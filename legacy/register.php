<?php
require_once 'config.php';

// Redirect if already logged in
if (isLoggedIn()) {
    redirect('customer/menu.php');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Warung Kenyang Selalu</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
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
                <?php displayAlert(); ?>
                
                <form action="auth.php" method="POST" id="registerForm">
                    <div class="mb-3">
                        <label for="full_name" class="form-label">
                            <i class="fas fa-user"></i> Nama Lengkap *
                        </label>
                        <input type="text" class="form-control" id="full_name" name="full_name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">
                            <i class="fas fa-at"></i> Username *
                        </label>
                        <input type="text" class="form-control" id="username" name="username" required>
                        <small class="text-muted">Username minimal 4 karakter, tanpa spasi</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i> Email
                        </label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    
                    <div class="mb-3">
                        <label for="phone" class="form-label">
                            <i class="fas fa-phone"></i> No. Telepon
                        </label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="08xxxxxxxxxx">
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i> Password *
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <small class="text-muted">Password minimal 6 karakter</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">
                            <i class="fas fa-lock"></i> Konfirmasi Password *
                        </label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label" for="terms">
                            Saya setuju dengan <a href="#" class="text-warning">syarat dan ketentuan</a>
                        </label>
                    </div>
                    
                    <button type="submit" name="register" class="btn btn-warning w-100 mb-3">
                        <i class="fas fa-user-plus"></i> Daftar
                    </button>
                    
                    <div class="text-center">
                        <p class="text-muted mb-2">Sudah punya akun?</p>
                        <a href="login.php" class="text-warning fw-bold text-decoration-none">
                            Login Sekarang
                        </a>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="text-center">
                        <a href="index.php" class="text-muted text-decoration-none">
                            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
        
        // Form validation
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const fullName = document.getElementById('full_name').value.trim();
            
            // Validate username
            if (username.length < 4) {
                e.preventDefault();
                alert('Username minimal 4 karakter!');
                return;
            }
            
            if (username.includes(' ')) {
                e.preventDefault();
                alert('Username tidak boleh mengandung spasi!');
                return;
            }
            
            // Validate full name
            if (fullName.length < 3) {
                e.preventDefault();
                alert('Nama lengkap minimal 3 karakter!');
                return;
            }
            
            // Validate password
            if (password.length < 6) {
                e.preventDefault();
                alert('Password minimal 6 karakter!');
                return;
            }
            
            // Check password match
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak cocok!');
                return;
            }
        });
        
        // Real-time password match check
        document.getElementById('confirm_password').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            
            if (confirmPassword && password !== confirmPassword) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    </script>
</body>
</html>