<div class="pt-20 min-h-screen bg-background">
    <!-- Success Header -->
    <section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="text-4xl text-green-600">✅</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Booking Berhasil!</h1>
                <p class="text-xl opacity-90 max-w-2xl mx-auto">
                    Terima kasih! Appointment Anda telah berhasil dibuat dan dikonfirmasi.
                </p>
            </div>
        </div>
    </section>

    <!-- Booking Details -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <!-- Booking Summary Card -->
                <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold mb-2">Detail Booking Anda</h2>
                        <p class="text-gray-600">Booking ID: <span class="font-semibold text-accent">#PB{{ date('Ymd') }}001</span></p>
                    </div>

                    <div id="booking-details" class="space-y-6">
                        <!-- Details will be populated by JavaScript -->
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-500 mb-1">Nama Pelanggan</label>
                                    <p id="customer-name" class="text-lg font-semibold">-</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-500 mb-1">Nomor Telepon</label>
                                    <p id="customer-phone" class="text-lg">-</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-500 mb-1">Email</label>
                                    <p id="customer-email" class="text-lg">-</p>
                                </div>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-500 mb-1">Layanan</label>
                                    <p id="service-name" class="text-lg font-semibold">-</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-500 mb-1">Barber</label>
                                    <p id="barber-name" class="text-lg">-</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-500 mb-1">Tanggal & Waktu</label>
                                    <p id="appointment-datetime" class="text-lg">-</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-t pt-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-500 mb-1">Catatan</label>
                                <p id="booking-notes" class="text-lg">-</p>
                            </div>
                        </div>

                        <div class="border-t pt-6">
                            <div class="flex justify-between items-center">
                                <span class="text-xl font-semibold">Total Biaya:</span>
                                <span id="total-cost" class="text-2xl font-bold text-accent">-</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-2">
                                Metode Pembayaran: <span id="payment-method" class="font-semibold">-</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 mb-8">
                    <h3 class="text-xl font-bold text-yellow-800 mb-4">Langkah Selanjutnya</h3>
                    <div class="space-y-3 text-yellow-700">
                        <div class="flex items-start">
                            <span class="bg-yellow-200 text-yellow-800 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5">1</span>
                            <p>Kami akan mengirimkan konfirmasi via WhatsApp dalam 5-10 menit</p>
                        </div>
                        <div class="flex items-start">
                            <span class="bg-yellow-200 text-yellow-800 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5">2</span>
                            <p>Harap datang 10 menit sebelum jadwal appointment</p>
                        </div>
                        <div class="flex items-start">
                            <span class="bg-yellow-200 text-yellow-800 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5">3</span>
                            <p>Jika ada perubahan, hubungi kami minimal H-1 sebelum appointment</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="grid md:grid-cols-3 gap-4">
                    <button onclick="window.print()" 
                            class="bg-gray-500 text-white py-3 px-6 rounded-lg font-semibold hover:bg-gray-600 transition-colors">
                        📄 Print Booking
                    </button>
                    <button data-navigate="home" 
                            class="bg-black text-white py-3 px-6 rounded-lg font-semibold hover:bg-gray-800 transition-colors">
                        🏠 Kembali ke Home
                    </button>
                    <button data-navigate="booking" 
                            class="bg-accent text-black py-3 px-6 rounded-lg font-semibold hover:bg-yellow-400 transition-colors">
                        📅 Booking Lagi
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Information -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-bold mb-8">Butuh Bantuan?</h2>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <div class="text-4xl mb-4">📞</div>
                        <h3 class="text-xl font-bold mb-2">Telepon</h3>
                        <p class="text-gray-600">+62 123 456 789</p>
                        <p class="text-sm text-gray-500 mt-2">Senin - Sabtu: 09:00 - 21:00</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <div class="text-4xl mb-4">💬</div>
                        <h3 class="text-xl font-bold mb-2">WhatsApp</h3>
                        <p class="text-gray-600">+62 123 456 789</p>
                        <p class="text-sm text-gray-500 mt-2">Respon cepat 24/7</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <div class="text-4xl mb-4">📧</div>
                        <h3 class="text-xl font-bold mb-2">Email</h3>
                        <p class="text-gray-600">info@panglingbarbershop.com</p>
                        <p class="text-sm text-gray-500 mt-2">Respon dalam 2-4 jam</p>
                    </div>
                </div>

                <div class="mt-12 p-6 bg-white rounded-xl shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Lokasi Barbershop</h3>
                    <p class="text-gray-600 mb-2">Jl. Contoh No. 123, Kota Contoh</p>
                    <p class="text-sm text-gray-500">
                        Dekat dengan Mall ABC, seberang Bank XYZ<br>
                        Parkir gratis tersedia
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load booking data from localStorage
    const bookingData = localStorage.getItem('bookingData');
    
    if (bookingData) {
        const data = JSON.parse(bookingData);
        populateBookingDetails(data);
    }
});

function populateBookingDetails(data) {
    // Service prices mapping
    const servicePrices = {
        'basic-haircut': { name: 'Potong Rambut Basic', price: 35000 },
        'premium-haircut': { name: 'Potong Rambut Premium', price: 55000 },
        'beard-trim': { name: 'Cukur Jenggot', price: 25000 },
        'complete-package': { name: 'Paket Lengkap', price: 75000 },
        'hair-wash': { name: 'Keramas + Creambath', price: 30000 },
        'kids-haircut': { name: 'Potong Rambut Anak', price: 25000 }
    };

    // Barber names mapping
    const barberNames = {
        'ahmad-rizki': 'Ahmad Rizki - Senior Barber',
        'budi-santoso': 'Budi Santoso - Master Barber',
        'dedi-kurniawan': 'Dedi Kurniawan - Professional Barber',
        'eko-prasetyo': 'Eko Prasetyo - Junior Barber',
        'fajar-ramadhan': 'Fajar Ramadhan - Specialist Barber',
        'gilang-pratama': 'Gilang Pratama - Creative Barber'
    };

    // Payment method mapping
    const paymentMethods = {
        'cash': 'Cash (Bayar di tempat)'
    };

    // Populate fields
    document.getElementById('customer-name').textContent = data.name || '-';
    document.getElementById('customer-phone').textContent = data.phone || '-';
    document.getElementById('customer-email').textContent = data.email || '-';
    
    const service = servicePrices[data.service];
    document.getElementById('service-name').textContent = service ? service.name : '-';
    
    document.getElementById('barber-name').textContent = barberNames[data.barber] || '-';
    
    if (data.date && data.time) {
        const dateObj = new Date(data.date);
        const formattedDate = dateObj.toLocaleDateString('id-ID', { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        });
        document.getElementById('appointment-datetime').textContent = `${formattedDate}, ${data.time}`;
    }
    
    document.getElementById('booking-notes').textContent = data.notes || 'Tidak ada catatan khusus';
    
    if (service) {
        document.getElementById('total-cost').textContent = `Rp ${service.price.toLocaleString('id-ID')}`;
    }
    
    document.getElementById('payment-method').textContent = paymentMethods[data.payment_method] || '-';
}
</script>