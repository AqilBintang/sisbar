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
                    <li><a href="/" class="text-gray-400 hover:text-accent transition-colors text-sm">Home</a></li>
                    <li><a href="{{ route('services') }}" class="text-gray-400 hover:text-accent transition-colors text-sm">Layanan</a></li>
                    <li><a href="{{ route('barbers') }}" class="text-gray-400 hover:text-accent transition-colors text-sm">Kapster</a></li>
                    <li><a href="{{ route('booking.index') }}" class="text-gray-400 hover:text-accent transition-colors text-sm">Booking</a></li>
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