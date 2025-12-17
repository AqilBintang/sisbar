<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Booking #{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }} - Sisbar Hairstudio</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: #fff;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            border-bottom: 2px dashed #ccc;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        
        .logo-section {
            margin-bottom: 15px;
        }
        
        .logo-section h1 {
            font-size: 24px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 5px;
        }
        
        .logo-section p {
            font-size: 12px;
            color: #666;
            margin-bottom: 3px;
        }
        
        .receipt-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .receipt-title h2 {
            font-size: 18px;
            font-weight: bold;
            color: #1a1a1a;
        }
        
        .booking-id {
            text-align: right;
        }
        
        .booking-id .label {
            font-size: 10px;
            color: #666;
        }
        
        .booking-id .value {
            font-size: 16px;
            font-weight: bold;
            color: #1a1a1a;
        }
        
        .details-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .details-row {
            display: table-row;
        }
        
        .details-cell {
            display: table-cell;
            padding: 8px 10px 8px 0;
            vertical-align: top;
            width: 50%;
        }
        
        .details-cell .label {
            font-size: 10px;
            color: #666;
            margin-bottom: 2px;
        }
        
        .details-cell .value {
            font-size: 12px;
            font-weight: 600;
            color: #1a1a1a;
        }
        
        .service-section {
            border-top: 1px solid #e5e5e5;
            padding-top: 15px;
            margin-bottom: 20px;
        }
        
        .service-section h3 {
            font-size: 14px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 10px;
        }
        
        .service-box {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 5px;
            padding: 15px;
        }
        
        .service-details {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        
        .service-info .service-name {
            font-size: 14px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 5px;
        }
        
        .service-info .service-meta {
            font-size: 10px;
            color: #666;
            margin-bottom: 2px;
        }
        
        .service-price {
            text-align: right;
        }
        
        .service-price .price {
            font-size: 16px;
            font-weight: bold;
            color: #1a1a1a;
        }
        
        .total-section {
            border-top: 2px dashed #ccc;
            padding-top: 15px;
            margin-bottom: 20px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .total-label {
            font-size: 16px;
            font-weight: bold;
            color: #1a1a1a;
        }
        
        .total-amount {
            font-size: 20px;
            font-weight: bold;
            color: #16a34a;
        }
        
        .payment-section {
            border-top: 1px solid #e5e5e5;
            padding-top: 15px;
            margin-bottom: 20px;
        }
        
        .payment-section h3 {
            font-size: 14px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 10px;
        }
        
        .payment-box {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 5px;
            padding: 12px;
        }
        
        .payment-method {
            font-size: 12px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 3px;
        }
        
        .payment-status {
            font-size: 10px;
            color: #3730a3;
        }
        
        .status-section {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }
        
        .status-pending {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            color: #92400e;
        }
        
        .status-confirmed {
            background: #dbeafe;
            border: 1px solid #3b82f6;
            color: #1e40af;
        }
        
        .status-completed {
            background: #dcfce7;
            border: 1px solid #16a34a;
            color: #166534;
        }
        
        .notes-section {
            margin-bottom: 20px;
        }
        
        .notes-section h3 {
            font-size: 14px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 8px;
        }
        
        .notes-box {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 5px;
            padding: 10px;
        }
        
        .notes-text {
            font-size: 11px;
            color: #1e40af;
        }
        
        .instructions {
            border-top: 1px solid #e5e5e5;
            padding-top: 15px;
            margin-bottom: 20px;
        }
        
        .instructions-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 5px;
            padding: 12px;
        }
        
        .instructions h4 {
            font-size: 12px;
            font-weight: bold;
            color: #dc2626;
            margin-bottom: 8px;
            text-align: center;
        }
        
        .instructions ul {
            list-style: none;
            padding: 0;
        }
        
        .instructions li {
            font-size: 9px;
            color: #991b1b;
            margin-bottom: 4px;
            padding-left: 10px;
            position: relative;
        }
        
        .instructions li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #dc2626;
        }
        
        .instructions .highlight {
            font-weight: bold;
        }
        
        .footer {
            border-top: 1px solid #e5e5e5;
            padding-top: 15px;
            text-align: center;
        }
        
        .footer p {
            font-size: 10px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .print-time {
            font-size: 9px;
            color: #999;
        }
        
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo-section">
                <h1>Sisbar Hairstudio</h1>
                <p>Professional Barbershop</p>
                <p>Jl. Raya Barbershop No. 123</p>
                <p>Telp: +62 812-3456-7890</p>
            </div>
        </div>

        <!-- Receipt Title -->
        <div class="receipt-title">
            <h2>STRUK BOOKING</h2>
            <div class="booking-id">
                <div class="label">Booking ID</div>
                <div class="value">#{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>

        <!-- Customer Details -->
        <div class="details-grid">
            <div class="details-row">
                <div class="details-cell">
                    <div class="label">Tanggal Booking:</div>
                    <div class="value">{{ $booking->formatted_date }}</div>
                </div>
                <div class="details-cell">
                    <div class="label">Waktu:</div>
                    <div class="value">{{ $booking->formatted_time }}</div>
                </div>
            </div>
            <div class="details-row">
                <div class="details-cell">
                    <div class="label">Nama Pelanggan:</div>
                    <div class="value">{{ $booking->customer_name }}</div>
                </div>
                <div class="details-cell">
                    <div class="label">No. Telepon:</div>
                    <div class="value">{{ $booking->customer_phone }}</div>
                </div>
            </div>
        </div>

        <!-- Service Details -->
        <div class="service-section">
            <h3>Detail Layanan</h3>
            <div class="service-box">
                <div class="service-details">
                    <div class="service-info">
                        <div class="service-name">{{ $booking->service->name }}</div>
                        <div class="service-meta">Kapster: {{ $booking->barber->name }}</div>
                        <div class="service-meta">Durasi: {{ $booking->service->duration }} menit</div>
                    </div>
                    <div class="service-price">
                        <div class="price">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total -->
        <div class="total-section">
            <div class="total-row">
                <div class="total-label">TOTAL PEMBAYARAN</div>
                <div class="total-amount">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Payment Method -->
        <div class="payment-section">
            <h3>Metode Pembayaran</h3>
            <div class="payment-box">
                <div class="payment-method">{{ $booking->payment_method_display }}</div>
                <div class="payment-status">{{ $booking->payment_status_display }}</div>
            </div>
        </div>

        <!-- Status -->
        <div class="status-section">
            <div class="status-badge 
                @if($booking->status === 'pending') status-pending
                @elseif($booking->status === 'confirmed') status-confirmed  
                @elseif($booking->status === 'completed') status-completed
                @else status-pending
                @endif">
                {{ $booking->status_display }}
            </div>
        </div>

        <!-- Notes (if any) -->
        @if($booking->notes)
        <div class="notes-section">
            <h3>Catatan</h3>
            <div class="notes-box">
                <div class="notes-text">{{ $booking->notes }}</div>
            </div>
        </div>
        @endif

        <!-- Important Instructions -->
        <div class="instructions">
            <div class="instructions-box">
                <h4>⚠️ INSTRUKSI PENTING</h4>
                <ul>
                    <li><span class="highlight">Berikan struk ini kepada kasir setengah jam (30 menit) sebelum waktu booking</span></li>
                    <li><span class="highlight">Jika terlambat lebih dari 10 menit dari waktu booking, akan diundur ke 1 pesanan selanjutnya</span></li>
                    <li>Harap datang tepat waktu untuk pelayanan terbaik</li>
                </ul>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Terima kasih atas kepercayaan Anda!</p>
            <p>Kami akan menghubungi Anda untuk konfirmasi</p>
            <div class="print-time">Dicetak pada: {{ $print_time }}</div>
        </div>
    </div>
</body>
</html>