<!-- Hero Section - Siap Untuk Transformasi -->
<section class="relative min-h-screen text-white pt-16 flex items-center overflow-hidden hero-background">
    <!-- Animated Diamond Background Pattern -->
    <div class="absolute inset-0 diamond-pattern"></div>
    
    <!-- Additional Moving Pattern Layer -->
    <div class="absolute inset-0 moving-diamonds"></div>
    
    <!-- Animated Background Pattern -->
    <div class="absolute inset-0 barbershop-pattern"></div>
    
    <!-- Barbershop Interior Simulation - Enhanced Visibility -->
    <div class="absolute inset-0 opacity-20 z-5">
        <!-- Barber Chairs -->
        <div class="absolute bottom-0 left-1/4 w-16 h-32 bg-accent/30 rounded-t-full barber-chair"></div>
        <div class="absolute bottom-0 left-1/2 w-16 h-32 bg-accent/20 rounded-t-full barber-chair"></div>
        <div class="absolute bottom-0 right-1/4 w-16 h-32 bg-accent/25 rounded-t-full barber-chair"></div>
        
        <!-- Mirrors with Reflection Effect -->
        <div class="absolute top-1/4 left-1/4 w-12 h-20 border-2 border-accent/20 rounded-lg mirror-reflection"></div>
        <div class="absolute top-1/4 left-1/2 w-12 h-20 border-2 border-accent/15 rounded-lg mirror-reflection"></div>
        <div class="absolute top-1/4 right-1/4 w-12 h-20 border-2 border-accent/20 rounded-lg mirror-reflection"></div>
        
        <!-- Ceiling Lights with Beam Effect -->
        <div class="absolute top-10 left-1/3 w-8 h-8 bg-accent/30 rounded-full ceiling-light"></div>
        <div class="absolute top-10 right-1/3 w-8 h-8 bg-accent/25 rounded-full ceiling-light" style="animation-delay: 0.5s;"></div>
        
        <!-- Additional Barbershop Elements -->
        <div class="absolute top-1/3 left-10 w-4 h-12 bg-accent/15 rounded-full barber-pole"></div> <!-- Animated Pole -->
        <div class="absolute top-1/2 right-16 w-6 h-6 bg-accent/20 rounded-full animate-pulse"></div> <!-- Clock -->
        <div class="absolute bottom-1/4 left-16 w-8 h-4 bg-accent/10 rounded mirror-reflection"></div> <!-- Counter -->
        
        <!-- Vintage Barbershop Sign -->
        <div class="absolute top-20 left-1/2 transform -translate-x-1/2 text-xs text-accent/20 font-bold animate-pulse">
            BARBERSHOP
        </div>
    </div>
    
    <!-- Floating Elements - Enhanced Visibility -->
    <div class="absolute inset-0 opacity-25 z-6">
        <!-- Barbershop Tools -->
        <div class="absolute top-1/4 left-1/3 text-6xl text-accent/30 animate-float parallax-element tool-shimmer">✂️</div>
        <div class="absolute bottom-1/3 right-1/4 text-5xl text-accent/25 animate-float-delayed parallax-element tool-shimmer">💇‍♂️</div>
        <div class="absolute top-1/2 right-10 text-4xl text-accent/20 animate-float parallax-element tool-shimmer">🪒</div>
        <div class="absolute top-3/4 left-1/5 text-3xl text-accent/15 animate-float-delayed parallax-element tool-shimmer">🧴</div>
        <div class="absolute top-1/6 right-1/3 text-4xl text-accent/20 animate-float parallax-element tool-shimmer">🪮</div>
        
        <!-- Geometric Accents -->
        <div class="absolute top-10 left-10 w-32 h-32 border-2 border-accent/30 rounded-full animate-pulse parallax-element"></div>
        <div class="absolute top-32 right-20 w-24 h-24 border border-accent/20 rounded-full animate-bounce parallax-element"></div>
        <div class="absolute bottom-20 left-1/4 w-16 h-16 bg-accent/15 rounded-full animate-pulse parallax-element"></div>
        <div class="absolute bottom-32 right-1/3 w-20 h-20 border border-accent/25 rounded-full parallax-element"></div>
        
        <!-- Rotating Elements -->
        <div class="absolute top-20 right-1/3 w-8 h-8 bg-accent/25 rotate-45 animate-spin-slow parallax-element"></div>
        <div class="absolute bottom-40 left-20 w-12 h-12 bg-accent/20 rotate-12 animate-pulse parallax-element"></div>
        <div class="absolute top-1/2 left-10 w-6 h-6 bg-accent/30 rotate-45 animate-spin-slow parallax-element" style="animation-delay: 2s;"></div>
    </div>
    
    <!-- Dynamic Gradient Overlay - Reduced for Better Background Visibility -->
    <div class="absolute inset-0 bg-gradient-to-br from-black/70 via-black/50 to-black/70 z-10"></div>
    
    <!-- Spotlight Effect -->
    <div class="absolute inset-0 z-5">
        <div class="absolute top-1/4 left-1/2 w-96 h-96 bg-accent/5 rounded-full blur-3xl spotlight"></div>
        <div class="absolute bottom-1/4 right-1/4 w-64 h-64 bg-accent/3 rounded-full blur-2xl spotlight" style="animation-delay: 2s;"></div>
    </div>
    
    <!-- Floating Particles -->
    <div class="absolute inset-0 z-5 pointer-events-none">
        <div class="absolute bottom-0 left-1/4 w-2 h-2 bg-accent/20 rounded-full floating-particle"></div>
        <div class="absolute bottom-0 left-1/2 w-1.5 h-1.5 bg-accent/15 rounded-full floating-particle"></div>
        <div class="absolute bottom-0 right-1/3 w-2.5 h-2.5 bg-accent/10 rounded-full floating-particle"></div>
        <div class="absolute bottom-0 right-1/4 w-1 h-1 bg-accent/25 rounded-full floating-particle"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-30">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Content Section with AOS Animations -->
            <div class="max-w-2xl" data-aos="fade-right">
                <div class="mb-6">
                    <span class="bg-accent text-black px-4 py-2 rounded-full text-sm font-semibold">
                        Sistem Manajemen Barbershop
                    </span>
                </div>
                <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                    Sisbar Hairstudio System
                </h1>
                <p class="text-xl md:text-2xl mb-8 opacity-90 leading-relaxed">
                    Platform digital terintegrasi untuk mengelola operasional barbershop modern dengan fitur booking online, manajemen pelanggan, dan laporan bisnis
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <button data-navigate="booking" class="bg-accent text-black px-8 py-4 rounded-lg font-semibold text-lg hover:bg-yellow-400 transition-all transform hover:scale-105 pulse-accent">
                        Coba Booking
                    </button>
                    <button data-navigate="availability" class="bg-transparent border-2 border-accent text-accent px-8 py-4 rounded-lg font-semibold text-lg hover:bg-accent hover:text-black transition-all transform hover:scale-105">
                        Lihat Fitur
                    </button>
                </div>
            </div>

            <!-- Image Section - Compact Executive Design -->
            <div class="relative group max-w-sm ml-auto" data-aos="fade-left">
                <!-- Executive Image Container -->
                <div class="relative bg-gradient-to-br from-black/10 to-black/30 rounded-xl overflow-hidden shadow-lg border border-accent/15 group-hover:border-accent/30 transition-all duration-700 backdrop-blur-sm">
                    <!-- Compact Barber Image -->
                    <div class="aspect-[4/5] relative">
                        <img src="{{ asset('images/barber-hal-utama.jpg') }}" 
                             alt="Executive Barber at Sisbar Hairstudio" 
                             class="w-full h-full object-cover object-center transition-all duration-700 group-hover:scale-101"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        
                        <!-- Minimalist Fallback -->
                        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 to-black flex items-center justify-center" style="display: none;">
                            <div class="text-center">
                                <div class="w-12 h-12 bg-accent/20 rounded-full flex items-center justify-center mb-3 mx-auto">
                                    <span class="text-accent text-lg">✂</span>
                                </div>
                                <p class="text-white font-medium text-sm">Executive Barber</p>
                            </div>
                        </div>

                        <!-- Subtle Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                        
                        <!-- Compact Quality Badge -->
                        <div class="absolute top-3 right-3 bg-black/50 backdrop-blur-sm text-accent px-2 py-1 rounded text-xs font-medium border border-accent/20 z-20">
                            Premium
                        </div>

                        <!-- Compact Info -->
                        <div class="absolute bottom-3 left-3 right-3 z-20">
                            <div class="bg-black/30 backdrop-blur-sm rounded p-2 border border-white/10">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-white font-medium text-xs">Professional Service</p>
                                    </div>
                                    <div class="w-1.5 h-1.5 bg-accent rounded-full animate-pulse"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section - Barber King Style -->
<section class="relative py-20 bg-black text-white scroll-animate">
    <!-- Animated Yellow Accent Background - Unrolling Effect -->
    <div class="absolute top-0 left-0 w-full h-16 bg-yellow-400 transform -skew-y-0.5 origin-top-left yellow-stripe-scroll scroll-animate">
        <!-- Paper Roll Shadow Effect -->
        <div class="absolute -top-1 -left-2 w-4 h-18 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-l-full transform rotate-12 opacity-60"></div>
        <!-- Roll Highlight -->
        <div class="absolute top-1 left-1 w-full h-2 bg-gradient-to-r from-yellow-300 to-transparent opacity-50"></div>
        <!-- Bottom Shadow -->
        <div class="absolute -bottom-1 left-0 w-full h-2 bg-gradient-to-r from-transparent via-black/20 to-transparent"></div>
        
        <!-- Unrolling Particles -->
        <div class="absolute top-2 left-4 w-1 h-1 bg-yellow-200 rounded-full opacity-70 animate-bounce" style="animation-delay: 0.5s;"></div>
        <div class="absolute top-4 left-8 w-0.5 h-0.5 bg-yellow-300 rounded-full opacity-60 animate-pulse" style="animation-delay: 0.8s;"></div>
        <div class="absolute top-6 left-12 w-1.5 h-1.5 bg-yellow-100 rounded-full opacity-50 animate-ping" style="animation-delay: 1.2s;"></div>
        
        <!-- Paper Texture Lines -->
        <div class="absolute top-0 left-0 w-full h-full opacity-20">
            <div class="absolute top-2 left-0 w-full h-px bg-yellow-200"></div>
            <div class="absolute top-6 left-0 w-full h-px bg-yellow-200"></div>
            <div class="absolute top-10 left-0 w-full h-px bg-yellow-200"></div>
            <div class="absolute top-14 left-0 w-full h-px bg-yellow-200"></div>
        </div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-6xl mx-auto">
            <!-- Header with Yellow Accent -->
            <div class="text-center mb-16 pt-12" data-aos="fade-up">
                <div class="mb-8">
                    <span class="inline-block bg-yellow-400 text-black px-6 py-2 rounded-full text-sm font-bold tracking-wider uppercase">
                        Tentang Produk
                    </span>
                </div>
                
                <!-- Main Title -->
                <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight" data-aos="fade-up">
                    <span class="text-white">Sisbar</span>
                    <span class="text-yellow-400"> Management System</span>
                </h2>
                
                <!-- Well-formatted Description -->
                <div class="max-w-4xl mx-auto" data-aos="fade-up">
                    <p class="text-lg text-gray-300 mb-4 leading-relaxed">
                        <span class="text-yellow-400 font-semibold">Sisbar Hairstudio System</span> adalah platform digital yang dirancang khusus untuk 
                        mengelola operasional barbershop modern. Sistem ini mengintegrasikan booking online, manajemen pelanggan, jadwal barber, 
                        dan pelaporan bisnis dalam satu dashboard yang mudah digunakan.
                    </p>
                    <p class="text-lg text-gray-300 leading-relaxed">
                        Dengan teknologi web modern dan interface yang intuitif, sistem ini membantu pemilik barbershop meningkatkan efisiensi operasional, 
                        mengurangi waktu tunggu pelanggan, dan mengoptimalkan pendapatan bisnis melalui analisis data yang komprehensif.
                    </p>
                </div>
            </div>

            <!-- Skills Section with Images -->
            <div class="grid lg:grid-cols-2 gap-16 items-center mb-20">
                <!-- Left Content -->
                <div data-aos="fade-right">
                    <!-- System Features -->
                    <div class="grid grid-cols-2 gap-8 mb-12">
                        <!-- Online Booking -->
                        <div class="text-center" data-aos="zoom-in">
                            <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-black text-2xl">📅</span>
                            </div>
                            <h3 class="text-white font-medium text-sm mb-2">Online Booking</h3>
                        </div>

                        <!-- Customer Management -->
                        <div class="text-center" data-aos="zoom-in">
                            <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-black text-2xl">👥</span>
                            </div>
                            <h3 class="text-white font-medium text-sm mb-2">Customer Management</h3>
                        </div>

                        <!-- Payment System -->
                        <div class="text-center" data-aos="zoom-in">
                            <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-black text-2xl">💳</span>
                            </div>
                            <h3 class="text-white font-medium text-sm mb-2">Payment System</h3>
                        </div>

                        <!-- Business Reports -->
                        <div class="text-center" data-aos="zoom-in">
                            <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-black text-2xl">📊</span>
                            </div>
                            <h3 class="text-white font-medium text-sm mb-2">Business Reports</h3>
                        </div>
                    </div>

                    <!-- Well-formatted Description Text -->
                    <div class="text-gray-300 leading-relaxed mb-8 space-y-4" data-aos="fade-up">
                        <p>
                            <span class="text-yellow-400 font-semibold">Sisbar Management System</span> menyediakan solusi digital komprehensif untuk 
                            mengelola barbershop modern. Dari sistem booking online yang mudah digunakan hingga manajemen inventory dan laporan keuangan, 
                            semua terintegrasi dalam satu platform yang powerful.
                        </p>
                        <p>
                            Dikembangkan dengan teknologi <span class="text-yellow-400 font-semibold">Laravel & Vue.js</span>, sistem ini menawarkan 
                            performa tinggi, keamanan data yang terjamin, dan interface yang responsif. Cocok untuk barbershop skala kecil hingga 
                            jaringan salon dengan multiple cabang.
                        </p>
                        <p>
                            <strong class="text-yellow-400">Keunggulan Produk:</strong> Sistem yang mudah digunakan, dapat dikustomisasi sesuai kebutuhan bisnis, 
                            dan dilengkapi dengan fitur analitik untuk membantu pengambilan keputusan bisnis yang tepat.
                        </p>
                    </div>
                </div>

                <!-- Right Images -->
                <div class="grid grid-cols-2 gap-4" data-aos="fade-left">
                    <!-- Barber Tools Image -->
                    <div class="relative" data-aos="zoom-in">
                        <img src="{{ asset('images/barber-scroll-tentang-1.jpg') }}" 
                             alt="Professional Barber Tools" 
                             class="w-full h-64 object-cover rounded-lg"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-full h-64 bg-gradient-to-br from-gray-700 to-gray-900 rounded-lg flex items-center justify-center" style="display: none;">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        
                        <!-- Fallback -->
                        <div class="w-full h-64 bg-gray-800 rounded-lg flex items-center justify-center" style="display: none;">
                            <div class="text-center">
                                <span class="text-yellow-400 text-4xl mb-2 block">🛠️</span>
                                <p class="text-white text-sm">Professional Tools</p>
                            </div>
                        </div>
                    </div>

                    <!-- Barber at Work Image -->
                    <div class="relative mt-8" data-aos="zoom-in">
                        <img src="{{ asset('images/barber-scroll-tentang-2.jpg') }}" 
                             alt="Professional Barber at Work" 
                             class="w-full h-64 object-cover rounded-lg"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-full h-64 bg-gradient-to-br from-gray-700 to-gray-900 rounded-lg flex items-center justify-center" style="display: none;">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>>
                        
                        <!-- Fallback -->
                        <div class="w-full h-64 bg-gray-800 rounded-lg flex items-center justify-center" style="display: none;">
                            <div class="text-center">
                                <span class="text-yellow-400 text-4xl mb-2 block">💇‍♂️</span>
                                <p class="text-white text-sm">Expert Barber</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <!-- Stat 1 -->
                <div class="relative" data-aos="flip-left">
                    <div class="absolute -top-4 -left-4 w-12 h-12 border-2 border-yellow-400 rounded-full flex items-center justify-center">
                        <span class="text-yellow-400 text-xl">📍</span>
                    </div>
                    <div class="bg-gray-900 rounded-lg p-6 pt-8">
                        <div class="text-3xl font-bold text-yellow-400 mb-2">1+</div>
                        <div class="text-sm text-gray-400 uppercase tracking-wide">Lokasi</div>
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="relative" data-aos="flip-left">
                    <div class="absolute -top-4 -left-4 w-12 h-12 border-2 border-yellow-400 rounded-full flex items-center justify-center">
                        <span class="text-yellow-400 text-xl">🏪</span>
                    </div>
                    <div class="bg-gray-900 rounded-lg p-6 pt-8">
                        <div class="text-3xl font-bold text-yellow-400 mb-2">8+</div>
                        <div class="text-sm text-gray-400 uppercase tracking-wide">Lokasi</div>
                    </div>
                </div>

                <!-- Stat 3 -->
                <div class="relative" data-aos="flip-left">
                    <div class="absolute -top-4 -left-4 w-12 h-12 border-2 border-yellow-400 rounded-full flex items-center justify-center">
                        <span class="text-yellow-400 text-xl">⭐</span>
                    </div>
                    <div class="bg-gray-900 rounded-lg p-6 pt-8">
                        <div class="text-3xl font-bold text-yellow-400 mb-2">5+</div>
                        <div class="text-sm text-gray-400 uppercase tracking-wide">Lokasi</div>
                    </div>
                </div>

                <!-- Stat 4 -->
                <div class="relative" data-aos="flip-left">
                    <div class="absolute -top-4 -left-4 w-12 h-12 border-2 border-yellow-400 rounded-full flex items-center justify-center">
                        <span class="text-yellow-400 text-xl">👑</span>
                    </div>
                    <div class="bg-gray-900 rounded-lg p-6 pt-8">
                        <div class="text-3xl font-bold text-yellow-400 mb-2">2+</div>
                        <div class="text-sm text-gray-400 uppercase tracking-wide">Lokasi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mengapa Pilih Kami Section - 3 Column Layout -->
<section class="relative py-20 bg-gradient-to-br from-gray-900 via-black to-gray-800 text-white overflow-hidden">
    <!-- Enhanced Background -->
    <div class="absolute inset-0">
        <!-- Animated Gradient Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-black to-gray-800"></div>
        <!-- Moving Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, #FCD34D 2px, transparent 2px), radial-gradient(circle at 75% 75%, #FCD34D 1px, transparent 1px); background-size: 80px 80px, 40px 40px; animation: patternMove 20s linear infinite;"></div>
        </div>
        <!-- Floating Orbs -->
        <div class="absolute top-20 left-20 w-32 h-32 bg-yellow-400/5 rounded-full blur-xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-48 h-48 bg-yellow-400/3 rounded-full blur-2xl animate-pulse" style="animation-delay: 2s;"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="mb-6">
                    <span class="inline-block bg-yellow-400 text-black px-6 py-2 rounded-full text-sm font-bold tracking-wider uppercase">
                        Mengapa Pilih Kami
                    </span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                    <span class="text-white">Fitur Lengkap</span>
                    <span class="text-yellow-400"> Sisbar System</span>
                </h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto leading-relaxed">
                    Platform manajemen barbershop dengan fitur-fitur canggih untuk operasional yang lebih efisien
                </p>
            </div>

            <!-- 3 Column Layout: Features - Image - Features -->
            <div class="grid lg:grid-cols-3 gap-8 items-start mb-16">
                <!-- Left Features Column -->
                <div class="space-y-6" data-aos="fade-right">
                    <!-- Feature 1: Online Booking -->
                    <div class="group bg-black/20 backdrop-blur-sm rounded-xl p-4 border border-gray-800/50 hover:border-yellow-400/30 transition-all duration-300 hover:bg-black/30">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-yellow-400/10 rounded-lg flex items-center justify-center group-hover:bg-yellow-400/20 transition-colors border border-yellow-400/20">
                                <span class="text-yellow-400 text-lg">📅</span>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-white mb-1 group-hover:text-yellow-400 transition-colors">Online Booking</h3>
                                <p class="text-gray-500 text-xs leading-relaxed">
                                    Sistem reservasi online 24/7 dengan konfirmasi otomatis
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 2: Customer Management -->
                    <div class="group bg-black/20 backdrop-blur-sm rounded-xl p-4 border border-gray-800/50 hover:border-yellow-400/30 transition-all duration-300 hover:bg-black/30">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-yellow-400/10 rounded-lg flex items-center justify-center group-hover:bg-yellow-400/20 transition-colors border border-yellow-400/20">
                                <span class="text-yellow-400 text-lg">👥</span>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-white mb-1 group-hover:text-yellow-400 transition-colors">Customer Management</h3>
                                <p class="text-gray-500 text-xs leading-relaxed">
                                    Database pelanggan lengkap dengan riwayat kunjungan
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 3: Payment Integration -->
                    <div class="group bg-black/20 backdrop-blur-sm rounded-xl p-4 border border-gray-800/50 hover:border-yellow-400/30 transition-all duration-300 hover:bg-black/30">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-yellow-400/10 rounded-lg flex items-center justify-center group-hover:bg-yellow-400/20 transition-colors border border-yellow-400/20">
                                <span class="text-yellow-400 text-lg">💳</span>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-white mb-1 group-hover:text-yellow-400 transition-colors">Payment Integration</h3>
                                <p class="text-gray-500 text-xs leading-relaxed">
                                    Sistem pembayaran terintegrasi dengan Midtrans
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Center Image Column -->
                <div class="flex justify-center" data-aos="zoom-in">
                    <div class="relative group">
                        <!-- Smaller Image Container -->
                        <div class="relative rounded-2xl overflow-hidden transition-all duration-500 max-w-xs mx-auto">
                            <!-- Barber Animation Image -->
                            <div class="aspect-[3/4] relative">
                                <img src="{{ asset('images/animasi-kapster.png') }}" 
                                     alt="Professional Barber Animation" 
                                     class="w-full h-full object-cover object-center transition-all duration-500 group-hover:scale-105"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                
                                <!-- Fallback -->
                                <div class="absolute inset-0 bg-black flex items-center justify-center" style="display: none;">
                                    <div class="text-center">
                                        <div class="w-16 h-16 bg-yellow-400/10 rounded-full flex items-center justify-center mb-3 mx-auto border border-yellow-400/20">
                                            <span class="text-yellow-400 text-2xl">✂️</span>
                                        </div>
                                        <p class="text-white font-semibold text-sm mb-1">Professional Barber</p>
                                        <p class="text-gray-500 text-xs">Animation System</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Features Column -->
                <div class="space-y-6" data-aos="fade-left">
                    <!-- Feature 4: Staff Management -->
                    <div class="group bg-black/20 backdrop-blur-sm rounded-xl p-4 border border-gray-800/50 hover:border-yellow-400/30 transition-all duration-300 hover:bg-black/30">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-yellow-400/10 rounded-lg flex items-center justify-center group-hover:bg-yellow-400/20 transition-colors border border-yellow-400/20">
                                <span class="text-yellow-400 text-lg">👨‍💼</span>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-white mb-1 group-hover:text-yellow-400 transition-colors">Staff Management</h3>
                                <p class="text-gray-500 text-xs leading-relaxed">
                                    Kelola jadwal barber dan track performa staff
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 5: Business Analytics -->
                    <div class="group bg-black/20 backdrop-blur-sm rounded-xl p-4 border border-gray-800/50 hover:border-yellow-400/30 transition-all duration-300 hover:bg-black/30">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-yellow-400/10 rounded-lg flex items-center justify-center group-hover:bg-yellow-400/20 transition-colors border border-yellow-400/20">
                                <span class="text-yellow-400 text-lg">📊</span>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-white mb-1 group-hover:text-yellow-400 transition-colors">Business Analytics</h3>
                                <p class="text-gray-500 text-xs leading-relaxed">
                                    Dashboard analitik dengan laporan real-time
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 6: Inventory Management -->
                    <div class="group bg-black/20 backdrop-blur-sm rounded-xl p-4 border border-gray-800/50 hover:border-yellow-400/30 transition-all duration-300 hover:bg-black/30">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-yellow-400/10 rounded-lg flex items-center justify-center group-hover:bg-yellow-400/20 transition-colors border border-yellow-400/20">
                                <span class="text-yellow-400 text-lg">📦</span>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-white mb-1 group-hover:text-yellow-400 transition-colors">Inventory Management</h3>
                                <p class="text-gray-500 text-xs leading-relaxed">
                                    Kelola stok produk dengan tracking otomatis
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action - Dark Theme -->
            <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-gradient-to-r from-gray-900 to-black rounded-2xl p-8 max-w-4xl mx-auto border border-gray-800/50">
                    <h3 class="text-2xl md:text-3xl font-bold text-white mb-4">
                        Siap Mengembangkan Bisnis Barbershop Anda?
                    </h3>
                    <p class="text-gray-400 text-lg mb-6 max-w-2xl mx-auto">
                        Bergabunglah dengan barbershop modern lainnya yang telah merasakan kemudahan mengelola bisnis dengan Sisbar Management System
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button data-navigate="booking" class="bg-yellow-400 text-black px-8 py-4 rounded-lg font-semibold text-lg hover:bg-yellow-500 transition-all transform hover:scale-105">
                            Coba Demo Gratis
                        </button>
                        <button class="bg-transparent border-2 border-yellow-400 text-yellow-400 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-yellow-400 hover:text-black transition-all transform hover:scale-105">
                            Hubungi Sales
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Flow Section - Enhanced Dark Theme -->
<section class="relative py-20 bg-gradient-to-br from-gray-900 via-black to-gray-900 text-white overflow-hidden">
    <!-- Enhanced Background -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-black to-gray-900"></div>
        <!-- Animated Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, #FCD34D 2px, transparent 2px), radial-gradient(circle at 75% 75%, #FCD34D 1px, transparent 1px); background-size: 100px 100px, 50px 50px; animation: patternMove 30s linear infinite;"></div>
        </div>
        <!-- Floating Orbs with Glow -->
        <div class="absolute top-20 left-20 w-32 h-32 bg-yellow-400/8 rounded-full blur-2xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-40 h-40 bg-yellow-400/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 3s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-yellow-400/3 rounded-full blur-3xl animate-pulse" style="animation-delay: 6s;"></div>
        <!-- Subtle Grid Lines -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: linear-gradient(rgba(252, 211, 77, 0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(252, 211, 77, 0.1) 1px, transparent 1px); background-size: 60px 60px;"></div>
        </div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="mb-6">
                    <span class="inline-block bg-yellow-400 text-black px-6 py-2 rounded-full text-sm font-bold tracking-wider uppercase">
                        Alur Booking
                    </span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                    <span class="text-white">Proses Booking</span>
                    <span class="text-yellow-400"> yang Mudah</span>
                </h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto leading-relaxed">
                    Sistem booking yang sederhana dan efisien untuk pengalaman pelanggan yang optimal
                </p>
            </div>

            <!-- Enhanced Process Steps -->
            <div class="relative">
                <!-- Enhanced Connection Lines -->
                <div class="hidden lg:block absolute top-1/2 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-yellow-400/30 to-transparent transform -translate-y-1/2 z-0 shadow-lg"></div>
                <div class="hidden lg:block absolute top-1/2 left-0 w-full h-px bg-gradient-to-r from-transparent via-yellow-400/60 to-transparent transform -translate-y-1/2 z-0"></div>
                
                <div class="grid lg:grid-cols-3 gap-8 relative z-10">
                    <!-- Step 1: Pilih Layanan -->
                    <div class="relative group" data-aos="zoom-in" data-aos-delay="100">
                        <!-- Card Shadow -->
                        <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/5 to-transparent rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <div class="relative bg-gradient-to-br from-gray-800/50 via-black/60 to-gray-900/50 backdrop-blur-sm rounded-2xl p-6 border border-gray-700/50 hover:border-yellow-400/40 transition-all duration-500 hover:shadow-2xl hover:shadow-yellow-400/10 transform hover:scale-105 hover:-translate-y-2">
                            <!-- Enhanced Step Number -->
                            <div class="absolute -top-6 left-1/2 transform -translate-x-1/2">
                                <div class="relative">
                                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center shadow-lg">
                                        <span class="text-black font-bold text-lg">1</span>
                                    </div>
                                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full blur-md opacity-50 animate-pulse"></div>
                                </div>
                            </div>
                            
                            <!-- Enhanced Interface -->
                            <div class="mb-6 relative h-36 bg-gradient-to-br from-black/70 to-gray-900/50 rounded-xl overflow-hidden border border-gray-700/30 shadow-inner">
                                <!-- Subtle Glow -->
                                <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/5 to-transparent"></div>
                                
                                <div class="absolute inset-4 space-y-2">
                                    <!-- Service Options with Enhanced Styling -->
                                    <div class="bg-gradient-to-r from-yellow-400/15 to-yellow-400/10 border border-yellow-400/40 rounded-lg p-2 shadow-lg transform hover:scale-102 transition-transform">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-6 h-6 bg-yellow-400/20 rounded-full flex items-center justify-center">
                                                <span class="text-yellow-400 text-sm">✂️</span>
                                            </div>
                                            <span class="text-white text-xs font-semibold">Premium Haircut</span>
                                            <span class="text-yellow-400 text-xs ml-auto font-bold">Rp 50K</span>
                                        </div>
                                    </div>
                                    <div class="bg-gradient-to-r from-gray-800/60 to-gray-900/40 border border-gray-700/40 rounded-lg p-2 opacity-70 hover:opacity-90 transition-opacity">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-6 h-6 bg-gray-700/50 rounded-full flex items-center justify-center">
                                                <span class="text-gray-400 text-sm">🪒</span>
                                            </div>
                                            <span class="text-gray-400 text-xs">Classic Shaving</span>
                                            <span class="text-gray-400 text-xs ml-auto">Rp 30K</span>
                                        </div>
                                    </div>
                                    <div class="bg-gradient-to-r from-gray-800/60 to-gray-900/40 border border-gray-700/40 rounded-lg p-2 opacity-70 hover:opacity-90 transition-opacity">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-6 h-6 bg-gray-700/50 rounded-full flex items-center justify-center">
                                                <span class="text-gray-400 text-sm">💇‍♂️</span>
                                            </div>
                                            <span class="text-gray-400 text-xs">Hair Styling</span>
                                            <span class="text-gray-400 text-xs ml-auto">Rp 75K</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Floating Icon -->
                                <div class="absolute bottom-2 right-2">
                                    <div class="w-6 h-6 bg-yellow-400/20 rounded-full flex items-center justify-center animate-bounce">
                                        <span class="text-yellow-400 text-xs">📋</span>
                                    </div>
                                </div>
                            </div>
                            
                            <h3 class="text-xl font-bold text-white mb-3 group-hover:text-yellow-400 transition-colors">
                                Pilih Layanan
                            </h3>
                            <p class="text-gray-400 text-sm leading-relaxed">
                                Pilih layanan yang diinginkan dari daftar layanan yang tersedia dengan harga transparan
                            </p>
                            
                            <!-- Feature Points -->
                            <div class="mt-4 space-y-2">
                                <div class="flex items-center space-x-2 text-xs">
                                    <div class="w-1.5 h-1.5 bg-yellow-400 rounded-full"></div>
                                    <span class="text-gray-500">Harga transparan</span>
                                </div>
                                <div class="flex items-center space-x-2 text-xs">
                                    <div class="w-1.5 h-1.5 bg-yellow-400 rounded-full"></div>
                                    <span class="text-gray-500">Deskripsi lengkap</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Enhanced Connection Arrow -->
                        <div class="hidden lg:block absolute -right-6 top-1/2 transform -translate-y-1/2 z-20">
                            <div class="relative">
                                <div class="w-12 h-12 bg-gradient-to-r from-yellow-400/30 to-yellow-500/20 rounded-full flex items-center justify-center border border-yellow-400/40 shadow-lg backdrop-blur-sm">
                                    <span class="text-yellow-400 text-lg">→</span>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-r from-yellow-400/20 to-yellow-500/10 rounded-full blur-md animate-pulse"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Pilih Jadwal -->
                    <div class="relative group" data-aos="zoom-in" data-aos-delay="300">
                        <!-- Card Shadow -->
                        <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/5 to-transparent rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <div class="relative bg-gradient-to-br from-gray-800/50 via-black/60 to-gray-900/50 backdrop-blur-sm rounded-2xl p-6 border border-gray-700/50 hover:border-yellow-400/40 transition-all duration-500 hover:shadow-2xl hover:shadow-yellow-400/10 transform hover:scale-105 hover:-translate-y-2">
                            <!-- Enhanced Step Number -->
                            <div class="absolute -top-6 left-1/2 transform -translate-x-1/2">
                                <div class="relative">
                                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center shadow-lg">
                                        <span class="text-black font-bold text-lg">2</span>
                                    </div>
                                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full blur-md opacity-50 animate-pulse"></div>
                                </div>
                            </div>
                            
                            <!-- Enhanced Calendar Interface -->
                            <div class="mb-6 relative h-36 bg-gradient-to-br from-black/70 to-gray-900/50 rounded-xl overflow-hidden border border-gray-700/30 shadow-inner">
                                <!-- Subtle Glow -->
                                <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/5 to-transparent"></div>
                                
                                <div class="absolute inset-4">
                                    <!-- Calendar Header -->
                                    <div class="text-center mb-2 bg-gradient-to-r from-gray-800/50 to-gray-900/30 rounded-lg p-1 border border-gray-700/30">
                                        <div class="text-white font-semibold text-sm">December 2024</div>
                                    </div>
                                    
                                    <!-- Enhanced Calendar -->
                                    <div class="grid grid-cols-7 gap-1 mb-2">
                                        <div class="text-gray-500 text-center text-xs font-semibold">S</div>
                                        <div class="text-gray-500 text-center text-xs font-semibold">M</div>
                                        <div class="text-gray-500 text-center text-xs font-semibold">T</div>
                                        <div class="text-gray-500 text-center text-xs font-semibold">W</div>
                                        <div class="text-gray-500 text-center text-xs font-semibold">T</div>
                                        <div class="text-gray-500 text-center text-xs font-semibold">F</div>
                                        <div class="text-gray-500 text-center text-xs font-semibold">S</div>
                                        
                                        <div class="text-gray-400 text-center text-xs hover:bg-gray-700/30 rounded transition-colors">15</div>
                                        <div class="text-gray-400 text-center text-xs hover:bg-gray-700/30 rounded transition-colors">16</div>
                                        <div class="text-gray-400 text-center text-xs hover:bg-gray-700/30 rounded transition-colors">17</div>
                                        <div class="relative">
                                            <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 text-black text-center text-xs rounded font-bold shadow-lg">18</div>
                                            <div class="absolute inset-0 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded blur-sm opacity-50"></div>
                                        </div>
                                        <div class="text-gray-400 text-center text-xs hover:bg-gray-700/30 rounded transition-colors">19</div>
                                        <div class="text-gray-400 text-center text-xs hover:bg-gray-700/30 rounded transition-colors">20</div>
                                        <div class="text-gray-400 text-center text-xs hover:bg-gray-700/30 rounded transition-colors">21</div>
                                    </div>
                                    
                                    <!-- Enhanced Time Slots -->
                                    <div class="grid grid-cols-3 gap-1">
                                        <div class="bg-gradient-to-br from-gray-800/60 to-gray-900/40 text-gray-400 text-xs p-1 rounded text-center border border-gray-700/30">09:00</div>
                                        <div class="relative">
                                            <div class="bg-gradient-to-r from-yellow-400/20 to-yellow-500/15 text-yellow-400 text-xs p-1 rounded text-center border border-yellow-400/40 font-semibold shadow-lg">10:00</div>
                                            <div class="absolute inset-0 bg-gradient-to-r from-yellow-400/10 to-yellow-500/5 rounded blur-sm"></div>
                                        </div>
                                        <div class="bg-gradient-to-br from-gray-800/60 to-gray-900/40 text-gray-400 text-xs p-1 rounded text-center border border-gray-700/30">11:00</div>
                                    </div>
                                </div>
                                
                                <!-- Floating Icon -->
                                <div class="absolute bottom-2 right-2">
                                    <div class="w-6 h-6 bg-yellow-400/20 rounded-full flex items-center justify-center animate-bounce">
                                        <span class="text-yellow-400 text-xs">📅</span>
                                    </div>
                                </div>
                            </div>
                            
                            <h3 class="text-xl font-bold text-white mb-3 group-hover:text-yellow-400 transition-colors">
                                Pilih Jadwal
                            </h3>
                            <p class="text-gray-400 text-sm leading-relaxed">
                                Tentukan tanggal dan waktu yang sesuai dengan ketersediaan barber
                            </p>
                            
                            <!-- Feature Points -->
                            <div class="mt-4 space-y-2">
                                <div class="flex items-center space-x-2 text-xs">
                                    <div class="w-1.5 h-1.5 bg-yellow-400 rounded-full"></div>
                                    <span class="text-gray-500">Real-time availability</span>
                                </div>
                                <div class="flex items-center space-x-2 text-xs">
                                    <div class="w-1.5 h-1.5 bg-yellow-400 rounded-full"></div>
                                    <span class="text-gray-500">Flexible scheduling</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Enhanced Connection Arrow -->
                        <div class="hidden lg:block absolute -right-6 top-1/2 transform -translate-y-1/2 z-20">
                            <div class="relative">
                                <div class="w-12 h-12 bg-gradient-to-r from-yellow-400/30 to-yellow-500/20 rounded-full flex items-center justify-center border border-yellow-400/40 shadow-lg backdrop-blur-sm">
                                    <span class="text-yellow-400 text-lg">→</span>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-r from-yellow-400/20 to-yellow-500/10 rounded-full blur-md animate-pulse"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Konfirmasi & Bayar -->
                    <div class="relative group" data-aos="zoom-in" data-aos-delay="500">
                        <!-- Card Shadow -->
                        <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/5 to-transparent rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <div class="relative bg-gradient-to-br from-gray-800/50 via-black/60 to-gray-900/50 backdrop-blur-sm rounded-2xl p-6 border border-gray-700/50 hover:border-yellow-400/40 transition-all duration-500 hover:shadow-2xl hover:shadow-yellow-400/10 transform hover:scale-105 hover:-translate-y-2">
                            <!-- Enhanced Step Number -->
                            <div class="absolute -top-6 left-1/2 transform -translate-x-1/2">
                                <div class="relative">
                                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center shadow-lg">
                                        <span class="text-black font-bold text-lg">3</span>
                                    </div>
                                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full blur-md opacity-50 animate-pulse"></div>
                                </div>
                            </div>
                            
                            <!-- Enhanced Payment Interface -->
                            <div class="mb-6 relative h-36 bg-gradient-to-br from-black/70 to-gray-900/50 rounded-xl overflow-hidden border border-gray-700/30 shadow-inner">
                                <!-- Subtle Glow -->
                                <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/5 to-transparent"></div>
                                
                                <div class="absolute inset-4">
                                    <!-- Transaction Summary -->
                                    <div class="mb-3 bg-gradient-to-r from-gray-800/50 to-gray-900/30 rounded-lg p-2 border border-gray-700/30">
                                        <div class="text-white text-sm font-semibold mb-2">Ringkasan Booking</div>
                                        <div class="flex justify-between text-xs mb-1">
                                            <span class="text-gray-400">Premium Haircut</span>
                                            <span class="text-yellow-400 font-bold">Rp 50.000</span>
                                        </div>
                                        <div class="text-gray-500 text-xs flex items-center space-x-1">
                                            <span>📅</span>
                                            <span>18 Dec 2024 • 10:00</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Enhanced Payment Methods -->
                                    <div class="grid grid-cols-2 gap-2">
                                        <div class="relative">
                                            <div class="bg-gradient-to-r from-yellow-400/20 to-yellow-500/15 text-yellow-400 text-xs p-2 rounded text-center border border-yellow-400/40 font-semibold shadow-lg">
                                                <div>💳 Digital</div>
                                            </div>
                                            <div class="absolute inset-0 bg-gradient-to-r from-yellow-400/10 to-yellow-500/5 rounded blur-sm"></div>
                                        </div>
                                        <div class="bg-gradient-to-br from-gray-800/60 to-gray-900/40 text-gray-400 text-xs p-2 rounded text-center border border-gray-700/30">
                                            <div>💰 Cash</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Floating Icon -->
                                <div class="absolute bottom-2 right-2">
                                    <div class="w-6 h-6 bg-green-400/20 rounded-full flex items-center justify-center animate-bounce">
                                        <span class="text-green-400 text-xs">✓</span>
                                    </div>
                                </div>
                            </div>
                            
                            <h3 class="text-xl font-bold text-white mb-3 group-hover:text-yellow-400 transition-colors">
                                Konfirmasi & Bayar
                            </h3>
                            <p class="text-gray-400 text-sm leading-relaxed">
                                Konfirmasi booking dan lakukan pembayaran dengan metode yang dipilih
                            </p>
                            
                            <!-- Feature Points -->
                            <div class="mt-4 space-y-2">
                                <div class="flex items-center space-x-2 text-xs">
                                    <div class="w-1.5 h-1.5 bg-yellow-400 rounded-full"></div>
                                    <span class="text-gray-500">Secure payment</span>
                                </div>
                                <div class="flex items-center space-x-2 text-xs">
                                    <div class="w-1.5 h-1.5 bg-yellow-400 rounded-full"></div>
                                    <span class="text-gray-500">Instant confirmation</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modern Futuristic CSS -->
<style>
/* Futuristic Grid Pattern */
.grid-pattern {
    background-image: 
        linear-gradient(rgba(252, 211, 77, 0.1) 1px, transparent 1px),
        linear-gradient(90deg, rgba(252, 211, 77, 0.1) 1px, transparent 1px);
    background-size: 50px 50px;
    animation: gridMove 20s linear infinite;
}

@keyframes gridMove {
    0% { transform: translate(0, 0); }
    100% { transform: translate(50px, 50px); }
}

/* Floating Orbs */
.orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(1px);
    animation: orbFloat 8s ease-in-out infinite;
}

.orb-1 {
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(252, 211, 77, 0.3), rgba(252, 211, 77, 0.1));
    top: 10%;
    left: 10%;
    animation-delay: 0s;
}

.orb-2 {
    width: 150px;
    height: 150px;
    background: radial-gradient(circle, rgba(139, 92, 246, 0.2), rgba(139, 92, 246, 0.05));
    top: 60%;
    right: 10%;
    animation-delay: 3s;
}

.orb-3 {
    width: 80px;
    height: 80px;
    background: radial-gradient(circle, rgba(34, 197, 94, 0.3), rgba(34, 197, 94, 0.1));
    bottom: 20%;
    left: 30%;
    animation-delay: 6s;
}

@keyframes orbFloat {
    0%, 100% {
        transform: translateY(0px) translateX(0px) scale(1);
        opacity: 0.6;
    }
    33% {
        transform: translateY(-30px) translateX(20px) scale(1.1);
        opacity: 0.8;
    }
    66% {
        transform: translateY(20px) translateX(-15px) scale(0.9);
        opacity: 0.7;
    }
}

/* Neural Network Lines */
.neural-line {
    stroke-dasharray: 5, 10;
    animation: neuralPulse 4s ease-in-out infinite;
}

.neural-line-1 { animation-delay: 0s; }
.neural-line-2 { animation-delay: 1.5s; }
.neural-line-3 { animation-delay: 3s; }

@keyframes neuralPulse {
    0%, 100% {
        stroke-dashoffset: 0;
        opacity: 0.3;
    }
    50% {
        stroke-dashoffset: 15;
        opacity: 0.8;
    }
}

/* Holographic Grid */
.holographic-grid {
    background-image: 
        linear-gradient(rgba(252, 211, 77, 0.2) 1px, transparent 1px),
        linear-gradient(90deg, rgba(252, 211, 77, 0.2) 1px, transparent 1px);
    background-size: 20px 20px;
    animation: holoMove 15s linear infinite;
}

@keyframes holoMove {
    0% { transform: translate(0, 0) rotate(0deg); }
    100% { transform: translate(20px, 20px) rotate(360deg); }
}

/* Modern Service Cards */
.service-card-modern {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    transform-style: preserve-3d;
}

.service-card-modern:hover {
    transform: translateZ(10px) rotateX(5deg);
}

.service-card-modern.active {
    animation: cardGlow 2s ease-in-out infinite;
}

@keyframes cardGlow {
    0%, 100% {
        box-shadow: 
            0 0 20px rgba(252, 211, 77, 0.3),
            inset 0 0 20px rgba(252, 211, 77, 0.1);
    }
    50% {
        box-shadow: 
            0 0 40px rgba(252, 211, 77, 0.6),
            inset 0 0 30px rgba(252, 211, 77, 0.2);
    }
}

/* Glassmorphism Effect */
.glass-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

/* 3D Hover Effects */
.card-3d {
    perspective: 1000px;
    transform-style: preserve-3d;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.card-3d:hover {
    transform: rotateY(5deg) rotateX(5deg) translateZ(20px);
}

/* Neon Glow Text */
.neon-text {
    text-shadow: 
        0 0 5px currentColor,
        0 0 10px currentColor,
        0 0 15px currentColor,
        0 0 20px currentColor;
    animation: neonFlicker 2s ease-in-out infinite alternate;
}

@keyframes neonFlicker {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
}

/* Quantum Loading Animation */
.quantum-loader {
    width: 40px;
    height: 40px;
    border: 3px solid rgba(252, 211, 77, 0.3);
    border-top: 3px solid #fbbf24;
    border-radius: 50%;
    animation: quantumSpin 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) infinite;
}

@keyframes quantumSpin {
    0% { transform: rotate(0deg) scale(1); }
    50% { transform: rotate(180deg) scale(1.2); }
    100% { transform: rotate(360deg) scale(1); }
}

/* Holographic Button */
.holo-button {
    position: relative;
    overflow: hidden;
}

.holo-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    transition: left 0.5s;
}

.holo-button:hover::before {
    left: 100%;
}

/* Particle System */
.particle-system {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.particle-system::before,
.particle-system::after {
    content: '';
    position: absolute;
    width: 4px;
    height: 4px;
    background: rgba(252, 211, 77, 0.6);
    border-radius: 50%;
    animation: particleFloat 6s linear infinite;
}

.particle-system::before {
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.particle-system::after {
    top: 70%;
    right: 15%;
    animation-delay: 3s;
}

@keyframes particleFloat {
    0% {
        transform: translateY(0) rotate(0deg);
        opacity: 0;
    }
    10% {
        opacity: 1;
    }
    90% {
        opacity: 1;
    }
    100% {
        transform: translateY(-100vh) rotate(360deg);
        opacity: 0;
    }
}

/* Cyberpunk Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(15, 23, 42, 0.8);
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(45deg, #fbbf24, #f59e0b);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(45deg, #f59e0b, #d97706);
}

/* Floating Scissors Animation */
.floating-scissors {
    position: absolute;
    font-size: 2rem;
    animation: floatScissors 8s ease-in-out infinite;
    opacity: 0.6;
}

.floating-scissors-1 {
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.floating-scissors-2 {
    top: 60%;
    right: 15%;
    animation-delay: 3s;
}

.floating-scissors-3 {
    bottom: 30%;
    left: 20%;
    animation-delay: 6s;
}

@keyframes floatScissors {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
        opacity: 0.4;
    }
    25% {
        transform: translateY(-20px) rotate(10deg);
        opacity: 0.8;
    }
    50% {
        transform: translateY(-40px) rotate(-5deg);
        opacity: 1;
    }
    75% {
        transform: translateY(-20px) rotate(15deg);
        opacity: 0.6;
    }
}

/* Enhanced Card Hover Effects */
.reason-card {
    position: relative;
    overflow: hidden;
}

.reason-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(252, 211, 77, 0.1), transparent);
    transition: left 0.5s;
}

.reason-card:hover::before {
    left: 100%;
}

/* Image Glow Effect */
.barber-image-glow {
    position: relative;
}

.barber-image-glow::after {
    content: '';
    position: absolute;
    inset: -4px;
    background: linear-gradient(45deg, #fbbf24, #f59e0b, #fbbf24);
    border-radius: inherit;
    opacity: 0;
    transition: opacity 0.5s;
    z-index: -1;
    filter: blur(20px);
}

.barber-image-glow:hover::after {
    opacity: 0.7;
}

/* Stats Animation */
@keyframes countUp {
    from {
        transform: translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.animate-count-up {
    animation: countUp 0.8s ease-out;
}

/* Floating Elements Animation */
.floating-element {
    animation: floatElement 6s ease-in-out infinite;
}

@keyframes floatElement {
    0%, 100% {
        transform: translateY(0px) scale(1);
    }
    50% {
        transform: translateY(-15px) scale(1.1);
    }
}

/* Enhanced Gradient Text */
.gradient-text-animated {
    background: linear-gradient(45deg, #fbbf24, #f59e0b, #fbbf24, #f59e0b);
    background-size: 400% 400%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: gradientShift 3s ease-in-out infinite;
}

@keyframes gradientShift {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}
</style>

<!-- Footer Section -->
<footer class="bg-gray-900 text-white py-10">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-6">
            <!-- Brand Section -->
            <div>
                <div class="flex items-center mb-4">
                    <img src="{{ asset('images/logo-sisbar.png') }}" alt="Sisbar Hairstudio" class="h-8 w-auto object-contain mr-3 filter brightness-0 invert" 
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="w-6 h-6 bg-accent rounded flex items-center justify-center mr-2 hidden">
                        <span class="text-black font-bold text-xs">S</span>
                    </div>
                    <span class="text-lg font-bold">Sisbar Hairstudio</span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Premium barbershop untuk pria modern
                </p>
            </div>

            <!-- Navigation -->
            <div>
                <h3 class="text-base font-bold mb-4">Navigasi</h3>
                <ul class="space-y-2">
                    <li><a href="javascript:void(0)" data-navigate="home" class="text-gray-400 hover:text-accent transition-colors text-sm">Home</a></li>
                    <li><a href="javascript:void(0)" data-navigate="services" class="text-gray-400 hover:text-accent transition-colors text-sm">Layanan</a></li>
                    <li><a href="javascript:void(0)" data-navigate="barbers" class="text-gray-400 hover:text-accent transition-colors text-sm">Kapster</a></li>
                    <li><a href="javascript:void(0)" data-navigate="booking" class="text-gray-400 hover:text-accent transition-colors text-sm">Booking</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-base font-bold mb-4">Kontak</h3>
                <div class="space-y-2 text-gray-400 text-sm">
                    <p>Email: info@sisbarhairstudio.com</p>
                    <p>Telepon: +62 812 3456 7890</p>
                    <p>Alamat: Jl. Premium No. 123, Jakarta</p>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-6 text-center">
            <p class="text-gray-400 text-sm">
                © {{ date('Y') }} <span class="text-accent font-semibold">Sisbar Hairstudio</span>. All rights reserved.
            </p>
        </div>
    </div>
</footer>

<!-- AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>