<?php
/**
 * Layout Product Block Template
 */

$data = get_field('layout_product_data');
if (!$data) return;

global $post;
$title = get_the_title();
?>

<div class="bg-tertiary py-8 lg:py-16 px-6 relative">
    <div class="lg:flex justify-center items-start w-full gap-12 mx-auto relative max-w-7xl">
        <div class="relative w-full lg:w-2/5 max-w-[600px]">
            <?php if ($data['image_slider']): ?>
                <!-- Main Image Slider -->
                <div class="swiper-container product-slider overflow-hidden rounded-[35px] relative" id="productSlider">
                    <div class="swiper-wrapper">
                        <?php foreach ($data['image_slider'] as $slide): ?>
                            <div class="swiper-slide">
                                <div class="aspect-[4/3] w-full overflow-hidden">
                                    <img src="<?php echo esc_url($slide['url']); ?>"
                                         alt="<?php echo esc_attr($title); ?>"
                                         class="w-full h-full object-contain bg-gray-100">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Navigation Arrows -->
                    <div class="flex gap-3 justify-center mt-4 lg:hidden">
                        <div class="bg-[#1e2938] p-3 rounded-full group cursor-pointer" id="productPrev">
                            <svg class="text-primary w-6 h-6 group-hover:scale-125" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8"/>
                            </svg>
                        </div>
                        <div class="bg-[#1e2938] p-3 rounded-full group cursor-pointer" id="productNext">
                            <svg class="text-primary w-6 h-6 group-hover:scale-125" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Thumbnail Slider -->
                <div class="mt-3">
                    <div class="swiper-container thumbs-slider" id="thumbsSlider">
                        <div class="swiper-wrapper">
                            <?php foreach ($data['image_slider'] as $index => $slide): ?>
                                <div class="swiper-slide cursor-pointer">
                                    <div class="aspect-square rounded-lg overflow-hidden border-2 border-gray-300 hover:border-primary transition-colors duration-200">
                                        <img src="<?php echo esc_url($slide['url']); ?>"
                                             alt="<?php echo esc_attr($title); ?> thumbnail <?php echo $index + 1; ?>"
                                             class="w-full h-full object-cover">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Navigation Arrows (Desktop) -->
                    <div class="hidden lg:flex gap-3 justify-center mt-4">
                        <div class="bg-[#1e2938] p-3 rounded-full group cursor-pointer" id="productPrevDesktop">
                            <svg class="text-primary w-8 h-8 group-hover:scale-125 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8"/>
                            </svg>
                        </div>
                        <div class="bg-[#1e2938] p-3 rounded-full group cursor-pointer" id="productNextDesktop">
                            <svg class="text-primary w-8 h-8 group-hover:scale-125 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8"/>
                            </svg>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="lg:flex gap-24 justify-center px-6">
            <div class="lg:flex flex-col  gap-4 h-full justify-start lg:min-h-[350px]">
                <div class="lg:text-lg max-w-[100%] lg:max-w-[440px] content mt-8 lg:mt-0">
                         <h1 class="grey-qo-regular  text-primary hidden lg:block text-3xl mb-2">
            <div class="jd-content">
                <?php echo esc_html(str_replace('- Greycaine', '', $title)); ?>
            </div>

            <style>
                .jd-content ul {
                    list-style: disk!important;

                }
            </style>


        </h1>
                   <div class="jd-content"> <?php echo str_replace('<li></li>', '', wp_kses_post($data['description_1'])); ?></div>
                </div>
                <?php if ($data['video']): ?>
                    <button class="border-primary hover:bg-primary text-primary hover:text-white inline-block mt-8 justify-center items-center border-2 px-6 py-2 text-sm font-semibold xl:text-lg cursor-pointer"
                            id="watchVideoBtn" data-video="<?php echo esc_url($data['video']['url']); ?>">
                        Watch Video
                    </button>
                <?php endif; ?>
                 <div class="lg:text-lg max-w-[440px] content mt-8 lg:mt-0">
                    <?php echo wp_kses_post($data['description_2']); ?>
                </div>
                <div class="mb-2">
                    <a href="tel:01543251122" class="bg-white text-primary border-2 border-primary hover:bg-primary hover:text-white inline-block px-6 py-3 font-semibold transition duration-300 lg:text-md">
                        Call Our Showroom
                    </a>
                </div>
                <div>
                    <a href="/contact-us/" class="bg-primary text-white hover:bg-primary/90 inline-block px-6 py-3 font-semibold transition duration-300 lg:text-md">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!-- Video Modal -->
    <div id="videoModal" class="fixed inset-0 z-50 bg-black bg-opacity-75 flex items-center justify-center p-4 hidden">
        <div class="relative w-full max-w-4xl">
            <button id="closeVideoModal" class="absolute -top-10 right-0 text-white flex items-center gap-2 bg-transparent bg-opacity-50 px-3 py-1 rounded-md">
                <span class="text-lg">Close</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <video id="modalVideo" controls class="w-full h-auto">
                <source src="" type="video/mp4">
            </video>
        </div>
    </div>
                </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Thumbnail slider
    const thumbsSlider = new Swiper('#thumbsSlider', {
        spaceBetween: 8,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
        breakpoints: {
            0: {
                slidesPerView: 3,
                spaceBetween: 6,
            },
            640: {
                slidesPerView: 4,
                spaceBetween: 8,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 10,
            },
        },
    });

    // Main product slider
    const productSlider = new Swiper('#productSlider', {
        slidesPerView: 1,
        spaceBetween: 0,
        thumbs: {
            swiper: thumbsSlider,
        },
    });

    // Navigation button handlers
    const mobileNext = document.getElementById('productNext');
    const mobilePrev = document.getElementById('productPrev');
    const desktopNext = document.getElementById('productNextDesktop');
    const desktopPrev = document.getElementById('productPrevDesktop');

    if (mobileNext) {
        mobileNext.addEventListener('click', () => productSlider.slideNext());
    }
    if (mobilePrev) {
        mobilePrev.addEventListener('click', () => productSlider.slidePrev());
    }
    if (desktopNext) {
        desktopNext.addEventListener('click', () => productSlider.slideNext());
    }
    if (desktopPrev) {
        desktopPrev.addEventListener('click', () => productSlider.slidePrev());
    }

    // Video modal functionality
    const watchVideoBtn = document.getElementById('watchVideoBtn');
    const videoModal = document.getElementById('videoModal');
    const modalVideo = document.getElementById('modalVideo');
    const closeVideoModal = document.getElementById('closeVideoModal');

    if (watchVideoBtn) {
        watchVideoBtn.addEventListener('click', function() {
            const videoUrl = this.getAttribute('data-video');
            modalVideo.querySelector('source').src = videoUrl;
            modalVideo.load();
            videoModal.classList.remove('hidden');
        });
    }

    if (closeVideoModal) {
        closeVideoModal.addEventListener('click', function() {
            videoModal.classList.add('hidden');
            modalVideo.pause();
        });
    }

    // Close modal when clicking outside
    videoModal?.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
            modalVideo.pause();
        }
    });
});
</script>

<style>
    /* Active thumbnail styling */
    #thumbsSlider .swiper-slide-thumb-active div {
        border-color: #c1a068 !important;
        box-shadow: 0 0 0 1px #c1a068;
    }

    /* Ensure proper spacing and layout */
    .thumbs-slider {
        padding: 0;
    }
</style>

<?php
// Get related products from the same category
$current_product_id = get_the_ID();
$product_categories = get_the_terms($current_product_id, 'product_category');
$related_products = array();

if ($product_categories && !is_wp_error($product_categories)) {
    // Get the first category
    $category = $product_categories[0];

    // Query for other products in the same category
    $args = array(
        'post_type' => 'products',
        'post_status' => 'publish',
        'posts_per_page' => 6,
        'post__not_in' => array($current_product_id), // Exclude current product
        'tax_query' => array(
            array(
                'taxonomy' => 'product_category',
                'field'    => 'term_id',
                'terms'    => $category->term_id,
            ),
        ),
    );

    $related_query = new WP_Query($args);
    $related_products = $related_query->posts;
    wp_reset_postdata();
}
?>

<?php if (!empty($related_products)): ?>
<section class="bg-[#1e2938] py-16 px-6">
    <div class="mx-auto container max-w-9xl">
        <h2 class="text-3xl lg:text-4xl font-bold text-primary mb-8">
            Other Products in <?php echo esc_html($category->name); ?>
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <?php foreach ($related_products as $product): ?>
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
</section>
<?php endif; ?>