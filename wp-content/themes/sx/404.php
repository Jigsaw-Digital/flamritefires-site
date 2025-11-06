<?php
/**
 * 404 Error Page Template
 */

get_header();
?>

<section class="bg-tertiary min-h-[calc(100vh-430px)] flex items-center justify-center px-6 py-16">
    <div class="mx-auto max-w-[800px] text-center">
        <!-- 404 Number -->
        <div class="mb-8">
            <h1 class="text-[120px] lg:text-[200px] font-bold text-primary leading-none">404</h1>
        </div>

        <!-- Error Message -->
        <div class="space-y-6">
            <h2 class="text-3xl lg:text-4xl font-bold text-[#1e2938]">
                Page Not Found
            </h2>

            <p class="text-lg text-[#1e2938]/80 max-w-[600px] mx-auto">
                Sorry, the page you are looking for doesn't exist or has been moved. Please check the URL or return to the homepage.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
                <a href="<?php echo home_url('/'); ?>"
                   class="inline-block bg-primary text-white font-semibold px-8 py-3 rounded-lg hover:bg-primary/90 transition-colors">
                    Return to Homepage
                </a>

                <a href="<?php echo home_url('/contact-us'); ?>"
                   class="inline-block border-2 border-primary text-primary font-semibold px-8 py-3 rounded-lg hover:bg-primary hover:text-white transition-colors">
                    Contact Us
                </a>
            </div>

            <!-- Search Box -->
            <div class="mt-12">
                <form role="search" method="get" action="<?php echo home_url('/'); ?>" class="max-w-[500px] mx-auto">
                    <div class="relative">
                        <input type="search"
                               name="s"
                               placeholder="Search our site..."
                               class="w-full px-6 py-4 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                               value="<?php echo get_search_query(); ?>">
                        <button type="submit"
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary/90 transition-colors">
                            Search
                        </button>
                    </div>
                </form>
            </div>

            <!-- Popular Links -->
            <div class="mt-12 pt-12 border-t border-gray-300">
                <h3 class="text-xl font-semibold text-[#1e2938] mb-6">
                    Popular Pages
                </h3>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="<?php echo home_url('/e-fx-built-in-fires'); ?>"
                       class="text-primary hover:text-primary/80 transition-colors">
                        E-FX Built-In Fires
                    </a>
                    <a href="<?php echo home_url('/e-fx-fireplace-suites'); ?>"
                       class="text-primary hover:text-primary/80 transition-colors">
                        E-FX Fireplace Suites
                    </a>
                    <a href="<?php echo home_url('/hearth-inset-fires'); ?>"
                       class="text-primary hover:text-primary/80 transition-colors">
                        Hearth Inset Fires
                    </a>
                    <a href="<?php echo home_url('/e-ridium-holographic-fires'); ?>"
                       class="text-primary hover:text-primary/80 transition-colors">
                        E-Ridium Holographic Fires
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>
