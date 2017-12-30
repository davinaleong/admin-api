<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_personal_profile extends CI_Controller {
    const ACCESS_RIGHTS = "SA";

    public function __construct() {
        parent::__construct();

        $this->load->model('Authentication_model');
        $this->load->model('User_log_model');
        $this->load->model('Personal_profile_model');
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

    public function json_view_profile() {
        if($this->Authentication_model->validate_access_admin()) {
            $this->form_validation->set_rules('user_hash', 'user_hash', 'trim|required');
            if($this->form_validation->run()) {
                if($personal_profile = $this->Personal_profile_model->get_by_user_hash($this->input->post('user_hash'), $this::ACCESS_RIGHTS)) {
                    $this->load->model('Access_right_model');
                    $this->load->model('Account_status_model');
    
                    json_response(
                        'Personal Profile retrieved.',
                        'success',
                        array(
                            'personal_profile' => $personal_profile,
                            'access_right_records' => $this->Access_right_model->get_by_ar_values($user['access']),
                            'account_statuses_record' => $this->Account_status_model->get_by_as_name($user['account_status'])
                        )
                    );
                } else {
                    json_response_redirect_logout('Personal Profile not found.');
                }
            } else {
                json_response_validation_errors('<li>', '</li>');
            }
            //@codeCoverageIgnoreStart
        } else {
            json_response_redirect_logout('This user has invalid access rights.');
        }
        //@codeCoverageIgnoreEnd
    }

    public function json_edit_profile() {
        if($this->Authentication_model->validate_access_admin()) {
            if($personal_profile = $this->Personal_profile_model->get_by_user_hash($this->session->userdata('user_hash'), $this::ACCESS_RIGHTS)) {
                $this->_set_rules_edit_profile();
                if($this->form_validation->run()) {
                    if($personal_profile = $this->Personal_profile_model->get_by_user_hash($this->input->post('user_hash'), $this::ACCESS_RIGHTS)) {
                        $this->load->model('Access_right_model');
                        $this->load->model('Account_status_model');
        
                        json_response(
                            'Personal Profile retrieved.',
                            'success',
                            array(
                                'personal_profile' => $personal_profile,
                                'access_right_records' => $this->Access_right_model->get_by_ar_values($user['access']),
                                'account_statuses_record' => $this->Account_status_model->get_by_as_name($user['account_status'])
                            )
                        );
                    } else {
                        json_response_redirect_logout('Personal Profile not found.');
                    }
                } else {
                    //@codeCoveragerIgnoreEnd
                    json_response_validation_errors('<li>', '</li>');
                }

                $this->load->model('Access_right_model');
                $this->load->model('Account_status_model');

                json_response(
                    'User record retrieved.',
                    'success',
                    array(
                        'user' => $user,
                        'access_right_records' => $this->Access_right_model->get_by_ar_values($user['access']),
                        'account_statuses_record' => $this->Account_status_model->get_by_as_name($user['account_status'])
                    )
                );
            } else {
                json_response_redirect_logout('Profile not found.');
            }
            //@codeCoverageIgnoreStart
        } else {
            json_response_redirect_logout('This user has invalid access rights.');
        }
        //@codeCoverageIgnoreEnd
    }

    private function _set_rules_edit_profile() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length['. max_lengths('varchar') . ']|is_unique[user.username]');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length['. max_lengths('varchar') . ']');
    }

    private function _prepare_edit_profile($personal_profile) {
        $personal_profile['username'] = $this->input->post('username');
        $personal_profile['name'] = $this->input->post('name');
        return $personal_profile;
    }

    public function json_change_password() {
        if($this->Authentication_model->validate_access_admin()) {
            if($user = $this->User_model->get_by_user_id($this->input->post('user_id'))) {
                $this->_set_rules_change_password();
                if($this->form_validation->run()) {
                    $user['password_hash'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

                    if($this->User_model->update($user)) {
                        $this->User_log_model->log("User's password updated. | user_id: " . $user_id);
                        json_response(
                            "User's password updated.",
                            'success'
                        );
                        //@codeCoverageIgnoreStart
                    } else {
                        json_response(
                            'Unable to update User record.',
                            'error'
                        );
                    }
                } else {
                    //@codeCoveragerIgnoreEnd
                    json_response_validation_errors();
                }

                $this->load->model('Access_right_model');
                $this->load->model('Account_status_model');

                json_response(
                    'User record retrieved.',
                    'success',
                    array(
                        'user' => $user,
                        'access_right_records' => $this->Access_right_model->get_by_ar_values($user['access']),
                        'account_statuses_record' => $this->Account_status_model->get_by_as_name($user['account_status'])
                    )
                );
            } else {
                json_response_redirect_logout('Profile not found.');
            }
            //@codeCoverageIgnoreStart
        } else {
            json_response_redirect_logout('This user has invalid access rights.');
        }
        //@codeCoverageIgnoreEnd
    }

    private function _set_rules_change_password() {
        $this->form_validation->set_rules('existing_password', 'Existing Password', 'trim|required|min_length[' . min_lengths('password') . ']|max_length[' . max_lengths(['password']) . ']');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[' . min_lengths('password') . ']|max_length[' . max_lengths(['password']) . ']');
        $this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'trim|required|min_length[' . min_lengths('password') . ']|max_length[' . max_lengths(['password']) . ']|matches[new_password]');
    }

} //end Api_personal_profile controller class