<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_authenticate extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Authentication_model');
        $this->load->model('User_log_model');
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->_unset_session_data();
        json_response(
            'Page not found.',
            'error'
        );
    }

    public function json_browse_users() {
        $this->Authentication_model->validate_access_admin();
        json_response(
            'All user records retrieved.',
            'success',
            array(
                'users' => $this->User_model->get_all()
            )
        );
    }

    public function json_new_user() {

    }

    private function _set_rules_new_user() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length['. max_lengths('varchar') . ']|is_unique[user.username]');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length['. max_lengths('varchar') . ']');
    }

    private function _prepare_new_user() {

    }

    public function json_view_user() {

    }

    public function json_edit_user() {

    }

    private function _set_rules_edit_user() {

    }

    private function _prepare_edit_user() {

    }

    public function json_reset_password() {

    }

    private function _set_rules_reset_password() {

    }

} //end Api_authenticate controller class