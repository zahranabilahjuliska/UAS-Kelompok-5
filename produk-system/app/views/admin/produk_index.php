<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - Admin</title>
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
        /* ===== NAVIGASI ADMIN ===== */
        .admin-nav {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }
        .admin-nav .nav-link-custom {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 10px;
            text-decoration: none;
            color: #5a4a3a;
            font-size: 14px;
            transition: all 0.2s;
            background: transparent;
            border: 1.5px solid transparent;
        }
        .admin-nav .nav-link-custom:hover {
            background: #f5ede7;
        }
        .admin-nav .nav-link-custom.active {
            background: #3d3d3a;
            color: white;
            border-color: #3d3d3a;
        }
        .admin-nav .nav-link-custom i {
            font-size: 16px;
        }
        .admin-nav .nav-link-custom .badge-nav {
            background: #d4a0a0;
            color: white;
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 12px;
        }
        .admin-nav .nav-link-custom.active .badge-nav {
            background: rgba(255,255,255,0.3);
        }
        .admin-user {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-left: auto;
        }
        .admin-user .user-name {
            font-size: 14px;
            color: #5a4a3a;
        }
        .admin-user .user-name i {
            margin-right: 4px;
        }
        .btn-logout {
            background-color: #d4a0a0;
            border: none;
            border-radius: 10px;
            padding: 8px 18px;
            color: white;
            transition: background-color 0.2s;
            font-size: 13px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-logout:hover {
            background-color: #c48a8a;
            color: white;
        }
        /* ===== END NAVIGASI ===== */
        .btn-primary {
            background-color: #3d3d3a;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            transition: background-color 0.2s;
        }
        .btn-primary:hover {
            background-color: #2c2c2a;
        }
        .btn-warning {
            background-color: #e8d5a0;
            border: none;
            border-radius: 8px;
            color: #5a4a3a;
        }
        .btn-warning:hover {
            background-color: #dec98a;
        }
        .btn-danger {
            background-color: #d4a0a0;
            border: none;
            border-radius: 8px;
        }
        .btn-danger:hover {
            background-color: #c48a8a;
        }
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
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #f0e3d8;
        }
        .badge-category {
            background: #f0e3d8;
            color: #7a5e4a;
            padding: 5px 12px;
            border-radius: 12px;
            font-size: 12px;
        }
        .alert-success {
            background: #e8f5e8;
            color: #4a7a5a;
            border: 1px solid #c4e0c4;
            border-radius: 10px;
        }
        .alert-danger {
            background: #f5e8e8;
            color: #7a4a4a;
            border: 1px solid #e0c4c4;
            border-radius: 10px;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #b59676;
        }
        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            display: block;
        }
        @media (max-width: 768px) {
            .admin-nav {
                flex-direction: column;
                align-items: stretch;
                width: 100%;
                margin-bottom: 10px;
            }
            .admin-user {
                margin-left: 0;
                justify-content: space-between;
                width: 100%;
            }
            .card-header {
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <!-- Header dengan Navigasi -->
        <div class="card-header">
            <div class="d-flex flex-wrap align-items-center gap-3">
                <!-- Logo / Title -->
                <h4 class="mb-0">
                    <i class="bi bi-box-seam me-2"></i>Daftar Produk
                </h4>

                <!-- Navigasi Menu -->
                <nav class="admin-nav">
                    <a href="index.php?controller=produk&action=index" class="nav-link-custom active">
                        <i class="bi bi-box-seam"></i> Produk
                    </a>
                    <a href="index.php?controller=transaksi&action=adminIndex" class="nav-link-custom">
                        <i class="bi bi-receipt"></i> Transaksi
                        <?php
                        // Hitung transaksi pending
                         require_once '../app/models/TransaksiModel.php';
                         $transModel = new TransaksiModel();
                         $pendingCount = $transModel->countByStatus('pending');
                        ?>
                        <?php if ($pendingCount > 0): ?>
                            <span class="badge-nav"><?= $pendingCount ?></span>
                        <?php endif; ?>
                    </a>
                </nav>

                <!-- User & Logout -->
                <div class="admin-user">
                    <span class="user-name">
                        <i class="bi bi-person-circle"></i>
                        <?= htmlspecialchars($_SESSION['nama'] ?? 'Admin') ?>
                    </span>
                    <a href="index.php?controller=auth&action=logout" class="btn-logout">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="card-body p-4">
            <!-- Alert -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success d-flex align-items-center gap-2 py-2 px-3 mb-3">
                    <i class="bi bi-check-circle-fill"></i>
                    <?= htmlspecialchars($_SESSION['success']) ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger d-flex align-items-center gap-2 py-2 px-3 mb-3">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <?= htmlspecialchars($_SESSION['error']) ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <!-- Tombol Tambah -->
            <div class="mb-3">
                <a href="index.php?controller=produk&action=create" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Tambah Produk
                </a>
            </div>

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($produk)): ?>
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <h5>Belum ada produk</h5>
                                        <p class="text-muted">Yuk tambahkan produk pertama Anda!</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($produk as $p): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <?php if ($p['gambar']): ?>
                                        <img src="uploads/<?= $p['gambar'] ?>" alt="<?= $p['nama_produk'] ?>" class="product-img">
                                    <?php else: ?>
                                        <span class="text-muted" style="font-size: 12px;">No Image</span>
                                    <?php endif; ?>
                                </td>
                                <td><strong><?= htmlspecialchars($p['nama_produk']) ?></strong></td>
                                <td><span class="badge-category"><?= htmlspecialchars($p['nama_kategori'] ?? 'Tanpa Kategori') ?></span></td>
                                <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                                <td><?= $p['stok'] ?></td>
                                <td>
                                    <a href="index.php?controller=produk&action=edit&id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="index.php?controller=produk&action=delete&id=<?= $p['id'] ?>" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Yakin hapus produk ini?')">
                                        <i class="bi bi-trash"></i>
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