<?php
/**
 * ACF Field definitions for About Section Block
 *
 * @package SX
 */

if (!function_exists('register_about_acf_fields')) {
    function register_about_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_about_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_about_section',
                    'title' => 'About Section',
                    'fields' => array(
                        array(
                            'key' => 'field_about_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => 'Main title for the about section',
                            'required' => 0,
                            'default_value' => 'Powering'
                        ),
                        array(
                            'key' => 'field_about_subtitle',
                            'label' => 'Subtitle',
                            'name' => 'subtitle',
                            'type' => 'text',
                            'instructions' => 'Subtitle for the about section',
                            'required' => 0,
                            'default_value' => 'up your kitchen'
                        ),
                        array(
                            'key' => 'field_about_content',
                            'label' => 'Content',
                            'name' => 'content',
                            'type' => 'wysiwyg',
                            'instructions' => 'Main content for the about section',
                            'required' => 0,
                            'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In id leo tortor. Integer eget nunc sit amet massa pretium pretium. Cras eu ipsum ac lorem laoreet lacinia. In hac habitasse platea dictumst. Ut vestibulum dolor gravida quam viverra tempus. Praesent nunc libero, ultricies sed nulla et, dignissim fermentum dolor. Maecenas ipsum massa, consectetur id interdum in, tincidunt vel purus.

Maecenas imperdiet tortor mattis massa mollis fermentum. Donec blandit auctor molestie. Pellentesque non dui vel diam dignissim suscipit. Cras dictum nibh in sem bibendum vehicula. Morbi ac felis luctus neque semper pharetra in in arcu. Sed sed risus ac libero malesuada malesuada. Proin tempus diam vitae libero egestas, quis pharetra augue molestie. Donec venenatis pretium arcu eget dignissim.',
                            'tabs' => 'all',
                            'toolbar' => 'full',
                            'media_upload' => 1
                        ),
                        array(
                            'key' => 'field_about_cta',
                            'label' => 'CTA Button',
                            'name' => 'cta',
                            'type' => 'link',
                            'instructions' => 'Call-to-action button',
                            'required' => 0,
                            'return_format' => 'array'
                        ),
                        array(
                            'key' => 'field_about_left_media_type',
                            'label' => 'Left Media Type',
                            'name' => 'left_media_type',
                            'type' => 'select',
                            'instructions' => 'Choose whether to display an image or video on the left side',
                            'required' => 0,
                            'choices' => array(
                                'image' => 'Image',
                                'video' => 'Video'
                            ),
                            'default_value' => 'image',
                            'return_format' => 'value'
                        ),
                        array(
                            'key' => 'field_about_left_image',
                            'label' => 'Left Image',
                            'name' => 'left_image',
                            'type' => 'image',
                            'instructions' => 'Left side image',
                            'required' => 0,
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_about_left_media_type',
                                        'operator' => '==',
                                        'value' => 'image',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_about_left_video',
                            'label' => 'Left Video',
                            'name' => 'left_video',
                            'type' => 'oembed',
                            'instructions' => 'Enter a YouTube, Vimeo, or other video URL to embed on the left side',
                            'required' => 0,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_about_left_media_type',
                                        'operator' => '==',
                                        'value' => 'video',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_about_right_image',
                            'label' => 'Right Image',
                            'name' => 'right_image',
                            'type' => 'image',
                            'instructions' => 'Right side image',
                            'required' => 0,
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all'
                        ),
                        array(
                            'key' => 'field_about_section_title',
                            'label' => 'Section Title',
                            'name' => 'section_title',
                            'type' => 'text',
                            'instructions' => 'Title for the section',
                            'required' => 0,
                            'default_value' => 'In Numbers'
                        )
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/about-section'
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
