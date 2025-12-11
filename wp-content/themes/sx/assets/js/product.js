/**
 * Product Page JavaScript
 * Handles sliders, modals, and interactions
 */
document.addEventListener('DOMContentLoaded', function() {
    // Thumbnail slider
    const thumbsSlider = new Swiper('#thumbsSlider', {
        spaceBetween: 8,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
        breakpoints: {
            0: { slidesPerView: 3, spaceBetween: 6 },
            640: { slidesPerView: 4, spaceBetween: 8 },
            1024: { slidesPerView: 4, spaceBetween: 10 }
        }
    });

    // Main product slider
    const productSlider = new Swiper('#productSlider', {
        slidesPerView: 1,
        spaceBetween: 0,
        thumbs: { swiper: thumbsSlider }
    });

    // Lightbox slider - initialized lazily
    let lightboxSlider = null;

    // Fullscreen lightbox
    const fullscreenBtn = document.getElementById('fullscreenBtn');
    const imageLightbox = document.getElementById('imageLightbox');
    const closeLightbox = document.getElementById('closeLightbox');
    const lightboxWrapper = document.querySelector('#lightboxSlider .swiper-wrapper');

    fullscreenBtn?.addEventListener('click', function() {
        // Populate lightbox from main slider if not already done
        if (lightboxWrapper && !lightboxWrapper.children.length) {
            const mainSlides = document.querySelectorAll('#productSlider .swiper-slide img');
            mainSlides.forEach(img => {
                const slide = document.createElement('div');
                slide.className = 'swiper-slide flex-center';
                slide.innerHTML = `<img src="${img.src}" alt="${img.alt}" class="max-h-[90vh] max-w-full object-contain">`;
                lightboxWrapper.appendChild(slide);
            });
            // Initialize lightbox slider after populating
            lightboxSlider = new Swiper('#lightboxSlider', {
                slidesPerView: 1,
                spaceBetween: 0,
                navigation: {
                    nextEl: '#lightboxSlider .swiper-button-next',
                    prevEl: '#lightboxSlider .swiper-button-prev'
                }
            });
        }
        imageLightbox.classList.remove('hidden');
        imageLightbox.style.display = 'flex';
        imageLightbox.style.alignItems = 'center';
        imageLightbox.style.justifyContent = 'center';
        lightboxSlider?.slideTo(productSlider.activeIndex);
        document.body.style.overflow = 'hidden';
    });

    function closeLightboxModal() {
        imageLightbox.classList.add('hidden');
        imageLightbox.style.display = '';
        document.body.style.overflow = '';
    }

    closeLightbox?.addEventListener('click', closeLightboxModal);

    imageLightbox?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeLightboxModal();
        }
    });

    // Video modal
    const watchVideoBtn = document.getElementById('watchVideoBtn');
    const videoModal = document.getElementById('videoModal');
    const modalVideo = document.getElementById('modalVideo');
    const closeVideoModal = document.getElementById('closeVideoModal');

    watchVideoBtn?.addEventListener('click', function() {
        const videoUrl = this.getAttribute('data-video');
        modalVideo.querySelector('source').src = videoUrl;
        modalVideo.load();
        videoModal.classList.remove('hidden');
    });

    closeVideoModal?.addEventListener('click', function() {
        videoModal.classList.add('hidden');
        modalVideo.pause();
    });

    videoModal?.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
            modalVideo.pause();
        }
    });

    // Where to Buy modal is now handled globally in footer.js

    // Escape key closes lightbox
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && imageLightbox && !imageLightbox.classList.contains('hidden')) {
            closeLightboxModal();
        }
    });
});
