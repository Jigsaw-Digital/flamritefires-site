<?php
/**
 * ACF Field definitions for New Reactive Maintenance Section Block
 *
 * @package SX
 */

if (!function_exists('register_new_reactive_maintenance_acf_fields')) {
    function register_new_reactive_maintenance_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_new_reactive_maintenance_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_new_reactive_maintenance_section',
                    'title' => 'New Reactive Maintenance Section',
                    'fields' => array(
                        array(
                            'key' => 'field_new_reactive_maintenance_title',
                            'label' => 'Section Title',
                            'name' => 'section_title',
                            'type' => 'text',
                            'instructions' => 'Main title for the reactive maintenance section',
                            'required' => 1,
                            'default_value' => 'Via our bespoke invested technologies, processes and team, we promise'
                        ),
                        array(
                            'key' => 'field_new_reactive_maintenance_background_image',
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
                            'key' => 'field_new_reactive_maintenance_left_svg',
                            'label' => 'Left SVG/Image',
                            'name' => 'left_svg',
                            'type' => 'image',
                            'instructions' => 'SVG or image for the left side of timeline',
                            'required' => 0,
                            'return_format' => 'array',
                            'preview_size' => 'thumbnail',
                            'library' => 'all'
                        ),
                        array(
                            'key' => 'field_new_reactive_maintenance_right_svg',
                            'label' => 'Right SVG/Image',
                            'name' => 'right_svg',
                            'type' => 'image',
                            'instructions' => 'SVG or image for the right side of timeline',
                            'required' => 0,
                            'return_format' => 'array',
                            'preview_size' => 'thumbnail',
                            'library' => 'all'
                        ),
                        array(
                            'key' => 'field_new_reactive_maintenance_timeline_items',
                            'label' => 'Timeline Items',
                            'name' => 'timeline_items',
                            'type' => 'repeater',
                            'instructions' => 'Add exactly 3 timeline items (middle section)',
                            'required' => 1,
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_timeline_item_image',
                                    'label' => 'Image',
                                    'name' => 'image',
                                    'type' => 'image',
                                    'instructions' => 'Circular image for this timeline item',
                                    'required' => 1,
                                    'return_format' => 'array',
                                    'preview_size' => 'thumbnail',
                                    'library' => 'all',
                                    'wrapper' => array(
                                        'width' => '25'
                                    )
                                ),
                                array(
                                    'key' => 'field_timeline_item_icon',
                                    'label' => 'Hover Icon',
                                    'name' => 'icon',
                                    'type' => 'image',
                                    'instructions' => 'Icon that appears above the title on hover',
                                    'required' => 0,
                                    'return_format' => 'array',
                                    'preview_size' => 'thumbnail',
                                    'library' => 'all',
                                    'wrapper' => array(
                                        'width' => '25'
                                    )
                                ),
                                array(
                                    'key' => 'field_timeline_item_title',
                                    'label' => 'Title',
                                    'name' => 'title',
                                    'type' => 'text',
                                    'instructions' => 'Title for this timeline item',
                                    'required' => 1,
                                    'wrapper' => array(
                                        'width' => '25'
                                    )
                                ),
                                array(
                                    'key' => 'field_timeline_item_description',
                                    'label' => 'Rollover Text',
                                    'name' => 'description',
                                    'type' => 'textarea',
                                    'instructions' => 'Text that appears on hover/rollover',
                                    'required' => 1,
                                    'rows' => 4,
                                    'wrapper' => array(
                                        'width' => '25'
                                    )
                                )
                            ),
                            'min' => 3,
                            'max' => 3,
                            'layout' => 'table',
                            'button_label' => 'Add Timeline Item'
                        )
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/new-reactive-maintenance-section'
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