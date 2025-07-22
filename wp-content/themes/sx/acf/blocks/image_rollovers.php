<?php
/**
 * ACF Field definitions for Image Rollovers Block
 *
 * @package SX
 */

if (!function_exists('register_image_rollovers_acf_fields')) {
    function register_image_rollovers_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_image_rollovers_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_image_rollovers_section',
                    'title' => 'Image Rollovers Section',
                    'fields' => array(
                        array(
                            'key' => 'field_image_rollovers_title',
                            'label' => 'Section Title',
                            'name' => 'section_title',
                            'type' => 'text',
                            'instructions' => 'Main title for the section (optional)',
                            'required' => 0,
                            'default_value' => 'Our Services'
                        ),
                        array(
                            'key' => 'field_image_rollovers_description',
                            'label' => 'Section Description',
                            'name' => 'section_description',
                            'type' => 'textarea',
                            'instructions' => 'Short description for the section (optional)',
                            'required' => 0,
                            'default_value' => 'Explore our range of services designed to meet your needs.',
                            'rows' => 3
                        ),
                        array(
                            'key' => 'field_image_rollovers_items',
                            'label' => 'Rollover Items',
                            'name' => 'rollover_items',
                            'type' => 'repeater',
                            'instructions' => 'Add up to 4 image items with rollover content',
                            'required' => 1,
                            'min' => 1,
                            'max' => 5,
                            'layout' => 'block',
                            'button_label' => 'Add Item',
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_image_rollovers_item_image',
                                    'label' => 'Image',
                                    'name' => 'image',
                                    'type' => 'image',
                                    'instructions' => 'Upload image (recommended size: 600x400px)',
                                    'required' => 1,
                                    'return_format' => 'array',
                                    'preview_size' => 'medium',
                                    'library' => 'all'
                                ),
                                array(
                                    'key' => 'field_image_rollovers_item_title',
                                    'label' => 'Title',
                                    'name' => 'title',
                                    'type' => 'text',
                                    'instructions' => 'Title to display on hover',
                                    'required' => 1,
                                ),
                                array(
                                    'key' => 'field_image_rollovers_item_text',
                                    'label' => 'Text',
                                    'name' => 'text',
                                    'type' => 'textarea',
                                    'instructions' => 'Short text to display on hover',
                                    'required' => 0,
                                    'rows' => 3
                                ),
                                array(
                                    'key' => 'field_image_rollovers_item_link',
                                    'label' => 'Link',
                                    'name' => 'link',
                                    'type' => 'link',
                                    'instructions' => 'Optional link for this item',
                                    'required' => 0,
                                    'return_format' => 'array'
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_image_rollovers_columns',
                            'label' => 'Grid Columns (Mobile)',
                            'name' => 'grid_columns_mobile',
                            'type' => 'select',
                            'instructions' => 'Number of columns on mobile devices',
                            'required' => 0,
                            'choices' => array(
                                '1' => '1 Column',
                                '2' => '2 Columns',
                            ),
                            'default_value' => '1',
                            'return_format' => 'value'
                        ),
                        array(
                            'key' => 'field_image_rollovers_columns_desktop',
                            'label' => 'Grid Columns (Desktop)',
                            'name' => 'grid_columns_desktop',
                            'type' => 'select',
                            'instructions' => 'Number of columns on desktop devices',
                            'required' => 0,
                            'choices' => array(
                                '2' => '2 Columns',
                                '3' => '3 Columns',
                                '4' => '4 Columns',
                                '5' => '5 Columns',
                            ),
                            'default_value' => '4',
                            'return_format' => 'value'
                        ),
                        array(
                            'key' => 'field_image_rollovers_overlay_color',
                            'label' => 'Overlay Color',
                            'name' => 'overlay_color',
                            'type' => 'color_picker',
                            'instructions' => 'Color for the hover overlay',
                            'required' => 0,
                            'default_value' => '#ef4444'
                        ),
                        array(
                            'key' => 'field_image_rollovers_text_color',
                            'label' => 'Text Color',
                            'name' => 'text_color',
                            'type' => 'color_picker',
                            'instructions' => 'Color for the text on hover',
                            'required' => 0,
                            'default_value' => '#ffffff'
                        ),
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/image-rollovers'
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

// Register the fields
add_action('acf/init', 'register_image_rollovers_acf_fields');
