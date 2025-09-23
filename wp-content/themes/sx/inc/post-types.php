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

// Register Documents Post Type
function register_documents_post_type() {
    $labels = array(
        'name'                  => _x('Documents', 'Post Type General Name'),
        'singular_name'         => _x('Document', 'Post Type Singular Name'),
        'menu_name'             => __('Documents'),
        'name_admin_bar'        => __('Document'),
        'archives'              => __('Document Archives'),
        'attributes'            => __('Document Attributes'),
        'parent_item_colon'     => __('Parent Document:'),
        'all_items'             => __('All Documents'),
        'add_new_item'          => __('Add New Document'),
        'add_new'               => __('Add New'),
        'new_item'              => __('New Document'),
        'edit_item'             => __('Edit Document'),
        'update_item'           => __('Update Document'),
        'view_item'             => __('View Document'),
        'view_items'            => __('View Documents'),
        'search_items'          => __('Search Document'),
        'not_found'             => __('Not found'),
        'not_found_in_trash'    => __('Not found in Trash'),
        'featured_image'        => __('Featured Image'),
        'set_featured_image'    => __('Set featured image'),
        'remove_featured_image' => __('Remove featured image'),
        'use_featured_image'    => __('Use as featured image'),
        'insert_into_item'      => __('Insert into document'),
        'uploaded_to_this_item' => __('Uploaded to this document'),
        'items_list'            => __('Documents list'),
        'items_list_navigation' => __('Documents list navigation'),
        'filter_items_list'     => __('Filter documents list'),
    );

    $args = array(
        'label'                 => __('Document'),
        'description'           => __('Company documents and files'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 21,
        'menu_icon'             => 'dashicons-media-document',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );

    register_post_type('documents', $args);
}
add_action('init', 'register_documents_post_type', 0);

// Register Videos Post Type
function register_videos_post_type() {
    $labels = array(
        'name'                  => _x('Videos', 'Post Type General Name'),
        'singular_name'         => _x('Video', 'Post Type Singular Name'),
        'menu_name'             => __('Videos'),
        'name_admin_bar'        => __('Video'),
        'archives'              => __('Video Archives'),
        'attributes'            => __('Video Attributes'),
        'parent_item_colon'     => __('Parent Video:'),
        'all_items'             => __('All Videos'),
        'add_new_item'          => __('Add New Video'),
        'add_new'               => __('Add New'),
        'new_item'              => __('New Video'),
        'edit_item'             => __('Edit Video'),
        'update_item'           => __('Update Video'),
        'view_item'             => __('View Video'),
        'view_items'            => __('View Videos'),
        'search_items'          => __('Search Video'),
        'not_found'             => __('Not found'),
        'not_found_in_trash'    => __('Not found in Trash'),
        'featured_image'        => __('Featured Image'),
        'set_featured_image'    => __('Set featured image'),
        'remove_featured_image' => __('Remove featured image'),
        'use_featured_image'    => __('Use as featured image'),
        'insert_into_item'      => __('Insert into video'),
        'uploaded_to_this_item' => __('Uploaded to this video'),
        'items_list'            => __('Videos list'),
        'items_list_navigation' => __('Videos list navigation'),
        'filter_items_list'     => __('Filter videos list'),
    );

    $args = array(
        'label'                 => __('Video'),
        'description'           => __('Company videos'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 22,
        'menu_icon'             => 'dashicons-video-alt3',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );

    register_post_type('videos', $args);
}
add_action('init', 'register_videos_post_type', 0);