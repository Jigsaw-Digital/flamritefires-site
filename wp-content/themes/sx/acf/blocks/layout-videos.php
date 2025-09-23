<?php
/**
 * Layout Videos ACF Field Registration
 */

function register_layout_videos_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_layout_videos',
            'title' => 'Layout Videos',
            'fields' => array(
                array(
                    'key' => 'field_layout_videos_data',
                    'label' => 'Videos Data',
                    'name' => 'layout_videos_data',
                    'type' => 'group',
                    'instructions' => 'Configure videos section',
                    'required' => 0,
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_videos_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => 'Page/section title',
                            'required' => 1,
                            'default_value' => 'Videos',
                            'placeholder' => 'Enter title',
                            'maxlength' => 100,
                        ),
                        array(
                            'key' => 'field_videos_description',
                            'label' => 'Description',
                            'name' => 'description',
                            'type' => 'wysiwyg',
                            'instructions' => 'Description for the videos section',
                            'required' => 0,
                            'tabs' => 'all',
                            'toolbar' => 'full',
                            'media_upload' => 0,
                        ),
                        array(
                            'key' => 'field_videos_selection_type',
                            'label' => 'Video Selection Method',
                            'name' => 'videos_selection_type',
                            'type' => 'radio',
                            'instructions' => 'Choose how to select videos to display',
                            'required' => 1,
                            'choices' => array(
                                'all' => 'Show all videos',
                                'manual' => 'Manually select specific videos',
                            ),
                            'default_value' => 'all',
                            'layout' => 'vertical',
                        ),
                        array(
                            'key' => 'field_videos_selection',
                            'label' => 'Select Videos',
                            'name' => 'videos_selection',
                            'type' => 'post_object',
                            'instructions' => 'Manually select specific videos to display',
                            'required' => 0,
                            'post_type' => array('videos'),
                            'taxonomy' => array(),
                            'allow_null' => 1,
                            'multiple' => 1,
                            'return_format' => 'object',
                            'ui' => 1,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_videos_selection_type',
                                        'operator' => '==',
                                        'value' => 'manual',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_videos_limit',
                            'label' => 'Number of Videos',
                            'name' => 'videos_limit',
                            'type' => 'number',
                            'instructions' => 'Maximum number of videos to display (-1 for unlimited)',
                            'required' => 0,
                            'default_value' => 12,
                            'min' => -1,
                            'max' => 100,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_videos_selection_type',
                                        'operator' => '!=',
                                        'value' => 'manual',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_videos_columns',
                            'label' => 'Columns',
                            'name' => 'columns',
                            'type' => 'select',
                            'instructions' => 'Number of columns to display videos in',
                            'required' => 0,
                            'choices' => array(
                                '2' => '2 Columns',
                                '3' => '3 Columns',
                                '4' => '4 Columns',
                            ),
                            'default_value' => '3',
                            'allow_null' => 0,
                            'multiple' => 0,
                            'ui' => 1,
                            'return_format' => 'value',
                        ),
                        array(
                            'key' => 'field_videos_show_duration',
                            'label' => 'Show Video Duration',
                            'name' => 'show_duration',
                            'type' => 'true_false',
                            'instructions' => 'Display video duration overlay on thumbnails',
                            'required' => 0,
                            'default_value' => 1,
                            'ui' => 1,
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/layout-videos',
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
add_action('acf/init', 'register_layout_videos_acf_fields');