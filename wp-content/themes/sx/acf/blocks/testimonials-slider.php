<?php
/**
 * Testimonials Slider Block ACF Fields
 */

function register_testimonials_slider_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_testimonials_slider',
            'title' => 'Testimonials Slider Settings',
            'fields' => array(
                // Content Tab
                array(
                    'key' => 'field_testimonials_content_tab',
                    'label' => 'Content',
                    'name' => 'content_tab',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_testimonials_subtitle',
                    'label' => 'Section Subtitle',
                    'name' => 'section_subtitle',
                    'type' => 'text',
                    'instructions' => 'Small text above the main title',
                    'required' => 0,
                    'default_value' => 'TESTIMONIALS',
                    'placeholder' => 'Enter subtitle',
                ),
                array(
                    'key' => 'field_testimonials_title',
                    'label' => 'Section Title',
                    'name' => 'section_title',
                    'type' => 'text',
                    'instructions' => 'Main heading for the testimonials section',
                    'required' => 0,
                    'default_value' => 'SOME WORDS FROM OUR CUSTOMERS',
                    'placeholder' => 'Enter main title',
                ),
                
                // Display Settings Tab
                array(
                    'key' => 'field_testimonials_display_tab',
                    'label' => 'Display Settings',
                    'name' => 'display_tab',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_testimonials_filter_type',
                    'label' => 'Testimonials to Show',
                    'name' => 'filter_type',
                    'type' => 'radio',
                    'instructions' => 'Choose which testimonials to display',
                    'required' => 1,
                    'choices' => array(
                        'all' => 'All Testimonials',
                        'featured' => 'Featured Only',
                        'latest' => 'Latest Testimonials',
                    ),
                    'default_value' => 'all',
                    'layout' => 'vertical',
                ),
                array(
                    'key' => 'field_testimonials_limit',
                    'label' => 'Number of Testimonials',
                    'name' => 'testimonials_limit',
                    'type' => 'number',
                    'instructions' => 'Maximum number of testimonials to show (leave blank for all)',
                    'required' => 0,
                    'default_value' => '',
                    'placeholder' => '6',
                    'min' => 1,
                    'max' => 20,
                ),
                array(
                    'key' => 'field_testimonials_autoplay',
                    'label' => 'Autoplay Slider',
                    'name' => 'autoplay',
                    'type' => 'true_false',
                    'instructions' => 'Automatically advance slides',
                    'required' => 0,
                    'default_value' => 1,
                    'ui' => 1,
                    'ui_on_text' => 'Yes',
                    'ui_off_text' => 'No',
                ),
                array(
                    'key' => 'field_testimonials_autoplay_delay',
                    'label' => 'Autoplay Delay',
                    'name' => 'autoplay_delay',
                    'type' => 'number',
                    'instructions' => 'Delay between slides in milliseconds',
                    'required' => 0,
                    'default_value' => 5000,
                    'min' => 1000,
                    'max' => 10000,
                    'step' => 500,
                    'append' => 'ms',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_testimonials_autoplay',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
                ),
                
                // Style Settings Tab
                array(
                    'key' => 'field_testimonials_style_tab',
                    'label' => 'Style Settings',
                    'name' => 'style_tab',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
                array(
                    'key' => 'field_testimonials_background_color',
                    'label' => 'Background Color',
                    'name' => 'background_color',
                    'type' => 'radio',
                    'instructions' => 'Choose background color for the section',
                    'required' => 1,
                    'choices' => array(
                        'dark' => 'Dark Background',
                        'light' => 'Light Background',
                        'primary' => 'Primary Color',
                    ),
                    'default_value' => 'dark',
                    'layout' => 'horizontal',
                ),
                array(
                    'key' => 'field_testimonials_show_stars',
                    'label' => 'Show Star Ratings',
                    'name' => 'show_stars',
                    'type' => 'true_false',
                    'instructions' => 'Display star ratings for testimonials',
                    'required' => 0,
                    'default_value' => 1,
                    'ui' => 1,
                    'ui_on_text' => 'Yes',
                    'ui_off_text' => 'No',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/testimonials-slider',
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
add_action('acf/init', 'register_testimonials_slider_acf_fields');