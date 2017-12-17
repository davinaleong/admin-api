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
        if($this->Authentication_model->validate_access_admin()) {
            $this->load->model('Access_right_model');
            $this->load->model('Account_status_model');
            
            json_response(
                'All user records retrieved.',
                'success',
                array(
                    'users' => $this->User_model->get_all(),
                    'ar_records' => $this->Access_right_model->get_all('ar_name', 'ASC'),
                    'as_records' => $this->Account_status_model->get_all('as_name', 'ASC')
                )
            );
            //@codeCoverageIgnoreStart
        } else {
            json_response(
                'User has invalid access rights.',
                'error'
            );
        }
        //@codeCoverageIgnoreEnd
    }

    public function json_new_user() {
        if($this->Authentication_model->validate_access_admin()) {
            $this->_set_rules_new_user();
            if($this->form_validation->run()) {
                if($user_id = $this->User_model->insert($this->_prepare_new_user())) {
                    $this->User_log_model->log('User record created. | user_id: ' . $user_id);
                    json_response(
                        'User record created.',
                        'success'
                    );
                    //@codeCoverageIgnoreStart
                } else {
                    json_response(
                        'Unable to create User record.',
                        'error'
                    );
                }
            } else {
                //@codeCoveragerIgnoreEnd
                json_response_validation_errors();
            }
            //@codeCoverageIgnoreStart
        } else {
            json_response(
                'User has invalid access rights.',
                'error'
            );
        }
        //@codeCoverageIgnoreEnd
    }

    private function _set_rules_new_user() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length['. max_lengths('varchar') . ']|is_unique[user.username]');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length['. max_lengths('varchar') . ']');

        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[' . min_lengths('password') . ']|max_length[' . max_lengths(['password']) . ']');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[' . min_lengths('password') . ']|max_length[' . max_lengths(['password']) . ']|matches[password]');

        $this->load->model('Access_right_model');
        $this->form_validation->set_rules('access', 'Access Rights', 'trim|required|in_list[' . $this->Access_right_model->get_values_as_concatenated_string() . ']');
    }

    private function _prepare_new_user() {
        $user = array();
        $user['username'] = $this->input->post('username');
        $user['name'] = $this->input->post('name');
        $user['password_hash'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $user['access'] = implode(',', $this->input->post('access'));
        $user['account_status'] = 'Active';

        return $user;
    }

    public function json_view_user() {
        if($this->Authentication_model->validate_access_admin()) {
            $this->form_validation->set_rules('user_id', 'user_id', 'trim|required|in_list[' . $this->User_model->get_ids_as_concatenated_string() . ']');
            if($user = $this->User_model->get_by_user_id($this->input->post('user_id'))) {
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
                json_response(
                    'User record not found.',
                    'error'
                );
            }
            //@codeCoverageIgnoreStart
        } else {
            json_response(
                'User has invalid access rights.',
                'error'
            );
        }
        //@codeCoverageIgnoreEnd
    }

    public function json_edit_user() {
        if($this->Authentication_model->validate_access_admin()) {
            if($user = $this->User_model->get_by_user_id($this->input->post('user_id'))) {
                $this->_set_rules_edit_user();
                if($this->form_validation->run()) {
                    if($this->User_model->update($this->_prepare_edit_user($user))) {
                        $this->User_log_model->log('User record updated. | user_id: ' . $user_id);
                        json_response(
                            'User record updated.',
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
                json_response(
                    'User record not found.',
                    'error'
                );
            }
            //@codeCoverageIgnoreStart
        } else {
            json_response(
                'User has invalid access rights.',
                'error'
            );
        }
        //@codeCoverageIgnoreEnd
    }

    private function _set_rules_edit_user() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length['. max_lengths('varchar') . ']|is_unique[user.username]');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length['. max_lengths('varchar') . ']');

        $this->load->model('Access_right_model');
        $this->form_validation->set_rules('access', 'Access Rights', 'trim|required|in_list[' . $this->Access_right_model->get_values_as_concatenated_string() . ']');
        $this->load->model('Account_status_model');
        $this->form_validation->set_rules('account_status', 'Account Status', 'trim|required|in_list[' . $this->Account_status_model->get_statuses_as_concatenated_string() . ']');
    }

    private function _prepare_edit_user($user) {
        $user['username'] = $this->input->post('username');
        $user['name'] = $this->input->post('name');
        $user['access'] = implode(',', $this->input->post('access'));
        $user['account_status'] = 'Active';

        return $user;
    }

    public function json_reset_password() {
        if($this->Authentication_model->validate_access_admin()) {
            if($user = $this->User_model->get_by_user_id($this->input->post('user_id'))) {
                $this->_set_rules_reset_password();
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
                json_response(
                    'User record not found.',
                    'error'
                );
            }
            //@codeCoverageIgnoreStart
        } else {
            json_response(
                'User has invalid access rights.',
                'error'
            );
        }
        //@codeCoverageIgnoreEnd
    }

    private function _set_rules_reset_password() {
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[' . min_lengths('password') . ']|max_length[' . max_lengths(['password']) . ']');
        $this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'trim|required|min_length[' . min_lengths('password') . ']|max_length[' . max_lengths(['password']) . ']|matches[password]');
    }

} //end Api_authenticate controller class