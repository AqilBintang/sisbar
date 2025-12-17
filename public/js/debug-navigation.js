// Debug Navigation System
console.log('🚀 Loading Debug Navigation System');

class DebugBarbershopApp {
    constructor() {
        console.log('🔧 Constructing DebugBarbershopApp');
        this.currentPage = 'home';
        this.cache = new Map();
        this.isLoading = false;
        this.init();
    }

    init() {
        console.log('🔧 Initializing Debug Navigation');
        this.setupNavigation();
        console.log('✅ Debug Navigation initialized');
    }

    setupNavigation() {
        console.log('🔧 Setting up navigation event listeners');
        
        // Use event delegation
        document.addEventListener('click', (e) => {
            const navElement = e.target.closest('[data-navigate]');
            if (navElement) {
                e.preventDefault();
                const page = navElement.getAttribute('data-navigate');
                console.log(`🖱️ Navigation clicked: ${page}`);
                this.navigateTo(page);
            }
        });
        
        console.log('✅ Navigation event listeners set up');
    }

    async navigateTo(page) {
        console.log(`🧭 Navigating to: ${page}`);
        
        if (this.isLoading) {
            console.log('⏳ Already loading, skipping navigation');
            return;
        }

        // Special handling for booking
        if (page === 'booking') {
            console.log('🔄 Redirecting to booking page');
            window.location.href = '/booking';
            return;
        }

        try {
            this.isLoading = true;
            
            // Hide all pages
            console.log('👁️ Hiding all pages');
            this.hideAllPages();
            
            // Show target page
            console.log(`👁️ Showing page: ${page}`);
            this.showPage(page);
            
            // Load content if needed
            console.log(`📥 Loading content for: ${page}`);
            await this.loadPageContent(page);
            
            // Update state
            this.currentPage = page;
            this.updateNavbar(page);
            
            console.log(`✅ Successfully navigated to: ${page}`);
            
        } catch (error) {
            console.error(`❌ Navigation error for ${page}:`, error);
            this.showError(page, error.message);
        } finally {
            this.isLoading = false;
        }
    }

    hideAllPages() {
        const pages = document.querySelectorAll('[data-page]');
        console.log(`👁️ Found ${pages.length} pages to hide`);
        
        pages.forEach(page => {
            const pageName = page.getAttribute('data-page');
            page.style.display = 'none';
            console.log(`👁️ Hidden page: ${pageName}`);
        });
    }

    showPage(page) {
        const pageElement = document.querySelector(`[data-page="${page}"]`);
        console.log(`👁️ Looking for page element: [data-page="${page}"]`);
        
        if (pageElement) {
            pageElement.style.display = 'block';
            console.log(`✅ Showing page: ${page}`);
        } else {
            console.error(`❌ Page element not found: ${page}`);
        }
    }

    async loadPageContent(page) {
        console.log(`📥 Loading content for: ${page}`);

        // Skip home page
        if (page === 'home') {
            console.log('🏠 Home page, no loading needed');
            return;
        }

        const pageElement = document.querySelector(`[data-page="${page}"]`);
        const lazyContent = pageElement?.querySelector('.lazy-content');
        
        console.log(`📥 Page element found: ${!!pageElement}`);
        console.log(`📥 Lazy content found: ${!!lazyContent}`);
        
        if (!lazyContent) {
            console.log(`📥 No lazy content for ${page}, assuming already loaded`);
            return;
        }

        // Check if already cached
        if (this.cache.has(page)) {
            console.log(`💾 Content already cached for: ${page}`);
            return;
        }

        console.log(`🌐 Making AJAX request for: ${page}`);

        // Show loading state
        lazyContent.innerHTML = `
            <div class="flex items-center justify-center min-h-screen">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-yellow-400"></div>
                <span class="ml-4 text-white text-lg">Memuat ${page}...</span>
            </div>
        `;

        try {
            const url = `/ajax/${page}`;
            console.log(`🌐 Fetching: ${url}`);
            
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            console.log(`🌐 Response status: ${response.status}`);
            console.log(`🌐 Response headers:`, response.headers);

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }

            const data = await response.json();
            console.log(`🌐 Response data:`, data);

            if (data.success && data.html) {
                console.log(`✅ Replacing content for: ${page}`);
                lazyContent.outerHTML = data.html;
                this.cache.set(page, true);
                console.log(`✅ Successfully loaded content for: ${page}`);
            } else {
                throw new Error(data.message || 'Invalid response format');
            }

        } catch (error) {
            console.error(`❌ AJAX error for ${page}:`, error);
            this.showError(page, error.message);
            throw error;
        }
    }

    showError(page, errorMessage) {
        console.log(`❌ Showing error for ${page}: ${errorMessage}`);
        
        const pageElement = document.querySelector(`[data-page="${page}"]`);
        if (pageElement) {
            pageElement.innerHTML = `
                <div class="flex items-center justify-center min-h-screen">
                    <div class="text-center text-white">
                        <h2 class="text-2xl mb-4">Gagal Memuat ${page}</h2>
                        <p class="text-red-400 mb-6">${errorMessage}</p>
                        <div class="space-x-4">
                            <button onclick="window.debugApp.navigateTo('${page}')" 
                                    class="px-6 py-2 bg-yellow-400 text-black rounded hover:bg-yellow-500">
                                Coba Lagi
                            </button>
                            <button onclick="window.location.reload()" 
                                    class="px-6 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                                Refresh Halaman
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }
    }

    updateNavbar(page) {
        console.log(`🎨 Updating navbar for: ${page}`);
        
        // Update all navigation elements
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
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    console.log('🚀 DOM Content Loaded');
    
    // Only initialize on barbershop pages
    if (window.location.pathname.startsWith('/admin') || 
        window.location.pathname.startsWith('/barber')) {
        console.log('⏭️ Skipping navigation on admin/barber pages');
        return;
    }
    
    console.log('🚀 Initializing Debug Barbershop Navigation');
    window.debugApp = new DebugBarbershopApp();
    console.log('✅ Debug app initialized and available as window.debugApp');
});

console.log('✅ Debug Navigation System loaded');