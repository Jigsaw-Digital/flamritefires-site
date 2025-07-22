<?php
/**
 * ACF Field definitions for FAQ Section Block
 *
 * @package SX
 */

if (!function_exists('register_faq_acf_fields')) {
    function register_faq_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_faq_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_faq_section',
                    'title' => 'FAQ Section',
                    'fields' => array(
                        array(
                            'key' => 'field_faq_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => 'Main title for the FAQ section',
                            'required' => 0,
                            'default_value' => 'FAQs'
                        ),
                        array(
                            'key' => 'field_faq_intro_text',
                            'label' => 'Intro Text',
                            'name' => 'intro_text',
                            'type' => 'textarea',
                            'instructions' => 'Introductory text for the FAQ section',
                            'required' => 0,
                            'default_value' => 'Some answers to questions you may have. Check our FAQ section or if you need further information.'
                        ),
                        array(
                            'key' => 'field_faq_category_filter',
                            'label' => 'Filter by Category',
                            'name' => 'category_filter',
                            'type' => 'taxonomy',
                            'instructions' => 'Select a specific FAQ category to display (leave empty for all)',
                            'required' => 0,
                            'taxonomy' => 'faq_category',
                            'field_type' => 'select',
                            'allow_null' => 1,
                            'add_term' => 0,
                            'save_terms' => 0,
                            'load_terms' => 0,
                            'return_format' => 'id',
                            'multiple' => 0
                        ),
                        array(
                            'key' => 'field_faq_limit',
                            'label' => 'Number of FAQs',
                            'name' => 'faq_limit',
                            'type' => 'number',
                            'instructions' => 'Maximum number of FAQs to display (-1 for all)',
                            'required' => 0,
                            'default_value' => -1,
                            'min' => -1,
                            'max' => 50,
                            'step' => 1
                        ),
                        array(
                            'key' => 'field_faq_columns',
                            'label' => 'Layout Columns',
                            'name' => 'layout_columns',
                            'type' => 'select',
                            'instructions' => 'Number of columns for FAQ layout',
                            'required' => 0,
                            'choices' => array(
                                '1' => 'Single Column',
                                '2' => 'Two Columns'
                            ),
                            'default_value' => '1',
                            'allow_null' => 0
                        ),
                        array(
                            'key' => 'field_faq_expand_first',
                            'label' => 'Expand First Item',
                            'name' => 'expand_first',
                            'type' => 'true_false',
                            'instructions' => 'Automatically expand the first FAQ item',
                            'required' => 0,
                            'default_value' => 0,
                            'ui' => 1,
                            'ui_on_text' => 'Yes',
                            'ui_off_text' => 'No'
                        )
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/faq-section'
                            )
                        )
                    ),
                    'menu_order' => 0,
                    'position' => 'normal',
                    'style' => 'default',
                    'label_placement' => 'top',
                    'instruction_placement' => 'label',
                    'hide_on_screen' => '',
                    'active' => true,
                    'description' => ''
                ));
            }
        }
    }
}
