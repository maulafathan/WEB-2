<?php
require_once 'Controllers/Pembayaran.php';
require_once 'Controllers/Pesanan.php'; 
require_once 'Helpers/helper.php';

$pembayaran_id = isset($_GET['id']) ? $_GET['id'] : null;
$show_pembayaran = $pembayaran_id ? $pembayaran->show($pembayaran_id) : [];

// Daftar Pesanan
$list_pesanan = [
    ['id' => 101, 'nama' => 'Laptop'],
    ['id' => 102, 'nama' => 'Handphone'],
    ['id' => 103, 'nama' => 'Kulkas'],
    ['id' => 104, 'nama' => 'TV']
];

if (isset($_POST['type'])) {
    if ($_POST['type'] == 'create') {
        $id = $pembayaran->create($_POST);
        echo "<script>alert('Data berhasil ditambahkan')</script>";
        echo "<script>window.location='?url=pembayaran'</script>";
    } elseif ($_POST['type'] == 'update') {
        $row = $pembayaran->update($pembayaran_id, $_POST);
        echo "<script>alert('Data pembayaran berhasil diperbarui')</script>";
        echo "<script>window.location='?url=pembayaran'</script>";
    }
}
?>

<div class="container">
    <form method="post">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <?= $pembayaran_id ? 'Edit Pembayaran' : 'Tambah Pembayaran' ?>
                </div>
            </div>
            <div class="card-body">
                <!-- ID Pembayaran -->
                  <div class="form-group">
                    <label for="pembayaran_id">No</label>
                    <input type="text" class="form-control" id="pembayaran_id" name="pembayaran_id" 
                           value="<?= getSafeFormValue($show_pembayaran, 'pembayaran_id') ?>" 
                           placeholder="Masukkan No" required>
                <div class="form-group">
                    <label for="pembayaran_id">ID Pembayaran</label>
                    <input type="text" class="form-control" id="pembayaran_id" name="pembayaran_id" 
                           value="<?= getSafeFormValue($show_pembayaran, 'pembayaran_id') ?>" 
                           placeholder="Masukkan ID Pembayaran" required>
                </div>
                <!-- Jumlah Bayar -->
                <div class="form-group">
                    <label for="jumlah_bayar">Jumlah Bayar</label>
                    <input type="number" class="form-control" id="jumlah_bayar" name="jumlah_bayar" 
                           value="<?= getSafeFormValue($show_pembayaran, 'jumlah_bayar') ?>" required>
                </div>
                <!-- Tanggal -->
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" 
                           value="<?= getSafeFormValue($show_pembayaran, 'tanggal') ?>" required>
                </div>
                <!-- Pesanan ID -->
                <div class="form-group">
                    <label for="pesanan_id">Pesanan ID</label>
                    <select class="form-control" id="pesanan_id" name="pesanan_id" required>
                        <option value="">Pilih Pesanan</option>
                        <?php foreach ($list_pesanan as $pesanan) : ?>
                            <option value="<?= $pesanan['id'] ?>" 
                                <?= $pesanan['id'] == getSafeFormValue($show_pembayaran, 'pesanan_id') ? 'selected' : '' ?>>
                                <?= $pesanan['nama'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="card-footer text-right">
                <input type="hidden" name="type" value="<?= $pembayaran_id ? 'update' : 'create' ?>">
                <input type="hidden" name="id" value="<?= $pembayaran_id ?>">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
