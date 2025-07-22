<?php
/**
 * ACF Field definitions for New Delivery Section Block
 *
 * @package SX
 */

if (!function_exists('register_new_delivery_acf_fields')) {
    function register_new_delivery_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_new_delivery_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_new_delivery_section',
                    'title' => 'New Delivery Section',
                    'fields' => array(
                        array(
                            'key' => 'field_new_delivery_title',
                            'label' => 'Section Title',
                            'name' => 'section_title',
                            'type' => 'text',
                            'instructions' => 'Main title for the delivery section',
                            'required' => 1,
                            'default_value' => 'We deliver when you need it most'
                        ),
                        array(
                            'key' => 'field_new_delivery_background_image',
                            'label' => 'Background Image',
                            'name' => 'background_image',
                            'type' => 'image',
                            'instructions' => 'Background image for the section',
                            'required' => 0,
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all'
                        ),
                        array(
                            'key' => 'field_new_delivery_center_image',
                            'label' => 'Center Image',
                            'name' => 'center_image',
                            'type' => 'image',
                            'instructions' => 'Image that appears in the center (person/character)',
                            'required' => 0,
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all'
                        ),
                        array(
                            'key' => 'field_new_delivery_icons',
                            'label' => 'Delivery Features',
                            'name' => 'delivery_features',
                            'type' => 'repeater',
                            'instructions' => 'Add up to 4 delivery features with icons',
                            'required' => 1,
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_delivery_feature_icon',
                                    'label' => 'Icon',
                                    'name' => 'icon',
                                    'type' => 'image',
                                    'instructions' => 'Upload an icon for this feature',
                                    'required' => 1,
                                    'return_format' => 'array',
                                    'preview_size' => 'thumbnail',
                                    'library' => 'all',
                                    'wrapper' => array(
                                        'width' => '30'
                                    )
                                ),
                                array(
                                    'key' => 'field_delivery_feature_text',
                                    'label' => 'Text',
                                    'name' => 'text',
                                    'type' => 'textarea',
                                    'instructions' => 'Text description for this feature',
                                    'required' => 1,
                                    'rows' => 3,
                                    'wrapper' => array(
                                        'width' => '70'
                                    )
                                ),
                                array(
                                    'key' => 'field_delivery_feature_position',
                                    'label' => 'Position',
                                    'name' => 'position',
                                    'type' => 'select',
                                    'instructions' => 'Where to position this feature around the center image',
                                    'required' => 1,
                                    'choices' => array(
                                        'top-left' => 'Top Left',
                                        'top-right' => 'Top Right',
                                        'bottom-left' => 'Bottom Left',
                                        'bottom-right' => 'Bottom Right'
                                    ),
                                    'default_value' => 'top-left',
                                    'wrapper' => array(
                                        'width' => '100'
                                    )
                                )
                            ),
                            'min' => 1,
                            'max' => 4,
                            'layout' => 'table',
                            'button_label' => 'Add Feature'
                        )
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/new-delivery-section'
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