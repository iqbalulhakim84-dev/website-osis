<?php
include '../config/koneksi.php';
include '../layout/header.php';

// Ambil semua data keuangan
$keuangan = mysqli_query($db, "SELECT ko.*, ak1.nama AS dibuat_oleh, ak2.nama AS diubah_oleh FROM keuangan_osis ko 
LEFT JOIN akun ak1 ON ko.created_by = ak1.id_akun
LEFT JOIN akun ak2 ON ko.updated_by = ak2.id_akun 
ORDER BY tanggal DESC");

// Hitung total pemasukan & pengeluaran
$total_pemasukan = mysqli_fetch_assoc(mysqli_query($db, "SELECT SUM(nominal) AS total FROM keuangan_osis WHERE jenis='Pemasukan'"))['total'] ?? 0;
$total_pengeluaran = mysqli_fetch_assoc(mysqli_query($db, "SELECT SUM(nominal) AS total FROM keuangan_osis WHERE jenis='Pengeluaran'"))['total'] ?? 0;
$saldo = $total_pemasukan - $total_pengeluaran;
?>

<div class="content-wrapper">
    <div class="container mt-5 overflow-x-scroll">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Data Keuangan OSIS</h2>
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>

        <hr>
        <!-- Tombol Aksi -->
        <div class="mb-3 text-start">
            <a href="tambah-keuangan.php" class="btn btn-primary">Tambah Transaksi Manual</a>
            <a href="laporan.php" class="btn btn-info">Cetak Laporan</a>
        </div>
        <hr>

        <!-- Ringkasan Keuangan -->
        <div class="row text-center mb-4">
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>Total Pemasukan</h5>
                        <h3>Rp <?= number_format($total_pemasukan, 0, ',', '.') ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5>Total Pengeluaran</h5>
                        <h3>Rp <?= number_format($total_pengeluaran, 0, ',', '.') ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning">
                    <div class="card-body">
                        <h5>Saldo Akhir</h5>
                        <h3>Rp <?= number_format($saldo, 0, ',', '.') ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <!-- Tabel Keuangan -->
        <table class="table table-bordered table-striped">
            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Jenis</th>
                    <th>Nominal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                while ($row = mysqli_fetch_assoc($keuangan)): ?>
                    <tr>
                        <td class="text-center"><?= $i++; ?></td>
                        <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                        <td class="text-center">
                            <span class="badge bg-<?= $row['jenis'] == 'Pemasukan' ? 'success' : 'danger' ?>">
                                <?= $row['jenis'] ?>
                            </span>
                        </td>
                        <td class="text-start">Rp <?= number_format($row['nominal'], 0, ',', '.') ?></td>
                        <td class="text-center">
                            <a class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $row['id_keuangan']; ?>"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $row['id_keuangan']; ?>"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row['id_keuangan']; ?>"><i class="fas fa-trash"></i></a>
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
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pelanggaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <!-- Pilih Siswa -->
                    <div class="mb-3">
                        <label for="id_siswa">Nama Siswa</label>
                        <select name="id_siswa" id="id_siswa" class="form-control" required>
                            <option value="">-- Pilih Siswa --</option>
                            <?php
                            $siswa = mysqli_query($db, "SELECT s.*, k.nama_kelas FROM siswa s JOIN kelas k ON k.id_kelas = s.id_kelas ORDER BY nama_siswa ASC");
                            while ($s = mysqli_fetch_assoc($siswa)) :
                            ?>
                                <option value="<?= $s['id_siswa']; ?>"><?= $s['nama_siswa']; ?> (<?= $s['nama_kelas']; ?>)</option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <!-- Pilih Jenis Pelanggaran -->
                    <div class="mb-3">
                        <label for="id_jenis_pelanggaran">Jenis Pelanggaran</label>
                        <select name="id_jenis_pelanggaran" id="id_jenis_pelanggaran" class="form-control" required>
                            <option value="">-- Pilih Jenis Pelanggaran --</option>
                            <?php
                            $jenis = mysqli_query($db, "SELECT * FROM jenis_pelanggaran ORDER BY nama_pelanggaran ASC");
                            while ($j = mysqli_fetch_assoc($jenis)) :
                            ?>
                                <option value="<?= $j['id_jenis_pelanggaran']; ?>"><?= $j['nama_pelanggaran']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ubah -->
<?php foreach ($keuangan as $r): ?>
    <div class="modal fade" id="modalUbah<?= $r['id_keuangan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah r</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_keuangan" value="<?= $r['id_keuangan']; ?>">
                        <div class="mb-3">
                            <label for="id_siswa">Nama Siswa</label>
                            <select name="id_siswa" id="id_siswa" class="form-control" required>
                                <?php
                                $anggota = select("SELECT s.*, k.nama_kelas FROM siswa s JOIN kelas k ON k.id_kelas = s.id_kelas ORDER BY nama_siswa ASC");
                                foreach ($anggota as $a) :
                                ?>
                                    <option value="<?= $a['id_siswa']; ?>" <?= $a['id_siswa'] == $r['id_siswa'] ? 'selected' : '' ?>>
                                        <?= $a['nama_siswa']; ?> (<?= $a['nama_kelas']; ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_jenis_pelanggaran">Jenis Pelanggaran</label>
                            <select name="id_jenis_pelanggaran" id="id_jenis_pelanggaran" class="form-control" required>
                                <?php
                                $jenis_pelanggaran = select("SELECT * FROM jenis_pelanggaran ORDER BY id_jenis_pelanggaran ASC");
                                foreach ($jenis_pelanggaran as $j) :
                                ?>
                                    <option value="<?= $j['id_jenis_pelanggaran']; ?>" <?= $j['id_jenis_pelanggaran'] == $r['id_jenis_pelanggaran'] ? 'selected' : '' ?>>
                                        <?= $j['nama_pelanggaran']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= htmlspecialchars($r['tanggal']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?= htmlspecialchars($r['keterangan']); ?>" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Modal Hapus -->
<?php foreach ($keuangan as $r): ?>
    <div class="modal fade" id="modalHapus<?= $r['id_keuangan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="" method="post" class="d-inline">
                        <input type="hidden" name="id_keuangan" value="<?= $r['id_keuangan']; ?>">
                        <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php mysqli_data_seek($keuangan, 0); // reset pointer 
?>
<?php while ($r = mysqli_fetch_assoc($keuangan)) : ?>
    <div class="modal fade" id="modalDetail<?= $r['id_keuangan']; ?>" tabindex="-1">
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
                            <td><?= date('d-m-Y', strtotime($r['tanggal'])) ?></td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td><?= htmlspecialchars($r['deskripsi']); ?></td>
                        </tr>
                        <tr>
                            <th>Jenis</th>
                            <td><?= htmlspecialchars($r['jenis']); ?></td>
                        </tr>
                        <tr>
                            <th>Nominal</th>
                            <td>Rp <?= number_format($r['nominal'], 0, ',', '.') ?></td>
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
<?php include '../layout/footer.php'; ?>