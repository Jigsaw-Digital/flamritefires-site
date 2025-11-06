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
                            <p class="text-gray-700">Two extra years at a one off cost of £90 inc VAT (Total of Five years)</p>
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
            <div>
                <iframe
                    src="https://api.leadconnectorhq.com/widget/form/UIw9jZxZdx10Lp7NRilw"
                    style="width:100%;height:100%;border:none;border-radius:3px"
                    id="inline-UIw9jZxZdx10Lp7NRilw"
                    data-layout="{'id':'INLINE'}"
                    data-trigger-type="alwaysShow"
                    data-trigger-value=""
                    data-activation-type="alwaysActivated"
                    data-activation-value=""
                    data-deactivation-type="neverDeactivate"
                    data-deactivation-value=""
                    data-form-name="Extended Warranty"
                    data-height="1292"
                    data-layout-iframe-id="inline-UIw9jZxZdx10Lp7NRilw"
                    data-form-id="UIw9jZxZdx10Lp7NRilw"
                    title="Extended Warranty">
                </iframe>
            </div>
        </div>
    </div>
</section>