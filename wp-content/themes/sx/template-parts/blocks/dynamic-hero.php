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

$is_product = strpos($_SERVER['REQUEST_URI'], '/products/') !== false;
$hero_class = $is_product ? 'bg-white h-[40vh] lg:h-[50vh] relative' : ($small_hero ? 'bg-white h-[calc(100vh-100px)] relative' : 'bg-white h-[calc(100vh-100px)] relative');
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
            <div class="absolute top-0 left-0 w-full h-full bg-primary/<?php echo intval($overlay_opacity); ?> z-10"></div>
        <?php endif; ?>
        
        <!-- Content -->
        <div class="absolute-full flex items-center px-6 lg:px-12 z-20">
            <div class="container mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left side - Text content -->
                <div class="text-left mt-[60px] lg:mt-[75px] lg:mt-0 flex justify-center flex-col">
                    <?php if ($title): ?>
                        <h1 class="max-w-[800px] text-xl xl:text-3xl 2xl:text-4xl text-white tracking-[0.3em] mb-4">
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
                            <form class="space-y-2 lg:space-y-4" id="dynamicHeroContactForm">
                                <h3 class="text-white text-sm lg:text-xl mb-2 lg:mb-6 font-medium">
                                    <?php echo esc_html($contact_form_title ?: 'Get In Touch'); ?>
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
                                    <?php echo esc_html($contact_form_button ?: 'Submit'); ?>
                                </button>
                            </form>
                            
                            <div class="hidden" id="dynamicHeroThankYou">
                                <h2 class="text-white text-lg font-semibold mb-4">Thank you</h2>
                                <p class="text-white">We will be in touch shortly.</p>
                            </div>
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
    
    // Contact form submission
    const form = document.getElementById('dynamicHeroContactForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show thank you message
            form.style.display = 'none';
            document.getElementById('dynamicHeroThankYou').classList.remove('hidden');
            
            // Reset form after delay
            setTimeout(function() {
                form.style.display = 'block';
                document.getElementById('dynamicHeroThankYou').classList.add('hidden');
                form.reset();
            }, 5000);
        });
    }
});
</script>