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

// Get products based on selection
$products = array();
if ($display_products) {
    if ($products_selection_type === 'manual' && !empty($data['products_selection'])) {
        // Use manually selected products
        $products = $data['products_selection'];
        if (current_user_can('administrator')) {
            echo '<!-- Using manual selection: ' . count($products) . ' products -->';
        }
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
        
        // If the main query failed but we know products exist in this category, try alternative approaches
        if (count($products) == 0 && current_user_can('administrator')) {
            // Try using term slug instead of term_id
            $args_alt1 = array(
                'post_type' => 'products',
                'post_status' => 'publish',
                'posts_per_page' => $products_limit > 0 ? $products_limit : -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_category',
                        'field'    => 'slug',
                        'terms'    => $filter_category->slug,
                    ),
                ),
            );
            $alt_query1 = new WP_Query($args_alt1);
            echo '<!-- Alternative query 1 (by slug) found: ' . $alt_query1->found_posts . ' products -->';
            
            // Try using get_posts instead of WP_Query
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
            echo '<!-- Alternative query 2 (get_posts) found: ' . count($alt_products) . ' products -->';
            
            // If alternative query found products, use those
            if (count($alt_products) > 0) {
                $products = $alt_products;
                echo '<!-- Using alternative query results -->';
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
        
        if (current_user_can('administrator')) {
            echo '<!-- All products query found: ' . count($products) . ' products -->';
        }
    }
}

// Debug: Check what products exist and their categories
if (current_user_can('administrator')) {
    $all_products = get_posts(array('post_type' => 'products', 'posts_per_page' => -1));
    echo '<!-- Total products in system: ' . count($all_products) . ' -->';
    
    foreach ($all_products as $product) {
        $product_categories = get_the_terms($product->ID, 'product_category');
        $cat_names = $product_categories ? array_map(function($cat) { return $cat->name . '(' . $cat->term_id . ')'; }, $product_categories) : array('No category');
        echo '<!-- Product: ' . $product->post_title . ' | Categories: ' . implode(', ', $cat_names) . ' -->';
    }
    
    $all_categories = get_terms(array('taxonomy' => 'product_category', 'hide_empty' => false));
    echo '<!-- Total categories: ' . count($all_categories) . ' -->';
    foreach ($all_categories as $cat) {
        echo '<!-- Category: ' . $cat->name . ' (ID: ' . $cat->term_id . ') -->';
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
?>

<section class="bg-tertiary pb-16 pt-16 relative px-6 min-h-[calc(100vh-430px)]">
    <div class="mx-auto max-w-8xl gap-14 lg:flex justify-between space-y-4 lg:space-y-0 mb-4 lg:mb-12">
        <div class="w-full lg:w-1/2 space-y-4">
            <h1 class="text-3xl lg:text-4xl xl:text-5xl font-bold text-primary mb-6">
                <?php echo esc_html($data['title']); ?>
            </h1>

            <!-- Breadcrumbs -->
            <div class="space-x-2 font-montserrat">
                <a href="<?php echo home_url('/'); ?>" class="uppercase hover:underline">Home</a>
                <span>|</span>
                <?php if ($data['sub_category']): ?>
                    <a href="/product-category/<?php echo esc_attr($data['sub_category']); ?>" class="uppercase hover:underline">
                        <?php echo esc_html(str_replace('-', ' ', $data['sub_category'])); ?>
                    </a>
                    <span>|</span>
                <?php endif; ?>
                <?php if ($products_category_filter): ?>
                    <a href="<?php echo get_term_link($products_category_filter); ?>" class="uppercase hover:underline">
                        <?php echo esc_html($products_category_filter->name); ?>
                    </a>
                <?php elseif ($selected_category): ?>
                    <a href="<?php echo get_term_link($selected_category); ?>" class="uppercase hover:underline">
                        <?php echo esc_html($selected_category->name); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="w-full lg:w-1/2 max-w-[700px]">
            <div class="lg:text-xl font-montserrat">
                <?php echo wp_kses_post($data['description']); ?>
            </div>
        </div>
    </div>


    <!-- Products Grid -->
    <?php if ($display_products): ?>
        <?php if (!empty($products)): ?>
        <div class="mx-auto max-w-9xl">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <?php foreach ($products as $product): ?>
                    <?php 
                    $product_price = get_field('price', $product->ID);
                    $featured_image = get_the_post_thumbnail_url($product->ID, 'large');
                    ?>
                    <div class="group cursor-pointer bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <a href="<?php echo get_permalink($product->ID); ?>" class="block">
                            <?php if ($featured_image): ?>
                                <div class="aspect-square overflow-hidden">
                                    <img src="<?php echo esc_url($featured_image); ?>" 
                                         alt="<?php echo esc_attr($product->post_title); ?>"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            <?php else: ?>
                                <div class="aspect-square bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            <?php endif; ?>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-primary group-hover:text-primary/80 transition-colors mb-2">
                                    <?php echo esc_html($product->post_title); ?>
                                </h3>
                                <?php if ($product_price): ?>
                                    <p class="text-secondary font-bold text-lg">
                                        <?php echo esc_html($product_price); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if ($product->post_excerpt): ?>
                                    <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                                        <?php echo esc_html($product->post_excerpt); ?>
                                    </p>
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

    <!-- No Content Message -->
    <?php if (empty($categories) && empty($products)): ?>
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
                
                <?php if (current_user_can('administrator') && $selected_category): ?>
                    <div style="background: #e7f3ff; padding: 20px; margin: 20px; border: 2px solid #0073aa; border-radius: 5px; text-align: left;">
                        <h4 style="color: #0073aa; margin-bottom: 15px;">🔧 Admin Tools - Fix Category Assignment</h4>
                        
                        <?php
                        // Show all products and allow quick category assignment
                        $all_products = get_posts(array(
                            'post_type' => 'products',
                            'posts_per_page' => -1,
                            'post_status' => 'publish'
                        ));
                        
                        $all_categories = get_terms(array(
                            'taxonomy' => 'product_category',
                            'hide_empty' => false
                        ));
                        ?>
                        
                        <p><strong>Selected Category:</strong> <?php echo $selected_category->name; ?> (ID: <?php echo $selected_category->term_id; ?>)</p>
                        
                        <h5>All Products in System:</h5>
                        <ul style="list-style: disc; padding-left: 20px;">
                            <?php foreach ($all_products as $product): ?>
                                <?php
                                $product_categories = get_the_terms($product->ID, 'product_category');
                                $cat_names = array();
                                $cat_ids = array();
                                if ($product_categories) {
                                    foreach ($product_categories as $cat) {
                                        $cat_names[] = $cat->name;
                                        $cat_ids[] = $cat->term_id;
                                    }
                                }
                                $is_in_selected = in_array($selected_category->term_id, $cat_ids);
                                ?>
                                <li style="margin-bottom: 5px;">
                                    <strong><?php echo $product->post_title; ?></strong><br>
                                    Categories: <?php echo !empty($cat_names) ? implode(', ', $cat_names) : '<em>No categories assigned</em>'; ?><br>
                                    Status: <?php echo $is_in_selected ? '✅ In selected category' : '❌ NOT in selected category'; ?>
                                    <?php if (!$is_in_selected): ?>
                                        <br><small style="color: #666;">
                                            To fix: Go to <a href="<?php echo admin_url('post.php?post=' . $product->ID . '&action=edit'); ?>" target="_blank">Edit Product</a> 
                                            and assign it to "<?php echo $selected_category->name; ?>" category.
                                        </small>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <h5>All Available Categories:</h5>
                        <ul style="list-style: disc; padding-left: 20px;">
                            <?php foreach ($all_categories as $cat): ?>
                                <li>
                                    <?php echo $cat->name; ?> (ID: <?php echo $cat->term_id; ?>, Slug: <?php echo $cat->slug; ?>)
                                    <?php if ($cat->term_id == $selected_category->term_id): ?>
                                        <strong>← SELECTED</strong>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <div style="background: #fff; padding: 15px; margin-top: 15px; border-radius: 3px;">
                            <h5 style="margin-top: 0;">Quick Fix Steps:</h5>
                            <ol style="padding-left: 20px;">
                                <li>Go to <a href="<?php echo admin_url('edit.php?post_type=products'); ?>" target="_blank"><strong>Products → All Products</strong></a></li>
                                <li>Click on a product to edit it</li>
                                <li>In the right sidebar, find "Product Categories"</li>
                                <li>Check the box for "<?php echo $selected_category->name; ?>"</li>
                                <li>Click "Update" button</li>
                                <li>Refresh this page to see the product appear</li>
                            </ol>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</section>