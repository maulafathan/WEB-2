<?php 
require_once 'Config/DB.php';

class Pesanan {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function index() {
        $stmt = $this->pdo->query("SELECT * FROM pesanan");
        return $stmt->fetchAll();
    }
    
    public function get($id) {
        try {
            $id = (int)$id;
            $stmt = $this->pdo->prepare("SELECT * FROM pesanan WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Gagal mengambil data pesanan: " . $e->getMessage();
            return false;
        }
    }
    
    public function create($id, $tanggal, $diskon, $status_bayar, $anggota_id) {
        try {
            // Convert id, diskon, status_bayar, and anggota_id to integers
            $id = (int)$id;
            $diskon = (int)$diskon;
            $status_bayar = $status_bayar === 'true' || $status_bayar === '1' ? 1 : 0;
            $anggota_id = (int)$anggota_id;
            
            $stmt = $this->pdo->prepare("
                INSERT INTO pesanan (id, tanggal, diskon, status_bayar, anggota_id)
                VALUES (?, ?, ?, ?, ?)
            ");
            return $stmt->execute([$id, $tanggal, $diskon, $status_bayar, $anggota_id]);
        } catch (PDOException $e) {
            echo "Gagal tambah pesanan: " . $e->getMessage();
            return false;
        }
    }
    
    public function update($id, $tanggal, $diskon, $status_bayar, $anggota_id) {
        try {
            // Convert id, diskon, status_bayar, and anggota_id to integers
            $id = (int)$id;
            $diskon = (int)$diskon;
            $status_bayar = $status_bayar === 'true' || $status_bayar === '1' ? 1 : 0;
            $anggota_id = (int)$anggota_id;
            
            $stmt = $this->pdo->prepare("
                UPDATE pesanan 
                SET tanggal = ?, diskon = ?, status_bayar = ?, anggota_id = ?
                WHERE id = ?
            ");
            return $stmt->execute([$tanggal, $diskon, $status_bayar, $anggota_id, $id]);
        } catch (PDOException $e) {
            echo "Gagal update pesanan: " . $e->getMessage();
            return false;
        }
    }
    
    public function delete($id) {
        try {
            // Convert id to integer
            $id = (int)$id;
            
            $stmt = $this->pdo->prepare("DELETE FROM pesanan WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Gagal hapus pesanan: " . $e->getMessage();
            return false;
        }
    }
}

// Jangan instantiate class di sini karena sudah diinstansiasi di view
// $pesanan = new Pesanan($pdo);
?>
