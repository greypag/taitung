<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('init', 'fac_output_buffer');
function fac_output_buffer() {
    ob_start();
}

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php' )) {
    global $facAutoloader;
    $facAutoloader = include_once (dirname(__FILE__) . '/vendor/autoload.php' );
} 

function Fac() {
    return Agp\Plugin\Fac\Fac::instance();
}    
    
Fac();