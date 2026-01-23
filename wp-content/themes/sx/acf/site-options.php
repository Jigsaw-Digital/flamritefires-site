<?php
/**
 * Site Options ACF Fields
 * Settings for site-wide options like logos
 */

function register_site_options_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_site_options',
            'title' => 'Site Options',
            'fields' => array(
                array(
                    'key' => 'field_site_logo',
                    'label' => 'Site Logo',
                    'name' => 'site_logo',
                    'type' => 'image',
                    'instructions' => 'Main site logo for Flamerite Fires',
                    'required' => 0,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ),
                array(
                    'key' => 'field_coolright_logo',
                    'label' => 'Coolright Logo',
                    'name' => 'coolright_logo',
                    'type' => 'image',
                    'instructions' => 'Alternative logo for Coolright mode (Fans & Portable AC Units)',
                    'required' => 0,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'site-settings',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
        ));
    }
}

// Register the fields
add_action('acf/init', 'register_site_options_acf_fields');
