<?php
/**
 * ACF Field definitions for Small Hero Section Block
 *
 * @package SX
 */

if (!function_exists('register_small_hero_acf_fields')) {
    function register_small_hero_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_small_hero_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_small_hero_section',
                    'title' => 'Small Hero Section',
                    'fields' => array(
                        array(
                            'key' => 'field_small_hero_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'wysiwyg',
                            'instructions' => 'Enter the hero title. You can use HTML tags for styling.',
                            'required' => 1,
                            'default_value' => '',
                            'tabs' => 'all',
                            'toolbar' => 'basic',
                            'media_upload' => 0,
                            'delay' => 0
                        ),
                        array(
                            'key' => 'field_small_hero_background_image',
                            'label' => 'Background Image',
                            'name' => 'background_image',
                            'type' => 'image',
                            'instructions' => 'Upload a background image for the hero section',
                            'required' => 0,
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all',
                            'min_width' => '',
                            'min_height' => '',
                            'min_size' => '',
                            'max_width' => '',
                            'max_height' => '',
                            'max_size' => '',
                            'mime_types' => ''
                        ),
                        array(
                            'key' => 'field_small_hero_overlay_opacity',
                            'label' => 'Background Overlay Opacity',
                            'name' => 'overlay_opacity',
                            'type' => 'range',
                            'instructions' => 'Adjust the darkness of the overlay on the background image (0 = no overlay, 100 = completely dark)',
                            'required' => 0,
                            'default_value' => 50,
                            'min' => 0,
                            'max' => 100,
                            'step' => 5,
                            'prepend' => '',
                            'append' => '%'
                        ),
                        array(
                            'key' => 'field_small_hero_text_alignment',
                            'label' => 'Text Alignment',
                            'name' => 'text_alignment',
                            'type' => 'select',
                            'instructions' => 'Choose the alignment of the title text',
                            'required' => 0,
                            'choices' => array(
                                'left' => 'Left',
                                'center' => 'Center',
                                'right' => 'Right'
                            ),
                            'default_value' => 'center',
                            'allow_null' => 0,
                            'multiple' => 0,
                            'ui' => 0,
                            'return_format' => 'value',
                            'ajax' => 0,
                            'placeholder' => ''
                        ),
                        array(
                            'key' => 'field_small_hero_height',
                            'label' => 'Section Height',
                            'name' => 'section_height',
                            'type' => 'select',
                            'instructions' => 'Choose the height of the hero section',
                            'required' => 0,
                            'choices' => array(
                                'small' => 'Small (200px)',
                                'medium' => 'Medium (300px)',
                                'large' => 'Large (400px)',
                                'xlarge' => 'Extra Large (500px)'
                            ),
                            'default_value' => 'medium',
                            'allow_null' => 0,
                            'multiple' => 0,
                            'ui' => 0,
                            'return_format' => 'value',
                            'ajax' => 0,
                            'placeholder' => ''
                        )
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/small-hero-section'
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