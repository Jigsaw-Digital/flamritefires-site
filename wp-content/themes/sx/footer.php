<!-- <div class="cta-fixed flex lg:hidden">
    <div class="cta-apointment" style="min-width:50px">
        <a href="/where-to-buy">
            <img src="/icons/where_to_buy.svg"> 
        </a>
        <a href="/where-to-buy">
            <span>Where To Buy</span>
        </a>
    </div>
    <div class="cta-brochure">
        <a href="/contact-us/">
            <img src="/icons/contact_us.svg"> 
        </a>
        <a href="/contact-us/">
            <span>Contact Us</span>
        </a>
    </div>
</div> -->

<div class="cta-fixed hidden lg:flex">
    <a href="/where-to-buy" class="cta-apointment">
        <img src="/icons/new-right-1.svg" alt="Where to Buy">
        <span style="font-size:12px; color:#fff">WHERE TO BUY</span>
    </a>
</div>

<div class="cta-fixed mt-16 hidden lg:flex">
    <a href="/contact-us/" class="cta-brochure">
        <img src="/icons/new-right-2.svg" alt="Contact Us">
        <span style="font-size:12px; color:#fff">CONTACT US</span>
    </a>
</div>

<style>
    .cta-fixed {
        position: fixed;
        right: 0px;
        top: 40%;
        z-index: 99999;
    }

     /* .cta-fixed:hover {
        width: 190px;
     } */

    .cta-apointment:hover   {
        width: 170px;  
    }

    .cky-btn-revisit-wrapper {
        display: none;
    }
    
    .cta-brochure:hover  {
        width: 140px;  
    }

    .cta-fixed:hover .cta-apointment img {
        margin-left: 0;
    }

     .cta-fixed:hover span {
        display: block;
        width: auto;
        text-align: left;
        font-size: 12px;
        padding-left: 8px;
        white-space: nowrap;
     }

    .cta-apointment {
        background-color: #E85319;
        padding: 0;
        margin: 0;
        display: flex;
        align-items: center;
        width: 60px;
        height: 60px;
        border-radius: 10px 0 0 10px;
        overflow: hidden;
        border: none;
        outline: none;
        box-sizing: border-box;
        text-decoration: none;
        transition: width 0.3s ease;
    }

    .cta-brochure {
        background-color: #99320a;
        padding: 0;
        margin: 0;
        display: flex;
        align-items: center;
        width: 60px;
        height: 60px;
        border-radius: 10px 0 0 10px;
        overflow: hidden;
        border: none;
        outline: none;
        box-sizing: border-box;
        text-decoration: none;
        transition: width 0.3s ease;
    }

    .cta-apointment img {
        width: 60px !important;
        height: 60px !important;
        margin: 0 !important;
        padding: 0 !important;
        display: block !important;
        border-radius: 0 !important;
        border: none !important;
        outline: none !important;
        box-sizing: border-box !important;
        object-fit: cover !important;
        flex-shrink: 0 !important;
    }

    .cta-brochure img  {
        width: 60px !important;
        height: 60px !important;
        margin: 0 !important;
        padding: 0 !important;
        display: block !important;
        border-radius: 0 !important;
        border: none !important;
        outline: none !important;
        box-sizing: border-box !important;
        object-fit: cover !important;
        flex-shrink: 0 !important;
    }

    .cta-apointment span, .cta-brochure span  {
        display: none;
        color: #fff;
    }

    .cta-apointment:hover  {
        width: 170px;
        cursor: pointer;
        opacity: 90%;
        overflow: visible;
    }

    .cta-brochure:hover  {
        width: 170px;
        cursor: pointer;
        opacity: 90%;
        overflow: visible;
        background-color: #99320a;
    }

    .cta-apointment:hover span, .cta-brochure:hover span {
        display: inline-block !important;
        padding-left: 12px;
        padding-right: 12px;
    }

@media (max-width: 768px) {
    .cta-fixed {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        top: auto;
        justify-content: space-between;
    }

    .cta-fixed:hover, .cta-fixed:hover .cta-apointment, .cta-fixed:hover .cta-brochure  {
        width: unset!important;
    }

    .cta-apointment, .cta-brochure {
        justify-content: center;
        align-items: center;
        flex: 1;
        margin: 0;
        opacity: 0.9;
        padding: 10px 5px;
    }

    .cta-apointment img {
        margin-left:10px;
        width:38px;
        padding: 12px;
    }

    .cta-brochure img {
        padding:8px!important;
    }

    .cta-fixed:hover span {
        font-size: 12px;
    }
    
    .cta-brochure img {
        margin-left:10px;
        width:35px;
    }

    .cta-apointment span {
        color: #fff;
    }

    .cta-brochure span { 
       
    }

     .cta-apointment span, .cta-brochure span {
        display: block;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 12px;;
        width: 100%;
        text-align: center;
    }
}

/* Footer Menu Styling */
.footer-menu-items {
    list-style: none;
    margin: 0;
    padding: 0;
}

.footer-menu-items li {
    margin: 0;
    padding: 0;
    margin-bottom: 0.5rem;
}

.footer-menu-items li:last-child {
    margin-bottom: 0;
}

.footer-menu-items li a {
    display: block;
    padding-left: 1rem;
    padding-right: 1rem;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.1875rem;
    color: #fff;
    transition: color 0.3s;
}

.footer-menu-items li a:hover {
    color: rgba(255, 255, 255, 0.7);
}

@media (min-width: 1024px) {
    .footer-menu-items li a {
        padding-left: 1rem;
        padding-right: 1rem;
    }
}
</style>
    
    
    </main>

    <div class="print:hidden pt-16 pb-16 bg-primary overflow-hidden px-6 lg:px-10">
        <div class="max-w-7xl mx-auto lg:flex justify-between px-6 lg:px-0">
            <div class="w-[200px] xl:w-[300px] max-w-[400px]">
                <?php 
                $site_logo = get_field('site_logo', 'option');
                if ($site_logo) {
                    echo '<img src="' . esc_url($site_logo['url']) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
                } else {
                    echo '<img src="' . get_template_directory_uri() . '/assets/images/logo.png" alt="Flamerite Fires">';
                }
                ?>
            </div>
            <div class="flex flex-wrap gap-12 mt-8 lg:mt-0">

                <div class="space-y-2">
                    <h3 class="font-semibold lg:px-4 mb-3 uppercase text-white">Products</h3>
                    <?php
                    if (has_nav_menu('footer-products')) {
                        wp_nav_menu(array(
                            'theme_location' => 'footer-products',
                            'container' => false,
                            'menu_class' => 'footer-menu-items',
                            'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                            'link_before' => '',
                            'link_after' => '',
                            'fallback_cb' => false,
                            'item_spacing' => 'discard',
                        ));
                    } else {
                        // Fallback to hardcoded links if menu not set
                        echo '<a href="' . esc_url(home_url('/e-fx-built-in-fires/')) . '" class="lg:px-4 text-sm uppercase tracking-[3px] text-white hover:text-white/70 block">E-FX Built In Fires</a>';
                        echo '<a href="' . esc_url(home_url('/e-fx-fireplace-suites/')) . '" class="lg:px-4 text-sm uppercase tracking-[3px] text-white hover:text-white/70 block">E-FX Fireplace Suites</a>';
                        echo '<a href="' . esc_url(home_url('/hearth-inset-fires/')) . '" class="lg:px-4 text-sm uppercase tracking-[3px] text-white hover:text-white/70 block">Hearth &amp; Inset Fires</a>';
                        echo '<a href="' . esc_url(home_url('/e-ridium-holographic-fires/')) . '" class="lg:px-4 text-sm uppercase tracking-[3px] text-white hover:text-white/70 block">E-RIDIUM Holographic Fires</a>';
                    }
                    ?>
               </div>

                <div class="space-y-2">
                    <h3 class="font-semibold lg:px-4 mb-3 uppercase text-white">Other</h3>
                    <?php
                    if (has_nav_menu('footer-other')) {
                        wp_nav_menu(array(
                            'theme_location' => 'footer-other',
                            'container' => false,
                            'menu_class' => 'footer-menu-items',
                            'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                            'link_before' => '',
                            'link_after' => '',
                            'fallback_cb' => false,
                            'item_spacing' => 'discard',
                        ));
                    } else {
                        // Fallback to hardcoded links if menu not set
                        $other_links = array(
                            array('name' => 'Bespoke', 'href' => home_url('/bespoke')),
                            array('name' => 'About Us', 'href' => home_url('/about-us')),
                            array('name' => 'Privacy Policy', 'href' => home_url('/privacy-policy'))
                        );

                        foreach ($other_links as $link) {
                            echo '<a href="' . esc_url($link['href']) . '" class="lg:px-4 text-sm uppercase tracking-[3px] text-white hover:text-white/70 block">' . esc_html($link['name']) . '</a>';
                        }
                    }
                    ?>
                </div>

                <div class="space-y-2">
                    <h3 class="font-semibold lg:px-4 mb-3 uppercase text-white">Follow Us</h3>

                    <!-- Facebook -->
                    <a href="https://www.facebook.com/flameritefiresltd" target="_blank" rel="noopener" class="lg:px-4 text-sm uppercase tracking-[3px] text-white hover:text-white/70 flex items-center gap-2 block">
                        <span class="w-6 h-6 inline-flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </span>
                        Facebook
                    </a>

                    <!-- X (Twitter) -->
                    <a href="https://twitter.com/FlameriteFires" target="_blank" rel="noopener" class="lg:px-4 text-sm uppercase tracking-[3px] text-white hover:text-white/70 flex items-center gap-2 block">
                        <span class="w-6 h-6 inline-flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </span>
                        X
                    </a>

                    <!-- Instagram -->
                    <a href="https://www.instagram.com/flameritefires/" target="_blank" rel="noopener" class="lg:px-4 text-sm uppercase tracking-[3px] text-white hover:text-white/70 flex items-center gap-2 block">
                        <span class="w-6 h-6 inline-flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        Instagram
                    </a>

                    <!-- Pinterest -->
                    <a href="https://www.pinterest.co.uk/Flameritefires/" target="_blank" rel="noopener" class="lg:px-4 text-sm uppercase tracking-[3px] text-white hover:text-white/70 flex items-center gap-2 block">
                        <span class="w-6 h-6 inline-flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.39 18.592.026 11.985.026L12.017 0z" />
                            </svg>
                        </span>
                        Pinterest
                    </a>

                    <!-- YouTube -->
                    <a href="https://www.youtube.com/channel/UCuBluN5KsWR_1ABRY0BoL7w" target="_blank" rel="noopener" class="lg:px-4 text-sm uppercase tracking-[3px] text-white hover:text-white/70 flex items-center gap-2 block">
                        <span class="w-6 h-6 inline-flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </span>
                        YouTube
                    </a>

                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/company/flamerite-fires-limited/" target="_blank" rel="noopener" class="lg:px-4 text-sm uppercase tracking-[3px] text-white hover:text-white/70 flex items-center gap-2 block">
                        <span class="w-6 h-6 inline-flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </span>
                        LinkedIn
                    </a>
                </div>
            </div>
        </div>
        <div class="max-w-7xl px-6 lg:px-0 mx-auto flex flex-col sm:flex-row justify-between items-center text-white/60 mt-8 lg:mt-16 text-sm">
            <p class="copyright">All Rights Reserved. <?php echo date('Y'); ?>. Company Number: 15924494</p>
            <div class="flex items-center gap-4 mt-2 sm:mt-0 text-xs">
                <a href="<?php echo esc_url(home_url('/cookie-policy/')); ?>" class="hover:text-white/80 transition-colors">Cookie Policy</a>
                <span class="text-white/40">|</span>
                <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>" class="hover:text-white/80 transition-colors">Privacy Policy</a>
            </div>
        </div>
    </div>

    <!-- Cookie Consent Banner -->
    <div id="cookie-policy-banner" class="fixed bottom-0 left-0 right-0 bg-[#1e2938] z-[9999] shadow-lg transform transition-transform duration-300 ease-in-out border-t border-primary/20" style="display: none; transform: translateY(100%);">
        <div class="container mx-auto px-4 py-4 md:py-6">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="flex-1">
                    <h3 class="text-white font-semibold text-lg mb-1">Cookie Policy</h3>
                    <p class="text-white/80 text-sm md:text-base">
                        We use cookies and third-party services to enhance your browsing experience. This includes Google Analytics for traffic analysis (optional) and Google reCAPTCHA for form spam protection (necessary).
                        By clicking "Accept All", you consent to optional analytics cookies.
                        Click "Customize" to manage your cookie preferences. Visit our <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>" class="text-primary hover:text-primary/80 underline">Privacy Policy</a> for more information.
                    </p>

                    <!-- Cookie Preferences (Hidden by default) -->
                    <div id="cookie-preferences" class="hidden mt-6 space-y-4">
                        <p class="text-white/90 text-sm font-medium mb-3">Manage Cookie Preferences:</p>

                        <!-- Necessary Cookies (Always on, disabled) -->
                        <label class="flex items-start gap-3 cursor-not-allowed opacity-60">
                            <input type="checkbox" checked disabled class="mt-1 w-5 h-5 rounded border-gray-400 text-primary focus:ring-primary cursor-not-allowed">
                            <div class="flex-1">
                                <div class="text-white font-medium text-sm">Strictly Necessary Cookies</div>
                                <div class="text-white/70 text-xs mt-1">Required for the website to function. Includes form spam protection (reCAPTCHA) and session management. Cannot be disabled.</div>
                            </div>
                        </label>

                        <!-- Analytics Cookies -->
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" id="cookie-analytics" checked class="mt-1 w-5 h-5 rounded border-gray-400 text-primary focus:ring-primary cursor-pointer">
                            <div class="flex-1">
                                <div class="text-white font-medium text-sm">Analytics Cookies</div>
                                <div class="text-white/70 text-xs mt-1">Help us understand how visitors interact with our website by collecting and reporting information anonymously. Uses Google Analytics.</div>
                            </div>
                        </label>

                        <!-- Marketing Cookies -->
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" id="cookie-marketing" checked class="mt-1 w-5 h-5 rounded border-gray-400 text-primary focus:ring-primary cursor-pointer">
                            <div class="flex-1">
                                <div class="text-white font-medium text-sm">Marketing Cookies</div>
                                <div class="text-white/70 text-xs mt-1">Track your activity to provide personalized advertising and marketing content. Used for retargeting and ad optimization.</div>
                            </div>
                        </label>

                        <!-- Functional Cookies -->
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" id="cookie-functional" checked class="mt-1 w-5 h-5 rounded border-gray-400 text-primary focus:ring-primary cursor-pointer">
                            <div class="flex-1">
                                <div class="text-white font-medium text-sm">Functional Cookies</div>
                                <div class="text-white/70 text-xs mt-1">Enable enhanced functionality and personalization, such as remembering your preferences and settings.</div>
                            </div>
                        </label>

                        <!-- Performance Cookies -->
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" id="cookie-performance" checked class="mt-1 w-5 h-5 rounded border-gray-400 text-primary focus:ring-primary cursor-pointer">
                            <div class="flex-1">
                                <div class="text-white font-medium text-sm">Performance Cookies</div>
                                <div class="text-white/70 text-xs mt-1">Help us improve website performance by understanding which pages are most and least popular and how visitors move around the site.</div>
                            </div>
                        </label>

                        <button id="cookie-save-preferences" class="w-full bg-primary hover:bg-primary/90 text-white font-medium py-2 px-4 rounded-md transition-colors duration-300 mt-4">
                            Save My Preferences
                        </button>
                    </div>
                </div>

                <!-- Buttons Container -->
                <div class="flex flex-row-reverse md:flex-row gap-2 md:gap-3 w-full md:w-auto">
                    <button id="cookie-policy-accept" class="bg-primary hover:bg-primary/90 text-white font-medium py-2 px-3 md:px-4 rounded-md transition-colors duration-300 whitespace-nowrap text-sm md:text-base flex-1 md:flex-none">
                        Accept All
                    </button>
                    <button id="cookie-policy-customize" class="bg-white/10 hover:bg-white/20 text-white font-medium py-2 px-3 md:px-4 rounded-md transition-colors duration-300 whitespace-nowrap border border-white/30 text-sm md:text-base flex-1 md:flex-none">
                        Customize
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Handle transparent header scroll behavior
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.getElementById('header');
        const hasDynamicHero = header && header.getAttribute('data-has-dynamic-hero') === 'true';

        if (hasDynamicHero) {
            let lastScroll = 0;

            window.addEventListener('scroll', function() {
                const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

                if (currentScroll > 100) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }

                lastScroll = currentScroll;
            });
        }
    });

    // Cookie consent banner functionality
    (function() {
        const banner = document.getElementById('cookie-policy-banner');
        const acceptBtn = document.getElementById('cookie-policy-accept');
        const customizeBtn = document.getElementById('cookie-policy-customize');
        const savePreferencesBtn = document.getElementById('cookie-save-preferences');
        const preferencesSection = document.getElementById('cookie-preferences');
        const COOKIE_NAME = 'cookie_consent';
        const COOKIE_EXPIRY_DAYS = 365;

        // Check if user has already made a choice
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }

        // Set cookie
        function setCookie(name, value, days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            const expires = `expires=${date.toUTCString()}`;
            document.cookie = `${name}=${value};${expires};path=/;SameSite=Lax`;
        }

        // Show banner with animation
        function showBanner() {
            banner.style.display = 'block';
            setTimeout(() => {
                banner.style.transform = 'translateY(0)';
            }, 10);
        }

        // Hide banner with animation
        function hideBanner() {
            banner.style.transform = 'translateY(100%)';
            setTimeout(() => {
                banner.style.display = 'none';
            }, 300);
        }

        // Handle accept all
        function handleAccept() {
            setCookie(COOKIE_NAME, 'accepted', COOKIE_EXPIRY_DAYS);
            hideBanner();
            // Dispatch event to load analytics
            window.dispatchEvent(new Event('cookiesAccepted'));
            console.log('All cookies accepted - analytics will now load');
        }

        // Handle customize button click
        function handleCustomize() {
            if (preferencesSection.classList.contains('hidden')) {
                preferencesSection.classList.remove('hidden');
                customizeBtn.textContent = 'Hide Options';
            } else {
                preferencesSection.classList.add('hidden');
                customizeBtn.textContent = 'Customize';
            }
        }

        // Handle save preferences
        function handleSavePreferences() {
            const analytics = document.getElementById('cookie-analytics').checked;
            const marketing = document.getElementById('cookie-marketing').checked;
            const functional = document.getElementById('cookie-functional').checked;
            const performance = document.getElementById('cookie-performance').checked;

            // Check if all are unchecked (user wants to decline all optional)
            if (!analytics && !marketing && !functional && !performance) {
                setCookie(COOKIE_NAME, 'necessary', COOKIE_EXPIRY_DAYS);
                console.log('Only necessary cookies accepted');
            } else {
                // At least one optional cookie is enabled
                setCookie(COOKIE_NAME, 'accepted', COOKIE_EXPIRY_DAYS);

                // Store individual preferences
                setCookie('cookie_analytics', analytics ? '1' : '0', COOKIE_EXPIRY_DAYS);
                setCookie('cookie_marketing', marketing ? '1' : '0', COOKIE_EXPIRY_DAYS);
                setCookie('cookie_functional', functional ? '1' : '0', COOKIE_EXPIRY_DAYS);
                setCookie('cookie_performance', performance ? '1' : '0', COOKIE_EXPIRY_DAYS);

                // Only load analytics if specifically enabled
                if (analytics) {
                    window.dispatchEvent(new Event('cookiesAccepted'));
                }

                console.log('Custom cookie preferences saved');
            }

            hideBanner();
        }

        // Check if banner should be shown
        const consent = getCookie(COOKIE_NAME);
        if (!consent) {
            showBanner();
        }

        // Event listeners
        if (acceptBtn) {
            acceptBtn.addEventListener('click', handleAccept);
        }
        if (customizeBtn) {
            customizeBtn.addEventListener('click', handleCustomize);
        }
        if (savePreferencesBtn) {
            savePreferencesBtn.addEventListener('click', handleSavePreferences);
        }
    })();
    </script>

    <?php wp_footer(); ?>
</body>
</html>