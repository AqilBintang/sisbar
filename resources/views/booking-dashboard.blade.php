@extends('layouts.app')

@section('title', 'Dashboard Booking - Sisbar Hairstudio')

@section('content')
<div class="min-h-screen bg-black pt-20">
    <!-- Background Image with Dark Overlay -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/bg-barber.jpg') }}');">
        <div class="absolute inset-0 bg-black/80"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-white mb-4">Dashboard Booking</h1>
            <p class="text-gray-300 text-lg">Lihat semua jadwal booking yang tersedia</p>
            <div class="flex justify-center mt-6">
                <div class="w-32 h-1 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-full"></div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
            <div class="bg-slate-800 rounded-xl p-4 text-center">
                <div class="text-2xl font-bold text-white">{{ $stats['total'] }}</div>
                <div class="text-gray-300 text-sm">Total</div>
            </div>
            <div class="bg-yellow-500/20 border border-yellow-500/30 rounded-xl p-4 text-center">
                <div class="text-2xl font-bold text-yellow-400">{{ $stats['pending'] }}</div>
                <div class="text-gray-300 text-sm">Pending</div>
            </div>
            <div class="bg-blue-500/20 border border-blue-500/30 rounded-xl p-4 text-center">
                <div class="text-2xl font-bold text-blue-400">{{ $stats['confirmed'] }}</div>
                <div class="text-gray-300 text-sm">Konfirmasi</div>
            </div>
            <div class="bg-green-500/20 border border-green-500/30 rounded-xl p-4 text-center">
                <div class="text-2xl font-bold text-green-400">{{ $stats['completed'] }}</div>
                <div class="text-gray-300 text-sm">Selesai</div>
            </div>
            <div class="bg-red-500/20 border border-red-500/30 rounded-xl p-4 text-center">
                <div class="text-2xl font-bold text-red-400">{{ $stats['cancelled'] }}</div>
                <div class="text-gray-300 text-sm">Batal</div>
            </div>
        </div>

        <!-- Filter -->
        <div class="bg-slate-800 rounded-2xl p-6 mb-8">
            <h2 class="text-xl font-bold text-white mb-4">Filter Booking</h2>
            <form method="GET" action="{{ route('booking.dashboard') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div>
                    <label for="date_from" class="block text-sm font-medium text-gray-300 mb-2">Dari Tanggal</label>
                    <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}"
                           class="w-full px-3 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
                </div>
                
                <div>
                    <label for="date_to" class="block text-sm font-medium text-gray-300 mb-2">Sampai Tanggal</label>
                    <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}"
                           class="w-full px-3 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
                </div>
                
                <div>
                    <label for="barber_id" class="block text-sm font-medium text-gray-300 mb-2">Kapster</label>
                    <select id="barber_id" name="barber_id" class="w-full px-3 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
                        <option value="all">Semua Kapster</option>
                        @foreach($barbers as $barber)
                            <option value="{{ $barber->id }}" {{ request('barber_id') == $barber->id ? 'selected' : '' }}>
                                {{ $barber->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-300 mb-2">Status</label>
                    <select id="status" name="status" class="w-full px-3 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
                        <option value="all">Semua Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-lg font-semibold transition-colors">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Calendar View -->
        <div class="bg-slate-800 rounded-2xl p-6 mb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-white">Kalender Booking - {{ $calendarData['month_name'] }}</h2>
                <div class="flex space-x-2">
                    <form method="GET" action="{{ route('booking.dashboard') }}" class="flex space-x-2">
                        <select name="month" class="px-3 py-1 bg-slate-700 border border-slate-600 rounded text-white text-sm">
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $calendarData['month'] == $i ? 'selected' : '' }}>
                                    {{ Carbon\Carbon::create()->month($i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                        <select name="year" class="px-3 py-1 bg-slate-700 border border-slate-600 rounded text-white text-sm">
                            @for($y = 2024; $y <= 2026; $y++)
                                <option value="{{ $y }}" {{ $calendarData['year'] == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                        <button type="submit" class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-black rounded text-sm font-semibold">Go</button>
                    </form>
                </div>
            </div>
            
            <div class="grid grid-cols-7 gap-2">
                <!-- Header Days -->
                <div class="text-center text-gray-400 font-semibold py-2">Min</div>
                <div class="text-center text-gray-400 font-semibold py-2">Sen</div>
                <div class="text-center text-gray-400 font-semibold py-2">Sel</div>
                <div class="text-center text-gray-400 font-semibold py-2">Rab</div>
                <div class="text-center text-gray-400 font-semibold py-2">Kam</div>
                <div class="text-center text-gray-400 font-semibold py-2">Jum</div>
                <div class="text-center text-gray-400 font-semibold py-2">Sab</div>
                
                <!-- Empty cells for days before month starts -->
                @for($i = 0; $i < $calendarData['start_date']->dayOfWeek; $i++)
                    <div class="h-20 bg-slate-700 rounded-lg"></div>
                @endfor
                
                <!-- Calendar Days -->
                @foreach($calendarData['calendar'] as $dateKey => $dayData)
                    <div class="h-20 bg-slate-700 hover:bg-slate-600 rounded-lg p-2 cursor-pointer transition-colors {{ $dayData['date']->isToday() ? 'ring-2 ring-yellow-400' : '' }}"
                         onclick="showBookingsForDate('{{ $dateKey }}', '{{ $dayData['date']->format('d F Y') }}')">
                        <div class="text-white font-semibold text-sm">{{ $dayData['day'] }}</div>
                        @if($dayData['total'] > 0)
                            <div class="mt-1">
                                <div class="text-xs text-yellow-400">{{ $dayData['total'] }} booking</div>
                                <div class="flex space-x-1 mt-1">
                                    @if($dayData['pending'] > 0)
                                        <div class="w-2 h-2 bg-yellow-400 rounded-full" title="{{ $dayData['pending'] }} pending"></div>
                                    @endif
                                    @if($dayData['confirmed'] > 0)
                                        <div class="w-2 h-2 bg-blue-400 rounded-full" title="{{ $dayData['confirmed'] }} confirmed"></div>
                                    @endif
                                    @if($dayData['completed'] > 0)
                                        <div class="w-2 h-2 bg-green-400 rounded-full" title="{{ $dayData['completed'] }} completed"></div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Bookings List -->
        <div class="bg-slate-800 rounded-2xl overflow-hidden">
            <div class="p-6 border-b border-slate-700">
                <h2 class="text-xl font-bold text-white">Daftar Booking</h2>
                <p class="text-gray-300">Total: {{ $bookings->total() }} booking</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-slate-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Tanggal & Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Kapster</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Layanan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @forelse($bookings as $booking)
                            <tr class="hover:bg-slate-700 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-white">{{ $booking->formatted_date }}</div>
                                    <div class="text-sm text-gray-400">{{ $booking->formatted_time }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-white">{{ $booking->customer_name }}</div>
                                    <div class="text-sm text-gray-400">{{ $booking->customer_phone }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-white">{{ $booking->barber->name }}</div>
                                    <div class="text-sm text-gray-400">{{ $booking->barber->level_display }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-white">{{ $booking->service->name }}</div>
                                    <div class="text-sm text-gray-400">{{ $booking->service->duration }} menit</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-white">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
                                    <div class="text-sm text-gray-400">{{ $booking->payment_method_display }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($booking->status === 'pending') bg-yellow-500/20 text-yellow-400 border border-yellow-500/30
                                        @elseif($booking->status === 'confirmed') bg-blue-500/20 text-blue-400 border border-blue-500/30
                                        @elseif($booking->status === 'completed') bg-green-500/20 text-green-400 border border-green-500/30
                                        @else bg-red-500/20 text-red-400 border border-red-500/30 @endif">
                                        {{ $booking->status_display }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v16a2 2 0 002 2z"></path>
                                    </svg>
                                    <p>Tidak ada booking ditemukan</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($bookings->hasPages())
                <div class="px-6 py-4 border-t border-slate-700">
                    <div class="flex justify-center">
                        {{ $bookings->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Day Bookings Modal -->
<div id="dayBookingsModal" class="fixed inset-0 bg-black/80 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-2xl bg-slate-800 border-slate-600">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-white" id="modalDateTitle">Booking untuk Tanggal</h3>
                <button onclick="closeDayModal()" class="text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div id="dayBookingsList" class="space-y-4 max-h-96 overflow-y-auto">
                <!-- Bookings will be loaded here -->
            </div>
            
            <div class="flex justify-end mt-6">
                <button onclick="closeDayModal()" 
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
async function showBookingsForDate(date, dateFormatted) {
    document.getElementById('modalDateTitle').textContent = `Booking untuk ${dateFormatted}`;
    document.getElementById('dayBookingsList').innerHTML = '<div class="text-center py-4"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-yellow-400 mx-auto"></div></div>';
    document.getElementById('dayBookingsModal').classList.remove('hidden');
    
    try {
        const response = await fetch('/booking-dashboard/date-bookings', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ date: date })
        });
        
        const data = await response.json();
        
        if (data.success) {
            const bookingsList = document.getElementById('dayBookingsList');
            
            if (data.bookings.length === 0) {
                bookingsList.innerHTML = '<div class="text-center py-8 text-gray-400">Tidak ada booking pada tanggal ini</div>';
                return;
            }
            
            bookingsList.innerHTML = data.bookings.map(booking => `
                <div class="bg-slate-700 rounded-lg p-4">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center space-x-4 mb-2">
                                <span class="text-lg font-semibold text-white">${booking.time}</span>
                                <span class="px-2 py-1 rounded-full text-xs font-medium ${getStatusClass(booking.status)}">
                                    ${booking.status_display}
                                </span>
                            </div>
                            <h3 class="font-semibold text-white">${booking.customer_name}</h3>
                            <p class="text-gray-300">${booking.service_name} (${booking.service_duration} menit)</p>
                            <p class="text-sm text-gray-400">Kapster: ${booking.barber_name}</p>
                            <p class="text-sm text-gray-400">${booking.customer_phone}</p>
                            ${booking.notes ? `<p class="text-sm text-gray-400 mt-1"><strong>Catatan:</strong> ${booking.notes}</p>` : ''}
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-white">${booking.formatted_price}</p>
                        </div>
                    </div>
                </div>
            `).join('');
        }
    } catch (error) {
        console.error('Error:', error);
        document.getElementById('dayBookingsList').innerHTML = '<div class="text-center py-4 text-red-400">Gagal memuat data booking</div>';
    }
}

function getStatusClass(status) {
    switch(status) {
        case 'pending': return 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30';
        case 'confirmed': return 'bg-blue-500/20 text-blue-400 border border-blue-500/30';
        case 'completed': return 'bg-green-500/20 text-green-400 border border-green-500/30';
        case 'cancelled': return 'bg-red-500/20 text-red-400 border border-red-500/30';
        default: return 'bg-gray-500/20 text-gray-400 border border-gray-500/30';
    }
}

function closeDayModal() {
    document.getElementById('dayBookingsModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('dayBookingsModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDayModal();
    }
});
</script>
@endsection