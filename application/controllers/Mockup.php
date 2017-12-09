<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mockup extends CI_Controller {

    public function index() {
        $this->load->view('mockup/index_page');
    }

    public function login() {
        echo '<h1>Not implemented yet.</h1>';
    }

    public function dashboard() {
        echo '<h1>Not implemented yet.</h1>';
    }

    public function browse_users() {
        echo '<h1>Not implemented yet.</h1>';
    }

    public function new_user() {
        echo '<h1>Not implemented yet.</h1>';
    }

} //end Mockup controller class