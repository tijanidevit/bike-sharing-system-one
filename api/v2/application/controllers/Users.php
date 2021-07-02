<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Users extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
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

                if ($this->fn_model->check_user_matric_number($details['matric_number'])) {
                    $this->response([
                        'status' => 'error',
                        'message' => 'Hey! The matric_number is already associated with another account.',
                        'status_code' => $this->status_code['forbidden']
                    ], $this->status_code['forbidden']);
                } 
                else {
                    $response = $this->users_model->create_account($details);
                }
                $this->response($response, $response['status_code']);
            }
        }
        catch (\Throwable $th) {
            $this->response([
                'status' => 'error',
                'message' => "Opps! The server has encountered a temporary error. Please try again later",
                'status_code' => $this->status_code['internalServerError']
            ], $this->status_code['internalServerError']);
        }
    }
    function profile_get($friconn_id = '')
    {
        if (!$friconn_id) {
            $users = $this->users_model->get_users();
            return $this->response([
                'status' => "success",
                'message' => "users fetched successfully.",
                'status_code' => $this->status_code['ok'],
                'data' => $users
            ], $this->status_code['ok']);
        }
        else{
            $user = $this->users_model->get_user($friconn_id);
            if ($user == null) {
                return $this->response([
                    'status' => "error",
                    'message' => "user not found or not a user.",
                    'status_code' => $this->status_code['ok'],
                    'data' => $user
                ], $this->status_code['ok']);
            }
            return $this->response([
                'status' => "success",
                'message' => "user fetched successfully.",
                'status_code' => $this->status_code['ok'],
                'data' => $user
            ], $this->status_code['ok']);
        }
    }
    function profile_post()
    {
        $this->form_validation->set_rules('friconn_id', 'Friconn ID', 'required');
        $this->form_validation->set_rules('dob', 'Date of birth', 'required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required');
        $this->form_validation->set_rules('institution_id', 'Institution', 'required');
        $this->form_validation->set_rules('department_id', 'department_id', 'required');
        if ($this->form_validation->run() === FALSE) {
            return $this->response([
                'status' => "failed",
                'message' => "All inputs are required.",
                'status_code' => $this->status_code['badRequest'],
                'data' => []
            ], $this->status_code['badRequest']);
        }

        $profile = [
            'friconn_id' => $this->input->post('friconn_id'),
            'dob' => $this->input->post('dob'),
            'phone' => $this->input->post('phone'),
            "institution_id" => $this->input->post('institution_id'),
            "department_id" => $this->input->post('department_id'),
        ];

        $user = $this->fn_model->get_user_via_friconn_id($profile['friconn_id']);
        $role_id = $this->fn_model->get_user_role_id('user');

        if (! $user ) {
            return $this->response([
                'status' => "error",
                'message' => "user not found.",
                'status_code' => $this->status_code['ok'],
            ], $this->status_code['ok']);
        }

        if ($user['role_id'] != $role_id) {
            return $this->response([
                'status' => "error",
                'message' => "User not a user.",
                'status_code' => $this->status_code['unauthorized'],
            ], $this->status_code['unauthorized']);
        }

        if ($this->users_model->update_user_profile($profile)) {
            return $this->response([
                'status' => "success",
                'message' => "user profile updated successfully.",
                'status_code' => $this->status_code['ok'],
                'data' => $user
            ], $this->status_code['ok']);
        }

        return $this->response([
            'status' => "error",
            'message' => "Unable to update user profile.",
            'status_code' => $this->status_code['badRequest'],
            'data' => $user
        ], $this->status_code['badRequest']);


    }

    function points_get($friconn_id)
    {
        $user_points = $this->users_model->get_user_points($friconn_id);
        if ($user_points == null) {
            return $this->response([
                'status' => "error",
                'message' => "Unable to fetch user points.",
                'status_code' => $this->status_code['ok'],
            ], $this->status_code['ok']);
        }
        return $this->response([
            'status' => "success",
            'message' => "user points fetched successfully.",
            'status_code' => $this->status_code['ok'],
            'data' => $user_points
        ], $this->status_code['ok']);
    }

    function points_post()
    {

        $this->form_validation->set_rules('friconn_id', 'Friconn ID', 'required');
        $this->form_validation->set_rules('points', 'Points', 'required');
        if ($this->form_validation->run() === FALSE) {
            return $this->response([
                'status' => "failed",
                'message' => "All inputs are required.",
                'status_code' => $this->status_code['badRequest'],
                'data' => []
            ], $this->status_code['badRequest']);
        }

        $data = [
            'friconn_id' => $this->input->post('friconn_id'),
            'points' => $this->input->post('points')
        ];
        $user = $this->users_model->get_user($data['friconn_id']);
        if ($user == null) {
            return $this->response([
                'status' => "error",
                'message' => "user not found or not an user.",
                'status_code' => $this->status_code['ok']
            ], $this->status_code['ok']);
        }

        $user_points = $this->users_model->update_user_points($data);
        if (! $user_points) {
            return $this->response([
                'status' => "error",
                'message' => "user points not updated.",
                'status_code' => $this->status_code['badRequest'],
            ], $this->status_code['badRequest']);
        }
        return $this->response([
            'status' => "success",
            'message' => "user points updated successfully.",
            'status_code' => $this->status_code['ok'],
            'data' => $user_points
        ], $this->status_code['ok']);
    }

    function courses_get($friconn_id = '')
    {
        if ($friconn_id) {
            $user_courses = $this->users_model->get_user_courses($friconn_id);
            if ($user_courses == null) {
                return $this->response([
                    'status' => "error",
                    'message' => "user has no course added.",
                    'status_code' => $this->status_code['ok'],
                ], $this->status_code['ok']);
            }
            return $this->response([
                'status' => "success",
                'message' => "user courses fetched successfully.",
                'status_code' => $this->status_code['ok'],
                'data' => $user_courses
            ], $this->status_code['ok']);
        }
        else{
            $user_courses = $this->users_model->get_users_courses($friconn_id);
            if ($user_courses == null) {
                return $this->response([
                    'status' => "error",
                    'message' => "users have no courses added.",
                    'status_code' => $this->status_code['ok'],
                ], $this->status_code['ok']);
            }
            return $this->response([
                'status' => "success",
                'message' => "users courses fetched successfully.",
                'status_code' => $this->status_code['ok'],
                'data' => $user_courses
            ], $this->status_code['ok']);
        }
    }

    function courses_post()
    {
        $this->form_validation->set_rules('friconn_id', 'Friconn ID', 'required');
        $this->form_validation->set_rules('course_id', 'course_id', 'required');
        if ($this->form_validation->run() === FALSE) {
            return $this->response([
                'status' => "failed",
                'message' => "All inputs are required.",
                'status_code' => $this->status_code['badRequest'],
                'data' => []
            ], $this->status_code['badRequest']);
        }

        $data = [
            'friconn_id' => $this->input->post('friconn_id'),
            'course_id' => $this->input->post('course_id'),
        ];


        $role_id = $this->fn_model->get_user_role_id('user');
        $user = $this->fn_model->get_user_via_friconn_id($data['friconn_id']);

        if ($user['role_id'] !== $role_id) {
            return $this->response([
                'status' => "error",
                'message' => "User not a user.",
                'status_code' => $this->status_code['unauthorized'],
            ], $this->status_code['unauthorized']);
        }


        if (! $this->fn_model->get_user_course($data['course_id'])) {
            return $this->response([
                'status' => "error",
                'message' => "Course does not exist.",
                'status_code' => $this->status_code['ok'],
            ], $this->status_code['ok']);
        }

        if ($this->users_model->check_user_course($data)) {
            return $this->response([
                'status' => "error",
                'message' => "user already added this course.",
                'status_code' => $this->status_code['conflict'],
            ], $this->status_code['conflict']);
        }
        $course = $this->users_model->add_user_course($data);
        if (!$course) {
            return $this->response([
                'status' => "error",
                'message' => "user course not added.",
                'status_code' => $this->status_code['internalServerError'],
            ], $this->status_code['internalServerError']);
        }

        return $this->response([
            'status' => "success",
            'message' => "user course added successfully.",
            'status_code' => $this->status_code['created'],
            'data' => $course
        ], $this->status_code['created']);
    }

    function questions_get($friconn_id)
    {
        $user_questions = $this->users_model->get_user_questions($friconn_id);
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

    function answers_get($friconn_id)
    {
        $user_answers = $this->users_model->get_user_answers($friconn_id);
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

    // function plans_get($friconn_id = '')
    // {
    //     if ($friconn_id) {
    //         $user_plans = $this->users_model->get_user_plans($friconn_id);
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
    //         $user_plans = $this->users_model->get_users_plans($friconn_id);
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
    //     $this->form_validation->set_rules('friconn_id', 'Friconn ID', 'required');
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
    //         'friconn_id' => $this->input->post('friconn_id'),
    //         'plan_id' => $this->input->post('plan_id'),
    //         'points' => $this->input->post('points'),
    //     ];


    //     $role_id = $this->fn_model->get_user_role_id('user');
    //     $user = $this->fn_model->get_user_via_friconn_id($data['friconn_id']);

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

    //     $old_points = $this->fn_model->get_user_points($data['friconn_id']);
    //     $new_points = $data['points'];

    //     $points = $old_points + $new_points;
    //     $update_data = ['friconn_id' => $data['friconn_id'], 'points'=> $points];

    //     $plan['new_points'] = $this->fn_model->update_user_points($update_data);

    //     return $this->response([
    //         'status' => "success",
    //         'message' => "user plan added successfully.",
    //         'status_code' => $this->status_code['created'],
    //         'data' => $plan
    //     ], $this->status_code['created']);
    // }

    function payments_get($friconn_id)
    {
        if ($friconn_id) {
            $user_payments = $this->users_model->get_user_payments($friconn_id);
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
                'message' => "Friconn ID required.",
                'status_code' => $this->status_code['badRequest'],
            ], $this->status_code['badRequest']);
        }
    }

}
