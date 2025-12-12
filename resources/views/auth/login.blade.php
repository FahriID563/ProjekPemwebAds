<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Warung Kenyang Selalu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        body {
            padding-top: 0;
        }

        /* ========== MOBILE RESPONSIVE ========== */
        @media (max-width: 768px) {
            .auth-container {
                padding: 0.75rem;
                min-height: 100vh;
            }

            .auth-card {
                max-width: 100%;
                margin: 0;
                border-radius: 16px;
            }

            .auth-header {
                padding: 1rem;
            }

            .auth-header i {
                font-size: 1.5rem;
            }

            .auth-header h2 {
                font-size: 1rem;
            }

            .auth-header p {
                font-size: 0.75rem;
            }

            .auth-body {
                padding: 1rem;
            }

            .auth-body h4 {
                font-size: 0.95rem;
            }

            .auth-body p.text-muted {
                font-size: 0.8rem;
            }

            .mb-4 {
                margin-bottom: 0.75rem !important;
            }

            .form-label {
                font-size: 0.8rem;
                margin-bottom: 0.25rem;
            }

            .form-control {
                font-size: 0.85rem;
                padding: 0.5rem 0.75rem;
            }

            .form-check-label {
                font-size: 0.8rem;
            }

            .alert {
                font-size: 0.75rem;
                padding: 0.75rem;
            }

            .alert h6 {
                font-size: 0.8rem;
            }

            .alert .row .col-12 {
                padding: 0.15rem 0;
            }

            .alert code {
                font-size: 0.7rem;
            }

            .alert .badge {
                font-size: 0.6rem;
                padding: 0.15rem 0.35rem;
            }

            .btn-primary {
                padding: 0.5rem 0.75rem;
                font-size: 0.85rem;
            }

            .text-center p {
                font-size: 0.8rem;
            }

            .text-center a {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 480px) {
            .auth-container {
                padding: 0.5rem;
            }

            .auth-header {
                padding: 0.75rem;
            }

            .auth-header i {
                font-size: 1.25rem;
            }

            .auth-header h2 {
                font-size: 0.9rem;
            }

            .auth-body {
                padding: 0.75rem;
            }

            .auth-body h4 {
                font-size: 0.85rem;
            }

            .form-control {
                font-size: 0.8rem;
                padding: 0.4rem 0.6rem;
            }

            .btn-primary {
                padding: 0.4rem 0.6rem;
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <i class="fas fa-utensils"></i>
                <h2>Warung Kenyang Selalu</h2>
                <p>Sistem Pemesanan Makanan</p>
            </div>

            <div class="auth-body">
                <h4 class="text-center mb-4 fw-bold text-gradient">Selamat Datang!</h4>
                <p class="text-center text-muted mb-4">Masuk ke akun Anda untuk melanjutkan</p>

                @if (session('status'))
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>{{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="username" class="form-label">
                            <i class="fas fa-user"></i> Username
                        </label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                            name="username" value="{{ old('username') }}" placeholder="Masukkan username" required
                            autofocus>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Masukkan password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword"
                                style="border-radius: 0 12px 12px 0;">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Ingat Saya
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-4">
                        <i class="fas fa-sign-in-alt me-2"></i> Login
                    </button>

                    <div class="text-center mb-4">
                        <p class="text-muted mb-2">Belum punya akun?</p>
                        <a href="{{ route('register') }}" class="text-gradient fw-bold text-decoration-none">
                            <i class="fas fa-user-plus me-1"></i> Daftar Sekarang
                        </a>
                    </div>

                    <hr class="my-4">

                    <div class="text-center">
                        <a href="{{ route('landing') }}" class="text-muted text-decoration-none">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                        </a>
                    </div>
                </form>

                <!-- Demo Accounts Info -->
                <div class="alert alert-info mt-4" role="alert">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-info-circle me-1"></i> Demo Akun
                    </h6>
                    <div class="row small">
                        <div class="col-12 mb-2">
                            <span class="badge bg-danger me-1">Admin</span>
                            <code>admin</code> / <code>password</code>
                        </div>
                        <div class="col-12 mb-2">
                            <span class="badge bg-warning me-1">Pelayan</span>
                            <code>pelayan1</code> / <code>password</code>
                        </div>
                        <div class="col-12">
                            <span class="badge bg-success me-1">Customer</span>
                            <code>customer1</code> / <code>password</code>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePasswordButton = document.getElementById('togglePassword');
        if (togglePasswordButton) {
            togglePasswordButton.addEventListener('click', function () {
                const passwordInput = document.getElementById('password');
                const icon = this.querySelector('i');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });
        }
    </script>
</body>

</html>