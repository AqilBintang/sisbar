@extends('layouts.app')

@section('title', 'Booking - Pangling Barbershop')

@section('content')
<!-- Page Header -->
<section class="py-5 bg-success text-white">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="fw-bold mb-3">Booking Layanan</h1>
                <p class="lead">Reservasi mudah untuk pengalaman barbershop terbaik</p>
            </div>
        </div>
    </div>
</section>

<!-- Booking Form Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4 fw-bold" data-aos="fade-down" data-aos-delay="200">Form Reservasi</h3>
                        
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" placeholder="Masukkan nama lengkap">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label fw-semibold">No. Telepon</label>
                                    <input type="tel" class="form-control" id="phone" placeholder="08xxxxxxxxxx">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="nama@email.com">
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal" class="form-label fw-semibold">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="waktu" class="form-label fw-semibold">Waktu</label>
                                    <select class="form-select" id="waktu">
                                        <option value="">Pilih waktu</option>
                                        <option value="09:00">09:00</option>
                                        <option value="10:00">10:00</option>
                                        <option value="11:00">11:00</option>
                                        <option value="13:00">13:00</option>
                                        <option value="14:00">14:00</option>
                                        <option value="15:00">15:00</option>
                                        <option value="16:00">16:00</option>
                                        <option value="17:00">17:00</option>
                                        <option value="18:00">18:00</option>
                                        <option value="19:00">19:00</option>
                                        <option value="20:00">20:00</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="layanan" class="form-label fw-semibold">Pilih Layanan</label>
                                <select class="form-select" id="layanan">
                                    <option value="">Pilih layanan</option>
                                    <option value="potong-rambut">Potong Rambut (Rp 25.000 - Rp 50.000)</option>
                                    <option value="cukur-jenggot">Cukur Jenggot (Rp 15.000 - Rp 30.000)</option>
                                    <option value="hair-treatment">Hair Treatment (Rp 35.000 - Rp 75.000)</option>
                                    <option value="paket-lengkap">Paket Lengkap (Rp 65.000)</option>
                                    <option value="hair-coloring">Hair Coloring (Rp 75.000 - Rp 150.000)</option>
                                    <option value="kids-haircut">Kids Haircut (Rp 20.000)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="barber" class="form-label fw-semibold">Pilih Barber (Opsional)</label>
                                <select class="form-select" id="barber">
                                    <option value="">Pilih barber atau biarkan kosong</option>
                                    <option value="andi">Andi - Senior Barber</option>
                                    <option value="budi">Budi - Hair Specialist</option>
                                    <option value="candra">Candra - Style Expert</option>
                                    <option value="dedi">Dedi - Classic Barber</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="catatan" class="form-label fw-semibold">Catatan Khusus (Opsional)</label>
                                <textarea class="form-control" id="catatan" rows="3" placeholder="Tuliskan permintaan khusus atau gaya yang diinginkan..."></textarea>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="bi bi-calendar-check me-2"></i>Konfirmasi Booking
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Info Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h3 class="fw-bold">Informasi Penting</h3>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <i class="bi bi-clock text-success mb-3" style="font-size: 2.5rem;"></i>
                <h5 class="fw-bold">Jam Operasional</h5>
                <p class="text-muted mb-1">Senin - Sabtu: 09:00 - 21:00</p>
                <p class="text-muted">Minggu: 10:00 - 18:00</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="bi bi-calendar-x text-success mb-3" style="font-size: 2.5rem;"></i>
                <h5 class="fw-bold">Kebijakan Pembatalan</h5>
                <p class="text-muted">Pembatalan dapat dilakukan minimal 2 jam sebelum jadwal booking</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="bi bi-cash text-success mb-3" style="font-size: 2.5rem;"></i>
                <h5 class="fw-bold">Metode Pembayaran</h5>
                <p class="text-muted">Cash (Bayar di tempat)</p>
            </div>
        </div>
    </div>
</section>
@endsection