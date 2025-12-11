<?php
/**
 * Full Text Block Template
 */

$data = get_field('full_text_data');

// Get configuration variables
$title = $data['title'] ?? '';
$content = $data['content'] ?? '';
$background_style = $data['background_style'] ?? 'white';
$padding = $data['padding'] ?? 'normal';

// Set background classes
$background_class = 'bg-white';
switch ($background_style) {
    case 'gray':
        $background_class = 'bg-gray-50';
        break;
    case 'tertiary':
        $background_class = 'bg-tertiary';
        break;
    default:
        $background_class = 'bg-white';
        break;
}

// Set padding classes
$padding_class = 'py-16';
switch ($padding) {
    case 'large':
        $padding_class = 'pb-24 pt-6';
        break;
    case 'none':
        $padding_class = '';
        break;
    default:
        $padding_class = 'pb-16 pt-4';
        break;
}
?>

<section class="<?php echo esc_attr($background_class . ' ' . $padding_class); ?>">
    <div class="mx-auto max-w-[1200px] px-6 lg:px-8">

        <?php if ($title): ?>
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl xl:text-5xl font-bold text-primary mb-6">
                    <?php echo esc_html($title); ?>
                </h2>
            </div>
        <?php endif; ?>

        <?php if ($content): ?>
            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                <?php echo wp_kses_post($content); ?>
            </div>
        <?php else: ?>
            <!-- Placeholder content for when no content is set -->
            <div class="text-center py-16 text-gray-500">
                <p>Please add content to this Full Text block using the WordPress editor.</p>
            </div>
        <?php endif; ?>

    </div>
</section>

<style>
/* Enhanced typography for full text content */
.prose {
    font-family: inherit;
}

.prose h1,
.prose h2,
.prose h3,
.prose h4,
.prose h5,
.prose h6 {
    color: var(--color-primary, #1e2938);
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.prose h1 {
    font-size: 2.5rem;
    margin-top: 0;
}

.prose h2 {
    font-size: 2rem;
    border-bottom: 2px solid #e5e7eb;
    padding-bottom: 0.5rem;
}

.prose h3 {
    font-size: 1.5rem;
}

.prose h4 {
    font-size: 1.25rem;
}

.prose p {
    margin-bottom: 1.5rem;
    line-height: 1.7;
}

.prose ul,
.prose ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.prose li {
    margin-bottom: 0.5rem;
    line-height: 1.6;
}

.prose ul li {
    list-style-type: disc;
}

.prose ol li {
    list-style-type: decimal;
}

.prose ul ul,
.prose ol ol,
.prose ul ol,
.prose ol ul {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}

.prose blockquote {
    border-left: 4px solid var(--color-primary, #1e2938);
    padding-left: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    background-color: #f9fafb;
    padding: 1.5rem;
    border-radius: 0.5rem;
}

.prose table {
    width: 100%;
    border-collapse: collapse;
    margin: 2rem 0;
    background-color: white;
    border-radius: 0.5rem;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.prose th,
.prose td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
}

.prose th {
    background-color: var(--color-primary, #1e2938);
    color: white;
    font-weight: 600;
}

.prose tr:hover {
    background-color: #f9fafb;
}

.prose a {
    color: var(--color-primary, #1e2938);
    text-decoration: underline;
    transition: color 0.2s ease;
}

.prose a:hover {
    color: var(--color-primary-dark, #5e052e);
}

.prose strong {
    font-weight: 700;
    color: var(--color-primary, #1e2938);
}

.prose em {
    font-style: italic;
}

.prose code {
    background-color: #f3f4f6;
    color: #1f2937;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.875em;
    font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
}

.prose pre {
    background-color: #1f2937;
    color: #f9fafb;
    padding: 1.5rem;
    border-radius: 0.5rem;
    overflow-x: auto;
    margin: 1.5rem 0;
}

.prose pre code {
    background-color: transparent;
    color: inherit;
    padding: 0;
}

.prose hr {
    border: none;
    border-top: 2px solid #e5e7eb;
    margin: 3rem 0;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .prose {
        font-size: 1rem;
    }

    .prose h1 {
        font-size: 2rem;
    }

    .prose h2 {
        font-size: 1.75rem;
    }

    .prose h3 {
        font-size: 1.5rem;
    }

    .prose table {
        font-size: 0.875rem;
    }

    .prose th,
    .prose td {
        padding: 0.75rem 0.5rem;
    }
}
</style>