import './bootstrap';

// Barbershop App Navigation System
class BarbershopApp {
    constructor() {
        // Don't initialize navigation on admin or barber pages
        if (window.location.pathname.startsWith('/admin') || 
            window.location.pathname.startsWith('/barber')) {
            console.log('Skipping BarbershopApp initialization on admin/barber pages');
            return;
        }
        
        this.currentPage = this.getCurrentPageFromURL();
        this.selectedService = '';
        this.selectedBarber = '';
        this.init();
    }

    init() {
        this.setupNavigation();
        this.setupScrollAnimations();
        this.showPage(this.currentPage);
    }

    getCurrentPageFromURL() {
        const path = window.location.pathname;
        console.log('Current URL path:', path);
        
        // Map URL paths to page names
        if (path === '/' || path === '') return 'home';
        if (path.startsWith('/services')) return 'services';
        if (path.startsWith('/barbers')) return 'barbers';
        if (path.startsWith('/booking')) return 'booking';
        if (path.startsWith('/gallery')) return 'gallery';
        if (path.startsWith('/confirmation')) return 'confirmation';
        if (path.startsWith('/notifications')) return 'notifications';
        
        // Availability is SPA-only, no separate route
        // Default to home for unknown paths
        return 'home';
    }

    setupNavigation() {
        // Setup main navigation
        document.addEventListener('click', (e) => {
            if (e.target.matches('[data-navigate]')) {
                e.preventDefault();
                const page = e.target.getAttribute('data-navigate');
                this.navigateTo(page);
            }
        });

        // Setup service selection
        document.addEventListener('click', (e) => {
            if (e.target.matches('[data-select-service]')) {
                e.preventDefault();
                const serviceId = e.target.getAttribute('data-select-service');
                this.selectService(serviceId);
            }
        });

        // Setup barber selection
        document.addEventListener('click', (e) => {
            if (e.target.matches('[data-select-barber]')) {
                e.preventDefault();
                const barberId = e.target.getAttribute('data-select-barber');
                this.selectBarber(barberId);
            }
        });
    }

    setupQuickNavigation() {
        // Quick navigation removed per user request
    }

    async navigateTo(page) {
        console.log('Navigating to:', page);
        
        // Check if we're on a non-SPA page (like login, admin, etc.)
        const currentPath = window.location.pathname;
        const nonSpaPages = ['/login', '/admin', '/barber', '/test-bookings'];
        const isOnNonSpaPage = nonSpaPages.some(path => currentPath.startsWith(path));
        
        if (isOnNonSpaPage) {
            // If we're on a non-SPA page, redirect to home first then show the page
            if (page === 'availability') {
                window.location.href = '/#availability';
            } else {
                window.location.href = `/${page === 'home' ? '' : page}`;
            }
            return;
        }
        
        // Special handling for booking page - redirect to Laravel route with auth
        if (page === 'booking') {
            window.location.href = '/booking';
            return;
        }
        
        // Special handling for availability - keep it in SPA, don't create separate route
        if (page === 'availability') {
            this.currentPage = page;
            
            // Ensure availability page exists before showing
            const availabilityPage = document.querySelector('[data-page="availability"]');
            if (availabilityPage) {
                this.showPage(page);
                window.scrollTo(0, 0);
                // Don't change URL for availability, keep it as SPA-only
                return;
            } else {
                // If availability page not found, wait and try again
                setTimeout(() => {
                    const retryPage = document.querySelector('[data-page="availability"]');
                    if (retryPage) {
                        this.showPage(page);
                        window.scrollTo(0, 0);
                    }
                }, 100);
                return;
            }
        }
        
        // Load dynamic content for pages that need it
        if (page === 'barbers' || page === 'services') {
            await this.loadPageContent(page);
        }
        
        this.currentPage = page;
        this.showPage(page);
        
        // Quick scroll to top without animation for better performance
        window.scrollTo(0, 0);
        
        // Update URL without page reload
        history.pushState({ page }, '', `/${page === 'home' ? '' : page}`);
    }

    selectService(serviceId) {
        this.selectedService = serviceId;
        console.log('Selected service:', serviceId);
        
        // Store selected service in session storage
        sessionStorage.setItem('selectedService', serviceId);
        
        // Redirect directly to booking page with service pre-selected
        window.location.href = `/booking?service=${serviceId}`;
    }

    selectBarber(barberId) {
        this.selectedBarber = barberId;
        console.log('Selected barber:', barberId);
    }

    async loadPageContent(page) {
        // Check if content is already cached
        const cacheKey = `page_content_${page}`;
        const cachedContent = sessionStorage.getItem(cacheKey);
        
        if (cachedContent) {
            try {
                const data = JSON.parse(cachedContent);
                const pageElement = document.querySelector(`[data-page="${page}"]`);
                if (pageElement) {
                    pageElement.innerHTML = data.html;
                    console.log(`Loaded ${page} from cache`);
                    return;
                }
            } catch (e) {
                // Cache corrupted, continue with fetch
                sessionStorage.removeItem(cacheKey);
            }
        }

        try {
            console.log(`Loading content for page: ${page}`);
            
            // Show loading state
            this.showLoadingState(page);
            
            const controller = new AbortController();
            const timeoutId = setTimeout(() => controller.abort(), 10000); // 10 second timeout
            
            const response = await fetch(`/ajax/${page}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                signal: controller.signal
            });
            
            clearTimeout(timeoutId);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            
            if (data.success) {
                // Cache the content for faster subsequent loads
                try {
                    sessionStorage.setItem(cacheKey, JSON.stringify(data));
                } catch (e) {
                    // Storage full, ignore
                    console.warn('Session storage full, skipping cache');
                }
                
                // Update the page content
                const pageElement = document.querySelector(`[data-page="${page}"]`);
                if (pageElement) {
                    pageElement.innerHTML = data.html;
                    console.log(`Successfully loaded ${page} content with ${data.count || 0} items`);
                    
                    // Lazy load images
                    this.lazyLoadImages(pageElement);
                }
            } else {
                throw new Error(data.message || 'Failed to load content');
            }
            
        } catch (error) {
            console.error(`Error loading ${page} content:`, error);
            
            // Show error message in the page
            const pageElement = document.querySelector(`[data-page="${page}"]`);
            if (pageElement) {
                pageElement.innerHTML = `
                    <div class="pt-20 min-h-screen flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-red-500 text-6xl mb-4">⚠️</div>
                            <h2 class="text-2xl font-bold text-white mb-4">Gagal Memuat Konten</h2>
                            <p class="text-gray-300 mb-6">Terjadi kesalahan saat memuat data ${page}</p>
                            <button onclick="window.barbershopApp.navigateTo('${page}')" 
                                    class="bg-yellow-400 text-black px-6 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition-colors">
                                Coba Lagi
                            </button>
                        </div>
                    </div>
                `;
            }
        } finally {
            this.hideLoadingState(page);
        }
    }

    lazyLoadImages(container) {
        const images = container.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    observer.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    }

    showLoadingState(page) {
        // Show loading spinner in navigation
        const navItem = document.querySelector(`[data-navigate="${page}"]`);
        if (navItem) {
            navItem.style.opacity = '0.6';
            navItem.style.pointerEvents = 'none';
        }
        
        // Show loading content in page
        const pageElement = document.querySelector(`[data-page="${page}"]`);
        if (pageElement) {
            pageElement.innerHTML = `
                <div class="pt-20 min-h-screen flex items-center justify-center">
                    <div class="text-center">
                        <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-yellow-400 mx-auto mb-4"></div>
                        <h2 class="text-xl font-semibold text-white mb-2">Memuat ${page === 'barbers' ? 'Data Kapster' : 'Konten'}...</h2>
                        <p class="text-gray-300">Mohon tunggu sebentar</p>
                    </div>
                </div>
            `;
        }
    }

    hideLoadingState(page) {
        const navItem = document.querySelector(`[data-navigate="${page}"]`);
        if (navItem) {
            navItem.style.opacity = '1';
            navItem.style.pointerEvents = 'auto';
        }
    }

    showPage(page) {
        console.log('Attempting to show page:', page);
        
        // Hide all pages efficiently
        const pages = document.querySelectorAll('[data-page]');
        console.log('Found pages:', pages.length);
        pages.forEach(el => {
            el.style.display = 'none';
            console.log('Hiding page:', el.getAttribute('data-page'));
        });

        // Show current page
        const currentPageEl = document.querySelector(`[data-page="${page}"]`);
        console.log('Target page element:', currentPageEl);
        if (currentPageEl) {
            currentPageEl.style.display = 'block';
            console.log('Successfully showed page:', page);
            
            // Re-enable navigation after showing page
            this.enableNavigation();
        } else {
            console.error('Page element not found for:', page);
            console.log('Available pages:', Array.from(pages).map(p => p.getAttribute('data-page')));
            
            // Special handling for availability - don't redirect if element not found
            if (page === 'availability') {
                console.log('Availability page element not found, but staying on current page to prevent redirect');
                return;
            }
            
            // Fallback: redirect to appropriate URL if SPA navigation fails
            const pageUrls = {
                'home': '/',
                'services': '/#services',
                'barbers': '/barbers', 
                'booking': '/booking',
                'availability': '/#availability',
                'gallery': '/#gallery',
                'admin': '/admin'
            };
            
            if (pageUrls[page]) {
                const targetUrl = pageUrls[page];
                const currentPath = window.location.pathname;
                
                // Prevent redirect if already on the same page
                if ((page === 'booking' && currentPath === '/booking') ||
                    (page === 'admin' && currentPath.startsWith('/admin')) ||
                    (page === 'home' && currentPath === '/') ||
                    (page === 'barbers' && currentPath === '/barbers') ||
                    (page === 'availability' && currentPath === '/') ||
                    (targetUrl.includes('#') && currentPath === '/')) {
                    console.log('Already on target page, skipping redirect');
                    return;
                }
                
                console.log('Redirecting to:', targetUrl);
                window.location.href = targetUrl;
            }
        }

        // Update navbar active state efficiently
        this.updateNavbarActiveState(page);
    }

    updateNavbarActiveState(page) {
        const navItems = document.querySelectorAll('[data-nav-item], [data-navigate]');
        navItems.forEach(el => {
            const navPage = el.getAttribute('data-nav-item') || el.getAttribute('data-navigate');
            if (navPage === page) {
                el.classList.add('active');
            } else {
                el.classList.remove('active');
            }
        });
    }

    enableNavigation() {
        // Ensure all navigation links are clickable
        const navItems = document.querySelectorAll('[data-navigate]');
        navItems.forEach(el => {
            el.style.pointerEvents = 'auto';
            el.style.opacity = '1';
        });
    }



    setupScrollAnimations() {
        // Add scroll animation class to elements
        const animateElements = document.querySelectorAll('.scroll-animate');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        animateElements.forEach(el => observer.observe(el));

        // Special observer for yellow stripe with different threshold
        const stripeObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                }
            });
        }, {
            threshold: 0.3,
            rootMargin: '0px 0px -100px 0px'
        });

        // Observe yellow stripe elements
        setTimeout(() => {
            document.querySelectorAll('.yellow-stripe-scroll').forEach(stripe => {
                stripeObserver.observe(stripe);
            });
        }, 100);

        // Add scroll animation classes to sections
        setTimeout(() => {
            document.querySelectorAll('section:not(:first-child)').forEach(section => {
                section.classList.add('scroll-animate');
                observer.observe(section);
            });
        }, 100);

        // Parallax effect for hero background elements
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.parallax-element');
            
            parallaxElements.forEach((element, index) => {
                const speed = 0.5 + (index * 0.1);
                const yPos = -(scrolled * speed);
                element.style.transform = `translateY(${yPos}px)`;
            });
        });
    }
}

// Initialize app when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Don't initialize BarbershopApp on admin, barber, or optimized barbershop pages
    if (window.location.pathname.startsWith('/admin') || 
        window.location.pathname.startsWith('/barber') ||
        window.location.pathname === '/barbershop') {
        console.log('Skipping BarbershopApp initialization on admin/barber/optimized pages');
        return;
    }
    
    if (!window.barbershopApp) {
        window.barbershopApp = new BarbershopApp();
        
        // If we're on barbers page after refresh, ensure navigation works
        if (window.location.pathname === '/barbers') {
            // Enable navigation after page is loaded
            setTimeout(() => {
                console.log('Barbers page loaded, navigation enabled');
            }, 100);
        }
    }
});

// Handle browser back/forward buttons
window.addEventListener('popstate', (e) => {
    // Skip if on optimized barbershop page
    if (window.location.pathname === '/barbershop') {
        return;
    }
    
    if (e.state && e.state.page && window.barbershopApp) {
        window.barbershopApp.navigateTo(e.state.page);
    }
});