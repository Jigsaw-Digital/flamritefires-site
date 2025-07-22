<?php
/**
 * Hero Section Layout
 *
 * @package SX
 */

// Block fields
$title = get_field('title') ?: 'While you prepare';
$subtitle = (is_page(5)) ? 'providing peace of mind' : get_field('subtitle');
$cta_primary = get_field('cta_primary');
$cta_secondary = get_field('cta_secondary');
$background_image = get_field('background_image');
?>

<section class="relative text-white h-[30vh] lg:h-[70vh]">
    <div class="container mx-auto px-4 py-32 flex flex-row justify-between items-center h-full">
        <div class="w-full md:w-1/2 lg:w-5/12"> 
            <h1 class="text-4xl md:text-6xl font-bold mb-4 opacity-100" data-animation="fadeUp">
                <?php echo esc_html($title); ?><br>
                <span class="text-3xl md:text-5xl font-normal"><?php echo esc_html($subtitle); ?></span>
            </h1>
            
            <div class="mt-6 flex flex-col gap-4 opacity-100" data-animation="fadeUp" data-delay="200">
                <?php if ($cta_primary){ ?>
                <a href="<?php echo esc_url($cta_primary['url']); ?>" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-full transition duration-300 uppercase tracking-widest text-center">
                    <?php echo esc_html($cta_primary['title']); ?>
                </a>
                <?php } ?>
                
                <?php if ($cta_secondary){?>
                <a href="<?php echo esc_url($cta_secondary['url']); ?>" class="bg-black hover:bg-black-700 text-white font-bold py-3 px-8 rounded-full transition duration-300 uppercase tracking-widest text-center">
                    <?php echo esc_html($cta_secondary['title']); ?>
                </a>
                <?php } ?>
            </div>
        </div>
        
        <!-- Contact Form with backdrop blur -->
        <div class="hidden md:block w-full md:w-1/2 lg:w-5/12 opacity-100 " data-animation="fadeUp" data-delay="400">
            <div class="bg-white/20 backdrop-blur-md p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-bold mb-4">Contact Us</h3>
                <form id="hero-contact-form" class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium mb-1">Name</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 bg-white/30 backdrop-blur-sm border border-white/30 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 bg-white/30 backdrop-blur-sm border border-white/30 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600" required>
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium mb-1">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 bg-white/30 backdrop-blur-sm border border-white/30 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600" required>
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium mb-1">Message</label>
                        <textarea id="message" name="message" rows="3" class="w-full px-4 py-2 bg-white/30 backdrop-blur-sm border border-white/30 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600" required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <?php if ($background_image) : ?>
    <div class="absolute inset-0 z-[-1]">
        <img src="<?php echo esc_url($background_image['url']); ?>" alt="<?php echo esc_attr($background_image['alt']); ?>" class="w-full h-full object-cover opacity-100">
    </div>
    <?php else : ?>
    <div class="absolute inset-0 z-[-1]">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero.png" alt="Kitchen background" class="w-full h-full object-cover opacity-100">
    </div>
    <?php endif; ?>
    
    <div class="absolute inset-0 z-[-1]">
      <div class="w-full h-full object-cover opacity-20 bg-black"></div>
    </div>
</section>