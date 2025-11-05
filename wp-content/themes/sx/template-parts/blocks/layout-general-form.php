<?php
/**
 * Layout General Form Block Template
 */

$data = get_field('layout_general_form_data');
$form_type = $data['form_type'] ?? 'download-brochure';
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

        <!-- Form Container -->
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg p-8">
            <?php if ($form_type === 'download-brochure'): ?>
                <!-- Download Brochure Form -->
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
            <?php elseif ($form_type === 'where-to-buy'): ?>
                <!-- Where to Buy Form -->
                <iframe
                    src="https://api.leadconnectorhq.com/widget/form/ADxQOaLUD4qr1znHzjkr"
                    style="width:100%;height:1292px;border:none;border-radius:3px"
                    id="inline-ADxQOaLUD4qr1znHzjkr"
                    data-layout="{'id':'INLINE'}"
                    data-trigger-type="alwaysShow"
                    data-trigger-value=""
                    data-activation-type="alwaysActivated"
                    data-activation-value=""
                    data-deactivation-type="neverDeactivate"
                    data-deactivation-value=""
                    data-form-name="Where to Buy"
                    data-height="1292"
                    data-layout-iframe-id="inline-ADxQOaLUD4qr1znHzjkr"
                    data-form-id="ADxQOaLUD4qr1znHzjkr"
                    title="Where to Buy">
                </iframe>
            <?php endif; ?>
        </div>
    </div>
</section>

<script src="https://link.msgsndr.com/js/form_embed.js"></script>
