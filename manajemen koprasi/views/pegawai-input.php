<?php
require_once 'Controllers/pegawai.php';

$pegawai_id = isset($_GET['id']) ? $_GET['id'] : null;
$show_pegawai = $pegawai_id ? $pegawai->show($pegawai_id) : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ('create') {
        $pegawai->create($_POST);
        echo "<script>alert('Pegawai berhasil ditambahkan');</script>";
        echo "<script>window.location='?url=pegawai-list';</script>";
    } elseif ($_POST['type'] === 'update') {
        $pesanan->update($pesanan_id, $_POST);
        echo "<script>alert('Pesanan berhasil diperbarui');</script>";
        echo "<script>window.location='?url=pesanan-list';</script>";
    }
}
?>

<div class="container">
    <form method="post">
        <div class="card">
            <div class="card-header">
                <h4><?= $pegawai_id ? 'Edit Pegawai' : 'Tambah Pegawai' ?></h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>ID</label>
                    <input type="text" name="id" class="form-control" value="<?= $show_pesanan['id'] ?? '' ?>" required>
                </div>
                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" name="id" class="form-control" value="<?= $show_pesanan['id'] ?? '' ?>" required>
                </div>
                 <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="id" class="form-control" value="<?= $show_pesanan['id'] ?? '' ?>" required>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <input type="text" name="id" class="form-control" value="<?= $show_pesanan['id'] ?? '' ?>" required>
                </div>
                <div class="form-group">
                   <label>Jabatan</label>
                    <input type="text" name="id" class="form-control" value="<?= $show_pesanan['id'] ?? '' ?>" required>
                        
                    </select>
                </div>
            <div class="card-footer text-right">
                <a href="?url=pesanan" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
                
