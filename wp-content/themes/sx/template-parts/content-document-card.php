<?php
/**
 * Document Card Partial
 * Used for displaying document posts in search results and grids
 */

$document_description = get_field('document_description');
$document_file = get_field('document_file');
$document_file_type = get_field('document_file_type');
$featured_image = get_the_post_thumbnail_url(get_the_ID(), 'large');

// Create excerpt
$excerpt = '';
if ($document_description) {
    $excerpt = wp_trim_words(strip_tags($document_description), 20, '...');
} elseif (has_excerpt()) {
    $excerpt = wp_trim_words(get_the_excerpt(), 20, '...');
} else {
    $excerpt = wp_trim_words(strip_tags(get_the_content()), 20, '...');
}

// Get file URL
$file_url = $document_file ? $document_file['url'] : '';
$file_size = $document_file && isset($document_file['filesize']) ? size_format($document_file['filesize']) : '';

// File type badge colors
if (!function_exists('get_document_badge_color')) {
    function get_document_badge_color($file_type) {
        $badges = array(
            'pdf' => 'bg-red-100 text-red-800',
            'word' => 'bg-blue-100 text-blue-800',
            'excel' => 'bg-green-100 text-green-800',
            'powerpoint' => 'bg-orange-100 text-orange-800',
            'text' => 'bg-gray-100 text-gray-800',
            'flame_rite_fire_econtrol' => 'bg-primary/10 text-primary',
            'flame_rite_fire_instructions' => 'bg-primary/10 text-primary',
            'e_fx_instructions' => 'bg-primary/10 text-primary',
            'e_ridium_instructions' => 'bg-primary/10 text-primary',
            'other' => 'bg-purple-100 text-purple-800',
        );
        return $badges[$file_type] ?? 'bg-gray-100 text-gray-800';
    }
}

if (!function_exists('get_document_type_label')) {
    function get_document_type_label($file_type) {
        $labels = array(
            'pdf' => 'PDF',
            'word' => 'DOC',
            'excel' => 'XLS',
            'powerpoint' => 'PPT',
            'text' => 'TXT',
            'flame_rite_fire_econtrol' => 'ECONTROL',
            'flame_rite_fire_instructions' => 'INSTRUCTIONS',
            'e_fx_instructions' => 'E-FX',
            'e_ridium_instructions' => 'E-RIDIUM',
            'other' => 'FILE',
        );
        return $labels[$file_type] ?? 'FILE';
    }
}
?>

<div class="group bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100">
    <?php if ($file_url): ?>
        <a href="<?php echo esc_url($file_url); ?>" target="_blank" class="block" rel="noopener noreferrer">
    <?php endif; ?>

        <!-- Image/Preview -->
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
                        <span class="text-sm font-medium">Document</span>
                    </div>
                </div>
            <?php endif; ?>

            <!-- File Type Badge -->
            <?php if ($document_file_type): ?>
                <div class="absolute top-3 right-3">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo esc_attr(get_document_badge_color($document_file_type)); ?>">
                        <?php echo esc_html(get_document_type_label($document_file_type)); ?>
                    </span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Content -->
        <div class="p-6">
            <div class="mb-3">
                <span class="inline-block bg-gray-100 text-gray-800 text-xs font-semibold px-3 py-1 rounded-full mb-2">
                    Documents
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
                <?php endif; ?>
                <span class="row-sm text-primary font-medium text-sm group-hover:translate-x-1 transition-transform">
                    View Details
                    <svg class="w-4 h-4" fill="none" stroke="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-arrow-right"/></svg>
                </span>
            </div>
        </div>

    <?php if ($file_url): ?>
        </a>
    <?php endif; ?>
</div>
