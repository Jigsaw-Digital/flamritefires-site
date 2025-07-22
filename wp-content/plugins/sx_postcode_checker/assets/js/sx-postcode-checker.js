(function($) {
    'use strict';
    
    // Global variables
    let map = null;
    let marker = null;
    let infoWindow = null;
    
    $(document).ready(function() {
        // Initialize map
        initializeMap();
        
        // Attach event listeners
        $('#sx-search-button').on('click', handleSearch);
        $('#sx-postcode-input').on('keypress', function(e) {
            if (e.which === 13) {
                handleSearch();
            }
        });
    });
    
    /**
     * Initialize Google Map
     */
    function initializeMap() {
        const options = sx_postcode_checker.options;
        const mapZoom = parseInt(options.map_zoom, 10);
        
        // Default center (UK)
        const mapOptions = {
            center: { lat: 54.7023545, lng: -3.2765753 },
            zoom: 6,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: true,
            scrollwheel: false,
            streetViewControl: false
        };
        
        map = new google.maps.Map(document.getElementById('sx-map'), mapOptions);
        infoWindow = new google.maps.InfoWindow();
    }
    
    /**
     * Handle search button click
     */
    function handleSearch() {
        const postcode = $('#sx-postcode-input').val().trim();
        
        if (!postcode) {
            showError('Please enter a valid postcode');
            return;
        }
        
        // Clear previous errors
        $('#sx-search-error').text('');
        
        // Show loading state
        $('#sx-search-button').prop('disabled', true).text('Searching...');
        
        // Make AJAX request
        $.ajax({
            url: sx_postcode_checker.ajax_url,
            type: 'POST',
            data: {
                action: 'sx_postcode_search',
                nonce: sx_postcode_checker.nonce,
                postcode: postcode
            },
            success: function(response) {
                $('#sx-search-button').prop('disabled', false).text('Search');
                
                if (response.success) {
                    displayResults(response.data);
                } else {
                    showError(response.data);
                }
            },
            error: function() {
                $('#sx-search-button').prop('disabled', false).text('Search');
                showError('An error occurred. Please try again.');
            }
        });
    }
    
    /**
     * Display error message
     */
    function showError(message) {
        $('#sx-search-error').text(message);
    }
    
    /**
     * Display search results
     */
    function displayResults(data) {
        const options = sx_postcode_checker.options;
        
        // Show results container
        $('.sx-results-container').show();
        
        // Set map center and zoom
        const latLng = new google.maps.LatLng(data.latitude, data.longitude);
        map.setCenter(latLng);
        map.setZoom(parseInt(options.map_zoom, 10));
        
        // Remove existing marker if any
        if (marker) {
            marker.setMap(null);
        }
        
        // Create new marker
        marker = new google.maps.Marker({
            position: latLng,
            map: map,
            title: options.marker_title.replace('{count}', data.count)
        });
        
        // Create info window content
        let infoWindowContent = options.info_window_template
            .replace('{postcode}', data.postcode)
            .replace('{count}', data.count);
        
        // If we have a custom message from the CSV, use it
        if (data.message && data.message.length > 0) {
            infoWindowContent = `<div class="sx-info-window">
                <h4>Postcode: ${data.postcode}</h4>
                <p>Subsidence Projects: ${data.count}</p>
                <div class="sx-custom-message">${data.message}</div>
            </div>`;
        }
        
        // Set info window content and open it
        infoWindow.setContent(infoWindowContent);
        infoWindow.open(map, marker);
        
        // Set location info content
        let locationInfoContent = `
            <h3>Postcode: ${data.postcode}</h3>
            <p>We have worked on <strong>${data.count}</strong> subsidence projects in your area.</p>
            <p>Our team has extensive experience with properties in your location and understands the local geology and subsidence risks.</p>
            <p><a href="/locations/${data.postcode.substring(0, 2).toLowerCase()}" class="sx-cta-button">View Projects in Your Area</a></p>
        `;
        
        // If we have a title from the CSV, use it in the content
        if (data.title && data.title !== data.postcode) {
            locationInfoContent = `
                <h3>${data.title}</h3>
                <p>We have worked on <strong>${data.count}</strong> subsidence projects in this area.</p>
                <p>Our team has extensive experience with properties in this location and understands the local geology and subsidence risks.</p>
                <p><a href="/locations/${data.postcode.substring(0, 2).toLowerCase()}" class="sx-cta-button">View Projects in This Area</a></p>
            `;
        }
        
        $('#sx-location-info').html(locationInfoContent);
        
        // Add click listener to marker
        google.maps.event.addListener(marker, 'click', function() {
            infoWindow.open(map, marker);
        });
    }
})(jQuery);