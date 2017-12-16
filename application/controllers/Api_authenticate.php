<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_authenticate extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Authentication_model');
        $this->load->model('User_log_model');
        $this->load->library('session');
    }

    public function index() {
        $this->_unset_session_data();
        json_response(
            'Page not found.',
            'error'
        );
    }

    public function json_login() {
        if($this->session->userdata('user_id') || $this->session->userdata('access'))
        {
            $this->_unset_session_data();
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[512]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[512]');

        if($this->form_validiation->run()) {
            $this->load->model('User_model');
            if($user == $this->User_model->get_by_username($this->input->post('username'))) {
                if($this->Authentication_model->validate_user_status($user)) {
                    if(password_verify($this->input->post('password'), $user['password_hash'])) {
                        $this->_set_session_data($user);

                        $this->User_log_model->log('User logged in.');
                        json_response(
                            'Login successful',
                            'success'
                        );
                    } else {
                        json_response(
                            'Password is incorrect',
                            'error'
                        );
                    }
                } else {
                    json_response(
                        'This account no longer available.',
                        'error'
                    );
                }
            } else {
                json_response(
                    'Invalid Username or Password',
                    'error'
                );
            }
        } else {
            json_response(
                validation_errors('', ''),
                'error'
            );
        }
    }

    public function json_logout() {
        $this->_unset_session_data();
        $this->User_log_model->log('User is logged out.');
        json_response(
            'You have logged out.',
            'success'
        );
    }

    //@codeCoverageIgnoreStart
    private function _set_session_data($user) {
        $this->session->set_userdata('user_id', $user['user_id']);
        $this->session->set_userdata('access', $user['access']);
        $this->session->set_userdata('name', $user['name']);
    }

    private function _unset_session_data() {
        if($this->session->userdata('user_id') || $this->session->userdata('access'))
        {
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('access');
            $this->session->unset_userdata('name');
        }
    }
    //@codeCoverageIgnoreEnd

} //end Api_authenticate controller class