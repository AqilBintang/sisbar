// Minimal Navigation - Focus on fixing the barbers issue
console.log('🚀 Minimal Navigation Loading...');

// Simple navigation without complex logic
function initMinimalNavigation() {
    console.log('🔧 Initializing Minimal Navigation');
    
    // Handle navigation clicks
    document.addEventListener('click', async function(e) {
        const navLink = e.target.closest('[data-navigate]');
        if (!navLink) return;
        
        e.preventDefault();
        const page = navLink.getAttribute('data-navigate');
        console.log(`🖱️ Clicked navigation: ${page}`);
        
        // Special handling for booking
        if (page === 'booking') {
            window.location.href = '/booking';
            return;
        }
        
        // Hide all pages
        document.querySelectorAll('[data-page]').forEach(p => {
            p.style.display = 'none';
        });
        
        // Show target page
        const targetPage = document.querySelector(`[data-page="${page}"]`);
        if (targetPage) {
            targetPage.style.display = 'block';
            console.log(`👁️ Showing page: ${page}`);
        }
        
        // Load content for barbers page specifically
        if (page === 'barbers') {
            await loadBarbersContent();
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
    });
    
    console.log('✅ Minimal Navigation initialized');
}

// Load barbers content specifically
async function loadBarbersContent() {
    console.log('📥 Loading barbers content...');
    
    const barbersPage = document.querySelector('[data-page="barbers"]');
    const lazyContent = barbersPage?.querySelector('.lazy-content');
    
    if (!lazyContent) {
        console.log('📥 No lazy content found, assuming already loaded');
        return;
    }
    
    // Show loading
    lazyContent.innerHTML = `
        <div class="flex items-center justify-center min-h-screen">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-yellow-400"></div>
            <span class="ml-4 text-white text-xl">Memuat Kapster...</span>
        </div>
    `;
    
    try {
        console.log('🌐 Fetching /ajax/barbers...');
        
        const response = await fetch('/ajax/barbers', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
        
        console.log(`🌐 Response status: ${response.status}`);
        
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}`);
        }
        
        const data = await response.json();
        console.log('🌐 Response data:', data);
        
        if (data.success && data.html) {
            // Replace the entire lazy content with the HTML
            lazyContent.outerHTML = data.html;
            console.log('✅ Barbers content loaded successfully!');
        } else {
            throw new Error(data.message || 'Invalid response');
        }
        
    } catch (error) {
        console.error('❌ Failed to load barbers:', error);
        
        lazyContent.innerHTML = `
            <div class="flex items-center justify-center min-h-screen">
                <div class="text-center text-white">
                    <h2 class="text-2xl mb-4">Gagal Memuat Kapster</h2>
                    <p class="text-red-400 mb-6">${error.message}</p>
                    <button onclick="loadBarbersContent()" 
                            class="px-6 py-2 bg-yellow-400 text-black rounded hover:bg-yellow-500 mr-2">
                        Coba Lagi
                    </button>
                    <button onclick="window.location.reload()" 
                            class="px-6 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                        Refresh
                    </button>
                </div>
            </div>
        `;
    }
}

// Make loadBarbersContent available globally for retry button
window.loadBarbersContent = loadBarbersContent;

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 DOM Ready');
    
    // Skip on admin/barber pages
    if (window.location.pathname.startsWith('/admin') || 
        window.location.pathname.startsWith('/barber')) {
        console.log('⏭️ Skipping on admin/barber pages');
        return;
    }
    
    initMinimalNavigation();
});

console.log('✅ Minimal Navigation script loaded');