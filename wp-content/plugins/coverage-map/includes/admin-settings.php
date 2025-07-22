<?php
/**
 * Admin Settings for Coverage Map Plugin
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Add settings menu
add_action('admin_menu', 'coverage_map_add_admin_menu');
function coverage_map_add_admin_menu() {
    add_options_page(
        __('Coverage Map Settings', 'coverage-map'),
        __('Coverage Map', 'coverage-map'),
        'manage_options',
        'coverage-map-settings',
        'coverage_map_settings_page'
    );
}

// Register settings
add_action('admin_init', 'coverage_map_settings_init');
function coverage_map_settings_init() {
    register_setting('coverage_map_settings', 'coverage_map_google_api_key');
    register_setting('coverage_map_settings', 'coverage_map_background_image');
    register_setting('coverage_map_settings', 'coverage_map_background_color');
    register_setting('coverage_map_settings', 'coverage_map_background_opacity');
    
    add_settings_section(
        'coverage_map_section',
        __('Coverage Map Settings', 'coverage-map'),
        'coverage_map_section_callback',
        'coverage_map_settings'
    );
    
    add_settings_field(
        'coverage_map_google_api_key',
        __('Google Maps API Key', 'coverage-map'),
        'coverage_map_api_key_field_callback',
        'coverage_map_settings',
        'coverage_map_section'
    );
    
    add_settings_field(
        'coverage_map_background_image',
        __('Background Image', 'coverage-map'),
        'coverage_map_background_image_field_callback',
        'coverage_map_settings',
        'coverage_map_section'
    );
    
    add_settings_field(
        'coverage_map_background_color',
        __('Background Overlay Color', 'coverage-map'),
        'coverage_map_background_color_field_callback',
        'coverage_map_settings',
        'coverage_map_section'
    );
    
    add_settings_field(
        'coverage_map_background_opacity',
        __('Background Overlay Opacity', 'coverage-map'),
        'coverage_map_background_opacity_field_callback',
        'coverage_map_settings',
        'coverage_map_section'
    );
}

function coverage_map_section_callback() {
    echo '<p>' . __('Configure your Coverage Map plugin settings below.', 'coverage-map') . '</p>';
}

function coverage_map_api_key_field_callback() {
    $api_key = get_option('coverage_map_google_api_key');
    ?>
    <input type="text" name="coverage_map_google_api_key" value="<?php echo esc_attr($api_key); ?>" class="regular-text" />
    <p class="description"><?php _e('Enter your Google Maps JavaScript API key. This is required for the map functionality.', 'coverage-map'); ?></p>
    <p class="description"><?php _e('You can get an API key from the <a href="https://console.cloud.google.com/google/maps-apis/credentials" target="_blank">Google Cloud Console</a>.', 'coverage-map'); ?></p>
    <?php
}

function coverage_map_background_image_field_callback() {
    $image_url = get_option('coverage_map_background_image');
    $default_image = COVERAGE_MAP_PLUGIN_URL . 'assets/images/coverage.png';
    ?>
    <div class="coverage-map-image-upload">
        <input type="hidden" id="coverage_map_background_image" name="coverage_map_background_image" value="<?php echo esc_url($image_url); ?>" />
        <div id="coverage-map-image-preview" style="margin-bottom: 10px;">
            <?php if ($image_url): ?>
                <img src="<?php echo esc_url($image_url); ?>" style="max-width: 300px; height: auto; border: 1px solid #ddd; padding: 5px;" />
            <?php else: ?>
                <img src="<?php echo esc_url($default_image); ?>" style="max-width: 300px; height: auto; border: 1px solid #ddd; padding: 5px;" />
            <?php endif; ?>
        </div>
        <button type="button" class="button" id="coverage-map-upload-btn"><?php _e('Select Image', 'coverage-map'); ?></button>
        <button type="button" class="button" id="coverage-map-remove-btn" <?php echo $image_url ? '' : 'style="display:none;"'; ?>><?php _e('Remove Image', 'coverage-map'); ?></button>
        <p class="description"><?php _e('Upload a background image for the coverage section. Recommended size: 1920x1080 pixels.', 'coverage-map'); ?></p>
        <p class="description"><?php _e('If no image is selected, the default image will be used.', 'coverage-map'); ?></p>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        var mediaUploader;
        
        $('#coverage-map-upload-btn').click(function(e) {
            e.preventDefault();
            
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            
            mediaUploader = wp.media({
                title: '<?php _e('Select Background Image', 'coverage-map'); ?>',
                button: {
                    text: '<?php _e('Use this image', 'coverage-map'); ?>'
                },
                multiple: false
            });
            
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#coverage_map_background_image').val(attachment.url);
                $('#coverage-map-image-preview img').attr('src', attachment.url);
                $('#coverage-map-remove-btn').show();
            });
            
            mediaUploader.open();
        });
        
        $('#coverage-map-remove-btn').click(function(e) {
            e.preventDefault();
            $('#coverage_map_background_image').val('');
            $('#coverage-map-image-preview img').attr('src', '<?php echo esc_url($default_image); ?>');
            $(this).hide();
        });
    });
    </script>
    <?php
}

function coverage_map_background_color_field_callback() {
    $color = get_option('coverage_map_background_color', '#ed1c24');
    ?>
    <input type="text" name="coverage_map_background_color" value="<?php echo esc_attr($color); ?>" class="coverage-map-color-picker" />
    <p class="description"><?php _e('Choose the color for the background overlay. Default: #ed1c24 (red)', 'coverage-map'); ?></p>
    
    <script>
    jQuery(document).ready(function($) {
        $('.coverage-map-color-picker').wpColorPicker();
    });
    </script>
    <?php
}

function coverage_map_background_opacity_field_callback() {
    $opacity = get_option('coverage_map_background_opacity', '80');
    ?>
    <input type="number" name="coverage_map_background_opacity" value="<?php echo esc_attr($opacity); ?>" min="0" max="100" step="5" style="width: 60px;" />
    <span>%</span>
    <p class="description"><?php _e('Set the opacity of the background overlay. 0% = fully transparent, 100% = fully opaque. Default: 80%', 'coverage-map'); ?></p>
    <?php
}

// Settings page content
function coverage_map_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('coverage_map_settings');
            do_settings_sections('coverage_map_settings');
            submit_button();
            ?>
        </form>
        
        <hr />
        
        <h2><?php _e('Usage', 'coverage-map'); ?></h2>
        <p><?php _e('To display the coverage map on any page or post, use the following shortcode:', 'coverage-map'); ?></p>
        <code>[coverage_map]</code>
        
        <h3><?php _e('Shortcode Parameters', 'coverage-map'); ?></h3>
        <ul>
            <li><code>title="Your Title"</code> - <?php _e('Override the default title', 'coverage-map'); ?></li>
            <li><code>subtitle="Your Subtitle"</code> - <?php _e('Override the default subtitle', 'coverage-map'); ?></li>
            <li><code>search_placeholder="Your Placeholder"</code> - <?php _e('Override the search placeholder text', 'coverage-map'); ?></li>
            <li><code>default_lat="54.5"</code> - <?php _e('Set default map latitude', 'coverage-map'); ?></li>
            <li><code>default_lng="-2.5"</code> - <?php _e('Set default map longitude', 'coverage-map'); ?></li>
            <li><code>default_zoom="6"</code> - <?php _e('Set default map zoom level', 'coverage-map'); ?></li>
            <li><code>background_image="URL"</code> - <?php _e('Override the background image URL', 'coverage-map'); ?></li>
            <li><code>background_color="#ed1c24"</code> - <?php _e('Override the background overlay color', 'coverage-map'); ?></li>
            <li><code>background_opacity="80"</code> - <?php _e('Override the background overlay opacity (0-100)', 'coverage-map'); ?></li>
        </ul>
        
        <h3><?php _e('Examples', 'coverage-map'); ?></h3>
        <p><code>[coverage_map title="Find Your Local Engineer" subtitle="Coverage across the UK" default_lat="51.5074" default_lng="-0.1278"]</code></p>
        <p><code>[coverage_map background_color="#0066cc" background_opacity="90"]</code></p>
    </div>
    <?php
}