@extends('layouts.admin')

@section('title', 'Buat Broadcast Baru - Simple')

@section('content')
<div class="container-fluid p-6">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Buat Broadcast Baru</h3>
                    <a href="{{ route('admin.broadcast.index') }}" class="btn btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('admin.broadcast.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                
                                <!-- Title -->
                                <div class="form-group">
                                    <label for="title">Judul Broadcast *</label>
                                    <input type="text" class="form-control" id="title" name="title" 
                                           value="{{ old('title') }}" required 
                                           placeholder="Masukkan judul broadcast">
                                </div>

                                <!-- Type -->
                                <div class="form-group">
                                    <label for="type">Tipe Broadcast *</label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option value="">Pilih Tipe</option>
                                        <option value="promo" {{ old('type') === 'promo' ? 'selected' : '' }}>Promo</option>
                                        <option value="notification" {{ old('type') === 'notification' ? 'selected' : '' }}>Notifikasi</option>
                                        <option value="reminder" {{ old('type') === 'reminder' ? 'selected' : '' }}>Pengingat</option>
                                        <option value="general" {{ old('type') === 'general' ? 'selected' : '' }}>Umum</option>
                                    </select>
                                </div>

                                <!-- Message -->
                                <div class="form-group">
                                    <label for="message">Pesan *</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required 
                                              placeholder="Tulis pesan broadcast...">{{ old('message') }}</textarea>
                                    <small class="form-text text-muted">
                                        Variabel: {name}, {email}, {date}, {time}, {barber}, {total}
                                    </small>
                                </div>

                                <!-- Target -->
                                <div class="form-group">
                                    <label for="user_type">Target Penerima *</label>
                                    <select class="form-control" id="user_type" name="target_criteria[user_type]" required>
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
                                    </select>
                                </div>

                                <!-- Send Options -->
                                <div class="form-group">
                                    <label>Jadwal Pengiriman</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="send_option" id="send_now" value="now" checked>
                                        <label class="form-check-label" for="send_now">
                                            Kirim Sekarang
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="send_option" id="send_draft" value="draft">
                                        <label class="form-check-label" for="send_draft">
                                            Simpan sebagai Draft
                                        </label>
                                    </div>
                                </div>

                                <!-- Submit Buttons -->
                                <div class="form-group">
                                    <button type="submit" name="action" value="send" class="btn btn-warning">
                                        <i class="fas fa-paper-plane"></i> Kirim Broadcast
                                    </button>
                                    <button type="submit" name="action" value="draft" class="btn btn-secondary ml-2">
                                        <i class="fas fa-save"></i> Simpan Draft
                                    </button>
                                    <a href="{{ route('admin.broadcast.index') }}" class="btn btn-light ml-2">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                </div>

                            </div>
                            
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Preview Target</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="target_preview">
                                            <p class="text-muted">Pilih target untuk melihat preview</p>
                                        </div>
                                        <button type="button" id="preview_btn" class="btn btn-info btn-sm mt-2">
                                            <i class="fas fa-eye"></i> Preview
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview functionality
    document.getElementById('preview_btn').addEventListener('click', function() {
        const userType = document.getElementById('user_type').value;
        if (!userType) {
            alert('Pilih target terlebih dahulu');
            return;
        }
        
        this.disabled = true;
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        
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
            let html = `<p><strong>${data.count} penerima</strong></p>`;
            if (data.users.length > 0) {
                html += '<ul class="list-unstyled small">';
                data.users.forEach(user => {
                    html += `<li>${user.name} (${user.whatsapp_number})</li>`;
                });
                html += '</ul>';
                if (data.count > 10) {
                    html += `<p class="small text-muted">Dan ${data.count - 10} lainnya...</p>`;
                }
            }
            document.getElementById('target_preview').innerHTML = html;
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('target_preview').innerHTML = '<p class="text-danger">Error loading preview</p>';
        })
        .finally(() => {
            this.disabled = false;
            this.innerHTML = '<i class="fas fa-eye"></i> Preview';
        });
    });

    // Form submission
    document.querySelector('form').addEventListener('submit', function(e) {
        const action = e.submitter.value;
        const sendOption = document.querySelector('input[name="send_option"]:checked').value;
        
        if (action === 'send' && sendOption === 'now') {
            const sendNowInput = document.createElement('input');
            sendNowInput.type = 'hidden';
            sendNowInput.name = 'send_now';
            sendNowInput.value = '1';
            this.appendChild(sendNowInput);
        }
    });
});
</script>
@endsection