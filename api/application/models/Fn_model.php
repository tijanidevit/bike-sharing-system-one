<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fn_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }


    public function get_bike($id){
        $this->db->select('*');
        $bike = $this->db->get_where('bikes',['id' => $id])->row_array();

        if ($bike) {
            return $bike;
        }
        return null;
    }

    
}
