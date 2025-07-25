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


<!-- Post Content -->
<article class="">
    <div class="">
        <div class=" mx-auto">
            <!-- Post Content -->
            <div class="max-w-none">
                <?php the_content(); ?>
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

?>

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