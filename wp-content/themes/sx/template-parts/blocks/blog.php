<?php
/**
 * Blog Section Layout
 *
 * @package SX
 */

// Block fields
$section_title = get_field('section_title') ?: 'Latest News & Insights';
$section_subtitle = get_field('section_subtitle') ?: 'Stay updated with our latest articles and industry insights';
$background_color = get_field('background_color') ?: '#ffffff';
$card_background = get_field('card_background') ?: '#f9fafb';
$button_text = get_field('button_text') ?: 'Read More';
$posts_limit = get_field('posts_limit') ?: 6;
$filter_categories = get_field('filter_categories');
$show_excerpt = get_field('show_excerpt');
$show_author = get_field('show_author');
$show_date = get_field('show_date');
$show_categories = get_field('show_categories');

// Build query arguments
$args = array(
    'post_type' => 'post',
    'posts_per_page' => $posts_limit,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish'
);

// Add category filter if selected
if ($filter_categories && !empty($filter_categories)) {
    $args['category__in'] = $filter_categories;
}

$posts = get_posts($args);
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
        
        <?php if ($posts) : ?>
            <!-- Posts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <?php foreach ($posts as $index => $post) : 
                    setup_postdata($post);
                    $categories = get_the_category($post->ID);
                    $featured_image = get_the_post_thumbnail_url($post->ID, 'medium_large');
                    $author_name = get_the_author_meta('display_name', $post->post_author);
                    $post_date = get_the_date('', $post->ID);
                    $excerpt = has_excerpt($post->ID) ? get_the_excerpt($post->ID) : wp_trim_words($post->post_content, 20);
                ?>
                    <article class="group hover:shadow-xl transition-all duration-300 rounded-lg overflow-hidden transform hover:-translate-y-1" 
                             style="background-color: <?php echo esc_attr($card_background); ?>;"
                             data-animation="fadeUp" 
                             data-delay="<?php echo $index * 100; ?>">
                        
                        <!-- Featured Image -->
                        <a href="<?php echo get_permalink($post->ID); ?>" class="block overflow-hidden">
                            <?php if ($featured_image) : ?>
                                <div class="relative overflow-hidden h-[16rem]">
                                    <img src="<?php echo esc_url($featured_image); ?>" 
                                         alt="<?php echo esc_attr($post->post_title); ?>" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            <?php else : ?>
                                <div class="bg-gray-200 h-48 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </a>
                        
                        <div class="p-6">
                            <!-- Categories -->
                            <?php if ($show_categories && $categories) : ?>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    <?php foreach ($categories as $category) : ?>
                                        <span class="inline-block bg-red-100 text-red-600 text-xs font-semibold px-2 py-1 rounded">
                                            <?php echo esc_html($category->name); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Title -->
                            <h3 class="text-xl font-bold mb-3 text-gray-900 group-hover:text-red-600 transition-colors">
                                <a href="<?php echo get_permalink($post->ID); ?>" class="hover:text-red-600">
                                    <?php echo esc_html($post->post_title); ?>
                                </a>
                            </h3>
                            
                            <!-- Meta Information -->
                            <?php if ($show_author || $show_date) : ?>
                                <div class="flex items-center gap-4 mb-3 text-sm text-gray-600">
                                    <?php if ($show_author) : ?>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <?php echo esc_html($author_name); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($show_date) : ?>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <?php echo esc_html($post_date); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Excerpt -->
                            <?php if ($show_excerpt) : ?>
                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    <?php echo esc_html($excerpt); ?>
                                </p>
                            <?php endif; ?>
                            
                            <!-- Read More Button -->
                            <a href="<?php echo get_permalink($post->ID); ?>" 
                               class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-full transition duration-300 uppercase tracking-wider text-sm">
                                <?php echo esc_html($button_text); ?>
                            </a>
                        </div>
                    </article>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>
        <?php else : ?>
            <!-- No Posts Message -->
            <div class="text-center py-12">
                <div class="max-w-2xl mx-auto">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <p class="text-gray-600 text-lg">
                        No posts found. Check back soon for new content!
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
/* Line clamp utility for excerpt */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Aspect ratio for images */
.aspect-w-16 {
    position: relative;
    padding-bottom: 56.25%;
}

.aspect-w-16 > img {
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}
</style>