@extends('layouts.admin')

@section('title', 'Kelola Booking')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Kelola Booking</h1>
        <p class="text-gray-600">Kelola semua booking dari pelanggan</p>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
        <div class="bg-blue-500 rounded-lg shadow p-4 text-white text-center">
            <div class="text-2xl font-bold">{{ $stats['total'] }}</div>
            <div class="text-sm opacity-90">Total Booking</div>
        </div>
        <div class="bg-yellow-500 rounded-lg shadow p-4 text-white text-center">
            <div class="text-2xl font-bold">{{ $stats['pending'] }}</div>
            <div class="text-sm opacity-90">Menunggu</div>
        </div>
        <div class="bg-green-500 rounded-lg shadow p-4 text-white text-center">
            <div class="text-2xl font-bold">{{ $stats['completed'] }}</div>
            <div class="text-sm opacity-90">Selesai</div>
        </div>
        <div class="bg-gray-600 rounded-lg shadow p-4 text-white text-center">
            <div class="text-2xl font-bold">{{ $stats['today'] }}</div>
            <div class="text-sm opacity-90">Hari Ini</div>
        </div>
    </div>
    
    <!-- Payment Statistics -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <div class="bg-orange-500 rounded-lg shadow p-4 text-white text-center">
            <div class="text-2xl font-bold">{{ $stats['payment_pending'] }}</div>
            <div class="text-sm opacity-90">Belum Bayar</div>
        </div>
        <div class="bg-emerald-500 rounded-lg shadow p-4 text-white text-center">
            <div class="text-2xl font-bold">{{ $stats['payment_paid'] }}</div>
            <div class="text-sm opacity-90">Sudah Bayar</div>
        </div>
        <div class="bg-red-600 rounded-lg shadow p-4 text-white text-center">
            <div class="text-2xl font-bold">{{ $stats['payment_failed'] }}</div>
            <div class="text-sm opacity-90">Gagal Bayar</div>
        </div>
    </div>

    <!-- Filter -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Filter Booking</h2>
        <form method="GET" action="{{ route('admin.bookings') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="date_from" class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>
            
            <div>
                <label for="date_to" class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>
            
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status Booking</label>
                <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    <option value="all">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
            
            <div>
                <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-2">Status Payment</label>
                <select id="payment_status" name="payment_status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    <option value="all">Semua Payment</option>
                    <option value="pending" {{ request('payment_status') === 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                    <option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }}>Sudah Dibayar</option>
                    <option value="failed" {{ request('payment_status') === 'failed' ? 'selected' : '' }}>Gagal</option>
                    <option value="challenge" {{ request('payment_status') === 'challenge' ? 'selected' : '' }}>Perlu Verifikasi</option>
                </select>
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-md font-semibold transition-colors">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Bookings Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Daftar Booking</h2>
            <p class="text-gray-600">Total: {{ $bookings->total() }} booking</p>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal & Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kapster</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Layanan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Booking</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Payment</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                #{{ $booking->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $booking->formatted_date }}</div>
                                <div class="text-sm text-gray-500">{{ $booking->formatted_time }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $booking->customer_name }}</div>
                                <div class="text-sm text-gray-500">{{ $booking->customer_phone }}</div>
                                @if($booking->customer_email)
                                    <div class="text-sm text-gray-500">{{ $booking->customer_email }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($booking->barber->photo)
                                        <img src="{{ asset('image/' . $booking->barber->photo) }}" alt="{{ $booking->barber->name }}" class="w-8 h-8 rounded-full object-cover mr-2" 
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <!-- Fallback when image fails to load -->
                                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-2" style="display: none;">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $booking->barber->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $booking->barber->level_display }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $booking->service->name }}</div>
                                <div class="text-sm text-gray-500">{{ $booking->service->duration }} menit</div>
                                @if($booking->notes)
                                    <div class="text-sm text-gray-500 mt-1">
                                        <strong>Catatan:</strong> {{ Str::limit($booking->notes, 30) }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
                                <div class="text-sm text-gray-500">{{ $booking->payment_method_display }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($booking->status === 'confirmed') bg-blue-100 text-blue-800
                                    @elseif($booking->status === 'completed') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ $booking->status_display }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($booking->payment_status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($booking->payment_status === 'paid') bg-green-100 text-green-800
                                    @elseif($booking->payment_status === 'failed') bg-red-100 text-red-800
                                    @elseif($booking->payment_status === 'challenge') bg-orange-100 text-orange-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $booking->payment_status_display }}
                                </span>
                                @if($booking->payment_method === 'online' && $booking->midtrans_order_id)
                                    <div class="text-xs text-gray-500 mt-1">
                                        Order: {{ Str::limit($booking->midtrans_order_id, 15) }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex flex-col space-y-1">
                                    @if($booking->status === 'pending')
                                        <button onclick="updateBookingStatus({{ $booking->id }}, 'confirmed')" 
                                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs transition-colors">
                                            Konfirmasi
                                        </button>
                                        <button onclick="updateBookingStatus({{ $booking->id }}, 'cancelled')" 
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition-colors">
                                            Tolak
                                        </button>
                                    @elseif($booking->status === 'confirmed')
                                        <button onclick="updateBookingStatus({{ $booking->id }}, 'completed')" 
                                                class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs transition-colors">
                                            Selesai
                                        </button>
                                        <button onclick="updateBookingStatus({{ $booking->id }}, 'cancelled')" 
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition-colors">
                                            Batal
                                        </button>
                                    @endif
                                    
                                    <a href="{{ route('admin.bookings.receipt', $booking->id) }}" target="_blank"
                                       class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded text-xs transition-colors text-center">
                                        Struk
                                    </a>
                                    
                                    <button onclick="deleteBooking({{ $booking->id }})" 
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs transition-colors">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                                <div class="py-8">
                                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v16a2 2 0 002 2z"></path>
                                    </svg>
                                    <p>Tidak ada booking ditemukan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($bookings->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $bookings->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

<script>
async function updateBookingStatus(bookingId, status) {
    const statusText = {
        'confirmed': 'konfirmasi',
        'completed': 'menyelesaikan',
        'cancelled': 'membatalkan'
    };
    
    if (confirm(`Apakah Anda yakin ingin ${statusText[status]} booking ini?`)) {
        try {
            const response = await fetch(`/admin/bookings/${bookingId}/status`, {
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
}

async function deleteBooking(bookingId) {
    if (confirm('Apakah Anda yakin ingin menghapus booking ini? Tindakan ini tidak dapat dibatalkan.')) {
        try {
            const response = await fetch(`/admin/bookings/${bookingId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const data = await response.json();
            
            if (data.success) {
                location.reload();
            } else {
                alert('Gagal menghapus booking');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus booking');
        }
    }
}
</script>
@endsection