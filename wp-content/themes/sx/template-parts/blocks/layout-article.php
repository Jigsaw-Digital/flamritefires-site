<?php
/**
 * Layout Article Block Template
 */

// Get individual fields
$header_image = get_field('article_header_image');
$subtitle = get_field('article_subtitle');
$title = get_field('article_title');
$content = get_field('article_content');
$background_theme = get_field('article_background_theme');
$disable_top_padding = get_field('article_disable_top_padding');

// Validation
if (!$title || !$content) return;

// Set defaults
$background_theme = $background_theme ?: 'default';
$disable_top_padding = $disable_top_padding ?: false;

// Set theme-based classes and styles
$is_dark = ($background_theme === 'dark');
$bg_class = $is_dark ? 'bg-[#1e2938]' : 'bg-tertiary';
$text_color = $is_dark ? 'text-white' : 'text-[#1e2938]';
$subtitle_color = $is_dark ? 'text-orange-400' : 'text-orange-600';

// Padding classes
$padding_class = $disable_top_padding ? 'pb-8 pt-8 lg:pb-16 lg:!pt-0' : 'pb-8 pt-8 lg:py-16';
?>

<section class="<?php echo $bg_class; ?> <?php echo $padding_class; ?> relative px-6 lg:px-10">

    <div class="mx-auto max-w-[900px]">
        <div class="space-y-4 lg:space-y-8">
            <!-- Header Image (if set) -->
            <?php if ($header_image): ?>
                <div class="text-center mb-4 lg:mb-6">
                    <img src="<?php echo esc_url($header_image['url']); ?>"
                        alt="<?php echo esc_attr($header_image['alt']); ?>"
                        class="<?php echo (strpos($header_image['url'], 'Deigned-in-the-UK.png') !== false ? 'max-h-[100px]' : 'max-h-[50px]');?> object-cover">
                </div>
            <?php endif; ?>

            <!-- Subtitle (if set) -->
            <?php if ($subtitle): ?>
                <p class="text-lg lg:text-xl <?php echo $subtitle_color; ?> font-medium tracking-[0.1em] uppercase mb-4">
                    <?php echo esc_html($subtitle); ?>
                </p>
            <?php endif; ?>

            <!-- Main Title -->
            <h1 class="text-3xl lg:text-3xl font-bold <?php echo $text_color; ?> mb-6">
                <?php echo esc_html($title); ?>
            </h1>

            <!-- Article Content with inline images support -->
            <div class="article-content lg:text-lg lg:mt-4 space-y-6 <?php echo $text_color; ?>">
                <?php echo wp_kses_post($content); ?>
            </div>
        </div>
    </div>
</section>

<style>
/* Article content styling */
.article-content img {
    width: 100%;
    height: auto;
    border-radius: 0.75rem;
    margin: 1.5rem 0;
}

@media (min-width: 1024px) {
    .article-content img {
        border-radius: 2.1875rem;
        margin: 2rem 0;
    }
}

.article-content p {
    margin-bottom: 1rem;
}

.article-content h2,
.article-content h3,
.article-content h4 {
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.article-content h2 {
    font-size: 1.875rem;
}

.article-content h3 {
    font-size: 1.5rem;
}

.article-content h4 {
    font-size: 1.25rem;
}

.article-content ul,
.article-content ol {
    margin-left: 1.5rem;
    margin-bottom: 1rem;
}

.article-content li {
    margin-bottom: 0.5rem;
}

.article-content a {
    color: #E85319;
    text-decoration: underline;
}

.article-content a:hover {
    color: #99320a;
}
</style>
