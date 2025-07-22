<?php
/**
 * Coverage Map Template
 * 
 * Available variables:
 * - $atts: Shortcode attributes
 * - $google_maps_api_key: Google Maps API key
 * - $block_id: Unique ID for this block instance
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<?php
// Get custom settings - shortcode attributes override plugin settings
$background_image = !empty($atts['background_image']) ? $atts['background_image'] : get_option('coverage_map_background_image');
$background_color = !empty($atts['background_color']) ? $atts['background_color'] : get_option('coverage_map_background_color', '#ed1c24');
$background_opacity = !empty($atts['background_opacity']) ? $atts['background_opacity'] : get_option('coverage_map_background_opacity', '80');

// Use default image if no custom image is set
if (!$background_image) {
    $background_image = COVERAGE_MAP_PLUGIN_URL . 'assets/images/coverage.png';
}

// Convert hex color to RGB for opacity
$hex = str_replace('#', '', $background_color);
$r = hexdec(substr($hex, 0, 2));
$g = hexdec(substr($hex, 2, 2));
$b = hexdec(substr($hex, 4, 2));
$opacity = $background_opacity / 100;
?>

<section class="cm-relative cm-text-white cm-h-[70vh] cm-bg-cover cm-bg-center cm-bg-no-repeat coverage-map-section" style="background-image: url('<?php echo esc_url($background_image); ?>');">
    <div class="cm-absolute cm-inset-0" style="background-color: rgba(<?php echo $r; ?>, <?php echo $g; ?>, <?php echo $b; ?>, <?php echo $opacity; ?>);"></div>    
    <div class="cm-relative cm-z-10">
        <div class="cm-grid cm-grid-cols-1 lg:cm-grid-cols-2 cm-gap-8 cm-min-h-[70vh]">
            <!-- Left Side - Search and Results -->
           <div class="cm-grid cm-grid-cols-1 lg:cm-grid-cols-2 cm-gap-8 cm-min-h-[70vh]">
            <div class="cm-flex cm-justify-center cm-items-center">
                <img src="<?php echo COVERAGE_MAP_PLUGIN_URL; ?>assets/images/circle-lines.png" alt="" class="cm-w-[80%] cm-ml-auto cm-object-contain">
            </div>
             <div class="cm-flex cm-flex-col cm-max-w-[500px] cm-mx-auto cm-h-full cm-justify-center cm-items-center">
                <div class="cm-flex cm-flex-col">
                    <!-- Header -->
                <div class="cm-mb-8">
                    <h2 class="cm-text-4xl md:cm-text-5xl cm-mb-4"><?php echo esc_html($atts['title']); ?></h2>
                    <p class="cm-text-4xl md:cm-text-6xl cm-opacity-90 cm-font-bold"><?php echo esc_html($atts['subtitle']); ?></p>
                </div>
                
                <!-- Search Form -->
                <div class="cm-mb-8">
                    <p class="cm-text-lg cm-opacity-90 cm-font-bold cm-mb-2"><?php _e('Enter a postcode to find coverage in your area', 'coverage-map'); ?></p>
                    <form id="<?php echo $block_id; ?>-search-form" class="cm-flex cm-gap-4">
                        <div class="cm-flex-1">
                            <input 
                                type="text" 
                                id="<?php echo $block_id; ?>-postcode-input" 
                                placeholder="<?php echo esc_attr($atts['search_placeholder']); ?>"
                                class="cm-w-full cm-px-4 cm-py-3 cm-rounded-lg cm-bg-white/20 cm-backdrop-blur-sm cm-border cm-border-white/30 cm-text-white cm-placeholder-white/70 focus:cm-outline-none focus:cm-ring-2 focus:cm-ring-white/50"
                                required
                            >
                        </div>
                        <button 
                            type="submit" 
                            class="cm-px-6 cm-py-3 cm-bg-white cm-text-red-600 cm-font-bold cm-rounded-lg hover:cm-bg-gray-100 cm-transition cm-duration-300 cm-flex cm-items-center cm-gap-2"
                        >
                            <img src="<?php echo COVERAGE_MAP_PLUGIN_URL; ?>assets/images/search.png" alt="Search" class="cm-w-4 cm-h-4">
                            <?php _e('Search', 'coverage-map'); ?>
                        </button>
                    </form>
                </div>
                
                <!-- Loading State -->
                <div id="<?php echo $block_id; ?>-loading" class="cm-hidden cm-text-center cm-py-8">
                    <div class="cm-inline-block cm-animate-spin cm-rounded-full cm-h-8 cm-w-8 cm-border-b-2 cm-border-white"></div>
                    <p class="cm-mt-2"><?php _e('Searching coverage...', 'coverage-map'); ?></p>
                </div>
                
                <!-- Results -->
                <div id="<?php echo $block_id; ?>-results" class="cm-flex-1 cm-overflow-y-auto">
                    <div class="cm-text-center cm-py-16 cm-opacity-70">
                        <h3 class="cm-text-2xl cm-font-bold cm-mb-4"><?php _e('Find Your Local Engineer', 'coverage-map'); ?></h3>
                        <p><?php _e('Enter your postcode above to see coverage in your area', 'coverage-map'); ?></p>
                    </div>
                </div>
                
                <!-- Contact Info Template (hidden) -->
                <template id="<?php echo $block_id; ?>-contact-template">
                    <div class="coverage-point cm-bg-white/10 cm-backdrop-blur-sm cm-rounded-lg cm-p-4 cm-mb-4 cm-border cm-border-white/20">
                        <div class="cm-flex cm-justify-between cm-items-start cm-mb-2">
                            <h4 class="cm-font-bold cm-text-lg coverage-point-title"></h4>
                            <span class="cm-text-sm cm-opacity-75 coverage-point-distance"></span>
                        </div>
                        <div class="coverage-point-contact cm-text-sm cm-space-y-1">
                            <div class="coverage-point-contact-name cm-font-semibold"></div>
                            <div class="coverage-point-contact-phone"></div>
                            <div class="coverage-point-contact-email"></div>
                            <div class="coverage-point-description cm-opacity-90"></div>
                        </div>
                    </div>
                </template>
                </div>
            </div>
            </div>
            
            <!-- Right Side - Map -->
            <div class="cm-relative">
                <div 
                    id="<?php echo $block_id; ?>-map" 
                    class="!cm-w-full !cm-h-full cm-overflow-hidden"
                    data-lat="<?php echo esc_attr($atts['default_lat']); ?>"
                    data-lng="<?php echo esc_attr($atts['default_lng']); ?>"
                    data-zoom="<?php echo esc_attr($atts['default_zoom']); ?>"
                >
                    <div class="cm-flex cm-items-center cm-justify-center cm-h-full cm-text-white/70">
                        <div class="cm-text-center">
                            <div class="cm-w-16 cm-h-16 cm-mx-auto cm-mb-4 cm-opacity-50">
                                <svg fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                </svg>
                            </div>
                            <p><?php _e('Map will load here', 'coverage-map'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if ($google_maps_api_key): ?>
<script>
(function() {
    const blockId = '<?php echo $block_id; ?>';
    const searchForm = document.getElementById(blockId + '-search-form');
    const postcodeInput = document.getElementById(blockId + '-postcode-input');
    const loadingDiv = document.getElementById(blockId + '-loading');
    const resultsDiv = document.getElementById(blockId + '-results');
    const mapDiv = document.getElementById(blockId + '-map');
    const contactTemplate = document.getElementById(blockId + '-contact-template');
    
    let map;
    let markers = [];
    let infoWindows = [];
    
    // Initialize Google Map
    function initMap() {
        const defaultLat = parseFloat(mapDiv.dataset.lat);
        const defaultLng = parseFloat(mapDiv.dataset.lng);
        const defaultZoom = parseInt(mapDiv.dataset.zoom);
        
        map = new google.maps.Map(mapDiv, {
            center: { lat: defaultLat, lng: defaultLng },
            zoom: defaultZoom,
            styles: [
                {
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#212121"
                        }
                    ]
                },
                {
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ed1c24"
                        },
                        {
                            "weight": 0.5
                        }
                    ]
                },
                {
                    "elementType": "labels",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#757575"
                        }
                    ]
                },
                {
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "color": "#212121"
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#757575"
                        },
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "administrative.country",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#9e9e9e"
                        }
                    ]
                },
                {
                    "featureType": "administrative.land_parcel",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "administrative.locality",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#bdbdbd"
                        }
                    ]
                },
                {
                    "featureType": "administrative.neighborhood",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#757575"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#181818"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#616161"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "color": "#1b1b1b"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#2c2c2c"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#8a8a8a"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#373737"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#3c3c3c"
                        }
                    ]
                },
                {
                    "featureType": "road.highway.controlled_access",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#4e4e4e"
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#616161"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#757575"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#000000"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#414042"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#3d3d3d"
                        }
                    ]
                }
            ]
        });
    }
    
    // Clear existing markers
    function clearMarkers() {
        markers.forEach(marker => marker.setMap(null));
        infoWindows.forEach(infoWindow => infoWindow.close());
        markers = [];
        infoWindows = [];
    }
    
    // Add marker to map
    function addMarker(point, isSearchLocation = false) {
        const marker = new google.maps.Marker({
            position: { lat: parseFloat(point.lat), lng: parseFloat(point.lng) },
            map: map,
            title: point.title || 'Location',
            icon: isSearchLocation ? {
                url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="8" fill="#dc2626" stroke="#ffffff" stroke-width="2"/>
                        <circle cx="12" cy="12" r="3" fill="#ffffff"/>
                    </svg>
                `),
                scaledSize: new google.maps.Size(32, 32)
            } : {
                url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5 2.5-1.12 2.5-2.5 2.5z" fill="#ffffff" stroke="#dc2626" stroke-width="1"/>
                    </svg>
                `),
                scaledSize: new google.maps.Size(32, 32)
            }
        });
        
        if (!isSearchLocation) {
            const infoWindow = new google.maps.InfoWindow({
                content: `
                    <div class="p-3">
                        <h4 class="font-bold text-gray-800 mb-2">${point.title}</h4>
                        <div class="text-sm space-y-1 text-black">
                            ${point.region ? `<div class="text-black">${point.region}</div>` : ''}
                            ${point.subsidence_claims ? `<div><strong class="text-gray-800 "><?php _e('Subsidence Claims:', 'coverage-map'); ?></strong> ${point.subsidence_claims}</div>` : ''}
                            ${point.contact_name ? `<div><strong class="text-gray-800 "><?php _e('Engineer:', 'coverage-map'); ?></strong> ${point.contact_name}</div>` : ''}
                            ${point.contact_phone ? `<div><strong class="text-gray-800 "><?php _e('Phone:', 'coverage-map'); ?></strong> <a href="tel:${point.contact_phone}" class="text-blue-600">${point.contact_phone}</a></div>` : ''}
                            ${point.contact_email ? `<div><strong class="text-gray-800 "><?php _e('Email:', 'coverage-map'); ?></strong> <a href="mailto:${point.contact_email}" class="text-blue-600">${point.contact_email}</a></div>` : ''}
                            ${point.description ? `<div class="mt-2 text-black text-gray-800">${point.description}</div>` : ''}
                            <div class="mt-2"><strong class="text-gray-800 "><?php _e('Distance:', 'coverage-map'); ?></strong> ${point.distance} <?php _e('miles', 'coverage-map'); ?></div>
                        </div>
                    </div>
                `
            });
            
            marker.addListener('click', () => {
                infoWindows.forEach(iw => iw.close());
                infoWindow.open(map, marker);
            });
            
            infoWindows.push(infoWindow);
        }
        
        markers.push(marker);
        return marker;
    }
    
    // Handle search form submission
    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const postcode = postcodeInput.value.trim();
        if (!postcode) return;
        
        // Show loading state
        loadingDiv.classList.remove('cm-hidden');
        resultsDiv.innerHTML = '';
        
        // Make AJAX request
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'coverage_map_lookup_postcode',
                postcode: postcode,
                nonce: '<?php echo wp_create_nonce('coverage_map_nonce'); ?>'
            })
        })
        .then(response => response.json())
        .then(data => {
            loadingDiv.classList.add('cm-hidden');
            
            if (data.success) {
                displayResults(data.data);
            } else {
                resultsDiv.innerHTML = `
                    <div class="cm-text-center cm-py-8">
                        <h3 class="cm-text-xl cm-font-bold cm-mb-2 cm-text-red-200"><?php _e('No Coverage Found', 'coverage-map'); ?></h3>
                        <p><?php _e('Sorry, we couldn\'t find any engineers in your area. Please try a different postcode.', 'coverage-map'); ?></p>
                    </div>
                `;
            }
        })
        .catch(error => {
            loadingDiv.classList.add('cm-hidden');
            resultsDiv.innerHTML = `
                <div class="cm-text-center cm-py-8">
                    <h3 class="cm-text-xl cm-font-bold cm-mb-2 cm-text-red-200"><?php _e('Error', 'coverage-map'); ?></h3>
                    <p><?php _e('There was an error searching for coverage. Please try again.', 'coverage-map'); ?></p>
                </div>
            `;
        });
    });
    
    // Display search results
    function displayResults(data) {
        clearMarkers();
        
        if (data.coverage_points.length === 0) {
            resultsDiv.innerHTML = `
                <div class="cm-text-center cm-py-8">
                    <h3 class="cm-text-xl cm-font-bold cm-mb-2 cm-text-red-200"><?php _e('No Coverage Found', 'coverage-map'); ?></h3>
                    <p><?php _e('Sorry, we couldn\'t find any engineers within 30 miles of your location.', 'coverage-map'); ?></p>
                </div>
            `;
            return;
        }
        
        // Update map center to search location
        const searchLocation = { lat: data.postcode_lat, lng: data.postcode_lng };
        map.setCenter(searchLocation);
        map.setZoom(10);
        
        // Add search location marker
        addMarker({
            lat: data.postcode_lat,
            lng: data.postcode_lng,
            title: '<?php _e('Your Search Location', 'coverage-map'); ?>'
        }, true);
        
        // Display results
        let resultsHTML = `
            <div class="cm-mb-6">
                <h3 class="cm-text-2xl cm-font-bold cm-mb-2"><?php _e('Engineers Near You', 'coverage-map'); ?></h3>
                <p class="cm-opacity-90"><?php _e('Found', 'coverage-map'); ?> ${data.coverage_points.length} <?php _e('engineer', 'coverage-map'); ?>${data.coverage_points.length !== 1 ? 's' : ''} <?php _e('within 30 miles', 'coverage-map'); ?></p>
            </div>
        `;
        
        data.coverage_points.forEach(point => {
            // Add marker to map
            addMarker(point);
            
            // Add to results list
            resultsHTML += `
                <div class="coverage-point cm-bg-white/10 cm-backdrop-blur-sm cm-rounded-lg cm-p-4 cm-mb-4 cm-border cm-border-white/20 cm-cursor-pointer hover:cm-bg-white/20 cm-transition cm-duration-300" data-lat="${point.lat}" data-lng="${point.lng}">
                    <div class="cm-flex cm-justify-between cm-items-start cm-mb-2">
                        <h4 class="cm-font-bold cm-text-lg">${point.title}</h4>
                        <span class="cm-text-sm cm-opacity-75">${point.distance} <?php _e('miles', 'coverage-map'); ?></span>
                    </div>
                    <div class="cm-text-sm cm-space-y-1">
                        ${point.region ? `<div class="cm-text-xs cm-opacity-75">${point.region}</div>` : ''}
                        ${point.subsidence_claims ? `<div class="cm-text-sm"><strong><?php _e('Subsidence Claims:', 'coverage-map'); ?></strong> ${point.subsidence_claims}</div>` : ''}
                        ${point.contact_name ? `<div class="cm-font-semibold">${point.contact_name}</div>` : ''}
                        ${point.contact_phone ? `<div><a href="tel:${point.contact_phone}" class="hover:cm-text-red-200">${point.contact_phone}</a></div>` : ''}
                        ${point.contact_email ? `<div><a href="mailto:${point.contact_email}" class="hover:cm-text-red-200">${point.contact_email}</a></div>` : ''}
                        ${point.description ? `<div class="cm-opacity-90 cm-mt-2">${point.description}</div>` : ''}
                    </div>
                </div>
            `;
        });
        
        resultsDiv.innerHTML = resultsHTML;
        
        // Add click handlers to results
        resultsDiv.querySelectorAll('.coverage-point').forEach((element, index) => {
            element.addEventListener('click', () => {
                const lat = parseFloat(element.dataset.lat);
                const lng = parseFloat(element.dataset.lng);
                map.setCenter({ lat, lng });
                map.setZoom(15);
                
                // Open corresponding info window
                if (infoWindows[index]) {
                    infoWindows.forEach(iw => iw.close());
                    infoWindows[index].open(map, markers[index + 1]); // +1 because first marker is search location
                }
            });
        });
    }
    
    // Initialize map when Google Maps API is ready
    window['initCoverageMap' + blockId] = initMap;
    
    // Load Google Maps API
    if (!window.google || !window.google.maps) {
        const script = document.createElement('script');
        script.src = `https://maps.googleapis.com/maps/api/js?key=<?php echo esc_js($google_maps_api_key); ?>&callback=initCoverageMap${blockId}`;
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);
    } else {
        initMap();
    }
})();
</script>
<?php else: ?>
<script>
console.warn('<?php _e('Google Maps API key is required for the coverage map to function. Please configure it in the plugin settings.', 'coverage-map'); ?>');
</script>
<?php endif; ?>