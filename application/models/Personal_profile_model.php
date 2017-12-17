<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personal_profile_model extends CI_Model {

    const TABLE_NAME = 'user';

    public function get($user_hash=FALSE, $access=FALSE) {
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
                if( ! in_array($key, $this->_fields_not_to_update())) {
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

    private function _fields_not_to_update() {
        return array(
            'user_id',
            'user_hash',
            'timestamp',
            'last_updated'
        );
    }

} //end Personal_profile_model class