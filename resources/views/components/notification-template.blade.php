<div class="pt-20 min-h-screen bg-background">
    <!-- Header -->
    <section class="bg-gradient-to-r from-black to-gray-800 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Notifikasi</h1>
                <p class="text-xl opacity-90 max-w-2xl mx-auto">
                    Pantau semua update dan informasi penting tentang appointment Anda
                </p>
            </div>
        </div>
    </section>

    <!-- Notifications -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Filter Tabs -->
                <div class="flex flex-wrap gap-2 mb-8">
                    <button class="notification-filter active bg-accent text-black px-6 py-2 rounded-full font-semibold" data-filter="all">
                        Semua
                    </button>
                    <button class="notification-filter bg-gray-200 text-gray-700 px-6 py-2 rounded-full font-semibold hover:bg-gray-300" data-filter="booking">
                        Booking
                    </button>
                    <button class="notification-filter bg-gray-200 text-gray-700 px-6 py-2 rounded-full font-semibold hover:bg-gray-300" data-filter="reminder">
                        Reminder
                    </button>
                    <button class="notification-filter bg-gray-200 text-gray-700 px-6 py-2 rounded-full font-semibold hover:bg-gray-300" data-filter="promo">
                        Promo
                    </button>
                </div>

                <!-- Notification List -->
                <div class="space-y-4">
                    <!-- Booking Confirmation -->
                    <div class="notification-item bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500" data-type="booking">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-4">
                                <div class="bg-green-100 p-3 rounded-full">
                                    <span class="text-2xl">✅</span>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">Booking Dikonfirmasi</h3>
                                    <p class="text-gray-600 mb-2">
                                        Appointment Anda dengan Ahmad Rizki telah dikonfirmasi untuk hari Senin, 11 Desember 2024 pukul 14:00.
                                    </p>
                                    <p class="text-sm text-gray-500">2 jam yang lalu</p>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600">
                                <span class="text-xl">×</span>
                            </button>
                        </div>
                    </div>

                    <!-- Reminder -->
                    <div class="notification-item bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500" data-type="reminder">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-4">
                                <div class="bg-yellow-100 p-3 rounded-full">
                                    <span class="text-2xl">⏰</span>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">Reminder Appointment</h3>
                                    <p class="text-gray-600 mb-2">
                                        Jangan lupa! Appointment Anda besok pukul 14:00 dengan Ahmad Rizki untuk layanan Potong Rambut Premium.
                                    </p>
                                    <p class="text-sm text-gray-500">1 hari yang lalu</p>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600">
                                <span class="text-xl">×</span>
                            </button>
                        </div>
                    </div>

                    <!-- Promo Notification -->
                    <div class="notification-item bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500" data-type="promo">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-4">
                                <div class="bg-purple-100 p-3 rounded-full">
                                    <span class="text-2xl">🎉</span>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">Promo Spesial Weekend!</h3>
                                    <p class="text-gray-600 mb-2">
                                        Dapatkan diskon 20% untuk semua layanan di akhir pekan. Berlaku hingga Minggu, 15 Desember 2024.
                                    </p>
                                    <p class="text-sm text-gray-500">3 hari yang lalu</p>
                                    <button class="mt-2 bg-purple-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-purple-700">
                                        Gunakan Promo
                                    </button>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600">
                                <span class="text-xl">×</span>
                            </button>
                        </div>
                    </div>

                    <!-- Service Complete -->
                    <div class="notification-item bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500" data-type="booking">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-4">
                                <div class="bg-blue-100 p-3 rounded-full">
                                    <span class="text-2xl">🎯</span>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">Layanan Selesai</h3>
                                    <p class="text-gray-600 mb-2">
                                        Terima kasih telah menggunakan layanan kami! Bagaimana pengalaman Anda? Berikan rating dan review.
                                    </p>
                                    <p class="text-sm text-gray-500">1 minggu yang lalu</p>
                                    <button class="mt-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                                        Berikan Review
                                    </button>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600">
                                <span class="text-xl">×</span>
                            </button>
                        </div>
                    </div>

                    <!-- Birthday Promo -->
                    <div class="notification-item bg-white rounded-xl shadow-lg p-6 border-l-4 border-pink-500" data-type="promo">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-4">
                                <div class="bg-pink-100 p-3 rounded-full">
                                    <span class="text-2xl">🎂</span>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">Selamat Ulang Tahun!</h3>
                                    <p class="text-gray-600 mb-2">
                                        Dapatkan layanan gratis di bulan ulang tahun Anda! Tunjukkan KTP sebagai bukti.
                                    </p>
                                    <p class="text-sm text-gray-500">2 minggu yang lalu</p>
                                    <button class="mt-2 bg-pink-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-pink-700">
                                        Klaim Hadiah
                                    </button>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600">
                                <span class="text-xl">×</span>
                            </button>
                        </div>
                    </div>

                    <!-- System Update -->
                    <div class="notification-item bg-white rounded-xl shadow-lg p-6 border-l-4 border-gray-500" data-type="system">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-4">
                                <div class="bg-gray-100 p-3 rounded-full">
                                    <span class="text-2xl">🔧</span>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">Update Sistem</h3>
                                    <p class="text-gray-600 mb-2">
                                        Sistem booking telah diperbarui dengan fitur baru. Sekarang Anda dapat memilih add-on layanan.
                                    </p>
                                    <p class="text-sm text-gray-500">1 bulan yang lalu</p>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600">
                                <span class="text-xl">×</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div id="empty-notifications" class="text-center py-16 hidden">
                    <div class="text-6xl mb-4">📭</div>
                    <h3 class="text-2xl font-bold text-gray-600 mb-2">Tidak Ada Notifikasi</h3>
                    <p class="text-gray-500">Semua notifikasi sudah Anda baca</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Notification Settings -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-center mb-12">Pengaturan Notifikasi</h2>
                
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold">Notifikasi Booking</h3>
                                <p class="text-gray-600 text-sm">Terima notifikasi tentang konfirmasi dan perubahan booking</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-accent/25 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-accent"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold">Reminder Appointment</h3>
                                <p class="text-gray-600 text-sm">Dapatkan pengingat sebelum jadwal appointment</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-accent/25 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-accent"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold">Promo & Penawaran</h3>
                                <p class="text-gray-600 text-sm">Terima informasi tentang promo dan penawaran khusus</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-accent/25 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-accent"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold">WhatsApp Notifications</h3>
                                <p class="text-gray-600 text-sm">Terima notifikasi melalui WhatsApp</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-accent/25 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-accent"></div>
                            </label>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t">
                        <button class="bg-accent text-black px-6 py-3 rounded-lg font-semibold hover:bg-yellow-400 transition-colors">
                            Simpan Pengaturan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterButtons = document.querySelectorAll('.notification-filter');
    const notificationItems = document.querySelectorAll('.notification-item');
    const emptyState = document.getElementById('empty-notifications');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterButtons.forEach(btn => {
                btn.classList.remove('active', 'bg-accent', 'text-black');
                btn.classList.add('bg-gray-200', 'text-gray-700');
            });
            this.classList.add('active', 'bg-accent', 'text-black');
            this.classList.remove('bg-gray-200', 'text-gray-700');

            // Filter notifications
            let visibleCount = 0;
            notificationItems.forEach(item => {
                const itemType = item.getAttribute('data-type');
                if (filter === 'all' || itemType === filter) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            // Show/hide empty state
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        });
    });

    // Dismiss notifications
    document.querySelectorAll('.notification-item button').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.notification-item').style.display = 'none';
        });
    });
});
</script>