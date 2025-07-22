<?php
/**
 * Shortcode for Coverage Map
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Register shortcode
add_shortcode('coverage_map', 'coverage_map_shortcode');

function coverage_map_shortcode($atts) {
    // Parse attributes
    $atts = shortcode_atts(array(
        'title' => __('Engineer Coverage', 'coverage-map'),
        'subtitle' => __('Enter a postcode to find coverage in your area', 'coverage-map'),
        'search_placeholder' => __('Enter postcode, town or city', 'coverage-map'),
        'default_lat' => '54.5',
        'default_lng' => '-2.5',
        'default_zoom' => '6',
        'background_image' => '',
        'background_color' => '',
        'background_opacity' => ''
    ), $atts, 'coverage_map');
    
    // Get Google Maps API key
    $google_maps_api_key = get_option('coverage_map_google_api_key');
    
    // Generate unique ID for this instance
    $block_id = 'coverage-' . uniqid();
    
    // Start output buffering
    ob_start();
    
    // Include template
    include COVERAGE_MAP_PLUGIN_DIR . 'templates/coverage-map.php';
    
    // Return output
    return ob_get_clean();
}