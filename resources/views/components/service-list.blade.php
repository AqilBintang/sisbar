<!-- Layanan Section - Premium Minimalis -->
<div class="pt-20 min-h-screen bg-gradient-to-br from-black via-gray-900 to-black">
    
    <!-- Header Section - Konsisten dengan Home -->
    <section class="relative py-20 text-white overflow-hidden">
        <!-- Subtle Background Elements -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-20 right-20 w-64 h-64 border border-accent/20 rounded-full"></div>
            <div class="absolute bottom-20 left-20 w-48 h-48 bg-accent/10 rounded-full blur-3xl"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <!-- Premium Badge -->
                <div class="mb-8">
                    <span class="bg-accent text-black px-6 py-2 rounded-full text-sm font-semibold">
                        Layanan Premium
                    </span>
                </div>
                
                <!-- Main Heading -->
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                    <span class="bg-gradient-to-r from-white via-accent to-white bg-clip-text text-transparent">
                        Layanan Kami
                    </span>
                </h1>
                
                <!-- Subtitle -->
                <p class="text-xl text-gray-300 mb-12 leading-relaxed">
                    Pilih layanan terbaik untuk penampilan sempurna Anda dengan <span class="text-accent font-medium">standar kualitas premium</span>
                </p>
            </div>
        </div>
    </section>

    <!-- Services Grid - Premium Cards -->
    <section class="relative py-16">
        <div class="container mx-auto px-4">
            <!-- Grid 3 Kolom Simetris dengan spacing yang konsisten -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 max-w-7xl mx-auto items-stretch">
                
                <!-- Service Card 1 - Potong Rambut Basic -->
                <div class="group relative">
                    <div class="relative bg-gradient-to-br from-gray-800/80 to-gray-900/90 backdrop-blur-sm rounded-lg overflow-hidden h-full border-2 border-yellow-500/40 group-hover:border-yellow-500/60 transition-all duration-500 group-hover:-translate-y-1 group-hover:shadow-xl group-hover:shadow-yellow-500/20">
                        
                        <!-- Image Section -->
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('images/basic haircut.jpeg') }}" 
                                 alt="Potong Rambut Basic" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="w-full h-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center" style="display: none;">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-10 0a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2M9 12l2 2 4-4"></path>
                                </svg>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        </div>
                        
                        <div class="p-8">
                            <!-- Gold Accent Bar -->
                            <div class="absolute top-48 left-6 right-6 h-0.5 bg-gradient-to-r from-transparent via-accent/60 to-transparent"></div>
                        
                            <!-- Decorative Line Above Icon -->
                            <div class="w-16 h-px bg-gradient-to-r from-transparent via-yellow-500/40 to-transparent mx-auto mb-4"></div>
                            
                            <!-- Icon Container -->
                            <div class="flex justify-center mb-6">
                                <div class="w-16 h-16 bg-gradient-to-br from-yellow-500/20 to-amber-500/10 rounded-full flex items-center justify-center group-hover:bg-gradient-to-br group-hover:from-yellow-500/30 group-hover:to-amber-500/20 transition-colors duration-300 relative">
                                    <!-- Halo Glow -->
                                    <div class="absolute inset-0 rounded-full border border-yellow-500/40 group-hover:border-yellow-500/60 transition-colors duration-300"></div>
                                    
                                    <!-- Premium Scissors Icon -->
                                    <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.848 8.25l1.536.887M7.848 8.25a3 3 0 11-5.196-3 3 3 0 015.196 3zm1.536.887a2.165 2.165 0 011.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 11-5.196 3 3 3 0 015.196-3zm1.536-.887a2.165 2.165 0 001.083-1.839c.005-.351.054-.695.14-1.024M9.384 14.863L11.461 13.664M16.652 8.25l-1.536.887M16.652 8.25a3 3 0 105.196-3 3 3 0 00-5.196 3zm-1.536.887a2.165 2.165 0 00-1.083 1.839c-.005.351-.054.695-.14 1.024m1.223-.863L12.539 9.137M16.652 15.75l-1.536-.887m1.536.887a3 3 0 105.196 3 3 3 0 00-5.196-3zm-1.536-.887a2.165 2.165 0 01-1.083-1.839c-.005-.351-.054-.695-.14-1.024m1.223.863L12.539 14.863" />
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Heading -->
                            <div class="text-center mb-4">
                                <h3 class="text-xl font-bold text-accent mb-2">Potong Rambut Basic</h3>
                                <!-- Gold Divider Line -->
                                <div class="w-12 h-px bg-gradient-to-r from-transparent via-yellow-500/60 to-transparent mx-auto mb-4"></div>
                                <p class="text-gray-300 text-sm leading-relaxed">Gaya klasik dan modern untuk penampilan sehari-hari yang rapi dan profesional</p>
                            </div>
                            
                            <!-- Price Section -->
                            <div class="text-center mb-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-2xl font-bold text-accent">Rp 35.000</span>
                                        <div class="text-xs text-gray-500">Harga terjangkau</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-white text-sm">30 menit</div>
                                        <div class="text-xs text-gray-500">Efisien</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Features -->
                            <div class="space-y-2 mb-8">
                                <div class="flex items-center text-sm text-gray-400">
                                    <div class="w-1.5 h-1.5 bg-accent rounded-full mr-3 flex-shrink-0"></div>
                                    <span>Konsultasi gaya rambut gratis</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-400">
                                    <div class="w-1.5 h-1.5 bg-accent rounded-full mr-3 flex-shrink-0"></div>
                                    <span>Potong rambut profesional</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-400">
                                    <div class="w-1.5 h-1.5 bg-accent rounded-full mr-3 flex-shrink-0"></div>
                                    <span>Styling dasar & finishing</span>
                                </div>
                            </div>
                            
                            <!-- Button -->
                            <button data-select-service="basic-haircut" data-navigate="barbers" class="w-full bg-accent/10 border border-accent/30 text-accent py-3 rounded-lg font-semibold hover:bg-accent hover:text-black hover:border-accent/60 hover:shadow-lg hover:shadow-accent/20 active:scale-95 active:bg-accent/90 transition-all duration-300 cursor-pointer">
                                Pilih Layanan
                            </button>
                            
                            <!-- Bottom Decorative Line -->
                            <div class="mt-6 w-16 h-px bg-gradient-to-r from-transparent via-yellow-500/30 to-transparent mx-auto"></div>
                        </div>
                    </div>
                </div>

                <!-- Service Card 2 - Potong Rambut Premium -->
                <div class="group relative">
                    <!-- Popular Badge -->
                    <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 z-20">
                        <span class="bg-accent text-black px-4 py-1 rounded-full text-xs font-bold">POPULER</span>
                    </div>
                    
                    <div class="relative bg-gradient-to-br from-gray-800/80 to-gray-900/90 backdrop-blur-sm rounded-lg overflow-hidden h-full border-2 border-yellow-500/40 group-hover:border-yellow-500/60 transition-all duration-500 group-hover:-translate-y-1 group-hover:shadow-xl group-hover:shadow-yellow-500/20">
                        
                        <!-- Image Section -->
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('images/premium haircut.jpg') }}" 
                                 alt="Potong Rambut Premium" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="w-full h-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center" style="display: none;">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                </svg>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        </div>
                        
                        <div class="p-8">
                            <!-- Gold Accent Bar -->
                            <div class="absolute top-48 left-6 right-6 h-0.5 bg-gradient-to-r from-transparent via-accent to-transparent"></div>
                        
                            <!-- Decorative Line Above Icon -->
                            <div class="w-16 h-px bg-gradient-to-r from-transparent via-yellow-500/50 to-transparent mx-auto mb-4"></div>
                            
                            <!-- Icon Container -->
                            <div class="flex justify-center mb-6">
                                <div class="w-16 h-16 bg-gradient-to-br from-yellow-500/25 to-amber-500/15 rounded-full flex items-center justify-center group-hover:bg-gradient-to-br group-hover:from-yellow-500/35 group-hover:to-amber-500/25 transition-colors duration-300 relative">
                                    <!-- Enhanced Halo Glow -->
                                    <div class="absolute inset-0 rounded-full border border-yellow-500/60 group-hover:border-yellow-500/80 transition-colors duration-300"></div>
                                    <div class="absolute inset-1 rounded-full border border-yellow-500/40 group-hover:border-yellow-500/60 transition-colors duration-300"></div>
                                    
                                    <!-- Premium Star Icon -->
                                    <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Heading -->
                            <div class="text-center mb-4">
                                <h3 class="text-xl font-bold text-accent mb-2">Potong Rambut Premium</h3>
                                <!-- Enhanced Gold Divider Line -->
                                <div class="w-16 h-px bg-gradient-to-r from-transparent via-yellow-500/60 to-transparent mx-auto mb-4"></div>
                                <p class="text-gray-300 text-sm leading-relaxed">Layanan lengkap dengan styling profesional dan treatment untuk hasil maksimal</p>
                            </div>
                            
                            <!-- Price Section -->
                            <div class="text-center mb-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-2xl font-bold text-accent">Rp 55.000</span>
                                        <div class="text-xs text-yellow-300 font-medium">Nilai terbaik</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-white text-sm">45 menit</div>
                                        <div class="text-xs text-yellow-300 font-medium">Premium</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Features -->
                            <div class="space-y-2 mb-8">
                                <div class="flex items-center text-sm text-gray-400">
                                    <div class="w-1.5 h-1.5 bg-accent rounded-full mr-3 flex-shrink-0"></div>
                                    <span>Konsultasi mendalam & analisis</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-400">
                                    <div class="w-1.5 h-1.5 bg-accent rounded-full mr-3 flex-shrink-0"></div>
                                    <span>Styling profesional premium</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-400">
                                    <div class="w-1.5 h-1.5 bg-accent rounded-full mr-3 flex-shrink-0"></div>
                                    <span>Hair treatment & vitamin</span>
                                </div>
                            </div>
                            
                            <!-- Premium Button -->
                            <button data-select-service="premium-haircut" data-navigate="barbers" class="w-full bg-accent text-black py-3 rounded-lg font-bold hover:bg-accent/90 hover:shadow-lg hover:shadow-accent/25 active:scale-95 active:bg-accent/80 transition-all duration-300 cursor-pointer">
                                Pilih Premium
                            </button>
                            
                            <!-- Bottom Decorative Line -->
                            <div class="mt-6 w-16 h-px bg-gradient-to-r from-transparent via-yellow-500/30 to-transparent mx-auto"></div>
                        </div>
                    </div>
                </div>

                <!-- Service Card 3 - Cukur Jenggot -->
                <div class="group relative">
                    <div class="relative bg-gradient-to-br from-gray-800/80 to-gray-900/90 backdrop-blur-sm rounded-lg overflow-hidden h-full border-2 border-yellow-500/40 group-hover:border-yellow-500/60 transition-all duration-500 group-hover:-translate-y-1 group-hover:shadow-xl group-hover:shadow-yellow-500/20">
                        
                        <!-- Image Section -->
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('images/shave beard.jpg') }}" 
                                 alt="Cukur Jenggot" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="w-full h-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center" style="display: none;">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        </div>
                        
                        <div class="p-8">
                            <!-- Gold Accent Bar -->
                            <div class="absolute top-48 left-6 right-6 h-0.5 bg-gradient-to-r from-transparent via-accent/60 to-transparent"></div>
                        
                            <!-- Decorative Line Above Icon -->
                            <div class="w-16 h-px bg-gradient-to-r from-transparent via-yellow-500/50 to-transparent mx-auto mb-4"></div>
                            
                            <!-- Icon Container -->
                            <div class="flex justify-center mb-6">
                                <div class="w-16 h-16 bg-gradient-to-br from-yellow-500/20 to-amber-500/10 rounded-full flex items-center justify-center group-hover:bg-gradient-to-br group-hover:from-yellow-500/30 group-hover:to-amber-500/20 transition-colors duration-300 relative">
                                    <!-- Halo Glow -->
                                    <div class="absolute inset-0 rounded-full border border-yellow-500/40 group-hover:border-yellow-500/60 transition-colors duration-300"></div>
                                    
                                    <!-- Beard Icon -->
                                    <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119.993zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Heading -->
                            <div class="text-center mb-4">
                                <h3 class="text-xl font-bold text-accent mb-2">Cukur Jenggot</h3>
                                <!-- Gold Divider Line -->
                                <div class="w-12 h-px bg-gradient-to-r from-transparent via-yellow-500/60 to-transparent mx-auto mb-4"></div>
                                <p class="text-gray-300 text-sm leading-relaxed">Perawatan jenggot profesional dengan teknik tradisional untuk tampilan maskulin</p>
                            </div>
                            
                            <!-- Price Section -->
                            <div class="text-center mb-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-2xl font-bold text-accent">Rp 25.000</span>
                                        <div class="text-xs text-gray-500">Cepat & presisi</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-white text-sm">20 menit</div>
                                        <div class="text-xs text-gray-500">Efisien</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Features -->
                            <div class="space-y-2 mb-8">
                                <div class="flex items-center text-sm text-gray-400">
                                    <div class="w-1.5 h-1.5 bg-accent rounded-full mr-3 flex-shrink-0"></div>
                                    <span>Trimming jenggot presisi</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-400">
                                    <div class="w-1.5 h-1.5 bg-accent rounded-full mr-3 flex-shrink-0"></div>
                                    <span>Shaping profesional</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-400">
                                    <div class="w-1.5 h-1.5 bg-accent rounded-full mr-3 flex-shrink-0"></div>
                                    <span>Aftercare treatment</span>
                                </div>
                            </div>
                            
                            <!-- Button -->
                            <button data-select-service="beard-trim" data-navigate="barbers" class="w-full bg-accent/10 border border-accent/30 text-accent py-3 rounded-lg font-semibold hover:bg-accent hover:text-black hover:border-accent/60 hover:shadow-lg hover:shadow-accent/20 active:scale-95 active:bg-accent/90 transition-all duration-300 cursor-pointer">
                                Pilih Layanan
                            </button>
                            
                            <!-- Bottom Decorative Line -->
                            <div class="mt-6 w-16 h-px bg-gradient-to-r from-transparent via-yellow-500/30 to-transparent mx-auto"></div>
                        </div>
                    </div>
                </div>

                <!-- Service Card 4 - Paket Lengkap -->
                <div class="group relative">
                    <!-- Hemat Badge -->
                    <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 z-20">
                        <span class="bg-green-500 text-white px-4 py-1 rounded-full text-xs font-bold">HEMAT</span>
                    </div>
                    
                    <div class="relative bg-gradient-to-br from-gray-800/80 to-gray-900/90 backdrop-blur-sm rounded-lg overflow-hidden h-full border-2 border-green-500/40 group-hover:border-green-500/60 transition-all duration-500 group-hover:-translate-y-1 group-hover:shadow-xl group-hover:shadow-green-500/20">
                        
                        <!-- Image Section -->
                        <div class="relative h-48 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=400&h=300&fit=crop&crop=face" 
                                 alt="Paket Lengkap" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        </div>
                        
                        <div class="p-8">
                            <!-- Green Accent Bar -->
                            <div class="absolute top-48 left-6 right-6 h-0.5 bg-gradient-to-r from-transparent via-green-500/60 to-transparent"></div>
                        
                            <!-- Icon Container -->
                            <div class="flex justify-center mb-6">
                                <div class="w-16 h-16 bg-green-500/10 rounded-full flex items-center justify-center group-hover:bg-green-500/20 transition-colors duration-300 relative">
                                    <!-- Halo Glow -->
                                    <div class="absolute inset-0 rounded-full border border-green-500/30 group-hover:border-green-500/50 transition-colors duration-300"></div>
                                    
                                    <!-- Package Icon -->
                                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Heading -->
                            <div class="text-center mb-4">
                                <h3 class="text-xl font-bold text-green-400 mb-2">Paket Lengkap</h3>
                                <!-- Green Divider Line -->
                                <div class="w-12 h-px bg-green-500/60 mx-auto mb-4"></div>
                                <p class="text-gray-300 text-sm leading-relaxed">Kombinasi semua layanan premium dengan harga hemat untuk pengalaman terbaik</p>
                            </div>
                            
                            <!-- Price Section -->
                            <div class="text-center mb-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-2xl font-bold text-green-500">Rp 75.000</span>
                                        <div class="text-xs text-red-400 line-through">Rp 95.000</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-white text-sm">60 menit</div>
                                        <div class="text-xs text-green-400">Hemat 20rb</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Features -->
                            <div class="space-y-2 mb-8">
                                <div class="flex items-center text-sm text-gray-400">
                                    <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-3 flex-shrink-0"></div>
                                    <span>Potong rambut premium</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-400">
                                    <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-3 flex-shrink-0"></div>
                                    <span>Cukur jenggot</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-400">
                                    <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-3 flex-shrink-0"></div>
                                    <span>Hair treatment</span>
                                </div>
                            </div>
                            
                            <!-- Button -->
                            <button data-select-service="complete-package" data-navigate="barbers" class="w-full bg-green-500 text-white py-3 rounded-lg font-bold hover:bg-green-600 hover:shadow-lg hover:shadow-green-500/25 active:scale-95 active:bg-green-700 transition-all duration-300 cursor-pointer">
                                Pilih Paket
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Service Card 5 - Keramas + Creambath -->
                <div class="group relative">
                    <div class="relative bg-gradient-to-br from-gray-800/80 to-gray-900/90 backdrop-blur-sm rounded-lg overflow-hidden h-full border-2 border-yellow-500/40 group-hover:border-yellow-500/60 transition-all duration-500 group-hover:-translate-y-1 group-hover:shadow-xl group-hover:shadow-yellow-500/20">
                        
                        <!-- Image Section -->
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('images/shampoo and cream bath.avif') }}" 
                                 alt="Keramas + Creambath" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        </div>
                        
                        <div class="p-8">
                            <!-- Gold Accent Bar -->
                            <div class="absolute top-48 left-6 right-6 h-0.5 bg-gradient-to-r from-transparent via-accent/60 to-transparent"></div>
                        
                            <!-- Decorative Line Above Icon -->
                            <div class="w-16 h-px bg-gradient-to-r from-transparent via-yellow-500/50 to-transparent mx-auto mb-4"></div>
                            
                            <!-- Icon Container -->
                            <div class="flex justify-center mb-6">
                                <div class="w-16 h-16 bg-gradient-to-br from-yellow-500/20 to-amber-500/10 rounded-full flex items-center justify-center group-hover:bg-gradient-to-br group-hover:from-yellow-500/30 group-hover:to-amber-500/20 transition-colors duration-300 relative">
                                    <!-- Halo Glow -->
                                    <div class="absolute inset-0 rounded-full border border-yellow-500/40 group-hover:border-yellow-500/60 transition-colors duration-300"></div>
                                    
                                    <!-- Heart Icon -->
                                    <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Heading -->
                            <div class="text-center mb-4">
                                <h3 class="text-xl font-bold text-accent mb-2">Keramas + Creambath</h3>
                                <!-- Gold Divider Line -->
                                <div class="w-12 h-px bg-accent/60 mx-auto mb-4"></div>
                                <p class="text-gray-300 text-sm leading-relaxed">Perawatan rambut relaksasi dengan produk premium untuk kesehatan rambut optimal</p>
                            </div>
                            
                            <!-- Price Section -->
                            <div class="text-center mb-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-2xl font-bold text-accent">Rp 30.000</span>
                                        <div class="text-xs text-gray-500">Relaksasi</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-white text-sm">25 menit</div>
                                        <div class="text-xs text-gray-500">Santai</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Features -->
                            <div class="space-y-2 mb-8">
                                <div class="flex items-center text-sm text-gray-400">
                                    <div class="w-1.5 h-1.5 bg-accent rounded-full mr-3 flex-shrink-0"></div>
                                    <span>Shampo premium</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-400">
                                    <div class="w-1.5 h-1.5 bg-accent rounded-full mr-3 flex-shrink-0"></div>
                                    <span>Creambath treatment</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-400">
                                    <div class="w-1.5 h-1.5 bg-accent rounded-full mr-3 flex-shrink-0"></div>
                                    <span>Pijat kepala relaksasi</span>
                                </div>
                            </div>
                            
                            <!-- Button -->
                            <button data-select-service="hair-wash" data-navigate="barbers" class="w-full bg-accent/10 border border-accent/30 text-accent py-3 rounded-lg font-semibold hover:bg-accent hover:text-black hover:border-accent/60 hover:shadow-lg hover:shadow-accent/20 active:scale-95 active:bg-accent/90 transition-all duration-300 cursor-pointer">
                                Pilih Layanan
                            </button>
                            
                            <!-- Bottom Decorative Line -->
                            <div class="mt-6 w-16 h-px bg-gradient-to-r from-transparent via-yellow-500/30 to-transparent mx-auto"></div>
                        </div>
                    </div>
                </div>

                <!-- Service Card 6 - Potong Rambut Anak -->
                <div class="group relative">
                    <div class="relative bg-gradient-to-br from-gray-800/80 to-gray-900/90 backdrop-blur-sm rounded-lg overflow-hidden h-full border-2 border-yellow-500/40 group-hover:border-yellow-500/60 transition-all duration-500 group-hover:-translate-y-1 group-hover:shadow-xl group-hover:shadow-yellow-500/20">
                        
                        <!-- Image Section -->
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('images/child haircut.webp') }}" 
                                 alt="Potong Rambut Anak" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 onerror="this.src='{{ asset('images/child haircut.jpg') }}'; this.onerror=function(){this.style.display='none'; this.nextElementSibling.style.display='flex';};">
                            <div class="w-full h-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center" style="display: none;">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        </div>
                        
                        <div class="p-8">
                            <!-- Gold Accent Bar -->
                            <div class="absolute top-48 left-6 right-6 h-0.5 bg-gradient-to-r from-transparent via-accent/60 to-transparent"></div>
                        
                            <!-- Decorative Line Above Icon -->
                            <div class="w-16 h-px bg-gradient-to-r from-transparent via-yellow-500/40 to-transparent mx-auto mb-4"></div>
                            
                            <!-- Icon Container -->
                            <div class="flex justify-center mb-6">
                                <div class="w-16 h-16 bg-gradient-to-br from-yellow-500/20 to-amber-500/10 rounded-full flex items-center justify-center group-hover:bg-gradient-to-br group-hover:from-yellow-500/30 group-hover:to-amber-500/20 transition-colors duration-300 relative">
                                    <!-- Halo Glow -->
                                    <div class="absolute inset-0 rounded-full border border-yellow-500/40 group-hover:border-yellow-500/60 transition-colors duration-300"></div>
                                    
                                    <!-- Child Icon -->
                                    <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Heading -->
                            <div class="text-center mb-4">
                                <h3 class="text-xl font-bold text-accent mb-2">Potong Rambut Anak</h3>
                                <!-- Gold Divider Line -->
                                <div class="w-12 h-px bg-accent/60 mx-auto mb-4"></div>
                                <p class="text-gray-300 text-sm leading-relaxed">Layanan khusus untuk anak-anak dengan pendekatan ramah dan suasana nyaman</p>
                            </div>
                            
                            <!-- Price Section -->
                            <div class="text-center mb-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-2xl font-bold text-accent">Rp 25.000</span>
                                        <div class="text-xs text-gray-500">Ramah anak</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-white text-sm">25 menit</div>
                                        <div class="text-xs text-gray-500">Sabar & telaten</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Features -->
                            <div class="space-y-2 mb-8">
                                <div class="flex items-center text-sm text-gray-400">
                                    <div class="w-1.5 h-1.5 bg-accent rounded-full mr-3 flex-shrink-0"></div>
                                    <span>Pendekatan ramah anak</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-400">
                                    <div class="w-1.5 h-1.5 bg-accent rounded-full mr-3 flex-shrink-0"></div>
                                    <span>Gaya rambut sesuai usia</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-400">
                                    <div class="w-1.5 h-1.5 bg-accent rounded-full mr-3 flex-shrink-0"></div>
                                    <span>Suasana nyaman & aman</span>
                                </div>
                            </div>
                            
                            <!-- Button -->
                            <button data-select-service="kids-haircut" data-navigate="barbers" class="w-full bg-accent/10 border border-accent/30 text-accent py-3 rounded-lg font-semibold hover:bg-accent hover:text-black hover:border-accent/60 hover:shadow-lg hover:shadow-accent/20 active:scale-95 active:bg-accent/90 transition-all duration-300 cursor-pointer">
                                Pilih Layanan
                            </button>
                            
                            <!-- Bottom Decorative Line -->
                            <div class="mt-6 w-16 h-px bg-gradient-to-r from-transparent via-yellow-500/30 to-transparent mx-auto"></div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</div>