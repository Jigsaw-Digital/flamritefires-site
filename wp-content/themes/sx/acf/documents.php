<?php
/**
 * Documents ACF Fields
 */

function register_documents_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_documents',
            'title' => 'Document Details',
            'fields' => array(
                array(
                    'key' => 'field_document_description',
                    'label' => 'Description',
                    'name' => 'document_description',
                    'type' => 'wysiwyg',
                    'instructions' => 'Enter a description for this document',
                    'required' => 0,
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ),
                array(
                    'key' => 'field_document_file',
                    'label' => 'Document File',
                    'name' => 'document_file',
                    'type' => 'file',
                    'instructions' => 'Upload any file type',
                    'required' => 1,
                    'return_format' => 'array',
                ),
                array(
                    'key' => 'field_document_file_type',
                    'label' => 'File Type',
                    'name' => 'document_file_type',
                    'type' => 'select',
                    'instructions' => 'Select the type of document',
                    'required' => 1,
                    'choices' => array(
                        'pdf' => 'PDF',
                        'word' => 'Word Document',
                        'excel' => 'Excel Spreadsheet',
                        'powerpoint' => 'PowerPoint Presentation',
                        'text' => 'Text Document',
                        'other' => 'Other',
                        'flame_rite_fire_econtrol' => 'Flamerite Fire EControl',
                        'flame_rite_fire_instructions' => 'Flamerite Fire Instructions',
                        'e_fx_instructions' => 'E-FX Instructions',
                        'e_ridium_instructions' => 'E-Ridium Instruction',
                    ),
                    'default_value' => 'pdf',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 1,
                    'return_format' => 'value',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'documents',
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
add_action('acf/init', 'register_documents_acf_fields');