<?php
/**
 * Full Text ACF Field Registration
 */

function register_full_text_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_full_text',
            'title' => 'Full Text',
            'fields' => array(
                array(
                    'key' => 'field_full_text_data',
                    'label' => 'Full Text Data',
                    'name' => 'full_text_data',
                    'type' => 'group',
                    'instructions' => 'Configure full text content section',
                    'required' => 0,
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_full_text_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => 'Optional title for the content section',
                            'required' => 0,
                            'placeholder' => 'Enter title (optional)',
                            'maxlength' => 100,
                        ),
                        array(
                            'key' => 'field_full_text_content',
                            'label' => 'Content',
                            'name' => 'content',
                            'type' => 'wysiwyg',
                            'instructions' => 'Add your full text content (terms, policies, etc.)',
                            'required' => 1,
                            'tabs' => 'all',
                            'toolbar' => 'full',
                            'media_upload' => 1,
                        ),
                        array(
                            'key' => 'field_full_text_background',
                            'label' => 'Background Style',
                            'name' => 'background_style',
                            'type' => 'select',
                            'instructions' => 'Choose the background style',
                            'required' => 0,
                            'choices' => array(
                                'white' => 'White Background',
                                'gray' => 'Light Gray Background',
                                'tertiary' => 'Tertiary Color Background',
                            ),
                            'default_value' => 'white',
                            'allow_null' => 0,
                            'multiple' => 0,
                            'ui' => 1,
                            'return_format' => 'value',
                        ),
                        array(
                            'key' => 'field_full_text_padding',
                            'label' => 'Padding',
                            'name' => 'padding',
                            'type' => 'select',
                            'instructions' => 'Choose the section padding',
                            'required' => 0,
                            'choices' => array(
                                'normal' => 'Normal (16px top/bottom)',
                                'large' => 'Large (24px top/bottom)',
                                'none' => 'No Padding',
                            ),
                            'default_value' => 'normal',
                            'allow_null' => 0,
                            'multiple' => 0,
                            'ui' => 1,
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
                        'value' => 'acf/full-text',
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
add_action('acf/init', 'register_full_text_acf_fields');