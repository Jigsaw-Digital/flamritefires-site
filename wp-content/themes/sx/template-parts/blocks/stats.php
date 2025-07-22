<?php
/**
 * Stats Section Layout
 *
 * @package SX
 */

// Block fields
$stats = get_field('stats');
$background_image = get_field('background_image');
?>

<section class="z-[999]">
    <div class="w-full mx-auto relative">
        <div class="stats-slider js-stats-slider relative overflow-y-hidden">
            <?php if ($background_image) : ?>
            <img src="<?php echo esc_url($background_image['url']); ?>" alt="<?php echo esc_attr($background_image['alt']); ?>" class="absolute left-0 h-full w-full object-cover opacity-100" data-animation="fadeLeft">
            <?php else : ?>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/stat-bg.png" class="absolute left-0 h-full w-full object-cover opacity-100" data-animation="fadeLeft">
            <?php endif; ?>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 relative">
                <?php 
                $opacity_variations = ['30', '40', '40', '20', '40', '40', '30', '20', '40', '30', '40', '40'];
                $count = 0;
                
                if ($stats) :
                    foreach ($stats as $stat) : 
                        $opacity = isset($opacity_variations[$count]) ? $opacity_variations[$count] : '30';
                        $count++;
                ?>
                <div class="text-white p-6 text-center aspect-square flex justify-center items-center relative border border-white">
                    <?php if ($opacity) : ?>
                    <div class="bg-black opacity-40 <?php echo $opacity; ?> absolute left-0 top-0 inset-[1px]"></div>
                    <?php endif; ?>
                    
                    <div class="z-10">
                        <?php if (isset($stat['number'])) : ?>
                        <span class="text-5xl font-bold text-white inline-block mb-2 counter" data-count="<?php echo esc_attr($stat['number']); ?>">0</span><span class="text-4xl text-gray-200 uppercase"><?php echo esc_html($stat['suffix']); ?></span>
                        <?php endif; ?>
                        
                        <?php if (isset($stat['label'])) : ?>
                        <span class="text-sm text-gray-200 uppercase block"><?php echo esc_html($stat['label']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php 
                    endforeach;
                else :
                    // Display placeholder stats if none defined
                    for ($i = 0; $i < 12; $i++) : 
                        $opacity = isset($opacity_variations[$i]) ? $opacity_variations[$i] : '30';
                        // Skip two cells to match the design (leave them empty)
                        if ($i == 2 || $i == 11) :
                ?>
                <div class="text-white p-6 text-center aspect-square flex justify-center items-center relative border border-white">
                </div>
                <?php else : ?>
                <div class="text-white p-6 text-center aspect-square flex justify-center items-center relative border border-white">
                    <?php if ($opacity) : ?>
                    <div class="bg-black opacity-50 <?php echo $opacity; ?> absolute left-0 top-0 inset-[1px]"></div>
                    <?php endif; ?>
                    
                    <div class="z-10">
                        <span class="text-5xl font-bold text-white block mb-2 counter" data-count="5644">0</span>
                        <span class="text-sm text-gray-200 uppercase">Total Equipment Assets Sold</span>
                    </div>
                </div>
                <?php 
                        endif;
                    endfor;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>