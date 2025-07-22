<?php
/**
 * Single Career/Position Template
 *
 * @package SX
 */

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        $job_description = get_field('job_description');
        $job_location = get_field('job_location');
        $employment_type = get_field('employment_type');
        $department = get_field('department');
        $salary_range = get_field('salary_range');
        $is_featured = get_field('featured_position');
        
        // Employment type labels
        $type_labels = array(
            'full-time' => 'Full Time',
            'part-time' => 'Part Time',
            'contract' => 'Contract',
            'freelance' => 'Freelance',
            'internship' => 'Internship'
        );
        $type_label = $type_labels[$employment_type] ?? 'Full Time';
        
        // Get contact page for apply button
        $contact_page = get_page_by_path('contact');
        $contact_url = $contact_page ? get_permalink($contact_page->ID) : '#';
?>

<!-- Small Hero Section -->
<section class="relative text-white h-[400px] flex items-center overflow-hidden">
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-4xl mx-auto">
            <div class="hero-title" data-animation="fadeUp">
                <!-- Position Type Badge -->
                <?php if ($is_featured) : ?>
                    <div class="mb-4">
                        <span class="inline-block bg-red-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                            FEATURED POSITION
                        </span>
                    </div>
                <?php endif; ?>
                
                <!-- Title -->
                <h1 class="text-3xl md:text-5xl font-bold mb-4">
                    <?php the_title(); ?>
                </h1>
                
                <!-- Meta Information -->
                <div class="flex items-center justify-center gap-6 text-sm text-gray-200 flex-wrap">
                    <?php if ($job_location) : ?>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <?php echo esc_html($job_location); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <?php echo esc_html($type_label); ?>
                    </div>
                    
                    <?php if ($department) : ?>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <?php echo esc_html($department); ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <?php if ($salary_range) : ?>
                    <div class="mt-3 text-lg text-gray-200">
                        <strong>Salary:</strong> <?php echo esc_html($salary_range); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Background gradient -->
    <div class="absolute inset-0 z-[-1] bg-gradient-to-r from-gray-800 to-gray-900"></div>
</section>

<!-- Job Content -->
<article class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <!-- Apply Button (Top) -->
            <div class="text-center mb-12">
                <a href="<?php echo esc_url($contact_url); ?>?position=<?php echo urlencode(get_the_title()); ?>" 
                   class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-full transition duration-300 uppercase tracking-wider">
                    Apply for this Position
                </a>
            </div>
            
            <!-- Job Description -->
            <div class="prose prose-lg max-w-none">
                <?php echo wp_kses_post($job_description); ?>
            </div>
            
            <!-- Apply Button (Bottom) -->
            <div class="text-center mt-12 pt-8 border-t border-gray-200">
                <h3 class="text-2xl font-bold mb-4">Interested in this position?</h3>
                <p class="text-gray-600 mb-6">We'd love to hear from you! Click below to apply.</p>
                <a href="<?php echo esc_url($contact_url); ?>?position=<?php echo urlencode(get_the_title()); ?>" 
                   class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-full transition duration-300 uppercase tracking-wider">
                    Apply Now
                </a>
            </div>
        </div>
    </div>
</article>

<!-- Other Open Positions -->
<?php
$related_args = array(
    'post_type' => 'careers',
    'posts_per_page' => 3,
    'post__not_in' => array(get_the_ID()),
    'orderby' => 'date',
    'order' => 'DESC'
);

$related_positions = get_posts($related_args);

if ($related_positions) :
?>
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-center mb-8">Other Open Positions</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <?php foreach ($related_positions as $position) : 
                    $related_location = get_field('job_location', $position->ID);
                    $related_type = get_field('employment_type', $position->ID);
                    $related_department = get_field('department', $position->ID);
                    $related_type_label = $type_labels[$related_type] ?? 'Full Time';
                ?>
                    <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow p-6">
                        <h3 class="font-semibold text-lg mb-3">
                            <a href="<?php echo get_permalink($position->ID); ?>" class="text-gray-900 hover:text-red-600 transition-colors">
                                <?php echo esc_html($position->post_title); ?>
                            </a>
                        </h3>
                        
                        <div class="space-y-2 text-sm text-gray-600 mb-4">
                            <?php if ($related_location) : ?>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <?php echo esc_html($related_location); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <?php echo esc_html($related_type_label); ?>
                            </div>
                            
                            <?php if ($related_department) : ?>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    <?php echo esc_html($related_department); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <a href="<?php echo get_permalink($position->ID); ?>" 
                           class="text-red-600 hover:text-red-700 font-medium text-sm transition-colors">
                            View Position →
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    endwhile;
endif;

get_footer();
?>

<style>
/* Prose styles for content */
.prose {
    color: #374151;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    color: #111827;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.prose h2 { font-size: 1.875rem; }
.prose h3 { font-size: 1.5rem; }
.prose h4 { font-size: 1.25rem; }

.prose p {
    margin-bottom: 1.25rem;
    line-height: 1.75;
}

.prose ul, .prose ol {
    margin-bottom: 1.25rem;
    padding-left: 1.5rem;
}

.prose ul li {
    list-style-type: disc;
    margin-bottom: 0.5rem;
}

.prose ol li {
    list-style-type: decimal;
    margin-bottom: 0.5rem;
}

.prose strong {
    font-weight: 700;
    color: #111827;
}
</style>