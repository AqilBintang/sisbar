@extends('layouts.app')

@section('title', 'Test Login - Sisbar Hairstudio')

@section('content')
<div class="min-h-screen bg-black pt-20">
    <div class="relative z-10 container mx-auto px-4 py-20">
        <div class="max-w-md mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-white mb-4">Test Login</h1>
                <p class="text-gray-300">Untuk testing tanpa Google OAuth</p>
            </div>

            <div class="bg-slate-800 rounded-3xl shadow-2xl p-8">
                <form method="POST" action="{{ route('auth.test-login') }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nama</label>
                            <input type="text" id="name" name="name" required
                                   class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                                   placeholder="Masukkan nama Anda">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                                   placeholder="test@gmail.com">
                        </div>
                        <button type="submit" 
                                class="w-full px-8 py-4 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-xl transition-colors">
                            Login Test
                        </button>
                    </div>
                </form>
                
                <div class="mt-4 text-center">
                    <p class="text-gray-400 text-sm">Atau</p>
                    <a href="{{ route('login') }}" class="text-yellow-400 hover:text-yellow-300">Kembali ke Login Google</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection