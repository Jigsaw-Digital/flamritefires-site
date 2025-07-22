<?php
/**
 * Testimonials ACF Fields
 */

function register_testimonials_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_testimonials',
            'title' => 'Testimonial Details',
            'fields' => array(
                array(
                    'key' => 'field_testimonial_quote',
                    'label' => 'Testimonial Quote',
                    'name' => 'testimonial_quote',
                    'type' => 'textarea',
                    'instructions' => 'The main testimonial text',
                    'required' => 1,
                    'rows' => 4,
                    'placeholder' => 'Enter the testimonial quote...',
                ),
                array(
                    'key' => 'field_testimonial_customer_name',
                    'label' => 'Customer Name',
                    'name' => 'customer_name',
                    'type' => 'text',
                    'instructions' => 'Name of the customer giving the testimonial',
                    'required' => 1,
                    'placeholder' => 'Enter customer name',
                ),
                array(
                    'key' => 'field_testimonial_customer_location',
                    'label' => 'Customer Location',
                    'name' => 'customer_location',
                    'type' => 'text',
                    'instructions' => 'Location or company of the customer (optional)',
                    'required' => 0,
                    'placeholder' => 'Enter location or company',
                ),
                array(
                    'key' => 'field_testimonial_star_rating',
                    'label' => 'Star Rating',
                    'name' => 'star_rating',
                    'type' => 'range',
                    'instructions' => 'Star rating out of 5',
                    'required' => 0,
                    'default_value' => 5,
                    'min' => 1,
                    'max' => 5,
                    'step' => 1,
                    'append' => 'stars',
                ),
                array(
                    'key' => 'field_testimonial_featured',
                    'label' => 'Featured Testimonial',
                    'name' => 'featured_testimonial',
                    'type' => 'true_false',
                    'instructions' => 'Mark as featured to prioritize in displays',
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
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'testimonial',
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
add_action('acf/init', 'register_testimonials_acf_fields');