<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access_right_model_test extends TestCase {
    const DO_ECHO = DO_TEST_ECHO_GLOBAL;
    const TABLE_NAME = 'access_right';

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
        $CI->load->model('Access_right_model');

        $this->assertCount(1, $CI->Access_right_model->get_all());
    }

    public function test_get_by_ar_values() {
        if($this::DO_ECHO) echo "\n+++ test_get_by_ar_values +++\n";
        $CI =& get_instance();
        $CI->load->model('Access_right_model');

        $this->assertCount(1, $CI->Access_right_model->get_by_ar_values('A'));
        $this->assertFalse($CI->Access_right_model->get_by_ar_values(FALSE));
    }

    public function test_get_by_id() {
        if($this::DO_ECHO) echo "\n+++ test_get_by_id +++\n";
        $CI =& get_instance();
        $CI->load->model('Access_right_model');

        $this->assertContains('Admin', $CI->Access_right_model->get_by_id(1));
        $this->assertFalse($CI->Access_right_model->get_by_id(FALSE));
    }

    public function test_get_by_ar_value() {
        if($this::DO_ECHO) echo "\n+++ test_get_by_ar_value +++\n";
        $CI =& get_instance();
        $CI->load->model('Access_right_model');

        $this->assertContains('Admin', $CI->Access_right_model->get_by_ar_value('A'));
        $this->assertFalse($CI->Access_right_model->get_by_ar_value(FALSE));
    }

    public function test_get_values_as_concatenated_string() {
        if($this::DO_ECHO) echo "\n+++ test_get_values_as_concatenated_string +++\n";
        $CI =& get_instance();
        $CI->load->model('Access_right_model');

        $this->assertContains('A', $CI->Access_right_model->get_values_as_concatenated_string());
    }

    public function test_insert() {
        if($this::DO_ECHO) echo "\n+++ test_insert +++\n";
        $CI =& get_instance();
        $CI->load->model('Access_right_model');

        $access_right = array(
            'ar_value' => 'S',
            'ar_name' => 'Super Admin',
            'ar_color' => 'danger'
        );
        $this->assertEquals(2, $CI->Access_right_model->insert($access_right));
        $this->assertFalse($CI->Access_right_model->insert(FALSE));
    }

    public function test_update() {
        if($this::DO_ECHO) echo "\n+++ test_update +++\n";
        $CI =& get_instance();
        $CI->load->model('Access_right_model');

        $access_right = $CI->Access_right_model->get_by_id(1);
        $access_right['ar_value'] = 'B';

        $this->assertEquals(1, $CI->Access_right_model->update($access_right));
        $this->assertFalse($CI->Access_right_model->update(FALSE));
    }

    public function test_delete_by_id() {
        if($this::DO_ECHO) echo "\n+++ test_delete_by_id +++\n";
        $CI =& get_instance();
        $CI->load->model('Access_right_model');

        $this->assertEquals(1, $CI->Access_right_model->delete_by_id(1));
        $this->assertFalse($CI->Access_right_model->delete_by_id(FALSE));
    }

    public function test_delete_by_ar_value() {
        if($this::DO_ECHO) echo "\n+++ test_delete_by_ar_value +++\n";
        $CI =& get_instance();
        $CI->load->model('Access_right_model');

        $this->assertEquals(1, $CI->Access_right_model->delete_by_ar_value('A'));
        $this->assertFalse($CI->Access_right_model->delete_by_ar_value(FALSE));
    }

} //end Access_right_model_test class