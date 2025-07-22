    </main>

    <div class="print:hidden pt-16 pb-16 bg-primary overflow-hidden">
        <div class="max-w-7xl mx-auto lg:flex justify-between px-6 lg:px-0">
            <div class="w-[200px] xl:w-[300px] max-w-[400px]">
                <?php 
                $site_logo = get_field('site_logo', 'option');
                if ($site_logo) {
                    echo '<img src="' . esc_url($site_logo['url']) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
                } else {
                    echo '<img src="' . get_template_directory_uri() . '/assets/images/logo.png" alt="Greycaine">';
                }
                ?>
            </div>
            <div class="flex flex-wrap gap-12 mt-8 lg:mt-0">
                <div class="space-y-2">
                    <h3 class="font-semibold lg:px-4 mb-3 uppercase text-white">Pages</h3>
                    <?php
                    $pages_links = array(
                        array('name' => 'Home', 'href' => home_url('/')),
                        array('name' => 'Products', 'href' => home_url('/products')),
                        array('name' => 'Contact', 'href' => home_url('/contact-us')),
                        array('name' => 'Showroom', 'href' => home_url('/showroom'))
                    );
                    
                    foreach ($pages_links as $link) {
                        echo '<a href="' . esc_url($link['href']) . '" class="lg:px-4 text-sm uppercase tracking-[6px] text-white hover:text-white/70 block">' . esc_html($link['name']) . '</a>';
                    }
                    ?>
                </div>

                <div class="space-y-2">
                    <h3 class="font-semibold lg:px-4 mb-3 uppercase text-white">Other</h3>
                    <?php
                    $other_links = array(
                        array('name' => 'Bespoke', 'href' => home_url('/bespoke')),
                        array('name' => 'About Us', 'href' => home_url('/about-us')),
                        array('name' => 'Trade Account', 'href' => home_url('/trade')),
                        array('name' => 'Privacy Policy', 'href' => home_url('/privacy-policy'))
                    );
                    
                    foreach ($other_links as $link) {
                        echo '<a href="' . esc_url($link['href']) . '" class="lg:px-4 text-sm uppercase tracking-[6px] text-white hover:text-white/70 block">' . esc_html($link['name']) . '</a>';
                    }
                    ?>
                </div>

                <div class="space-y-2">
                    <h3 class="font-semibold lg:px-4 mb-3 uppercase text-white">Follow Us</h3>
                    <a href="https://instagram.com/greycaine" target="_blank" rel="noopener noreferrer" class="lg:px-4 text-sm uppercase tracking-[6px] text-white hover:text-white/70 flex items-center gap-2 block">
                        <span class="w-6 h-6 inline-flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        Instagram
                    </a>
                    <a href="https://pinterest.com/greycaine" target="_blank" rel="noopener noreferrer" class="lg:px-4 text-sm uppercase tracking-[6px] text-white hover:text-white/70 flex items-center gap-2 block">
                        <span class="w-6 h-6 inline-flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.39 18.592.026 11.985.026L12.017 0z" />
                            </svg>
                        </span>
                        Pinterest
                    </a>
                </div>
            </div>
        </div>
        <div class="max-w-7xl px-6 lg:px-0 mx-auto flex flex-col sm:flex-row justify-between items-center text-white/60 mt-8 lg:mt-16 text-sm">
            <p class="copyright">All Rights Reserved. <?php echo date('Y'); ?>.</p>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>