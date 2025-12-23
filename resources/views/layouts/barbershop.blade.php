<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sisbar Hairstudio')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-sisbar.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo-sisbar.png') }}">
    
    <!-- Google Fonts - Elegant Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="min-h-screen bg-background">
    @include('components.navbar')

    <!-- Page Content -->
    <main>
        <!-- Landing Page -->
        <div data-page="home" style="display: {{ request()->is('/') ? 'block' : 'none' }}">
            @include('components.landing-page')
        </div>

        <!-- Services Page -->
        <div data-page="services" style="display: {{ request()->is('services*') ? 'block' : 'none' }}">
            @php
                // Use optimized service for better performance
                $uiService = app(\App\Services\UserInterfaceService::class);
                $services = $uiService->getServices();
            @endphp
            @include('components.service-list-dynamic', ['services' => $services])
        </div>

        <!-- Barbers Page -->
        <div data-page="barbers" style="display: {{ request()->is('barbers*') ? 'block' : 'none' }}">
            @if(request()->is('barbers*'))
                @php
                    // Use optimized service for better performance
                    $uiService = app(\App\Services\UserInterfaceService::class);
                    $barbers = $uiService->getBarbers();
                @endphp
                @include('components.barber-profile', ['barbers' => $barbers])
            @else
                <!-- Content will be loaded via AJAX when navigating -->
                <div class="pt-20 min-h-screen flex items-center justify-center">
                    <div class="text-center">
                        <div class="animate-pulse">
                            <div class="w-16 h-16 bg-yellow-400/20 rounded-full mx-auto mb-4"></div>
                            <h2 class="text-xl font-semibold text-white mb-2">Siap Memuat Data Kapster</h2>
                            <p class="text-gray-300">Klik navigasi Kapster untuk melihat tim profesional kami</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Booking Page -->
        <div data-page="booking" style="display: {{ request()->is('booking*') ? 'block' : 'none' }}">
            @include('components.booking-page')
        </div>

        <!-- Confirmation Page -->
        <div data-page="confirmation" style="display: {{ request()->is('confirmation*') ? 'block' : 'none' }}">
            @include('components.confirmation-page')
        </div>

        <!-- Notifications Page -->
        <div data-page="notifications" style="display: {{ request()->is('notifications*') ? 'block' : 'none' }}">
            @include('components.notification-template')
        </div>

        <!-- Availability Checker Page -->
        <div data-page="availability" style="display: none;">
            @include('components.availability-checker')
        </div>

        <!-- Gallery Page -->
        <div data-page="gallery" style="display: {{ request()->is('gallery*') ? 'block' : 'none' }}">
            @include('components.gallery-section')
        </div>

        <!-- Admin Dashboard -->
        <div data-page="admin" style="display: {{ request()->is('admin*') ? 'block' : 'none' }}">
            @include('components.admin-dashboard')
        </div>

        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')
    
    <!-- Floating WhatsApp Widget -->
    @include('components.whatsapp-float')

    @stack('scripts')
    
    <!-- Premium Navigation Enhancement Script -->
    <script>
    // Global navigation enhancement for barbershop layout
    document.addEventListener('DOMContentLoaded', function() {
        // Detect current page and set active navigation
        function setNavigationFromContext() {
            const path = window.location.pathname;
            const hash = window.location.hash;
            let activePage = 'home';
            
            // Check URL-based detection first
            if (path.includes('/booking')) {
                activePage = 'booking';
            } else if (path.includes('/services')) {
                activePage = 'services';
            } else if (path.includes('/barbers')) {
                activePage = 'barbers';
            } else if (path.includes('/availability')) {
                activePage = 'availability';
            } else {
                // Check visible sections for single-page navigation
                const visiblePage = document.querySelector('[data-page]:not([style*="display: none"])');
                if (visiblePage) {
                    const pageType = visiblePage.getAttribute('data-page');
                    if (pageType && pageType !== 'home') {
                        activePage = pageType;
                    }
                }
                
                // Check hash-based navigation (including availability)
                if (hash) {
                    const sectionMap = {
                        '#mengapa-pilih-kami': 'services',
                        '#layanan': 'services',
                        '#kapster': 'barbers',
                        '#booking': 'booking',
                        '#services': 'services',
                        '#barbers': 'barbers',
                        '#availability': 'availability'  // Re-added for proper hash detection
                    };
                    activePage = sectionMap[hash] || activePage;
                    
                    // Show the appropriate page if hash matches
                    if (sectionMap[hash]) {
                        const targetPageElement = document.querySelector(`[data-page="${sectionMap[hash]}"]`);
                        if (targetPageElement) {
                            // Hide all pages first
                            document.querySelectorAll('[data-page]').forEach(page => {
                                page.style.display = 'none';
                            });
                            // Show target page
                            targetPageElement.style.display = 'block';
                            
                            // Initialize availability checker if needed
                            if (sectionMap[hash] === 'availability' && window.initAvailabilityChecker) {
                                setTimeout(() => {
                                    window.initAvailabilityChecker();
                                }, 300);
                            }
                        }
                    }
                }
            }
            
            // Apply premium active state
            document.querySelectorAll('.nav-link').forEach(link => {
                const linkPage = link.getAttribute('data-navigate') || link.getAttribute('data-nav-item');
                
                if (linkPage === activePage) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
            
            console.log(`✨ Premium navigation active state set for: ${activePage}`);
        }
        
        // Set initial navigation state with delay to ensure DOM is ready
        setTimeout(setNavigationFromContext, 150);
        
        // Listen for hash changes and navigation
        window.addEventListener('hashchange', setNavigationFromContext);
        window.addEventListener('popstate', setNavigationFromContext);
        
        // Observer for dynamic page changes
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                    const target = mutation.target;
                    if (target.hasAttribute('data-page') && target.style.display !== 'none') {
                        setTimeout(setNavigationFromContext, 50);
                    }
                }
            });
        });
        
        // Observe all page elements for visibility changes
        document.querySelectorAll('[data-page]').forEach(page => {
            observer.observe(page, { attributes: true, attributeFilter: ['style'] });
        });
    });
    </script>
</body>
</html>