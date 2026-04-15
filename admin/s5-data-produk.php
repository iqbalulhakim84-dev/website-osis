<?php
include '../config/koneksi.php';
include '../layout/header.php';

// ambil semua produk
$result = mysqli_query($db, "SELECT po.*, 
                        ak1.nama AS dibuat_oleh,
                        ak2.nama AS diubah_oleh 
                        FROM produk_osis po 
                        LEFT JOIN akun ak1 ON po.created_by = ak1.id_akun
                        LEFT JOIN akun ak2 ON po.updated_by = ak2.id_akun
                        ORDER BY id_produk ASC
                        ");

// tambah produk
if (isset($_POST['tambah'])) {
    if (create_produk_osis($_POST) > 0) {
        echo "<script>alert('Produk berhasil ditambahkan!'); document.location.href='s5-data-produk.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan produk!');</script>";
    }
}

// ubah produk
if (isset($_POST['ubah'])) {
    if (update_produk_osis($_POST) > 0) {
        echo "<script>alert('Produk berhasil diubah!'); document.location.href='s5-data-produk.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah produk!');</script>";
    }
}

// hapus produk
if (isset($_POST['hapus'])) {
    if (delete_produk_osis($_POST) > 0) {
        echo "<script>alert('Produk berhasil dihapus!'); document.location.href='s5-data-produk.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus produk!');</script>";
    }
}
?>

<div class="content-wrapper">
    <div class="container mt-5 overflow-x-scroll">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Data Produk Kewirausahaan OSIS</h2>
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
        <hr>
        <a class="btn btn-primary tambah-btn" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah</a>

        <table id="serverside" class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th width="24">No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                while ($r = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= htmlspecialchars($r['nama_produk']) ?></td>
                        <td>Rp <?= number_format($r['harga_jual'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($r['stok']) ?></td>
                        <td width="144" class="text-center">
                            <a class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $r['id_produk']; ?>">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn btn-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $r['id_produk']; ?>"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $r['id_produk']; ?>"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Kategori</label>
                        <input type="text" name="kategori" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Harga (Rp)</label>
                        <input type="number" name="harga_jual" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah -->
<?php
mysqli_data_seek($result, 0); // reset pointer untuk looping ulang
while ($r = mysqli_fetch_assoc($result)): ?>
    <div class="modal fade" id="modalUbah<?= $r['id_produk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Ubah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <input type="hidden" name="id_produk" value="<?= $r['id_produk'] ?>">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" value="<?= htmlspecialchars($r['nama_produk']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Kategori</label>
                            <input type="text" name="kategori" class="form-control" value="<?= htmlspecialchars($r['kategori']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Harga (Rp)</label>
                            <input type="number" name="harga_jual" class="form-control" value="<?= $r['harga_jual'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control" value="<?= $r['stok'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control"><?= htmlspecialchars($r['deskripsi']) ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" name="ubah" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endwhile; ?>

<!-- Modal Hapus -->
<?php
mysqli_data_seek($result, 0);
while ($r = mysqli_fetch_assoc($result)): ?>
    <div class="modal fade" id="modalHapus<?= $r['id_produk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Hapus Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Yakin ingin menghapus produk <strong><?= htmlspecialchars($r['nama_produk']) ?></strong>?
                </div>
                <div class="modal-footer">
                    <form method="post">
                        <input type="hidden" name="id_produk" value="<?= $r['id_produk'] ?>">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>
<?php mysqli_data_seek($result, 0); // reset pointer 
?>
<?php while ($r = mysqli_fetch_assoc($result)) : ?>
    <div class="modal fade" id="modalDetail<?= $r['id_produk']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Produk</th>
                            <td><?= htmlspecialchars($r['nama_produk']); ?></td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td><?= htmlspecialchars($r['kategori']); ?></td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>Rp <?= number_format($r['harga_jual'], 0, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td><?= htmlspecialchars($r['stok']); ?></td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td><?= htmlspecialchars($r['deskripsi']); ?></td>
                        </tr>
                        <tr>
                            <th>Foto Produk</th>
                            <td><?= htmlspecialchars($r['foto_produk']); ?></td>
                        </tr>

                        <tr>
                            <th>Dibuat Pada</th>
                            <td><?= date('d-m-Y H:i', strtotime($r['created_at'])); ?></td>
                        </tr>
                        <tr>
                            <th>Dibuat Oleh</th>
                            <td><?= htmlspecialchars($r['dibuat_oleh']); ?></td>
                        </tr>

                        <tr>
                            <th>Terakhir Diubah</th>
                            <td><?= date('d-m-Y H:i', strtotime($r['updated_at'])); ?></td>
                        </tr>
                        <tr>
                            <th>Diubah Oleh</th>
                            <td><?= htmlspecialchars($r['diubah_oleh']); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
<?php endwhile;
include '../layout/footer.php'; ?>