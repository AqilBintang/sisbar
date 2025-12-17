@extends('layouts.app')

@section('title', 'Struk Booking - Sisbar Hairstudio')

@section('content')
<div class="min-h-screen bg-black pt-20">
    <!-- Background Image with Dark Overlay -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/bg-barber.jpg') }}');">
        <div class="absolute inset-0 bg-black/80"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 py-20">
        <div class="max-w-2xl mx-auto">
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
                    <div class="w-24 h-1 bg-linear-to-r from-yellow-400 to-yellow-600 rounded-full"></div>
                </div>
            </div>

            <!-- Receipt Card -->
            <div id="receipt-card" class="bg-white rounded-3xl shadow-2xl p-8 mb-8 text-black">
                <!-- Header -->
                <div class="text-center border-b-2 border-dashed border-gray-300 pb-6 mb-6">
                    <div class="flex items-center justify-center mb-4">
                        <img src="{{ asset('images/logo-sisbar.png') }}" alt="Sisbar Hairstudio" class="h-12 w-auto object-contain mr-3" 
                             onerror="this.style.display='none';">
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
                            <p class="font-bold text-lg" id="receipt-booking-id">#0000</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-600">Tanggal Booking:</p>
                            <p class="font-semibold" id="receipt-date">-</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Waktu:</p>
                            <p class="font-semibold" id="receipt-time">-</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Nama Pelanggan:</p>
                            <p class="font-semibold" id="receipt-customer">-</p>
                        </div>
                        <div>
                            <p class="text-gray-600">No. Telepon:</p>
                            <p class="font-semibold" id="receipt-phone">-</p>
                        </div>
                    </div>
                </div>

                <!-- Service Details -->
                <div class="border-t border-gray-200 pt-4 mb-6">
                    <h4 class="font-bold text-gray-800 mb-3">Detail Layanan</h4>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-semibold" id="receipt-service">-</p>
                                <p class="text-sm text-gray-600">Kapster: <span id="receipt-barber">-</span></p>
                                <p class="text-sm text-gray-600">Durasi: <span id="receipt-duration">-</span> menit</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-lg" id="receipt-price">Rp 0</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total -->
                <div class="border-t-2 border-dashed border-gray-300 pt-4 mb-6">
                    <div class="flex justify-between items-center">
                        <p class="text-xl font-bold text-gray-800">TOTAL PEMBAYARAN</p>
                        <p class="text-2xl font-bold text-green-600" id="receipt-total">Rp 0</p>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="border-t border-gray-200 pt-4 mb-4">
                    <h4 class="font-bold text-gray-800 mb-3">Metode Pembayaran</h4>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-blue-800" id="receipt-payment-method">-</p>
                                <p class="text-sm text-blue-600" id="receipt-payment-status">-</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="text-center mb-6">
                    <div id="receipt-status-badge" class="inline-flex items-center px-4 py-2 bg-yellow-100 border border-yellow-300 rounded-full">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                        <span class="text-yellow-800 font-semibold" id="receipt-status-text">Menunggu Konfirmasi</span>
                    </div>
                </div>

                <!-- Notes -->
                <div id="receipt-notes-section" class="hidden mb-6">
                    <h4 class="font-bold text-gray-800 mb-2">Catatan</h4>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                        <p class="text-blue-800" id="receipt-notes">-</p>
                    </div>
                </div>

                <!-- Important Instructions in Receipt -->
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
                    <p class="text-xs">Dicetak pada: <span id="receipt-print-time">-</span></p>
                </div>
            </div>

            <!-- Important Instructions -->
            <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-6 mb-8">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-red-600 font-bold text-lg">Instruksi Penting</h3>
                        <p class="text-red-700 text-sm">Harap baca dengan teliti</p>
                    </div>
                </div>
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <p class="text-red-800 font-semibold mb-2">📋 Petunjuk Kedatangan:</p>
                    <ul class="text-red-800 text-sm space-y-2">
                        <li class="flex items-start">
                            <span class="text-red-600 mr-2">•</span>
                            <span><strong>Berikan struk ini kepada kasir setengah jam (30 menit) sebelum waktu booking Anda</strong></span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-red-600 mr-2">•</span>
                            <span><strong>Jika terlambat lebih dari 10 menit dari waktu booking, maka akan diundur ke 1 pesanan selanjutnya</strong></span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-red-600 mr-2">•</span>
                            <span>Pastikan Anda membawa struk ini dalam bentuk cetak atau PDF</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-6">
                <!-- Payment Section (for online payment) -->
                <div id="payment-section" class="hidden">
                    <div class="bg-blue-500/10 border border-blue-500/30 rounded-xl p-6">
                        <div class="text-center mb-4">
                            <h3 class="text-blue-400 font-bold text-lg mb-2">💳 Pembayaran Online</h3>
                            <p class="text-gray-300 text-sm">
                                Silakan lakukan pembayaran untuk mengkonfirmasi booking Anda
                            </p>
                        </div>
                        
                        <!-- Payment Timer -->
                        <div id="payment-timer" class="mb-4 p-3 bg-orange-100 border border-orange-400 text-orange-700 rounded-lg text-center">
                            <div class="font-bold">⏰ Waktu Pembayaran Tersisa</div>
                            <div id="countdown" class="text-2xl font-mono">05:00</div>
                            <div class="text-sm">Booking akan otomatis dibatalkan jika tidak dibayar</div>
                        </div>
                        
                        <!-- Payment Buttons -->
                        <div class="space-y-3">
                            <button onclick="processOnlinePayment()" 
                                    id="pay-now-btn"
                                    class="w-full px-8 py-4 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-xl transition-all transform hover:scale-105 shadow-lg">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                💳 Bayar Sekarang
                            </button>
                            
                            <!-- Test Payment Buttons -->
                            <div class="grid grid-cols-2 gap-3">
                                <button onclick="simulatePaymentSuccess()" 
                                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg transition-colors">
                                    ✅ Test: Sudah Bayar
                                </button>
                                <button onclick="simulatePaymentCancel()" 
                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-4 rounded-lg transition-colors">
                                    ❌ Test: Tidak Bayar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Action Buttons -->
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                    <!-- Download PDF -->
                    <button onclick="downloadReceiptPDF()" 
                            class="group px-4 py-4 bg-red-500 hover:bg-red-600 text-white font-bold rounded-xl transition-all transform hover:scale-105 shadow-lg">
                        <div class="flex flex-col items-center">
                            <svg class="w-6 h-6 mb-2 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="text-xs">Download PDF</span>
                        </div>
                    </button>
                    
                    <!-- View PDF -->
                    <button onclick="viewReceiptPDF()" 
                            class="group px-4 py-4 bg-purple-500 hover:bg-purple-600 text-white font-bold rounded-xl transition-all transform hover:scale-105 shadow-lg">
                        <div class="flex flex-col items-center">
                            <svg class="w-6 h-6 mb-2 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <span class="text-xs">View PDF</span>
                        </div>
                    </button>
                    
                    <!-- Print Receipt -->
                    <button onclick="window.print()" 
                            class="group px-4 py-4 bg-gray-500 hover:bg-gray-600 text-white font-bold rounded-xl transition-all transform hover:scale-105 shadow-lg">
                        <div class="flex flex-col items-center">
                            <svg class="w-6 h-6 mb-2 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                            <span class="text-xs">Print</span>
                        </div>
                    </button>
                    
                    <!-- WhatsApp Contact -->
                    <a href="https://wa.me/6285729421875" target="_blank"
                       class="group px-6 py-4 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl transition-all transform hover:scale-105 shadow-lg text-center">
                        <div class="flex flex-col items-center">
                            <svg class="w-8 h-8 mb-2 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-sm">WhatsApp</span>
                            <span class="text-xs opacity-75">Bantuan</span>
                        </div>
                    </a>
                    
                    <!-- Booking Lagi -->
                    <a href="/booking" 
                       class="group px-6 py-4 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-xl transition-all transform hover:scale-105 shadow-lg text-center">
                        <div class="flex flex-col items-center">
                            <svg class="w-8 h-8 mb-2 group-hover:animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="text-sm">Booking</span>
                            <span class="text-xs opacity-75">Lagi</span>
                        </div>
                    </a>
                    
                    <!-- Kembali ke Beranda -->
                    <a href="/" 
                       class="group px-6 py-4 bg-slate-600 hover:bg-slate-500 text-white font-bold rounded-xl transition-all transform hover:scale-105 shadow-lg text-center">
                        <div class="flex flex-col items-center">
                            <svg class="w-8 h-8 mb-2 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span class="text-sm">Kembali</span>
                            <span class="text-xs opacity-75">ke Beranda</span>
                        </div>
                    </a>
                </div>


            </div>

            <!-- Contact Info -->
            <div class="bg-slate-800 rounded-3xl shadow-2xl p-6 mt-8">
                <h3 class="text-xl font-bold text-white mb-4 text-center">Informasi Kontak</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h4 class="text-white font-semibold">WhatsApp</h4>
                        <p class="text-gray-300">+62 812-3456-7890</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-white font-semibold">Alamat</h4>
                        <p class="text-gray-300">Jl. Raya Barbershop No. 123</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Simple logging system
window.bookingDebug = {
    logs: [],
    addLog: function(message) {
        this.logs.push(new Date().toISOString() + ': ' + message);
        console.log(message);
    }
};

// Main initialization
document.addEventListener('DOMContentLoaded', function() {
    window.bookingDebug.addLog('DOM Content Loaded');
    loadBookingData();
});

// Load booking data from API
function loadBookingData() {
    const urlParams = new URLSearchParams(window.location.search);
    const bookingId = urlParams.get('booking_id');
    
    window.bookingDebug.addLog('Loading booking data for ID: ' + bookingId);
    
    if (bookingId) {
        showLoadingState();
        
        window.bookingDebug.addLog('Fetching from server: /booking-detail/' + bookingId);
        
        fetch('/booking-detail/' + bookingId, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            window.bookingDebug.addLog('Response status: ' + response.status);
            if (!response.ok) {
                throw new Error('HTTP error! status: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            window.bookingDebug.addLog('Server response received');
            window.bookingDebug.addLog('Response data: ' + JSON.stringify(data));
            hideLoadingState();
            
            if (data.success && data.booking) {
                window.bookingDebug.addLog('Data loaded successfully from server');
                displayBookingData(data.booking);
            } else {
                window.bookingDebug.addLog('Server response failed, trying localStorage');
                loadFromLocalStorage();
            }
        })
        .catch(error => {
            window.bookingDebug.addLog('Error fetching booking: ' + error.message);
            hideLoadingState();
            loadFromLocalStorage();
        });
    } else {
        window.bookingDebug.addLog('No booking ID in URL, trying localStorage');
        loadFromLocalStorage();
    }
}

// Show loading state
function showLoadingState() {
    window.bookingDebug.addLog('Showing loading state');
    const elements = [
        'receipt-booking-id', 'receipt-date', 'receipt-time', 
        'receipt-customer', 'receipt-phone', 'receipt-service',
        'receipt-barber', 'receipt-duration', 'receipt-price', 'receipt-total'
    ];
    
    elements.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.textContent = 'Memuat...';
        }
    });
}

// Hide loading state
function hideLoadingState() {
    window.bookingDebug.addLog('Hiding loading state');
}

// Load from localStorage fallback
function loadFromLocalStorage() {
    const bookingData = localStorage.getItem('lastBooking');
    if (bookingData) {
        try {
            const booking = JSON.parse(bookingData);
            console.log('Loading data from localStorage:', booking);
            displayBookingData(booking);
            localStorage.removeItem('lastBooking');
        } catch (error) {
            console.error('Error parsing localStorage data:', error);
            showErrorMessage();
        }
    } else {
        console.log('No data found in localStorage');
        showErrorMessage();
    }
}

// Show error message
function showErrorMessage() {
    const receiptCard = document.getElementById('receipt-card');
    if (receiptCard) {
        receiptCard.innerHTML = `
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Data Booking Tidak Ditemukan</h3>
                <p class="text-gray-600 mb-6">Maaf, data booking tidak dapat dimuat. Silakan coba lagi atau hubungi customer service.</p>
                <div class="space-y-3">
                    <a href="/booking" class="inline-block px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-xl transition-colors">
                        Buat Booking Baru
                    </a>
                    <br>
                    <a href="/" class="inline-block px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-bold rounded-xl transition-colors">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        `;
    }
}



// Display booking data
function displayBookingData(booking) {
    window.bookingDebug.addLog('Displaying booking data: ' + JSON.stringify(booking));
    
    try {
        // Booking ID
        const bookingIdElement = document.getElementById('receipt-booking-id');
        if (bookingIdElement) {
            const bookingIdText = '#' + String(booking.id || '0000').padStart(4, '0');
            bookingIdElement.textContent = bookingIdText;
            window.bookingDebug.addLog('Set booking ID: ' + bookingIdText);
        }
        
        // Date
        const dateElement = document.getElementById('receipt-date');
        if (dateElement) {
            const dateText = booking.date || formatDate(booking.booking_date) || '-';
            dateElement.textContent = dateText;
            window.bookingDebug.addLog('Set date: ' + dateText);
        }
        
        // Time
        const timeElement = document.getElementById('receipt-time');
        if (timeElement) {
            const timeText = booking.time || formatTime(booking.booking_time) || '-';
            timeElement.textContent = timeText;
            window.bookingDebug.addLog('Set time: ' + timeText);
        }
        
        // Customer
        const customerElement = document.getElementById('receipt-customer');
        if (customerElement) {
            const customerText = booking.customer_name || '-';
            customerElement.textContent = customerText;
            window.bookingDebug.addLog('Set customer: ' + customerText);
        }
        
        // Phone
        const phoneElement = document.getElementById('receipt-phone');
        if (phoneElement) {
            const phoneText = booking.customer_phone || '-';
            phoneElement.textContent = phoneText;
            window.bookingDebug.addLog('Set phone: ' + phoneText);
        }
        
        // Service
        const serviceElement = document.getElementById('receipt-service');
        if (serviceElement) {
            const serviceText = booking.service_name || (booking.service && booking.service.name) || '-';
            serviceElement.textContent = serviceText;
            window.bookingDebug.addLog('Set service: ' + serviceText);
        }
        
        // Barber
        const barberElement = document.getElementById('receipt-barber');
        if (barberElement) {
            const barberText = booking.barber_name || (booking.barber && booking.barber.name) || '-';
            barberElement.textContent = barberText;
            window.bookingDebug.addLog('Set barber: ' + barberText);
        }
        
        // Duration
        const durationElement = document.getElementById('receipt-duration');
        if (durationElement) {
            const durationText = (booking.service && booking.service.duration) || '30';
            durationElement.textContent = durationText;
            window.bookingDebug.addLog('Set duration: ' + durationText);
        }
        
        // Price
        const price = parseFloat(booking.total_price) || 0;
        const formattedPrice = 'Rp ' + price.toLocaleString('id-ID');
        
        const priceElement = document.getElementById('receipt-price');
        if (priceElement) {
            priceElement.textContent = formattedPrice;
            window.bookingDebug.addLog('Set price: ' + formattedPrice);
        }
        
        const totalElement = document.getElementById('receipt-total');
        if (totalElement) {
            totalElement.textContent = formattedPrice;
            window.bookingDebug.addLog('Set total: ' + formattedPrice);
        }
        
        // Payment method
        const paymentMethodElement = document.getElementById('receipt-payment-method');
        if (paymentMethodElement) {
            const paymentMethodText = booking.payment_method || 'Tunai';
            paymentMethodElement.textContent = paymentMethodText;
            window.bookingDebug.addLog('Set payment method: ' + paymentMethodText);
        }
        
        // Payment status
        const paymentStatusElement = document.getElementById('receipt-payment-status');
        if (paymentStatusElement) {
            const paymentStatusText = booking.payment_status || 'Menunggu Pembayaran';
            paymentStatusElement.textContent = paymentStatusText;
            window.bookingDebug.addLog('Set payment status: ' + paymentStatusText);
        }
        
        // Status badge
        const statusText = booking.status || 'Menunggu Konfirmasi';
        updateStatusBadge(statusText, booking.payment_status || 'pending');
        
        // Notes
        if (booking.notes && booking.notes.trim()) {
            const notesElement = document.getElementById('receipt-notes');
            const notesSectionElement = document.getElementById('receipt-notes-section');
            if (notesElement && notesSectionElement) {
                notesElement.textContent = booking.notes;
                notesSectionElement.classList.remove('hidden');
                window.bookingDebug.addLog('Set notes: ' + booking.notes);
            }
        }
        
        // Print time
        const printTimeElement = document.getElementById('receipt-print-time');
        if (printTimeElement) {
            const printTime = new Date().toLocaleString('id-ID');
            printTimeElement.textContent = printTime;
            window.bookingDebug.addLog('Set print time: ' + printTime);
        }
        
        // Debug payment method and status
        window.bookingDebug.addLog('Payment method: ' + booking.payment_method);
        window.bookingDebug.addLog('Payment status: ' + booking.payment_status);
        

        
        // Show payment section if online payment and pending
        const isOnlinePayment = booking.payment_method === 'online' || booking.payment_method === 'Online Payment';
        const isPending = booking.payment_status === 'pending' || booking.payment_status === 'Menunggu Pembayaran';
        
        if (isOnlinePayment && isPending) {
            const paymentSection = document.getElementById('payment-section');
            if (paymentSection) {
                paymentSection.classList.remove('hidden');
                window.bookingDebug.addLog('Payment section shown for online payment');
            }
        } else {
            window.bookingDebug.addLog('Payment section NOT shown. Method: ' + booking.payment_method + ', Status: ' + booking.payment_status);
            
            // For testing: show payment section anyway if method is online (regardless of status)
            if (isOnlinePayment) {
                const paymentSection = document.getElementById('payment-section');
                if (paymentSection) {
                    paymentSection.classList.remove('hidden');
                    window.bookingDebug.addLog('Payment section shown for testing (online method detected)');
                }
            }
        }
        
        // Store current booking data globally
        currentBookingData = booking;
        
        // Start payment timer if online payment and has expires_at
        if (isOnlinePayment && isPending && booking.payment_expires_at) {
            startPaymentTimer(booking.payment_expires_at);
        }
        
        window.bookingDebug.addLog('Data populated successfully');
        
    } catch (error) {
        window.bookingDebug.addLog('Error displaying booking data: ' + error.message);
        showErrorMessage();
    }
}

// Update status badge
function updateStatusBadge(status, paymentStatus) {
    const statusBadge = document.getElementById('receipt-status-badge');
    const statusText = document.getElementById('receipt-status-text');
    
    if (!statusBadge || !statusText) return;
    
    statusBadge.className = 'inline-flex items-center px-4 py-2 rounded-full';
    statusText.textContent = status;
    
    if (status.includes('Dikonfirmasi') && status.includes('Dibayar')) {
        statusBadge.classList.add('bg-green-100', 'border', 'border-green-300');
        const dot = statusBadge.querySelector('.w-3');
        if (dot) dot.className = 'w-3 h-3 bg-green-500 rounded-full mr-2';
        statusText.className = 'text-green-800 font-semibold';
    } else if (status.includes('Dikonfirmasi')) {
        statusBadge.classList.add('bg-blue-100', 'border', 'border-blue-300');
        const dot = statusBadge.querySelector('.w-3');
        if (dot) dot.className = 'w-3 h-3 bg-blue-500 rounded-full mr-2';
        statusText.className = 'text-blue-800 font-semibold';
    } else if (status.includes('Dibayar')) {
        statusBadge.classList.add('bg-purple-100', 'border', 'border-purple-300');
        const dot = statusBadge.querySelector('.w-3');
        if (dot) dot.className = 'w-3 h-3 bg-purple-500 rounded-full mr-2';
        statusText.className = 'text-purple-800 font-semibold';
    } else {
        statusBadge.classList.add('bg-yellow-100', 'border', 'border-yellow-300');
        const dot = statusBadge.querySelector('.w-3');
        if (dot) dot.className = 'w-3 h-3 bg-yellow-500 rounded-full mr-2';
        statusText.className = 'text-yellow-800 font-semibold';
    }
}

// Format date
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

// Format time
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

// Download PDF
function downloadReceiptPDF() {
    const bookingIdElement = document.getElementById('receipt-booking-id');
    if (!bookingIdElement || bookingIdElement.textContent === '#0000' || bookingIdElement.textContent === 'Memuat...') {
        alert('Data booking sedang dimuat. Silakan tunggu sebentar dan coba lagi.');
        return;
    }
    
    const idText = bookingIdElement.textContent.replace('#', '').trim();
    const bookingId = parseInt(idText, 10);
    
    if (isNaN(bookingId) || bookingId <= 0) {
        alert('ID booking tidak valid. Silakan refresh halaman dan coba lagi.');
        return;
    }
    
    window.bookingDebug.addLog('Downloading PDF for booking ID: ' + bookingId);
    
    // Show loading state
    const downloadButton = event.target;
    const originalText = downloadButton.innerHTML;
    downloadButton.innerHTML = '<svg class="w-5 h-5 inline mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Membuat PDF...';
    downloadButton.disabled = true;
    
    // Create a temporary link to trigger download
    const link = document.createElement('a');
    link.href = '/booking-receipt/pdf/' + bookingId;
    link.download = 'struk-booking-' + String(bookingId).padStart(4, '0') + '.pdf';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    // Reset button after a delay
    setTimeout(() => {
        downloadButton.innerHTML = originalText;
        downloadButton.disabled = false;
    }, 2000);
}

// Process online payment
async function processOnlinePayment() {
    const bookingIdElement = document.getElementById('receipt-booking-id');
    if (!bookingIdElement || bookingIdElement.textContent === '#0000' || bookingIdElement.textContent === 'Memuat...') {
        alert('Data booking sedang dimuat. Silakan tunggu sebentar dan coba lagi.');
        return;
    }
    
    const idText = bookingIdElement.textContent.replace('#', '').trim();
    const bookingId = parseInt(idText, 10);
    
    if (isNaN(bookingId) || bookingId <= 0) {
        alert('ID booking tidak valid. Silakan refresh halaman dan coba lagi.');
        return;
    }
    
    window.bookingDebug.addLog('Processing online payment for booking ID: ' + bookingId);
    
    // Show loading state
    const payButton = document.getElementById('pay-now-btn');
    const originalText = payButton.innerHTML;
    payButton.innerHTML = '<svg class="w-5 h-5 inline mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Memproses...';
    payButton.disabled = true;
    
    try {
        const response = await fetch(`/payment/create/${bookingId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }

        const result = await response.json();
        
        if (result.success) {
            window.bookingDebug.addLog('Payment token received, opening Midtrans');
            window.bookingDebug.addLog('Environment: ' + (result.is_production ? 'Production' : 'Sandbox'));
            
            // Validate snap token
            if (!result.snap_token) {
                throw new Error('Snap token tidak diterima dari server');
            }

            // Check if snap is available
            if (typeof snap === 'undefined') {
                throw new Error('Midtrans Snap tidak tersedia. Silakan refresh halaman.');
            }
            
            // Initialize Midtrans Snap with enhanced options
            snap.pay(result.snap_token, {
                // Callbacks
                onSuccess: function(result) {
                    window.bookingDebug.addLog('Payment success: ' + JSON.stringify(result));
                    alert('🎉 Pembayaran berhasil! Status booking telah diperbarui.');
                    // Refresh booking data instead of full page reload
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                },
                onPending: function(result) {
                    window.bookingDebug.addLog('Payment pending: ' + JSON.stringify(result));
                    alert('⏳ Pembayaran sedang diproses. Status akan diperbarui otomatis.');
                    // Refresh booking data instead of full page reload
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                },
                onError: function(result) {
                    window.bookingDebug.addLog('Payment error: ' + JSON.stringify(result));
                    const errorMsg = result.status_message || result.message || 'Terjadi kesalahan dalam pembayaran';
                    alert('❌ Pembayaran gagal: ' + errorMsg);
                    payButton.innerHTML = originalText;
                    payButton.disabled = false;
                },
                onClose: function() {
                    window.bookingDebug.addLog('Payment popup closed by user');
                    alert('💡 Pembayaran dibatalkan. Anda dapat melanjutkan pembayaran kapan saja.');
                    payButton.innerHTML = originalText;
                    payButton.disabled = false;
                }
            });
        } else {
            window.bookingDebug.addLog('Payment creation failed: ' + result.message);
            alert('❌ ' + (result.message || 'Gagal membuat pembayaran.'));
            payButton.innerHTML = originalText;
            payButton.disabled = false;
        }
    } catch (error) {
        window.bookingDebug.addLog('Payment error: ' + error.message);
        alert('Terjadi kesalahan saat memproses pembayaran.');
        payButton.innerHTML = originalText;
        payButton.disabled = false;
    }
}

// Payment timer variables
let paymentTimer;
let currentBookingData = null;

// Start countdown timer
function startPaymentTimer(expiresAt) {
    if (!expiresAt) return;
    
    const countdownElement = document.getElementById('countdown');
    if (!countdownElement) return;
    
    const expiryDate = new Date(expiresAt);
    
    paymentTimer = setInterval(function() {
        const now = new Date();
        const timeLeft = Math.max(0, Math.floor((expiryDate - now) / 1000));
        
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        
        countdownElement.textContent = 
            `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        
        if (timeLeft <= 0) {
            clearInterval(paymentTimer);
            expireBooking();
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

// Expire booking
async function expireBooking() {
    if (!currentBookingData) return;
    
    try {
        const response = await fetch(`/api/expire-booking/${currentBookingData.id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('⏰ Waktu pembayaran habis! Booking telah dibatalkan otomatis.');
            window.location.href = '/';
        }
    } catch (error) {
        console.error('Error expiring booking:', error);
    }
}

// Simulate payment success
async function simulatePaymentSuccess() {
    if (!currentBookingData) {
        alert('Data booking belum dimuat');
        return;
    }
    
    if (!confirm('Simulasi pembayaran berhasil?\n\nIni akan mengubah status booking menjadi "Paid".')) {
        return;
    }
    
    try {
        const response = await fetch(`/api/simulate-payment/${currentBookingData.id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({ status: 'success' })
        });
        
        const result = await response.json();
        
        if (result.success) {
            clearInterval(paymentTimer);
            alert('🎉 Simulasi pembayaran berhasil!\n\nStatus booking telah diubah menjadi "Paid".');
            loadBookingData(); // Reload data
        } else {
            alert('❌ Error: ' + result.message);
        }
    } catch (error) {
        alert('❌ Error: ' + error.message);
    }
}

// Simulate payment cancel
async function simulatePaymentCancel() {
    if (!currentBookingData) {
        alert('Data booking belum dimuat');
        return;
    }
    
    if (!confirm('Simulasi pembayaran dibatalkan?\n\nIni akan menghapus booking dari database.')) {
        return;
    }
    
    try {
        const response = await fetch(`/api/simulate-payment/${currentBookingData.id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({ status: 'cancel' })
        });
        
        const result = await response.json();
        
        if (result.success) {
            clearInterval(paymentTimer);
            alert('❌ Simulasi pembayaran dibatalkan!\n\nBooking telah dihapus dari database.');
            window.location.href = '/';
        } else {
            alert('❌ Error: ' + result.message);
        }
    } catch (error) {
        alert('❌ Error: ' + error.message);
    }
}

// Download PDF
function downloadReceiptPDF() {
    if (!currentBookingData) {
        alert('Data booking belum dimuat');
        return;
    }
    
    window.location.href = `/pdf/receipt/${currentBookingData.id}/download`;
}

// View PDF
function viewReceiptPDF() {
    if (!currentBookingData) {
        alert('Data booking belum dimuat');
        return;
    }
    
    window.open(`/pdf/receipt/${currentBookingData.id}/view`, '_blank');
}



</script>

<!-- Midtrans Snap Script -->
<script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
@endsection
