<?php
/**
 * Sample Testimonials Creator
 * Run this once to create sample testimonials for testing
 */

function create_sample_testimonials() {
    // Check if we already have testimonials
    $existing = get_posts(array(
        'post_type' => 'testimonial',
        'posts_per_page' => 1,
        'post_status' => 'publish'
    ));
    
    if (!empty($existing)) {
        return false; // Already have testimonials
    }
    
    $sample_testimonials = array(
        array(
            'title' => 'Great Service',
            'quote' => 'The fire looks amazing and very high quality. Fire effect great and cost look. Everyone who has seen it is very impressed. Would highly recommend the product. Clear instructions and easy to register. Great',
            'customer_name' => 'Nick Pilkington',
            'customer_location' => '',
            'star_rating' => 5,
            'featured' => true
        ),
        array(
            'title' => 'Excellent Quality',
            'quote' => 'Outstanding service and product quality. The installation was seamless and the team was professional throughout.',
            'customer_name' => 'Sarah Johnson',
            'customer_location' => 'Manchester',
            'star_rating' => 5,
            'featured' => false
        ),
        array(
            'title' => 'Highly Recommended',
            'quote' => 'Fantastic fireplace that has transformed our living room. The efficiency is incredible and the design is beautiful.',
            'customer_name' => 'Michael Brown',
            'customer_location' => 'London',
            'star_rating' => 5,
            'featured' => true
        ),
        array(
            'title' => 'Perfect Installation',
            'quote' => 'From consultation to installation, everything was handled professionally. Could not be happier with the result.',
            'customer_name' => 'Emma Wilson',
            'customer_location' => 'Birmingham',
            'star_rating' => 4,
            'featured' => false
        )
    );
    
    foreach ($sample_testimonials as $testimonial) {
        $post_id = wp_insert_post(array(
            'post_title' => $testimonial['title'],
            'post_type' => 'testimonial',
            'post_status' => 'publish',
            'post_author' => 1
        ));
        
        if ($post_id && !is_wp_error($post_id)) {
            update_field('testimonial_quote', $testimonial['quote'], $post_id);
            update_field('customer_name', $testimonial['customer_name'], $post_id);
            update_field('customer_location', $testimonial['customer_location'], $post_id);
            update_field('star_rating', $testimonial['star_rating'], $post_id);
            update_field('featured_testimonial', $testimonial['featured'], $post_id);
        }
    }
    
    return true;
}

// Hook to create sample testimonials (remove after testing)
add_action('init', function() {
    if (isset($_GET['create_sample_testimonials']) && current_user_can('administrator')) {
        $created = create_sample_testimonials();
        if ($created) {
            wp_redirect(admin_url('edit.php?post_type=testimonial&message=created'));
            exit;
        } else {
            wp_redirect(admin_url('edit.php?post_type=testimonial&message=exists'));
            exit;
        }
    }
});