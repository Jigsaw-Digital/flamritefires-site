<?php
/**
 * CSV Import functionality for Coverage Map
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Add import submenu
add_action('admin_menu', 'coverage_map_add_import_menu');
function coverage_map_add_import_menu() {
    add_submenu_page(
        'edit.php?post_type=coverage_points',
        __('Import CSV', 'coverage-map'),
        __('Import CSV', 'coverage-map'),
        'manage_options',
        'coverage-map-import',
        'coverage_map_import_page'
    );
}

// Import page content
function coverage_map_import_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Import Coverage Points from CSV', 'coverage-map'); ?></h1>
        
        <?php
        // Handle form submission
        if (isset($_POST['submit']) && isset($_FILES['csv_file'])) {
            coverage_map_handle_csv_import();
        }
        ?>
        
        <form method="post" enctype="multipart/form-data">
            <?php wp_nonce_field('coverage_map_csv_import', 'coverage_map_import_nonce'); ?>
            
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="csv_file"><?php _e('CSV File', 'coverage-map'); ?></label>
                    </th>
                    <td>
                        <input type="file" name="csv_file" id="csv_file" accept=".csv" required />
                        <p class="description"><?php _e('Select a CSV file to import coverage points.', 'coverage-map'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="update_existing"><?php _e('Update Existing', 'coverage-map'); ?></label>
                    </th>
                    <td>
                        <input type="checkbox" name="update_existing" id="update_existing" value="1" />
                        <label for="update_existing"><?php _e('Update existing coverage points with matching titles', 'coverage-map'); ?></label>
                    </td>
                </tr>
            </table>
            
            <h3><?php _e('CSV Format', 'coverage-map'); ?></h3>
            <p><?php _e('Your CSV file should have the following columns in this order:', 'coverage-map'); ?></p>
            <ol>
                <li><strong>ID</strong> - <?php _e('Unique identifier (optional, used for reference)', 'coverage-map'); ?></li>
                <li><strong>Title</strong> - <?php _e('Coverage point title (e.g., DE73)', 'coverage-map'); ?></li>
                <li><strong>Latitude</strong> - <?php _e('Decimal latitude (e.g., 52.8472038)', 'coverage-map'); ?></li>
                <li><strong>Longitude</strong> - <?php _e('Decimal longitude (e.g., -1.438215)', 'coverage-map'); ?></li>
                <li><strong>Postal Code</strong> - <?php _e('Postal code (e.g., DE73)', 'coverage-map'); ?></li>
                <li><strong>Subsidence Claims</strong> - <?php _e('Number of subsidence claims', 'coverage-map'); ?></li>
                <li><strong>Postcode Area</strong> - <?php _e('Postcode area (e.g., DE)', 'coverage-map'); ?></li>
                <li><strong>Region</strong> - <?php _e('Region name (e.g., East Midlands)', 'coverage-map'); ?></li>
            </ol>
            
            <h4><?php _e('Example:', 'coverage-map'); ?></h4>
            <pre style="background: #f0f0f0; padding: 10px; overflow-x: auto;">
ID,Title,Latitude,Longitude,Postal Code,Subsidence Claims,Postcode Area,Region
404,DE73,52.8472038,-1.438215,DE73,7,DE,East Midlands
405,NG1,52.9547,-1.1581,NG1,12,NG,East Midlands</pre>
            
            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Import CSV', 'coverage-map'); ?>" />
            </p>
        </form>
    </div>
    <?php
}

// Handle CSV import
function coverage_map_handle_csv_import() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['coverage_map_import_nonce'], 'coverage_map_csv_import')) {
        wp_die(__('Security check failed', 'coverage-map'));
    }
    
    // Check file upload
    if (empty($_FILES['csv_file']['tmp_name'])) {
        echo '<div class="notice notice-error"><p>' . __('No file uploaded.', 'coverage-map') . '</p></div>';
        return;
    }
    
    // Check file type
    $file_type = wp_check_filetype($_FILES['csv_file']['name']);
    if ($file_type['ext'] !== 'csv') {
        echo '<div class="notice notice-error"><p>' . __('Please upload a CSV file.', 'coverage-map') . '</p></div>';
        return;
    }
    
    $update_existing = isset($_POST['update_existing']) && $_POST['update_existing'] == '1';
    
    // Open and read CSV file
    $handle = fopen($_FILES['csv_file']['tmp_name'], 'r');
    if ($handle === false) {
        echo '<div class="notice notice-error"><p>' . __('Could not open file.', 'coverage-map') . '</p></div>';
        return;
    }
    
    $imported = 0;
    $updated = 0;
    $errors = 0;
    $row_number = 0;
    
    // Skip header row
    $header = fgetcsv($handle);
    
    while (($data = fgetcsv($handle)) !== false) {
        $row_number++;
        
        // Validate row data
        if (count($data) < 8) {
            $errors++;
            continue;
        }
        
        // Extract data
        $csv_id = $data[0];
        $title = trim($data[1]);
        $latitude = floatval($data[2]);
        $longitude = floatval($data[3]);
        $postal_code = trim($data[4]);
        $subsidence_claims = intval($data[5]);
        $postcode_area = trim($data[6]);
        $region = trim($data[7]);
        
        // Validate required fields
        if (empty($title) || empty($latitude) || empty($longitude) || empty($postal_code)) {
            $errors++;
            continue;
        }
        
        // Check if coverage point exists
        $existing_post = get_page_by_title($title, OBJECT, 'coverage_points');
        
        if ($existing_post && $update_existing) {
            // Update existing post
            $post_id = $existing_post->ID;
            
            // Update post
            wp_update_post(array(
                'ID' => $post_id,
                'post_title' => $title,
                'post_status' => 'publish'
            ));
            
            $updated++;
        } else if (!$existing_post) {
            // Create new post
            $post_id = wp_insert_post(array(
                'post_title' => $title,
                'post_type' => 'coverage_points',
                'post_status' => 'publish'
            ));
            
            if (is_wp_error($post_id)) {
                $errors++;
                continue;
            }
            
            $imported++;
        } else {
            // Skip existing post if not updating
            continue;
        }
        
        // Update meta fields
        update_post_meta($post_id, '_coverage_lat', $latitude);
        update_post_meta($post_id, '_coverage_lng', $longitude);
        update_post_meta($post_id, '_coverage_postal_code', $postal_code);
        update_post_meta($post_id, '_coverage_subsidence_claims', $subsidence_claims);
        update_post_meta($post_id, '_coverage_postcode_area', $postcode_area);
        update_post_meta($post_id, '_coverage_region', $region);
    }
    
    fclose($handle);
    
    // Display results
    if ($imported > 0 || $updated > 0) {
        $message = sprintf(
            __('Import completed. %d new coverage points imported, %d updated.', 'coverage-map'),
            $imported,
            $updated
        );
        if ($errors > 0) {
            $message .= sprintf(__(' %d rows had errors and were skipped.', 'coverage-map'), $errors);
        }
        echo '<div class="notice notice-success"><p>' . $message . '</p></div>';
    } else {
        echo '<div class="notice notice-warning"><p>' . __('No coverage points were imported.', 'coverage-map') . '</p></div>';
    }
}

// Add export functionality
add_action('admin_init', 'coverage_map_handle_export');
function coverage_map_handle_export() {
    if (isset($_GET['coverage_map_export']) && $_GET['coverage_map_export'] === '1') {
        // Verify nonce
        if (!wp_verify_nonce($_GET['_wpnonce'], 'coverage_map_export')) {
            wp_die(__('Security check failed', 'coverage-map'));
        }
        
        // Check permissions
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have permission to export data.', 'coverage-map'));
        }
        
        // Set headers for CSV download
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=coverage-points-' . date('Y-m-d') . '.csv');
        
        // Create output stream
        $output = fopen('php://output', 'w');
        
        // Add BOM for Excel UTF-8 compatibility
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        
        // Add header row
        fputcsv($output, array('ID', 'Title', 'Latitude', 'Longitude', 'Postal Code', 'Subsidence Claims', 'Postcode Area', 'Region'));
        
        // Get all coverage points
        $coverage_points = get_posts(array(
            'post_type' => 'coverage_points',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC'
        ));
        
        foreach ($coverage_points as $point) {
            $row = array(
                $point->ID,
                $point->post_title,
                get_post_meta($point->ID, '_coverage_lat', true),
                get_post_meta($point->ID, '_coverage_lng', true),
                get_post_meta($point->ID, '_coverage_postal_code', true),
                get_post_meta($point->ID, '_coverage_subsidence_claims', true),
                get_post_meta($point->ID, '_coverage_postcode_area', true),
                get_post_meta($point->ID, '_coverage_region', true)
            );
            
            fputcsv($output, $row);
        }
        
        fclose($output);
        exit;
    }
}

// Add export button to coverage points list
add_filter('views_edit-coverage_points', 'coverage_map_add_export_button');
function coverage_map_add_export_button($views) {
    $export_url = wp_nonce_url(
        add_query_arg('coverage_map_export', '1', admin_url('edit.php?post_type=coverage_points')),
        'coverage_map_export'
    );
    
    $views['export'] = '<a href="' . esc_url($export_url) . '" class="button" style="margin-left: 10px;">' . __('Export CSV', 'coverage-map') . '</a>';
    
    return $views;
}