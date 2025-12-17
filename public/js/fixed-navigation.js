// Fixed Navigation - Direct approach
console.log('🚀 Fixed Navigation Loading...');

// Global function to load barbers (for debugging)
window.loadBarbers = async function() {
    console.log('🔧 Manual loadBarbers called');
    
    const barbersPage = document.querySelector('[data-page="barbers"]');
    console.log('📍 Barbers page element:', barbersPage);
    
    if (!barbersPage) {
        console.error('❌ Barbers page element not found!');
        return;
    }
    
    const lazyContent = barbersPage.querySelector('.lazy-content');
    console.log('📍 Lazy content element:', lazyContent);
    
    if (!lazyContent) {
        console.log('📍 No lazy content - content might already be loaded');
        return;
    }
    
    // Show loading immediately
    lazyContent.innerHTML = `
        <div class="flex items-center justify-center min-h-screen bg-gray-900">
            <div class="text-center">
                <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-yellow-400 mx-auto mb-4"></div>
                <p class="text-white text-xl">Memuat Data Kapster...</p>
                <p class="text-gray-400 text-sm mt-2">Mohon tunggu sebentar</p>
            </div>
        </div>
    `;
    
    try {
        console.log('🌐 Starting AJAX request to /ajax/barbers');
        
        const response = await fetch('/ajax/barbers', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });
        
        console.log('🌐 Response received:', {
            status: response.status,
            statusText: response.statusText,
            ok: response.ok,
            headers: Object.fromEntries(response.headers.entries())
        });
        
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        
        const data = await response.json();
        console.log('🌐 Response data:', {
            success: data.success,
            count: data.count,
            htmlLength: data.html ? data.html.length : 0,
            hasHtml: !!data.html
        });
        
        if (data.success && data.html) {
            console.log('✅ Replacing lazy content with actual barber data');
            lazyContent.outerHTML = data.html;
            console.log('✅ Barbers content loaded successfully!');
        } else {
            throw new Error(data.message || 'Invalid response format');
        }
        
    } catch (error) {
        console.error('❌ AJAX request failed:', error);
        
        lazyContent.innerHTML = `
            <div class="flex items-center justify-center min-h-screen bg-gray-900">
                <div class="text-center text-white">
                    <h2 class="text-2xl mb-4">❌ Gagal Memuat Kapster</h2>
                    <p class="text-red-400 mb-6">${error.message}</p>
                    <div class="space-x-4">
                        <button onclick="window.loadBarbers()" 
                                class="px-6 py-2 bg-yellow-400 text-black rounded hover:bg-yellow-500">
                            🔄 Coba Lagi
                        </button>
                        <button onclick="window.location.reload()" 
                                class="px-6 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                            🔄 Refresh Halaman
                        </button>
                    </div>
                </div>
            </div>
        `;
    }
};

// Navigation handler
function handleNavigation() {
    console.log('🔧 Setting up navigation handler');
    
    document.addEventListener('click', async function(e) {
        const navLink = e.target.closest('[data-navigate]');
        if (!navLink) return;
        
        e.preventDefault();
        const page = navLink.getAttribute('data-navigate');
        console.log(`🖱️ Navigation clicked: ${page}`);
        
        // Special handling for booking
        if (page === 'booking') {
            console.log('🔄 Redirecting to booking page');
            window.location.href = '/booking';
            return;
        }
        
        // Hide all pages
        console.log('👁️ Hiding all pages');
        document.querySelectorAll('[data-page]').forEach(p => {
            p.style.display = 'none';
            console.log(`👁️ Hidden: ${p.getAttribute('data-page')}`);
        });
        
        // Show target page
        const targetPage = document.querySelector(`[data-page="${page}"]`);
        if (targetPage) {
            targetPage.style.display = 'block';
            console.log(`👁️ Showing page: ${page}`);
        } else {
            console.error(`❌ Target page not found: ${page}`);
        }
        
        // Load content for barbers page
        if (page === 'barbers') {
            console.log('📥 Loading barbers content...');
            await window.loadBarbers();
        }
        
        // Update navigation active state
        document.querySelectorAll('[data-navigate]').forEach(nav => {
            if (nav.getAttribute('data-navigate') === page) {
                nav.classList.add('text-yellow-400');
                nav.classList.remove('text-gray-300');
            } else {
                nav.classList.remove('text-yellow-400');
                nav.classList.add('text-gray-300');
            }
        });
        
        console.log(`✅ Navigation to ${page} completed`);
    });
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 DOM Ready - Fixed Navigation');
    
    // Skip on admin/barber pages
    if (window.location.pathname.startsWith('/admin') || 
        window.location.pathname.startsWith('/barber')) {
        console.log('⏭️ Skipping on admin/barber pages');
        return;
    }
    
    console.log('🔧 Initializing Fixed Navigation');
    handleNavigation();
    console.log('✅ Fixed Navigation initialized');
    
    // Add debug info
    console.log('🔍 Debug info:', {
        currentPath: window.location.pathname,
        barbersPageExists: !!document.querySelector('[data-page="barbers"]'),
        lazyContentExists: !!document.querySelector('[data-page="barbers"] .lazy-content'),
        navigationLinksCount: document.querySelectorAll('[data-navigate]').length
    });
});

console.log('✅ Fixed Navigation script loaded');