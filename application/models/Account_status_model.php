<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_status_model extends CI_Model
{
    const TABLE_NAME = 'account_status';

    public function get_all($order_by_col='timestamp', $direction='DESC')
    {
        $this->db->order_by($order_by_col, $direction);
        $query = $this->db->get($this::TABLE_NAME);
        return $query->row_array();
    }

    public function get_by_account_status_id($account_status_id=FALSE) {
        if($account_status_id !== FALSE) {
            $query = $this->db->get_where($this::TABLE_NAME, array('account_status_id' => $account_status_id));
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    public function get_by_as_name($as_name=FALSE) {
        if($as_name !== FALSE) {
            $query = $this->db->get_where($this::TABLE_NAME, array('as_name' => $as_name));
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    public function get_statuses_as_concatenated_string($seperator=',') {
        $sql = "
            SELECT GROUP_CONCAT(`as_name` SEPARATOR ?) AS `account_statuses`
            FROM `" .   $this::TABLE_NAME . "`
        ";
        $query = $this->db->query($sql, array($seperator));
        return $query->row_array()['account_statuses'];
    }

    public function insert($account_status=FALSE) {
        if($account_status !== FALSE) {
            $temp_array = array();
            foreach($account_status as $key=>$value) {
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

    public function update($account_status=FALSE) {
        if($account_status !== FALSE) {
            $temp_array = array();
            foreach($account_status as $key=>$value) {
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

    public function delete_by_id($account_status_id=FALSE) {
        if($account_status_id !== FALSE) {
            $query = $this->db->delete($this::TABLE_NAME, array('account_status_id' => $account_status_id));
            return $this->db->affected_rows();
        } else {
            return FALSE;
        }
    }

    private function _fields_not_to_update() {
        return array(
            'account_status_id',
            'timestamp',
            'last_updated'
        );
    }

} // end Account_status_model controller class