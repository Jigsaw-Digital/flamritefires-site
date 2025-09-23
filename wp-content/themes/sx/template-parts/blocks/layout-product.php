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
    <div class="lg:flex justify-center items-center w-full gap-12 mx-auto relative">
        <div class="relative w-full lg:w-2/5  max-w-[700px]">
            <?php if ($data['image_slider']): ?>
                <div class="swiper-container product-slider overflow-hidden" id="productSlider">
                    <div class="swiper-wrapper">
                        <?php foreach ($data['image_slider'] as $slide): ?>
                            <div class="swiper-slide">
                                <div class="rounded-[35px] transition-transform duration-500 ease-in-out min-h-[380px] lg:min-h-[850px]"
                                     style="background-image: url(<?php echo esc_url($slide['url']); ?>); background-position: center; background-size: cover;">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="rounded-[35px] transition-transform duration-500 ease-in-out min-h-[380px] lg:min-h-[850px]"
                                     style="background-image: url(<?php echo esc_url($slide['url']); ?>); background-position: center; background-size: cover;">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="rounded-[35px] transition-transform duration-500 ease-in-out min-h-[380px] lg:min-h-[850px]"
                                     style="background-image: url(<?php echo esc_url($slide['url']); ?>); background-position: center; background-size: cover;">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="flex gap-4 lg:gap-6 mt-6 lg:mt-8 justify-end absolute bottom-4 right-4 z-10">
                    <div class="bg-[#1e2938] p-1 lg:p-3 rounded-full group cursor-pointer" id="productPrev">
                        <svg class="text-primary text-2xl w-[40px] lg:w-[50px] group-hover:scale-125" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8"/>
                        </svg>
                    </div>
                    <div class="bg-[#1e2938] p-1 lg:p-3 rounded-full group cursor-pointer" id="productNext">
                        <svg class="text-primary text-2xl w-[40px] lg:w-[50px] group-hover:scale-125" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8"/>
                        </svg>
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
                    <a href="tel:01923923120" class="bg-white text-primary border-2 border-primary hover:bg-primary hover:text-white inline-block px-6 py-3 font-semibold transition duration-300 lg:text-md">
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

<?php 
// Get CTA data - you can customize this or make it dynamic
$cta_data = [
    'title' => 'Other Products',
    'description' => 'Seeing and feeling furniture in person makes all the difference. Our expert designers work tirelessly to source the finest Italian-made pieces, and our website is just a taste of what we offer. Visit our two-storey, 3000 sq ft showroom in Watford, and let us show you the very best in Italian furniture design.'
];
?>

<div class="bg-[#1e2938]">
    <div class="max-w-[1800px] mx-auto mt-8 lg:mt-0 py-8 lg:py-32">
        <div class="max-w-7xl relative bg-[#e0dbd1] rounded-xl lg:rounded-[35px] justify-center items-center text-white px-6 lg:px-12 py-12 lg:py-24">
            <div class="min-w-[100%] lg:min-w-[550px] lg:absolute left-12 bottom-24">
                <div class="lg:h-[600px] flex justify-center items-center">
                    <div>
                        <div class="lg:text-lg text-primary max-w-[440px] content">
                            <h1 class="text-primary text-2xl lg:text-4xl mb-4">
                                <?php echo esc_html($cta_data['title']); ?>
                            </h1>
                            <p class="lg:text-lg text-[#1e2938] max-w-[440px] content">
                                <?php echo esc_html($cta_data['description']); ?>
                            </p>
                        </div>
                        <a href="/contact-us/" class="lg:text-xs mt-4 rounded-lg inline-block justify-center items-center border-3 border px-6 py-2 text-sm font-semibold xl:text-lg cursor-pointer bg-[#1e2938] hover:bg-primary text-wgite hover:text-white">
                            Contact Us
                        </a>
                    </div>
                </div>
                <div class="flex gap-4 lg:gap-6 mt-6 lg:mt-8 justify-end">
                    <div class="bg-[#c1b2a8] p-1 lg:p-3 rounded-full group cursor-pointer" id="bottomSliderPrev">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="text-primary text-2xl w-[40px] lg:w-[50px] group-hover:scale-125">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                        </svg>
                    </div>
                    <div class="bg-[#c1b2a8] p-1 lg:p-3 rounded-full group cursor-pointer" id="bottomSliderNext">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="text-primary text-2xl w-[40px] lg:w-[50px] group-hover:scale-125">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <?php if ($data['image_slider']): ?>
                <div class="swiper lg:absolute lg:-right-[50%] mt-6 lg:mt-0 !bg-[#dddad1]" id="bottomProductSlider">
                    <div class="swiper-wrapper">
                        <?php 
                        $reversed_images = array_reverse($data['image_slider']);
                        foreach ($reversed_images as $slide): 
                        ?>
                            <div class="swiper-slide">
                                <div class="hover:scale-110 transition-transform duration-500 ease-in-out min-h-[360px] lg:min-h-[750px] rounded-xl"
                                     style="background-image: url(<?php echo esc_url($slide['url']); ?>); background-position: center; background-size: cover;">
                                </div>
                            </div>
                              <div class="swiper-slide">
                                <div class="hover:scale-110 transition-transform duration-500 ease-in-out min-h-[360px] lg:min-h-[750px] rounded-xl"
                                     style="background-image: url(<?php echo esc_url($slide['url']); ?>); background-position: center; background-size: cover;">
                                </div>
                            </div>
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