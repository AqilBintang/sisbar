@extends('layouts.admin')

@section('title', 'Konfigurasi WhatsApp')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Konfigurasi WhatsApp Broadcast</h3>
                    <a href="{{ route('admin.broadcast.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    
                    <!-- Current Service Status -->
                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle"></i> Service Aktif</h5>
                        <p class="mb-0">Saat ini menggunakan: <strong>{{ $config['current_service'] }}</strong></p>
                    </div>

                    <!-- Fonnte Configuration -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card {{ isset($config['fonnte']) && $config['fonnte']['configured'] ? 'border-success' : 'border-warning' }}">
                                <div class="card-header {{ isset($config['fonnte']) && $config['fonnte']['configured'] ? 'bg-success text-white' : 'bg-warning' }}">
                                    <h5 class="mb-0">
                                        <i class="fab fa-whatsapp"></i> Fonnte WhatsApp
                                        @if(isset($config['fonnte']) && $config['fonnte']['configured'])
                                            <span class="badge badge-light ml-2">{{ $config['fonnte']['status'] }}</span>
                                        @endif
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4"><strong>Status:</strong></div>
                                        <div class="col-sm-8">
                                            @if(isset($config['fonnte']) && $config['fonnte']['configured'])
                                                <span class="badge badge-success">Configured</span>
                                            @else
                                                <span class="badge badge-warning">Not Configured</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-4"><strong>Token:</strong></div>
                                        <div class="col-sm-8">
                                            <code>{{ isset($config['fonnte']) ? $config['fonnte']['token'] : 'Not available' }}</code>
                                        </div>
                                    </div>
                                    
                                    @if(!isset($config['fonnte']) || !$config['fonnte']['configured'])
                                    <div class="mt-3">
                                        <h6>Setup Fonnte:</h6>
                                        <ol class="small">
                                            <li>Daftar di <a href="https://fonnte.com" target="_blank">fonnte.com</a></li>
                                            <li>Dapatkan token API dari dashboard</li>
                                            <li>Tambahkan ke file .env:</li>
                                        </ol>
                                        <pre class="bg-light p-2 small"><code>FONNTE_TOKEN=your_actual_token_here</code></pre>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Twilio Configuration -->
                        <div class="col-md-6">
                            <div class="card {{ $config['twilio']['configured'] ? 'border-info' : 'border-secondary' }}">
                                <div class="card-header {{ $config['twilio']['configured'] ? 'bg-info text-white' : 'bg-secondary text-white' }}">
                                    <h5 class="mb-0">
                                        <i class="fas fa-phone"></i> Twilio WhatsApp
                                        @if($config['twilio']['configured'])
                                            <span class="badge badge-light ml-2">{{ $config['twilio']['status'] }}</span>
                                        @endif
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4"><strong>Status:</strong></div>
                                        <div class="col-sm-8">
                                            @if($config['twilio']['configured'])
                                                <span class="badge badge-info">Configured</span>
                                            @else
                                                <span class="badge badge-secondary">Not Configured</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-4"><strong>Account SID:</strong></div>
                                        <div class="col-sm-8">
                                            <code>{{ $config['twilio']['sid'] }}</code>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-4"><strong>From Number:</strong></div>
                                        <div class="col-sm-8">
                                            <code>{{ $config['twilio']['from'] ?? 'Not set' }}</code>
                                        </div>
                                    </div>
                                    
                                    @if($config['twilio']['configured'])
                                    <div class="mt-3">
                                        <div class="alert alert-warning small">
                                            <strong>Catatan:</strong> Twilio Sandbox hanya bisa mengirim ke nomor yang sudah join sandbox.
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Priority -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Prioritas Service</h5>
                        </div>
                        <div class="card-body">
                            <p>Sistem akan menggunakan service dengan prioritas berikut:</p>
                            <ol>
                                <li><strong>Fonnte</strong> - Service utama (recommended untuk Indonesia)</li>
                                <li><strong>Twilio</strong> - Service cadangan</li>
                                <li><strong>Mock</strong> - Untuk testing (jika tidak ada service yang dikonfigurasi)</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Test Commands -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5>Test Commands</h5>
                        </div>
                        <div class="card-body">
                            <p>Gunakan command berikut untuk test konfigurasi:</p>
                            
                            <h6>Test Fontte:</h6>
                            <pre class="bg-light p-2"><code>php artisan fontte:test --number=085729421875</code></pre>
                            
                            <h6>Test Broadcast Umum:</h6>
                            <pre class="bg-light p-2"><code>php artisan broadcast:test</code></pre>
                            
                            <h6>Test Broadcast ke Semua User:</h6>
                            <pre class="bg-light p-2"><code>php artisan broadcast:send-test</code></pre>
                        </div>
                    </div>

                    <!-- Documentation Links -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5>Dokumentasi</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Setup Guides:</h6>
                                    <ul>
                                        <li><a href="{{ asset('FONNTE_WHATSAPP_SETUP.md') }}" target="_blank">Setup Fonnte WhatsApp</a></li>
                                        <li><a href="{{ asset('TWILIO_WHATSAPP_SETUP.md') }}" target="_blank">Setup Twilio WhatsApp</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>External Links:</h6>
                                    <ul>
                                        <li><a href="https://fonnte.com" target="_blank">Fonnte Dashboard</a></li>
                                        <li><a href="https://console.twilio.com" target="_blank">Twilio Console</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection