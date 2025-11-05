<?php
/**
 * Layout Article ACF Field Registration
 */

function register_layout_article_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_layout_article',
            'title' => 'Layout Article',
            'fields' => array(
                // Header Image (shows at top if set)
                array(
                    'key' => 'field_article_header_image',
                    'label' => 'Header Image',
                    'name' => 'article_header_image',
                    'type' => 'image',
                    'instructions' => 'Optional header image that appears above the subtitle and title',
                    'required' => 0,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ),

                // Subtitle (shows above title if set)
                array(
                    'key' => 'field_article_subtitle',
                    'label' => 'Subtitle',
                    'name' => 'article_subtitle',
                    'type' => 'text',
                    'instructions' => 'Optional subtitle that appears above the main title',
                    'required' => 0,
                    'default_value' => '',
                    'placeholder' => 'Enter subtitle',
                    'maxlength' => 150,
                ),

                // Main Title
                array(
                    'key' => 'field_article_title',
                    'label' => 'Title',
                    'name' => 'article_title',
                    'type' => 'text',
                    'instructions' => 'Main heading for the article',
                    'required' => 1,
                    'default_value' => '',
                    'placeholder' => 'Enter article title',
                    'maxlength' => 100,
                ),

                // Content
                array(
                    'key' => 'field_article_content',
                    'label' => 'Content',
                    'name' => 'article_content',
                    'type' => 'wysiwyg',
                    'instructions' => 'Article content with support for inline images, headings, lists, and formatting',
                    'required' => 1,
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                ),

                // Background Theme
                array(
                    'key' => 'field_article_background_theme',
                    'label' => 'Background Theme',
                    'name' => 'article_background_theme',
                    'type' => 'select',
                    'instructions' => 'Choose the background theme for this section',
                    'required' => 0,
                    'choices' => array(
                        'default' => 'Default (Light)',
                        'dark' => 'Dark',
                    ),
                    'default_value' => 'default',
                    'allow_null' => 0,
                    'ui' => 1,
                    'ajax' => 0,
                ),

                // Disable Top Padding
                array(
                    'key' => 'field_article_disable_top_padding',
                    'label' => 'Disable Top Padding',
                    'name' => 'article_disable_top_padding',
                    'type' => 'true_false',
                    'instructions' => 'Remove top padding from this section',
                    'required' => 0,
                    'default_value' => 0,
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
                        'value' => 'acf/layout-article',
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

add_action('acf/init', 'register_layout_article_acf_fields');
