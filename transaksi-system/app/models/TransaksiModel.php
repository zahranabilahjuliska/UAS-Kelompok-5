<?php
// app/models/TransaksiModel.php

require_once __DIR__ . '/../../config/Database.php';

class TransaksiModel {
    private $db;

    public function __construct() {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }

    // Buat transaksi baru
    public function create($data) {
        try {
            // Mulai transaksi database
            $this->db->beginTransaction();

            // Insert ke tabel transaksi
            $query = "INSERT INTO transaksi (user_id, total_harga, alamat_pengiriman, metode_pembayaran, status) 
                      VALUES (:user_id, :total_harga, :alamat, :metode, 'pending')";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':user_id' => $data['user_id'],
                ':total_harga' => $data['total_harga'],
                ':alamat' => $data['alamat'],
                ':metode' => $data['metode_pembayaran']
            ]);
            
            $transaksi_id = $this->db->lastInsertId();

            // Insert detail transaksi
            foreach ($data['items'] as $item) {
                $query = "INSERT INTO detail_transaksi (transaksi_id, produk_id, quantity, harga_satuan, subtotal) 
                          VALUES (:transaksi_id, :produk_id, :quantity, :harga_satuan, :subtotal)";
                $stmt = $this->db->prepare($query);
                $stmt->execute([
                    ':transaksi_id' => $transaksi_id,
                    ':produk_id' => $item['produk_id'],
                    ':quantity' => $item['quantity'],
                    ':harga_satuan' => $item['harga'],
                    ':subtotal' => $item['harga'] * $item['quantity']
                ]);

                // Kurangi stok produk
                $query = "UPDATE produk SET stok = stok - :quantity WHERE id = :produk_id";
                $stmt = $this->db->prepare($query);
                $stmt->execute([
                    ':quantity' => $item['quantity'],
                    ':produk_id' => $item['produk_id']
                ]);
            }

            // Commit transaksi
            $this->db->commit();
            return $transaksi_id;

        } catch (Exception $e) {
            // Rollback jika ada error
            $this->db->rollBack();
            throw $e;
        }
    }

    // Ambil transaksi by ID
    public function getById($id) {
        $query = "SELECT t.*, u.nama as user_nama, u.email as user_email 
                  FROM transaksi t 
                  JOIN users u ON t.user_id = u.id 
                  WHERE t.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Ambil detail transaksi
    public function getDetails($transaksi_id) {
        $query = "SELECT d.*, p.nama_produk, p.gambar 
                  FROM detail_transaksi d 
                  JOIN produk p ON d.produk_id = p.id 
                  WHERE d.transaksi_id = :transaksi_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':transaksi_id' => $transaksi_id]);
        return $stmt->fetchAll();
    }

    // Ambil semua transaksi user
    public function getByUser($user_id) {
        $query = "SELECT * FROM transaksi 
                  WHERE user_id = :user_id 
                  ORDER BY tanggal_transaksi DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll();
    }

    // Update status transaksi
    public function updateStatus($id, $status) {
        $query = "UPDATE transaksi SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':status' => $status,
            ':id' => $id
        ]);
    }

    // Hitung transaksi dengan status tertentu
    public function countByStatus($status) {
    $query = "SELECT COUNT(*) as total FROM transaksi WHERE status = :status";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':status' => $status]);
    $result = $stmt->fetch();
    return $result['total'] ?? 0;
    }

    // Ambil semua transaksi (untuk admin)
public function getAll() {
    $query = "SELECT t.*, u.nama as user_nama, u.email as user_email 
              FROM transaksi t 
              JOIN users u ON t.user_id = u.id 
              ORDER BY t.tanggal_transaksi DESC";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

}
?>