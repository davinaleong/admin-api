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

        $this->load->library('datetime_helper');
        $this->db->set('timestamp', $this->datetime_helper->now(MYSQL_DATE_FORMAT));
        $this->db->insert('user_log', $temp_array);
        return $this->db->insert_id();
    }

    public function validate_access($requiredAccess,$userAccess)
    {
        $valid = false;

        for ($i = 0; $i < strlen($userAccess); $i++)
        {
            if (strpos($requiredAccess, substr($userAccess, $i, 1)) !== false)
            {
                $valid = true;
                break;
            }
        }
        return $valid;
    }

    public function _get_account_status_array()
    {
        return array(
            STATUS_ACTIVE,
            STATUS_DEACTIVATED
        );
    }

} // end User_log_model controller class
//@codeCoverageIgnoreEnd