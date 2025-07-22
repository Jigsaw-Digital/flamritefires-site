<?php
/**
 * Intro Section Layout
 *
 * @package SX
 */

// Block fields
$title = get_field('title') ?: 'Welcome to';
$subtitle = get_field('subtitle') ?: 'Asset Management';
$tagline = get_field('tagline') ?: 'by Advance';
$content = get_field('content') ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In id leo tortor. Integer eget nunc sit amet massa pretium pretium. Cras eu ipsum ac lorem laoreet lacinia. In hac habitasse platea dictumst.';
$cta = get_field('cta') ?: array('title' => 'TALK TO US', 'url' => '#', 'target' => '');
$media_type = get_field('media_type') ?: 'image';
$image = get_field('image');
$video = get_field('video');
$background_color = get_field('background_color') ?: '#ffffff';
$accent_color = get_field('accent_color') ?: '#ef4444';

// Generate inline styles
$accent_style = "color: {$accent_color};";
$bg_style = "background-color: {$background_color};";
$button_style = "background-color: #f59e0b; color: white;"; // Yellow button by default
?>

<section class="relative overflow-hidden">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <!-- Left Content Side -->
        <div class="p-8 md:p-12 lg:p-16 flex items-center" style="<?php echo esc_attr($bg_style); ?>">
            <div class="max-w-[500px] mx-auto md:ml-auto md:mr-0">
                <h2 class="text-3xl md:text-4xl lg:text-5xl mb-4 opacity-100  font-light" data-animation="fadeUp">
                    <?php echo esc_html($title); ?><br>
                    <span class="font-bold"><?php echo esc_html($subtitle); ?></span><br>
                    <span style="<?php echo esc_attr($accent_style); ?>"><?php echo esc_html($tagline); ?></span>
                </h2>
                
                <div class="text-gray-600 mb-8 opacity-100 " data-animation="fadeUp" data-delay="200">
                    <?php echo wp_kses_post($content); ?>
                </div>
                
                <a href="<?php echo esc_url($cta['url']); ?>" class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-full transition duration-300 opacity-100 transform mt-8" data-animation="fadeUp" data-delay="400" target="<?php echo esc_attr($cta['target']); ?>">
                    <?php echo esc_html($cta['title']); ?>
                </a>
            </div>
        </div>
        
        <!-- Right Media Side -->
        <div class="relative h-full min-h-[300px] md:min-h-[400px]">
            <?php if ($media_type === 'video' && $video) : ?>
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
                    if (strpos($video, 'youtube.com') !== false || strpos($video, 'youtu.be') !== false) {
                        // YouTube specific parameters
                        $video_args['showinfo'] = 0;
                        $video_args['rel'] = 0;
                    } elseif (strpos($video, 'vimeo.com') !== false) {
                        // Vimeo specific parameters
                        $video_args['title'] = 0;
                        $video_args['byline'] = 0;
                    }
                    
                    echo wp_oembed_get($video, $video_args); 
                    ?>
                    
                    <!-- Play button overlay -->
                    <div class="absolute inset-0 flex items-center justify-center video-play-button cursor-pointer z-10">
                        <div class="rounded-full bg-white bg-opacity-20 p-4 w-16 h-16 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="text-red-600">
                                <polygon points="5 3 19 12 5 21 5 3"></polygon>
                            </svg>
                        </div>
                    </div>
                </div>
            <?php elseif ($image) : ?>
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="absolute inset-0 h-full w-full object-cover">
            <?php else : ?>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/right-video.png" alt="Default image" class="absolute inset-0 h-full w-full object-cover">
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Background decorative elements -->
    <div class="absolute left-0 bottom-0 w-1/3 h-2/3 bg-red-100 rounded-tr-full opacity-20 z-[-1]"></div>
</section>

<!-- JavaScript for video play functionality -->
<?php if ($media_type === 'video' && $video) : ?>
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
<?php endif; ?>
