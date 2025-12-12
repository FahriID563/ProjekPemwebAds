<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Menu - Warung Kenyang Selalu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .order-layout {
            position: fixed;
            top: 80px;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, var(--light-color) 0%, var(--light-secondary) 100%);
            overflow: hidden;
        }

        .main-container {
            height: 100%;
            overflow: hidden;
        }

        /* Menu Column */
        .menu-column {
            height: 100%;
            display: flex;
            flex-direction: column;
            padding: 1.5rem;
            overflow: hidden;
        }

        .menu-header {
            flex-shrink: 0;
            padding-bottom: 1rem;
            background: transparent;
        }

        .menu-scroll-area {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: var(--primary-color) transparent;
        }

        .menu-scroll-area::-webkit-scrollbar {
            width: 6px;
        }

        .menu-scroll-area::-webkit-scrollbar-track {
            background: transparent;
        }

        .menu-scroll-area::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }

        /* Cart Column */
        .cart-column {
            height: 100%;
            padding: 1.5rem;
            overflow: hidden;
        }

        .cart-wrapper {
            height: 100%;
            display: flex;
            flex-direction: column;
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }

        .cart-header {
            flex-shrink: 0;
            background: var(--primary-gradient);
            color: white;
            padding: 1.25rem;
        }

        .cart-body {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 1rem;
            scrollbar-width: thin;
            scrollbar-color: var(--primary-color) transparent;
        }

        .cart-body::-webkit-scrollbar {
            width: 6px;
        }

        .cart-body::-webkit-scrollbar-track {
            background: transparent;
        }

        .cart-body::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }

        .cart-footer {
            flex-shrink: 0;
            padding: 1.25rem;
            background: var(--white);
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Menu Cards */
        .menu-item-card {
            transition: var(--transition-base);
            border: 2px solid transparent;
        }

        .menu-item-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
            box-shadow: var(--shadow-lg);
        }

        .cart-item {
            padding: 0.75rem;
            background: var(--light-color);
            border-radius: var(--radius-md);
            margin-bottom: 0.75rem;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-sm);
        }

        .category-badge {
            background: var(--light-secondary);
            color: var(--primary-color);
            padding: 0.25rem 0.75rem;
            border-radius: var(--radius-full);
            font-size: 0.8rem;
            font-weight: 500;
        }

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

        .nav-link.active {
            color: var(--primary-color) !important;
            font-weight: 600;
        }

        /* ========== MOBILE RESPONSIVE ========== */
        @media (max-width: 991px) {
            .order-layout {
                position: relative;
                top: 0;
                min-height: calc(100vh - 70px);
                padding-bottom: 280px;
                /* Space for sticky cart */
            }

            .main-container {
                height: auto;
                overflow: visible;
            }

            .menu-column {
                height: auto;
                padding: 1rem;
                overflow: visible;
            }

            .menu-scroll-area {
                overflow: visible;
                padding-right: 0;
            }

            .cart-column {
                display: none;
            }

            .menu-header h3 {
                font-size: 1.1rem;
            }

            .menu-header p {
                font-size: 0.8rem;
            }

            .menu-header .btn {
                padding: 0.35rem 0.75rem;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 768px) {
            body {
                padding-top: 60px;
            }

            .order-layout {
                padding-bottom: 260px;
            }

            .menu-column {
                padding: 0.75rem;
            }

            .menu-header {
                padding-bottom: 0.75rem;
            }

            .menu-header .d-flex {
                flex-direction: column;
                gap: 0.5rem;
                text-align: center;
            }

            .menu-header .btn {
                width: 100%;
            }

            /* Compact menu cards for mobile grid */
            .menu-item-card .card-body {
                padding: 0.5rem !important;
            }

            .menu-item-card .menu-image,
            .menu-item-card .menu-item-img,
            .menu-item-card div[style*="width: 70px"] {
                width: 50px !important;
                height: 50px !important;
            }

            .menu-item-card h6 {
                font-size: 0.75rem !important;
                margin-bottom: 0.25rem !important;
                line-height: 1.2;
            }

            .menu-item-card .menu-price {
                font-size: 0.8rem !important;
                margin-bottom: 0.25rem !important;
            }

            .menu-item-card .category-badge {
                font-size: 0.65rem;
                padding: 0.15rem 0.4rem;
            }

            .menu-item-card .card-footer {
                padding: 0.35rem !important;
            }

            .menu-item-card .card-footer .btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.7rem;
            }

            .category-badge i {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .order-layout {
                padding-bottom: 240px;
            }

            .menu-column {
                padding: 0.5rem;
            }

            .menu-header h3 {
                font-size: 1rem;
            }

            /* Extra compact on very small screens */
            .menu-item-card .card-body {
                padding: 0.4rem !important;
            }

            .menu-item-card .menu-image,
            .menu-item-card .menu-item-img,
            .menu-item-card div[style*="width: 70px"] {
                width: 40px !important;
                height: 40px !important;
            }

            .menu-item-card h6 {
                font-size: 0.7rem !important;
            }

            .menu-item-card .menu-price {
                font-size: 0.75rem !important;
            }

            .menu-item-card .card-footer .btn {
                padding: 0.2rem 0.4rem;
                font-size: 0.65rem;
            }
        }

        /* ========== MOBILE STICKY CART ========== */
        .mobile-cart {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--white);
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.15);
            border-radius: 20px 20px 0 0;
            z-index: 1000;
            max-height: 280px;
            overflow: hidden;
        }

        @media (max-width: 991px) {
            .mobile-cart {
                display: flex;
                flex-direction: column;
            }
        }

        .mobile-cart-header {
            background: var(--primary-gradient);
            color: white;
            padding: 0.75rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .mobile-cart-body {
            flex: 1;
            overflow-y: auto;
            padding: 0.75rem;
            max-height: 120px;
        }

        .mobile-cart-footer {
            padding: 0.75rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .mobile-cart-footer .row {
            margin-bottom: 0.5rem;
        }

        .mobile-cart-footer .form-control-sm {
            font-size: 0.8rem;
            padding: 0.35rem 0.5rem;
        }

        .mobile-cart-footer .btn {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
        }

        .mobile-cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.4rem 0.5rem;
            background: var(--light-color);
            border-radius: 8px;
            margin-bottom: 0.4rem;
            font-size: 0.8rem;
        }

        .mobile-cart-item .qty-controls {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .mobile-cart-item .qty-btn {
            width: 24px;
            height: 24px;
            font-size: 0.65rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                <i class="fas fa-utensils"></i> Warung Kenyang Selalu
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.customer') }}">
                            <i class="fas fa-home me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('dashboard.customer.order') }}">
                            <i class="fas fa-utensils me-1"></i> Pesan Menu
                        </a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar-circle">
                                <i class="fas fa-user"></i>
                            </div>
                            <span class="fw-medium d-none d-lg-inline">{{ $user->full_name }}</span>
                        </div>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="order-layout">
        <div class="container-fluid h-100">
            <div class="row main-container">
                <!-- Menu Section -->
                <div class="col-lg-8 menu-column">
                    <!-- Fixed Header -->
                    <div class="menu-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="fw-bold mb-1">
                                    <span class="text-gradient">Pilih Menu</span> Favoritmu
                                </h3>
                                <p class="text-muted mb-0">Klik menu untuk menambahkan ke keranjang</p>
                            </div>
                            <a href="{{ route('dashboard.customer') }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>

                    <!-- Scrollable Menu Grid -->
                    <div class="menu-scroll-area">
                        <div class="row g-3" id="menuGrid">
                            <div class="col-12 text-center py-5">
                                <div class="spinner"></div>
                                <p class="text-muted">Memuat menu...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cart Section -->
                <div class="col-lg-4 cart-column">
                    <div class="cart-wrapper">
                        <!-- Fixed Cart Header -->
                        <div class="cart-header">
                            <h5 class="mb-0">
                                <i class="fas fa-shopping-cart me-2"></i> Keranjang Pesanan
                                <span class="badge bg-white text-primary ms-2" id="cartCount">0</span>
                            </h5>
                        </div>

                        <!-- Scrollable Cart Items -->
                        <div class="cart-body" id="cartItems">
                            <div class="text-center py-4">
                                <div style="font-size: 3rem; opacity: 0.5;">🛒</div>
                                <p class="text-muted mt-2 mb-0">Keranjang masih kosong</p>
                                <small class="text-muted">Pilih menu untuk memulai pesanan</small>
                            </div>
                        </div>

                        <!-- Fixed Cart Footer -->
                        <div class="cart-footer">
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label small fw-medium mb-1">
                                        <i class="fas fa-calendar me-1 text-primary"></i> Tanggal
                                    </label>
                                    <input type="date" class="form-control form-control-sm" id="pickupDate"
                                        value="{{ now()->toDateString() }}">
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-medium mb-1">
                                        <i class="fas fa-clock me-1 text-primary"></i> Jam
                                    </label>
                                    <input type="time" class="form-control form-control-sm" id="pickupTime" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-medium">Total</span>
                                <span class="h5 mb-0 fw-bold text-gradient" id="cartTotal">Rp 0</span>
                            </div>

                            <button onclick="checkout()" class="btn btn-primary w-100 py-2 fw-bold">
                                <i class="fas fa-check-circle me-2"></i> BUAT PESANAN
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Sticky Cart (visible only on mobile) -->
    <div class="mobile-cart" id="mobileCart">
        <div class="mobile-cart-header" onclick="toggleMobileCartBody()">
            <div>
                <i class="fas fa-shopping-cart me-2"></i>
                <span class="fw-bold">Keranjang</span>
                <span class="badge bg-white text-primary ms-2" id="mobileCartCount">0</span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="fw-bold" id="mobileCartTotal">Rp 0</span>
                <i class="fas fa-chevron-up" id="mobileCartChevron"></i>
            </div>
        </div>
        <div class="mobile-cart-body" id="mobileCartBody">
            <div class="text-center py-2 text-muted" id="mobileCartEmpty">
                <small>Keranjang masih kosong</small>
            </div>
            <div id="mobileCartItems"></div>
        </div>
        <div class="mobile-cart-footer">
            <div class="row g-2 mb-2">
                <div class="col-6">
                    <input type="date" class="form-control form-control-sm" id="mobilePickupDate"
                        value="{{ now()->toDateString() }}">
                </div>
                <div class="col-6">
                    <input type="time" class="form-control form-control-sm" id="mobilePickupTime"
                        placeholder="Jam ambil">
                </div>
            </div>
            <button onclick="checkoutMobile()" class="btn btn-primary w-100 fw-bold">
                <i class="fas fa-check-circle me-1"></i> BUAT PESANAN
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        const USER = @json($user);
        let cart = [];

        document.addEventListener('DOMContentLoaded', loadMenu);

        async function loadMenu() {
            const data = await loadAvailableMenu();
            const grid = document.getElementById('menuGrid');

            if (!data || data.length === 0) {
                grid.innerHTML = `
                    <div class="col-12 text-center py-5">
                        <div style="font-size: 4rem;">🍽️</div>
                        <h5 class="mt-3">Menu belum tersedia</h5>
                        <p class="text-muted">Silakan cek kembali nanti</p>
                    </div>
                `;
                return;
            }

            grid.innerHTML = data.map(item => {
                const imageDisplay = item.image_url
                    ? `<img src="${item.image_url}" alt="${item.menu_name}" class="menu-item-img" 
                           style="width: 50px; height: 50px; object-fit: cover; border-radius: 10px;"
                           onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                       <div class="menu-image" style="width: 50px; height: 50px; margin: 0 auto; display:none;"><i class="fas fa-utensils"></i></div>`
                    : `<div class="menu-image" style="width: 50px; height: 50px; margin: 0 auto;"><i class="fas fa-utensils"></i></div>`;

                return `
                <div class="col-6 col-sm-4 col-md-4 col-lg-3 col-xl-3">
                    <div class="card h-100 border-0 shadow-sm menu-item-card" onclick='addToCart(${JSON.stringify(item)})' style="cursor:pointer">
                        <div class="card-body text-center p-2">
                            <div class="mb-2 d-flex justify-content-center">
                                ${imageDisplay}
                            </div>
                            <h6 class="fw-bold mb-1" style="font-size: 0.8rem; line-height: 1.2;">${item.menu_name}</h6>
                            <p class="menu-price mb-1" style="font-size: 0.85rem;">${formatRupiah(item.price)}</p>
                            <span class="category-badge" style="font-size: 0.65rem;">
                                Stok: ${item.stock}
                            </span>
                        </div>
                        <div class="card-footer bg-transparent border-0 p-2 pt-0">
                            <button class="btn btn-outline-primary w-100" style="font-size: 0.7rem; padding: 0.25rem 0.5rem;">
                                <i class="fas fa-plus me-1"></i>Tambah
                            </button>
                        </div>
                    </div>
                </div>
            `}).join('');
        }

        function addToCart(item) {
            const existing = cart.find(c => c.id === item.id);
            if (existing) {
                if (existing.qty < item.stock) {
                    existing.qty++;
                } else {
                    showToast('Stok maksimal tercapai!', 'warning');
                    return;
                }
            } else {
                cart.push({ ...item, qty: 1 });
            }
            renderCart();
            showToast(`${item.menu_name} ditambahkan!`, 'success');
        }

        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `alert alert-${type} position-fixed`;
            toast.style.cssText = 'top: 100px; right: 20px; z-index: 9999; animation: slideInUp 0.3s ease;';
            toast.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>${message}`;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 2000);
        }

        function renderCart() {
            const container = document.getElementById('cartItems');
            const countBadge = document.getElementById('cartCount');
            let total = 0;
            let itemCount = 0;

            cart.forEach(item => {
                total += item.price * item.qty;
                itemCount += item.qty;
            });

            countBadge.textContent = itemCount;

            // Update mobile cart as well
            const mobileCountBadge = document.getElementById('mobileCartCount');
            const mobileCartTotal = document.getElementById('mobileCartTotal');
            const mobileCartItems = document.getElementById('mobileCartItems');
            const mobileCartEmpty = document.getElementById('mobileCartEmpty');

            if (mobileCountBadge) mobileCountBadge.textContent = itemCount;
            if (mobileCartTotal) mobileCartTotal.textContent = formatRupiah(total);

            if (cart.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-4">
                        <div style="font-size: 3rem; opacity: 0.5;">🛒</div>
                        <p class="text-muted mt-2 mb-0">Keranjang masih kosong</p>
                        <small class="text-muted">Pilih menu untuk memulai pesanan</small>
                    </div>
                `;
                document.getElementById('cartTotal').innerText = 'Rp 0';

                // Mobile cart empty state
                if (mobileCartEmpty) mobileCartEmpty.style.display = 'block';
                if (mobileCartItems) mobileCartItems.innerHTML = '';
                return;
            }

            // Hide empty message on mobile
            if (mobileCartEmpty) mobileCartEmpty.style.display = 'none';

            // Desktop cart
            container.innerHTML = cart.map((item, index) => `
                <div class="cart-item">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h6 class="mb-1 fw-bold" style="font-size: 0.9rem;">${item.menu_name}</h6>
                            <small class="text-muted">${formatRupiah(item.price)} × ${item.qty}</small>
                        </div>
                        <span class="fw-bold text-gradient" style="font-size: 0.9rem;">${formatRupiah(item.price * item.qty)}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <button class="btn btn-outline-secondary qty-btn" onclick="updateQty(${index}, -1)">
                            <i class="fas fa-minus" style="font-size: 0.7rem;"></i>
                        </button>
                        <span class="fw-bold px-2">${item.qty}</span>
                        <button class="btn btn-outline-primary qty-btn" onclick="updateQty(${index}, 1)">
                            <i class="fas fa-plus" style="font-size: 0.7rem;"></i>
                        </button>
                        <button class="btn btn-outline-danger qty-btn ms-auto" onclick="removeItem(${index})">
                            <i class="fas fa-trash" style="font-size: 0.7rem;"></i>
                        </button>
                    </div>
                </div>
            `).join('');

            // Mobile cart items
            if (mobileCartItems) {
                mobileCartItems.innerHTML = cart.map((item, index) => `
                    <div class="mobile-cart-item">
                        <div>
                            <span class="fw-bold">${item.menu_name}</span>
                            <span class="text-muted ms-1">${formatRupiah(item.price * item.qty)}</span>
                        </div>
                        <div class="qty-controls">
                            <button class="btn btn-outline-secondary qty-btn" onclick="updateQty(${index}, -1)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span class="fw-bold px-1">${item.qty}</span>
                            <button class="btn btn-outline-primary qty-btn" onclick="updateQty(${index}, 1)">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button class="btn btn-outline-danger qty-btn" onclick="removeItem(${index})">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                `).join('');
            }

            document.getElementById('cartTotal').innerText = formatRupiah(total);
        }

        // Mobile cart toggle function
        function toggleMobileCartBody() {
            const body = document.getElementById('mobileCartBody');
            const chevron = document.getElementById('mobileCartChevron');
            if (body.style.display === 'none') {
                body.style.display = 'block';
                chevron.classList.remove('fa-chevron-down');
                chevron.classList.add('fa-chevron-up');
            } else {
                body.style.display = 'none';
                chevron.classList.remove('fa-chevron-up');
                chevron.classList.add('fa-chevron-down');
            }
        }

        // Mobile checkout function
        async function checkoutMobile() {
            if (cart.length === 0) {
                showToast('Pilih menu terlebih dahulu!', 'warning');
                return;
            }

            const time = document.getElementById('mobilePickupTime').value;
            const date = document.getElementById('mobilePickupDate').value;

            if (!time || !date) {
                showToast('Lengkapi waktu pengambilan!', 'warning');
                return;
            }

            // Use the same checkout logic
            document.getElementById('pickupTime').value = time;
            document.getElementById('pickupDate').value = date;
            await checkout();
        }

        function updateQty(index, change) {
            cart[index].qty += change;
            if (cart[index].qty <= 0) {
                cart.splice(index, 1);
            } else if (cart[index].qty > cart[index].stock) {
                showToast('Stok maksimal tercapai!', 'warning');
                cart[index].qty = cart[index].stock;
            }
            renderCart();
        }

        function removeItem(index) {
            const itemName = cart[index].menu_name;
            cart.splice(index, 1);
            renderCart();
            showToast(`${itemName} dihapus`, 'info');
        }

        async function checkout() {
            if (cart.length === 0) {
                showToast('Pilih menu terlebih dahulu!', 'warning');
                return;
            }

            const time = document.getElementById('pickupTime').value;
            const date = document.getElementById('pickupDate').value;

            if (!time || !date) {
                showToast('Lengkapi waktu pengambilan!', 'warning');
                return;
            }

            // Calculate total
            let total = 0;
            cart.forEach(item => {
                total += item.price * item.qty;
            });

            const orderData = {
                user_id: USER.id,
                customer_name: USER.full_name,
                customer_phone: USER.phone ?? '08xxxxx',
                pickup_date: date,
                pickup_time: time,
                items: cart.map(c => ({
                    menu_item_id: c.id,
                    menu_name: c.menu_name,
                    price: c.price,
                    quantity: c.qty,
                })),
            };

            try {
                const result = await createOrder(orderData);

                // Show confirmation modal
                showOrderConfirmation(result.data.order_code, cart, total, date, time);

            } catch (error) {
                showToast('Gagal membuat pesanan: ' + error.message, 'danger');
            }
        }

        function showOrderConfirmation(orderCode, items, total, date, time) {
            // Format date nicely
            const dateObj = new Date(date);
            const formattedDate = dateObj.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            // Build items HTML
            const itemsHtml = items.map(item => `
                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                    <div>
                        <span class="fw-medium">${item.menu_name}</span>
                        <br>
                        <small class="text-muted">${formatRupiah(item.price)} × ${item.qty}</small>
                    </div>
                    <span class="fw-bold">${formatRupiah(item.price * item.qty)}</span>
                </div>
            `).join('');

            // Create modal HTML
            const modalHtml = `
                <div class="modal fade" id="orderConfirmModal" tabindex="-1" data-bs-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                            <!-- Header -->
                            <div class="modal-header border-0 text-center" style="background: var(--primary-gradient); padding: 2rem;">
                                <div class="w-100 text-white">
                                    <div style="font-size: 4rem; margin-bottom: 0.5rem;">🎉</div>
                                    <h4 class="fw-bold mb-1">Pesanan Berhasil!</h4>
                                    <p class="mb-0 opacity-75">Terima kasih telah memesan</p>
                                </div>
                            </div>
                            
                            <!-- Body -->
                            <div class="modal-body p-4">
                                <!-- Order Code -->
                                <div class="text-center mb-4 p-3" style="background: var(--light-secondary); border-radius: 12px;">
                                    <small class="text-muted d-block mb-1">Kode Pesanan</small>
                                    <h3 class="fw-bold text-gradient mb-0">#${orderCode}</h3>
                                </div>

                                <!-- Pickup Info -->
                                <div class="d-flex gap-3 mb-4">
                                    <div class="flex-fill p-3 text-center" style="background: var(--light-color); border-radius: 12px;">
                                        <i class="fas fa-calendar text-primary mb-2" style="font-size: 1.5rem;"></i>
                                        <p class="small text-muted mb-0">Tanggal</p>
                                        <p class="fw-medium mb-0" style="font-size: 0.85rem;">${formattedDate}</p>
                                    </div>
                                    <div class="flex-fill p-3 text-center" style="background: var(--light-color); border-radius: 12px;">
                                        <i class="fas fa-clock text-primary mb-2" style="font-size: 1.5rem;"></i>
                                        <p class="small text-muted mb-0">Jam Ambil</p>
                                        <p class="fw-bold mb-0">${time}</p>
                                    </div>
                                </div>

                                <!-- Order Items -->
                                <div class="mb-3">
                                    <h6 class="fw-bold mb-3">
                                        <i class="fas fa-receipt me-2 text-primary"></i>Detail Pesanan
                                    </h6>
                                    <div style="max-height: 200px; overflow-y: auto;">
                                        ${itemsHtml}
                                    </div>
                                </div>

                                <!-- Total -->
                                <div class="d-flex justify-content-between align-items-center p-3 mt-3" style="background: var(--primary-gradient); border-radius: 12px; color: white;">
                                    <span class="fw-medium">Total Pembayaran</span>
                                    <span class="h4 fw-bold mb-0">${formatRupiah(total)}</span>
                                </div>

                                <!-- Payment Note -->
                                <div class="alert alert-warning mt-3 mb-0" style="border-radius: 12px;">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <small>Pembayaran dilakukan saat pengambilan pesanan.</small>
                                </div>
                            </div>
                            
                            <!-- Footer -->
                            <div class="modal-footer border-0 p-4 pt-0">
                                <button type="button" class="btn btn-primary w-100 py-3 fw-bold" onclick="goToDashboard()">
                                    <i class="fas fa-check-circle me-2"></i> Lihat Riwayat Pesanan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Remove existing modal if any
            const existingModal = document.getElementById('orderConfirmModal');
            if (existingModal) {
                existingModal.remove();
            }

            // Add modal to body
            document.body.insertAdjacentHTML('beforeend', modalHtml);

            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('orderConfirmModal'));
            modal.show();
        }

        function goToDashboard() {
            window.location.href = "{{ route('dashboard.customer') }}";
        }

        // Navbar scroll effect
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>