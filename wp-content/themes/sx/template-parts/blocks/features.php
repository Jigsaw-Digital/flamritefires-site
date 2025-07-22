<?php
/**
 * Features Section Layout
 *
 * @package SX
 */

// Block fields
$background_image = get_field('background_image');
$overlay_opacity = get_field('overlay_opacity') ?: 70;
$feature_columns = get_field('feature_columns');

// Only render the section if we have feature columns
if ($feature_columns && !empty($feature_columns)) :

// Icon mapping for Heroicons outline
$icon_map = array(
    'cog' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>',
    'currency-dollar' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
    'phone' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>',
    'clock' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
    'shield-check' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>',
    'chart-bar' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>',
    'users' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>',
    'lightning-bolt' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>'
);
?>

<section class="relative py-20 text-white overflow-hidden">
    <!-- Background Image - No overlay by default -->
    <?php if ($background_image && !empty($background_image['url'])) : ?>
        <div class="absolute inset-0 z-[-1]">
            <img src="<?php echo esc_url($background_image['url']); ?>" 
                 alt="<?php echo esc_attr($background_image['alt'] ?? ''); ?>" 
                 class="w-full h-full object-cover">
        </div>
    <?php else : ?>
        <!-- Fallback gradient background -->
        <div class="absolute inset-0 z-[-1] bg-gradient-to-br from-gray-800 to-gray-900"></div>
    <?php endif; ?>
    
    <!-- Dark overlay outside container -->
    <div class="absolute inset-0 z-[0]">
        <div class="h-full w-full relative">
            <!-- Left dark area -->
            <div class="absolute inset-y-0 left-0 right-auto w-[calc((100%-1280px)/2)] bg-black" style="opacity: <?php echo esc_attr($overlay_opacity / 100); ?>;"></div>
            <!-- Right dark area -->
            <div class="absolute inset-y-0 right-0 left-auto w-[calc((100%-1280px)/2)] bg-black" style="opacity: <?php echo esc_attr($overlay_opacity / 100); ?>;"></div>
            <!-- Center container area with column-specific overlays -->
            <div class="container mx-auto h-full relative">
                <div class="grid grid-cols-1 md:grid-cols-<?php echo count($feature_columns); ?> gap-0 h-full">
                    <?php for ($i = 0; $i < count($feature_columns); $i++) : ?>
                        <!-- Only add overlay to middle column(s) -->
                        <?php if (count($feature_columns) === 3 && $i === 1) : ?>
                            <div class="relative">
                                <div class="absolute inset-0 bg-black" style="opacity: <?php echo esc_attr($overlay_opacity / 100); ?>;"></div>
                            </div>
                        <?php elseif (count($feature_columns) === 2) : ?>
                            <!-- For 2 columns, no middle column -->
                            <div class="relative"></div>
                        <?php else : ?>
                            <!-- Clear areas for left and right columns -->
                            <div class="relative"></div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Content Container with proper z-index -->
    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-<?php echo count($feature_columns); ?> gap-8 lg:gap-12">
            <?php foreach ($feature_columns as $index => $column) : ?>
                <?php if (!empty($column['title'])) : ?>
                    <div class="text-center transform translate-y-10"  data-delay="<?php echo $index * 200; ?>">
                        <!-- Icon -->
                        <?php if (!empty($column['icon']) && !empty($column['icon_color'])) : ?>
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full border-2 border-white mb-6" style="border-color: <?php echo esc_attr($column['icon_color']); ?>;">
                                <span style="color: <?php echo esc_attr($column['icon_color']); ?>;">
                                    <?php echo $icon_map[$column['icon']] ?? $icon_map['cog']; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Title -->
                        <h3 class="text-2xl font-bold mb-6"><?php echo esc_html($column['title']); ?></h3>
                        
                        <!-- Feature Items -->
                        <?php if (!empty($column['items']) && is_array($column['items'])) : ?>
                            <ul class="text-left inline-block">
                                <?php foreach ($column['items'] as $item) : ?>
                                    <?php if (!empty($item['text'])) : ?>
                                        <li class="flex items-start mb-3">
                                            <span class="text-white mr-2 mt-1">•</span>
                                            <span class="text-white/90"><?php echo esc_html($item['text']); ?></span>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php endif; // End if feature_columns ?>