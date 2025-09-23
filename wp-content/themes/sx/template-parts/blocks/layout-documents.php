<?php
/**
 * Layout Documents Block Template
 */

$data = get_field('layout_documents_data');

// Get configuration variables
$title = $data['title'] ?? 'Documents';
$description = $data['description'] ?? '';
$documents_selection_type = $data['documents_selection_type'] ?? 'all';
$documents_type_filter = $data['documents_type_filter'] ?? '';
$documents_limit = $data['documents_limit'] ?? 12;
$show_file_type = $data['show_file_type'] ?? true;
$columns = $data['columns'] ?? '3';

// Get documents based on selection
$documents = array();

if ($documents_selection_type === 'manual' && !empty($data['documents_selection'])) {
    // Use manually selected documents
    $documents = $data['documents_selection'];
} elseif ($documents_selection_type === 'by_type' && $documents_type_filter) {
    // Filter by document type
    $args = array(
        'post_type' => 'documents',
        'post_status' => 'publish',
        'posts_per_page' => $documents_limit > 0 ? $documents_limit : -1,
        'meta_query' => array(
            array(
                'key' => 'document_file_type',
                'value' => $documents_type_filter,
                'compare' => '='
            )
        )
    );
    $document_query = new WP_Query($args);
    $documents = $document_query->posts;
    wp_reset_postdata();
} else {
    // Get all documents
    $args = array(
        'post_type' => 'documents',
        'post_status' => 'publish',
        'posts_per_page' => $documents_limit > 0 ? $documents_limit : -1,
    );
    $document_query = new WP_Query($args);
    $documents = $document_query->posts;
    wp_reset_postdata();
}

// Define grid columns class
$grid_cols = 'md:grid-cols-2 lg:grid-cols-3';
if ($columns === '2') {
    $grid_cols = 'md:grid-cols-2';
} elseif ($columns === '4') {
    $grid_cols = 'md:grid-cols-2 lg:grid-cols-4';
}

// Get file type badge colors
if (!function_exists('get_file_type_badge')) {
    function get_file_type_badge($file_type) {
        $badges = array(
            'pdf' => 'bg-red-100 text-red-800',
            'word' => 'bg-blue-100 text-blue-800',
            'excel' => 'bg-green-100 text-green-800',
            'powerpoint' => 'bg-orange-100 text-orange-800',
            'text' => 'bg-gray-100 text-gray-800',
            'other' => 'bg-purple-100 text-purple-800',
        );
        return $badges[$file_type] ?? 'bg-gray-100 text-gray-800';
    }
}

if (!function_exists('get_file_type_label')) {
    function get_file_type_label($file_type) {
        $labels = array(
            'pdf' => 'PDF',
            'word' => 'DOC',
            'excel' => 'XLS',
            'powerpoint' => 'PPT',
            'text' => 'TXT',
            'other' => 'FILE',
        );
        return $labels[$file_type] ?? 'FILE';
    }
}
?>

<section class="py-16 bg-white">
    <!-- Header Section -->
    <div class="mx-auto max-w-9xl container px-6 lg:px-8 mb-12">
        <div class="text-center max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                <?php echo esc_html($title); ?>
            </h1>

            <?php if ($description): ?>
                <div class="text-lg text-gray-600 font-montserrat">
                    <?php echo wp_kses_post($description); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Documents Grid -->
    <?php if (!empty($documents)): ?>
        <div class="mx-auto max-w-9xl container px-6 lg:px-8">
            <div class="grid grid-cols-1 <?php echo esc_attr($grid_cols); ?> gap-8">
                <?php foreach ($documents as $document): ?>
                    <?php
                    $document_description = get_field('document_description', $document->ID);
                    $document_file = get_field('document_file', $document->ID);
                    $document_file_type = get_field('document_file_type', $document->ID);
                    $featured_image = get_the_post_thumbnail_url($document->ID, 'large');

                    // Create excerpt from description or post content
                    $excerpt = '';
                    if ($document_description) {
                        $excerpt = wp_trim_words(strip_tags($document_description), 20, '...');
                    } elseif ($document->post_excerpt) {
                        $excerpt = wp_trim_words($document->post_excerpt, 20, '...');
                    } elseif ($document->post_content) {
                        $excerpt = wp_trim_words(strip_tags($document->post_content), 20, '...');
                    }

                    // Get file URL
                    $file_url = $document_file ? $document_file['url'] : '';
                    $file_size = $document_file && isset($document_file['filesize']) ? size_format($document_file['filesize']) : '';
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
                                             alt="<?php echo esc_attr($document->post_title); ?>"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    </div>
                                <?php else: ?>
                                    <div class="aspect-[4/3] bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <div class="text-center text-gray-400">
                                            <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <span class="text-sm font-medium">Document</span>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- File Type Badge -->
                                <?php if ($show_file_type && $document_file_type): ?>
                                    <div class="absolute top-3 right-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo esc_attr(get_file_type_badge($document_file_type)); ?>">
                                            <?php echo esc_html(get_file_type_label($document_file_type)); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <div class="mb-3">
                                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-primary transition-colors duration-200 leading-tight">
                                        <?php echo esc_html($document->post_title); ?>
                                    </h3>
                                </div>

                                <?php if ($excerpt): ?>
                                    <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">
                                        <?php echo esc_html($excerpt); ?>
                                    </p>
                                <?php endif; ?>

                                <!-- File Info -->
                                <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                                    <div class="text-sm text-gray-500">
                                        <?php if ($file_size): ?>
                                            <span><?php echo esc_html($file_size); ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="flex items-center text-primary text-sm font-medium">
                                        <span>Download</span>
                                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                        <?php if ($file_url): ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="mx-auto max-w-9xl container px-6 lg:px-8">
            <div class="text-center py-16">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No documents found</h3>
                <p class="text-gray-500">There are no documents available at the moment.</p>
            </div>
        </div>
    <?php endif; ?>
</section>