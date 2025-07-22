<?php
/**
 * Coverage Section Layout
 *
 * @package SX
 */

// Block fields
$title = get_field('title') ?: 'Engineer Coverage';
$subtitle = get_field('subtitle') ?: 'Enter a postcode to find coverage in your area';
$search_placeholder = get_field('search_placeholder') ?: 'Enter postcode, town or city';
$google_maps_api_key = get_field('google_maps_api_key') ?: get_field('google_maps_api_key', 'option');
$default_lat = get_field('default_lat') ?: 54.5;
$default_lng = get_field('default_lng') ?: -2.5;
$default_zoom = get_field('default_zoom') ?: 6;

// Generate unique ID for this block
$block_id = 'coverage-' . uniqid();
?>

<section class="relative text-white h-[70vh] bg-cover bg-center bg-no-repeat" style="background-image: url('/coverage.png');">
    <div class="absolute inset-0 bg-[#ed1c24]/80"></div>    
    <div class="relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 min-h-[70vh]">
            <!-- Left Side - Search and Results -->
           <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 min-h-[70vh]">
            <div class="flex justify-center items-center">
                <img src="/circle-lines.png" alt="" class="w-[80%] ml-auto object-contain">
            </div>
             <div class="flex flex-col max-w-[500px] mx-auto h-full justify-center items-center">
                <div class="flex flex-col">
                    <!-- Header -->
                <div class="mb-8">
                    <h2 class="text-4xl md:text-5xl mb-4"><?php echo esc_html($title); ?></h2>
                    <p class="text-4xl md:text-6xl  opacity-90 font-bold"><?php echo esc_html($subtitle); ?></p>
                </div>
                
                <!-- Search Form -->
                <div class="mb-8">

                    <p class="text-lg opacity-90 font-bold mb-2">Enter a postcode to find coverage in your area</p>
                    <form id="<?php echo $block_id; ?>-search-form" class="flex gap-4">
                        <div class="flex-1">
                            <input 
                                type="text" 
                                id="<?php echo $block_id; ?>-postcode-input" 
                                placeholder="<?php echo esc_attr($search_placeholder); ?>"
                                class="w-full px-4 py-3 rounded-lg bg-white/20 backdrop-blur-sm border border-white/30 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50"
                                required
                            >
                        </div>
                        <button 
                            type="submit" 
                            class="px-6 py-3 bg-white text-red-600 font-bold rounded-lg hover:bg-gray-100 transition duration-300 flex items-center gap-2"
                        >
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/search.png" alt="Search" class="w-4 h-4">
                            Search
                        </button>
                    </form>
                </div>
                
                <!-- Loading State -->
                <div id="<?php echo $block_id; ?>-loading" class="hidden text-center py-8">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-white"></div>
                    <p class="mt-2">Searching coverage...</p>
                </div>
                
                <!-- Results -->
                <div id="<?php echo $block_id; ?>-results" class="flex-1 overflow-y-auto">
                    <div class="text-center py-16 opacity-70">
                        <h3 class="text-2xl font-bold mb-4">Find Your Local Engineer</h3>
                        <p>Enter your postcode above to see coverage in your area</p>
                    </div>
                </div>
                
                <!-- Contact Info Template (hidden) -->
                <template id="<?php echo $block_id; ?>-contact-template">
                    <div class="coverage-point bg-white/10 backdrop-blur-sm rounded-lg p-4 mb-4 border border-white/20">
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="font-bold text-lg coverage-point-title"></h4>
                            <span class="text-sm opacity-75 coverage-point-distance"></span>
                        </div>
                        <div class="coverage-point-contact text-sm space-y-1">
                            <div class="coverage-point-contact-name font-semibold"></div>
                            <div class="coverage-point-contact-phone"></div>
                            <div class="coverage-point-contact-email"></div>
                            <div class="coverage-point-description opacity-90"></div>
                        </div>
                    </div>
                </template>
                </div>
            </div>
            </div>
            
            <!-- Right Side - Map -->
            <div class="relative">
                <div 
                    id="<?php echo $block_id; ?>-map" 
                    class="!w-full !h-full overflow-hidden"
                    data-lat="<?php echo esc_attr($default_lat); ?>"
                    data-lng="<?php echo esc_attr($default_lng); ?>"
                    data-zoom="<?php echo esc_attr($default_zoom); ?>"
                >
                    <div class="flex items-center justify-center h-full text-white/70">
                        <div class="text-center">
                            <div class="w-16 h-16 mx-auto mb-4 opacity-50">
                                <svg fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                </svg>
                            </div>
                            <p>Map will load here</p>
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
        
        if (!isSearchLocation && point.contact_name) {
            const infoWindow = new google.maps.InfoWindow({
                content: `
                    <div class="p-3">
                        <h4 class="font-bold text-gray-800 mb-2">${point.title}</h4>
                        <div class="text-sm space-y-1">
                            <div><strong>Engineer:</strong> ${point.contact_name}</div>
                            ${point.contact_phone ? `<div><strong>Phone:</strong> <a href="tel:${point.contact_phone}" class="text-blue-600">${point.contact_phone}</a></div>` : ''}
                            ${point.contact_email ? `<div><strong>Email:</strong> <a href="mailto:${point.contact_email}" class="text-blue-600">${point.contact_email}</a></div>` : ''}
                            ${point.description ? `<div class="mt-2 text-gray-600">${point.description}</div>` : ''}
                            <div class="mt-2"><strong>Distance:</strong> ${point.distance} miles</div>
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
        loadingDiv.classList.remove('hidden');
        resultsDiv.innerHTML = '';
        
        // Make AJAX request
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'lookup_postcode',
                postcode: postcode
            })
        })
        .then(response => response.json())
        .then(data => {
            loadingDiv.classList.add('hidden');
            
            if (data.success) {
                displayResults(data.data);
            } else {
                resultsDiv.innerHTML = `
                    <div class="text-center py-8">
                        <h3 class="text-xl font-bold mb-2 text-red-200">No Coverage Found</h3>
                        <p>Sorry, we couldn't find any engineers in your area. Please try a different postcode.</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            loadingDiv.classList.add('hidden');
            resultsDiv.innerHTML = `
                <div class="text-center py-8">
                    <h3 class="text-xl font-bold mb-2 text-red-200">Error</h3>
                    <p>There was an error searching for coverage. Please try again.</p>
                </div>
            `;
        });
    });
    
    // Display search results
    function displayResults(data) {
        clearMarkers();
        
        if (data.coverage_points.length === 0) {
            resultsDiv.innerHTML = `
                <div class="text-center py-8">
                    <h3 class="text-xl font-bold mb-2 text-red-200">No Coverage Found</h3>
                    <p>Sorry, we couldn't find any engineers within 30 miles of your location.</p>
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
            title: 'Your Search Location'
        }, true);
        
        // Display results
        let resultsHTML = `
            <div class="mb-6">
                <h3 class="text-2xl font-bold mb-2">Engineers Near You</h3>
                <p class="opacity-90">Found ${data.coverage_points.length} engineer${data.coverage_points.length !== 1 ? 's' : ''} within 30 miles</p>
            </div>
        `;
        
        data.coverage_points.forEach(point => {
            // Add marker to map
            addMarker(point);
            
            // Add to results list
            resultsHTML += `
                <div class="coverage-point bg-white/10 backdrop-blur-sm rounded-lg p-4 mb-4 border border-white/20 cursor-pointer hover:bg-white/20 transition duration-300" data-lat="${point.lat}" data-lng="${point.lng}">
                    <div class="flex justify-between items-start mb-2">
                        <h4 class="font-bold text-lg">${point.title}</h4>
                        <span class="text-sm opacity-75">${point.distance} miles</span>
                    </div>
                    <div class="text-sm space-y-1">
                        ${point.contact_name ? `<div class="font-semibold">${point.contact_name}</div>` : ''}
                        ${point.contact_phone ? `<div><a href="tel:${point.contact_phone}" class="hover:text-red-200">${point.contact_phone}</a></div>` : ''}
                        ${point.contact_email ? `<div><a href="mailto:${point.contact_email}" class="hover:text-red-200">${point.contact_email}</a></div>` : ''}
                        ${point.description ? `<div class="opacity-90 mt-2">${point.description}</div>` : ''}
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
    window.initCoverageMap = initMap;
    
    // Load Google Maps API
    if (!window.google || !window.google.maps) {
        const script = document.createElement('script');
        script.src = `https://maps.googleapis.com/maps/api/js?key=<?php echo esc_js($google_maps_api_key); ?>&callback=initCoverageMap`;
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
console.warn('Google Maps API key is required for the coverage map to function.');
</script>
<?php endif; ?>