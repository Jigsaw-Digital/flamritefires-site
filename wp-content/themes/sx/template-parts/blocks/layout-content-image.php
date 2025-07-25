<?php
/**
 * Layout Content Image Block Template
 */

// Get individual fields
$header_image = get_field('header_image');
$subtitle = get_field('subtitle');
$title = get_field('title');
$content = get_field('content');
$image_direction = get_field('image_direction');
$main_image = get_field('main_image');
$offset_image = get_field('offset_image');

// Validation
if (!$title || !$content || !$main_image) return;

// Set defaults
$image_direction = $image_direction ?: 'right';
?>

<section class="bg-tertiary pb-8 pt-8 lg:py-24 relative px-6">
    
    <div class="<?php echo ($image_direction == 'left' ? 'lg:flex-row-reverse' : ''); ?> mx-auto max-w-8xl gap-14 lg:flex items-center justify-between max-w-[1600px] mx-auto">
        <div class="w-full lg:w-1/2 space-y-4 lg:space-y-8">
            <!-- Header Image (if set) -->
            <?php if ($header_image): ?>
                <div class="text-center mb-4 lg:mb-6">
                    <img src="<?php echo esc_url($header_image['url']); ?>" 
                        alt="<?php echo esc_attr($header_image['alt']); ?>"
                        class=" rounded-xl  max-h-[50px] object-cover">
                </div>
            <?php endif; ?>

            <!-- Subtitle (if set) -->
            <?php if ($subtitle): ?>
                <p class="text-lg lg:text-xl text-orange-600 font-medium tracking-[0.1em] uppercase mb-4">
                    <?php echo esc_html($subtitle); ?>
                </p>
            <?php endif; ?>
            
            <!-- Main Title -->
            <h1 class="text-3xl lg:text-3xl font-bold text-primary mb-6">
                <?php echo esc_html($title); ?>
            </h1>
            
            <!-- Content -->
            <div class="lg:text-lg lg:mt-4 space-y-2">
                <?php echo wp_kses_post($content); ?>
            </div>
            
            <!-- Contact Button -->
            <a href="/contact-us" class="bg-primary text-white hover:bg-primary/90 inline-block mt-4 px-6 py-3 font-semibold transition duration-300 lg:text-xs">
                Contact Us
            </a>
        </div>
        
        <!-- Image Section -->
        <div class="w-full lg:w-1/2 relative">
            <img src="<?php echo esc_url($main_image['url']); ?>" 
                 alt="<?php echo esc_attr($main_image['alt']); ?>"
                 class="mt-8 lg:mt-0 rounded-xl lg:rounded-[35px] w-[80%] mx-auto object-cover max-h-[800px]">
            <?php if ($offset_image): ?>
                <img src="<?php echo esc_url($offset_image['url']); ?>" 
                     alt="<?php echo esc_attr($offset_image['alt']); ?>"
                     class="rounded-xl lg:rounded-[35px] w-1/2 object-cover hidden lg:block lg:absolute -left-24 -bottom-24">
            <?php endif; ?>
        </div>
    </div>
</section>