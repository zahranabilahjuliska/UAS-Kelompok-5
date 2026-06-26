<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Toko Tas</title>
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

        .cart-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f5ede7;
        }
        .cart-item:last-child {
            border-bottom: none;
        }
        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #f5ede7;
        }
        .cart-item .item-info {
            flex: 1;
            padding: 0 15px;
        }
        .cart-item .item-name {
            font-weight: 600;
            color: #2d2d2d;
            font-size: 16px;
        }
        .cart-item .item-price {
            color: #2d2d2d;
            font-weight: 700;
            font-size: 17px;
        }
        .cart-item .item-stock {
            font-size: 12px;
            color: #8a7a6a;
        }
        .cart-item .item-quantity {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .cart-item .item-quantity input {
            width: 60px;
            text-align: center;
            border-radius: 8px;
            border: 1.5px solid #e0dfd8;
            padding: 5px;
            font-size: 14px;
        }
        .cart-item .item-subtotal {
            min-width: 100px;
            text-align: right;
        }
        .cart-item .item-subtotal .label {
            font-size: 11px;
            color: #8a7a6a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .cart-item .item-subtotal .amount {
            font-weight: 700;
            color: #2d2d2d;
            font-size: 16px;
        }

        .btn-outline-dark {
            border-color: #2d2d2d;
            color: #2d2d2d;
            border-radius: 8px;
        }
        .btn-outline-dark:hover {
            background-color: #2d2d2d;
            color: white;
        }
        .btn-primary {
            background: #2d2d2d;
            border: none;
            border-radius: 10px;
            padding: 10px 24px;
            font-weight: 600;
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
            padding: 10px 24px;
            color: #5a4a3a;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-secondary:hover {
            background: #e5d5c8;
            color: #2d2d2d;
        }
        .btn-danger {
            background: #d4a0a0;
            border: none;
            border-radius: 8px;
            padding: 6px 12px;
        }
        .btn-danger:hover {
            background: #c48a8a;
        }

        .total-section {
            background: #f8f5f0;
            padding: 20px 25px;
            border-radius: 12px;
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        .total-section .total-label {
            font-size: 14px;
            color: #5a4a3a;
        }
        .total-section .total-amount {
            font-size: 28px;
            font-weight: 700;
            color: #2d2d2d;
        }
        .total-section .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

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
        .empty-state h5 {
            color: #2d2d2d;
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

        footer {
            text-align: center;
            padding: 30px 0 10px;
            color: #8a7a6a;
            font-size: 13px;
        }

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
            .cart-item {
                flex-wrap: wrap;
            }
            .cart-item .item-info {
                padding: 10px 0;
            }
            .cart-item .item-quantity {
                margin-top: 10px;
            }
            .cart-item .item-subtotal {
                min-width: auto;
                text-align: left;
                margin-top: 10px;
            }
            .total-section {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }
            .total-section .actions {
                justify-content: center;
            }
        }
        @media (max-width: 576px) {
            .cart-item img {
                width: 60px;
                height: 60px;
            }
            .cart-item .item-name {
                font-size: 14px;
            }
            .cart-item .item-price {
                font-size: 15px;
            }
            .total-section .total-amount {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid">

    <!-- ===== NAVBAR ===== -->
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
                    <a href="index.php?controller=keranjang&action=index" class="nav-link active position-relative">
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
                    <a href="index.php?controller=keranjang&action=index" class="nav-link active position-relative">
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

    <!-- ===== KERANJANG ===== -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="bi bi-cart3 me-2"></i>Keranjang Belanja
            </h4>
            <?php if (!empty($items)): ?>
                <span style="font-size: 14px; color: #8a7a6a;">
                    <?= count($items) ?> item
                </span>
            <?php endif; ?>
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

            <?php if (empty($items)): ?>
                <div class="empty-state">
                    <i class="bi bi-cart-x"></i>
                    <h5>Keranjang Kosong</h5>
                    <p class="text-muted">Yuk mulai belanja tas impianmu!</p>
                    <a href="index.php?controller=produk&action=produk_list" class="btn btn-primary mt-3">
                        <i class="bi bi-arrow-left me-1"></i>Lihat Produk
                    </a>
                </div>
            <?php else: ?>
                <!-- Daftar Item -->
                <?php foreach ($items as $item): ?>
                    <div class="cart-item">
                        <!-- Gambar -->
                        <div>
                            <?php 
                            $gambarPath = $_SERVER['DOCUMENT_ROOT'] . '/project/public/uploads/' . $item['gambar'];
                            if ($item['gambar'] && file_exists($gambarPath)): 
                            ?>
                                <img src="/project/public/uploads/<?= $item['gambar'] ?>" alt="<?= htmlspecialchars($item['nama_produk']) ?>">
                            <?php else: ?>
                                <div style="width: 80px; height: 80px; background: #f5ede7; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #b59676;">
                                    <i class="bi bi-image" style="font-size: 32px;"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Info -->
                        <div class="item-info">
                            <div class="item-name"><?= htmlspecialchars($item['nama_produk']) ?></div>
                            <div class="item-price">Rp <?= number_format($item['harga'], 0, ',', '.') ?></div>
                            <div class="item-stock">Stok: <?= $item['stok'] ?></div>
                        </div>

                        <!-- Quantity -->
                        <div class="item-quantity">
                            <form action="index.php?controller=keranjang&action=update" method="POST" class="d-flex align-items-center gap-2">
                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" max="<?= $item['stok'] ?>" class="form-control form-control-sm" style="width: 60px;">
                                <button type="submit" class="btn btn-outline-dark btn-sm">
                                    <i class="bi bi-arrow-repeat"></i>
                                </button>
                            </form>
                            <form action="index.php?controller=keranjang&action=remove" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus item ini dari keranjang?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Subtotal -->
                        <div class="item-subtotal">
                            <div class="label">Subtotal</div>
                            <div class="amount">Rp <?= number_format($item['harga'] * $item['quantity'], 0, ',', '.') ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Total -->
                <div class="total-section">
                    <div>
                        <div class="total-label">Total Belanja</div>
                        <div class="total-amount">Rp <?= number_format($total, 0, ',', '.') ?></div>
                    </div>
                    <div class="actions">
                        <a href="index.php?controller=produk&action=produk_list" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Lanjut Belanja
                        </a>
                        <a href="index.php?controller=transaksi&action=checkout" class="btn btn-primary">
                            <i class="bi bi-credit-card me-1"></i>Checkout
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ===== FOOTER ===== -->
    <footer>
        <p class="mb-0">© <?= date('Y') ?> Toko Tas.</p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>