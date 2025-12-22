<!-- Availability Checker Section -->
<div class="min-h-screen bg-gradient-to-br from-black via-gray-900 to-black text-white py-20">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 animate-fade-in-up">
                Cek Ketersediaan Booking
            </h1>
            <p class="text-xl opacity-90 max-w-2xl mx-auto animate-fade-in-up animation-delay-200">
                Lihat jadwal yang sudah terbooked pada tanggal tertentu
            </p>
        </div>

        <!-- Date Picker -->
        <div class="max-w-md mx-auto mb-8">
            <div class="bg-slate-800 rounded-xl p-6">
                <label for="check-date" class="block text-sm font-medium text-gray-300 mb-3">Pilih Tanggal</label>
                <input type="date" 
                       id="check-date" 
                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                       onchange="checkAvailability()">
                <button onclick="checkAvailability()" class="w-full mt-3 bg-yellow-400 text-black px-4 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition-colors">
                    Cek Ketersediaan
                </button>
                <p class="text-xs text-gray-400 mt-2">Pilih tanggal untuk melihat jam yang sudah terbooked</p>
            </div>
        </div>

        <!-- Loading State -->
        <div id="loading-availability" class="text-center hidden">
            <div class="inline-flex items-center px-4 py-2 bg-blue-500/20 border border-blue-500/30 rounded-lg">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-blue-400">Mengecek ketersediaan...</span>
            </div>
        </div>

        <!-- Results -->
        <div id="availability-results" class="max-w-4xl mx-auto">
            <!-- Default State -->
            <div id="default-state" class="text-center py-12">
                <div class="w-20 h-20 bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-300 mb-2">Pilih Tanggal</h3>
                <p class="text-gray-400">Pilih tanggal di atas untuk melihat ketersediaan booking</p>
            </div>

            <!-- No Bookings State -->
            <div id="no-bookings-state" class="text-center py-12 hidden">
                <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-green-400 mb-2">Semua Jam Tersedia</h3>
                <p class="text-gray-400 mb-6">Belum ada booking pada tanggal ini. Semua jam masih tersedia!</p>
                <button onclick="showAvailableTimeSlots()" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-xl font-semibold transition-colors">
                    Lihat Jam Tersedia & Booking
                </button>
            </div>

            <!-- Bookings Found State -->
            <div id="bookings-found-state" class="hidden">
                <div class="bg-slate-800 rounded-xl p-6 mb-6">
                    <h3 class="text-xl font-semibold text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 text-yellow-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Jam yang Sudah Terbooked
                    </h3>
                    <p class="text-gray-400 mb-6">Berikut jam-jam yang sudah ada booking pada tanggal ini:</p>
                    
                    <!-- Booked Times Grid -->
                    <div id="booked-times-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mb-6">
                        <!-- Will be populated by JavaScript -->
                    </div>

                    <div class="border-t border-slate-700 pt-4">
                        <p class="text-sm text-gray-400 mb-4">
                            💡 <strong>Tips:</strong> Jam yang tidak ditampilkan di atas masih tersedia untuk booking
                        </p>
                        <button onclick="showAvailableTimeSlots()" class="bg-yellow-500 hover:bg-yellow-600 text-black px-6 py-3 rounded-xl font-semibold transition-colors">
                            Lihat Jam Tersedia & Booking
                        </button>
                    </div>
                    
                    <!-- Available Time Slots Section -->
                    <div id="available-slots-section" class="hidden mt-6 border-t border-slate-700 pt-6">
                        <h4 class="text-lg font-semibold text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Jam Tersedia untuk Booking
                        </h4>
                        <div id="available-slots-loading" class="text-center py-4 hidden">
                            <div class="inline-flex items-center px-4 py-2 bg-blue-500/20 border border-blue-500/30 rounded-lg">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span class="text-blue-400">Memuat jam tersedia...</span>
                            </div>
                        </div>
                        <div id="available-slots-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center mt-12">
            <button data-navigate="home" class="inline-flex items-center text-gray-400 hover:text-white transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Home
            </button>
        </div>
    </div>
</div>

<script>
// Set minimum date to today
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('check-date');
    if (dateInput) {
        dateInput.min = new Date().toISOString().split('T')[0];
        // Set default to today
        dateInput.value = new Date().toISOString().split('T')[0];
    }
});

async function checkAvailability() {
    const dateInput = document.getElementById('check-date');
    const selectedDate = dateInput.value;
    
    if (!selectedDate) return;
    
    // Show loading
    showAvailabilityState('loading');
    
    try {
        const response = await fetch('/api/check-availability', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({ date: selectedDate })
        });
        
        const data = await response.json();
        
        if (data.success) {
            if (data.bookings.length === 0) {
                showAvailabilityState('no-bookings');
            } else {
                showAvailabilityState('bookings-found', data.bookings);
            }
        } else {
            showAvailabilityState('error');
        }
        
    } catch (error) {
        console.error('Error checking availability:', error);
        showAvailabilityState('error');
    }
}

function showAvailabilityState(state, bookings = []) {
    // Hide all states
    document.getElementById('default-state').classList.add('hidden');
    document.getElementById('no-bookings-state').classList.add('hidden');
    document.getElementById('bookings-found-state').classList.add('hidden');
    document.getElementById('loading-availability').classList.add('hidden');
    
    switch (state) {
        case 'loading':
            document.getElementById('loading-availability').classList.remove('hidden');
            break;
            
        case 'no-bookings':
            document.getElementById('no-bookings-state').classList.remove('hidden');
            break;
            
        case 'bookings-found':
            document.getElementById('bookings-found-state').classList.remove('hidden');
            populateBookedTimes(bookings);
            break;
            
        case 'error':
            // Show default state with error message
            document.getElementById('default-state').classList.remove('hidden');
            break;
            
        default:
            document.getElementById('default-state').classList.remove('hidden');
    }
}

function populateBookedTimes(bookings) {
    const grid = document.getElementById('booked-times-grid');
    grid.innerHTML = '';
    
    bookings.forEach(booking => {
        const timeCard = document.createElement('div');
        timeCard.className = 'bg-red-500/20 border border-red-500/30 rounded-lg p-3 text-center';
        timeCard.innerHTML = `
            <div class="flex items-center justify-center mb-2">
                <svg class="w-4 h-4 text-red-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-red-400 font-semibold">${booking.time}</span>
            </div>
            <div class="text-xs text-gray-400">${booking.barber_name}</div>
            <div class="text-xs text-red-300 mt-1">Terbooked</div>
        `;
        grid.appendChild(timeCard);
    });
}

// Auto-check availability when page loads if date is set
document.addEventListener('DOMContentLoaded', function() {
    // Small delay to ensure DOM is ready
    setTimeout(() => {
        const dateInput = document.getElementById('check-date');
        if (dateInput && dateInput.value) {
            checkAvailability();
        }
    }, 500);
});

// Show available time slots for booking
async function showAvailableTimeSlots() {
    const dateInput = document.getElementById('check-date');
    const selectedDate = dateInput.value;
    
    if (!selectedDate) {
        alert('Silakan pilih tanggal terlebih dahulu');
        return;
    }
    
    // Show the available slots section
    const slotsSection = document.getElementById('available-slots-section');
    const loadingDiv = document.getElementById('available-slots-loading');
    const slotsGrid = document.getElementById('available-slots-grid');
    
    slotsSection.classList.remove('hidden');
    loadingDiv.classList.remove('hidden');
    slotsGrid.innerHTML = '';
    
    try {
        // Get available barbers and time slots
        const response = await fetch('/api/available-slots', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({ date: selectedDate })
        });
        
        const data = await response.json();
        loadingDiv.classList.add('hidden');
        
        if (data.success && data.slots.length > 0) {
            populateAvailableSlots(data.slots, selectedDate);
        } else {
            slotsGrid.innerHTML = '<p class="text-gray-400 col-span-full text-center py-4">Tidak ada jam tersedia untuk tanggal ini.</p>';
        }
        
    } catch (error) {
        console.error('Error loading available slots:', error);
        loadingDiv.classList.add('hidden');
        slotsGrid.innerHTML = '<p class="text-red-400 col-span-full text-center py-4">Terjadi kesalahan saat memuat jam tersedia.</p>';
    }
}

// Populate available time slots
function populateAvailableSlots(slots, selectedDate) {
    const slotsGrid = document.getElementById('available-slots-grid');
    slotsGrid.innerHTML = '';
    
    slots.forEach(slot => {
        const slotCard = document.createElement('div');
        slotCard.className = 'bg-green-500/20 border border-green-500/30 rounded-lg p-3 text-center hover:bg-green-500/30 transition-colors cursor-pointer';
        slotCard.onclick = () => bookTimeSlot(selectedDate, slot.time, slot.barber_id, slot.barber_name);
        
        slotCard.innerHTML = `
            <div class="flex items-center justify-center mb-2">
                <svg class="w-4 h-4 text-green-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-green-400 font-semibold">${slot.time}</span>
            </div>
            <div class="text-xs text-gray-300">${slot.barber_name}</div>
            <div class="text-xs text-green-300 mt-1">Tersedia</div>
            <button class="mt-2 w-full bg-green-500 hover:bg-green-600 text-white text-xs py-1 px-2 rounded transition-colors">
                Booking
            </button>
        `;
        
        slotsGrid.appendChild(slotCard);
    });
}

// Book a specific time slot - redirect to booking with pre-filled data
function bookTimeSlot(date, time, barberId, barberName) {
    // Store booking data in sessionStorage
    const bookingData = {
        date: date,
        time: time,
        barber_id: barberId,
        barber_name: barberName,
        from_availability: true
    };
    
    sessionStorage.setItem('prefilledBookingData', JSON.stringify(bookingData));
    
    // Redirect to booking page
    window.location.href = '/booking';
}
</script>