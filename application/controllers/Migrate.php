<?php
//@codeCoverageIgnoreStart
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('migration');
        $this->load->model("Migration_model");
    }

    public function index()
    {
        if ($this->migration->current() === FALSE)
        {
            show_error($this->migration->error_string());
        }
        else
        {
            $data = array(
                'migration_version' =>  $this->Migration_model->get_version_from_db()
            );

            $this->load->view('migrate/result', $data);
        }
    }

    public function reset()
    {
        if(ENVIRONMENT=='localhost')
        {
            $this->load->model("Migration_model");
            $this->Migration_model->reset();
            $this->insertStagingRecords();
            $this->load->view('migrate/result');
        }
    }

    public function insertStagingRecords()
    {
        if(ENVIRONMENT!='production')
        {
            // Place staging code here.
        }
    }

    public function new_script($descriptive_name='New_migration')
    {
        if(ENVIRONMENT == 'localhost')
        {
            $this->load->library('datetime_helper');
            $data = array(
                'descriptive_name' => ucfirst($descriptive_name),
            );
            $this->load->view('migrate/new_script_template', $data);
        }
    }

}
//@codeCoverageIgnoreEnd