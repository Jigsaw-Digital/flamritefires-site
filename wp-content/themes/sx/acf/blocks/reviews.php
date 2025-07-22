<?php
/**
 * ACF Field definitions for Reviews Section Block
 *
 * @package SX
 */

if (!function_exists('register_reviews_acf_fields')) {
    function register_reviews_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_reviews_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_reviews_section',
                    'title' => 'Reviews Section',
                    'fields' => array(
                        array(
                            'key' => 'field_reviews_section_title',
                            'label' => 'Section Title',
                            'name' => 'section_title',
                            'type' => 'text',
                            'instructions' => 'Title for the reviews section',
                            'required' => 0,
                            'default_value' => 'What Our Clients Say'
                        ),
                        array(
                            'key' => 'field_reviews_section_subtitle',
                            'label' => 'Section Subtitle',
                            'name' => 'section_subtitle',
                            'type' => 'text',
                            'instructions' => 'Optional subtitle text',
                            'required' => 0,
                            'default_value' => ''
                        ),
                        array(
                            'key' => 'field_reviews_background_color',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'color_picker',
                            'instructions' => 'Choose the background color for the section',
                            'required' => 0,
                            'default_value' => '#f3f4f6'
                        ),
                        array(
                            'key' => 'field_reviews_text_color',
                            'label' => 'Text Color',
                            'name' => 'text_color',
                            'type' => 'select',
                            'instructions' => 'Choose text color scheme',
                            'required' => 0,
                            'choices' => array(
                                'dark' => 'Dark Text',
                                'light' => 'Light Text'
                            ),
                            'default_value' => 'dark',
                            'allow_null' => 0
                        ),
                        array(
                            'key' => 'field_reviews_autoplay',
                            'label' => 'Autoplay',
                            'name' => 'autoplay',
                            'type' => 'true_false',
                            'instructions' => 'Enable autoplay for the slider',
                            'required' => 0,
                            'default_value' => 1,
                            'ui' => 1,
                            'ui_on_text' => 'Enabled',
                            'ui_off_text' => 'Disabled'
                        ),
                        array(
                            'key' => 'field_reviews_autoplay_speed',
                            'label' => 'Autoplay Speed',
                            'name' => 'autoplay_speed',
                            'type' => 'number',
                            'instructions' => 'Time between slides in milliseconds',
                            'required' => 0,
                            'default_value' => 5000,
                            'min' => 1000,
                            'max' => 10000,
                            'step' => 500,
                            'append' => 'ms',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_reviews_autoplay',
                                        'operator' => '==',
                                        'value' => '1'
                                    )
                                )
                            )
                        ),
                        array(
                            'key' => 'field_reviews_limit',
                            'label' => 'Number of Reviews',
                            'name' => 'reviews_limit',
                            'type' => 'number',
                            'instructions' => 'Maximum number of reviews to display (-1 for all)',
                            'required' => 0,
                            'default_value' => -1,
                            'min' => -1,
                            'max' => 20,
                            'step' => 1
                        )
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/reviews-section'
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