<?php
// app/controllers/AuthController.php

require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct() {
        // Start session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $this->userModel = new UserModel();
    }

    // Tampilkan halaman login
    public function loginPage() {
        // Jika sudah login, redirect sesuai role
        if (isset($_SESSION['user_id'])) {
            $this->redirectByRole($_SESSION['role']);
        }
        require_once __DIR__ . '/../views/auth/login.php';
    }

    // Proses form login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Validasi input tidak kosong
        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Email dan password wajib diisi.';
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        // Cari user di database
        $user = $this->userModel->findByEmail($email);

        // Cek user ada dan password cocok
        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['error'] = 'Email atau password salah.';
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        // Login berhasil — simpan ke session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        $_SESSION['success'] = 'Selamat datang, ' . $user['nama'] . '!';
        $this->redirectByRole($user['role']);
    }

    // Tampilkan halaman register
    public function registerPage() {
        if (isset($_SESSION['user_id'])) {
            $this->redirectByRole($_SESSION['role']);
        }
        require_once __DIR__ . '/../views/auth/register.php';
    }

    // Proses form register
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=auth&action=register');
            exit;
        }

        $nama = trim($_POST['nama'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $konfirmPassword = $_POST['konfirm_password'] ?? '';

        // Validasi tidak boleh kosong
        if (empty($nama) || empty($email) || empty($password)) {
            $_SESSION['error'] = 'Semua field wajib diisi.';
            header('Location: index.php?controller=auth&action=register');
            exit;
        }

        // Validasi format email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Format email tidak valid.';
            header('Location: index.php?controller=auth&action=register');
            exit;
        }

        // Validasi panjang password
        if (strlen($password) < 6) {
            $_SESSION['error'] = 'Password minimal 6 karakter.';
            header('Location: index.php?controller=auth&action=register');
            exit;
        }

        // Validasi konfirmasi password
        if ($password !== $konfirmPassword) {
            $_SESSION['error'] = 'Password dan konfirmasi password tidak cocok.';
            header('Location: index.php?controller=auth&action=register');
            exit;
        }

        // Cek email sudah terdaftar
        if ($this->userModel->emailExists($email)) {
            $_SESSION['error'] = 'Email sudah terdaftar, silakan gunakan email lain.';
            header('Location: index.php?controller=auth&action=register');
            exit;
        }

        // Paksa role menjadi pembeli (admin tidak bisa daftar)
        $role = 'pembeli';

        // Simpan user baru dengan role pembeli
        $berhasil = $this->userModel->create([
            'nama' => $nama,
            'email' => $email,
            'password' => $password,
            'role' => $role,  // <-- SELALU PEMBELI
        ]);

        if ($berhasil) {
            $_SESSION['success'] = 'Akun berhasil dibuat! Silakan login.';
            header('Location: index.php?controller=auth&action=login');
        } else {
            $_SESSION['error'] = 'Gagal membuat akun, coba lagi.';
            header('Location: index.php?controller=auth&action=register');
        }
        exit;
    }

    // Logout
    public function logout() {
        // Hapus semua session
        $_SESSION = array();
        session_destroy();
        
        header('Location: index.php?controller=auth&action=login');
        exit;
    }

    // Helper: redirect berdasarkan role
    private function redirectByRole($role) {
    if ($role === 'admin') {
        header('Location: index.php?controller=produk&action=index');
    } else {
        header('Location: index.php?controller=produk&action=produk_list');
    }
    exit;
}
}
?>
