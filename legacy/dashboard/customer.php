<?php
require_once '../config.php';
checkRole(['customer']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Area Pelanggan - Warung Kenyang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand text-warning fw-bold" href="#">Warung Kenyang Selalu</a>
            <div class="d-flex align-items-center gap-3">
                <span>Hi, <?php echo $_SESSION['full_name']; ?></span>
                <a href="../auth.php?logout=true" class="btn btn-outline-secondary btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row align-items-center mb-5">
            <div class="col-md-8">
                <h2>Mau makan apa hari ini?</h2>
                <p class="text-muted">Pesan sekarang dan ambil nanti tanpa antri.</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="order.php" class="btn btn-warning btn-lg px-5 shadow text-white">
                    <i class="fas fa-utensils me-2"></i> Buat Pesanan Baru
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Riwayat Pesanan Anda</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No. Order</th>
                                <th>Tanggal & Waktu</th>
                                <th>Menu</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="historyTable">
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/main.js"></script>
    <script>
        const API_BASE = '../api/';
        const USER_ID = <?php echo $_SESSION['user_id']; ?>;

        document.addEventListener('DOMContentLoaded', async () => {
            try {
                const res = await fetch(API_BASE + `orders.php?action=user&user_id=${USER_ID}`);
                const data = await res.json();
                const tbody = document.getElementById('historyTable');
                
                if(data.data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center">Belum ada riwayat pesanan.</td></tr>';
                    return;
                }

                data.data.forEach(order => {
                    let badge = 'secondary';
                    if(order.status === 'completed') badge = 'success';
                    if(order.status === 'pending') badge = 'warning';
                    if(order.status === 'cancelled') badge = 'danger';

                    tbody.innerHTML += `
                        <tr>
                            <td>#${order.order_code}</td>
                            <td>${formatDate(order.pickup_date)} <br> <small>${order.pickup_time}</small></td>
                            <td><small>${order.items_ordered}</small></td>
                            <td class="fw-bold">${formatRupiah(order.total_amount)}</td>
                            <td><span class="badge bg-${badge}">${order.status}</span></td>
                        </tr>
                    `;
                });
            } catch(e) { console.error(e); }
        });
    </script>
</body>
</html>