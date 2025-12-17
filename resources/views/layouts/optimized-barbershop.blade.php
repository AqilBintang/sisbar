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
    
    <!-- Preload critical resources -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" as="style">
    <link rel="preload" href="{{ asset('images/logo-sisbar.png') }}" as="image">
    
    <!-- Google Fonts - Optimized loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css'])
    
    <!-- Critical CSS inline for faster loading -->
    <style>
        .page-transition {
            transition: opacity 0.15s ease-in-out;
        }
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .nav-loading {
            opacity: 0.7;
            pointer-events: none;
        }
    </style>
    
    @stack('styles')
</head>
<body class="min-h-screen bg-background">
    @include('components.navbar')

    <!-- Loading indicator -->
    <div id="page-loader" class="fixed top-0 left-0 w-full h-1 bg-gray-200 z-50" style="display: none;">
        <div class="h-full bg-accent transition-all duration-300 ease-out" style="width: 0%"></div>
    </div>

    <!-- Page Content Container -->
    <main id="main-content" class="page-transition">
        <!-- Landing Page - Always loaded for performance -->
        <div data-page="home" class="page-content" style="display: {{ request()->is('/') || request()->is('barbershop') ? 'block' : 'none' }}">
            @include('components.landing-page')
        </div>

        <!-- Services Page - Lazy loaded -->
        <div data-page="services" class="page-content" style="display: {{ request()->is('services*') ? 'block' : 'none' }}">
            @if(request()->is('services*'))
                @php
                    $services = \App\Models\Service::where('is_active', true)
                        ->select('id', 'name', 'description', 'price', 'duration', 'type', 'image', 'features')
                        ->orderBy('type')
                        ->orderBy('price')
                        ->get();
                @endphp
                @include('components.service-list-dynamic', ['services' => $services])
            @else
                <div class="lazy-content" data-lazy-load="services">
                    <div class="flex items-center justify-center min-h-screen">
                        <div class="loading-spinner"></div>
                        <span class="ml-2">Memuat layanan...</span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Barbers Page - Lazy loaded -->
        <div data-page="barbers" class="page-content" style="display: none;">
            <div class="lazy-content" data-lazy-load="barbers">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="loading-spinner"></div>
                    <span class="ml-2">Memuat profil barber...</span>
                </div>
            </div>
        </div>

        <!-- Booking Page - Redirect to Laravel route -->
        <div data-page="booking" class="page-content" style="display: none;">
            <!-- This will redirect to /booking route -->
        </div>

        <!-- Gallery Page - Lazy loaded -->
        <div data-page="gallery" class="page-content" style="display: {{ request()->is('gallery*') ? 'block' : 'none' }}">
            @if(request()->is('gallery*'))
                @include('components.gallery-section')
            @else
                <div class="lazy-content" data-lazy-load="gallery">
                    <div class="flex items-center justify-center min-h-screen">
                        <div class="loading-spinner"></div>
                        <span class="ml-2">Memuat galeri...</span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Availability Checker - SPA only -->
        <div data-page="availability" class="page-content" style="display: none;">
            @include('components.availability-checker')
        </div>

        @yield('content')
    </main>

    <!-- Scripts loaded at the end for better performance -->
    @vite(['resources/js/app.js'])
    <script src="{{ asset('js/fixed-navigation.js') }}" defer></script>
    
    @stack('scripts')

    <!-- Service Worker for caching (optional) -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js')
                    .then(function(registration) {
                        console.log('SW registered: ', registration);
                    })
                    .catch(function(registrationError) {
                        console.log('SW registration failed: ', registrationError);
                    });
            });
        }
    </script>
</body>
</html>