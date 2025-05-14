<?php
require_once 'Controllers/Pegawai.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type'] === 'delete') {
    $pegawai->delete($_POST['id']);
    echo "<script>alert('Pegawai berhasil dihapus');</script>";
    echo "<script>window.location='?url=pegawai-list';</script>";
}

$list_pegawai = $pegawai->index();
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Daftar Pegawai</h4>
            <a href="?url=pegawai-input" class="btn btn-success">Tambah Pegawai</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list_pegawai as $index => $row): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $row['nip'] ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['jenis_kelamin'] ?></td>
                        <td><?= $row['jabatan'] ?></td>
                        <td>
                            <a href="?url=pegawai-input&id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="type" value="delete">
                                <button class="btn btn-danger" onclick="return confirm('Hapus pegawai ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
