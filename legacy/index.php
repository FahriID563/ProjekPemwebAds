<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Kenyang Selalu - Sistem Pemesanan Makanan</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-warning" href="index.php">
                <i class="fas fa-utensils"></i> Warung Kenyang Selalu
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#menu">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#fitur">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-warning text-white ms-2 px-4" href="login.php">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6">
                    <h1 class="display-3 fw-bold mb-4">Pesan Makanan Favorit Anda</h1>
                    <p class="lead mb-4">Tanpa Antri, Tanpa Ribet. Pesan Sekarang, Ambil Nanti!</p>
                    <div class="d-flex gap-3">
                        <a href="register.php" class="btn btn-warning btn-lg px-5">
                            <i class="fas fa-user-plus"></i> Daftar Sekarang
                        </a>
                        <a href="#menu" class="btn btn-outline-warning btn-lg px-5">
                            <i class="fas fa-book-open"></i> Lihat Menu
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="assets/images/hero-food.png" alt="Food" class="img-fluid" style="max-height: 500px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="fw-bold">Tentang Warung Kenyang Selalu</h2>
                    <p class="text-muted">Warung makan yang mengutamakan kepuasan pelanggan</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-clock fa-3x text-warning mb-3"></i>
                            <h5 class="fw-bold">Buka Setiap Hari</h5>
                            <p class="text-muted">Senin - Minggu<br>08:00 - 20:00 WIB</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-map-marker-alt fa-3x text-warning mb-3"></i>
                            <h5 class="fw-bold">Lokasi Strategis</h5>
                            <p class="text-muted">Purbalingga, Jawa Tengah<br>Dekat kampus & perkantoran</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-star fa-3x text-warning mb-3"></i>
                            <h5 class="fw-bold">Kualitas Terjamin</h5>
                            <p class="text-muted">Menu bervariasi dengan<br>bahan berkualitas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Section -->
    <section id="fitur" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="fw-bold">Keunggulan Sistem Kami</h2>
                    <p class="text-muted">Kemudahan dalam memesan makanan</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h5 class="fw-bold mt-3">Pemesanan Terjadwal</h5>
                        <p class="text-muted">Pilih waktu pengambilan sesuai jadwal Anda. Tidak perlu menunggu lama!</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h5 class="fw-bold mt-3">Pembayaran Fleksibel</h5>
                        <p class="text-muted">Bayar tunai atau digital (QRIS, Dana, GoPay) saat pengambilan pesanan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h5 class="fw-bold mt-3">Notifikasi Real-time</h5>
                        <p class="text-muted">Dapatkan update status pesanan langsung ke email Anda.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <h5 class="fw-bold mt-3">Stok Real-time</h5>
                        <p class="text-muted">Lihat ketersediaan menu secara langsung sebelum memesan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h5 class="fw-bold mt-3">Responsive Design</h5>
                        <p class="text-muted">Akses mudah dari smartphone, tablet, atau komputer.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h5 class="fw-bold mt-3">Hemat Waktu</h5>
                        <p class="text-muted">Tidak perlu antri panjang. Pesan online, ambil langsung!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Preview Menu Section -->
    <section id="menu" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="fw-bold">Menu Populer Kami</h2>
                    <p class="text-muted">Pilihan menu yang lezat dan berkualitas</p>
                </div>
            </div>
            <div id="menuContainer" class="row g-4">
                <!-- Menu akan dimuat via JavaScript -->
            </div>
            <div class="text-center mt-5">
                <a href="login.php" class="btn btn-warning btn-lg px-5">
                    <i class="fas fa-shopping-cart"></i> Login untuk Memesan
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-warning text-white">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Siap Memesan Makanan?</h2>
            <p class="lead mb-4">Daftar sekarang dan nikmati kemudahan pemesanan online!</p>
            <a href="register.php" class="btn btn-light btn-lg px-5">
                <i class="fas fa-user-plus"></i> Daftar Gratis
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-utensils"></i> Warung Kenyang Selalu
                    </h5>
                    <p class="text-muted">Sistem Informasi Pemesanan Makanan Terjadwal</p>
                    <p class="text-muted small">
                        <i class="fas fa-map-marker-alt"></i> Purbalingga, Jawa Tengah<br>
                        <i class="fas fa-phone"></i> 0812-3456-7890<br>
                        <i class="fas fa-envelope"></i> info@warungkenyang.com
                    </p>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold mb-3">Menu</h6>
                    <ul class="list-unstyled">
                        <li><a href="#tentang" class="text-muted text-decoration-none">Tentang</a></li>
                        <li><a href="#menu" class="text-muted text-decoration-none">Menu</a></li>
                        <li><a href="#fitur" class="text-muted text-decoration-none">Fitur</a></li>
                        <li><a href="login.php" class="text-muted text-decoration-none">Login</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold mb-3">Ikuti Kami</h6>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-whatsapp fa-2x"></i></a>
                    </div>
                </div>
            </div>
            <hr class="bg-secondary">
            <div class="text-center">
                <p class="mb-0 small">&copy; 2025 Warung Kenyang Selalu. All Rights Reserved.</p>
                <p class="mb-0 small text-muted">Developed by Kelompok 9 - Pemrograman Web 1</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/main.js"></script>
    <script>
        // Load menu preview
        document.addEventListener('DOMContentLoaded', function() {
            loadMenuPreview();
        });

        function loadMenuPreview() {
            fetch('api/menu.php?action=available')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const menuContainer = document.getElementById('menuContainer');
                        const menus = data.data.slice(0, 6); // Ambil 6 menu pertama
                        
                        menuContainer.innerHTML = menus.map(menu => `
                            <div class="col-md-4">
                                <div class="card h-100 border-0 shadow-sm menu-card">
                                    <div class="card-body text-center">
                                        <div class="menu-image mb-3">
                                            <i class="fas fa-utensils fa-3x text-warning"></i>
                                        </div>
                                        <h5 class="fw-bold">${menu.menu_name}</h5>
                                        <p class="text-muted small">${menu.description}</p>
                                        <p class="text-warning fw-bold fs-5">Rp ${formatRupiah(menu.price)}</p>
                                        <span class="badge bg-success">Stok: ${menu.stock}</span>
                                    </div>
                                </div>
                            </div>
                        `).join('');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }
    </script>
</body>
</html>