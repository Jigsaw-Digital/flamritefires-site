<?php
/**
 * Search Results Template
 *
 * @package SX
 */

get_header();

global $wp_query;
$total_results = $wp_query->found_posts;
$search_query = get_search_query();

// Group results by post type
$results_by_type = array();
if (have_posts()) {
    while (have_posts()) {
        the_post();
        $post_type = get_post_type();
        if (!isset($results_by_type[$post_type])) {
            $results_by_type[$post_type] = array();
        }
        $results_by_type[$post_type][] = $post;
    }
    wp_reset_postdata();
}

// Post type labels
$post_type_labels = array(
    'post' => 'Blog Posts',
    'page' => 'Pages',
    'careers' => 'Career Opportunities',
    'projects' => 'Projects',
    'reviews' => 'Reviews',
    'faqs' => 'FAQs'
);
?>

<!-- Search Hero -->
<section class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">Search Results</h1>
            <?php if ($search_query) : ?>
                <p class="text-lg text-gray-600">
                    <?php echo $total_results; ?> result<?php echo $total_results !== 1 ? 's' : ''; ?> found for 
                    <span class="font-semibold">"<?php echo esc_html($search_query); ?>"</span>
                </p>
            <?php endif; ?>
        </div>
        
        <!-- Search Form -->
        <div class="max-w-2xl mx-auto mt-8">
            <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                <div class="flex gap-2">
                    <input type="text" 
                           name="s" 
                           placeholder="Search again..." 
                           class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-red-600"
                           value="<?php echo esc_attr($search_query); ?>">
                    <button type="submit" 
                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-lg transition duration-300">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Search Results -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <?php if (!empty($results_by_type)) : ?>
            <?php foreach ($results_by_type as $post_type => $posts) : ?>
                <div class="mb-12">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900">
                        <?php echo isset($post_type_labels[$post_type]) ? $post_type_labels[$post_type] : ucfirst($post_type) . 's'; ?>
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach ($posts as $post) : 
                            setup_postdata($post);
                            
                            // Get post-specific data
                            $featured_image = get_the_post_thumbnail_url($post->ID, 'medium_large');
                            $excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 20);
                            
                            // Post type specific data
                            $meta_info = array();
                            $post_type_label = '';
                            $post_type_color = '';
                            
                            switch ($post_type) {
                                case 'post':
                                    $post_type_label = 'Blog';
                                    $post_type_color = 'bg-blue-100 text-blue-800';
                                    $categories = get_the_category();
                                    if ($categories) {
                                        $meta_info[] = $categories[0]->name;
                                    }
                                    $meta_info[] = get_the_date();
                                    break;
                                    
                                case 'careers':
                                    $post_type_label = 'Career';
                                    $post_type_color = 'bg-green-100 text-green-800';
                                    $location = get_field('job_location', $post->ID);
                                    $employment_type = get_field('employment_type', $post->ID);
                                    if ($location) $meta_info[] = $location;
                                    if ($employment_type) {
                                        $type_labels = array(
                                            'full-time' => 'Full Time',
                                            'part-time' => 'Part Time',
                                            'contract' => 'Contract',
                                            'freelance' => 'Freelance',
                                            'internship' => 'Internship'
                                        );
                                        $meta_info[] = $type_labels[$employment_type] ?? 'Full Time';
                                    }
                                    $excerpt = wp_trim_words(strip_tags(get_field('job_description', $post->ID)), 20);
                                    break;
                                    
                                case 'projects':
                                    $post_type_label = 'Project';
                                    $post_type_color = 'bg-purple-100 text-purple-800';
                                    $client = get_field('client_name', $post->ID);
                                    $value = get_field('project_value', $post->ID);
                                    if ($client) $meta_info[] = $client;
                                    if ($value) $meta_info[] = $value;
                                    $excerpt = get_field('project_description', $post->ID);
                                    break;
                                    
                                case 'reviews':
                                    $post_type_label = 'Review';
                                    $post_type_color = 'bg-yellow-100 text-yellow-800';
                                    $rating = get_field('review_rating', $post->ID);
                                    $author = get_field('reviewer_name', $post->ID);
                                    if ($rating) $meta_info[] = $rating . '/5 Stars';
                                    if ($author) $meta_info[] = 'By ' . $author;
                                    $excerpt = wp_trim_words(get_field('review_content', $post->ID), 20);
                                    break;
                                    
                                case 'faqs':
                                    $post_type_label = 'FAQ';
                                    $post_type_color = 'bg-orange-100 text-orange-800';
                                    $categories = get_the_terms($post->ID, 'faq_category');
                                    if ($categories && !is_wp_error($categories)) {
                                        $meta_info[] = $categories[0]->name;
                                    }
                                    $excerpt = wp_trim_words(strip_tags(get_field('faq_answer', $post->ID)), 20);
                                    break;
                                    
                                default:
                                    $post_type_label = ucfirst($post_type);
                                    $post_type_color = 'bg-gray-100 text-gray-800';
                            }
                        ?>
                            <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group">
                                <!-- Post Type Label -->
                                <div class="px-6 pt-4">
                                    <span class="inline-block <?php echo $post_type_color; ?> text-xs font-semibold px-3 py-1 rounded-full">
                                        <?php echo $post_type_label; ?>
                                    </span>
                                </div>
                                
                                <!-- Featured Image -->
                                <?php if ($featured_image) : ?>
                                    <a href="<?php the_permalink(); ?>" class="block overflow-hidden px-6 pt-2">
                                        <div class="rounded-lg overflow-hidden h-48">
                                            <img src="<?php echo esc_url($featured_image); ?>" 
                                                 alt="<?php echo esc_attr(get_the_title()); ?>" 
                                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        </div>
                                    </a>
                                <?php else : ?>
                                    <div class="px-6 pt-2">
                                        <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Content -->
                                <div class="p-6">
                                    <!-- Title -->
                                    <h3 class="text-xl font-bold mb-2 text-gray-900 group-hover:text-red-600 transition-colors">
                                        <a href="<?php the_permalink(); ?>" class="hover:text-red-600">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    
                                    <!-- Meta Information -->
                                    <?php if (!empty($meta_info)) : ?>
                                        <div class="flex items-center gap-3 mb-3 text-sm text-gray-600">
                                            <?php echo implode(' • ', array_map('esc_html', $meta_info)); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Excerpt -->
                                    <?php if ($excerpt) : ?>
                                        <p class="text-gray-600 mb-4 line-clamp-3">
                                            <?php echo esc_html($excerpt); ?>
                                        </p>
                                    <?php endif; ?>
                                    
                                    <!-- Read More Button -->
                                    <a href="<?php the_permalink(); ?>" 
                                       class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-full transition duration-300 text-sm">
                                        View Details
                                    </a>
                                </div>
                            </article>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <!-- No Results -->
            <div class="text-center py-12">
                <div class="max-w-2xl mx-auto">
                    <svg class="w-24 h-24 mx-auto mb-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <h2 class="text-2xl font-bold mb-4 text-gray-900">No results found</h2>
                    <p class="text-gray-600 mb-8">
                        Sorry, we couldn't find any results matching "<?php echo esc_html($search_query); ?>". 
                        Please try different keywords or browse our content below.
                    </p>
                    
                    <!-- Quick Links -->
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="<?php echo esc_url(home_url('/blog')); ?>" 
                           class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-full transition duration-300">
                            Browse Blog
                        </a>
                        <a href="<?php echo esc_url(home_url('/careers')); ?>" 
                           class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-full transition duration-300">
                            View Careers
                        </a>
                        <a href="<?php echo esc_url(home_url('/projects')); ?>" 
                           class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-full transition duration-300">
                            Our Projects
                        </a>
                    </div>
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
</style>

<?php get_footer(); ?>