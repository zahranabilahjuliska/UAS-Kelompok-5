<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Tas - Katalog</title>
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
        }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background: #ffffff;
            box-shadow: 0 2px 20px rgba(0,0,0,0.05);
            padding: 12px 0;
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

        /* Mobile Nav Links */
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

        /* ===== HERO SECTION ===== */
        .hero-section {
            background: linear-gradient(135deg, #f5ede7 0%, #faf5f0 100%);
            padding: 50px 0;
            margin-top: 20px;
            border-radius: 20px;
        }
        .hero-section h1 {
            font-weight: 700;
            font-size: 38px;
            color: #2d2d2d;
            letter-spacing: -1px;
        }
        .hero-section p {
            color: #7a6a5a;
            font-size: 17px;
            max-width: 500px;
        }
        .hero-section .btn-primary {
            background: #2d2d2d;
            border: none;
            border-radius: 12px;
            padding: 14px 36px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .hero-section .btn-primary:hover {
            background: #1a1a1a;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .hero-image {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .hero-image i {
            font-size: 100px;
            color: #c9a88a;
            opacity: 0.5;
        }

        /* ===== SEARCH ===== */
        .search-section {
            margin: 30px 0 20px;
        }
        .search-input {
            border: 2px solid #e8e0d8;
            border-radius: 12px;
            padding: 12px 20px;
            font-size: 14px;
            background: white;
            transition: all 0.3s;
            width: 100%;
            max-width: 400px;
        }
        .search-input:focus {
            border-color: #c9a88a;
            box-shadow: 0 0 0 4px rgba(201, 168, 138, 0.15);
            outline: none;
        }
        .search-btn {
            background: #2d2d2d;
            border: none;
            border-radius: 12px;
            padding: 0 24px;
            color: white;
            transition: all 0.3s;
        }
        .search-btn:hover {
            background: #1a1a1a;
        }
        .search-clear {
            background: #f0e3d8;
            border: none;
            border-radius: 12px;
            padding: 0 20px;
            color: #5a4a3a;
            transition: all 0.3s;
        }
        .search-clear:hover {
            background: #e5d5c8;
        }

        /* ===== CARD PRODUK ===== */
        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 2px 16px rgba(0,0,0,0.04);
            height: 100%;
        }
        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.08);
        }
        .product-card .card-img-wrapper {
            height: 220px;
            background: #f5ede7;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        .product-card .card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .product-card .card-img-wrapper .placeholder-img {
            font-size: 48px;
            color: #c9a88a;
            opacity: 0.4;
        }
        .product-card .card-body {
            padding: 20px 22px;
        }
        .product-card .product-category {
            font-size: 11px;
            font-weight: 600;
            color: #c9a88a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .product-card .product-name {
            font-weight: 600;
            font-size: 16px;
            color: #2d2d2d;
            margin: 6px 0 4px;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .product-card .product-desc {
            font-size: 13px;
            color: #8a7a6a;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 38px;
        }
        .product-card .product-price {
            font-weight: 700;
            font-size: 20px;
            color: #2d2d2d;
            margin: 10px 0 14px;
        }
        .product-card .btn-add-cart {
            background: #2d2d2d;
            border: none;
            border-radius: 10px;
            padding: 10px 16px;
            color: white;
            font-weight: 600;
            font-size: 13px;
            width: 100%;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .product-card .btn-add-cart:hover {
            background: #1a1a1a;
            transform: scale(1.02);
        }
        .product-card .btn-add-cart:disabled {
            background: #d0c8c0;
            cursor: not-allowed;
            transform: none;
        }
        .product-card .badge-stock {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255,255,255,0.95);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            color: #4a8a5a;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        .product-card .badge-stock.empty {
            color: #d4a0a0;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #b59676;
        }
        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            display: block;
            opacity: 0.5;
        }

        /* ===== FOOTER ===== */
        .footer {
            background: white;
            padding: 30px 0;
            margin-top: 40px;
            border-radius: 16px;
            text-align: center;
            color: #8a7a6a;
            font-size: 14px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 26px;
            }
            .hero-section {
                padding: 30px 0;
            }
            .hero-image i {
                font-size: 60px;
            }
            .search-input {
                max-width: 100%;
            }
            .product-card .card-img-wrapper {
                height: 180px;
            }
            .product-card .product-price {
                font-size: 17px;
            }
        }
        @media (max-width: 576px) {
            .hero-section h1 {
                font-size: 22px;
            }
            .hero-section .btn-primary {
                padding: 10px 24px;
                font-size: 14px;
            }
            .product-card .card-img-wrapper {
                height: 150px;
            }
            .product-card .card-body {
                padding: 14px 16px;
            }
            .product-card .product-name {
                font-size: 14px;
            }
            .product-card .product-price {
                font-size: 15px;
                margin: 6px 0 10px;
            }
            .product-card .btn-add-cart {
                font-size: 12px;
                padding: 8px 12px;
            }
        }
    </style>
</head>
<body>

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
                <a href="index.php?controller=produk&action=produk_list" class="nav-link active">
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
                <a href="index.php?controller=produk&action=produk_list" class="nav-link active">
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

<!-- ===== HERO SECTION ===== -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1>Koleksi Tas <br>Elegan & Modern</h1>
                <p class="mb-4">Temukan tas impianmu dengan kualitas terbaik. Dari casual hingga formal, kami punya semuanya.</p>
                <a href="#products" class="btn btn-primary">
                    <i class="bi bi-arrow-right me-2"></i>Belanja Sekarang
                </a>
            </div>
            <div class="col-lg-5 hero-image">
                <i class="bi bi-bag-heart-fill"></i>
            </div>
        </div>
    </div>
</section>

<!-- ===== SEARCH ===== -->
<section class="search-section">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center gap-3">
            <form action="index.php?controller=produk&action=search" method="GET" class="d-flex gap-2 flex-grow-1" style="max-width: 500px;">
                <input type="hidden" name="controller" value="produk">
                <input type="hidden" name="action" value="search">
                <input type="text" name="keyword" class="search-input" placeholder="Cari tas favoritmu..." 
                       value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
                <button type="submit" class="search-btn">
                    <i class="bi bi-search"></i>
                </button>
                <?php if (isset($searchKeyword)): ?>
                    <a href="index.php?controller=produk&action=produk_list" class="search-clear">
                        <i class="bi bi-x"></i>
                    </a>
                <?php endif; ?>
            </form>
        </div>
    </div>
</section>

<!-- ===== GRID PRODUK ===== -->
<section id="products" class="mb-4">
    <div class="container">
        <?php if (isset($searchKeyword)): ?>
            <p style="color: #5a4a3a; margin-bottom: 20px;">
                Hasil pencarian: <strong>"<?= htmlspecialchars($searchKeyword) ?>"</strong>
            </p>
        <?php endif; ?>

        <?php if (empty($produk)): ?>
            <div class="empty-state">
                <i class="bi bi-box-seam"></i>
                <h5>Tidak ada produk</h5>
                <p class="text-muted">Belum ada produk yang tersedia saat ini.</p>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($produk as $p): ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="product-card">
                            <div class="card-img-wrapper">
                                <?php 
                                $gambarPath = $_SERVER['DOCUMENT_ROOT'] . '/project/public/uploads/' . $p['gambar'];
                                if ($p['gambar'] && file_exists($gambarPath)): 
                                ?>
                                    <img src="/project/public/uploads/<?= $p['gambar'] ?>" alt="<?= htmlspecialchars($p['nama_produk']) ?>">
                                <?php else: ?>
                                    <i class="bi bi-image placeholder-img"></i>
                                <?php endif; ?>
                                <?php if ($p['stok'] > 0): ?>
                                    <span class="badge-stock">✓ Tersedia</span>
                                <?php else: ?>
                                    <span class="badge-stock empty">✕ Habis</span>
                                <?php endif; ?>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="product-category"><?= htmlspecialchars($p['nama_kategori'] ?? 'Umum') ?></div>
                                <h5 class="product-name"><?= htmlspecialchars($p['nama_produk']) ?></h5>
                                <p class="product-desc"><?= htmlspecialchars(substr($p['deskripsi'] ?? '', 0, 60)) ?>...</p>
                                <div class="product-price">Rp <?= number_format($p['harga'], 0, ',', '.') ?></div>
                                <?php if ($p['stok'] > 0): ?>
                                    <button class="btn-add-cart" onclick="addToCart(<?= $p['id'] ?>)">
                                        <i class="bi bi-cart-plus"></i> Tambahkan ke Keranjang
                                    </button>
                                <?php else: ?>
                                    <button class="btn-add-cart" disabled>
                                        <i class="bi bi-x-circle"></i> Stok Habis
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="footer">
    <div class="container">
        <p class="mb-0">© <?= date('Y') ?> Toko Tas</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function addToCart(produkId) {
        var formData = new FormData();
        formData.append('produk_id', produkId);
        formData.append('quantity', 1);
        
        fetch('index.php?controller=keranjang&action=add', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            window.location.href = 'index.php?controller=keranjang&action=index';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan. Silakan coba lagi.');
        });
    }
</script>
</body>
</html>