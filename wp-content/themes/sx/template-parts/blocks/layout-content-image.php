<?php
/**
 * Layout Content Image Block Template
 */

$data = get_field('layout_content_image_data');
if (!$data) return;
?>

<section class="bg-tertiary pb-8 pt-8 lg:py-24 relative px-6">
    <div class="<?php echo ($data['image_direction'] == 'left' ? 'lg:flex-row-reverse' : ''); ?> mx-auto max-w-8xl gap-14 lg:flex items-center justify-between max-w-[1600px] mx-auto">
        <div class="w-full lg:w-1/2 space-y-4 lg:space-y-8">
            <h1 class="text-3xl lg:text-3xl font-bold text-primary mb-6">
                <?php echo esc_html($data['title']); ?>
            </h1>
            <div class="lg:text-lg lg:mt-4 space-y-2">
                <?php echo wp_kses_post($data['content']); ?>
            </div>
            <a href="/contact-us" class="bg-primary text-white hover:bg-primary/90 inline-block mt-4 px-6 py-3 font-semibold transition duration-300 lg:text-xs">
                Contact Us
            </a>
        </div>
        <div class="w-full lg:w-1/2 relative">
            <img src="<?php echo esc_url($data['image']['url']); ?>" 
                 alt="<?php echo esc_attr($data['image']['alt']); ?>"
                 class="mt-8 lg:mt-0 rounded-xl lg:rounded-[35px] w-[80%] mx-auto object-cover max-h-[800px]">
            <?php if ($data['image_offset']): ?>
                <img src="<?php echo esc_url($data['image_offset']['url']); ?>" 
                     alt="<?php echo esc_attr($data['image_offset']['alt']); ?>"
                     class="rounded-xl lg:rounded-[35px] w-1/2 object-cover hidden lg:block lg:absolute -left-24 -bottom-24">
            <?php endif; ?>
        </div>
    </div>
</section>