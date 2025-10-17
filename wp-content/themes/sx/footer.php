<div class="cta-fixed flex lg:hidden">
    <div class="cta-apointment" style="min-width:50px">
        <a href="https://supplier.flameritefires.com/find-your-local-flamerite-supplier">
            <img src="/icons/where_to_buy.svg"> 
        </a>
        <a href="https://supplier.flameritefires.com/find-your-local-flamerite-supplier">
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
</div>

<div class="cta-fixed hidden lg:flex">
    <div class="cta-apointment" style="min-width:50px">
        <a href="https://supplier.flameritefires.com/find-your-local-flamerite-supplier">
            <img src="/icons/where_to_buy_c.svg"> 
        </a>
        <a href="https://supplier.flameritefires.com/find-your-local-flamerite-supplier">
            <span style="font-size:12px; color:#fff">WHERE TO BUY</span>
        </a>
    </div>
</div>

<div class="cta-fixed mt-16 hidden lg:flex">
    <div class="cta-brochure">
        <a href="/contact-us/">
            <img src="/icons/contact_us.svg"> 
        </a>
        <a href=/contact-us/">
            <span style="font-size:12px; color:#fff">CONTACT US</span> 
        </a>
    </div>
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
        width: 190px;  
    }

    .cta-fixed:hover .cta-apointment img {
        margin-left: 5px;
    }

     .cta-fixed:hover span {
        display: block;
        width: 100%;
        text-align: center;
        font-size: 12px;;
     }

    .cta-apointment {
        background-color: #E85319;
        padding:4px;
    }

    .cta-brochure {
        background-color: #1e2939;
        padding:4px;
    }

    .cta-apointment img {
        width: 45px;
        margin: 0px auto;
        padding: 5px;
    }
    
    .cta-brochure img  {
        width:45px;
        padding: 12px;
    }

    .cta-apointment span, .cta-brochure span  {
        display: none;
        color: #fff;
    }

    .cta-apointment, .cta-brochure  {
        z-index: 9999999999;
        display: flex;
        justify-content: space-between;
        align-items: center;

    }

    .cta-apointment:hover, .cta-brochure:hover  {
        cursor: pointer;
        opacity: 90%;
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
                    <a href="<?php echo esc_url(home_url('/e-fx-built-in-fires/')); ?>" class="lg:px-4 text-sm uppercase tracking-[3px] text-white hover:text-white/70 block">E-FX Built In Fires</a>
                    <a href="<?php echo esc_url(home_url('/e-fx-fireplace-suites/')); ?>" class="lg:px-4 text-sm uppercase tracking-[3px] text-white hover:text-white/70 block">E-FX Fireplace Suites</a>
                    <a href="<?php echo esc_url(home_url('/hearth-inset-fires/')); ?>" class="lg:px-4 text-sm uppercase tracking-[3px] text-white hover:text-white/70 block">Hearth &amp; Inset Fires</a>
                    <a href="<?php echo esc_url(home_url('/e-ridium-holographic-fires/')); ?>" class="lg:px-4 text-sm uppercase tracking-[3px] text-white hover:text-white/70 block">E-RIDIUM Holographic Fires</a>
               </div>

                <div class="space-y-2">
                    <h3 class="font-semibold lg:px-4 mb-3 uppercase text-white">Other</h3>
                    <?php
                    $other_links = array(
                        array('name' => 'Bespoke', 'href' => home_url('/bespoke')),
                        array('name' => 'About Us', 'href' => home_url('/about-us')),
                        array('name' => 'Privacy Policy', 'href' => home_url('/privacy-policy'))
                    );
                    
                    foreach ($other_links as $link) {
                        echo '<a href="' . esc_url($link['href']) . '" class="lg:px-4 text-sm uppercase tracking-[3px] text-white hover:text-white/70 block">' . esc_html($link['name']) . '</a>';
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

                    <!-- Twitter -->
                    <a href="https://twitter.com/FlameriteFires" target="_blank" rel="noopener" class="lg:px-4 text-sm uppercase tracking-[3px] text-white hover:text-white/70 flex items-center gap-2 block">
                        <span class="w-6 h-6 inline-flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </span>
                        Twitter
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
            <p class="copyright">All Rights Reserved. <?php echo date('Y'); ?>.</p>
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
                        We use cookies to enhance your browsing experience, serve personalized content, and analyze our traffic.
                        By clicking "Accept All", you consent to our use of cookies. Visit our <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>" class="text-primary hover:text-primary/80 underline">Privacy Policy</a> for more information.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-2 md:gap-3">
                    <button id="cookie-policy-accept" class="bg-primary hover:bg-primary/90 text-white font-medium py-2 px-4 rounded-md transition-colors duration-300 whitespace-nowrap">
                        Accept All
                    </button>
                    <button id="cookie-policy-decline" class="bg-white/10 hover:bg-white/20 text-white font-medium py-2 px-4 rounded-md transition-colors duration-300 whitespace-nowrap border border-white/30">
                        Necessary Only
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
        const declineBtn = document.getElementById('cookie-policy-decline');
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

        // Handle accept
        function handleAccept() {
            setCookie(COOKIE_NAME, 'accepted', COOKIE_EXPIRY_DAYS);
            hideBanner();
            // Add any analytics or tracking scripts here
            console.log('Cookies accepted');
        }

        // Handle decline
        function handleDecline() {
            setCookie(COOKIE_NAME, 'necessary', COOKIE_EXPIRY_DAYS);
            hideBanner();
            console.log('Only necessary cookies accepted');
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
        if (declineBtn) {
            declineBtn.addEventListener('click', handleDecline);
        }
    })();
    </script>

    <?php wp_footer(); ?>
</body>
</html>