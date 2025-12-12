<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dapur & Kasir - Warung Kenyang Selalu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <meta http-equiv="refresh" content="30">
    <style>
        body {
            background: linear-gradient(180deg, var(--light-color) 0%, var(--light-secondary) 100%);
            min-height: 100vh;
        }

        .kitchen-header {
            background: var(--primary-gradient);
            color: white;
            padding: 1rem 0;
            margin-bottom: 2rem;
        }

        .stats-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 1.25rem;
            box-shadow: var(--shadow-md);
            transition: var(--transition-base);
            border-left: 4px solid transparent;
        }

        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }

        .stats-card.pending {
            border-left-color: var(--warning-color);
        }

        .stats-card.processing {
            border-left-color: var(--info-color);
        }

        .stats-card.ready {
            border-left-color: var(--success-color);
        }

        .stats-card.completed {
            border-left-color: #8B5CF6;
        }

        .order-card {
            background: white;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: var(--transition-base);
            height: 100%;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .order-card-header {
            padding: 1rem 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-card-header.pending {
            background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
        }

        .order-card-header.processing {
            background: linear-gradient(135deg, #DBEAFE 0%, #BFDBFE 100%);
        }

        .order-card-header.ready {
            background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
        }

        .order-card-header.completed {
            background: linear-gradient(135deg, #EDE9FE 0%, #DDD6FE 100%);
        }

        .order-code {
            font-family: var(--font-heading);
            font-weight: 700;
            font-size: 1.1rem;
        }

        .order-card-body {
            padding: 1.25rem;
        }

        .order-item {
            display: flex;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-item-icon {
            width: 32px;
            height: 32px;
            background: var(--light-secondary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            color: var(--primary-color);
        }

        .order-total {
            background: var(--light-color);
            padding: 1rem 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .action-btn {
            width: 100%;
            padding: 0.875rem;
            font-weight: 600;
            border-radius: 0;
            border: none;
            transition: var(--transition-base);
        }

        .action-btn:hover {
            transform: scale(1.02);
        }

        .action-btn.btn-cook {
            background: var(--primary-gradient);
            color: white;
        }

        .action-btn.btn-ready {
            background: linear-gradient(135deg, var(--success-color), #059669);
            color: white;
        }

        .action-btn.btn-payment {
            background: linear-gradient(135deg, #1F2937, #374151);
            color: white;
        }

        .action-btn.btn-completed {
            background: linear-gradient(135deg, #8B5CF6, #7C3AED);
            color: white;
            cursor: default;
            border-radius: 0 0 var(--radius-lg) var(--radius-lg);
        }

        .action-btn.btn-completed:hover {
            transform: none;
        }

        .order-items {
            max-height: 120px;
            overflow-y: auto;
        }

        .order-card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .order-card-body {
            flex: 1;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .status-tabs {
            background: white;
            border-radius: var(--radius-lg);
            padding: 0.5rem;
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.5rem;
        }

        .status-tabs .nav-link {
            border-radius: var(--radius-md);
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            color: var(--dark-secondary);
            transition: var(--transition-base);
        }

        .status-tabs .nav-link.active {
            background: var(--primary-gradient);
            color: white;
        }

        .status-tabs .nav-link:hover:not(.active) {
            background: var(--light-secondary);
        }

        .refresh-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.25rem 0.75rem;
            border-radius: var(--radius-full);
            font-size: 0.8rem;
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        /* ========== MOBILE RESPONSIVE ========== */
        @media (max-width: 768px) {
            body {
                padding-top: 0;
            }

            .kitchen-header {
                padding: 0.5rem 0;
                margin-bottom: 0.5rem;
            }

            .kitchen-header h4 {
                font-size: 0.85rem;
            }

            .kitchen-header small {
                font-size: 0.6rem;
            }

            .kitchen-header .d-flex {
                flex-wrap: wrap;
                gap: 0.35rem !important;
            }

            .kitchen-header div[style*="font-size: 2rem"] {
                font-size: 1.25rem !important;
            }

            .container-fluid {
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
            }

            .refresh-badge {
                font-size: 0.55rem;
                padding: 0.15rem 0.35rem;
            }

            .row.mb-4 {
                margin-bottom: 0.5rem !important;
            }

            .row.g-3 {
                --bs-gutter-y: 0.35rem;
                --bs-gutter-x: 0.35rem;
            }

            .stats-card {
                padding: 0.5rem;
            }

            .stats-card h3 {
                font-size: 0.95rem;
            }

            .stats-card .small {
                font-size: 0.6rem;
            }

            .stats-card .stats-icon {
                width: 30px !important;
                height: 30px !important;
                font-size: 0.8rem !important;
            }

            .status-tabs {
                padding: 0.2rem;
                margin-bottom: 0.5rem;
            }

            .status-tabs .nav {
                flex-wrap: nowrap;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
            }

            .status-tabs .nav::-webkit-scrollbar {
                display: none;
            }

            .status-tabs .nav-link {
                padding: 0.35rem 0.5rem;
                font-size: 0.7rem;
                white-space: nowrap;
            }

            .order-card {
                margin-bottom: 0.35rem;
            }

            .order-card-header {
                padding: 0.5rem 0.6rem;
            }

            .order-code {
                font-size: 0.85rem;
            }

            .order-card-body {
                padding: 0.6rem;
            }

            .order-items {
                max-height: 80px;
            }

            .order-item {
                font-size: 0.75rem;
                padding: 0.2rem 0;
            }

            .order-total {
                padding: 0.5rem 0.6rem;
            }

            .order-total .h5 {
                font-size: 0.85rem;
            }

            .action-btn {
                padding: 0.5rem;
                font-size: 0.75rem;
            }

            .empty-state {
                padding: 1.5rem 0.75rem;
            }

            .empty-state-icon {
                font-size: 2.5rem;
            }

            .empty-state h5 {
                font-size: 0.9rem;
            }

            .empty-state p {
                font-size: 0.75rem;
            }

            .avatar-circle {
                width: 26px;
                height: 26px;
                font-size: 0.7rem;
            }

            .btn-outline-primary.btn-sm {
                padding: 0.2rem 0.4rem;
                font-size: 0.7rem;
            }
        }

        @media (max-width: 480px) {
            .kitchen-header h4 {
                font-size: 0.75rem;
            }

            .kitchen-header div[style*="font-size: 2rem"] {
                font-size: 1rem !important;
            }

            .kitchen-header>.container-fluid>.d-flex {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 0.35rem !important;
            }

            .kitchen-header>.container-fluid>.d-flex>.d-flex:last-child {
                width: 100%;
                justify-content: space-between;
            }

            .stats-card {
                padding: 0.4rem;
            }

            .stats-card h3 {
                font-size: 0.85rem;
            }

            .stats-card .stats-icon {
                width: 24px !important;
                height: 24px !important;
                font-size: 0.7rem !important;
            }

            .order-card-header {
                padding: 0.4rem 0.5rem;
            }

            .order-code {
                font-size: 0.75rem;
            }

            .order-card-body {
                padding: 0.5rem;
            }

            .order-item {
                font-size: 0.7rem;
            }

            .action-btn {
                padding: 0.4rem;
                font-size: 0.7rem;
            }
        }
    </style>
</head>

<body>
    <!-- Kitchen Header -->
    <header class="kitchen-header">
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div style="font-size: 2rem;">🍳</div>
                    <div>
                        <h4 class="mb-0 fw-bold">Dapur & Kasir</h4>
                        <small class="opacity-75">Warung Kenyang Selalu</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="refresh-badge">
                        <i class="fas fa-sync-alt me-1 pulse-animation"></i> Auto refresh 30s
                    </span>
                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar-circle"
                            style="width: 40px; height: 40px; background: rgba(255,255,255,0.2);">
                            <i class="fas fa-user"></i>
                        </div>
                        <span class="d-none d-md-inline">{{ $user->full_name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-light btn-sm">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid px-4">
        <!-- Stats Cards -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3">
                <div class="stats-card pending">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-icon"
                            style="width: 50px; height: 50px; background: linear-gradient(135deg, #F59E0B, #D97706); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.25rem;">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 small">Menunggu</p>
                            <h3 class="mb-0 fw-bold" id="statPending">0</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stats-card processing">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-icon"
                            style="width: 50px; height: 50px; background: linear-gradient(135deg, #3B82F6, #2563EB); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.25rem;">
                            <i class="fas fa-fire"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 small">Dimasak</p>
                            <h3 class="mb-0 fw-bold" id="statProcessing">0</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stats-card ready">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-icon"
                            style="width: 50px; height: 50px; background: linear-gradient(135deg, #10B981, #059669); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.25rem;">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 small">Siap Diambil</p>
                            <h3 class="mb-0 fw-bold" id="statReady">0</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stats-card completed">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-icon"
                            style="width: 50px; height: 50px; background: linear-gradient(135deg, #8B5CF6, #7C3AED); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.25rem;">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 small">Selesai Hari Ini</p>
                            <h3 class="mb-0 fw-bold" id="statCompleted">0</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Tabs: Pesanan & Menu -->
        <div class="status-tabs mb-3">
            <ul class="nav nav-pills" id="mainTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="orders-tab" data-bs-toggle="tab" data-bs-target="#ordersPane"
                        type="button" role="tab">
                        <i class="fas fa-receipt me-1"></i> Pesanan
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="menu-tab" data-bs-toggle="tab" data-bs-target="#menuPane" type="button"
                        role="tab">
                        <i class="fas fa-utensils me-1"></i> Daftar Menu
                    </button>
                </li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div class="tab-content" id="mainTabContent">
            <!-- Pesanan Tab -->
            <div class="tab-pane fade show active" id="ordersPane" role="tabpanel">
                <!-- Filter Tabs -->
                <div class="status-tabs">
                    <ul class="nav nav-pills flex-nowrap overflow-auto" id="statusFilter">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" data-filter="all">
                                <i class="fas fa-list me-1"></i> Semua Aktif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-filter="pending">
                                <i class="fas fa-clock me-1"></i> Menunggu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-filter="processing">
                                <i class="fas fa-fire me-1"></i> Dimasak
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-filter="ready">
                                <i class="fas fa-check me-1"></i> Siap Diambil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-filter="completed">
                                <i class="fas fa-receipt me-1"></i> Sudah Bayar
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Orders Grid -->
                <div class="row g-4" id="ordersContainer">
                    <div class="col-12 text-center py-5">
                        <div class="spinner"></div>
                        <p class="text-muted mt-3">Memuat pesanan...</p>
                    </div>
                </div>
            </div>

            <!-- Menu Tab -->
            <div class="tab-pane fade" id="menuPane" role="tabpanel">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-utensils me-2 text-primary"></i> Daftar Menu yang Dijual
                        </h5>
                        <div class="d-flex gap-2">
                            <select class="form-select form-select-sm" id="menuCategoryFilter" style="width: auto;">
                                <option value="all">Semua Kategori</option>
                                <option value="Makanan Berat">Makanan Berat</option>
                                <option value="Minuman">Minuman</option>
                                <option value="Snack">Snack</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3" id="menuGrid">
                            <div class="col-12 text-center py-4">
                                <div class="spinner"></div>
                                <p class="text-muted mt-2">Memuat menu...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End tab-content -->
    </div> <!-- End container-fluid -->

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0" style="border-radius: 20px; overflow: hidden;">
                <div class="modal-header border-0" style="background: var(--primary-gradient); color: white;">
                    <h5 class="modal-title fw-bold">
                        <i class="fas fa-cash-register me-2"></i> Konfirmasi Pembayaran
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="paymentOrderDetails" class="mb-4"></div>
                    <label class="form-label fw-medium">Metode Pembayaran</label>
                    <div class="row g-2">
                        <div class="col-6">
                            <input type="radio" class="btn-check" name="paymentMethod" id="payCash" value="cash"
                                checked>
                            <label class="btn btn-outline-primary w-100 py-3" for="payCash">
                                <i class="fas fa-money-bill-wave d-block mb-1" style="font-size: 1.5rem;"></i>
                                Cash
                            </label>
                        </div>
                        <div class="col-6">
                            <input type="radio" class="btn-check" name="paymentMethod" id="payQris" value="qris">
                            <label class="btn btn-outline-primary w-100 py-3" for="payQris">
                                <i class="fas fa-qrcode d-block mb-1" style="font-size: 1.5rem;"></i>
                                QRIS
                            </label>
                        </div>
                        <div class="col-6">
                            <input type="radio" class="btn-check" name="paymentMethod" id="payDana" value="dana">
                            <label class="btn btn-outline-primary w-100 py-3" for="payDana">
                                <i class="fas fa-wallet d-block mb-1" style="font-size: 1.5rem;"></i>
                                Dana
                            </label>
                        </div>
                        <div class="col-6">
                            <input type="radio" class="btn-check" name="paymentMethod" id="payGopay" value="gopay">
                            <label class="btn btn-outline-primary w-100 py-3" for="payGopay">
                                <i class="fas fa-mobile-alt d-block mb-1" style="font-size: 1.5rem;"></i>
                                GoPay
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary px-4" onclick="processPayment()">
                        <i class="fas fa-check me-1"></i> Konfirmasi Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .avatar-circle {
            width: 36px;
            height: 36px;
            background: var(--primary-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.875rem;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        let allOrders = [];
        let completedOrders = [];
        let currentFilter = 'all';
        let currentPaymentOrderId = null;

        document.addEventListener('DOMContentLoaded', function () {
            loadOrders();

            // Setup filter tabs
            document.querySelectorAll('#statusFilter .nav-link').forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelectorAll('#statusFilter .nav-link').forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                    currentFilter = this.dataset.filter;
                    renderOrders();
                });
            });

            // Setup menu tab and filter
            setupMenuTab();
        });

        function setupMenuTab() {
            // Load menu when menu tab is clicked
            const menuTab = document.getElementById('menu-tab');
            if (menuTab) {
                menuTab.addEventListener('shown.bs.tab', function () {
                    if (allMenuItems.length === 0) {
                        loadMenuItems();
                    }
                });
            }

            // Category filter
            const categoryFilter = document.getElementById('menuCategoryFilter');
            if (categoryFilter) {
                categoryFilter.addEventListener('change', function () {
                    renderMenuItems(this.value);
                });
            }
        }

        async function loadOrders() {
            try {
                const result = await loadAllOrders();
                // Separate active and completed orders
                allOrders = result.filter(order => !['completed', 'cancelled'].includes(order.status));
                // Get all completed orders (show recent ones)
                completedOrders = result.filter(order => order.status === 'completed');

                console.log('Loaded orders:', {
                    active: allOrders.length,
                    completed: completedOrders.length,
                    total: result.length
                });

                updateStats();
                renderOrders();
            } catch (error) {
                console.error('Error loading orders:', error);
                showError('Gagal memuat pesanan');
            }
        }

        function updateStats() {
            document.getElementById('statPending').textContent = allOrders.filter(o => o.status === 'pending').length;
            document.getElementById('statProcessing').textContent = allOrders.filter(o => o.status === 'processing').length;
            document.getElementById('statReady').textContent = allOrders.filter(o => o.status === 'ready').length;
            document.getElementById('statCompleted').textContent = completedOrders.length;
        }

        function renderOrders() {
            const container = document.getElementById('ordersContainer');
            let orders = [];

            if (currentFilter === 'completed') {
                orders = completedOrders;
            } else if (currentFilter === 'all') {
                orders = allOrders;
            } else {
                orders = allOrders.filter(o => o.status === currentFilter);
            }

            if (!orders.length) {
                container.innerHTML = `
                    <div class="col-12">
                        <div class="empty-state">
                            <div class="empty-state-icon">${currentFilter === 'completed' ? '💰' : '📋'}</div>
                            <h5 class="fw-bold">${currentFilter === 'completed' ? 'Belum ada pembayaran hari ini' : 'Tidak ada pesanan'}</h5>
                            <p class="text-muted mb-0">
                                ${currentFilter === 'all' ? 'Belum ada pesanan aktif saat ini' :
                        currentFilter === 'completed' ? 'Pesanan yang sudah dibayar akan muncul di sini' :
                            'Tidak ada pesanan dengan status ini'}
                            </p>
                        </div>
                    </div>
                `;
                return;
            }

            container.innerHTML = orders.map(order => {
                const items = (order.items_ordered ?? '').split(',').map(item => item.trim()).filter(Boolean);

                let actionBtn = '';
                let statusText = '';
                let statusIcon = '';

                if (order.status === 'pending') {
                    statusText = 'Menunggu';
                    statusIcon = '⏳';
                    actionBtn = `<button onclick="handleUpdateStatus(${order.id}, 'processing', this)" class="action-btn btn-cook">
                        <i class="fas fa-fire me-2"></i> Mulai Masak
                    </button>`;
                } else if (order.status === 'processing') {
                    statusText = 'Sedang Dimasak';
                    statusIcon = '🔥';
                    actionBtn = `<button onclick="handleUpdateStatus(${order.id}, 'ready', this)" class="action-btn btn-ready">
                        <i class="fas fa-check me-2"></i> Siap Disajikan
                    </button>`;
                } else if (order.status === 'ready') {
                    statusText = 'Siap Diambil';
                    statusIcon = '✅';
                    actionBtn = `<button onclick="showPaymentModal(${order.id}, '${order.order_code}', ${order.total_amount})" class="action-btn btn-payment">
                        <i class="fas fa-cash-register me-2"></i> Terima Pembayaran
                    </button>`;
                } else if (order.status === 'completed') {
                    statusText = 'Selesai';
                    statusIcon = '💰';
                    const paymentMethod = order.payment_method ? order.payment_method.toUpperCase() : 'CASH';
                    actionBtn = `<div class="action-btn btn-completed">
                        <i class="fas fa-check-circle me-2"></i> Dibayar via ${paymentMethod}
                    </div>`;
                }

                return `
                    <div class="col-lg-4 col-md-6">
                        <div class="order-card">
                            <div class="order-card-header ${order.status}">
                                <span class="order-code">#${order.order_code}</span>
                                <span class="badge bg-white text-dark">
                                    ${statusIcon} ${statusText}
                                </span>
                            </div>
                            <div class="order-card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="fw-bold mb-0">${order.customer_name}</h6>
                                        <small class="text-muted">${order.customer_phone ?? '-'}</small>
                                    </div>
                                    <div class="text-end">
                                        <small class="text-muted d-block">Jadwal Ambil</small>
                                        <span class="fw-medium">${order.pickup_time}</span>
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class="order-items">
                                    ${items.map(item => `
                                        <div class="order-item">
                                            <span class="small">• ${item}</span>
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                            <div class="order-total">
                                <span class="fw-medium">Total</span>
                                <span class="h5 mb-0 fw-bold text-gradient">${formatRupiah(order.total_amount)}</span>
                            </div>
                            ${actionBtn}
                        </div>
                    </div>
                `;
            }).join('');
        }

        async function handleUpdateStatus(id, status, btn) {
            const statusText = status === 'processing' ? 'Mulai memasak' : 'Siap disajikan';

            // Show loading state on the button
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Memproses...';
            }

            try {
                // Direct API call to ensure it works
                const response = await fetch(`/api/orders/${id}/status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ status: status })
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Gagal mengupdate status');
                }

                showToast(`${statusText} pesanan berhasil!`, 'success');
                loadOrders();
            } catch (error) {
                console.error('Error updating status:', error);
                showToast('Gagal mengupdate status: ' + error.message, 'danger');
                // Reload to reset button state
                loadOrders();
            }
        }

        function showPaymentModal(orderId, orderCode, total) {
            currentPaymentOrderId = orderId;
            document.getElementById('paymentOrderDetails').innerHTML = `
                <div class="text-center p-3" style="background: var(--light-secondary); border-radius: 12px;">
                    <small class="text-muted">Kode Pesanan</small>
                    <h4 class="fw-bold text-gradient mb-2">#${orderCode}</h4>
                    <h3 class="fw-bold">${formatRupiah(total)}</h3>
                </div>
            `;
            // Reset to cash
            document.getElementById('payCash').checked = true;
            const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
            modal.show();
        }

        async function processPayment() {
            const method = document.querySelector('input[name="paymentMethod"]:checked').value;

            try {
                // Direct API call to ensure it works
                const response = await fetch(`/api/orders/${currentPaymentOrderId}/payment`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ payment_method: method })
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Gagal memproses pembayaran');
                }

                bootstrap.Modal.getInstance(document.getElementById('paymentModal')).hide();
                showToast('Pembayaran berhasil! Pesanan selesai.', 'success');
                loadOrders();
            } catch (error) {
                console.error('Error processing payment:', error);
                showToast('Gagal memproses pembayaran: ' + error.message, 'danger');
            }
        }

        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `alert alert-${type} position-fixed shadow-lg`;
            toast.style.cssText = 'top: 100px; right: 20px; z-index: 9999; animation: slideInUp 0.3s ease; min-width: 300px;';
            toast.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>${message}`;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        function showError(message) {
            document.getElementById('ordersContainer').innerHTML = `
                <div class="col-12">
                    <div class="alert alert-danger text-center">
                        <i class="fas fa-exclamation-triangle me-2"></i> ${message}
                    </div>
                </div>
            `;
        }

        // ========== MENU FUNCTIONS ==========
        let allMenuItems = [];

        async function loadMenuItems() {
            try {
                const response = await fetch('/api/menu');
                const data = await response.json();

                if (data.success) {
                    allMenuItems = data.data;
                    renderMenuItems('all');
                }
            } catch (error) {
                console.error('Error loading menu:', error);
                document.getElementById('menuGrid').innerHTML = `
                            <div class="col-12 text-center py-4">
                                <i class="fas fa-exclamation-triangle text-danger" style="font-size: 2rem;"></i>
                                <p class="text-muted mt-2">Gagal memuat menu</p>
                            </div>
                        `;
            }
        }

        function renderMenuItems(category) {
            const grid = document.getElementById('menuGrid');
            let filteredMenu = allMenuItems;

            if (category !== 'all') {
                filteredMenu = allMenuItems.filter(item => item.category === category);
            }

            if (filteredMenu.length === 0) {
                grid.innerHTML = `
                            <div class="col-12 text-center py-4">
                                <i class="fas fa-utensils text-muted" style="font-size: 2rem;"></i>
                                <p class="text-muted mt-2">Tidak ada menu dalam kategori ini</p>
                            </div>
                        `;
                return;
            }

            grid.innerHTML = filteredMenu.map(item => {
                const stockClass = item.stock > 10 ? 'success' : item.stock > 0 ? 'warning' : 'danger';
                const stockLabel = item.stock > 0 ? `Stok: ${item.stock}` : 'Habis';

                const imageDisplay = item.image_url
                    ? `<img src="${item.image_url}" alt="${item.menu_name}" 
                                   style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px;"
                                   onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                               <div class="menu-thumb-placeholder" style="width: 60px; height: 60px; display:none; background: var(--light-secondary); border-radius: 10px; align-items: center; justify-content: center;">
                                   <i class="fas fa-utensils text-muted"></i>
                               </div>`
                    : `<div class="menu-thumb-placeholder" style="width: 60px; height: 60px; background: var(--light-secondary); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                   <i class="fas fa-utensils text-muted"></i>
                               </div>`;

                return `
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body text-center p-2">
                                        <div class="mb-2 d-flex justify-content-center">
                                            ${imageDisplay}
                                        </div>
                                        <h6 class="fw-bold mb-1" style="font-size: 0.85rem;">${item.menu_name}</h6>
                                        <p class="text-primary fw-bold mb-1" style="font-size: 0.9rem;">${formatRupiah(item.price)}</p>
                                        <div class="d-flex justify-content-center gap-1 flex-wrap">
                                            <span class="badge bg-${stockClass}" style="font-size: 0.65rem;">${stockLabel}</span>
                                            <span class="badge bg-secondary" style="font-size: 0.65rem;">${item.category}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
            }).join('');
        }
    </script>
</body>

</html>