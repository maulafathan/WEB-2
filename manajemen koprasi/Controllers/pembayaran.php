<?php
require_once 'Config/DB.php';

class Pembayaran
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT * FROM pembayaran");
        return $stmt->fetchAll();
    }

    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM pembayaran WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = "INSERT INTO pembayaran (jumlah_bayar, tanggal, pesanan_id) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['jumlah_bayar'],
            $data['tanggal'],
            $data['pesanan_id']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE pembayaran SET jumlah_bayar = :jumlah_bayar, tanggal = :tanggal, 
                pesanan_id = :pesanan_id WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'jumlah_bayar' => $data['jumlah_bayar'],
            'tanggal' => $data['tanggal'],
            'pesanan_id' => $data['pesanan_id'],
            'id' => $id
        ]);
        return $this->show($id);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM pembayaran WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount();
    }
}

$pembayaran = new Pembayaran($pdo);
