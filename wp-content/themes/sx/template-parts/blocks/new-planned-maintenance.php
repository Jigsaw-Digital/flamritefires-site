<?php
/**
 * New Planned Maintenance Section Layout
 *
 * @package SX
 */

// Block fields
$section_title = get_field('section_title') ?: 'We Ensure Longevity & Efficiency';
$background_image = get_field('background_image');
$road_image = get_field('road_image');
$maintenance_items = get_field('maintenance_items') ?: array();
$button_text = get_field('button_text') ?: 'ENGINEER COVERAGE';
$button_url = get_field('button_url') ?: '#';

// Generate unique ID for this block
$block_id = 'new-planned-maintenance-' . uniqid();

// Vehicle SVG path
$vehicle_svg_path = get_template_directory_uri() . '/assets/images/vehicle.svg';

// Default items if none are set
if (empty($maintenance_items)) {
    $maintenance_items = array(
        array('title' => 'Bespoke', 'subtitle' => 'Planned Maintenance Packages'),
        array('title' => 'Optional', 'subtitle' => 'Cleaning'),
        array('title' => 'Equipment', 'subtitle' => 'Training Videos'),
        array('title' => 'Decarb', 'subtitle' => ''),
        array('title' => 'Scheduled', 'subtitle' => 'Consumable Replacements'),
        array('title' => 'Full Kitchen', 'subtitle' => 'Refurbs'),
        array('title' => 'IKS', 'subtitle' => 'Insights'),
        array('title' => 'All to', 'subtitle' => 'F5620 Standards')
    );
}

// Ensure we have exactly 8 items for the grid
$maintenance_items = array_slice($maintenance_items, 0, 8);
while (count($maintenance_items) < 8) {
    $maintenance_items[] = array('title' => '', 'subtitle' => '');
}
?>

<section class="relative py-16   overflow-hidden">

    <!-- Road Image -->
    <div class="flex justify-center my-8 absolute top-[190px] left-0 right-0 w-full hidden lg:block">
            <!-- Dotted Line if no road image -->
            <div class="justify-center my-8  w-full ">
                 <div class="bg-red-600/20  h-[74px] w-full"></div>
                <div class="bg-white/20 h-[1px] w-full"></div>
                 <div class="bg-red-600/20  h-[74px] w-full"></div>
            </div>
        </div>


    <!-- Background Image -->
    <?php if ($background_image): ?>
        <div class="absolute inset-0 z-0">
            <img 
                src="<?php echo esc_url($background_image['url']); ?>" 
                alt="<?php echo esc_attr($background_image['alt']); ?>"
                class="w-full h-full object-cover opacity-30"
            >
        </div>
    <?php endif; ?>

    <!-- Background Pattern -->

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Title -->
        <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
            <h2 class="text-xl md:text-3xl font-bold text-gray-800 mb-0 lg:mb-4">
                <?php 
                $title_parts = explode(' ', $section_title);
                if (count($title_parts) >= 2) {
                    $first_part = $title_parts[0] . ' ' . $title_parts[1];
                    $second_part = implode(' ', array_slice($title_parts, 2));
                    echo '<span class="text-red-600">' . esc_html($first_part) . '</span> ' . esc_html($second_part);
                } else {
                    echo esc_html($section_title);
                }
                ?>
            </h2>
        </div>

        <!-- Desktop Layout: 2 rows of 4 items each -->
        <div class="hidden md:block">
            <!-- Top Row -->
            <div class="grid grid-cols-4 gap-8">
                <?php for ($i = 0; $i < 4; $i++): ?>
                    <div class="flex flex-col justify-between items-center text-center" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="<?php echo 300 + ($i * 150); ?>">

                     <!-- Text -->
                        <div class="text-gray-800">
                            <?php if (!empty($maintenance_items[$i]['title'])): ?>
                                <div class="text-lg font-bold mb-1"><?php echo $maintenance_items[$i]['title']; ?></div>
                            <?php endif; ?>
                            <?php if (!empty($maintenance_items[$i]['subtitle'])): ?>
                                <p class="text-sm"><?php echo esc_html($maintenance_items[$i]['subtitle']); ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- <div class="bg-red-600/40  h-full w-[1px]"></div> -->

                        <!-- Vehicle SVG -->
                        <div class="h-16 mb-4 opacity-60 mt-12 z-10">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vehicle.svg" class="w-full h-full" style="opacity: 0.<?php echo $i + 1; ?>;">
                        </div>
                        
                    </div>
                <?php endfor; ?>
            </div>

            <!-- Bottom Row -->
            <div class="grid grid-cols-4 gap-8 mb-12">
                <?php for ($i = 4; $i < 8; $i++): ?>
                    <div class="flex flex-col justify-between items-center text-center" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="<?php echo 1200 - (($i - 4) * 150); ?>">
                        
                     <div class="h-16 mb-12">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vehicle.svg" class="w-full h-full" style="transform: scaleX(-1); opacity: 0.<?php echo 8 - $i + 4; ?>;">
                        </div>
                        
                        <!-- Text -->
                        <div class="text-gray-800">
                            <?php if (!empty($maintenance_items[$i]['title'])): ?>
                                <div class="text-lg font-bold mb-1"><?php echo $maintenance_items[$i]['title']; ?></div>
                            <?php endif; ?>
                            <?php if (!empty($maintenance_items[$i]['subtitle'])): ?>
                                <p class="text-sm"><?php echo esc_html($maintenance_items[$i]['subtitle']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <!-- Mobile Layout: List with bullet points -->
        <div class="md:hidden space-y-2 mb-12">
            <?php foreach ($maintenance_items as $item): ?>
                <?php if (!empty($item['title'])): ?>
                    <div class="flex items-center space-x-4">
                        <!-- Vehicle SVG as bullet -->
                        <div class="h-12 w-12 mb-0 opacity-60">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vehicle.svg" class="w-full h-full">
                        </div>
                        
                        <!-- Text -->
                        <div class="text-gray-800">
                            <div class=" font-bold"><?php echo $item['title']; ?></div>
                            <?php if (!empty($item['subtitle'])): ?>
                                <p class="text-sm"><?php echo esc_html($item['subtitle']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

      
    </div>
</section>