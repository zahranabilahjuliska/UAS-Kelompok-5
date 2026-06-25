<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Ambil parameter dari URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'auth';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Routing
switch ($controller) {
    case 'auth':
        require_once '../app/controllers/AuthController.php';
        $auth = new AuthController();
        
        if ($action == 'login') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $auth->login();
            } else {
                $auth->loginPage();
            }
        } elseif ($action == 'register') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $auth->register();
            } else {
                $auth->registerPage();
            }
        } elseif ($action == 'logout') {
            $auth->logout();
        }
        break;
        
    case 'produk':
        require_once '../app/controllers/ProdukController.php';
        $produk = new ProdukController();
        
        if ($action == 'index') {
            $produk->index();
        } elseif ($action == 'create') {
            $produk->create();
        } elseif ($action == 'store') {
            $produk->store();
        } elseif ($action == 'edit' && $id) {
            $produk->edit($id);
        } elseif ($action == 'update' && $id) {
            $produk->update($id);
        } elseif ($action == 'delete' && $id) {
            $produk->delete($id);
        } elseif ($action == 'produk_list') {
            $produk->produkList();
        } elseif ($action == 'search') {  // <-- TAMBAHKAN INI
        $produk->search();
        }
        break;

    case 'keranjang':
    require_once '../app/controllers/KeranjangController.php';
    $keranjang = new KeranjangController();
    
    if ($action == 'index') {
        $keranjang->index();
    } elseif ($action == 'add') {
        $keranjang->add();
    } elseif ($action == 'update') {
        $keranjang->update();
    } elseif ($action == 'remove') {
        $keranjang->remove();
    } elseif ($action == 'clear') {
        $keranjang->clear();
    }
    break;

    case 'transaksi':
    require_once '../app/controllers/TransaksiController.php';
    $transaksi = new TransaksiController();
    
    if ($action == 'checkout') {
        $transaksi->checkout();
    } elseif ($action == 'process') {
        $transaksi->process();
    } elseif ($action == 'detail') {
        $transaksi->detail();
    } elseif ($action == 'history') {
        $transaksi->history();
    } elseif ($action == 'adminIndex') {        // <-- TAMBAHKAN
        $transaksi->adminIndex();
    } elseif ($action == 'adminDetail') {      // <-- TAMBAHKAN
        $transaksi->adminDetail();
    } elseif ($action == 'adminUpdateStatus') { // <-- TAMBAHKAN
        $transaksi->adminUpdateStatus();
    }
    break;
        
    default:
        echo "404 - Halaman tidak ditemukan";
        break;
}
?>