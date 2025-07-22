<?php
/**
 * ACF Field definitions for Section Header Block
 *
 * @package SX
 */

if (!function_exists('register_section_header_acf_fields')) {
    function register_section_header_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_section_header')) {
                acf_add_local_field_group(array(
                    'key' => 'group_section_header',
                    'title' => 'Section Header',
                    'fields' => array(
                        array(
                            'key' => 'field_section_header_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => 'Section header title',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'field_section_header_background_color',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'color_picker',
                            'instructions' => 'Background color for the section header',
                            'required' => 0,
                            'default_value' => '#0e0e0e'
                        ),
                        array(
                            'key' => 'field_section_header_text_color',
                            'label' => 'Text Color',
                            'name' => 'text_color',
                            'type' => 'select',
                            'instructions' => 'Text color for the section header',
                            'required' => 0,
                            'choices' => array(
                                'white' => 'White',
                                'black' => 'Black',
                                'gray-600' => 'Gray',
                                'red-600' => 'Red'
                            ),
                            'default_value' => 'white'
                        ),
                        array(
                            'key' => 'field_section_header_font_size',
                            'label' => 'Font Size',
                            'name' => 'font_size',
                            'type' => 'select',
                            'instructions' => 'Font size for the section header',
                            'required' => 0,
                            'choices' => array(
                                'text-xl lg:text-4xl' => 'Small',
                                'text-2xl lg:text-5xl' => 'Medium',
                                'text-2xl lg:text-6xl' => 'Large',
                                'text-3xl lg:text-7xl' => 'Extra Large'
                            ),
                            'default_value' => 'text-2xl lg:text-6xl'
                        )
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/section-header'
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
