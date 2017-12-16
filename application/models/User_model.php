<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    const TABLE_NAME = 'user';

    public function get_all($order_by_col='last_updated', $direction='DESC') {
        $this->db->order_by($order_by_col, $direction);
        $query = $this->db->get($this::TABLE_NAME);
        return $query->row_array();
    }

    public function get_by_user_id($user_id=FALSE) {
        if($user_id !== FALSE) {
            $query = $this->db->get_where($this::TABLE_NAME, array('user_id' => $user_id));
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    public function insert($user=FALSE) {
        if($user !== FALSE) {
            $temp_array = array();
            foreach($user as $key=>$value) {
                if($key !== 'user_id' || $key !== 'timestamp' || $key !== 'last_updated') {
                    $temp_array[$key] = $value;
                }
            }

            $this->db->set('timestamp', now(MYSQL_DATETIME_FORMAT));
            $this->db->set('last_updated', now(MYSQL_DATETIME_FORMAT));
            $this->db->insert($this::TABLE_NAME, $temp_array);
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function update($user=FALSE) {
        if($user !== FALSE) {
            $temp_array = array();
            foreach($user as $key=>$value) {
                if($key !== 'user_id' || $key !== 'timestamp' || $key !== 'last_updated') {
                    $temp_array[$key] = $value;
                }
            }

            $this->db->set('last_updated', now(MYSQL_DATETIME_FORMAT));
            $this->db->insert($this::TABLE_NAME, $temp_array);
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

} //end User_model class