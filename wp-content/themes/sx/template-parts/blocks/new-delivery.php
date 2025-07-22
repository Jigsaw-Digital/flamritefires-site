<?php
/**
 * New Delivery Section Layout
 *
 * @package SX
 */

// Block fields
$section_title = get_field('section_title') ?: 'We deliver when you need it most';
$background_image = get_field('background_image');
$center_image = get_field('center_image');
$delivery_features = get_field('delivery_features') ?: array();

// Generate unique ID for this block
$block_id = 'new-delivery-' . uniqid();

// Default features if none are set
if (empty($delivery_features)) {
    $delivery_features = array(
        array('text' => 'All manufacturers', 'position' => 'top-left'),
        array('text' => 'Same day dispatch and speedy delivery on selected lines', 'position' => 'top-right'),
        array('text' => 'Objective approach, data led replacement planning', 'position' => 'bottom-left'),
        array('text' => 'National installation and disposal network', 'position' => 'bottom-right')
    );
}
?>

<section class="relative pt-16 pb-16 lg:pb-0 bg-gray-100 overflow-hidden">
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
    <div class="absolute inset-0 opacity-10 z-0">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <defs>
                <pattern id="delivery-circles" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                    <circle cx="10" cy="10" r="8" fill="none" stroke="rgba(255,192,203,0.5)" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(#delivery-circles)"/>
        </svg>
    </div>

    <div class="max-w-6xl mx-auto px-6 lg:px-8 relative z-10">
        <!-- Title -->
        <div class="text-center mb-8 lg:mb-16" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
            <h2 class="text-xl md:text-3xl font-bold text-gray-800">
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

        <!-- Desktop Layout: Positioned around center image -->
        <div class="hidden md:block relative">
            <div class="relative w-full max-w-4xl mx-auto h-96">
                <!-- Center Image -->
                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 z-20" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300">
                    <?php if ($center_image): ?>
                        <img 
                            src="<?php echo esc_url($center_image['url']); ?>" 
                            alt="<?php echo esc_attr($center_image['alt']); ?>"
                            class="h-[400px] object-contain "
                        >
                    <?php else: ?>
                        <div class="w-48 h-48 bg-gray-300 rounded-full flex items-center justify-center">
                            <span class="text-gray-600 text-sm">Center Image</span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Features positioned around center -->
                <?php foreach ($delivery_features as $index => $feature): ?>
                    <?php 
                    $position_classes = '';
                    $text_alignment = '';
                    $icon_margin = '';
                    $animation_direction = '';
                    
                    switch ($feature['position']) {
                        case 'top-left':
                            $position_classes = 'top-0 left-0';
                            $text_alignment = 'text-right';
                            $icon_margin = 'ml-4';
                            $animation_direction = 'fade-down-right';
                            break;
                        case 'top-right':
                            $position_classes = 'top-0 right-0';
                            $text_alignment = 'text-left';
                            $icon_margin = 'mr-4';
                            $animation_direction = 'fade-down-left';
                            break;
                        case 'bottom-left':
                            $position_classes = 'bottom-16 left-0';
                            $text_alignment = 'text-right';
                            $icon_margin = 'ml-4';
                            $animation_direction = 'fade-up-right';
                            break;
                        case 'bottom-right':
                            $position_classes = 'bottom-16 right-0';
                            $text_alignment = 'text-left';
                            $icon_margin = 'mr-4';
                            $animation_direction = 'fade-up-left';
                            break;
                    }
                    ?>
                    
                    <div class="absolute <?php echo $position_classes; ?> w-64 z-10" data-aos="<?php echo $animation_direction; ?>" data-aos-duration="800" data-aos-delay="<?php echo 600 + ($index * 200); ?>">
                        <div class="flex items-center <?php echo ($feature['position'] === 'top-right' || $feature['position'] === 'bottom-right') ? 'flex-row' : 'flex-row-reverse'; ?>">
                            <!-- Icon Circle -->
                            <div class="w-[8rem] h-[8rem] bg-white rounded-full shadow-lg  flex items-center justify-center <?php echo $icon_margin; ?>">
                                <?php if (!empty($feature['icon'])): ?>
                                    <img 
                                        src="<?php echo esc_url($feature['icon']['url']); ?>" 
                                        alt="<?php echo esc_attr($feature['icon']['alt']); ?>"
                                        class="[8rem] object-contain"
                                    >
                                <?php else: ?>
                                    <div class="w-8 h-8 bg-red-600 rounded"></div>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Text -->
                            <div class="flex-1 <?php echo $text_alignment; ?>">
                                <p class="text-gray-800 text-sm font-medium leading-tight">
                                    <?php echo esc_html($feature['text']); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Mobile Layout: Vertical list -->
        <div class="md:hidden space-y-8">
            <!-- Center Image -->
            <?php if ($center_image): ?>
                <div class="text-center mb-8" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="200">
                    <img 
                        src="<?php echo esc_url($center_image['url']); ?>" 
                        alt="<?php echo esc_attr($center_image['alt']); ?>"
                        class="w-32 h-32 object-contain mx-auto hidden lg:block"
                    >
                </div>
            <?php endif; ?>

            <!-- Features List -->
            <?php foreach ($delivery_features as $index => $feature): ?>
                <div class="flex items-center space-x-4" data-aos="fade-up" data-aos-duration="600" data-aos-delay="<?php echo 400 + ($index * 150); ?>">
                    <!-- Icon Circle -->
                    <div class="w-16 h-16 bg-white rounded-full shadow-lg border-4 border-red-600 flex items-center justify-center flex-shrink-0">
                        <?php if (!empty($feature['icon'])): ?>
                            <img 
                                src="<?php echo esc_url($feature['icon']['url']); ?>" 
                                alt="<?php echo esc_attr($feature['icon']['alt']); ?>"
                                class="w-8 h-8 object-contain"
                            >
                        <?php else: ?>
                            <div class="w-8 h-8 bg-red-600 rounded"></div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Text -->
                    <div class="flex-1">
                        <p class="text-gray-800 text-sm font-medium">
                            <?php echo esc_html($feature['text']); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>