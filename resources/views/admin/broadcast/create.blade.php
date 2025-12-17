@extends('layouts.admin')

@section('title', 'Buat Broadcast Baru')
@section('page-title', 'Buat Broadcast Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.broadcast.index') }}" 
           class="text-gray-600 hover:text-gray-900 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Broadcast
        </a>
    </div>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.broadcast.store') }}" method="POST" id="broadcastForm">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form Input -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Broadcast</h3>
                    
                    <!-- Judul -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Broadcast
                        </label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                               placeholder="Masukkan judul broadcast"
                               required>
                    </div>

                    <!-- Tipe -->
                    <div class="mb-4">
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                            Tipe Broadcast
                        </label>
                        <select id="type" 
                                name="type" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                required>
                            <option value="">Pilih Tipe</option>
                            <option value="promo" {{ old('type') === 'promo' ? 'selected' : '' }}>Promo</option>
                            <option value="notification" {{ old('type') === 'notification' ? 'selected' : '' }}>Notifikasi</option>
                            <option value="reminder" {{ old('type') === 'reminder' ? 'selected' : '' }}>Pengingat</option>
                            <option value="general" {{ old('type') === 'general' ? 'selected' : '' }}>Umum</option>
                        </select>
                    </div>

                    <!-- Template -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Template Pesan (Opsional)
                        </label>
                        <select id="template" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <option value="">Pilih Template</option>
                            @foreach($templates as $key => $template)
                                <option value="{{ $key }}">{{ $template['title'] }}</option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Pilih template untuk mengisi pesan otomatis</p>
                    </div>

                    <!-- Pesan -->
                    <div class="mb-4">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                            Pesan
                        </label>
                        <textarea id="message" 
                                  name="message" 
                                  rows="6"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                  placeholder="Tulis pesan broadcast..."
                                  required>{{ old('message') }}</textarea>
                        <div class="text-xs text-gray-500 mt-1">
                            <p>Variabel yang tersedia:</p>
                            <p><code>{name}</code> - Nama user, <code>{email}</code> - Email user</p>
                            <p><code>{date}</code> - Tanggal booking, <code>{time}</code> - Waktu booking</p>
                            <p><code>{barber}</code> - Nama barber, <code>{total}</code> - Total harga</p>
                        </div>
                    </div>

                    <!-- Target Audience -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Target Penerima
                        </label>
                        <select id="user_type" 
                                name="target_criteria[user_type]" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                required>
                            <option value="">Pilih Target</option>
                            <option value="all" {{ old('target_criteria.user_type') === 'all' ? 'selected' : '' }}>
                                Semua User
                            </option>
                            <option value="with_bookings" {{ old('target_criteria.user_type') === 'with_bookings' ? 'selected' : '' }}>
                                User dengan Booking
                            </option>
                            <option value="recent_bookings" {{ old('target_criteria.user_type') === 'recent_bookings' ? 'selected' : '' }}>
                                User dengan Booking 30 Hari Terakhir
                            </option>
                            <option value="upcoming_bookings" {{ old('target_criteria.user_type') === 'upcoming_bookings' ? 'selected' : '' }}>
                                User dengan Booking Mendatang
                            </option>
                            <option value="pending_payment" {{ old('target_criteria.user_type') === 'pending_payment' ? 'selected' : '' }}>
                                User dengan Pembayaran Pending
                            </option>
                        </select>
                    </div>

                    <!-- Jadwal -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Jadwal Pengiriman
                        </label>
                        <div class="space-y-3">
                            <label class="flex items-center">
                                <input type="radio" name="send_option" value="now" class="mr-2" checked>
                                <span>Kirim Sekarang</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="send_option" value="schedule" class="mr-2">
                                <span>Jadwalkan Pengiriman</span>
                            </label>
                            <div id="schedule_input" class="ml-6 hidden">
                                <input type="datetime-local" 
                                       name="scheduled_at" 
                                       class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                       min="{{ now()->format('Y-m-d\TH:i') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex space-x-4">
                        <button type="submit" 
                                name="action" 
                                value="send"
                                class="bg-yellow-400 hover:bg-yellow-500 text-black px-6 py-2 rounded-lg font-medium transition-colors">
                            <i class="fas fa-paper-plane mr-2"></i>Kirim Broadcast
                        </button>
                        <button type="submit" 
                                name="action" 
                                value="draft"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-lg font-medium transition-colors">
                            <i class="fas fa-save mr-2"></i>Simpan sebagai Draft
                        </button>
                    </div>
                </div>
            </div>

            <!-- Preview Panel -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow rounded-lg p-6 sticky top-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Preview Target</h3>
                    
                    <div id="target_preview">
                        <p class="text-gray-500 text-sm">Pilih target untuk melihat preview</p>
                    </div>
                    
                    <button type="button" 
                            id="preview_btn" 
                            class="mt-4 w-full bg-blue-100 hover:bg-blue-200 text-blue-800 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        <i class="fas fa-eye mr-2"></i>Preview Target
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle schedule option
    const scheduleRadio = document.querySelector('input[name="send_option"][value="schedule"]');
    const nowRadio = document.querySelector('input[name="send_option"][value="now"]');
    const scheduleInput = document.getElementById('schedule_input');
    
    scheduleRadio.addEventListener('change', function() {
        if (this.checked) {
            scheduleInput.classList.remove('hidden');
            scheduleInput.querySelector('input').required = true;
        }
    });
    
    nowRadio.addEventListener('change', function() {
        if (this.checked) {
            scheduleInput.classList.add('hidden');
            scheduleInput.querySelector('input').required = false;
        }
    });

    // Handle template selection
    const templateSelect = document.getElementById('template');
    const messageTextarea = document.getElementById('message');
    
    templateSelect.addEventListener('change', function() {
        if (this.value) {
            fetch(`{{ route('admin.broadcast.template') }}?template=${this.value}`)
                .then(response => response.json())
                .then(data => {
                    messageTextarea.value = data.template;
                })
                .catch(error => console.error('Error:', error));
        }
    });

    // Handle target preview
    const previewBtn = document.getElementById('preview_btn');
    const userTypeSelect = document.getElementById('user_type');
    const targetPreview = document.getElementById('target_preview');
    
    previewBtn.addEventListener('click', function() {
        const userType = userTypeSelect.value;
        if (!userType) {
            alert('Pilih target terlebih dahulu');
            return;
        }
        
        previewBtn.disabled = true;
        previewBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Loading...';
        
        fetch('{{ route("admin.broadcast.preview") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                target_criteria: {
                    user_type: userType
                }
            })
        })
        .then(response => response.json())
        .then(data => {
            let html = `<div class="text-sm">
                <p class="font-medium text-gray-900 mb-2">${data.count} penerima</p>`;
            
            if (data.users.length > 0) {
                html += '<div class="space-y-1">';
                data.users.forEach(user => {
                    html += `<div class="text-xs text-gray-600">
                        <div>${user.name}</div>
                        <div class="text-gray-500">${user.whatsapp_number}</div>
                    </div>`;
                });
                html += '</div>';
                
                if (data.count > 10) {
                    html += `<p class="text-xs text-gray-500 mt-2">Dan ${data.count - 10} lainnya...</p>`;
                }
            }
            
            html += '</div>';
            targetPreview.innerHTML = html;
        })
        .catch(error => {
            console.error('Error:', error);
            targetPreview.innerHTML = '<p class="text-red-500 text-sm">Error loading preview</p>';
        })
        .finally(() => {
            previewBtn.disabled = false;
            previewBtn.innerHTML = '<i class="fas fa-eye mr-2"></i>Preview Target';
        });
    });

    // Form submission handling
    const form = document.getElementById('broadcastForm');
    form.addEventListener('submit', function(e) {
        const action = e.submitter.value;
        const sendOption = document.querySelector('input[name="send_option"]:checked').value;
        
        if (action === 'send') {
            if (sendOption === 'now') {
                const sendNowInput = document.createElement('input');
                sendNowInput.type = 'hidden';
                sendNowInput.name = 'send_now';
                sendNowInput.value = '1';
                form.appendChild(sendNowInput);
            }
        }
    });
});
</script>
@endpush
@endsection