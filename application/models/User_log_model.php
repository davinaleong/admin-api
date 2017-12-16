<?php
//@codeCoverageIgnoreStart
defined('BASEPATH') OR exit('No direct script access allowed');

class User_log_model extends CI_Model
{
    public function get_all()
    {
        $query = $this->db->get('user_log');
        return $query->result_array();
    }

    public function log_message($message)
    {
        $temp_array = array(
            'user_id'=>$this->session->userdata('user_id'),
            'message'=>$message
        );

        $this->db->set('timestamp', now(MYSQL_DATE_FORMAT));
        $this->db->insert('user_log', $temp_array);
        return $this->db->insert_id();
    }

} // end User_log_model controller class
//@codeCoverageIgnoreEnd