<?php
// app/models/KeranjangModel.php

require_once __DIR__ . '/../../config/Database.php';

class KeranjangModel {
    private $db;

    public function __construct() {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }

    // Tambah item ke keranjang
    public function add($user_id, $produk_id, $quantity = 1) {
        // Cek apakah produk sudah ada di keranjang
        $query = "SELECT * FROM keranjang WHERE user_id = :user_id AND produk_id = :produk_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':user_id' => $user_id,
            ':produk_id' => $produk_id
        ]);
        $existing = $stmt->fetch();

        if ($existing) {
            // Update quantity jika sudah ada
            $query = "UPDATE keranjang SET quantity = quantity + :quantity 
                      WHERE user_id = :user_id AND produk_id = :produk_id";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                ':quantity' => $quantity,
                ':user_id' => $user_id,
                ':produk_id' => $produk_id
            ]);
        } else {
            // Insert baru jika belum ada
            $query = "INSERT INTO keranjang (user_id, produk_id, quantity) 
                      VALUES (:user_id, :produk_id, :quantity)";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                ':user_id' => $user_id,
                ':produk_id' => $produk_id,
                ':quantity' => $quantity
            ]);
        }
    }

    // Ambil semua item keranjang user
    public function getByUser($user_id) {
        $query = "SELECT k.*, p.nama_produk, p.harga, p.gambar, p.stok 
                  FROM keranjang k 
                  JOIN produk p ON k.produk_id = p.id 
                  WHERE k.user_id = :user_id 
                  ORDER BY k.tanggal_ditambahkan DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll();
    }

    // Update quantity item keranjang
    public function updateQuantity($id, $user_id, $quantity) {
        if ($quantity <= 0) {
            return $this->remove($id, $user_id);
        }
        $query = "UPDATE keranjang SET quantity = :quantity 
                  WHERE id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':quantity' => $quantity,
            ':id' => $id,
            ':user_id' => $user_id
        ]);
    }

    // Hapus item dari keranjang
    public function remove($id, $user_id) {
        $query = "DELETE FROM keranjang WHERE id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':id' => $id,
            ':user_id' => $user_id
        ]);
    }

    // Hapus semua item keranjang user (setelah checkout)
    public function clear($user_id) {
        $query = "DELETE FROM keranjang WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':user_id' => $user_id]);
    }

    // Hitung total item di keranjang
    public function countItems($user_id) {
        $query = "SELECT SUM(quantity) as total FROM keranjang WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':user_id' => $user_id]);
        $result = $stmt->fetch();
        return $result['total'] ?? 0;
    }

    // Hitung total harga keranjang
    public function getTotal($user_id) {
        $query = "SELECT SUM(k.quantity * p.harga) as total 
                  FROM keranjang k 
                  JOIN produk p ON k.produk_id = p.id 
                  WHERE k.user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':user_id' => $user_id]);
        $result = $stmt->fetch();
        return $result['total'] ?? 0;
    }
}
?>