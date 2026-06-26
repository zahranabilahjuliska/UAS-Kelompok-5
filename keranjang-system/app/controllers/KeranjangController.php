<?php
// app/controllers/KeranjangController.php

require_once __DIR__ . '/../models/KeranjangModel.php';
require_once __DIR__ . '/../models/ProdukModel.php';

class KeranjangController {
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
        
        $this->keranjangModel = new KeranjangModel();
        $this->produkModel = new ProdukModel();
    }

    // Tampilkan halaman keranjang
    public function index() {
        $user_id = $_SESSION['user_id'];
        $items = $this->keranjangModel->getByUser($user_id);
        $total = $this->keranjangModel->getTotal($user_id);
        $count = $this->keranjangModel->countItems($user_id);
        
        require_once __DIR__ . '/../views/pembeli/keranjang.php';
    }

    // Tambah produk ke keranjang (AJAX)
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=produk&action=produk_list');
            exit();
        }

        $user_id = $_SESSION['user_id'];
        $produk_id = $_POST['produk_id'] ?? 0;
        $quantity = $_POST['quantity'] ?? 1;

        // Validasi
        if ($produk_id <= 0) {
            $_SESSION['error'] = 'Produk tidak valid.';
            header('Location: index.php?controller=produk&action=produk_list');
            exit();
        }

        // Cek stok
        $produk = $this->produkModel->getById($produk_id);
        if (!$produk || $produk['stok'] <= 0) {
            $_SESSION['error'] = 'Stok produk habis.';
            header('Location: index.php?controller=produk&action=produk_list');
            exit();
        }

        // Tambah ke keranjang
        if ($this->keranjangModel->add($user_id, $produk_id, $quantity)) {
            $_SESSION['success'] = 'Produk berhasil ditambahkan ke keranjang!';
        } else {
            $_SESSION['error'] = 'Gagal menambahkan produk ke keranjang.';
        }
        
        header('Location: index.php?controller=keranjang&action=index');
        exit();
    }

    // Update quantity di keranjang (AJAX)
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=keranjang&action=index');
            exit();
        }

        $user_id = $_SESSION['user_id'];
        $id = $_POST['id'] ?? 0;
        $quantity = $_POST['quantity'] ?? 1;

        if ($id <= 0) {
            $_SESSION['error'] = 'Item tidak valid.';
            header('Location: index.php?controller=keranjang&action=index');
            exit();
        }

        if ($this->keranjangModel->updateQuantity($id, $user_id, $quantity)) {
            $_SESSION['success'] = 'Keranjang berhasil diperbarui!';
        } else {
            $_SESSION['error'] = 'Gagal memperbarui keranjang.';
        }
        
        header('Location: index.php?controller=keranjang&action=index');
        exit();
    }

    // Hapus item dari keranjang
    public function remove() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=keranjang&action=index');
            exit();
        }

        $user_id = $_SESSION['user_id'];
        $id = $_POST['id'] ?? 0;

        if ($id <= 0) {
            $_SESSION['error'] = 'Item tidak valid.';
            header('Location: index.php?controller=keranjang&action=index');
            exit();
        }

        if ($this->keranjangModel->remove($id, $user_id)) {
            $_SESSION['success'] = 'Item berhasil dihapus dari keranjang.';
        } else {
            $_SESSION['error'] = 'Gagal menghapus item.';
        }
        
        header('Location: index.php?controller=keranjang&action=index');
        exit();
    }

    // Hapus semua item keranjang (untuk checkout)
    public function clear() {
        $user_id = $_SESSION['user_id'];
        $this->keranjangModel->clear($user_id);
        header('Location: index.php?controller=keranjang&action=index');
        exit();
    }
}
?>