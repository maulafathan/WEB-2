<?php
require_once 'Controllers/Pesanan.php';
require_once 'Config/DB.php';
$pesanan = new Pesanan($pdo); 

// Ambil data anggota untuk dropdown
function getAnggotaList($pdo) {
    try {
        $stmt = $pdo->query("SELECT id, pegawai_id FROM anggota");
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

// Tangani permintaan POST dan redirect
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['type'])) {
        // Validasi data
        $id = trim($_POST['id']);
        $tanggal = $_POST['tanggal'];
        $diskon = $_POST['diskon'];
        $status_bayar = $_POST['status_bayar'];
        $anggota_id = $_POST['anggota_id'];

        if ($_POST['type'] == 'create') {
            // Validasi: pastikan semua field terisi dengan benar
            if ($id && is_numeric($id) && 
                $tanggal && 
                $diskon !== '' && is_numeric($diskon) && 
                ($status_bayar === '0' || $status_bayar === '1') && 
                $anggota_id && is_numeric($anggota_id)) {
                
                $result = $pesanan->create($id, $tanggal, $diskon, $status_bayar, $anggota_id);
                if ($result) {
                    echo '<script>alert("Data berhasil ditambahkan")</script>';
                    echo '<meta http-equiv="refresh" content="0; url=?url=pesanan">';
                    exit;
                } else {
                    echo '<script>alert("Gagal menambahkan data! Pastikan ID belum digunakan.")</script>';
                }
            } else {
                echo '<script>alert("Semua field harus diisi dengan benar! ID, diskon, dan anggota_id harus berupa angka.")</script>';
            }
        } 
        elseif ($_POST['type'] == 'update') {
            // Validasi: pastikan semua field terisi dengan benar
            if ($id && is_numeric($id) && 
                $tanggal && 
                $diskon !== '' && is_numeric($diskon) && 
                ($status_bayar === '0' || $status_bayar === '1') && 
                $anggota_id && is_numeric($anggota_id)) {
                
                $result = $pesanan->update($id, $tanggal, $diskon, $status_bayar, $anggota_id);
                if ($result) {
                    echo '<script>alert("Data berhasil diperbarui")</script>';
                    echo '<meta http-equiv="refresh" content="0; url=?url=pesanan">';
                    exit;
                } else {
                    echo '<script>alert("Gagal memperbarui data!")</script>';
                }
            } else {
                echo '<script>alert("Semua field harus diisi dengan benar! ID, diskon, dan anggota_id harus berupa angka.")</script>';
            }
        }
    }
}

// Ambil data untuk edit jika ada ID
$edit_data = null;
$pesanan_id = isset($_GET['id']) ? $_GET['id'] : null;
if ($pesanan_id) {
    $edit_data = $pesanan->get($pesanan_id);
}

// Ambil daftar anggota
$anggota_list = getAnggotaList($pdo);
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><?= $pesanan_id ? 'Edit Pesanan' : 'Tambah Pesanan' ?></h4>
        </div>
        <form method="post">
            <div class="card-body">
                <div class="form-group">
                    <label for="id">ID Pesanan</label>
                    <input type="number" name="id" class="form-control" value="<?= $edit_data ? htmlspecialchars($edit_data['id']) : '' ?>" <?= $edit_data ? 'readonly' : '' ?> required>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= $edit_data ? htmlspecialchars($edit_data['tanggal']) : '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="diskon">Diskon (%)</label>
                    <input type="number" name="diskon" class="form-control" value="<?= $edit_data ? htmlspecialchars($edit_data['diskon']) : '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="status_bayar">Status Bayar</label>
                    <select name="status_bayar" class="form-control" required>
                        <option value="1" <?= $edit_data && $edit_data['status_bayar'] == 1 ? 'selected' : '' ?>>Sudah Dibayar</option>
                        <option value="0" <?= $edit_data && $edit_data['status_bayar'] == 0 ? 'selected' : '' ?>>Belum Dibayar</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="anggota_id">Anggota ID</label>
                    <select name="anggota_id" class="form-control" required>
                        <option value="">-- Pilih Anggota --</option>
                        <?php foreach ($anggota_list as $anggota): ?>
                        <option value="<?= htmlspecialchars($anggota['id']) ?>" <?= $edit_data && $edit_data['anggota_id'] == $anggota['id'] ? 'selected' : '' ?>>
                            ID: <?= htmlspecialchars($anggota['id']) ?> - Pegawai ID: <?= htmlspecialchars($anggota['pegawai_id']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="hidden" name="type" value="<?= $pesanan_id ? 'update' : 'create' ?>">
            </div>
            <div class="card-footer text-right">
                <a href="?url=pesanan" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>