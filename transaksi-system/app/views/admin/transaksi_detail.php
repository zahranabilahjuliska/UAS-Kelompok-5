<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi - Admin</title>
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
            padding: 8px 20px;
            color: white;
            transition: background-color 0.2s;
        }
        .btn-primary:hover {
            background-color: #2c2c2a;
            color: white;
        }
        .btn-secondary {
            background-color: #f0e3d8;
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
            color: #5a4a3a;
            transition: background-color 0.2s;
        }
        .btn-secondary:hover {
            background-color: #e5d5c8;
        }
        .btn-success {
            background-color: #4a8a5a;
            border: none;
            border-radius: 8px;
            padding: 5px 14px;
            color: white;
            font-size: 13px;
        }
        .btn-success:hover {
            background-color: #3a7a4a;
            color: white;
        }
        .btn-warning {
            background-color: #e8d5a0;
            border: none;
            border-radius: 8px;
            padding: 5px 14px;
            color: #5a4a3a;
            font-size: 13px;
        }
        .btn-warning:hover {
            background-color: #dec98a;
        }
        .btn-danger {
            background-color: #d4a0a0;
            border: none;
            border-radius: 8px;
            padding: 5px 14px;
            color: white;
            font-size: 13px;
        }
        .btn-danger:hover {
            background-color: #c48a8a;
            color: white;
        }
        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 13px;
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
        .info-box {
            background: #f5ede7;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .info-box p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="bi bi-receipt me-2"></i>Detail Transaksi #<?= str_pad($transaksi['id'], 6, '0', STR_PAD_LEFT) ?>
            </h4>
            <div>
                <span class="me-3 text-muted">
                    <i class="bi bi-person-circle me-1"></i>
                    <?= htmlspecialchars($_SESSION['nama'] ?? 'Admin') ?>
                </span>
                <a href="index.php?controller=transaksi&action=adminIndex" class="btn btn-secondary btn-sm me-2">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
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

            <!-- Info Transaksi -->
            <div class="info-box row">
                <div class="col-md-6">
                    <p><strong>Pembeli:</strong> <?= htmlspecialchars($transaksi['user_nama']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($transaksi['user_email']) ?></p>
                    <p><strong>Tanggal:</strong> <?= date('d M Y, H:i', strtotime($transaksi['tanggal_transaksi'])) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Metode Pembayaran:</strong> <?= strtoupper(str_replace('_', ' ', $transaksi['metode_pembayaran'] ?? '-')) ?></p>
                    <p><strong>Alamat Pengiriman:</strong> <?= htmlspecialchars($transaksi['alamat_pengiriman']) ?></p>
                    <p>
                        <strong>Status:</strong>
                        <span class="status-badge status-<?= $transaksi['status'] ?>">
                            <?= ucfirst($transaksi['status']) ?>
                        </span>
                    </p>
                </div>
            </div>

            <!-- Update Status -->
            <div class="mb-4">
                <form action="index.php?controller=transaksi&action=adminUpdateStatus" method="POST" class="d-flex align-items-center gap-3">
                    <input type="hidden" name="id" value="<?= $transaksi['id'] ?>">
                    <label class="fw-bold" style="color: #5a4a3a;">Update Status:</label>
                    <select name="status" class="form-select form-select-sm" style="width: 150px; border-radius: 8px; border: 1.5px solid #e0dfd8;">
                        <option value="pending" <?= $transaksi['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="diproses" <?= $transaksi['status'] == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                        <option value="dikirim" <?= $transaksi['status'] == 'dikirim' ? 'selected' : '' ?>>Dikirim</option>
                        <option value="selesai" <?= $transaksi['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                        <option value="batal" <?= $transaksi['status'] == 'batal' ? 'selected' : '' ?>>Batal</option>
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-save me-1"></i>Update
                    </button>
                </form>
            </div>

            <!-- Detail Produk -->
            <h6 class="fw-bold" style="color: #5a4a3a;">Detail Produk</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga Satuan</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($details as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['nama_produk']) ?></td>
                                <td>Rp <?= number_format($item['harga_satuan'], 0, ',', '.') ?></td>
                                <td><?= $item['quantity'] ?></td>
                                <td>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Total</th>
                            <th>Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>