<?php
/**
 * Brochure Card Partial
 * Used for displaying brochure posts in search results and grids
 */

$brochure_file = get_field('brochure_file');
$brochure_description = get_field('brochure_description');
$featured_image = get_the_post_thumbnail_url(get_the_ID(), 'large');

// Create excerpt
$excerpt = '';
if ($brochure_description) {
    $excerpt = wp_trim_words(strip_tags($brochure_description), 20, '...');
} elseif (has_excerpt()) {
    $excerpt = wp_trim_words(get_the_excerpt(), 20, '...');
}

// Get file URL and size
$file_url = $brochure_file ? $brochure_file['url'] : '';
$file_size = $brochure_file && isset($brochure_file['filesize']) ? size_format($brochure_file['filesize']) : '';
?>

<div class="group bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100">
    <?php if ($file_url): ?>
        <a href="<?php echo esc_url($file_url); ?>" target="_blank" class="block" rel="noopener noreferrer">
    <?php else: ?>
        <a href="<?php the_permalink(); ?>" class="block">
    <?php endif; ?>

        <!-- Brochure Image -->
        <div class="relative">
            <?php if ($featured_image): ?>
                <div class="aspect-[4/3] overflow-hidden bg-gray-50">
                    <img src="<?php echo esc_url($featured_image); ?>"
                         alt="<?php echo esc_attr(get_the_title()); ?>"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
            <?php else: ?>
                <div class="aspect-[4/3] bg-gradient-to-br from-gray-100 to-gray-200 flex-center">
                    <div class="text-center text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-document-text"/></svg>
                        <span class="text-sm font-medium">Brochure</span>
                    </div>
                </div>
            <?php endif; ?>

            <!-- PDF Badge -->
            <div class="absolute top-3 right-3">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    PDF
                </span>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            <div class="mb-3">
                <span class="inline-block bg-gray-100 text-gray-800 text-xs font-semibold px-3 py-1 rounded-full mb-2">
                    Brochures
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
                <?php if ($file_size): ?>
                    <span class="text-xs text-gray-500"><?php echo esc_html($file_size); ?></span>
                <?php else: ?>
                    <span class="text-xs text-gray-500"><?php echo get_the_date(); ?></span>
                <?php endif; ?>
                <span class="row-sm text-primary font-medium text-sm group-hover:translate-x-1 transition-transform">
                    Download
                    <svg class="w-4 h-4" fill="none" stroke="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-cloud-download"/></svg>
                </span>
            </div>
        </div>
    </a>
</div>
