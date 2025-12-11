<?php
require_once '../config.php';
checkRole(['customer']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Pesan Menu - Warung Kenyang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row min-vh-100">
            <div class="col-md-8 p-4 bg-light overflow-auto" style="height: 100vh;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="customer.php" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <h4 class="mb-0 fw-bold">Daftar Menu</h4>
                </div>
                <div class="row g-3" id="menuGrid">
                    </div>
            </div>

            <div class="col-md-4 p-0 bg-white border-start shadow-sm position-relative">
                <div class="d-flex flex-column h-100">
                    <div class="p-4 border-bottom bg-warning text-white">
                        <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i> Keranjang Pesanan</h5>
                    </div>
                    
                    <div class="p-3 flex-grow-1 overflow-auto" id="cartItems">
                        <div class="text-center text-muted mt-5">Keranjang masih kosong</div>
                    </div>

                    <div class="p-4 border-top bg-light">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="h5">Total</span>
                            <span class="h5 fw-bold text-primary" id="cartTotal">Rp 0</span>
                        </div>
                        
                        <div class="mb-3">
                            <label class="small text-muted">Jam Pengambilan</label>
                            <input type="time" class="form-control" id="pickupTime" required>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted">Tanggal</label>
                            <input type="date" class="form-control" id="pickupDate" value="<?php echo date('Y-m-d'); ?>">
                        </div>

                        <button onclick="checkout()" class="btn btn-warning w-100 py-2 fw-bold text-white">
                            BUAT PESANAN
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/main.js"></script>
    <script>
        const API_BASE = '../api/';
        // Gunakan localStorage sederhana untuk sesi ini
        let cart = [];

        document.addEventListener('DOMContentLoaded', loadMenu);

        async function loadMenu() {
            const res = await fetch(API_BASE + 'menu.php?action=available');
            const data = await res.json();
            const grid = document.getElementById('menuGrid');
            
            grid.innerHTML = data.data.map(item => `
                <div class="col-md-4 col-sm-6">
                    <div class="card h-100 border-0 shadow-sm" onclick='addToCart(${JSON.stringify(item)})' style="cursor:pointer">
                        <div class="card-body text-center p-2">
                            <h6 class="fw-bold mb-1">${item.menu_name}</h6>
                            <p class="text-primary fw-bold small mb-0">${formatRupiah(item.price)}</p>
                            <small class="text-muted">Stok: ${item.stock}</small>
                        </div>
                        <div class="card-footer bg-white border-0 p-2">
                            <button class="btn btn-sm btn-outline-warning w-100">Tambah +</button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function addToCart(item) {
            const existing = cart.find(c => c.menu_id === item.menu_id);
            if(existing) {
                if(existing.qty < item.stock) existing.qty++;
            } else {
                cart.push({...item, qty: 1});
            }
            renderCart();
        }

        function renderCart() {
            const container = document.getElementById('cartItems');
            let total = 0;

            if(cart.length === 0) {
                container.innerHTML = '<div class="text-center text-muted mt-5">Keranjang masih kosong</div>';
                document.getElementById('cartTotal').innerText = 'Rp 0';
                return;
            }

            container.innerHTML = cart.map((item, index) => {
                total += item.price * item.qty;
                return `
                    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                        <div>
                            <h6 class="mb-0">${item.menu_name}</h6>
                            <small class="text-muted">${formatRupiah(item.price)} x ${item.qty}</small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-sm btn-light" onclick="updateQty(${index}, -1)">-</button>
                            <span>${item.qty}</span>
                            <button class="btn btn-sm btn-light" onclick="updateQty(${index}, 1)">+</button>
                        </div>
                    </div>
                `;
            }).join('');
            
            document.getElementById('cartTotal').innerText = formatRupiah(total);
        }

        function updateQty(index, change) {
            cart[index].qty += change;
            if(cart[index].qty <= 0) cart.splice(index, 1);
            else if(cart[index].qty > cart[index].stock) {
                alert('Stok maksimal tercapai');
                cart[index].qty = cart[index].stock;
            }
            renderCart();
        }

        async function checkout() {
            if(cart.length === 0) return alert('Pilih menu dulu!');
            const time = document.getElementById('pickupTime').value;
            const date = document.getElementById('pickupDate').value;
            
            if(!time || !date) return alert('Lengkapi waktu pengambilan!');

            const orderData = {
                user_id: <?php echo $_SESSION['user_id']; ?>,
                customer_name: "<?php echo $_SESSION['full_name']; ?>",
                customer_phone: "08xxx", // Idealnya ambil dari session jika ada
                pickup_date: date,
                pickup_time: time,
                items: cart.map(c => ({
                    menu_id: c.menu_id,
                    menu_name: c.menu_name,
                    price: c.price,
                    quantity: c.qty
                }))
            };

            try {
                const res = await fetch(API_BASE + 'orders.php?action=create', {
                    method: 'POST',
                    body: JSON.stringify(orderData)
                });
                const result = await res.json();
                
                if(result.success) {
                    alert('Pesanan berhasil dibuat! Kode: ' + result.data.order_code);
                    window.location.href = 'customer.php';
                } else {
                    alert('Gagal: ' + result.message);
                }
            } catch(e) {
                alert('Terjadi kesalahan sistem');
            }
        }
    </script>
</body>
</html>