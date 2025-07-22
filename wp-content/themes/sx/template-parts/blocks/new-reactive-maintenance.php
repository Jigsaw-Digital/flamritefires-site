<?php
/**
 * New Reactive Maintenance Section Layout
 *
 * @package SX
 */

// Block fields
$section_title = get_field('section_title') ?: 'Via our bespoke invested technologies, processes and team, we promise';
$background_image = get_field('background_image');
$left_svg = get_field('left_svg');
$right_svg = get_field('right_svg');
$timeline_items = get_field('timeline_items') ?: array();

// Generate unique ID for this block
$block_id = 'new-reactive-maintenance-' . uniqid();

// Default timeline items if none are set
if (empty($timeline_items)) {
    $timeline_items = array(
        array(
            'title' => 'Reduce Downtime',
            'description' => '• Business critical scheduling\n• Mergency protocols\n• Engineers PDA\n• Regular reviews and reporting eg FTP, parts availability, open calls\n• Training for engineers\n• Objective led PPMs\n• IKS insights'
        ),
        array(
            'title' => 'Reduce Costs', 
            'description' => 'Cost-effective solutions and efficient resource management to minimize operational expenses.'
        ),
        array(
            'title' => 'Reduce Call Outs',
            'description' => 'Proactive maintenance and monitoring to prevent emergency callouts and system failures.'
        )
    );
}

// Ensure we have exactly 3 items
$timeline_items = array_slice($timeline_items, 0, 3);
while (count($timeline_items) < 3) {
    $timeline_items[] = array('title' => '', 'description' => '', 'image' => null);
}
?>

<section class="relative py-16 overflow-hidden">
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
    <div class="absolute inset-0 opacity-20 z-0">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <defs>
                <pattern id="reactive-circles" x="0" y="0" width="25" height="25" patternUnits="userSpaceOnUse">
                    <circle cx="12.5" cy="12.5" r="10" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(#reactive-circles)"/>
        </svg>
    </div>

    <div class="mx-auto px-4 lg:px-0 relative z-10">
        <!-- Title -->
        <div class="text-center mb-8 lg:mb-16" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
            <h2 class="text-xl md:text-3xl  font-bold text-gray-800 max-w-4xl mx-auto">
                <?php 
                $title_parts = explode(', ', $section_title);
                if (count($title_parts) >= 2) {
                    $first_part = $title_parts[0];
                    $second_part = implode(', ', array_slice($title_parts, 1));
                    $second_part_red = preg_replace('/(we promise to)/i', '<span class="text-red-600">$1</span>', esc_html($second_part));
                    echo esc_html($first_part) . ', ' . $second_part_red;
                } else {
                    echo esc_html($section_title);
                }
                ?>
            </h2>
        </div>

        <!-- Desktop Timeline -->
        <div class="hidden md:block">
            <div class="relative">
                <!-- Timeline Line -->
                <div class="absolute top-1/2 left-0 right-0 h-2 transform -translate-y-1/2 z-0">
                    <div class="bg-red-600 h-3 w-full"></div>
                    <div class="bg-white/50 h-[0.5px] w-full"></div>
                    <div class="bg-red-600 h-3 w-full"></div>
                </div>
                
                <!-- Timeline Items Container -->
                <div class="relative flex justify-between items-center z-10 max-w-7xl mx-auto h-[400px]">
                    <!-- Left SVG Device -->
                    <div class="flex-shrink-0 relative" data-aos="fade-right" data-aos-duration="800" data-aos-delay="300">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vehicle.svg" class="w-40">
                    </div>

                    <!-- Timeline Items -->
                    <?php foreach ($timeline_items as $index => $item): ?>
                        <div class="group relative flex-shrink-0" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="<?php echo 500 + ($index * 200); ?>">
                          
                                <!-- Other items: Images with red borders -->
                                 <div class="relative w-[250px] h-[250px] hover:w-[250px] hover:h-[400px] rounded-full overflow-hidden shadow-lg 
  cursor-pointer transition-transform duration-300 group-hover:scale-110">
  
   <div class="absolute top-0 left-0  w-[250px] h-[250px] rounded-full border-[30px]  border-red-600 opacity-50 pointer-events-none"></div>

                                    <h4 class="font-bold text-white px-3 text-lg mb-2 absolute inset-0 flex items-center justify-center text-center"><?php echo esc_html($item['title']); ?></h4>
                                           
                                <?php if (!empty($item['image'])): ?>
                                        <img 
                                            src="<?php echo esc_url($item['image']['url']); ?>" 
                                            alt="<?php echo esc_attr($item['image']['alt']); ?>"
                                            class="w-full h-full object-cover"
                                        >
                                    <?php else: ?>
                                        <div class="w-full h-full bg-gradient-to-br from-gray-400 to-gray-600 flex items-center justify-center">
                                            <span class="text-white font-bold text-sm text-center px-2">
                                                <?php echo esc_html($item['title']); ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                     
                                    <!-- Title overlay on hover -->
                                    <div class="absolute inset-0 bg-red-600 bg-opacity-90 flex flex-col items-center justify-center opacity-0 px-4 group-hover:opacity-100 transition-opacity duration-300">
                                        <?php if (!empty($item['icon'])): ?>
                                            <div class="mb-3">
                                                <img 
                                                    src="<?php echo esc_url($item['icon']['url']); ?>" 
                                                    alt="<?php echo esc_attr($item['icon']['alt']); ?>"
                                                    class="w-12 h-12 object-contain mx-auto"
                                                >
                                            </div>
                                        <?php endif; ?>
                                        <h3 class="text-white font-bold text-lg text-center px-2">
                                            <?php echo esc_html($item['title']); ?>
                                        </h3>
                                        <div class="text-center">
                                        <ul class="text-white text-sm mt-2 space-y-1 list-disc list-inside">
                                            <?php 
                                            $lines = explode(", ", $item['description']);
                                            foreach ($lines as $line) {
                                                echo '<li class="text-white text-sm">' . esc_html($line) . '</li>';
                                            } 
                                            ?>
                                        </ul>
                                    </div>
                                    </div>
                                </div>

                        </div>
                    <?php endforeach; ?>

                    <!-- Right SVG Device -->
                    <div class="flex-shrink-0 relative" data-aos="fade-left" data-aos-duration="800" data-aos-delay="300">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vehicle.svg" class="w-40">
                   
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Layout: Vertical List (SVGs hidden) -->
        <div class="md:hidden space-y-4">
            <?php foreach ($timeline_items as $index => $item): ?>
                <div class="bg-white rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-duration="600" data-aos-delay="<?php echo 300 + ($index * 150); ?>">
                    <div class="flex items-center space-x-4">
                        <!-- Circular Image -->
                        <div class="w-20 h-20 rounded-full overflow-hidden shadow-md border-4 border-red-600 flex-shrink-0">
                            <?php if (!empty($item['image'])): ?>
                                <img 
                                    src="<?php echo esc_url($item['image']['url']); ?>" 
                                    alt="<?php echo esc_attr($item['image']['alt']); ?>"
                                    class="w-full h-full object-cover"
                                >
                            <?php else: ?>
                                <div class="w-full h-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center">
                                    <span class="text-white font-bold text-xs text-center px-1">
                                        <?php echo esc_html($item['title']); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Content -->
                        <div class="flex-1">
                            <h3 class="font-bold text-red-600 text-lg mb-2"><?php echo esc_html($item['title']); ?></h3>
                             <ul class="text-gray-700 text-sm space-y-1">
                                    <?php 
                                    $lines = explode("\n", $item['description']);
                                    foreach ($lines as $line) {
                                        $line = trim($line);
                                        if (!empty($line)) {
                                            $line = ltrim($line, '•');
                                            echo '<li class="flex items-start"><span class="text-red-600 mr-2">•</span>' . esc_html(trim($line)) . '</li>';
                                        }
                                    }
                                    ?>
                                </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
/* Additional CSS for smooth hover effects */
.group:hover .absolute.top-full {
    animation: slideInUp 0.3s ease-out;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translate(-50%, 10px);
    }
    to {
        opacity: 1;
        transform: translate(-50%, 0);
    }
}
</style>