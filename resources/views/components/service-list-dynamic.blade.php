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

    <!-- Services Grid - Dynamic from Database -->
    <section class="relative py-16">
        <div class="container mx-auto px-4">
            @if(isset($services) && $services->count() > 0)
            <!-- Grid Responsif -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 max-w-7xl mx-auto items-stretch">
                @foreach($services as $service)
                <!-- Service Card - {{ $service->name }} -->
                <div class="group relative">
                    @if($service->type === 'populer')
                    <!-- Popular Badge -->
                    <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 z-20">
                        <span class="bg-accent text-black px-4 py-1 rounded-full text-xs font-bold">POPULER</span>
                    </div>
                    @elseif($service->type === 'ekonomis')
                    <!-- Ekonomis Badge -->
                    <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 z-20">
                        <span class="bg-green-500 text-white px-4 py-1 rounded-full text-xs font-bold">EKONOMIS</span>
                    </div>
                    @elseif($service->type === 'paket')
                    <!-- Hemat Badge -->
                    <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 z-20">
                        <span class="bg-blue-500 text-white px-4 py-1 rounded-full text-xs font-bold">PAKET</span>
                    </div>
                    @elseif($service->type === 'premium')
                    <!-- Premium Badge -->
                    <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 z-20">
                        <span class="bg-purple-500 text-white px-4 py-1 rounded-full text-xs font-bold">PREMIUM</span>
                    </div>
                    @endif
                    
                    <div class="relative bg-gradient-to-br from-gray-800/80 to-gray-900/90 backdrop-blur-sm rounded-lg overflow-hidden h-full border-2 
                        @if($service->type === 'ekonomis') border-green-500/40 group-hover:border-green-500/60 group-hover:shadow-green-500/20
                        @elseif($service->type === 'paket') border-blue-500/40 group-hover:border-blue-500/60 group-hover:shadow-blue-500/20
                        @elseif($service->type === 'premium') border-purple-500/40 group-hover:border-purple-500/60 group-hover:shadow-purple-500/20
                        @else border-yellow-500/40 group-hover:border-yellow-500/60 group-hover:shadow-yellow-500/20 @endif
                        transition-all duration-500 group-hover:-translate-y-1 group-hover:shadow-xl">
                        
                        <!-- Image Section -->
                        <div class="relative h-48 overflow-hidden">
                            @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" 
                                 alt="{{ $service->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                            <!-- Default image based on service type -->
                            <div class="w-full h-full bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center">
                                <div class="text-center">
                                    @if(str_contains(strtolower($service->name), 'potong') || str_contains(strtolower($service->name), 'haircut'))
                                        <svg class="w-16 h-16 text-accent mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.848 8.25l1.536.887M7.848 8.25a3 3 0 11-5.196-3 3 3 0 015.196 3zm1.536.887a2.165 2.165 0 011.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 11-5.196 3 3 3 0 015.196-3zm1.536-.887a2.165 2.165 0 001.083-1.839c.005-.351.054-.695.14-1.024M9.384 14.863L11.461 13.664M16.652 8.25l-1.536.887M16.652 8.25a3 3 0 105.196-3 3 3 0 00-5.196 3zm-1.536.887a2.165 2.165 0 00-1.083 1.839c-.005.351-.054.695-.14 1.024m1.223-.863L12.539 9.137M16.652 15.75l-1.536-.887m1.536.887a3 3 0 105.196 3 3 3 0 00-5.196-3zm-1.536-.887a2.165 2.165 0 01-1.083-1.839c-.005-.351-.054-.695-.14-1.024m1.223.863L12.539 14.863" />
                                        </svg>
                                    @elseif(str_contains(strtolower($service->name), 'jenggot') || str_contains(strtolower($service->name), 'beard'))
                                        <svg class="w-16 h-16 text-accent mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119.993z" />
                                        </svg>
                                    @elseif(str_contains(strtolower($service->name), 'paket'))
                                        <svg class="w-16 h-16 text-green-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                        </svg>
                                    @else
                                        <svg class="w-16 h-16 text-accent mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" />
                                        </svg>
                                    @endif
                                    <p class="text-gray-400 text-sm">{{ $service->name }}</p>
                                </div>
                            </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        </div>
                        
                        <div class="p-8">
                            <!-- Accent Bar -->
                            <div class="absolute top-48 left-6 right-6 h-0.5 bg-gradient-to-r from-transparent 
                                @if($service->type === 'ekonomis') via-green-500/60 
                                @elseif($service->type === 'paket') via-blue-500/60 
                                @elseif($service->type === 'premium') via-purple-500/60 
                                @else via-accent/60 @endif to-transparent"></div>
                        
                            <!-- Decorative Line Above Icon -->
                            <div class="w-16 h-px bg-gradient-to-r from-transparent 
                                @if($service->type === 'ekonomis') via-green-500/40 
                                @elseif($service->type === 'paket') via-blue-500/40 
                                @elseif($service->type === 'premium') via-purple-500/40 
                                @else via-yellow-500/40 @endif to-transparent mx-auto mb-4"></div>
                            
                            <!-- Icon Container -->
                            <div class="flex justify-center mb-6">
                                <div class="w-16 h-16 bg-gradient-to-br 
                                    @if($service->type === 'ekonomis') from-green-500/20 to-green-600/10 group-hover:from-green-500/30 group-hover:to-green-600/20
                                    @elseif($service->type === 'paket') from-blue-500/20 to-blue-600/10 group-hover:from-blue-500/30 group-hover:to-blue-600/20
                                    @elseif($service->type === 'premium') from-purple-500/20 to-purple-600/10 group-hover:from-purple-500/30 group-hover:to-purple-600/20
                                    @else from-yellow-500/20 to-amber-500/10 group-hover:from-yellow-500/30 group-hover:to-amber-500/20 @endif
                                    rounded-full flex items-center justify-center transition-colors duration-300 relative">
                                    <!-- Halo Glow -->
                                    <div class="absolute inset-0 rounded-full border 
                                        @if($service->type === 'ekonomis') border-green-500/40 group-hover:border-green-500/60
                                        @elseif($service->type === 'paket') border-blue-500/40 group-hover:border-blue-500/60
                                        @elseif($service->type === 'premium') border-purple-500/40 group-hover:border-purple-500/60
                                        @else border-yellow-500/40 group-hover:border-yellow-500/60 @endif
                                        transition-colors duration-300"></div>
                                    
                                    <!-- Service Type Badge -->
                                    <span class="text-xs font-bold 
                                        @if($service->type === 'ekonomis') text-green-500
                                        @elseif($service->type === 'paket') text-blue-500
                                        @elseif($service->type === 'premium') text-purple-500
                                        @else text-accent @endif">
                                        {{ strtoupper($service->type) }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Heading -->
                            <div class="text-center mb-4">
                                <h3 class="text-xl font-bold 
                                    @if($service->type === 'ekonomis') text-green-400
                                    @elseif($service->type === 'paket') text-blue-400
                                    @elseif($service->type === 'premium') text-purple-400
                                    @else text-accent @endif mb-2">{{ $service->name }}</h3>
                                <!-- Divider Line -->
                                <div class="w-12 h-px bg-gradient-to-r from-transparent 
                                    @if($service->type === 'ekonomis') via-green-500/60
                                    @elseif($service->type === 'paket') via-blue-500/60
                                    @elseif($service->type === 'premium') via-purple-500/60
                                    @else via-yellow-500/60 @endif to-transparent mx-auto mb-4"></div>
                                @if($service->description)
                                <p class="text-gray-300 text-sm leading-relaxed">{{ $service->description }}</p>
                                @endif
                            </div>
                            
                            <!-- Price Section -->
                            <div class="text-center mb-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-2xl font-bold 
                                            @if($service->type === 'ekonomis') text-green-500
                                            @elseif($service->type === 'paket') text-blue-500
                                            @elseif($service->type === 'premium') text-purple-500
                                            @else text-accent @endif">{{ $service->formatted_price }}</span>
                                        <div class="text-xs text-gray-500">
                                            @if($service->type === 'ekonomis') Ramah kantong
                                            @elseif($service->type === 'populer') Nilai terbaik
                                            @elseif($service->type === 'premium') Premium
                                            @elseif($service->type === 'paket') Hemat
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-white text-sm">{{ $service->duration }} menit</div>
                                        <div class="text-xs 
                                            @if($service->type === 'ekonomis') text-green-400
                                            @elseif($service->type === 'paket') text-blue-400
                                            @elseif($service->type === 'premium') text-purple-400
                                            @else text-gray-500 @endif">
                                            @if($service->duration <= 30) Cepat
                                            @elseif($service->duration <= 45) Efisien
                                            @else Lengkap @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Features -->
                            @if($service->features && count($service->features) > 0)
                            <div class="space-y-2 mb-8">
                                @foreach($service->features as $feature)
                                <div class="flex items-center text-sm text-gray-400">
                                    <div class="w-1.5 h-1.5 
                                        @if($service->type === 'ekonomis') bg-green-500
                                        @elseif($service->type === 'paket') bg-blue-500
                                        @elseif($service->type === 'premium') bg-purple-500
                                        @else bg-accent @endif rounded-full mr-3 flex-shrink-0"></div>
                                    <span>{{ $feature }}</span>
                                </div>
                                @endforeach
                            </div>
                            @endif
                            
                            <!-- Button -->
                            <button data-select-service="{{ $service->id }}" data-navigate="barbers" 
                                class="w-full py-3 rounded-lg font-semibold transition-all duration-300 cursor-pointer
                                @if($service->type === 'ekonomis') bg-green-500 text-white hover:bg-green-600 hover:shadow-lg hover:shadow-green-500/25 active:scale-95 active:bg-green-700
                                @elseif($service->type === 'paket') bg-blue-500 text-white hover:bg-blue-600 hover:shadow-lg hover:shadow-blue-500/25 active:scale-95 active:bg-blue-700
                                @elseif($service->type === 'premium') bg-purple-500 text-white hover:bg-purple-600 hover:shadow-lg hover:shadow-purple-500/25 active:scale-95 active:bg-purple-700
                                @elseif($service->type === 'populer') bg-accent text-black hover:bg-accent/90 hover:shadow-lg hover:shadow-accent/25 active:scale-95 active:bg-accent/80
                                @else bg-accent/10 border border-accent/30 text-accent hover:bg-accent hover:text-black hover:border-accent/60 hover:shadow-lg hover:shadow-accent/20 active:scale-95 active:bg-accent/90 @endif">
                                @if($service->type === 'ekonomis') Pilih Ekonomis
                                @elseif($service->type === 'paket') Pilih Paket
                                @elseif($service->type === 'premium') Pilih Premium
                                @else Pilih Layanan @endif
                            </button>
                            
                            <!-- Bottom Decorative Line -->
                            <div class="mt-6 w-16 h-px bg-gradient-to-r from-transparent 
                                @if($service->type === 'ekonomis') via-green-500/30
                                @elseif($service->type === 'paket') via-blue-500/30
                                @elseif($service->type === 'premium') via-purple-500/30
                                @else via-yellow-500/30 @endif to-transparent mx-auto"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Belum Ada Layanan</h3>
                    <p class="text-gray-400 mb-6">Layanan sedang dalam proses penambahan. Silakan kembali lagi nanti.</p>
                    <button data-navigate="home" class="bg-accent text-black px-6 py-3 rounded-lg font-semibold hover:bg-accent/90 transition-colors">
                        Kembali ke Home
                    </button>
                </div>
            </div>
            @endif
        </div>
    </section>
</div>