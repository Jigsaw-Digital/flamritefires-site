<?php
/**
 * ACF Field definitions for Blog Section Block
 *
 * @package SX
 */

if (!function_exists('register_blog_acf_fields')) {
    function register_blog_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_blog_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_blog_section',
                    'title' => 'Blog Section',
                    'fields' => array(
                        array(
                            'key' => 'field_blog_section_title',
                            'label' => 'Section Title',
                            'name' => 'section_title',
                            'type' => 'text',
                            'instructions' => 'Title for the blog section',
                            'required' => 0,
                            'default_value' => 'Latest News & Insights'
                        ),
                        array(
                            'key' => 'field_blog_section_subtitle',
                            'label' => 'Section Subtitle',
                            'name' => 'section_subtitle',
                            'type' => 'text',
                            'instructions' => 'Optional subtitle text',
                            'required' => 0,
                            'default_value' => 'Stay updated with our latest articles and industry insights'
                        ),
                        array(
                            'key' => 'field_blog_background_color',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'color_picker',
                            'instructions' => 'Choose the background color for the section',
                            'required' => 0,
                            'default_value' => '#ffffff'
                        ),
                        array(
                            'key' => 'field_blog_card_background',
                            'label' => 'Card Background Color',
                            'name' => 'card_background',
                            'type' => 'color_picker',
                            'instructions' => 'Background color for blog cards',
                            'required' => 0,
                            'default_value' => '#f9fafb'
                        ),
                        array(
                            'key' => 'field_blog_button_text',
                            'label' => 'Read More Button Text',
                            'name' => 'button_text',
                            'type' => 'text',
                            'instructions' => 'Text for the read more button',
                            'required' => 0,
                            'default_value' => 'Read More'
                        ),
                        array(
                            'key' => 'field_blog_posts_limit',
                            'label' => 'Number of Posts',
                            'name' => 'posts_limit',
                            'type' => 'number',
                            'instructions' => 'Maximum number of posts to display (-1 for all)',
                            'required' => 0,
                            'default_value' => 6,
                            'min' => -1,
                            'max' => 30,
                            'step' => 1
                        ),
                        array(
                            'key' => 'field_blog_categories',
                            'label' => 'Filter by Categories',
                            'name' => 'filter_categories',
                            'type' => 'taxonomy',
                            'instructions' => 'Select specific categories to display (leave empty for all)',
                            'required' => 0,
                            'taxonomy' => 'category',
                            'field_type' => 'multi_select',
                            'allow_null' => 1,
                            'add_term' => 0,
                            'save_terms' => 0,
                            'load_terms' => 0,
                            'return_format' => 'id',
                            'multiple' => 1
                        ),
                        array(
                            'key' => 'field_blog_show_excerpt',
                            'label' => 'Show Excerpt',
                            'name' => 'show_excerpt',
                            'type' => 'true_false',
                            'instructions' => 'Display post excerpt in cards',
                            'required' => 0,
                            'default_value' => 1,
                            'ui' => 1,
                            'ui_on_text' => 'Yes',
                            'ui_off_text' => 'No'
                        ),
                        array(
                            'key' => 'field_blog_show_author',
                            'label' => 'Show Author',
                            'name' => 'show_author',
                            'type' => 'true_false',
                            'instructions' => 'Display post author',
                            'required' => 0,
                            'default_value' => 1,
                            'ui' => 1,
                            'ui_on_text' => 'Yes',
                            'ui_off_text' => 'No'
                        ),
                        array(
                            'key' => 'field_blog_show_date',
                            'label' => 'Show Date',
                            'name' => 'show_date',
                            'type' => 'true_false',
                            'instructions' => 'Display post date',
                            'required' => 0,
                            'default_value' => 1,
                            'ui' => 1,
                            'ui_on_text' => 'Yes',
                            'ui_off_text' => 'No'
                        ),
                        array(
                            'key' => 'field_blog_show_categories',
                            'label' => 'Show Categories',
                            'name' => 'show_categories',
                            'type' => 'true_false',
                            'instructions' => 'Display post categories',
                            'required' => 0,
                            'default_value' => 1,
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
                                'value' => 'acf/blog-section'
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