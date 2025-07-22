<?php
/**
 * Layout Video Hero ACF Field Registration
 */

function register_layout_video_hero_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_layout_video_hero',
            'title' => 'Layout Video Hero',
            'fields' => array(
                array(
                    'key' => 'field_layout_video_hero_data',
                    'label' => 'Video Hero Data',
                    'name' => 'layout_video_hero_data',
                    'type' => 'group',
                    'instructions' => 'Configure video hero section settings and slides',
                    'required' => 0,
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_video_hero_small',
                            'label' => 'Small Hero',
                            'name' => 'small',
                            'type' => 'true_false',
                            'instructions' => 'Enable for small hero variant',
                            'required' => 0,
                            'default_value' => 0,
                            'ui' => 1,
                            'ui_on_text' => 'Yes',
                            'ui_off_text' => 'No',
                        ),
                        array(
                            'key' => 'field_video_hero_slides_count',
                            'label' => 'Number of Slides',
                            'name' => 'slides',
                            'type' => 'number',
                            'instructions' => 'How many video slides to show',
                            'required' => 1,
                            'default_value' => 1,
                            'min' => 1,
                            'max' => 10,
                            'step' => 1,
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/layout-video-hero',
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
        
        // Add dynamic video slide fields
        for ($i = 0; $i < 10; $i++) {
            acf_add_local_field_group(array(
                'key' => 'group_layout_video_hero_slide_' . $i,
                'title' => 'Video Hero Slide ' . ($i + 1),
                'fields' => array(
                    array(
                        'key' => 'field_video_hero_slide_' . $i . '_video',
                        'label' => 'Video URL',
                        'name' => 'slides_' . $i . '_video_url',
                        'type' => 'url',
                        'instructions' => 'Enter video URL for slide ' . ($i + 1),
                        'required' => 1,
                        'default_value' => '',
                        'placeholder' => 'https://example.com/video.mp4',
                    ),
                    array(
                        'key' => 'field_video_hero_slide_' . $i . '_title',
                        'label' => 'Slide Title',
                        'name' => 'slides_' . $i . '_title',
                        'type' => 'text',
                        'instructions' => 'Main heading for slide ' . ($i + 1),
                        'required' => 1,
                        'default_value' => '',
                        'placeholder' => 'Enter slide title',
                        'maxlength' => 100,
                    ),
                    array(
                        'key' => 'field_video_hero_slide_' . $i . '_sub_title',
                        'label' => 'Slide Subtitle',
                        'name' => 'slides_' . $i . '_sub_title',
                        'type' => 'text',
                        'instructions' => 'Subtitle for slide ' . ($i + 1),
                        'required' => 0,
                        'default_value' => '',
                        'placeholder' => 'Enter slide subtitle',
                        'maxlength' => 150,
                    ),
                    array(
                        'key' => 'field_video_hero_slide_' . $i . '_cta',
                        'label' => 'Call to Action',
                        'name' => 'slides_' . $i . '_call_to_action',
                        'type' => 'link',
                        'instructions' => 'Button link for slide ' . ($i + 1),
                        'required' => 0,
                        'return_format' => 'array',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'block',
                            'operator' => '==',
                            'value' => 'acf/layout-video-hero',
                        ),
                    ),
                ),
                'menu_order' => $i + 1,
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
}