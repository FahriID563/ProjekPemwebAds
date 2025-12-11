<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Warung Kenyang Selalu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Administrator</a>
            <div class="d-flex">
                <span class="navbar-text text-white me-3">Halo, {{ $user->full_name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body">
                        <h5>Total Pesanan</h5>
                        <h2 id="totalOrders">0</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <h5>Pendapatan Hari Ini</h5>
                        <h2 id="todayRevenue">Rp 0</h2>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4">
                <div class="card shadow">
                    <div class="card-header bg-warning d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">Manajemen Menu</h5>
                        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#menuModal" onclick="resetForm()">
                            <i class="fas fa-plus"></i> Tambah Menu
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="menuTable">
                                <thead>
                                    <tr>
                                        <th>Nama Menu</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="menuTableBody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="menuModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="menuForm">
                        <input type="hidden" id="menuId">
                        <div class="mb-3">
                            <label>Nama Menu</label>
                            <input type="text" class="form-control" id="menuName" required>
                        </div>
                        <div class="mb-3">
                            <label>Kategori</label>
                            <select class="form-select" id="menuCategory" required>
                                <option value="Makanan Berat">Makanan Berat</option>
                                <option value="Minuman">Minuman</option>
                                <option value="Snack">Snack</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Harga</label>
                                <input type="number" class="form-control" id="menuPrice" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Stok</label>
                                <input type="number" class="form-control" id="menuStock" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea class="form-control" id="menuDesc"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>URL Gambar</label>
                            <input type="text" class="form-control" id="menuImage">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="menuAvailable" checked>
                            <label class="form-check-label" for="menuAvailable">
                                Tersedia
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="saveMenu()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        const API_BASE = '/api';

        document.addEventListener('DOMContentLoaded', () => {
            loadStats();
            loadMenus();
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
                const tbody = document.getElementById('menuTableBody');
                tbody.innerHTML = '';

                result.data.forEach(menu => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${menu.menu_name}</td>
                            <td><span class="badge bg-info">${menu.category}</span></td>
                            <td>${formatRupiah(menu.price)}</td>
                            <td>${menu.stock}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" onclick='editMenu(${JSON.stringify(menu)})'><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger" onclick="deleteMenu(${menu.id})"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    `;
                });
            } catch (error) {
                console.error(error);
            }
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
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify(payload),
                    });
                } else {
                    await fetchAPI('/menu', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify(payload),
                    });
                }

                bootstrap.Modal.getInstance(document.getElementById('menuModal')).hide();
                loadMenus();
                showAlert('Berhasil disimpan!');
            } catch (error) {
                showAlert('Gagal menyimpan: ' + error.message, 'danger');
            }
        }

        async function deleteMenu(id) {
            if (! confirm('Yakin hapus menu ini?')) return;

            try {
                await fetchAPI(`/menu/${id}`, {
                    method: 'DELETE',
                });
                loadMenus();
            } catch (error) {
                showAlert('Gagal menghapus: ' + error.message, 'danger');
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
            document.getElementById('menuAvailable').checked = Boolean(menu.is_available);
            document.getElementById('modalTitle').innerText = 'Edit Menu';
            new bootstrap.Modal(document.getElementById('menuModal')).show();
        }

        function resetForm() {
            document.getElementById('menuForm').reset();
            document.getElementById('menuId').value = '';
            document.getElementById('menuAvailable').checked = true;
            document.getElementById('modalTitle').innerText = 'Tambah Menu';
        }
    </script>
</body>
</html>

