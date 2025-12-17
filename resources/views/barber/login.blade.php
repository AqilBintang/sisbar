<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Kapster - Sisbar Hairstudio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/logo barber.png') }}">
</head>
<body class="bg-black min-h-screen flex items-center justify-center">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/bg-barber.jpg') }}');">
        <div class="absolute inset-0 bg-black/80"></div>
    </div>

    <div class="relative z-10 w-full max-w-md px-6">
        <!-- Logo -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo barber.png') }}" alt="Sisbar Hairstudio" class="w-20 h-20 mx-auto mb-4">
            <h1 class="text-3xl font-bold text-white mb-2">Kapster Panel</h1>
            <p class="text-gray-300">Sisbar Hairstudio</p>
        </div>

        <!-- Login Form -->
        <div class="bg-slate-800 rounded-2xl shadow-2xl p-8">
            <h2 class="text-2xl font-bold text-white mb-6 text-center">Login Kapster</h2>
            
            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4 mb-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-red-400 text-sm">{{ $errors->first() }}</span>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-500/10 border border-green-500/30 rounded-xl p-4 mb-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-green-400 text-sm">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('barber.login.post') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-300 mb-2">Username</label>
                    <input type="text" id="username" name="username" required
                           class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white placeholder-gray-400 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                           placeholder="Masukkan username"
                           value="{{ old('username') }}">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white placeholder-gray-400 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                           placeholder="Masukkan password">
                </div>

                <button type="submit" 
                        class="w-full px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-xl transition-colors">
                    Login
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="/" class="text-gray-400 hover:text-yellow-400 text-sm transition-colors">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-gray-400 text-sm">© 2024 Sisbar Hairstudio. All rights reserved.</p>
        </div>
    </div>
</body>
</html>