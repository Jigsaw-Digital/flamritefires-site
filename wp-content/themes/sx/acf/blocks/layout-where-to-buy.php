<?php
/**
 * Layout Where to Buy ACF Field Registration
 */

function register_layout_where_to_buy_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_layout_where_to_buy',
            'title' => 'Layout Where to Buy',
            'fields' => array(
                array(
                    'key' => 'field_layout_where_to_buy_data',
                    'label' => 'Where to Buy Data',
                    'name' => 'layout_where_to_buy_data',
                    'type' => 'group',
                    'instructions' => 'Configure the where to buy section',
                    'required' => 0,
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_where_to_buy_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => 'Page/section title',
                            'required' => 0,
                            'default_value' => 'Where to Buy',
                            'placeholder' => 'Enter title',
                            'maxlength' => 100,
                        ),
                        array(
                            'key' => 'field_where_to_buy_description',
                            'label' => 'Description',
                            'name' => 'description',
                            'type' => 'wysiwyg',
                            'instructions' => 'Description for the where to buy section',
                            'required' => 0,
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
                        'value' => 'acf/layout-where-to-buy',
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
add_action('acf/init', 'register_layout_where_to_buy_acf_fields');
