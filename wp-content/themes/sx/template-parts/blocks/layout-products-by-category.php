<?php
/**
 * Layout Products by Category Block Template
 */

$data = get_field('layout_products_by_category_data');


// Get selected category if any
$selected_category = $data['selected_category'] ?? null;
$products_limit = $data['products_limit'] ?? 12;
$display_categories = $data['display_categories'] ?? false;
$display_products = $data['display_products'] ?? false;
$products_selection_type = $data['products_selection_type'] ?? 'by_category';
$products_category_filter = $data['products_category_filter'] ?? null;

// Brochure variables
$display_brochures = $data['display_brochures'] ?? false;
$brochures_selection_type = $data['brochures_selection_type'] ?? 'by_category';
$brochures_category_filter = $data['brochures_category_filter'] ?? null;
$brochures_limit = $data['brochures_limit'] ?? 12;

// Get products based on selection
$products = array();
if ($display_products) {
    if ($products_selection_type === 'manual' && !empty($data['products_selection'])) {
        // Use manually selected products
        $products = $data['products_selection'];
    } elseif ($products_selection_type === 'by_category' && $products_category_filter) {
        // Use products from selected category filter
        $filter_category = $products_category_filter;
        // Get products from selected category
        $args = array(
            'post_type' => 'products',
            'post_status' => 'publish',
            'posts_per_page' => $products_limit > 0 ? $products_limit : -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_category',
                    'field'    => 'term_id',
                    'terms'    => $filter_category->term_id,
                ),
            ),
        );
        $product_query = new WP_Query($args);
        $products = $product_query->posts;
        
        wp_reset_postdata();
        
        // Fallback: try alternative query if main query returned no results
        if (count($products) == 0) {
            $alt_products = get_posts(array(
                'post_type' => 'products',
                'posts_per_page' => $products_limit > 0 ? $products_limit : -1,
                'post_status' => 'publish',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_category',
                        'field'    => 'term_id',
                        'terms'    => $filter_category->term_id,
                    ),
                ),
            ));
            if (count($alt_products) > 0) {
                $products = $alt_products;
            }
            wp_reset_postdata();
        }
    } else {
        // Get all products if no category selected
        $args = array(
            'post_type' => 'products',
            'post_status' => 'publish',
            'posts_per_page' => $products_limit > 0 ? $products_limit : -1,
        );
        $product_query = new WP_Query($args);
        $products = $product_query->posts;
        wp_reset_postdata();
    }
}

// Get brochures based on selection
$brochures = array();
if ($display_brochures) {
    if ($brochures_selection_type === 'manual' && !empty($data['brochures_selection'])) {
        // Use manually selected brochures
        $brochures = $data['brochures_selection'];
    } elseif ($brochures_selection_type === 'by_category' && $brochures_category_filter) {
        // Use brochures from selected category filter
        $filter_category = $brochures_category_filter;
        // Get brochures from selected category
        $args = array(
            'post_type' => 'brochures',
            'post_status' => 'publish',
            'posts_per_page' => $brochures_limit > 0 ? $brochures_limit : -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'brochure_category',
                    'field'    => 'term_id',
                    'terms'    => $filter_category->term_id,
                ),
            ),
        );
        $brochure_query = new WP_Query($args);
        $brochures = $brochure_query->posts;
        wp_reset_postdata();
    } else {
        // Get all brochures if no category selected
        $args = array(
            'post_type' => 'brochures',
            'post_status' => 'publish',
            'posts_per_page' => $brochures_limit > 0 ? $brochures_limit : -1,
        );
        $brochure_query = new WP_Query($args);
        $brochures = $brochure_query->posts;
        wp_reset_postdata();
    }
}

// Get child categories if displaying categories
$categories = array();
if ($display_categories && $selected_category) {
    $categories = get_terms(array(
        'taxonomy' => 'product_category',
        'parent' => $selected_category->term_id,
        'hide_empty' => false,
    ));
} elseif ($display_categories && !$selected_category) {
    // Show top-level categories
    $categories = get_terms(array(
        'taxonomy' => 'product_category',
        'parent' => 0,
        'hide_empty' => false,
    ));
}

// Get title and description
$title = $data['title'] ?? '';
$description = $data['description'] ?? '';
?>

<?php if ($title || $description): ?>
<section class="bg-tertiary pb-8 pt-16 relative px-6">
    <div class="mx-auto max-w-9xl container">
        <?php if ($title): ?>
            <h1 class="text-3xl lg:text-4xl font-bold text-primary mb-4">
                <?php echo esc_html($title); ?>
            </h1>
        <?php endif; ?>

        <?php if ($description): ?>
            <div class="text-gray-600 lg:text-lg">
                <?php echo wp_kses_post($description); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<section class="bg-tertiary pb-16 <?php echo ($title || $description) ? 'pt-8' : 'pt-16'; ?> relative px-6 min-h-[calc(100vh-430px)]">
    <!-- Products Grid -->
    <?php if ($display_products): ?>
        <?php if (!empty($products)): ?>
        <div class="mx-auto max-w-9xl container">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                <?php foreach ($products as $product): ?>
                    <?php include(get_template_directory() . '/template-parts/partials/product-card.php'); ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php else: ?>
            <div class="mx-auto max-w-9xl">
                <div class="text-center py-16">
                    <h3 class="text-xl font-semibold text-primary mb-4">No Products Found</h3>
                    <p class="text-gray-600">
                        <?php if ($selected_category): ?>
                            No products found in "<?php echo esc_html($selected_category->name); ?>".
                        <?php else: ?>
                            No products available to display.
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Brochures Grid -->
    <?php if ($display_brochures): ?>
        <?php if (!empty($brochures)): ?>
        <div class="mx-auto max-w-9xl container <?php echo ($display_products && !empty($products)) ? 'mt-16' : ''; ?>">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <?php foreach ($brochures as $brochure): ?>
                    <?php 
                    $brochure_file = get_field('brochure_file', $brochure->ID);
                    $brochure_description = get_field('brochure_description', $brochure->ID);
                    $featured_image = get_the_post_thumbnail_url($brochure->ID, 'large');
                    ?>
                    <div class="group cursor-pointer bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <?php if ($brochure_file): ?>
                            <a href="<?php echo esc_url($brochure_file['url']); ?>" target="_blank" class="block">
                        <?php else: ?>
                            <a href="<?php echo get_permalink($brochure->ID); ?>" class="block">
                        <?php endif; ?>
                            <?php if ($featured_image): ?>
                                <div class="aspect-[1/1] overflow-hidden relative">
                                    <img src="<?php echo esc_url($featured_image); ?>" 
                                         alt="<?php echo esc_attr($brochure->post_title); ?>"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    <!-- PDF Download Overlay -->
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex-center">
                                        <div class="text-white text-center">
                                            <svg class="w-12 h-12 mx-auto mb-2" fill="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-download"/></svg>
                                            <p class="text-sm font-semibold">Download PDF</p>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="aspect-[3/4] bg-gradient-to-br from-primary to-primary/80 flex-center">
                                    <div class="text-white text-center p-4">
                                        <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-document"/></svg>
                                        <p class="text-sm font-semibold">PDF Brochure</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-primary group-hover:text-primary/80 transition-colors mb-2">
                                    <?php echo esc_html($brochure->post_title); ?>
                                </h3>
                                <?php if ($brochure_description): ?>
                                    <p class="text-sm text-gray-600 mt-2 line-clamp-3">
                                        <?php echo esc_html($brochure_description); ?>
                                    </p>
                                <?php elseif ($brochure->post_excerpt): ?>
                                    <p class="text-sm text-gray-600 mt-2 line-clamp-3">
                                        <?php echo esc_html($brochure->post_excerpt); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if ($brochure_file): ?>
                                    <div class="mt-3 row-sm text-sm text-primary font-medium">
                                        <svg class="w-4 h-4" fill="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-download"/></svg>
                                        Download PDF
                                    </div>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php else: ?>
            <div class="mx-auto max-w-9xl">
                <div class="text-center py-16">
                    <h3 class="text-xl font-semibold text-primary mb-4">No Brochures Found</h3>
                    <p class="text-gray-600">
                        <?php if ($brochures_category_filter): ?>
                            No brochures found in "<?php echo esc_html($brochures_category_filter->name); ?>".
                        <?php else: ?>
                            No brochures available to display.
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- No Content Message -->
    <?php if (empty($categories) && empty($products) && empty($brochures)): ?>
        <div class="mx-auto max-w-9xl">
            <div class="text-center py-16">
                <h3 class="text-xl font-semibold text-primary mb-4">No Content Found</h3>
                <p class="text-gray-600">
                    <?php if ($selected_category): ?>
                        No products or categories found in "<?php echo esc_html($selected_category->name); ?>".
                    <?php else: ?>
                        Please configure the block to display categories or products.
                    <?php endif; ?>
                </p>
            </div>
        </div>
    <?php endif; ?>
</section>