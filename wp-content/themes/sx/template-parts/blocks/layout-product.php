<?php
/**
 * Layout Product Block Template
 */

$data = get_field('layout_product_data');
if (!$data) return;

global $post;
$title = get_the_title();
?>

<section class="bg-tertiary pt-16 lg:pt-32 px-6 relative">
    <div class="lg:flex justify-center items-center max-w-9xl mx-auto relative">
        <h1 class="grey-qo-regular absolute right-32 !text-[280px] -top-16 text-primary/10 hidden lg:block">
            <?php echo esc_html(str_replace('- Greycaine', '', $title)); ?>
        </h1>
        <div class="relative w-full lg:w-2/5">
            <?php if ($data['image_slider']): ?>
                <div class="swiper-container product-slider" id="productSlider">
                    <div class="swiper-wrapper">
                        <?php foreach ($data['image_slider'] as $slide): ?>
                            <div class="swiper-slide">
                                <div class="hover:scale-110 transition-transform duration-500 ease-in-out min-h-[380px] lg:min-h-[850px]"
                                     style="background-image: url(<?php echo esc_url($slide['url']); ?>); background-position: center; background-size: cover;">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="flex gap-4 lg:gap-6 mt-6 lg:mt-8 justify-end absolute bottom-4 right-4 z-10">
                    <div class="bg-[#c1b2a8] p-1 lg:p-3 rounded-full group cursor-pointer" id="productPrev">
                        <svg class="text-primary text-2xl w-[40px] lg:w-[50px] group-hover:scale-125" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8"/>
                        </svg>
                    </div>
                    <div class="bg-[#c1b2a8] p-1 lg:p-3 rounded-full group cursor-pointer" id="productNext">
                        <svg class="text-primary text-2xl w-[40px] lg:w-[50px] group-hover:scale-125" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8"/>
                        </svg>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="lg:flex gap-24 justify-center max-w-7xl lg:w-3/5 px-6">
            <div class="lg:flex flex-col h-full justify-start lg:min-h-[350px]">
                <div class="lg:text-lg max-w-[100%] lg:max-w-[440px] content mt-8 lg:mt-0">
                    <?php echo wp_kses_post($data['description_1']); ?>
                </div>
                <?php if ($data['video']): ?>
                    <button class="border-primary hover:bg-primary text-primary hover:text-white inline-block mt-8 justify-center items-center border-2 px-6 py-2 text-sm font-semibold xl:text-lg cursor-pointer"
                            id="watchVideoBtn" data-video="<?php echo esc_url($data['video']['url']); ?>">
                        Watch Video
                    </button>
                <?php endif; ?>
            </div>
            <div class="lg:flex flex-col h-full justify-end lg:min-h-[400px]">
                <div class="lg:text-lg max-w-[440px] content mt-8 lg:mt-0">
                    <?php echo wp_kses_post($data['description_2']); ?>
                </div>
                <div class="my-4">
                    <a href="tel:01923923120" class="bg-white text-primary border-2 border-primary hover:bg-primary hover:text-white inline-block px-6 py-3 font-semibold transition duration-300 lg:text-xs">
                        Call Our Showroom
                    </a>
                </div>
                <div>
                    <a href="/showroom" class="bg-primary text-white hover:bg-primary/90 inline-block px-6 py-3 font-semibold transition duration-300 lg:text-xs">
                        Visit Our Showroom
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-[#dde2e4]/50">
        <div class="max-w-9xl mx-auto mt-8 lg:mt-32 py-8 lg:py-32">
            <div class="max-w-7xl relative bg-[#e0dbd1] rounded-xl lg:rounded-[35px] justify-center items-center text-white px-6 lg:px-12 py-12 lg:py-24">
                <div class="min-w-[100%] lg:min-w-[550px] lg:absolute left-12 bottom-24">
                    <div class="lg:h-[600px] flex justify-center items-center">
                        <div>
                            <div class="lg:text-lg text-primary max-w-[440px] content">
                                <h2 class="text-primary text-2xl lg:text-4xl mb-4">
                                    <?php echo esc_html($data['cta_title'] ?: 'Discover the Best of Italian Design'); ?>
                                </h2>
                                <p class="lg:text-lg text-primary max-w-[440px] content">
                                    <?php echo esc_html($data['cta_description'] ?: 'Visit our showroom to see the full collection of expertly sourced Italian furniture.'); ?>
                                </p>
                            </div>
                            <a href="/showroom" class="bg-primary text-white hover:bg-primary/90 inline-block mt-4 px-6 py-3 font-semibold transition duration-300 lg:text-xs">
                                Visit Our Showroom
                            </a>
                        </div>
                    </div>
                    <div class="flex gap-4 lg:gap-6 mt-6 lg:mt-8 justify-end">
                        <div class="bg-[#c1b2a8] p-1 lg:p-3 rounded-full group cursor-pointer" id="bottomSliderPrev">
                            <svg class="text-primary text-2xl w-[40px] lg:w-[50px] group-hover:scale-125" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8"/>
                            </svg>
                        </div>
                        <div class="bg-[#c1b2a8] p-1 lg:p-3 rounded-full group cursor-pointer" id="bottomSliderNext">
                            <svg class="text-primary text-2xl w-[40px] lg:w-[50px] group-hover:scale-125" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <?php if ($data['image_slider']): ?>
                    <div class="swiper-container bottom-product-slider lg:absolute lg:-right-[50%] mt-6 lg:mt-0 !bg-[#dddad1]" id="bottomProductSlider">
                        <div class="swiper-wrapper">
                            <?php foreach (array_reverse($data['image_slider']) as $slide): ?>
                                <div class="swiper-slide">
                                    <div class="hover:scale-110 transition-transform duration-500 ease-in-out min-h-[360px] lg:min-h-[750px] rounded-xl"
                                         style="background-image: url(<?php echo esc_url($slide['url']); ?>); background-position: center; background-size: cover;">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
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
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Main product slider
    const productSlider = new Swiper('#productSlider', {
        slidesPerView: 1,
        spaceBetween: 40,
        navigation: {
            nextEl: '#productNext',
            prevEl: '#productPrev',
        },
    });
    
    // Bottom product slider
    const bottomSlider = new Swiper('#bottomProductSlider', {
        slidesPerView: 2,
        spaceBetween: 40,
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
        },
        navigation: {
            nextEl: '#bottomSliderNext',
            prevEl: '#bottomSliderPrev',
        },
    });
    
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