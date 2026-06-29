<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi - Toko Tas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f8f5f0;
            min-height: 100vh;
            padding: 0 !important;
            margin: 0 !important;
        }

        .container-fluid {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background: #ffffff;
            box-shadow: 0 2px 20px rgba(0,0,0,0.05);
            padding: 12px 20px;
            margin-bottom: 30px;
            border-radius: 0 !important;
        }
        .navbar-custom .container-fluid {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        .navbar-custom .brand {
            font-weight: 700;
            font-size: 22px;
            color: #2d2d2d;
            text-decoration: none;
            letter-spacing: -0.5px;
        }
        .navbar-custom .brand i {
            color: #c9a88a;
        }
        .navbar-custom .nav-link {
            color: #5a4a3a;
            font-weight: 500;
            font-size: 14px;
            padding: 10px 16px;
            transition: all 0.3s;
            border-radius: 8px;
        }
        .navbar-custom .nav-link:hover {
            background: #f5ede7;
            color: #2d2d2d;
        }
        .navbar-custom .nav-link.active {
            background: #f5ede7;
            color: #2d2d2d;
        }
        .btn-logout {
            background: #e8ddd0;
            border: none;
            border-radius: 10px;
            padding: 8px 20px;
            color: #5a4a3a;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-logout:hover {
            background: #d5c8b8;
            color: #2d2d2d;
        }
        .badge-cart {
            background: #c9a88a;
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 11px;
            font-weight: 600;
            position: absolute;
            top: -6px;
            right: -8px;
        }
        .navbar-toggler {
            border: none;
            padding: 8px 10px;
            border-radius: 10px;
            background: #f5ede7;
        }
        .navbar-toggler:focus {
            box-shadow: none;
        }
        .navbar-toggler i {
            font-size: 24px;
            color: #2d2d2d;
        }

        @media (max-width: 991px) {
            .navbar-collapse {
                padding-top: 16px;
                border-top: 1px solid #f0e8e0;
                margin-top: 12px;
            }
            .navbar-custom .nav-link {
                padding: 12px 16px;
                width: 100%;
            }
            .navbar-custom .btn-logout {
                width: 100%;
                justify-content: center;
                margin-top: 8px;
            }
            .navbar-right {
                margin-top: 12px;
                padding-top: 12px;
                border-top: 1px solid #f0e8e0;
            }
        }

        /* ===== CARD ===== */
        .detail-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.04);
            padding: 30px;
            margin: 0 20px 24px;
        }
        .detail-card .card-title {
            font-weight: 600;
            font-size: 20px;
            color: #2d2d2d;
            margin-bottom: 8px;
        }
        .detail-card .card-subtitle {
            color: #8a7a6a;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .detail-card .card-title i {
            color: #c9a88a;
            margin-right: 10px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px 30px;
            background: #f8f5f0;
            padding: 20px 24px;
            border-radius: 12px;
            margin-bottom: 24px;
        }
        .info-grid .info-item .label {
            font-size: 12px;
            color: #8a7a6a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 500;
        }
        .info-grid .info-item .value {
            font-weight: 600;
            color: #2d2d2d;
            font-size: 15px;
            margin: 0;
        }

        /* ===== STATUS BADGE ===== */
        .status-badge {
            padding: 6px 18px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
        }
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        .status-diproses {
            background: #cce5ff;
            color: #004085;
        }
        .status-dikirim {
            background: #d4edda;
            color: #155724;
        }
        .status-selesai {
            background: #d1ecf1;
            color: #0c5460;
        }
        .status-batal {
            background: #f8d7da;
            color: #721c24;
        }

        /* ===== TABLE ===== */
        .table-transaksi {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            color: #5a4a3a;
        }
        .table-transaksi thead th {
            background: #f8f5f0;
            color: #2d2d2d;
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .table-transaksi tbody td {
            padding: 12px 16px;
            border-bottom: 1px solid #f0e8e0;
        }
        .table-transaksi tbody tr:last-child td {
            border-bottom: none;
        }
        .table-transaksi tbody tr:hover {
            background: #faf8f5;
        }

        .total-row {
            display: flex;
            justify-content: flex-end;
            padding: 16px 0 0;
            border-top: 2px solid #e8e0d8;
            margin-top: 8px;
        }
        .total-row .total-label {
            font-size: 16px;
            color: #5a4a3a;
            margin-right: 20px;
            font-weight: 500;
        }
        .total-row .total-amount {
            font-size: 22px;
            font-weight: 700;
            color: #2d2d2d;
        }

        /* ===== BUTTONS ===== */
        .btn-primary {
            background: #2d2d2d;
            border: none;
            border-radius: 10px;
            padding: 10px 24px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary:hover {
            background: #1a1a1a;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            color: white;
        }
        .btn-secondary {
            background: #f0e3d8;
            border: none;
            border-radius: 10px;
            padding: 10px 24px;
            color: #5a4a3a;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-secondary:hover {
            background: #e5d5c8;
            color: #2d2d2d;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .alert-custom-success {
            background: #e8f5e8;
            border: 1px solid #c4e0c4;
            color: #4a7a5a;
            border-radius: 10px;
            padding: 12px 18px;
            margin: 0 20px 20px;
        }

        footer {
            text-align: center;
            padding: 30px 0 10px;
            color: #8a7a6a;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .detail-card {
                padding: 20px;
                margin: 0 10px 16px;
            }
            .info-grid {
                grid-template-columns: 1fr;
                gap: 8px;
                padding: 16px;
            }
            .table-transaksi {
                font-size: 13px;
            }
            .table-transaksi thead th,
            .table-transaksi tbody td {
                padding: 10px 12px;
            }
            .total-row .total-amount {
                font-size: 18px;
            }
            .action-buttons {
                flex-direction: column;
            }
            .action-buttons .btn-primary,
            .action-buttons .btn-secondary {
                justify-content: center;
            }
            .alert-custom-success {
                margin: 0 10px 16px;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid">

    <!-- ===== NAVBAR (SAMA PERSIS) ===== -->
    <nav class="navbar-custom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                        <i class="bi bi-list"></i>
                    </button>
                    <a href="index.php?controller=produk&action=produk_list" class="brand">
                        <i class="bi bi-bag-heart-fill me-2"></i>Toko Tas
                    </a>
                </div>

                <div class="d-none d-lg-flex align-items-center gap-1">
                    <a href="index.php?controller=produk&action=produk_list" class="nav-link">
                        <i class="bi bi-grid-3x3-gap-fill me-1"></i>Katalog
                    </a>
                    <a href="index.php?controller=transaksi&action=history" class="nav-link">
                        <i class="bi bi-clock-history me-1"></i>Transaksi
                    </a>
                    <a href="index.php?controller=keranjang&action=index" class="nav-link position-relative">
                        <i class="bi bi-cart3 me-1"></i>Keranjang
                        <?php
                            require_once '../app/models/KeranjangModel.php';
                            $keranjangModel = new KeranjangModel();
                            $cartCount = $keranjangModel->countItems($_SESSION['user_id']);
                        ?>
                        <?php if ($cartCount > 0): ?>
                            <span class="badge-cart"><?= $cartCount ?></span>
                        <?php endif; ?>
                    </a>
                </div>

                <div class="d-none d-lg-flex align-items-center gap-3">
                    <span style="font-size: 14px; color: #5a4a3a;">
                        <i class="bi bi-person-circle me-1"></i>
                        <?= htmlspecialchars($_SESSION['nama'] ?? 'Pembeli') ?>
                    </span>
                    <a href="index.php?controller=auth&action=logout" class="btn-logout">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </a>
                </div>
            </div>

            <div class="collapse" id="navbarMenu">
                <div class="d-flex flex-column">
                    <a href="index.php?controller=produk&action=produk_list" class="nav-link">
                        <i class="bi bi-grid-3x3-gap-fill me-2"></i>Katalog
                    </a>
                    <a href="index.php?controller=transaksi&action=history" class="nav-link">
                        <i class="bi bi-clock-history me-2"></i>Transaksi
                    </a>
                    <a href="index.php?controller=keranjang&action=index" class="nav-link position-relative">
                        <i class="bi bi-cart3 me-2"></i>Keranjang
                        <?php if ($cartCount > 0): ?>
                            <span class="badge-cart" style="position: relative; top: -2px; left: 4px;"><?= $cartCount ?></span>
                        <?php endif; ?>
                    </a>
                    <div class="navbar-right d-flex flex-column gap-2">
                        <span style="font-size: 14px; color: #5a4a3a; padding: 8px 16px;">
                            <i class="bi bi-person-circle me-2"></i>
                            <?= htmlspecialchars($_SESSION['nama'] ?? 'Pembeli') ?>
                        </span>
                        <a href="index.php?controller=auth&action=logout" class="btn-logout" style="width: 100%; justify-content: center;">
                            <i class="bi bi-box-arrow-right me-1"></i>Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- ===== ALERT ===== -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-custom-success d-flex align-items-center gap-2 py-2 px-3">
            <i class="bi bi-check-circle-fill"></i>
            <?= htmlspecialchars($_SESSION['success']) ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- ===== DETAIL TRANSAKSI ===== -->
    <div class="detail-card">
        <!-- Header -->
        <div class="d-flex flex-wrap justify-content-between align-items-start mb-3">
            <div>
                <div class="card-title">
                    <i class="bi bi-receipt"></i> Detail Transaksi
                </div>
                <div class="card-subtitle">
                    #<?= str_pad($transaksi['id'], 6, '0', STR_PAD_LEFT) ?> • 
                    <?= date('d M Y, H:i', strtotime($transaksi['tanggal_transaksi'])) ?>
                </div>
            </div>
            <span class="status-badge status-<?= $transaksi['status'] ?>">
                <?= ucfirst($transaksi['status']) ?>
            </span>
        </div>

        <!-- Info Grid -->
        <div class="info-grid">
            <div class="info-item">
                <div class="label">Metode Pembayaran</div>
                <div class="value"><?= strtoupper(str_replace('_', ' ', $transaksi['metode_pembayaran'])) ?></div>
            </div>
            <div class="info-item">
                <div class="label">Alamat Pengiriman</div>
                <div class="value"><?= htmlspecialchars($transaksi['alamat_pengiriman']) ?></div>
            </div>
        </div>

        <!-- Table Detail -->
        <div class="table-responsive">
            <table class="table-transaksi">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th style="text-align: right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($details as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['nama_produk']) ?></td>
                            <td>Rp <?= number_format($item['harga_satuan'], 0, ',', '.') ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td style="text-align: right; font-weight: 500;">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Total -->
        <div class="total-row">
            <span class="total-label">Total</span>
            <span class="total-amount">Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></span>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="index.php?controller=transaksi&action=history" class="btn-secondary">
                <i class="bi bi-arrow-left"></i> Riwayat Transaksi
            </a>
            <a href="index.php?controller=produk&action=produk_list" class="btn-primary">
                <i class="bi bi-shop"></i> Lanjut Belanja
            </a>
        </div>
    </div>

    <!-- ===== FOOTER ===== -->
    <footer>
        <p class="mb-0">© <?= date('Y') ?> Toko Tas. Dibuat dengan <i class="bi bi-heart-fill" style="color: #d4a0a0;"></i></p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>