<?php
/**
 * AJAX Handlers for Coverage Map
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Register AJAX handlers
add_action('wp_ajax_coverage_map_lookup_postcode', 'coverage_map_handle_postcode_lookup');
add_action('wp_ajax_nopriv_coverage_map_lookup_postcode', 'coverage_map_handle_postcode_lookup');

function coverage_map_handle_postcode_lookup() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'coverage_map_nonce')) {
        wp_die('Security check failed');
    }
    
    $postcode = sanitize_text_field($_POST['postcode']);
    
    if (empty($postcode)) {
        wp_send_json_error('Invalid postcode');
    }
    
    // Call UK postcode API
    $response = wp_remote_get('https://api.postcodes.io/postcodes/' . urlencode(str_replace(' ', '', $postcode)));
    
    if (is_wp_error($response)) {
        wp_send_json_error('Error fetching postcode data');
    }
    
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);
    
    if (!isset($data['status']) || $data['status'] != 200) {
        wp_send_json_error('Postcode not found');
    }
    
    $lat = $data['result']['latitude'];
    $lng = $data['result']['longitude'];
    
    // Find coverage points within 30 miles (48.28 km)
    $coverage_points = get_posts(array(
        'post_type' => 'coverage_points',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ));
    
    $nearby_points = array();
    
    foreach ($coverage_points as $point) {
        $point_lat = get_post_meta($point->ID, '_coverage_lat', true);
        $point_lng = get_post_meta($point->ID, '_coverage_lng', true);
        
        if ($point_lat && $point_lng) {
            $point_lat = floatval($point_lat);
            $point_lng = floatval($point_lng);
            
            $distance = coverage_map_calculate_distance($lat, $lng, $point_lat, $point_lng);
            
            if ($distance <= 30) { // 30 miles
                $nearby_points[] = array(
                    'id' => $point->ID,
                    'title' => $point->post_title,
                    'lat' => $point_lat,
                    'lng' => $point_lng,
                    'postal_code' => get_post_meta($point->ID, '_coverage_postal_code', true),
                    'subsidence_claims' => get_post_meta($point->ID, '_coverage_subsidence_claims', true),
                    'postcode_area' => get_post_meta($point->ID, '_coverage_postcode_area', true),
                    'region' => get_post_meta($point->ID, '_coverage_region', true),
                    'distance' => round($distance, 2),
                    'contact_name' => get_post_meta($point->ID, '_coverage_contact_name', true),
                    'contact_phone' => get_post_meta($point->ID, '_coverage_contact_phone', true),
                    'contact_email' => get_post_meta($point->ID, '_coverage_contact_email', true),
                    'description' => get_post_meta($point->ID, '_coverage_description', true)
                );
            }
        }
    }
    
    // Sort by distance
    usort($nearby_points, function($a, $b) {
        return $a['distance'] <=> $b['distance'];
    });
    
    wp_send_json_success(array(
        'postcode_lat' => $lat,
        'postcode_lng' => $lng,
        'coverage_points' => $nearby_points
    ));
}

// Calculate distance between two points using Haversine formula
function coverage_map_calculate_distance($lat1, $lng1, $lat2, $lng2) {
    $earth_radius = 3959; // miles
    
    $lat_delta = deg2rad($lat2 - $lat1);
    $lng_delta = deg2rad($lng2 - $lng1);
    
    $a = sin($lat_delta / 2) * sin($lat_delta / 2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($lng_delta / 2) * sin($lng_delta / 2);
    
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
    return $earth_radius * $c;
}