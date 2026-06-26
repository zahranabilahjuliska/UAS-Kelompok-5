<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Admin</title>
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
            max-width: 800px;
            margin: 0 auto;
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
            padding: 30px;
        }
        .form-label {
            color: #5a4a3a;
            font-weight: 500;
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 11px 14px;
            border: 1.5px solid #e0dfd8;
            font-size: 14px;
            background: #fdfaf7;
        }
        .form-control:focus, .form-select:focus {
            border-color: #3d3d3a;
            box-shadow: 0 0 0 3px rgba(61,61,58,0.1);
            background: #fff;
        }
        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }
        .btn-primary {
            background-color: #3d3d3a;
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            transition: background-color 0.2s;
        }
        .btn-primary:hover {
            background-color: #2c2c2a;
        }
        .btn-secondary {
            background-color: #f0e3d8;
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            color: #5a4a3a;
            transition: background-color 0.2s;
        }
        .btn-secondary:hover {
            background-color: #e5d5c8;
        }
        .file-upload-wrapper {
            position: relative;
            padding: 30px;
            border: 2px dashed #e0dfd8;
            border-radius: 10px;
            text-align: center;
            background: #fdfaf7;
            cursor: pointer;
            transition: all 0.3s;
        }
        .file-upload-wrapper:hover {
            border-color: #3d3d3a;
            background: #f5f0eb;
        }
        .file-upload-wrapper input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        .file-upload-wrapper p {
            color: #b59676;
            font-size: 14px;
            margin: 0;
        }
        .file-upload-wrapper i {
            font-size: 32px;
            color: #b59676;
            display: block;
            margin-bottom: 10px;
        }
        .current-image {
            margin: 15px 0;
            padding: 15px;
            background: #f5ede7;
            border-radius: 10px;
            text-align: center;
        }
        .current-image img {
            max-width: 150px;
            max-height: 150px;
            border-radius: 8px;
            border: 2px solid #e0dfd8;
        }
        .current-image .image-label {
            display: block;
            font-size: 12px;
            color: #b59676;
            margin-bottom: 8px;
        }
        .alert-custom {
            border-radius: 10px;
            padding: 12px 18px;
        }
        .alert-custom-danger {
            background: #f5e8e8;
            border: 1px solid #e0c4c4;
            color: #7a4a4a;
        }
        .alert-custom-success {
            background: #e8f5e8;
            border: 1px solid #c4e0c4;
            color: #4a7a5a;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="bi bi-pencil-square me-2"></i>Edit Produk
            </h4>
            <a href="index.php?controller=produk&action=index" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i>Kembali
            </a>
        </div>

        <!-- Body -->
        <div class="card-body">
            <!-- Alert -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-custom alert-custom-danger d-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <?= htmlspecialchars($_SESSION['error']) ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <!-- Form -->
            <form action="index.php?controller=produk&action=update&id=<?= $produk['id'] ?>" method="POST" enctype="multipart/form-data">
                
                <!-- Nama Produk -->
                <div class="mb-3">
                    <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                    <input type="text" name="nama_produk" class="form-control" value="<?= htmlspecialchars($produk['nama_produk']) ?>" required>
                </div>

                <!-- Kategori -->
                <div class="mb-3">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori_id" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($kategori as $k): ?>
                            <option value="<?= $k['id'] ?>" <?= $k['id'] == $produk['kategori_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($k['nama_kategori']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Harga & Stok -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                        <input type="number" name="harga" class="form-control" value="<?= $produk['harga'] ?>" min="0" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok <span class="text-danger">*</span></label>
                        <input type="number" name="stok" class="form-control" value="<?= $produk['stok'] ?>" min="0" required>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control"><?= htmlspecialchars($produk['deskripsi'] ?? '') ?></textarea>
                </div>

                <!-- Gambar Saat Ini -->
<div class="mb-3">
    <label class="form-label">Gambar Saat Ini</label>
    <div class="current-image">
        <?php 
        $gambarPath = $_SERVER['DOCUMENT_ROOT'] . '/project/public/uploads/' . $produk['gambar'];
        if ($produk['gambar'] && file_exists($gambarPath)): 
        ?>
            <span class="image-label">Gambar saat ini</span>
            <img src="uploads/<?= $produk['gambar'] ?>" alt="<?= htmlspecialchars($produk['nama_produk']) ?>" style="max-width: 150px; max-height: 150px; border-radius: 8px; border: 2px solid #e0dfd8;">
            <br>
            <small class="text-muted">File: <?= $produk['gambar'] ?></small>
        <?php else: ?>
            <span class="image-label">Belum ada gambar</span>
            <i class="bi bi-image" style="font-size: 48px; color: #b59676;"></i>
        <?php endif; ?>
    </div>
</div>

                <!-- Upload Gambar Baru -->
                <div class="mb-4">
                    <label class="form-label">Ganti Gambar (Opsional)</label>
                    <div class="file-upload-wrapper">
                        <i class="bi bi-cloud-upload"></i>
                        <p>Klik untuk upload gambar baru (max 2MB)</p>
                        <input type="file" name="gambar" accept="image/*">
                    </div>
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar. Gambar lama akan otomatis terhapus.</small>
                </div>

                <!-- Tombol -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>Update Produk
                    </button>
                    <a href="index.php?controller=produk&action=index" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Tampilkan nama file yang dipilih
    document.querySelector('input[type="file"]').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || 'Tidak ada file dipilih';
        const wrapper = e.target.parentElement;
        const p = wrapper.querySelector('p');
        p.textContent = fileName;
        p.style.color = '#3d3d3a';
    });
</script>
</body>
</html>