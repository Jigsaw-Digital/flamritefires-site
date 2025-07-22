<?php
/**
 * Small Hero Section Layout
 *
 * @package SX
 */

// Block fields
$title = get_field('title');
$background_image = get_field('background_image');
$overlay_opacity = get_field('overlay_opacity') ?: 50;
$text_alignment = get_field('text_alignment') ?: 'center';
$section_height = get_field('section_height') ?: 'medium';

// Height classes mapping
$height_classes = array(
    'small' => 'h-[200px]',
    'medium' => 'h-[300px]',
    'large' => 'h-[400px]',
    'xlarge' => 'h-[500px]'
);

// Text alignment classes
$alignment_classes = array(
    'left' => 'text-left',
    'center' => 'text-center',
    'right' => 'text-right'
);

$height_class = $height_classes[$section_height] ?? $height_classes['medium'];
$alignment_class = $alignment_classes[$text_alignment] ?? $alignment_classes['center'];
?>

<section class="relative text-white <?php echo esc_attr($height_class); ?> flex items-center overflow-hidden">
    <!-- Background Image with Overlay - Moved to top with negative z-index -->
    <?php if ($background_image) : ?>
        <div class="absolute inset-0 z-[-1]">
            <img src="<?php echo esc_url($background_image['url']); ?>" 
                 alt="<?php echo esc_attr($background_image['alt']); ?>" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black" style="opacity: <?php echo esc_attr($overlay_opacity / 100); ?>;"></div>
        </div>
    <?php else : ?>
        <!-- Fallback gradient background if no image is provided -->
        <div class="absolute inset-0 z-[-1] bg-gradient-to-r from-gray-800 to-gray-900"></div>
    <?php endif; ?>
    
    <!-- Content Container with proper z-index -->
    <div class="container mx-auto px-4 relative z-10">
        <div class="<?php echo esc_attr($alignment_class); ?> max-w-4xl ">
            <div class="hero-title !text-2xl text-left">
               <h1><?php echo wp_kses_post($title); ?></h1>
            </div>
        </div>
    </div>
</section>

<style>
/* Ensure proper styling for WYSIWYG content in hero */
.hero-title h1,
.hero-title h2,
.hero-title h3 {
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 0;
}

.hero-title h1 {
    font-size: 2.5rem;
}

.hero-title h2 {
    font-size: 2rem;
}

.hero-title h3 {
    font-size: 1.75rem;
}

.hero-title p {
    font-size: 1.125rem;
    opacity: 0.9;
    margin-top: 0.5rem;
}

@media (min-width: 768px) {
    .hero-title h1 {
        font-size: 3.5rem;
    }
    
    .hero-title h2 {
        font-size: 3rem;
    }
    
    .hero-title h3 {
        font-size: 2.5rem;
    }
    
    .hero-title p {
        font-size: 1.25rem;
    }
}
</style>