<?php
// app/models/ProdukModel.php

require_once __DIR__ . '/../../config/Database.php';

class ProdukModel {
    private $db;

    public function __construct() {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }

    // Ambil semua produk
    public function getAll() {
        $query = "SELECT p.*, k.nama_kategori 
                  FROM produk p 
                  LEFT JOIN kategori k ON p.kategori_id = k.id 
                  ORDER BY p.id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Ambil produk by ID
    public function getById($id) {
        $query = "SELECT * FROM produk WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Tambah produk
    public function create($data) {
        $query = "INSERT INTO produk (nama_produk, harga, stok, deskripsi, gambar, kategori_id) 
                  VALUES (:nama, :harga, :stok, :deskripsi, :gambar, :kategori_id)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':nama' => $data['nama_produk'],
            ':harga' => $data['harga'],
            ':stok' => $data['stok'],
            ':deskripsi' => $data['deskripsi'],
            ':gambar' => $data['gambar'],
            ':kategori_id' => $data['kategori_id']
        ]);
    }

    // Update produk
    public function update($id, $data) {
        $query = "UPDATE produk SET 
                  nama_produk = :nama, 
                  harga = :harga, 
                  stok = :stok, 
                  deskripsi = :deskripsi, 
                  gambar = :gambar, 
                  kategori_id = :kategori_id 
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':id' => $id,
            ':nama' => $data['nama_produk'],
            ':harga' => $data['harga'],
            ':stok' => $data['stok'],
            ':deskripsi' => $data['deskripsi'],
            ':gambar' => $data['gambar'],
            ':kategori_id' => $data['kategori_id']
        ]);
    }

    // Hapus produk
    public function delete($id) {
        $query = "DELETE FROM produk WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':id' => $id]);
    }

    // Ambil produk yang aktif saja (untuk pembeli)
    public function getAllActive() {
        $query = "SELECT p.*, k.nama_kategori 
                  FROM produk p 
                  LEFT JOIN kategori k ON p.kategori_id = k.id 
                  WHERE p.status = 'aktif'
                  ORDER BY p.id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Cari produk berdasarkan keyword (untuk pembeli)
    public function search($keyword) {
    $keyword = '%' . $keyword . '%';
    $query = "SELECT p.*, k.nama_kategori 
              FROM produk p 
              LEFT JOIN kategori k ON p.kategori_id = k.id 
              WHERE p.status = 'aktif' 
              AND (p.nama_produk LIKE :keyword 
                   OR p.deskripsi LIKE :keyword 
                   OR k.nama_kategori LIKE :keyword)
              ORDER BY p.id DESC";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':keyword' => $keyword]);
    return $stmt->fetchAll();
}
}
?>