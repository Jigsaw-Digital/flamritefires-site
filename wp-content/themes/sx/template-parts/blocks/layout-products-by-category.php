<?php
/**
 * Layout Products by Category Block Template
 */

$data = get_field('layout_products_by_category_data');

// Debug: Check if we're getting any data at all
if (current_user_can('administrator')) {
    echo '<!-- RAW DATA: ' . json_encode($data) . ' -->';
}

if (!$data) {
    if (current_user_can('administrator')) {
        echo '<!-- ERROR: No ACF data found for layout_products_by_category_data -->';
        
        // Basic test - show all products regardless of settings
        echo '<div style="background: #f0f0f0; padding: 20px; margin: 20px; border: 2px solid red;">';
        echo '<h3>DEBUG: Basic Product Test</h3>';
        
        $test_products = get_posts(array(
            'post_type' => 'products',
            'posts_per_page' => -1,
            'post_status' => 'publish'
        ));
        
        echo '<p>Found ' . count($test_products) . ' products total</p>';
        
        foreach ($test_products as $product) {
            $cats = get_the_terms($product->ID, 'product_category');
            $cat_list = $cats ? implode(', ', array_map(function($c) { return $c->name; }, $cats)) : 'No categories';
            echo '<p>- ' . $product->post_title . ' (Categories: ' . $cat_list . ')</p>';
        }
        
        $test_categories = get_terms(array('taxonomy' => 'product_category', 'hide_empty' => false));
        echo '<p>Found ' . count($test_categories) . ' categories total</p>';
        
        foreach ($test_categories as $cat) {
            echo '<p>- ' . $cat->name . ' (ID: ' . $cat->term_id . ')</p>';
        }
        
        echo '</div>';
    }
    return;
}

// Get selected category if any
$selected_category = $data['selected_category'] ?? null;
$products_limit = $data['products_limit'] ?? 12;
$display_categories = $data['display_categories'] ?? false;
$display_products = $data['display_products'] ?? false;

// Debug: Output current data for troubleshooting
if (current_user_can('administrator')) {
    echo '<!-- DEBUG INFO -->';
    echo '<!-- Display Products: ' . ($display_products ? 'true' : 'false') . ' -->';
    echo '<!-- Display Categories: ' . ($display_categories ? 'true' : 'false') . ' -->';
    echo '<!-- Selected Category: ' . ($selected_category ? $selected_category->name . ' (ID: ' . $selected_category->term_id . ')' : 'none') . ' -->';
    echo '<!-- Products Limit: ' . $products_limit . ' -->';
    echo '<!-- Manual Selection: ' . (!empty($data['products_selection']) ? 'yes (' . count($data['products_selection']) . ' products)' : 'no') . ' -->';
}

// Get products based on selection
$products = array();
if ($display_products) {
    if (!empty($data['products_selection'])) {
        // Use manually selected products
        $products = $data['products_selection'];
        if (current_user_can('administrator')) {
            echo '<!-- Using manual selection: ' . count($products) . ' products -->';
        }
    } elseif ($selected_category) {
        // Get products from selected category
        $args = array(
            'post_type' => 'products',
            'post_status' => 'publish',
            'posts_per_page' => $products_limit > 0 ? $products_limit : -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_category',
                    'field'    => 'term_id',
                    'terms'    => $selected_category->term_id,
                ),
            ),
        );
        $product_query = new WP_Query($args);
        $products = $product_query->posts;
        wp_reset_postdata();
        
        if (current_user_can('administrator')) {
            echo '<!-- Category query found: ' . count($products) . ' products -->';
            echo '<!-- Query args: ' . json_encode($args) . ' -->';
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
                <?php if ($selected_category): ?>
                    <a href="<?php echo get_term_link($selected_category); ?>" class="uppercase hover:underline">
                        <?php echo esc_html($selected_category->name); ?>
                    </a>
                    <span>|</span>
                <?php endif; ?>
                <span class="text-primary uppercase font-semibold font-montserrat">
                    <?php echo esc_html($data['title']); ?>
                </span>
            </div>
        </div>
        <div class="w-full lg:w-1/2 max-w-[700px]">
            <div class="lg:text-xl font-montserrat">
                <?php echo wp_kses_post($data['description']); ?>
            </div>
        </div>
    </div>

    <!-- Categories Grid -->
    <?php if ($display_categories && !empty($categories)): ?>
        <div class="mx-auto max-w-9xl mb-16">
            <h2 class="text-2xl font-bold text-primary mb-8 text-center">Product Categories</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-12">
                <?php foreach ($categories as $category): ?>
                    <?php 
                    $category_image = get_field('category_image', 'product_category_' . $category->term_id);
                    ?>
                    <div class="group cursor-pointer">
                        <a href="<?php echo get_term_link($category); ?>" class="block">
                            <?php if ($category_image): ?>
                                <div class="aspect-square overflow-hidden rounded-xl mb-4">
                                    <img src="<?php echo esc_url($category_image['url']); ?>" 
                                         alt="<?php echo esc_attr($category->name); ?>"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            <?php else: ?>
                                <div class="aspect-square overflow-hidden rounded-xl mb-4 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500 text-lg">No Image</span>
                                </div>
                            <?php endif; ?>
                            <h3 class="text-xl font-semibold text-primary group-hover:text-primary/80 transition-colors">
                                <?php echo esc_html($category->name); ?>
                            </h3>
                            <?php if ($category->description): ?>
                                <p class="text-sm text-gray-600 mt-2">
                                    <?php echo esc_html($category->description); ?>
                                </p>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Products Grid -->
    <?php if ($display_products): ?>
        <?php if (!empty($products)): ?>
        <div class="mx-auto max-w-9xl">
            <?php if ($display_categories && !empty($categories)): ?>
                <h2 class="text-2xl font-bold text-primary mb-8 text-center">Products</h2>
            <?php endif; ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
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
            </div>
        </div>
    <?php endif; ?>
</section>