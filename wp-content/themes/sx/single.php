<?php
/**
 * Single Post Template
 *
 * @package SX
 */

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
        $author_name = get_the_author();
        $post_date = get_the_date();
        $categories = get_the_category();
?>

<div class="progress-container">
    <div class="progress-bar" id="readingProgress"></div>
</div>

<!-- Small Hero Section -->
<section class="relative text-white h-[400px] flex items-center overflow-hidden">
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-4xl mx-auto">
            <div class="hero-title" data-animation="fadeUp">
                <!-- Categories -->
                <?php if ($categories) : ?>
                    <div class="flex justify-center gap-2 mb-4">
                        <?php foreach ($categories as $category) : ?>
                            <span class="inline-block bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1 rounded-full">
                                <?php echo esc_html($category->name); ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <!-- Title -->
                <h1 class="text-3xl md:text-5xl font-bold mb-4">
                    <?php the_title(); ?>
                </h1>
                
                <!-- Meta Information -->
                <div class="flex items-center justify-center gap-6 text-sm text-gray-200">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <?php echo esc_html($author_name); ?>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <?php echo esc_html($post_date); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Background Image with Overlay -->
    <?php if ($featured_image) : ?>
        <div class="absolute inset-0 z-[-1]">
            <img src="<?php echo esc_url($featured_image); ?>" 
                 alt="<?php echo esc_attr(get_the_title()); ?>" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>
    <?php else : ?>
        <!-- Fallback gradient background if no featured image -->
        <div class="absolute inset-0 z-[-1] bg-gradient-to-r from-gray-800 to-gray-900"></div>
    <?php endif; ?>
</section>

<!-- Post Content -->
<article class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <!-- Post Content -->
            <div class="prose prose-lg max-w-none">
                <?php the_content(); ?>
            </div>
            
            <!-- Post Navigation -->
            <div class="mt-12 pt-8 border-t border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    ?>
                    
                    <?php if ($prev_post) : ?>
                        <div>
                            <span class="text-sm text-gray-500 block mb-2">Previous Post</span>
                            <a href="<?php echo get_permalink($prev_post); ?>" class="group flex items-center text-gray-900 hover:text-red-600 transition-colors">
                                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                <span class="font-medium"><?php echo esc_html($prev_post->post_title); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($next_post) : ?>
                        <div class="text-right">
                            <span class="text-sm text-gray-500 block mb-2">Next Post</span>
                            <a href="<?php echo get_permalink($next_post); ?>" class="group inline-flex items-center text-gray-900 hover:text-red-600 transition-colors">
                                <span class="font-medium"><?php echo esc_html($next_post->post_title); ?></span>
                                <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Tags -->
            <?php
            $tags = get_the_tags();
            if ($tags) :
            ?>
                <div class="mt-8">
                    <h3 class="text-sm font-semibold text-gray-500 mb-3">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach ($tags as $tag) : ?>
                            <a href="<?php echo get_tag_link($tag->term_id); ?>" 
                               class="inline-block bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm px-3 py-1 rounded-full transition-colors">
                                <?php echo esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Author Bio -->
            <?php if (get_the_author_meta('description')) : ?>
                <div class="mt-12 p-6 bg-gray-50 rounded-lg">
                    <div class="flex items-start">
                        <?php echo get_avatar(get_the_author_meta('ID'), 80, '', '', array('class' => 'rounded-full mr-4')); ?>
                        <div>
                            <h3 class="font-semibold text-lg mb-1">About <?php the_author(); ?></h3>
                            <p class="text-gray-600"><?php the_author_meta('description'); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</article>

<!-- Related Posts -->
<?php
$related_args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'post__not_in' => array(get_the_ID()),
    'orderby' => 'rand'
);

// Get posts from same category
if ($categories) {
    $category_ids = array();
    foreach ($categories as $category) {
        $category_ids[] = $category->term_id;
    }
    $related_args['category__in'] = $category_ids;
}

$related_posts = get_posts($related_args);

if ($related_posts) :
?>
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-center mb-8">Related Articles</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <?php foreach ($related_posts as $related_post) : 
                    $related_image = get_the_post_thumbnail_url($related_post->ID, 'medium');
                    $related_excerpt = has_excerpt($related_post->ID) ? get_the_excerpt($related_post->ID) : wp_trim_words($related_post->post_content, 20);
                ?>
                    <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <?php if ($related_image) : ?>
                            <a href="<?php echo get_permalink($related_post->ID); ?>" class="block">
                                <img src="<?php echo esc_url($related_image); ?>" 
                                     alt="<?php echo esc_attr($related_post->post_title); ?>" 
                                     class="w-full h-40 object-cover">
                            </a>
                        <?php endif; ?>
                        <div class="p-4">
                            <h3 class="font-semibold mb-2">
                                <a href="<?php echo get_permalink($related_post->ID); ?>" class="text-gray-900 hover:text-red-600 transition-colors">
                                    <?php echo esc_html($related_post->post_title); ?>
                                </a>
                            </h3>
                            <p class="text-sm text-gray-600 line-clamp-2">
                                <?php echo esc_html($related_excerpt); ?>
                            </p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    endwhile;
endif;

get_footer();
?>

<style>
/* Prose styles for content */
.prose {
    color: #374151;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    color: #111827;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.prose h1 { font-size: 2.25rem; }
.prose h2 { font-size: 1.875rem; }
.prose h3 { font-size: 1.5rem; }
.prose h4 { font-size: 1.25rem; }

.prose p {
    margin-bottom: 1.25rem;
    line-height: 1.75;
}

.prose a {
    color: #dc2626;
    text-decoration: underline;
}

.prose a:hover {
    color: #b91c1c;
}

.prose img {
    max-width: 100%;
    height: auto;
    margin: 2rem auto;
    border-radius: 0.5rem;
}

.prose ul, .prose ol {
    margin-bottom: 1.25rem;
    padding-left: 1.5rem;
}

.prose ul li {
    list-style-type: disc;
}

.prose ol li {
    list-style-type: decimal;
}

.prose blockquote {
    border-left: 4px solid #e5e7eb;
    padding-left: 1rem;
    margin: 2rem 0;
    font-style: italic;
    color: #6b7280;
}

.prose pre {
    background-color: #1f2937;
    color: #e5e7eb;
    padding: 1rem;
    border-radius: 0.5rem;
    overflow-x: auto;
    margin: 2rem 0;
}

.prose code {
    background-color: #f3f4f6;
    padding: 0.125rem 0.25rem;
    border-radius: 0.25rem;
    font-size: 0.875rem;
}

.prose pre code {
    background-color: transparent;
    padding: 0;
}

/* Line clamp for related posts */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}    /* Progress bar styles */
    .progress-container {
        position: fixed; 
        top: 72px;
        left: 0;
        width: 100%;
        height: 4px;
        background: rgba(0, 0, 0, 0.1);
        z-index: 9999;
    }

    .progress-bar {
        height: 100%;
        width: 0%;
        background-color: #ed1d25;
        transition: width 0.2s ease;
    }

     @media (min-width: 800px) { 
         .progress-container {
            display: none!important;
         }
     }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('scroll', function() {
            const winScroll = window.pageYOffset || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight - 100;
            const scrolled = (winScroll / height) * 100; 
            document.getElementById("readingProgress").style.width = scrolled + "%";
        });
    });
</script>