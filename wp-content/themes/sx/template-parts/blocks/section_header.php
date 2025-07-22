<?php
/**
 * Section Header Layout
 *
 * @package SX
 */

// Block fields
$title = get_field('title');
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$font_size = get_field('font_size') ?: 'text-2xl lg:text-6xl';
?>

<section class="relative overflow-hidden">
    <div class="grid grid-cols-1 lg:grid-cols-2 w-full">
        <div class="flex justify-center lg:justify-end relative text-center bg-[<?php echo esc_attr($background_color ?: '#0e0e0e'); ?>] text-<?php echo esc_attr($text_color ?: 'white'); ?> <?php echo esc_attr($font_size); ?> py-6">
            <div class="lg:w-[500px] text-center lg:text-left block font-thin"><?php echo esc_html($title); ?></div>
        </div>
        <div class="">
        </div>
    </div>
</section>