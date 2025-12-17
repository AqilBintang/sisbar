<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register - Sisbar Hairstudio</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-sisbar.png') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            text-decoration: none;
            list-style: none;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 50%, #1a1a1a 100%);
        }

        .container {
            position: relative;
            width: 1100px;
            height: 750px;
            background: #fff;
            margin: 20px;
            border-radius: 20px;
            box-shadow: 0 0 40px rgba(0, 0, 0, .3);
            overflow: hidden;
        }

        .container h1 {
            font-size: 32px;
            margin: 0 0 20px 0;
            color: #1a1a1a;
            font-weight: 700;
        }

        .container p {
            font-size: 14px;
            margin: 15px 0;
            color: #6b7280;
            line-height: 1.5;
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-box {
            position: absolute;
            right: 0;
            width: 50%;
            height: 100%;
            background: #fff;
            display: flex;
            align-items: center;
            color: #333;
            text-align: center;
            padding: 60px 50px;
            z-index: 1;
            transition: .6s ease-in-out 1.2s, visibility 0s 1s;
        }

        .container.active .form-box {
            right: 50%;
        }

        .form-box.register {
            visibility: hidden;
        }

        .form-box.register .input-box {
            margin: 12px 0;
        }

        .form-box.register h1 {
            margin-bottom: 10px;
        }

        .form-box.register p {
            margin: 10px 0;
        }

        .container.active .form-box.register {
            visibility: visible;
        }

        .input-box {
            position: relative;
            margin: 20px 0;
        }

        .input-box input {
            width: 100%;
            padding: 15px 50px 15px 20px;
            background: #f9fafb;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            outline: none;
            font-size: 16px;
            color: #1a1a1a;
            font-weight: 500;
            transition: all 0.3s ease;
            min-height: 50px;
        }

        .input-box input:focus {
            border-color: #fbbf24;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
        }

        .input-box input::placeholder {
            color: #9ca3af;
            font-weight: 400;
        }

        .input-box i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #9ca3af;
            transition: color 0.3s ease;
        }

        .input-box input:focus + i {
            color: #fbbf24;
        }

        .input-box input.valid {
            border-color: #10b981;
            background: #f0fdf4;
        }

        .input-box input.valid + i {
            color: #10b981;
        }

        .input-box input.invalid {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .input-box input.invalid + i {
            color: #ef4444;
        }

        .input-help {
            font-size: 11px;
            color: #6b7280;
            margin-top: 2px;
            text-align: left;
            line-height: 1.3;
        }

        .input-help.success {
            color: #10b981;
        }

        .input-help.error {
            color: #ef4444;
        }

        .forgot-link {
            margin: 10px 0 20px;
            text-align: right;
        }

        .forgot-link a {
            font-size: 14.5px;
            color: #6b7280;
            transition: color 0.3s ease;
        }

        .forgot-link a:hover {
            color: #fbbf24;
        }

        .btn {
            width: 100%;
            height: 52px;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(251, 191, 36, .3);
            border: none;
            cursor: pointer;
            font-size: 16px;
            color: #1a1a1a;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 15px 0;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(251, 191, 36, 0.4);
        }

        .social-icons {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 10px;
        }

        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 20px;
            color: #6b7280;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            border-color: #fbbf24;
            color: #fbbf24;
            transform: translateY(-2px);
        }

        .toggle-box {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .toggle-box::before {
            content: '';
            position: absolute;
            left: -250%;
            width: 300%;
            height: 100%;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #d97706 100%);
            border-radius: 150px;
            z-index: 2;
            transition: 1.8s ease-in-out;
        }

        .container.active .toggle-box::before {
            left: 50%;
        }

        .toggle-panel {
            position: absolute;
            width: 50%;
            height: 100%;
            color: #1a1a1a;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 2;
            transition: .6s ease-in-out;
        }

        .toggle-panel h1 {
            color: #1a1a1a;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .toggle-panel p {
            color: #1a1a1a;
            opacity: 0.8;
        }

        .toggle-panel.toggle-left {
            left: 0;
            transition-delay: 1.2s;
        }

        .container.active .toggle-panel.toggle-left {
            left: -50%;
            transition-delay: .6s;
        }

        .toggle-panel.toggle-right {
            right: -50%;
            transition-delay: .6s;
        }

        .container.active .toggle-panel.toggle-right {
            right: 0;
            transition-delay: 1.2s;
        }

        .toggle-panel p {
            margin-bottom: 20px;
        }

        .toggle-panel .btn {
            width: 160px;
            height: 46px;
            background: rgba(26, 26, 26, 0.1);
            color: #1a1a1a;
            border: 2px solid #1a1a1a;
            box-shadow: none;
            backdrop-filter: blur(10px);
        }

        .toggle-panel .btn:hover {
            background: #1a1a1a;
            color: #fbbf24;
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 25px rgba(26, 26, 26, 0.4);
        }

        .error-message {
            background: #fee2e2;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 15px;
            font-size: 0.85rem;
            border-left: 4px solid #dc2626;
            box-shadow: 0 2px 8px rgba(220, 38, 38, 0.1);
        }

        .success-message {
            background: #d1fae5;
            color: #065f46;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 15px;
            font-size: 0.85rem;
            border-left: 4px solid #10b981;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.1);
        }

        /* Loading Animation */
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

        @media screen and (max-width: 1150px) {
            .container {
                width: 95%;
                max-width: 1000px;
                height: auto;
                min-height: 700px;
            }
        }

        @media screen and (max-width: 768px) {
            .container {
                width: 95%;
                height: auto;
                min-height: calc(100vh - 40px);
                flex-direction: column;
            }

            .form-box {
                position: relative;
                width: 100%;
                height: auto;
                min-height: 60vh;
                padding: 30px 20px;
            }

            .container.active .form-box {
                right: 0;
            }

            .toggle-box {
                position: relative;
                width: 100%;
                height: 200px;
            }

            .toggle-box::before {
                display: none;
            }

            .toggle-panel {
                position: relative;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #d97706 100%);
                border-radius: 0;
            }

            .toggle-panel.toggle-left,
            .toggle-panel.toggle-right {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
            }

            .container.active .toggle-panel.toggle-left {
                left: 0;
                top: 0;
            }

            .toggle-panel.toggle-right {
                right: 0;
                bottom: 0;
            }

            .container.active .toggle-panel.toggle-right {
                bottom: 0;
                right: 0;
            }
        }

        @media screen and (max-width: 480px) {
            .form-box {
                padding: 20px 15px;
            }

            .container h1 {
                font-size: 28px;
            }

            .toggle-panel h1 {
                font-size: 24px;
            }

            .input-box input {
                padding: 12px 45px 12px 15px;
                font-size: 14px;
            }

            .btn {
                height: 48px;
                font-size: 14px;
            }

            .social-icons a {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Login Form -->
        <div class="form-box login">
            <form method="POST" action="{{ route('login.post') }}" id="loginForm">
                @csrf
                <h1>Login</h1>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="error-message">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                <!-- Success Messages -->
                @if (session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    <i class='bx bxs-user'></i>
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <div class="forgot-link">
                    <a href="#" onclick="alert('Fitur reset password akan segera tersedia!')">Lupa Password?</a>
                </div>

                <button type="submit" class="btn" id="loginBtn">
                    <span id="loginText">Masuk</span>
                    <span id="loginLoading" class="loading" style="display: none;"></span>
                </button>

                <p>atau masuk dengan akun sosial</p>

                <div class="social-icons">
                    <a href="{{ route('auth.google') }}" title="Login with Google">
                        <i class='bx bxl-google'></i>
                    </a>
                    <a href="#" title="Login with Facebook" onclick="alert('Facebook login akan segera tersedia!')">
                        <i class='bx bxl-facebook'></i>
                    </a>
                </div>
            </form>
        </div>

        <!-- Register Form -->
        <div class="form-box register">
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf
                <h1>Registrasi</h1>

                <div class="input-box">
                    <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                    <i class='bx bxs-user'></i>
                </div>

                <div class="input-box">
                    <input type="email" name="email" placeholder="Alamat Email" value="{{ old('email') }}" required>
                    <i class='bx bxs-envelope'></i>
                </div>

                <div class="input-box">
                    <input type="tel" name="whatsapp_number" placeholder="Nomor WhatsApp (08xxxxxxxxxx)" value="{{ old('whatsapp_number') }}" required id="whatsapp_input">
                    <i class='bx bxl-whatsapp'></i>
                    <div class="input-help" id="whatsapp_help">Masukkan nomor WhatsApp aktif (08xxxxxxxxxx)</div>
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <div class="input-box">
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <button type="submit" class="btn" id="registerBtn">
                    <span id="registerText">Daftar Sekarang</span>
                    <span id="registerLoading" class="loading" style="display: none;"></span>
                </button>

                <p>atau daftar dengan akun sosial</p>

                <div class="social-icons">
                    <a href="{{ route('auth.google') }}" title="Register with Google">
                        <i class='bx bxl-google'></i>
                    </a>
                    <a href="#" title="Register with Facebook" onclick="alert('Facebook register akan segera tersedia!')">
                        <i class='bx bxl-facebook'></i>
                    </a>
                </div>
            </form>
        </div>

        <!-- Toggle Box -->
        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Belum Punya Akun?</h1>
                <p>Mari bergabung bersama kami!</p>
                <button class="btn register-btn">Daftar</button>
            </div>

            <div class="toggle-panel toggle-right">
                <h1>Sudah Punya Akun?</h1>
                <p>Ayo Login!</p>
                <button class="btn login-btn">Masuk</button>
            </div>
        </div>
    </div>

    <script>
        const container = document.querySelector('.container');
        const registerBtn = document.querySelector('.register-btn');
        const loginBtn = document.querySelector('.login-btn');

        registerBtn.addEventListener('click', () => {
            container.classList.add('active');
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove('active');
        });

        // Form submission with loading state
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('loginBtn');
            const text = document.getElementById('loginText');
            const loading = document.getElementById('loginLoading');
            
            btn.disabled = true;
            text.style.display = 'none';
            loading.style.display = 'inline-block';
        });

        document.getElementById('registerForm').addEventListener('submit', function() {
            const btn = document.getElementById('registerBtn');
            const text = document.getElementById('registerText');
            const loading = document.getElementById('registerLoading');
            
            btn.disabled = true;
            text.style.display = 'none';
            loading.style.display = 'inline-block';
        });

        // WhatsApp number formatting and validation
        const whatsappInput = document.getElementById('whatsapp_input');
        const whatsappHelp = document.getElementById('whatsapp_help');
        
        if (whatsappInput && whatsappHelp) {
            whatsappInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, ''); // Remove non-digits
                
                // Limit to 15 digits
                if (value.length > 15) {
                    value = value.substring(0, 15);
                }
                
                // Format display
                if (value.length > 0) {
                    if (value.startsWith('62')) {
                        e.target.value = value;
                    } else if (value.startsWith('0')) {
                        e.target.value = value;
                    } else {
                        e.target.value = '0' + value;
                    }
                }

                // Real-time validation
                validateWhatsAppNumber(e.target, whatsappHelp);
            });

            whatsappInput.addEventListener('blur', function(e) {
                validateWhatsAppNumber(e.target, whatsappHelp);
            });
        }

        function validateWhatsAppNumber(input, helpElement) {
            const value = input.value.replace(/\D/g, '');
            
            // Remove previous classes
            input.classList.remove('valid', 'invalid');
            helpElement.classList.remove('success', 'error');
            
            if (value.length === 0) {
                helpElement.textContent = 'Masukkan nomor WhatsApp aktif (08xxxxxxxxxx)';
                input.setCustomValidity('');
            } else if (value.length < 10) {
                input.classList.add('invalid');
                helpElement.classList.add('error');
                helpElement.textContent = '❌ Nomor WhatsApp minimal 10 digit';
                input.setCustomValidity('Nomor WhatsApp minimal 10 digit');
            } else if (value.length > 15) {
                input.classList.add('invalid');
                helpElement.classList.add('error');
                helpElement.textContent = '❌ Nomor WhatsApp maksimal 15 digit';
                input.setCustomValidity('Nomor WhatsApp maksimal 15 digit');
            } else if (!value.startsWith('08') && !value.startsWith('62')) {
                input.classList.add('invalid');
                helpElement.classList.add('error');
                helpElement.textContent = '❌ Format nomor tidak valid (gunakan 08xxx atau 62xxx)';
                input.setCustomValidity('Format nomor tidak valid');
            } else {
                input.classList.add('valid');
                helpElement.classList.add('success');
                helpElement.textContent = '✅ Format nomor WhatsApp valid';
                input.setCustomValidity('');
            }
        }

        // Auto-hide messages after 5 seconds
        setTimeout(() => {
            const messages = document.querySelectorAll('.error-message, .success-message');
            messages.forEach(msg => {
                msg.style.opacity = '0';
                msg.style.transform = 'translateY(-10px)';
                setTimeout(() => msg.remove(), 300);
            });
        }, 5000);
    </script>
</body>
</html>