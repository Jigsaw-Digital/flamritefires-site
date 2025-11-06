<?php
/**
 * Greycaine Header Template
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (!class_exists('WPSEO_Frontend')) : ?>
        <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php endif; ?>
    <?php
    // Meta description - Only add if Yoast SEO is not handling it
    // Yoast will handle meta descriptions via wp_head() below
    // This is just a fallback if Yoast is disabled or not configured
    if (!class_exists('WPSEO_Frontend')) {
        if (is_singular()) {
            $meta_description = get_field('meta_description') ?: wp_trim_words(get_the_excerpt() ?: get_the_content(), 25);
            if ($meta_description) {
                echo '<meta name="description" content="' . esc_attr(strip_tags($meta_description)) . '">' . "\n";
            }
        } elseif (is_home() || is_front_page()) {
            $site_description = get_bloginfo('description');
            if ($site_description) {
                echo '<meta name="description" content="' . esc_attr($site_description) . '">' . "\n";
            }
        }
    }
    ?>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/app.css?v=1.0.1">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/greycaine.css?v=1.0.1">
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }
        .fixed-to-top {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 999;
        }
        .dark-logo { display: block; }
        .light-logo { display: none; }
        .nav-desktop { display: flex; }
        .nav-mobile { display: none; }

        @media (max-width: 1023px) {
            .nav-desktop { display: none !important; }
            .nav-mobile { display: block !important; }
        }

        .megamenu {
            visibility: hidden;
            opacity: 0;
            transition: all 0.3s ease-in-out;
        }
        .megamenu.visible {
            visibility: visible;
            opacity: 1;
        }

        .grey-qo-regular {
            font-family: 'Roboto', sans-serif;
            font-style: italic;
        }

        /* Transparent header styles */
        .header-transparent {
            background:  linear-gradient(to bottom, black 0%, black 10%, transparent 100%);  
        }

        .header-transparent.scrolled {
            background: #1f2937;
            backdrop-filter: none;
            -webkit-backdrop-filter: none;
        }

        /* Link colors for transparent header */
        .header-transparent:not(.scrolled) .nav-desktop a,
        .header-transparent:not(.scrolled) .nav-desktop .text-white {
            color: #fff !important;
        }

        /* Contact links (email/phone) in orange for transparent header */
        .header-transparent:not(.scrolled) .text-primary {
            color: #e85319 !important;
        }

        /* Hide elements with x-cloak until Alpine.js loads */
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Google Analytics - Only loads if user has accepted cookies -->
    <script>
        // Check if user has accepted cookies before loading analytics
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }

        function loadGoogleAnalytics() {
            // Load gtag.js
            var script = document.createElement('script');
            script.async = true;
            script.src = 'https://www.googletagmanager.com/gtag/js?id=UA-163902256-1';
            document.head.appendChild(script);

            // Initialize gtag
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-163902256-1');
            gtag('config', 'UA-3588407-2');
        }

        // Check consent and load if accepted
        const consent = getCookie('cookie_consent');
        if (consent === 'accepted') {
            loadGoogleAnalytics();
        }

        // Listen for consent acceptance event
        window.addEventListener('cookiesAccepted', function() {
            loadGoogleAnalytics();
        });
    </script>

    <?php wp_head(); ?>
</head>
<body <?php
    if ($has_dynamic_hero) {
        body_class('has-transparent-header');
    } else {
        body_class();
    }
?> x-data="{ mobileMenuOpen: false, mobileSubMenuOpen1: false, mobileSubMenuOpen2: false, mobileSubMenuOpen3: false, mobileSubMenuOpen4: false, mobileSubMenuOpen5: false, megaMenuOpen: false, searchOpen: false }" style="background-color: #333;">
    <?php wp_body_open(); ?>
    
    <?php
    // Get hero block data to determine header style
    global $post;
    $hero_block = null;
    $small = false;
    $has_dynamic_hero = false;
    $disable_transparent_header = false;

    if (has_blocks($post->post_content)) {
        $blocks = parse_blocks($post->post_content);
        foreach ($blocks as $block) {
            if (in_array($block['blockName'], ['acf/dynamic-hero', 'acf/layout-hero', 'acf/layout-video-hero'])) {
                $hero_block = $block;
                if ($block['blockName'] === 'acf/dynamic-hero') {
                    $has_dynamic_hero = true;
                    $small = isset($block['attrs']['data']['small']) && $block['attrs']['data']['small'] == '1';
                    $disable_transparent_header = isset($block['attrs']['data']['disable_transparent_header']) && $block['attrs']['data']['disable_transparent_header'] == '1';
                } else {
                    $small = isset($block['attrs']['data']['small']) && $block['attrs']['data']['small'] == '1';
                }
                break;
            }
        }
    }

    // Only enable transparent header if dynamic hero exists AND it's not disabled
    $has_dynamic_hero = $has_dynamic_hero && !$disable_transparent_header;

    // Get WordPress categories for product menu
    $product_categories = get_categories(array(
        'taxonomy' => 'category',
        'hide_empty' => true,
        'parent' => 0
    ));

    // Header classes based on hero type
    $header_classes = 'fixed-to-top fixed left-0 top-0 z-[999] w-full items-center py-[20px] xl:py-[30px] transition-all duration-300';
    if ($has_dynamic_hero) {
        $header_classes .= ' header-transparent';
    } else {
        $header_classes .= ' bg-gray-800';
    }
    ?>

    <header id="header" class="<?php echo esc_attr($header_classes); ?>" data-has-dynamic-hero="<?php echo $has_dynamic_hero ? 'true' : 'false'; ?>">
        <div class="mx-auto flex max-w-6xl justify-between px-6 lg:max-w-9xl">
            <div class="flex w-[150px] lg:w-[200px] items-center xl:w-[200px]">
                <a href="<?php echo home_url('/'); ?>">
                    <?php
                    $site_logo = get_field('site_logo', 'option');
                    if ($site_logo) {
                        echo '<img class="dark-logo" src="' . esc_url($site_logo['url']) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
                        echo '<img class="light-logo" src="' . esc_url($site_logo['url']) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
                    } else {
                        echo '<img class="dark-logo" src="' . get_template_directory_uri() . '/assets/images/logo.png" alt="' . esc_attr(get_bloginfo('name')) . '">';
                        echo '<img class="light-logo" src="' . get_template_directory_uri() . '/assets/images/logo.png" alt="' . esc_attr(get_bloginfo('name')) . '">';
                    }
                    ?>
                </a>
            </div>
            
            <nav class="nav-desktop flex items-center gap-3">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'container' => false,
                    'menu_class' => 'flex items-center gap-1.5',
                    'walker' => new Greycaine_Desktop_Walker(),
                    'fallback_cb' => 'greycaine_default_menu'
                ));
                ?>

                <!-- Search Icon -->
                <button @click="searchOpen = !searchOpen" class="text-white hover:text-primary transition-colors p-2" aria-label="Search">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </nav>

            <div class="flex gap-3 lg:gap-4 justify-center items-center">
                <!-- Mobile: Icons only -->
                <button @click="searchOpen = !searchOpen" class="lg:hidden <?php echo ($small ? 'text-primary' : 'text-white hover:text-primary'); ?>" aria-label="Search">
                    <svg class="w-[20px] hover:scale-105" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
                <a href="tel:01543251122" class="lg:hidden">
                    <svg class="<?php echo ($small ? 'text-primary' : 'text-white hover:text-primary'); ?> w-[20px] hover:scale-105" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </a>
                <a href="mailto:info@flameritefires.com" class="lg:hidden">
                    <svg class="<?php echo ($small ? 'text-primary' : 'text-white hover:text-primary'); ?> w-[20px] hover:scale-105" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </a>

                <!-- Desktop: Stacked text -->
                <div class="hidden lg:flex flex-col gap-2.5 text-primary text-xs leading-tight">
                    <a href="tel:01543251122" class="flex items-center gap-1 hover:text-primary/80 transition-colors">
                        <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="font-medium">01543 251122</span>
                    </a>
                    <a href="mailto:info@flameritefires.com" class="flex items-center gap-1 hover:text-primary/80 transition-colors">
                        <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-medium">info@flameritefires.com</span>
                    </a>
                </div>

                <button type="button" class="nav-mobile right-4 z-[999] rounded-md <?php echo ($small ? 'text-primary' : 'text-white'); ?>" @click="mobileMenuOpen = true">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Search Dropdown -->
        <div x-show="searchOpen"
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             @click.away="searchOpen = false"
             class="absolute top-full left-0 w-full bg-white shadow-lg py-6 px-4"
             x-init="$watch('searchOpen', value => { if(value) { setTimeout(() => { $refs.searchInput.focus() }, 100) } })">
            <form action="<?php echo esc_url(home_url('/')); ?>" method="get" role="search" class="container mx-auto">
                <div class="flex gap-2 max-w-3xl mx-auto">
                    <input type="text"
                           name="s"
                           placeholder="Search products, documents..."
                           class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors"
                           value=""
                           x-ref="searchInput">
                    <button type="submit"
                            class="bg-primary hover:bg-primary/90 text-white font-semibold py-3 px-8 rounded-lg transition-colors"
                            aria-label="Search">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen"
             x-cloak
             class="fixed inset-0 z-[9999] overflow-y-auto bg-primary pb-6 lg:hidden"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="flex items-center justify-between px-6 pb-12 pt-[20px]">
                <a href="<?php echo home_url('/'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" class="my-auto w-[150px] lg:ml-0">
                </a>
                <div class="flex gap-4">
                    <a href="tel:01543251122">
                        <svg class="w-[20px] lg:w-[30px] hover:scale-105 text-white hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </a>
                    <a href="mailto:info@flameritefires.com">
                        <svg class="w-[20px] lg:w-[30px] hover:scale-105 text-white hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </a>
                    <button type="button" class="z-[999] text-white" @click="mobileMenuOpen = false">
                        <span class="sr-only">Close menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="mt-6 flow-root px-6">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="flex flex-col space-y-3">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'main-menu',
                            'container' => false,
                            'menu_class' => 'flex flex-col space-y-3',
                            'walker' => new Greycaine_Mobile_Walker(),
                            'fallback_cb' => 'greycaine_mobile_default_menu'
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="<?php echo $has_dynamic_hero ? '' : 'mt-[70px] lg:mt-[110px]'; ?>">