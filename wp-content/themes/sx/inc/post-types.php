<?php
/**
 * Custom Post Types Registration
 */

// Register Testimonials Post Type
function register_testimonials_post_type() {
    $labels = array(
        'name'                  => _x('Testimonials', 'Post Type General Name'),
        'singular_name'         => _x('Testimonial', 'Post Type Singular Name'),
        'menu_name'             => __('Testimonials'),
        'name_admin_bar'        => __('Testimonial'),
        'archives'              => __('Testimonial Archives'),
        'attributes'            => __('Testimonial Attributes'),
        'parent_item_colon'     => __('Parent Testimonial:'),
        'all_items'             => __('All Testimonials'),
        'add_new_item'          => __('Add New Testimonial'),
        'add_new'               => __('Add New'),
        'new_item'              => __('New Testimonial'),
        'edit_item'             => __('Edit Testimonial'),
        'update_item'           => __('Update Testimonial'),
        'view_item'             => __('View Testimonial'),
        'view_items'            => __('View Testimonials'),
        'search_items'          => __('Search Testimonial'),
        'not_found'             => __('Not found'),
        'not_found_in_trash'    => __('Not found in Trash'),
        'featured_image'        => __('Featured Image'),
        'set_featured_image'    => __('Set featured image'),
        'remove_featured_image' => __('Remove featured image'),
        'use_featured_image'    => __('Use as featured image'),
        'insert_into_item'      => __('Insert into testimonial'),
        'uploaded_to_this_item' => __('Uploaded to this testimonial'),
        'items_list'            => __('Testimonials list'),
        'items_list_navigation' => __('Testimonials list navigation'),
        'filter_items_list'     => __('Filter testimonials list'),
    );
    
    $args = array(
        'label'                 => __('Testimonial'),
        'description'           => __('Customer testimonials'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-format-quote',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    
    register_post_type('testimonial', $args);
}
add_action('init', 'register_testimonials_post_type', 0);