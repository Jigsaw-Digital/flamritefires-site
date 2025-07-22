<?php
/**
 * ACF Field definitions for Welcome Section Block
 *
 * @package SX
 */

if (!function_exists('register_welcome_acf_fields')) {
    function register_welcome_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_welcome_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_welcome_section',
                    'title' => 'Welcome Section',
                    'fields' => array(
                        array(
                            'key' => 'field_welcome_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => 'Title for the welcome section',
                            'required' => 0,
                            'default_value' => 'Welcome to'
                        ),
                        array(
                            'key' => 'field_welcome_subtitle',
                            'label' => 'Subtitle',
                            'name' => 'subtitle',
                            'type' => 'text',
                            'instructions' => 'Subtitle shown in accent color',
                            'required' => 0,
                            'default_value' => 'Asset Management'
                        ),
                        array(
                            'key' => 'field_welcome_content',
                            'label' => 'Content',
                            'name' => 'content',
                            'type' => 'wysiwyg',
                            'instructions' => 'Main text content',
                            'required' => 0,
                            'default_value' => 'Keeping your kitchen and catering facilities in optimal working order, so you can focus on what you do best. Our range of Asset Management services offer extensive protection and support for commercial kitchens.',
                            'tabs' => 'all',
                            'toolbar' => 'full',
                            'media_upload' => 1,
                            'delay' => 0
                        ),
                        array(
                            'key' => 'field_welcome_cta',
                            'label' => 'CTA Button',
                            'name' => 'cta',
                            'type' => 'link',
                            'instructions' => 'Call-to-action button',
                            'required' => 0,
                            'return_format' => 'array'
                        ),
                        array(
                            'key' => 'field_welcome_image',
                            'label' => 'Image',
                            'name' => 'image',
                            'type' => 'image',
                            'instructions' => 'Right side image',
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
                                'value' => 'acf/welcome-section'
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
