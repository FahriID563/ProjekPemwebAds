<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Warung Kenyang Selalu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <i class="fas fa-user-plus fa-3x mb-3"></i>
                <h2 class="fw-bold">Daftar Akun Baru</h2>
                <p class="mb-0">Warung Kenyang Selalu</p>
            </div>

            <div class="auth-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        Terjadi kesalahan, periksa kembali input Anda.
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" id="registerForm">
                    @csrf
                    <div class="mb-3">
                        <label for="full_name" class="form-label">
                            <i class="fas fa-user"></i> Nama Lengkap *
                        </label>
                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                        @error('full_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">
                            <i class="fas fa-at"></i> Username *
                        </label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required>
                        <small class="text-muted">Username minimal 4 karakter, tanpa spasi</small>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i> Email
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">
                            <i class="fas fa-phone"></i> No. Telepon
                        </label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i> Password *
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <small class="text-muted">Password minimal 6 karakter</small>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">
                            <i class="fas fa-lock"></i> Konfirmasi Password *
                        </label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label" for="terms">
                            Saya setuju dengan <a href="#" class="text-warning">syarat dan ketentuan</a>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 mb-3">
                        <i class="fas fa-user-plus"></i> Daftar
                    </button>

                    <div class="text-center">
                        <p class="text-muted mb-2">Sudah punya akun?</p>
                        <a href="{{ route('login') }}" class="text-warning fw-bold text-decoration-none">
                            Login Sekarang
                        </a>
                    </div>

                    <hr class="my-4">

                    <div class="text-center">
                        <a href="{{ route('landing') }}" class="text-muted text-decoration-none">
                            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
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
            toggleRegisterPasswordButton.addEventListener('click', function() {
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

