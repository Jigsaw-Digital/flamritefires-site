<?php
/**
 * ACF Field definitions for Coverage Section Block
 *
 * @package SX
 */

if (!function_exists('register_coverage_acf_fields')) {
    function register_coverage_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            // Only register the fields if they don't already exist
            if (!acf_get_field_group('group_coverage_section')) {
                acf_add_local_field_group(array(
                    'key' => 'group_coverage_section',
                    'title' => 'Coverage Section',
                    'fields' => array(
                        array(
                            'key' => 'field_coverage_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => 'Main coverage section title',
                            'required' => 1,
                            'default_value' => 'Engineer Coverage'
                        ),
                        array(
                            'key' => 'field_coverage_subtitle',
                            'label' => 'Subtitle',
                            'name' => 'subtitle',
                            'type' => 'text',
                            'instructions' => 'Subtitle shown below the main title',
                            'required' => 0,
                            'default_value' => 'Enter a postcode to find coverage in your area'
                        ),
                        array(
                            'key' => 'field_coverage_search_placeholder',
                            'label' => 'Search Placeholder',
                            'name' => 'search_placeholder',
                            'type' => 'text',
                            'instructions' => 'Placeholder text for the postcode search field',
                            'required' => 0,
                            'default_value' => 'Enter postcode, town or city'
                        ),
                        array(
                            'key' => 'field_coverage_google_maps_api_key',
                            'label' => 'Google Maps API Key',
                            'name' => 'google_maps_api_key',
                            'type' => 'text',
                            'instructions' => 'Your Google Maps JavaScript API key for displaying the map',
                            'required' => 1
                        ),
                        array(
                            'key' => 'field_coverage_default_lat',
                            'label' => 'Default Map Latitude',
                            'name' => 'default_lat',
                            'type' => 'number',
                            'instructions' => 'Default latitude for map center (UK default: 54.5)',
                            'required' => 0,
                            'default_value' => 54.5,
                            'step' => 'any'
                        ),
                        array(
                            'key' => 'field_coverage_default_lng',
                            'label' => 'Default Map Longitude',
                            'name' => 'default_lng',
                            'type' => 'number',
                            'instructions' => 'Default longitude for map center (UK default: -2.5)',
                            'required' => 0,
                            'default_value' => -2.5,
                            'step' => 'any'
                        ),
                        array(
                            'key' => 'field_coverage_default_zoom',
                            'label' => 'Default Map Zoom',
                            'name' => 'default_zoom',
                            'type' => 'number',
                            'instructions' => 'Default zoom level for the map (1-20)',
                            'required' => 0,
                            'default_value' => 6,
                            'min' => 1,
                            'max' => 20
                        )
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/coverage-section'
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