<?php
/**
 * Projects Section Layout
 *
 * @package SX
 */

// Block fields
$section_title = get_field('section_title') ?: 'Our Projects';
$section_subtitle = get_field('section_subtitle') ?: 'Explore our portfolio of successful projects';
$category_filter = get_field('category_filter');
$posts_per_page = get_field('posts_per_page') ?: 9;
$grid_columns = get_field('grid_columns') ?: '3';
$show_description = get_field('show_description');
$show_client = get_field('show_client');
$show_date = get_field('show_date');
$show_category = get_field('show_category');
$background_color = get_field('background_color') ?: '#f9fafb';

// Build query arguments
$args = array(
    'post_type' => 'projects',
    'posts_per_page' => $posts_per_page,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish'
);

// Add category filter if selected
if ($category_filter) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'project_category',
            'field' => 'term_id',
            'terms' => $category_filter
        )
    );
}

$projects = get_posts($args);

// Grid column classes
$grid_classes = array(
    '2' => 'md:grid-cols-2',
    '3' => 'md:grid-cols-2 lg:grid-cols-3',
    '4' => 'md:grid-cols-2 lg:grid-cols-4'
);
$grid_class = $grid_classes[$grid_columns] ?? $grid_classes['3'];
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
        
        <?php if ($projects) : ?>
            <!-- Projects Grid -->
            <div class="grid grid-cols-1 <?php echo esc_attr($grid_class); ?> gap-6 lg:gap-8">
                <?php foreach ($projects as $index => $project) : 
                    $featured_image = get_the_post_thumbnail_url($project->ID, 'large');
                    $project_description = get_field('project_description', $project->ID);
                    $client_name = get_field('client_name', $project->ID);
                    $project_date = get_field('project_date', $project->ID);
                    $project_value = get_field('project_value', $project->ID);
                    $project_categories = get_the_terms($project->ID, 'project_category');
                ?>
                    <article class="group bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" 
                             data-animation="fadeUp" 
                             data-delay="<?php echo $index * 100; ?>">
                        
                        <!-- Project Image -->
                        <a href="<?php echo get_permalink($project->ID); ?>" class="block overflow-hidden aspect-w-16 aspect-h-12">
                            <?php if ($featured_image) : ?>
                                <img src="<?php echo esc_url($featured_image); ?>" 
                                     alt="<?php echo esc_attr($project->post_title); ?>" 
                                     class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                            <?php else : ?>
                                <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </a>
                        
                        <!-- Project Content -->
                        <div class="p-6">
                            <!-- Category -->
                            <?php if ($show_category && $project_categories) : ?>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    <?php foreach ($project_categories as $category) : ?>
                                        <span class="inline-block bg-red-100 text-red-600 text-xs font-semibold px-2 py-1 rounded">
                                            <?php echo esc_html($category->name); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Title -->
                            <h3 class="text-xl font-bold mb-2 text-gray-900 group-hover:text-red-600 transition-colors">
                                <a href="<?php echo get_permalink($project->ID); ?>">
                                    <?php echo esc_html($project->post_title); ?>
                                </a>
                            </h3>
                            
                            <!-- Project Value -->
                            <?php if ($project_value) : ?>
                                <div class="mb-3">
                                    <span class="inline-block bg-green-100 text-green-800 text-sm font-bold px-3 py-1 rounded">
                                        <?php echo esc_html($project_value); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Meta Information -->
                            <?php if (($show_client && $client_name) || ($show_date && $project_date)) : ?>
                                <div class="flex items-center gap-4 mb-3 text-sm text-gray-600">
                                    <?php if ($show_client && $client_name) : ?>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                            <?php echo esc_html($client_name); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($show_date && $project_date) : ?>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <?php echo esc_html($project_date); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Description -->
                            <?php if ($show_description && $project_description) : ?>
                                <p class="text-gray-600 line-clamp-3">
                                    <?php echo esc_html($project_description); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <!-- No Projects Message -->
            <div class="text-center py-12">
                <div class="max-w-2xl mx-auto">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <p class="text-gray-600 text-lg">
                        No projects found in this category.
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
/* Line clamp utility */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Aspect ratio for images */
.aspect-w-16 {
    position: relative;
    padding-bottom: 75%; /* 4:3 ratio */
}

.aspect-w-16 > img,
.aspect-w-16 > div {
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}
</style>