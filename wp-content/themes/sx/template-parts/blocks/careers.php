<?php
/**
 * Careers Section Layout
 *
 * @package SX
 */

// Block fields
$section_title = get_field('section_title') ?: 'Join Our Team';
$section_subtitle = get_field('section_subtitle') ?: 'Explore exciting career opportunities';
$background_color = get_field('background_color') ?: '#ffffff';
$card_background = get_field('card_background') ?: '#f9fafb';
$button_text = get_field('button_text') ?: 'Apply Now';
$contact_page_link = get_field('contact_page_link');
$positions_limit = get_field('positions_limit') ?: -1;
$show_featured_only = get_field('show_featured_only');
$empty_message = get_field('empty_message') ?: 'We don\'t have any open positions at the moment, but we\'re always interested in hearing from talented individuals. Please send your CV to careers@company.com';

// Build query arguments
$args = array(
    'post_type' => 'careers',
    'posts_per_page' => $positions_limit,
    'orderby' => 'date',
    'order' => 'DESC'
);

// Add featured filter if enabled
if ($show_featured_only) {
    $args['meta_query'] = array(
        array(
            'key' => 'featured_position',
            'value' => '1',
            'compare' => '='
        )
    );
}

$positions = get_posts($args);
?>

<section class="py-20" style="background-color: <?php echo esc_attr($background_color); ?>;">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <?php if ($section_title || $section_subtitle) : ?>
            <div class="text-center mb-12">
                <?php if ($section_title) : ?>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900" data-animation="fadeUp">
                        <?php echo esc_html($section_title); ?>
                    </h2>
                <?php endif; ?>
                <?php if ($section_subtitle) : ?>
                    <p class="text-lg text-gray-600" data-animation="fadeUp" data-delay="100">
                        <?php echo esc_html($section_subtitle); ?>
                    </p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($positions) : ?>
            <!-- Positions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <?php foreach ($positions as $index => $position) : 
                    $job_description = get_field('job_description', $position->ID);
                    $job_location = get_field('job_location', $position->ID);
                    $employment_type = get_field('employment_type', $position->ID);
                    $department = get_field('department', $position->ID);
                    $salary_range = get_field('salary_range', $position->ID);
                    $is_featured = get_field('featured_position', $position->ID);
                    
                    // Employment type labels
                    $type_labels = array(
                        'full-time' => 'Full Time',
                        'part-time' => 'Part Time',
                        'contract' => 'Contract',
                        'freelance' => 'Freelance',
                        'internship' => 'Internship'
                    );
                    $type_label = $type_labels[$employment_type] ?? 'Full Time';
                ?>
                    <div class="group hover:shadow-xl transition-all duration-300 rounded-lg overflow-hidden transform hover:-translate-y-1" 
                         style="background-color: <?php echo esc_attr($card_background); ?>;"
                         data-animation="fadeUp" 
                         data-delay="<?php echo $index * 100; ?>">
                        
                        <?php if ($is_featured) : ?>
                            <div class="bg-red-600 text-white text-xs font-semibold px-3 py-1 text-center">
                                FEATURED
                            </div>
                        <?php endif; ?>
                        
                        <div class="p-6">
                            <!-- Position Title -->
                            <h3 class="text-xl font-bold mb-3 text-gray-900 group-hover:text-red-600 transition-colors">
                                <?php echo esc_html($position->post_title); ?>
                            </h3>
                            
                            <!-- Meta Information -->
                            <div class="flex flex-wrap gap-4 mb-4 text-sm text-gray-600">
                                <?php if ($job_location) : ?>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <?php echo esc_html($job_location); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <?php echo esc_html($type_label); ?>
                                </div>
                                
                                <?php if ($department) : ?>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                        <?php echo esc_html($department); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <?php if ($salary_range) : ?>
                                <div class="text-sm text-gray-600 mb-4">
                                    <strong>Salary:</strong> <?php echo esc_html($salary_range); ?>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Job Description (Excerpt) -->
                            <div class="text-gray-600 mb-6 line-clamp-3">
                                <?php 
                                // Strip tags and get excerpt
                                $description_text = wp_strip_all_tags($job_description);
                                $excerpt = wp_trim_words($description_text, 30, '...');
                                echo esc_html($excerpt);
                                ?>
                            </div>
                            
                            <!-- View Details Button -->
                            <div class="flex gap-3">
                                <a href="<?php echo get_permalink($position->ID); ?>" 
                                   class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 text-sm">
                                    View Details
                                </a>
                                <a href="<?php echo esc_url($contact_page_link); ?>?position=<?php echo urlencode($position->post_title); ?>" 
                                   class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-full transition duration-300 uppercase tracking-wider text-sm">
                                    <?php echo esc_html($button_text); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <!-- No Positions Message -->
            <div class="text-center py-12">
                <div class="max-w-2xl mx-auto">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-gray-600 text-lg">
                        <?php echo wp_kses_post($empty_message); ?>
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
/* Line clamp utility for job description */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>