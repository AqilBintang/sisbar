<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt Booking #{{ $booking->id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: #fff;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        
        .logo-section {
            margin-bottom: 15px;
        }
        
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        
        .company-tagline {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .company-info {
            font-size: 11px;
            color: #666;
            line-height: 1.3;
        }
        
        .receipt-title {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            padding: 10px;
            background: #f8f9fa;
            border: 1px solid #ddd;
        }
        
        .booking-info {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .info-row {
            display: table-row;
        }
        
        .info-label {
            display: table-cell;
            width: 30%;
            padding: 8px 10px 8px 0;
            font-weight: bold;
            vertical-align: top;
        }
        
        .info-value {
            display: table-cell;
            padding: 8px 0;
            vertical-align: top;
        }
        
        .section {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        .section-header {
            background: #f8f9fa;
            padding: 10px 15px;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
        }
        
        .section-content {
            padding: 15px;
        }
        
        .service-details {
            border-collapse: collapse;
            width: 100%;
        }
        
        .service-details td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }
        
        .total-section {
            background: #f8f9fa;
            border: 2px solid #333;
            padding: 15px;
            margin-top: 20px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 16px;
            font-weight: bold;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-paid {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .status-pending {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }
        
        .status-failed {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 11px;
            color: #666;
        }
        
        .qr-section {
            text-align: center;
            margin: 20px 0;
        }
        
        .notes-section {
            background: #f8f9fa;
            padding: 15px;
            border-left: 4px solid #007bff;
            margin: 15px 0;
        }
        
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 60px;
            color: rgba(0, 0, 0, 0.05);
            z-index: -1;
            font-weight: bold;
        }
        
        @media print {
            .container {
                padding: 0;
            }
            
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Watermark -->
    <div class="watermark">SISBAR HAIRSTUDIO</div>
    
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo-section">
                <div class="company-name">SISBAR HAIRSTUDIO</div>
                <div class="company-tagline">Professional Barbershop & Hair Care</div>
            </div>
            <div class="company-info">
                Jl. Raya Barbershop No. 123, Kota Barbershop<br>
                Telp: +62 812-3456-7890 | Email: info@sisbar.com<br>
                Website: www.sisbar.com
            </div>
        </div>
        
        <!-- Receipt Title -->
        <div class="receipt-title">
            STRUK PEMBAYARAN BOOKING
        </div>
        
        <!-- Booking Information -->
        <div class="section">
            <div class="section-header">Informasi Booking</div>
            <div class="section-content">
                <div class="booking-info">
                    <div class="info-row">
                        <div class="info-label">Booking ID:</div>
                        <div class="info-value"><strong>#{{ $booking->id }}</strong></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Tanggal Booking:</div>
                        <div class="info-value">{{ $booking->formatted_date }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Waktu:</div>
                        <div class="info-value">{{ $booking->formatted_time }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Tanggal Cetak:</div>
                        <div class="info-value">{{ date('d F Y, H:i') }} WIB</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Customer Information -->
        <div class="section">
            <div class="section-header">Informasi Customer</div>
            <div class="section-content">
                <div class="booking-info">
                    <div class="info-row">
                        <div class="info-label">Nama:</div>
                        <div class="info-value">{{ $booking->customer_name }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Telepon:</div>
                        <div class="info-value">{{ $booking->customer_phone }}</div>
                    </div>
                    @if($booking->customer_email)
                    <div class="info-row">
                        <div class="info-label">Email:</div>
                        <div class="info-value">{{ $booking->customer_email }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Service Details -->
        <div class="section">
            <div class="section-header">Detail Layanan</div>
            <div class="section-content">
                <table class="service-details">
                    <tr>
                        <td style="width: 30%; font-weight: bold;">Layanan:</td>
                        <td>{{ $booking->service->name }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Kapster:</td>
                        <td>{{ $booking->barber->name }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Durasi:</td>
                        <td>{{ $booking->service->duration }} menit</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Harga:</td>
                        <td><strong>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</strong></td>
                    </tr>
                </table>
            </div>
        </div>
        
        <!-- Payment Information -->
        <div class="section">
            <div class="section-header">Informasi Pembayaran</div>
            <div class="section-content">
                <div class="booking-info">
                    <div class="info-row">
                        <div class="info-label">Metode Pembayaran:</div>
                        <div class="info-value">{{ $booking->payment_method_display }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Status Pembayaran:</div>
                        <div class="info-value">
                            <span class="status-badge 
                                @if($booking->payment_status === 'paid') status-paid
                                @elseif($booking->payment_status === 'pending') status-pending
                                @else status-failed @endif">
                                {{ $booking->payment_status_display }}
                            </span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Status Booking:</div>
                        <div class="info-value">
                            <span class="status-badge status-pending">
                                {{ $booking->status_display }}
                            </span>
                        </div>
                    </div>
                    @if($booking->midtrans_order_id)
                    <div class="info-row">
                        <div class="info-label">Order ID:</div>
                        <div class="info-value">{{ $booking->midtrans_order_id }}</div>
                    </div>
                    @endif
                    @if($booking->midtrans_transaction_id)
                    <div class="info-row">
                        <div class="info-label">Transaction ID:</div>
                        <div class="info-value">{{ $booking->midtrans_transaction_id }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        @if($booking->notes)
        <!-- Notes -->
        <div class="notes-section">
            <strong>Catatan:</strong><br>
            {{ $booking->notes }}
        </div>
        @endif
        
        <!-- Total Payment -->
        <div class="total-section">
            <div class="total-row">
                <span>TOTAL PEMBAYARAN:</span>
                <span>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
            </div>
        </div>
        
        <!-- QR Code Section (Optional) -->
        <div class="qr-section">
            <div style="border: 1px solid #ddd; padding: 15px; display: inline-block;">
                <div style="font-size: 10px; margin-bottom: 5px;">Booking ID: #{{ $booking->id }}</div>
                <div style="width: 80px; height: 80px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; font-size: 8px; color: #666;">
                    QR CODE<br>PLACEHOLDER
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p><strong>Terima kasih telah memilih Sisbar Hairstudio!</strong></p>
            <p>Struk ini adalah bukti booking yang sah. Harap simpan untuk keperluan konfirmasi.</p>
            <p>Untuk pertanyaan, hubungi kami di +62 812-3456-7890</p>
            <br>
            <p style="font-size: 10px; color: #999;">
                Dokumen ini digenerate secara otomatis pada {{ date('d F Y, H:i:s') }} WIB
            </p>
        </div>
    </div>
</body>
</html>