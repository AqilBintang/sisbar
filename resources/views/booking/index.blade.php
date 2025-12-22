@extends('layouts.app')

@section('title', 'Booking Appointment - Sisbar Hairstudio')

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
                <h1 class="text-5xl font-bold text-white mb-6">Booking Appointment</h1>
                <p class="text-gray-300 text-xl">Pilih tanggal untuk melihat kapster yang tersedia</p>
                

                
                <div class="flex justify-center mt-8">
                    <div class="w-32 h-1 bg-linear-to-r from-yellow-400 to-yellow-600 rounded-full"></div>
                </div>
            </div>

            <!-- Booking Form -->
            <div class="bg-slate-800 rounded-3xl shadow-2xl p-8 mb-8">
                <form id="booking-form" class="space-y-6">
                    @csrf
                    
                    <!-- Step 1: Date Selection -->
                    <div id="step-1">
                        <h2 class="text-2xl font-bold text-white mb-6">1. Pilih Tanggal</h2>
                        <div class="flex flex-col md:flex-row gap-4 items-end">
                            <div class="flex-1">
                                <label for="booking-date" class="block text-sm font-medium text-gray-300 mb-2">Tanggal Appointment</label>
                                <input type="date" id="booking-date" name="booking_date" required
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                                       min="{{ date('Y-m-d') }}">
                            </div>
                            <button type="button" onclick="searchAvailableBarbers()" 
                                    class="px-8 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-xl transition-colors">
                                Cari Kapster
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Barber Selection -->
                    <div id="step-2" class="hidden">
                        <h2 class="text-2xl font-bold text-white mb-6">2. Pilih Kapster</h2>
                        <div id="barbers-list" class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Barbers will be populated here -->
                        </div>
                    </div>

                    <!-- Step 3: Time Selection -->
                    <div id="step-3" class="hidden">
                        <h2 class="text-2xl font-bold text-white mb-6">3. Pilih Waktu</h2>
                        <div id="time-slots" class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 mb-6">
                            <!-- Time slots will be populated here -->
                        </div>
                    </div>

                    <!-- Step 4: Service Selection -->
                    <div id="step-4" class="hidden" @if(isset($selectedService) && $selectedService) style="display: none !important;" @endif>
                        <!-- Prefilled Data Info -->
                        <div id="prefilled-info" class="hidden mb-6 p-4 bg-blue-500/20 border border-blue-500/30 rounded-xl">
                            <div class="flex items-center mb-3">
                                <svg class="w-5 h-5 text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <h3 class="text-blue-400 font-semibold">Data dari Cek Ketersediaan</h3>
                            </div>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-400">Tanggal:</span>
                                    <span id="prefilled-date" class="text-white font-medium ml-2"></span>
                                </div>
                                <div>
                                    <span class="text-gray-400">Waktu:</span>
                                    <span id="prefilled-time" class="text-white font-medium ml-2"></span>
                                </div>
                                <div class="col-span-2">
                                    <span class="text-gray-400">Kapster:</span>
                                    <span id="prefilled-barber" class="text-white font-medium ml-2"></span>
                                </div>
                            </div>
                        </div>
                        
                        <h2 class="text-2xl font-bold text-white mb-6">4. Pilih Layanan</h2>
                        <div id="services-list" class="space-y-3 mb-6">
                            <!-- Services will be populated here -->
                        </div>
                    </div>
                    
                    @if(isset($selectedService) && $selectedService)
                    <!-- Pre-selected Service Display -->
                    <div id="preselected-service" class="mb-6">
                        <h2 class="text-2xl font-bold text-white mb-4">Layanan Terpilih</h2>
                        <div class="bg-slate-700 border-2 border-yellow-400 rounded-xl p-6">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h4 class="text-white font-semibold text-lg">{{ $selectedService->name }}</h4>
                                    <p class="text-gray-400 text-sm">{{ $selectedService->duration }} menit</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-yellow-400 font-bold text-xl">{{ $selectedService->formatted_price }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Step 5: Customer Information -->
                    <div id="step-5" class="hidden">
                        <!-- Prefilled Data Info -->
                        <div id="prefilled-info-step5" class="hidden mb-6 p-4 bg-blue-500/20 border border-blue-500/30 rounded-xl">
                            <div class="flex items-center mb-3">
                                <svg class="w-5 h-5 text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <h3 class="text-blue-400 font-semibold">Data dari Cek Ketersediaan</h3>
                            </div>
                            <div class="grid grid-cols-3 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-400">Tanggal:</span>
                                    <span id="prefilled-date-step5" class="text-white font-medium ml-2"></span>
                                </div>
                                <div>
                                    <span class="text-gray-400">Waktu:</span>
                                    <span id="prefilled-time-step5" class="text-white font-medium ml-2"></span>
                                </div>
                                <div>
                                    <span class="text-gray-400">Kapster:</span>
                                    <span id="prefilled-barber-step5" class="text-white font-medium ml-2"></span>
                                </div>
                            </div>
                        </div>
                        
                        <h2 class="text-2xl font-bold text-white mb-6">5. Informasi Pelanggan</h2>
                        
                        <!-- Auto-filled Customer Data Display -->
                        <div class="bg-slate-700/50 border border-yellow-400/30 rounded-xl p-6 mb-6">
                            <div class="flex items-center mb-4">
                                <svg class="w-5 h-5 text-yellow-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <h3 class="text-yellow-400 font-semibold">Data Pelanggan Terverifikasi</h3>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap</label>
                                    <input type="text" id="customer-name" name="customer_name" required readonly
                                           class="w-full px-4 py-3 bg-slate-600 border border-slate-500 rounded-xl text-white cursor-not-allowed"
                                           value="{{ auth()->user()->name }}">
                                    <p class="text-gray-400 text-xs mt-1">Data dari akun Anda</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-2">Nomor Telepon</label>
                                    <input type="tel" id="customer-phone" name="customer_phone" required readonly
                                           class="w-full px-4 py-3 bg-slate-600 border border-slate-500 rounded-xl text-white cursor-not-allowed"
                                           value="{{ auth()->user()->whatsapp_number ?? auth()->user()->phone ?? '08xxxxxxxxxx' }}">
                                    <p class="text-gray-400 text-xs mt-1">Nomor WhatsApp terdaftar</p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                                    <input type="email" id="customer-email" name="customer_email" required readonly
                                           class="w-full px-4 py-3 bg-slate-600 border border-slate-500 rounded-xl text-white cursor-not-allowed"
                                           value="{{ auth()->user()->email }}">
                                    <p class="text-gray-400 text-xs mt-1">Email dari akun Google Anda</p>
                                </div>
                            </div>
                        </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-300 mb-3">Metode Pembayaran *</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="payment_method" value="cash" class="sr-only" onchange="selectPaymentMethod('cash')" checked>
                                        <div class="payment-option bg-slate-600 border-2 border-slate-500 rounded-xl p-4 text-center hover:border-yellow-400 transition-colors" onclick="selectPaymentMethod('cash')">
                                            <svg class="w-8 h-8 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            <span class="text-white font-medium">Bayar Tunai</span>
                                            <p class="text-gray-400 text-xs mt-1">Bayar di tempat</p>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="payment_method" value="online" class="sr-only" onchange="selectPaymentMethod('online')">
                                        <div class="payment-option bg-slate-600 border-2 border-slate-500 rounded-xl p-4 text-center hover:border-yellow-400 transition-colors" onclick="selectPaymentMethod('online')">
                                            <svg class="w-8 h-8 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                            </svg>
                                            <span class="text-white font-medium">Bayar Online</span>
                                            <p class="text-yellow-400 text-xs mt-1 font-semibold">QRIS • Transfer Bank • E-Wallet</p>
                                        </div>
                                    </label>
                                </div>
                                
                                <!-- PAYMENT METHOD CONFIRMATION -->
                                <div id="payment-confirmation" class="md:col-span-2 mt-4" style="display: none;">
                                    <!-- Payment confirmation will be shown here -->
                                </div>
                                

                            </div>
                            <div class="md:col-span-2">
                                <label for="notes" class="block text-sm font-medium text-gray-300 mb-2">Catatan (Opsional)</label>
                                <textarea id="notes" name="notes" rows="3"
                                          class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                                          placeholder="Catatan khusus untuk kapster..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Step 6: Confirmation -->
                    <div id="step-6" class="hidden">
                        <h2 class="text-2xl font-bold text-white mb-6">6. Konfirmasi Booking</h2>
                        <div class="bg-slate-700 rounded-xl p-6 mb-6">
                            <div id="booking-summary" class="space-y-3 text-gray-300">
                                <!-- Booking summary will be populated here -->
                            </div>
                        </div>
                        <button type="submit" 
                                class="w-full px-8 py-4 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-xl transition-colors">
                            Konfirmasi Booking
                        </button>
                    </div>

                    <!-- Navigation Buttons -->
                    <div id="navigation-buttons" class="flex justify-between pt-6">
                        <button type="button" id="prev-btn" onclick="previousStep()" 
                                class="px-6 py-3 bg-slate-600 hover:bg-slate-500 text-white font-medium rounded-xl transition-colors hidden">
                            Sebelumnya
                        </button>
                        <button type="button" id="next-btn" onclick="nextStep()" 
                                class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-medium rounded-xl transition-colors hidden">
                            Selanjutnya
                        </button>
                        <button type="button" id="confirm-btn" onclick="goToConfirmation()" 
                                class="px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-medium rounded-xl transition-colors hidden">
                            Lanjut ke Konfirmasi
                        </button>
                    </div>
                </form>
            </div>

            <!-- Loading State -->
            <div id="loading" class="hidden text-center py-8">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-yellow-400"></div>
                <p class="text-gray-300 mt-2">Mencari kapster yang tersedia...</p>
            </div>

            <!-- Results -->
            <div id="results" class="hidden">
                <div class="bg-slate-800 rounded-3xl shadow-2xl p-8">
                    <h2 class="text-2xl font-bold text-white mb-6">Kapster Tersedia</h2>
                    <div id="selected-date-info" class="mb-6 p-4 bg-yellow-500/10 border border-yellow-500/30 rounded-xl">
                        <p class="text-yellow-400 font-medium"></p>
                    </div>
                    <div id="barbers-list" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Barbers will be populated here -->
                    </div>
                </div>
            </div>

            <!-- No Results -->
            <div id="no-results" class="hidden">
                <div class="bg-slate-800 rounded-3xl shadow-2xl p-8 text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Tidak Ada Kapster Tersedia</h3>
                    <p class="text-gray-300">Maaf, tidak ada kapster yang tersedia pada tanggal yang dipilih. Silakan pilih tanggal lain.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let currentStep = 1;
let selectedBarber = null;
let selectedTime = null;
let selectedService = null;
let selectedPaymentMethod = 'cash'; // Default to cash
let bookingData = {
    payment_method: 'cash' // Set default payment method
};

// Check for pre-selected service
@if(isset($selectedService) && $selectedService)
selectedService = {
    id: {{ $selectedService->id }},
    name: "{{ $selectedService->name }}",
    price: {{ $selectedService->price }},
    duration: {{ $selectedService->duration }},
    formatted_price: "{{ $selectedService->formatted_price }}"
};
bookingData.service_id = {{ $selectedService->id }};
bookingData.total_price = {{ $selectedService->price }};
console.log('Pre-selected service:', selectedService);
@endif

// Initialize
document.getElementById('booking-date').min = new Date().toISOString().split('T')[0];

// Check for prefilled booking data from availability checker
const prefilledData = sessionStorage.getItem('prefilledBookingData');
if (prefilledData) {
    const data = JSON.parse(prefilledData);
    console.log('Found prefilled booking data:', data);
    
    // Set the form values
    document.getElementById('booking-date').value = data.date;
    bookingData.booking_date = data.date;
    bookingData.barber_id = data.barber_id;
    bookingData.booking_time = data.time;
    
    // Set selected data
    selectedBarber = {
        id: data.barber_id,
        name: data.barber_name
    };
    selectedTime = {
        time: data.time,
        display: data.time
    };
    
    // Clear the session storage
    sessionStorage.removeItem('prefilledBookingData');
    
    // Skip to service selection (step 4)
    @if(isset($selectedService) && $selectedService)
    // If service is pre-selected, go directly to customer info (step 5)
    showStep(5);
    @else
    // Load services and show step 4
    loadServices();
    showStep(4);
    @endif
} else {
    // Normal flow - start from step 1
    // Auto-populate customer data from authenticated user
    @auth
    bookingData.customer_name = "{{ auth()->user()->name }}";
    bookingData.customer_email = "{{ auth()->user()->email }}";
    bookingData.customer_phone = "{{ auth()->user()->whatsapp_number ?? auth()->user()->phone ?? '' }}";
    @endauth
}

// Set default payment method visual state
document.addEventListener('DOMContentLoaded', function() {
    // Set default cash payment method as selected
    const cashOption = document.querySelector('input[value="cash"]').closest('label').querySelector('.payment-option');
    cashOption.classList.add('border-yellow-400', 'bg-yellow-400/10');
    cashOption.classList.remove('border-slate-500');
});

async function searchAvailableBarbers() {
    const dateInput = document.getElementById('booking-date');
    const date = dateInput.value;
    
    if (!date) {
        alert('Silakan pilih tanggal terlebih dahulu');
        return;
    }

    // Add booking date to bookingData
    bookingData.booking_date = date;

    showLoading();

    try {
        const response = await fetch('{{ route("booking.available-barbers") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ date: date })
        });

        const data = await response.json();
        hideLoading();

        if (data.success && data.barbers.length > 0) {
            populateBarbers(data.barbers);
            showStep(2);
        } else {
            showNoResults();
        }
    } catch (error) {
        console.error('Error:', error);
        hideLoading();
        alert('Terjadi kesalahan saat mencari kapster. Silakan coba lagi.');
    }
}

function populateBarbers(barbers) {
    const barbersList = document.getElementById('barbers-list');
    barbersList.innerHTML = '';
    
    barbers.forEach(barber => {
        const barberCard = document.createElement('div');
        barberCard.className = 'bg-slate-700 rounded-2xl p-6 border border-slate-600 hover:border-yellow-400 transition-colors cursor-pointer';
        barberCard.onclick = () => selectBarber(barber);
        
        barberCard.innerHTML = `
            <div class="flex items-center mb-4">
                ${barber.photo ? 
                    `<img src="${barber.photo}" alt="${barber.name}" class="w-16 h-16 rounded-full object-cover mr-4" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                     <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mr-4" style="display: none;">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                     </div>` :
                    `<div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>`
                }
                <div>
                    <h3 class="text-lg font-bold text-white">${barber.name}</h3>
                    <p class="text-yellow-400 text-sm">${barber.level}</p>
                    <div class="flex items-center mt-1">
                        <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span class="text-gray-300 text-sm">${barber.rating}</span>
                    </div>
                </div>
            </div>
            <p class="text-gray-300 text-sm mb-3">${barber.specialty}</p>
            ${barber.schedule ? `<p class="text-yellow-400 text-sm">Jam kerja: ${barber.schedule}</p>` : ''}
        `;
        
        barbersList.appendChild(barberCard);
    });
}

async function selectBarber(barber) {
    selectedBarber = barber;
    bookingData.barber_id = barber.id;
    
    // Highlight selected barber
    document.querySelectorAll('#barbers-list > div').forEach(card => {
        card.classList.remove('border-yellow-400', 'bg-slate-600');
        card.classList.add('border-slate-600');
    });
    event.currentTarget.classList.add('border-yellow-400', 'bg-slate-600');
    
    // Load time slots
    await loadTimeSlots();
    showStep(3);
}

async function loadTimeSlots() {
    const date = document.getElementById('booking-date').value;
    
    try {
        const response = await fetch('{{ route("booking.time-slots") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ 
                barber_id: selectedBarber.id,
                date: date 
            })
        });

        const data = await response.json();
        
        if (data.success) {
            populateTimeSlots(data.time_slots);
        }
    } catch (error) {
        console.error('Error loading time slots:', error);
    }
}

function populateTimeSlots(timeSlots) {
    const timeSlotsContainer = document.getElementById('time-slots');
    timeSlotsContainer.innerHTML = '';
    
    if (timeSlots.length === 0) {
        timeSlotsContainer.innerHTML = '<p class="text-gray-300 col-span-full text-center">Tidak ada waktu yang tersedia untuk hari ini.</p>';
        return;
    }
    
    timeSlots.forEach(slot => {
        const timeButton = document.createElement('button');
        timeButton.type = 'button';
        timeButton.className = 'px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white hover:border-yellow-400 hover:bg-slate-600 transition-colors';
        timeButton.textContent = slot.display;
        timeButton.onclick = () => selectTime(slot);
        
        timeSlotsContainer.appendChild(timeButton);
    });
}

function selectTime(timeSlot) {
    selectedTime = timeSlot;
    bookingData.booking_time = timeSlot.time;
    
    // Highlight selected time
    document.querySelectorAll('#time-slots button').forEach(btn => {
        btn.classList.remove('border-yellow-400', 'bg-slate-600');
        btn.classList.add('border-slate-600');
    });
    event.currentTarget.classList.add('border-yellow-400', 'bg-slate-600');
    
    // Check if service is already pre-selected
    @if(isset($selectedService) && $selectedService)
    // Skip service selection, go directly to customer info
    showStep(5);
    @else
    // Load services for selection
    loadServices();
    showStep(4);
    @endif
}

async function loadServices() {
    try {
        const response = await fetch('{{ route("booking.services") }}');
        const data = await response.json();
        
        if (data.success) {
            populateServices(data.services);
        }
    } catch (error) {
        console.error('Error loading services:', error);
    }
}

function populateServices(services) {
    const servicesList = document.getElementById('services-list');
    servicesList.innerHTML = '';
    
    services.forEach(service => {
        const serviceCard = document.createElement('div');
        serviceCard.className = 'bg-slate-700 border border-slate-600 rounded-xl p-4 hover:border-yellow-400 transition-colors cursor-pointer';
        serviceCard.onclick = () => selectService(service);
        
        serviceCard.innerHTML = `
            <div class="flex justify-between items-center">
                <div>
                    <h4 class="text-white font-semibold">${service.name}</h4>
                    <p class="text-gray-400 text-sm">${service.duration} menit</p>
                </div>
                <div class="text-right">
                    <p class="text-yellow-400 font-bold">${service.formatted_price}</p>
                </div>
            </div>
        `;
        
        servicesList.appendChild(serviceCard);
    });
}

function selectService(service) {
    selectedService = service;
    bookingData.service_id = service.id;
    bookingData.total_price = service.price;
    
    // Highlight selected service
    document.querySelectorAll('#services-list > div').forEach(card => {
        card.classList.remove('border-yellow-400', 'bg-slate-600');
        card.classList.add('border-slate-600');
    });
    event.currentTarget.classList.add('border-yellow-400', 'bg-slate-600');
    
    showStep(5);
}

function selectPaymentMethod(method) {
    selectedPaymentMethod = method;
    bookingData.payment_method = method;
    
    // Update the actual form input value
    const radioInput = document.querySelector(`input[name="payment_method"][value="${method}"]`);
    if (radioInput) {
        radioInput.checked = true;
    }
    
    // Update visual selection
    document.querySelectorAll('.payment-option').forEach(option => {
        option.classList.remove('border-yellow-400', 'bg-yellow-400/10');
        option.classList.add('border-slate-500');
    });
    
    // Add selection to current option
    if (event && event.target) {
        const currentOption = event.target.closest('label').querySelector('.payment-option');
        if (currentOption) {
            currentOption.classList.remove('border-slate-500');
            currentOption.classList.add('border-yellow-400', 'bg-yellow-400/10');
        }
    }
    
    // Show payment confirmation
    const confirmationDiv = document.getElementById('payment-confirmation');
    if (confirmationDiv) {
        confirmationDiv.style.display = 'block';
        
        if (method === 'online') {
            confirmationDiv.innerHTML = `
                <div class="p-4 bg-blue-500/20 border-2 border-blue-500/50 rounded-xl">
                    <div class="flex items-center mb-3">
                        <svg class="w-6 h-6 text-blue-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-blue-400 font-bold text-lg">Bayar Online Dipilih</span>
                    </div>
                    <div class="bg-blue-600/20 rounded-lg p-3">
                        <p class="text-blue-300 font-semibold mb-2">Metode pembayaran tersedia:</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium">QRIS</span>
                            <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium">Transfer Bank</span>
                            <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium">E-Wallet</span>
                        </div>
                    </div>
                </div>
            `;
        } else {
            confirmationDiv.innerHTML = `
                <div class="p-4 bg-green-500/20 border-2 border-green-500/50 rounded-xl">
                    <div class="flex items-center mb-3">
                        <svg class="w-6 h-6 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-green-400 font-bold text-lg">Bayar Tunai Dipilih</span>
                    </div>
                    <div class="bg-green-600/20 rounded-lg p-3">
                        <p class="text-green-300 font-semibold">Bayar langsung di tempat saat pelayanan</p>
                    </div>
                </div>
            `;
        }
    }
}



function showStep(step) {
    // Hide all steps
    for (let i = 1; i <= 6; i++) {
        document.getElementById(`step-${i}`).classList.add('hidden');
    }
    
    // Show current step
    document.getElementById(`step-${step}`).classList.remove('hidden');
    currentStep = step;
    
    // Show prefilled info if we have prefilled data and we're on step 4 or 5
    if ((step === 4 || step === 5) && selectedBarber && selectedTime) {
        const prefilledInfo = document.getElementById(step === 4 ? 'prefilled-info' : 'prefilled-info-step5');
        if (prefilledInfo) {
            prefilledInfo.classList.remove('hidden');
            
            // Update prefilled data display
            const suffix = step === 5 ? '-step5' : '';
            const dateEl = document.getElementById('prefilled-date' + suffix);
            const timeEl = document.getElementById('prefilled-time' + suffix);
            const barberEl = document.getElementById('prefilled-barber' + suffix);
            
            if (dateEl) dateEl.textContent = new Date(bookingData.booking_date).toLocaleDateString('id-ID');
            if (timeEl) timeEl.textContent = selectedTime.display || selectedTime.time;
            if (barberEl) barberEl.textContent = selectedBarber.name;
        }
    }
    
    // Update navigation buttons
    updateNavigationButtons();
    
    // If step 6, populate summary
    if (step === 6) {
        populateBookingSummary();
    }
}

function updateNavigationButtons() {
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const confirmBtn = document.getElementById('confirm-btn');
    
    prevBtn.classList.toggle('hidden', currentStep === 1);
    nextBtn.classList.toggle('hidden', currentStep >= 5);
    confirmBtn.classList.toggle('hidden', currentStep !== 5);
}

function previousStep() {
    if (currentStep > 1) {
        showStep(currentStep - 1);
    }
}

function nextStep() {
    if (currentStep < 6) {
        showStep(currentStep + 1);
    }
}

function goToConfirmation() {
    // Customer data is pre-filled from authenticated user, no validation needed
    const customerName = document.getElementById('customer-name').value;
    const customerPhone = document.getElementById('customer-phone').value;
    const customerEmail = document.getElementById('customer-email').value;
    
    // Update booking data with current values (already pre-filled)
    bookingData.customer_name = customerName;
    bookingData.customer_phone = customerPhone;
    bookingData.customer_email = customerEmail;
    
    // Go to confirmation step
    showStep(6);
}

function populateBookingSummary() {
    const date = document.getElementById('booking-date').value;
    const summary = document.getElementById('booking-summary');
    
    summary.innerHTML = `
        <div class="grid grid-cols-2 gap-4">
            <div><strong>Tanggal:</strong></div>
            <div>${new Date(date).toLocaleDateString('id-ID')}</div>
            
            <div><strong>Waktu:</strong></div>
            <div>${selectedTime.display}</div>
            
            <div><strong>Kapster:</strong></div>
            <div>${selectedBarber.name} (${selectedBarber.level})</div>
            
            <div><strong>Layanan:</strong></div>
            <div>${selectedService.name}</div>
            
            <div><strong>Durasi:</strong></div>
            <div>${selectedService.duration} menit</div>
            
            <div><strong>Metode Pembayaran:</strong></div>
            <div>${selectedPaymentMethod === 'cash' ? 'Bayar Tunai' : 'Bayar Online'}</div>
            
            <div><strong>Total Harga:</strong></div>
            <div class="text-yellow-400 font-bold">${selectedService.formatted_price}</div>
        </div>
    `;
}

// Form submission
document.getElementById('booking-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    console.log('🚀 Form submitted!');
    
    // Show loading state
    const submitButton = document.querySelector('button[type="submit"]');
    const originalText = submitButton.innerHTML;
    submitButton.innerHTML = 'Memproses...';
    submitButton.disabled = true;
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
    // Add selected data
    Object.assign(data, bookingData);
    
    // Ensure customer data is included (from pre-filled readonly fields)
    data.customer_name = document.getElementById('customer-name').value;
    data.customer_email = document.getElementById('customer-email').value;
    data.customer_phone = document.getElementById('customer-phone').value;
    
    // Ensure payment method is set correctly
    if (selectedPaymentMethod) {
        data.payment_method = selectedPaymentMethod;
    }
    
    console.log('📤 Final data to send:', data);
    
    try {

        
        const response = await fetch('{{ route("booking.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const responseText = await response.text();
        
        // Try to parse as JSON
        let result;
        try {
            result = JSON.parse(responseText);
        } catch (parseError) {
            
            if (responseText.includes('<html') || responseText.includes('<!DOCTYPE')) {
                alert('Terjadi redirect. Silakan coba lagi.');
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
                return;
            }
            
            throw new Error('Invalid JSON response');
        }
        
        if (result.success) {
            // Store booking data in localStorage for receipt page
            localStorage.setItem('lastBooking', JSON.stringify(result.booking));
            
            // Show success message
            alert('✅ Booking berhasil! Struk akan ditampilkan...');
            
            // Instead of redirect, show receipt inline
            showBookingReceipt(result.booking, result.booking_id);
        } else {
            alert(result.message || 'Terjadi kesalahan saat membuat booking.');
            submitButton.innerHTML = originalText;
            submitButton.disabled = false;
        }
    } catch (error) {
        alert('Terjadi kesalahan saat membuat booking. Silakan coba lagi.');
        submitButton.innerHTML = originalText;
        submitButton.disabled = false;
    }
});

function showLoading() {
    document.getElementById('loading').classList.remove('hidden');
}

function hideLoading() {
    document.getElementById('loading').classList.add('hidden');
}

function showNoResults() {
    document.getElementById('no-results').classList.remove('hidden');
}

function showBookingReceipt(booking, bookingId) {
    console.log('📄 Showing booking receipt inline');
    
    // Hide the booking form
    document.querySelector('.max-w-4xl').style.display = 'none';
    
    // Create receipt container
    const receiptContainer = document.createElement('div');
    receiptContainer.className = 'max-w-2xl mx-auto';
    receiptContainer.innerHTML = `
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
                <div class="w-24 h-1 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-full"></div>
            </div>
        </div>

        <!-- Receipt Card -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 mb-8 text-black">
            <!-- Header -->
            <div class="text-center border-b-2 border-dashed border-gray-300 pb-6 mb-6">
                <div class="flex items-center justify-center mb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Sisbar Hairstudio</h2>
                        <p class="text-gray-600 text-sm">Professional Barbershop</p>
                    </div>
                </div>
                <p class="text-gray-600">Jl. Raya Barbershop No. 123</p>
                <p class="text-gray-600">Telp: +62 815-7279-4699</p>
            </div>

            <!-- Receipt Details -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">STRUK BOOKING</h3>
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Booking ID</p>
                        <p class="font-bold text-lg">#${String(bookingId).padStart(4, '0')}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-600">Tanggal Booking:</p>
                        <p class="font-semibold">${booking.date || formatDate(booking.booking_date)}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Waktu:</p>
                        <p class="font-semibold">${booking.time || formatTime(booking.booking_time)}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Nama Pelanggan:</p>
                        <p class="font-semibold">${booking.customer_name}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">No. Telepon:</p>
                        <p class="font-semibold">${booking.customer_phone}</p>
                    </div>
                </div>
            </div>

            <!-- Service Details -->
            <div class="border-t border-gray-200 pt-4 mb-6">
                <h4 class="font-bold text-gray-800 mb-3">Detail Layanan</h4>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="font-semibold">${booking.service_name || (booking.service && booking.service.name)}</p>
                            <p class="text-sm text-gray-600">Kapster: ${booking.barber_name || (booking.barber && booking.barber.name)}</p>
                            <p class="text-sm text-gray-600">Durasi: ${(booking.service && booking.service.duration) || '30'} menit</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-lg">Rp ${parseInt(booking.total_price).toLocaleString('id-ID')}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total -->
            <div class="border-t-2 border-dashed border-gray-300 pt-4 mb-6">
                <div class="flex justify-between items-center">
                    <p class="text-xl font-bold text-gray-800">TOTAL PEMBAYARAN</p>
                    <p class="text-2xl font-bold text-green-600">Rp ${parseInt(booking.total_price).toLocaleString('id-ID')}</p>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="border-t border-gray-200 pt-4 mb-4">
                <h4 class="font-bold text-gray-800 mb-3">Metode Pembayaran</h4>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-blue-800">${booking.payment_method_display || ((booking.payment_method === 'online' || selectedPaymentMethod === 'online') ? 'Bayar Online' : 'Bayar Tunai')}</p>
                            <p class="text-sm text-blue-600">${booking.payment_status || 'Menunggu Pembayaran'}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center px-4 py-2 bg-yellow-100 border border-yellow-300 rounded-full">
                    <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                    <span class="text-yellow-800 font-semibold">Menunggu Konfirmasi</span>
                </div>
            </div>

            <!-- Important Instructions -->
            <div class="border-t border-gray-200 pt-4 mb-4">
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <h4 class="font-bold text-red-800 mb-2 text-center">⚠️ INSTRUKSI PENTING</h4>
                    <div class="text-red-700 text-xs space-y-1">
                        <p><strong>• Berikan struk ini kepada kasir setengah jam (30 menit) sebelum waktu booking</strong></p>
                        <p><strong>• Jika terlambat lebih dari 10 menit dari waktu booking, akan diundur ke 1 pesanan selanjutnya</strong></p>
                        <p>• Harap datang tepat waktu untuk pelayanan terbaik</p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="border-t border-gray-200 pt-4 text-center text-sm text-gray-600">
                <p class="mb-2">Terima kasih atas kepercayaan Anda!</p>
                <p class="mb-2">Kami akan menghubungi Anda untuk konfirmasi</p>
                <p class="text-xs">Dicetak pada: ${new Date().toLocaleString('id-ID')}</p>
            </div>
        </div>

        <!-- Payment Section (for online payment) -->
        <div id="inline-payment-section" class="mb-8" style="display: ${(booking.payment_method === 'online' || selectedPaymentMethod === 'online') && booking.payment_status !== 'Sudah Dibayar' && booking.payment_status !== 'paid' ? 'block' : 'none'};">
            <div class="bg-blue-500/10 border border-blue-500/30 rounded-xl p-6">
                <div class="text-center mb-4">
                    <h3 class="text-blue-400 font-bold text-lg mb-2">💳 Pembayaran Online</h3>
                    <p class="text-gray-300 text-sm">
                        Silakan lakukan pembayaran untuk mengkonfirmasi booking Anda
                    </p>
                </div>
                
                <!-- Payment Timer -->
                <div id="inline-payment-timer" class="mb-4 p-3 bg-orange-100 border border-orange-400 text-orange-700 rounded-lg text-center">
                    <div class="font-bold">⏰ Waktu Pembayaran Tersisa</div>
                    <div id="inline-countdown" class="text-2xl font-mono">05:00</div>
                    <div class="text-sm">Booking akan otomatis dibatalkan jika tidak dibayar</div>
                </div>
                
                <!-- Payment Buttons -->
                <div class="space-y-3">
                    <button onclick="processInlineOnlinePayment(${bookingId})" 
                            id="inline-pay-now-btn"
                            class="w-full px-8 py-4 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-xl transition-all transform hover:scale-105 shadow-lg">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        💳 Bayar Sekarang
                    </button>
                    
                    <!-- Test Payment Buttons -->
                    <div class="grid grid-cols-2 gap-3">
                        <button onclick="simulateInlinePaymentSuccess(${bookingId})" 
                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg transition-colors">
                            ✅ Test: Sudah Bayar
                        </button>
                        <button onclick="simulateInlinePaymentCancel(${bookingId})" 
                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-4 rounded-lg transition-colors">
                            ❌ Test: Tidak Bayar
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="grid grid-cols-2 sm:grid-cols-5 gap-4 mb-8">
            <!-- Download PDF -->
            <button onclick="downloadInlineReceiptPDF(${bookingId})" 
                    class="group px-4 py-4 bg-red-500 hover:bg-red-600 text-white font-bold rounded-xl transition-all transform hover:scale-105 shadow-lg">
                <div class="flex flex-col items-center">
                    <svg class="w-6 h-6 mb-2 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="text-xs">Download PDF</span>
                </div>
            </button>
            
            <!-- View PDF -->
            <button onclick="viewInlineReceiptPDF(${bookingId})" 
                    class="group px-4 py-4 bg-purple-500 hover:bg-purple-600 text-white font-bold rounded-xl transition-all transform hover:scale-105 shadow-lg">
                <div class="flex flex-col items-center">
                    <svg class="w-6 h-6 mb-2 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <span class="text-xs">View PDF</span>
                </div>
            </button>
            
            <!-- Full Receipt -->
            <a href="/booking-receipt?booking_id=${bookingId}" target="_blank"
               class="group px-4 py-4 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl transition-all transform hover:scale-105 shadow-lg text-center">
                <div class="flex flex-col items-center">
                    <svg class="w-6 h-6 mb-2 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="text-xs">Struk Lengkap</span>
                </div>
            </a>
            
            <!-- Booking Lagi -->
            <a href="/booking" 
               class="group px-4 py-4 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-xl transition-all transform hover:scale-105 shadow-lg text-center">
                <div class="flex flex-col items-center">
                    <svg class="w-6 h-6 mb-2 group-hover:animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span class="text-xs">Booking Lagi</span>
                </div>
            </a>
            
            <!-- Kembali ke Beranda -->
            <a href="/" 
               class="group px-4 py-4 bg-slate-600 hover:bg-slate-500 text-white font-bold rounded-xl transition-all transform hover:scale-105 shadow-lg text-center">
                <div class="flex flex-col items-center">
                    <svg class="w-6 h-6 mb-2 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="text-xs">Beranda</span>
                </div>
            </a>
        </div>
    `;
    
    // Insert receipt after the main container
    document.querySelector('.container.mx-auto').appendChild(receiptContainer);
    
    // Start payment timer if online payment and has expires_at
    const isOnlinePayment = booking.payment_method === 'online' || selectedPaymentMethod === 'online';
    
    if (isOnlinePayment && booking.payment_expires_at) {
        startInlinePaymentTimer(booking.payment_expires_at);
    }
    
    console.log('✅ Receipt displayed successfully');
}

function formatDate(dateString) {
    if (!dateString) return '-';
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

function formatTime(timeString) {
    if (!timeString) return '-';
    
    if (timeString.match(/^\d{2}:\d{2}$/)) {
        return timeString;
    }
    
    if (timeString.match(/^\d{2}:\d{2}:\d{2}$/)) {
        return timeString.substring(0, 5);
    }
    
    try {
        const date = new Date(timeString);
        return date.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        });
    } catch (error) {
        return timeString;
    }
}

// Payment timer variables for inline receipt
let inlinePaymentTimer;

// Start countdown timer for inline receipt
function startInlinePaymentTimer(expiresAt) {
    if (!expiresAt) return;
    
    const countdownElement = document.getElementById('inline-countdown');
    if (!countdownElement) return;
    
    const expiryDate = new Date(expiresAt);
    
    inlinePaymentTimer = setInterval(function() {
        const now = new Date();
        const timeLeft = Math.max(0, Math.floor((expiryDate - now) / 1000));
        
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        
        countdownElement.textContent = 
            `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        
        if (timeLeft <= 0) {
            clearInterval(inlinePaymentTimer);
            expireInlineBooking();
            return;
        }
        
        // Change color when time is running out
        const timerElement = countdownElement.parentElement;
        if (timeLeft <= 60) {
            timerElement.className = 'mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-center';
        } else if (timeLeft <= 120) {
            timerElement.className = 'mb-4 p-3 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded-lg text-center';
        }
    }, 1000);
}

// Expire booking for inline receipt
async function expireInlineBooking() {
    alert('⏰ Waktu pembayaran habis! Booking telah dibatalkan otomatis.');
    window.location.href = '/';
}

// Process online payment for inline receipt
async function processInlineOnlinePayment(bookingId) {
    
    // Show loading state
    const payButton = document.getElementById('inline-pay-now-btn');
    const originalText = payButton.innerHTML;
    payButton.innerHTML = '<svg class="w-5 h-5 inline mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Memproses...';
    payButton.disabled = true;
    
    try {
        const response = await fetch(`/payment/create/${bookingId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }

        const result = await response.json();
        
        if (result.success) {
            
            // Validate snap token
            if (!result.snap_token) {
                throw new Error('Snap token tidak diterima dari server');
            }

            // Check if snap is available
            if (typeof snap === 'undefined') {
                throw new Error('Midtrans Snap tidak tersedia. Silakan refresh halaman.');
            }
            
            // Initialize Midtrans Snap
            snap.pay(result.snap_token, {
                onSuccess: function(result) {
                    alert('🎉 Pembayaran berhasil! Status booking telah diperbarui.');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                },
                onPending: function(result) {
                    alert('⏳ Pembayaran sedang diproses. Status akan diperbarui otomatis.');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                },
                onError: function(result) {
                    const errorMsg = result.status_message || result.message || 'Terjadi kesalahan dalam pembayaran';
                    alert('❌ Pembayaran gagal: ' + errorMsg);
                    payButton.innerHTML = originalText;
                    payButton.disabled = false;
                },
                onClose: function() {
                    alert('💡 Pembayaran dibatalkan. Anda dapat melanjutkan pembayaran kapan saja.');
                    payButton.innerHTML = originalText;
                    payButton.disabled = false;
                }
            });
        } else {
            alert('❌ ' + (result.message || 'Gagal membuat pembayaran.'));
            payButton.innerHTML = originalText;
            payButton.disabled = false;
        }
    } catch (error) {
        alert('Terjadi kesalahan saat memproses pembayaran.');
        payButton.innerHTML = originalText;
        payButton.disabled = false;
    }
}



// Download PDF for inline receipt
function downloadInlineReceiptPDF(bookingId) {
    
    // Create a temporary link to trigger download
    const link = document.createElement('a');
    link.href = '/booking-receipt/pdf/' + bookingId;
    link.download = 'struk-booking-' + String(bookingId).padStart(4, '0') + '.pdf';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// View PDF for inline receipt
function viewInlineReceiptPDF(bookingId) {
    window.open(`/pdf/receipt/${bookingId}/view`, '_blank');
}

// Update payment status in the receipt display
function updatePaymentStatus(status) {
    // Update payment method display
    const paymentMethodElement = document.querySelector('.font-semibold.text-blue-800');
    if (paymentMethodElement) {
        paymentMethodElement.textContent = 'Bayar Online';
    }
    
    // Update payment status display
    const paymentStatusElement = document.querySelector('.text-sm.text-blue-600');
    if (paymentStatusElement) {
        paymentStatusElement.textContent = status === 'paid' ? 'Sudah Dibayar' : 'Menunggu Pembayaran';
    }
    
    // Update status badge
    const statusBadge = document.querySelector('.inline-flex.items-center.px-4.py-2.rounded-full');
    const statusText = statusBadge?.querySelector('span');
    const statusDot = statusBadge?.querySelector('.w-3.h-3.rounded-full');
    
    if (statusBadge && statusText && statusDot) {
        if (status === 'paid') {
            // Change to green for paid status
            statusBadge.className = 'inline-flex items-center px-4 py-2 bg-green-100 border border-green-300 rounded-full';
            statusDot.className = 'w-3 h-3 bg-green-500 rounded-full mr-2';
            statusText.className = 'text-green-800 font-semibold';
            statusText.textContent = 'Sudah Dibayar';
        }
    }
}

// Show payment success message
function showPaymentSuccessMessage() {
    // Create success message element
    const successMessage = document.createElement('div');
    successMessage.className = 'mb-6 p-4 bg-green-50 border border-green-200 rounded-lg';
    successMessage.innerHTML = `
        <div class="flex items-center">
            <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <h4 class="font-bold text-green-800">Pembayaran Berhasil!</h4>
                <p class="text-green-700 text-sm">Booking Anda telah dikonfirmasi dan siap untuk dilayani.</p>
            </div>
        </div>
    `;
    
    // Insert after the status section
    const statusSection = document.querySelector('.text-center.mb-6');
    if (statusSection) {
        statusSection.parentNode.insertBefore(successMessage, statusSection.nextSibling);
    }
}

// Simulate payment success for inline receipt
async function simulateInlinePaymentSuccess(bookingId) {
    if (!confirm('Simulasi pembayaran berhasil?\n\nIni akan mengubah status booking menjadi "Sudah Dibayar".')) {
        return;
    }
    
    try {
        const response = await fetch(`/api/simulate-payment/${bookingId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status: 'success' })
        });
        
        const result = await response.json();
        
        if (result.success) {
            clearInterval(inlinePaymentTimer);
            alert('🎉 Simulasi pembayaran berhasil!\n\nStatus booking telah diubah menjadi "Sudah Dibayar".');
            
            // Update payment status in the receipt
            updatePaymentStatus('paid');
            
            // Hide payment section
            const paymentSection = document.getElementById('inline-payment-section');
            if (paymentSection) {
                paymentSection.style.display = 'none';
            }
            
            // Show success message in the receipt
            showPaymentSuccessMessage();
        } else {
            alert('❌ Error: ' + result.message);
        }
    } catch (error) {
        alert('❌ Error: ' + error.message);
    }
}

// Simulate payment cancel for inline receipt
async function simulateInlinePaymentCancel(bookingId) {
    if (!confirm('Simulasi pembayaran dibatalkan?\n\nIni akan menghapus booking dari database.')) {
        return;
    }
    
    try {
        const response = await fetch(`/api/simulate-payment/${bookingId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status: 'cancel' })
        });
        
        const result = await response.json();
        
        if (result.success) {
            clearInterval(inlinePaymentTimer);
            alert('❌ Simulasi pembayaran dibatalkan!\n\nBooking telah dihapus dari database.');
            window.location.href = '/';
        } else {
            alert('❌ Error: ' + result.message);
        }
    } catch (error) {
        alert('❌ Error: ' + error.message);
    }
}
</script>

<!-- Midtrans Snap Script -->
<script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
@endsection