@extends('layouts.app')

@section('title', 'Profile - Pangling Barbershop')

@section('content')
<!-- Page Header -->
<section class="py-5 bg-success text-white">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="fw-bold mb-3">Profil Saya</h1>
                <p class="lead">Kelola informasi akun dan preferensi Anda</p>
            </div>
        </div>
    </div>
</section>

<!-- Profile Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Profile Info -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="mb-4">
                            <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                                <i class="bi bi-person-fill" style="font-size: 3rem;"></i>
                            </div>
                            <h4 class="fw-bold mb-1">John Doe</h4>
                            <p class="text-muted">Member sejak November 2024</p>
                        </div>
                        
                        <div class="row text-center">
                            <div class="col-4">
                                <h5 class="fw-bold text-success mb-0">12</h5>
                                <small class="text-muted">Total Booking</small>
                            </div>
                            <div class="col-4">
                                <h5 class="fw-bold text-success mb-0">10</h5>
                                <small class="text-muted">Selesai</small>
                            </div>
                            <div class="col-4">
                                <h5 class="fw-bold text-success mb-0">5★</h5>
                                <small class="text-muted">Rating</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Aksi Cepat</h5>
                        <div class="d-grid gap-2">
                            <a href="/booking" class="btn btn-success">
                                <i class="bi bi-calendar-plus me-2"></i>Booking Baru
                            </a>
                            <a href="/history" class="btn btn-outline-success">
                                <i class="bi bi-clock-history me-2"></i>Lihat History
                            </a>
                            <a href="/layanan" class="btn btn-outline-success">
                                <i class="bi bi-scissors me-2"></i>Lihat Layanan
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Form -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Informasi Pribadi</h5>
                        
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName" class="form-label fw-semibold">Nama Depan</label>
                                    <input type="text" class="form-control" id="firstName" value="John">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName" class="form-label fw-semibold">Nama Belakang</label>
                                    <input type="text" class="form-control" id="lastName" value="Doe">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" id="email" value="john.doe@email.com">
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label fw-semibold">No. Telepon</label>
                                    <input type="tel" class="form-control" id="phone" value="081234567890">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="birthDate" class="form-label fw-semibold">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="birthDate" value="1990-01-15">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label fw-semibold">Alamat</label>
                                <textarea class="form-control" id="address" rows="3">Jl. Contoh No. 123, Jakarta Selatan</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="preferences" class="form-label fw-semibold">Preferensi Layanan</label>
                                <textarea class="form-control" id="preferences" rows="2" placeholder="Ceritakan gaya rambut atau preferensi khusus Anda...">Suka gaya rambut pendek, rapih, dan mudah diatur</textarea>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
                                </button>
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Reset
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Change Password -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Ubah Password</h5>
                        
                        <form>
                            <div class="mb-3">
                                <label for="currentPassword" class="form-label fw-semibold">Password Saat Ini</label>
                                <input type="password" class="form-control" id="currentPassword">
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="newPassword" class="form-label fw-semibold">Password Baru</label>
                                    <input type="password" class="form-control" id="newPassword">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="confirmPassword" class="form-label fw-semibold">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" id="confirmPassword">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-shield-lock me-2"></i>Ubah Password
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Notification Settings -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Pengaturan Notifikasi</h5>
                        
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="emailNotif" checked>
                            <label class="form-check-label" for="emailNotif">
                                <strong>Email Notifikasi</strong><br>
                                <small class="text-muted">Terima notifikasi booking dan promosi via email</small>
                            </label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="smsNotif" checked>
                            <label class="form-check-label" for="smsNotif">
                                <strong>SMS Reminder</strong><br>
                                <small class="text-muted">Terima pengingat booking via SMS</small>
                            </label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="promoNotif">
                            <label class="form-check-label" for="promoNotif">
                                <strong>Notifikasi Promosi</strong><br>
                                <small class="text-muted">Terima informasi promo dan penawaran khusus</small>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-bell me-2"></i>Simpan Pengaturan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Loyalty Program -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h3 class="fw-bold">Program Loyalitas</h3>
                <p class="text-muted">Dapatkan poin setiap kali menggunakan layanan kami</p>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-3 text-center">
                                <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 80px; height: 80px;">
                                    <i class="bi bi-star-fill" style="font-size: 2rem;"></i>
                                </div>
                                <h5 class="fw-bold text-success">Gold Member</h5>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold mb-2">Poin Anda: <span class="text-success">850 poin</span></h6>
                                <div class="progress mb-2" style="height: 10px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="text-muted">150 poin lagi untuk mencapai Platinum Member</small>
                            </div>
                            <div class="col-md-3 text-center">
                                <button class="btn btn-success">
                                    <i class="bi bi-gift me-2"></i>Tukar Poin
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection