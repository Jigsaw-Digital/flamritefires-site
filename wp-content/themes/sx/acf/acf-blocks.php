<?php
/**
 * ACF Block Field Definitions
 *
 * @package SX
 */

/**
 * Dynamically include all PHP files in the blocks directory
 */
function include_acf_block_files() {
    $blocks_dir = get_template_directory() . '/acf/blocks/';
    
    // Check if directory exists
    if (!is_dir($blocks_dir)) {
        return;
    }
    
    // Get all PHP files in the blocks directory
    $files = glob($blocks_dir . '*.php');
    
    // Include each file
    foreach ($files as $file) {
        require_once $file;
    }
}

// Include all block files
include_acf_block_files();

/**
 * Register all ACF fields for blocks
 */
function register_all_acf_block_fields() {
    // Get all functions that match the pattern 'register_*_acf_fields'
    $all_functions = get_defined_functions();
    $user_functions = $all_functions['user'];
    
    // Filter functions that match our naming pattern
    $registration_functions = array_filter($user_functions, function($function_name) {
        return preg_match('/^register_.*_acf_fields$/', $function_name);
    });
    
    // Call each registration function
    foreach ($registration_functions as $function) {
        if (function_exists($function)) {
            call_user_func($function);
        }
    }
}

// Register all fields when ACF initializes
add_action('acf/init', 'register_all_acf_block_fields', 5);
