<?php
require_once 'Config/DB.php';

class Pegawai
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT * FROM pegawai");
        return $stmt->fetchAll();
    }

    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM pegawai WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        try {
            $sql = "INSERT INTO pegawai (nip, nama, jenis_kelamin, jabatan) VALUES (?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $data['nip'],
                $data['nama'],
                $data['jenis_kelamin'],
                $data['jabatan']
            ]);
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function update($id, $data)
    {
        $sql = "UPDATE pegawai SET nip = ?, nama = ?, jenis_kelamin = ?, jabatan = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['nip'],
            $data['nama'],
            $data['jenis_kelamin'],
            $data['jabatan'],
            $id
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM pegawai WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}

$pegawai = new Pegawai($pdo);
?>
