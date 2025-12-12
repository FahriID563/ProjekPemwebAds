<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Warung Kenyang Selalu - Sistem Pemesanan Makanan Terjadwal. Pesan makanan favorit Anda secara online, tanpa antri!">
    <title>Warung Kenyang Selalu - Sistem Pemesanan Makanan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        /* ========== LANDING PAGE MOBILE RESPONSIVE ========== */
        @media (max-width: 768px) {
            body {
                padding-top: 60px;
            }

            .navbar {
                padding: 0.4rem 0;
            }

            .navbar-brand {
                font-size: 0.9rem;
            }

            .navbar-toggler {
                border: none;
                padding: 0.2rem 0.4rem;
                font-size: 0.8rem;
            }

            .hero-section {
                padding: 10px 0 30px;
            }

            .hero-section .row {
                min-height: auto !important;
            }

            .hero-section h1 {
                font-size: 1.4rem;
                margin-bottom: 0.75rem;
            }

            .hero-section .lead {
                font-size: 0.85rem;
                margin-bottom: 1rem;
            }

            .floating-element {
                display: none;
            }

            .hero-badges {
                gap: 0.35rem;
                margin-bottom: 1rem;
            }

            .hero-badge {
                padding: 0.3rem 0.5rem;
                font-size: 0.65rem;
            }

            .hero-cta {
                gap: 0.5rem;
            }

            .hero-cta .btn {
                padding: 0.4rem 0.75rem;
                font-size: 0.8rem;
            }

            .hero-image {
                margin-top: 1.5rem;
            }

            .hero-image img {
                max-height: 180px;
            }

            .section-title {
                margin-bottom: 1.5rem;
            }

            .section-title h2 {
                font-size: 1.2rem;
            }

            .section-title p {
                font-size: 0.8rem;
            }

            .py-5 {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important;
            }

            .container.py-4 {
                padding-top: 0.5rem !important;
                padding-bottom: 0.5rem !important;
            }

            .feature-card,
            .info-card {
                padding: 1rem;
            }

            .feature-card h5,
            .info-card h5 {
                font-size: 0.9rem;
            }

            .feature-card p,
            .info-card p {
                font-size: 0.8rem;
            }

            .feature-icon {
                width: 50px;
                height: 50px;
                font-size: 1.25rem;
                margin-bottom: 0.75rem !important;
            }

            .menu-card .card-body {
                padding: 1rem;
            }

            .menu-image {
                width: 80px;
                height: 80px;
            }

            .menu-card h5 {
                font-size: 0.9rem;
            }

            .menu-price {
                font-size: 1rem;
            }

            .menu-card .badge {
                font-size: 0.7rem;
            }

            .cta-section {
                padding: 2rem 0;
            }

            .cta-section h2 {
                font-size: 1.2rem;
            }

            .cta-section p {
                font-size: 0.85rem;
            }

            .cta-section .btn {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
            }

            footer {
                padding: 1.5rem 0 0.75rem;
            }

            footer h5 {
                font-size: 1rem;
            }

            footer h6 {
                font-size: 0.85rem;
            }

            footer p,
            footer span {
                font-size: 0.8rem;
            }

            footer .social-links a {
                width: 32px;
                height: 32px;
                font-size: 0.8rem;
            }

            .footer-bottom p {
                font-size: 0.7rem;
            }

            .row.g-4 {
                --bs-gutter-y: 0.75rem;
                --bs-gutter-x: 0.75rem;
            }
        }

        @media (max-width: 480px) {
            body {
                padding-top: 55px;
            }

            .navbar-brand {
                font-size: 0.8rem;
            }

            .hero-section h1 {
                font-size: 1.2rem;
            }

            .hero-section .lead {
                font-size: 0.8rem;
            }

            .hero-badge {
                font-size: 0.6rem;
                padding: 0.25rem 0.4rem;
            }

            .hero-cta .btn {
                padding: 0.35rem 0.6rem;
                font-size: 0.75rem;
            }

            .hero-image img {
                max-height: 150px;
            }

            .section-title h2 {
                font-size: 1.1rem;
            }

            .feature-icon {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .feature-card,
            .info-card {
                padding: 0.75rem;
            }

            .menu-image {
                width: 60px;
                height: 60px;
            }

            footer .row {
                text-align: center;
            }

            footer .col-md-5,
            footer .col-md-3,
            footer .col-md-4 {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Animated Background -->
    <div class="animated-bg"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                <i class="fas fa-utensils"></i> Warung Kenyang Selalu
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#menu">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#fitur">Fitur</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        @auth
                            <a class="btn btn-primary" href="{{ route('dashboard') }}">
                                <i class="fas fa-th-large me-1"></i> Dashboard
                            </a>
                        @else
                            <a class="btn btn-primary" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <!-- Floating Food Elements -->
        <div class="floating-element" style="top: 15%; right: 15%;">
            <span class="food-emoji">🍜</span>
        </div>
        <div class="floating-element" style="top: 60%; right: 8%;">
            <span class="food-emoji">🍛</span>
        </div>
        <div class="floating-element" style="bottom: 25%; left: 8%;">
            <span class="food-emoji">🥗</span>
        </div>

        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6 hero-content">
                    <h1 class="display-4 fw-bold mb-4">
                        Pesan Makanan<br>
                        <span>Favorit Anda</span>
                    </h1>
                    <p class="lead">
                        Tanpa antri, tanpa ribet. Pesan sekarang, ambil nanti!
                        Nikmati kemudahan pemesanan makanan online di Warung Kenyang Selalu.
                    </p>

                    <div class="hero-badges">
                        <span class="hero-badge">
                            <i class="fas fa-clock"></i> Buka 08:00 - 20:00
                        </span>
                        <span class="hero-badge">
                            <i class="fas fa-map-marker-alt"></i> Purbalingga
                        </span>
                        <span class="hero-badge">
                            <i class="fas fa-star"></i> 4.9 Rating
                        </span>
                    </div>

                    <div class="hero-cta">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-utensils me-2"></i> Buka Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i> Login
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-6 text-center hero-image">
                    <img src="{{ asset('assets/images/hero-food.png') }}" alt="Delicious Food"
                        style="max-height: 500px;"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="d-none justify-content-center align-items-center" style="height: 400px;">
                        <div class="text-center">
                            <div style="font-size: 8rem;">🍽️</div>
                            <p class="text-muted mt-3">Menu Lezat Menanti Anda!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-5">
        <div class="container py-4">
            <div class="section-title">
                <h2>Tentang <span>Warung Kenyang Selalu</span></h2>
                <p>Warung makan yang mengutamakan kepuasan pelanggan</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="info-card animate-fade-in">
                        <i class="fas fa-clock"></i>
                        <h5>Buka Setiap Hari</h5>
                        <p>Senin - Minggu<br>08:00 - 20:00 WIB</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card animate-fade-in animate-delay-1">
                        <i class="fas fa-map-marker-alt"></i>
                        <h5>Lokasi Strategis</h5>
                        <p>Purbalingga, Jawa Tengah<br>Dekat kampus & perkantoran</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card animate-fade-in animate-delay-2">
                        <i class="fas fa-star"></i>
                        <h5>Kualitas Terjamin</h5>
                        <p>Menu bervariasi dengan<br>bahan berkualitas</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-5"
        style="background: linear-gradient(180deg, var(--light-color) 0%, var(--light-secondary) 100%);">
        <div class="container py-4">
            <div class="section-title">
                <h2>Keunggulan <span>Sistem Kami</span></h2>
                <p>Kemudahan dalam memesan makanan</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h5>Pemesanan Terjadwal</h5>
                        <p>Pilih waktu pengambilan sesuai jadwal Anda. Tidak perlu menunggu lama!</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h5>Pembayaran Fleksibel</h5>
                        <p>Bayar tunai atau digital (QRIS, Dana, GoPay) saat pengambilan pesanan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-history"></i>
                        </div>
                        <h5>Riwayat Pesanan</h5>
                        <p>Lihat semua riwayat pesanan Anda kapan saja dari dashboard pribadi.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-boxes-stacked"></i>
                        </div>
                        <h5>Stok Real-time</h5>
                        <p>Lihat ketersediaan menu secara langsung sebelum memesan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-screen"></i>
                        </div>
                        <h5>Responsive Design</h5>
                        <p>Akses mudah dari smartphone, tablet, atau komputer.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h5>Hemat Waktu</h5>
                        <p>Tidak perlu antri panjang. Pesan online, ambil langsung!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Section -->
    <section id="menu" class="py-5">
        <div class="container py-4">
            <div class="section-title">
                <h2>Menu <span>Populer Kami</span></h2>
                <p>Pilihan menu yang lezat dan berkualitas</p>
            </div>
            <div class="row g-4">
                @forelse ($menuPreview as $menu)
                    <div class="col-md-4">
                        <div class="menu-card card h-100 border-0">
                            <div class="card-body text-center">
                                <div class="menu-image">
                                    @if($menu->image_url)
                                        <img src="{{ $menu->image_url }}" alt="{{ $menu->menu_name }}"
                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;"
                                            onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                                        <i class="fas fa-utensils" style="display:none;"></i>
                                    @else
                                        <i class="fas fa-utensils"></i>
                                    @endif
                                </div>
                                <h5 class="mt-3">{{ $menu->menu_name }}</h5>
                                <p class="description text-muted">{{ $menu->description }}</p>
                                <p class="menu-price mb-2">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                                <span class="badge">
                                    <i class="fas fa-check-circle me-1"></i> Stok: {{ $menu->stock }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            <i class="fas fa-info-circle me-2"></i>
                            Menu belum tersedia. Silakan cek kembali nanti.
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-5">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-cart me-2"></i> Kelola Pesanan
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-cart me-2"></i> Login untuk Memesan
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container text-center position-relative">
            <h2 class="mb-4">Siap Memesan Makanan?</h2>
            <p class="lead mb-4">Daftar sekarang dan nikmati kemudahan pemesanan online!</p>
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-th-large me-2"></i> Buka Dashboard
                </a>
            @else
                <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-user-plus me-2"></i> Daftar Gratis
                </a>
            @endauth
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-4 mb-md-0">
                    <h5>
                        <i class="fas fa-utensils me-2"></i>Warung Kenyang Selalu
                    </h5>
                    <p class="text-white-50 mb-4">Sistem Informasi Pemesanan Makanan Terjadwal</p>
                    <div class="d-flex flex-column gap-2">
                        <span class="text-white-50">
                            <i class="fas fa-map-marker-alt me-2 text-warning"></i> Purbalingga, Jawa Tengah
                        </span>
                        <span class="text-white-50">
                            <i class="fas fa-phone me-2 text-warning"></i> 0812-3456-7890
                        </span>
                        <span class="text-white-50">
                            <i class="fas fa-envelope me-2 text-warning"></i> info@warungkenyang.com
                        </span>
                    </div>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h6 class="text-white">Navigasi</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#tentang">Tentang Kami</a></li>
                        <li class="mb-2"><a href="#menu">Menu</a></li>
                        <li class="mb-2"><a href="#fitur">Fitur</a></li>
                        <li class="mb-2"><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Daftar</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="text-white">Ikuti Kami</h6>
                    <p class="text-white-50 small mb-3">Dapatkan update menu terbaru dan promo menarik!</p>
                    <div class="social-links d-flex gap-2">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                        <a href="#"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="footer-bottom">
                <p>&copy; {{ now()->year }} Warung Kenyang Selalu. All Rights Reserved.</p>
                <p class="small text-white-50">Developed by Kelompok 9 - Pemrograman Web 1</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feature-card, .info-card, .menu-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    </script>
</body>

</html>