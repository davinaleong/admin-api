<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personal_profile_model extends CI_Model {

    const TABLE_NAME = 'user';

    public function get_by_user_id($user_id=FALSE, $access=FALSE) {
        if($user_id !== FALSE && $access !== FALSE) {
            $this->load->model('Authentication_model');
            $result = FALSE;
            if($this->Authentication_model->validate_user_access("SA", $access)) {
                $this->db->select('user_id, username, name, access, status, timestamp, last_updated');
                $this->db->from($this::TABLE_NAME);
                $this->db->where('user_id = ', $user_id);
                $result = $this->db->get();
            } else {
                $this->db->select('user_id, username, name, timestamp, last_updated');
                $this->db->from($this::TABLE_NAME);
                $this->db->where('user_id = ', $user_id);
                $result = $this->db->get();
            }
            return $result->row_array();
        } else {
            return FALSE;
        }
    }

    public function get_by_username($username=FALSE, $access=FALSE) {
        if($username !== FALSE && $access !== FALSE) {
            $this->load->model('Authentication_model');
            $result = FALSE;
            if($this->Authentication_model->validate_user_access("SA", $access)) {
                $this->db->select('username, username, name, access, status, timestamp, last_updated');
                $this->db->from($this::TABLE_NAME);
                $this->db->where('username = ', $username);
                $result = $this->db->get();
            } else {
                $this->db->select('username, username, name, timestamp, last_updated');
                $this->db->from($this::TABLE_NAME);
                $this->db->where('username = ', $username);
                $result = $this->db->get();
            }
            return $result->row_array();
        } else {
            return FALSE;
        }
    }

    public function get_by_user_hash($user_hash=FALSE, $access=FALSE) {
        if($user_hash !== FALSE && $access !== FALSE) {
            $this->load->model('Authentication_model');
            $result = FALSE;
            if($this->Authentication_model->validate_user_access("SA", $access)) {
                $this->db->select('user_hash, username, name, access, status, timestamp, last_updated');
                $this->db->from($this::TABLE_NAME);
                $this->db->where('user_hash = ', $user_hash);
                $result = $this->db->get();
            } else {
                $this->db->select('user_hash, username, name, timestamp, last_updated');
                $this->db->from($this::TABLE_NAME);
                $this->db->where('user_hash = ', $user_hash);
                $result = $this->db->get();
            }
            return $result->row_array();
        } else {
            return FALSE;
        }
    }

    public function update($personal_profile=FALSE) {
        if($personal_profile !== FALSE) {
            $temp_array = array();
            foreach($personal_profile as $key=>$value) {
                if( ! in_array($key, $this->_ignored_fields())) {
                    $temp_array[$key] = $value;
                }
            }

            $this->db->set('last_updated', now(MYSQL_DATETIME_FORMAT));
            $this->db->update($this::TABLE_NAME, $temp_array, array('user_hash' => $user['user_hash']));
            return $this->db->affected_rows();
        } else {
            return FALSE;
        }
    }

    private function _ignored_fields() {
        return array(
            'user_id',
            'user_hash',
            'timestamp',
            'last_updated'
        );
    }

} //end Personal_profile_model class