<?php
/**
 * Layout Slider ACF Field Registration
 */

function register_layout_slider_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        // Main slider fields - no groups, just individual fields
        $fields = array(
            // General Settings
            array(
                'key' => 'field_slider_title',
                'label' => 'Title',
                'name' => 'slider_title',
                'type' => 'text',
                'instructions' => 'Main heading for the slider',
                'required' => 1,
                'default_value' => '',
                'placeholder' => 'Enter slider title',
                'maxlength' => 100,
            ),
            array(
                'key' => 'field_slider_sub_title',
                'label' => 'Sub Title',
                'name' => 'slider_sub_title',
                'type' => 'text',
                'instructions' => 'Subtitle for the slider',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'Enter slider subtitle',
                'maxlength' => 150,
            ),
            array(
                'key' => 'field_slider_description',
                'label' => 'Description',
                'name' => 'slider_description',
                'type' => 'textarea',
                'instructions' => 'Description text for the slider',
                'required' => 0,
                'rows' => 3,
                'new_lines' => '',
            ),
            array(
                'key' => 'field_slider_slides_count',
                'label' => 'Number of Slides',
                'name' => 'slider_slides_count',
                'type' => 'number',
                'instructions' => 'How many slides to show (1-12)',
                'required' => 1,
                'default_value' => 4,
                'min' => 1,
                'max' => 12,
                'step' => 1,
            ),
        );
        
        // Add individual slide fields (12 slides max)
        for ($i = 1; $i <= 12; $i++) {
            $fields[] = array(
                'key' => 'field_slide_' . $i . '_image',
                'label' => 'Slide ' . $i . ' - Image',
                'name' => 'slide_' . $i . '_image',
                'type' => 'image',
                'instructions' => 'Upload image for slide ' . $i,
                'required' => 0,
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            );
            
            $fields[] = array(
                'key' => 'field_slide_' . $i . '_title',
                'label' => 'Slide ' . $i . ' - Title',
                'name' => 'slide_' . $i . '_title',
                'type' => 'text',
                'instructions' => 'Title for slide ' . $i,
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'Enter slide title',
                'maxlength' => 50,
            );
            
            $fields[] = array(
                'key' => 'field_slide_' . $i . '_link',
                'label' => 'Slide ' . $i . ' - Link',
                'name' => 'slide_' . $i . '_link',
                'type' => 'link',
                'instructions' => 'Link for slide ' . $i,
                'required' => 0,
                'return_format' => 'array',
            );
        }
        
        acf_add_local_field_group(array(
            'key' => 'group_layout_slider',
            'title' => 'Layout Slider',
            'fields' => $fields,
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/layout-slider',
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