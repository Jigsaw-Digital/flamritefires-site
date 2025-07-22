<?php
/**
 * Layout Slider Block Template
 */

// Get individual fields
$title = get_field('slider_title');
$sub_title = get_field('slider_sub_title');
$description = get_field('slider_description');
$slides_count = get_field('slider_slides_count');

// Validation
if (!$title || !$slides_count) return;
?>

<section class="bg-[#dde2e4] py-8 lg:py-24 px-6 lg:px-12 relative">
    <div class="lg:mx-auto max-w-7xl lg:flex justify-between gap-24 rounded-xl lg:px-12 lg:rounded-[35px] text-primary mb-8">
        <div class="lg:min-w-[400px]">
            <h2 class="text-4xl lg:text-5xl text-primary"><?php echo esc_html($title); ?></h2>
            <?php if ($sub_title): ?>
                <h3 class="mt-3 lg:mt-6 text-lg lg:text-xl text-primary">
                    <?php echo esc_html($sub_title); ?>
                </h3>
            <?php endif; ?>
        </div>
        <?php if ($description): ?>
            <div class="max-w-[700px]">
                <p class="mt-3 lg:mt-0 lg:text-xl text-primary lg:tracking-[0.1rem] lg:leading-8">
                    <?php echo esc_html($description); ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 justify-center relative max-w-[1800px] mx-auto">
        <?php for ($i = 1; $i <= intval($slides_count); $i++): ?>
            <?php 
            $slide_image = get_field('slide_' . $i . '_image');
            $slide_title = get_field('slide_' . $i . '_title');
            $slide_link = get_field('slide_' . $i . '_link');
            ?>
            
            <?php if ($slide_image): ?>
                <div class="relative h-full overflow-hidden aspect-square">
                    <?php if ($slide_link): ?>
                        <a href="<?php echo esc_url($slide_link['url']); ?>" 
                           <?php if ($slide_link['target']): ?>target="<?php echo esc_attr($slide_link['target']); ?>"<?php endif; ?>>
                    <?php endif; ?>
                        <div class="hover:scale-105 transition-transform duration-500 ease-in-out h-full">
                            <img src="<?php echo esc_url($slide_image['url']); ?>" 
                                 alt="<?php echo esc_attr($slide_image['alt'] ?: $slide_title); ?>"
                                 class="w-full object-cover h-full rounded-xl">
                        </div>
                        <?php if ($slide_title): ?>
                            <p class="text-[0.8rem] hidden lg:block lg:text-[1rem] uppercase tracking-widest absolute bottom-4 left-0 w-full text-center text-white">
                                <?php echo esc_html($slide_title); ?>
                            </p>
                            <p class="bg-primary px-5 py-1 text-[0.8rem] block lg:hidden lg:text-[1rem] uppercase tracking-widest absolute bottom-0 rounded-b-xl lg:rounded-none lg:bottom-4 left-0 w-full text-center text-white">
                                <?php echo esc_html($slide_title); ?>
                            </p>
                        <?php endif; ?>
                    <?php if ($slide_link): ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
</section>