<?php
/**
 * Layout Products by Category ACF Field Registration
 */

function register_layout_products_by_category_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_layout_products_by_category',
            'title' => 'Layout Products by Category',
            'fields' => array(
                array(
                    'key' => 'field_layout_products_by_category_data',
                    'label' => 'Products by Category Data',
                    'name' => 'layout_products_by_category_data',
                    'type' => 'group',
                    'instructions' => 'Configure products by category section',
                    'required' => 0,
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_products_category_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => 'Page/section title',
                            'required' => 1,
                            'default_value' => '',
                            'placeholder' => 'Enter title',
                            'maxlength' => 100,
                        ),
                        array(
                            'key' => 'field_products_category_description',
                            'label' => 'Description',
                            'name' => 'description',
                            'type' => 'wysiwyg',
                            'instructions' => 'Description for the section',
                            'required' => 0,
                            'tabs' => 'all',
                            'toolbar' => 'full',
                            'media_upload' => 0,
                        ),
                        array(
                            'key' => 'field_products_category_sub',
                            'label' => 'Sub Category',
                            'name' => 'sub_category',
                            'type' => 'text',
                            'instructions' => 'Parent category slug for breadcrumbs (optional)',
                            'required' => 0,
                            'default_value' => '',
                            'placeholder' => 'parent-category-slug',
                        ),
                        array(
                            'key' => 'field_products_category_display_type',
                            'label' => 'Display Type',
                            'name' => 'display_type',
                            'type' => 'radio',
                            'instructions' => 'Choose what to display',
                            'required' => 1,
                            'choices' => array(
                                'categories' => 'Categories',
                                'products' => 'Products',
                                'brochures' => 'Brochures',
                                'both' => 'Both',
                            ),
                            'default_value' => 'categories',
                            'layout' => 'vertical',
                        ),
                        array(
                            'key' => 'field_products_display_categories',
                            'label' => 'Display Categories',
                            'name' => 'display_categories',
                            'type' => 'true_false',
                            'instructions' => 'Show categories section',
                            'required' => 0,
                            'default_value' => 1,
                            'ui' => 1,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_products_category_display_type',
                                        'operator' => '!=',
                                        'value' => 'products',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_selected_category',
                            'label' => 'Select Category',
                            'name' => 'selected_category',
                            'type' => 'taxonomy',
                            'instructions' => 'Choose a product category to display products from',
                            'required' => 0,
                            'taxonomy' => 'product_category',
                            'field_type' => 'select',
                            'allow_null' => 1,
                            'return_format' => 'object',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_products_display_categories',
                                        'operator' => '==',
                                        'value' => '1',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_products_display_products',
                            'label' => 'Display Products',
                            'name' => 'display_products',
                            'type' => 'true_false',
                            'instructions' => 'Show products section',
                            'required' => 0,
                            'default_value' => 0,
                            'ui' => 1,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_products_category_display_type',
                                        'operator' => '!=',
                                        'value' => 'categories',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_products_selection_type',
                            'label' => 'Product Selection Method',
                            'name' => 'products_selection_type',
                            'type' => 'radio',
                            'instructions' => 'Choose how to select products to display',
                            'required' => 1,
                            'choices' => array(
                                'by_category' => 'Show all products from selected category',
                                'manual' => 'Manually select specific products',
                            ),
                            'default_value' => 'by_category',
                            'layout' => 'vertical',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_products_display_products',
                                        'operator' => '==',
                                        'value' => '1',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_products_category_filter',
                            'label' => 'Product Category',
                            'name' => 'products_category_filter',
                            'type' => 'taxonomy',
                            'instructions' => 'Select the category to show products from',
                            'required' => 1,
                            'taxonomy' => 'product_category',
                            'field_type' => 'select',
                            'allow_null' => 0,
                            'return_format' => 'object',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_products_display_products',
                                        'operator' => '==',
                                        'value' => '1',
                                    ),
                                    array(
                                        'field' => 'field_products_selection_type',
                                        'operator' => '==',
                                        'value' => 'by_category',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_products_selection',
                            'label' => 'Select Products',
                            'name' => 'products_selection',
                            'type' => 'post_object',
                            'instructions' => 'Manually select specific products to display',
                            'required' => 0,
                            'post_type' => array('products'),
                            'taxonomy' => array(),
                            'allow_null' => 1,
                            'multiple' => 1,
                            'return_format' => 'object',
                            'ui' => 1,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_products_display_products',
                                        'operator' => '==',
                                        'value' => '1',
                                    ),
                                    array(
                                        'field' => 'field_products_selection_type',
                                        'operator' => '==',
                                        'value' => 'manual',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_products_limit',
                            'label' => 'Number of Products',
                            'name' => 'products_limit',
                            'type' => 'number',
                            'instructions' => 'Maximum number of products to display (-1 for unlimited)',
                            'required' => 0,
                            'default_value' => 12,
                            'min' => -1,
                            'max' => 100,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_products_display_products',
                                        'operator' => '==',
                                        'value' => '1',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_display_brochures',
                            'label' => 'Display Brochures',
                            'name' => 'display_brochures',
                            'type' => 'true_false',
                            'instructions' => 'Show brochures section',
                            'required' => 0,
                            'default_value' => 0,
                            'ui' => 1,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_products_category_display_type',
                                        'operator' => '==',
                                        'value' => 'brochures',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_brochures_selection_type',
                            'label' => 'Brochure Selection Method',
                            'name' => 'brochures_selection_type',
                            'type' => 'radio',
                            'instructions' => 'Choose how to select brochures to display',
                            'required' => 1,
                            'choices' => array(
                                'by_category' => 'Show all brochures from selected category',
                                'manual' => 'Manually select specific brochures',
                            ),
                            'default_value' => 'by_category',
                            'layout' => 'vertical',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_display_brochures',
                                        'operator' => '==',
                                        'value' => '1',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_brochures_category_filter',
                            'label' => 'Brochure Category',
                            'name' => 'brochures_category_filter',
                            'type' => 'taxonomy',
                            'instructions' => 'Select the category to show brochures from',
                            'required' => 1,
                            'taxonomy' => 'brochure_category',
                            'field_type' => 'select',
                            'allow_null' => 0,
                            'return_format' => 'object',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_display_brochures',
                                        'operator' => '==',
                                        'value' => '1',
                                    ),
                                    array(
                                        'field' => 'field_brochures_selection_type',
                                        'operator' => '==',
                                        'value' => 'by_category',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_brochures_selection',
                            'label' => 'Select Brochures',
                            'name' => 'brochures_selection',
                            'type' => 'post_object',
                            'instructions' => 'Manually select specific brochures to display',
                            'required' => 0,
                            'post_type' => array('brochures'),
                            'taxonomy' => array(),
                            'allow_null' => 1,
                            'multiple' => 1,
                            'return_format' => 'object',
                            'ui' => 1,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_display_brochures',
                                        'operator' => '==',
                                        'value' => '1',
                                    ),
                                    array(
                                        'field' => 'field_brochures_selection_type',
                                        'operator' => '==',
                                        'value' => 'manual',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_brochures_limit',
                            'label' => 'Number of Brochures',
                            'name' => 'brochures_limit',
                            'type' => 'number',
                            'instructions' => 'Maximum number of brochures to display (-1 for unlimited)',
                            'required' => 0,
                            'default_value' => 12,
                            'min' => -1,
                            'max' => 100,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_display_brochures',
                                        'operator' => '==',
                                        'value' => '1',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/layout-products-by-category',
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

// Register the fields
add_action('acf/init', 'register_layout_products_by_category_acf_fields');