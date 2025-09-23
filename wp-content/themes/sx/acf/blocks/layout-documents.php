<?php
/**
 * Layout Documents ACF Field Registration
 */

function register_layout_documents_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_layout_documents',
            'title' => 'Layout Documents',
            'fields' => array(
                array(
                    'key' => 'field_layout_documents_data',
                    'label' => 'Documents Data',
                    'name' => 'layout_documents_data',
                    'type' => 'group',
                    'instructions' => 'Configure documents section',
                    'required' => 0,
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_documents_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => 'Page/section title',
                            'required' => 1,
                            'default_value' => 'Documents',
                            'placeholder' => 'Enter title',
                            'maxlength' => 100,
                        ),
                        array(
                            'key' => 'field_documents_description',
                            'label' => 'Description',
                            'name' => 'description',
                            'type' => 'wysiwyg',
                            'instructions' => 'Description for the documents section',
                            'required' => 0,
                            'tabs' => 'all',
                            'toolbar' => 'full',
                            'media_upload' => 0,
                        ),
                        array(
                            'key' => 'field_documents_selection_type',
                            'label' => 'Document Selection Method',
                            'name' => 'documents_selection_type',
                            'type' => 'radio',
                            'instructions' => 'Choose how to select documents to display',
                            'required' => 1,
                            'choices' => array(
                                'all' => 'Show all documents',
                                'manual' => 'Manually select specific documents',
                                'by_type' => 'Filter by document type',
                            ),
                            'default_value' => 'all',
                            'layout' => 'vertical',
                        ),
                        array(
                            'key' => 'field_documents_type_filter',
                            'label' => 'Document Type Filter',
                            'name' => 'documents_type_filter',
                            'type' => 'select',
                            'instructions' => 'Select the document type to filter by',
                            'required' => 1,
                            'choices' => array(
                                'pdf' => 'PDF',
                                'word' => 'Word Document',
                                'excel' => 'Excel Spreadsheet',
                                'powerpoint' => 'PowerPoint Presentation',
                                'text' => 'Text Document',
                                'other' => 'Other',
                            ),
                            'allow_null' => 0,
                            'multiple' => 0,
                            'ui' => 1,
                            'return_format' => 'value',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_documents_selection_type',
                                        'operator' => '==',
                                        'value' => 'by_type',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_documents_selection',
                            'label' => 'Select Documents',
                            'name' => 'documents_selection',
                            'type' => 'post_object',
                            'instructions' => 'Manually select specific documents to display',
                            'required' => 0,
                            'post_type' => array('documents'),
                            'taxonomy' => array(),
                            'allow_null' => 1,
                            'multiple' => 1,
                            'return_format' => 'object',
                            'ui' => 1,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_documents_selection_type',
                                        'operator' => '==',
                                        'value' => 'manual',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_documents_limit',
                            'label' => 'Number of Documents',
                            'name' => 'documents_limit',
                            'type' => 'number',
                            'instructions' => 'Maximum number of documents to display (-1 for unlimited)',
                            'required' => 0,
                            'default_value' => 12,
                            'min' => -1,
                            'max' => 100,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_documents_selection_type',
                                        'operator' => '!=',
                                        'value' => 'manual',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_documents_show_file_type',
                            'label' => 'Show File Type Badge',
                            'name' => 'show_file_type',
                            'type' => 'true_false',
                            'instructions' => 'Display file type badge on each document',
                            'required' => 0,
                            'default_value' => 1,
                            'ui' => 1,
                        ),
                        array(
                            'key' => 'field_documents_columns',
                            'label' => 'Columns',
                            'name' => 'columns',
                            'type' => 'select',
                            'instructions' => 'Number of columns to display documents in',
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
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/layout-documents',
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
add_action('acf/init', 'register_layout_documents_acf_fields');