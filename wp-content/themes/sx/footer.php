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

                <div class="stack-sm">
                    <h3 class="font-semibold lg:px-4 mb-3 uppercase text-white">Follow Us</h3>
                    <a href="https://www.facebook.com/flameritefiresltd" target="_blank" rel="noopener" class="social-link text-label lg:px-4"><svg class="w-5 h-5" fill="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-facebook"/></svg>Facebook</a>
                    <a href="https://twitter.com/FlameriteFires" target="_blank" rel="noopener" class="social-link text-label lg:px-4"><svg class="w-5 h-5" fill="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-x"/></svg>X</a>
                    <a href="https://www.instagram.com/flameritefires/" target="_blank" rel="noopener" class="social-link text-label lg:px-4"><svg class="w-5 h-5" fill="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-instagram"/></svg>Instagram</a>
                    <a href="https://www.pinterest.co.uk/Flameritefires/" target="_blank" rel="noopener" class="social-link text-label lg:px-4"><svg class="w-5 h-5" fill="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-pinterest"/></svg>Pinterest</a>
                    <a href="https://www.youtube.com/channel/UCuBluN5KsWR_1ABRY0BoL7w" target="_blank" rel="noopener" class="social-link text-label lg:px-4"><svg class="w-5 h-5" fill="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-youtube"/></svg>YouTube</a>
                    <a href="https://www.linkedin.com/company/flamerite-fires-limited/" target="_blank" rel="noopener" class="social-link text-label lg:px-4"><svg class="w-5 h-5" fill="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-linkedin"/></svg>LinkedIn</a>
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

    <!-- Where to Buy Modal (Global) -->
    <div id="whereToBuyModal" class="fixed inset-0 z-[9999] hidden">
        <div id="whereToBuyOverlay" class="absolute inset-0 transition-opacity" style="background:rgba(0,0,0,0.3)"></div>
        <div id="whereToBuyContent" class="absolute bg-white transition-transform duration-300 ease-in-out inset-0 lg:inset-y-0 lg:right-0 lg:left-auto lg:w-[600px] lg:max-w-[90vw] overflow-y-auto transform translate-x-full">
            <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex-between z-10">
                <h2 class="text-2xl font-bold text-primary">Your Local Supplier</h2>
                <button id="closeWhereToBuy" class="icon-btn text-gray-500 hover:text-primary" aria-label="Close supplier finder">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-close"/></svg>
                </button>
            </div>
            <p class="px-6 mt-4 text-sm text-black">We will help you find your best local Flamerite supplier. If you can send over your details we will contact you to match your needs to the perfect fire. As a thank you we will send you a <b>£50</b> voucher to put against your new Flamerite fire.</p>
            <div id="whereToBuyIframeContainer"></div>
        </div>
    </div>

    <!-- Cookie Consent Overlay -->
    <div id="cookie-policy-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[9998] transition-opacity duration-300 opacity-0" style="display: none;"></div>

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
                <div class="flex flex-row-reverse gap-2 md:gap-3 w-full md:w-auto">
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

    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/footer.min.js?v=1.0.0"></script>

    <?php wp_footer(); ?>
</body>
</html>