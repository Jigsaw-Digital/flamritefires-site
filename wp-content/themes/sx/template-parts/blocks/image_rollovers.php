<?php
/**
 * Image Rollovers Section Layout
 *
 * @package SX
 */

// Block fields
$section_title = get_field('section_title') ?: 'Our Services';
$section_description = get_field('section_description') ?: 'Explore our range of services designed to meet your needs.';
$rollover_items = get_field('rollover_items');
$grid_columns_mobile = get_field('grid_columns_mobile') ?: '1';
$grid_columns_desktop = get_field('grid_columns_desktop') ?: '4';
$overlay_color = get_field('overlay_color') ?: '#ef4444';
$text_color = get_field('text_color') ?: '#ffffff';

// Set grid classes based on selected columns with validation
$mobile_grid_class = $grid_columns_mobile === '1' ? 'grid-cols-1' : 'grid-cols-2';

// Validate desktop grid columns (1-5) and set proper Tailwind classes
if ($grid_columns_desktop == '1') {
    $desktop_grid_class = 'lg:grid-cols-1';
} elseif ($grid_columns_desktop == '2') {
    $desktop_grid_class = 'lg:grid-cols-2';
} elseif ($grid_columns_desktop == '3') {
    $desktop_grid_class = 'lg:grid-cols-3';
} elseif ($grid_columns_desktop == '4') {
    $desktop_grid_class = 'lg:grid-cols-4';
} elseif ($grid_columns_desktop == '5') {
    $desktop_grid_class = 'lg:grid-cols-5';
} else {
    $desktop_grid_class = 'lg:grid-cols-4'; // Default fallback
}

// Convert hex color to rgba for overlay
if(function_exists('hex2rgba')){
    $overlay_rgba = hex2rgba($overlay_color);
}else{
    function hex2rgba($color, $opacity = 0.9) {
        $default = 'rgba(239, 68, 68, 0.9)'; // Default is red with 0.9 opacity
        
        // Return default if no color provided
        if(empty($color)) {
            return $default;
        }
        
        // Remove any spaces and the hash
        $color = str_replace(' ', '', $color);
        $color = ltrim($color, '#');
        
        if(strlen($color) == 6) {
            $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
        } elseif(strlen($color) == 3) {
            $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        } else {
            return $default;
        }
        
        $rgb = array_map('hexdec', $hex);
        
        return 'rgba(' . implode(',', $rgb) . ',' . $opacity . ')';
    }

    $overlay_rgba = hex2rgba($overlay_color);
}
?>

<section class="">
    <div class=" mx-auto">
        <!-- <?php if ($section_title || $section_description) : ?>
        <div class="text-center mb-12">
            <?php if ($section_title) : ?>
            <h2 class="text-3xl md:text-4xl font-bold mb-4"><?php echo esc_html($section_title); ?></h2>
            <?php endif; ?>
            
            <?php if ($section_description) : ?>
            <p class="text-gray-600 max-w-3xl mx-auto"><?php echo esc_html($section_description); ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?> -->
        
        <?php if ($rollover_items) : ?>
        <div class="grid <?php echo esc_attr($mobile_grid_class); ?> <?php echo esc_attr($desktop_grid_class); ?>">
            <?php foreach ($rollover_items as $item) : 
                $image = $item['image'];
                $title = $item['title'];
                $text = $item['text'];
                $link = $item['link'];
                
                // Skip if no image or title
                if (!$image || !$title) continue;
                
                // Determine if we should wrap in a link
                $has_link = !empty($link) && !empty($link['url']);
                $link_target = !empty($link['target']) ? $link['target'] : '_self';
            ?>
            
            <?php if ($has_link) : ?>
            <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link_target); ?>" class="block">
            <?php endif; ?>
            
            <div class="relative overflow-hidden group h-[300px] md:h-[350px] <?php echo $has_link ? '' : 'cursor-pointer'; ?>">
                <!-- Image -->
                <?php if ($image) : ?>
                <img 
                    src="<?php echo esc_url($image['url']); ?>" 
                    alt="<?php echo esc_attr($image['alt']); ?>" 
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                />
                <?php endif; ?>
                
                <!-- Default title overlay (visible by default, hidden on hover) -->
                <div class="absolute inset-0 opacity-100 group-hover:opacity-0 transition-opacity duration-300 flex flex-col justify-center items-center text-center p-6 b
                 bg-opacity-40">
                    <h3 class="text-xl md:text-2xl font-bold text-white">
                        <?php echo esc_html($title); ?>
                    </h3>
                </div>
                
                <!-- Hover overlay with content -->
                <div 
                    class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center text-center p-6"
                    style="background-color: <?php echo esc_attr($overlay_rgba); ?>; color: <?php echo esc_attr($text_color); ?>;"
                >
                    <h3 class="text-xl md:text-2xl font-bold mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <?php echo esc_html($title); ?>
                    </h3>
                    
                    <?php if ($text) : ?>
                    <p class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75">
                        <?php echo esc_html($text); ?>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php if ($has_link) : ?>
            </a>
            <?php endif; ?>
            
            <?php endforeach; ?>
        </div>
        <?php else : ?>
        <div class="text-center text-gray-500 py-8">
            <p>Please add some rollover items in the block settings.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Add custom styles for smoother animations -->
<style>
.group:hover .group-hover\:opacity-100 {
    opacity: 1;
}
.group:hover .group-hover\:translate-y-0 {
    transform: translateY(0);
}
.group:hover .group-hover\:scale-110 {
    transform: scale(1.1);
}
</style>
