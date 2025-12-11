<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Warung Kenyang Selalu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <i class="fas fa-utensils fa-3x mb-3"></i>
                <h2 class="fw-bold">Warung Kenyang Selalu</h2>
                <p class="mb-0">Sistem Pemesanan Makanan</p>
            </div>

            <div class="auth-body">
                <h4 class="text-center mb-4 fw-bold">Login</h4>

                @if (session('status'))
                    <div class="alert alert-info">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">
                            <i class="fas fa-user"></i> Username
                        </label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required autofocus>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Ingat Saya
                        </label>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 mb-3">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>

                    <div class="text-center">
                        <p class="text-muted mb-2">Belum punya akun?</p>
                        <a href="{{ route('register') }}" class="text-warning fw-bold text-decoration-none">
                            Daftar Sekarang
                        </a>
                    </div>

                    <hr class="my-4">

                    <div class="text-center">
                        <a href="{{ route('landing') }}" class="text-muted text-decoration-none">
                            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                        </a>
                    </div>
                </form>

                <div class="alert alert-info mt-4" role="alert">
                    <h6 class="fw-bold mb-2">
                        <i class="fas fa-info-circle"></i> Demo Akun
                    </h6>
                    <small>
                        <strong>Admin:</strong> username: <code>admin</code>, password: <code>password</code><br>
                        <strong>Pelayan:</strong> username: <code>pelayan1</code>, password: <code>password</code><br>
                        <strong>Customer:</strong> username: <code>customer1</code>, password: <code>password</code>
                    </small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePasswordButton = document.getElementById('togglePassword');
        if (togglePasswordButton) {
            togglePasswordButton.addEventListener('click', function() {
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

