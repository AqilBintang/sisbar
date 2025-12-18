<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sisbar Hairstudio')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-sisbar.png') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    
    <!-- Inline CSS for ngrok compatibility -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 50%, #1a1a1a 100%);
            min-height: 100vh;
            color: #ffffff;
        }

        /* Navbar Styles */
        .navbar {
            background: rgba(26, 26, 26, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(251, 191, 36, 0.2);
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            color: #fbbf24;
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
        }

        .navbar-nav {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-link {
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
            cursor: pointer;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #fbbf24;
        }

        .navbar-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: #1a1a1a;
        }

        .btn-outline {
            background: transparent;
            color: #fbbf24;
            border: 2px solid #fbbf24;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(251, 191, 36, 0.3);
        }

        /* Main Content */
        .main-content {
            margin-top: 80px;
            min-height: calc(100vh - 80px);
            padding: 2rem;
        }

        .page-section {
            display: none;
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-section.active {
            display: block;
        }

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 4rem 0;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.8;
        }

        /* Services Grid */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .service-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        .service-card h3 {
            color: #fbbf24;
            margin-bottom: 1rem;
        }

        /* Barbers Grid */
        .barbers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .barber-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .barber-card:hover {
            transform: translateY(-5px);
        }

        .barber-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #fbbf24;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #1a1a1a;
        }

        /* Booking Form */
        .booking-form {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 2rem;
            max-width: 600px;
            margin: 2rem auto;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #fbbf24;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid rgba(251, 191, 36, 0.3);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            font-size: 1rem;
        }

        .form-control:focus {
            outline: none;
            border-color: #fbbf24;
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-nav {
                display: none;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .main-content {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="#" class="navbar-brand" onclick="showPage('home')">
                🏠 Sisbar Hairstudio
            </a>
            
            <ul class="navbar-nav">
                <li><a href="javascript:void(0)" data-navigate="home" class="nav-link">Home</a></li>
                <li><a href="javascript:void(0)" data-navigate="services" class="nav-link">Layanan</a></li>
                <li><a href="javascript:void(0)" data-navigate="barbers" class="nav-link">Kapster</a></li>
                <li><a href="javascript:void(0)" data-navigate="booking" class="nav-link">Booking</a></li>
                <li><a href="javascript:void(0)" data-navigate="availability" class="nav-link">Cek Ketersediaan</a></li>
            </ul>
            
            <div class="navbar-buttons">
                <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
                <a href="#" class="btn btn-primary" onclick="showPage('booking')">Book Now</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Home Page -->
        <div id="home" class="page-section active">
            <div class="hero">
                <h1>Selamat Datang di Sisbar Hairstudio</h1>
                <p>Tempat terbaik untuk perawatan rambut dan gaya hidup modern Anda</p>
                <a href="#" class="btn btn-primary" onclick="showPage('booking')">Book Sekarang</a>
            </div>
            
            <div class="services-grid">
                <div class="service-card">
                    <h3>Haircut Premium</h3>
                    <p>Potong rambut dengan teknik modern dan styling terkini</p>
                    <p><strong>Rp 50.000</strong></p>
                </div>
                <div class="service-card">
                    <h3>Beard Trim</h3>
                    <p>Perawatan jenggot profesional untuk tampilan yang rapi</p>
                    <p><strong>Rp 25.000</strong></p>
                </div>
                <div class="service-card">
                    <h3>Complete Package</h3>
                    <p>Paket lengkap haircut + beard trim + styling</p>
                    <p><strong>Rp 70.000</strong></p>
                </div>
            </div>
        </div>

        <!-- Services Page -->
        <div id="services" class="page-section">
            <div class="hero">
                <h1>Layanan Kami</h1>
                <p>Berbagai layanan profesional untuk kebutuhan grooming Anda</p>
            </div>
            
            <div class="services-grid">
                <div class="service-card">
                    <h3>Haircut</h3>
                    <p>Potong rambut standar dengan hasil yang rapi dan profesional</p>
                    <p><strong>Rp 35.000</strong></p>
                </div>
                <div class="service-card">
                    <h3>Haircut Premium</h3>
                    <p>Potong rambut dengan konsultasi styling dan finishing premium</p>
                    <p><strong>Rp 50.000</strong></p>
                </div>
                <div class="service-card">
                    <h3>Beard Trim</h3>
                    <p>Perawatan jenggot dengan teknik profesional</p>
                    <p><strong>Rp 25.000</strong></p>
                </div>
                <div class="service-card">
                    <h3>Creambath</h3>
                    <p>Perawatan rambut dengan cream bath untuk kesehatan rambut</p>
                    <p><strong>Rp 40.000</strong></p>
                </div>
                <div class="service-card">
                    <h3>Complete Package</h3>
                    <p>Paket lengkap semua layanan dengan harga spesial</p>
                    <p><strong>Rp 70.000</strong></p>
                </div>
            </div>
        </div>

        <!-- Barbers Page -->
        <div id="barbers" class="page-section">
            <div class="hero">
                <h1>Tim Kapster Profesional</h1>
                <p>Bertemu dengan tim ahli kami yang berpengalaman</p>
            </div>
            
            <div class="barbers-grid">
                <div class="barber-card">
                    <div class="barber-avatar">AH</div>
                    <h3>Ahmad Rizki</h3>
                    <p>Senior Barber</p>
                    <p>Spesialis: Modern Cut, Fade</p>
                    <p>⭐ 4.9 (150+ reviews)</p>
                </div>
                <div class="barber-card">
                    <div class="barber-avatar">BS</div>
                    <h3>Budi Santoso</h3>
                    <p>Master Barber</p>
                    <p>Spesialis: Classic Cut, Beard</p>
                    <p>⭐ 4.8 (200+ reviews)</p>
                </div>
                <div class="barber-card">
                    <div class="barber-avatar">DK</div>
                    <h3>Dedi Kurniawan</h3>
                    <p>Professional Barber</p>
                    <p>Spesialis: Trendy Style, Color</p>
                    <p>⭐ 4.7 (120+ reviews)</p>
                </div>
                <div class="barber-card">
                    <div class="barber-avatar">EP</div>
                    <h3>Eko Prasetyo</h3>
                    <p>Expert Barber</p>
                    <p>Spesialis: Premium Cut, Styling</p>
                    <p>⭐ 4.9 (180+ reviews)</p>
                </div>
            </div>
        </div>

        <!-- Booking Page -->
        <div id="booking" class="page-section">
            <div class="hero">
                <h1>Book Appointment</h1>
                <p>Reservasi jadwal Anda dengan mudah</p>
            </div>
            
            <form class="booking-form">
                <div class="form-group">
                    <label for="service">Pilih Layanan</label>
                    <select id="service" class="form-control">
                        <option value="">-- Pilih Layanan --</option>
                        <option value="haircut">Haircut - Rp 35.000</option>
                        <option value="haircut-premium">Haircut Premium - Rp 50.000</option>
                        <option value="beard-trim">Beard Trim - Rp 25.000</option>
                        <option value="creambath">Creambath - Rp 40.000</option>
                        <option value="complete">Complete Package - Rp 70.000</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="barber">Pilih Kapster</label>
                    <select id="barber" class="form-control">
                        <option value="">-- Pilih Kapster --</option>
                        <option value="ahmad">Ahmad Rizki</option>
                        <option value="budi">Budi Santoso</option>
                        <option value="dedi">Dedi Kurniawan</option>
                        <option value="eko">Eko Prasetyo</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="date">Tanggal</label>
                    <input type="date" id="date" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="time">Waktu</label>
                    <select id="time" class="form-control">
                        <option value="">-- Pilih Waktu --</option>
                        <option value="09:00">09:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="13:00">13:00</option>
                        <option value="14:00">14:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" class="form-control" placeholder="Masukkan nama lengkap">
                </div>
                
                <div class="form-group">
                    <label for="phone">No. Telepon</label>
                    <input type="tel" id="phone" class="form-control" placeholder="Masukkan nomor telepon">
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">Book Sekarang</button>
            </form>
        </div>

        <!-- Availability Page -->
        <div id="availability" class="page-section">
            <div class="hero">
                <h1>Cek Ketersediaan</h1>
                <p>Lihat jadwal kosong kapster kami</p>
            </div>
            
            <div class="booking-form">
                <div class="form-group">
                    <label for="check-date">Pilih Tanggal</label>
                    <input type="date" id="check-date" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="check-barber">Pilih Kapster</label>
                    <select id="check-barber" class="form-control">
                        <option value="">-- Semua Kapster --</option>
                        <option value="ahmad">Ahmad Rizki</option>
                        <option value="budi">Budi Santoso</option>
                        <option value="dedi">Dedi Kurniawan</option>
                        <option value="eko">Eko Prasetyo</option>
                    </select>
                </div>
                
                <button type="button" class="btn btn-primary" onclick="checkAvailability()">Cek Ketersediaan</button>
                
                <div id="availability-result" style="margin-top: 2rem; display: none;">
                    <h3>Jadwal Tersedia:</h3>
                    <div class="services-grid">
                        <div class="service-card">
                            <h4>09:00 - 10:00</h4>
                            <p>Ahmad Rizki - Tersedia</p>
                        </div>
                        <div class="service-card">
                            <h4>10:00 - 11:00</h4>
                            <p>Budi Santoso - Tersedia</p>
                        </div>
                        <div class="service-card">
                            <h4>13:00 - 14:00</h4>
                            <p>Dedi Kurniawan - Tersedia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('components.footer')

    <!-- JavaScript -->
    <script>
        function showPage(pageId) {
            // Hide all pages
            const pages = document.querySelectorAll('.page-section');
            pages.forEach(page => {
                page.classList.remove('active');
            });
            
            // Show selected page
            const targetPage = document.getElementById(pageId);
            if (targetPage) {
                targetPage.classList.add('active');
            }
            
            // Update active nav link
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.classList.remove('active');
            });
            
            // Add active class to current nav link
            const currentLink = document.querySelector(`[onclick="showPage('${pageId}')"]`);
            if (currentLink) {
                currentLink.classList.add('active');
            }
        }
        
        function checkAvailability() {
            const result = document.getElementById('availability-result');
            result.style.display = 'block';
        }
        
        // Form submission
        document.querySelector('.booking-form form')?.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Booking berhasil! Kami akan menghubungi Anda untuk konfirmasi.');
        });
        
        // Set minimum date to today
        const dateInputs = document.querySelectorAll('input[type="date"]');
        const today = new Date().toISOString().split('T')[0];
        dateInputs.forEach(input => {
            input.min = today;
        });
    </script>
</body>
</html>