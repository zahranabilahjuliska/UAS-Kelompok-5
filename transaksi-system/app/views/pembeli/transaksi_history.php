<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - Toko Tas</title>
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

        /* ===== HILANGKAN PADDING CONTAINER ===== */
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
        .card {
            border: none;
            border-radius: 16px !important;
            box-shadow: 0 2px 16px rgba(0,0,0,0.04);
            background: #ffffff;
            margin: 0 20px;
        }
        .card-header {
            background: #ffffff;
            border-bottom: 2px solid #f5ede7;
            padding: 20px 25px;
            border-radius: 16px 16px 0 0 !important;
        }
        .card-header h4 {
            color: #2d2d2d;
            font-weight: 700;
            font-size: 20px;
        }
        .card-body {
            padding: 25px;
        }

        /* ===== TABLE ===== */
        .table {
            color: #5a4a3a;
            font-size: 14px;
        }
        .table thead th {
            background: #f8f5f0;
            color: #2d2d2d;
            border-bottom: 2px solid #f0e8e0;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            padding: 14px 16px;
        }
        .table tbody td {
            padding: 14px 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f5ede7;
        }
        .table tbody tr:hover {
            background: #faf8f5;
        }
        .table tbody tr:last-child td {
            border-bottom: none;
        }

        /* ===== STATUS BADGE ===== */
        .status-badge {
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 12px;
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

        /* ===== BUTTONS ===== */
        .btn-primary {
            background: #2d2d2d;
            border: none;
            border-radius: 10px;
            padding: 8px 18px;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background: #1a1a1a;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }
        .btn-secondary {
            background: #f0e3d8;
            border: none;
            border-radius: 10px;
            padding: 8px 18px;
            color: #5a4a3a;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s;
        }
        .btn-secondary:hover {
            background: #e5d5c8;
            color: #2d2d2d;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #b59676;
        }
        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            display: block;
            opacity: 0.5;
        }

        /* ===== FOOTER ===== */
        footer {
            text-align: center;
            padding: 30px 0 10px;
            color: #8a7a6a;
            font-size: 13px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .card {
                margin: 0 10px;
            }
            .card-header {
                padding: 16px 20px;
            }
            .card-header h4 {
                font-size: 17px;
            }
            .card-body {
                padding: 16px;
            }
            .table {
                font-size: 13px;
            }
            .table thead th,
            .table tbody td {
                padding: 10px 12px;
            }
            .table thead th {
                font-size: 11px;
            }
            .status-badge {
                font-size: 11px;
                padding: 3px 10px;
            }
            .btn-primary, .btn-secondary {
                font-size: 12px;
                padding: 6px 14px;
            }
        }
        @media (max-width: 576px) {
            .table thead th:nth-child(2),
            .table tbody td:nth-child(2) {
                display: none;
            }
        }
    </style>
</head>
<body>

<!-- ===== CONTAINER TANPA PADDING ===== -->
<div class="container-fluid">

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar-custom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <!-- Brand & Toggler -->
            <div class="d-flex align-items-center gap-3">
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                    <i class="bi bi-list"></i>
                </button>
                <a href="index.php?controller=produk&action=produk_list" class="brand">
                    <i class="bi bi-bag-heart-fill me-2"></i>Toko Tas
                </a>
            </div>

            <!-- Nav Links (Desktop) -->
            <div class="d-none d-lg-flex align-items-center gap-1">
                <a href="index.php?controller=produk&action=produk_list" class="nav-link">
                    <i class="bi bi-grid-3x3-gap-fill me-1"></i>Katalog
                </a>
                <a href="index.php?controller=transaksi&action=history" class="nav-link active">
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

            <!-- Right (Desktop) -->
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

        <!-- ===== COLLAPSE MENU (MOBILE) ===== -->
        <div class="collapse" id="navbarMenu">
            <div class="d-flex flex-column">
                <a href="index.php?controller=produk&action=produk_list" class="nav-link">
                    <i class="bi bi-grid-3x3-gap-fill me-2"></i>Katalog
                </a>
                <a href="index.php?controller=transaksi&action=history" class="nav-link active">
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

    <!-- ===== RIWAYAT TRANSAKSI ===== -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="bi bi-clock-history me-2"></i>Riwayat Transaksi
            </h4>
        </div>
        <div class="card-body">
            <!-- Alert -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success d-flex align-items-center gap-2 py-2 px-3 mb-3" style="background: #e8f5e8; border: 1px solid #c4e0c4; color: #4a7a5a; border-radius: 10px;">
                    <i class="bi bi-check-circle-fill"></i>
                    <?= htmlspecialchars($_SESSION['success']) ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger d-flex align-items-center gap-2 py-2 px-3 mb-3" style="background: #f5e8e8; border: 1px solid #e0c4c4; color: #7a4a4a; border-radius: 10px;">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <?= htmlspecialchars($_SESSION['error']) ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php if (empty($transaksi)): ?>
                <div class="empty-state">
                    <i class="bi bi-receipt"></i>
                    <h5>Belum Ada Transaksi</h5>
                    <p class="text-muted">Anda belum melakukan pembelian apapun.</p>
                    <a href="index.php?controller=produk&action=produk_list" class="btn btn-primary mt-3">
                        <i class="bi bi-shop me-1"></i>Mulai Belanja
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Metode</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transaksi as $t): ?>
                            <tr>
                                <td><strong>#<?= str_pad($t['id'], 6, '0', STR_PAD_LEFT) ?></strong></td>
                                <td><?= date('d M Y H:i', strtotime($t['tanggal_transaksi'])) ?></td>
                                <td><strong>Rp <?= number_format($t['total_harga'], 0, ',', '.') ?></strong></td>
                                <td><?= strtoupper(str_replace('_', ' ', $t['metode_pembayaran'] ?? '-')) ?></td>
                                <td>
                                    <span class="status-badge status-<?= $t['status'] ?>">
                                        <?= ucfirst($t['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="index.php?controller=transaksi&action=detail&id=<?= $t['id'] ?>" class="btn btn-primary btn-sm">
                                        <i class="bi bi-eye me-1"></i>Detail
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ===== FOOTER ===== -->
    <footer>
        <p class="mb-0">© <?= date('Y') ?> Toko Tas</p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>