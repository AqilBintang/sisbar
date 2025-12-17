<div class="min-h-screen bg-gray-100">
    <!-- Admin Header -->
    <header class="bg-black shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-accent">Admin Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-white">Admin User</span>
                    <button data-navigate="home" class="bg-accent text-black px-4 py-2 rounded-lg hover:bg-yellow-400 transition-colors">
                        Kembali ke Website
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Dashboard Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-3 rounded-full">
                        <span class="text-2xl">📅</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Booking Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-900">12</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="bg-green-100 p-3 rounded-full">
                        <span class="text-2xl">💰</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Pendapatan Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-900">Rp 650K</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <span class="text-2xl">👥</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Pelanggan Baru</p>
                        <p class="text-2xl font-bold text-gray-900">5</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="bg-purple-100 p-3 rounded-full">
                        <span class="text-2xl">⭐</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Rating Rata-rata</p>
                        <p class="text-2xl font-bold text-gray-900">4.8</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Booking List -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-bold">Booking Hari Ini</h2>
                            <button class="bg-accent text-black px-4 py-2 rounded-lg hover:bg-yellow-400 transition-colors">
                                Tambah Booking
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <!-- Booking Item -->
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                <div class="flex items-center space-x-4">
                                    <div class="bg-green-100 p-2 rounded-full">
                                        <span class="text-green-600 font-bold">09:00</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Ahmad Rizki</p>
                                        <p class="text-sm text-gray-600">Potong Rambut Premium - Budi Santoso</p>
                                        <p class="text-sm text-gray-500">+62 812 3456 7890</p>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600">
                                        Selesai
                                    </button>
                                    <button class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                                        Batal
                                    </button>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                <div class="flex items-center space-x-4">
                                    <div class="bg-yellow-100 p-2 rounded-full">
                                        <span class="text-yellow-600 font-bold">10:30</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Dedi Kurniawan</p>
                                        <p class="text-sm text-gray-600">Cukur Jenggot - Ahmad Rizki</p>
                                        <p class="text-sm text-gray-500">+62 813 4567 8901</p>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                                        Mulai
                                    </button>
                                    <button class="bg-gray-500 text-white px-3 py-1 rounded text-sm hover:bg-gray-600">
                                        Edit
                                    </button>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                <div class="flex items-center space-x-4">
                                    <div class="bg-blue-100 p-2 rounded-full">
                                        <span class="text-blue-600 font-bold">14:00</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Eko Prasetyo</p>
                                        <p class="text-sm text-gray-600">Paket Lengkap - Fajar Ramadhan</p>
                                        <p class="text-sm text-gray-500">+62 814 5678 9012</p>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <span class="bg-gray-200 text-gray-600 px-3 py-1 rounded text-sm">
                                        Menunggu
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <button class="w-full bg-accent text-black py-2 px-4 rounded-lg hover:bg-yellow-400 transition-colors">
                            📅 Tambah Booking
                        </button>
                        <button class="w-full bg-gray-200 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-300 transition-colors">
                            👥 Kelola Pelanggan
                        </button>
                        <button class="w-full bg-gray-200 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-300 transition-colors">
                            💰 Laporan Keuangan
                        </button>
                        <button class="w-full bg-gray-200 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-300 transition-colors">
                            ⚙️ Pengaturan
                        </button>
                    </div>
                </div>

                <!-- Barber Status -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold mb-4">Status Barber</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm">Ahmad Rizki</span>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Aktif</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm">Budi Santoso</span>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Aktif</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm">Dedi Kurniawan</span>
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Istirahat</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm">Eko Prasetyo</span>
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Tidak Aktif</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Reviews -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold mb-4">Review Terbaru</h3>
                    <div class="space-y-4">
                        <div class="border-b border-gray-200 pb-3">
                            <div class="flex items-center mb-2">
                                <span class="text-yellow-400">⭐⭐⭐⭐⭐</span>
                                <span class="text-sm text-gray-600 ml-2">5.0</span>
                            </div>
                            <p class="text-sm text-gray-700">"Pelayanan sangat memuaskan!"</p>
                            <p class="text-xs text-gray-500 mt-1">- Ahmad S.</p>
                        </div>
                        <div class="border-b border-gray-200 pb-3">
                            <div class="flex items-center mb-2">
                                <span class="text-yellow-400">⭐⭐⭐⭐⭐</span>
                                <span class="text-sm text-gray-600 ml-2">4.8</span>
                            </div>
                            <p class="text-sm text-gray-700">"Barber profesional dan ramah"</p>
                            <p class="text-xs text-gray-500 mt-1">- Budi R.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
            <!-- Revenue Chart -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-bold mb-4">Pendapatan Mingguan</h3>
                <div class="h-64 flex items-end justify-between space-x-2">
                    <div class="bg-accent w-full h-32 rounded-t flex items-end justify-center pb-2">
                        <span class="text-xs text-black font-semibold">Sen</span>
                    </div>
                    <div class="bg-accent w-full h-48 rounded-t flex items-end justify-center pb-2">
                        <span class="text-xs text-black font-semibold">Sel</span>
                    </div>
                    <div class="bg-accent w-full h-40 rounded-t flex items-end justify-center pb-2">
                        <span class="text-xs text-black font-semibold">Rab</span>
                    </div>
                    <div class="bg-accent w-full h-56 rounded-t flex items-end justify-center pb-2">
                        <span class="text-xs text-black font-semibold">Kam</span>
                    </div>
                    <div class="bg-accent w-full h-44 rounded-t flex items-end justify-center pb-2">
                        <span class="text-xs text-black font-semibold">Jum</span>
                    </div>
                    <div class="bg-accent w-full h-60 rounded-t flex items-end justify-center pb-2">
                        <span class="text-xs text-black font-semibold">Sab</span>
                    </div>
                    <div class="bg-accent w-full h-52 rounded-t flex items-end justify-center pb-2">
                        <span class="text-xs text-black font-semibold">Min</span>
                    </div>
                </div>
            </div>

            <!-- Service Popularity -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-bold mb-4">Layanan Terpopuler</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm">Potong Rambut Premium</span>
                        <div class="flex items-center space-x-2">
                            <div class="w-24 bg-gray-200 rounded-full h-2">
                                <div class="bg-accent h-2 rounded-full" style="width: 85%"></div>
                            </div>
                            <span class="text-xs text-gray-600">85%</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm">Paket Lengkap</span>
                        <div class="flex items-center space-x-2">
                            <div class="w-24 bg-gray-200 rounded-full h-2">
                                <div class="bg-accent h-2 rounded-full" style="width: 70%"></div>
                            </div>
                            <span class="text-xs text-gray-600">70%</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm">Potong Rambut Basic</span>
                        <div class="flex items-center space-x-2">
                            <div class="w-24 bg-gray-200 rounded-full h-2">
                                <div class="bg-accent h-2 rounded-full" style="width: 60%"></div>
                            </div>
                            <span class="text-xs text-gray-600">60%</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm">Cukur Jenggot</span>
                        <div class="flex items-center space-x-2">
                            <div class="w-24 bg-gray-200 rounded-full h-2">
                                <div class="bg-accent h-2 rounded-full" style="width: 45%"></div>
                            </div>
                            <span class="text-xs text-gray-600">45%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>