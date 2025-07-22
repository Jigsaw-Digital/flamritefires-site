<?php
/**
 * About Section Layout
 *
 * @package SX
 */

// Block fields
$title = get_field('title') ?: 'Powering';
$subtitle = get_field('subtitle') ?: 'up your kitchen';
$content = get_field('content') ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In id leo tortor. Integer eget nunc sit amet massa pretium pretium. Cras eu ipsum ac lorem laoreet lacinia. In hac habitasse platea dictumst. Ut vestibulum dolor gravida quam viverra tempus. Praesent nunc libero, ultricies sed nulla et, dignissim fermentum dolor. Maecenas ipsum massa, consectetur id interdum in, tincidunt vel purus.

Maecenas imperdiet tortor mattis massa mollis fermentum. Donec blandit auctor molestie. Pellentesque non dui vel diam dignissim suscipit. Cras dictum nibh in sem bibendum vehicula. Morbi ac felis luctus neque semper pharetra in in arcu. Sed sed risus ac libero malesuada malesuada. Proin tempus diam vitae libero egestas, quis pharetra augue molestie. Donec venenatis pretium arcu eget dignissim.';
$cta = get_field('cta');
$left_media_type = get_field('left_media_type') ?: 'image';
$left_image = get_field('left_image');
$left_video = get_field('left_video');
$right_image = get_field('right_image');
$section_title = get_field('section_title') ?: '';
?>

<section class="relative overflow-hidden">
    <div class="grid grid-cols-1 lg:grid-cols-2 w-full min-h-[500px]">
        <div class="h-full relative">
            <?php if ($left_media_type === 'video' && $left_video) : ?>
                <div class="absolute inset-0 h-full w-full video-container">
                    <?php 
                    // Get the video embed with controls hidden
                    $video_args = array(
                        'width' => '100%', 
                        'height' => '100%',
                        'controls' => 0,
                        'autoplay' => 0
                    );
                    
                    // Different providers may have different parameter names
                    if (strpos($left_video, 'youtube.com') !== false || strpos($left_video, 'youtu.be') !== false) {
                        // YouTube specific parameters
                        $video_args['showinfo'] = 0;
                        $video_args['rel'] = 0;
                    } elseif (strpos($left_video, 'vimeo.com') !== false) {
                        // Vimeo specific parameters
                        $video_args['title'] = 0;
                        $video_args['byline'] = 0;
                    }
                    
                    echo wp_oembed_get($left_video, $video_args); 
                    ?>
                    
                    <!-- Play button overlay -->
                    <div class="absolute inset-0 flex items-center justify-center video-play-button cursor-pointer z-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-80 hover:opacity-100 transition-opacity duration-300 bg-black bg-opacity-30 rounded-full p-4">
                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                        </svg>
                    </div>
                </div>
                
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const playButtons = document.querySelectorAll('.video-play-button');
                    
                    playButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const container = this.closest('.video-container');
                            const iframe = container.querySelector('iframe');
                            
                            // Hide the play button
                            this.style.display = 'none';
                            
                            // Get the iframe source
                            let src = iframe.src;
                            
                            // Add autoplay parameter based on video provider
                            if (src.includes('youtube')) {
                                // YouTube
                                if (src.includes('?')) {
                                    iframe.src = src + '&autoplay=1';
                                } else {
                                    iframe.src = src + '?autoplay=1';
                                }
                            } else if (src.includes('vimeo')) {
                                // Vimeo
                                if (src.includes('?')) {
                                    iframe.src = src + '&autoplay=1';
                                } else {
                                    iframe.src = src + '?autoplay=1';
                                }
                            }
                        });
                    });
                });
                </script>
            <?php elseif ($left_image) : ?>
                <div class="absolute left-0 top-0 h-full w-1/2 bg-white/80 z-10">
                </div>
                <img src="<?php echo esc_url($left_image['url']); ?>" alt="<?php echo esc_attr($left_image['alt']); ?>" class="absolute inset-0 h-full w-full object-cover"/>
            <?php else : ?>
                 <div class="absolute left-0 top-0 h-full w-1/2 bg-white/80 z-10">
                </div>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/power-left.png" class="absolute inset-0 h-full w-full object-cover"/>
            <?php endif; ?>
        </div>
        <div class="lg:max-h-[800px] relative">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/right-decal.png" class="absolute left-0 lg:h-[calc(100%+108px)] lg:-top-[108px] w-full object-cover opacity-100 z-10" data-animation="fadeLeft">
            
            <?php if ($section_title != ''): ?>
            <div class="hidden lg:block absolute top-0 right-0 w-full flex px-12 items-center text-2xl lg:text-6xl py-6 z-30 bg-white">
                <div class="w-full lg:w-[500px] text-center lg:text-left block font-thin text-red-600"><?php echo esc_html($section_title); ?></div>
            </div>
            <?php endif; ?>
            <div class="flex items-center justify-center flex-col z-20 relative overflow-hidden mb-8 mt-[100px] <?php echo $section_title != '' ? 'lg:mt-[108px]' : 'lg:mt-[0px]'; ?> py-12 lg:py-0">
                <div class="text-gray-800 rounded-lg h-full px-6 lg:px-12 mb-12 lg:mb-0 ">
                    <h3 class="text-2xl font-bold mb-4 pt-4 text-red-600 opacity-100  text-center" data-animation="fadeUp" data-delay="200">
                        <span class="text-black"><?php echo esc_html($title); ?></span><br>
                        <?php echo esc_html($subtitle); ?>
                    </h3>
                    
                    <div class="mb-8 opacity-100  text-center" data-animation="fadeUp" data-delay="300">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                    
                    <?php if ($cta) : ?>
                    <a href="<?php echo esc_url($cta['url']); ?>" class="max-w-[240px] text-center block mx-auto bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-full transition duration-300 opacity-100 mt-16" data-animation="fadeUp" data-delay="500">
                        <?php echo esc_html($cta['title']); ?>
                    </a>
                    <?php endif; ?>
                </div>
                <?php if ($right_image) : ?>
                <img src="<?php echo esc_url($right_image['url']); ?>" alt="<?php echo esc_attr($right_image['alt']); ?>" class="w-full object-cover max-h-[350px] lg:h-full lg:max-h-[700px]"/>
                  <?php endif; ?>
            </div>
        </div>
    </div>
</section>