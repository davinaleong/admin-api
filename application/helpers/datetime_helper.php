<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function format($datetime_str='', $format_str='', $time_zone=DATETIME_ZONE) {
    $datetime = new DateTime($datetime_str, new DateTimeZone($time_zone));
    return $datetime->format($format_str);
}

function now($format_str='', $time_zone=DATETIME_ZONE) {
    return $this->format('now', $format_str, $time_zone);
}

function today($format_str='', $time_zone=DATETIME_ZONE) {
    return $this->format('today', $format_str, $time_zone);
}

function format_mysql($datetime_str='', $time_zone=DATETIME_ZONE) {
    return $this->format($datetime_str, MYSQL_DATETIME_FORMAT, DATETIME_ZONE);
}

function format_system($datetime_str='', $time_zone=DATETIME_ZONE) {
    return $this->format($datetime_str, SYSTEM_DATETIME_FORMAT, DATETIME_ZONE);
}

function format_default($datetime_str='', $time_zone=DATETIME_ZONE) {
    return $this->format($datetime_str, DISPLAY_DATETIME_FORMAT, DATETIME_ZONE);
}