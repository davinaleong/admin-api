<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model_test extends TestCase {
    const DO_ECHO = DO_TEST_ECHO_GLOBAL;
    const TABLE_NAME = 'user';

    public function setUp() {
        $this->resetInstance();

        $CI =& get_instance();
        $CI->load->database();
        $CI->load->model('Migration_model');
        $CI->Migration_model->reset();
    }

    public function tearDown() {
        $CI =& get_instance();
        $CI->load->database();
        $CI->db->truncate($this::TABLE_NAME);
    }

    public function test_get_all() {
        if($this::DO_ECHO) echo "\n+++ test_get_all +++\n";
        $CI =& get_instance();
        $CI->load->model('User_model');
        var_dump($CI->User_model->get_all());

        $this->assertCount(1, $CI->User_model->get_all());
    }

    public function test_get_by_id() {
        if($this::DO_ECHO) echo "\n+++ test_get_by_id +++\n";
        $CI =& get_instance();
        $CI->load->model('User_model');

        $this->assertContains('Default Admin', $CI->User_model->get_by_id(1));
        $this->assertFalse($CI->User_model->get_by_id(FALSE));
    }

    public function test_get_by_user_hash() {
        if($this::DO_ECHO) echo "\n+++ test_get_by_user_hash +++\n";
        $CI =& get_instance();
        $CI->load->model('User_model');
        $user = $CI->User_model->get_by_id(1);

        $this->assertContains('Default Admin', $CI->User_model->get_by_user_hash($user['user_hash']));
        $this->assertFalse($CI->User_model->get_by_user_hash(FALSE));
    }

    public function test_insert() {
        if($this::DO_ECHO) echo "\n+++ test_insert +++\n";
        $CI =& get_instance();
        $CI->load->model('User_model');

        $user = array(
            'username' => 'davina',
            'password_hash' => password_hash('password', PASSWORD_DEFAULT),
            'name' => 'Davina Leong',
            'access' => 'A',
            'account_status' => 'Active'
        );
        $this->assertEquals(2, $CI->User_model->insert($user));
        $this->assertFalse($CI->User_model->insert(FALSE));
    }

    public function test_update() {
        if($this::DO_ECHO) echo "\n+++ test_update +++\n";
        $CI =& get_instance();
        $CI->load->model('User_model');

        $user = $CI->User_model->get_by_id(1);
        $user['name'] = 'Admin 2';

        $this->assertEquals(1, $CI->User_model->update($user));
        $this->assertFalse($CI->User_model->update(FALSE));
    }

} //end User_model_test class