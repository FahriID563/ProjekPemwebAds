<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Warung Kenyang Selalu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        body {
            padding-top: 0;
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="auth-card" style="max-width: 500px;">
            <div class="auth-header">
                <i class="fas fa-user-plus"></i>
                <h2>Daftar Akun Baru</h2>
                <p>Bergabung dengan Warung Kenyang Selalu</p>
            </div>

            <div class="auth-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Terjadi kesalahan, periksa kembali input Anda.
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" id="registerForm">
                    @csrf

                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="full_name" class="form-label">
                                <i class="fas fa-user"></i> Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                id="full_name" name="full_name" value="{{ old('full_name') }}"
                                placeholder="Masukkan nama lengkap" required>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">
                                <i class="fas fa-at"></i> Username <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" value="{{ old('username') }}" placeholder="username_anda"
                                required>
                            <small class="text-muted">Min. 4 karakter, tanpa spasi</small>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">
                                <i class="fas fa-phone"></i> No. Telepon
                            </label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i> Email
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" placeholder="email@contoh.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock"></i> Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Min. 6 karakter" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword"
                                    style="border-radius: 0 12px 12px 0;">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="password_confirmation" class="form-label">
                                <i class="fas fa-lock"></i> Konfirmasi Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Ulangi password" required>
                        </div>
                    </div>

                    <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label" for="terms">
                            Saya setuju dengan <a href="#" class="text-gradient fw-bold text-decoration-none">syarat dan
                                ketentuan</a>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-4">
                        <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                    </button>

                    <div class="text-center mb-3">
                        <p class="text-muted mb-2">Sudah punya akun?</p>
                        <a href="{{ route('login') }}" class="text-gradient fw-bold text-decoration-none">
                            <i class="fas fa-sign-in-alt me-1"></i> Login Sekarang
                        </a>
                    </div>

                    <hr class="my-4">

                    <div class="text-center">
                        <a href="{{ route('landing') }}" class="text-muted text-decoration-none">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggleRegisterPasswordButton = document.getElementById('togglePassword');
        if (toggleRegisterPasswordButton) {
            toggleRegisterPasswordButton.addEventListener('click', function () {
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