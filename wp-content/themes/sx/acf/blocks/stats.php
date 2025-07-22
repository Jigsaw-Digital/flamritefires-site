<?php
/**
 * ACF Field definitions for Stats Section Block
 *
 * @package SX
 */

if (!function_exists('register_stats_acf_fields')) {
    function register_stats_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_stats_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_stats_section',
                    'title' => 'Stats Section',
                    'fields' => array(
                        array(
                            'key' => 'field_stats_stats',
                            'label' => 'Statistics',
                            'name' => 'stats',
                            'type' => 'repeater',
                            'instructions' => 'Add statistics to display',
                            'required' => 0,
                            'min' => 0,
                            'max' => 0,
                            'layout' => 'block',
                            'button_label' => 'Add Statistic',
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_stats_number',
                                    'label' => 'Number',
                                    'name' => 'number',
                                    'type' => 'text',
                                    'instructions' => 'The statistic number (e.g. 500)',
                                    'required' => 1,
                                ),
                                array(
                                    'key' => 'field_stats_suffix',
                                    'label' => 'Suffix',
                                    'name' => 'suffix',
                                    'type' => 'text',
                                    'instructions' => 'Suffix to display after the number (e.g. +, %, k)',
                                    'required' => 0,
                                ),
                                array(
                                    'key' => 'field_stats_label',
                                    'label' => 'Label',
                                    'name' => 'label',
                                    'type' => 'text',
                                    'instructions' => 'Label describing the statistic',
                                    'required' => 1,
                                )
                            )
                        ),
                        array(
                            'key' => 'field_stats_background_image',
                            'label' => 'Background Image',
                            'name' => 'background_image',
                            'type' => 'image',
                            'instructions' => 'Background image for the stats section',
                            'required' => 0,
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
                                'value' => 'acf/stats-section'
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
