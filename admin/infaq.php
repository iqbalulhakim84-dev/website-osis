<?php
include '../config/koneksi.php';

// Proses Tambah
if (isset($_POST['tambah'])) {
    $tanggal = $_POST['tanggal'];
    $jenis = $_POST['jenis'];
    $keterangan = $_POST['keterangan'];
    $jumlah = $_POST['jumlah'];

    $db->query("INSERT INTO infaq (tanggal, jenis, keterangan, jumlah) 
                VALUES ('$tanggal','$jenis','$keterangan','$jumlah')");
    header("Location: infaq.php");
}

// Proses Edit
if (isset($_POST['edit'])) {
    $id = $_POST['id_infaq'];
    $tanggal = $_POST['tanggal'];
    $jenis = $_POST['jenis'];
    $keterangan = $_POST['keterangan'];
    $jumlah = $_POST['jumlah'];

    $db->query("UPDATE infaq SET tanggal='$tanggal', jenis='$jenis', keterangan='$keterangan', jumlah='$jumlah' 
                WHERE id_infaq='$id'");
    header("Location: infaq.php");
}

// Proses Hapus
if (isset($_POST['hapus'])) {
    $id = $_POST['id_infaq'];
    $db->query("DELETE FROM infaq WHERE id_infaq='$id'");
    header("Location: infaq.php");
}

// Ambil data
$result = mysqli_query($db, "
    SELECT i.*, 
        ak1.nama AS dibuat_oleh,
        ak2.nama AS diubah_oleh
    FROM infaq i
    LEFT JOIN akun ak1 ON i.created_by = ak1.id_akun
    LEFT JOIN akun ak2 ON i.updated_by = ak2.id_akun
    ORDER BY tanggal ASC
");

// Hitung total
$total_masuk = $db->query("SELECT SUM(jumlah) as total FROM infaq WHERE jenis='pemasukan'")->fetch_assoc()['total'];
$total_keluar = $db->query("SELECT SUM(jumlah) as total FROM infaq WHERE jenis='pengeluaran'")->fetch_assoc()['total'];
$saldo = $total_masuk - $total_keluar;

include '../layout/header.php';
?>

<div class="content-wrapper">
    <div class="container mt-5 overflow-x-scroll">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Laporan Keuangan Infaq</h2>
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
        <hr>

        <!-- Tombol Tambah -->
        <a class="btn btn-primary tambah-btn mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah</a>

        <!-- Modal Tambah -->
        <div class="modal fade" id="modalTambah" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Jenis</label>
                                <select name="jenis" class="form-control" required>
                                    <option value="pemasukan">Pemasukan</option>
                                    <option value="pengeluaran">Pengeluaran</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Jumlah (Rp)</label>
                                <input type="number" name="jumlah" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabel -->
        <table class="table table-bordered table-striped">
            <thead class="">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td width="30"><?= $no++; ?></td>
                        <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                        <td><?php if ($row['jenis'] == "pemasukan"): ?>
                                <span class="badge bg-success">Pemasukan</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Pengeluaran</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row['keterangan']); ?></td>
                        <td width="144">
                            <a class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $row['id_infaq']; ?>">
                                <i class="fas fa-eye"></i>
                            </a> |
                            <!-- Tombol Edit -->
                            <a class="btn btn-warning btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id_infaq']; ?>"><i class="fas fa-edit"></i></a> |

                            <!-- Tombol Hapus -->
                            <a class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row['id_infaq']; ?>"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit<?= $row['id_infaq']; ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title">Ubah Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="id_infaq" value="<?= $row['id_infaq']; ?>">
                                        <div class="mb-3">
                                            <label>Tanggal</label>
                                            <input type="date" name="tanggal" class="form-control" value="<?= $row['tanggal']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Jenis</label>
                                            <select name="jenis" class="form-control" required>
                                                <option value="pemasukan" <?= $row['jenis'] == 'pemasukan' ? 'selected' : ''; ?>>Pemasukan</option>
                                                <option value="pengeluaran" <?= $row['jenis'] == 'pengeluaran' ? 'selected' : ''; ?>>Pengeluaran</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" class="form-control" required><?= $row['keterangan']; ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label>Jumlah (Rp)</label>
                                            <input type="number" name="jumlah" class="form-control" value="<?= $row['jumlah']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="edit" class="btn btn-warning">Update</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Hapus -->
                    <div class="modal fade" id="modalHapus<?= $row['id_infaq']; ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Hapus Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="id_infaq" value="<?= $row['id_infaq']; ?>">
                                        <p>Yakin ingin menghapus data <b><?= $row['keterangan']; ?></b> ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="alert alert-info">
            <b>Total Pemasukan:</b> Rp <?= number_format($total_masuk, 0, ',', '.'); ?><br>
            <b>Total Pengeluaran:</b> Rp <?= number_format($total_keluar, 0, ',', '.'); ?><br>
            <b>Saldo Akhir:</b> Rp <?= number_format($saldo, 0, ',', '.'); ?>
        </div>
    </div>
</div>
<?php mysqli_data_seek($result, 0); // reset pointer 
?>
<?php while ($r = mysqli_fetch_assoc($result)) : ?>
    <div class="modal fade" id="modalDetail<?= $r['id_infaq']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Detail Keuangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Tanggal</th>
                            <td><?= date('d-m-Y', strtotime($r['tanggal'])); ?></td>
                        </tr>
                        <tr>
                            <th>Jenis</th>
                            <td><?php if ($r['jenis'] == "pemasukan"): ?>
                                    <span class="badge bg-success">Pemasukan</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Pengeluaran</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td><?= htmlspecialchars($r['keterangan']); ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah (Rp)</th>
                            <td>Rp <?= number_format($r['jumlah'], 0, ',', '.'); ?></td>
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
include '../layout/footer.php'
?>