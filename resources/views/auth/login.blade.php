@extends('layouts.app')

@section('title', 'Login - Sisbar Hairstudio')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Bergabung Bersama Kami!</h1>
            <p class="text-gray-600">Buat akun untuk memulai petualangan Anda</p>
        </div>

        <!-- Login Form Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 space-y-6">
            
            <!-- Google Login Button -->
            <a href="{{ route('auth.google') }}" 
               class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-xl shadow-sm bg-white text-gray-700 hover:bg-gray-50 transition-colors">
                <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Daftar dengan Google
            </a>

            <!-- Divider -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">atau</span>
                </div>
            </div>

            <!-- Manual Registration Form -->
            <form id="registerForm" class="space-y-4">
                @csrf
                
                <!-- Name Field -->
                <div>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors"
                           placeholder="Nama Lengkap">
                </div>

                <!-- Email Field -->
                <div>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors"
                           placeholder="Alamat Email">
                </div>

                <!-- Password Fields -->
                <div class="grid grid-cols-2 gap-3">
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               minlength="8"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors pr-10"
                               placeholder="Password">
                        <button type="button" 
                                onclick="togglePassword('password')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="relative">
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               required
                               minlength="8"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors pr-10"
                               placeholder="Ulangi Password">
                        <button type="button" 
                                onclick="togglePassword('password_confirmation')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Password Requirements -->
                <div class="text-sm text-red-500" id="passwordError">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Min. 8 karakter
                    </span>
                </div>

                <!-- Terms Checkbox -->
                <div class="flex items-start">
                    <input type="checkbox" 
                           id="terms" 
                           name="terms" 
                           required
                           class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="terms" class="ml-2 text-sm text-gray-600">
                        Saya menyetujui 
                        <a href="#" class="text-blue-600 hover:text-blue-500">Syarat & Ketentuan</a> 
                        dan 
                        <a href="#" class="text-blue-600 hover:text-blue-500">Kebijakan Privasi</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-xl transition-colors flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Daftar Akun
                </button>
            </form>

            <!-- Login Link -->
            <div class="text-center">
                <p class="text-gray-600">
                    Sudah punya akun? 
                    <button onclick="showLoginForm()" class="text-blue-600 hover:text-blue-500 font-medium">Masuk sekarang!</button>
                </p>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center">
            <a href="/" class="inline-flex items-center text-gray-600 hover:text-gray-800 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<!-- Login Modal (Hidden by default) -->
<div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl p-8 max-w-md w-full mx-4">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Masuk ke Akun</h2>
            <p class="text-gray-600">Selamat datang kembali!</p>
        </div>

        <form id="loginForm" class="space-y-4">
            @csrf
            
            <div>
                <input type="email" 
                       name="email" 
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors"
                       placeholder="Alamat Email">
            </div>

            <div class="relative">
                <input type="password" 
                       name="password" 
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors pr-10"
                       placeholder="Password">
                <button type="button" 
                        onclick="togglePassword('loginPassword')"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </button>
            </div>

            <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-xl transition-colors">
                Masuk
            </button>
        </form>

        <div class="mt-4 text-center">
            <button onclick="hideLoginForm()" class="text-gray-500 hover:text-gray-700">Batal</button>
        </div>
    </div>
</div>

<script>
// Toggle password visibility
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
    field.setAttribute('type', type);
}

// Show/Hide login modal
function showLoginForm() {
    document.getElementById('loginModal').classList.remove('hidden');
    document.getElementById('loginModal').classList.add('flex');
}

function hideLoginForm() {
    document.getElementById('loginModal').classList.add('hidden');
    document.getElementById('loginModal').classList.remove('flex');
}

// Password validation
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const errorDiv = document.getElementById('passwordError');
    
    if (password.length >= 8) {
        errorDiv.innerHTML = '<span class="flex items-center text-green-500"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Password valid</span>';
    } else {
        errorDiv.innerHTML = '<span class="flex items-center text-red-500"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>Min. 8 karakter</span>';
    }
});

// Handle registration form
document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
    // Validate passwords match
    if (data.password !== data.password_confirmation) {
        alert('Password tidak cocok!');
        return;
    }
    
    try {
        const response = await fetch('/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('Registrasi berhasil! Selamat datang di Sisbar Hairstudio.');
            // Use redirect URL from server response
            window.location.href = result.redirect_url || '/';
        } else {
            alert(result.message || 'Registrasi gagal. Silakan coba lagi.');
        }
    } catch (error) {
        console.error('Registration error:', error);
        alert('Terjadi kesalahan. Silakan coba lagi.');
    }
});

// Handle login form
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
    try {
        const response = await fetch('/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('Login berhasil!');
            // Use redirect URL from server response
            window.location.href = result.redirect_url || '/';
        } else {
            alert(result.message || 'Login gagal. Periksa email dan password Anda.');
        }
    } catch (error) {
        console.error('Login error:', error);
        alert('Terjadi kesalahan. Silakan coba lagi.');
    }
});
</script>
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h3 class="text-blue-400 font-semibold mb-1">Mengapa perlu login?</h3>
                            <ul class="text-gray-300 text-sm space-y-1">
                                <li>• Untuk keamanan data booking Anda</li>
                                <li>• Memudahkan tracking status appointment</li>
                                <li>• Menyimpan riwayat booking</li>
                                <li>• Notifikasi konfirmasi via email</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Privacy Notice -->
                <div class="mt-4 text-center">
                    <p class="text-gray-400 text-xs">
                        Dengan login, Anda menyetujui 
                        <a href="#" class="text-yellow-400 hover:text-yellow-300">Syarat & Ketentuan</a> 
                        dan 
                        <a href="#" class="text-yellow-400 hover:text-yellow-300">Kebijakan Privasi</a> kami
                    </p>
                </div>

                <!-- Test Login Link (Development Only) -->
                <div class="mt-4 text-center">
                    <a href="{{ route('auth.test-login') }}" class="text-blue-400 hover:text-blue-300 text-sm">
                        Test Login (Development)
                    </a>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="text-center">
                <a href="/" 
                   class="inline-block px-8 py-3 bg-slate-600 hover:bg-slate-500 text-white font-bold rounded-xl transition-colors">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection