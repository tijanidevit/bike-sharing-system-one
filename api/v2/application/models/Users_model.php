<?php
class users_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->model('fn_model');
        $this->status_code  = get_response_status_code();
    }

    public function get_login_info($credentials)
    {
        $this->db->where(["email" => $credentials['email']]);
        $user = $this->db->get('users')->row_array();

        if (!$user) {
            return array(
                'status' => "error",
                'message' => "Invalid email address",
                'status_code' => $this->status_code['unauthorized']
            );
        }

        if ($user['password'] !== $credentials['password']) {
            return array(
                'status' => "error",
                'message' => "Login failed! Incorrect account password.",
                'status_code' => $this->status_code['unauthorized']
            );
        }

        if (!$this->fn_model->match_user_with_role($user['role_id'], 'user')) {
            return array(
                'status' => "error",
                'message' => "Access Denied! Please login through the right user account.",
                'status_code' => $this->status_code['unauthorized']
            );
        }


        if ($user['blocked'] === 1) {
            return array(
                'status' => "error",
                'message' => "Access Denied! This account is temporarily blocked, please contact our support centre.",
                'status_code' => $this->status_code['forbidden']
            );
        }
        $user_details = $this->_get_user_details($user['friconn_id']);

        if ($user['approved'] === 0) {
            return array(
                'status' => "success",
                'message' => "One more step to go, please verify your email address.",
                'status_code' => $this->status_code['ok'],
                'data' => array_merge($user, $user_details)
            );
        }

        return array(
            'status' => "success",
            'message' => "Login successful.",
            'status_code' => $this->status_code['ok'],
            'data' => array_merge($user, $user_details)
        );
    }

    public function create_account($details)
    {
        try {
            if ($this->db->insert('users', $details)) {
                $this->db->where(["matric_no" => $details['matric_no']]);
                $user = $this->db->get('users')->row_array();
                if ($user) {
                    return array(
                        'status' => "success",
                        'message' => "Registration Completed.",
                        'status_code' => $this->status_code['created'],
                        'data' => $user
                    );
                } 
                else {
                    return array(
                        'status' => "error",
                        'message' => "Opps! The server has encountered a temporary error. Please try again later",
                        'status_code' => $this->status_code['internalServerError']
                    );
                }
            } 
            else {
                return array(
                    'status' => "error",
                    'message' => "Opps! The server has encountered a temporary error. Please try again later",
                    'status_code' => $this->status_code['internalServerError']
                );
            }

        } 
        catch (\Throwable $th) {
            return array(
                'status' => "error",
                'message' => "Opps! The server has encountered a temporary error. Please try again later",
                'status_code' => $this->status_code['internalServerError']
            );
        };
    }

    public function get_last_user_id()
    {
        $users = $this->db->select('id')->order_by('id', "desc")->limit(1)->get('users')->row();
        return ($users->id + 1);
    }

    private function _get_user_details($friconn_id)
    {
        $this->db->select('*');
        $query = $this->db->get_where('users_profile', array('friconn_id' => $friconn_id));
        $result = $query->row_array();
        $result['institution'] = $this->fn_model->get_user_institution($result['institution_id']);
        $result['department'] = $this->fn_model->get_user_department($result['department_id']);
        return $result;
    }
    public function get_users(){
        $role_id = $this->fn_model->get_user_role_id('user');

        $this->db->select('friconn_id,role_id,last_name,other_names,email,profile_image,created_at');
        $profiles = $this->db->get_where('users',['role_id' => $role_id])->result();
        foreach ($profiles as $profile) {
            $profile->profile = $this->_get_user_details($profile->friconn_id);
        }
        return $profiles;
    }

    public function get_user($friconn_id){
        $role_id = $this->fn_model->get_user_role_id('user');
        $this->db->select('friconn_id,role_id,last_name,other_names,email,profile_image,created_at');
        $user = $this->db->get_where('users',['friconn_id' => $friconn_id,'role_id' => $role_id])->row_array();

        if ($user['role_id'] == $role_id) {
            $user_details = $this->_get_user_details($friconn_id);
            return array_merge($user, $user_details);
        }
        return null;
    }

    public function update_user_profile($data)
    {
        $update_profile = $this->db->update('users_profile',$data,['friconn_id' => $data['friconn_id']]);
        if ($update_profile) {
            return true;
        }
        return false;
    }

    public function get_user_points($friconn_id){
        $this->db->select('points');
        $user_points = $this->db->get_where('users_profile',['friconn_id' => $friconn_id])->row_array();

        if ($user_points) {
            return $user_points['points'];
        }
        return null;
    }

    public function update_user_points($data)
    {
        $update_points = $this->db->update('users_profile',$data,['friconn_id' => $data['friconn_id']]);
        if ($update_points) {
            return $this->get_user_points($data['friconn_id']);
        }
        return false;
    }

    public function get_users_courses(){
        $this->db->select('*');
        $users_courses = $this->db->order_by('id', "desc")->get('user_courses')->result();

        if ($users_courses) {
            foreach ($users_courses as $users_course) {
                $user = $this->fn_model->get_user_via_friconn_id($users_course->friconn_id);
                $users_course->user = $user['last_name']. ' '.$user['other_names'];

                $course = $this->fn_model->get_user_course($users_course->course_id);
                $users_course->course = $course;
            }

            return $users_courses;
        }
        return null;
    }

    public function get_user_courses($friconn_id){
        $this->db->select('*');
        $this->db->where(['friconn_id' => $friconn_id]);
        $user_courses = $this->db->order_by('id', "desc")->get('user_courses')->result();

        if ($user_courses) {
            foreach ($user_courses as $user_course) {
                $user = $this->fn_model->get_user_via_friconn_id($user_course->friconn_id);
                $user_course->user = $user['last_name']. ' '.$user['other_names'];

                $course = $this->fn_model->get_user_course($user_course->course_id);
                $user_course->course = $course;
            }

            return $user_courses;
        }
        return null;
    }

    public function check_user_course($data){
        $this->db->select('id');
        $this->db->where(['course_id' => $data['course_id'],'friconn_id' =>$data['friconn_id']]);
        $users_course = $this->db->get('user_courses')->num_rows();
        if ($users_course > 0) {
            return true;
        }
        return false;
    }

    public function add_user_course($data){
        if ($this->db->insert('user_courses',$data)) {
            $course = $this->get_user_last_course($data['friconn_id']);
            return $course;
        }
        return false;
    }

    public function get_user_last_course($friconn_id){
        $this->db->select('*');
        $this->db->where(['friconn_id' => $friconn_id]);
        $user_course = $this->db->order_by('id', "desc")->limit(1)->get('user_courses')->row_array();

        if ($user_course) {
            $course = $this->fn_model->get_user_course($user_course['course_id']);
            $user_course['course'] = $course;

            return $user_course;
        }
        return null;
    }

    public function get_user_questions($friconn_id){
        $this->db->select('*');
        $this->db->where(['friconn_id' => $friconn_id]);
        $user_questions = $this->db->order_by('id', "desc")->get('questions')->result();

        if ($user_questions) {
            foreach ($user_questions as $user_question) {
                $user = $this->fn_model->get_user_via_friconn_id($user_question->friconn_id);
                $user_question->user = $user['last_name']. ' '.$user['other_names'];
                $user_question->question = substr($user_question->question, 0,119);

                $course = $this->fn_model->get_user_course($user_question->course_id);
                $user_question->course = $course;
            }

            return $user_questions;
        }
        return null;
    }

    public function get_user_answers($friconn_id){
        $this->db->select('*');
        $this->db->where(['friconn_id' => $friconn_id]);
        $user_answers = $this->db->order_by('id', "desc")->get('question_answers')->result();

        if ($user_answers) {
            foreach ($user_answers as $user_answer) {
                $user = $this->fn_model->get_user_via_friconn_id($user_answer->friconn_id);
                $user_answer->user = $user['last_name']. ' '.$user['other_names'];

                $question = $this->fn_model->get_user_question($user_answer->question_id);
                $user_answer->question = $question;
            }

            return $user_answers;
        }
        return null;
    }

    public function get_users_plans(){
        $this->db->select('*');
        $users_plans = $this->db->order_by('id', "desc")->get('user_plans')->result();

        if ($users_plans) {
            foreach ($users_plans as $users_plan) {
                $user = $this->fn_model->get_user_via_friconn_id($users_plan->friconn_id);
                $users_plan->user = $user['last_name']. ' '.$user['other_names'];

                $plan = $this->fn_model->get_user_plan($users_plan->plan_id);
                $users_plan->plan = $plan;
            }

            return $users_plans;
        }
        return null;
    }

    public function get_user_plans($friconn_id){
        $this->db->select('*');
        $this->db->where(['friconn_id' => $friconn_id]);
        $user_plans = $this->db->order_by('id', "desc")->get('user_plans')->result();

        if ($user_plans) {
            foreach ($user_plans as $user_plan) {
                $user = $this->fn_model->get_user_via_friconn_id($user_plan->friconn_id);
                $user_plan->user = $user['last_name']. ' '.$user['other_names'];

                $plan = $this->fn_model->get_user_plan($user_plan->plan_id);
                $user_plan->plan = $plan;
            }

            return $user_plans;
        }
        return null;
    }

    public function check_user_plan($data){
        $this->db->select('id');
        $this->db->where(['plan_id' => $data['plan_id'],'friconn_id' =>$data['friconn_id']]);
        $users_plan = $this->db->get('user_plans')->num_rows();
        if ($users_plan > 0) {
            return true;
        }
        return false;
    }

    public function add_user_plan($data){
        if ($this->db->insert('user_plans',$data)) {
            $plan = $this->get_user_last_plan($data['friconn_id']);
            return $plan;
        }
        return false;
    }

    public function get_user_last_plan($friconn_id){
        $this->db->select('*');
        $this->db->where(['friconn_id' => $friconn_id]);
        $user_plan = $this->db->order_by('id', "desc")->limit(1)->get('user_plans')->row_array();

        if ($user_plan) {
            $plan = $this->fn_model->get_user_plan($user_plan['plan_id']);
            $user_plan['plan'] = $plan;

            return $user_plan;
        }
        return null;
    }


    public function get_user_payments($friconn_id){
        $this->db->select('*');
        $this->db->where(['friconn_id' => $friconn_id]);
        $user_payments = $this->db->order_by('id', "desc")->get('payments')->result();

        if ($user_payments) {
            foreach ($user_payments as $user_payment) {
                $user = $this->fn_model->get_user_via_friconn_id($user_payment->friconn_id);
                $user_payment->user = $user['last_name']. ' '.$user['other_names'];
                
                $plan = $this->fn_model->get_user_plan($user_payment->plan_id);
                $user_payment->plan = $plan;
            }

            return $user_payments;
        }
        return null;
    }
}
