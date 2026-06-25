<?php
// public/test_db.php

// Perbaiki path ke config/Database.php
require_once __DIR__ . '/../config/Database.php';

// Coba koneksi
try {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    
    echo "<h2 style='color: green;'>✅ Koneksi Database Berhasil!</h2>";
    
    // Test query
    $stmt = $conn->query("SELECT COUNT(*) as total FROM users");
    $result = $stmt->fetch();
    echo "<p>Total Users: " . $result['total'] . "</p>";
    
    // Tampilkan beberapa produk
    $stmt = $conn->query("SELECT * FROM produk LIMIT 5");
    $produk = $stmt->fetchAll();
    
    if ($produk) {
        echo "<h3>Daftar Produk:</h3>";
        echo "<ul>";
        foreach ($produk as $p) {
            echo "<li>" . htmlspecialchars($p['nama_produk']) . 
                 " - Rp " . number_format($p['harga'], 0, ',', '.') . "</li>";
        }
        echo "</ul>";
    }
    
} catch (PDOException $e) {
    echo "<h2 style='color: red;'>❌ Koneksi Gagal!</h2>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
}
?>