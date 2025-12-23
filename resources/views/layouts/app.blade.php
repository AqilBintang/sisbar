<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sisbar Hairstudio')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-sisbar.png') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="min-h-screen bg-background">
    @include('components.navbar')

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

    <!-- Floating WhatsApp Widget -->
    @include('components.whatsapp-float')

    @stack('scripts')
    
    <!-- Premium Navigation Enhancement Script -->
    <script>
    // Global navigation enhancement for all pages
    document.addEventListener('DOMContentLoaded', function() {
        // Detect current page from URL and set active navigation
        function setNavigationFromURL() {
            const path = window.location.pathname;
            let activePage = 'home';
            
            // Map URL paths to navigation items
            if (path.includes('/booking')) {
                activePage = 'booking';
            } else if (path.includes('/services') || path.includes('/layanan')) {
                activePage = 'services';
            } else if (path.includes('/barbers') || path.includes('/kapster')) {
                activePage = 'barbers';
            } else if (path.includes('/availability')) {
                activePage = 'availability';
            }
            
            // Check for visible sections in single-page navigation
            const visiblePage = document.querySelector('[data-page]:not([style*="display: none"])');
            if (visiblePage) {
                const pageType = visiblePage.getAttribute('data-page');
                if (pageType && pageType !== 'home') {
                    activePage = pageType;
                }
            }
            
            // Apply active state
            document.querySelectorAll('.nav-link').forEach(link => {
                const linkPage = link.getAttribute('data-navigate') || link.getAttribute('data-nav-item');
                
                if (linkPage === activePage) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
            
            console.log(`🎯 Navigation active state set for: ${activePage}`);
        }
        
        // Set initial navigation state
        setTimeout(setNavigationFromURL, 100);
        
        // Listen for navigation changes
        window.addEventListener('popstate', setNavigationFromURL);
        
        // Handle navigation clicks for pages that need redirect
        document.addEventListener('click', function(e) {
            const navLink = e.target.closest('[data-navigate]');
            if (!navLink) return;
            
            const targetPage = navLink.getAttribute('data-navigate');
            console.log(`🖱️ Navigation clicked: ${targetPage}`);
            
            // Handle availability navigation - redirect to home with availability section
            if (targetPage === 'availability') {
                e.preventDefault();
                console.log('🔄 Redirecting to home page with availability section');
                
                // Add loading state to navigation
                navLink.classList.add('loading');
                
                // Redirect to home page and show availability
                setTimeout(() => {
                    window.location.href = '/#availability';
                }, 200);
                return;
            }
            
            // Handle other navigation that requires redirect
            if (targetPage === 'home' || targetPage === 'services' || targetPage === 'barbers') {
                e.preventDefault();
                console.log(`🔄 Redirecting to home page with ${targetPage} section`);
                
                // Add loading state
                navLink.classList.add('loading');
                
                // Redirect to home page
                setTimeout(() => {
                    if (targetPage === 'home') {
                        window.location.href = '/';
                    } else {
                        window.location.href = `/#${targetPage}`;
                    }
                }, 200);
                return;
            }
        });
    });
    </script>
</body>
</html>