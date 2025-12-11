<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dapur & Kasir - Warung Kenyang Selalu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <meta http-equiv="refresh" content="30">
</head>
<body class="bg-light">
    <nav class="navbar navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">🍳 Dapur & Kasir</span>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted">Halo, {{ $user->full_name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h4 class="mb-3">Daftar Pesanan Aktif</h4>
        <div class="row" id="ordersContainer">
            <div class="col-12 text-center mt-5">
                <div class="spinner-border text-warning"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', loadOrders);

        async function loadOrders() {
            try {
                const result = await loadAllOrders();
                const container = document.getElementById('ordersContainer');
                container.innerHTML = '';

                if (!result.length) {
                    container.innerHTML = '<div class="alert alert-info w-100">Belum ada pesanan aktif.</div>';
                    return;
                }

                result.forEach(order => {
                    if (['completed', 'cancelled'].includes(order.status)) {
                        return;
                    }

                    let actionBtn = '';
                    let statusColor = 'secondary';

                    if (order.status === 'pending') {
                        statusColor = 'warning';
                        actionBtn = `<button onclick="handleUpdateStatus(${order.id}, 'processing')" class="btn btn-primary btn-sm w-100">Mulai Masak</button>`;
                    } else if (order.status === 'processing') {
                        statusColor = 'info';
                        actionBtn = `<button onclick="handleUpdateStatus(${order.id}, 'ready')" class="btn btn-success btn-sm w-100">Siap Disajikan</button>`;
                    } else if (order.status === 'ready') {
                        statusColor = 'success';
                        actionBtn = `<button onclick="handleConfirmPayment(${order.id})" class="btn btn-dark btn-sm w-100">Terima Pembayaran</button>`;
                    }

                    const items = (order.items_ordered ?? '').split(',').map(item => item.trim()).filter(Boolean);

                    container.innerHTML += `
                        <div class="col-md-4 mb-3">
                            <div class="card shadow-sm border-top border-4 border-${statusColor}">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <h5 class="card-title">#${order.order_code}</h5>
                                        <span class="badge bg-${statusColor}">${order.status.toUpperCase()}</span>
                                    </div>
                                    <p class="mb-1"><strong>${order.customer_name}</strong> (${order.customer_phone ?? '-'})</p>
                                    <p class="small text-muted mb-2">Jadwal: ${order.pickup_time}</p>
                                    <hr>
                                    <ul class="list-unstyled small mb-3">
                                        ${items.map(item => `<li>• ${item}</li>`).join('')}
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
            } catch (error) {
                console.error(error);
            }
        }

        async function handleUpdateStatus(id, status) {
            if (! confirm('Ubah status pesanan?')) return;
            await updateOrderStatus(id, status);
            loadOrders();
        }

        async function handleConfirmPayment(id) {
            const method = prompt("Masukkan metode pembayaran (cash/qris/dana/gopay):", "cash");
            if (! method) return;

            await updatePaymentStatus(id, method);
            alert("Pembayaran berhasil! Pesanan selesai.");
            loadOrders();
        }
    </script>
</body>
</html>

