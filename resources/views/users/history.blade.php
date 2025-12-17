@extends('layouts.app')

@section('title', 'History - Pangling Barbershop')

@section('content')
<!-- Page Header -->
<section class="py-5 bg-success text-white">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="fw-bold mb-3">Riwayat Booking</h1>
                <p class="lead">Lihat semua riwayat layanan yang pernah Anda gunakan</p>
            </div>
        </div>
    </div>
</section>

<!-- History Section -->
<section class="py-5">
    <div class="container">
        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" placeholder="Cari berdasarkan layanan atau tanggal...">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">Semua Status</option>
                    <option value="completed">Selesai</option>
                    <option value="cancelled">Dibatalkan</option>
                    <option value="upcoming">Akan Datang</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">Semua Layanan</option>
                    <option value="potong-rambut">Potong Rambut</option>
                    <option value="cukur-jenggot">Cukur Jenggot</option>
                    <option value="hair-treatment">Hair Treatment</option>
                    <option value="paket-lengkap">Paket Lengkap</option>
                </select>
            </div>
        </div>

        <!-- History Cards -->
        <div class="row g-4">
            <!-- Booking 1 - Completed -->
            <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-2 text-center">
                                <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="bi bi-scissors fs-4"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="fw-bold mb-1">Paket Lengkap</h5>
                                <p class="text-muted mb-1">Barber: Andi</p>
                                <p class="text-muted mb-0">
                                    <i class="bi bi-calendar me-1"></i>15 November 2024, 14:00
                                </p>
                            </div>
                            <div class="col-md-2 text-center">
                                <span class="badge bg-success fs-6">Selesai</span>
                            </div>
                            <div class="col-md-2 text-end">
                                <h5 class="fw-bold text-success mb-1">Rp 65.000</h5>
                                <button class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-arrow-repeat me-1"></i>Book Lagi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking 2 - Completed -->
            <div class="col-12" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-2 text-center">
                                <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="bi bi-brush fs-4"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="fw-bold mb-1">Potong Rambut + Cukur Jenggot</h5>
                                <p class="text-muted mb-1">Barber: Budi</p>
                                <p class="text-muted mb-0">
                                    <i class="bi bi-calendar me-1"></i>28 Oktober 2024, 16:30
                                </p>
                            </div>
                            <div class="col-md-2 text-center">
                                <span class="badge bg-success fs-6">Selesai</span>
                            </div>
                            <div class="col-md-2 text-end">
                                <h5 class="fw-bold text-success mb-1">Rp 40.000</h5>
                                <button class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-arrow-repeat me-1"></i>Book Lagi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking 3 - Upcoming -->
            <div class="col-12" data-aos="fade-up" data-aos-delay="300">
                <div class="card border-0 shadow-sm border-warning">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-2 text-center">
                                <div class="bg-warning text-dark rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="bi bi-droplet fs-4"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="fw-bold mb-1">Hair Treatment</h5>
                                <p class="text-muted mb-1">Barber: Candra</p>
                                <p class="text-muted mb-0">
                                    <i class="bi bi-calendar me-1"></i>20 Desember 2024, 10:00
                                </p>
                            </div>
                            <div class="col-md-2 text-center">
                                <span class="badge bg-warning text-dark fs-6">Akan Datang</span>
                            </div>
                            <div class="col-md-2 text-end">
                                <h5 class="fw-bold text-warning mb-1">Rp 50.000</h5>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-x-circle me-1"></i>Batalkan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking 4 - Cancelled -->
            <div class="col-12" data-aos="fade-up" data-aos-delay="400">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 opacity-75">
                        <div class="row align-items-center">
                            <div class="col-md-2 text-center">
                                <div class="bg-secondary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="bi bi-palette fs-4"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="fw-bold mb-1">Hair Coloring</h5>
                                <p class="text-muted mb-1">Barber: Dedi</p>
                                <p class="text-muted mb-0">
                                    <i class="bi bi-calendar me-1"></i>10 Oktober 2024, 15:00
                                </p>
                            </div>
                            <div class="col-md-2 text-center">
                                <span class="badge bg-secondary fs-6">Dibatalkan</span>
                            </div>
                            <div class="col-md-2 text-end">
                                <h5 class="fw-bold text-secondary mb-1">Rp 100.000</h5>
                                <button class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-arrow-repeat me-1"></i>Book Lagi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State (jika tidak ada history) -->
        <!-- 
        <div class="row">
            <div class="col-12 text-center py-5">
                <i class="bi bi-calendar-x text-muted mb-3" style="font-size: 4rem;"></i>
                <h4 class="text-muted mb-3">Belum Ada Riwayat Booking</h4>
                <p class="text-muted mb-4">Anda belum pernah melakukan booking layanan di Pangling Barbershop</p>
                <a href="/booking" class="btn btn-success btn-lg">
                    <i class="bi bi-calendar-plus me-2"></i>Booking Sekarang
                </a>
            </div>
        </div>
        -->

        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <div class="card border-0 h-100">
                    <div class="card-body">
                        <i class="bi bi-calendar-check text-success mb-3" style="font-size: 2.5rem;"></i>
                        <h4 class="fw-bold text-success">12</h4>
                        <p class="text-muted mb-0">Total Booking</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 h-100">
                    <div class="card-body">
                        <i class="bi bi-check-circle text-success mb-3" style="font-size: 2.5rem;"></i>
                        <h4 class="fw-bold text-success">10</h4>
                        <p class="text-muted mb-0">Selesai</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 h-100">
                    <div class="card-body">
                        <i class="bi bi-currency-dollar text-success mb-3" style="font-size: 2.5rem;"></i>
                        <h4 class="fw-bold text-success">Rp 520K</h4>
                        <p class="text-muted mb-0">Total Pengeluaran</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 h-100">
                    <div class="card-body">
                        <i class="bi bi-star text-success mb-3" style="font-size: 2.5rem;"></i>
                        <h4 class="fw-bold text-success">Paket Lengkap</h4>
                        <p class="text-muted mb-0">Layanan Favorit</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection