<?php
/**
 * Customers Section Layout
 *
 * @package SX
 */

// Block fields
$title = get_field('title') ?: 'Customers';
$subtitle = get_field('subtitle') ?: 'Our';
$background_image = get_field('background_image');
$customers = get_field('customers');
?>

<section id="customers" class="py-16 md:py-20 relative">
    <?php if ($background_image) : ?>
    <div class="absolute inset-0 z-[-1] bg-white">
        <img src="<?php echo esc_url($background_image['url']); ?>" alt="<?php echo esc_attr($background_image['alt']); ?>" class="w-full h-full object-cover opacity-20">
    </div>
    <?php else : ?>
    <div class="absolute inset-0 z-[-1] bg-white">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero.png" alt="Kitchen background" class="w-full h-full object-cover opacity-20">
    </div>
    <?php endif; ?>
    
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold mb-16 text-center opacity-100" data-animation="fadeUp">
            <span class="text-red-600"><?php echo esc_html($subtitle); ?></span> <?php echo esc_html($title); ?>
        </h2>
        
        <div class="customers-slider js-customers-slider">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-x-8 gap-y-10 items-center justify-center">
                <?php 
                if ($customers) : 
                    foreach ($customers as $customer) : 
                ?>
                <div class="flex justify-center items-center">
                    <?php if (isset($customer['logo'])) : ?>
                    <img src="<?php echo esc_url($customer['logo']['url']); ?>" alt="<?php echo esc_attr($customer['logo']['alt'] ?: ($customer['name'] ?: 'Customer')); ?>" class="max-w-[120px]">
                    <?php endif; ?>
                </div>
                <?php 
                    endforeach;
                else :
                    // Display placeholder logos if none defined
                    for ($index = 1; $index <= 17; $index++) : 
                ?>
                <div class="flex justify-center items-center">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/customers/<?php echo $index; ?>.png" alt="Customer <?php echo $index; ?>" class="max-w-[120px]">
                </div>
                <?php 
                    endfor;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>