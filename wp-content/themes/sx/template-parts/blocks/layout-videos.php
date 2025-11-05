<?php
/**
 * Layout Videos Block Template
 */

$data = get_field('layout_videos_data');

// Get configuration variables
$title = $data['title'] ?? 'Videos';
$description = $data['description'] ?? '';
$videos_selection_type = $data['videos_selection_type'] ?? 'all';
$videos_limit = $data['videos_limit'] ?? 12;
$columns = $data['columns'] ?? '3';
$show_duration = $data['show_duration'] ?? true;

// Get videos based on selection
$videos = array();

if ($videos_selection_type === 'manual' && !empty($data['videos_selection'])) {
    // Use manually selected videos
    $videos = $data['videos_selection'];
} else {
    // Get all videos
    $args = array(
        'post_type' => 'videos',
        'post_status' => 'publish',
        'posts_per_page' => $videos_limit > 0 ? $videos_limit : -1,
    );
    $video_query = new WP_Query($args);
    $videos = $video_query->posts;
    wp_reset_postdata();
}

// Define grid columns class
$grid_cols = 'md:grid-cols-2 lg:grid-cols-3';
if ($columns === '2') {
    $grid_cols = 'md:grid-cols-2';
} elseif ($columns === '4') {
    $grid_cols = 'md:grid-cols-2 lg:grid-cols-4';
}

// Generate unique modal IDs
$modal_id_prefix = 'video-modal-' . uniqid();
?>

<section class="py-16 bg-white">
    <!-- Header Section -->
    <div class="mx-auto max-w-9xl container px-6 lg:px-8 mb-12">
        <div class="text-center max-w-4xl mx-auto">
            <h1 class="text-2xl md:text-3xl lg:text-4xl  font-bold text-gray-900 mb-6">
                <?php echo esc_html($title); ?>
            </h1>

            <?php if ($description): ?>
                <div class="text-lg text-gray-600 font-montserrat">
                    <?php echo wp_kses_post($description); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Videos Grid -->
    <?php if (!empty($videos)): ?>
        <div class="mx-auto max-w-9xl container px-6 lg:px-8">
            <div class="grid grid-cols-1 <?php echo esc_attr($grid_cols); ?> gap-8">
                <?php foreach ($videos as $index => $video): ?>
                    <?php
                    $video_description = get_field('video_description', $video->ID);
                    $video_file = get_field('video_file', $video->ID);
                    $video_thumbnail = get_field('video_thumbnail', $video->ID);

                    // Use custom thumbnail if available, otherwise use featured image
                    $featured_image = null;
                    if ($video_thumbnail && is_array($video_thumbnail) && isset($video_thumbnail['url'])) {
                        $featured_image = $video_thumbnail['url'];
                    } else {
                        // Try featured image first
                        $featured_image = get_the_post_thumbnail_url($video->ID, 'large');

                        // Fallback to try different image sizes if large doesn't work
                        if (!$featured_image) {
                            $featured_image = get_the_post_thumbnail_url($video->ID, 'full');
                        }
                        if (!$featured_image) {
                            $featured_image = get_the_post_thumbnail_url($video->ID, 'medium');
                        }
                        if (!$featured_image) {
                            $featured_image = get_the_post_thumbnail_url($video->ID);
                        }
                    }

                    // Debug output for admins
                    if (current_user_can('administrator')) {
                        error_log('Video ID ' . $video->ID . ': Thumbnail URL = ' . ($featured_image ?: 'NONE'));
                    }

                    // Create excerpt from description or post content
                    $excerpt = '';
                    if ($video_description) {
                        $excerpt = wp_trim_words(strip_tags($video_description), 20, '...');
                    } elseif ($video->post_excerpt) {
                        $excerpt = wp_trim_words($video->post_excerpt, 20, '...');
                    } elseif ($video->post_content) {
                        $excerpt = wp_trim_words(strip_tags($video->post_content), 20, '...');
                    }

                    // Get video URL
                    $video_url = $video_file ? $video_file['url'] : '';
                    $video_size = $video_file && isset($video_file['filesize']) ? size_format($video_file['filesize']) : '';

                    $modal_id = $modal_id_prefix . '-' . $index;
                    ?>
                    <div class="group bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100">
                        <?php if ($video_url): ?>
                            <button type="button" class="w-full text-left" onclick="openVideoModal('<?php echo esc_js($modal_id); ?>')">
                        <?php endif; ?>

                            <!-- Video Thumbnail -->
                            <?php if (current_user_can('administrator')): ?>
                                <!-- Debug: Video ID: <?php echo $video->ID; ?>, Has Featured Image: <?php echo $featured_image ? 'YES' : 'NO'; ?>, URL: <?php echo $featured_image ?: 'NONE'; ?> -->
                            <?php endif; ?>
                            <div class="relative">
                                <?php if ($featured_image): ?>
                                    <div class="aspect-video overflow-hidden bg-gray-50">
                                        <img src="<?php echo esc_url($featured_image); ?>"
                                             alt="<?php echo esc_attr($video->post_title); ?>"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                             onerror="console.error('Failed to load image:', this.src)">
                                    </div>
                                <?php else: ?>
                                    <div class="aspect-video bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <div class="text-center text-gray-400">
                                            <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="text-sm font-medium">Video</span>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Play Button Overlay -->
                                <?php if ($video_url): ?>
                                    <div class="absolute inset-0 flex items-center justify-center bg-opacity-30 group-hover:bg-opacity-40 transition-all duration-300">
                                        <div class="bg-white bg-opacity-90 group-hover:bg-opacity-100 rounded-full p-4 transition-all duration-300">
                                            <svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <div class="mb-3">
                                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-primary transition-colors duration-200 leading-tight">
                                        <?php echo esc_html($video->post_title); ?>
                                    </h3>
                                </div>

                                <?php if ($excerpt): ?>
                                    <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">
                                        <?php echo esc_html($excerpt); ?>
                                    </p>
                                <?php endif; ?>

                                <!-- Video Info -->
                                <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                                    <div class="text-sm text-gray-500">
                                        <span>Click to play</span>
                                    </div>

                                    <div class="flex items-center text-primary text-sm font-medium">
                                        <span>Watch</span>
                                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h8m2 4H7a2 2 0 01-2-2V8a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                        <?php if ($video_url): ?>
                            </button>
                        <?php endif; ?>
                    </div>

                    <!-- Video Modal -->
                    <?php if ($video_url): ?>
                        <div id="<?php echo esc_attr($modal_id); ?>" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-80 opacity-0 invisible transition-all duration-300">
                            <div class="relative w-full h-full max-w-6xl max-h-[90vh] mx-4">
                                <!-- Close Button -->
                                <button type="button" class="absolute -top-2 -right-2 lg:top-4 lg:right-4 z-10 bg-white hover:bg-gray-100 text-gray-800 rounded-full p-3 lg:p-4 shadow-lg transition-all duration-200 hover:scale-110" onclick="closeVideoModal('<?php echo esc_js($modal_id); ?>')">
                                    <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>

                                <!-- Video Container -->
                                <div class="w-full h-full flex items-center justify-center">
                                    <video
                                        id="video-<?php echo esc_attr($modal_id); ?>"
                                        class="w-full h-full object-contain rounded-lg"
                                        controls
                                        preload="metadata">
                                        <source src="<?php echo esc_url($video_url); ?>" type="<?php echo esc_attr($video_file['mime_type'] ?? 'video/mp4'); ?>">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="mx-auto max-w-9xl container px-6 lg:px-8">
            <div class="text-center py-16">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No videos found</h3>
                <p class="text-gray-500">There are no videos available at the moment.</p>
            </div>
        </div>
    <?php endif; ?>
</section>

<!-- Video Modal JavaScript -->
<script>
function openVideoModal(modalId) {
    const modal = document.getElementById(modalId);
    const video = document.getElementById('video-' + modalId);

    if (modal && video) {
        modal.classList.remove('opacity-0', 'invisible');
        modal.classList.add('opacity-100', 'visible');
        document.body.style.overflow = 'hidden';

        // Small delay to ensure modal is visible before playing
        setTimeout(() => {
            video.play();
        }, 100);
    }
}

function closeVideoModal(modalId) {
    const modal = document.getElementById(modalId);
    const video = document.getElementById('video-' + modalId);

    if (modal && video) {
        video.pause();
        video.currentTime = 0;

        modal.classList.remove('opacity-100', 'visible');
        modal.classList.add('opacity-0', 'invisible');
        document.body.style.overflow = '';
    }
}

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.matches('[id^="<?php echo esc_js($modal_id_prefix); ?>"]')) {
        const modalId = e.target.id;
        closeVideoModal(modalId);
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const openModals = document.querySelectorAll('[id^="<?php echo esc_js($modal_id_prefix); ?>"].opacity-100');
        openModals.forEach(modal => {
            const modalId = modal.id;
            closeVideoModal(modalId);
        });
    }
});
</script>