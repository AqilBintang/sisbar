// Simple and Robust Navigation System
class SimpleBarbershopApp {
    constructor() {
        this.currentPage = this.getCurrentPageFromURL();
        this.cache = new Map();
        this.init();
    }

    init() {
        console.log('Initializing Simple Barbershop App');
        this.setupNavigation();
        this.showInitialPage();
    }

    getCurrentPageFromURL() {
        const path = window.location.pathname;
        if (path === '/' || path === '/barbershop') return 'home';
        return 'home'; // Default to home for SPA
    }

    setupNavigation() {
        // Simple click handler
        document.addEventListener('click', (e) => {
            const navElement = e.target.closest('[data-navigate]');
            if (navElement) {
                e.preventDefault();
                const page = navElement.getAttribute('data-navigate');
                console.log('Navigation clicked:', page);
                this.navigateTo(page);
            }
        });
    }

    showInitialPage() {
        this.showPage(this.currentPage);
    }

    async navigateTo(page) {
        console.log('Navigating to:', page);
        
        // Special handling for booking
        if (page === 'booking') {
            window.location.href = '/booking';
            return;
        }

        try {
            // Hide all pages first
            this.hideAllPages();
            
            // Show target page (might show loading state)
            this.showPage(page);
            
            // Load content if needed (this will update the content)
            await this.loadPageContent(page);
            
            // Update state
            this.currentPage = page;
            this.updateNavbar(page);
            
            // Scroll to top
            window.scrollTo(0, 0);
            
        } catch (error) {
            console.error('Navigation error:', error);
            // Show error in the page instead of alert
            this.showErrorPage(page, error.message);
        }
    }

    showErrorPage(page, errorMessage) {
        const pageElement = document.querySelector(`[data-page="${page}"]`);
        if (pageElement) {
            pageElement.innerHTML = `
                <div class="flex items-center justify-center min-h-screen">
                    <div class="text-center text-white">
                        <p class="text-red-400 mb-4">Gagal memuat ${page}: ${errorMessage}</p>
                        <button onclick="window.location.reload()" 
                                class="px-6 py-2 bg-yellow-400 text-black rounded hover:bg-yellow-500">
                            Refresh Halaman
                        </button>
                    </div>
                </div>
            `;
            pageElement.style.display = 'block';
        }
    }

    hideAllPages() {
        document.querySelectorAll('[data-page]').forEach(page => {
            page.style.display = 'none';
        });
    }

    showPage(page) {
        const pageElement = document.querySelector(`[data-page="${page}"]`);
        if (pageElement) {
            pageElement.style.display = 'block';
            console.log('Showing page:', page);
        } else {
            console.error('Page element not found:', page);
        }
    }

    async loadPageContent(page) {
        console.log(`Loading content for page: ${page}`);

        // Skip home page (always loaded)
        if (page === 'home') {
            this.cache.set(page, true);
            return;
        }

        // Skip if already cached and content is loaded
        if (this.cache.has(page)) {
            const pageElement = document.querySelector(`[data-page="${page}"]`);
            const lazyContent = pageElement?.querySelector('.lazy-content');
            if (!lazyContent) {
                console.log('Page already cached and loaded:', page);
                return;
            }
        }

        const pageElement = document.querySelector(`[data-page="${page}"]`);
        const lazyContent = pageElement?.querySelector('.lazy-content');
        
        if (!lazyContent) {
            console.log('No lazy content found for:', page);
            this.cache.set(page, true);
            return;
        }

        console.log('Loading AJAX content for:', page);

        // Show loading immediately
        lazyContent.innerHTML = `
            <div class="flex items-center justify-center min-h-screen">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-yellow-400"></div>
                <span class="ml-3 text-white">Memuat ${page}...</span>
            </div>
        `;

        try {
            const response = await fetch(`/ajax/${page}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    'Accept': 'application/json'
                }
            });

            console.log(`AJAX response status for ${page}:`, response.status);

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }

            const data = await response.json();
            console.log(`AJAX response data for ${page}:`, data);

            if (data.success && data.html) {
                // Replace the lazy content with actual content
                lazyContent.outerHTML = data.html;
                this.cache.set(page, true);
                console.log(`Successfully loaded content for: ${page}`);
            } else {
                throw new Error(data.message || 'Invalid response format');
            }

        } catch (error) {
            console.error(`AJAX loading failed for ${page}:`, error);
            lazyContent.innerHTML = `
                <div class="flex items-center justify-center min-h-screen">
                    <div class="text-center text-white">
                        <p class="text-red-400 mb-4">Gagal memuat konten: ${error.message}</p>
                        <button onclick="window.barbershopApp.loadPageContent('${page}')" 
                                class="px-4 py-2 bg-yellow-400 text-black rounded hover:bg-yellow-500 mr-2">
                            Coba Lagi
                        </button>
                        <button onclick="window.location.reload()" 
                                class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                            Refresh Halaman
                        </button>
                    </div>
                </div>
            `;
            throw error;
        }
    }

    updateNavbar(page) {
        // Update navigation active states
        document.querySelectorAll('[data-navigate]').forEach(nav => {
            const navPage = nav.getAttribute('data-navigate');
            if (navPage === page) {
                nav.classList.add('text-yellow-400');
                nav.classList.remove('text-gray-300');
            } else {
                nav.classList.remove('text-yellow-400');
                nav.classList.add('text-gray-300');
            }
        });

        // Update nav items
        document.querySelectorAll('[data-nav-item]').forEach(nav => {
            const navPage = nav.getAttribute('data-nav-item');
            if (navPage === page) {
                nav.classList.add('text-yellow-400');
                nav.classList.remove('text-gray-300');
            } else {
                nav.classList.remove('text-yellow-400');
                nav.classList.add('text-gray-300');
            }
        });
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // Only initialize on barbershop pages
    if (window.location.pathname.startsWith('/admin') || 
        window.location.pathname.startsWith('/barber')) {
        console.log('Skipping navigation on admin/barber pages');
        return;
    }
    
    console.log('Initializing Simple Barbershop Navigation');
    window.barbershopApp = new SimpleBarbershopApp();
});

// Handle browser back/forward
window.addEventListener('popstate', (e) => {
    if (window.barbershopApp) {
        const page = window.barbershopApp.getCurrentPageFromURL();
        window.barbershopApp.navigateTo(page);
    }
});