<?php
/**
 * Testimonials Slider Block Template
 */

// Get ACF fields
$section_subtitle = get_field('section_subtitle');
$section_title = get_field('section_title');
$filter_type = get_field('filter_type');
$testimonials_limit = get_field('testimonials_limit');
$autoplay = get_field('autoplay');
$autoplay_delay = get_field('autoplay_delay');
$background_color = get_field('background_color');
$show_stars = get_field('show_stars');

// Set defaults
$section_subtitle = $section_subtitle ?: 'TESTIMONIALS';
$section_title = $section_title ?: 'SOME WORDS FROM OUR CUSTOMERS';
$filter_type = $filter_type ?: 'all';
$autoplay = $autoplay !== null ? $autoplay : true;
$autoplay_delay = $autoplay_delay ?: 5000;
$background_color = $background_color ?: 'dark';
$show_stars = $show_stars !== null ? $show_stars : true;

// Build query arguments
$query_args = array(
    'post_type' => 'testimonial',
    'post_status' => 'publish',
    'posts_per_page' => $testimonials_limit ?: -1,
    'orderby' => 'date',
    'order' => 'DESC',
);

// Apply filters
if ($filter_type === 'featured') {
    $query_args['meta_query'] = array(
        array(
            'key' => 'featured_testimonial',
            'value' => '1',
            'compare' => '='
        )
    );
} elseif ($filter_type === 'latest') {
    $query_args['posts_per_page'] = $testimonials_limit ?: 6;
}

// Get testimonials
$testimonials = new WP_Query($query_args);

// echo '<pre>';
// print_r($testimonials);
// echo '</pre>';

// Debug: Check if we found any testimonials
$debug_info = array(
    'query_args' => $query_args,
    'found_posts' => $testimonials->found_posts,
    'post_count' => $testimonials->post_count
);

// Background classes
$bg_classes = array(
    'dark' => 'bg-gray-800',
    'light' => 'bg-gray-100',
    'primary' => 'bg-primary'
);

$text_classes = array(
    'dark' => 'text-white',
    'light' => 'text-gray-800',
    'primary' => 'text-white'
);

$subtitle_classes = array(
    'dark' => 'text-orange-400',
    'light' => 'text-orange-600',
    'primary' => 'text-orange-300'
);

$bg_class = $bg_classes[$background_color];
$text_class = $text_classes[$background_color];
$subtitle_class = $subtitle_classes[$background_color];

// Generate unique ID for this slider
$slider_id = 'testimonials-slider-' . uniqid();
?>

<?php if ($testimonials->have_posts()): ?>
<section class="py-8 lg:py-16 bg-gray-800">
    <div class="container mx-auto px-6 lg:px-12">
        <!-- Section Header -->
        <div class="text-center mb-12 lg:mb-16">
            <?php if ($section_subtitle): ?>
                <p class="<?php echo $subtitle_class; ?> text-sm lg:text-base font-medium tracking-[0.2em] mb-4">
                    <?php echo esc_html($section_subtitle); ?>
                </p>
            <?php endif; ?>
            
            <?php if ($section_title): ?>
                <h2 class="<?php echo $text_class; ?> text-2xl lg:text-3xl font-light tracking-[0.1em] max-w-4xl mx-auto">
                    <?php echo esc_html($section_title); ?>
                </h2>
            <?php endif; ?>
            
            <!-- Decorative line -->
            <div class="w-24 h-0.5 <?php echo $subtitle_class; ?> bg-current mx-auto mt-6"></div>
        </div>

        <!-- Testimonials Slider -->
        <div class="swiper testimonials-swiper-<?php echo uniqid(); ?>" id="<?php echo $slider_id; ?>">
            <div class="swiper-wrapper">
                <?php foreach ($testimonials->get_posts() as $testimonial): ?>
                    <?php
                    $quote = get_field('testimonial_quote', $testimonial->ID);
                    $customer_name = get_field('customer_name', $testimonial->ID);
                    $customer_location = get_field('customer_location', $testimonial->ID);
                    $star_rating = get_field('star_rating', $testimonial->ID);
                    ?>
                    
                    <div class="swiper-slide">
                        <div class="text-center max-w-4xl mx-auto px-4">
                            <!-- Star Rating -->
                            <?php if ($show_stars && $star_rating): ?>
                                <div class="flex justify-center mb-6">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <svg class="w-5 h-5 <?php echo $i <= $star_rating ? $subtitle_class : 'text-gray-400'; ?>" 
                                             fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    <?php endfor; ?>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Quote -->
                            <?php if ($quote): ?>
                                <blockquote class="<?php echo $text_class; ?> text-lg lg:text-xl xl:text-2xl font-light italic leading-relaxed mb-8">
                                    "<?php echo esc_html($quote); ?>"
                                </blockquote>
                            <?php endif; ?>
                            
                            <!-- Customer Info -->
                            <div class="<?php echo $text_class; ?>">
                                <?php if ($customer_name): ?>
                                    <p class="<?php echo $subtitle_class; ?> font-semibold text-lg lg:text-xl">
                                        <?php echo esc_html($customer_name); ?>
                                    </p>
                                <?php endif; ?>
                                
                                <?php if ($customer_location): ?>
                                    <p class="<?php echo $text_class; ?> text-sm lg:text-base opacity-80 mt-1">
                                        <?php echo esc_html($customer_location); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
<?php else: ?>
<section class="<?php echo $bg_class; ?> py-16 lg:py-24">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="text-center">
            <h2 class="<?php echo $text_class; ?> text-2xl lg:text-4xl xl:text-5xl font-light tracking-[0.1em] max-w-4xl mx-auto mb-8">
                <?php echo esc_html($section_title ?: 'SOME WORDS FROM OUR CUSTOMERS'); ?>
            </h2>
            <p class="<?php echo $text_class; ?> text-lg mb-4">
                No testimonials found. <a href="<?php echo admin_url('post-new.php?post_type=testimonial'); ?>" class="<?php echo $subtitle_class; ?> underline">Add some testimonials</a> to get started.
            </p>
            
            <!-- Debug info (remove in production) -->
            <?php if (current_user_can('administrator')): ?>
                <div class="bg-red-100 text-red-800 p-4 rounded-lg text-sm mt-4 max-w-2xl mx-auto">
                    <p><strong>Debug Info:</strong></p>
                    <p>Query: <?php echo esc_html(print_r($query_args, true)); ?></p>
                    <p>Found Posts: <?php echo $testimonials->found_posts; ?></p>
                    <p>Post Count: <?php echo $testimonials->post_count; ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Wait a bit for everything to load 
    setTimeout(function() {
        if (typeof Swiper !== 'undefined') {
            const swiperElement = document.getElementById('<?php echo $slider_id; ?>');
            console.log('Looking for element:', '<?php echo $slider_id; ?>');
            console.log('Found element:', swiperElement);
            
            if (swiperElement) {
                console.log('Slides found:', swiperElement.querySelectorAll('.swiper-slide').length);
                
                const swiper = new Swiper('#<?php echo $slider_id; ?>', {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    loop: false,
                    centeredSlides: true,
                    <?php if ($autoplay): ?>
                    autoplay: {
                        delay: <?php echo intval($autoplay_delay); ?>,
                        disableOnInteraction: false,
                    },
                    <?php endif; ?>
                    pagination: {
                        el: '#<?php echo $slider_id; ?> .swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '#<?php echo $slider_id; ?> .swiper-button-next',
                        prevEl: '#<?php echo $slider_id; ?> .swiper-button-prev',
                    },
                    on: {
                        init: function() {
                            console.log('Testimonials Swiper initialized successfully');
                        },
                        slideChange: function() {
                            console.log('Slide changed to:', this.activeIndex);
                        }
                    }
                });
            } else {
                console.error('Testimonials slider element not found with ID:', '<?php echo $slider_id; ?>');
            }
        } else {
            console.error('Swiper library not loaded');
        }
    }, 100);
});
</script>

<style>
#<?php echo $slider_id; ?> .swiper-button-next,
#<?php echo $slider_id; ?> .swiper-button-prev {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-top: -25px;
    transition: all 0.3s ease;
    color: <?php echo $background_color === 'light' ? '#374151' : '#fff'; ?>;
}

#<?php echo $slider_id; ?> .swiper-button-next:hover,
#<?php echo $slider_id; ?> .swiper-button-prev:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.1);
}

#<?php echo $slider_id; ?> .swiper-button-next:after,
#<?php echo $slider_id; ?> .swiper-button-prev:after {
    font-size: 20px;
    font-weight: bold;
}

#<?php echo $slider_id; ?> .swiper-pagination {
    bottom: -50px;
}

#<?php echo $slider_id; ?> .swiper-pagination-bullet {
    width: 12px;
    height: 12px;
    background: rgba(255, 255, 255, 0.3);
    opacity: 1;
    margin: 0 6px;
    transition: all 0.3s ease;
}

#<?php echo $slider_id; ?> .swiper-pagination-bullet-active {
    background: <?php echo $background_color === 'light' ? '#ea580c' : '#fb923c'; ?>;
    transform: scale(1.2);
}

/* Ensure slides are visible */
#<?php echo $slider_id; ?> .swiper-slide {
    height: auto;
    display: flex;
    align-items: center;
}
</style>

<?php wp_reset_postdata(); ?>
<?php endif; ?>