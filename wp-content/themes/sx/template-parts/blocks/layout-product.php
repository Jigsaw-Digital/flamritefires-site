<?php
/**
 * Layout Product Block Template
 */

$data = get_field('layout_product_data');
if (!$data) return;

global $post;
$title = get_the_title();

// Detect Coolright mode
$is_coolright = false;
if (function_exists('get_field')) {
    $is_coolright = get_field('is_coolright_page');
}

// Check if current product is in Fans or Portable AC Units categories
if (!$is_coolright && is_singular('products')) {
    $product_categories = get_the_terms(get_the_ID(), 'product_category');
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
?>

<div class="section-light section relative">
    <div class="lg:flex justify-center items-start w-full gap-12 container-content relative">
        <div class="relative w-full lg:w-2/5 max-w-[600px] lg:sticky lg:top-32 lg:self-start">
            <?php if ($data['image_slider']): ?>
                <div class="swiper-container product-slider overflow-hidden relative" id="productSlider">
                    <div class="swiper-wrapper">
                        <?php foreach ($data['image_slider'] as $slide): ?>
                            <div class="swiper-slide">
                                <div class="aspect-card overflow-hidden">
                                    <img src="<?php echo esc_url($slide['url']); ?>" alt="<?php echo esc_attr($title); ?>" class="img-cover">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button id="fullscreenBtn" class="icon-btn absolute top-4 right-4 bg-white/90 hover:bg-white shadow-lg z-10" aria-label="Open image in fullscreen">
                        <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-expand"/></svg>
                    </button>
                </div>

                <div class="mt-3 max-w-full">
                    <div class="swiper-container thumbs-slider max-w-full" id="thumbsSlider">
                        <div class="swiper-wrapper max-w-full">
                            <?php foreach ($data['image_slider'] as $index => $slide): ?>
                                <div class="swiper-slide cursor-pointer">
                                    <div class="aspect-square rounded-lg overflow-hidden border-2 border-gray-300 hover:border-primary transition-base">
                                        <img src="<?php echo esc_url($slide['url']); ?>" alt="<?php echo esc_attr($title); ?> thumbnail <?php echo $index + 1; ?>" class="img-cover">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="lg:flex gap-24 justify-center px-4 lg:px-6">
            <div class="stack h-full justify-start lg:min-h-[350px]">
                <div class="lg:text-lg max-w-full lg:max-w-[440px] content mt-8 lg:mt-0">
                    <h1 class="grey-qo-regular text-primary hidden lg:block text-3xl mb-2">
                        <div class="jd-content"><?php echo esc_html(str_replace('- Greycaine', '', $title)); ?></div>
                    </h1>
                    <div class="jd-content"><?php echo str_replace('<li></li>', '', wp_kses_post($data['description_1'])); ?></div>
                </div>

                <?php if ($data['video']): ?>
                    <button class="btn-outline mt-8 inline-block text-sm xl:text-lg" id="watchVideoBtn" data-video="<?php echo esc_url($data['video']['url']); ?>" aria-label="Watch product video">Watch Video</button>
                <?php endif; ?>

                <div class="lg:text-lg max-w-[440px] content mt-8 lg:mt-0"><?php echo wp_kses_post($data['description_2']); ?></div>

                <div class="stack-sm mt-6 max-w-[210px]">
                    <button id="whereToBuyBtn" class="<?php echo $is_coolright ? 'btn-cta-coolblue' : 'btn-cta'; ?> btn-icon w-full" aria-label="Find local supplier">
                        <img src="/icons/where_to_buy.svg" alt="" class="w-6 h-6" aria-hidden="true" loading="lazy">
                        <span class="text-label">WHERE TO BUY</span>
                    </button>
                    <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="<?php echo $is_coolright ? 'btn-cta-dark-coolblue' : 'btn-cta-dark'; ?> btn-icon w-full" aria-label="Contact us">
                        <img src="/icons/contact_us.svg" alt="" class="w-6 h-6" aria-hidden="true" loading="lazy">
                        <span class="text-label">CONTACT US</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php if ($data['video']): ?>
    <!-- Video Modal -->
    <div id="videoModal" class="modal-overlay p-4 hidden" role="dialog" aria-modal="true" aria-labelledby="videoModalTitle">
        <div class="relative w-full max-w-4xl">
            <h2 id="videoModalTitle" class="sr-only">Product Video</h2>
            <button id="closeVideoModal" class="absolute -top-10 right-0 text-white row-sm px-3 py-1 rounded-md" aria-label="Close video modal">
                <span class="text-lg">Close</span>
                <svg class="h-6 w-6" fill="none" stroke="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-close"/></svg>
            </button>
            <video id="modalVideo" controls class="w-full h-auto"><source src="" type="video/mp4"></video>
        </div>
    </div>
    <?php endif; ?>

    <!-- Fullscreen Image Lightbox - images populated via JS from main slider -->
    <div id="imageLightbox" class="fixed inset-0 z-[9999] bg-black hidden" role="dialog" aria-modal="true" aria-label="Image gallery fullscreen view">
        <button id="closeLightbox" class="icon-btn absolute top-4 right-4 text-white bg-black/50 hover:bg-black/70 z-20" aria-label="Close fullscreen view">
            <svg class="h-6 w-6" fill="none" stroke="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-close"/></svg>
        </button>
        <div class="w-full h-full flex-center p-4">
            <div class="swiper-container lightbox-slider w-full h-full max-w-7xl" id="lightboxSlider">
                <div class="swiper-wrapper"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>

    <!-- Where to Buy Modal moved to footer.php for site-wide availability -->
</div>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/product.min.js?v=1.0.0"></script>

<?php
// Related products section
$current_product_id = get_the_ID();
$product_categories = get_the_terms($current_product_id, 'product_category');
$related_products = array();

if ($product_categories && !is_wp_error($product_categories)) {
    $category = $product_categories[0];
    $args = array(
        'post_type' => 'products',
        'post_status' => 'publish',
        'posts_per_page' => 6,
        'post__not_in' => array($current_product_id),
        'tax_query' => array(
            array(
                'taxonomy' => 'product_category',
                'field' => 'term_id',
                'terms' => $category->term_id,
            ),
        ),
    );
    $related_query = new WP_Query($args);
    $related_products = $related_query->posts;
    wp_reset_postdata();
}

if (!empty($related_products)): ?>
<section class="section section-dark">
    <div class="container-wide">
        <h2 class="<?php echo $is_coolright ? 'heading-section-coolblue-accent' : 'heading-section'; ?>">Other Products in <?php echo esc_html($category->name); ?></h2>
        <div class="grid-3">
            <?php foreach ($related_products as $product): ?>
                <?php include(get_template_directory() . '/template-parts/partials/product-card.php'); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
