@extends('layouts.app')

@section('title', 'Dashboard - Pangling Barbershop')

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(rgba(28, 28, 28, 0.6), rgba(40, 167, 69, 0.7)), 
                    url('{{ asset("images/bg-barber.jpg") }}');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 100vh;
        display: flex;
        align-items: center;
        position: relative;
    }
    
    /* Fallback for mobile devices where background-attachment: fixed might not work */
    @media (max-width: 768px) {
        .hero-section {
            background-attachment: scroll;
        }
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(28, 28, 28, 0.7) 0%, rgba(40, 167, 69, 0.5) 100%);
        z-index: 1;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
    }
    
    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }
    
    .hero-subtitle {
        font-size: 1.3rem;
        margin-bottom: 2.5rem;
        opacity: 0.95;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }
    
    .btn-custom {
        background-color: var(--green);
        color: white;
        border: none;
        padding: 15px 35px;
        font-weight: 600;
        border-radius: 30px;
        transition: all 0.3s;
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
    }
    
    .btn-custom:hover {
        background-color: var(--green-light);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    }
    
    .floating-animation {
        animation: floating 3s ease-in-out infinite;
    }
    
    @keyframes floating {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    .barbershop-tools {
        position: absolute;
        opacity: 0.1;
        font-size: 8rem;
        color: white;
        z-index: 1;
    }
    
    .tool-1 { top: 10%; left: 10%; animation: floating 4s ease-in-out infinite; }
    .tool-2 { top: 20%; right: 15%; animation: floating 5s ease-in-out infinite reverse; }
    .tool-3 { bottom: 20%; left: 20%; animation: floating 6s ease-in-out infinite; }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <!-- Floating barbershop tools -->
    <i class="bi bi-scissors barbershop-tools tool-1"></i>
    <i class="bi bi-brush barbershop-tools tool-2"></i>
    <i class="bi bi-droplet barbershop-tools tool-3"></i>
    
    <div class="container hero-content">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                <h1 class="hero-title text-white">Selamat Datang di Pangling Barbershop</h1>
                <p class="hero-subtitle text-white">
                    Nikmati pengalaman potong rambut dan perawatan jenggot terbaik dengan layanan profesional dan suasana yang nyaman.
                </p>
                <a href="/layanan" class="btn btn-custom btn-lg" data-aos="zoom-in" data-aos-delay="600">
                    <i class="bi bi-scissors me-2"></i>Lihat Layanan Kami
                </a>
            </div>
            <div class="col-lg-6 text-center" data-aos="fade-left" data-aos-delay="400">
                <div class="floating-animation">
                    <img src="{{ asset('images/barbershop-hero.jpg') }}" alt="Pangling Barbershop" class="img-fluid rounded shadow-lg" 
                         style="max-height: 500px; object-fit: cover; border: 3px solid rgba(255,255,255,0.2);" 
                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAwIiBoZWlnaHQ9IjQwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjMzQ0OTVlIi8+PHRleHQgeD0iNTAlIiB5PSI0NSUiIGZvbnQtc2l6ZT0iMjQiIGZpbGw9IndoaXRlIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkeT0iLjNlbSI+UGFuZ2xpbmcgQmFyYmVyc2hvcDwvdGV4dD48dGV4dCB4PSI1MCUiIHk9IjYwJSIgZm9udC1zaXplPSIxNiIgZmlsbD0iI2VjZjBmMSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkV4cGVyaWVuY2UgUHJvZmVzc2lvbmFsPC90ZXh0Pjwvc3ZnPg=='">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Preview Section -->
<section class="services-section bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold mb-3">Layanan Unggulan Kami</h2>
                <p class="text-muted">Berbagai layanan profesional untuk penampilan terbaik Anda</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card service-card h-100 text-center p-4">
                    <div class="card-body">
                        <i class="bi bi-scissors service-icon"></i>
                        <h5 class="card-title fw-bold">Potong Rambut</h5>
                        <p class="card-text text-muted">
                            Potong rambut dengan gaya modern dan klasik sesuai keinginan Anda
                        </p>
                        <div class="mt-3">
                            <span class="badge bg-success fs-6">Mulai Rp 25.000</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card service-card h-100 text-center p-4">
                    <div class="card-body">
                        <i class="bi bi-brush service-icon"></i>
                        <h5 class="card-title fw-bold">Cukur Jenggot</h5>
                        <p class="card-text text-muted">
                            Perawatan jenggot profesional untuk tampilan yang rapi dan stylish
                        </p>
                        <div class="mt-3">
                            <span class="badge bg-success fs-6">Mulai Rp 15.000</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card service-card h-100 text-center p-4">
                    <div class="card-body">
                        <i class="bi bi-droplet service-icon"></i>
                        <h5 class="card-title fw-bold">Hair Treatment</h5>
                        <p class="card-text text-muted">
                            Perawatan rambut khusus untuk menjaga kesehatan dan kilau rambut
                        </p>
                        <div class="mt-3">
                            <span class="badge bg-success fs-6">Mulai Rp 35.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-12 text-center" data-aos="fade-up" data-aos-delay="400">
                <a href="/layanan" class="btn btn-outline-success btn-lg">
                    Lihat Semua Layanan <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold mb-3">Mengapa Memilih Pangling Barbershop?</h2>
                <p class="text-muted">Komitmen kami untuk memberikan pelayanan terbaik</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3 text-center" data-aos="zoom-in" data-aos-delay="100">
                <div class="mb-3">
                    <i class="bi bi-award text-success" style="font-size: 3rem;"></i>
                </div>
                <h5 class="fw-bold">Barber Profesional</h5>
                <p class="text-muted small">Tim barber berpengalaman dan terlatih</p>
            </div>
            
            <div class="col-md-3 text-center" data-aos="zoom-in" data-aos-delay="200">
                <div class="mb-3">
                    <i class="bi bi-clock text-success" style="font-size: 3rem;"></i>
                </div>
                <h5 class="fw-bold">Booking Online</h5>
                <p class="text-muted small">Sistem reservasi mudah dan praktis</p>
            </div>
            
            <div class="col-md-3 text-center" data-aos="zoom-in" data-aos-delay="300">
                <div class="mb-3">
                    <i class="bi bi-shield-check text-success" style="font-size: 3rem;"></i>
                </div>
                <h5 class="fw-bold">Alat Steril</h5>
                <p class="text-muted small">Kebersihan dan sterilisasi terjamin</p>
            </div>
            
            <div class="col-md-3 text-center" data-aos="zoom-in" data-aos-delay="400">
                <div class="mb-3">
                    <i class="bi bi-currency-dollar text-success" style="font-size: 3rem;"></i>
                </div>
                <h5 class="fw-bold">Harga Terjangkau</h5>
                <p class="text-muted small">Kualitas premium dengan harga bersahabat</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-success text-white">
    <div class="container">
        <div class="row align-items-center" data-aos="fade-up">
            <div class="col-lg-8" data-aos="fade-right" data-aos-delay="100">
                <h3 class="fw-bold mb-2">Siap untuk Tampil Lebih Percaya Diri?</h3>
                <p class="mb-0">Booking sekarang dan dapatkan potongan harga untuk kunjungan pertama!</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0" data-aos="fade-left" data-aos-delay="200">
                <a href="/booking" class="btn btn-light btn-lg text-success fw-bold">
                    <i class="bi bi-calendar-check me-2"></i>Book Sekarang
                </a>
            </div>
        </div>
    </div>
</section>
@endsection