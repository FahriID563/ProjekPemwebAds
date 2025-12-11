<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Warung Kenyang Selalu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-warning shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-dark" href="{{ route('landing') }}">
                <i class="fas fa-utensils"></i> Warung Kenyang Selalu
            </a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-dark fw-semibold">
                    {{ $user->full_name }} <small class="d-block text-muted">{{ strtoupper($user->role) }}</small>
                </span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-dark">
                        <i class="fas fa-power-off"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container py-5">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">Profil Pengguna</h5>
                        <p class="mb-2"><strong>Nama:</strong> {{ $user->full_name }}</p>
                        <p class="mb-2"><strong>Username:</strong> {{ $user->username }}</p>
                        <p class="mb-2"><strong>Peran:</strong> {{ ucfirst($user->role) }}</p>
                        <p class="mb-2"><strong>Email:</strong> {{ $user->email ?? '-' }}</p>
                        <p class="mb-0"><strong>Telepon:</strong> {{ $user->phone ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title fw-bold mb-0">Pesanan Terbaru</h5>
                            <span class="badge bg-warning text-dark">{{ $recentOrders->count() }} Pesanan</span>
                        </div>
                        @if ($recentOrders->isEmpty())
                            <div class="alert alert-info mb-0">
                                Belum ada pesanan. Silakan mulai menerima atau membuat pesanan baru.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped align-middle">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Pelanggan</th>
                                            <th>Total Item</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentOrders as $order)
                                            <tr>
                                                <td class="fw-semibold">{{ $order->order_code }}</td>
                                                <td>
                                                    <div>{{ $order->customer_name }}</div>
                                                    <small class="text-muted">{{ $order->customer_phone }}</small>
                                                </td>
                                                <td>{{ $order->details_count }}</td>
                                                <td>
                                                    <span class="badge bg-secondary text-uppercase">{{ $order->status }}</span>
                                                </td>
                                                <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

