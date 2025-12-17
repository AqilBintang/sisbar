@extends('layouts.app')

@section('title', 'Cek Status Booking - Sisbar Hairstudio')

@section('content')
<div class="min-h-screen bg-black pt-20">
    <!-- Background Image with Dark Overlay -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/bg-barber.jpg') }}');">
        <div class="absolute inset-0 bg-black/80"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 py-20">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold text-white mb-6">Cek Status Booking</h1>
                <p class="text-gray-300 text-xl">Periksa status booking Anda dengan mudah</p>
                <div class="flex justify-center mt-8">
                    <div class="w-32 h-1 bg-linear-to-r from-yellow-400 to-yellow-600 rounded-full"></div>
                </div>
            </div>

            <!-- Search Form -->
            <div class="bg-slate-800 rounded-3xl shadow-2xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-white mb-6 text-center">Masukkan Data Booking</h2>
                
                <form id="status-form" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="booking_id" class="block text-sm font-medium text-gray-300 mb-2">ID Booking (Opsional)</label>
                            <input type="number" id="booking_id" name="booking_id"
                                   class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                                   placeholder="Contoh: 123">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-300 mb-2">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone"
                                   class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                                   placeholder="08xxxxxxxxxx">
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" 
                                class="px-8 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-xl transition-colors">
                            Cek Status Booking
                        </button>
                    </div>
                </form>
            </div>

            <!-- Results -->
            <div id="results-section" class="hidden">
                <div class="bg-slate-800 rounded-3xl shadow-2xl p-8">
                    <h3 class="text-2xl font-bold text-white mb-6 text-center">Hasil Pencarian</h3>
                    <div id="booking-results" class="space-y-4">
                        <!-- Results will be populated here -->
                    </div>
                </div>
            </div>

            <!-- No Results -->
            <div id="no-results" class="hidden bg-slate-800 rounded-3xl shadow-2xl p-8 text-center">
                <div class="w-20 h-20 bg-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">Booking Tidak Ditemukan</h3>
                <p class="text-gray-300 mb-6">Tidak ada booking yang ditemukan dengan data yang Anda masukkan.</p>
                <button onclick="resetForm()" 
                        class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-xl transition-colors">
                    Coba Lagi
                </button>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-8">
                <a href="/" 
                   class="inline-block px-8 py-3 bg-slate-600 hover:bg-slate-500 text-white font-bold rounded-xl transition-colors mr-4">
                    Kembali ke Beranda
                </a>
                <a href="/booking" 
                   class="inline-block px-8 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-xl transition-colors">
                    Booking Baru
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('status-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
    // Validate input
    if (!data.booking_id && !data.phone) {
        alert('Silakan masukkan ID Booking atau Nomor Telepon');
        return;
    }
    
    try {
        const response = await fetch('/booking-status/check', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();
        
        if (result.success && result.bookings.length > 0) {
            displayResults(result.bookings);
        } else {
            showNoResults();
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mencari booking. Silakan coba lagi.');
    }
});

function displayResults(bookings) {
    const resultsSection = document.getElementById('results-section');
    const bookingResults = document.getElementById('booking-results');
    const noResults = document.getElementById('no-results');
    
    // Hide no results, show results
    noResults.classList.add('hidden');
    resultsSection.classList.remove('hidden');
    
    // Clear previous results
    bookingResults.innerHTML = '';
    
    bookings.forEach(booking => {
        const bookingCard = document.createElement('div');
        bookingCard.className = 'bg-slate-700 rounded-xl p-6 border border-slate-600';
        
        const statusColor = getStatusColor(booking.status_color);
        
        bookingCard.innerHTML = `
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h4 class="text-xl font-bold text-white mb-2">Booking #${booking.id}</h4>
                    <p class="text-gray-300">${booking.customer_name}</p>
                </div>
                <span class="px-3 py-1 rounded-full text-sm font-semibold ${statusColor}">
                    ${booking.status}
                </span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-400">Tanggal & Waktu:</p>
                    <p class="text-white font-semibold">${booking.date} ${booking.time}</p>
                </div>
                <div>
                    <p class="text-gray-400">Kapster:</p>
                    <p class="text-white font-semibold">${booking.barber_name}</p>
                </div>
                <div>
                    <p class="text-gray-400">Layanan:</p>
                    <p class="text-white font-semibold">${booking.service_name}</p>
                </div>
                <div>
                    <p class="text-gray-400">Total Harga:</p>
                    <p class="text-yellow-400 font-bold">Rp ${parseInt(booking.total_price).toLocaleString('id-ID')}</p>
                </div>
            </div>
            
            ${booking.notes ? `
                <div class="mt-4 pt-4 border-t border-slate-600">
                    <p class="text-gray-400 text-sm">Catatan:</p>
                    <p class="text-gray-300 text-sm">${booking.notes}</p>
                </div>
            ` : ''}
        `;
        
        bookingResults.appendChild(bookingCard);
    });
}

function showNoResults() {
    const resultsSection = document.getElementById('results-section');
    const noResults = document.getElementById('no-results');
    
    resultsSection.classList.add('hidden');
    noResults.classList.remove('hidden');
}

function resetForm() {
    document.getElementById('status-form').reset();
    document.getElementById('results-section').classList.add('hidden');
    document.getElementById('no-results').classList.add('hidden');
}

function getStatusColor(color) {
    const colors = {
        'yellow': 'bg-yellow-100 text-yellow-800',
        'blue': 'bg-blue-100 text-blue-800',
        'green': 'bg-green-100 text-green-800',
        'red': 'bg-red-100 text-red-800',
        'gray': 'bg-gray-100 text-gray-800'
    };
    
    return colors[color] || colors['gray'];
}
</script>
@endsection