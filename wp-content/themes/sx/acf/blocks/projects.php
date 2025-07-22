<?php
/**
 * ACF Field definitions for Projects Section Block
 *
 * @package SX
 */

if (!function_exists('register_projects_acf_fields')) {
    function register_projects_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_projects_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_projects_section',
                    'title' => 'Projects Section',
                    'fields' => array(
                        array(
                            'key' => 'field_projects_section_title',
                            'label' => 'Section Title',
                            'name' => 'section_title',
                            'type' => 'text',
                            'instructions' => 'Title for the projects section',
                            'required' => 0,
                            'default_value' => 'Our Projects'
                        ),
                        array(
                            'key' => 'field_projects_section_subtitle',
                            'label' => 'Section Subtitle',
                            'name' => 'section_subtitle',
                            'type' => 'text',
                            'instructions' => 'Optional subtitle text',
                            'required' => 0,
                            'default_value' => 'Explore our portfolio of successful projects'
                        ),
                        array(
                            'key' => 'field_projects_category_filter',
                            'label' => 'Filter by Category',
                            'name' => 'category_filter',
                            'type' => 'taxonomy',
                            'instructions' => 'Select a specific category to display (leave empty for all)',
                            'required' => 0,
                            'taxonomy' => 'project_category',
                            'field_type' => 'select',
                            'allow_null' => 1,
                            'add_term' => 0,
                            'save_terms' => 0,
                            'load_terms' => 0,
                            'return_format' => 'id',
                            'multiple' => 0
                        ),
                        array(
                            'key' => 'field_projects_posts_per_page',
                            'label' => 'Number of Projects',
                            'name' => 'posts_per_page',
                            'type' => 'number',
                            'instructions' => 'How many projects to display (-1 for all)',
                            'required' => 0,
                            'default_value' => 9,
                            'min' => -1,
                            'max' => 30,
                            'step' => 1
                        ),
                        array(
                            'key' => 'field_projects_columns',
                            'label' => 'Grid Columns',
                            'name' => 'grid_columns',
                            'type' => 'select',
                            'instructions' => 'Number of columns in the grid',
                            'required' => 0,
                            'choices' => array(
                                '2' => '2 Columns',
                                '3' => '3 Columns',
                                '4' => '4 Columns'
                            ),
                            'default_value' => '3',
                            'allow_null' => 0
                        ),
                        array(
                            'key' => 'field_projects_show_description',
                            'label' => 'Show Description',
                            'name' => 'show_description',
                            'type' => 'true_false',
                            'instructions' => 'Display project descriptions',
                            'required' => 0,
                            'default_value' => 1,
                            'ui' => 1,
                            'ui_on_text' => 'Yes',
                            'ui_off_text' => 'No'
                        ),
                        array(
                            'key' => 'field_projects_show_client',
                            'label' => 'Show Client Name',
                            'name' => 'show_client',
                            'type' => 'true_false',
                            'instructions' => 'Display client names',
                            'required' => 0,
                            'default_value' => 1,
                            'ui' => 1,
                            'ui_on_text' => 'Yes',
                            'ui_off_text' => 'No'
                        ),
                        array(
                            'key' => 'field_projects_show_date',
                            'label' => 'Show Project Date',
                            'name' => 'show_date',
                            'type' => 'true_false',
                            'instructions' => 'Display project completion dates',
                            'required' => 0,
                            'default_value' => 0,
                            'ui' => 1,
                            'ui_on_text' => 'Yes',
                            'ui_off_text' => 'No'
                        ),
                        array(
                            'key' => 'field_projects_show_category',
                            'label' => 'Show Category',
                            'name' => 'show_category',
                            'type' => 'true_false',
                            'instructions' => 'Display project categories',
                            'required' => 0,
                            'default_value' => 1,
                            'ui' => 1,
                            'ui_on_text' => 'Yes',
                            'ui_off_text' => 'No'
                        ),
                        array(
                            'key' => 'field_projects_background_color',
                            'label' => 'Background Color',
                            'name' => 'background_color',
                            'type' => 'color_picker',
                            'instructions' => 'Section background color',
                            'required' => 0,
                            'default_value' => '#f9fafb'
                        )
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/projects-section'
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