<?php
require_once 'Config/DB.php';

class Produk {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function index() {
        $stmt = $this->pdo->query("SELECT * FROM produk");
        return $stmt->fetchAll();
    }

    public function create($kode, $nama, $deskripsi, $harga, $stok, $jenis_produk) {
        $stmt = $this->pdo->prepare("
            INSERT INTO produk (kode, nama, deskripsi, harga, stok, jenis_produk)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$kode, $nama, $deskripsi, $harga, $stok, $jenis_produk]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM produk WHERE id = ?");
        return $stmt->execute([$id]);
    }
}


$produk = new Produk($pdo);
