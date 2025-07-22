<?php
/**
 * The main template file
 *
 * @package SX
 */

get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; else : ?>
    <div class="container mx-auto px-4 py-20">
        <h1 class="text-3xl font-bold mb-6"><?php esc_html_e('Nothing Found', 'sx'); ?></h1>
        <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'sx'); ?></p>
    </div>
<?php endif; ?>

<?php
get_footer();
?>