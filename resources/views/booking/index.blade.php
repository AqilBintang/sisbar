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
                    <div id="step-4" class="hidden">
                        <h2 class="text-2xl font-bold text-white mb-6">4. Pilih Layanan</h2>
                        <div id="services-list" class="space-y-3 mb-6">
                            <!-- Services will be populated here -->
                        </div>
                    </div>

                    <!-- Step 5: Customer Information -->
                    <div id="step-5" class="hidden">
                        <h2 class="text-2xl font-bold text-white mb-6">5. Informasi Pelanggan</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="customer-name" class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap *</label>
                                <input type="text" id="customer-name" name="customer_name" required
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                                       placeholder="Masukkan nama lengkap"
                                       value="{{ auth()->user()->name }}">
                            </div>
                            <div>
                                <label for="customer-phone" class="block text-sm font-medium text-gray-300 mb-2">Nomor Telepon *</label>
                                <input type="tel" id="customer-phone" name="customer_phone" required
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                                       placeholder="08xxxxxxxxxx">
                            </div>
                            <div class="md:col-span-2">
                                <label for="customer-email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                                <input type="email" id="customer-email" name="customer_email"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                                       placeholder="email@example.com"
                                       value="{{ auth()->user()->email }}" readonly>
                                <p class="text-gray-400 text-xs mt-1">Email dari akun Google Anda</p>
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

// Initialize
document.getElementById('booking-date').min = new Date().toISOString().split('T')[0];

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
    
    // Load services
    loadServices();
    showStep(4);
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
    // Validate required fields in step 5
    const customerName = document.getElementById('customer-name').value;
    const customerPhone = document.getElementById('customer-phone').value;
    
    if (!customerName.trim()) {
        alert('Nama lengkap harus diisi');
        return;
    }
    
    if (!customerPhone.trim()) {
        alert('Nomor telepon harus diisi');
        return;
    }
    
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
    console.log('📊 Selected payment method:', selectedPaymentMethod);
    console.log('📊 Booking data:', bookingData);
    
    // Show loading state
    const submitButton = document.querySelector('button[type="submit"]');
    const originalText = submitButton.innerHTML;
    submitButton.innerHTML = 'Memproses...';
    submitButton.disabled = true;
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
    // Add selected data
    Object.assign(data, bookingData);
    
    console.log('📤 Final data to send:', data);
    
    try {
        console.log('🌐 Sending request to:', '{{ route("booking.store") }}');
        
        const response = await fetch('{{ route("booking.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });

        console.log('📡 Response status:', response.status);
        
        // Get response text first to see what we're getting
        const responseText = await response.text();
        console.log('📄 Raw response:', responseText);
        
        // Try to parse as JSON
        let result;
        try {
            result = JSON.parse(responseText);
            console.log('✅ Parsed JSON response:', result);
        } catch (parseError) {
            console.error('❌ Failed to parse JSON:', parseError);
            console.log('📄 Response was:', responseText);
            
            // Check if it's an HTML response (redirect)
            if (responseText.includes('<html') || responseText.includes('<!DOCTYPE')) {
                console.log('🔄 Received HTML response - likely a redirect');
                alert('Terjadi redirect. Silakan coba lagi.');
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
                return;
            }
            
            throw new Error('Invalid JSON response');
        }
        
        if (result.success) {
            console.log('✅ Booking successful!');
            
            // Store booking data in localStorage for receipt page
            localStorage.setItem('lastBooking', JSON.stringify(result.booking));
            
            // Show success message
            alert('✅ Booking berhasil! Struk akan ditampilkan...');
            
            // Instead of redirect, show receipt inline
            showBookingReceipt(result.booking, result.booking_id);
        } else {
            console.error('❌ Booking failed:', result.message);
            alert(result.message || 'Terjadi kesalahan saat membuat booking.');
            submitButton.innerHTML = originalText;
            submitButton.disabled = false;
        }
    } catch (error) {
        console.error('💥 Error:', error);
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
                <p class="text-gray-600">Telp: +62 812-3456-7890</p>
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
                            <p class="font-semibold text-blue-800">${booking.payment_method === 'online' ? 'Bayar Online' : 'Bayar Tunai'}</p>
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

        <!-- Action Buttons -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            <a href="/booking-receipt?booking_id=${bookingId}" target="_blank"
               class="px-6 py-4 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl transition-all text-center">
                📄 Buka Struk Lengkap
            </a>
            <a href="/booking" 
               class="px-6 py-4 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-xl transition-all text-center">
                🔄 Booking Lagi
            </a>
            <a href="/" 
               class="px-6 py-4 bg-slate-600 hover:bg-slate-500 text-white font-bold rounded-xl transition-all text-center">
                🏠 Kembali ke Beranda
            </a>
        </div>
    `;
    
    // Insert receipt after the main container
    document.querySelector('.container.mx-auto').appendChild(receiptContainer);
    
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
</script>
@endsection