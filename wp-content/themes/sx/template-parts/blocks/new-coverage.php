<?php
/**
 * New Coverage Section Layout
 *
 * @package SX
 */

// Block fields
$left_top_image = get_field('left_top_image');
$left_title = get_field('left_title') ?: 'Engineer';
$left_subtitle = get_field('left_subtitle') ?: 'coverage';
$left_bottom_image = get_field('left_bottom_image');
$map_image = get_field('map_image');

// Generate unique ID for this block
$block_id = 'new-coverage-' . uniqid();
?>

<section class="bg-white" style="height: calc(100vh - 72px);">
    <div class="w-full h-full">
        <div class="flex flex-col lg:flex-row lg:h-full">
            <!-- Mobile: Map First, Desktop: Left Side Images -->
            <div class="lg:order-1 order-2 h-full lg:w-[40%]">

                <!-- Left Side Images - Hidden on mobile -->
                <div class="flex lg:flex-col h-[200px] lg:h-full">
                    <!-- Top Left Image with Title Overlay -->
                    <div class="relative overflow-hidden flex-1">
                        <?php if ($left_top_image): ?>
                            <img 
                                src="<?php echo esc_url($left_top_image['url']); ?>" 
                                alt="<?php echo esc_attr($left_top_image['alt']); ?>"
                                class="w-full h-full object-cover"
                            >
                            <!-- Title Overlay -->
                            <div class="absolute inset-0  flex items-center justify-start lg:pl-[200px]">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/advance-lines.png"class="w-1/2 hidden lg:block">
                            
                        </div>
                            <div class="absolute inset-0 bg-black/40 flex text-center lg:text-left items-center justify-center lg:justify-end lg:pr-[200px]">
                                <div class=" text-white">
                                    <h2 class="text-2xl md:text-5xl  font-thin mb-2">
                                        <?php echo esc_html($left_title); ?>
                                    </h2>
                                    <p class="text-2xl md:text-5xl font-bold ">
                                        <?php echo esc_html($left_subtitle); ?>
                                    </p>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                <div class="text-center text-gray-600">
                                    <p class="text-lg">Upload top left image</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Bottom Left Image -->
                    <div class="relative overflow-hidden flex-1 hidden lg:block">
                        <?php if ($left_bottom_image): ?>
                            <img 
                                src="<?php echo esc_url($left_bottom_image['url']); ?>" 
                                alt="<?php echo esc_attr($left_bottom_image['alt']); ?>"
                                class="w-full h-full object-cover"
                            >
                        <?php else: ?>
                            <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                <div class="text-center text-gray-600">
                                    <p class="text-lg">Upload bottom left image</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Right Side - Interactive Map -->
            <div class="lg:order-2 order-2 block h-full lg:w-[60%]">
                <div class="relative overflow-hidden h-full" id="<?php echo $block_id; ?>-map-container">
                    <?php if ($map_image): ?>
                        <!-- Map Controls -->
                        <div class="absolute top-4 right-4 z-10 flex flex-col gap-2">
                            <button 
                                id="<?php echo $block_id; ?>-zoom-in"
                                class="bg-white/90 hover:bg-white shadow-lg rounded-lg p-3 transition-all duration-200 hover:scale-110"
                                title="Zoom In"
                            >
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    <line x1="11" y1="8" x2="11" y2="14"></line>
                                    <line x1="8" y1="11" x2="14" y2="11"></line>
                                </svg>
                            </button>
                            <button 
                                id="<?php echo $block_id; ?>-zoom-out"
                                class="bg-white/90 hover:bg-white shadow-lg rounded-lg p-3 transition-all duration-200 hover:scale-110"
                                title="Zoom Out"
                            >
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    <line x1="8" y1="11" x2="14" y2="11"></line>
                                </svg>
                            </button>
                            <button 
                                id="<?php echo $block_id; ?>-reset-view"
                                class="bg-white/90 hover:bg-white shadow-lg rounded-lg p-3 transition-all duration-200 hover:scale-110"
                                title="Reset View"
                            >
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path>
                                    <path d="M3 3v5h5"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Drag Indicator (shown on first load) -->
                        <div 
                            id="<?php echo $block_id; ?>-drag-indicator"
                            class="absolute inset-0 flex items-center justify-center bg-black/20 pointer-events-none transition-opacity duration-500"
                        >
                            <div class="bg-white/95 rounded-xl p-6 shadow-xl text-center animate-pulse">
                                <div class="text-4xl mb-2">👆</div>
                                <p class="text-gray-700 font-medium">Drag to explore the map</p>
                                <p class="text-gray-500 text-sm mt-1">Use controls to zoom</p>
                            </div>
                        </div>

                        <div 
                            class="interactive-map-wrapper w-full h-full cursor-grab bg-[#1b1b19] active:cursor-grabbing select-none"
                            id="<?php echo $block_id; ?>-map-wrapper"
                            style="touch-action: none;"
                        >
                            <img 
                                src="<?php echo esc_url($map_image['url']); ?>" 
                                alt="<?php echo esc_attr($map_image['alt']); ?>"
                                class="interactive-map-image transition-transform duration-150 ease-out"
                                id="<?php echo $block_id; ?>-map-image"
                                style="transform: scale(1.5) translate(0px, 0px); transform-origin: center center;"
                                draggable="false"
                            >
                        </div>
                    <?php else: ?>
                        <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                            <div class="text-center text-gray-600">
                                <p class="text-lg">Upload map image</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const blockId = '<?php echo $block_id; ?>';
    const mapContainer = document.getElementById(blockId + '-map-container');
    const mapWrapper = document.getElementById(blockId + '-map-wrapper');
    const mapImage = document.getElementById(blockId + '-map-image');
    const dragIndicator = document.getElementById(blockId + '-drag-indicator');
    const zoomInBtn = document.getElementById(blockId + '-zoom-in');
    const zoomOutBtn = document.getElementById(blockId + '-zoom-out');
    const resetViewBtn = document.getElementById(blockId + '-reset-view');
    
    if (!mapContainer || !mapWrapper || !mapImage) return;
    
    let isDragging = false;
    let startX = 0;
    let startY = 0;
    let currentX = 0;
    let currentY = 0;
    let scale = 1.5;
    let minScale = 1;
    let maxScale = 3;
    let imageNaturalWidth = 0;
    let imageNaturalHeight = 0;
    
    // Hide drag indicator after 3 seconds or on first interaction
    function hideDragIndicator() {
        if (dragIndicator) {
            dragIndicator.style.opacity = '0';
            setTimeout(() => {
                dragIndicator.style.display = 'none';
            }, 500);
        }
    }
    
    // Show drag indicator initially, then hide after 3 seconds
    setTimeout(hideDragIndicator, 3000);
    
    // Get image natural dimensions
    function getImageNaturalDimensions() {
        // First try to get from the actual image if it's loaded
        if (mapImage.naturalWidth > 0 && mapImage.naturalHeight > 0) {
            imageNaturalWidth = mapImage.naturalWidth;
            imageNaturalHeight = mapImage.naturalHeight;
            applyBounds();
        } else {
            // If not loaded, create a new image to get dimensions
            const tempImg = new Image();
            tempImg.onload = function() {
                imageNaturalWidth = this.naturalWidth;
                imageNaturalHeight = this.naturalHeight;
                applyBounds();
            };
            tempImg.src = mapImage.src;
        }
    }
    
    // Calculate bounds to prevent showing white space
    function calculateBounds() {
        const containerRect = mapContainer.getBoundingClientRect();
        const containerWidth = containerRect.width;
        const containerHeight = containerRect.height;
        
        // If image dimensions aren't loaded yet, use fallback
        if (imageNaturalWidth === 0 || imageNaturalHeight === 0) {
            return { minX: 0, maxX: 0, minY: 0, maxY: 0 };
        }
        
        // Calculate how the image would naturally fit in the container
        const imageAspectRatio = imageNaturalWidth / imageNaturalHeight;
        const containerAspectRatio = containerWidth / containerHeight;
        
        // Determine the rendered image dimensions (object-fit: cover behavior)
        let renderedWidth, renderedHeight;
        if (imageAspectRatio > containerAspectRatio) {
            // Image is wider than container ratio - height fills container
            renderedHeight = containerHeight;
            renderedWidth = renderedHeight * imageAspectRatio;
        } else {
            // Image is taller than container ratio - width fills container
            renderedWidth = containerWidth;
            renderedHeight = renderedWidth / imageAspectRatio;
        }
        
        // Apply scaling
        const scaledWidth = renderedWidth * scale;
        const scaledHeight = renderedHeight * scale;
        
        // Calculate maximum translation before showing white space
        const maxTranslateX = Math.max(0, (scaledWidth - containerWidth) / 2);
        const maxTranslateY = Math.max(0, (scaledHeight - containerHeight) / 2);
        
        return {
            minX: -maxTranslateX,
            maxX: maxTranslateX,
            minY: -maxTranslateY,
            maxY: maxTranslateY
        };
    }
    
    // Apply bounds to current translation values
    function applyBounds() {
        const bounds = calculateBounds();
        
        // Debug logging (remove in production)
        console.log('Bounds:', bounds, 'Current:', {x: currentX, y: currentY}, 'Scale:', scale, 'ImageDims:', {w: imageNaturalWidth, h: imageNaturalHeight});
        
        const oldX = currentX;
        const oldY = currentY;
        
        currentX = Math.max(bounds.minX, Math.min(bounds.maxX, currentX));
        currentY = Math.max(bounds.minY, Math.min(bounds.maxY, currentY));
        
        // If bounds were applied, log it
        if (oldX !== currentX || oldY !== currentY) {
            console.log('Applied bounds - moved from', {x: oldX, y: oldY}, 'to', {x: currentX, y: currentY});
        }
        
        updateTransform();
    }
    
    // Update the transform style
    function updateTransform() {
        mapImage.style.transform = `scale(${scale}) translate(${currentX}px, ${currentY}px)`;
    }
    
    // Handle mouse down
    function handleStart(e) {
        isDragging = true;
        mapWrapper.classList.add('active:cursor-grabbing');
        hideDragIndicator();
        
        const clientX = e.type === 'mousedown' ? e.clientX : e.touches[0].clientX;
        const clientY = e.type === 'mousedown' ? e.clientY : e.touches[0].clientY;
        
        startX = clientX - currentX;
        startY = clientY - currentY;
        
        e.preventDefault();
    }
    
    // Handle mouse move
    function handleMove(e) {
        if (!isDragging) return;
        
        const clientX = e.type === 'mousemove' ? e.clientX : e.touches[0].clientX;
        const clientY = e.type === 'mousemove' ? e.clientY : e.touches[0].clientY;
        
        currentX = clientX - startX;
        currentY = clientY - startY;
        
        applyBounds();
        
        e.preventDefault();
    }
    
    // Handle mouse up
    function handleEnd(e) {
        if (!isDragging) return;
        
        isDragging = false;
        mapWrapper.classList.remove('active:cursor-grabbing');
        
        e.preventDefault();
    }
    
    // Zoom functionality
    function zoom(direction) {
        hideDragIndicator();
        const step = 0.2;
        const newScale = direction > 0 ? scale + step : scale - step;
        
        if (newScale >= minScale && newScale <= maxScale) {
            scale = newScale;
            applyBounds();
        }
    }
    
    // Reset view
    function resetView() {
        hideDragIndicator();
        scale = 1.5;
        currentX = 0;
        currentY = 0;
        updateTransform();
    }
    
    // Mouse events
    mapWrapper.addEventListener('mousedown', handleStart);
    document.addEventListener('mousemove', handleMove);
    document.addEventListener('mouseup', handleEnd);
    
    // Touch events for mobile
    mapWrapper.addEventListener('touchstart', handleStart, { passive: false });
    document.addEventListener('touchmove', handleMove, { passive: false });
    document.addEventListener('touchend', handleEnd, { passive: false });
    
    // Zoom controls
    if (zoomInBtn) zoomInBtn.addEventListener('click', () => zoom(1));
    if (zoomOutBtn) zoomOutBtn.addEventListener('click', () => zoom(-1));
    if (resetViewBtn) resetViewBtn.addEventListener('click', resetView);
    
    // Prevent context menu on long press
    mapWrapper.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        setTimeout(applyBounds, 100);
    });
    
    // Initialize
    function initialize() {
        getImageNaturalDimensions();
        // Also wait for image to load if it hasn't already
        if (mapImage.complete) {
            setTimeout(applyBounds, 100);
        } else {
            mapImage.addEventListener('load', function() {
                getImageNaturalDimensions();
                setTimeout(applyBounds, 100);
            });
        }
    }
    
    initialize();
});
</script>