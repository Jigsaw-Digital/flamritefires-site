<?php
/**
 * Contact Page Template
 *
 * @package SX
 */

get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <div class="bg-tertiary pb-16 pt-16 relative px-6 min-h-[calc(100vh-430px)]">
        <div class="mx-auto max-w-4xl">
            
            <!-- Page Header -->
            <div class="text-center mb-12">
                <h1 class="text-3xl lg:text-4xl xl:text-5xl font-bold text-primary mb-6">
                    <?php the_title(); ?>
                </h1>
                <?php if (get_the_content()): ?>
                    <div class="text-lg text-gray-700 max-w-2xl mx-auto">
                        <?php the_content(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                
                <!-- Contact Form -->
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-primary mb-6">Send us a Message</h2>
                    
                    <form id="contact-form" action="<?php echo admin_url('admin-post.php'); ?>" method="post" class="space-y-6">
                        <input type="hidden" name="action" value="contact_form_submit">
                        <?php wp_nonce_field('contact_form_nonce', 'contact_nonce'); ?>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    First Name *
                                </label>
                                <input type="text" 
                                       id="first_name" 
                                       name="first_name" 
                                       required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                            </div>
                            
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Last Name *
                                </label>
                                <input type="text" 
                                       id="last_name" 
                                       name="last_name" 
                                       required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                            </div>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address *
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Phone Number
                            </label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                                Subject *
                            </label>
                            <select id="subject" 
                                    name="subject" 
                                    required 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                                <option value="">Please select a subject...</option>
                                <option value="General Inquiry">General Inquiry</option>
                                <option value="Product Information">Product Information</option>
                                <option value="Quote Request">Quote Request</option>
                                <option value="Technical Support">Technical Support</option>
                                <option value="Installation Services">Installation Services</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                Message *
                            </label>
                            <textarea id="message" 
                                      name="message" 
                                      rows="6" 
                                      required 
                                      placeholder="Please tell us about your inquiry..."
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors resize-vertical"></textarea>
                        </div>
                        
                        <div class="flex items-start">
                            <input type="checkbox" 
                                   id="privacy_consent" 
                                   name="privacy_consent" 
                                   required 
                                   class="mt-1 mr-3 h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                            <label for="privacy_consent" class="text-sm text-gray-600">
                                I agree to the processing of my personal data in accordance with your privacy policy. *
                            </label>
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-primary text-white font-semibold py-3 px-6 rounded-lg hover:bg-primary/90 transition-colors focus:ring-2 focus:ring-primary focus:ring-offset-2">
                            Send Message
                        </button>
                    </form>
                    
                    <!-- Success/Error Messages -->
                    <div id="form-messages" class="mt-6">
                        <?php if (isset($_GET['contact_status']) && isset($_GET['message'])): ?>
                            <?php if ($_GET['contact_status'] === 'success'): ?>
                                <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                                    <div class="flex">
                                        <svg class="w-5 h-5 text-green-400 mr-3 mt-0.5" fill="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-check-circle"/></svg>
                                        <p class="text-green-800"><?php echo esc_html(urldecode($_GET['message'])); ?></p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                                    <div class="flex">
                                        <svg class="w-5 h-5 text-red-400 mr-3 mt-0.5" fill="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-x-circle"/></svg>
                                        <p class="text-red-800"><?php echo esc_html(urldecode($_GET['message'])); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Contact Information -->
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-primary mb-6">Get in Touch</h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-lg flex-center mr-4">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-location"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Address</h3>
                                <p class="text-gray-600">Your Business Address<br>City, State 12345<br>United Kingdom</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-lg flex-center mr-4">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-phone"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Phone</h3>
                                <p class="text-gray-600"><a href="tel:01543251122" class="hover:text-primary transition-colors">01923 923 120</a></p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-lg flex-center mr-4">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-email"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                                <p class="text-gray-600"><a href="mailto:info@flameritefires.com" class="hover:text-primary transition-colors">info@flameritefires.com</a></p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-lg flex-center mr-4">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor"><use href="<?php echo get_template_directory_uri(); ?>/assets/images/icons.svg#icon-clock"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Business Hours</h3>
                                <p class="text-gray-600">Monday - Friday: 9:00 AM - 5:00 PM<br>Saturday: 9:00 AM - 1:00 PM<br>Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endwhile; endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contact-form');
    const submitButton = form.querySelector('button[type="submit"]');
    const originalButtonText = submitButton.textContent;
    
    // Form submission handling
    form.addEventListener('submit', function(e) {
        // Show loading state
        submitButton.disabled = true;
        submitButton.textContent = 'Sending...';
        submitButton.classList.add('opacity-75');
    });
    
    // Clear URL parameters after showing message
    if (window.location.search.includes('contact_status')) {
        // Clear the URL parameters after 3 seconds
        setTimeout(function() {
            const url = new URL(window.location);
            url.searchParams.delete('contact_status');
            url.searchParams.delete('message');
            window.history.replaceState({}, document.title, url.pathname);
        }, 3000);
    }
    
    // Enhanced form validation
    const requiredFields = form.querySelectorAll('[required]');
    
    requiredFields.forEach(field => {
        field.addEventListener('blur', function() {
            validateField(this);
        });
        
        field.addEventListener('input', function() {
            if (this.classList.contains('border-red-500')) {
                validateField(this);
            }
        });
    });
    
    function validateField(field) {
        const isValid = field.checkValidity();
        
        if (!isValid || (field.type === 'email' && !isValidEmail(field.value))) {
            field.classList.add('border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
            field.classList.remove('border-gray-300', 'focus:ring-primary', 'focus:border-primary');
            showFieldError(field);
        } else {
            field.classList.remove('border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
            field.classList.add('border-gray-300', 'focus:ring-primary', 'focus:border-primary');
            hideFieldError(field);
        }
    }
    
    function showFieldError(field) {
        hideFieldError(field); // Remove existing error first
        
        let errorMessage = '';
        if (field.type === 'email') {
            errorMessage = 'Please enter a valid email address';
        } else if (field.tagName === 'SELECT') {
            errorMessage = 'Please select an option';
        } else if (field.type === 'checkbox') {
            errorMessage = 'This field is required';
        } else {
            errorMessage = 'This field is required';
        }
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'field-error text-red-600 text-sm mt-1';
        errorDiv.textContent = errorMessage;
        
        field.parentNode.appendChild(errorDiv);
    }
    
    function hideFieldError(field) {
        const existingError = field.parentNode.querySelector('.field-error');
        if (existingError) {
            existingError.remove();
        }
    }
    
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    // Phone number formatting
    const phoneField = document.getElementById('phone');
    if (phoneField) {
        phoneField.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 6) {
                if (value.length <= 10) {
                    value = value.replace(/(\d{3})(\d{3})(\d{1,4})/, '$1 $2 $3');
                } else {
                    value = value.replace(/(\d{5})(\d{3})(\d{3})/, '$1 $2 $3');
                }
            }
            e.target.value = value;
        });
    }
});
</script>

<?php get_footer(); ?>