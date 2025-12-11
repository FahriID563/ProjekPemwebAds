-- Database: warung_kenyang_db
CREATE DATABASE IF NOT EXISTS warung_kenyang_db;
USE warung_kenyang_db;

-- Tabel Users (Pelanggan, Pelayan, Admin)
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(100),
    role ENUM('customer', 'pelayan', 'admin') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel Menu Items
CREATE TABLE menu_items (
    menu_id INT AUTO_INCREMENT PRIMARY KEY,
    menu_name VARCHAR(100) NOT NULL,
    description TEXT,
    category ENUM('Makanan Berat', 'Minuman', 'Snack') NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    stock INT DEFAULT 0,
    image_url VARCHAR(255),
    is_available BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel Orders
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    order_code VARCHAR(50) NOT NULL UNIQUE,
    user_id INT NOT NULL,
    customer_name VARCHAR(100) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    pickup_date DATE NOT NULL,
    pickup_time TIME NOT NULL,
    notes TEXT,
    total_amount DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'processing', 'ready', 'completed', 'cancelled') DEFAULT 'pending',
    payment_method ENUM('cash', 'qris', 'dana', 'gopay', 'pending') DEFAULT 'pending',
    payment_status ENUM('unpaid', 'paid') DEFAULT 'unpaid',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Tabel Order Details
CREATE TABLE order_details (
    detail_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    menu_id INT NOT NULL,
    menu_name VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (menu_id) REFERENCES menu_items(menu_id) ON DELETE CASCADE
);

-- Tabel Inventory/Stock History (Optional untuk tracking stok)
CREATE TABLE stock_history (
    history_id INT AUTO_INCREMENT PRIMARY KEY,
    menu_id INT NOT NULL,
    quantity_change INT NOT NULL,
    type ENUM('in', 'out', 'adjustment') NOT NULL,
    notes TEXT,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (menu_id) REFERENCES menu_items(menu_id) ON DELETE CASCADE,
    FOREIGN KEY (created_by) REFERENCES users(user_id) ON DELETE SET NULL
);

-- Insert Data Default Users
INSERT INTO users (username, password, full_name, phone, email, role) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', '081234567890', 'admin@warungkenyang.com', 'admin'),
('pelayan1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Pelayan Satu', '081234567891', 'pelayan1@warungkenyang.com', 'pelayan'),
('customer1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Budi Santoso', '081234567892', 'budi@email.com', 'customer');
-- Password default untuk semua: "password123"

-- Insert Data Default Menu Items
INSERT INTO menu_items (menu_name, description, category, price, stock, image_url, is_available) VALUES
('Nasi Goreng Spesial', 'Nasi goreng dengan telur, ayam, dan sayuran segar', 'Makanan Berat', 15000.00, 20, 'nasi-goreng.jpg', TRUE),
('Mie Ayam', 'Mie ayam dengan pangsit dan bakso pilihan', 'Makanan Berat', 12000.00, 15, 'mie-ayam.jpg', TRUE),
('Soto Ayam', 'Soto ayam kampung dengan bumbu rempah khas', 'Makanan Berat', 13000.00, 10, 'soto-ayam.jpg', TRUE),
('Nasi Pecel', 'Nasi dengan sayuran dan bumbu pecel', 'Makanan Berat', 10000.00, 25, 'nasi-pecel.jpg', TRUE),
('Ayam Goreng + Nasi', 'Ayam goreng crispy dengan nasi putih', 'Makanan Berat', 18000.00, 12, 'ayam-goreng.jpg', TRUE),
('Es Teh Manis', 'Es teh manis segar', 'Minuman', 3000.00, 50, 'es-teh.jpg', TRUE),
('Jus Jeruk', 'Jus jeruk asli tanpa gula tambahan', 'Minuman', 8000.00, 20, 'jus-jeruk.jpg', TRUE),
('Es Kelapa Muda', 'Es kelapa muda segar', 'Minuman', 10000.00, 15, 'es-kelapa.jpg', TRUE),
('Kopi Hitam', 'Kopi hitam robusta pilihan', 'Minuman', 5000.00, 30, 'kopi.jpg', TRUE),
('Pisang Goreng', 'Pisang goreng crispy dengan meses', 'Snack', 5000.00, 30, 'pisang-goreng.jpg', TRUE),
('Tahu Isi', 'Tahu isi dengan sayuran dan cabai', 'Snack', 6000.00, 25, 'tahu-isi.jpg', TRUE),
('Tempe Mendoan', 'Tempe mendoan crispy khas Purbalingga', 'Snack', 5000.00, 20, 'mendoan.jpg', TRUE);

-- View untuk laporan penjualan
CREATE VIEW sales_report AS
SELECT 
    o.order_id,
    o.order_code,
    o.customer_name,
    o.customer_phone,
    o.pickup_date,
    o.pickup_time,
    o.total_amount,
    o.status,
    o.payment_method,
    o.payment_status,
    o.created_at,
    COUNT(od.detail_id) as total_items,
    GROUP_CONCAT(CONCAT(od.menu_name, ' (', od.quantity, ')') SEPARATOR ', ') as items_ordered
FROM orders o
LEFT JOIN order_details od ON o.order_id = od.order_id
GROUP BY o.order_id
ORDER BY o.created_at DESC;

-- Stored Procedure untuk membuat pesanan
DELIMITER //
CREATE PROCEDURE create_order(
    IN p_user_id INT,
    IN p_customer_name VARCHAR(100),
    IN p_customer_phone VARCHAR(20),
    IN p_pickup_date DATE,
    IN p_pickup_time TIME,
    IN p_notes TEXT,
    IN p_total_amount DECIMAL(10,2),
    OUT p_order_code VARCHAR(50)
)
BEGIN
    DECLARE v_order_id INT;
    
    -- Generate order code
    SET p_order_code = CONCAT('ORD', DATE_FORMAT(NOW(), '%Y%m%d'), LPAD(FLOOR(RAND() * 10000), 4, '0'));
    
    -- Insert order
    INSERT INTO orders (order_code, user_id, customer_name, customer_phone, pickup_date, pickup_time, notes, total_amount)
    VALUES (p_order_code, p_user_id, p_customer_name, p_customer_phone, p_pickup_date, p_pickup_time, p_notes, p_total_amount);
    
    SET v_order_id = LAST_INSERT_ID();
    SELECT v_order_id as order_id, p_order_code as order_code;
END //
DELIMITER ;

-- Trigger untuk update stok setelah order dibuat
DELIMITER //
CREATE TRIGGER after_order_detail_insert
AFTER INSERT ON order_details
FOR EACH ROW
BEGIN
    UPDATE menu_items 
    SET stock = stock - NEW.quantity
    WHERE menu_id = NEW.menu_id;
    
    -- Log ke stock history
    INSERT INTO stock_history (menu_id, quantity_change, type, notes)
    VALUES (NEW.menu_id, -NEW.quantity, 'out', CONCAT('Order: ', (SELECT order_code FROM orders WHERE order_id = NEW.order_id)));
END //
DELIMITER ;

-- Index untuk optimasi query
CREATE INDEX idx_orders_status ON orders(status);
CREATE INDEX idx_orders_pickup_date ON orders(pickup_date);
CREATE INDEX idx_orders_user_id ON orders(user_id);
CREATE INDEX idx_menu_category ON menu_items(category);
CREATE INDEX idx_menu_available ON menu_items(is_available);