<?php
/**
 * Reviews Section Layout
 *
 * @package SX
 */

// Block fields
$section_title = get_field('section_title') ?: 'What Our Clients Say';
$section_subtitle = get_field('section_subtitle');
$background_color = get_field('background_color') ?: '#f3f4f6';
$text_color = get_field('text_color') ?: 'dark';
$autoplay = get_field('autoplay');
$autoplay_speed = get_field('autoplay_speed') ?: 5000;
$reviews_limit = get_field('reviews_limit') ?: -1;

// Text color classes
$text_class = $text_color === 'light' ? 'text-white' : 'text-gray-900';
$subtitle_class = $text_color === 'light' ? 'text-gray-200' : 'text-gray-600';
$quote_class = $text_color === 'light' ? 'text-gray-100' : 'text-gray-700';
$author_class = $text_color === 'light' ? 'text-gray-300' : 'text-gray-500';
$dot_active_class = $text_color === 'light' ? 'bg-white' : 'bg-gray-800';
$dot_inactive_class = $text_color === 'light' ? 'bg-white/30' : 'bg-gray-400';

// Get reviews
$args = array(
    'post_type' => 'reviews',
    'posts_per_page' => $reviews_limit,
    'orderby' => 'date',
    'order' => 'DESC'
);
$reviews = get_posts($args);

if ($reviews) :
?>

<section class="py-20 relative overflow-hidden hidden" style="background-color: <?php echo esc_attr($background_color); ?>;">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <?php if ($section_title || $section_subtitle) : ?>
            <div class="text-center mb-12">
                <?php if ($section_title) : ?>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4 <?php echo esc_attr($text_class); ?>" data-animation="fadeUp">
                        <?php echo esc_html($section_title); ?>
                    </h2>
                <?php endif; ?>
                <?php if ($section_subtitle) : ?>
                    <p class="text-lg <?php echo esc_attr($subtitle_class); ?>" data-animation="fadeUp" data-delay="100">
                        <?php echo esc_html($section_subtitle); ?>
                    </p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <!-- Reviews Slider -->
        <div class="relative max-w-4xl mx-auto" data-animation="fadeUp" data-delay="200">
            <div class="reviews-slider overflow-hidden">
                <div class="reviews-track flex transition-transform duration-500 ease-in-out">
                    <?php foreach ($reviews as $review) : 
                        $review_content = get_field('review_content', $review->ID);
                        $author_name = get_field('author_name', $review->ID);
                        $author_title = get_field('author_title', $review->ID);
                        $rating = get_field('rating', $review->ID) ?: 5;
                        $author_image = get_field('author_image', $review->ID);
                    ?>
                        <div class="review-slide w-full flex-shrink-0 px-4">
                            <div class="text-center">
                                <!-- Stars -->
                                <?php if ($rating) : ?>
                                    <div class="flex justify-center mb-6">
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <svg class="w-6 h-6 <?php echo $i <= $rating ? 'text-yellow-400' : 'text-gray-300'; ?>" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        <?php endfor; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Quote -->
                                <blockquote class="mb-8">
                                    <p class="text-lg md:text-xl italic <?php echo esc_attr($quote_class); ?>">
                                        "<?php echo esc_html($review_content); ?>"
                                    </p>
                                </blockquote>
                                
                                <!-- Author -->
                                <div class="flex items-center justify-center">
                                    <?php if ($author_image) : ?>
                                        <img src="<?php echo esc_url($author_image['sizes']['thumbnail']); ?>" 
                                             alt="<?php echo esc_attr($author_name); ?>" 
                                             class="w-12 h-12 rounded-full mr-4 object-cover">
                                    <?php endif; ?>
                                    <div class="text-left">
                                        <div class="font-semibold <?php echo esc_attr($text_class); ?>">
                                            <?php echo esc_html($author_name); ?>
                                        </div>
                                        <?php if ($author_title) : ?>
                                            <div class="text-sm <?php echo esc_attr($author_class); ?>">
                                                <?php echo esc_html($author_title); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Navigation Dots -->
            <?php if (count($reviews) > 1) : ?>
                <div class="flex justify-center space-x-2 mt-8">
                    <?php for ($i = 0; $i < count($reviews); $i++) : ?>
                        <button class="review-dot w-2 h-2 rounded-full transition-all duration-300 <?php echo $i === 0 ? esc_attr($dot_active_class) : esc_attr($dot_inactive_class); ?>" 
                                data-slide="<?php echo $i; ?>"
                                aria-label="Go to slide <?php echo $i + 1; ?>">
                        </button>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.reviews-slider');
    if (!slider) return;
    
    const track = slider.querySelector('.reviews-track');
    const slides = track.querySelectorAll('.review-slide');
    const dots = document.querySelectorAll('.review-dot');
    const slideCount = slides.length;
    let currentSlide = 0;
    let autoplayInterval;
    
    function goToSlide(slideIndex) {
        currentSlide = slideIndex;
        track.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        // Update dots
        dots.forEach((dot, index) => {
            if (index === currentSlide) {
                dot.classList.remove('<?php echo esc_js($dot_inactive_class); ?>');
                dot.classList.add('<?php echo esc_js($dot_active_class); ?>');
            } else {
                dot.classList.remove('<?php echo esc_js($dot_active_class); ?>');
                dot.classList.add('<?php echo esc_js($dot_inactive_class); ?>');
            }
        });
    }
    
    function nextSlide() {
        goToSlide((currentSlide + 1) % slideCount);
    }
    
    function prevSlide() {
        goToSlide((currentSlide - 1 + slideCount) % slideCount);
    }
    
    // Dot navigation
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            goToSlide(index);
            // Reset autoplay
            if (autoplayInterval) {
                clearInterval(autoplayInterval);
                startAutoplay();
            }
        });
    });
    
    // Touch/swipe support
    let touchStartX = 0;
    let touchEndX = 0;
    
    slider.addEventListener('touchstart', e => {
        touchStartX = e.changedTouches[0].screenX;
    });
    
    slider.addEventListener('touchend', e => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });
    
    function handleSwipe() {
        if (touchEndX < touchStartX - 50) {
            nextSlide();
        }
        if (touchEndX > touchStartX + 50) {
            prevSlide();
        }
        // Reset autoplay
        if (autoplayInterval) {
            clearInterval(autoplayInterval);
            startAutoplay();
        }
    }
    
    // Autoplay
    <?php if ($autoplay) : ?>
    function startAutoplay() {
        autoplayInterval = setInterval(nextSlide, <?php echo esc_js($autoplay_speed); ?>);
    }
    
    // Start autoplay
    if (slideCount > 1) {
        startAutoplay();
        
        // Pause on hover
        slider.addEventListener('mouseenter', () => {
            clearInterval(autoplayInterval);
        });
        
        slider.addEventListener('mouseleave', () => {
            startAutoplay();
        });
    }
    <?php endif; ?>
});
</script>

<?php endif; // End if reviews ?>