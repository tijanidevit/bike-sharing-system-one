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
        $this->db->where(["matric_number" => $credentials['matric_number']]);
        $user = $this->db->get('users')->row_array();

        if (!$user) {
            return array(
                'status' => "error",
                'message' => "Unknown matric number",
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

        return array(
            'status' => "success",
            'message' => "Login successful.",
            'status_code' => $this->status_code['ok'],
            'data' => $user
        );
    }


    public function check_user_matric_number($matric_number)
    {

        $this->db->where("matric_number", $matric_number);
        $matric_numberCheck = $this->db->get('users');
        if ($matric_numberCheck->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function create_account($details)
    {

        try {
            if ($this->db->insert('users', $details)) {
                $this->db->where(["matric_number" => $details['matric_number']]);
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
                'message' => $th,
                'status_code' => $this->status_code['internalServerError']
            );
        };
    }

    public function get_user_bookings($user_id){
        $this->db->select('*');
        $this->db->where(['user_id' => $user_id]);
        $bookings = $this->db->order_by('id', "desc")->get('bookings')->result();

        if ($bookings) {
            foreach ($bookings as $booking) {
                $booking = $this->fn_model->get_user_booking($booking->booking_id);
                $booking->booking = $booking;
            }

            return $bookings;
        }
        return null;
    }


    public function add_user_booking($data){
        if ($this->db->insert('user_bookings',$data)) {
            return true;
        }
        return false;
    }
}
