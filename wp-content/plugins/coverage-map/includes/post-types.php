<?php
/**
 * Register Coverage Points Post Type
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Register Coverage Points Post Type
add_action('init', 'coverage_map_register_post_type');
function coverage_map_register_post_type() {
    register_post_type('coverage_points', array(
        'labels' => array(
            'name' => __('Coverage Points', 'coverage-map'),
            'singular_name' => __('Coverage Point', 'coverage-map'),
            'add_new' => __('Add New Coverage Point', 'coverage-map'),
            'add_new_item' => __('Add New Coverage Point', 'coverage-map'),
            'edit_item' => __('Edit Coverage Point', 'coverage-map'),
            'new_item' => __('New Coverage Point', 'coverage-map'),
            'view_item' => __('View Coverage Point', 'coverage-map'),
            'search_items' => __('Search Coverage Points', 'coverage-map'),
            'not_found' => __('No coverage points found', 'coverage-map'),
            'not_found_in_trash' => __('No coverage points found in trash', 'coverage-map')
        ),
        'public' => true,
        'has_archive' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-location-alt',
        'supports' => array('title', 'editor'),
        'rewrite' => false,
        'show_in_rest' => true
    ));
}

// Add meta boxes for coverage point details
add_action('add_meta_boxes', 'coverage_map_add_meta_boxes');
function coverage_map_add_meta_boxes() {
    add_meta_box(
        'coverage_point_details',
        __('Coverage Point Details', 'coverage-map'),
        'coverage_map_meta_box_callback',
        'coverage_points',
        'normal',
        'high'
    );
}

// Meta box callback
function coverage_map_meta_box_callback($post) {
    // Add nonce for security
    wp_nonce_field('coverage_map_save_meta_box_data', 'coverage_map_meta_box_nonce');
    
    // Get existing values
    $lat = get_post_meta($post->ID, '_coverage_lat', true);
    $lng = get_post_meta($post->ID, '_coverage_lng', true);
    $postal_code = get_post_meta($post->ID, '_coverage_postal_code', true);
    $subsidence_claims = get_post_meta($post->ID, '_coverage_subsidence_claims', true);
    $postcode_area = get_post_meta($post->ID, '_coverage_postcode_area', true);
    $region = get_post_meta($post->ID, '_coverage_region', true);
    $contact_name = get_post_meta($post->ID, '_coverage_contact_name', true);
    $contact_phone = get_post_meta($post->ID, '_coverage_contact_phone', true);
    $contact_email = get_post_meta($post->ID, '_coverage_contact_email', true);
    $description = get_post_meta($post->ID, '_coverage_description', true);
    
    // Get Google Maps API key
    $api_key = get_option('coverage_map_google_api_key');
    ?>
    <style>
        .coverage-map-field {
            margin-bottom: 20px;
        }
        .coverage-map-field label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .coverage-map-field input[type="text"],
        .coverage-map-field input[type="email"],
        .coverage-map-field textarea {
            width: 100%;
            max-width: 500px;
        }
        .coverage-map-field textarea {
            min-height: 100px;
        }
        #coverage-map-picker {
            height: 400px;
            width: 100%;
            margin-top: 10px;
            border: 1px solid #ddd;
        }
        .coverage-map-field .description {
            font-style: italic;
            color: #666;
            margin-top: 5px;
        }
    </style>
    
    <div class="coverage-map-field">
        <label for="coverage_postal_code"><?php _e('Postal Code', 'coverage-map'); ?> <span style="color: red;">*</span></label>
        <input type="text" id="coverage_postal_code" name="coverage_postal_code" value="<?php echo esc_attr($postal_code); ?>" required />
        <p class="description"><?php _e('e.g., DE73', 'coverage-map'); ?></p>
    </div>
    
    <div class="coverage-map-field">
        <label><?php _e('Coordinates', 'coverage-map'); ?> <span style="color: red;">*</span></label>
        <div style="display: flex; gap: 10px;">
            <div style="flex: 1;">
                <label for="coverage_lat" style="font-weight: normal;"><?php _e('Latitude', 'coverage-map'); ?></label>
                <input type="text" id="coverage_lat" name="coverage_lat" value="<?php echo esc_attr($lat); ?>" required />
            </div>
            <div style="flex: 1;">
                <label for="coverage_lng" style="font-weight: normal;"><?php _e('Longitude', 'coverage-map'); ?></label>
                <input type="text" id="coverage_lng" name="coverage_lng" value="<?php echo esc_attr($lng); ?>" required />
            </div>
        </div>
        <p class="description"><?php _e('Enter coordinates or use the map below to set location', 'coverage-map'); ?></p>
    </div>
    
    <div class="coverage-map-field">
        <label><?php _e('Map Location', 'coverage-map'); ?></label>
        <div id="coverage-map-picker"></div>
        <button type="button" id="coverage-search-postcode" class="button"><?php _e('Search by Postal Code', 'coverage-map'); ?></button>
    </div>
    
    <div class="coverage-map-field">
        <label for="coverage_subsidence_claims"><?php _e('Subsidence Claims', 'coverage-map'); ?></label>
        <input type="number" id="coverage_subsidence_claims" name="coverage_subsidence_claims" value="<?php echo esc_attr($subsidence_claims); ?>" min="0" />
    </div>
    
    <div class="coverage-map-field">
        <label for="coverage_postcode_area"><?php _e('Postcode Area', 'coverage-map'); ?></label>
        <input type="text" id="coverage_postcode_area" name="coverage_postcode_area" value="<?php echo esc_attr($postcode_area); ?>" />
        <p class="description"><?php _e('e.g., DE', 'coverage-map'); ?></p>
    </div>
    
    <div class="coverage-map-field">
        <label for="coverage_region"><?php _e('Region', 'coverage-map'); ?></label>
        <input type="text" id="coverage_region" name="coverage_region" value="<?php echo esc_attr($region); ?>" />
        <p class="description"><?php _e('e.g., East Midlands', 'coverage-map'); ?></p>
    </div>
    
    <div class="coverage-map-field">
        <label for="coverage_contact_name"><?php _e('Contact Name', 'coverage-map'); ?></label>
        <input type="text" id="coverage_contact_name" name="coverage_contact_name" value="<?php echo esc_attr($contact_name); ?>" />
    </div>
    
    <div class="coverage-map-field">
        <label for="coverage_contact_phone"><?php _e('Contact Phone', 'coverage-map'); ?></label>
        <input type="text" id="coverage_contact_phone" name="coverage_contact_phone" value="<?php echo esc_attr($contact_phone); ?>" />
    </div>
    
    <div class="coverage-map-field">
        <label for="coverage_contact_email"><?php _e('Contact Email', 'coverage-map'); ?></label>
        <input type="email" id="coverage_contact_email" name="coverage_contact_email" value="<?php echo esc_attr($contact_email); ?>" />
    </div>
    
    <div class="coverage-map-field">
        <label for="coverage_description"><?php _e('Description', 'coverage-map'); ?></label>
        <textarea id="coverage_description" name="coverage_description"><?php echo esc_textarea($description); ?></textarea>
        <p class="description"><?php _e('Additional information about this coverage area', 'coverage-map'); ?></p>
    </div>
    
    <?php if ($api_key): ?>
    <script>
        function initCoverageMapPicker() {
            const lat = parseFloat(document.getElementById('coverage_lat').value) || 54.5;
            const lng = parseFloat(document.getElementById('coverage_lng').value) || -2.5;
            
            const map = new google.maps.Map(document.getElementById('coverage-map-picker'), {
                center: { lat: lat, lng: lng },
                zoom: 6
            });
            
            const marker = new google.maps.Marker({
                position: { lat: lat, lng: lng },
                map: map,
                draggable: true
            });
            
            // Update hidden fields when marker is dragged
            marker.addListener('dragend', function() {
                const position = marker.getPosition();
                document.getElementById('coverage_lat').value = position.lat();
                document.getElementById('coverage_lng').value = position.lng();
            });
            
            // Click on map to set marker
            map.addListener('click', function(e) {
                marker.setPosition(e.latLng);
                document.getElementById('coverage_lat').value = e.latLng.lat();
                document.getElementById('coverage_lng').value = e.latLng.lng();
            });
            
            // Update coordinates when inputs change
            document.getElementById('coverage_lat').addEventListener('change', function() {
                const lat = parseFloat(this.value);
                const lng = parseFloat(document.getElementById('coverage_lng').value);
                if (!isNaN(lat) && !isNaN(lng)) {
                    const position = new google.maps.LatLng(lat, lng);
                    marker.setPosition(position);
                    map.setCenter(position);
                }
            });
            
            document.getElementById('coverage_lng').addEventListener('change', function() {
                const lat = parseFloat(document.getElementById('coverage_lat').value);
                const lng = parseFloat(this.value);
                if (!isNaN(lat) && !isNaN(lng)) {
                    const position = new google.maps.LatLng(lat, lng);
                    marker.setPosition(position);
                    map.setCenter(position);
                }
            });
            
            // Search by postal code functionality
            document.getElementById('coverage-search-postcode').addEventListener('click', function() {
                const postalCode = document.getElementById('coverage_postal_code').value;
                if (!postalCode) {
                    alert('Please enter a postal code first');
                    return;
                }
                
                // Use UK postcode API
                fetch('https://api.postcodes.io/postcodes/' + encodeURIComponent(postalCode.replace(' ', '')))
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 200) {
                            const lat = data.result.latitude;
                            const lng = data.result.longitude;
                            const position = new google.maps.LatLng(lat, lng);
                            
                            map.setCenter(position);
                            map.setZoom(15);
                            marker.setPosition(position);
                            
                            document.getElementById('coverage_lat').value = lat;
                            document.getElementById('coverage_lng').value = lng;
                            
                            // Auto-fill postcode area and region if empty
                            if (!document.getElementById('coverage_postcode_area').value) {
                                document.getElementById('coverage_postcode_area').value = data.result.outcode || '';
                            }
                            if (!document.getElementById('coverage_region').value) {
                                document.getElementById('coverage_region').value = data.result.region || '';
                            }
                        } else {
                            alert('Postcode not found');
                        }
                    })
                    .catch(error => {
                        alert('Error searching postcode: ' + error.message);
                    });
            });
        }
        
        // Load Google Maps API
        if (typeof google === 'undefined' || typeof google.maps === 'undefined') {
            const script = document.createElement('script');
            script.src = 'https://maps.googleapis.com/maps/api/js?key=<?php echo esc_js($api_key); ?>&callback=initCoverageMapPicker';
            script.async = true;
            script.defer = true;
            document.head.appendChild(script);
        } else {
            initCoverageMapPicker();
        }
    </script>
    <?php else: ?>
    <p style="color: red;"><?php _e('Please configure Google Maps API key in the plugin settings to use the map picker.', 'coverage-map'); ?></p>
    <?php endif;
}

// Save meta box data
add_action('save_post', 'coverage_map_save_meta_box_data');
function coverage_map_save_meta_box_data($post_id) {
    // Check if nonce is set
    if (!isset($_POST['coverage_map_meta_box_nonce'])) {
        return;
    }
    
    // Verify nonce
    if (!wp_verify_nonce($_POST['coverage_map_meta_box_nonce'], 'coverage_map_save_meta_box_data')) {
        return;
    }
    
    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save data
    if (isset($_POST['coverage_lat'])) {
        update_post_meta($post_id, '_coverage_lat', sanitize_text_field($_POST['coverage_lat']));
    }
    
    if (isset($_POST['coverage_lng'])) {
        update_post_meta($post_id, '_coverage_lng', sanitize_text_field($_POST['coverage_lng']));
    }
    
    if (isset($_POST['coverage_postal_code'])) {
        update_post_meta($post_id, '_coverage_postal_code', sanitize_text_field($_POST['coverage_postal_code']));
    }
    
    if (isset($_POST['coverage_subsidence_claims'])) {
        update_post_meta($post_id, '_coverage_subsidence_claims', absint($_POST['coverage_subsidence_claims']));
    }
    
    if (isset($_POST['coverage_postcode_area'])) {
        update_post_meta($post_id, '_coverage_postcode_area', sanitize_text_field($_POST['coverage_postcode_area']));
    }
    
    if (isset($_POST['coverage_region'])) {
        update_post_meta($post_id, '_coverage_region', sanitize_text_field($_POST['coverage_region']));
    }
    
    if (isset($_POST['coverage_contact_name'])) {
        update_post_meta($post_id, '_coverage_contact_name', sanitize_text_field($_POST['coverage_contact_name']));
    }
    
    if (isset($_POST['coverage_contact_phone'])) {
        update_post_meta($post_id, '_coverage_contact_phone', sanitize_text_field($_POST['coverage_contact_phone']));
    }
    
    if (isset($_POST['coverage_contact_email'])) {
        update_post_meta($post_id, '_coverage_contact_email', sanitize_email($_POST['coverage_contact_email']));
    }
    
    if (isset($_POST['coverage_description'])) {
        update_post_meta($post_id, '_coverage_description', sanitize_textarea_field($_POST['coverage_description']));
    }
}