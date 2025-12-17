<div class="pt-20 min-h-screen bg-background">
    <!-- Header -->
    <section class="bg-gradient-to-r from-black to-gray-800 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Booking Appointment</h1>
                <p class="text-xl opacity-90 max-w-2xl mx-auto">
                    Isi form di bawah untuk membuat janji temu dengan barber pilihan Anda
                </p>
            </div>
        </div>
    </section>

    <!-- Booking Form -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <form id="booking-form" class="space-y-6">
                        @csrf
                        
                        <!-- Personal Information -->
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap *</label>
                                <input type="text" name="name" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon *</label>
                                <input type="tel" name="phone" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent">
                        </div>

                        <!-- Service Selection -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Layanan *</label>
                            <select name="service" required 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent">
                                <option value="">-- Pilih Layanan --</option>
                                <option value="basic-haircut">Potong Rambut Basic - Rp 35.000</option>
                                <option value="premium-haircut">Potong Rambut Premium - Rp 55.000</option>
                                <option value="beard-trim">Cukur Jenggot - Rp 25.000</option>
                                <option value="complete-package">Paket Lengkap - Rp 75.000</option>
                                <option value="hair-wash">Keramas + Creambath - Rp 30.000</option>
                                <option value="kids-haircut">Potong Rambut Anak - Rp 25.000</option>
                            </select>
                        </div>

                        <!-- Barber Selection -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Barber *</label>
                            <select name="barber" required 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent">
                                <option value="">-- Pilih Barber --</option>
                                <option value="ahmad-rizki">Ahmad Rizki - Senior Barber (⭐ 4.9)</option>
                                <option value="budi-santoso">Budi Santoso - Master Barber (⭐ 5.0)</option>
                                <option value="dedi-kurniawan">Dedi Kurniawan - Professional Barber (⭐ 4.8)</option>
                                <option value="eko-prasetyo">Eko Prasetyo - Junior Barber (⭐ 4.7)</option>
                                <option value="fajar-ramadhan">Fajar Ramadhan - Specialist Barber (⭐ 4.9)</option>
                                <option value="gilang-pratama">Gilang Pratama - Creative Barber (⭐ 4.6)</option>
                            </select>
                        </div>

                        <!-- Date and Time -->
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal *</label>
                                <input type="date" name="date" required 
                                       min="{{ date('Y-m-d') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Waktu *</label>
                                <select name="time" required 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent">
                                    <option value="">-- Pilih Waktu --</option>
                                    <option value="09:00">09:00</option>
                                    <option value="09:30">09:30</option>
                                    <option value="10:00">10:00</option>
                                    <option value="10:30">10:30</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:30">11:30</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:30">12:30</option>
                                    <option value="13:00">13:00</option>
                                    <option value="13:30">13:30</option>
                                    <option value="14:00">14:00</option>
                                    <option value="14:30">14:30</option>
                                    <option value="15:00">15:00</option>
                                    <option value="15:30">15:30</option>
                                    <option value="16:00">16:00</option>
                                    <option value="16:30">16:30</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:30">17:30</option>
                                    <option value="18:00">18:00</option>
                                    <option value="18:30">18:30</option>
                                    <option value="19:00">19:00</option>
                                    <option value="19:30">19:30</option>
                                    <option value="20:00">20:00</option>
                                </select>
                            </div>
                        </div>

                        <!-- Additional Notes -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan Tambahan</label>
                            <textarea name="notes" rows="4" 
                                      placeholder="Tuliskan permintaan khusus atau gaya rambut yang diinginkan..."
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent"></textarea>
                        </div>

                        <!-- Payment Method -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Metode Pembayaran *</label>
                            <div class="grid md:grid-cols-2 gap-4">
                                <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="payment_method" value="cash" required class="mr-3">
                                    <div>
                                        <div class="font-semibold">Cash</div>
                                        <div class="text-sm text-gray-600">Bayar di tempat</div>
                                    </div>
                                </label>
                                <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="payment_method" value="ewallet" required class="mr-3">
                                    <div>
                                        <div class="font-semibold">Cash</div>
                                        <div class="text-sm text-gray-600">Bayar di tempat</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="flex items-start">
                            <input type="checkbox" name="terms" required class="mt-1 mr-3">
                            <label class="text-sm text-gray-600">
                                Saya setuju dengan <a href="#" class="text-accent hover:underline">syarat dan ketentuan</a> 
                                yang berlaku dan kebijakan pembatalan booking.
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex space-x-4">
                            <button type="button" data-navigate="barbers" 
                                    class="flex-1 bg-gray-500 text-white py-4 rounded-lg font-semibold hover:bg-gray-600 transition-colors">
                                Kembali
                            </button>
                            <button type="submit" 
                                    class="flex-1 bg-accent text-black py-4 rounded-lg font-semibold hover:bg-yellow-400 transition-colors">
                                Konfirmasi Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Info -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-center mb-12">Informasi Penting</h2>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <div class="text-center mb-4">
                            <div class="bg-accent w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl">⏰</span>
                            </div>
                            <h3 class="text-xl font-bold">Kebijakan Waktu</h3>
                        </div>
                        <ul class="text-sm text-gray-600 space-y-2">
                            <li>• Harap datang 10 menit sebelum jadwal</li>
                            <li>• Toleransi keterlambatan maksimal 15 menit</li>
                            <li>• Booking dapat dibatalkan H-1</li>
                        </ul>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <div class="text-center mb-4">
                            <div class="bg-accent w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl">💳</span>
                            </div>
                            <h3 class="text-xl font-bold">Pembayaran</h3>
                        </div>
                        <ul class="text-sm text-gray-600 space-y-2">
                            <li>• Pembayaran dapat dilakukan di tempat</li>
                            <li>• Terima cash dan e-wallet</li>
                            <li>• Tidak ada biaya tambahan</li>
                        </ul>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <div class="text-center mb-4">
                            <div class="bg-accent w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl">📞</span>
                            </div>
                            <h3 class="text-xl font-bold">Kontak</h3>
                        </div>
                        <ul class="text-sm text-gray-600 space-y-2">
                            <li>• WhatsApp: +62 123 456 789</li>
                            <li>• Telepon: +62 123 456 789</li>
                            <li>• Email: info@panglingbarbershop.com</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('booking-form');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simulate form submission
            const formData = new FormData(form);
            const data = Object.fromEntries(formData);
            
            // Store booking data in localStorage for confirmation page
            localStorage.setItem('bookingData', JSON.stringify(data));
            
            // Navigate to confirmation page
            // Use simple navigation approach
            document.querySelectorAll('[data-page]').forEach(el => el.style.display = 'none');
            const confirmationPage = document.querySelector('[data-page="confirmation"]');
            if (confirmationPage) {
                confirmationPage.style.display = 'block';
            }
        });
    }
});
</script>