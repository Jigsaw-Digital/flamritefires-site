<?php
/**
 * ACF Field definitions for New Planned Maintenance Section Block
 *
 * @package SX
 */

if (!function_exists('register_new_planned_maintenance_acf_fields')) {
    function register_new_planned_maintenance_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_new_planned_maintenance_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_new_planned_maintenance_section',
                    'title' => 'New Planned Maintenance Section',
                    'fields' => array(
                        array(
                            'key' => 'field_new_planned_maintenance_title',
                            'label' => 'Section Title',
                            'name' => 'section_title',
                            'type' => 'text',
                            'instructions' => 'Main title for the planned maintenance section',
                            'required' => 1,
                            'default_value' => 'We Ensure Longevity & Efficiency'
                        ),
                        array(
                            'key' => 'field_new_planned_maintenance_background_image',
                            'label' => 'Background Image',
                            'name' => 'background_image',
                            'type' => 'image',
                            'instructions' => 'Optional background image for the section',
                            'required' => 0,
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all'
                        ),
                        array(
                            'key' => 'field_new_planned_maintenance_road_image',
                            'label' => 'Road Image',
                            'name' => 'road_image',
                            'type' => 'image',
                            'instructions' => 'Road image for vehicle SVG alignment (appears between top and bottom rows)',
                            'required' => 0,
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all'
                        ),
                        array(
                            'key' => 'field_new_planned_maintenance_items',
                            'label' => 'Maintenance Items',
                            'name' => 'maintenance_items',
                            'type' => 'repeater',
                            'instructions' => 'Add up to 8 maintenance items',
                            'required' => 1,
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_maintenance_item_title',
                                    'label' => 'Title',
                                    'name' => 'title',
                                    'type' => 'wysiwyg',
                                    'instructions' => 'Title for this maintenance item (supports bold, italic, etc.)',
                                    'required' => 1,
                                    'default_value' => '',
                                    'tabs' => 'visual',
                                    'toolbar' => 'basic',
                                    'media_upload' => 0,
                                    'delay' => 0,
                                    'wrapper' => array(
                                        'width' => '50'
                                    )
                                ),
                                array(
                                    'key' => 'field_maintenance_item_subtitle',
                                    'label' => 'Subtitle',
                                    'name' => 'subtitle',
                                    'type' => 'text',
                                    'instructions' => 'Subtitle for this maintenance item',
                                    'required' => 0,
                                    'default_value' => '',
                                    'wrapper' => array(
                                        'width' => '50'
                                    )
                                )
                            ),
                            'min' => 1,
                            'max' => 8,
                            'layout' => 'table',
                            'button_label' => 'Add Maintenance Item'
                        ),
                        array(
                            'key' => 'field_new_planned_maintenance_button_text',
                            'label' => 'Button Text',
                            'name' => 'button_text',
                            'type' => 'text',
                            'instructions' => 'Text for the bottom button',
                            'required' => 1,
                            'default_value' => 'ENGINEER COVERAGE'
                        ),
                        array(
                            'key' => 'field_new_planned_maintenance_button_url',
                            'label' => 'Button URL',
                            'name' => 'button_url',
                            'type' => 'url',
                            'instructions' => 'URL for the bottom button',
                            'required' => 0,
                            'default_value' => '#'
                        )
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/new-planned-maintenance-section'
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