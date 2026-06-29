<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Transaksi - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f0;
            min-height: 100vh;
            padding: 30px;
        }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            background: #fffbf7;
        }
        .card-header {
            background: #fffbf7;
            border-bottom: 2px solid #f0e3d8;
            padding: 20px 25px;
            border-radius: 16px 16px 0 0 !important;
        }
        .card-header h4 {
            color: #5a4a3a;
            font-weight: 600;
        }
        .card-body {
            padding: 25px;
        }
        .btn-logout {
            background-color: #d4a0a0;
            border: none;
            border-radius: 10px;
            padding: 8px 18px;
            color: white;
            transition: background-color 0.2s;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-logout:hover {
            background-color: #c48a8a;
            color: white;
        }
        .btn-primary {
            background-color: #3d3d3a;
            border: none;
            border-radius: 8px;
            padding: 6px 14px;
            color: white;
            transition: background-color 0.2s;
            font-size: 13px;
        }
        .btn-primary:hover {
            background-color: #2c2c2a;
            color: white;
        }
        .btn-secondary {
            background-color: #f0e3d8;
            border: none;
            border-radius: 8px;
            padding: 6px 14px;
            color: #5a4a3a;
            transition: background-color 0.2s;
            font-size: 13px;
        }
        .btn-secondary:hover {
            background-color: #e5d5c8;
        }
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-diproses { background: #cce5ff; color: #004085; }
        .status-dikirim { background: #d4edda; color: #155724; }
        .status-selesai { background: #d1ecf1; color: #0c5460; }
        .status-batal { background: #f8d7da; color: #721c24; }
        .table {
            color: #5a4a3a;
        }
        .table thead th {
            background: #f5ede7;
            color: #7a5e4a;
            border-bottom: 2px solid #f0e3d8;
            font-weight: 600;
        }
        .table tbody tr:hover {
            background: #faf5f0;
        }
        .stats-card {
            background: #f5ede7;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
        }
        .stats-card .number {
            font-size: 28px;
            font-weight: 700;
            color: #3d3d3a;
        }
        .stats-card .label {
            font-size: 14px;
            color: #8a7a6a;
        }
        .stats-card i {
            font-size: 32px;
            color: #b59676;
            display: block;
            margin-bottom: 8px;
        }
        .alert-custom-success {
            background: #e8f5e8;
            border: 1px solid #c4e0c4;
            color: #4a7a5a;
            border-radius: 10px;
            padding: 12px 18px;
        }
        .alert-custom-danger {
            background: #f5e8e8;
            border: 1px solid #e0c4c4;
            color: #7a4a4a;
            border-radius: 10px;
            padding: 12px 18px;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Navbar -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="bi bi-receipt me-2"></i>Manajemen Transaksi
            </h4>
            <div>
                <span class="me-3 text-muted">
                    <i class="bi bi-person-circle me-1"></i>
                    <?= htmlspecialchars($_SESSION['nama'] ?? 'Admin') ?>
                </span>
                <a href="index.php?controller=produk&action=index" class="btn btn-secondary btn-sm me-2">
                    <i class="bi bi-box-seam me-1"></i>Produk
                </a>
                <a href="index.php?controller=auth&action=logout" class="btn btn-logout btn-sm">
                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Alert -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-custom-success d-flex align-items-center gap-2 py-2 px-3 mb-3">
                    <i class="bi bi-check-circle-fill"></i>
                    <?= htmlspecialchars($_SESSION['success']) ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-custom-danger d-flex align-items-center gap-2 py-2 px-3 mb-3">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <?= htmlspecialchars($_SESSION['error']) ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <!-- Statistik -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="stats-card">
                        <i class="bi bi-cart-check"></i>
                        <div class="number"><?= $total_transaksi ?? 0 ?></div>
                        <div class="label">Total Transaksi</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <i class="bi bi-currency-dollar"></i>
                        <div class="number">Rp <?= number_format($total_pendapatan ?? 0, 0, ',', '.') ?></div>
                        <div class="label">Total Pendapatan</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <i class="bi bi-box"></i>
                        <div class="number"><?= $total_terjual ?? 0 ?></div>
                        <div class="label">Produk Terjual</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <i class="bi bi-clock-history"></i>
                        <div class="number">
                            <?php 
                                $pending = array_filter($transaksi ?? [], function($t) {
                                    return $t['status'] == 'pending';
                                });
                                echo count($pending);
                            ?>
                        </div>
                        <div class="label">Pending</div>
                    </div>
                </div>
            </div>

            <!-- Tabel Transaksi -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pembeli</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($transaksi)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-4" style="color: #b59676;">
                                    <i class="bi bi-inbox" style="font-size: 32px; display: block; margin-bottom: 10px;"></i>
                                    Belum ada transaksi
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($transaksi as $t): ?>
                            <tr>
                                <td>#<?= str_pad($t['id'], 6, '0', STR_PAD_LEFT) ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($t['user_nama']) ?></strong><br>
                                    <small class="text-muted"><?= htmlspecialchars($t['user_email']) ?></small>
                                </td>
                                <td><?= date('d M Y H:i', strtotime($t['tanggal_transaksi'])) ?></td>
                                <td>Rp <?= number_format($t['total_harga'], 0, ',', '.') ?></td>
                                <td><?= strtoupper(str_replace('_', ' ', $t['metode_pembayaran'] ?? '-')) ?></td>
                                <td>
                                    <span class="status-badge status-<?= $t['status'] ?>">
                                        <?= ucfirst($t['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="index.php?controller=transaksi&action=adminDetail&id=<?= $t['id'] ?>" class="btn btn-primary btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>