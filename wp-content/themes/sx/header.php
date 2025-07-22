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
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/app.css?v=1.0.1">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/greycaine.css?v=1.0.1">
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
    
    <style>
        * {
            font-family: 'Montserrat', sans-serif;
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
            font-family: 'Montserrat', sans-serif;
            font-style: italic;
        }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> x-data="{ mobileMenuOpen: false, mobileSubMenuOpen: false, megaMenuOpen: false }" style="background-color: #333;">
    <?php wp_body_open(); ?>
    
    <?php
    // Get hero block data to determine header style
    global $post;
    $hero_block = null;
    $small = false;
    
    if (has_blocks($post->post_content)) {
        $blocks = parse_blocks($post->post_content);
        foreach ($blocks as $block) {
            if (in_array($block['blockName'], ['acf/dynamic-hero', 'acf/layout-hero', 'acf/layout-video-hero'])) {
                $hero_block = $block;
                if ($block['blockName'] === 'acf/dynamic-hero') {
                    $small = isset($block['attrs']['data']['small']) && $block['attrs']['data']['small'] == '1';
                } else {
                    $small = isset($block['attrs']['data']['small']) && $block['attrs']['data']['small'] == '1';
                }
                break;
            }
        }
    }
    
    // Get WordPress categories for product menu
    $product_categories = get_categories(array(
        'taxonomy' => 'category',
        'hide_empty' => true,
        'parent' => 0
    ));
    ?>
    
    <header id="header" class="fixed-to-top fixed left-0 top-0 z-[999] w-full items-center py-[20px] xl:py-[30px]">
        <div class="mx-auto flex max-w-6xl justify-between px-6 xl:max-w-7xl">
            <div class="flex w-[200px] items-center xl:w-[200px]">
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
            
            <div class="nav-desktop flex items-center gap-2 xl:gap-4">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'container' => false,
                    'menu_class' => 'flex items-center gap-2 xl:gap-4',
                    'walker' => new Greycaine_Desktop_Walker(),
                    'fallback_cb' => 'greycaine_default_menu'
                ));
                ?>
            </div>

            <div class="flex gap-4 justify-center items-center">
                <a href="tel:01923923120">
                    <svg class="<?php echo ($small ? 'text-primary' : 'text-white hover:text-primary'); ?> w-[20px] lg:w-[30px] hover:scale-105" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </a>
                <a href="mailto:info@greycaine.co.uk">
                    <svg class="<?php echo ($small ? 'text-primary' : 'text-white hover:text-primary'); ?> w-[20px] lg:w-[30px] hover:scale-105" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </a>
                <a href="/showroom" class="nav-desktop !lg:flex px-2 py-1 border-primary hover:bg-primary text-primary hover:text-white inline-block justify-center items-center border-2 border px-2 py-1 text-sm font-semibold xl:text-lg">
                    <span class="text-[14px]">Book A <span class="hidden xl:inline-block">Showroom</span> Visit</span>
                </a>
                <button type="button" class="nav-mobile right-4 z-[999] rounded-md <?php echo ($small ? 'text-primary' : 'text-white'); ?>" @click="mobileMenuOpen = true">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" class="fixed inset-0 z-[9999] overflow-y-auto bg-primary pb-6 lg:hidden" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="flex items-center justify-between px-6 pb-12 pt-[20px]">
                <a href="<?php echo home_url('/'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Greycaine_Dark.png" class="my-auto w-[200px] lg:ml-0">
                </a>
                <div class="flex gap-4">
                    <a href="tel:01923923120">
                        <svg class="w-[20px] lg:w-[30px] hover:scale-105 text-white hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </a>
                    <a href="mailto:info@greycaine.co.uk">
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

    <main class="mt-[70px] lg:mt-[110px]">