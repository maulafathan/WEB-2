<?php
require_once 'Controllers/Pembayaran.php'; // Changed to Pembayaran controller
require_once 'Helpers/helper.php';

$list_Pembayaran = $pembayaran->index(); // Changed to Pembayaran

if (isset($_POST['type'])) {
    if ($_POST['type'] == 'delete') {
        $row = $pembayaran->delete($_POST['id']); // Changed to Pembayaran delete
        echo "<script>alert('Data $row[id] berhasil dihapus')</script>";
        echo "<script>window.location='?url=pembayaran'</script>";
    }
}
?>

<div class="container">
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pembayaran</th>
                        <th>Jumlah Bayar</th>
                        <th>Tanggal</th>
                        <th>Pesanan ID</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($list_Pembayaran as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['id'] ?></td> <!-- ID Pembayaran -->
                            <td><?= $row['jumlah_bayar'] ?></td> <!-- Jumlah Bayar -->
                            <td><?= $row['tanggal'] ?></td> <!-- Tanggal Pembayaran -->
                            <td><?= $row['pesanan_id'] ?></td> <!-- Pesanan ID -->
                            <td>
                                <div class="d-flex">
                                    <a href="?url=Pembayaran-input&id=<?= $row['id'] ?>"
                                        class="btn btn-sm btn-warning mr-2">Edit</a>
                                    <form action="" method="post"
                                        onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="type" value="delete">
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-2">
                <a class="btn btn-success btn-sm" href="?url=Pembayaran-input">
                    <i class="fas fa-plus"></i> Tambah Pembayaran
                </a>
            </div>
        </div>
    </div>
</div>
