<?php
/**
 * Authentication Handler - REVISED
 */
require_once 'config.php';

// Handle Login
if (isset($_POST['login'])) {
    $username = sanitize($_POST['username']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        showAlert('Username dan password harus diisi!', 'danger');
        redirect('login.php');
    }
    
    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['logged_in'] = true;
            
            // PERBAIKAN: Redirect sesuai struktur folder dashboard/
            switch($user['role']) {
                case 'admin':
                    redirect('dashboard/admin.php');
                    break;
                case 'pelayan': // Role di database 'pelayan', file dashboard 'waiter.php'
                    redirect('dashboard/waiter.php');
                    break;
                case 'customer':
                    redirect('dashboard/customer.php');
                    break;
                default:
                    redirect('index.php');
            }
        } else {
            showAlert('Username atau password salah!', 'danger');
            redirect('login.php');
        }
    } catch (PDOException $e) {
        showAlert('Terjadi kesalahan: ' . $e->getMessage(), 'danger');
        redirect('login.php');
    }
}

// Handle Register (Sama seperti sebelumnya)
if (isset($_POST['register'])) {
    $username = sanitize($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $full_name = sanitize($_POST['full_name']);
    $phone = sanitize($_POST['phone']);
    $email = sanitize($_POST['email']);
    
    if (empty($username) || empty($password) || empty($full_name)) {
        showAlert('Username, password, dan nama lengkap harus diisi!', 'danger');
        redirect('register.php');
    }
    
    if ($password !== $confirm_password) {
        showAlert('Password dan konfirmasi password tidak cocok!', 'danger');
        redirect('register.php');
    }
    
    try {
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            showAlert('Username sudah digunakan!', 'danger');
            redirect('register.php');
        }
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, password, full_name, phone, email, role) VALUES (?, ?, ?, ?, ?, 'customer')");
        
        if ($stmt->execute([$username, $hashed_password, $full_name, $phone, $email])) {
            showAlert('Registrasi berhasil! Silakan login.', 'success');
            redirect('login.php');
        }
    } catch (PDOException $e) {
        showAlert('Terjadi kesalahan: ' . $e->getMessage(), 'danger');
        redirect('register.php');
    }
}

// Handle Logout
if (isset($_GET['logout'])) {
    session_destroy();
    redirect('index.php'); // Kembali ke index bukan login
}
?>