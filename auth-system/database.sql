-- =============================================
-- DATABASE E-COMMERCE TAS
-- =============================================

-- 1. Buat database jika belum ada
CREATE DATABASE IF NOT EXISTS ecommerce_tas;
USE ecommerce_tas;

-- =============================================
-- 2. Tabel users (admin & pembeli)
-- =============================================
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    alamat TEXT,
    no_telepon VARCHAR(20),
    role ENUM('admin', 'pembeli') DEFAULT 'pembeli',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- 3. Tabel kategori
-- =============================================
CREATE TABLE IF NOT EXISTS kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(50) UNIQUE NOT NULL,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_nama_kategori (nama_kategori)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- 4. Tabel produk (CRUD utama)
-- =============================================
CREATE TABLE IF NOT EXISTS produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kategori_id INT,
    nama_produk VARCHAR(200) NOT NULL,
    harga DECIMAL(12,2) NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    deskripsi TEXT,
    gambar VARCHAR(255),
    status ENUM('aktif', 'nonaktif') DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id) ON DELETE SET NULL,
    INDEX idx_kategori (kategori_id),
    INDEX idx_status (status),
    INDEX idx_harga (harga),
    FULLTEXT idx_nama_produk (nama_produk)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- 5. Tabel keranjang
-- =============================================
CREATE TABLE IF NOT EXISTS keranjang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    produk_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    tanggal_ditambahkan TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (produk_id) REFERENCES produk(id) ON DELETE CASCADE,
    UNIQUE KEY unique_cart_item (user_id, produk_id),
    INDEX idx_user (user_id),
    INDEX idx_produk (produk_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- 6. Tabel transaksi
-- =============================================
CREATE TABLE IF NOT EXISTS transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_harga DECIMAL(12,2) NOT NULL,
    status ENUM('pending', 'diproses', 'dikirim', 'selesai', 'batal') DEFAULT 'pending',
    alamat_pengiriman TEXT NOT NULL,
    metode_pembayaran VARCHAR(50),
    tanggal_transaksi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user (user_id),
    INDEX idx_status (status),
    INDEX idx_tanggal (tanggal_transaksi)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- 7. Tabel detail transaksi
-- =============================================
CREATE TABLE IF NOT EXISTS detail_transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaksi_id INT NOT NULL,
    produk_id INT NOT NULL,
    quantity INT NOT NULL,
    harga_satuan DECIMAL(12,2) NOT NULL,
    subtotal DECIMAL(12,2) NOT NULL,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE,
    FOREIGN KEY (produk_id) REFERENCES produk(id) ON DELETE CASCADE,
    INDEX idx_transaksi (transaksi_id),
    INDEX idx_produk (produk_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- 8. Data dummy untuk testing (opsional)
-- =============================================

-- Insert admin default
INSERT INTO users (nama, email, password, role) VALUES 
('Admin', 'admin@ecommerce.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');
-- Password: password

-- Insert beberapa kategori
INSERT INTO kategori (nama_kategori, deskripsi) VALUES 
('Ransel', 'Tas punggung untuk berbagai keperluan'),
('Selempang', 'Tas selempang casual dan stylish'),
('Tote Bag', 'Tas belanja yang praktis dan fashionable'),
('Tas Sekolah', 'Tas untuk keperluan sekolah dan kuliah'),
('Tas Travel', 'Tas untuk perjalanan dan wisata');

-- Insert beberapa produk contoh
INSERT INTO produk (kategori_id, nama_produk, harga, stok, deskripsi, status) VALUES 
(1, 'Ransel Urban Classic', 450000, 25, 'Ransel dengan desain minimalis, cocok untuk aktivitas sehari-hari', 'aktif'),
(2, 'Selempang Leather', 350000, 15, 'Tas selempang berbahan kulit sintetis premium', 'aktif'),
(3, 'Tote Bag Canvas', 250000, 30, 'Tote bag berbahan kanvas tebal dengan desain modern', 'aktif'),
(1, 'Ransel Adventure', 550000, 10, 'Ransel besar untuk petualangan dan traveling', 'aktif'),
(4, 'Tas Sekolah Anime', 300000, 20, 'Tas sekolah dengan desain karakter anime populer', 'nonaktif');

-- Insert data pembeli contoh
INSERT INTO users (nama, email, password, role, alamat, no_telepon) VALUES 
('Budi Santoso', 'budi@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pembeli', 'Jl. Merdeka No. 123, Jakarta', '08123456789'),
('Siti Rahayu', 'siti@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pembeli', 'Jl. Sudirman No. 456, Bandung', '08987654321');