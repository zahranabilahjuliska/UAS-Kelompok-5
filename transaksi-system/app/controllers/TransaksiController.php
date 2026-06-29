<?php
// app/controllers/TransaksiController.php

require_once __DIR__ . '/../models/TransaksiModel.php';
require_once __DIR__ . '/../models/KeranjangModel.php';
require_once __DIR__ . '/../models/ProdukModel.php';

class TransaksiController {
    private $transaksiModel;
    private $keranjangModel;
    private $produkModel;

    public function __construct() {
        // Start session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Cek login
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Silakan login terlebih dahulu.';
            header('Location: index.php?controller=auth&action=login');
            exit();
        }
        
        $this->transaksiModel = new TransaksiModel();
        $this->keranjangModel = new KeranjangModel();
        $this->produkModel = new ProdukModel();
    }

    // Halaman checkout
    public function checkout() {
        $user_id = $_SESSION['user_id'];
        
        // Ambil item keranjang
        $items = $this->keranjangModel->getByUser($user_id);
        
        // Cek apakah keranjang kosong
        if (empty($items)) {
            $_SESSION['error'] = 'Keranjang belanja kosong.';
            header('Location: index.php?controller=keranjang&action=index');
            exit();
        }
        
        // Hitung total
        $total = $this->keranjangModel->getTotal($user_id);
        $count = $this->keranjangModel->countItems($user_id);
        
        require_once __DIR__ . '/../views/pembeli/checkout.php';
    }

    // Proses checkout (simpan transaksi)
    public function process() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=transaksi&action=checkout');
            exit();
        }

        $user_id = $_SESSION['user_id'];
        
        // Validasi form
        $alamat = trim($_POST['alamat'] ?? '');
        $metode_pembayaran = $_POST['metode_pembayaran'] ?? '';
        
        if (empty($alamat)) {
            $_SESSION['error'] = 'Alamat pengiriman wajib diisi.';
            header('Location: index.php?controller=transaksi&action=checkout');
            exit();
        }
        
        if (empty($metode_pembayaran)) {
            $_SESSION['error'] = 'Metode pembayaran wajib dipilih.';
            header('Location: index.php?controller=transaksi&action=checkout');
            exit();
        }

        // Ambil item keranjang
        $items = $this->keranjangModel->getByUser($user_id);
        
        if (empty($items)) {
            $_SESSION['error'] = 'Keranjang belanja kosong.';
            header('Location: index.php?controller=keranjang&action=index');
            exit();
        }

        // Cek stok sebelum checkout
        foreach ($items as $item) {
            if ($item['stok'] < $item['quantity']) {
                $_SESSION['error'] = 'Stok produk "' . $item['nama_produk'] . '" tidak mencukupi.';
                header('Location: index.php?controller=transaksi&action=checkout');
                exit();
            }
        }

        // Hitung total
        $total = $this->keranjangModel->getTotal($user_id);

        // Siapkan data transaksi
        $data = [
            'user_id' => $user_id,
            'total_harga' => $total,
            'alamat' => $alamat,
            'metode_pembayaran' => $metode_pembayaran,
            'items' => $items
        ];

        try {
            // Simpan transaksi
            $transaksi_id = $this->transaksiModel->create($data);
            
            // Kosongkan keranjang
            $this->keranjangModel->clear($user_id);
            
            $_SESSION['success'] = 'Transaksi berhasil! Terima kasih telah berbelanja.';
            header('Location: index.php?controller=transaksi&action=detail&id=' . $transaksi_id);
            
        } catch (Exception $e) {
            $_SESSION['error'] = 'Gagal memproses transaksi: ' . $e->getMessage();
            header('Location: index.php?controller=transaksi&action=checkout');
        }
        exit();
    }

    // Detail transaksi
    public function detail() {
        $user_id = $_SESSION['user_id'];
        $id = $_GET['id'] ?? 0;
        
        if ($id <= 0) {
            $_SESSION['error'] = 'Transaksi tidak valid.';
            header('Location: index.php?controller=produk&action=produk_list');
            exit();
        }
        
        $transaksi = $this->transaksiModel->getById($id);
        
        // Cek kepemilikan transaksi
        if (!$transaksi || $transaksi['user_id'] != $user_id) {
            $_SESSION['error'] = 'Anda tidak memiliki akses ke transaksi ini.';
            header('Location: index.php?controller=produk&action=produk_list');
            exit();
        }
        
        $details = $this->transaksiModel->getDetails($id);
        
        require_once __DIR__ . '/../views/pembeli/transaksi_detail.php';
    }

    // Riwayat transaksi
    public function history() {
        $user_id = $_SESSION['user_id'];
        $transaksi = $this->transaksiModel->getByUser($user_id);
        
        require_once __DIR__ . '/../views/pembeli/transaksi_history.php';
    }

// =============================================
// ADMIN: Daftar semua transaksi
// =============================================
public function adminIndex() {
    // Cek login dan role admin
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        $_SESSION['error'] = 'Akses ditolak. Silakan login sebagai admin.';
        header('Location: index.php?controller=auth&action=login');
        exit();
    }
    
    // Ambil semua transaksi
    $transaksi = $this->transaksiModel->getAll();
    
    // Hitung statistik
    $total_transaksi = count($transaksi);
    $total_pendapatan = array_sum(array_column($transaksi, 'total_harga'));
    $total_terjual = 0;
    
    // Hitung total produk terjual
    foreach ($transaksi as $t) {
        $details = $this->transaksiModel->getDetails($t['id']);
        foreach ($details as $d) {
            $total_terjual += $d['quantity'];
        }
    }
    
    require_once __DIR__ . '/../views/admin/transaksi_index.php';
}

// =============================================
// ADMIN: Detail transaksi
// =============================================
public function adminDetail() {
    // Cek login dan role admin
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        $_SESSION['error'] = 'Akses ditolak. Silakan login sebagai admin.';
        header('Location: index.php?controller=auth&action=login');
        exit();
    }
    
    $id = $_GET['id'] ?? 0;
    if ($id <= 0) {
        $_SESSION['error'] = 'Transaksi tidak valid.';
        header('Location: index.php?controller=transaksi&action=adminIndex');
        exit();
    }
    
    $transaksi = $this->transaksiModel->getById($id);
    if (!$transaksi) {
        $_SESSION['error'] = 'Transaksi tidak ditemukan.';
        header('Location: index.php?controller=transaksi&action=adminIndex');
        exit();
    }
    
    $details = $this->transaksiModel->getDetails($id);
    
    require_once __DIR__ . '/../views/admin/transaksi_detail.php';
}

// =============================================
// ADMIN: Update status transaksi
// =============================================
public function adminUpdateStatus() {
    // Cek login dan role admin
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        $_SESSION['error'] = 'Akses ditolak.';
        header('Location: index.php?controller=auth&action=login');
        exit();
    }
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php?controller=transaksi&action=adminIndex');
        exit();
    }
    
    $id = $_POST['id'] ?? 0;
    $status = $_POST['status'] ?? '';
    
    $allowed_status = ['pending', 'diproses', 'dikirim', 'selesai', 'batal'];
    if (!in_array($status, $allowed_status)) {
        $_SESSION['error'] = 'Status tidak valid.';
        header('Location: index.php?controller=transaksi&action=adminIndex');
        exit();
    }
    
    if ($this->transaksiModel->updateStatus($id, $status)) {
        $_SESSION['success'] = 'Status transaksi berhasil diperbarui!';
    } else {
        $_SESSION['error'] = 'Gagal memperbarui status transaksi.';
    }
    
    header('Location: index.php?controller=transaksi&action=adminDetail&id=' . $id);
    exit();
}
}
?>