<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access_right_model extends CI_Model
{
    const TABLE_NAME = 'access_right';

    public function get_all($order_by_col='timestamp', $direction='DESC')
    {
        $this->db->order_by($order_by_col, $direction);
        $query = $this->db->get($this::TABLE_NAME);
        return $query->result_array();
    }

    public function get_by_ar_values($ar_values=FALSE) {
        if($ar_values !== FALSE) {
            $sql = "
                SELECT * FROM " .   $this::TABLE_NAME . "
                WHERE LOCATE(" .    $this::TABLE_NAME . ".`ar_value`, ?);
            ";
            $query = $this->db->query($sql, array($ar_values));
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    public function get_by_access_right_id($access_right_id=FALSE) {
        if($access_right_id !== FALSE) {
            $query = $this->db->get_where($this::TABLE_NAME, array('access_right_id' => $access_right_id));
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    public function get_by_ar_value($ar_value=FALSE) {
        if($ar_value !== FALSE) {
            $query = $this->db->get_where($this::TABLE_NAME, array('ar_value' => $ar_value));
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    public function get_values_as_concatenated_string($seperator=',') {
        $sql = "
            SELECT GROUP_CONCAT(`ar_value` SEPARATOR ?) AS `access_rights`
            FROM `" .   $this::TABLE_NAME . "`
        ";
        $query = $this->db->query($sql, array($seperator));
        return $query->row_array()['access_rights'];
    }

    public function insert($access_right=FALSE) {
        if($access_right !== FALSE) {
            $temp_array = array();
            foreach($access_right as $key=>$value) {
                if( ! in_array($key, $this->_ignored_fields())) {
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
                if( ! in_array($key, $this->_ignored_fields())) {
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

    private function _ignored_fields() {
        return array(
            'access_right_id',
            'timestamp',
            'last_updated'
        );
    }

} // end Access_right_model controller class