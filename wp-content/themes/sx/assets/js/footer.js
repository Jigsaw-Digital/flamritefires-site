/**
 * Footer JavaScript
 * Header scroll behavior and cookie consent functionality
 */

// Handle transparent header scroll behavior
document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('header');
    const hasDynamicHero = header && header.getAttribute('data-has-dynamic-hero') === 'true';

    if (hasDynamicHero) {
        let lastScroll = 0;

        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            if (currentScroll > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }

            lastScroll = currentScroll;
        });
    }
});

// Cookie consent banner functionality
(function() {
    const banner = document.getElementById('cookie-policy-banner');
    const overlay = document.getElementById('cookie-policy-overlay');
    const acceptBtn = document.getElementById('cookie-policy-accept');
    const customizeBtn = document.getElementById('cookie-policy-customize');
    const savePreferencesBtn = document.getElementById('cookie-save-preferences');
    const preferencesSection = document.getElementById('cookie-preferences');
    const COOKIE_NAME = 'cookie_consent';
    const COOKIE_EXPIRY_DAYS = 365;

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = `expires=${date.toUTCString()}`;
        document.cookie = `${name}=${value};${expires};path=/;SameSite=Lax`;
    }

    function showBanner() {
        overlay.style.display = 'block';
        setTimeout(() => { overlay.style.opacity = '1'; }, 10);
        banner.style.display = 'block';
        setTimeout(() => { banner.style.transform = 'translateY(0)'; }, 10);
        document.body.style.overflow = 'hidden';
    }

    function hideBanner() {
        banner.style.transform = 'translateY(100%)';
        overlay.style.opacity = '0';
        setTimeout(() => {
            banner.style.display = 'none';
            overlay.style.display = 'none';
            document.body.style.overflow = '';
        }, 300);
    }

    function handleAccept() {
        setCookie(COOKIE_NAME, 'accepted', COOKIE_EXPIRY_DAYS);
        hideBanner();
        window.dispatchEvent(new Event('cookiesAccepted'));
    }

    function handleCustomize() {
        if (preferencesSection.classList.contains('hidden')) {
            preferencesSection.classList.remove('hidden');
            customizeBtn.textContent = 'Hide Options';
        } else {
            preferencesSection.classList.add('hidden');
            customizeBtn.textContent = 'Customize';
        }
    }

    function handleSavePreferences() {
        const analytics = document.getElementById('cookie-analytics').checked;
        const marketing = document.getElementById('cookie-marketing').checked;
        const functional = document.getElementById('cookie-functional').checked;
        const performance = document.getElementById('cookie-performance').checked;

        if (!analytics && !marketing && !functional && !performance) {
            setCookie(COOKIE_NAME, 'necessary', COOKIE_EXPIRY_DAYS);
        } else {
            setCookie(COOKIE_NAME, 'accepted', COOKIE_EXPIRY_DAYS);
            setCookie('cookie_analytics', analytics ? '1' : '0', COOKIE_EXPIRY_DAYS);
            setCookie('cookie_marketing', marketing ? '1' : '0', COOKIE_EXPIRY_DAYS);
            setCookie('cookie_functional', functional ? '1' : '0', COOKIE_EXPIRY_DAYS);
            setCookie('cookie_performance', performance ? '1' : '0', COOKIE_EXPIRY_DAYS);
            if (analytics) {
                window.dispatchEvent(new Event('cookiesAccepted'));
            }
        }
        hideBanner();
    }

    const consent = getCookie(COOKIE_NAME);
    if (!consent) {
        showBanner();
    }

    if (acceptBtn) acceptBtn.addEventListener('click', handleAccept);
    if (customizeBtn) customizeBtn.addEventListener('click', handleCustomize);
    if (savePreferencesBtn) savePreferencesBtn.addEventListener('click', handleSavePreferences);
})();

// Where to Buy Modal (Global)
(function() {
    const modal = document.getElementById('whereToBuyModal');
    const content = document.getElementById('whereToBuyContent');
    const overlay = document.getElementById('whereToBuyOverlay');
    const closeBtn = document.getElementById('closeWhereToBuy');
    const iframeContainer = document.getElementById('whereToBuyIframeContainer');
    let iframeLoaded = false;

    function openModal() {
        if (!modal) return;
        // Lazy load iframe on first open
        if (!iframeLoaded && iframeContainer) {
            iframeContainer.innerHTML = '<iframe src="https://api.leadconnectorhq.com/widget/form/ADxQOaLUD4qr1znHzjkr" style="width:100%;height:1292px;border:none;border-radius:3px" title="Find Your Local Flamerite Supplier"></iframe>';
            iframeLoaded = true;
        }
        modal.classList.remove('hidden');
        setTimeout(() => {
            content.classList.remove('translate-x-full');
            content.classList.add('translate-x-0');
        }, 10);
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        if (!modal) return;
        content.classList.add('translate-x-full');
        content.classList.remove('translate-x-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    }

    // Attach to any element with whereToBuyBtn class or id
    document.querySelectorAll('#whereToBuyBtn, #whereToBuyBtn2, #whereToBuyBtn3, .where-to-buy-trigger').forEach(btn => {
        btn.addEventListener('click', openModal);
    });

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (overlay) overlay.addEventListener('click', closeModal);

    // Escape key closes modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
})();
