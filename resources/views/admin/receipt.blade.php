@extends('layouts.admin')

@section('title', 'Struk Booking #' . $booking->id)

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Struk Booking #{{ $booking->id }}</h1>
                <p class="text-gray-600">Detail lengkap booking pelanggan</p>
            </div>
            <div class="flex space-x-3">
                <button onclick="printReceipt()" 
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Cetak Struk
                </button>
                <button onclick="downloadPDF()" 
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Download PDF
                </button>
                <a href="{{ route('admin.bookings') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Receipt Card -->
    <div class="bg-white rounded-lg shadow">
        <div id="receipt-content" class="p-8">
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
                <p class="text-gray-600">Telp: +62 815-7279-4699</p>
            </div>

            <!-- Receipt Details -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">STRUK BOOKING</h3>
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Booking ID</p>
                        <p class="font-bold text-lg">#{{ $booking->id }}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-600">Tanggal Booking:</p>
                        <p class="font-semibold">{{ $booking->formatted_date }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Waktu:</p>
                        <p class="font-semibold">{{ $booking->formatted_time }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Nama Pelanggan:</p>
                        <p class="font-semibold">{{ $booking->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">No. Telepon:</p>
                        <p class="font-semibold">{{ $booking->customer_phone }}</p>
                    </div>
                    @if($booking->customer_email)
                    <div class="col-span-2">
                        <p class="text-gray-600">Email:</p>
                        <p class="font-semibold">{{ $booking->customer_email }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Service Details -->
            <div class="border-t border-gray-200 pt-4 mb-6">
                <h4 class="font-bold text-gray-800 mb-3">Detail Layanan</h4>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="font-semibold">{{ $booking->service->name }}</p>
                            <p class="text-sm text-gray-600">Kapster: {{ $booking->barber->name }} ({{ $booking->barber->level_display }})</p>
                            <p class="text-sm text-gray-600">Durasi: {{ $booking->service->duration }} menit</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-lg">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total -->
            <div class="border-t-2 border-dashed border-gray-300 pt-4 mb-6">
                <div class="flex justify-between items-center">
                    <p class="text-xl font-bold text-gray-800">TOTAL PEMBAYARAN</p>
                    <p class="text-2xl font-bold text-green-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="border-t border-gray-200 pt-4 mb-4">
                <h4 class="font-bold text-gray-800 mb-3">Metode Pembayaran</h4>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-blue-800">{{ $booking->payment_method_display }}</p>
                            <p class="text-sm text-blue-600">{{ $booking->payment_status_display }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="text-center mb-6">
                <span class="inline-flex items-center px-4 py-2 rounded-full
                    @if($booking->status === 'pending') bg-yellow-100 border border-yellow-300
                    @elseif($booking->status === 'confirmed') bg-blue-100 border border-blue-300
                    @elseif($booking->status === 'completed') bg-green-100 border border-green-300
                    @else bg-red-100 border border-red-300 @endif">
                    <div class="w-3 h-3 rounded-full mr-2
                        @if($booking->status === 'pending') bg-yellow-500
                        @elseif($booking->status === 'confirmed') bg-blue-500
                        @elseif($booking->status === 'completed') bg-green-500
                        @else bg-red-500 @endif"></div>
                    <span class="font-semibold
                        @if($booking->status === 'pending') text-yellow-800
                        @elseif($booking->status === 'confirmed') text-blue-800
                        @elseif($booking->status === 'completed') text-green-800
                        @else text-red-800 @endif">{{ $booking->status_display }}</span>
                </span>
            </div>

            <!-- Notes -->
            @if($booking->notes)
            <div class="mb-6">
                <h4 class="font-bold text-gray-800 mb-2">Catatan</h4>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                    <p class="text-blue-800">{{ $booking->notes }}</p>
                </div>
            </div>
            @endif

            <!-- Admin Info -->
            <div class="border-t border-gray-200 pt-4 mb-4">
                <h4 class="font-bold text-gray-800 mb-3">Informasi Admin</h4>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-600">Dibuat pada:</p>
                        <p class="font-semibold">{{ $booking->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Terakhir diupdate:</p>
                        <p class="font-semibold">{{ $booking->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="border-t border-gray-200 pt-4 text-center text-sm text-gray-600">
                <p class="mb-2">Terima kasih atas kepercayaan Anda!</p>
                <p class="mb-2">Sisbar Hairstudio - Premium Men's Grooming</p>
                <p class="text-xs">Dicetak pada: {{ now()->format('d M Y H:i') }}</p>
            </div>
        </div>
    </div>

    <!-- Status Update Section -->
    @if($booking->status !== 'completed' && $booking->status !== 'cancelled')
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Update Status Booking</h3>
        <div class="flex space-x-3">
            @if($booking->status === 'pending')
                <button onclick="updateStatus('confirmed')" 
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                    Konfirmasi Booking
                </button>
                <button onclick="updateStatus('cancelled')" 
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                    Tolak Booking
                </button>
            @elseif($booking->status === 'confirmed')
                <button onclick="updateStatus('completed')" 
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                    Selesaikan Booking
                </button>
                <button onclick="updateStatus('cancelled')" 
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                    Batalkan Booking
                </button>
            @endif
        </div>
    </div>
    @endif
</div>

<script>
function printReceipt() {
    // Hide non-printable elements
    const nonPrintable = document.querySelectorAll('.space-y-6 > div:not(.bg-white.rounded-lg.shadow:nth-child(2))');
    nonPrintable.forEach(el => el.style.display = 'none');
    
    // Print
    window.print();
    
    // Show elements again
    setTimeout(() => {
        nonPrintable.forEach(el => el.style.display = 'block');
    }, 1000);
}

function downloadPDF() {
    // Simple implementation - opens print dialog
    // You can enhance this with libraries like jsPDF or Puppeteer
    const receiptContent = document.getElementById('receipt-content').innerHTML;
    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
        <html>
            <head>
                <title>Struk Booking #{{ $booking->id }} - Sisbar Hairstudio</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    .receipt-content { max-width: 600px; margin: 0 auto; }
                    .bg-gray-50 { background-color: #f9fafb; }
                    .bg-blue-50 { background-color: #eff6ff; }
                    .border { border: 1px solid #e5e7eb; }
                    .border-blue-200 { border-color: #bfdbfe; }
                    .rounded-lg { border-radius: 8px; }
                    .p-4 { padding: 16px; }
                    .p-3 { padding: 12px; }
                    .mb-2 { margin-bottom: 8px; }
                    .mb-3 { margin-bottom: 12px; }
                    .mb-4 { margin-bottom: 16px; }
                    .mb-6 { margin-bottom: 24px; }
                    .text-sm { font-size: 14px; }
                    .text-xs { font-size: 12px; }
                    .font-bold { font-weight: bold; }
                    .font-semibold { font-weight: 600; }
                    .text-gray-600 { color: #4b5563; }
                    .text-gray-800 { color: #1f2937; }
                    .text-blue-800 { color: #1e40af; }
                    .text-blue-600 { color: #2563eb; }
                    .text-green-600 { color: #059669; }
                    .border-dashed { border-style: dashed; }
                    .border-t { border-top-width: 1px; }
                    .border-t-2 { border-top-width: 2px; }
                    .pt-4 { padding-top: 16px; }
                    .pb-6 { padding-bottom: 24px; }
                    .text-center { text-align: center; }
                    .grid { display: grid; }
                    .grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
                    .gap-4 { gap: 16px; }
                    .flex { display: flex; }
                    .justify-between { justify-content: space-between; }
                    .items-center { align-items: center; }
                    .items-start { align-items: flex-start; }
                </style>
            </head>
            <body>
                <div class="receipt-content">${receiptContent}</div>
                <script>
                    window.onload = function() {
                        window.print();
                        window.close();
                    }
                </script>
            </body>
        </html>
    `);
    printWindow.document.close();
}

async function updateStatus(status) {
    const statusText = {
        'confirmed': 'konfirmasi',
        'completed': 'menyelesaikan',
        'cancelled': 'membatalkan'
    };
    
    if (confirm(`Apakah Anda yakin ingin ${statusText[status]} booking ini?`)) {
        try {
            const response = await fetch(`/admin/bookings/{{ $booking->id }}/status`, {
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
</script>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    #receipt-content, #receipt-content * {
        visibility: visible;
    }
    #receipt-content {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
}
</style>
@endsection
