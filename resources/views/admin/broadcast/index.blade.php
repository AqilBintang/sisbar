@extends('layouts.admin')

@section('title', 'Broadcast WhatsApp')
@section('page-title', 'Broadcast WhatsApp')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-900">Daftar Broadcast</h2>
        <div class="flex gap-2">
            <a href="{{ route('admin.broadcast.config') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                <i class="fas fa-cog mr-2"></i>Konfigurasi
            </a>
            <a href="{{ route('admin.broadcast.create') }}" 
               class="bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-2 rounded-lg font-medium transition-colors">
                <i class="fas fa-plus mr-2"></i>Buat Broadcast Baru
            </a>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Judul & Tipe
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Penerima
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($broadcasts as $broadcast)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ $broadcast->title }}</div>
                            <div class="text-sm text-gray-500">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($broadcast->type === 'promo') bg-green-100 text-green-800
                                    @elseif($broadcast->type === 'notification') bg-blue-100 text-blue-800
                                    @elseif($broadcast->type === 'reminder') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($broadcast->type) }}
                                </span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($broadcast->status === 'sent') bg-green-100 text-green-800
                            @elseif($broadcast->status === 'scheduled') bg-blue-100 text-blue-800
                            @elseif($broadcast->status === 'failed') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800 @endif">
                            @if($broadcast->status === 'sent') Terkirim
                            @elseif($broadcast->status === 'scheduled') Terjadwal
                            @elseif($broadcast->status === 'failed') Gagal
                            @else Draft @endif
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <div>{{ $broadcast->total_recipients }} penerima</div>
                        @if($broadcast->status === 'sent')
                            <div class="text-xs text-gray-500">
                                ✓ {{ $broadcast->successful_sends }} berhasil, 
                                ✗ {{ $broadcast->failed_sends }} gagal
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div>Dibuat: {{ $broadcast->created_at->format('d/m/Y H:i') }}</div>
                        @if($broadcast->scheduled_at)
                            <div class="text-xs">Jadwal: {{ $broadcast->scheduled_at->format('d/m/Y H:i') }}</div>
                        @endif
                        @if($broadcast->sent_at)
                            <div class="text-xs">Dikirim: {{ $broadcast->sent_at->format('d/m/Y H:i') }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.broadcast.show', $broadcast) }}" 
                               class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            @if($broadcast->status === 'draft' || $broadcast->status === 'scheduled')
                                <form action="{{ route('admin.broadcast.send', $broadcast) }}" 
                                      method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="text-green-600 hover:text-green-900"
                                            onclick="return confirm('Yakin ingin mengirim broadcast ini?')">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </form>
                            @endif
                            
                            @if($broadcast->status !== 'sent')
                                <form action="{{ route('admin.broadcast.destroy', $broadcast) }}" 
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Yakin ingin menghapus broadcast ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Belum ada broadcast. <a href="{{ route('admin.broadcast.create') }}" class="text-blue-600 hover:text-blue-800">Buat yang pertama</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($broadcasts->hasPages())
        <div class="px-6 py-3 border-t border-gray-200">
            {{ $broadcasts->links() }}
        </div>
    @endif
</div>
@endsection