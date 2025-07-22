<?php
/**
 * ACF Field definitions for Customers Section Block
 *
 * @package SX
 */

if (!function_exists('register_customers_acf_fields')) {
    function register_customers_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_customers_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_customers_section',
                    'title' => 'Customers Section',
                    'fields' => array(
                        array(
                            'key' => 'field_customers_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => 'Main title for the customers section',
                            'required' => 0,
                            'default_value' => 'Customers'
                        ),
                        array(
                            'key' => 'field_customers_subtitle',
                            'label' => 'Subtitle',
                            'name' => 'subtitle',
                            'type' => 'text',
                            'instructions' => 'Subtitle for the customers section',
                            'required' => 0,
                            'default_value' => 'Our'
                        ),
                        array(
                            'key' => 'field_customers_background_image',
                            'label' => 'Background Image',
                            'name' => 'background_image',
                            'type' => 'image',
                            'instructions' => 'Background image for the customers section',
                            'required' => 0,
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all'
                        ),
                        array(
                            'key' => 'field_customers_customers',
                            'label' => 'Customer Logos',
                            'name' => 'customers',
                            'type' => 'repeater',
                            'instructions' => 'Add customer logos to display',
                            'required' => 0,
                            'min' => 0,
                            'max' => 0,
                            'layout' => 'block',
                            'button_label' => 'Add Customer',
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_customers_logo',
                                    'label' => 'Logo',
                                    'name' => 'logo',
                                    'type' => 'image',
                                    'instructions' => 'Customer logo',
                                    'required' => 1,
                                    'return_format' => 'array',
                                    'preview_size' => 'medium',
                                    'library' => 'all'
                                ),
                                array(
                                    'key' => 'field_customers_name',
                                    'label' => 'Customer Name',
                                    'name' => 'name',
                                    'type' => 'text',
                                    'instructions' => 'Name of the customer (for alt text)',
                                    'required' => 1
                                )
                            )
                        )
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/customers-section'
                            )
                        )
                    ),
                    'menu_order' => 0,
                    'position' => 'normal',
                    'style' => 'default',
                    'label_placement' => 'top',
                    'instruction_placement' => 'label',
                    'hide_on_screen' => '',
                    'active' => true,
                    'description' => ''
                ));
            }
        }
    }
}
