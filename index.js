// DOM Content Loaded Event Listener
document.addEventListener('DOMContentLoaded', () => {
    // Navigation and Button Handlers
    initNavigationHandlers();
    initButtonHandlers();
    initLazyLoading();
    initScrollAnimation();
});

// Initialize Navigation Handlers
function initNavigationHandlers() {
    const navLinks = document.querySelectorAll('.nav-item');
    const navbarToggle = document.querySelector('.navbar-toggle');

    navLinks.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = item.getAttribute('href')?.substring(1);
            if (targetId) {
                const targetElement = document.getElementById(targetId);
                targetElement?.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    if (navbarToggle) {
        navbarToggle.addEventListener('click', () => {
            document.querySelector('.nav-links')?.classList.toggle('active');
        });
    }
}

// Initialize Button Handlers
function initButtonHandlers() {
    // Get Started button handler
    const getStartedBtn = document.querySelector('.get-started');
    if (getStartedBtn) {
        getStartedBtn.addEventListener('click', redirectToPersonalInfo);
    }

    // Build Resume button handler (in hero section)
    const buildResumeBtn = document.querySelector('.cta-buttons .primary-button');
    if (buildResumeBtn) {
        buildResumeBtn.addEventListener('click', redirectToPersonalInfo);
    }

    // Sign In button handler
    const signInBtn = document.querySelector('.sign-in');
    if (signInBtn) {
        signInBtn.addEventListener('click', (e) => {
            e.preventDefault();
            // Add sign in logic here
            console.log('Sign in clicked');
        });
    }
}

// Redirect to Personal Info page
function redirectToPersonalInfo() {
    window.location.href = './personalInfo.html';
}

// Initialize Lazy Loading
function initLazyLoading() {
    const lazyImages = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                observer.unobserve(img);
            }
        });
    });

    lazyImages.forEach(img => imageObserver.observe(img));
}

// Initialize Scroll Animation
function initScrollAnimation() {
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    const elementObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
            }
        });
    }, { threshold: 0.1 });

    animatedElements.forEach(element => elementObserver.observe(element));
}

// Update footer year
const footerYear = document.querySelector('.footer-year');
if (footerYear) {
    footerYear.textContent = new Date().getFullYear();
}

// Handle form submission if exists
const resumeForm = document.querySelector('form');
if (resumeForm) {
    resumeForm.addEventListener('submit', (e) => {
        e.preventDefault();
        // Add form submission logic here
        console.log('Form submitted');
    });
}