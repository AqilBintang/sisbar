// Optimized Navigation System for Better Performance
class OptimizedBarbershopApp {
    constructor() {
        this.currentPage = this.getCurrentPageFromURL();
        this.cache = new Map(); // Cache for loaded content
        this.loadingStates = new Map(); // Track loading states
        this.init();
    }

    init() {
        this.setupOptimizedNavigation();
        this.preloadCriticalPages();
        this.showPage(this.currentPage);
    }

    getCurrentPageFromURL() {
        const path = window.location.pathname;
        if (path === '/' || path === '/barbershop') return 'home';
        if (path.includes('services')) return 'services';
        if (path.includes('barbers')) return 'barbers';
        if (path.includes('booking')) return 'booking';
        if (path.includes('gallery')) return 'gallery';
        return 'home';
    }

    setupOptimizedNavigation() {
        // Use event delegation for better performance
        document.addEventListener('click', this.handleNavigation.bind(this), { passive: false });
        
        // Preload on hover for instant navigation
        document.addEventListener('mouseenter', this.handlePreload.bind(this), { passive: true });
        
        // Handle service and barber selections after AJAX load
        document.addEventListener('click', this.handleDynamicClicks.bind(this), { passive: false });
    }

    handleDynamicClicks(e) {
        // Handle service selection
        if (e.target.matches('[data-select-service]')) {
            e.preventDefault();
            const serviceId = e.target.getAttribute('data-select-service');
            this.selectService(serviceId);
        }

        // Handle barber selection
        if (e.target.matches('[data-select-barber]')) {
            e.preventDefault();
            const barberId = e.target.getAttribute('data-select-barber');
            this.selectBarber(barberId);
        }
    }

    selectService(serviceId) {
        // Store selected service in session storage
        sessionStorage.setItem('selectedService', serviceId);
        
        // Redirect directly to booking page with service pre-selected
        window.location.href = `/booking?service=${serviceId}`;
    }

    selectBarber(barberId) {
        // Store selected barber
        sessionStorage.setItem('selectedBarber', barberId);
        console.log('Selected barber:', barberId);
    }

    handleNavigation(e) {
        const navElement = e.target.closest('[data-navigate]');
        if (!navElement) return;

        e.preventDefault();
        const page = navElement.getAttribute('data-navigate');
        
        // Add loading state immediately for better UX
        this.showLoadingState(page);
        
        // Use requestAnimationFrame for smooth transitions
        requestAnimationFrame(() => {
            this.navigateTo(page);
        });
    }

    handlePreload(e) {
        const navElement = e.target.closest('[data-navigate]');
        if (!navElement) return;

        const page = navElement.getAttribute('data-navigate');
        this.preloadPage(page);
    }

    showLoadingState(page) {
        const navItem = document.querySelector(`[data-navigate="${page}"]`);
        if (navItem) {
            navItem.style.opacity = '0.7';
            navItem.style.pointerEvents = 'none';
        }
        
        // Defensive: Auto-unlock after 10 seconds to prevent permanent freeze
        setTimeout(() => {
            this.hideLoadingState(page);
            console.warn(`Auto-unlocked loading state for ${page} after timeout`);
        }, 10000);
    }

    hideLoadingState(page) {
        const navItem = document.querySelector(`[data-navigate="${page}"]`);
        if (navItem) {
            navItem.style.opacity = '1';
            navItem.style.pointerEvents = 'auto';
        }
        
        // Defensive: Ensure body is never locked
        document.body.style.pointerEvents = '';
        document.body.style.overflow = '';
    }

    async navigateTo(page) {
        if (this.currentPage === page) {
            this.hideLoadingState(page);
            return;
        }

        try {
            // Load page content if not cached
            if (!this.cache.has(page)) {
                await this.loadPageContent(page);
            }

            // Hide current page with fade effect
            this.hideCurrentPage();

            // Show new page
            await this.showPage(page);

            // Update state
            this.currentPage = page;
            this.updateURL(page);
            this.updateNavbarState(page);

        } catch (error) {
            console.error('Navigation error:', error);
            // Fallback to full page reload
            window.location.href = `/${page === 'home' ? '' : page}`;
        } finally {
            this.hideLoadingState(page);
        }
    }

    hideCurrentPage() {
        const currentEl = document.querySelector(`[data-page="${this.currentPage}"]`);
        if (currentEl) {
            currentEl.style.transition = 'opacity 0.15s ease-out';
            currentEl.style.opacity = '0';
            setTimeout(() => {
                currentEl.style.display = 'none';
            }, 150);
        }
    }

    async showPage(page) {
        return new Promise((resolve) => {
            const pageEl = document.querySelector(`[data-page="${page}"]`);
            if (pageEl) {
                pageEl.style.display = 'block';
                pageEl.style.opacity = '0';
                pageEl.style.transition = 'opacity 0.15s ease-in';
                
                // Force reflow
                pageEl.offsetHeight;
                
                requestAnimationFrame(() => {
                    pageEl.style.opacity = '1';
                    setTimeout(resolve, 150);
                });
            } else {
                resolve();
            }
        });
    }

    async loadPageContent(page) {
        if (this.loadingStates.get(page)) return;
        this.loadingStates.set(page, true);

        console.log(`Loading content for page: ${page}`);

        try {
            const pageEl = document.querySelector(`[data-page="${page}"]`);
            const lazyContent = pageEl?.querySelector('.lazy-content');
            
            console.log(`Page element found:`, !!pageEl);
            console.log(`Lazy content found:`, !!lazyContent);
            
            if (lazyContent) {
                // Show loading state
                lazyContent.innerHTML = `
                    <div class="flex items-center justify-center min-h-screen">
                        <div class="loading-spinner"></div>
                        <span class="ml-2">Memuat ${page}...</span>
                    </div>
                `;

                // Load content via AJAX
                const response = await fetch(`/ajax/${page}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                console.log(`AJAX response status:`, response.status);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                console.log(`AJAX response data:`, data);
                
                if (data.success) {
                    lazyContent.innerHTML = data.html;
                    lazyContent.classList.remove('lazy-content');
                    console.log(`Successfully loaded ${page} content`);
                } else {
                    throw new Error(data.message || 'Failed to load content');
                }
            }
            
            this.cache.set(page, true);
        } catch (error) {
            console.error(`Failed to load page ${page}:`, error);
            
            // Show error message
            const pageEl = document.querySelector(`[data-page="${page}"]`);
            const lazyContent = pageEl?.querySelector('.lazy-content');
            if (lazyContent) {
                lazyContent.innerHTML = `
                    <div class="flex items-center justify-center min-h-screen">
                        <div class="text-center">
                            <p class="text-red-500 mb-4">Gagal memuat konten</p>
                            <button onclick="window.location.reload()" class="px-4 py-2 bg-accent text-black rounded">
                                Refresh Halaman
                            </button>
                        </div>
                    </div>
                `;
            }
            
            throw error;
        } finally {
            this.loadingStates.set(page, false);
        }
    }

    async createPageElement(page) {
        // This would be implemented based on your specific needs
        // For now, we'll work with existing DOM structure
        return Promise.resolve();
    }

    preloadCriticalPages() {
        // Preload most commonly accessed pages
        const criticalPages = ['services', 'barbers'];
        criticalPages.forEach(page => {
            setTimeout(() => this.preloadPage(page), 100);
        });
    }

    async preloadPage(page) {
        if (!this.cache.has(page) && !this.loadingStates.get(page)) {
            try {
                await this.loadPageContent(page);
            } catch (error) {
                console.warn(`Failed to preload page ${page}:`, error);
            }
        }
    }

    updateURL(page) {
        const url = page === 'home' ? '/' : `/${page}`;
        if (window.location.pathname !== url) {
            history.pushState({ page }, '', url);
        }
    }

    updateNavbarState(page) {
        // Remove active state from all nav items
        document.querySelectorAll('[data-nav-item]').forEach(item => {
            item.classList.remove('active', 'text-accent');
            item.classList.add('text-gray-600');
        });

        // Add active state to current nav item
        const activeNavItem = document.querySelector(`[data-nav-item="${page}"]`);
        if (activeNavItem) {
            activeNavItem.classList.add('active', 'text-accent');
            activeNavItem.classList.remove('text-gray-600');
        }

        // Also check for navigation links
        document.querySelectorAll('[data-navigate]').forEach(item => {
            if (item.getAttribute('data-navigate') === page) {
                item.classList.add('active', 'text-accent');
                item.classList.remove('text-gray-600');
            } else {
                item.classList.remove('active', 'text-accent');
                item.classList.add('text-gray-600');
            }
        });
    }

    // Cleanup method
    destroy() {
        this.cache.clear();
        this.loadingStates.clear();
    }
}

// Initialize optimized app
document.addEventListener('DOMContentLoaded', () => {
    // Don't initialize on admin or barber pages
    if (window.location.pathname.startsWith('/admin') || 
        window.location.pathname.startsWith('/barber')) {
        return;
    }
    
    // Replace the old app with optimized version
    if (window.barbershopApp) {
        window.barbershopApp.destroy?.();
    }
    
    window.barbershopApp = new OptimizedBarbershopApp();
});

// Handle browser back/forward buttons
window.addEventListener('popstate', (e) => {
    if (e.state && e.state.page && window.barbershopApp) {
        window.barbershopApp.navigateTo(e.state.page);
    }
});