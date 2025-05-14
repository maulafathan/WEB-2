<div class="container">
    <div class="card">
        <div class="card-body">

            <!-- Tombol Tambah -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-default">
                Tambah Produk
            </button>

            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Produk</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="kode">Kode Produk</label>
                                    <input type="text" name="kode" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Produk</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Harga</label>
                                    <input type="text" name="harga" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="number" name="stok" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_produk">Jenis Produk</label>
                                    <input type="text" name="jenis_produk" class="form-control" required>
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

            <!-- Tabel Daftar Produk -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Jenis Produk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once 'Controllers/Produk.php';
                    $row = $produk->index();
                    $nomor = 1;
                    foreach ($row as $item):
                    ?>
                        <tr>
                            <td><?= $nomor++ ?></td>
                            <td><?= $item['kode'] ?></td>
                            <td><?= $item['nama'] ?></td>
                            <td><?= $item['deskripsi'] ?></td>
                            <?php require_once('Helpers/helper.php') ?>
                            <td><?= formatHarga($item['harga']) ?></td>
                            <td><?= $item['stok'] ?></td>
                            <td><?= $item['jenis_produk'] ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <input type="hidden" name="type" value="delete">
                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['type'])) {
                    if ($_POST['type'] == 'delete') {
                        $produk->delete($_POST['id']);
                        echo '<script>alert("Hapus berhasil")</script>';
                        echo '<meta http-equiv="refresh" content="0; url=?url=produk">';
                    } elseif ($_POST['type'] == 'tambah') {
                        $produk->create(
                            $_POST['kode'],
                            $_POST['nama'],
                            $_POST['deskripsi'],
                            $_POST['harga'],
                            $_POST['stok'],
                            $_POST['jenis_produk']
                        );
                        echo '<script>alert("Tambah berhasil")</script>';
                        echo '<meta http-equiv="refresh" content="0; url=?url=produk">';
                    }
                }
            }
            ?>
        </div>
    </div>
</div>
