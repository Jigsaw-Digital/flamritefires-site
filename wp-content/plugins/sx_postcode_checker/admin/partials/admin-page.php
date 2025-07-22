<div class="wrap">
    <h1><?php _e('SX Postcode Checker Settings', 'sx-postcode-checker'); ?></h1>
    
    <?php if (isset($_GET['message']) && $_GET['message'] === 'csv_uploaded'): ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e('CSV file uploaded successfully.', 'sx-postcode-checker'); ?></p>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_GET['error'])): ?>
        <div class="notice notice-error is-dismissible">
            <?php if ($_GET['error'] === 'upload'): ?>
                <p><?php _e('There was an error uploading the CSV file.', 'sx-postcode-checker'); ?></p>
            <?php elseif ($_GET['error'] === 'filetype'): ?>
                <p><?php _e('The uploaded file is not a CSV file.', 'sx-postcode-checker'); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    
    <div class="sx-admin-container">
        <div class="sx-admin-main">
            <form method="post" action="options.php">
                <?php
                settings_fields('sx_postcode_checker_options_group');
                $options = get_option('sx_postcode_checker_options');
                ?>
                
                <div class="sx-settings-section">
                    <h2><?php _e('Google Maps Settings', 'sx-postcode-checker'); ?></h2>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('Google Maps API Key', 'sx-postcode-checker'); ?></th>
                            <td>
                                <input type="text" name="sx_postcode_checker_options[map_api_key]" value="<?php echo isset($options['map_api_key']) ? esc_attr($options['map_api_key']) : ''; ?>" class="regular-text" />
                                <p class="description"><?php _e('Enter your Google Maps API key. <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Get an API key</a>', 'sx-postcode-checker'); ?></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('Map Zoom Level', 'sx-postcode-checker'); ?></th>
                            <td>
                                <input type="number" name="sx_postcode_checker_options[map_zoom]" value="<?php echo isset($options['map_zoom']) ? esc_attr($options['map_zoom']) : '12'; ?>" min="1" max="20" />
                                <p class="description"><?php _e('Set the map zoom level (1-20) when a location is found.', 'sx-postcode-checker'); ?></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('Map Height', 'sx-postcode-checker'); ?></th>
                            <td>
                                <input type="text" name="sx_postcode_checker_options[map_height]" value="<?php echo isset($options['map_height']) ? esc_attr($options['map_height']) : '500px'; ?>" class="regular-text" />
                                <p class="description"><?php _e('Set the map height (e.g., "500px" or "50vh").', 'sx-postcode-checker'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="sx-settings-section">
                    <h2><?php _e('Data Source Settings', 'sx-postcode-checker'); ?></h2>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('Data Source', 'sx-postcode-checker'); ?></th>
                            <td>
                                <select name="sx_postcode_checker_options[data_source]" id="sx-data-source">
                                    <option value="csv" <?php selected(isset($options['data_source']) ? $options['data_source'] : 'csv', 'csv'); ?>><?php _e('CSV File', 'sx-postcode-checker'); ?></option>
                                    <option value="post_type" <?php selected(isset($options['data_source']) ? $options['data_source'] : 'csv', 'post_type'); ?>><?php _e('Custom Post Type', 'sx-postcode-checker'); ?></option>
                                </select>
                                <p class="description"><?php _e('Select the data source for postcode information.', 'sx-postcode-checker'); ?></p>
                            </td>
                        </tr>
                    </table>
                    
                    <div id="csv-settings" class="sx-conditional-settings" <?php echo isset($options['data_source']) && $options['data_source'] !== 'csv' ? 'style="display:none;"' : ''; ?>>
                        <h3><?php _e('CSV Settings', 'sx-postcode-checker'); ?></h3>
                        <p><?php _e('Upload a CSV file with postcode data or specify a path to an existing CSV file. The CSV should have columns including: ID, Title, Latitude, Longitude, "Postal Code", "Subsidence Claims".', 'sx-postcode-checker'); ?></p>
                        
                        <?php if (!empty($options['csv_file_path']) && file_exists($options['csv_file_path'])): ?>
                            <p><strong><?php _e('Current CSV file:', 'sx-postcode-checker'); ?></strong> <?php echo basename($options['csv_file_path']); ?> (<?php echo $options['csv_file_path']; ?>)</p>
                        <?php else: ?>
                            <p><strong><?php _e('No CSV file uploaded yet.', 'sx-postcode-checker'); ?></strong></p>
                        <?php endif; ?>
                        
                        <div class="sx-media-upload">
                            <p>
                                <strong><?php _e('Option 1: Upload a CSV file from Media Library', 'sx-postcode-checker'); ?></strong><br />
                                <button id="sx-csv-upload-button" class="button button-secondary"><?php _e('Select CSV File', 'sx-postcode-checker'); ?></button>
                            </p>
                            
                            <?php 
                            $csv_file_id = isset($options['csv_file_id']) ? $options['csv_file_id'] : '';
                            $csv_file_url = isset($options['csv_file_url']) ? $options['csv_file_url'] : '';
                            $csv_filename = '';
                            
                            if (!empty($csv_file_id)) {
                                $attachment = get_post($csv_file_id);
                                if ($attachment) {
                                    $csv_filename = basename(get_attached_file($csv_file_id));
                                }
                            }
                            ?>
                            
                            <div id="sx-selected-csv-file">
                                <?php if (!empty($csv_filename)): ?>
                                    <strong><?php _e('Selected file:', 'sx-postcode-checker'); ?></strong> <?php echo esc_html($csv_filename); ?>
                                <?php endif; ?>
                            </div>
                            
                            <form method="post" action="options.php">
                                <?php settings_fields('sx_postcode_checker_options_group'); ?>
                                <input type="hidden" id="sx-csv-file-id" name="sx_postcode_checker_options[csv_file_id]" value="<?php echo esc_attr($csv_file_id); ?>" />
                                <input type="hidden" id="sx-csv-file-url" name="sx_postcode_checker_options[csv_file_url]" value="<?php echo esc_attr($csv_file_url); ?>" />
                                <input type="hidden" name="sx_postcode_checker_options[data_source]" value="csv" />
                                
                                <p>
                                    <input type="submit" id="sx-save-csv-button" class="button button-primary" value="<?php _e('Save CSV Selection', 'sx-postcode-checker'); ?>" <?php echo empty($csv_file_id) ? 'style="display:none"' : ''; ?> />
                                </p>
                            </form>
                        </div>
                        
                        <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
                            <input type="hidden" name="action" value="sx_upload_csv" />
                            <?php wp_nonce_field('sx_upload_csv_nonce'); ?>
                            
                            <p>
                                <strong><?php _e('Option 2: Specify path to an existing CSV file', 'sx-postcode-checker'); ?></strong><br />
                                <input type="text" name="csv_file_path" class="regular-text" value="<?php echo !empty($options['csv_file_path']) ? esc_attr($options['csv_file_path']) : ''; ?>" placeholder="/path/to/your/file.csv" />
                                <input type="submit" class="button button-secondary" value="<?php _e('Set CSV Path', 'sx-postcode-checker'); ?>" />
                            </p>
                            
                            <p class="description">
                                <?php _e('If you already have the CSV file on the server (like the one at /Users/michaeltaylor/Downloads/location_csv_1746700843.csv), enter the full path here.', 'sx-postcode-checker'); ?>
                            </p>
                        </form>
                    </div>
                    
                    <div id="post-type-settings" class="sx-conditional-settings" <?php echo isset($options['data_source']) && $options['data_source'] !== 'post_type' ? 'style="display:none;"' : ''; ?>>
                        <h3><?php _e('Custom Post Type Settings', 'sx-postcode-checker'); ?></h3>
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row"><?php _e('Post Type', 'sx-postcode-checker'); ?></th>
                                <td>
                                    <select name="sx_postcode_checker_options[post_type]">
                                        <option value=""><?php _e('-- Select Post Type --', 'sx-postcode-checker'); ?></option>
                                        <?php
                                        $post_types = get_post_types(array('public' => true), 'objects');
                                        foreach ($post_types as $post_type) {
                                            printf(
                                                '<option value="%s" %s>%s</option>',
                                                esc_attr($post_type->name),
                                                selected(isset($options['post_type']) ? $options['post_type'] : '', $post_type->name, false),
                                                esc_html($post_type->label)
                                            );
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><?php _e('Latitude Field', 'sx-postcode-checker'); ?></th>
                                <td>
                                    <input type="text" name="sx_postcode_checker_options[latitude_field]" value="<?php echo isset($options['latitude_field']) ? esc_attr($options['latitude_field']) : ''; ?>" class="regular-text" />
                                    <p class="description"><?php _e('Enter the meta key or ACF field name for latitude.', 'sx-postcode-checker'); ?></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><?php _e('Longitude Field', 'sx-postcode-checker'); ?></th>
                                <td>
                                    <input type="text" name="sx_postcode_checker_options[longitude_field]" value="<?php echo isset($options['longitude_field']) ? esc_attr($options['longitude_field']) : ''; ?>" class="regular-text" />
                                    <p class="description"><?php _e('Enter the meta key or ACF field name for longitude.', 'sx-postcode-checker'); ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="sx-settings-section">
                    <h2><?php _e('Display Settings', 'sx-postcode-checker'); ?></h2>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('Marker Title', 'sx-postcode-checker'); ?></th>
                            <td>
                                <input type="text" name="sx_postcode_checker_options[marker_title]" value="<?php echo isset($options['marker_title']) ? esc_attr($options['marker_title']) : 'Subsidence Projects: {count}'; ?>" class="regular-text" />
                                <p class="description"><?php _e('Set the marker title. Use {count} as a placeholder for the number of projects.', 'sx-postcode-checker'); ?></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('Info Window Template', 'sx-postcode-checker'); ?></th>
                            <td>
                                <textarea name="sx_postcode_checker_options[info_window_template]" rows="5" cols="50"><?php echo isset($options['info_window_template']) ? esc_textarea($options['info_window_template']) : '<div class="sx-info-window"><h4>Postcode: {postcode}</h4><p>Subsidence Projects: {count}</p></div>'; ?></textarea>
                                <p class="description"><?php _e('Set the info window template. Use {postcode} and {count} as placeholders.', 'sx-postcode-checker'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <?php submit_button(); ?>
            </form>
        </div>
        
        <div class="sx-admin-sidebar">
            <div class="sx-admin-box">
                <h3><?php _e('Shortcode Usage', 'sx-postcode-checker'); ?></h3>
                <p><?php _e('Use the following shortcode to display the postcode checker on your pages:', 'sx-postcode-checker'); ?></p>
                <code>[sx_postcode_checker]</code>
                
                <h4><?php _e('Available Attributes', 'sx-postcode-checker'); ?></h4>
                <ul>
                    <li><code>map_height</code> - <?php _e('Height of the map (e.g., "500px").', 'sx-postcode-checker'); ?></li>
                    <li><code>map_zoom</code> - <?php _e('Zoom level when a location is found (1-20).', 'sx-postcode-checker'); ?></li>
                </ul>
                
                <h4><?php _e('Example', 'sx-postcode-checker'); ?></h4>
                <code>[sx_postcode_checker map_height="600px" map_zoom="14"]</code>
            </div>
            
            <div class="sx-admin-box">
                <h3><?php _e('Support', 'sx-postcode-checker'); ?></h3>
                <p><?php _e('If you need help with this plugin, please contact our support team.', 'sx-postcode-checker'); ?></p>
            </div>
        </div>
    </div>
</div>