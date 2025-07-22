<?php
/**
 * ACF Field definitions for Careers Section Block
 *
 * @package SX
 */

if (!function_exists('register_careers_acf_fields')) {
    function register_careers_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_careers_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_careers_section',
                    'title' => 'Careers Section',
                    'fields' => array(
                        array(
                            'key' => 'field_careers_section_title',
                            'label' => 'Section Title',
                            'name' => 'section_title',
                            'type' => 'text',
                            'instructions' => 'Title for the careers section',
                            'required' => 0,
                            'default_value' => 'Join Our Team'
                        ),
                        array(
                            'key' => 'field_careers_section_subtitle',
                            'label' => 'Section Subtitle',
                            'name' => 'section_subtitle',
                            'type' => 'text',
                            'instructions' => 'Optional subtitle text',
                            'required' => 0,
                            'default_value' => 'Explore exciting career opportunities'
                        ),
                        array(
                            'key' => 'field_careers_background_color',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'color_picker',
                            'instructions' => 'Choose the background color for the section',
                            'required' => 0,
                            'default_value' => '#ffffff'
                        ),
                        array(
                            'key' => 'field_careers_card_background',
                            'label' => 'Card Background Color',
                            'name' => 'card_background',
                            'type' => 'color_picker',
                            'instructions' => 'Background color for job cards',
                            'required' => 0,
                            'default_value' => '#f9fafb'
                        ),
                        array(
                            'key' => 'field_careers_button_text',
                            'label' => 'Apply Button Text',
                            'name' => 'button_text',
                            'type' => 'text',
                            'instructions' => 'Text for the apply button',
                            'required' => 0,
                            'default_value' => 'Apply Now'
                        ),
                        array(
                            'key' => 'field_careers_contact_page',
                            'label' => 'Contact Page Link',
                            'name' => 'contact_page_link',
                            'type' => 'page_link',
                            'instructions' => 'Select the contact page for applications',
                            'required' => 0,
                            'post_type' => array('page'),
                            'taxonomy' => '',
                            'allow_null' => 0,
                            'allow_archives' => 0,
                            'multiple' => 0
                        ),
                        array(
                            'key' => 'field_careers_positions_limit',
                            'label' => 'Number of Positions',
                            'name' => 'positions_limit',
                            'type' => 'number',
                            'instructions' => 'Maximum number of positions to display (-1 for all)',
                            'required' => 0,
                            'default_value' => -1,
                            'min' => -1,
                            'max' => 30,
                            'step' => 1
                        ),
                        array(
                            'key' => 'field_careers_show_featured_only',
                            'label' => 'Show Featured Only',
                            'name' => 'show_featured_only',
                            'type' => 'true_false',
                            'instructions' => 'Only display featured positions',
                            'required' => 0,
                            'default_value' => 0,
                            'ui' => 1,
                            'ui_on_text' => 'Yes',
                            'ui_off_text' => 'No'
                        ),
                        array(
                            'key' => 'field_careers_empty_message',
                            'label' => 'No Positions Message',
                            'name' => 'empty_message',
                            'type' => 'textarea',
                            'instructions' => 'Message to display when no positions are available',
                            'required' => 0,
                            'default_value' => 'We don\'t have any open positions at the moment, but we\'re always interested in hearing from talented individuals. Please send your CV to careers@company.com',
                            'rows' => 3
                        )
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/careers-section'
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