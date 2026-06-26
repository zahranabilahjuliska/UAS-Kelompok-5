<?php
// app/models/KategoriModel.php

require_once __DIR__ . '/../../config/Database.php';

class KategoriModel {
    private $db;

    public function __construct() {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }

    // Ambil semua kategori
    public function getAll() {
        $query = "SELECT * FROM kategori ORDER BY nama_kategori ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>