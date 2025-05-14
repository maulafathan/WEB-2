<?php
require_once 'Controllers/Pesanan.php';
$pesanan = new Pesanan($pdo); 

// Tangani permintaan POST (letakkan di atas agar redirect berjalan)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['type'])) {
        if ($_POST['type'] == 'delete') {
            $pesanan->delete($_POST['id']);
            echo '<script>alert("Hapus berhasil")</script>';
            echo '<meta http-equiv="refresh" content="0; url=?url=pesanan">';
            exit;
        } elseif ($_POST['type'] == 'tambah') {
            // Validasi sederhana
            $id = trim($_POST['id']);
            $tanggal = $_POST['tanggal'];
            $diskon = $_POST['diskon'];
            $status_bayar = $_POST['status_bayar'];
            $anggota_id = $_POST['anggota_id'];

            // Contoh validasi: pastikan tidak kosong dan id, diskon, anggota_id harus numerik
            if ($id && is_numeric($id) && 
                $tanggal && 
                $diskon !== '' && is_numeric($diskon) && 
                ($status_bayar === '0' || $status_bayar === '1' || $status_bayar === 'true' || $status_bayar === 'false') && 
                $anggota_id && is_numeric($anggota_id)) {
                
                $result = $pesanan->create($id, $tanggal, $diskon, $status_bayar, $anggota_id);
                if ($result) {
                    echo '<script>alert("Tambah berhasil")</script>';
                    echo '<meta http-equiv="refresh" content="0; url=?url=pesanan">';
                    exit;
                } else {
                    echo '<script>alert("Gagal menambahkan data! Pastikan ID belum digunakan.")</script>';
                }
            } else {
                echo '<script>alert("Semua field harus diisi dengan benar! ID, diskon, dan anggota_id harus berupa angka.")</script>';
            }
        } elseif ($_POST['type'] == 'edit') {
            // Validasi sederhana
            $id = trim($_POST['id']);
            $tanggal = $_POST['tanggal'];
            $diskon = $_POST['diskon'];
            $status_bayar = $_POST['status_bayar'];
            $anggota_id = $_POST['anggota_id'];

            // Contoh validasi: pastikan tidak kosong dan id, diskon, anggota_id harus numerik
            if ($id && is_numeric($id) && 
                $tanggal && 
                $diskon !== '' && is_numeric($diskon) && 
                ($status_bayar === '0' || $status_bayar === '1' || $status_bayar === 'true' || $status_bayar === 'false') && 
                $anggota_id && is_numeric($anggota_id)) {
                
                $result = $pesanan->update($id, $tanggal, $diskon, $status_bayar, $anggota_id);
                if ($result) {
                    echo '<script>alert("Edit berhasil")</script>';
                    echo '<meta http-equiv="refresh" content="0; url=?url=pesanan">';
                    exit;
                } else {
                    echo '<script>alert("Gagal mengedit data!")</script>';
                }
            } else {
                echo '<script>alert("Semua field harus diisi dengan benar! ID, diskon, dan anggota_id harus berupa angka.")</script>';
            }
        }
    }
}

// Dapatkan data untuk modal edit jika ada parameter edit_id
$data_edit = null;
if (isset($_GET['edit_id'])) {
    $data_edit = $pesanan->get($_GET['edit_id']);
}
?>

<div class="container">
    <div class="card">
        <div class="card-body">

            <!-- Tombol Tambah -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-default">
                Tambah Pesanan
            </button>

            <!-- Modal Tambah -->
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Pesanan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="number" name="id" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="diskon">Diskon (%)</label>
                                    <input type="number" name="diskon" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="status_bayar">Status Bayar</label>
                                    <select name="status_bayar" class="form-control" required>
                                        <option value="1">Sudah Dibayar</option>
                                        <option value="0">Belum Dibayar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="anggota_id">Anggota ID</label>
                                    <input type="number" name="anggota_id" class="form-control" required>
                                </div>
                                <input type="hidden" name="type" value="tambah">
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Edit -->
            <div class="modal fade" id="modal-edit">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Pesanan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="number" name="id" class="form-control" id="edit-id" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" id="edit-tanggal" required>
                                </div>
                                <div class="form-group">
                                    <label for="diskon">Diskon (%)</label>
                                    <input type="number" name="diskon" class="form-control" id="edit-diskon" required>
                                </div>
                                <div class="form-group">
                                    <label for="status_bayar">Status Bayar</label>
                                    <select name="status_bayar" class="form-control" id="edit-status-bayar" required>
                                        <option value="1">Sudah Dibayar</option>
                                        <option value="0">Belum Dibayar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="anggota_id">Anggota ID</label>
                                    <input type="number" name="anggota_id" class="form-control" id="edit-anggota-id" required>
                                </div>
                                <input type="hidden" name="type" value="edit">
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabel Pesanan -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Diskon</th>
                        <th>Status Bayar</th>
                        <th>Anggota ID</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row = $pesanan->index();
                    $nomor = 1;
                    if ($row && is_array($row)):
                        foreach ($row as $item):
                    ?>
                        <tr>
                            <td><?= $nomor++ ?></td>
                            <td><?= htmlspecialchars($item['id']) ?></td>
                            <td><?= htmlspecialchars($item['tanggal']) ?></td>
                            <td><?= htmlspecialchars($item['diskon']) ?>%</td>
                            <td><?= $item['status_bayar'] == 1 ? 'Sudah Dibayar' : 'Belum Dibayar' ?></td>
                            <td><?= htmlspecialchars($item['anggota_id']) ?></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm edit-btn" 
                                        data-id="<?= htmlspecialchars($item['id']) ?>"
                                        data-tanggal="<?= htmlspecialchars($item['tanggal']) ?>"
                                        data-diskon="<?= htmlspecialchars($item['diskon']) ?>"
                                        data-status-bayar="<?= htmlspecialchars($item['status_bayar']) ?>"
                                        data-anggota-id="<?= htmlspecialchars($item['anggota_id']) ?>"
                                        data-toggle="modal" data-target="#modal-edit">
                                    Edit
                                </button>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
                                    <input type="hidden" name="type" value="delete">
                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">
                                </form>
                            </td>
                        </tr>
                    <?php
                        endforeach;
                    else:
                        echo '<tr><td colspan="7" class="text-center">Tidak ada data pesanan.</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- Script untuk mengisi modal edit -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-btn');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const tanggal = this.getAttribute('data-tanggal');
            const diskon = this.getAttribute('data-diskon');
            const statusBayar = this.getAttribute('data-status-bayar');
            const anggotaId = this.getAttribute('data-anggota-id');
            
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-tanggal').value = tanggal;
            document.getElementById('edit-diskon').value = diskon;
            document.getElementById('edit-status-bayar').value = statusBayar;
            document.getElementById('edit-anggota-id').value = anggotaId;
        });
    });
});
</script>