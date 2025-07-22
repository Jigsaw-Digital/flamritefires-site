<?php
/**
 * Admin functionality for SX Postcode Checker
 */
class SX_Postcode_Checker_Admin {
    
    public function __construct() {
        // Add settings link on plugin page
        add_filter('plugin_action_links_sx-postcode-checker/sx-postcode-checker.php', array($this, 'add_settings_link'));
        
        // Add admin scripts and styles
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
        
        // Handle CSV upload
        add_action('admin_post_sx_upload_csv', array($this, 'handle_csv_upload'));
    }
    
    /**
     * Add settings link to plugin page
     */
    public function add_settings_link($links) {
        $settings_link = '<a href="admin.php?page=sx-postcode-checker">' . __('Settings', 'sx-postcode-checker') . '</a>';
        array_unshift($links, $settings_link);
        return $links;
    }
    
    /**
     * Enqueue admin scripts and styles
     */
    public function enqueue_admin_scripts($hook) {
        if ('toplevel_page_sx-postcode-checker' !== $hook) {
            return;
        }
        
        // Enqueue WordPress media scripts
        wp_enqueue_media();
        
        wp_enqueue_style('sx-postcode-checker-admin-css', SX_POSTCODE_CHECKER_URL . 'admin/css/admin.css', array(), SX_POSTCODE_CHECKER_VERSION);
        wp_enqueue_script('sx-postcode-checker-admin-js', SX_POSTCODE_CHECKER_URL . 'admin/js/admin.js', array('jquery'), SX_POSTCODE_CHECKER_VERSION, true);
        
        // Localize script with any data needed for the media uploader
        wp_localize_script('sx-postcode-checker-admin-js', 'sx_admin', array(
            'title' => __('Select CSV File', 'sx-postcode-checker'),
            'button' => __('Use This File', 'sx-postcode-checker')
        ));
    }
    
    /**
     * Handle CSV upload
     */
    public function handle_csv_upload() {
        // Check permissions
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.', 'sx-postcode-checker'));
        }
        
        // Verify nonce
        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'sx_upload_csv_nonce')) {
            wp_die(__('Security check failed.', 'sx-postcode-checker'));
        }
        
        // Handle direct file input
        if (isset($_POST['csv_file_path']) && !empty($_POST['csv_file_path'])) {
            $file_path = sanitize_text_field($_POST['csv_file_path']);
            
            // Validate that the file exists and is a CSV
            if (!file_exists($file_path) || pathinfo($file_path, PATHINFO_EXTENSION) !== 'csv') {
                wp_redirect(admin_url('admin.php?page=sx-postcode-checker&error=invalid_path'));
                exit;
            }
            
            // Update options
            $options = get_option('sx_postcode_checker_options');
            $options['csv_file_path'] = $file_path;
            update_option('sx_postcode_checker_options', $options);
            
            // Redirect back to settings page
            wp_redirect(admin_url('admin.php?page=sx-postcode-checker&message=csv_path_set'));
            exit;
        }
        
        // Check if file is uploaded
        if (!isset($_FILES['csv_file']) || $_FILES['csv_file']['error'] !== UPLOAD_ERR_OK) {
            wp_redirect(admin_url('admin.php?page=sx-postcode-checker&error=upload'));
            exit;
        }
        
        // Check file type
        $file_type = wp_check_filetype(basename($_FILES['csv_file']['name']));
        if ($file_type['ext'] !== 'csv') {
            wp_redirect(admin_url('admin.php?page=sx-postcode-checker&error=filetype'));
            exit;
        }
        
        // Create uploads directory if it doesn't exist
        $upload_dir = wp_upload_dir();
        $sx_upload_dir = $upload_dir['basedir'] . '/sx-postcode-checker';
        
        if (!file_exists($sx_upload_dir)) {
            wp_mkdir_p($sx_upload_dir);
        }
        
        // Move uploaded file
        $new_file_path = $sx_upload_dir . '/' . basename($_FILES['csv_file']['name']);
        move_uploaded_file($_FILES['csv_file']['tmp_name'], $new_file_path);
        
        // Update options
        $options = get_option('sx_postcode_checker_options');
        $options['csv_file_path'] = $new_file_path;
        update_option('sx_postcode_checker_options', $options);
        
        // Redirect back to settings page
        wp_redirect(admin_url('admin.php?page=sx-postcode-checker&message=csv_uploaded'));
        exit;
    }
}