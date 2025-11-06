<?php
/**
 * Video Card Partial
 * Used for displaying video posts in search results and grids
 */

$video_url = get_field('video_url');
$video_description = get_field('video_description');
$featured_image = get_the_post_thumbnail_url(get_the_ID(), 'large');

// Get video thumbnail if available
$video_thumbnail = get_field('video_thumbnail');
if ($video_thumbnail) {
    $featured_image = $video_thumbnail['url'];
}

// Create excerpt
$excerpt = '';
if ($video_description) {
    $excerpt = wp_trim_words(strip_tags($video_description), 20, '...');
} elseif (has_excerpt()) {
    $excerpt = wp_trim_words(get_the_excerpt(), 20, '...');
}

// Get video categories
$categories = get_the_terms(get_the_ID(), 'video_category');
$category_name = '';
if ($categories && !is_wp_error($categories)) {
    $category_name = $categories[0]->name;
}

// Generate unique modal ID for this video
$modal_id = 'video-modal-' . get_the_ID();
?>

<div class="group bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100">
    <?php if ($video_url): ?>
        <button type="button"
                onclick="openVideoModal('<?php echo esc_js($modal_id); ?>')"
                class="block w-full text-left cursor-pointer"
                aria-label="Play <?php echo esc_attr(get_the_title()); ?>">
    <?php else: ?>
        <a href="<?php the_permalink(); ?>" class="block">
    <?php endif; ?>

        <!-- Video Thumbnail -->
        <div class="relative">
            <?php if ($featured_image): ?>
                <div class="aspect-video overflow-hidden bg-gray-50 relative">
                    <img src="<?php echo esc_url($featured_image); ?>"
                         alt="<?php echo esc_attr(get_the_title()); ?>"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                    <!-- Play Icon Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/30 transition-colors">
                        <div class="bg-primary w-16 h-16 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="aspect-video bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center relative">
                    <div class="text-center text-white">
                        <div class="bg-primary w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-2">
                            <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium">Video</span>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Category Badge -->
            <?php if ($category_name): ?>
                <div class="absolute top-3 left-3">
                    <span class="inline-block bg-white/90 backdrop-blur-sm text-primary text-xs font-semibold px-3 py-1 rounded-full">
                        <?php echo esc_html($category_name); ?>
                    </span>
                </div>
            <?php endif; ?>

            <!-- Duration Badge (if available) -->
            <?php
            $video_duration = get_field('video_duration');
            if ($video_duration): ?>
                <div class="absolute bottom-3 right-3">
                    <span class="inline-block bg-black/80 text-white text-xs font-medium px-2 py-1 rounded">
                        <?php echo esc_html($video_duration); ?>
                    </span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Content -->
        <div class="p-6">
            <div class="mb-3">
                <span class="inline-block bg-primary/10 text-primary text-xs font-semibold px-3 py-1 rounded-full mb-2">
                    Videos
                </span>
                <h3 class="text-xl font-bold text-gray-900 group-hover:text-primary transition-colors duration-200 leading-tight">
                    <?php the_title(); ?>
                </h3>
            </div>

            <?php if ($excerpt): ?>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    <?php echo esc_html($excerpt); ?>
                </p>
            <?php endif; ?>

            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <span class="text-xs text-gray-500"><?php echo get_the_date(); ?></span>
                <span class="inline-flex items-center text-primary font-medium text-sm group-hover:translate-x-1 transition-transform">
                    <?php echo $video_url ? 'Watch Video' : 'View Details'; ?>
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </span>
            </div>
        </div>
    </a>
</div>
