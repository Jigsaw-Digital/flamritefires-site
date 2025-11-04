<?php
/**
 * Layout Selected Videos ACF Field Registration
 */

function register_layout_selected_videos_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_layout_selected_videos',
            'title' => 'Layout Selected Videos',
            'fields' => array(
                array(
                    'key' => 'field_layout_selected_videos_data',
                    'label' => 'Selected Videos Data',
                    'name' => 'layout_selected_videos_data',
                    'type' => 'group',
                    'instructions' => 'Configure selected videos section',
                    'required' => 0,
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_selected_videos_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => 'Section title (optional)',
                            'required' => 0,
                            'default_value' => 'Related Videos',
                            'placeholder' => 'Related Videos',
                        ),
                        array(
                            'key' => 'field_selected_videos_description',
                            'label' => 'Description',
                            'name' => 'description',
                            'type' => 'textarea',
                            'instructions' => 'Optional description text',
                            'required' => 0,
                            'rows' => 3,
                        ),
                        array(
                            'key' => 'field_selected_videos_selection',
                            'label' => 'Select Videos',
                            'name' => 'videos_selection',
                            'type' => 'post_object',
                            'instructions' => 'Select which videos to display',
                            'required' => 1,
                            'post_type' => array('videos'),
                            'taxonomy' => array(),
                            'allow_null' => 0,
                            'multiple' => 1,
                            'return_format' => 'object',
                            'ui' => 1,
                        ),
                        array(
                            'key' => 'field_selected_videos_columns',
                            'label' => 'Columns',
                            'name' => 'columns',
                            'type' => 'select',
                            'instructions' => 'Number of columns for video grid',
                            'required' => 0,
                            'choices' => array(
                                '2' => '2 Columns',
                                '3' => '3 Columns',
                                '4' => '4 Columns',
                            ),
                            'default_value' => '3',
                            'allow_null' => 0,
                            'multiple' => 0,
                            'ui' => 0,
                            'return_format' => 'value',
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/layout-selected-videos',
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
add_action('acf/init', 'register_layout_selected_videos_acf_fields');
