<?php
/**
 * Page Card Partial
 * Used for displaying page posts in search results and grids
 */

$featured_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
$excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 20);
?>

<div class="group bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100">
    <a href="<?php the_permalink(); ?>" class="block">
        <!-- Page Image -->
        <div class="relative">
            <?php if ($featured_image): ?>
                <div class="aspect-video overflow-hidden bg-gray-50">
                    <img src="<?php echo esc_url($featured_image); ?>"
                         alt="<?php echo esc_attr(get_the_title()); ?>"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
            <?php else: ?>
                <div class="aspect-video bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                    <div class="text-center text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="text-sm font-medium">Page</span>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Page Badge -->
            <div class="absolute top-3 left-3">
                <span class="inline-block bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-semibold px-3 py-1 rounded-full">
                    Page
                </span>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            <h3 class="text-xl font-bold text-gray-900 group-hover:text-primary transition-colors duration-200 leading-tight mb-3">
                <?php the_title(); ?>
            </h3>

            <?php if ($excerpt): ?>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    <?php echo esc_html($excerpt); ?>
                </p>
            <?php endif; ?>

            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <span class="text-xs text-gray-500"><?php echo get_the_date(); ?></span>
                <span class="inline-flex items-center text-primary font-medium text-sm group-hover:translate-x-1 transition-transform">
                    View Page
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </span>
            </div>
        </div>
    </a>
</div>
