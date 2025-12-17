@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stats Cards -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-400 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Layanan</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $stats['total_services'] }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-400 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Kapster</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $stats['total_barbers'] }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-400 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Booking Hari Ini</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $stats['today_bookings'] }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-400 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Booking</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $stats['total_bookings'] }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Aksi Cepat</h3>
            <div class="space-y-3">
                <a href="{{ route('admin.services') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-500 hover:bg-yellow-600 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Layanan
                </a>
                <a href="{{ route('admin.barbers') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-500 hover:bg-yellow-600 transition-colors ml-3">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Kapster
                </a>
                <a href="{{ route('admin.bookings') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 transition-colors ml-3">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Kelola Booking
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Notifikasi Terbaru</h3>
                @if($stats['unread_notifications'] > 0)
                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        {{ $stats['unread_notifications'] }} baru
                    </span>
                @endif
            </div>
            
            @if($recentNotifications->count() > 0)
                <div class="space-y-3 max-h-64 overflow-y-auto">
                    @foreach($recentNotifications as $notification)
                        <div class="flex items-start space-x-3 p-3 {{ $notification->is_read ? 'bg-gray-50' : 'bg-blue-50' }} rounded-lg">
                            <div class="flex-shrink-0">
                                @if($notification->type === 'new_booking')
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                @else
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">{{ $notification->title }}</p>
                                <p class="text-sm text-gray-500">{{ $notification->message }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                            @if(!$notification->is_read)
                                <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                            @endif
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-4 text-center">
                    <a href="{{ route('admin.bookings') }}" class="text-sm text-blue-600 hover:text-blue-800">
                        Lihat semua booking →
                    </a>
                </div>
            @else
                <p class="text-gray-500 text-sm">Belum ada notifikasi</p>
            @endif
            <div class="space-y-3 text-sm text-gray-600">
                @php
                    $recentBookings = \App\Models\Booking::with(['service', 'barber'])
                        ->orderBy('created_at', 'desc')
                        ->limit(3)
                        ->get();
                @endphp
                
                @forelse($recentBookings as $booking)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-green-400 rounded-full mr-3"></div>
                            <span>Booking baru dari {{ $booking->customer_name }}</span>
                        </div>
                        <span class="text-xs text-gray-400">{{ $booking->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-gray-400 rounded-full mr-3"></div>
                        <span>Belum ada booking terbaru</span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Business Management Info -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Revenue Card -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-700">💰 Pendapatan Hari Ini</h3>
                @php
                    $dashboardService = app(\App\Services\DashboardService::class);
                    $stats = $dashboardService->getDashboardStats();
                @endphp
                <p class="text-3xl font-bold text-green-600">Rp {{ number_format($stats['today']->revenue ?? 0, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500">{{ $stats['today']->count ?? 0 }} transaksi</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Bookings Card -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-700">📅 Booking Bulan Ini</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $stats['monthly']->total_bookings ?? 0 }}</p>
                <p class="text-sm text-gray-500">Rp {{ number_format($stats['monthly']->revenue ?? 0, 0, ',', '.') }} total</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Staff Card -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-700">👥 Tim Kapster</h3>
                @php
                    $activeBarbers = \App\Models\Barber::where('is_active', true)->count();
                    $totalBarbers = \App\Models\Barber::count();
                @endphp
                <p class="text-3xl font-bold text-purple-600">{{ $activeBarbers }}</p>
                <p class="text-sm text-gray-500">dari {{ $totalBarbers }} total kapster</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Revenue Chart -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-700">📈 Grafik Pendapatan</h3>
            <select id="revenueFilter" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                <option value="7">7 Hari Terakhir</option>
                <option value="14">14 Hari Terakhir</option>
                <option value="30">30 Hari Terakhir</option>
                <option value="90">3 Bulan Terakhir</option>
            </select>
        </div>
        <canvas id="revenueChart" width="400" height="200"></canvas>
        <div class="mt-4 text-center">
            <div class="inline-flex items-center space-x-4 text-sm text-gray-600">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                    <span>Total: <span id="totalRevenue">Rp 0</span></span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                    <span>Rata-rata: <span id="avgRevenue">Rp 0</span></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Service Popularity Chart -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-700">🎯 Layanan Populer</h3>
            <select id="serviceFilter" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                <option value="7">7 Hari Terakhir</option>
                <option value="30">30 Hari Terakhir</option>
                <option value="90">3 Bulan Terakhir</option>
                <option value="all">Semua Waktu</option>
            </select>
        </div>
        <canvas id="serviceChart" width="400" height="200"></canvas>
        <div class="mt-4">
            <div id="serviceStats" class="text-sm text-gray-600 text-center">
                <span>Total Booking: <span id="totalBookings">0</span></span>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Stats -->
<div class="bg-white rounded-lg shadow-lg p-6">
    <h3 class="text-lg font-semibold text-gray-700 mb-4">📊 Statistik Bisnis Lengkap</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="text-center">
            <div class="text-2xl font-bold text-gray-800">
                {{ \App\Models\Booking::where('status', 'completed')->count() }}
            </div>
            <div class="text-sm text-gray-600">Total Layanan Selesai</div>
        </div>
        <div class="text-center">
            <div class="text-2xl font-bold text-gray-800">
                {{ \App\Models\Booking::where('status', 'pending')->count() }}
            </div>
            <div class="text-sm text-gray-600">Booking Menunggu</div>
        </div>
        <div class="text-center">
            <div class="text-2xl font-bold text-gray-800">
                {{ \App\Models\Service::where('is_active', true)->count() }}
            </div>
            <div class="text-sm text-gray-600">Layanan Aktif</div>
        </div>
        <div class="text-center">
            <div class="text-2xl font-bold text-gray-800">
                Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
            </div>
            <div class="text-sm text-gray-600">Total Pendapatan</div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let revenueChart, serviceChart;
    
    // Initialize Charts
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const serviceCtx = document.getElementById('serviceChart').getContext('2d');
    
    // Revenue Chart Filter Handler
    document.getElementById('revenueFilter').addEventListener('change', function() {
        updateRevenueChart(this.value);
    });
    
    // Service Chart Filter Handler
    document.getElementById('serviceFilter').addEventListener('change', function() {
        updateServiceChart(this.value);
    });
    
    // Update Revenue Chart
    async function updateRevenueChart(days) {
        try {
            const response = await fetch(`/admin/chart-data/revenue?days=${days}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            const data = await response.json();
            
            if (revenueChart) {
                revenueChart.destroy();
            }
            
            revenueChart = new Chart(revenueCtx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: data.revenue,
                        borderColor: 'rgb(34, 197, 94)',
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
            
            // Update stats
            document.getElementById('totalRevenue').textContent = 'Rp ' + data.total.toLocaleString('id-ID');
            document.getElementById('avgRevenue').textContent = 'Rp ' + Math.round(data.average).toLocaleString('id-ID');
            
        } catch (error) {
            console.error('Error updating revenue chart:', error);
        }
    }
    
    // Update Service Chart
    async function updateServiceChart(days) {
        try {
            const response = await fetch(`/admin/chart-data/services?days=${days}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            const data = await response.json();
            
            if (serviceChart) {
                serviceChart.destroy();
            }
            
            serviceChart = new Chart(serviceCtx, {
                type: 'doughnut',
                data: {
                    labels: data.labels,
                    datasets: [{
                        data: data.counts,
                        backgroundColor: [
                            'rgb(59, 130, 246)',
                            'rgb(16, 185, 129)',
                            'rgb(245, 158, 11)',
                            'rgb(239, 68, 68)',
                            'rgb(139, 92, 246)',
                            'rgb(236, 72, 153)',
                            'rgb(14, 165, 233)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
            
            // Update stats
            document.getElementById('totalBookings').textContent = data.total;
            
        } catch (error) {
            console.error('Error updating service chart:', error);
        }
    }
    
    // Initialize with default data
    updateRevenueChart(7);
    updateServiceChart(7);
});
</script>
@endsection