<?php
/**
 * ACF Field definitions for Hero Section Block
 *
 * @package SX
 */

if (!function_exists('register_hero_acf_fields')) {
    function register_hero_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_hero_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_hero_section',
                    'title' => 'Hero Section',
                    'fields' => array(
                        array(
                            'key' => 'field_hero_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => 'Main hero title',
                            'required' => 1,
                            'default_value' => 'While you prepare'
                        ),
                        array(
                            'key' => 'field_hero_subtitle',
                            'label' => 'Subtitle',
                            'name' => 'subtitle',
                            'type' => 'text',
                            'instructions' => 'Subtitle shown below the main title',
                            'required' => 0,
                            'default_value' => 'we keep you running'
                        ),
                        array(
                            'key' => 'field_hero_cta_primary',
                            'label' => 'Primary CTA',
                            'name' => 'cta_primary',
                            'type' => 'link',
                            'instructions' => 'Primary call-to-action button',
                            'required' => 0,
                            'return_format' => 'array'
                        ),
                        array(
                            'key' => 'field_hero_cta_secondary',
                            'label' => 'Secondary CTA',
                            'name' => 'cta_secondary',
                            'type' => 'link',
                            'instructions' => 'Secondary call-to-action button',
                            'required' => 0,
                            'return_format' => 'array'
                        ),
                        array(
                            'key' => 'field_hero_background_image',
                            'label' => 'Background Image',
                            'name' => 'background_image',
                            'type' => 'image',
                            'instructions' => 'Hero section background image',
                            'required' => 0,
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all'
                        )
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/hero-section'
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
