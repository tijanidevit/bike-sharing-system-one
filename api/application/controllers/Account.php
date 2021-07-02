<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Account extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('account_model');
        $this->load->model('fn_model');
        $this->status_code  = get_response_status_code();
        $this->load->library('form_validation');
    }

    function index_get()
    {

        $this->response([
            'status' => 'success',
            'message' => 'Account API Connected successful.',
            'time_connected' => date('d-M-Y h:i:s'),
            'domain' => base_url()
        ], REST_Controller::HTTP_OK);
    }

    public function password_post($action)
    {

        if ($action === 'token') { #verify user's password token

            $this->form_validation->set_rules('token', 'Password Reset Token', 'required');

            if ($this->form_validation->run() === FALSE) {
                return $this->response([
                    'status' => "error",
                    'message' => "Password Reset Token required.",
                    'status_code' => $this->status_code['badRequest']
                ], $this->status_code['badRequest']);
            } else {
                $token = $this->input->post('token');
                $token_data = $this->account_model->fetch_password_token($token);
                if (!$token_data) {
                    return $this->response([
                        'status' => 'error',
                        'message' => 'Unrecognized Token',
                        'status_code' => $this->status_code['notFound']
                    ], $this->status_code['notFound']);
                }

                return $this->response([
                    'status' => 'success',
                    'message' => 'Token Valid',
                    'data' => $token_data,
                    'status_code' => $this->status_code['ok']
                ], $this->status_code['ok']);
            }
        } else if ($action === 'request') { #request password token
            $email = $this->post('email');

            $this->form_validation->set_rules('email', 'Email', 'required');

            if ($this->form_validation->run() === FALSE) {
                return $this->response([
                    'status' => "error",
                    'message' => "Email address required.",
                    'status_code' => $this->status_code['badRequest']
                ], $this->status_code['badRequest']);
            }
            $user = $this->fn_model->get_user_via_email($email);

            if (!$user) {
                return $this->response([
                    "message" => "We couldn't find your email addres in our store. Would you try again ?",
                    "status" => "error",
                    "status_code" => "404"
                ], $this->status_code['notFound']);
            }


            $friconn_id = $user['friconn_id'];

            $link = urlify($friconn_id);
            $token_data = array(
                "token" => $link['token'],
                "friconn_id" => $friconn_id,
                "expires_at" => plushrs(date('Y-m-d h:i:s'), 24),
            );

            try {
                $save_password_request = $this->account_model->save_password_request($token_data);
                if (!$save_password_request) {
                    return $this->response([
                        "message" => "internalServerError",
                        "status" => "error",
                    ], $this->status_code['badRequest']);;
                }

                $emailMessage = "
                <p class='text-justify'>You requested for a password reset. Click the link below to reset your password</p>
                <p class='text-center'><a href='" . $link['url'] . "'>Click to reset password</a></p>
                <p>If you do not initial this, you may revoke password change access <a href='https://friconn.com/password/revoke'>here</a> </p>
                ";
                // $send = send_HTML_email($this, 'Friconn Password Reset', $emailMessage, $email);
                // if ($send) {
                $this->response([
                    "message" => "Okay. We are good to go! A reset link has been sent to your email address",
                    "status" => "success",
                    "data" =>
                    [
                        'token_data' => $token_data,
                        'link' => $link,
                    ]
                ], $this->status_code['ok']);
                // }
            } catch (Exception $e) {
                $this->response([
                    "message" => $e,
                    "status" => "error",
                ], $this->status_code['methodNotAllowed']);
            }
        } else if ($action === 'reset') { #reset forgotten password
            $this->form_validation->set_rules('friconn_id', 'Friconn ID', 'required');
            $this->form_validation->set_rules('new_password', 'New Password', 'required');

            if ($this->form_validation->run() === FALSE) {
                $this->response([
                    'status' => "error",
                    'message' => "All inputs are required.",
                    'status_code' => $this->status_code['badRequest']
                ], $this->status_code['badRequest']);
            } else {
                $new_password = $this->input->post('new_password');
                $friconn_id = $this->input->post('friconn_id');

                if (!$this->account_model->fetch_user_password_token($friconn_id)) {
                    return $this->response([
                        'status' => 'error',
                        'message' => 'User has not made any password reset request',
                        'status_code' => $this->status_code['notFound']
                    ], $this->status_code['notFound']);
                }

                $user_data = $this->fn_model->get_user_via_friconn_id($friconn_id);
                if (!$user_data) {
                    return $this->response([
                        'status' => 'error',
                        'message' => 'Unrecognized user',
                        'status_code' => $this->status_code['notFound']
                    ], $this->status_code['notFound']);
                }

                if (strlen('' . $new_password) < 6) {
                    return $this->response([
                        'status' => 'error',
                        'message' => 'New Password must be up to six character lengths',
                        'status_code' => $this->status_code['lengthRequired']
                    ], $this->status_code['lengthRequired']);
                }

                if ($this->account_model->update_user_password(encrypt($new_password), $friconn_id)) {
                    $this->account_model->delete_user_password_request($friconn_id);
                    return $this->response([
                        'status' => 'success',
                        'message' => 'Password updated successfully',
                        'status_code' => $this->status_code['ok']
                    ], $this->status_code['ok']);
                }

                return $this->response([
                    'status' => 'error',
                    'message' => 'Password not updated',
                    'status_code' => $this->status_code['badRequest']
                ], $this->status_code['badRequest']);
            }
        } else if ($action === 'update') { #user update password 
            $this->form_validation->set_rules('old_password', 'Old Password', 'required');
            $this->form_validation->set_rules('friconn_id', 'Friconn ID', 'required');
            $this->form_validation->set_rules('new_password', 'New Password', 'required');

            if ($this->form_validation->run() === FALSE) {
                $this->response([
                    'status' => "error",
                    'message' => "All inputs are required.",
                    'status_code' => $this->status_code['badRequest']
                ], $this->status_code['badRequest']);
            } else {
                $old_password = $this->input->post('old_password');
                $new_password = $this->input->post('new_password');
                $friconn_id = $this->input->post('friconn_id');

                $user_data = $this->fn_model->get_user_via_friconn_id($friconn_id);
                if (!$user_data) {
                    return $this->response([
                        'status' => 'error',
                        'message' => 'Unrecognized user',
                        'status_code' => $this->status_code['notFound']
                    ], $this->status_code['notFound']);
                }

                if ($user_data['password'] != encrypt($old_password)) {
                    return $this->response([
                        'status' => 'error',
                        'message' => 'Old password not correct',
                        'status_code' => $this->status_code['badRequest']
                    ], $this->status_code['badRequest']);
                }

                if (strlen('' . $new_password) < 6) {
                    return $this->response([
                        'status' => 'error',
                        'message' => 'New Password must be up to six character lengths',
                        'status_code' => $this->status_code['lengthRequired']
                    ], $this->status_code['lengthRequired']);
                }

                if ($new_password == $old_password) {
                    return $this->response([
                        'status' => 'error',
                        'message' => 'Old password and new password cannot be the same',
                        'status_code' => $this->status_code['badRequest']
                    ], $this->status_code['badRequest']);
                }

                if ($this->account_model->update_user_password(encrypt($new_password), $friconn_id)) {
                    return $this->response([
                        'status' => 'success',
                        'message' => 'Password updated successfully',
                        'status_code' => $this->status_code['ok']
                    ], $this->status_code['ok']);
                }

                return $this->response([
                    'status' => 'error',
                    'message' => 'Password not updated',
                    'status_code' => $this->status_code['badRequest']
                ], $this->status_code['badRequest']);
            }
        } else if ($action === 'revoke') {
            #revoke password token
            $token = $this->post('token');
            $this->form_validation->set_rules('token', 'Token', 'required');
            if ($this->form_validation->run() === FALSE) {
                return $this->response([
                    'status' => "error",
                    'message' => "Token required.",
                    'status_code' => $this->status_code['badRequest']
                ], $this->status_code['badRequest']);
            }
            if (!$this->account_model->fetch_password_token($token)) {
                return $this->response([
                    'status' => "error",
                    'message' => "Token not found.",
                    'status_code' => $this->status_code['notFound']
                ], $this->status_code['notFound']);
            }
            if ($this->account_model->delete_password_request($token)) {
                return $this->response([
                    'status' => "success",
                    'message' => "Token revoked successfully.",
                    'status_code' => $this->status_code['ok']
                ], $this->status_code['ok']);
            } else {
                return $this->response([
                    'status' => "error",
                    'message' => "Unable to revoke token.",
                    'status_code' => $this->status_code['badRequest']
                ], $this->status_code['badRequest']);
            }
        } else {
            return $this->response([
                'status' => "error",
                'message' => "Action not recognized.",
                'status_code' => $this->status_code['badRequest']
            ], $this->status_code['badRequest']);
        }
    }

    function email_post($action) #Email
    {
        if ($action == 'verify') { #verify email
            $this->form_validation->set_rules('verification_code', 'Verification Code', 'required');
            $this->form_validation->set_rules('friconn_id', 'Friconn ID', 'required');

            if ($this->form_validation->run() === FALSE) {
                $this->response([
                    'status' => "error",
                    'message' => "one or more required data is missing.",
                    'status_code' => $this->status_code['badRequest']
                ], $this->status_code['badRequest']);
            } else {

                $data = array(
                    'friconn_id' => $this->input->post('friconn_id'),
                    'verification_code' => $this->input->post('verification_code')
                );


                if ($this->account_model->check_user_approval($data['friconn_id'])) {
                    return $this->response([
                        'status' => 'success',
                        'message' => 'Email already verified',
                        'status_code' => $this->status_code['ok']
                    ], $this->status_code['ok']);
                }

                $is_valid = $this->account_model->check_verification_code($data);

                if ($is_valid) {

                    $verification_response = $this->account_model->verify_user_account($data['friconn_id']);
                    $this->response(
                        $verification_response,
                        $verification_response['status_code']
                    );
                } else {
                    $this->response([
                        'status' => 'error',
                        'message' => 'Invalid or expired verification code',
                        'status_code' => $this->status_code['badRequest']
                    ], $this->status_code['badRequest']);
                }
            }
        } else if ($action === 'request') {  #request email verification code
            $this->form_validation->set_rules('friconn_id', 'Friconn ID', 'required');

            if ($this->form_validation->run() === FALSE) {
                $this->response([
                    'status' => "error",
                    'message' => "Friconn ID is missing.",
                    'status_code' => $this->status_code['badRequest']
                ], $this->status_code['badRequest']);
            } else {
                $data = array(
                    'friconn_id' => $this->input->post('friconn_id'),
                    'verification_code' => rand(111111, 999999)
                );


                if ($this->account_model->check_user_approval($data['friconn_id'])) {
                    return $this->response([
                        'status' => 'success',
                        'message' => 'Email already verified',
                        'status_code' => $this->status_code['ok']
                    ], $this->status_code['ok']);
                }


                $user_email = $this->account_model->get_account_email($data['friconn_id']);
                if ($user_email !== '') {
                    if ($this->account_model->set_verification_code($data)) {
                        send_HTML_email($this, 'Verification Code Resent', $data['verification_code'], $user_email);
                        $this->response(
                            [
                                'status' => 'success',
                                'message' => 'Verification code sent successfully',
                                'status_code' => $this->status_code['ok']
                            ],
                            $this->status_code['ok']
                        );
                    } else {
                        $this->response([
                            'status' => "error",
                            'message' => "Opps! The server has encountered a temporary error. Please try again later",
                            'status_code' => $this->status_code['internalServerError']
                        ]);
                    }
                } else {
                    $this->response([
                        'status' => 'error',
                        'message' => 'Acccount not found',
                        'status_code' => $this->status_code['notFound']
                    ], $this->status_code['notFound']);
                }
            }
        }
    }
}
