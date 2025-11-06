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

<div class="group bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100">
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
                <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                    <div class="text-center text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
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
        <div class="p-6">
            <div class="mb-3">
                <span class="inline-block bg-primary/10 text-primary text-xs font-semibold px-3 py-1 rounded-full mb-2">
                    Products
                </span>
                <h3 class="text-xl font-bold text-gray-900 group-hover:text-primary transition-colors duration-200 leading-tight">
                    <?php the_title(); ?>
                </h3>
            </div>

            <?php if ($excerpt): ?>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    <?php echo esc_html($excerpt); ?>
                </p>
            <?php endif; ?>

            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <?php if ($price): ?>
                    <span class="text-lg font-bold text-primary"><?php echo esc_html($price); ?></span>
                <?php else: ?>
                    <span></span>
                <?php endif; ?>
                <span class="inline-flex items-center text-primary font-medium text-sm group-hover:translate-x-1 transition-transform">
                    View Product
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </span>
            </div>
        </div>
    </a>
</div>
