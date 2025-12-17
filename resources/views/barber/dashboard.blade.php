@extends('layouts.barber')

@section('title', 'Dashboard Kapster')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Dashboard Kapster</h1>
        <p class="text-gray-600">Selamat datang, {{ $barberUser->name }}!</p>
        <p class="text-sm text-gray-500">Kapster: {{ $barberUser->barber->name }} ({{ $barberUser->barber->level_display }})</p>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-blue-500 rounded-lg shadow p-6 text-white">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold">Booking Hari Ini</h3>
                    <p class="text-3xl font-bold">{{ $stats['today_total'] }}</p>
                </div>
                <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v16a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>

        <div class="bg-yellow-500 rounded-lg shadow p-6 text-white">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold">Menunggu Konfirmasi</h3>
                    <p class="text-3xl font-bold">{{ $stats['today_pending'] }}</p>
                </div>
                <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>

        <div class="bg-green-500 rounded-lg shadow p-6 text-white">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold">Dikonfirmasi</h3>
                    <p class="text-3xl font-bold">{{ $stats['today_confirmed'] }}</p>
                </div>
                <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>

        <div class="bg-purple-500 rounded-lg shadow p-6 text-white">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold">Selesai</h3>
                    <p class="text-3xl font-bold">{{ $stats['today_completed'] }}</p>
                </div>
                <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Today's Bookings -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Booking Hari Ini</h2>
            <p class="text-gray-600">{{ now()->format('d F Y') }}</p>
        </div>
        
        <div class="p-6">
            @if($todayBookings->count() > 0)
                <div class="space-y-4">
                    @foreach($todayBookings as $booking)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-4 mb-2">
                                        <span class="text-lg font-semibold text-gray-800">{{ $booking->formatted_time }}</span>
                                        <span class="px-3 py-1 rounded-full text-xs font-medium
                                            @if($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($booking->status === 'confirmed') bg-blue-100 text-blue-800
                                            @elseif($booking->status === 'completed') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ $booking->status_display }}
                                        </span>
                                    </div>
                                    <h3 class="font-semibold text-gray-800">{{ $booking->customer_name }}</h3>
                                    <p class="text-gray-600">{{ $booking->service->name }} ({{ $booking->service->duration }} menit)</p>
                                    <p class="text-sm text-gray-500">{{ $booking->customer_phone }}</p>
                                    @if($booking->notes)
                                        <p class="text-sm text-gray-500 mt-1"><strong>Catatan:</strong> {{ $booking->notes }}</p>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-gray-800">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                    <div class="mt-2 space-x-2">
                                        @if($booking->status === 'pending')
                                            <button onclick="updateBookingStatus({{ $booking->id }}, 'confirmed')" 
                                                    class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-xs rounded transition-colors">
                                                Konfirmasi
                                            </button>
                                        @endif
                                        @if($booking->status === 'confirmed')
                                            <button onclick="updateBookingStatus({{ $booking->id }}, 'completed')" 
                                                    class="px-3 py-1 bg-green-500 hover:bg-green-600 text-white text-xs rounded transition-colors">
                                                Selesai
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v16a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-gray-500">Tidak ada booking hari ini</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Notifications -->
    @if($recentNotifications->count() > 0)
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800">Notifikasi Terbaru</h2>
                    @if($stats['unread_notifications'] > 0)
                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            {{ $stats['unread_notifications'] }} baru
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="p-6">
                <div class="space-y-4">
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
            </div>
        </div>
    @endif

    <!-- Upcoming Bookings -->
    @if($upcomingBookings->count() > 0)
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">Booking Mendatang</h2>
                <p class="text-gray-600">7 hari ke depan</p>
            </div>
            
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($upcomingBookings as $booking)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-4 mb-2">
                                        <span class="text-lg font-semibold text-gray-800">{{ $booking->formatted_date }}</span>
                                        <span class="text-lg font-semibold text-gray-800">{{ $booking->formatted_time }}</span>
                                        <span class="px-3 py-1 rounded-full text-xs font-medium
                                            @if($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($booking->status === 'confirmed') bg-blue-100 text-blue-800
                                            @elseif($booking->status === 'completed') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ $booking->status_display }}
                                        </span>
                                    </div>
                                    <h3 class="font-semibold text-gray-800">{{ $booking->customer_name }}</h3>
                                    <p class="text-gray-600">{{ $booking->service->name }} ({{ $booking->service->duration }} menit)</p>
                                    <p class="text-sm text-gray-500">{{ $booking->customer_phone }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-gray-800">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
async function updateBookingStatus(bookingId, status) {
    try {
        const response = await fetch(`/barber/bookings/${bookingId}/status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status: status })
        });

        const data = await response.json();
        
        if (data.success) {
            location.reload();
        } else {
            alert('Gagal mengupdate status booking');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengupdate status');
    }
}
</script>
@endpush
@endsection