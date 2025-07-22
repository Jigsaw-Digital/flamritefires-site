<?php
/**
 * ACF Field definitions for Awards Section Block
 *
 * @package SX
 */

if (!function_exists('register_awards_acf_fields')) {
    function register_awards_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_awards_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_awards_section',
                    'title' => 'Awards Section',
                    'fields' => array(
                        array(
                            'key' => 'field_awards_title',
                            'label' => 'Section Title',
                            'name' => 'section_title',
                            'type' => 'text',
                            'instructions' => 'Main title for the awards section',
                            'required' => 0,
                            'default_value' => 'Our Awards'
                        ),
                        array(
                            'key' => 'field_awards_subtitle',
                            'label' => 'Section Subtitle',
                            'name' => 'section_subtitle',
                            'type' => 'textarea',
                            'instructions' => 'Subtitle text below the main title',
                            'required' => 0,
                            'default_value' => 'Judged as Experts by professionals, brands, independents, chains and associations across the sector.',
                            'rows' => 3
                        ),
                        array(
                            'key' => 'field_awards_list',
                            'label' => 'Awards List',
                            'name' => 'awards_list',
                            'type' => 'repeater',
                            'instructions' => 'Add awards to display in the list',
                            'required' => 1,
                            'min' => 1,
                            'layout' => 'block',
                            'button_label' => 'Add Award',
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_award_year',
                                    'label' => 'Year',
                                    'name' => 'year',
                                    'type' => 'text',
                                    'instructions' => 'Year of the award (e.g., 2024)',
                                    'required' => 1,
                                ),
                                array(
                                    'key' => 'field_award_title',
                                    'label' => 'Award Title',
                                    'name' => 'title',
                                    'type' => 'text',
                                    'instructions' => 'Title of the award',
                                    'required' => 1,
                                ),
                                array(
                                    'key' => 'field_award_winner_text',
                                    'label' => 'Winner Text',
                                    'name' => 'winner_text',
                                    'type' => 'text',
                                    'instructions' => 'Text to display for winner status (e.g., "Winner", "Finalist")',
                                    'required' => 0,
                                    'default_value' => 'Winner'
                                ),
                                array(
                                    'key' => 'field_award_highlight',
                                    'label' => 'Highlight Award',
                                    'name' => 'highlight',
                                    'type' => 'true_false',
                                    'instructions' => 'Highlight this award in the list',
                                    'required' => 0,
                                    'default_value' => 0,
                                    'ui' => 1
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_awards_image',
                            'label' => 'Right Side Image',
                            'name' => 'right_image',
                            'type' => 'image',
                            'instructions' => 'Image to display on the right side',
                            'required' => 0,
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all'
                        ),
                        array(
                            'key' => 'field_awards_accent_color',
                            'label' => 'Accent Color',
                            'name' => 'accent_color',
                            'type' => 'color_picker',
                            'instructions' => 'Color for highlighted text and elements',
                            'required' => 0,
                            'default_value' => '#ef4444'
                        ),
                        array(
                            'key' => 'field_awards_background_color',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'color_picker',
                            'instructions' => 'Background color for the section',
                            'required' => 0,
                            'default_value' => '#ffffff'
                        ),
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/awards-section'
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

// Register the fields
add_action('acf/init', 'register_awards_acf_fields');
