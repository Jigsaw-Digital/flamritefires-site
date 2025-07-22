<?php
/**
 * Layout Product ACF Field Registration
 */

function register_layout_product_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_layout_product',
            'title' => 'Layout Product',
            'fields' => array(
                array(
                    'key' => 'field_layout_product_data',
                    'label' => 'Product Data',
                    'name' => 'layout_product_data',
                    'type' => 'group',
                    'instructions' => 'Configure product showcase section',
                    'required' => 0,
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_product_image_slider',
                            'label' => 'Image Slider',
                            'name' => 'image_slider',
                            'type' => 'gallery',
                            'instructions' => 'Add product images for the slider',
                            'required' => 1,
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'insert' => 'append',
                            'library' => 'all',
                            'min' => 1,
                            'max' => 10,
                        ),
                        array(
                            'key' => 'field_product_description_1',
                            'label' => 'Description 1',
                            'name' => 'description_1',
                            'type' => 'wysiwyg',
                            'instructions' => 'First description section',
                            'required' => 1,
                            'tabs' => 'all',
                            'toolbar' => 'full',
                            'media_upload' => 0,
                        ),
                        array(
                            'key' => 'field_product_description_2',
                            'label' => 'Description 2',
                            'name' => 'description_2',
                            'type' => 'wysiwyg',
                            'instructions' => 'Second description section',
                            'required' => 1,
                            'tabs' => 'all',
                            'toolbar' => 'full',
                            'media_upload' => 0,
                        ),
                        array(
                            'key' => 'field_product_video',
                            'label' => 'Video',
                            'name' => 'video',
                            'type' => 'file',
                            'instructions' => 'Upload a video file (optional)',
                            'required' => 0,
                            'return_format' => 'array',
                            'library' => 'all',
                            'mime_types' => 'mp4,webm,ogg',
                        ),
                        array(
                            'key' => 'field_product_cta_title',
                            'label' => 'CTA Title',
                            'name' => 'cta_title',
                            'type' => 'text',
                            'instructions' => 'Call to action title (optional)',
                            'required' => 0,
                            'default_value' => 'Discover the Best of Italian Design',
                            'placeholder' => 'Enter CTA title',
                            'maxlength' => 100,
                        ),
                        array(
                            'key' => 'field_product_cta_description',
                            'label' => 'CTA Description',
                            'name' => 'cta_description',
                            'type' => 'textarea',
                            'instructions' => 'Call to action description (optional)',
                            'required' => 0,
                            'rows' => 3,
                            'new_lines' => '',
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/layout-product',
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