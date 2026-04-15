<?php
include '../config/koneksi.php';
include '../layout/header.php';

$transaksi = mysqli_query($db, "
SELECT t.*, p.nama_produk, p.harga_jual, ak1.nama AS dibuat_oleh, ak2.nama AS diubah_oleh 
FROM transaksi_osis t
JOIN produk_osis p ON t.id_produk = p.id_produk
LEFT JOIN akun ak1 ON t.created_by = ak1.id_akun
LEFT JOIN akun ak2 ON t.updated_by = ak2.id_akun
ORDER BY t.id_transaksi DESC");
// Ambil daftar produk untuk dropdown
$produk = mysqli_query($db, "SELECT * FROM produk_osis ORDER BY nama_produk ASC");

// Tambah
if (isset($_POST['tambah'])) {
    if (create_transaksi_osis($_POST) > 0) {
        echo "<script>alert('Transaksi berhasil!'); location.href='s5-transaksi.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah transaksi!');</script>";
    }
}
?>

<div class="content-wrapper">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Transaksi</h2>
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
        <hr>
        <a class="btn btn-primary tambah-btn" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah</a>

        <table id="serverside" class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th width="24">No</th>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th>Keterangan</th>
                    <th width="96">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                while ($t = mysqli_fetch_assoc($transaksi)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $t['tanggal'] ?></td>
                        <td><?= $t['nama_produk'] ?></td>
                        <td><?= $t['keterangan']; ?></td>
                        <td>
                            <a class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $t['id_transaksi']; ?>"><i class="fas fa-eye"></i></a>
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
                <h5 class="modal-title">Tambah Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="id_produk" class="form-label">Produk</label>
                        <select name="id_produk" id="id_produk" class="form-control" required>
                            <option value="">-- Pilih Produk --</option>
                            <?php while ($p = mysqli_fetch_assoc($produk)): ?>
                                <option value="<?= $p['id_produk'] ?>" data-harga="<?= $p['harga_jual'] ?>">
                                    <?= htmlspecialchars($p['nama_produk']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="harga_jual" class="form-label">Harga Satuan</label>
                        <input type="text" name="harga_jual" id="harga_jual" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" required min="1">
                    </div>

                    <div class="mb-3">
                        <label for="total" class="form-label">Total</label>
                        <input type="text" name="total" id="total" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="jenis">Jenis Transaksi</label>
                        <select name="jenis" id="jenis" class="form-control" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Penjualan">Penjualan</option>
                            <option value="Pembelian">Pembelian</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required value="<?= date('Y-m-d') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php mysqli_data_seek($transaksi, 0); // reset pointer 
?>
<?php while ($r = mysqli_fetch_assoc($transaksi)) : ?>
    <div class="modal fade" id="modalDetail<?= $r['id_transaksi']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Detail Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Tanggal</th>
                            <td><?= htmlspecialchars($r['tanggal']); ?></td>
                        </tr>
                        <tr>
                            <th>Nama Produk</th>
                            <td><?= htmlspecialchars($r['nama_produk']); ?></td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>Rp <?= number_format($r['harga_jual'], 0, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <th>Jenis</th>
                            <td><?= htmlspecialchars($r['jenis']); ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td><?= htmlspecialchars($r['jumlah']); ?></td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>Rp <?= number_format($r['total'], 0, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td><?= htmlspecialchars($r['keterangan']); ?></td>
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
<?php endwhile; ?>

<script>
    // ambil harga otomatis saat produk dipilih
    document.getElementById('id_produk').addEventListener('change', function() {
        const harga_jual = this.options[this.selectedIndex].getAttribute('data-harga');
        document.getElementById('harga_jual').value = harga_jual ? harga_jual : '';
        hitungTotal();
    });

    document.getElementById('jumlah').addEventListener('input', hitungTotal);

    function hitungTotal() {
        const harga_jual = parseFloat(document.getElementById('harga_jual').value) || 0;
        const jumlah = parseInt(document.getElementById('jumlah').value) || 0;
        document.getElementById('total').value = harga_jual * jumlah;
    }
</script>

<?php include '../layout/footer.php' ?>