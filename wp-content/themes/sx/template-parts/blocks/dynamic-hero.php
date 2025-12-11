<?php
/**
 * Dynamic Hero Block Template
 */

// Get individual fields
$media_type = get_field('media_type');
$background_image = get_field('background_image');
$video_source = get_field('video_source');
$video_file = get_field('video_file');
$video_url = get_field('video_url');
$small_hero = get_field('small_hero');
$overlay_opacity = get_field('overlay_opacity');
$title = get_field('hero_title');
$subtitle = get_field('hero_subtitle');
$description = get_field('hero_description');
$primary_cta = get_field('primary_cta');
$secondary_cta = get_field('secondary_cta');
$show_contact_form = get_field('show_contact_form');
$contact_form_title = get_field('contact_form_title');
$contact_form_button = get_field('contact_form_button');
$show_divider = get_field('show_divider');

// Check if this is a product page using WordPress functions
$is_product = is_singular('products');
$hero_class = $is_product ? 'bg-white h-[40vh] lg:h-[50vh] relative' : ($small_hero ? 'bg-white h-[calc(100vh-100px)] relative' : 'bg-white h-[100vh] relative');
$container_class = $is_product ? 'pt-[70px] hero-slider h-[40vh] lg:h-[50vh] object-cover !rounded-none' : ($small_hero ? 'mt-[70px] lg:mt-[110px] !mx-6 !lg:mx-12 hero-slider relative h-full lg:h-[calc(94vh-115px)] object-cover rounded-xl lg:rounded-[35px]' : 'h-[90vh] lg:h-[100vh] hero-slider !rounded-none');
?>

<section class="<?php echo $hero_class; ?>">
    <div class="<?php echo $container_class; ?>">
        <!-- Background Media -->
        <div class="hero-media-container absolute top-0 left-0 w-full h-full">
            <?php if ($media_type === 'video'): ?>
                <?php 
                $video_src = '';
                if ($video_source === 'upload' && $video_file) {
                    $video_src = $video_file['url'];
                } elseif ($video_source === 'url' && $video_url) {
                    $video_src = $video_url;
                }
                ?>
                <?php if (!empty($video_src)): ?>
                    <video class="object-cover w-full h-full"
                           autoplay
                           muted
                           loop
                           playsinline
                           preload="auto"
                           aria-hidden="true"
                           style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                        <source src="<?php echo esc_url($video_src); ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                <?php endif; ?>
            <?php elseif ($media_type === 'image' && $background_image): ?>
                <img src="<?php echo esc_url($background_image['url']); ?>" 
                     alt="<?php echo esc_attr($background_image['alt']); ?>" 
                     class="object-cover w-full h-full">
            <?php else: ?>
                <!-- Fallback background -->
                <div class="w-full h-full bg-gray-800"></div>
            <?php endif; ?>
        </div>
        
        <!-- Overlay -->
        <?php if ($overlay_opacity): ?>
            <div class="absolute top-0 left-0 w-full h-full bg-[#1e2938]/<?php echo intval($overlay_opacity); ?> z-10"></div>
        <?php endif; ?>
        
        <!-- Content -->
        <div class="absolute-full flex items-center px-6 lg:px-12 z-20">
            <div class="container mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left side - Text content -->
                <div class="text-left mt-[60px] h-full lg:mt-[75px] lg:mt-0 flex  flex-col justify-center ">
                    <div>
                    <?php if ($title): ?>
                        <h1 class="max-w-[800px] text-xl lg:text-[24px] text-white tracking-[0.3em] mb-4">
                            <?php echo esc_html($title); ?>
                        </h1>
                    <?php endif; ?>
                    
                    <?php if ($show_divider): ?>
                        <div class="h-[1px] bg-white w-[140px] sm:w-[300px] my-4 xl:my-6"></div>
                    <?php endif; ?>
                    
                    <?php if ($subtitle): ?>
                        <h2 class="max-w-[600px] text-sm lg:text-lg text-white tracking-[0.2em] mb-6">
                            <?php echo esc_html($subtitle); ?>
                        </h2>
                    <?php endif; ?>
                    
                    <?php if ($description): ?>
                        <div class="max-w-[600px] text-white text-sm lg:text-base mb-6">
                            <?php echo wp_kses_post($description); ?>
                        </div>
                    <?php endif; ?>
                    </div>

                    <!-- Outlet Banners - DISABLED: shop.flameritefires.com returns 403
                    <?php if (get_field('show_outlet_banners', 'option')): ?>
                        <div class="mb-6">
                            <a href="https://shop.flameritefires.com/" target="_blank" rel="noopener noreferrer" class="hidden md:block max-w-[360px]">
                                <img src="<?php echo get_site_url(); ?>/banners/OutletBanner_Desktop.png"
                                     alt="Flamerite Outlet - End of line fires at reduced prices"
                                     class="max-w-full h-auto hover:opacity-90 transition-opacity">
                            </a>
                            <a href="https://shop.flameritefires.com/" target="_blank" rel="noopener noreferrer" class="block md:hidden">
                                <img src="<?php echo get_site_url(); ?>/banners/OutletBanner_Mobile.png"
                                     alt="Flamerite Outlet - End of line fires at reduced prices"
                                     class="max-w-full h-auto hover:opacity-90 transition-opacity">
                            </a>
                        </div>
                    <?php endif; ?>
                    -->

                    <!-- Call to Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <?php if ($primary_cta): ?>
                            <a href="<?php echo esc_url($primary_cta['url']); ?>" 
                               class="bg-white text-primary hover:bg-gray-100 inline-block px-6 py-3 font-semibold transition duration-300 text-center"
                               <?php if ($primary_cta['target']) echo 'target="' . esc_attr($primary_cta['target']) . '"'; ?>>
                                <?php echo esc_html($primary_cta['title']); ?>
                            </a>
                        <?php endif; ?>
                        
                        <?php if ($secondary_cta): ?>
                            <a href="<?php echo esc_url($secondary_cta['url']); ?>" 
                               class="border-2 border-white text-white hover:bg-white hover:text-primary inline-block px-6 py-3 font-semibold transition duration-300 text-center"
                               <?php if ($secondary_cta['target']) echo 'target="' . esc_attr($secondary_cta['target']) . '"'; ?>>
                                <?php echo esc_html($secondary_cta['title']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Right side - Contact Form -->
                <?php if ($show_contact_form && !$is_product): ?>
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
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Play video if present
    const video = document.querySelector('.hero-media-container video');
    if (video) {
        video.play().catch(e => {
            console.log('Video autoplay prevented:', e);
        });
    }
});
</script>