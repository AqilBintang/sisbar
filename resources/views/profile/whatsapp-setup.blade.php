<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup WhatsApp - Sisbar Hairstudio</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-sisbar.png') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Inter", sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 50%, #1a1a1a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .setup-container {
            background: white;
            border-radius: 16px;
            padding: 40px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: #1a1a1a;
        }

        h1 {
            color: #1a1a1a;
            margin-bottom: 10px;
            font-size: 28px;
            font-weight: 700;
        }

        .subtitle {
            color: #6b7280;
            margin-bottom: 30px;
            font-size: 16px;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-weight: 500;
        }

        .input-group {
            position: relative;
        }

        input[type="tel"] {
            width: 100%;
            padding: 14px 50px 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        input[type="tel"]:focus {
            outline: none;
            border-color: #fbbf24;
            background: white;
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
        }

        .input-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 20px;
        }

        .help-text {
            font-size: 14px;
            color: #6b7280;
            margin-top: 6px;
        }

        .btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: #1a1a1a;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 15px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(251, 191, 36, 0.3);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #6b7280;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
            box-shadow: none;
        }

        .error-message {
            background: #fee2e2;
            color: #dc2626;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border-left: 4px solid #dc2626;
        }

        .success-message {
            background: #d1fae5;
            color: #065f46;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border-left: 4px solid #10b981;
        }

        .info-message {
            background: #dbeafe;
            color: #1e40af;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border-left: 4px solid #3b82f6;
        }

        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(26, 26, 26, 0.3);
            border-radius: 50%;
            border-top-color: #1a1a1a;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .features {
            background: #f9fafb;
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
            text-align: left;
        }

        .features h3 {
            color: #1a1a1a;
            margin-bottom: 12px;
            font-size: 18px;
        }

        .features ul {
            list-style: none;
            padding: 0;
        }

        .features li {
            padding: 6px 0;
            color: #6b7280;
            display: flex;
            align-items: center;
        }

        .features li i {
            color: #10b981;
            margin-right: 8px;
            font-size: 16px;
        }

        @media (max-width: 480px) {
            .setup-container {
                padding: 30px 20px;
            }
            
            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="setup-container">
        <div class="logo">
            <i class='bx bxl-whatsapp'></i>
        </div>
        
        <h1>Setup WhatsApp</h1>
        <p class="subtitle">
            Tambahkan nomor WhatsApp Anda untuk menerima notifikasi booking, pengingat, dan promo eksklusif dari Sisbar Hairstudio.
        </p>

        @if(session('info'))
            <div class="info-message">
                {{ session('info') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-message">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.whatsapp.setup') }}" id="whatsappForm">
            @csrf
            
            <div class="form-group">
                <label for="whatsapp_number">Nomor WhatsApp</label>
                <div class="input-group">
                    <input type="tel" 
                           id="whatsapp_number" 
                           name="whatsapp_number" 
                           placeholder="08xxxxxxxxxx"
                           value="{{ old('whatsapp_number') }}"
                           required>
                    <i class='bx bxl-whatsapp input-icon'></i>
                </div>
                <div class="help-text">
                    Masukkan nomor WhatsApp aktif Anda (format: 08xxxxxxxxxx)
                </div>
            </div>

            <button type="submit" class="btn" id="submitBtn">
                <span id="submitText">Simpan & Lanjutkan</span>
                <span id="submitLoading" class="loading" style="display: none;"></span>
            </button>
        </form>

        <button type="button" class="btn btn-secondary" onclick="skipSetup()">
            Lewati untuk Sekarang
        </button>

        <div class="features">
            <h3>Manfaat Menambahkan WhatsApp:</h3>
            <ul>
                <li><i class='bx bx-check-circle'></i> Notifikasi konfirmasi booking</li>
                <li><i class='bx bx-check-circle'></i> Pengingat jadwal appointment</li>
                <li><i class='bx bx-check-circle'></i> Promo dan penawaran eksklusif</li>
                <li><i class='bx bx-check-circle'></i> Update status pembayaran</li>
            </ul>
        </div>
    </div>

    <script>
        // Form submission with loading state
        document.getElementById('whatsappForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            const text = document.getElementById('submitText');
            const loading = document.getElementById('submitLoading');
            
            btn.disabled = true;
            text.style.display = 'none';
            loading.style.display = 'inline-block';
        });

        // Skip setup function
        function skipSetup() {
            if (confirm('Anda yakin ingin melewati setup WhatsApp? Anda tidak akan menerima notifikasi penting.')) {
                window.location.href = '/';
            }
        }

        // Format phone number input
        document.getElementById('whatsapp_number').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove non-digits
            
            // Limit to 15 digits
            if (value.length > 15) {
                value = value.substring(0, 15);
            }
            
            // Format display
            if (value.length > 0) {
                if (value.startsWith('62')) {
                    // Already in international format
                    e.target.value = value;
                } else if (value.startsWith('0')) {
                    // Indonesian format
                    e.target.value = value;
                } else {
                    // Add 0 prefix for Indonesian numbers
                    e.target.value = '0' + value;
                }
            }
        });

        // Auto-hide messages after 5 seconds
        setTimeout(() => {
            const messages = document.querySelectorAll('.error-message, .success-message, .info-message');
            messages.forEach(msg => {
                msg.style.opacity = '0';
                msg.style.transform = 'translateY(-10px)';
                setTimeout(() => msg.remove(), 300);
            });
        }, 5000);
    </script>
</body>
</html>