<div class="pt-20 min-h-screen relative">
    <!-- Background Halus & Nyaman -->
    <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-black to-gray-800">
        <!-- Subtle Pattern Overlay -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-gradient-to-br from-transparent via-yellow-400/5 to-transparent"></div>
        </div>
        <!-- Soft Dark Overlay -->
        <div class="absolute inset-0 bg-black/40"></div>
    </div>

    <!-- Barber Showcase -->
    <section class="py-20 relative z-10 barber-showcase-section">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Kapster Profesional Kami</h2>
                <p class="text-gray-300 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed">
                    Setiap kapster memiliki keahlian unik dan pengalaman bertahun-tahun dalam seni memotong rambut
                </p>
                <div class="flex justify-center mt-8">
                    <div class="w-32 h-1 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-full"></div>
                </div>
            </div>
            
            @if(isset($barbers) && $barbers->count() > 0)
            <!-- Grid Layout Responsif dengan Ukuran Card Seragam -->
            <div class="barber-cards-grid">
                @foreach($barbers as $index => $barber)
                    @php
                        // Level styling dengan warna yang konsisten
                        $levelStyles = match($barber->level) {
                            'master' => [
                                'badge_bg' => 'bg-gradient-to-r from-yellow-400 to-yellow-500',
                                'badge_text' => 'text-black'
                            ],
                            'senior' => [
                                'badge_bg' => 'bg-gradient-to-r from-blue-400 to-blue-500',
                                'badge_text' => 'text-white'
                            ],
                            'professional' => [
                                'badge_bg' => 'bg-gradient-to-r from-green-400 to-green-500',
                                'badge_text' => 'text-white'
                            ],
                            'specialist' => [
                                'badge_bg' => 'bg-gradient-to-r from-purple-400 to-purple-500',
                                'badge_text' => 'text-white'
                            ],
                            'creative' => [
                                'badge_bg' => 'bg-gradient-to-r from-pink-400 to-pink-500',
                                'badge_text' => 'text-white'
                            ],
                            default => [
                                'badge_bg' => 'bg-gradient-to-r from-gray-400 to-gray-500',
                                'badge_text' => 'text-white'
                            ]
                        };
                    @endphp

                    <!-- Barber Card - Fixed Height untuk Konsistensi MUTLAK -->
                    <div class="barber-card-uniform group relative">
                        <!-- Main Card Container - Fixed Height 480px -->
                        <div class="barber-card-container relative h-[480px] bg-gradient-to-br from-gray-900/95 via-gray-800/90 to-black/95 
                                    backdrop-blur-sm rounded-2xl border border-gray-700/30 
                                    shadow-xl hover:shadow-2xl hover:-translate-y-2 hover:scale-[1.01]
                                    transition-all duration-500 ease-out overflow-hidden flex flex-col">
                            
                            <!-- Photo Section - Fixed Height 140px -->
                            <div class="barber-photo-section relative h-[140px] p-4 flex items-center justify-center flex-shrink-0">
                                <div class="relative">
                                    <!-- Photo Container - Enlarged Size 130x130 -->
                                    <div class="w-[130px] h-[130px] rounded-full overflow-hidden border-2 border-yellow-400/40 shadow-lg
                                                group-hover:shadow-yellow-400/30 group-hover:scale-105 transition-all duration-300
                                                bg-gradient-to-br from-gray-700 to-gray-900">
                                        @if($barber->photo)
                                            <img src="{{ asset('image/' . $barber->photo) }}" alt="{{ $barber->name }}" 
                                                 class="w-full h-full object-cover object-center"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        @endif
                                        <!-- Default avatar (always present as fallback) -->
                                        <div class="w-full h-full flex items-center justify-center {{ $barber->photo ? 'hidden' : '' }}" 
                                             style="{{ $barber->photo ? 'display: none;' : '' }}">
                                            <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </div>
                                    
                                    <!-- Level Badge - Positioned Consistently -->
                                    <div class="absolute -top-1 -right-1 {{ $levelStyles['badge_bg'] }} {{ $levelStyles['badge_text'] }} 
                                                px-2 py-1 rounded-lg text-xs font-bold shadow-lg">
                                        {{ ucfirst($barber->level) }}
                                    </div>
                                </div>
                            </div>

                            <!-- Content Section - Flex Grow untuk Mengisi Sisa Ruang -->
                            <div class="barber-content-section px-5 pb-5 flex-grow flex flex-col">
                                
                                <!-- Name & Specialty Section - Auto Height -->
                                <div class="barber-name-section text-center mb-3 flex flex-col justify-center flex-shrink-0">
                                    <h3 class="text-lg font-bold text-white mb-1 group-hover:text-yellow-400 transition-colors duration-300">
                                        {{ $barber->name }}
                                    </h3>
                                    
                                    <!-- Specialty Badge - Auto Adjusting -->
                                    @if($barber->specialty)
                                    <div class="specialty-container mt-1">
                                        <span class="inline-block bg-yellow-400/10 text-yellow-400 px-2 py-1 rounded-full text-xs font-medium border border-yellow-400/30">
                                            {{ $barber->specialty }}
                                        </span>
                                    </div>
                                    @endif
                                </div>

                                <!-- Rating Section - Fixed Height 45px -->
                                <div class="barber-rating-section text-center mb-3 h-[45px] flex flex-col justify-center flex-shrink-0">
                                    <!-- Star Rating Display -->
                                    <div class="flex items-center justify-center mb-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-3 h-3 {{ $i <= ($barber->rating ?? 5) ? 'text-yellow-400' : 'text-gray-600' }} mr-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <div class="flex items-center justify-center space-x-3 text-xs">
                                        <span class="text-yellow-400 font-bold">{{ number_format($barber->rating ?? 5.0, 1) }}</span>
                                        <span class="text-gray-400">({{ rand(50, 200) }}+ ulasan)</span>
                                    </div>
                                </div>

                                <!-- Info Details Section - Auto Adjusting Content -->
                                <div class="barber-info-section flex-grow flex flex-col space-y-2 mb-4">
                                    <!-- Schedule - Auto Height -->
                                    <div class="schedule-info flex items-start text-gray-300">
                                        <svg class="w-3 h-3 mr-2 text-yellow-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-xs font-medium">
                                            {{ $barber->schedule ?? 'Senin - Minggu: 09:00 - 21:00' }}
                                        </span>
                                    </div>
                                    
                                    <!-- Experience - Auto Height -->
                                    @if($barber->experience)
                                    <div class="experience-info flex items-start text-gray-300">
                                        <svg class="w-3 h-3 mr-2 text-yellow-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-xs font-medium">{{ $barber->experience }}</span>
                                    </div>
                                    @endif

                                    <!-- Bio/Description - Auto Height with Scroll if Needed -->
                                    @if($barber->bio)
                                    <div class="bio-info flex items-start text-gray-300">
                                        <svg class="w-3 h-3 mr-2 text-yellow-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                        <div class="bio-text text-xs font-medium max-h-16 overflow-y-auto scrollbar-thin scrollbar-thumb-yellow-400/30 scrollbar-track-gray-700/20">
                                            {{ $barber->bio }}
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Services/Skills - Auto Height -->
                                    @if($barber->skills && is_array($barber->skills))
                                    <div class="skills-info mt-2">
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($barber->skills as $skill)
                                                <span class="bg-gray-700/50 text-gray-300 px-2 py-1 rounded text-xs font-medium border border-gray-600/50">
                                                    {{ $skill }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </div>


                            </div>

                            <!-- Subtle Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent pointer-events-none rounded-2xl"></div>
                            
                            <!-- Hover Effect Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none rounded-2xl"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            @else
            <!-- No Barbers Message -->
            <div class="text-center py-20 no-barbers-message max-w-md mx-auto">
                <div class="w-24 h-24 bg-gradient-to-br from-yellow-400/20 to-yellow-600/20 rounded-full flex items-center justify-center mx-auto mb-6 border border-yellow-400/30">
                    <svg class="w-12 h-12 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">Belum Ada Kapster</h3>
                <p class="text-gray-300 text-lg">Tim kapster profesional kami sedang dalam proses rekrutmen.</p>
            </div>
            @endif

        </div>
    </section>

</div>