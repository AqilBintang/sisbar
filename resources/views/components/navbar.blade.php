<nav class="bg-black shadow-lg fixed top-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="flex items-center space-x-3 navbar-logo-container">
                    <img src="{{ asset('images/logo-sisbar.png') }}" alt="Sisbar Hairstudio" class="h-14 w-auto object-contain filter brightness-0 invert" 
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <span class="text-accent font-bold text-lg hidden">Sisbar Hairstudio</span>
                    <span class="text-white font-bold text-xl hover:text-accent transition-colors duration-300 ml-3">Sisbar Hairstudio</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:block">
                <div class="flex items-center space-x-8">
                    <button data-navigate="home" data-nav-item="home"
                       class="nav-link cursor-pointer text-white hover:text-accent px-3 py-2 rounded-lg transition-colors duration-200 font-medium">
                        Home
                    </button>
                    <button data-navigate="services" data-nav-item="services"
                       class="nav-link cursor-pointer text-white hover:text-accent px-3 py-2 rounded-lg transition-colors duration-200 font-medium">
                        Layanan
                    </button>
                    <button data-navigate="barbers" data-nav-item="barbers"
                       class="nav-link cursor-pointer text-white hover:text-accent px-3 py-2 rounded-lg transition-colors duration-200 font-medium">
                        Kapster
                    </button>
                    <button data-navigate="booking" data-nav-item="booking"
                       class="nav-link cursor-pointer text-white hover:text-accent px-3 py-2 rounded-lg transition-colors duration-200 font-medium">
                        Booking
                    </button>
                    <button data-navigate="availability" data-nav-item="availability"
                       class="nav-link cursor-pointer text-white hover:text-accent px-3 py-2 rounded-lg transition-colors duration-200 font-medium">
                        Cek Ketersediaan
                    </button>
                </div>
            </div>

            <!-- Book Now Button & Profile -->
            <div class="hidden md:flex items-center space-x-4">
                <button data-navigate="booking" class="bg-accent text-black px-6 py-2 rounded-lg font-semibold hover:bg-yellow-400 transition-colors">
                    Book Now
                </button>
                
                @auth
                <!-- Profile Icon -->
                <div class="relative group">
                    <div class="cursor-pointer hover:scale-110 transition-transform duration-200 profile-icon flex items-center">
                        @if(auth()->user()->avatar)
                            <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full object-cover border-2 border-accent">
                        @else
                            <svg class="w-7 h-7 text-accent hover:text-yellow-400 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        @endif
                    </div>
                    
                    <!-- Profile Dropdown -->
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="py-2">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-sm font-semibold text-gray-900">Halo, {{ auth()->user()->name }}!</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                            </div>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profil Saya
                            </a>
                            <a href="{{ route('booking.status') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Cek Status Booking
                            </a>
                            <div class="border-t border-gray-100 mt-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors text-left">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <!-- Login Button -->
                <a href="{{ route('login') }}" class="flex items-center px-4 py-2 bg-accent text-black rounded-lg font-semibold hover:bg-yellow-400 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Login
                </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" id="mobile-menu-button" class="text-white hover:text-accent focus:outline-none focus:text-accent">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div id="mobile-menu" class="md:hidden hidden">
        <div class="px-4 pt-2 pb-3 space-y-1 bg-black border-t border-gray-800">
            <button data-navigate="home" data-nav-item="home" class="nav-link cursor-pointer text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium w-full text-left transition-colors duration-200">Home</button>
            <button data-navigate="services" data-nav-item="services" class="nav-link cursor-pointer text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium w-full text-left transition-colors duration-200">Layanan</button>
            <button data-navigate="barbers" data-nav-item="barbers" class="nav-link cursor-pointer text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium w-full text-left transition-colors duration-200">Kapster</button>
            <button data-navigate="booking" data-nav-item="booking" class="nav-link cursor-pointer text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium w-full text-left transition-colors duration-200">Booking</button>
            <button data-navigate="availability" data-nav-item="availability" class="nav-link cursor-pointer text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium text-left w-full transition-colors duration-200">Cek Ketersediaan</button>
            
            @auth
            <!-- Mobile Profile Section -->
            <div class="border-t border-gray-700 pt-4 mt-4">
                <div class="flex items-center px-3 py-2">
                    <div class="mr-3">
                        @if(auth()->user()->avatar)
                            <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full object-cover">
                        @else
                            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        @endif
                    </div>
                    <div>
                        <p class="text-white text-sm font-medium">Halo, {{ auth()->user()->name }}!</p>
                        <p class="text-gray-400 text-xs">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <a href="#" class="text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium">Profil Saya</a>
                <a href="{{ route('booking.status') }}" class="text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium">Cek Status Booking</a>
                <form method="POST" action="{{ route('logout') }}" class="px-3 py-2">
                    @csrf
                    <button type="submit" class="text-red-400 hover:text-red-300 text-left text-base font-medium w-full">Logout</button>
                </form>
            </div>
            @else
            <!-- Mobile Login Section -->
            <div class="border-t border-gray-700 pt-4 mt-4">
                <a href="{{ route('login') }}" class="text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium">Login dengan Google</a>
            </div>
            @endauth
            
            <div class="pt-4">
                <button data-navigate="booking" class="w-full bg-accent text-black px-4 py-2 rounded-lg font-semibold hover:bg-yellow-400 transition-colors">
                    Book Now
                </button>
            </div>
        </div>
    </div>
</nav>

<style>
/* Premium Active Navigation Styles */
.nav-link.active {
    color: #fbbf24 !important; /* text-accent */
    background: linear-gradient(135deg, rgba(251, 191, 36, 0.2), rgba(251, 191, 36, 0.1)) !important;
    box-shadow: 0 0 20px rgba(251, 191, 36, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.1) !important;
    border: 1px solid rgba(251, 191, 36, 0.3) !important;
    position: relative;
    overflow: hidden;
}

/* Premium Glow Animation */
.nav-link.active::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    animation: shimmer 2s infinite;
    z-index: 1;
}

/* Premium Pulse Effect */
.nav-link.active::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(251, 191, 36, 0.1);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    animation: pulse-ring 2s infinite;
    z-index: 0;
}

/* Shimmer Animation */
@keyframes shimmer {
    0% { left: -100%; }
    100% { left: 100%; }
}

/* Pulse Ring Animation */
@keyframes pulse-ring {
    0% {
        width: 0;
        height: 0;
        opacity: 1;
    }
    100% {
        width: 100px;
        height: 100px;
        opacity: 0;
    }
}

/* Premium Hover Effects */
.nav-link:hover:not(.active) {
    background: linear-gradient(135deg, rgba(251, 191, 36, 0.1), rgba(251, 191, 36, 0.05));
    box-shadow: 0 0 15px rgba(251, 191, 36, 0.2);
    border: 1px solid rgba(251, 191, 36, 0.2);
    transform: translateY(-1px);
}

/* Mobile menu active state with premium styling */
@media (max-width: 768px) {
    .nav-link.active {
        border-left: 4px solid #fbbf24;
        padding-left: 1rem;
        background: linear-gradient(90deg, rgba(251, 191, 36, 0.2), rgba(251, 191, 36, 0.05));
        box-shadow: inset 0 0 20px rgba(251, 191, 36, 0.1);
    }
}

/* Enhanced transitions with premium feel */
.nav-link {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 1;
    border: 1px solid transparent;
}

/* Logo hover with premium glow */
.navbar-logo-container:hover span {
    color: #fbbf24;
    text-shadow: 0 0 10px rgba(251, 191, 36, 0.5);
}

/* Premium loading state */
.nav-link.loading {
    opacity: 0.7;
    pointer-events: none;
}

.nav-link.loading::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(90deg, transparent, rgba(251, 191, 36, 0.3), transparent);
    animation: loading-sweep 1.5s infinite;
}

@keyframes loading-sweep {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
        if (mobileMenu && !mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
            mobileMenu.classList.add('hidden');
        }
    });
    
    // Close mobile menu when clicking on navigation items
    document.querySelectorAll('[data-navigate]').forEach(item => {
        item.addEventListener('click', function() {
            if (mobileMenu) {
                mobileMenu.classList.add('hidden');
            }
        });
    });
    
    // Premium Navigation System with Active State Detection
    function initPremiumNavigation() {
        console.log('🌟 Initializing Premium Navigation System');
        
        // Function to detect current page/section
        function getCurrentPage() {
            const path = window.location.pathname;
            
            // Check URL-based pages first
            if (path.includes('/booking')) return 'booking';
            if (path.includes('/services')) return 'services';
            if (path.includes('/barbers')) return 'barbers';
            if (path.includes('/availability')) return 'availability';
            
            // Check visible sections for single-page navigation
            const visiblePage = document.querySelector('[data-page]:not([style*="display: none"])');
            if (visiblePage) {
                const pageType = visiblePage.getAttribute('data-page');
                if (pageType && pageType !== 'home') return pageType;
            }
            
            // For hash-based navigation (excluding availability for cleaner navigation)
            const hash = window.location.hash;
            if (hash) {
                const sectionMap = {
                    '#mengapa-pilih-kami': 'services',
                    '#layanan': 'services',
                    '#kapster': 'barbers',
                    '#booking': 'booking'
                    // Removed #availability to prevent hash navigation issues
                };
                return sectionMap[hash] || 'home';
            }
            
            // Default to home
            return 'home';
        }
        
        // Function to update active states with premium animations
        function updateActiveStates(activePage) {
            console.log(`🎯 Setting active state for: ${activePage}`);
            
            document.querySelectorAll('.nav-link').forEach(link => {
                const linkPage = link.getAttribute('data-navigate') || link.getAttribute('data-nav-item');
                
                if (linkPage === activePage) {
                    // Add premium active state
                    link.classList.add('active');
                    
                    // Add premium loading effect briefly
                    link.classList.add('loading');
                    setTimeout(() => {
                        link.classList.remove('loading');
                    }, 300);
                    
                    console.log(`✨ Activated: ${linkPage}`);
                } else {
                    link.classList.remove('active', 'loading');
                }
            });
        }
        
        // Enhanced navigation handler with premium effects
        function handlePremiumNavigation(e) {
            const navLink = e.target.closest('[data-navigate]');
            if (!navLink) return;
            
            e.preventDefault();
            const targetPage = navLink.getAttribute('data-navigate');
            
            console.log(`🚀 Premium navigation to: ${targetPage}`);
            
            // Add premium loading state
            navLink.classList.add('loading');
            
            // Handle special cases
            if (targetPage === 'booking' && !window.location.pathname.includes('/booking')) {
                console.log('🔄 Redirecting to booking page');
                setTimeout(() => {
                    window.location.href = '/booking';
                }, 200);
                return;
            }
            
            // Handle availability navigation - redirect to home if not on barbershop layout
            if (targetPage === 'availability' && !document.querySelector(`[data-page="availability"]`)) {
                console.log('🔄 Redirecting to home page for availability');
                setTimeout(() => {
                    window.location.href = '/#availability';
                }, 200);
                return;
            }
            
            // Handle single-page navigation
            if (document.querySelector(`[data-page="${targetPage}"]`)) {
                // Hide all pages with fade effect
                document.querySelectorAll('[data-page]').forEach(page => {
                    page.style.display = 'none';
                });
                
                // Show target page
                const targetPageElement = document.querySelector(`[data-page="${targetPage}"]`);
                if (targetPageElement) {
                    targetPageElement.style.display = 'block';
                    
                    // Smooth scroll to top
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
                
                // Load dynamic content if needed
                if (targetPage === 'barbers' && window.loadBarbers) {
                    window.loadBarbers();
                }
                
                // Initialize availability checker if navigating to availability
                if (targetPage === 'availability' && window.initAvailabilityChecker) {
                    console.log('🔄 Initializing availability checker after navigation');
                    setTimeout(() => {
                        window.initAvailabilityChecker();
                    }, 200);
                }
            }
            
            // Update active states
            setTimeout(() => {
                updateActiveStates(targetPage);
                navLink.classList.remove('loading');
            }, 300);
            
            // Update URL without hash for cleaner navigation
            // Only update URL for home page, other pages handle their own routing
            if (targetPage === 'home') {
                history.pushState(null, '', '/');
            }
            // For other pages like availability, services, barbers - don't change URL
            // This prevents hash-based navigation issues
        }
        
        // Set up navigation event listeners
        document.querySelectorAll('[data-navigate]').forEach(link => {
            link.addEventListener('click', handlePremiumNavigation);
        });
        
        // Initial active state detection
        const currentPage = getCurrentPage();
        updateActiveStates(currentPage);
        
        // Listen for browser back/forward buttons
        window.addEventListener('popstate', function() {
            const currentPage = getCurrentPage();
            updateActiveStates(currentPage);
        });
        
        // Listen for page visibility changes (for dynamic content)
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                    const target = mutation.target;
                    if (target.hasAttribute('data-page') && target.style.display !== 'none') {
                        const pageType = target.getAttribute('data-page');
                        updateActiveStates(pageType);
                    }
                }
            });
        });
        
        // Observe all page elements
        document.querySelectorAll('[data-page]').forEach(page => {
            observer.observe(page, { attributes: true, attributeFilter: ['style'] });
        });
        
        console.log('✨ Premium Navigation System initialized');
    }
    
    // Initialize premium navigation
    initPremiumNavigation();
});
</script>