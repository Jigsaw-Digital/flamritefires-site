<?php
/**
 * Welcome Section Layout
 *
 * @package SX
 */

// Block fields
$title = get_field('title') ?: 'Welcome to';
$subtitle = get_field('subtitle') ?: 'Asset Management';
$content = get_field('content') ?: 'Keeping your kitchen and catering facilities in optimal working order, so you can focus on what you do best. Our range of Asset Management services offer extensive protection and support for commercial kitchens.';
$cta = get_field('cta');
$image = get_field('image');
?>

<section class="relative overflow-hidden">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/left-decal.png" class="hidden lg:block absolute left-0 h-full top-0 w-1/2 object-cover opacity-100" data-animation="fadeLeft">
    <div class="mx-auto">
        <div class="flex flex-col md:flex-row items-center">
            <div class="w-full md:w-1/2 relative">
                <div class="max-w-[500px] lg:float-right px-4 lg:px-0">
                    <h2 class="text-3xl md:text-5xl mb-8 opacity-100  font-thin" data-animation="fadeUp">
                        <?php echo esc_html($title); ?><br>
                        <span class="text-red-600 font-bold"><?php echo esc_html($subtitle); ?></span><br>
                        by Advance
                    </h2>
                    
                    <div class="text-gray-600 mb-8 opacity-100 " data-animation="fadeUp" data-delay="200">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                    
                    <?php if ($cta) : ?>
                    <a href="<?php echo esc_url($cta['url']); ?>" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded-full transition duration-300 opacity-100 transform mt-12" data-animation="fadeUp" data-delay="400">
                        <?php echo esc_html($cta['title']); ?>
                    </a>
                    <?php else : ?>
                    <a href="#" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded-full transition duration-300 opacity-100 transform mt-12" data-animation="fadeUp" data-delay="400">TELL ME MORE</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="w-full lg:w-1/2 mt-12 lg:mt-0">
                <?php if ($image) : ?>
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="w-full opacity-100 lg:object-cover" data-animation="fadeLeft">
                <?php else : ?>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/right-video.png" alt="Kitchen equipment" class="w-full opacity-100 lg:object-cover" data-animation="fadeLeft">
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="absolute left-0 bottom-0 w-1/4 h-1/2 bg-red-100 rounded-tr-full opacity-20 z-[-1]"></div>
</section>