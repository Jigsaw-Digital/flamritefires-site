<?php

// Include ACF Block Field Definitions
require_once get_template_directory() . '/acf/acf-blocks.php';

// Include custom post types
require_once get_template_directory() . '/inc/post-types.php';

// Include testimonials ACF fields
require_once get_template_directory() . '/acf/testimonials.php';

// Include testimonials slider block ACF fields
require_once get_template_directory() . '/acf/blocks/testimonials-slider.php';

// Include sample testimonials creator (remove in production)
require_once get_template_directory() . '/inc/sample-testimonials.php';

// Theme Setup
add_action('after_setup_theme', 'sx_theme_setup');
function sx_theme_setup() {
    // Enable featured images
    add_theme_support('post-thumbnails');
    
    // Add custom image sizes if needed
    add_image_size('blog-grid', 600, 400, true); // For blog grid
    add_image_size('project-grid', 800, 600, true); // For project grid
}

// Admin Colours
// add_action('admin_init', function(){
//     if (!wp_doing_ajax()) {
//         echo "
//         <style>
//             #adminmenu, #adminmenu .wp-submenu, #adminmenuback, #adminmenuwrap, #wpadminbar {
//                 width: 160px;
//                 background-color: #333!important;
//             }
//             .ab-icon::before {
//                 display:none!important;
//             }
//             // html :where(.wp-block) {
//             //     max-width:1500px!important;
//             // }
//         </style>
//         <script src='https://cdn.tailwindcss.com'></script>
//         <script>
//             tailwind.config = {
//                 theme: {
//                     extend: {
//                         colors: {
//                             primary: '#750639',
//                             primary_light: '#9c084c',
//                             primary_dark: '#5e052e',
//                             secondary: '#daa521',
//                             secondary_light: '#f0bf4c',
//                             secondary_dark: '#b78a15',
//                             tertiary: '#008080',
//                             tertiary_light: '#20a0a0',
//                             tertiary_dark: '#006666',
//                         }
//                     }
//                 }
//             }
//         </script>
//         ";
//     }
// });

// Menus
add_action('init', 'sx_custom_new_menu');
function sx_custom_new_menu(){
    register_nav_menu('main-menu', 'Main Menu');
}

// Menu Walker Classes for Greycaine Theme
if (!class_exists('Greycaine_Desktop_Walker')) {
    class Greycaine_Desktop_Walker extends Walker_Nav_Menu {
        function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
            $classes = empty($item->classes) ? array() : (array) $item->classes;
            $has_children = in_array('menu-item-has-children', $classes);
            
            $atts = array();
            $atts['href'] = !empty($item->url) ? $item->url : '';
            
            if ($has_children) {
                $attributes = ' class="px-4 text-sm uppercase tracking-[10px] xl:text-lg relative cursor-pointer text-white hover:text-white/70" onmouseenter="openMegaMenu()" onmouseleave="closeMegaMenu()"';
                $output .= '<span' . $attributes . '>' . apply_filters('the_title', $item->title, $item->ID) . '</span>';
            } else {
                $attributes = ' href="' . esc_url($atts['href']) . '" class="px-4 text-sm uppercase tracking-[8px] relative text-white hover:text-white/70"';
                $output .= '<a' . $attributes . '>' . apply_filters('the_title', $item->title, $item->ID) . '</a>';
            }
        }
    }
}

if (!class_exists('Greycaine_Mobile_Walker')) {
    class Greycaine_Mobile_Walker extends Walker_Nav_Menu {
        function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
            $classes = empty($item->classes) ? array() : (array) $item->classes;
            $has_children = in_array('menu-item-has-children', $classes);
            
            $atts = array();
            $atts['href'] = !empty($item->url) ? $item->url : '';
            
            if ($has_children) {
                $output .= '<div class="text-white">';
                $output .= '<div class="flex items-center justify-between text-[14px] uppercase text-white hover:text-[#b25c43] py-2 cursor-pointer" @click="mobileSubMenuOpen = !mobileSubMenuOpen">';
                $output .= '<span>' . apply_filters('the_title', $item->title, $item->ID) . '</span>';
                $output .= '<svg x-show="!mobileSubMenuOpen" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>';
                $output .= '<svg x-show="mobileSubMenuOpen" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"/></svg>';
                $output .= '</div>';
                $output .= '</div>';
            } else {
                $attributes = ' href="' . esc_url($atts['href']) . '" class="block text-[14px] uppercase text-white hover:text-[#b25c43] py-2" @click="mobileMenuOpen = false"';
                $output .= '<a' . $attributes . '>' . apply_filters('the_title', $item->title, $item->ID) . '</a>';
            }
        }
    }
}

// Default menu fallbacks
function greycaine_default_menu() {
    echo '<div class="flex items-center gap-2 xl:gap-4">';
    echo '<a href="#" class="px-4 text-sm uppercase tracking-[10px] xl:text-lg relative text-white hover:text-white/70">Products</a>';
    echo '<a href="/bespoke" class="px-4 text-sm uppercase tracking-[10px] xl:text-lg relative text-white hover:text-white/70">Bespoke</a>';
    echo '<a href="/trade" class="px-4 text-sm uppercase tracking-[10px] xl:text-lg relative text-white hover:text-white/70">Trade</a>';
    echo '<a href="/category/clearance" class="px-4 text-sm uppercase tracking-[10px] xl:text-lg relative text-white hover:text-white/70">Clearance</a>';
    echo '</div>';
}

function greycaine_mobile_default_menu() {
    echo '<div class="flex flex-col space-y-3">';
    echo '<div class="text-white"><div class="flex items-center justify-between text-[14px] uppercase text-white hover:text-[#b25c43] py-2 cursor-pointer" @click="mobileSubMenuOpen = !mobileSubMenuOpen"><span>Products</span><svg x-show="!mobileSubMenuOpen" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg></div></div>';
    echo '<a href="/bespoke" class="block text-[14px] uppercase text-white hover:text-[#b25c43] py-2" @click="mobileMenuOpen = false">Bespoke</a>';
    echo '<a href="/trade" class="block text-[14px] uppercase text-white hover:text-[#b25c43] py-2" @click="mobileMenuOpen = false">Trade</a>';
    echo '<a href="/category/clearance" class="block text-[14px] uppercase text-white hover:text-[#b25c43] py-2" @click="mobileMenuOpen = false">Clearance</a>';
    echo '</div>';
}

// Custom Post Type for Coverage Points
add_action('init', 'register_coverage_points_post_type');
function register_coverage_points_post_type() {
    register_post_type('coveragepoints', array(
        'labels' => array(
            'name' => 'Coverage Points',
            'singular_name' => 'Coverage Point',
            'add_new' => 'Add New Coverage Point',
            'add_new_item' => 'Add New Coverage Point',
            'edit_item' => 'Edit Coverage Point',
            'new_item' => 'New Coverage Point',
            'view_item' => 'View Coverage Point',
            'search_items' => 'Search Coverage Points',
            'not_found' => 'No coverage points found',
            'not_found_in_trash' => 'No coverage points found in trash'
        ),
        'public' => true,
        'has_archive' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-location-alt',
        'supports' => array('title', 'editor'),
        'rewrite' => false,
        'show_in_rest' => true
    ));
}

// Custom Post Type for Reviews
add_action('init', 'register_reviews_post_type');
function register_reviews_post_type() {
    register_post_type('reviews', array(
        'labels' => array(
            'name' => 'Reviews',
            'singular_name' => 'Review',
            'add_new' => 'Add New Review',
            'add_new_item' => 'Add New Review',
            'edit_item' => 'Edit Review',
            'new_item' => 'New Review',
            'view_item' => 'View Review',
            'search_items' => 'Search Reviews',
            'not_found' => 'No reviews found',
            'not_found_in_trash' => 'No reviews found in trash'
        ),
        'public' => true,
        'has_archive' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-star-filled',
        'supports' => array('title'),
        'rewrite' => false,
        'show_in_rest' => true
    ));
}

// Custom Post Type for Careers
add_action('init', 'register_careers_post_type');
function register_careers_post_type() {
    register_post_type('careers', array(
        'labels' => array(
            'name' => 'Careers',
            'singular_name' => 'Career',
            'add_new' => 'Add New Position',
            'add_new_item' => 'Add New Position',
            'edit_item' => 'Edit Position',
            'new_item' => 'New Position',
            'view_item' => 'View Position',
            'search_items' => 'Search Positions',
            'not_found' => 'No positions found',
            'not_found_in_trash' => 'No positions found in trash'
        ),
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-businessperson',
        'supports' => array('title'),
        'rewrite' => array('slug' => 'careers'),
        'show_in_rest' => true
    ));
}

// Custom Post Type for Projects
add_action('init', 'register_projects_post_type');
function register_projects_post_type() {
    register_post_type('projects', array(
        'labels' => array(
            'name' => 'Projects',
            'singular_name' => 'Project',
            'add_new' => 'Add New Project',
            'add_new_item' => 'Add New Project',
            'edit_item' => 'Edit Project',
            'new_item' => 'New Project',
            'view_item' => 'View Project',
            'search_items' => 'Search Projects',
            'not_found' => 'No projects found',
            'not_found_in_trash' => 'No projects found in trash'
        ),
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => array('title', 'thumbnail'),
        'rewrite' => array('slug' => 'projects'),
        'show_in_rest' => true
    ));
    
    // Register Project Categories taxonomy
    register_taxonomy('project_category', 'projects', array(
        'labels' => array(
            'name' => 'Project Categories',
            'singular_name' => 'Project Category',
            'search_items' => 'Search Categories',
            'all_items' => 'All Categories',
            'parent_item' => 'Parent Category',
            'parent_item_colon' => 'Parent Category:',
            'edit_item' => 'Edit Category',
            'update_item' => 'Update Category',
            'add_new_item' => 'Add New Category',
            'new_item_name' => 'New Category Name',
            'menu_name' => 'Categories'
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'project-category'),
        'show_in_rest' => true
    ));
}

// Custom Post Type for FAQs
add_action('init', 'register_faqs_post_type');
function register_faqs_post_type() {
    register_post_type('faqs', array(
        'labels' => array(
            'name' => 'FAQs',
            'singular_name' => 'FAQ',
            'add_new' => 'Add New FAQ',
            'add_new_item' => 'Add New FAQ',
            'edit_item' => 'Edit FAQ',
            'new_item' => 'New FAQ',
            'view_item' => 'View FAQ',
            'search_items' => 'Search FAQs',
            'not_found' => 'No FAQs found',
            'not_found_in_trash' => 'No FAQs found in trash'
        ),
        'public' => true,
        'has_archive' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-editor-help',
        'supports' => array('title'),
        'rewrite' => false,
        'show_in_rest' => true
    ));
    
    // Register FAQ Categories taxonomy
    register_taxonomy('faq_category', 'faqs', array(
        'labels' => array(
            'name' => 'FAQ Categories',
            'singular_name' => 'FAQ Category',
            'search_items' => 'Search Categories',
            'all_items' => 'All Categories',
            'parent_item' => 'Parent Category',
            'parent_item_colon' => 'Parent Category:',
            'edit_item' => 'Edit Category',
            'update_item' => 'Update Category',
            'add_new_item' => 'Add New Category',
            'new_item_name' => 'New Category Name',
            'menu_name' => 'Categories'
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'faq-category'),
        'show_in_rest' => true
    ));
}

// Add Coverage Points ACF Fields
add_action('acf/init', 'register_coverage_points_fields');
function register_coverage_points_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_coverage_points',
            'title' => 'Coverage Point Details',
            'fields' => array(
                array(
                    'key' => 'field_coverage_location',
                    'label' => 'Location',
                    'name' => 'location',
                    'type' => 'google_map',
                    'instructions' => 'Search for the address or click on the map to set the location',
                    'required' => 1,
                    'center_lat' => 54.5,
                    'center_lng' => -2.5,
                    'zoom' => 6,
                    'height' => 400
                ),
                array(
                    'key' => 'field_coverage_contact_name',
                    'label' => 'Contact Name',
                    'name' => 'contact_name',
                    'type' => 'text',
                    'instructions' => 'Name of the contact person',
                    'required' => 1
                ),
                array(
                    'key' => 'field_coverage_contact_phone',
                    'label' => 'Contact Phone',
                    'name' => 'contact_phone',
                    'type' => 'text',
                    'instructions' => 'Phone number for this coverage point',
                    'required' => 0
                ),
                array(
                    'key' => 'field_coverage_contact_email',
                    'label' => 'Contact Email',
                    'name' => 'contact_email',
                    'type' => 'email',
                    'instructions' => 'Email address for this coverage point',
                    'required' => 0
                ),
                array(
                    'key' => 'field_coverage_description',
                    'label' => 'Description',
                    'name' => 'description',
                    'type' => 'textarea',
                    'instructions' => 'Additional information about this coverage area',
                    'required' => 0,
                    'rows' => 3
                )
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'coveragepoints'
                    )
                )
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label'
        ));
    }
}

// Add Reviews ACF Fields
add_action('acf/init', 'register_reviews_fields');
function register_reviews_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_reviews',
            'title' => 'Review Details',
            'fields' => array(
                array(
                    'key' => 'field_review_content',
                    'label' => 'Review Content',
                    'name' => 'review_content',
                    'type' => 'textarea',
                    'instructions' => 'The review text',
                    'required' => 1,
                    'rows' => 4
                ),
                array(
                    'key' => 'field_review_author',
                    'label' => 'Author Name',
                    'name' => 'author_name',
                    'type' => 'text',
                    'instructions' => 'Name of the person who wrote the review',
                    'required' => 1
                ),
                array(
                    'key' => 'field_review_author_title',
                    'label' => 'Author Title/Company',
                    'name' => 'author_title',
                    'type' => 'text',
                    'instructions' => 'Job title or company name',
                    'required' => 0
                ),
                array(
                    'key' => 'field_review_rating',
                    'label' => 'Rating',
                    'name' => 'rating',
                    'type' => 'number',
                    'instructions' => 'Rating out of 5',
                    'required' => 0,
                    'default_value' => 5,
                    'min' => 1,
                    'max' => 5,
                    'step' => 1
                ),
                array(
                    'key' => 'field_review_author_image',
                    'label' => 'Author Image',
                    'name' => 'author_image',
                    'type' => 'image',
                    'instructions' => 'Optional photo of the reviewer',
                    'required' => 0,
                    'return_format' => 'array',
                    'preview_size' => 'thumbnail',
                    'library' => 'all'
                )
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'reviews'
                    )
                )
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label'
        ));
    }
}

// Add Careers ACF Fields
add_action('acf/init', 'register_careers_fields');
function register_careers_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_careers',
            'title' => 'Position Details',
            'fields' => array(
                array(
                    'key' => 'field_career_description',
                    'label' => 'Job Description',
                    'name' => 'job_description',
                    'type' => 'wysiwyg',
                    'instructions' => 'Enter the job description and requirements',
                    'required' => 1,
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 0
                ),
                array(
                    'key' => 'field_career_location',
                    'label' => 'Location',
                    'name' => 'job_location',
                    'type' => 'text',
                    'instructions' => 'Job location (e.g., London, Remote, Hybrid)',
                    'required' => 0,
                    'default_value' => ''
                ),
                array(
                    'key' => 'field_career_type',
                    'label' => 'Employment Type',
                    'name' => 'employment_type',
                    'type' => 'select',
                    'instructions' => 'Select the type of employment',
                    'required' => 0,
                    'choices' => array(
                        'full-time' => 'Full Time',
                        'part-time' => 'Part Time',
                        'contract' => 'Contract',
                        'freelance' => 'Freelance',
                        'internship' => 'Internship'
                    ),
                    'default_value' => 'full-time',
                    'allow_null' => 0
                ),
                array(
                    'key' => 'field_career_department',
                    'label' => 'Department',
                    'name' => 'department',
                    'type' => 'text',
                    'instructions' => 'Department or team (e.g., Engineering, Sales, Marketing)',
                    'required' => 0
                ),
                array(
                    'key' => 'field_career_salary',
                    'label' => 'Salary Range',
                    'name' => 'salary_range',
                    'type' => 'text',
                    'instructions' => 'Optional salary range (e.g., £30,000 - £40,000)',
                    'required' => 0
                ),
                array(
                    'key' => 'field_career_featured',
                    'label' => 'Featured Position',
                    'name' => 'featured_position',
                    'type' => 'true_false',
                    'instructions' => 'Mark as featured to highlight this position',
                    'required' => 0,
                    'default_value' => 0,
                    'ui' => 1,
                    'ui_on_text' => 'Yes',
                    'ui_off_text' => 'No'
                )
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'careers'
                    )
                )
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label'
        ));
    }
}

// Add Projects ACF Fields
add_action('acf/init', 'register_projects_fields');
function register_projects_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_projects',
            'title' => 'Project Details',
            'fields' => array(
                array(
                    'key' => 'field_project_description',
                    'label' => 'Project Description',
                    'name' => 'project_description',
                    'type' => 'textarea',
                    'instructions' => 'Brief description of the project',
                    'required' => 1,
                    'rows' => 4,
                    'new_lines' => 'wpautop'
                ),
                array(
                    'key' => 'field_project_content',
                    'label' => 'Project Content',
                    'name' => 'project_content',
                    'type' => 'wysiwyg',
                    'instructions' => 'Detailed project information',
                    'required' => 0,
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                    'delay' => 0
                ),
                array(
                    'key' => 'field_project_client',
                    'label' => 'Client Name',
                    'name' => 'client_name',
                    'type' => 'text',
                    'instructions' => 'Name of the client (optional)',
                    'required' => 0
                ),
                array(
                    'key' => 'field_project_date',
                    'label' => 'Project Date',
                    'name' => 'project_date',
                    'type' => 'date_picker',
                    'instructions' => 'When was the project completed?',
                    'required' => 0,
                    'display_format' => 'F Y',
                    'return_format' => 'F Y',
                    'first_day' => 1
                ),
                array(
                    'key' => 'field_project_value',
                    'label' => 'Project Value',
                    'name' => 'project_value',
                    'type' => 'text',
                    'instructions' => 'The value of the project (e.g., £1.2M, $500K)',
                    'required' => 0,
                    'default_value' => '',
                    'placeholder' => 'e.g., £1.2M'
                ),
                array(
                    'key' => 'field_project_gallery',
                    'label' => 'Project Gallery',
                    'name' => 'project_gallery',
                    'type' => 'gallery',
                    'instructions' => 'Add project images',
                    'required' => 0,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'insert' => 'append',
                    'library' => 'all',
                    'min' => '',
                    'max' => '',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => ''
                )
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'projects'
                    )
                )
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label'
        ));
    }
}

// Add FAQs ACF Fields
add_action('acf/init', 'register_faqs_fields');
function register_faqs_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_faqs',
            'title' => 'FAQ Details',
            'fields' => array(
                array(
                    'key' => 'field_faq_answer',
                    'label' => 'Answer',
                    'name' => 'faq_answer',
                    'type' => 'wysiwyg',
                    'instructions' => 'The answer to the question',
                    'required' => 1,
                    'tabs' => 'all',
                    'toolbar' => 'basic',
                    'media_upload' => 0,
                    'delay' => 0
                ),
                array(
                    'key' => 'field_faq_order',
                    'label' => 'Display Order',
                    'name' => 'display_order',
                    'type' => 'number',
                    'instructions' => 'Order in which FAQ appears (lower numbers appear first)',
                    'required' => 0,
                    'default_value' => 0,
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => 0,
                    'max' => '',
                    'step' => 1
                )
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'faqs'
                    )
                )
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label'
        ));
    }
}

// AJAX handler for postcode lookup
add_action('wp_ajax_lookup_postcode', 'handle_postcode_lookup');
add_action('wp_ajax_nopriv_lookup_postcode', 'handle_postcode_lookup');

function handle_postcode_lookup() {
    $postcode = sanitize_text_field($_POST['postcode']);
    
    if (empty($postcode)) {
        wp_die('Invalid postcode');
    }
    
    $response = wp_remote_get('https://api.postcodes.io/postcodes/' . urlencode(str_replace(' ', '', $postcode)));
    
    if (is_wp_error($response)) {
        wp_die('Error fetching postcode data');
    }
    
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);
    
    if ($data['status'] != 200) {
        wp_die('Postcode not found');
    }
    
    $lat = $data['result']['latitude'];
    $lng = $data['result']['longitude'];
    
    // Find coverage points within 30 miles (48.28 km)
    $coverage_points = get_posts(array(
        'post_type' => 'coveragepoints',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'location',
                'compare' => 'EXISTS'
            )
        )
    ));
    
    $nearby_points = array();
    
    foreach ($coverage_points as $point) {
        $location = get_field('location', $point->ID);
        
        // ACF Google Map field returns array with lat, lng, address
        if ($location && isset($location['lat']) && isset($location['lng'])) {
            $point_lat = floatval($location['lat']);
            $point_lng = floatval($location['lng']);
            
            $distance = calculate_distance($lat, $lng, $point_lat, $point_lng);
            
            if ($distance <= 30) { // 30 miles
                $nearby_points[] = array(
                    'id' => $point->ID,
                    'title' => $point->post_title,
                    'lat' => $point_lat,
                    'lng' => $point_lng,
                    'address' => $location['address'] ?? '',
                    'distance' => round($distance, 2),
                    'contact_name' => get_field('contact_name', $point->ID),
                    'contact_phone' => get_field('contact_phone', $point->ID),
                    'contact_email' => get_field('contact_email', $point->ID),
                    'description' => get_field('description', $point->ID)
                );
            }
        }
    }
    
    // Sort by distance
    usort($nearby_points, function($a, $b) {
        return $a['distance'] <=> $b['distance'];
    });
    
    wp_send_json_success(array(
        'postcode_lat' => $lat,
        'postcode_lng' => $lng,
        'coverage_points' => $nearby_points
    ));
}

// Set Google Maps API key for ACF
add_action('acf/init', 'acf_google_map_api');
function acf_google_map_api() {
    // Get API key from coverage block or site settings
    $api_key = get_field('google_maps_api_key', 'option');
    if ($api_key) {
        acf_update_setting('google_api_key', $api_key);
    }
}

// Calculate distance between two points using Haversine formula
function calculate_distance($lat1, $lng1, $lat2, $lng2) {
    $earth_radius = 3959; // miles
    
    $lat_delta = deg2rad($lat2 - $lat1);
    $lng_delta = deg2rad($lng2 - $lng1);
    
    $a = sin($lat_delta / 2) * sin($lat_delta / 2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($lng_delta / 2) * sin($lng_delta / 2);
    
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
    return $earth_radius * $c;
}

// ACF Options Page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => 'Site Settings',
        'menu_title'    => 'Site Settings',
        'menu_slug'     => 'site-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    // Add Site Logo field to options page
    add_action('acf/init', 'register_site_settings_fields');
    function register_site_settings_fields() {
        if (function_exists('acf_add_local_field_group')) {
            acf_add_local_field_group(array(
                'key' => 'group_site_settings',
                'title' => 'Site Settings',
                'fields' => array(
                    array(
                        'key' => 'field_site_logo',
                        'label' => 'Site Logo',
                        'name' => 'site_logo',
                        'type' => 'image',
                        'instructions' => 'Upload your site logo. If not provided, the site name will be displayed.',
                        'required' => 0,
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'library' => 'all',
                    ),
                    array(
                        'key' => 'field_google_maps_api_key',
                        'label' => 'Google Maps API Key',
                        'name' => 'google_maps_api_key',
                        'type' => 'text',
                        'instructions' => 'Enter your Google Maps JavaScript API key. This is used for ACF Google Map fields and coverage maps.',
                        'required' => 0,
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'site-settings',
                        ),
                    ),
                ),
                'menu_order' => 0,
            ));
        }
    }
}

// Disable ACF JSON saving since we're using PHP-based field registration
add_filter('acf/settings/save_json', 'sx_disable_acf_json_save');
function sx_disable_acf_json_save($path) {
    // Return false to disable JSON saving
    return false;
}

// ACF Blocks
// Hook into acf/init which runs after ACF has been initialized
add_action('acf/init', 'sx_block_init');
function sx_block_init()
{
    // Check if function exists to avoid errors
    if (!function_exists('acf_register_block_type')) {
        return;
    }
    
    $supports = array(
        'align' => false,
        'mode' => false,
        'jsx' => true
    );
    
    // Register New Layout Blocks
    acf_register_block_type(array(
        'name'              => 'hero-section',
        'title'             => __('Hero Section'),
        'description'       => __('A hero section with heading, subtitle, and CTA buttons.'),
        'render_template'   => 'template-parts/blocks/hero.php',
        'category'          => 'layout',
        'icon'              => 'cover-image',
        'keywords'          => array('hero', 'banner', 'header'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'welcome-section',
        'title'             => __('Welcome Section'),
        'description'       => __('A welcome section with text on left and image on right.'),
        'render_template'   => 'template-parts/blocks/welcome.php',
        'category'          => 'layout',
        'icon'              => 'align-pull-left',
        'keywords'          => array('welcome', 'intro', 'image', 'text'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'section-header',
        'title'             => __('Section Header'),
        'description'       => __('A section header with title in colored background.'),
        'render_template'   => 'template-parts/blocks/section_header.php',
        'category'          => 'layout',
        'icon'              => 'heading',
        'keywords'          => array('header', 'title', 'section'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'about-section',
        'title'             => __('About Section'),
        'description'       => __('An about section with text content and images.'),
        'render_template'   => 'template-parts/blocks/about.php',
        'category'          => 'layout',
        'icon'              => 'info',
        'keywords'          => array('about', 'content', 'images'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'stats-section',
        'title'             => __('Stats Section'),
        'description'       => __('A statistics section with numerical data and counters.'),
        'render_template'   => 'template-parts/blocks/stats.php',
        'category'          => 'layout',
        'icon'              => 'chart-bar',
        'keywords'          => array('stats', 'numbers', 'counters'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'customers-section',
        'title'             => __('Customers Section'),
        'description'       => __('A section to showcase customer logos in a grid.'),
        'render_template'   => 'template-parts/blocks/customers.php',
        'category'          => 'layout',
        'icon'              => 'groups',
        'keywords'          => array('customers', 'clients', 'logos'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'faq-section',
        'title'             => __('FAQ Section'),
        'description'       => __('A FAQ section with accordion functionality.'),
        'render_template'   => 'template-parts/blocks/faq.php',
        'category'          => 'layout',
        'icon'              => 'editor-help',
        'keywords'          => array('faq', 'questions', 'accordion'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'intro-section',
        'title'             => __('Intro Section'),
        'description'       => __('A modern intro section with text and media (image/video).'),
        'render_template'   => 'template-parts/blocks/intro.php',
        'category'          => 'layout',
        'icon'              => 'align-left',
        'keywords'          => array('intro', 'welcome', 'video', 'media'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'image-rollovers',
        'title'             => __('Image Rollovers'),
        'description'       => __('A grid of images that reveal content on hover.'),
        'render_template'   => 'template-parts/blocks/image_rollovers.php',
        'category'          => 'layout',
        'icon'              => 'images-alt2',
        'keywords'          => array('images', 'grid', 'hover', 'rollovers'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'awards-section',
        'title'             => __('Awards Section'),
        'description'       => __('A section to showcase awards and achievements.'),
        'render_template'   => 'template-parts/blocks/awards.php',
        'category'          => 'layout',
        'icon'              => 'awards',
        'keywords'          => array('awards', 'achievements', 'recognition'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'coverage-section',
        'title'             => __('Coverage Section'),
        'description'       => __('A section to showcase engineer coverage with postcode search and Google Maps.'),
        'render_template'   => 'template-parts/blocks/coverage.php',
        'category'          => 'layout',
        'icon'              => 'location-alt',
        'keywords'          => array('coverage', 'engineers', 'map', 'postcode'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'features-section',
        'title'             => __('Features Section'),
        'description'       => __('A section with three columns showcasing features with icons and bullet points.'),
        'render_template'   => 'template-parts/blocks/features.php',
        'category'          => 'layout',
        'icon'              => 'editor-ul',
        'keywords'          => array('features', 'benefits', 'columns', 'icons'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'small-hero-section',
        'title'             => __('Small Hero Section'),
        'description'       => __('A compact hero section with customizable title, background image and overlay.'),
        'render_template'   => 'template-parts/blocks/small_hero.php',
        'category'          => 'layout',
        'icon'              => 'format-image',
        'keywords'          => array('hero', 'banner', 'header', 'small'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'reviews-section',
        'title'             => __('Reviews Section'),
        'description'       => __('A slider showcasing customer reviews and testimonials.'),
        'render_template'   => 'template-parts/blocks/reviews.php',
        'category'          => 'layout',
        'icon'              => 'testimonial',
        'keywords'          => array('reviews', 'testimonials', 'slider', 'quotes'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'careers-section',
        'title'             => __('Careers Section'),
        'description'       => __('A grid layout displaying job openings and career opportunities.'),
        'render_template'   => 'template-parts/blocks/careers.php',
        'category'          => 'layout',
        'icon'              => 'businessperson',
        'keywords'          => array('careers', 'jobs', 'positions', 'employment', 'hiring'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'blog-section',
        'title'             => __('Blog Section'),
        'description'       => __('A grid layout displaying blog posts and articles.'),
        'render_template'   => 'template-parts/blocks/blog.php',
        'category'          => 'layout',
        'icon'              => 'welcome-write-blog',
        'keywords'          => array('blog', 'posts', 'articles', 'news', 'insights'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'projects-section',
        'title'             => __('Projects Section'),
        'description'       => __('A grid layout displaying projects from selected categories.'),
        'render_template'   => 'template-parts/blocks/projects.php',
        'category'          => 'layout',
        'icon'              => 'portfolio',
        'keywords'          => array('projects', 'portfolio', 'work', 'case studies'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'new-coverage-section',
        'title'             => __('New Coverage Section'),
        'description'       => __('A coverage section with left image and title overlay, plus right image.'),
        'render_template'   => 'template-parts/blocks/new-coverage.php',
        'category'          => 'layout',
        'icon'              => 'images-alt2',
        'keywords'          => array('coverage', 'images', 'title', 'overlay'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'new-planned-maintenance-section',
        'title'             => __('New Planned Maintenance Section'),
        'description'       => __('A planned maintenance section with timeline grid and vehicle icons.'),
        'render_template'   => 'template-parts/blocks/new-planned-maintenance.php',
        'category'          => 'layout',
        'icon'              => 'car',
        'keywords'          => array('maintenance', 'planned', 'vehicle', 'timeline', 'grid'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'new-delivery-section',
        'title'             => __('New Delivery Section'),
        'description'       => __('A delivery section with center image and positioned feature icons.'),
        'render_template'   => 'template-parts/blocks/new-delivery.php',
        'category'          => 'layout',
        'icon'              => 'location',
        'keywords'          => array('delivery', 'features', 'icons', 'positioned'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'new-reactive-maintenance-section',
        'title'             => __('New Reactive Maintenance Section'),
        'description'       => __('A reactive maintenance timeline with rollover effects and SVG endpoints.'),
        'render_template'   => 'template-parts/blocks/new-reactive-maintenance.php',
        'category'          => 'layout',
        'icon'              => 'clock',
        'keywords'          => array('reactive', 'maintenance', 'timeline', 'rollover', 'hover'),
        'supports'          => $supports,
    ));
    
    // Greycaine Layout Blocks
    acf_register_block_type(array(
        'name'              => 'dynamic-hero',
        'title'             => __('Dynamic Hero'),
        'description'       => __('Advanced hero section with video/image support, multiple slides, and extensive customization options.'),
        'render_template'   => 'template-parts/blocks/dynamic-hero.php',
        'category'          => 'layout',
        'icon'              => 'format-video',
        'keywords'          => array('hero', 'video', 'slider', 'contact', 'form', 'advanced', 'dynamic'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'layout-hero',
        'title'             => __('Layout Hero (Legacy)'),
        'description'       => __('Legacy hero section with image slider and contact form.'),
        'render_template'   => 'template-parts/blocks/layout-hero.php',
        'category'          => 'layout',
        'icon'              => 'cover-image',
        'keywords'          => array('hero', 'slider', 'contact', 'form', 'legacy'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'layout-video-hero',
        'title'             => __('Layout Video Hero'),
        'description'       => __('Hero section with video background and contact form.'),
        'render_template'   => 'template-parts/blocks/layout-video-hero.php',
        'category'          => 'layout',
        'icon'              => 'video-alt3',
        'keywords'          => array('hero', 'video', 'contact', 'form'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'layout-content-image',
        'title'             => __('Layout Content Image'),
        'description'       => __('Content section with text and offset images.'),
        'render_template'   => 'template-parts/blocks/layout-content-image.php',
        'category'          => 'layout',
        'icon'              => 'align-pull-left',
        'keywords'          => array('content', 'image', 'text', 'offset'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'layout-slider',
        'title'             => __('Layout Slider'),
        'description'       => __('Image slider with categories and links.'),
        'render_template'   => 'template-parts/blocks/layout-slider.php',
        'category'          => 'layout',
        'icon'              => 'images-alt2',
        'keywords'          => array('slider', 'images', 'categories', 'grid'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'layout-product',
        'title'             => __('Layout Product'),
        'description'       => __('Product showcase with image slider and descriptions.'),
        'render_template'   => 'template-parts/blocks/layout-product.php',
        'category'          => 'layout',
        'icon'              => 'products',
        'keywords'          => array('product', 'showcase', 'slider', 'gallery'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'layout-products-by-category',
        'title'             => __('Layout Products by Category'),
        'description'       => __('Display products filtered by category with breadcrumbs.'),
        'render_template'   => 'template-parts/blocks/layout-products-by-category.php',
        'category'          => 'layout',
        'icon'              => 'category',
        'keywords'          => array('products', 'category', 'grid', 'breadcrumbs'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'layout-contact',
        'title'             => __('Layout Contact'),
        'description'       => __('Contact section layout.'),
        'render_template'   => 'template-parts/blocks/layout-contact.php',
        'category'          => 'layout',
        'icon'              => 'email-alt',
        'keywords'          => array('contact', 'section'),
        'supports'          => $supports,
    ));
    
    acf_register_block_type(array(
        'name'              => 'testimonials-slider',
        'title'             => __('Testimonials Slider'),
        'description'       => __('A slider to display customer testimonials with customizable styling.'),
        'render_template'   => 'template-parts/blocks/testimonials-slider.php',
        'category'          => 'layout',
        'icon'              => 'format-quote',
        'keywords'          => array('testimonials', 'slider', 'reviews', 'quotes', 'customers'),
        'supports'          => $supports,
    ));
}

// Custom Walker Class for Desktop Menu
if (!class_exists('Custom_Walker_Nav_Menu')) {
    class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
        function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
            $indent = ($depth) ? str_repeat("\t", $depth) : '';
            $classes = empty($item->classes) ? array() : (array) $item->classes;
            
            // Create the class attribute
            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
            
            // Start the element
            $output .= $indent;
            
            // Create the item HTML
            $atts = array();
            $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
            $atts['target'] = !empty($item->target) ? $item->target : '';
            $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
            $atts['href']   = !empty($item->url) ? $item->url : '';
            
            // Add classes for styling
            $atts['class']  = 'text-gray-700 hover:text-primary group';
            
            // Add animation for top-level items
            if ($depth === 0) {
                $delay = 100 + ($item->menu_order * 100);
                $atts['data-aos'] = 'fade-down';
                $atts['data-aos-delay'] = $delay;
            }
            
            // Build the HTML attributes
            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }
            
            // Start the item element
            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
            
            $output .= $item_output;
        }
    }
}

// Custom Walker Class for Mobile Menu
if (!class_exists('Mobile_Walker_Nav_Menu')) {
    class Mobile_Walker_Nav_Menu extends Walker_Nav_Menu {
        function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
            $indent = ($depth) ? str_repeat("\t", $depth) : '';
            $classes = empty($item->classes) ? array() : (array) $item->classes;
            
            // Create the class attribute
            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
            
            // Start the element
            $output .= $indent;
            
            // Create the item HTML
            $atts = array();
            $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
            $atts['target'] = !empty($item->target) ? $item->target : '';
            $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
            $atts['href']   = !empty($item->url) ? $item->url : '';
            
            // Add classes for styling for mobile
            $atts['class']  = 'text-gray-700 lg:hover:text-white/90 py-2 block lg:text-2xl lg:text-white';
            
            // Build the HTML attributes
            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }
            
            // Start the item element
            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
            
            $output .= $item_output;
        }
    }
}