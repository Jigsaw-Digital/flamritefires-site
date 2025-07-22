<?php
/**
 * Plugin Name: Coverage Map
 * Plugin URI: https://example.com/
 * Description: A plugin to display engineer coverage with postcode search and Google Maps integration
 * Version: 1.0.0
 * Author: Your Name
 * License: GPL v2 or later
 * Text Domain: coverage-map
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('COVERAGE_MAP_VERSION', '1.0.0');
define('COVERAGE_MAP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('COVERAGE_MAP_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include required files
require_once COVERAGE_MAP_PLUGIN_DIR . 'includes/post-types.php';
require_once COVERAGE_MAP_PLUGIN_DIR . 'includes/ajax-handlers.php';
require_once COVERAGE_MAP_PLUGIN_DIR . 'includes/shortcode.php';
require_once COVERAGE_MAP_PLUGIN_DIR . 'includes/admin-settings.php';
require_once COVERAGE_MAP_PLUGIN_DIR . 'includes/csv-import.php';

// Activation hook
register_activation_hook(__FILE__, 'coverage_map_activate');
function coverage_map_activate() {
    // Register post type
    coverage_map_register_post_type();
    
    // Flush rewrite rules
    flush_rewrite_rules();
}

// Deactivation hook
register_deactivation_hook(__FILE__, 'coverage_map_deactivate');
function coverage_map_deactivate() {
    // Flush rewrite rules
    flush_rewrite_rules();
}

// Initialize plugin
add_action('init', 'coverage_map_init');
function coverage_map_init() {
    // Load plugin text domain for translations
    load_plugin_textdomain('coverage-map', false, dirname(plugin_basename(__FILE__)) . '/languages');
}

// Enqueue frontend assets
add_action('wp_enqueue_scripts', 'coverage_map_enqueue_scripts');
function coverage_map_enqueue_scripts() {
    // Only enqueue on pages with our shortcode
    global $post;
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'coverage_map')) {
        // Enqueue custom styles
        wp_enqueue_style('coverage-map-styles', COVERAGE_MAP_PLUGIN_URL . 'assets/css/coverage-map.css', array(), COVERAGE_MAP_VERSION);
    }
}

// Add Tailwind CDN to head when shortcode is present
add_action('wp_head', 'coverage_map_add_tailwind');
function coverage_map_add_tailwind() {
    global $post;
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'coverage_map')) {
        ?>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                prefix: "cm-",
                corePlugins: {
                    preflight: false,
                }
            }
        </script>
        <?php
    }
}

// Enqueue admin scripts
add_action('admin_enqueue_scripts', 'coverage_map_admin_scripts');
function coverage_map_admin_scripts($hook) {
    // Only load on our settings page
    if ($hook !== 'settings_page_coverage-map-settings') {
        return;
    }
    
    // Enqueue WordPress media scripts
    wp_enqueue_media();
    
    // Enqueue color picker
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
}