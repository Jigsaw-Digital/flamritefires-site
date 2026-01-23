<?php
/**
 * Reusable Product Card Template
 *
 * @param WP_Post $product The product post object
 */

if (!isset($product)) {
    return;
}

// Detect Coolright mode for this product
$is_coolright = false;
if (function_exists('get_field')) {
    $is_coolright = get_field('is_coolright_page', $product->ID);
}

// Check if product is in Fans or Portable AC Units categories
if (!$is_coolright) {
    $product_categories = get_the_terms($product->ID, 'product_category');
    if ($product_categories && !is_wp_error($product_categories)) {
        foreach ($product_categories as $category) {
            if (in_array($category->slug, ['fans', 'portable-ac-units']) ||
                in_array(strtolower($category->name), ['fans', 'portable ac units'])) {
                $is_coolright = true;
                break;
            }
        }
    }
}

// Get product data using ACF - try multiple methods since it's a Gutenberg block
$product_data = get_field('layout_product_data', $product->ID);
$product_price = '';
$product_description = '';

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

<div class="group product-card-wrapper border border-gray-100">
    <a href="<?php echo get_permalink($product->ID); ?>" class="block">
        <?php if ($featured_image): ?>
            <div class="product-card-image bg-gray-50">
                <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr($product->post_title); ?>">
            </div>
        <?php else: ?>
            <div class="aspect-card flex-center bg-gradient-to-br from-gray-100 to-gray-200">
                <div class="text-center text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-image"/></svg>
                    <span class="text-sm font-medium">No Image</span>
                </div>
            </div>
        <?php endif; ?>

        <div class="card-body">
            <div class="mb-3">
                <h3 class="<?php echo $is_coolright ? 'card-title-coolblue' : 'card-title'; ?> text-gray-900 <?php echo $is_coolright ? 'group-hover:text-coolblue' : 'group-hover:text-primary'; ?> transition-colors leading-tight"><?php echo esc_html($product->post_title); ?></h3>
            </div>

            <?php if ($excerpt): ?>
                <p class="text-meta leading-relaxed mb-4 line-clamp-3"><?php echo esc_html($excerpt); ?></p>
            <?php endif; ?>

            <div class="flex-between pt-2 border-t border-gray-100">
                <?php if ($product_price): ?>
                    <span class="<?php echo $is_coolright ? 'text-coolblue' : 'text-primary'; ?> font-bold text-lg"><?php echo esc_html($product_price); ?></span>
                <?php else: ?>
                    <div></div>
                <?php endif; ?>

                <div class="row-sm <?php echo $is_coolright ? 'text-coolblue' : 'text-primary'; ?> text-sm font-medium">
                    <span>View Details</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-arrow-right"/></svg>
                </div>
            </div>
        </div>
    </a>
</div>
