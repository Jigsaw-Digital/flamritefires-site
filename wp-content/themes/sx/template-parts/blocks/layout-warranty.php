<?php
/**
 * Layout Warranty Block Template
 */

$data = get_field('layout_warranty_data');
?>

<section class="bg-tertiary pb-16 pt-16 relative px-6 min-h-[calc(100vh-430px)]">
    <div class="mx-auto max-w-[1200px]">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            <!-- Warranty Information -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-primary mb-6">Flamerite Products</h2>

                <div class="space-y-6">
                    <p class="text-gray-700 leading-relaxed">
                        All Flamerite Products include a full two year warranty* as standard.
                    </p>

                    <div class="space-y-3">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-2 h-2 bg-primary rounded-full mt-2 mr-3"></div>
                            <p class="text-gray-700">Two years full warranty including call out and parts</p>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-2 h-2 bg-primary rounded-full mt-2 mr-3"></div>
                            <p class="text-gray-700">Third year (One extra year free of charge if you register your product)</p>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-2 h-2 bg-primary rounded-full mt-2 mr-3"></div>
                            <p class="text-gray-700">Two extra years at a one off cost of £75 + VAT (Total of Five years)</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">
                            * This excludes Ireland and Northern Ireland. One Year full warranty with the remaining years covering parts only.
                        </p>
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="font-semibold text-gray-900 mb-4">Extended Warranty Terms & Conditions</h3>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p>• Extended warranty must be purchased within 30 days of purchase/installation date.</p>
                            <p>• 14 day cooling off period.</p>
                            <p>• Customer's responsibility to provide purchase details/policy number at request.</p>
                            <p>• One warranty per product.</p>
                            <p>• Non-transferrable</p>
                            <p>• Electrical warranty only.</p>
                            <p>• Repaired or replaced parts are only covered for the remainder of the warranty.</p>
                            <p>• Warranty becomes invalid if unauthorized repairs are made to the product.</p>
                            <p>• Engineer must be able to gain access Mon-Fri 8am-5pm. No weekends.</p>
                            <p>• UK mainland only</p>
                        </div>

                        <h4 class="font-semibold text-gray-900 mt-4 mb-2">Warranty does not cover:</h4>
                        <div class="space-y-1 text-sm text-gray-600">
                            <p>• Bulbs or Fuses</p>
                            <p>• Removal and re-installation costs</p>
                            <p>• Issues with mains/spur connections or power supply</p>
                            <p>• Cosmetic damage to fire or fireplace</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Warranty Form -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-primary mb-6">Apply Today</h2>
                <p class="text-gray-600 mb-6">Please fill in your contact and product information below.</p>

                <form id="warranty-form" action="<?php echo admin_url('admin-post.php'); ?>" method="post" class="space-y-6">
                    <input type="hidden" name="action" value="warranty_form_submit">
                    <?php wp_nonce_field('warranty_form_nonce', 'warranty_nonce'); ?>

                    <div>
                        <label for="fire_product" class="block text-sm font-medium text-gray-700 mb-2">
                            Select your fire *
                        </label>
                        <select id="fire_product"
                                name="fire_product"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                            <option value="">Please select your fire...</option>
                            <option value="Electric Fire">Electric Fire</option>
                            <option value="Gas Fire">Gas Fire</option>
                            <option value="Electric Suite">Electric Suite</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Name *
                        </label>
                        <input type="text"
                               id="customer_name"
                               name="customer_name"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                    </div>

                    <div>
                        <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email *
                        </label>
                        <input type="email"
                               id="customer_email"
                               name="customer_email"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                    </div>

                    <div>
                        <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Telephone *
                        </label>
                        <input type="tel"
                               id="customer_phone"
                               name="customer_phone"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                    </div>

                    <div>
                        <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-2">
                            Address *
                        </label>
                        <input type="text"
                               id="customer_address"
                               name="customer_address"
                               required
                               placeholder="Address Line 1"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors mb-3">
                        <input type="text"
                               id="customer_address_2"
                               name="customer_address_2"
                               placeholder="Address Line 2 (Optional)"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="customer_town" class="block text-sm font-medium text-gray-700 mb-2">
                                Town/City *
                            </label>
                            <input type="text"
                                   id="customer_town"
                                   name="customer_town"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                        </div>

                        <div>
                            <label for="customer_postcode" class="block text-sm font-medium text-gray-700 mb-2">
                                Postcode *
                            </label>
                            <input type="text"
                                   id="customer_postcode"
                                   name="customer_postcode"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg text-sm text-gray-600">
                        <p class="mb-2">The data collected by this form allows our support team to communicate with you and provide assistance. Please check our privacy policy to see how we protect and manage your submitted data.</p>
                        <p>By submitting this form I consent to having this website store my submitted information for the purpose of dealing with my enquiry.</p>
                    </div>

                    <button type="submit"
                            class="w-full bg-primary text-white font-semibold py-3 px-6 rounded-lg hover:bg-primary/90 transition-colors focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        Send Warranty Request
                    </button>
                </form>

                <!-- Success/Error Messages -->
                <div id="warranty-form-messages" class="mt-6">
                    <?php if (isset($_GET['warranty_status']) && isset($_GET['message'])): ?>
                        <?php if ($_GET['warranty_status'] === 'success'): ?>
                            <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-green-400 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-green-800"><?php echo esc_html(urldecode($_GET['message'])); ?></p>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-red-400 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-red-800"><?php echo esc_html(urldecode($_GET['message'])); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <!-- Additional Information -->
                <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <h3 class="font-semibold text-blue-900 mb-2">Next Steps</h3>
                    <p class="text-sm text-blue-800">
                        Flamerite will be in contact by phone within 72 hours of receiving this form. Payment must be taken over the phone via Debit/Credit card. Alternatively post a cheque for the full amount to the address below, made payable to Flamerite Fires Ltd. You will then receive an email or letter from us confirming your purchase and details of your extended warranty.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('warranty-form');
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
    if (window.location.search.includes('warranty_status')) {
        // Clear the URL parameters after 3 seconds
        setTimeout(function() {
            const url = new URL(window.location);
            url.searchParams.delete('warranty_status');
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
    const phoneField = document.getElementById('customer_phone');
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