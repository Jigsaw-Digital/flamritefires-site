<?php
/**
 * Layout Content Image ACF Field Registration
 */

function register_layout_content_image_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_layout_content_image',
            'title' => 'Layout Content Image',
            'fields' => array(
                // Header Image (shows at top if set)
                array(
                    'key' => 'field_content_image_header_image',
                    'label' => 'Header Image',
                    'name' => 'header_image',
                    'type' => 'image',
                    'instructions' => 'Optional header image that appears above the subtitle and title',
                    'required' => 0,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ),
                
                // Subtitle (shows above title if set)
                array(
                    'key' => 'field_content_image_subtitle',
                    'label' => 'Subtitle',
                    'name' => 'subtitle',
                    'type' => 'text',
                    'instructions' => 'Optional subtitle that appears above the main title',
                    'required' => 0,
                    'default_value' => '',
                    'placeholder' => 'Enter subtitle',
                    'maxlength' => 150,
                ),
                
                // Main Title
                array(
                    'key' => 'field_content_image_title',
                    'label' => 'Title',
                    'name' => 'title',
                    'type' => 'text',
                    'instructions' => 'Main heading for the section',
                    'required' => 1,
                    'default_value' => '',
                    'placeholder' => 'Enter section title',
                    'maxlength' => 100,
                ),
                
                // Content
                array(
                    'key' => 'field_content_image_content',
                    'label' => 'Content',
                    'name' => 'content',
                    'type' => 'wysiwyg',
                    'instructions' => 'Main content for the section',
                    'required' => 1,
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                ),
                
                // Image Direction
                array(
                    'key' => 'field_content_image_direction',
                    'label' => 'Image Direction',
                    'name' => 'image_direction',
                    'type' => 'select',
                    'instructions' => 'Choose which side the main image appears on',
                    'required' => 0,
                    'choices' => array(
                        'right' => 'Right',
                        'left' => 'Left',
                    ),
                    'default_value' => 'right',
                    'allow_null' => 0,
                ),
                
                // Main Image
                array(
                    'key' => 'field_content_image_main',
                    'label' => 'Main Image',
                    'name' => 'main_image',
                    'type' => 'image',
                    'instructions' => 'Upload the main image',
                    'required' => 1,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ),
                
                // Offset Image
                array(
                    'key' => 'field_content_image_offset',
                    'label' => 'Offset Image',
                    'name' => 'offset_image',
                    'type' => 'image',
                    'instructions' => 'Upload the offset image (optional)',
                    'required' => 0,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/layout-content-image',
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