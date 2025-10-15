<?php
/**
 * Reusable Product Card Template
 *
 * @param WP_Post $product The product post object
 */

if (!isset($product)) {
    return;
}

// Get product data using ACF - try multiple methods since it's a Gutenberg block
$product_data = get_field('layout_product_data', $product->ID);
$product_price = '';
$product_description = '';

// Debug: Check what we got
if (current_user_can('administrator')) {
    echo '<!-- Product ID: ' . $product->ID . ' -->';
    echo '<!-- Product Data: ' . print_r($product_data, true) . ' -->';
}

// Try to get data from the parsed blocks directly
if (has_blocks($product->post_content)) {
    $blocks = parse_blocks($product->post_content);
    foreach ($blocks as $block) {
        if ($block['blockName'] === 'acf/layout-product') {
            // Get the block ID to retrieve ACF data
            $block_id = $block['attrs']['id'] ?? null;

            if ($block_id) {
                // Try getting data with block ID
                $block_data = get_field('layout_product_data', $block_id);
                if ($block_data) {
                    $product_price = $block_data['price'] ?? '';
                    $product_description = $block_data['description_1'] ?? '';
                }
            }

            // If that didn't work, try the attrs data directly
            if (!$product_description && isset($block['attrs']['data'])) {
                $product_price = $block['attrs']['data']['price'] ?? '';
                $product_description = $block['attrs']['data']['description_1'] ?? '';
            }

            if (current_user_can('administrator')) {
                echo '<!-- Block found. Block ID: ' . $block_id . ' -->';
                echo '<!-- Block attrs: ' . print_r($block['attrs'], true) . ' -->';
                echo '<!-- Description found: ' . ($product_description ? 'YES' : 'NO') . ' -->';
            }

            break;
        }
    }
}

// Fallback to standard ACF field if blocks didn't work
if (!$product_description && $product_data) {
    $product_price = $product_data['price'] ?? '';
    $product_description = $product_data['description_1'] ?? '';
}

$featured_image = get_the_post_thumbnail_url($product->ID, 'large');

// Get excerpt from description_1 field
$excerpt = '';
if ($product_description) {
    $excerpt = wp_trim_words(strip_tags($product_description), 20, '...');
} elseif ($product->post_excerpt) {
    $excerpt = wp_trim_words($product->post_excerpt, 20, '...');
} elseif ($product->post_content) {
    $excerpt = wp_trim_words(strip_tags($product->post_content), 20, '...');
}
?>

<div class="group bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100">
    <a href="<?php echo get_permalink($product->ID); ?>" class="block">
        <?php if ($featured_image): ?>
            <div class="aspect-[4/3] overflow-hidden bg-gray-50">
                <img src="<?php echo esc_url($featured_image); ?>"
                     alt="<?php echo esc_attr($product->post_title); ?>"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>
        <?php else: ?>
            <div class="aspect-[4/3] bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                <div class="text-center text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-sm font-medium">No Image</span>
                </div>
            </div>
        <?php endif; ?>

        <div class="p-6">
            <div class="mb-3">
                <h3 class="text-xl font-bold text-gray-900 group-hover:text-primary transition-colors duration-200 leading-tight">
                    <?php echo esc_html($product->post_title); ?>
                </h3>
            </div>

            <?php if ($excerpt): ?>
                <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">
                    <?php echo esc_html($excerpt); ?>
                </p>
            <?php endif; ?>

            <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                <?php if ($product_price): ?>
                    <div class="text-right">
                        <span class="text-primary font-bold text-lg">
                            <?php echo esc_html($product_price); ?>
                        </span>
                    </div>
                <?php else: ?>
                    <div></div>
                <?php endif; ?>

                <div class="flex items-center text-primary text-sm font-medium">
                    <span class="mr-1">View Details</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </div>
        </div>
    </a>
</div>
