<nav class="bg-black shadow-lg fixed top-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="flex items-center space-x-3 navbar-logo-container">
                    <img src="{{ asset('images/logo-sisbar.png') }}" alt="Sisbar Hairstudio" class="h-10 w-auto object-contain filter brightness-0 invert" 
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <span class="text-accent font-bold text-lg hidden">Sisbar Hairstudio</span>
                    <span class="text-white font-bold text-lg hover:text-accent transition-colors duration-300 ml-3">Sisbar Hairstudio</span>
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
/* Active navigation item styles */
.nav-link.active {
    color: #fbbf24 !important; /* text-accent */
    background-color: rgba(251, 191, 36, 0.15) !important; /* bg-accent/15 */
}

/* Simple hover effects for better performance */
.nav-link:hover {
    background-color: rgba(251, 191, 36, 0.1);
}

/* Mobile menu active state */
@media (max-width: 768px) {
    .nav-link.active {
        border-left: 3px solid #fbbf24;
        padding-left: 1rem;
    }
}

/* Optimized transitions - only color changes */
.nav-link {
    transition: color 0.2s ease, background-color 0.2s ease;
}

/* Simplified logo hover */
.navbar-logo-container:hover span {
    color: #fbbf24;
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
});
</script>