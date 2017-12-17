<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function get_array_value_by_key($array, $array_key) {
    $array_key = strtolower($array_key);
    if($array_key && array_key_exists($array_key, $array)) {
        return $array[$array_key];
    } else {
        return $array;
    }
}

function table_names($key) {
    $array = array(
        'Access Right' => 'access_right',
        'Access Rights' => 'access_right',
        'Account Status' => 'account_status',
        'Account Statuses' => 'account_status',
        'Users' => 'user',
        'User' => 'user',
        'User Log' => 'user_log'
    );
    return get_array_value_by_key($array, $key);
}

function max_lengths($key) {
    $array = array(
        'varchar' => 64,
        'access' => 8,
        'password' => 12,
        'text' => 512
    );

    return get_array_value_by_key($array, $key);
}

function min_lengths($key) {
    $array = array(
        'password' => 6
    );

    return get_array_value_by_key($array, $key);
}

function default_access_rights($key) {
    $array = array(
        'S' => 'Super Admin',
        'A' => 'Admin',
        'M' => 'Manager',
        'U' => 'User'
    );
    return get_array_value_by_key($array, $key);
}

function default_account_status($key) {
    $array = array(
        'unverified' => 'Unverified',
        'active' => 'Active',
        'suspended' => 'Suspended',
        'deactivated' => 'Deactivated'
    );
    return get_array_value_by_key($array, $key);
}

function actions($key) {
    $array = array(
        'redirect' => 'redirect'
    );
    return get_array_value_by_key($array, $key);
}

function response_statuses($key) {
    $array = array(
        'Failed' => 'error',
        'Error' => 'error',
        'Passed' => 'success',
        'Success' => 'success'
    );
    return get_array_value_by_key($array, $key);
}

function redirect_locations($key) {
    $array = array(
        'welcome' => 'dashboard',
        'dashboard' => 'dashboard',
        'login' => 'login',
        'logout' => 'login'
    );
    return get_array_value_by_key($array, $key);
}

//end of script