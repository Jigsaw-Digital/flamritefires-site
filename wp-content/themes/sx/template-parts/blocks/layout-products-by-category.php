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

// Get brochures based on selection
$brochures = array();
if ($display_brochures) {
    if ($brochures_selection_type === 'manual' && !empty($data['brochures_selection'])) {
        // Use manually selected brochures
        $brochures = $data['brochures_selection'];
        if (current_user_can('administrator')) {
            echo '<!-- Using manual brochure selection: ' . count($brochures) . ' brochures -->';
        }
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
        
        if (current_user_can('administrator')) {
            echo '<!-- Brochure category query found: ' . count($brochures) . ' brochures -->';
        }
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
        
        if (current_user_can('administrator')) {
            echo '<!-- All brochures query found: ' . count($brochures) . ' brochures -->';
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
    <div class="mx-auto container max-w-8xl gap-14 lg:flex justify-between space-y-4 lg:space-y-0 mb-4 lg:mb-12">
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
                <?php if ($brochures_category_filter): ?>
                    <a href="<?php echo get_term_link($brochures_category_filter); ?>" class="uppercase hover:underline">
                        <?php echo esc_html($brochures_category_filter->name); ?>
                    </a>
                    <span>|</span>
                <?php elseif ($products_category_filter): ?>
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
        <div class="mx-auto max-w-9xl container">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <?php foreach ($products as $product): ?>
                    <?php 
                    $product_price = get_field('price', $product->ID);
                    $product_description = get_field('description', $product->ID);
                    $featured_image = get_the_post_thumbnail_url($product->ID, 'large');
                    
                    // Create excerpt from description or post content
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
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <div class="text-white text-center">
                                            <svg class="w-12 h-12 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                            <p class="text-sm font-semibold">Download PDF</p>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="aspect-[3/4] bg-gradient-to-br from-primary to-primary/80 flex items-center justify-center">
                                    <div class="text-white text-center p-4">
                                        <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                                        </svg>
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
                                    <div class="mt-3 flex items-center text-sm text-primary font-medium">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
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