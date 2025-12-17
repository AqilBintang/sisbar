<div class="pt-20 min-h-screen bg-gray-50">
    <!-- Hero Gallery Header -->
    <section class="bg-gradient-to-br from-slate-900 via-gray-800 to-black text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <!-- Animated background elements -->
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-20 left-10 w-40 h-40 bg-orange-500 opacity-10 rounded-full animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-32 h-32 bg-red-500 opacity-10 rounded-full animate-bounce"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-60 h-60 bg-yellow-500 opacity-5 rounded-full"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-orange-500 to-red-500 rounded-full mb-8 shadow-2xl">
                    <span class="text-4xl">📸</span>
                </div>
                <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                    Galeri <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-red-400">Karya Kami</span>
                </h1>
                <p class="text-xl md:text-2xl opacity-90 mb-8 leading-relaxed">
                    Lihat transformasi menakjubkan dari para pelanggan kami. Setiap potongan adalah karya seni yang mencerminkan kepribadian unik Anda.
                </p>
                <div class="flex flex-wrap justify-center gap-6 text-sm">
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm px-6 py-3 rounded-full border border-white border-opacity-20">
                        <span class="font-semibold">🏆 500+ Transformasi Sukses</span>
                    </div>
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm px-6 py-3 rounded-full border border-white border-opacity-20">
                        <span class="font-semibold">⭐ Rating 4.9/5</span>
                    </div>
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm px-6 py-3 rounded-full border border-white border-opacity-20">
                        <span class="font-semibold">📱 Update Mingguan</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Categories -->
    <section class="py-12 bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-center gap-4">
                <button class="gallery-filter active px-8 py-4 rounded-full bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105" data-filter="all">
                    <span class="mr-2">🎨</span> Semua Karya
                </button>
                <button class="gallery-filter px-8 py-4 rounded-full border-2 border-gray-300 text-gray-600 font-semibold hover:border-orange-500 hover:text-orange-500 transition-all duration-300" data-filter="classic">
                    <span class="mr-2">✂️</span> Classic Cut
                </button>
                <button class="gallery-filter px-8 py-4 rounded-full border-2 border-gray-300 text-gray-600 font-semibold hover:border-orange-500 hover:text-orange-500 transition-all duration-300" data-filter="modern">
                    <span class="mr-2">🔥</span> Modern Style
                </button>
                <button class="gallery-filter px-8 py-4 rounded-full border-2 border-gray-300 text-gray-600 font-semibold hover:border-orange-500 hover:text-orange-500 transition-all duration-300" data-filter="beard">
                    <span class="mr-2">🧔</span> Beard Styling
                </button>
                <button class="gallery-filter px-8 py-4 rounded-full border-2 border-gray-300 text-gray-600 font-semibold hover:border-orange-500 hover:text-orange-500 transition-all duration-300" data-filter="transformation">
                    <span class="mr-2">✨</span> Transformasi
                </button>
            </div>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="gallery-grid">
                
                <!-- Gallery Item 1 - Classic Cut -->
                <div class="gallery-item group cursor-pointer" data-category="classic" data-image="https://images.unsplash.com/photo-1621605815971-fbc98d665033?w=500&h=600&fit=crop">
                    <div class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                        <div class="aspect-[4/5] bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-6xl mb-4">✂️</div>
                                <h3 class="text-xl font-bold text-gray-700">Classic Gentleman</h3>
                                <p class="text-gray-500">Traditional Cut</p>
                            </div>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Classic Gentleman Cut</h3>
                                <p class="text-sm opacity-90">Potongan klasik dengan finishing premium</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-400 text-sm">⭐⭐⭐⭐⭐</span>
                                    <span class="ml-2 text-xs">by Master Barber</span>
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4 bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            CLASSIC
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 2 - Modern Style -->
                <div class="gallery-item group cursor-pointer" data-category="modern" data-image="https://images.unsplash.com/photo-1622286346003-c2d4e4a8e9b0?w=500&h=600&fit=crop">
                    <div class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                        <div class="aspect-[4/5] bg-gradient-to-br from-blue-200 to-purple-300 flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-6xl mb-4">🔥</div>
                                <h3 class="text-xl font-bold text-gray-700">Modern Fade</h3>
                                <p class="text-gray-500">Contemporary Style</p>
                            </div>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Modern Fade Cut</h3>
                                <p class="text-sm opacity-90">Gaya kontemporer dengan teknik fade</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-400 text-sm">⭐⭐⭐⭐⭐</span>
                                    <span class="ml-2 text-xs">Trending Style</span>
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            MODERN
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 3 - Beard Styling -->
                <div class="gallery-item group cursor-pointer" data-category="beard" data-image="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&h=600&fit=crop">
                    <div class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                        <div class="aspect-[4/5] bg-gradient-to-br from-amber-200 to-orange-300 flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-6xl mb-4">🧔</div>
                                <h3 class="text-xl font-bold text-gray-700">Beard Master</h3>
                                <p class="text-gray-500">Professional Grooming</p>
                            </div>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Beard Styling Expert</h3>
                                <p class="text-sm opacity-90">Perawatan jenggot profesional</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-400 text-sm">⭐⭐⭐⭐⭐</span>
                                    <span class="ml-2 text-xs">Signature Style</span>
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4 bg-amber-500 text-white px-3 py-1 rounded-full text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            GROOMING
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 4 - Transformation -->
                <div class="gallery-item group cursor-pointer" data-category="transformation" data-image="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=500&h=600&fit=crop">
                    <div class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                        <div class="aspect-[4/5] bg-gradient-to-br from-green-200 to-emerald-300 flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-6xl mb-4">✨</div>
                                <h3 class="text-xl font-bold text-gray-700">Total Makeover</h3>
                                <p class="text-gray-500">Before & After</p>
                            </div>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Amazing Transformation</h3>
                                <p class="text-sm opacity-90">Perubahan total yang menakjubkan</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-400 text-sm">⭐⭐⭐⭐⭐</span>
                                    <span class="ml-2 text-xs">Viral Result</span>
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            TRANSFORM
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 5 - Classic Cut -->
                <div class="gallery-item group cursor-pointer" data-category="classic" data-image="https://images.unsplash.com/photo-1605497788044-5a32c7078486?w=500&h=600&fit=crop">
                    <div class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                        <div class="aspect-[4/5] bg-gradient-to-br from-gray-200 to-slate-300 flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-6xl mb-4">👔</div>
                                <h3 class="text-xl font-bold text-gray-700">Business Style</h3>
                                <p class="text-gray-500">Professional Look</p>
                            </div>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Executive Business Cut</h3>
                                <p class="text-sm opacity-90">Gaya profesional untuk eksekutif</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-400 text-sm">⭐⭐⭐⭐⭐</span>
                                    <span class="ml-2 text-xs">Corporate Style</span>
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4 bg-gray-600 text-white px-3 py-1 rounded-full text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            BUSINESS
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 6 - Modern Style -->
                <div class="gallery-item group cursor-pointer" data-category="modern" data-image="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=500&h=600&fit=crop">
                    <div class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                        <div class="aspect-[4/5] bg-gradient-to-br from-purple-200 to-pink-300 flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-6xl mb-4">🎨</div>
                                <h3 class="text-xl font-bold text-gray-700">Creative Cut</h3>
                                <p class="text-gray-500">Artistic Style</p>
                            </div>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Creative Artistic Cut</h3>
                                <p class="text-sm opacity-90">Gaya kreatif dan artistik</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-400 text-sm">⭐⭐⭐⭐⭐</span>
                                    <span class="ml-2 text-xs">Unique Design</span>
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4 bg-purple-500 text-white px-3 py-1 rounded-full text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            CREATIVE
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 7 - Transformation -->
                <div class="gallery-item group cursor-pointer" data-category="transformation" data-image="https://images.unsplash.com/photo-1582095133179-bfd08e2fc6b3?w=500&h=600&fit=crop">
                    <div class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                        <div class="aspect-[4/5] bg-gradient-to-br from-red-200 to-pink-300 flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-6xl mb-4">🌟</div>
                                <h3 class="text-xl font-bold text-gray-700">Style Revolution</h3>
                                <p class="text-gray-500">Complete Change</p>
                            </div>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Style Revolution</h3>
                                <p class="text-sm opacity-90">Revolusi gaya yang mengagumkan</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-400 text-sm">⭐⭐⭐⭐⭐</span>
                                    <span class="ml-2 text-xs">Life Changing</span>
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            REVOLUTION
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 8 - Beard Styling -->
                <div class="gallery-item group cursor-pointer" data-category="beard" data-image="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?w=500&h=600&fit=crop">
                    <div class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                        <div class="aspect-[4/5] bg-gradient-to-br from-yellow-200 to-amber-300 flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-6xl mb-4">🪒</div>
                                <h3 class="text-xl font-bold text-gray-700">Precision Shave</h3>
                                <p class="text-gray-500">Master Technique</p>
                            </div>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Precision Shave Art</h3>
                                <p class="text-sm opacity-90">Seni cukur dengan presisi tinggi</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-400 text-sm">⭐⭐⭐⭐⭐</span>
                                    <span class="ml-2 text-xs">Master Level</span>
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4 bg-yellow-500 text-black px-3 py-1 rounded-full text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            PRECISION
                        </div>
                    </div>
                </div>

            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12">
                <button id="loadMore" class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-8 py-4 rounded-xl font-bold text-lg hover:from-orange-600 hover:to-red-600 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <span class="mr-2">📸</span>
                    Lihat Lebih Banyak Karya
                </button>
            </div>
        </div>
    </section>    <!
-- Customer Testimonials -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Apa Kata Pelanggan Kami?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Kepuasan pelanggan adalah prioritas utama kami. Lihat testimoni dari mereka yang telah merasakan layanan terbaik kami.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-gradient-to-br from-gray-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-red-400 rounded-full flex items-center justify-center text-white text-2xl font-bold mr-4">
                            A
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Ahmad Rizki</h4>
                            <p class="text-gray-500 text-sm">Eksekutif Muda</p>
                        </div>
                    </div>
                    <div class="text-yellow-400 mb-4">
                        <span class="text-lg">⭐⭐⭐⭐⭐</span>
                    </div>
                    <p class="text-gray-600 italic leading-relaxed">
                        "Pelayanan luar biasa! Barbernya sangat profesional dan hasil potongannya sesuai dengan yang saya inginkan. Tempatnya juga bersih dan nyaman."
                    </p>
                    <div class="mt-4 text-sm text-gray-500">
                        <span class="mr-2">📅</span> 2 minggu yang lalu
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-blue-100">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-purple-400 rounded-full flex items-center justify-center text-white text-2xl font-bold mr-4">
                            B
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Budi Santoso</h4>
                            <p class="text-gray-500 text-sm">Pengusaha</p>
                        </div>
                    </div>
                    <div class="text-yellow-400 mb-4">
                        <span class="text-lg">⭐⭐⭐⭐⭐</span>
                    </div>
                    <p class="text-gray-600 italic leading-relaxed">
                        "Sudah langganan di sini hampir 2 tahun. Konsisten memberikan hasil terbaik. Harga juga sangat reasonable untuk kualitas yang diberikan."
                    </p>
                    <div class="mt-4 text-sm text-gray-500">
                        <span class="mr-2">📅</span> 1 minggu yang lalu
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-gradient-to-br from-green-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-green-100">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-emerald-400 rounded-full flex items-center justify-center text-white text-2xl font-bold mr-4">
                            C
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Chandra Wijaya</h4>
                            <p class="text-gray-500 text-sm">Content Creator</p>
                        </div>
                    </div>
                    <div class="text-yellow-400 mb-4">
                        <span class="text-lg">⭐⭐⭐⭐⭐</span>
                    </div>
                    <p class="text-gray-600 italic leading-relaxed">
                        "Perfect untuk foto dan video content! Barbernya paham banget soal gaya rambut yang photogenic. Highly recommended!"
                    </p>
                    <div class="mt-4 text-sm text-gray-500">
                        <span class="mr-2">📅</span> 3 hari yang lalu
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Media Integration -->
    <section class="py-16 bg-gradient-to-br from-gray-900 to-black text-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Ikuti Kami di Social Media</h2>
                <p class="text-xl opacity-90 max-w-2xl mx-auto">
                    Dapatkan update terbaru, tips grooming, dan lihat karya-karya terbaru kami setiap hari
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Instagram -->
                <div class="text-center group">
                    <div class="bg-gradient-to-br from-pink-500 to-purple-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <span class="text-3xl text-white">📷</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Instagram</h3>
                    <p class="text-gray-300 text-sm mb-4">Daily updates & behind the scenes</p>
                    <a href="#" class="inline-flex items-center text-pink-400 hover:text-pink-300 font-semibold">
                        <span class="mr-2">👀</span> @panglingbarbershop
                    </a>
                </div>

                <!-- TikTok -->
                <div class="text-center group">
                    <div class="bg-gradient-to-br from-black to-gray-800 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <span class="text-3xl text-white">🎵</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">TikTok</h3>
                    <p class="text-gray-300 text-sm mb-4">Viral haircut transformations</p>
                    <a href="#" class="inline-flex items-center text-gray-300 hover:text-white font-semibold">
                        <span class="mr-2">🔥</span> @panglingbarber
                    </a>
                </div>

                <!-- YouTube -->
                <div class="text-center group">
                    <div class="bg-gradient-to-br from-red-500 to-red-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <span class="text-3xl text-white">📺</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">YouTube</h3>
                    <p class="text-gray-300 text-sm mb-4">Tutorials & full transformations</p>
                    <a href="#" class="inline-flex items-center text-red-400 hover:text-red-300 font-semibold">
                        <span class="mr-2">▶️</span> Pangling Barbershop
                    </a>
                </div>

                <!-- Facebook -->
                <div class="text-center group">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <span class="text-3xl text-white">👥</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Facebook</h3>
                    <p class="text-gray-300 text-sm mb-4">Community & customer stories</p>
                    <a href="#" class="inline-flex items-center text-blue-400 hover:text-blue-300 font-semibold">
                        <span class="mr-2">👍</span> Pangling Barbershop
                    </a>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="text-center mt-12">
                <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl p-8 max-w-2xl mx-auto">
                    <h3 class="text-2xl font-bold mb-4">Bagikan Transformasi Anda!</h3>
                    <p class="mb-6 opacity-90">
                        Tag kami di foto hasil potongan Anda dan dapatkan kesempatan untuk ditampilkan di galeri kami
                    </p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <span class="bg-white bg-opacity-20 px-4 py-2 rounded-full text-sm font-semibold">
                            #PanglingTransformation
                        </span>
                        <span class="bg-white bg-opacity-20 px-4 py-2 rounded-full text-sm font-semibold">
                            #PanglingBarbershop
                        </span>
                        <span class="bg-white bg-opacity-20 px-4 py-2 rounded-full text-sm font-semibold">
                            #BarberLife
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Gallery Lightbox -->
    <div id="galleryModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
        <div class="relative max-w-4xl w-full">
            <button id="closeModal" class="absolute top-4 right-4 text-white text-4xl hover:text-gray-300 z-10">
                ×
            </button>
            <div class="bg-white rounded-2xl overflow-hidden">
                <div id="modalImage" class="aspect-[4/5] bg-gray-200 flex items-center justify-center">
                    <span class="text-6xl">📸</span>
                </div>
                <div class="p-6">
                    <h3 id="modalTitle" class="text-2xl font-bold mb-2">Gallery Item</h3>
                    <p id="modalDescription" class="text-gray-600 mb-4">Description</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="text-yellow-400 mr-2">⭐⭐⭐⭐⭐</span>
                            <span class="text-sm text-gray-500">by Master Barber</span>
                        </div>
                        <button class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-2 rounded-lg font-semibold hover:from-orange-600 hover:to-red-600 transition-colors">
                            Book Similar Style
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gallery filter functionality
    const filterButtons = document.querySelectorAll('.gallery-filter');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterButtons.forEach(btn => {
                btn.classList.remove('active', 'bg-gradient-to-r', 'from-orange-500', 'to-red-500', 'text-white');
                btn.classList.add('border-2', 'border-gray-300', 'text-gray-600');
            });
            
            this.classList.add('active', 'bg-gradient-to-r', 'from-orange-500', 'to-red-500', 'text-white');
            this.classList.remove('border-2', 'border-gray-300', 'text-gray-600');
            
            // Filter gallery items with stagger animation
            galleryItems.forEach((item, index) => {
                const category = item.getAttribute('data-category');
                
                if (filter === 'all' || category === filter) {
                    setTimeout(() => {
                        item.style.display = 'block';
                        item.style.opacity = '0';
                        item.style.transform = 'translateY(30px)';
                        
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'translateY(0)';
                        }, 50);
                    }, index * 100);
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(30px)';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
    
    // Gallery lightbox functionality
    const modal = document.getElementById('galleryModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    const closeModal = document.getElementById('closeModal');
    
    galleryItems.forEach(item => {
        item.addEventListener('click', function() {
            const category = this.getAttribute('data-category');
            const title = this.querySelector('h3').textContent;
            const description = this.querySelector('p').textContent;
            
            modalTitle.textContent = title;
            modalDescription.textContent = description;
            modal.classList.remove('hidden');
            
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
        });
    });
    
    // Close modal functionality
    closeModal.addEventListener('click', function() {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });
    
    // Close modal on backdrop click
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });
    
    // Load more functionality
    const loadMoreBtn = document.getElementById('loadMore');
    let isLoading = false;
    
    loadMoreBtn.addEventListener('click', function() {
        if (isLoading) return;
        
        isLoading = true;
        const originalText = this.innerHTML;
        this.innerHTML = '<span class="animate-spin mr-2">⏳</span>Loading...';
        this.disabled = true;
        
        // Simulate loading more items
        setTimeout(() => {
            // Add more gallery items here
            this.innerHTML = originalText;
            this.disabled = false;
            isLoading = false;
            
            // Show success message
            const successMsg = document.createElement('div');
            successMsg.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
            successMsg.textContent = '✅ Lebih banyak karya telah dimuat!';
            document.body.appendChild(successMsg);
            
            setTimeout(() => {
                successMsg.remove();
            }, 3000);
        }, 2000);
    });
    
    // Scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe gallery items for scroll animations
    galleryItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(30px)';
        item.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(item);
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });
});
</script>