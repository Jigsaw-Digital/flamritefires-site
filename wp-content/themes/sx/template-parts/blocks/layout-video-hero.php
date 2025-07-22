<?php
/**
 * Layout Video Hero Block Template
 */

$data = get_field('layout_video_hero_data');
if (!$data) return;
?>

<section class="<?php echo ($data['small'] ? 'bg-white pb-12 h-[calc(100vh-100px)] relative' : 'bg-white h-[90vh] lg:h-[100vh] relative'); ?>">
    <div class="<?php echo ($data['small'] ? 'mt-[70px] lg:mt-[110px] !mx-6 !lg:mx-12 hero-slider relative h-full lg:h-[calc(94vh-115px)] object-cover rounded-xl lg:rounded-[35px]' : 'h-[90vh] lg:h-[100vh] hero-slider !rounded-none'); ?>">
        <?php if ($data['slides']): ?>
            <div class="swiper-container hero-video-slider" id="videoHeroSwiper">
                <div class="swiper-wrapper">
                    <?php for ($i = 0; $i < $data['slides']; $i++): ?>
                        <div class="swiper-slide">
                            <div class="hero-video-container absolute top-0 left-0 w-full h-full">
                                <video src="<?php echo esc_url($data['slides_' . $i . '_video_url']); ?>" 
                                       class="object-cover w-full h-full"
                                       autoplay muted loop playsinline>
                                </video>
                            </div>
                            
                            <div class="absolute-full flex items-center px-6 lg:px-12">
                                <div class="container mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8">
                                    <!-- Left side - Text content aligned left -->
                                    <div class="text-left mt-[60px] lg:mt-[75px] lg:mt-0 flex justify-center flex-col">
                                        <h1 class="max-w-[800px] text-xl xl:text-3xl 2xl:text-4xl text-white tracking-[0.3em]">
                                            <?php echo esc_html($data['slides_' . $i . '_title']); ?>
                                        </h1>
                                        <div class="h-[1px] bg-white w-[140px] sm:w-[300px] my-4 xl:my-6 float-start mx-0"></div>
                                        <h2 class="max-w-[800px] text-sm lg:text-lg text-white tracking-[0.2em] text-left">
                                            <?php echo esc_html($data['slides_' . $i . '_sub_title']); ?>
                                        </h2>
                                        <?php if ($data['slides_' . $i . '_call_to_action']): ?>
                                            <a href="<?php echo esc_url($data['slides_' . $i . '_call_to_action']['url']); ?>" 
                                               class="bg-white text-primary hover:bg-gray-100 block mt-4 max-w-[300px] text-center px-6 py-3 font-semibold transition duration-300">
                                                Visit Our Showroom
                                            </a>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Right side - Contact Form -->
                                    <div class="hidden lg:flex items-center justify-center">
                                        <div class="backdrop-blur-md bg-white/20 p-4 lg:p-8 rounded-xl shadow-lg border border-white/30 w-full max-w-md">
                                            <form class="space-y-2 lg:space-y-4" id="videoHeroContactForm">
                                                <h3 class="text-white text-sm lg:text-xl mb-2 lg:mb-6 font-medium">
                                                    Get In Touch
                                                </h3>
                                                <div>
                                                    <input type="text" name="contact_name" placeholder="Full Name" 
                                                           class="w-full px-4 py-1 lg:py-3 bg-white/10 border border-white/30 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50" required>
                                                </div>
                                                <div>
                                                    <input type="email" name="contact_email" placeholder="Email Address" 
                                                           class="w-full px-4 py-1 lg:py-3 bg-white/10 border border-white/30 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50" required>
                                                </div>
                                                <div>
                                                    <input type="text" name="contact_phone" placeholder="Phone Number" 
                                                           class="w-full px-4 py-1 lg:py-3 bg-white/10 border border-white/30 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50" required>
                                                </div>
                                                <div>
                                                    <textarea name="contact_message" placeholder="Your Message" rows="3" 
                                                              class="w-full px-4 py-1 lg:py-3 bg-white/10 border border-white/30 rounded-lg text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50 resize-none" required></textarea>
                                                </div>
                                                <button type="submit" 
                                                        class="w-full py-1 lg:py-3 bg-white text-primary font-medium rounded-lg hover:bg-white/90 transition duration-300">
                                                    Submit
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const videoHeroSwiper = new Swiper('#videoHeroSwiper', {
        slidesPerView: 1,
        loop: true,
        autoplay: {
            delay: 7000,
            disableOnInteraction: false,
        }
    });
    
    // Contact form submission
    const form = document.getElementById('videoHeroContactForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Form submitted! (This is a placeholder - connect to your form handler)');
            form.reset();
        });
    }
});
</script>