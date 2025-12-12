<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Pelanggan - Warung Kenyang Selalu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body
    style="background: linear-gradient(180deg, var(--light-color) 0%, var(--light-secondary) 100%); min-height: 100vh;">
    <!-- Animated Background -->
    <div class="animated-bg"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                <i class="fas fa-utensils"></i> Warung Kenyang Selalu
            </a>
            <div class="d-flex align-items-center gap-3">
                <div class="d-none d-md-flex align-items-center gap-2">
                    <div class="avatar-circle">
                        <i class="fas fa-user"></i>
                    </div>
                    <span class="fw-medium">{{ $user->full_name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container" style="padding-top: 100px; padding-bottom: 50px;">
        <!-- Welcome Section -->
        <div class="row align-items-center mb-5">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="welcome-emoji">👋</div>
                    <div>
                        <h2 class="mb-1 fw-bold">Hai, {{ $user->full_name }}!</h2>
                        <p class="text-muted mb-0">Mau makan apa hari ini?</p>
                    </div>
                </div>
                <p class="text-muted">Pesan sekarang dan ambil nanti tanpa antri.</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('dashboard.customer.order') }}" class="btn btn-primary btn-lg shadow">
                    <i class="fas fa-utensils me-2"></i> Buat Pesanan Baru
                </a>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon primary">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 small">Total Pesanan</p>
                            <h3 class="mb-0 fw-bold" id="totalOrders">-</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 small">Menunggu</p>
                            <h3 class="mb-0 fw-bold" id="pendingOrders">-</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 small">Selesai</p>
                            <h3 class="mb-0 fw-bold" id="completedOrders">-</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order History -->
        <div class="card border-0 shadow-sm rounded-lg">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-history me-2 text-gradient"></i> Riwayat Pesanan Anda
                </h5>
                <a href="{{ route('dashboard.customer.order') }}" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-plus me-1"></i> Pesanan Baru
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>No. Order</th>
                                <th>Tanggal & Waktu</th>
                                <th>Menu</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="historyTable">
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="spinner"></div>
                                    <p class="text-muted mb-0">Memuat data...</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .welcome-emoji {
            font-size: 2.5rem;
            animation: wave 2s ease-in-out infinite;
        }

        @keyframes wave {

            0%,
            100% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(20deg);
            }

            75% {
                transform: rotate(-10deg);
            }
        }

        .avatar-circle {
            width: 40px;
            height: 40px;
            background: var(--primary-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        /* ========== MOBILE RESPONSIVE ========== */
        @media (max-width: 768px) {
            body {
                padding-top: 60px !important;
            }

            .navbar {
                padding: 0.5rem 0;
            }

            .navbar-brand {
                font-size: 0.95rem;
            }

            .navbar-brand i {
                font-size: 1rem;
            }

            .container {
                padding-top: 70px !important;
                padding-left: 0.75rem !important;
                padding-right: 0.75rem !important;
            }

            .welcome-emoji {
                font-size: 1.5rem;
            }

            .row.align-items-center.mb-5 {
                margin-bottom: 1rem !important;
            }

            .row.align-items-center.mb-5 h2 {
                font-size: 1rem;
                margin-bottom: 0 !important;
            }

            .row.align-items-center.mb-5 p {
                font-size: 0.75rem;
                margin-bottom: 0.25rem !important;
            }

            .row.align-items-center.mb-5 .d-flex {
                gap: 0.5rem !important;
            }

            .row.align-items-center.mb-5 .btn-lg {
                padding: 0.4rem 0.75rem;
                font-size: 0.8rem;
            }

            .row.g-4.mb-5 {
                --bs-gutter-y: 0.5rem;
                --bs-gutter-x: 0.5rem;
                margin-bottom: 1rem !important;
            }

            .stat-card {
                padding: 0.75rem;
            }

            .stat-card h3 {
                font-size: 1.1rem;
            }

            .stat-card .small {
                font-size: 0.7rem;
            }

            .stat-icon {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }

            .stat-card .d-flex {
                gap: 0.5rem !important;
            }

            .card-header {
                padding: 0.75rem;
                flex-direction: row;
                gap: 0.5rem;
            }

            .card-header h5 {
                font-size: 0.9rem;
            }

            .card-header .btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.7rem;
            }

            .card-body {
                padding: 0.75rem;
            }

            .table th,
            .table td {
                padding: 0.4rem;
                font-size: 0.75rem;
            }

            .table th:nth-child(3),
            .table td:nth-child(3) {
                display: none;
            }

            .avatar-circle {
                width: 28px;
                height: 28px;
                font-size: 0.7rem;
            }

            .btn-outline-primary.btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }

            .badge {
                font-size: 0.65rem;
                padding: 0.2rem 0.4rem;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding-top: 65px !important;
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
            }

            .welcome-emoji {
                font-size: 1.25rem;
            }

            .row.align-items-center.mb-5 h2 {
                font-size: 0.9rem;
            }

            .row.align-items-center.mb-5 .col-lg-8,
            .row.align-items-center.mb-5 .col-lg-4 {
                text-align: center;
            }

            .row.align-items-center.mb-5 .d-flex {
                justify-content: center;
            }

            .row.align-items-center.mb-5 .btn-lg {
                width: 100%;
                margin-top: 0.5rem;
            }

            .stat-card {
                padding: 0.5rem;
            }

            .stat-card h3 {
                font-size: 1rem;
            }

            .stat-icon {
                width: 30px;
                height: 30px;
                font-size: 0.8rem;
            }

            .table th:nth-child(2),
            .table td:nth-child(2) {
                display: none;
            }

            .card-header {
                flex-direction: column;
                text-align: center;
            }

            .card-header .btn {
                width: 100%;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        const USER_ID = @json($user->id);

        document.addEventListener('DOMContentLoaded', async () => {
            try {
                const orders = await loadOrdersByUser(USER_ID);
                const tbody = document.getElementById('historyTable');

                // Update stats
                document.getElementById('totalOrders').textContent = orders.length;
                document.getElementById('pendingOrders').textContent = orders.filter(o => o.status === 'pending').length;
                document.getElementById('completedOrders').textContent = orders.filter(o => o.status === 'completed').length;

                if (!orders.length) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div style="font-size: 4rem;">🍽️</div>
                                <h5 class="mt-3 fw-bold">Belum ada pesanan</h5>
                                <p class="text-muted mb-3">Yuk, buat pesanan pertamamu!</p>
                                <a href="{{ route('dashboard.customer.order') }}" class="btn btn-primary">
                                    <i class="fas fa-utensils me-2"></i> Pesan Sekarang
                                </a>
                            </td>
                        </tr>
                    `;
                    return;
                }

                tbody.innerHTML = orders.map(order => {
                    let badgeClass = 'secondary';
                    let statusText = order.status;

                    switch (order.status) {
                        case 'completed':
                            badgeClass = 'status-completed';
                            statusText = 'Selesai';
                            break;
                        case 'pending':
                            badgeClass = 'status-pending';
                            statusText = 'Menunggu';
                            break;
                        case 'processing':
                            badgeClass = 'status-processing';
                            statusText = 'Diproses';
                            break;
                        case 'ready':
                            badgeClass = 'status-ready';
                            statusText = 'Siap Diambil';
                            break;
                        case 'cancelled':
                            badgeClass = 'status-cancelled';
                            statusText = 'Dibatalkan';
                            break;
                    }

                    return `
                        <tr>
                            <td>
                                <span class="fw-bold text-gradient">#${order.order_code}</span>
                            </td>
                            <td>
                                <div class="fw-medium">${formatDate(order.pickup_date)}</div>
                                <small class="text-muted"><i class="fas fa-clock me-1"></i>${order.pickup_time}</small>
                            </td>
                            <td>
                                <small class="text-muted">${order.items_ordered ?? '-'}</small>
                            </td>
                            <td class="fw-bold">${formatRupiah(order.total_amount)}</td>
                            <td><span class="badge ${badgeClass}">${statusText}</span></td>
                        </tr>
                    `;
                }).join('');
            } catch (error) {
                console.error(error);
                document.getElementById('historyTable').innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center text-danger py-4">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Gagal memuat data. Silakan refresh halaman.
                        </td>
                    </tr>
                `;
            }
        });
    </script>
</body>

</html>