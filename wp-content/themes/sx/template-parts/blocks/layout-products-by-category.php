<?php
/**
 * Layout Products by Category Block Template
 */

$data = get_field('layout_products_by_category_data');
if (!$data) return;
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
                    <a href="/category/<?php echo esc_attr($data['sub_category']); ?>" class="uppercase hover:underline">
                        <?php echo esc_html(str_replace('-', ' ', $data['sub_category'])); ?>
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
    <?php if ($data['display_categories'] && $data['categories']): ?>
        <div class="mx-auto max-w-9xl">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-12">
                <?php foreach ($data['categories'] as $category): ?>
                    <div class="group cursor-pointer">
                        <a href="/category/<?php echo esc_attr($category['slug']); ?>" class="block">
                            <?php if ($category['image']): ?>
                                <div class="aspect-square overflow-hidden rounded-xl mb-4">
                                    <img src="<?php echo esc_url($category['image']['url']); ?>" 
                                         alt="<?php echo esc_attr($category['name']); ?>"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            <?php endif; ?>
                            <h3 class="text-xl font-semibold text-primary group-hover:text-primary/80 transition-colors">
                                <?php echo esc_html($category['name']); ?>
                            </h3>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Products Grid -->
    <?php if ($data['display_products'] && $data['products']): ?>
        <div class="mx-auto max-w-9xl">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-12">
                <?php foreach ($data['products'] as $product): ?>
                    <div class="group cursor-pointer">
                        <a href="/products/<?php echo esc_attr($product['slug']); ?>" class="block">
                            <?php if ($product['featured_image']): ?>
                                <div class="aspect-square overflow-hidden rounded-xl mb-4">
                                    <img src="<?php echo esc_url($product['featured_image']['url']); ?>" 
                                         alt="<?php echo esc_attr($product['title']); ?>"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            <?php endif; ?>
                            <h3 class="text-xl font-semibold text-primary group-hover:text-primary/80 transition-colors">
                                <?php echo esc_html($product['title']); ?>
                            </h3>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- No Products Message -->
    <?php if ((!$data['categories'] || count($data['categories']) == 0) && (!$data['products'] || count($data['products']) == 0)): ?>
        <div class="mx-auto max-w-9xl">
            <div class="grid grid-cols-1 gap-12 mt-16 text-center">
                <p class="text-primary">No products found</p>
            </div>
        </div>
    <?php endif; ?>
</section>