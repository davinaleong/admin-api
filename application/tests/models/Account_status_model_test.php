<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_status_model_test extends TestCase {
    const DO_ECHO = DO_TEST_ECHO_GLOBAL;
    const TABLE_NAME = 'account_status';

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
        $CI->load->model('Account_status_model');

        $this->assertCount(1, $CI->Account_status_model->get_all());
    }

    public function test_get_by_id() {
        if($this::DO_ECHO) echo "\n+++ test_get_by_id +++\n";
        $CI =& get_instance();
        $CI->load->model('Account_status_model');

        $this->assertContains('success', $CI->Account_status_model->get_by_id(1));
        $this->assertFalse($CI->Account_status_model->get_by_id(FALSE));
    }

    public function test_get_by_as_name() {
        if($this::DO_ECHO) echo "\n+++ test_get_by_as_name +++\n";
        $CI =& get_instance();
        $CI->load->model('Account_status_model');

        $this->assertContains('success', $CI->Account_status_model->get_by_as_name('Active'));
        $this->assertFalse($CI->Account_status_model->get_by_as_name(FALSE));
    }

    public function test_get_statuses_as_concatenated_string() {
        if($this::DO_ECHO) echo "\n+++ test_get_statuses_as_concatenated_string +++\n";
        $CI =& get_instance();
        $CI->load->model('Account_status_model');

        $this->assertContains('A', $CI->Account_status_model->get_statuses_as_concatenated_string());
    }

    public function test_insert() {
        if($this::DO_ECHO) echo "\n+++ test_insert +++\n";
        $CI =& get_instance();
        $CI->load->model('Account_status_model');

        $account_status = array(
            'as_name' => 'Deactivated',
            'as_color' => 'secondary',
            'as_description' => 'Account is no longer in use.'
        );
        $this->assertEquals(2, $CI->Account_status_model->insert($account_status));
        $this->assertFalse($CI->Account_status_model->insert(FALSE));
    }

    public function test_update() {
        if($this::DO_ECHO) echo "\n+++ test_update +++\n";
        $CI =& get_instance();
        $CI->load->model('Account_status_model');

        $account_status = $CI->Account_status_model->get_by_id(1);
        $account_status['as_name'] = 'Deactivated';

        $this->assertEquals(1, $CI->Account_status_model->update($account_status));
        $this->assertFalse($CI->Account_status_model->update(FALSE));
    }

    public function test_delete_by_id() {
        if($this::DO_ECHO) echo "\n+++ test_delete_by_id +++\n";
        $CI =& get_instance();
        $CI->load->model('Account_status_model');

        $this->assertEquals(1, $CI->Account_status_model->delete_by_id(1));
        $this->assertFalse($CI->Account_status_model->delete_by_id(FALSE));
    }

} //end Account_status_model_test class