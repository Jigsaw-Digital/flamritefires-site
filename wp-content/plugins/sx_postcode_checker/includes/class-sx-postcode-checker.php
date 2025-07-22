<?php
/**
 * Main SX Postcode Checker Class
 */
class SX_Postcode_Checker {
    /**
     * Initialize the plugin
     */
    public function init() {
        // Register activation and deactivation hooks
        register_activation_hook(SX_POSTCODE_CHECKER_DIR . 'sx-postcode-checker.php', array($this, 'activate'));
        register_deactivation_hook(SX_POSTCODE_CHECKER_DIR . 'sx-postcode-checker.php', array($this, 'deactivate'));
        
        // Add actions and filters
        add_action('init', array($this, 'register_shortcodes'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('wp_ajax_sx_postcode_search', array($this, 'ajax_postcode_search'));
        add_action('wp_ajax_nopriv_sx_postcode_search', array($this, 'ajax_postcode_search'));
        
        // Include admin files
        if (is_admin()) {
            require_once SX_POSTCODE_CHECKER_DIR . 'admin/class-sx-postcode-checker-admin.php';
        }
    }
    
    /**
     * Plugin activation
     */
    public function activate() {
        // Create default options
        $default_options = array(
            'map_api_key' => '',
            'data_source' => 'csv',
            'csv_file_path' => '',
            'post_type' => '',
            'latitude_field' => '',
            'longitude_field' => '',
            'marker_title' => 'Subsidence Projects: {count}',
            'map_zoom' => 12,
            'map_height' => '500px',
            'info_window_template' => '<div class="sx-info-window"><h4>Postcode: {postcode}</h4><p>Subsidence Projects: {count}</p></div>'
        );
        
        update_option('sx_postcode_checker_options', $default_options);
    }
    
    /**
     * Plugin deactivation
     */
    public function deactivate() {
        // Cleanup if needed
    }
    
    /**
     * Register shortcodes
     */
    public function register_shortcodes() {
        add_shortcode('sx_postcode_checker', array($this, 'render_postcode_checker'));
    }
    
    /**
     * Enqueue scripts and styles
     */
    public function enqueue_scripts() {
        $options = get_option('sx_postcode_checker_options', array());
        if (!is_array($options)) {
            $options = array();
        }
        
        // Only enqueue on pages with our shortcode
        global $post;
        if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'sx_postcode_checker')) {
            // Google Maps API
            $api_key = isset($options['map_api_key']) ? $options['map_api_key'] : '';
            wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=' . esc_attr($api_key) . '&libraries=places', array(), null, true);
            
            // Plugin scripts
            wp_enqueue_script('sx-postcode-checker-js', SX_POSTCODE_CHECKER_URL . 'assets/js/sx-postcode-checker.js', array('jquery', 'google-maps'), SX_POSTCODE_CHECKER_VERSION, true);
            
            // Plugin styles
            wp_enqueue_style('sx-postcode-checker-css', SX_POSTCODE_CHECKER_URL . 'assets/css/sx-postcode-checker.css', array(), SX_POSTCODE_CHECKER_VERSION);
            
            // Localize script with data
            wp_localize_script('sx-postcode-checker-js', 'sx_postcode_checker', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('sx_postcode_checker_nonce'),
                'options' => $options
            ));
        }
    }
    
    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_menu_page(
            __('SX Postcode Checker', 'sx-postcode-checker'),
            __('Postcode Checker', 'sx-postcode-checker'),
            'manage_options',
            'sx-postcode-checker',
            array($this, 'render_admin_page'),
            'dashicons-location-alt',
            30
        );
    }
    
    /**
     * Register settings
     */
    public function register_settings() {
        register_setting('sx_postcode_checker_options_group', 'sx_postcode_checker_options');
    }
    
    /**
     * Render admin page
     */
    public function render_admin_page() {
        require_once SX_POSTCODE_CHECKER_DIR . 'admin/partials/admin-page.php';
    }
    
    /**
     * Render postcode checker shortcode
     */
    public function render_postcode_checker($atts) {
        $options = get_option('sx_postcode_checker_options', array());
        if (!is_array($options)) {
            $options = array();
        }
        
        // Allow attributes to override options
        $attributes = shortcode_atts(array(
            'map_height' => isset($options['map_height']) ? $options['map_height'] : '500px',
            'map_zoom' => isset($options['map_zoom']) ? $options['map_zoom'] : '12',
        ), $atts);
        
        ob_start();
        require SX_POSTCODE_CHECKER_DIR . 'includes/partials/postcode-checker.php';
        return ob_get_clean();
    }
    
    /**
     * AJAX postcode search
     */
    public function ajax_postcode_search() {
        // Verify nonce
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'sx_postcode_checker_nonce')) {
            wp_send_json_error('Invalid security token');
        }
        
        // Get postcode
        $postcode = isset($_POST['postcode']) ? sanitize_text_field($_POST['postcode']) : '';
        
        if (empty($postcode)) {
            wp_send_json_error('Postcode is required');
        }
        
        // Get location data based on data source
        $location_data = $this->get_location_data($postcode);
        
        if (is_wp_error($location_data)) {
            wp_send_json_error($location_data->get_error_message());
        }
        
        wp_send_json_success($location_data);
    }
    
    /**
     * Get location data based on data source
     */
    private function get_location_data($postcode) {
        $options = get_option('sx_postcode_checker_options', array());
        if (!is_array($options)) {
            $options = array();
        }
        $data_source = isset($options['data_source']) ? $options['data_source'] : 'csv';
        
        switch ($data_source) {
            case 'csv':
                return $this->get_data_from_csv($postcode);
                
            case 'post_type':
                return $this->get_data_from_post_type($postcode);
                
            default:
                return new WP_Error('invalid_data_source', 'Invalid data source');
        }
    }
    
    /**
     * Get data from CSV
     */
    private function get_data_from_csv($postcode) {
        $options = get_option('sx_postcode_checker_options', array());
        if (!is_array($options)) {
            $options = array();
        }
        
        // Check for media library file first
        $csv_file_path = '';
        if (isset($options['csv_file_id']) && !empty($options['csv_file_id'])) {
            $attachment_id = $options['csv_file_id'];
            $csv_file_path = get_attached_file($attachment_id);
        } else if (isset($options['csv_file_path']) && !empty($options['csv_file_path'])) {
            // Fall back to direct path
            $csv_file_path = $options['csv_file_path'];
        }
        
        if (empty($csv_file_path) || !file_exists($csv_file_path)) {
            return new WP_Error('csv_not_found', 'CSV file not found');
        }
        
        $file = fopen($csv_file_path, 'r');
        if (!$file) {
            return new WP_Error('csv_open_error', 'Could not open CSV file');
        }
        
        $header = fgetcsv($file);
        
        // Based on the CSV format we've seen, find the correct columns
        $postcode_index = array_search('Postal Code', $header);
        $title_index = array_search('Title', $header);
        $lat_index = array_search('Latitude', $header);
        $lng_index = array_search('Longitude', $header);
        $claims_index = array_search('Subsidence Claims', $header);
        $message_index = array_search('Message', $header);
        
        if ($postcode_index === false || $lat_index === false || $lng_index === false || $claims_index === false) {
            fclose($file);
            return new WP_Error('csv_invalid_format', 'CSV file does not have required columns');
        }
        
        // Normalize input postcode for comparison
        $search_postcode = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $postcode));
        
        $result = null;
        
        while (($row = fgetcsv($file)) !== false) {
            if (isset($row[$postcode_index])) {
                $row_postcode = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $row[$postcode_index]));
                
                // Compare the first part of the postcode (e.g., AB10) if full postcode is provided
                $postcode_part = strlen($search_postcode) > 4 ? substr($search_postcode, 0, 4) : $search_postcode;
                
                if (strpos($row_postcode, $postcode_part) === 0) {
                    // Clean up the longitude value (sometimes has a single quote prefix)
                    $longitude = $row[$lng_index];
                    if (strpos($longitude, "'") === 0) {
                        $longitude = substr($longitude, 1);
                    }
                    
                    $result = array(
                        'postcode' => $row[$postcode_index],
                        'title' => isset($row[$title_index]) ? $row[$title_index] : $row[$postcode_index],
                        'latitude' => (float) $row[$lat_index],
                        'longitude' => (float) $longitude,
                        'count' => (int) $row[$claims_index],
                        'message' => isset($row[$message_index]) ? $row[$message_index] : ''
                    );
                    break;
                }
            }
        }
        
        fclose($file);
        
        if ($result === null) {
            return new WP_Error('postcode_not_found', 'Postcode not found in data');
        }
        
        return $result;
    }
    
    /**
     * Get data from post type
     */
    private function get_data_from_post_type($postcode) {
        $options = get_option('sx_postcode_checker_options', array());
        if (!is_array($options)) {
            $options = array();
        }
        $post_type = isset($options['post_type']) ? $options['post_type'] : '';
        $latitude_field = isset($options['latitude_field']) ? $options['latitude_field'] : '';
        $longitude_field = isset($options['longitude_field']) ? $options['longitude_field'] : '';
        
        if (empty($post_type) || empty($latitude_field) || empty($longitude_field)) {
            return new WP_Error('invalid_post_config', 'Post type configuration is incomplete');
        }
        
        // Get posts with matching postcode
        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => 'postcode',
                    'value' => $postcode,
                    'compare' => '='
                )
            )
        );
        
        $posts = get_posts($args);
        
        if (empty($posts)) {
            return new WP_Error('postcode_not_found', 'Postcode not found in data');
        }
        
        // Determine if we're using ACF fields or regular post meta
        $is_acf = function_exists('get_field');
        $latitude = 0;
        $longitude = 0;
        
        // Get the first post's coordinates
        if ($is_acf) {
            $latitude = (float) get_field($latitude_field, $posts[0]->ID);
            $longitude = (float) get_field($longitude_field, $posts[0]->ID);
        } else {
            $latitude = (float) get_post_meta($posts[0]->ID, $latitude_field, true);
            $longitude = (float) get_post_meta($posts[0]->ID, $longitude_field, true);
        }
        
        return array(
            'postcode' => $postcode,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'count' => count($posts)
        );
    }
}