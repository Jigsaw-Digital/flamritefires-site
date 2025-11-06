<?php
/**
 * Search Results Template
 */

get_header();

global $wp_query;
$search_query = get_search_query();

// Handle search query variations for E-FX/EFX by doing a second query if needed
$combined_results = array();
if (stripos($search_query, 'efx') !== false || stripos($search_query, 'e-fx') !== false) {
    // Get results from original query
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            global $post;
            $combined_results[] = clone $post;
        }
        wp_reset_postdata();
    }

    // Create variation query
    $variation_query = $search_query;
    if (stripos($search_query, 'efx') !== false) {
        $variation_query = str_ireplace('efx', 'e-fx', $search_query);
    } elseif (stripos($search_query, 'e-fx') !== false) {
        $variation_query = str_ireplace('e-fx', 'efx', $search_query);
    }

    // Query for variation
    $variation_wp_query = new WP_Query(array(
        's' => $variation_query,
        'post_type' => 'any',
        'posts_per_page' => -1,
    ));

    if ($variation_wp_query->have_posts()) {
        while ($variation_wp_query->have_posts()) {
            $variation_wp_query->the_post();
            global $post;
            // Check if not already in results
            $already_exists = false;
            foreach ($combined_results as $existing_post) {
                if ($existing_post->ID === get_the_ID()) {
                    $already_exists = true;
                    break;
                }
            }
            if (!$already_exists) {
                $combined_results[] = clone $post;
            }
        }
        wp_reset_postdata();
    }

    $total_results = count($combined_results);
} else {
    $total_results = $wp_query->found_posts;
}

// Group results by post type
$results_by_type = array();
if (!empty($combined_results)) {
    // Use combined results from E-FX/EFX search
    foreach ($combined_results as $post) {
        $post_type = get_post_type($post);
        if (!isset($results_by_type[$post_type])) {
            $results_by_type[$post_type] = array();
        }
        $results_by_type[$post_type][] = $post;
    }
} elseif (have_posts()) {
    // Use regular search results
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
    'products' => 'Products',
    'documents' => 'Documents',
    'videos' => 'Videos',
    'testimonials' => 'Testimonials',
    'brochures' => 'Brochures',
);
?>

<!-- Search Hero -->
<section class="bg-tertiary py-12 lg:py-16 px-6">
    <div class="mx-auto max-w-[1200px]">
        <div class="text-center mb-8">
            <h1 class="text-3xl lg:text-4xl font-bold text-[#1e2938] mb-4">Search Results</h1>
            <?php if ($search_query): ?>
                <p class="text-lg text-[#1e2938]/80">
                    <?php echo $total_results; ?> result<?php echo $total_results !== 1 ? 's' : ''; ?> found for
                    <span class="font-semibold text-primary">"<?php echo esc_html($search_query); ?>"</span>
                </p>
            <?php endif; ?>
        </div>

        <!-- Search Form -->
        <div class="max-w-2xl mx-auto">
            <form action="<?php echo esc_url(home_url('/')); ?>" method="get" role="search">
                <div class="flex gap-2">
                    <input type="text"
                           name="s"
                           placeholder="Search again..."
                           class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors"
                           value="<?php echo esc_attr($search_query); ?>">
                    <button type="submit"
                            class="bg-primary hover:bg-primary/90 text-white font-semibold py-3 px-8 rounded-lg transition-colors"
                            aria-label="Search">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Search Results -->
<section class="bg-white py-16 px-6">
    <div class="mx-auto max-w-[1400px]">
        <?php if (!empty($results_by_type)): ?>
            <?php foreach ($results_by_type as $post_type => $posts): ?>
                <div class="mb-16">
                    <h2 class="text-2xl lg:text-3xl font-bold text-[#1e2938] mb-8">
                        <?php echo isset($post_type_labels[$post_type]) ? $post_type_labels[$post_type] : ucfirst($post_type) . 's'; ?>
                        <span class="text-primary">(<?php echo count($posts); ?>)</span>
                    </h2>

                    <?php if ($post_type === 'products' || $post_type === 'documents' || $post_type === 'page' || $post_type === 'videos' || $post_type === 'brochures'): ?>
                        <!-- Products, Documents, Pages, Videos, and Brochures use card grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            <?php foreach ($posts as $post):
                                setup_postdata($post);
                                if ($post_type === 'products') {
                                    get_template_part('template-parts/content', 'product-card');
                                } elseif ($post_type === 'documents') {
                                    get_template_part('template-parts/content', 'document-card');
                                } elseif ($post_type === 'page') {
                                    get_template_part('template-parts/content', 'page-card');
                                } elseif ($post_type === 'videos') {
                                    get_template_part('template-parts/content', 'video-card');
                                } elseif ($post_type === 'brochures') {
                                    get_template_part('template-parts/content', 'brochure-card');
                                }
                            endforeach;
                            wp_reset_postdata(); ?>
                        </div>
                    <?php else: ?>
                        <!-- Other post types use list view -->
                        <div class="space-y-6">
                            <?php foreach ($posts as $post):
                                setup_postdata($post);

                                $featured_image = get_the_post_thumbnail_url($post->ID, 'medium');
                                $excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 30);
                                ?>
                                <article class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100 group">
                                    <div class="flex flex-col md:flex-row">
                                        <!-- Image -->
                                        <?php if ($featured_image): ?>
                                            <a href="<?php the_permalink(); ?>" class="block md:w-1/3 flex-shrink-0">
                                                <div class="aspect-video md:aspect-square md:h-full overflow-hidden">
                                                    <img src="<?php echo esc_url($featured_image); ?>"
                                                         alt="<?php echo esc_attr(get_the_title()); ?>"
                                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                                </div>
                                            </a>
                                        <?php endif; ?>

                                        <!-- Content -->
                                        <div class="p-6 flex-1">
                                            <div class="mb-2">
                                                <span class="inline-block bg-gray-100 text-gray-800 text-xs font-semibold px-3 py-1 rounded-full">
                                                    <?php echo ucfirst($post_type); ?>
                                                </span>
                                            </div>

                                            <h3 class="text-xl lg:text-2xl font-bold text-gray-900 group-hover:text-primary transition-colors mb-3">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>

                                            <?php if ($excerpt): ?>
                                                <p class="text-gray-600 mb-4 leading-relaxed">
                                                    <?php echo esc_html($excerpt); ?>
                                                </p>
                                            <?php endif; ?>

                                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                                <span><?php echo get_the_date(); ?></span>
                                                <?php if ($post_type === 'post'): ?>
                                                    <?php
                                                    $categories = get_the_category();
                                                    if ($categories): ?>
                                                        <span>•</span>
                                                        <span><?php echo esc_html($categories[0]->name); ?></span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>

                                            <a href="<?php the_permalink(); ?>"
                                               class="inline-flex items-center text-primary font-medium mt-4 group-hover:translate-x-1 transition-transform">
                                                Read More
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach;
                            wp_reset_postdata(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- No Results -->
            <div class="text-center py-16">
                <div class="max-w-2xl mx-auto">
                    <svg class="w-24 h-24 mx-auto mb-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <h2 class="text-2xl lg:text-3xl font-bold mb-4 text-[#1e2938]">No results found</h2>
                    <p class="text-lg text-gray-600 mb-8">
                        Sorry, we couldn't find any results matching "<?php echo esc_html($search_query); ?>".
                        Please try different keywords or browse our products below.
                    </p>

                    <!-- Quick Links -->
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-12">
                        <a href="<?php echo home_url('/e-fx-built-in-fires'); ?>"
                           class="text-primary hover:text-primary/80 font-medium transition-colors">
                            E-FX Built-In Fires
                        </a>
                        <a href="<?php echo home_url('/e-fx-fireplace-suites'); ?>"
                           class="text-primary hover:text-primary/80 font-medium transition-colors">
                            E-FX Fireplace Suites
                        </a>
                        <a href="<?php echo home_url('/hearth-inset-fires'); ?>"
                           class="text-primary hover:text-primary/80 font-medium transition-colors">
                            Hearth Inset Fires
                        </a>
                        <a href="<?php echo home_url('/e-ridium-holographic-fires'); ?>"
                           class="text-primary hover:text-primary/80 font-medium transition-colors">
                            E-Ridium Holographic Fires
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
