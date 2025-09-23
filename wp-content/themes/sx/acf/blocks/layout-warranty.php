<?php
/**
 * Layout Warranty ACF Field Registration
 */

function register_layout_warranty_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_layout_warranty',
            'title' => 'Layout Warranty',
            'fields' => array(
                array(
                    'key' => 'field_layout_warranty_data',
                    'label' => 'Warranty Data',
                    'name' => 'layout_warranty_data',
                    'type' => 'group',
                    'instructions' => 'Configure warranty section',
                    'required' => 0,
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_warranty_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => 'Page/section title',
                            'required' => 0,
                            'default_value' => 'Extended Warranty',
                            'placeholder' => 'Enter title',
                            'maxlength' => 100,
                        ),
                        array(
                            'key' => 'field_warranty_description',
                            'label' => 'Description',
                            'name' => 'description',
                            'type' => 'wysiwyg',
                            'instructions' => 'Description for the warranty section',
                            'required' => 0,
                            'default_value' => 'Become part of the Flamerite Fires family and cover your fire for up to 5 years, guaranteeing the longevity of your fireplace for years to come.',
                            'tabs' => 'all',
                            'toolbar' => 'full',
                            'media_upload' => 0,
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/layout-warranty',
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
add_action('acf/init', 'register_layout_warranty_acf_fields');