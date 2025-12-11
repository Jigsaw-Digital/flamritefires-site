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
$background_theme = get_field('background_theme');
$disable_top_padding = get_field('disable_top_padding');

// Validation
if (!$title || !$content || !$main_image) return;

// Set defaults
$image_direction = $image_direction ?: 'right';
$background_theme = $background_theme ?: 'default';
$disable_top_padding = $disable_top_padding ?: false;

// Set theme-based classes and styles
$is_dark = ($background_theme === 'dark');
$is_dark_grey = ($background_theme === 'dark_grey');

if ($is_dark) {
    $bg_class = 'bg-[#1e2938]';
    $text_color = 'text-white';
    $subtitle_color = 'text-orange-400';
    $button_class = 'bg-white text-[#1e2938] hover:bg-gray-100';
} elseif ($is_dark_grey) {
    $bg_class = 'bg-[#e7e3de]';
    $text_color = 'text-[#1e2938]';
    $subtitle_color = 'text-orange-600';
    $button_class = 'bg-primary text-white hover:bg-primary/90';
} else {
    // Default theme
    $bg_class = 'bg-tertiary';
    $text_color = 'text-[#1e2938]';
    $subtitle_color = 'text-orange-600';
    $button_class = 'bg-primary text-white hover:bg-primary/90';
}

// Padding classes
$padding_class = $disable_top_padding ? 'pb-8 pt-8 lg:pb-16 lg:!pt-0' : 'pb-8 pt-8 lg:py-16';
?>

<section class="<?php echo $bg_class; ?> <?php echo $padding_class; ?> relative px-6 lg:px-10">
    
    <div class="<?php echo ($image_direction == 'left' ? 'lg:flex-row-reverse' : ''); ?> mx-auto max-w-8xl gap-14 lg:flex items-center justify-between max-w-[1600px] mx-auto">
        <div class="w-full lg:w-1/2 space-y-4 lg:space-y-8">
            <!-- Header Image (if set) -->
            <?php if ($header_image): ?>
                <div class="text-center mb-4 lg:mb-6">
                    <img src="<?php echo esc_url($header_image['url']); ?>" 
                        alt="<?php echo esc_attr($header_image['alt']); ?>"
                        class="<?php echo (strpos($header_image['url'], 'Deigned-in-the-UK.png') !== false ? 'max-h-[100px]' : 'max-h-[50px]');?> object-cover">
                </div>
            <?php endif; ?>

            <!-- Subtitle (if set) -->
            <?php if ($subtitle): ?>
                <p class="text-lg lg:text-xl <?php echo $subtitle_color; ?> font-medium tracking-[0.1em] uppercase mb-4">
                    <?php echo esc_html($subtitle); ?>
                </p>
            <?php endif; ?>
            
            <!-- Main Title -->
            <h2 class="text-3xl lg:text-3xl font-bold <?php echo $text_color; ?> mb-6">
                <?php echo esc_html($title); ?>
            </h2>
            
            <!-- Content -->
            <div class="lg:text-lg lg:mt-4 space-y-4 <?php echo $text_color; ?>">
                <?php echo wp_kses_post($content); ?>
            </div>
            
            <!-- Contact Button -->
            <a href="/contact-us" class="<?php echo $button_class; ?> inline-block mt-0 px-6 py-3 font-semibold transition duration-300 lg:text-xs">
                Contact Us
            </a>
        </div>
        
        <!-- Image Section -->
        <div class="w-full lg:w-1/2 relative">
            <img src="<?php echo esc_url($main_image['url']); ?>"
                 alt="<?php echo esc_attr($main_image['alt']); ?>"
                 class="mt-8 lg:mt-0 rounded-xl lg:rounded-[35px] w-full mx-auto object-cover lg:h-[500px]">
            <?php if ($offset_image): ?>
                <img src="<?php echo esc_url($offset_image['url']); ?>" 
                     alt="<?php echo esc_attr($offset_image['alt']); ?>"
                     class="rounded-xl lg:rounded-[35px] w-1/2 object-cover hidden lg:block lg:absolute -left-24 -bottom-24">
            <?php endif; ?>
        </div>
    </div>
</section>