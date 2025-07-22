<?php
/**
 * Single Project Template
 *
 * @package SX
 */

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
        $project_description = get_field('project_description');
        $project_content = get_field('project_content');
        $client_name = get_field('client_name');
        $project_date = get_field('project_date');
        $project_value = get_field('project_value');
        $project_gallery = get_field('project_gallery');
        $project_categories = get_the_terms(get_the_ID(), 'project_category');
        
        // Use first gallery image as fallback for hero if no featured image
        if (!$featured_image && $project_gallery && !empty($project_gallery)) {
            $featured_image = $project_gallery[0]['url'];
        }
        
        // Get current project category for related projects
        $current_category_id = null;
        if ($project_categories && !is_wp_error($project_categories)) {
            $current_category_id = $project_categories[0]->term_id;
        }
?>

<!-- Small Hero Section -->
<section class="relative text-white h-[400px] flex items-center overflow-hidden">
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-4xl mx-auto">
            <div class="hero-title" data-animation="fadeUp">
                <!-- Title -->
                <h1 class="text-3xl md:text-5xl font-bold mb-4">
                    <?php the_title(); ?>
                </h1>
                
                <!-- Meta Information -->
                <div class="flex items-center justify-center gap-6 text-sm text-gray-200">
                    <?php if ($client_name) : ?>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <?php echo esc_html($client_name); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($project_date) : ?>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <?php echo esc_html($project_date); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($project_value) : ?>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <?php echo esc_html($project_value); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($project_categories) : ?>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <?php echo esc_html($project_categories[0]->name); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Background Image with Overlay -->
    <?php if ($featured_image) : ?>
        <div class="absolute inset-0 z-[-1]">
            <img src="<?php echo esc_url($featured_image); ?>" 
                 alt="<?php echo esc_attr(get_the_title()); ?>" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>
    <?php else : ?>
        <!-- Fallback gradient background if no featured image -->
        <div class="absolute inset-0 z-[-1] bg-gradient-to-r from-gray-800 to-gray-900"></div>
    <?php endif; ?>
</section>

<!-- Project Content -->
<article class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Project Description Box -->
            <?php if ($project_description || $project_value) : ?>
                <div class="bg-gray-100 p-8 rounded-lg mb-12">
                    <?php if ($project_value) : ?>
                        <div class="mb-4 pb-4 border-b border-gray-300">
                            <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-1">Project Value</h3>
                            <p class="text-2xl font-bold text-gray-900"><?php echo esc_html($project_value); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if ($project_description) : ?>
                        <p class="text-lg text-gray-700 leading-relaxed">
                            <?php echo ($project_description); ?>
                        </p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <!-- Project Content -->
            <?php if ($project_content) : ?>
                <div class="prose prose-lg max-w-none mb-12">
                    <?php echo wp_kses_post($project_content); ?>
                </div>
            <?php endif; ?>
            
            <!-- Project Gallery -->
            <?php if ($project_gallery) : ?>
                <div class="mb-12">
                    <h2 class="text-2xl font-bold mb-6">Project Gallery</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <?php foreach ($project_gallery as $image) : ?>
                            <a href="<?php echo esc_url($image['url']); ?>" 
                               class="block overflow-hidden rounded-lg group"
                               data-lightbox="project-gallery">
                                <img src="<?php echo esc_url($image['sizes']['medium_large']); ?>" 
                                     alt="<?php echo esc_attr($image['alt']); ?>" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</article>

<!-- Other Projects from Same Category -->
<?php if ($current_category_id) :
    $related_args = array(
        'post_type' => 'projects',
        'posts_per_page' => 3,
        'post__not_in' => array(get_the_ID()),
        'tax_query' => array(
            array(
                'taxonomy' => 'project_category',
                'field' => 'term_id',
                'terms' => $current_category_id
            )
        ),
        'orderby' => 'rand'
    );
    
    $related_projects = get_posts($related_args);
    
    if ($related_projects) :
?>
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-center mb-8">View Other Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <?php foreach ($related_projects as $related_project) : 
                    $related_image = get_the_post_thumbnail_url($related_project->ID, 'medium_large');
                    $related_description = get_field('project_description', $related_project->ID);
                    $related_client = get_field('client_name', $related_project->ID);
                    $related_value = get_field('project_value', $related_project->ID);
                ?>
                    <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow group">
                        <a href="<?php echo get_permalink($related_project->ID); ?>" class="block">
                            <?php if ($related_image) : ?>
                                <div class="overflow-hidden">
                                    <img src="<?php echo esc_url($related_image); ?>" 
                                         alt="<?php echo esc_attr($related_project->post_title); ?>" 
                                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            <?php else : ?>
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </a>
                        <div class="p-5">
                            <h3 class="font-semibold text-lg mb-2">
                                <a href="<?php echo get_permalink($related_project->ID); ?>" class="text-gray-900 hover:text-red-600 transition-colors">
                                    <?php echo esc_html($related_project->post_title); ?>
                                </a>
                            </h3>
                            <?php if ($related_value) : ?>
                                <div class="mb-2">
                                    <span class="inline-block bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded">
                                        <?php echo esc_html($related_value); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            <?php if ($related_client) : ?>
                                <p class="text-sm text-gray-500 mb-2"><?php echo esc_html($related_client); ?></p>
                            <?php endif; ?>
                            <?php if ($related_description) : ?>
                                <p class="text-sm text-gray-600 line-clamp-2">
                                    <?php echo esc_html(wp_trim_words($related_description, 20)); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; endif; ?>

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

.prose a {
    color: #dc2626;
    text-decoration: underline;
}

.prose a:hover {
    color: #b91c1c;
}

.prose img {
    max-width: 100%;
    height: auto;
    margin: 2rem auto;
    border-radius: 0.5rem;
}

.prose ul, .prose ol {
    margin-bottom: 1.25rem;
    padding-left: 1.5rem;
}

.prose ul li {
    list-style-type: disc;
}

.prose ol li {
    list-style-type: decimal;
}

/* Line clamp for related projects */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>