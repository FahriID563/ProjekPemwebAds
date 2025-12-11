<?php
/**
 * Database Configuration
 * Warung Kenyang Selalu - Sistem Pemesanan Makanan
 * Kelompok 9 - Pemrograman Web 1
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'warung_kenyang_db');

// Application Configuration
define('BASE_URL', 'http://localhost/warung-kenyang/');
define('SITE_NAME', 'Warung Kenyang Selalu');
define('UPLOAD_PATH', __DIR__ . '/uploads/');

// Session Configuration
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database Connection Class
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    
    private $conn;
    private $error;
    
    public function __construct() {
        $this->connect();
    }
    
    private function connect() {
        $this->conn = null;
        
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            $this->conn = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            die("Connection Error: " . $this->error);
        }
    }
    
    public function getConnection() {
        return $this->conn;
    }
    
    public function closeConnection() {
        $this->conn = null;
    }
}

// Helper Functions
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getUserRole() {
    return $_SESSION['role'] ?? null;
}

function checkRole($allowedRoles) {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
    
    $userRole = getUserRole();
    if (!in_array($userRole, $allowedRoles)) {
        header("Location: index.php");
        exit();
    }
}

function redirect($url) {
    header("Location: " . $url);
    exit();
}

function showAlert($message, $type = 'success') {
    $_SESSION['alert'] = [
        'message' => $message,
        'type' => $type
    ];
}

function displayAlert() {
    if (isset($_SESSION['alert'])) {
        $alert = $_SESSION['alert'];
        $alertClass = $alert['type'] === 'success' ? 'alert-success' : 'alert-danger';
        echo "<div class='alert {$alertClass} alert-dismissible fade show' role='alert'>
                {$alert['message']}
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
              </div>";
        unset($_SESSION['alert']);
    }
}

function formatRupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}

function formatDate($date) {
    $months = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    
    $split = explode('-', $date);
    return $split[2] . ' ' . $months[(int)$split[1]] . ' ' . $split[0];
}

function formatTime($time) {
    return date('H:i', strtotime($time));
}

// Auto-load database connection
$database = new Database();
$conn = $database->getConnection();
?>