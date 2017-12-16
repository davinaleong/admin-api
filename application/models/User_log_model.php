<?php
//@codeCoverageIgnoreStart
defined('BASEPATH') OR exit('No direct script access allowed');

class User_log_model extends CI_Model
{
    const TABLE_NAME = 'user_log';

    public function get_all()
    {
        $query = $this->db->get($this::TABLE_NAME);
        return $query->result_array();
    }

    public function log_message($message)
    {
        $temp_array = array(
            'user_id'=>$this->session->userdata('user_id'),
            'message'=>$message
        );

        $this->db->set('timestamp', now(MYSQL_DATE_FORMAT));
        $this->db->insert($this::TABLE_NAME, $temp_array);
        return $this->db->insert_id();
    }

} // end User_log_model controller class
//@codeCoverageIgnoreEnd