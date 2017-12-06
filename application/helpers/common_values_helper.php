<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function account_status() {
    return array(
        'Active',
        'Inactive'
    );
}

function access_rights() {
    return array(
        'A' => 'Admin',
        'M' => 'Manager',
        'U' => 'User'
    );
}

function record_status() {
    return array(
        'Draft',
        'Published'
    );
}