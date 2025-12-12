<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Warung Kenyang Selalu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        body {
            background: linear-gradient(180deg, var(--light-color) 0%, var(--light-secondary) 100%);
            min-height: 100vh;
        }

        .admin-header {
            background: linear-gradient(135deg, #1F2937 0%, #374151 100%);
            color: white;
            padding: 1rem 0;
            margin-bottom: 2rem;
        }

        .stats-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
            transition: var(--transition-base);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }

        .stats-card.primary::before {
            background: var(--primary-gradient);
        }

        .stats-card.success::before {
            background: linear-gradient(135deg, #10B981, #059669);
        }

        .stats-card.info::before {
            background: linear-gradient(135deg, #3B82F6, #2563EB);
        }

        .stats-card.warning::before {
            background: linear-gradient(135deg, #F59E0B, #D97706);
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stats-icon.primary {
            background: var(--primary-gradient);
        }

        .stats-icon.success {
            background: linear-gradient(135deg, #10B981, #059669);
        }

        .stats-icon.info {
            background: linear-gradient(135deg, #3B82F6, #2563EB);
        }

        .stats-icon.warning {
            background: linear-gradient(135deg, #F59E0B, #D97706);
        }

        .menu-card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .menu-card-header {
            background: var(--primary-gradient);
            color: white;
            padding: 1.25rem 1.5rem;
        }

        .menu-table {
            margin-bottom: 0;
        }

        .menu-table th {
            background: var(--light-secondary);
            font-weight: 600;
            padding: 1rem;
            border: none;
        }

        .menu-table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .menu-table tbody tr {
            transition: var(--transition-base);
        }

        .menu-table tbody tr:hover {
            background: var(--light-color);
        }

        .menu-image {
            width: 45px;
            height: 45px;
            min-width: 45px;
            background: var(--light-secondary);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
        }

        .menu-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .menu-thumb {
            width: 45px;
            height: 45px;
            min-width: 45px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid var(--light-secondary);
        }

        .menu-thumb-placeholder {
            width: 45px;
            height: 45px;
            min-width: 45px;
            background: var(--light-secondary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 1rem;
        }

        .category-badge {
            padding: 0.35rem 0.75rem;
            border-radius: var(--radius-full);
            font-size: 0.8rem;
            font-weight: 500;
        }

        .category-badge.makanan {
            background: linear-gradient(135deg, #FEF3C7, #FDE68A);
            color: #92400E;
        }

        .category-badge.minuman {
            background: linear-gradient(135deg, #DBEAFE, #BFDBFE);
            color: #1E40AF;
        }

        .category-badge.snack {
            background: linear-gradient(135deg, #D1FAE5, #A7F3D0);
            color: #065F46;
        }

        .stock-badge {
            padding: 0.35rem 0.75rem;
            border-radius: var(--radius-md);
            font-weight: 600;
        }

        .stock-badge.low {
            background: #FEE2E2;
            color: #991B1B;
        }

        .stock-badge.medium {
            background: #FEF3C7;
            color: #92400E;
        }

        .stock-badge.high {
            background: #D1FAE5;
            color: #065F46;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-md);
            transition: var(--transition-base);
        }

        .action-btn:hover {
            transform: scale(1.1);
        }

        .nav-tabs-custom {
            border: none;
            background: white;
            padding: 0.5rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.5rem;
        }

        .nav-tabs-custom .nav-link {
            border: none;
            border-radius: var(--radius-md);
            padding: 0.75rem 1.5rem;
            color: var(--dark-secondary);
            font-weight: 500;
            transition: var(--transition-base);
        }

        .nav-tabs-custom .nav-link.active {
            background: var(--primary-gradient);
            color: white;
        }

        .nav-tabs-custom .nav-link:hover:not(.active) {
            background: var(--light-secondary);
        }

        .modern-modal .modal-content {
            border: none;
            border-radius: 20px;
            overflow: hidden;
        }

        .modern-modal .modal-header {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 1.5rem;
        }

        .modern-modal .modal-body {
            padding: 1.5rem;
        }

        .modern-modal .modal-footer {
            border: none;
            padding: 1rem 1.5rem 1.5rem;
        }

        .avatar-circle {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .empty-table {
            text-align: center;
            padding: 3rem;
        }

        /* ========== MOBILE RESPONSIVE ========== */
        @media (max-width: 768px) {
            body {
                padding-top: 60px;
            }

            .admin-header {
                padding: 0.5rem 0;
                margin-bottom: 0.75rem;
            }

            .admin-header h4 {
                font-size: 0.85rem;
            }

            .admin-header small {
                font-size: 0.6rem;
            }

            .admin-header .d-flex {
                gap: 0.35rem !important;
            }

            .admin-header div[style*="font-size: 2rem"] {
                font-size: 1.25rem !important;
            }

            .container-fluid {
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
            }

            .row.mb-4 {
                margin-bottom: 0.75rem !important;
            }

            .row.g-4 {
                --bs-gutter-y: 0.5rem;
                --bs-gutter-x: 0.5rem;
            }

            .stats-card {
                padding: 0.6rem;
            }

            .stats-card h3,
            .stats-card h4 {
                font-size: 1rem;
            }

            .stats-card .small {
                font-size: 0.65rem;
            }

            .stats-icon {
                width: 32px;
                height: 32px;
                font-size: 0.85rem;
            }

            .menu-card-header {
                padding: 0.6rem;
                flex-direction: row;
                gap: 0.5rem;
            }

            .menu-card-header h5 {
                font-size: 0.85rem;
            }

            .menu-card-header .btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.7rem;
            }

            .nav-tabs-custom {
                overflow-x: auto;
                flex-wrap: nowrap;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
            }

            .nav-tabs-custom::-webkit-scrollbar {
                display: none;
            }

            .nav-tabs-custom .nav-link {
                padding: 0.35rem 0.5rem;
                font-size: 0.7rem;
            }

            .table-responsive {
                font-size: 0.75rem;
            }

            .menu-table th,
            .menu-table td {
                padding: 0.35rem;
                font-size: 0.7rem;
            }

            .menu-table th:nth-child(5),
            .menu-table td:nth-child(5) {
                display: none;
            }

            .menu-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.15rem;
            }

            .menu-thumb,
            .menu-thumb-placeholder {
                width: 28px;
                height: 28px;
                min-width: 28px;
            }

            .action-btn {
                width: 24px;
                height: 24px;
                font-size: 0.65rem;
            }

            .category-badge,
            .stock-badge {
                font-size: 0.6rem;
                padding: 0.15rem 0.35rem;
            }

            .modern-modal .modal-dialog {
                margin: 0.25rem;
            }

            .modern-modal .modal-header,
            .modern-modal .modal-body,
            .modern-modal .modal-footer {
                padding: 0.75rem;
            }

            .modal-title {
                font-size: 0.9rem;
            }

            .form-label {
                font-size: 0.75rem;
            }

            .form-control {
                font-size: 0.8rem;
                padding: 0.35rem 0.5rem;
            }

            .empty-table {
                padding: 1.5rem 0.75rem;
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
            .admin-header h4 {
                font-size: 0.75rem;
            }

            .admin-header div[style*="font-size: 2rem"] {
                font-size: 1rem !important;
            }

            .admin-header .btn-sm {
                padding: 0.2rem 0.35rem;
                font-size: 0.65rem;
            }

            .admin-header .btn-sm span,
            .admin-header .btn-sm .d-none {
                display: none !important;
            }

            .stats-card {
                padding: 0.5rem;
            }

            .stats-card h3,
            .stats-card h4 {
                font-size: 0.9rem;
            }

            .stats-icon {
                width: 28px;
                height: 28px;
                font-size: 0.75rem;
            }

            .row.g-4 {
                --bs-gutter-y: 0.35rem;
                --bs-gutter-x: 0.35rem;
            }

            .menu-table th:nth-child(2),
            .menu-table td:nth-child(2) {
                display: none;
            }

            .menu-card-header {
                flex-direction: column;
                text-align: center;
            }

            .menu-card-header .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Admin Header -->
    <header class="admin-header">
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div style="font-size: 2rem;">⚙️</div>
                    <div>
                        <h4 class="mb-0 fw-bold">Panel Admin</h4>
                        <small class="opacity-75">Warung Kenyang Selalu</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar-circle">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <span class="d-none d-md-inline">{{ $user->full_name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid px-4">
        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="stats-card primary">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-icon primary">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1 small">Total Pesanan</p>
                            <h3 class="mb-0 fw-bold" id="totalOrders">0</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stats-card success">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-icon success">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1 small">Pendapatan Hari Ini</p>
                            <h4 class="mb-0 fw-bold text-gradient" id="todayRevenue">Rp 0</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stats-card info">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-icon info">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1 small">Total Menu</p>
                            <h3 class="mb-0 fw-bold" id="totalMenu">0</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stats-card warning">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stats-icon warning">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1 small">Stok Menipis</p>
                            <h3 class="mb-0 fw-bold" id="lowStock">0</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Management -->
        <div class="menu-card">
            <div class="menu-card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-clipboard-list me-2"></i> Manajemen Menu
                    </h5>
                </div>
                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#menuModal" onclick="resetForm()">
                    <i class="fas fa-plus me-1"></i> Tambah Menu
                </button>
            </div>

            <!-- Category Filter -->
            <div class="p-3 border-bottom">
                <ul class="nav nav-tabs-custom" id="categoryFilter">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" data-category="all">
                            <i class="fas fa-list me-1"></i> Semua
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-category="Makanan Berat">
                            <i class="fas fa-drumstick-bite me-1"></i> Makanan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-category="Minuman">
                            <i class="fas fa-glass-water me-1"></i> Minuman
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-category="Snack">
                            <i class="fas fa-cookie me-1"></i> Snack
                        </a>
                    </li>
                </ul>
            </div>

            <div class="table-responsive">
                <table class="table menu-table" id="menuTable">
                    <thead>
                        <tr>
                            <th style="width: 30%;">Nama Menu</th>
                            <th style="width: 15%;">Kategori</th>
                            <th style="width: 15%;">Harga</th>
                            <th style="width: 10%;">Stok</th>
                            <th style="width: 12%;">Status</th>
                            <th style="width: 18%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="menuTableBody">
                        <tr>
                            <td colspan="6">
                                <div class="empty-table">
                                    <div class="spinner"></div>
                                    <p class="text-muted mt-2 mb-0">Memuat data...</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Menu Modal -->
    <div class="modal fade modern-modal" id="menuModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalTitle">
                        <i class="fas fa-plus-circle me-2"></i> Tambah Menu
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="menuForm">
                        <input type="hidden" id="menuId">
                        <div class="mb-3">
                            <label class="form-label fw-medium">Nama Menu</label>
                            <input type="text" class="form-control" id="menuName" placeholder="Masukkan nama menu"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Kategori</label>
                            <select class="form-select" id="menuCategory" required>
                                <option value="Makanan Berat">🍽️ Makanan Berat</option>
                                <option value="Minuman">🥤 Minuman</option>
                                <option value="Snack">🍪 Snack</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-medium">Harga (Rp)</label>
                                <input type="number" class="form-control" id="menuPrice" placeholder="0" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-medium">Stok</label>
                                <input type="number" class="form-control" id="menuStock" placeholder="0" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Deskripsi</label>
                            <textarea class="form-control" id="menuDesc" rows="2"
                                placeholder="Deskripsi menu (opsional)"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">URL Gambar</label>
                            <input type="text" class="form-control" id="menuImage" placeholder="https://...">
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="menuAvailable" checked>
                            <label class="form-check-label" for="menuAvailable">
                                Menu tersedia untuk dipesan
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary px-4" onclick="saveMenu()">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        const API_BASE = '/api';
        let allMenus = [];
        let currentCategory = 'all';

        document.addEventListener('DOMContentLoaded', () => {
            loadStats();
            loadMenus();

            // Category filter
            document.querySelectorAll('#categoryFilter .nav-link').forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelectorAll('#categoryFilter .nav-link').forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                    currentCategory = this.dataset.category;
                    renderMenuTable();
                });
            });
        });

        async function loadStats() {
            try {
                const result = await fetchAPI('/orders/stats');
                document.getElementById('totalOrders').innerText = result.data.total_orders;
                document.getElementById('todayRevenue').innerText = formatRupiah(result.data.today_revenue);
            } catch (error) {
                console.error(error);
            }
        }

        async function loadMenus() {
            try {
                const result = await fetchAPI('/menu');
                allMenus = result.data;

                // Update stats
                document.getElementById('totalMenu').innerText = allMenus.length;
                document.getElementById('lowStock').innerText = allMenus.filter(m => m.stock <= 5).length;

                renderMenuTable();
            } catch (error) {
                console.error(error);
            }
        }

        function renderMenuTable() {
            const tbody = document.getElementById('menuTableBody');
            let menus = allMenus;

            if (currentCategory !== 'all') {
                menus = allMenus.filter(m => m.category === currentCategory);
            }

            if (!menus.length) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6">
                            <div class="empty-table">
                                <div style="font-size: 3rem;">🍽️</div>
                                <h6 class="mt-3">Tidak ada menu</h6>
                                <p class="text-muted mb-0">
                                    ${currentCategory === 'all' ? 'Belum ada menu. Tambahkan menu pertama!' : 'Tidak ada menu dalam kategori ini'}
                                </p>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = menus.map(menu => {
                // Category badge class
                let categoryClass = 'makanan';
                if (menu.category === 'Minuman') categoryClass = 'minuman';
                else if (menu.category === 'Snack') categoryClass = 'snack';

                // Stock badge class
                let stockClass = 'high';
                if (menu.stock <= 5) stockClass = 'low';
                else if (menu.stock <= 15) stockClass = 'medium';

                // Status text - handle both 1/0 and true/false
                const isAvailable = menu.is_available === true || menu.is_available === 1 || menu.is_available === '1';
                const statusText = isAvailable
                    ? '<span class="text-success fw-bold"><i class="fas fa-check-circle me-1"></i>Aktif</span>'
                    : '<span class="text-secondary fw-bold"><i class="fas fa-times-circle me-1"></i>Nonaktif</span>';

                // Image display
                const imageDisplay = menu.image_url
                    ? `<img src="${menu.image_url}" alt="${menu.menu_name}" class="menu-thumb" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                       <div class="menu-thumb-placeholder" style="display:none;"><i class="fas fa-utensils"></i></div>`
                    : `<div class="menu-thumb-placeholder"><i class="fas fa-utensils"></i></div>`;

                return `
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                ${imageDisplay}
                                <div>
                                    <strong>${menu.menu_name}</strong>
                                    <br><small class="text-muted">${menu.description ? menu.description.substring(0, 30) : '-'}</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="category-badge ${categoryClass}">${menu.category}</span></td>
                        <td><strong>Rp ${formatRupiah(menu.price)}</strong></td>
                        <td><span class="stock-badge ${stockClass}">${menu.stock}</span></td>
                        <td>${statusText}</td>
                        <td class="text-center">
                            <button class="btn btn-warning btn-sm me-1" onclick='editMenu(${JSON.stringify(menu)})'>
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteMenu(${menu.id}, this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        async function saveMenu() {
            const id = document.getElementById('menuId').value;
            const payload = {
                menu_name: document.getElementById('menuName').value,
                category: document.getElementById('menuCategory').value,
                price: document.getElementById('menuPrice').value,
                stock: document.getElementById('menuStock').value,
                description: document.getElementById('menuDesc').value,
                image_url: document.getElementById('menuImage').value,
                is_available: document.getElementById('menuAvailable').checked,
            };

            try {
                if (id) {
                    await fetchAPI(`/menu/${id}`, {
                        method: 'PUT',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(payload),
                    });
                } else {
                    await fetchAPI('/menu', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(payload),
                    });
                }

                bootstrap.Modal.getInstance(document.getElementById('menuModal')).hide();
                loadMenus();
                showToast('Menu berhasil disimpan!', 'success');
            } catch (error) {
                showToast('Gagal menyimpan: ' + error.message, 'danger');
            }
        }

        async function deleteMenu(id, btn) {
            console.log('Delete menu called with ID:', id);

            // Show loading state
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            }

            try {
                console.log('Sending DELETE request to:', `/api/menu/${id}`);
                const response = await fetch(`/api/menu/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                console.log('Response status:', response.status);
                const data = await response.json();
                console.log('Response data:', data);

                if (!response.ok) {
                    throw new Error(data.message || 'Gagal menghapus');
                }

                showToast('Menu berhasil dihapus', 'success');
                loadMenus();
            } catch (error) {
                console.error('Delete error:', error);
                showToast('Gagal menghapus: ' + error.message, 'danger');
                loadMenus(); // Reload to reset button state
            }
        }

        function editMenu(menu) {
            document.getElementById('menuId').value = menu.id;
            document.getElementById('menuName').value = menu.menu_name;
            document.getElementById('menuCategory').value = menu.category;
            document.getElementById('menuPrice').value = menu.price;
            document.getElementById('menuStock').value = menu.stock;
            document.getElementById('menuDesc').value = menu.description ?? '';
            document.getElementById('menuImage').value = menu.image_url ?? '';
            document.getElementById('menuAvailable').checked = (menu.is_available === true || menu.is_available === 1 || menu.is_available === '1');
            document.getElementById('modalTitle').innerHTML = '<i class="fas fa-edit me-2"></i> Edit Menu';
            new bootstrap.Modal(document.getElementById('menuModal')).show();
        }

        function resetForm() {
            document.getElementById('menuForm').reset();
            document.getElementById('menuId').value = '';
            document.getElementById('menuAvailable').checked = true;
            document.getElementById('modalTitle').innerHTML = '<i class="fas fa-plus-circle me-2"></i> Tambah Menu';
        }

        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `alert alert-${type} position-fixed shadow-lg`;
            toast.style.cssText = 'top: 100px; right: 20px; z-index: 9999; animation: slideInUp 0.3s ease; min-width: 300px;';
            toast.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>${message}`;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }
    </script>
</body>

</html>