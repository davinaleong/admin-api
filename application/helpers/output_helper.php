<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function content_type($mime_key) {
    $mime_array = array(
        'AAC' => 'audio/aac',
        'ABW' => 'application/x-abiword',
        'ARC' => 'application/octet-stream',
        'AVI' => 'video/x-msvideo',
        'AZW' => 'application/vnd.amazon.ebook',
        'BIN' => 'application/octet-stream',
        'BZ' => 'application/x-bzip',
        'BZ' => 'application/x-bzip2',
        'CSH' => 'application/x-csh',
        'CSS' => 'text/css',
        'CSV' => 'text/csv',
        'DOC' => 'application/msword',
        'EOT' => 'application/vnd.ms-fontobject',
        'EPUB' => 'application/epub+zip',
        'GIF' => 'image/gif',
        'HTML' => 'text/html',
        'ICO' => 'image/x-icon',
        'ICS' => 'text/calendar',
        'JAR' => 'application/java-archive',
        'JPG' => 'image/jpeg',
        'JS' => 'application/javascript',
        'JSON' => 'application/json',
        'MIDI' => 'audio/midi',
        'MPEG' => 'video/mpeg',
        'MPKG' => 'application/vnd.apple.installer+xml',
        'ODP' => 'application/vnd.oasis.opendocument.presentation',
        'ODS' => 'application/vnd.oasis.opendocument.spreadsheet',
        'ODT' => 'application/vnd.oasis.opendocument.text',
        'OGA' => 'audio/ogg',
        'OGV' => 'video/ogg',
        'OGX' => 'application/ogg',
        'OTF' => 'font/otf',
        'PNG' => 'image/png',
        'PDF' => 'application/pdf',
        'PPT' => 'application/vnd.ms-powerpoint',
        'RAR' => 'application/x-rar-compressed',
        'RTF' => 'application/rtf',
        'SH' => 'application/x-sh',
        'SVG' => 'image/svg+xml',
        'SWF' => 'application/x-shockwave-flash',
        'TAR' => 'application/x-tar',
        'TIF' => 'image/tiff',
        'TS' => 'application/typescript',
        'TTF' => 'font/ttf',
        'VSD' => 'application/vnd.visio',
        'WAV' => 'audio/x-wav',
        'WEBA' => 'audio/webm',
        'WEBM' => 'video/webm',
        'WEBP' => 'image/webp',
        'WOFF' => 'font/woff',
        'WOFF2' => 'font/woff2',
        'XHTML' => 'application/xhtml+xml',
        'XLS' => 'application/vnd.ms-excel application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'XML' => 'application/xml',
        'XUL' => 'application/vnd.mozilla.xul+xml',
        'ZIP' => 'application/zip',
        '3GP' => 'video/3gpp',
        '3G2' => 'video/3gpp2',
        '7Z' => 'application/x-7z-compressed'
    );

    if($mime_key && array_key_exists($mime_key, $mime_array)) {
        return $mime_array[$mime_key];
    } else {
        return $mime_array;
    }
}

function json_response($message, $status, $additional_data=NULL) {
    $json_response = array(
        'message' => $message,
        'status' => $status
    );

    if($additional_data && is_array($additional_data)) {
        foreach($additional_data as $key=>$data) {
            $json_response[$key] = $data;
        }
    }
    $CI =& get_instance();
    $CI->output->set_content_type(content_type('JSON'))->set_output(json_encode($json_response));
}

function json_response_validation_errors($prefix='', $suffix='') {
    $CI =& get_instance();
    $CI->load->library('form_validation');
    json_response(
        validation_errors($prefix, $suffix),
        'error'
    );
}

function json_response_redirect($message, $status='error') {
    json_response(
        $message,
        $status,
        array(
            'action' => 'redirect'
        )
    );
}

function json_response_redirect_dashboard($message, $status='error') {
    json_response(
        $message,
        $status,
        array(
            'action' => 'redirect',
            'page' => 'dashboard'
        )
    );
}

function json_response_redirect_logout($message, $status='error') {
    json_response(
        $message,
        $status,
        array(
            'action' => 'redirect',
            'page' => 'logout'
        )
    );
}

function json_response_page_not_found() {
    json_response_redirect_dashboard('Page not found.');
}
//end of script