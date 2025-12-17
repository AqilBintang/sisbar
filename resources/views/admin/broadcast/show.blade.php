@extends('layouts.admin')

@section('title', 'Detail Broadcast')
@section('page-title', 'Detail Broadcast')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.broadcast.index') }}" 
           class="text-gray-600 hover:text-gray-900 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Broadcast
        </a>
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Broadcast Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Header Info -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">{{ $broadcast->title }}</h2>
                        <div class="flex items-center space-x-4 mt-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($broadcast->type === 'promo') bg-green-100 text-green-800
                                @elseif($broadcast->type === 'notification') bg-blue-100 text-blue-800
                                @elseif($broadcast->type === 'reminder') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($broadcast->type) }}
                            </span>
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
                        </div>
                    </div>
                    
                    <div class="flex space-x-2">
                        @if($broadcast->status === 'draft' || $broadcast->status === 'scheduled')
                            <form action="{{ route('admin.broadcast.send', $broadcast) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-2 rounded-lg font-medium transition-colors"
                                        onclick="return confirm('Yakin ingin mengirim broadcast ini?')">
                                    <i class="fas fa-paper-plane mr-2"></i>Kirim Sekarang
                                </button>
                            </form>
                        @endif
                        
                        @if($broadcast->status !== 'sent')
                            <form action="{{ route('admin.broadcast.destroy', $broadcast) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium transition-colors"
                                        onclick="return confirm('Yakin ingin menghapus broadcast ini?')">
                                    <i class="fas fa-trash mr-2"></i>Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- Message Content -->
                <div class="border-t pt-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Isi Pesan</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <pre class="whitespace-pre-wrap text-sm text-gray-700">{{ $broadcast->message }}</pre>
                    </div>
                </div>

                <!-- Metadata -->
                <div class="border-t pt-4 mt-4">
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="font-medium text-gray-500">Dibuat oleh:</span>
                            <span class="text-gray-900">{{ $broadcast->creator->name }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-500">Tanggal dibuat:</span>
                            <span class="text-gray-900">{{ $broadcast->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        @if($broadcast->scheduled_at)
                        <div>
                            <span class="font-medium text-gray-500">Dijadwalkan:</span>
                            <span class="text-gray-900">{{ $broadcast->scheduled_at->format('d/m/Y H:i') }}</span>
                        </div>
                        @endif
                        @if($broadcast->sent_at)
                        <div>
                            <span class="font-medium text-gray-500">Dikirim:</span>
                            <span class="text-gray-900">{{ $broadcast->sent_at->format('d/m/Y H:i') }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recipients List -->
            @if($broadcast->recipients->count() > 0)
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Daftar Penerima</h3>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    WhatsApp
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dikirim
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($broadcast->recipients as $recipient)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $recipient->user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $recipient->whatsapp_number }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($recipient->status === 'sent') bg-green-100 text-green-800
                                        @elseif($recipient->status === 'failed') bg-red-100 text-red-800
                                        @elseif($recipient->status === 'delivered') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        @if($recipient->status === 'sent') Terkirim
                                        @elseif($recipient->status === 'failed') Gagal
                                        @elseif($recipient->status === 'delivered') Tersampaikan
                                        @else Pending @endif
                                    </span>
                                    @if($recipient->error_message)
                                        <div class="text-xs text-red-600 mt-1">{{ $recipient->error_message }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $recipient->sent_at ? $recipient->sent_at->format('d/m/Y H:i') : '-' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>

        <!-- Statistics -->
        <div class="lg:col-span-1">
            <div class="bg-white shadow rounded-lg p-6 sticky top-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Statistik</h3>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Total Penerima</span>
                        <span class="text-lg font-semibold text-gray-900">{{ $stats['total_recipients'] }}</span>
                    </div>
                    
                    @if($broadcast->status === 'sent')
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Berhasil Dikirim</span>
                        <span class="text-lg font-semibold text-green-600">{{ $stats['successful_sends'] }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Gagal Dikirim</span>
                        <span class="text-lg font-semibold text-red-600">{{ $stats['failed_sends'] }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Tingkat Keberhasilan</span>
                        <span class="text-lg font-semibold text-blue-600">{{ $stats['delivery_rate'] }}%</span>
                    </div>
                    @else
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Status</span>
                        <span class="text-sm text-gray-900">
                            @if($broadcast->status === 'draft') Belum dikirim
                            @elseif($broadcast->status === 'scheduled') Menunggu jadwal
                            @else {{ ucfirst($broadcast->status) }} @endif
                        </span>
                    </div>
                    @endif
                </div>

                @if($broadcast->status === 'sent' && $stats['total_recipients'] > 0)
                <div class="mt-6">
                    <div class="bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" 
                             style="width: {{ $stats['delivery_rate'] }}%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1 text-center">
                        {{ $stats['delivery_rate'] }}% berhasil dikirim
                    </p>
                </div>
                @endif

                <!-- Target Criteria -->
                @if($broadcast->target_criteria)
                <div class="mt-6 pt-6 border-t">
                    <h4 class="text-sm font-medium text-gray-900 mb-2">Kriteria Target</h4>
                    <div class="text-sm text-gray-600">
                        @php
                            $userType = $broadcast->target_criteria['user_type'] ?? '';
                            $targetLabels = [
                                'all' => 'Semua User',
                                'with_bookings' => 'User dengan Booking',
                                'recent_bookings' => 'User dengan Booking 30 Hari Terakhir',
                                'upcoming_bookings' => 'User dengan Booking Mendatang',
                                'pending_payment' => 'User dengan Pembayaran Pending'
                            ];
                        @endphp
                        {{ $targetLabels[$userType] ?? 'Tidak diketahui' }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection