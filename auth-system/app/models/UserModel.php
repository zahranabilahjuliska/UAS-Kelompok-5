<?php
// app/models/UserModel.php

// Path ke Database.php (naik 2 level dari models ke root project)
require_once __DIR__ . '/../../config/Database.php';

class UserModel {
    private $db;

    public function __construct() {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }

    // Cari user berdasarkan email
    public function findByEmail($email) {
        $stmt = $this->db->prepare("
            SELECT id, nama, email, password, role 
            FROM users 
            WHERE email = :email 
            LIMIT 1
        ");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    // Cek apakah email sudah terdaftar
    public function emailExists($email) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as total 
            FROM users 
            WHERE email = :email
        ");
        $stmt->execute([':email' => $email]);
        $result = $stmt->fetch();
        return $result['total'] > 0;
    }

   // Simpan user baru
public function create($data) {
    $stmt = $this->db->prepare("
        INSERT INTO users (nama, email, password, role) 
        VALUES (:nama, :email, :password, :role)
    ");
    return $stmt->execute([
        ':nama' => $data['nama'],
        ':email' => $data['email'],
        ':password' => password_hash($data['password'], PASSWORD_BCRYPT),
        ':role' => $data['role'] ?? 'pembeli',  // <- Tambahkan role
    ]);
}

    // Ambil data user berdasarkan ID
    public function findById($id) {
        $stmt = $this->db->prepare("
            SELECT id, nama, email, role 
            FROM users 
            WHERE id = :id 
            LIMIT 1
        ");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
}
?>