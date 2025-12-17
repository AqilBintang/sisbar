@extends('layouts.app')

@section('title', 'Layanan - Pangling Barbershop')

@section('content')
<!-- Page Header -->
<section class="py-5 bg-success text-white">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="fw-bold mb-3">Layanan Kami</h1>
                <p class="lead">Berbagai layanan profesional untuk penampilan terbaik Anda</p>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Potong Rambut -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card service-card h-100">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <i class="bi bi-scissors service-icon"></i>
                            <h4 class="fw-bold">Potong Rambut</h4>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Konsultasi gaya rambut</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Potong sesuai bentuk wajah</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Styling dengan produk premium</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Keramas gratis</li>
                        </ul>
                        <div class="text-center mt-4">
                            <h5 class="text-success fw-bold">Rp 25.000 - Rp 50.000</h5>
                            <small class="text-muted">Durasi: 30-45 menit</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cukur Jenggot -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card service-card h-100">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <i class="bi bi-brush service-icon"></i>
                            <h4 class="fw-bold">Cukur Jenggot</h4>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Cukur dengan pisau cukur</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Hot towel treatment</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Aftershave premium</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Pijat wajah ringan</li>
                        </ul>
                        <div class="text-center mt-4">
                            <h5 class="text-success fw-bold">Rp 15.000 - Rp 30.000</h5>
                            <small class="text-muted">Durasi: 20-30 menit</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hair Treatment -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card service-card h-100">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <i class="bi bi-droplet service-icon"></i>
                            <h4 class="fw-bold">Hair Treatment</h4>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Deep cleansing shampoo</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Hair mask treatment</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Scalp massage</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Hair tonic application</li>
                        </ul>
                        <div class="text-center mt-4">
                            <h5 class="text-success fw-bold">Rp 35.000 - Rp 75.000</h5>
                            <small class="text-muted">Durasi: 45-60 menit</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Paket Lengkap -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card service-card h-100 border-success">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <span class="badge bg-success mb-2">PAKET HEMAT</span>
                            <i class="bi bi-star service-icon"></i>
                            <h4 class="fw-bold">Paket Lengkap</h4>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Potong rambut premium</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Cukur jenggot</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Hair treatment</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Face mask</li>
                        </ul>
                        <div class="text-center mt-4">
                            <h5 class="text-success fw-bold">Rp 65.000</h5>
                            <small class="text-muted">Hemat Rp 20.000! | Durasi: 90 menit</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hair Coloring -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="card service-card h-100">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <i class="bi bi-palette service-icon"></i>
                            <h4 class="fw-bold">Hair Coloring</h4>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Konsultasi warna</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Cat rambut premium</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Hair treatment post-coloring</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Styling finish</li>
                        </ul>
                        <div class="text-center mt-4">
                            <h5 class="text-success fw-bold">Rp 75.000 - Rp 150.000</h5>
                            <small class="text-muted">Durasi: 60-90 menit</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kids Haircut -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="card service-card h-100">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <i class="bi bi-emoji-smile service-icon"></i>
                            <h4 class="fw-bold">Kids Haircut</h4>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Potong rambut anak</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Suasana ramah anak</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Mainan dan hiburan</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Foto gratis</li>
                        </ul>
                        <div class="text-center mt-4">
                            <h5 class="text-success fw-bold">Rp 20.000</h5>
                            <small class="text-muted">Untuk anak usia 3-12 tahun</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <div class="bg-light p-5 rounded">
                    <h3 class="fw-bold mb-3">Tertarik dengan Layanan Kami?</h3>
                    <p class="text-muted mb-4">Booking sekarang dan nikmati pelayanan terbaik dari tim profesional kami</p>
                    <a href="/booking" class="btn btn-success btn-lg me-3">
                        <i class="bi bi-calendar-check me-2"></i>Book Sekarang
                    </a>
                    <a href="tel:+621234567890" class="btn btn-outline-success btn-lg">
                        <i class="bi bi-telephone me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection