<?php
/**
 * FAQ Section Layout
 *
 * @package SX
 */

// Block fields
$title = get_field('title') ?: 'FAQs';
$intro_text = get_field('intro_text') ?: 'Some answers to questions you may have. Check our FAQ section or if you need further information.';
$category_filter = get_field('category_filter');
$faq_limit = get_field('faq_limit') ?: -1;
$layout_columns = get_field('layout_columns') ?: '1';
$expand_first = get_field('expand_first');

// Build query arguments
$args = array(
    'post_type' => 'faqs',
    'posts_per_page' => $faq_limit,
    'post_status' => 'publish',
    'meta_key' => 'display_order',
    'orderby' => array(
        'meta_value_num' => 'ASC',
        'date' => 'DESC'
    )
);

// Add category filter if selected
if ($category_filter) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'faq_category',
            'field' => 'term_id',
            'terms' => $category_filter
        )
    );
}

$faqs = get_posts($args);

// Column classes
$column_class = $layout_columns === '2' ? 'md:grid-cols-2' : '';
$container_class = $layout_columns === '2' ? 'max-w-6xl' : 'max-w-3xl';
?>

<section id="faq" class="py-4 lg:py-16" x-data="{ openFaq: <?php echo $expand_first ? '0' : 'null'; ?> }">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center opacity-100 " data-animation="fadeUp">
            <?php echo esc_html($title); ?>
        </h2>
        
        <div class="<?php echo esc_attr($container_class); ?> mx-auto bg-white rounded-lg lg:p-8 opacity-100 " data-animation="fadeUp" data-delay="100">
            <p class="text-red-600 mb-8 text-center"><?php echo esc_html($intro_text); ?></p>
            
            <?php if ($faqs) : ?>
                <div class="grid grid-cols-1 <?php echo esc_attr($column_class); ?> gap-4 lg:gap-6">
                    <?php 
                    foreach ($faqs as $index => $faq) : 
                        $faq_answer = get_field('faq_answer', $faq->ID);
                    ?>
                    <div class="border-b border-red-600 pb-3">
                        <button @click="openFaq = openFaq === <?php echo $index; ?> ? null : <?php echo $index; ?>"
                                class="flex justify-between items-center w-full text-left font-semibold transition-colors hover:text-red-600"
                                :class="{ 'text-red-600': openFaq === <?php echo $index; ?> }">
                            <?php echo esc_html($faq->post_title); ?>
                            <svg class="h-5 w-5 text-gray-500 transform transition-transform duration-300"
                                 :class="{ 'rotate-180': openFaq === <?php echo $index; ?> }"
                                 fill="none" stroke="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-chevron-down"/></svg>
                        </button>
                        <div x-show="openFaq === <?php echo $index; ?>"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 transform translate-y-0"
                             x-transition:leave-end="opacity-0 transform -translate-y-2"
                             class="mt-3 text-gray-600">
                            <?php echo wp_kses_post($faq_answer); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="text-center py-8">
                    <p class="text-gray-600">No FAQs available at the moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>