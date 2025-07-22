</main>

<section class="relative overflow-hidden">
    <div class="grid grid-cols-1 md:grid-cols-2">

      <!-- Left Media Side -->
        <div class="relative h-full min-h-[300px] md:min-h-[400px] hidden lg:block">
                            <img decoding="async" src="/wp-content/uploads/2025/07/AG_C222-scaled.jpg" alt="Default image" class="absolute inset-0 h-full w-full object-cover">
                    </div>

        <!-- Right Content Side -->
        <div class="px-8 py-8 md:p-12 lg:p-16 flex items-center" style="background-color: #ffffff;">
            <div class="max-w-[500px] mx-auto md:ml-0 md:mr-auto">
                  <div class="lg:p-8 rounded-lg h-full">
                    <h3 class="text-2xl font-bold mb-6 opacity-100 " data-animation="fadeUp" data-delay="200">HAVE A QUESTION?</h3>
                    <p class="mb-6 text-gray-600 opacity-100 " data-animation="fadeUp" data-delay="300">
                        If you have a question about any of our products, then please use the form to get in touch with us. Alternatively you can call us or email us using the phone/email below. We look forward to hearing from you.
                    </p>
                    
                    <form class="space-y-4 opacity-100 " data-animation="fadeUp" data-delay="400">
                        <div>
                            <label for="name" class="sr-only">Name</label>
                            <input type="text" id="name" name="name" placeholder="NAME" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-red-600">
                        </div>
                        
                        <div>
                            <label for="telephone" class="sr-only">Telephone</label>
                            <input type="tel" id="telephone" name="telephone" placeholder="TELEPHONE" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-red-600">
                        </div>
                        
                        <div>
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" id="email" name="email" placeholder="EMAIL" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-red-600">
                        </div>
                        
                        <div>
                            <label for="message" class="sr-only">Message</label>
                            <textarea id="message" name="message" rows="4" placeholder="MESSAGE" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-red-600"></textarea>
                        </div>
                        
                        <div class="flex items-center mb-4">
                            <input id="consent" type="checkbox" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-600">
                            <label for="consent" class="ml-2 text-xs text-gray-600">I AGREE FOR MY INFORMATION TO BE USED FOR MARKETING</label>
                        </div>
                        
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-8 rounded-md transition duration-300 w-auto">SUBMIT FORM</button>
                    </form>
                </div>
            </div>
        </div>
    
    </div>
    
    <!-- Background decorative elements -->
    <div class="absolute left-0 bottom-0 w-1/3 h-2/3 bg-red-100 rounded-tr-full opacity-20 z-[-1]"></div>
</section>
    
    <!-- Footer -->
    <footer class="bg-[#1b1b19] text-white py-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between">
                <div class="mb-8 md:mb-0">
                    <?php
                    $logo = get_field('site_logo', 'option');
                    if ($logo) {
                        echo '<img src="' . esc_url($logo['url']) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="h-10 mb-4">';
                    } else {
                        echo '<h3 class="text-xl font-bold mb-4">' . esc_html(get_bloginfo('name')) . '</h3>';
                    }
                    ?>
                    <p class="text-gray-400 max-w-sm">
                        Keeping your kitchen and catering facilities in optimal working order, so you can focus on what you do best.
                    </p>
                    <div class="flex space-x-4 mt-6">
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="font-bold text-lg mb-4">Company</h3>
                        <ul class="space-y-2">
                            <li><a href="/about-us/" class="text-gray-400 hover:text-white transition duration-300">About</a></li>
                            <li><a href="/faqs/" class="text-gray-400 hover:text-white transition duration-300">FAQ's</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Careers</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Contact</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="font-bold text-lg mb-4">Services</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Maintenance</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Repairs</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Installations</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Equipment Sales</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="font-bold text-lg mb-4">Contact</h3>
                        <ul class="space-y-2">
                            <li class="text-gray-400">123 Business Street</li>
                            <li class="text-gray-400">London, UK</li>
                            <li class="text-gray-400">+44 123 456 7890</li>
                            <li class="text-gray-400">info@assetmanagement.com</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">&copy; <?php echo date('Y'); ?> Asset Management by Advance. All rights reserved.</p>
                <div class="mt-4 md:mt-0">
                    <ul class="flex space-x-6 text-sm">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Terms of Service</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>


    </footer>
 <div class="acred-slider swiper-container2 px-8 block bg-white" style="height: 75px!important;">
  <div class="swiper-wrapper">
    <div class="swiper-slide">  <img src="/1.png" class="h-[50px]" /></div>
    <div class="swiper-slide">  <img src="/2.png" class="h-[50px]" /></div>
    <div class="swiper-slide">  <img src="/3.png" class="h-[50px]" /></div>
    <div class="swiper-slide">  <img src="/4.png" class="h-[50px]" /></div>
    <div class="swiper-slide">  <img src="/5.png" class="h-[50px]" /></div>
    <div class="swiper-slide">  <img src="/6.png" class="h-[50px]" /></div>
    <div class="swiper-slide">  <img src="/7.png" class="h-[50px]" /></div>
    <div class="swiper-slide">  <img src="/8.png" class="h-[50px]" /></div> 
  </div> 
</div>
</div>
</div>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
    var swiper = new Swiper('.swiper-container2', {
    slidesPerView: 6,
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    }, 
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev', 
    },
    breakpoints: {
    // when window width is >= 320px
    320: {
      slidesPerView: 1,
    },
    // when window width is >= 480px
    900: {
      slidesPerView: 2,
    },
    // when window width is >= 640px
    1024: {
      slidesPerView: 6,

    }
}
    });

    var swiper = new Swiper('#swiperjs', {
    slidesPerView: 1,
    centeredSlides: true,
    autoplay: {
        delay: 10000,
        disableOnInteraction: false,
    }, 
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.sliderjs-prev',
        prevEl: '.sliderjs-next',
    },
    });

     var swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    }, 
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    });
  </script>
  <style>
   .swiper-wrapper:not(.swiper-wrapper-test) {
    height: 180px!important;
}
.awards-slider  .swiper-slide {
    height: 117px!important;
}

.swiper-slide {
    display:flex;
    justify-content: center;
    height: 100%;
    width: 100%;
    padding:1rem 0 ;
}

.swiper-slide img {
    max-width: 300px;
}

.acred-slider {
    overflow: hidden!important;
}

.acred-slider  .swiper-slide {
    height:74px!important;
}
.acred-slider  .swiper-wrapper {
    height: 78px!important;
} 
</style>

    <script>
        AOS.init();
    </script>

    <!-- Scripts -->
    <script>
        // Mobile Menu Toggle with animation
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');
            
            const m_menuIcon = document.getElementById('m-menu-icon');
            const m_closeIcon = document.getElementById('m-close-icon');

            
            // Toggle open class for animation
            mobileMenu.classList.toggle('open');
            
            // Toggle icons
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');

            m_menuIcon.classList.toggle('hidden');
            m_closeIcon.classList.toggle('hidden');
        });

        // Mobile Menu Toggle with animation
        document.getElementById('m-mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');
            
            const m_menuIcon = document.getElementById('m-menu-icon');
            const m_closeIcon = document.getElementById('m-close-icon');

            
            // Toggle open class for animation
            mobileMenu.classList.toggle('open');
            
            // Toggle icons
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');

            m_menuIcon.classList.toggle('hidden');
            m_closeIcon.classList.toggle('hidden');
        });
        
        // FAQ Toggle
        const faqToggles = document.querySelectorAll('.faq-toggle');
        faqToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const content = this.nextElementSibling;
                const icon = this.querySelector('svg');
                
                content.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });
        });
        
        // Counter animation
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-count');
                const count = +counter.innerText;
                const increment = target / 100;
                
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 20);
                } else {
                    counter.innerText = target;
                }
            };
            
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateCount();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            observer.observe(counter);
        });

        // Initialize container queries support if the browser doesn't support it natively
        if (typeof window.container !== 'undefined') {
            // Container queries polyfill/fallback for older browsers
            document.querySelectorAll('[class*="@container"]').forEach(el => {
                // Add container context to elements that need it
                el.closest('.container-responsive').style.containerType = 'inline-size';
            });
        }
        
        // Mobile slider functionality for dot navigation
        document.addEventListener('DOMContentLoaded', function() {
            const sliders = document.querySelectorAll('.stats-slider, .customers-slider, .awards-slider');
            
            sliders.forEach(slider => {
                const dots = slider.querySelectorAll('.slider-dot');
                const grid = slider.querySelector('.grid');
                
                if (!dots.length || !grid) return;
                
                // Set first dot as active
                if (dots.length > 0) {
                    dots[0].classList.add('bg-white', 'opacity-100');
                    dots[0].classList.remove('bg-white/50');
                }
                
                dots.forEach(dot => {
                    dot.addEventListener('click', function() {
                        // Calculate scroll position based on dot index
                        const index = parseInt(this.getAttribute('data-index') || 0);
                        const containerWidth = grid.offsetWidth;
                        const scrollTo = containerWidth * index;
                        
                        // Scroll to the position
                        grid.scrollTo({
                            left: scrollTo,
                            behavior: 'smooth'
                        });
                        
                        // Update active dot
                        dots.forEach(d => {
                            d.classList.remove('bg-white', 'opacity-100');
                            d.classList.add('bg-white/50');
                        });
                        this.classList.add('bg-white', 'opacity-100');
                        this.classList.remove('bg-white/50');
                    });
                });
                
                // Update dots on scroll
                grid.addEventListener('scroll', function() {
                    const scrollPos = grid.scrollLeft;
                    const containerWidth = grid.offsetWidth;
                    const activeIndex = Math.round(scrollPos / containerWidth);
                    
                    dots.forEach((dot, i) => {
                        if (i === activeIndex) {
                            dot.classList.add('bg-white', 'opacity-100');
                            dot.classList.remove('bg-white/50');
                        } else {
                            dot.classList.remove('bg-white', 'opacity-100');
                            dot.classList.add('bg-white/50');
                        }
                    });
                });
            });
        });
    </script>
    
    <?php wp_footer(); ?>
</body>
</html>