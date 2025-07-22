<?php
/**
 * ACF Field definitions for New Coverage Section Block
 *
 * @package SX
 */

if (!function_exists('register_new_coverage_acf_fields')) {
    function register_new_coverage_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_new_coverage_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_new_coverage_section',
                    'title' => 'New Coverage Section',
                    'fields' => array(
                        array(
                            'key' => 'field_new_coverage_left_top_image',
                            'label' => 'Left Top Image',
                            'name' => 'left_top_image',
                            'type' => 'image',
                            'instructions' => 'Upload the image for the top left position',
                            'required' => 1,
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all'
                        ),
                        array(
                            'key' => 'field_new_coverage_left_title',
                            'label' => 'Left Title',
                            'name' => 'left_title',
                            'type' => 'text',
                            'instructions' => 'Title that appears on top of the left images',
                            'required' => 1,
                            'default_value' => 'Engineer'
                        ),
                        array(
                            'key' => 'field_new_coverage_left_subtitle',
                            'label' => 'Left Subtitle',
                            'name' => 'left_subtitle',
                            'type' => 'text',
                            'instructions' => 'Subtitle that appears below the title on the left images',
                            'required' => 1,
                            'default_value' => 'coverage'
                        ),
                        array(
                            'key' => 'field_new_coverage_left_bottom_image',
                            'label' => 'Left Bottom Image',
                            'name' => 'left_bottom_image',
                            'type' => 'image',
                            'instructions' => 'Upload the image for the bottom left position',
                            'required' => 1,
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all'
                        ),
                        array(
                            'key' => 'field_new_coverage_map_image',
                            'label' => 'Map Image',
                            'name' => 'map_image',
                            'type' => 'image',
                            'instructions' => 'Upload the map image for the right side',
                            'required' => 1,
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all'
                        )
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/new-coverage-section'
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