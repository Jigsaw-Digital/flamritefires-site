<div class="sx-postcode-checker-container">
    <div class="sx-postcode-search-container">
        <div class="sx-search-box">
            <input type="text" id="sx-postcode-input" placeholder="Enter your postcode" />
            <button id="sx-search-button">Search</button>
        </div>
        <div id="sx-search-error" class="sx-error-message"></div>
    </div>
    
    <div class="sx-results-container" style="display: none;">
        <div class="sx-map-container">
            <div id="sx-map" style="height: <?php echo esc_attr($attributes['map_height']); ?>;"></div>
        </div>
        
        <div class="sx-location-info-container">
            <div id="sx-location-info">
                <!-- Location info will be dynamically populated here -->
            </div>
        </div>
    </div>
</div>