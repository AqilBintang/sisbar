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
                <div class="mt-3">
                    <a href="https://instagram.com/sisbarhairstudio" target="_blank" class="inline-flex items-center text-gray-400 hover:text-accent transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                        <span class="text-sm">@sisbarhairstudio</span>
                    </a>
                </div>
            </div>

            <!-- Navigation -->
            <div>
                <h3 class="text-base font-bold mb-4">Navigasi</h3>
                <ul class="space-y-2">
                    <li><a href="javascript:void(0)" data-navigate="home" class="text-gray-400 hover:text-accent transition-colors text-sm">Home</a></li>
                    <li><a href="javascript:void(0)" data-navigate="services" class="text-gray-400 hover:text-accent transition-colors text-sm">Layanan</a></li>
                    <li><a href="javascript:void(0)" data-navigate="barbers" class="text-gray-400 hover:text-accent transition-colors text-sm">Kapster</a></li>
                    <li><a href="javascript:void(0)" data-navigate="booking" class="text-gray-400 hover:text-accent transition-colors text-sm">Booking</a></li>
                    <li><a href="{{ route('booking.dashboard') }}" class="text-gray-400 hover:text-accent transition-colors text-sm">Dashboard</a></li>
                    <li><a href="{{ route('barber.login') }}" class="text-gray-400 hover:text-accent transition-colors text-sm">Login Kapster</a></li>
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