<?php
/**
 * Layout Hero Block Template
 */

$data = get_field('layout_hero_data');
if (!$data) return;

$is_product = strpos($_SERVER['REQUEST_URI'], '/products/') !== false;
?>

<section class="<?php echo $is_product ? 'bg-white h-[40vh] lg:h-[50vh] relative' : ($data['small'] ? 'bg-white h-[calc(100vh-100px)] relative' : 'bg-white h-[calc(100vh-100px)] relative'); ?>">
    <div class="<?php echo $is_product ? 'pt-[70px] hero-slider h-[40vh] lg:h-[50vh] object-cover !rounded-none' : ($data['small'] ? 'mt-[70px] lg:mt-[110px] !mx-6 !lg:mx-12 hero-slider relative h-full lg:h-[calc(94vh-115px)] object-cover rounded-xl lg:rounded-[35px]' : 'h-[90vh] lg:h-[100vh] hero-slider !rounded-none'); ?>">
        <?php if ($data['slides']): ?>
            <div class="swiper-container hero-slider" id="heroSwiper">
                <div class="swiper-wrapper">
                    <?php for ($i = 0; $i < $data['slides']; $i++): ?>
                        <div class="swiper-slide">
                            <div class="hero-image-container absolute top-0 left-0 w-full h-full">
                                <img src="<?php echo esc_url($data['slides_' . $i . '_background_image']['url']); ?>" 
                                     alt="Slide <?php echo $i + 1; ?> background" 
                                     class="object-cover w-full h-full">
                            </div>
                            
                            <div class="absolute top-0 left-0 w-full h-full bg-primary/40 z-10"></div>
                            <div class="absolute-full flex items-center px-6 lg:px-12 z-20">
                                <div class="container mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8"> 
                                    <!-- Left side - Text content aligned left -->
                                    <div class="text-left mt-[60px] lg:mt-[75px] lg:mt-0 flex justify-center flex-col">
                                        <h1 class="max-w-[800px] text-xl xl:text-3xl 2xl:text-4xl text-white tracking-[0.3em]">
                                            <?php echo esc_html($data['slides_' . $i . '_title']); ?>
                                        </h1>
                                        <div class="h-[1px] bg-white w-[140px] sm:w-[300px] my-4 xl:my-6"></div>
                                        <h2 class="max-w-[600px] text-sm lg:text-lg text-white tracking-[0.2em]">
                                            <?php echo esc_html($data['slides_' . $i . '_sub_title']); ?>
                                        </h2>
                                        <?php if ($data['slides_' . $i . '_call_to_action']): ?>
                                            <a href="<?php echo esc_url($data['slides_' . $i . '_call_to_action']['url']); ?>" 
                                               class="bg-white text-primary hover:bg-gray-100 inline-block mt-4 max-w-[300px] text-center px-6 py-3 font-semibold transition duration-300">
                                                <?php echo esc_html($data['slides_' . $i . '_call_to_action']['title']); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Right side - Contact Form -->
                                    <?php if (!$is_product): ?>
                                        <div class="hidden lg:flex items-center justify-center">
                                            <div class="backdrop-blur-md bg-white/20 p-4 lg:p-8 rounded-xl shadow-lg border border-white/30 w-full max-w-md">
                                                <iframe
                                                    src="https://api.leadconnectorhq.com/widget/form/08L7zVVi4qNLKn6Dwqf2"
                                                    style="width:100%;height:100%;border:none;border-radius:3px"
                                                    id="inline-08L7zVVi4qNLKn6Dwqf2"
                                                    data-layout="{'id':'INLINE'}"
                                                    data-trigger-type="alwaysShow"
                                                    data-trigger-value=""
                                                    data-activation-type="alwaysActivated"
                                                    data-activation-value=""
                                                    data-deactivation-type="neverDeactivate"
                                                    data-deactivation-value=""
                                                    data-form-name="Hero"
                                                    data-height="undefined"
                                                    data-layout-iframe-id="inline-08L7zVVi4qNLKn6Dwqf2"
                                                    data-form-id="08L7zVVi4qNLKn6Dwqf2"
                                                    title="Hero">
                                                </iframe>
                                                <script src="https://link.msgsndr.com/js/form_embed.js"></script>
                                            </div>
                                        </div>
                                    <?php endif; ?>
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
    const heroSwiper = new Swiper('#heroSwiper', {
        slidesPerView: 1,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        }
    });
});
</script>