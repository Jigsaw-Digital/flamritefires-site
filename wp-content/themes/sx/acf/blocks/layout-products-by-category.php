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
                            'key' => 'field_products_categories',
                            'label' => 'Categories',
                            'name' => 'categories',
                            'type' => 'repeater',
                            'instructions' => 'Add categories to display',
                            'required' => 0,
                            'collapsed' => '',
                            'min' => 0,
                            'max' => 20,
                            'layout' => 'table',
                            'button_label' => 'Add Category',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_products_display_categories',
                                        'operator' => '==',
                                        'value' => '1',
                                    ),
                                ),
                            ),
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_category_name',
                                    'label' => 'Name',
                                    'name' => 'name',
                                    'type' => 'text',
                                    'required' => 1,
                                ),
                                array(
                                    'key' => 'field_category_slug',
                                    'label' => 'Slug',
                                    'name' => 'slug',
                                    'type' => 'text',
                                    'required' => 1,
                                ),
                                array(
                                    'key' => 'field_category_image',
                                    'label' => 'Image',
                                    'name' => 'image',
                                    'type' => 'image',
                                    'required' => 0,
                                    'return_format' => 'array',
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
                            'key' => 'field_products_products',
                            'label' => 'Products',
                            'name' => 'products',
                            'type' => 'repeater',
                            'instructions' => 'Add products to display',
                            'required' => 0,
                            'collapsed' => '',
                            'min' => 0,
                            'max' => 50,
                            'layout' => 'table',
                            'button_label' => 'Add Product',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_products_display_products',
                                        'operator' => '==',
                                        'value' => '1',
                                    ),
                                ),
                            ),
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_product_title',
                                    'label' => 'Title',
                                    'name' => 'title',
                                    'type' => 'text',
                                    'required' => 1,
                                ),
                                array(
                                    'key' => 'field_product_slug',
                                    'label' => 'Slug',
                                    'name' => 'slug',
                                    'type' => 'text',
                                    'required' => 1,
                                ),
                                array(
                                    'key' => 'field_product_featured_image',
                                    'label' => 'Featured Image',
                                    'name' => 'featured_image',
                                    'type' => 'image',
                                    'required' => 0,
                                    'return_format' => 'array',
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