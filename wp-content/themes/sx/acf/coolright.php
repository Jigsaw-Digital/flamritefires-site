<?php
/**
 * Coolright Mode ACF Fields
 * Adds checkbox to enable cool blue navbar and alternative logo
 */

function register_coolright_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_coolright',
            'title' => 'Coolright Settings',
            'fields' => array(
                array(
                    'key' => 'field_is_coolright_page',
                    'label' => 'Enable Coolright Mode',
                    'name' => 'is_coolright_page',
                    'type' => 'true_false',
                    'instructions' => 'Enable cool blue navbar and alternative logo (for Fans & Portable AC Units)',
                    'required' => 0,
                    'default_value' => 0,
                    'ui' => 1,
                    'ui_on_text' => 'Yes',
                    'ui_off_text' => 'No',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'page',
                    ),
                ),
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'products',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'side',
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
add_action('acf/init', 'register_coolright_acf_fields');
