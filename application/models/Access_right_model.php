<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access_right_model extends CI_Model
{
    const TABLE_NAME = 'access_right';

    public function get_all($order_by_col='timestamp', $direction='DESC')
    {
        $this->db->order_by($order_by_col, $direction);
        $query = $this->db->get($this::TABLE_NAME);
        return $query->row_array();
    }

    public function get_by_id($access_right_id=FALSE) {
        if($access_right_id !== FALSE) {
            $query = $this->db->get_where($this::TABLE_NAME, array('access_right_id' => $access_right_id));
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    public function get_values_as_concatenated_string($seperator=',') {
        $sql = "
            SELECT GROUP_CONCAT(`ar_value` SEPARATOR ?) AS `access_rights`
            FROM `access_right`
        ";
        $query = $this->db->query($sql, array($seperator));
        return $query->row_array()['access_rights'];
    }

    public function insert($access_right=FALSE) {
        if($access_right !== FALSE) {
            $temp_array = array();
            foreach($access_right as $key=>$value) {
                if( ! in_array($key, $this->_fields_not_to_update())) {
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

    public function update($access_right=FALSE) {
        if($access_right !== FALSE) {
            $temp_array = array();
            foreach($access_right as $key=>$value) {
                if( ! in_array($key, $this->_fields_not_to_update())) {
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

    public function delete_by_id($access_right_id=FALSE) {
        if($access_right_id !== FALSE) {
            $query = $this->db->delete($this::TABLE_NAME, array('access_right_id' => $access_right_id));
            return $this->db->affected_rows();
        } else {
            return FALSE;
        }
    }

    private function _fields_not_to_update() {
        return array(
            'access_right_id',
            'timestamp',
            'last_updated'
        );
    }

} // end Access_right_model controller class