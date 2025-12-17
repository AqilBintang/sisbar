@extends('layouts.app')

@section('title', 'Booking Confirmation - Sisbar Hairstudio')

@section('content')
<div class="min-h-screen bg-black pt-20">
    <!-- Background Image with Dark Overlay -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/bg-barber.jpg') }}');">
        <div class="absolute inset-0 bg-black/80"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 py-20">
        <div class="max-w-2xl mx-auto">
            <!-- Success Icon -->
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-white mb-4">Booking Berhasil!</h1>
                <p class="text-gray-300 text-lg">Terima kasih telah mempercayakan perawatan rambut Anda kepada kami</p>
                <div class="flex justify-center mt-6">
                    <div class="w-24 h-1 bg-linear-to-r from-yellow-400 to-yellow-600 rounded-full"></div>
                </div>
            </div>

            <!-- Booking Details Card -->
            <div class="bg-slate-800 rounded-3xl shadow-2xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-white mb-6 text-center">Detail Booking Anda</h2>
                
                <div id="booking-details" class="space-y-4">
                    <!-- Details will be populated by JavaScript -->
                </div>

                <div class="border-t border-slate-600 pt-6 mt-6">
                    <div class="bg-yellow-500/10 border border-yellow-500/30 rounded-xl p-4">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-yellow-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="text-yellow-400 font-semibold mb-2">Informasi Penting:</h3>
                                <ul class="text-gray-300 text-sm space-y-1">
                                    <li>• Kami akan menghubungi Anda untuk konfirmasi booking</li>
                                    <li>• Harap datang 10 menit sebelum waktu appointment</li>
                                    <li>• Jika ada perubahan, hubungi kami minimal 2 jam sebelumnya</li>
                                    <li>• Pembayaran dapat dilakukan secara tunai atau transfer</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-slate-800 rounded-3xl shadow-2xl p-8 mb-8">
                <h3 class="text-xl font-bold text-white mb-4 text-center">Hubungi Kami</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h4 class="text-white font-semibold">Telepon</h4>
                        <p class="text-gray-300">+62 812-3456-7890</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-white font-semibold">Alamat</h4>
                        <p class="text-gray-300">Jl. Raya Barbershop No. 123</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center space-y-4">
                <a href="{{ route('booking.index') }}" 
                   class="inline-block px-8 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-xl transition-colors mr-4">
                    Booking Lagi
                </a>
                <a href="{{ route('booking.status') }}" 
                   class="inline-block px-8 py-3 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-xl transition-colors mr-4">
                    Cek Status Booking
                </a>
                <a href="/" 
                   class="inline-block px-8 py-3 bg-slate-600 hover:bg-slate-500 text-white font-bold rounded-xl transition-colors">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get booking data from URL parameters or localStorage
    const urlParams = new URLSearchParams(window.location.search);
    const bookingId = urlParams.get('booking_id');
    
    if (bookingId) {
        // Fetch booking details from server
        fetch(`/booking/${bookingId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayBookingDetails(data.booking);
                }
            })
            .catch(error => {
                console.error('Error fetching booking details:', error);
            });
    } else {
        // Try to get from localStorage (fallback)
        const bookingData = localStorage.getItem('lastBooking');
        if (bookingData) {
            const booking = JSON.parse(bookingData);
            displayBookingDetails(booking);
            localStorage.removeItem('lastBooking'); // Clean up
        }
    }
});

function displayBookingDetails(booking) {
    const detailsContainer = document.getElementById('booking-details');
    
    detailsContainer.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-400">Booking ID:</span>
                    <span class="text-white font-semibold">#${booking.id}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Nama:</span>
                    <span class="text-white">${booking.customer_name}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Telepon:</span>
                    <span class="text-white">${booking.customer_phone || '-'}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Status:</span>
                    <span class="text-yellow-400 font-semibold">${booking.status || 'Menunggu Konfirmasi'}</span>
                </div>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-400">Tanggal:</span>
                    <span class="text-white">${booking.date}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Waktu:</span>
                    <span class="text-white">${booking.time}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Kapster:</span>
                    <span class="text-white">${booking.barber_name}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Layanan:</span>
                    <span class="text-white">${booking.service_name}</span>
                </div>
            </div>
        </div>
        <div class="border-t border-slate-600 pt-4 mt-4">
            <div class="flex justify-between items-center">
                <span class="text-xl font-bold text-white">Total Harga:</span>
                <span class="text-2xl font-bold text-yellow-400">Rp ${booking.total_price ? booking.total_price.toLocaleString('id-ID') : '0'}</span>
            </div>
        </div>
    `;
}
</script>
@endsection