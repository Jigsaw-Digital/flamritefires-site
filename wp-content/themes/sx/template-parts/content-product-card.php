<?php
/**
 * Product Card Partial
 * Used for displaying product posts in search results and grids
 */

$featured_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
$product_description = get_field('product_description');
$price = get_field('price');

// Get product categories
$categories = get_the_terms(get_the_ID(), 'product_category');
$category_name = '';
if ($categories && !is_wp_error($categories)) {
    $category_name = $categories[0]->name;
}

// Create excerpt
$excerpt = '';
if ($product_description) {
    $excerpt = wp_trim_words(strip_tags($product_description), 20, '...');
} elseif (has_excerpt()) {
    $excerpt = wp_trim_words(get_the_excerpt(), 20, '...');
}
?>

<div class="group product-card-wrapper border border-gray-100">
    <a href="<?php the_permalink(); ?>" class="block">
        <!-- Product Image -->
        <div class="relative">
            <?php if ($featured_image): ?>
                <div class="aspect-square overflow-hidden bg-gray-50">
                    <img src="<?php echo esc_url($featured_image); ?>"
                         alt="<?php echo esc_attr(get_the_title()); ?>"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
            <?php else: ?>
                <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 flex-center">
                    <div class="text-center text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-image"/></svg>
                        <span class="text-sm font-medium">No Image</span>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Category Badge -->
            <?php if ($category_name): ?>
                <div class="absolute top-3 left-3">
                    <span class="inline-block bg-white/90 backdrop-blur-sm text-primary text-xs font-semibold px-3 py-1 rounded-full">
                        <?php echo esc_html($category_name); ?>
                    </span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Content -->
        <div class="card-body">
            <div class="mb-3">
                <span class="inline-block bg-primary/10 text-primary text-xs font-semibold px-3 py-1 rounded-full mb-2">
                    Products
                </span>
                <h3 class="card-title text-gray-900 group-hover:text-primary transition-colors leading-tight">
                    <?php the_title(); ?>
                </h3>
            </div>

            <?php if ($excerpt): ?>
                <p class="text-meta leading-relaxed mb-4"><?php echo esc_html($excerpt); ?></p>
            <?php endif; ?>

            <div class="flex-between pt-4 border-t border-gray-100">
                <?php if ($price): ?>
                    <span class="text-lg font-bold text-primary"><?php echo esc_html($price); ?></span>
                <?php else: ?>
                    <span></span>
                <?php endif; ?>
                <span class="row-sm text-primary font-medium text-sm group-hover:translate-x-1 transition-transform">
                    View Product
                    <svg class="w-4 h-4" fill="none" stroke="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-arrow-right"/></svg>
                </span>
            </div>
        </div>
    </a>
</div>
