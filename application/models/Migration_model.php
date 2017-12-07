<?php
// @codeCoverageIgnoreStart
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_model extends CI_Model
{
    public function reset()
    {
        $this->load->library('migration');
        $this->migration->version('0');
        $this->migration->current();
    }

    public function get_version_from_db()
    {
        $query = $this->db->get('migrations');
        return $query->row_array()['version'];
    }
}
// @codeCoverageIgnoreEnd