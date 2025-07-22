<?php
/**
 * The header for our theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <meta name="description" content="Asset Management by Advance - Keeping your kitchen and catering facilities running smoothly">
    
    <!-- Google Fonts - Open Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Load local Tailwind CSS instead of CDN for better customization -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/app.css?v=1.0.1">
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <link rel="stylesheet"
          href="https://unpkg.com/swiper/swiper-bundle.min.css"/>

              <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- Custom Styles -->
    <style>
        /* Set Open Sans as the default font for the entire site */
        * {
            font-family: 'Open Sans', sans-serif;
        }
        
        /* Add any custom styles here */
        .stats-slider,
        .customers-slider,
        .awards-slider {
            /* overflow: hidden; */
        }
        
        /* Mobile menu animation */
        #mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }
        
        #mobile-menu.open {
            max-height: 100vh;
        }
        
        /* Add container query rules */
        /* These will be used based on the parent container size rather than viewport */
        @container (max-width: 768px) {
            .container-responsive {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            .container-responsive .grid {
                grid-template-columns: 1fr;
            }
        }
        
        @container (min-width: 769px) and (max-width: 1024px) {
            .container-responsive .grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @container (min-width: 1025px) {
            .container-responsive .grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }
        
        /* Slider styles for mobile */
        @media (max-width: 768px) {
            .stats-slider .grid,
            .customers-slider .grid,
            .awards-slider .grid {
                display: flex;
                overflow-x: auto;
                scroll-snap-type: x mandatory;
                scroll-behavior: smooth;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none; /* Firefox */
            }
            
            .stats-slider .grid::-webkit-scrollbar,
            .customers-slider .grid::-webkit-scrollbar,
            .awards-slider .grid::-webkit-scrollbar {
                display: none; /* Chrome, Safari, Edge */
            }
            
            .stats-slider .grid > div,
            .customers-slider .grid > div,
            .awards-slider .grid > div {
                flex: 0 0 100%;
                scroll-snap-align: center;
                margin-right: 15px;
            }
        }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class('text-gray-800'); ?>>
    <?php wp_body_open(); ?>
    
    <!-- Navigation -->
    <header class="bg-white shadow-md fixed w-full top-0 z-50" x-data="{ searchOpen: false, mobileSearchOpen: false }">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center">
                    <?php
                    $logo = get_field('site_logo', 'option');
                    if ($logo) {
                        echo '<img src="' . esc_url($logo['url']) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="h-10">';
                    } else {
                        echo '<img src="' . get_stylesheet_directory_uri() . '/assets/images/logo.png" alt="' . esc_attr(get_bloginfo('name')) . '" class="h-10">';
                    }
                    ?>
                </a>
                
                <div class="flex gap-4 md:gap-12">
                    <div class="flex items-center space-x-3 md:space-x-4">
                        <button @click="searchOpen = !searchOpen" class="hidden sm:block">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/search.png" class="h-6 md:h-7"/>
                        </button>

                        <a href="#" class="hidden sm:block">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/call.png" class="h-6 md:h-7"/>
                        </a>

                        <a href="#" class="hidden sm:block">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/login.png" class="h-6 md:h-7"/>
                        </a>
                        
                        <button class=" text-gray-800 p-2 focus:outline-none" id="mobile-menu-button" aria-label="Toggle mobile menu">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="menu-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="#000" id="close-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Search Bar -->
            <div x-show="searchOpen" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                 @click.away="searchOpen = false"
                 class="absolute top-full left-0 w-full bg-white shadow-lg py-4 px-4"
                 x-init="$watch('searchOpen', value => { if(value) { setTimeout(() => { $refs.searchInput.focus() }, 100) } })">
                <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="container mx-auto">
                    <div class="flex gap-2 max-w-3xl mx-auto">
                        <input type="text" 
                               name="s" 
                               placeholder="Search..." 
                               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-red-600"
                               value="<?php echo get_search_query(); ?>"
                               x-ref="searchInput">
                        <button type="submit" 
                                class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                            Search
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Mobile Menu -->
            <div class="md:hidden z-[999] fixed top-0 left-0 w-full lg:w-[400px] h-[100vh] bg-white lg:bg-[#333] px-4" id="mobile-menu">
                <div class=" space-y-4 border-t border-gray-200">

                <div class="flex justify-between items-center py-4 container mx-auto">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center">
                    <?php
                    $logo = get_field('site_logo', 'option');
                    if ($logo) {
                        echo '<img src="' . esc_url($logo['url']) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="lg:px-4  h-10">';
                    } else {
                        echo '<img src="' . get_stylesheet_directory_uri() . '/assets/images/logo.png" alt="' . esc_attr(get_bloginfo('name')) . '" class="lg:px-4 h-10">';
                    }
                    ?>
                </a>
                <button class=" text-gray-800 p-2 focus:outline-none" id="m-mobile-menu-button" aria-label="Toggle mobile menu">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="m-menu-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="#fff" id="m-close-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                </div>
                   <div class="container mx-auto px-4 flex flex-col space-y-4 justify-between h-full" style="height: calc(100vh - 100px);"> 
                    <div class="flex flex-col space-y-4 ">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'main-menu',
                            'container' => false,
                            'menu_class' => '',
                            'items_wrap' => '%3$s',
                            'walker' => new Mobile_Walker_Nav_Menu()
                        ));
                        ?>
                    </div>
                    <!-- Mobile-only menu icons -->
                    <div class="flex items-center justify-around pt-4 border-t border-gray-100">
                        <a href="/?s=" class="flex flex-col items-center text-xs text-gray-600 lg:text-white">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/search.png" class="h-6 mb-1"/>
                            <span>Search</span>
                        </a>
                        <a href="#" class="flex flex-col items-center text-xs text-gray-600 lg:text-white">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/call.png" class="h-6 mb-1"/>
                            <span>Call Us</span>
                        </a>
                        <a href="#" class="flex flex-col items-center text-xs text-gray-600 lg:text-white">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/login.png" class="h-6 mb-1"/>
                            <span>Login</span>
                        </a>
                    </div>
                    
                    <!-- Mobile Search Form -->
                    <div x-show="mobileSearchOpen" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="absolute bottom-24 left-4 right-4 bg-white rounded-lg shadow-lg p-4">
                        <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                            <div class="flex flex-col gap-2">
                                <input type="text" 
                                       name="s" 
                                       placeholder="Search..." 
                                       class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-red-600"
                                       value="<?php echo get_search_query(); ?>">
                                <button type="submit" 
                                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Main Content - Add mt-20 to account for fixed header -->
    <main class="mt-[72px]">