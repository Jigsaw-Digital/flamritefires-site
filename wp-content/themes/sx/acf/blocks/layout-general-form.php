<?php
/**
 * Layout General Form ACF Field Registration
 */

function register_layout_general_form_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_layout_general_form',
            'title' => 'Layout General Form',
            'fields' => array(
                array(
                    'key' => 'field_layout_general_form_data',
                    'label' => 'General Form Data',
                    'name' => 'layout_general_form_data',
                    'type' => 'group',
                    'instructions' => 'Configure general form section content',
                    'required' => 0,
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_general_form_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => 'Section title (optional)',
                            'required' => 0,
                            'default_value' => '',
                        ),
                        array(
                            'key' => 'field_general_form_description',
                            'label' => 'Description',
                            'name' => 'description',
                            'type' => 'wysiwyg',
                            'instructions' => 'Section description (optional)',
                            'required' => 0,
                            'tabs' => 'visual',
                            'toolbar' => 'basic',
                            'media_upload' => 0,
                        ),
                        array(
                            'key' => 'field_general_form_type',
                            'label' => 'Form Type',
                            'name' => 'form_type',
                            'type' => 'select',
                            'instructions' => 'Select which form to display',
                            'required' => 1,
                            'choices' => array(
                                'download-brochure' => 'Download a Brochure',
                            ),
                            'default_value' => 'download-brochure',
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
                        'value' => 'acf/layout-general-form',
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
