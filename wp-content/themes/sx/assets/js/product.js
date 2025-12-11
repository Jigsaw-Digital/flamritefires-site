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

    // Lightbox slider
    const lightboxSlider = new Swiper('#lightboxSlider', {
        slidesPerView: 1,
        spaceBetween: 0,
        navigation: {
            nextEl: '#lightboxSlider .swiper-button-next',
            prevEl: '#lightboxSlider .swiper-button-prev'
        }
    });

    // Fullscreen lightbox
    const fullscreenBtn = document.getElementById('fullscreenBtn');
    const imageLightbox = document.getElementById('imageLightbox');
    const closeLightbox = document.getElementById('closeLightbox');

    fullscreenBtn?.addEventListener('click', function() {
        imageLightbox.classList.remove('hidden');
        lightboxSlider.slideTo(productSlider.activeIndex);
        document.body.style.overflow = 'hidden';
    });

    closeLightbox?.addEventListener('click', function() {
        imageLightbox.classList.add('hidden');
        document.body.style.overflow = '';
    });

    imageLightbox?.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
            document.body.style.overflow = '';
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

    // Where to Buy modal
    const whereToBuyModal = document.getElementById('whereToBuyModal');
    const whereToBuyContent = document.getElementById('whereToBuyContent');
    const whereToBuyOverlay = document.getElementById('whereToBuyOverlay');
    const closeWhereToBuy = document.getElementById('closeWhereToBuy');

    function openWhereToBuy() {
        whereToBuyModal.classList.remove('hidden');
        setTimeout(() => {
            whereToBuyContent.classList.remove('translate-x-full');
            whereToBuyContent.classList.add('translate-x-0');
        }, 10);
        document.body.style.overflow = 'hidden';
    }

    function closeWhereToBuyModal() {
        whereToBuyContent.classList.add('translate-x-full');
        whereToBuyContent.classList.remove('translate-x-0');
        setTimeout(() => {
            whereToBuyModal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    }

    document.getElementById('whereToBuyBtn')?.addEventListener('click', openWhereToBuy);
    document.getElementById('whereToBuyBtn2')?.addEventListener('click', openWhereToBuy);
    document.getElementById('whereToBuyBtn3')?.addEventListener('click', openWhereToBuy);
    closeWhereToBuy?.addEventListener('click', closeWhereToBuyModal);
    whereToBuyOverlay?.addEventListener('click', closeWhereToBuyModal);

    // Escape key closes all modals
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (!imageLightbox?.classList.contains('hidden')) {
                imageLightbox.classList.add('hidden');
                document.body.style.overflow = '';
            }
            if (!whereToBuyModal?.classList.contains('hidden')) {
                closeWhereToBuyModal();
            }
        }
    });
});
