<?php
// app/controllers/ProdukController.php

require_once __DIR__ . '/../models/ProdukModel.php';
require_once __DIR__ . '/../models/KategoriModel.php';

class ProdukController {
    private $produkModel;
    private $kategoriModel;

    public function __construct() {
        // Start session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
    }

    // =============================================
    // ADMIN: Halaman daftar produk
    // =============================================
    public function index() {
        // Cek login dan role admin
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            $_SESSION['error'] = 'Akses ditolak. Silakan login sebagai admin.';
            header('Location: index.php?controller=auth&action=login');
            exit();
        }
        
        $produk = $this->produkModel->getAll();
        require_once __DIR__ . '/../views/admin/produk_index.php';
    }
// =============================================
// PEMBELI: Halaman katalog produk
// =============================================
public function produkList() {
    // Cek login (tapi tidak harus admin)
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error'] = 'Silakan login terlebih dahulu.';
        header('Location: index.php?controller=auth&action=login');
        exit();
    }
    
    // Ambil data produk
    $produk = $this->produkModel->getAllActive();
    
    // Tampilkan view
    require_once __DIR__ . '/../views/pembeli/produk_list.php';
}

    // =============================================
    // ADMIN: Halaman tambah produk
    // =============================================
    public function create() {
        // Cek login dan role admin
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            $_SESSION['error'] = 'Akses ditolak. Silakan login sebagai admin.';
            header('Location: index.php?controller=auth&action=login');
            exit();
        }
        
        $kategori = $this->kategoriModel->getAll();
        require_once __DIR__ . '/../views/admin/produk_create.php';
    }

    // =============================================
    // ADMIN: Proses tambah produk
    // =============================================
 public function store() {
    // Cek login dan role admin
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        $_SESSION['error'] = 'Akses ditolak.';
        header('Location: index.php?controller=auth&action=login');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php?controller=produk&action=index');
        exit;
    }

    // Upload gambar
    $gambar = '';
    if (!empty($_FILES['gambar']['name'])) {
        // PATH ABSOLUT
        $target_dir = "C:/xampp/htdocs/project/public/uploads/";
        
        // Buat folder jika belum ada
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        // Bersihkan nama file
        $nama_file = $_FILES['gambar']['name'];
        $ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);
        $nama_bersih = pathinfo($nama_file, PATHINFO_FILENAME);
        $nama_bersih = preg_replace('/[^a-zA-Z0-9]/', '_', $nama_bersih);
        $gambar = time() . '_' . $nama_bersih . '.' . $ekstensi;
        
        $target_file = $target_dir . $gambar;
        
        // Upload file
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            // Upload berhasil
        } else {
            $_SESSION['error'] = 'Gagal upload gambar.';
            header('Location: index.php?controller=produk&action=create');
            exit();
        }
    }

    $data = [
        'nama_produk' => $_POST['nama_produk'],
        'harga' => $_POST['harga'],
        'stok' => $_POST['stok'],
        'deskripsi' => $_POST['deskripsi'],
        'gambar' => $gambar,
        'kategori_id' => $_POST['kategori_id']
    ];

    if ($this->produkModel->create($data)) {
        $_SESSION['success'] = 'Produk berhasil ditambahkan!';
        header('Location: index.php?controller=produk&action=index');
    } else {
        $_SESSION['error'] = 'Gagal menambahkan produk.';
        header('Location: index.php?controller=produk&action=create');
    }
    exit;
}

    // =============================================
    // ADMIN: Halaman edit produk
    // =============================================
    public function edit($id) {
        // Cek login dan role admin
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            $_SESSION['error'] = 'Akses ditolak. Silakan login sebagai admin.';
            header('Location: index.php?controller=auth&action=login');
            exit();
        }
        
        $produk = $this->produkModel->getById($id);
        $kategori = $this->kategoriModel->getAll();
        require_once __DIR__ . '/../views/admin/produk_edit.php';
    }

    // =============================================
    // ADMIN: Proses update produk
    // =============================================
    public function update($id) {
    // Cek login dan role admin
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        $_SESSION['error'] = 'Akses ditolak.';
        header('Location: index.php?controller=auth&action=login');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php?controller=produk&action=index');
        exit;
    }

    $produk_lama = $this->produkModel->getById($id);
    $gambar = $produk_lama['gambar'];

    // Upload gambar baru jika ada
    if (!empty($_FILES['gambar']['name'])) {
        // Hapus gambar lama
        $target_dir = "C:/xampp/htdocs/project/public/uploads/";
        if ($gambar && file_exists($target_dir . $gambar)) {
            unlink($target_dir . $gambar);
        }
        
        // Bersihkan nama file
        $nama_file = $_FILES['gambar']['name'];
        $ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);
        $nama_bersih = pathinfo($nama_file, PATHINFO_FILENAME);
        $nama_bersih = preg_replace('/[^a-zA-Z0-9]/', '_', $nama_bersih);
        $gambar = time() . '_' . $nama_bersih . '.' . $ekstensi;
        
        $target_file = $target_dir . $gambar;
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);
    }

    $data = [
        'nama_produk' => $_POST['nama_produk'],
        'harga' => $_POST['harga'],
        'stok' => $_POST['stok'],
        'deskripsi' => $_POST['deskripsi'],
        'gambar' => $gambar,
        'kategori_id' => $_POST['kategori_id']
    ];

    if ($this->produkModel->update($id, $data)) {
        $_SESSION['success'] = 'Produk berhasil diperbarui!';
        header('Location: index.php?controller=produk&action=index');
    } else {
        $_SESSION['error'] = 'Gagal memperbarui produk.';
        header('Location: index.php?controller=produk&action=edit&id=' . $id);
    }
    exit;
}

    // =============================================
    // ADMIN: Hapus produk
    // =============================================
    public function delete($id) {
        // Cek login dan role admin
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            $_SESSION['error'] = 'Akses ditolak.';
            header('Location: index.php?controller=auth&action=login');
            exit();
        }

        $produk = $this->produkModel->getById($id);
        
        // Hapus gambar
        if ($produk['gambar'] && file_exists(__DIR__ . '/../public/uploads/' . $produk['gambar'])) {
            unlink(__DIR__ . '/../public/uploads/' . $produk['gambar']);
        }

        if ($this->produkModel->delete($id)) {
            $_SESSION['success'] = 'Produk berhasil dihapus!';
        } else {
            $_SESSION['error'] = 'Gagal menghapus produk.';
        }
        header('Location: index.php?controller=produk&action=index');
        exit;
    }

    // =============================================
// PEMBELI: Pencarian produk
// =============================================
public function search() {
    // Cek login
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error'] = 'Silakan login terlebih dahulu.';
        header('Location: index.php?controller=auth&action=login');
        exit();
    }
    
    $keyword = trim($_GET['keyword'] ?? '');
    
    if (empty($keyword)) {
        header('Location: index.php?controller=produk&action=produk_list');
        exit();
    }
    
    $produk = $this->produkModel->search($keyword);
    $searchKeyword = $keyword;
    
    require_once __DIR__ . '/../views/pembeli/produk_list.php';
}

}
?>