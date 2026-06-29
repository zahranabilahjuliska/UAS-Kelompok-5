<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Toko Tas</title>
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

        /* ===== CHECKOUT CONTENT ===== */
        .checkout-wrapper {
            padding: 0 20px;
        }

        .checkout-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.04);
            padding: 30px;
            margin-bottom: 24px;
        }

        .checkout-card .card-title {
            font-weight: 600;
            font-size: 18px;
            color: #2d2d2d;
            margin-bottom: 20px;
        }
        .checkout-card .card-title i {
            color: #c9a88a;
            margin-right: 10px;
        }

        .form-label {
            font-weight: 500;
            font-size: 13px;
            color: #5a4a3a;
            margin-bottom: 4px;
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px 16px;
            border: 1.5px solid #e8e0d8;
            font-size: 14px;
            background: #fdfaf7;
            transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #2d2d2d;
            box-shadow: 0 0 0 3px rgba(45,45,45,0.08);
            background: #ffffff;
        }
        .form-control::placeholder {
            color: #b0a8a0;
        }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            border: 2px solid #e8e0d8;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 10px;
        }
        .payment-option:hover {
            border-color: #c9a88a;
        }
        .payment-option.selected {
            border-color: #2d2d2d;
            background: #f8f5f0;
        }
        .payment-option input[type="radio"] {
            accent-color: #2d2d2d;
            width: 18px;
            height: 18px;
            margin: 0;
            flex-shrink: 0;
        }
        .payment-option .option-label {
            font-weight: 500;
            font-size: 14px;
            color: #2d2d2d;
        }
        .payment-option .option-desc {
            font-size: 12px;
            color: #8a7a6a;
            margin: 0;
        }

        /* ===== ORDER SUMMARY ===== */
        .order-summary {
            background: #f8f5f0;
            border-radius: 12px;
            padding: 20px;
        }
        .order-summary .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e8e0d8;
            font-size: 14px;
            color: #5a4a3a;
        }
        .order-summary .summary-item:last-child {
            border-bottom: none;
        }
        .order-summary .summary-item .label {
            color: #8a7a6a;
        }
        .order-summary .summary-item .value {
            font-weight: 500;
            color: #2d2d2d;
        }
        .order-summary .summary-total {
            display: flex;
            justify-content: space-between;
            padding-top: 12px;
            margin-top: 8px;
            border-top: 2px solid #d0c8c0;
            font-size: 18px;
            font-weight: 700;
            color: #2d2d2d;
        }

        .product-item {
            display: flex;
            gap: 14px;
            padding: 12px 0;
            border-bottom: 1px solid #f0e8e0;
        }
        .product-item:last-child {
            border-bottom: none;
        }
        .product-item .product-img {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            background: #f5ede7;
            object-fit: cover;
            flex-shrink: 0;
        }
        .product-item .product-info {
            flex: 1;
        }
        .product-item .product-name {
            font-weight: 600;
            font-size: 14px;
            color: #2d2d2d;
        }
        .product-item .product-meta {
            font-size: 13px;
            color: #8a7a6a;
        }
        .product-item .product-price {
            font-weight: 600;
            color: #2d2d2d;
        }

        .btn-place-order {
            background: #2d2d2d;
            border: none;
            border-radius: 12px;
            padding: 14px 30px;
            color: white;
            font-weight: 600;
            font-size: 16px;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-place-order:hover {
            background: #1a1a1a;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .btn-place-order i {
            margin-right: 8px;
        }

        .btn-back {
            background: transparent;
            border: none;
            color: #5a4a3a;
            font-weight: 500;
            font-size: 14px;
            padding: 10px 0;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s;
        }
        .btn-back:hover {
            color: #2d2d2d;
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
            .checkout-wrapper {
                padding: 0 10px;
            }
            .checkout-card {
                padding: 20px;
            }
            .payment-option {
                padding: 12px 14px;
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

    <!-- ===== CHECKOUT CONTENT ===== -->
    <div class="checkout-wrapper">
        <div class="row g-4">
            <!-- Left Column: Shipping & Payment -->
            <div class="col-lg-8">
                <form action="index.php?controller=transaksi&action=process" method="POST">

                    <!-- Shipping Address -->
                    <div class="checkout-card">
                        <div class="card-title">
                            <i class="bi bi-geo-alt"></i> Alamat Pengiriman
                        </div>

                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-custom-danger d-flex align-items-center gap-2 mb-3">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                <?= htmlspecialchars($_SESSION['error']) ?>
                            </div>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>

                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" value="<?= htmlspecialchars($_POST['nama'] ?? $_SESSION['nama'] ?? '') ?>" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea name="alamat" class="form-control" placeholder="Jalan, Nomor, RT/RW, Kelurahan, Kecamatan" required><?= htmlspecialchars($_POST['alamat'] ?? '') ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kota / Kabupaten</label>
                                <input type="text" name="kota" class="form-control" placeholder="Kota" value="<?= htmlspecialchars($_POST['kota'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kode Pos</label>
                                <input type="text" name="zip" class="form-control" placeholder="Kode pos" value="<?= htmlspecialchars($_POST['zip'] ?? '') ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="checkout-card">
                        <div class="card-title">
                            <i class="bi bi-credit-card"></i> Metode Pembayaran
                        </div>

                        <div class="payment-option" onclick="selectPayment(this)">
                            <input type="radio" name="metode_pembayaran" value="transfer_bank" required>
                            <div>
                                <div class="option-label">Transfer Bank</div>
                                <p class="option-desc">BCA, Mandiri, BNI, BRI</p>
                            </div>
                        </div>

                        <div class="payment-option" onclick="selectPayment(this)">
                            <input type="radio" name="metode_pembayaran" value="e_wallet">
                            <div>
                                <div class="option-label">E-Wallet</div>
                                <p class="option-desc">OVO, GoPay, DANA, LinkAja</p>
                            </div>
                        </div>

                        <div class="payment-option" onclick="selectPayment(this)">
                            <input type="radio" name="metode_pembayaran" value="cod">
                            <div>
                                <div class="option-label">COD (Cash on Delivery)</div>
                                <p class="option-desc">Bayar saat barang diterima</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex flex-wrap gap-3 mt-3" style="padding: 0 4px;">
                        <button type="submit" class="btn-place-order">
                            <i class="bi bi-check-circle"></i> Konfirmasi Pesanan
                        </button>
                        <a href="index.php?controller=keranjang&action=index" class="btn-back">
                            <i class="bi bi-arrow-left"></i> Kembali ke Keranjang
                        </a>
                    </div>
                </form>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="col-lg-4">
                <div class="checkout-card">
                    <div class="card-title">
                        <i class="bi bi-receipt"></i> Ringkasan Pesanan
                    </div>

                    <!-- Products -->
                    <?php foreach ($items as $item): ?>
                        <div class="product-item">
                            <?php 
                            $gambarPath = $_SERVER['DOCUMENT_ROOT'] . '/project/public/uploads/' . $item['gambar'];
                            if ($item['gambar'] && file_exists($gambarPath)): 
                            ?>
                                <img src="/project/public/uploads/<?= $item['gambar'] ?>" alt="<?= htmlspecialchars($item['nama_produk']) ?>" class="product-img">
                            <?php else: ?>
                                <div class="product-img d-flex align-items-center justify-content-center" style="background: #f5ede7; color: #b59676;">
                                    <i class="bi bi-image" style="font-size: 24px;"></i>
                                </div>
                            <?php endif; ?>
                            <div class="product-info">
                                <div class="product-name"><?= htmlspecialchars($item['nama_produk']) ?></div>
                                <div class="product-meta"><?= $item['quantity'] ?> × Rp <?= number_format($item['harga'], 0, ',', '.') ?></div>
                            </div>
                            <div class="product-price">Rp <?= number_format($item['harga'] * $item['quantity'], 0, ',', '.') ?></div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Summary -->
                    <div class="order-summary mt-3">
                        <div class="summary-item">
                            <span class="label">Subtotal</span>
                            <span class="value">Rp <?= number_format($total, 0, ',', '.') ?></span>
                        </div>
                        <div class="summary-item">
                            <span class="label">Ongkos Kirim</span>
                            <span class="value">Rp 0</span>
                        </div>
                        <div class="summary-item" style="border-bottom: none;">
                            <span class="label">Pajak</span>
                            <span class="value">Rp 0</span>
                        </div>
                        <div class="summary-total">
                            <span>Total</span>
                            <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== FOOTER ===== -->
    <footer>
        <p class="mb-0">© <?= date('Y') ?> Toko Tas. Dibuat dengan <i class="bi bi-heart-fill" style="color: #d4a0a0;"></i></p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function selectPayment(element) {
        document.querySelectorAll('.payment-option').forEach(el => {
            el.classList.remove('selected');
        });
        element.classList.add('selected');
        const radio = element.querySelector('input[type="radio"]');
        if (radio) {
            radio.checked = true;
        }
    }
</script>
</body>
</html>