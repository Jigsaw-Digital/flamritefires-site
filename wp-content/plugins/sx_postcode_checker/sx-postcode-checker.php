<?php
/**
 * Plugin Name: SX Postcode Checker
 * Plugin URI: https://subsidenceltd.co.uk/
 * Description: A bespoke postcode checker that allows users to search for subsidence projects in their area.
 * Version: 1.0.0
 * Author: Subsidence Ltd
 * Author URI: https://subsidenceltd.co.uk/
 * Text Domain: sx-postcode-checker
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('SX_POSTCODE_CHECKER_DIR', plugin_dir_path(__FILE__));
define('SX_POSTCODE_CHECKER_URL', plugin_dir_url(__FILE__));
define('SX_POSTCODE_CHECKER_VERSION', '1.0.0');

// Include required files
require_once SX_POSTCODE_CHECKER_DIR . 'includes/class-sx-postcode-checker.php';

// Initialize the plugin
function sx_postcode_checker_init() {
    $plugin = new SX_Postcode_Checker();
    $plugin->init();
}
add_action('plugins_loaded', 'sx_postcode_checker_init');