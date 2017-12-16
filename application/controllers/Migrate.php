<?php
//@codeCoverageIgnoreStart
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {
    public function __construct()     {
        parent::__construct();
        $this->load->library('migration');
        $this->load->model("Migration_model");
    }

    public function index() {
        if ($this->migration->current() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            $this->_result_view();
        }
    }

    public function reset() {
        if(ENVIRONMENT !=='production') {
            $this->load->model("Migration_model");
            $this->Migration_model->reset();
            $this->insert_staging_records();
            $this->_result_view();
        } else {
            redirect('index');
        }
    }

    public function insert_staging_records() {
        if(ENVIRONMENT !== 'production') {
            // insert Access Rights records
            // insert Account Status records
            // insert User records
            // insert User logs

            #region Insert Access Rights
            $this->load->model('Access_right_model');
            $access_rights = array(
                array(
                    'ar_value' => 'S',
                    'ar_name' => 'Super Admin',
                    'ar_color' => 'danger'
                ),
                array(
                    'ar_value' => 'U',
                    'ar_name' => 'User',
                    'ar_color' => 'secondary'
                )
            );
            foreach($access_rights as $access_right) {
                $this->Access_right_model->insert($access_right);
            }
            #endregion

            #region Insert Account Statuses
            $this->load->model('Account_status_model');
            $access_rights = array(
                array(
                    'as_name' => 'Unverified',
                    'as_color' => 'warning',
                    'as_description' => 'Denotes if the email tied to this account has been verified.'
                ),
                array(
                    'as_name' => 'Suspended',
                    'as_color' => 'danger',
                    'as_description' => 'Account has been temporarily disabled.'
                ),
                array(
                    'as_name' => 'Deactivated',
                    'as_color' => 'secondary',
                    'as_description' => 'Account is no longer in use.'
                )
            );
            foreach($access_rights as $access_right) {
                $this->Account_status_model->insert($access_right);
            }
            #endregion

            #region Insert User Logs
            $this->load->model('User_log_model');
            $user_logs = array(
                'Access Right record created from migrations. | access_right_id: 2',
                'Access Right record created from migrations. | access_right_id: 3',
                'Account Status created from migrations. | account_status_id: 2',
                'Account Status created from migrations. | account_status_id: 3',
                'Account Status created from migrations. | account_status_id: 4',
                'User record created from migrations. | user_id: 2',
                'User record created from migrations. | user_id: 3'
            );
            foreach($user_logs as $user_log) {
                $this->User_log_model->log_with_id($user_log, 0);
            }
            #endregion

            #region Insert Users
            $this->load->model('User_model');
            $users = array(
                array(
                    'username' => 'super',
                    'name' => 'Super Admin',
                    'password_hash' => password_hash('pass1234', PASSWORD_DEFAULT),
                    'access' => 'SA',
                    'account_status' => 'Active'
                ),
                array(
                    'username' => 'user',
                    'name' => 'Default User',
                    'password_hash' => password_hash('password', PASSWORD_DEFAULT),
                    'access' => 'U',
                    'account_status' => 'Active'
                )
            );
            foreach($users as $user) {
                $this->User_model->insert($user);
            }
            #endregion
        }
    }

    public function new_script($descriptive_name='New_migration') {
        if(ENVIRONMENT == 'localhost') {
            $this->load->library('datetime_helper');
            $data = array(
                'descriptive_name' => ucfirst($descriptive_name),
            );
            $this->load->view('migrate/new_script_template', $data);
        }
    }

    private function _result_view() {
        $data = array(
            'migration_version' =>  $this->Migration_model->get_version_from_db()
        );
        $this->load->view('migrate/result', $data);
    }

} //end Migrate controller class
//@codeCoverageIgnoreEnd