<?php
/**
 * ACF Field definitions for Intro Section Block
 *
 * @package SX
 */

if (!function_exists('register_intro_acf_fields')) {
    function register_intro_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_intro_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_intro_section',
                    'title' => 'Intro Section',
                    'fields' => array(
                        array(
                            'key' => 'field_intro_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => 'Title for the intro section (top line)',
                            'required' => 0,
                            'default_value' => 'Welcome to'
                        ),
                        array(
                            'key' => 'field_intro_subtitle',
                            'label' => 'Subtitle',
                            'name' => 'subtitle',
                            'type' => 'text',
                            'instructions' => 'Subtitle shown in bold',
                            'required' => 0,
                            'default_value' => 'Asset Management'
                        ),
                        array(
                            'key' => 'field_intro_tagline',
                            'label' => 'Tagline',
                            'name' => 'tagline',
                            'type' => 'text',
                            'instructions' => 'Tagline shown in red (e.g., "by Advance")',
                            'required' => 0,
                            'default_value' => 'by Advance'
                        ),
                        array(
                            'key' => 'field_intro_content',
                            'label' => 'Content',
                            'name' => 'content',
                            'type' => 'wysiwyg',
                            'instructions' => 'Main text content',
                            'required' => 0,
                            'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In id leo tortor. Integer eget nunc sit amet massa pretium pretium. Cras eu ipsum ac lorem laoreet lacinia. In hac habitasse platea dictumst.',
                            'tabs' => 'all',
                            'toolbar' => 'full',
                            'media_upload' => 1,
                            'delay' => 0
                        ),
                        array(
                            'key' => 'field_intro_cta',
                            'label' => 'CTA Button',
                            'name' => 'cta',
                            'type' => 'link',
                            'instructions' => 'Call-to-action button',
                            'required' => 0,
                            'return_format' => 'array',
                            'default_value' => array(
                                'title' => 'TALK TO US',
                                'url' => '#',
                                'target' => ''
                            )
                        ),
                        array(
                            'key' => 'field_intro_media_type',
                            'label' => 'Right Media Type',
                            'name' => 'media_type',
                            'type' => 'select',
                            'instructions' => 'Choose whether to display an image or video on the right side',
                            'required' => 0,
                            'choices' => array(
                                'image' => 'Image',
                                'video' => 'Video'
                            ),
                            'default_value' => 'image',
                            'return_format' => 'value'
                        ),
                        array(
                            'key' => 'field_intro_image',
                            'label' => 'Right Image',
                            'name' => 'image',
                            'type' => 'image',
                            'instructions' => 'Right side image',
                            'required' => 0,
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_intro_media_type',
                                        'operator' => '==',
                                        'value' => 'image',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_intro_video',
                            'label' => 'Right Video',
                            'name' => 'video',
                            'type' => 'oembed',
                            'instructions' => 'Enter a YouTube, Vimeo, or other video URL to embed on the right side',
                            'required' => 0,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_intro_media_type',
                                        'operator' => '==',
                                        'value' => 'video',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_intro_background_color',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'color_picker',
                            'instructions' => 'Choose a background color for the left side (default: white)',
                            'required' => 0,
                            'default_value' => '#ffffff'
                        ),
                        array(
                            'key' => 'field_intro_accent_color',
                            'label' => 'Accent Color',
                            'name' => 'accent_color',
                            'type' => 'color_picker',
                            'instructions' => 'Choose an accent color for highlights and tagline (default: red)',
                            'required' => 0,
                            'default_value' => '#ef4444'
                        )
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/intro-section'
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
add_action('acf/init', 'register_intro_acf_fields');
