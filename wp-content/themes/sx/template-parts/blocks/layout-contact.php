<?php
/**
 * Layout Contact Block Template
 */

$data = get_field('layout_contact_data');
?>

<section class="bg-tertiary pb-16 pt-16 lg:pt-32 lg:pb-48 relative px-6 lg:px-0">
    <?php if ($data && $data['content']): ?>
        <div class="mx-auto max-w-7xl">
            <?php echo wp_kses_post($data['content']); ?>
        </div>
    <?php else: ?>
        <div class="mx-auto max-w-7xl">
            <div class="text-center">
                <h2 class="text-3xl lg:text-4xl font-bold text-primary mb-6">Get In Touch</h2>
                <p class="text-lg text-gray-600 mb-8">Contact us for more information about our products and services.</p>
            </div>
        </div>
    <?php endif; ?>
</section>