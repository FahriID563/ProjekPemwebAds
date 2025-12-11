<?php
require_once '../config.php';
checkRole(['pelayan', 'admin']); // Pelayan dan admin bisa akses
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dapur & Kasir - Warung Kenyang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <meta http-equiv="refresh" content="30"> 
</head>
<body class="bg-light">
    <nav class="navbar navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">🍳 Dapur & Kasir</span>
            <a href="../auth.php?logout=true" class="btn btn-outline-danger btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h4 class="mb-3">Daftar Pesanan Aktif</h4>
        <div class="row" id="ordersContainer">
            <div class="col-12 text-center mt-5"><div class="spinner-border text-warning"></div></div>
        </div>
    </div>

    <script src="../assets/js/main.js"></script>
    <script>
        const API_BASE = '../api/';

        document.addEventListener('DOMContentLoaded', loadOrders);

        async function loadOrders() {
            try {
                // Ambil semua order
                const response = await fetch(API_BASE + 'orders.php?action=all');
                const result = await response.json();
                const container = document.getElementById('ordersContainer');
                container.innerHTML = '';

                if (result.data.length === 0) {
                    container.innerHTML = '<div class="alert alert-info w-100">Belum ada pesanan aktif.</div>';
                    return;
                }

                result.data.forEach(order => {
                    // Hanya tampilkan yang belum completed/cancelled agar tidak menumpuk
                    if(order.status === 'completed' || order.status === 'cancelled') return;

                    let actionBtn = '';
                    let statusColor = 'secondary';
                    
                    // Logika Status Tombol
                    if(order.status === 'pending') {
                        statusColor = 'warning';
                        actionBtn = `<button onclick="updateStatus(${order.order_id}, 'processing')" class="btn btn-primary btn-sm w-100">Mulai Masak</button>`;
                    } else if (order.status === 'processing') {
                        statusColor = 'info';
                        actionBtn = `<button onclick="updateStatus(${order.order_id}, 'ready')" class="btn btn-success btn-sm w-100">Siap Disajikan</button>`;
                    } else if (order.status === 'ready') {
                        statusColor = 'success';
                        actionBtn = `<button onclick="confirmPayment(${order.order_id})" class="btn btn-dark btn-sm w-100">Terima Pembayaran</button>`;
                    }

                    container.innerHTML += `
                        <div class="col-md-4 mb-3">
                            <div class="card shadow-sm border-top border-4 border-${statusColor}">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <h5 class="card-title">#${order.order_code}</h5>
                                        <span class="badge bg-${statusColor}">${order.status.toUpperCase()}</span>
                                    </div>
                                    <p class="mb-1"><strong>${order.customer_name}</strong> (${order.customer_phone})</p>
                                    <p class="small text-muted mb-2">Jadwal: ${order.pickup_time}</p>
                                    <hr>
                                    <ul class="list-unstyled small mb-3">
                                        ${order.items_ordered.split(',').map(item => `<li>• ${item}</li>`).join('')}
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <strong>Total:</strong>
                                        <span class="text-primary fs-5">${formatRupiah(order.total_amount)}</span>
                                    </div>
                                    ${actionBtn}
                                </div>
                            </div>
                        </div>
                    `;
                });
            } catch(e) { console.error(e); }
        }

        async function updateStatus(id, status) {
            if(!confirm('Ubah status pesanan?')) return;
            await fetch(API_BASE + 'orders.php?action=update-status', {
                method: 'PUT',
                body: JSON.stringify({order_id: id, status: status})
            });
            loadOrders();
        }

        async function confirmPayment(id) {
            const method = prompt("Masukkan metode pembayaran (cash/qris/dana):", "cash");
            if(!method) return;
            
            await fetch(API_BASE + 'orders.php?action=update-payment', {
                method: 'PUT',
                body: JSON.stringify({order_id: id, payment_method: method})
            });
            alert("Pembayaran berhasil! Pesanan selesai.");
            loadOrders();
        }
    </script>
</body>
</html>