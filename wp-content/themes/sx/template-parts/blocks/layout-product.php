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
        <div class="relative w-full lg:w-2/5 max-w-[600px] lg:sticky lg:top-32 lg:self-start">
            <?php if ($data['image_slider']): ?>
                <!-- Main Image Slider -->
                <div class="swiper-container product-slider overflow-hidden rounded-[35px] relative" id="productSlider">
                    <div class="swiper-wrapper">
                        <?php foreach ($data['image_slider'] as $slide): ?>
                            <div class="swiper-slide">
                                <div class="aspect-[4/3] w-full overflow-hidden">
                                    <img src="<?php echo esc_url($slide['url']); ?>"
                                         alt="<?php echo esc_attr($title); ?>"
                                         class="w-full h-full object-cover">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Fullscreen Button -->
                    <button id="fullscreenBtn" class="absolute top-4 right-4 bg-white/90 hover:bg-white p-3 rounded-full shadow-lg transition-all duration-200 z-10">
                        <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                        </svg>
                    </button>

                    <!-- Navigation Arrows -->
                    <!-- <div class="flex gap-3 justify-center mt-4 lg:hidden">
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
                    </div> -->
                </div>

                <!-- Thumbnail Slider -->
                <div class="mt-3 max-w-full">
                    <div class="swiper-container thumbs-slider max-w-full" id="thumbsSlider">
                        <div class="swiper-wrapper max-w-full">
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
                    <!-- <div class="hidden lg:flex gap-3 justify-center mt-4">
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
                    </div> -->
                </div>
            <?php endif; ?>
        </div>
        <div class="lg:flex gap-24 justify-center px-4 lg:px-6">
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
                <div class="flex flex-col gap-3 mt-6 max-w-[210px]">
                    <button id="whereToBuyBtn" class="bg-primary text-white hover:bg-primary/90 flex items-center gap-3 px-6 py-3 font-semibold transition duration-300 cursor-pointer w-full">
                        <img src="/icons/where_to_buy.svg" alt="Where to Buy" class="w-6 h-6">
                        <span class="text-sm uppercase tracking-wider">WHERE TO BUY</span>
                    </button>
                    <a href="/contact-us/" class="bg-[#1e2938] text-white hover:bg-[#1e2938]/90 flex items-center gap-3 px-6 py-3 font-semibold transition duration-300 w-full">
                        <img src="/icons/contact_us.svg" alt="Contact Us" class="w-6 h-6">
                        <span class="text-sm uppercase tracking-wider">CONTACT US</span>
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

    <!-- Fullscreen Image Lightbox -->
    <div id="imageLightbox" class="fixed inset-0 z-[9999] bg-black flex items-center justify-center hidden">
        <button id="closeLightbox" class="absolute top-4 right-4 text-white bg-black/50 hover:bg-black/70 p-3 rounded-full transition-all duration-200 z-20">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- Lightbox Slider -->
        <div class="w-full h-full flex items-center justify-center p-4">
            <div class="swiper-container lightbox-slider w-full h-full max-w-7xl" id="lightboxSlider">
                <div class="swiper-wrapper">
                    <?php foreach ($data['image_slider'] as $slide): ?>
                        <div class="swiper-slide flex items-center justify-center">
                            <img src="<?php echo esc_url($slide['url']); ?>"
                                 alt="<?php echo esc_attr($title); ?>"
                                 class="max-h-[90vh] max-w-full object-contain">
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>

    <!-- Where to Buy Modal/Slide-out -->
    <div id="whereToBuyModal" class="fixed inset-0 z-[9999] hidden">
        <!-- Overlay -->
        <div id="whereToBuyOverlay" class="absolute inset-0  transition-opacity" style="background: rgba(0,0,0,0.3)"></div>

        <!-- Modal Content - Full screen on mobile, slide-out on desktop -->
        <div id="whereToBuyContent" class="absolute bg-white transition-transform duration-300 ease-in-out
                                           inset-0 lg:inset-y-0 lg:right-0 lg:left-auto lg:w-[600px] lg:max-w-[90vw]
                                           overflow-y-auto transform translate-x-full">
            <!-- Header -->
            <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center z-10">
                <h2 class="text-2xl font-bold text-primary">Where to Buy</h2>
                <button id="closeWhereToBuy" class="text-gray-500 hover:text-primary hover:bg-gray-100 rounded-full p-2 transition-all duration-200">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Iframe Content -->
            <div class="">
                <iframe
                    src="https://api.leadconnectorhq.com/widget/form/ADxQOaLUD4qr1znHzjkr"
                    style="width:100%;height:1292px;border:none;border-radius:3px"
                    id="inline-ADxQOaLUD4qr1znHzjkr"
                    data-layout="{'id':'INLINE'}"
                    data-trigger-type="alwaysShow"
                    data-trigger-value=""
                    data-activation-type="alwaysActivated"
                    data-activation-value=""
                    data-deactivation-type="neverDeactivate"
                    data-deactivation-value=""
                    data-form-name="Voucher Promo"
                    data-height="1292"
                    data-layout-iframe-id="inline-ADxQOaLUD4qr1znHzjkr"
                    data-form-id="ADxQOaLUD4qr1znHzjkr"
                    title="Voucher Promo">
                </iframe>
            </div>
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

    // Lightbox slider
    const lightboxSlider = new Swiper('#lightboxSlider', {
        slidesPerView: 1,
        spaceBetween: 0,
        navigation: {
            nextEl: '#lightboxSlider .swiper-button-next',
            prevEl: '#lightboxSlider .swiper-button-prev',
        },
    });

    // Fullscreen lightbox functionality
    const fullscreenBtn = document.getElementById('fullscreenBtn');
    const imageLightbox = document.getElementById('imageLightbox');
    const closeLightbox = document.getElementById('closeLightbox');

    if (fullscreenBtn) {
        fullscreenBtn.addEventListener('click', function() {
            imageLightbox.classList.remove('hidden');
            // Sync lightbox to current slide
            lightboxSlider.slideTo(productSlider.activeIndex);
            document.body.style.overflow = 'hidden';
        });
    }

    if (closeLightbox) {
        closeLightbox.addEventListener('click', function() {
            imageLightbox.classList.add('hidden');
            document.body.style.overflow = '';
        });
    }

    // Close lightbox when clicking background
    imageLightbox?.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
            document.body.style.overflow = '';
        }
    });

    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !imageLightbox.classList.contains('hidden')) {
            imageLightbox.classList.add('hidden');
            document.body.style.overflow = '';
        }
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

    // Where to Buy modal functionality
    const whereToBuyBtn = document.getElementById('whereToBuyBtn');
    const whereToBuyBtn2 = document.getElementById('whereToBuyBtn2');
    const whereToBuyBtn3 = document.getElementById('whereToBuyBtn3');
    const whereToBuyModal = document.getElementById('whereToBuyModal');
    const whereToBuyContent = document.getElementById('whereToBuyContent');
    const whereToBuyOverlay = document.getElementById('whereToBuyOverlay');
    const closeWhereToBuy = document.getElementById('closeWhereToBuy');

    function openWhereToBuy() {
        whereToBuyModal.classList.remove('hidden');
        // Small delay to allow the display change to take effect before animation
        setTimeout(() => {
            whereToBuyContent.classList.remove('translate-x-full');
            whereToBuyContent.classList.add('translate-x-0');
        }, 10);
        document.body.style.overflow = 'hidden';
    }

    function closeWhereToBuyModal() {
        whereToBuyContent.classList.add('translate-x-full');
        whereToBuyContent.classList.remove('translate-x-0');
        setTimeout(() => {
            whereToBuyModal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    }

    if (whereToBuyBtn) {
        whereToBuyBtn.addEventListener('click', openWhereToBuy);
    }


    if (whereToBuyBtn2) {
        whereToBuyBtn2.addEventListener('click', openWhereToBuy);
    }

    if (whereToBuyBtn3) {
        whereToBuyBtn3.addEventListener('click', openWhereToBuy);
    }

    if (closeWhereToBuy) {
        closeWhereToBuy.addEventListener('click', closeWhereToBuyModal);
    }

    // Close when clicking overlay
    if (whereToBuyOverlay) {
        whereToBuyOverlay.addEventListener('click', closeWhereToBuyModal);
    }

    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !whereToBuyModal.classList.contains('hidden')) {
            closeWhereToBuyModal();
        }
    });
});
</script>

<!-- Load form embed script -->
<script src="https://link.msgsndr.com/js/form_embed.js"></script>

<style>
    /* Active thumbnail styling */
    #thumbsSlider .swiper-slide-thumb-active div {
        border-color: #e85319 !important;
        box-shadow: 0 0 0 2px #e85319;
    }

    /* Ensure proper spacing and layout */
    .thumbs-slider {
        padding: 0;
        max-width: 100%;
    }

    /* Constrain thumbnail slider to match main image width */
    #thumbsSlider {
        max-width: 100%;
        overflow: hidden;
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
                <?php include(get_template_directory() . '/template-parts/partials/product-card.php'); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>