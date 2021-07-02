<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Users extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('fn_model');
        $this->status_code  = get_response_status_code();
        $this->load->library('form_validation');
    }

    function index_get()
    {

        $this->response([
            'status' => 'success',
            'message' => 'users API Connected successful.',
            'time_connected' => date('d-M-Y h:i:s'),
            'domain' => base_url()
        ], REST_Controller::HTTP_OK);
    }
    function login_post()
    {
        $this->form_validation->set_rules('matric_number', 'Matric Number', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');


        if ($this->form_validation->run() === FALSE) {
            $this->response([
                'status' => "failed",
                'message' => "Provide Matric Number and password.",
                'status_code' => $this->status_code['badRequest'],
                'data' => []
            ], $this->status_code['badRequest']);
        } else {
            $credentials = array(
                'matric_number' => $this->input->post('matric_number'),
                'password' => encrypt($this->input->post('password'))
            );
            $result = $this->users_model->get_login_info($credentials);
            $this->response($result, $result['status_code']);
        }
    }

    function register_post()
    {

        $this->load->library('form_validation');

        try {

            $this->form_validation->set_rules('matric_number', 'Matric Number', 'required');
            $this->form_validation->set_rules('fullname', 'Full name', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run() === FALSE) {
                $this->response([
                    'status' => "failed",
                    'message' => "One or more required data is missing.",
                    'status_code' => $this->status_code['badRequest'],
                    'data' => []
                ], $this->status_code['badRequest']);
            } 
            else {
                $details = array(
                    "fullname" => $this->input->post('fullname'),
                    "phone" => $this->input->post('phone'),
                    "matric_number" => $this->input->post('matric_number'),
                    "password" => encrypt($this->input->post('password'))
                );

                if ($this->users_model->check_user_matric_number($details['matric_number'])) {
                    $this->response([
                        'status' => 'error',
                        'message' => 'Hey! The matric number is already associated with another account.',
                        'status_code' => $this->status_code['forbidden']
                    ], $this->status_code['forbidden']);
                } 
                else {
                    $response = $this->users_model->create_account($details);
                    $this->response($response, $response['status_code']);
                }
            }
        }
        catch (\Throwable $th) {
            $this->response([
                'status' => 'error',
                'message' => "Opps! The server has encountered a temporary error. Please try again later.",
                'status_code' => $this->status_code['internalServerError']
            ], $this->status_code['internalServerError']);
        }
    }

    function bookings_get($user_id = '')
    {
        if ($user_id) {
            $user_bookings = $this->users_model->get_user_bookings($user_id);
            if ($user_bookings == null) {
                return $this->response([
                    'status' => "error",
                    'message' => "You have no bookings.",
                    'status_code' => $this->status_code['ok'],
                ], $this->status_code['ok']);
            }
            return $this->response([
                'status' => "success",
                'message' => "Your bookings fetched successfully.",
                'status_code' => $this->status_code['ok'],
                'data' => $user_bookings
            ], $this->status_code['ok']);
        }
    }

    function bookings_post()
    {
        $this->form_validation->set_rules('user_id', 'user ID', 'required');
        $this->form_validation->set_rules('bike_id', 'bike_id', 'required');
        if ($this->form_validation->run() === FALSE) {
            return $this->response([
                'status' => "failed",
                'message' => "All inputs are required.",
                'status_code' => $this->status_code['badRequest'],
                'data' => []
            ], $this->status_code['badRequest']);
        }

        $data = [
            'user_id' => $this->input->post('user_id'),
            'bike_id' => $this->input->post('bike_id'),
        ];
        
        if ($this->users_model->check_user_booking($data)) {
            return $this->response([
                'status' => "error",
                'message' => "user already added this booking.",
                'status_code' => $this->status_code['conflict'],
            ], $this->status_code['conflict']);
        }
        $booking = $this->users_model->add_user_booking($data);
        if (!$booking) {
            return $this->response([
                'status' => "error",
                'message' => "user booking not added.",
                'status_code' => $this->status_code['internalServerError'],
            ], $this->status_code['internalServerError']);
        }

        return $this->response([
            'status' => "success",
            'message' => "user booking added successfully.",
            'status_code' => $this->status_code['created'],
            'data' => $booking
        ], $this->status_code['created']);
    }

    function questions_get($user_id)
    {
        $user_questions = $this->users_model->get_user_questions($user_id);
        if ($user_questions == null) {
            return $this->response([
                'status' => "error",
                'message' => "user has no question added.",
                'status_code' => $this->status_code['ok'],
            ], $this->status_code['ok']);
        }
        return $this->response([
            'status' => "success",
            'message' => "user questions fetched successfully.",
            'status_code' => $this->status_code['ok'],
            'data' => $user_questions
        ], $this->status_code['ok']);

    }

    function answers_get($user_id)
    {
        $user_answers = $this->users_model->get_user_answers($user_id);
        if ($user_answers == null) {
            return $this->response([
                'status' => "error",
                'message' => "user has no answer added.",
                'status_code' => $this->status_code['ok'],
            ], $this->status_code['ok']);
        }
        return $this->response([
            'status' => "success",
            'message' => "user answers fetched successfully.",
            'status_code' => $this->status_code['ok'],
            'data' => $user_answers
        ], $this->status_code['ok']);

    }

    // function plans_get($user_id = '')
    // {
    //     if ($user_id) {
    //         $user_plans = $this->users_model->get_user_plans($user_id);
    //         if ($user_plans == null) {
    //             return $this->response([
    //                 'status' => "error",
    //                 'message' => "user has no plan added.",
    //                 'status_code' => $this->status_code['ok'],
    //             ], $this->status_code['ok']);
    //         }
    //         return $this->response([
    //             'status' => "success",
    //             'message' => "user plans fetched successfully.",
    //             'status_code' => $this->status_code['ok'],
    //             'data' => $user_plans
    //         ], $this->status_code['ok']);
    //     }
    //     else{
    //         $user_plans = $this->users_model->get_users_plans($user_id);
    //         if ($user_plans == null) {
    //             return $this->response([
    //                 'status' => "error",
    //                 'message' => "users have no plans added.",
    //                 'status_code' => $this->status_code['ok'],
    //             ], $this->status_code['ok']);
    //         }
    //         return $this->response([
    //             'status' => "success",
    //             'message' => "users plans fetched successfully.",
    //             'status_code' => $this->status_code['ok'],
    //             'data' => $user_plans
    //         ], $this->status_code['ok']);
    //     }
    // }

    // function plans_post()
    // {
    //     $this->form_validation->set_rules('user_id', 'user ID', 'required');
    //     $this->form_validation->set_rules('plan_id', 'plan_id', 'required');
    //     $this->form_validation->set_rules('points', 'points', 'required');
    //     if ($this->form_validation->run() === FALSE) {
    //         return $this->response([
    //             'status' => "failed",
    //             'message' => "All inputs are required.",
    //             'status_code' => $this->status_code['badRequest'],
    //             'data' => []
    //         ], $this->status_code['badRequest']);
    //     }

    //     $data = [
    //         'user_id' => $this->input->post('user_id'),
    //         'plan_id' => $this->input->post('plan_id'),
    //         'points' => $this->input->post('points'),
    //     ];


    //     $role_id = $this->fn_model->get_user_role_id('user');
    //     $user = $this->fn_model->get_user_via_user_id($data['user_id']);

    //     if ($user['role_id'] !== $role_id) {
    //         return $this->response([
    //             'status' => "error",
    //             'message' => "User not a user.",
    //             'status_code' => $this->status_code['unauthorized'],
    //         ], $this->status_code['unauthorized']);
    //     }


    //     if (! $this->fn_model->get_user_plan($data['plan_id'])) {
    //         return $this->response([
    //             'status' => "error",
    //             'message' => "plan does not exist.",
    //             'status_code' => $this->status_code['ok'],
    //         ], $this->status_code['ok']);
    //     }

    //     $plan = $this->users_model->add_user_plan($data);
    //     if (!$plan) {
    //         return $this->response([
    //             'status' => "error",
    //             'message' => "user plan not added.",
    //             'status_code' => $this->status_code['internalServerError'],
    //         ], $this->status_code['internalServerError']);
    //     }

    //     $old_points = $this->fn_model->get_user_points($data['user_id']);
    //     $new_points = $data['points'];

    //     $points = $old_points + $new_points;
    //     $update_data = ['user_id' => $data['user_id'], 'points'=> $points];

    //     $plan['new_points'] = $this->fn_model->update_user_points($update_data);

    //     return $this->response([
    //         'status' => "success",
    //         'message' => "user plan added successfully.",
    //         'status_code' => $this->status_code['created'],
    //         'data' => $plan
    //     ], $this->status_code['created']);
    // }

    function payments_get($user_id)
    {
        if ($user_id) {
            $user_payments = $this->users_model->get_user_payments($user_id);
            if ($user_payments == null) {
                return $this->response([
                    'status' => "error",
                    'message' => "user has no payment added.",
                    'status_code' => $this->status_code['ok'],
                ], $this->status_code['ok']);
            }
            return $this->response([
                'status' => "success",
                'message' => "user payments fetched successfully.",
                'status_code' => $this->status_code['ok'],
                'data' => $user_payments
            ], $this->status_code['ok']);
        }
        else{            
            return $this->response([
                'status' => "error",
                'message' => "user ID required.",
                'status_code' => $this->status_code['badRequest'],
            ], $this->status_code['badRequest']);
        }
    }

}
