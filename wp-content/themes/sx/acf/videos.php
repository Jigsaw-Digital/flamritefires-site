<?php
/**
 * Videos ACF Fields
 */

function register_videos_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_videos',
            'title' => 'Video Details',
            'fields' => array(
                array(
                    'key' => 'field_video_description',
                    'label' => 'Description',
                    'name' => 'video_description',
                    'type' => 'wysiwyg',
                    'instructions' => 'Enter a description for this video',
                    'required' => 0,
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ),
                array(
                    'key' => 'field_video_file',
                    'label' => 'Video File',
                    'name' => 'video_file',
                    'type' => 'file',
                    'instructions' => 'Upload any file type',
                    'required' => 1,
                    'return_format' => 'array',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'videos',
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

// Register the fields
add_action('acf/init', 'register_videos_acf_fields');