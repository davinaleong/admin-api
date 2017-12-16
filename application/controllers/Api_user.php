<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_authenticate extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Authentication_model');
        $this->load->library('session');
    }

    public function index() {
        $this->_unset_session_data();
        json_response(
            'Page not found.',
            'error'
        );
    }

    

} //end Api_authenticate controller class