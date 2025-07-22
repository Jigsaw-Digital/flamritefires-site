<?php
/**
 * Awards Section Layout
 *
 * @package SX
 */

// Block fields
$section_title = get_field('section_title') ?: 'Our Awards';
$section_subtitle = get_field('section_subtitle') ?: 'Judged as Experts by professionals, brands, independents, chains and associations across the sector.';
$awards_list = get_field('awards_list');
$right_image = get_field('right_image');
$accent_color = get_field('accent_color') ?: '#ef4444';
$background_color = get_field('background_color') ?: '#ffffff';

// Generate inline styles
$accent_style = "color: {$accent_color};";
$bg_style = "background-color: {$background_color};";
?>

<section class="relative w-full" style="<?php echo esc_attr($bg_style); ?>">
    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Left content - Awards list -->
            <div class="order-2 md:order-1">
                <div class="max-w-[500px] mx-auto md:ml-auto md:mr-0">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6 text-center md:text-left">
                        Our <span style="<?php echo esc_attr($accent_style); ?>"><?php echo esc_html($section_title); ?></span>
                    </h2>
                    
                    <?php if ($section_subtitle) : ?>
                    <p class="text-gray-600 mb-0 lg:mb-8 text-center md:text-left text-lg">
                        "<?php echo esc_html($section_subtitle); ?>"
                    </p>
                    <?php endif; ?>
                    
                    <?php if ($awards_list) : ?>
                    <div class="space-y-4">
                        <?php foreach ($awards_list as $award) : 
                            $year = isset($award['year']) ? $award['year'] : '';
                            $title = isset($award['title']) ? $award['title'] : '';
                            $winner_text = isset($award['winner_text']) ? $award['winner_text'] : 'Winner';
                            $highlight = isset($award['highlight']) ? $award['highlight'] : false;
                            
                            // Skip if no title
                            if (!$title) continue;
                            
                            // Set classes based on highlight status
                            $award_classes = $highlight ? 'font-bold' : '';
                        ?>
                        <div class="flex items-start">
                            <span class="mr-2 text-lg">•</span>
                            <p class="<?php echo esc_attr($award_classes); ?>">
                                <?php if ($year) : ?>
                                <span class="mr-1"><?php echo esc_html($year); ?></span>
                                <?php endif; ?>
                                
                                <?php echo esc_html($title); ?>
                                
                                <?php if ($winner_text) : ?>
                                - <span style="<?php echo esc_attr($accent_style); ?>"><?php echo esc_html($winner_text); ?></span>
                                <?php endif; ?>
                            </p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php else : ?>
                    <div class="text-gray-500 py-4">
                        <p>Please add some awards in the block settings.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Right content - Image -->
            <div class="order-1 md:order-2">
                <?php if ($right_image) : ?>
                <img 
                    src="<?php echo esc_url($right_image['url']); ?>" 
                    alt="<?php echo esc_attr($right_image['alt']); ?>" 
                    class="w-full h-auto rounded-lg shadow-lg"
                />
                <?php else : ?>
                <img 
                    src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/awards-default.jpg" 
                    alt="Awards default image" 
                    class="w-full h-auto rounded-lg shadow-lg"
                />
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
