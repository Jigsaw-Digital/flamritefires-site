<?php
/**
 * ACF Field definitions for Features Section Block
 *
 * @package SX
 */

if (!function_exists('register_features_acf_fields')) {
    function register_features_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_features_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_features_section',
                    'title' => 'Features Section',
                    'fields' => array(
                        array(
                            'key' => 'field_features_background_image',
                            'label' => 'Background Image',
                            'name' => 'background_image',
                            'type' => 'image',
                            'instructions' => 'Full width background image for the features section',
                            'required' => 0,
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'library' => 'all'
                        ),
                        array(
                            'key' => 'field_features_overlay_opacity',
                            'label' => 'Overlay Opacity',
                            'name' => 'overlay_opacity',
                            'type' => 'range',
                            'instructions' => 'Darkness of the overlay on the background image',
                            'required' => 0,
                            'default_value' => 70,
                            'min' => 0,
                            'max' => 100,
                            'step' => 10,
                            'append' => '%'
                        ),
                        array(
                            'key' => 'field_features_columns',
                            'label' => 'Feature Columns',
                            'name' => 'feature_columns',
                            'type' => 'repeater',
                            'instructions' => 'Add up to 3 feature columns',
                            'required' => 1,
                            'min' => 1,
                            'max' => 3,
                            'layout' => 'block',
                            'button_label' => 'Add Feature Column',
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_feature_icon',
                                    'label' => 'Icon',
                                    'name' => 'icon',
                                    'type' => 'select',
                                    'instructions' => 'Select an icon for this feature',
                                    'required' => 1,
                                    'choices' => array(
                                        'cog' => 'Cog (Settings)',
                                        'currency-dollar' => 'Dollar Sign (Costs)',
                                        'phone' => 'Phone (Call Outs)',
                                        'clock' => 'Clock (Time)',
                                        'shield-check' => 'Shield Check (Security)',
                                        'chart-bar' => 'Chart Bar (Analytics)',
                                        'users' => 'Users (Team)',
                                        'lightning-bolt' => 'Lightning Bolt (Speed)'
                                    ),
                                    'default_value' => 'cog',
                                    'allow_null' => 0
                                ),
                                array(
                                    'key' => 'field_feature_icon_color',
                                    'label' => 'Icon Color',
                                    'name' => 'icon_color',
                                    'type' => 'color_picker',
                                    'instructions' => 'Choose the icon color',
                                    'required' => 0,
                                    'default_value' => '#ffffff'
                                ),
                                array(
                                    'key' => 'field_feature_title',
                                    'label' => 'Title',
                                    'name' => 'title',
                                    'type' => 'text',
                                    'instructions' => 'Feature column title',
                                    'required' => 1,
                                    'default_value' => ''
                                ),
                                array(
                                    'key' => 'field_feature_items',
                                    'label' => 'Feature Items',
                                    'name' => 'items',
                                    'type' => 'repeater',
                                    'instructions' => 'Add bullet point items for this feature',
                                    'required' => 0,
                                    'min' => 0,
                                    'max' => 10,
                                    'layout' => 'table',
                                    'button_label' => 'Add Item',
                                    'sub_fields' => array(
                                        array(
                                            'key' => 'field_feature_item_text',
                                            'label' => 'Item Text',
                                            'name' => 'text',
                                            'type' => 'text',
                                            'instructions' => 'Bullet point text',
                                            'required' => 1
                                        )
                                    )
                                )
                            )
                        )
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/features-section'
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