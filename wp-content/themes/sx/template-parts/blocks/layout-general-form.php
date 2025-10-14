<?php
/**
 * Layout General Form Block Template
 */

$data = get_field('layout_general_form_data');
?>

<section class="bg-tertiary pb-16 pt-16 relative px-6 min-h-[calc(100vh-430px)]">
    <div class="mx-auto max-w-[1200px]">

        <!-- Block Header -->
        <?php if (!empty($data['title'])): ?>
            <div class="text-center mb-12">
                <h1 class="text-3xl lg:text-4xl xl:text-5xl font-bold text-primary mb-6">
                    <?php echo esc_html($data['title']); ?>
                </h1>
                <?php if (!empty($data['description'])): ?>
                    <div class="text-lg text-gray-700 max-w-2xl mx-auto">
                        <?php echo wp_kses_post($data['description']); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Form Type Selector -->
        <div class="max-w-3xl mx-auto mb-8">
            <label for="formTypeSelect" class="block text-lg font-semibold text-primary mb-3">
                Select Form Type
            </label>
            <select id="formTypeSelect"
                    class="w-full px-4 py-3 border-2 border-primary rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-lg">
                <option value="">Please select...</option>
                <option value="download-brochure">Download a Brochure</option>
            </select>
        </div>

        <!-- Form Container -->
        <div id="formContainer" class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg p-8 hidden">
            <!-- Download Brochure Form -->
            <div id="downloadBrochureForm" class="form-content hidden">
                <iframe
                    src="https://api.leadconnectorhq.com/widget/form/ssScBGTkUfO0ddTPycRS"
                    style="width:100%;height:1292px;border:none;border-radius:3px"
                    id="inline-ssScBGTkUfO0ddTPycRS"
                    data-layout="{'id':'INLINE'}"
                    data-trigger-type="alwaysShow"
                    data-trigger-value=""
                    data-activation-type="alwaysActivated"
                    data-activation-value=""
                    data-deactivation-type="neverDeactivate"
                    data-deactivation-value=""
                    data-form-name="Download Brochure"
                    data-height="1292"
                    data-layout-iframe-id="inline-ssScBGTkUfO0ddTPycRS"
                    data-form-id="ssScBGTkUfO0ddTPycRS"
                    title="Download Brochure">
                </iframe>
            </div>
        </div>

        <!-- Empty State -->
        <div id="emptyState" class="max-w-3xl mx-auto text-center py-16">
            <svg class="w-24 h-24 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p class="text-xl text-gray-500">Please select a form type from the dropdown above</p>
        </div>
    </div>
</section>

<script src="https://link.msgsndr.com/js/form_embed.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const formTypeSelect = document.getElementById('formTypeSelect');
    const formContainer = document.getElementById('formContainer');
    const emptyState = document.getElementById('emptyState');
    const downloadBrochureForm = document.getElementById('downloadBrochureForm');

    formTypeSelect.addEventListener('change', function() {
        const selectedValue = this.value;

        // Hide all forms first
        const allForms = document.querySelectorAll('.form-content');
        allForms.forEach(form => form.classList.add('hidden'));

        if (selectedValue === '') {
            // Show empty state
            formContainer.classList.add('hidden');
            emptyState.classList.remove('hidden');
        } else {
            // Hide empty state and show container
            emptyState.classList.add('hidden');
            formContainer.classList.remove('hidden');

            // Show the selected form
            if (selectedValue === 'download-brochure') {
                downloadBrochureForm.classList.remove('hidden');
            }
        }

        // Smooth scroll to form
        if (selectedValue !== '') {
            setTimeout(() => {
                formContainer.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 100);
        }
    });
});
</script>
