<?php
/**
 * Dynamic Hero ACF Field Registration
 */

function register_dynamic_hero_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_dynamic_hero',
            'title' => 'Dynamic Hero Settings',
            'fields' => array(
                // General Settings Tab
                array(
                    'key' => 'field_dynamic_hero_general_tab',
                    'label' => 'General Settings',
                    'name' => 'general_tab',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_dynamic_hero_small',
                    'label' => 'Small Hero',
                    'name' => 'small_hero',
                    'type' => 'true_false',
                    'instructions' => 'Enable for small hero variant',
                    'required' => 0,
                    'default_value' => 0,
                    'ui' => 1,
                    'ui_on_text' => 'Yes',
                    'ui_off_text' => 'No',
                ),
                array(
                    'key' => 'field_dynamic_hero_show_divider',
                    'label' => 'Show Title Divider',
                    'name' => 'show_divider',
                    'type' => 'true_false',
                    'instructions' => 'Show horizontal line under title',
                    'required' => 0,
                    'default_value' => 1,
                    'ui' => 1,
                    'ui_on_text' => 'Yes',
                    'ui_off_text' => 'No',
                ),
                
                // Media Tab
                array(
                    'key' => 'field_dynamic_hero_media_tab',
                    'label' => 'Background Media',
                    'name' => 'media_tab',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_dynamic_hero_media_type',
                    'label' => 'Media Type',
                    'name' => 'media_type',
                    'type' => 'radio',
                    'instructions' => 'Choose between image or video background',
                    'required' => 1,
                    'choices' => array(
                        'image' => 'Image',
                        'video' => 'Video',
                    ),
                    'default_value' => 'image',
                    'layout' => 'horizontal',
                ),
                array(
                    'key' => 'field_dynamic_hero_background_image',
                    'label' => 'Background Image',
                    'name' => 'background_image',
                    'type' => 'image',
                    'instructions' => 'Upload background image',
                    'required' => 1,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_dynamic_hero_media_type',
                                'operator' => '==',
                                'value' => 'image',
                            ),
                        ),
                    ),
                ),
                array(
                    'key' => 'field_dynamic_hero_video_source',
                    'label' => 'Video Source',
                    'name' => 'video_source',
                    'type' => 'radio',
                    'instructions' => 'Choose video source type',
                    'required' => 1,
                    'choices' => array(
                        'upload' => 'Upload File',
                        'url' => 'External URL',
                    ),
                    'default_value' => 'upload',
                    'layout' => 'horizontal',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_dynamic_hero_media_type',
                                'operator' => '==',
                                'value' => 'video',
                            ),
                        ),
                    ),
                ),
                array(
                    'key' => 'field_dynamic_hero_video_file',
                    'label' => 'Video File',
                    'name' => 'video_file',
                    'type' => 'file',
                    'instructions' => 'Upload video file (MP4 format recommended)',
                    'required' => 1,
                    'return_format' => 'array',
                    'library' => 'all',
                    'mime_types' => 'mp4,webm,ogg',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_dynamic_hero_media_type',
                                'operator' => '==',
                                'value' => 'video',
                            ),
                            array(
                                'field' => 'field_dynamic_hero_video_source',
                                'operator' => '==',
                                'value' => 'upload',
                            ),
                        ),
                    ),
                ),
                array(
                    'key' => 'field_dynamic_hero_video_url',
                    'label' => 'Video URL',
                    'name' => 'video_url',
                    'type' => 'url',
                    'instructions' => 'Enter video URL (MP4 format recommended)',
                    'required' => 1,
                    'default_value' => '',
                    'placeholder' => 'https://example.com/video.mp4',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_dynamic_hero_media_type',
                                'operator' => '==',
                                'value' => 'video',
                            ),
                            array(
                                'field' => 'field_dynamic_hero_video_source',
                                'operator' => '==',
                                'value' => 'url',
                            ),
                        ),
                    ),
                ),
                array(
                    'key' => 'field_dynamic_hero_overlay_opacity',
                    'label' => 'Overlay Opacity',
                    'name' => 'overlay_opacity',
                    'type' => 'range',
                    'instructions' => 'Darkness level of overlay (0-80%)',
                    'required' => 0,
                    'default_value' => 40,
                    'min' => 0,
                    'max' => 80,
                    'step' => 10,
                    'append' => '%',
                ),
                
                // Content Tab
                array(
                    'key' => 'field_dynamic_hero_content_tab',
                    'label' => 'Content',
                    'name' => 'content_tab',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_dynamic_hero_title',
                    'label' => 'Hero Title',
                    'name' => 'hero_title',
                    'type' => 'text',
                    'instructions' => 'Main heading for the hero section',
                    'required' => 0,
                    'default_value' => '',
                    'placeholder' => 'Enter hero title',
                    'maxlength' => 150,
                ),
                array(
                    'key' => 'field_dynamic_hero_subtitle',
                    'label' => 'Hero Subtitle',
                    'name' => 'hero_subtitle',
                    'type' => 'text',
                    'instructions' => 'Subtitle for the hero section',
                    'required' => 0,
                    'default_value' => '',
                    'placeholder' => 'Enter hero subtitle',
                    'maxlength' => 200,
                ),
                array(
                    'key' => 'field_dynamic_hero_description',
                    'label' => 'Hero Description',
                    'name' => 'hero_description',
                    'type' => 'wysiwyg',
                    'instructions' => 'Additional description text',
                    'required' => 0,
                    'tabs' => 'visual,text',
                    'toolbar' => 'basic',
                    'media_upload' => 0,
                    'delay' => 0,
                ),
                array(
                    'key' => 'field_dynamic_hero_primary_cta',
                    'label' => 'Primary Call to Action',
                    'name' => 'primary_cta',
                    'type' => 'link',
                    'instructions' => 'Primary button link',
                    'required' => 0,
                    'return_format' => 'array',
                ),
                array(
                    'key' => 'field_dynamic_hero_secondary_cta',
                    'label' => 'Secondary Call to Action',
                    'name' => 'secondary_cta',
                    'type' => 'link',
                    'instructions' => 'Secondary button link',
                    'required' => 0,
                    'return_format' => 'array',
                ),
                
                // Contact Form Tab
                array(
                    'key' => 'field_dynamic_hero_form_tab',
                    'label' => 'Contact Form',
                    'name' => 'form_tab',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_dynamic_hero_show_contact_form',
                    'label' => 'Show Contact Form',
                    'name' => 'show_contact_form',
                    'type' => 'true_false',
                    'instructions' => 'Display contact form on right side (desktop only)',
                    'required' => 0,
                    'default_value' => 0,
                    'ui' => 1,
                    'ui_on_text' => 'Yes',
                    'ui_off_text' => 'No',
                ),
                array(
                    'key' => 'field_dynamic_hero_contact_form_title',
                    'label' => 'Contact Form Title',
                    'name' => 'contact_form_title',
                    'type' => 'text',
                    'instructions' => 'Title for the contact form',
                    'required' => 0,
                    'default_value' => 'Get In Touch',
                    'placeholder' => 'Enter form title',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_dynamic_hero_show_contact_form',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
                ),
                array(
                    'key' => 'field_dynamic_hero_contact_form_button',
                    'label' => 'Contact Form Button Text',
                    'name' => 'contact_form_button',
                    'type' => 'text',
                    'instructions' => 'Text for the submit button',
                    'required' => 0,
                    'default_value' => 'Submit',
                    'placeholder' => 'Enter button text',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_dynamic_hero_show_contact_form',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/dynamic-hero',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
        ));
    }
}