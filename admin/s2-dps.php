<?php
include '../config/koneksi.php';
include "../layout/header.php";

/* =========================
   QUERY DATA UTAMA
========================= */
$query = "
SELECT 
    ps.*, 
    s.nama_siswa, 
    s.poin, 
    jp.nama_pelanggaran, 
    k.nama_kelas,
    ak1.nama AS dibuat_oleh, 
    ak2.nama AS diubah_oleh
FROM pelanggaran_siswa ps
JOIN siswa s ON ps.id_siswa = s.id_siswa
JOIN kelas k ON k.id_kelas = s.id_kelas
JOIN jenis_pelanggaran jp ON ps.id_jenis_pelanggaran = jp.id_jenis_pelanggaran
LEFT JOIN akun ak1 ON ps.created_by = ak1.id_akun
LEFT JOIN akun ak2 ON ps.updated_by = ak2.id_akun
ORDER BY jp.nama_pelanggaran ASC
";
$result = mysqli_query($db, $query);

/* simpan ke array agar aman dipakai berulang */
$dataPelanggaran = [];
while ($row = mysqli_fetch_assoc($result)) {
    $dataPelanggaran[] = $row;
}

/* =========================
   QUERY GRAFIK
========================= */
$chartQuery = "
SELECT jp.nama_pelanggaran, COUNT(*) AS total
FROM pelanggaran_siswa ps
JOIN jenis_pelanggaran jp ON ps.id_jenis_pelanggaran = jp.id_jenis_pelanggaran
GROUP BY jp.nama_pelanggaran
";
$chartResult = mysqli_query($db, $chartQuery);

$chart_labels = [];
$chart_totals = [];
while ($row = mysqli_fetch_assoc($chartResult)) {
    $chart_labels[] = $row['nama_pelanggaran'];
    $chart_totals[] = $row['total'];
}

/* =========================
   PROSES CRUD
========================= */
// jika tombol tambah di tekan jalankan script berikut
if (isset($_POST['tambah'])) {
    if (create_data_pelanggaran_siswa($_POST) > 0) {
        echo "<script>
               alert('Data Berhasil Ditambahkan');
               document.location.href = 's2-dps.php';
               </script>";
    } else {
        echo "<script>
               alert('Data Gagal Ditambahkan');
               document.location.href = 's2-dps.php';
               </script>";
    }
}
// jika tombol ubah di tekan jalankan script berikut
if (isset($_POST['ubah'])) {
    if (update_data_pelanggaran_siswa($_POST) > 0) {
        echo "<script>
               alert('Data Berhasil Diubahkan');
               document.location.href = 's2-dps.php';
               </script>";
    } else {
        echo "<script>
               alert('Data Gagal Diubahkan');
               document.location.href = 's2-dps.php';
               </script>";
    }
}
if (isset($_POST['hapus'])) {
    if (delete_data_pelanggaran_siswa($_POST) > 0) {
        echo "<script>
               alert('Data Berhasil Dihapus');
               document.location.href = 's2-dps.php';
               </script>";
    } else {
        echo "<script>
               alert('Data Gagal Dihapus');
               document.location.href = 's2-dps.php';
               </script>";
    }
}
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Sekbid 2 – Data Pelanggaran Siswa</h2>
        <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
    </div>

    <hr>

    <a class="btn btn-primary mb-3 tambah-btn" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="fas fa-plus-circle"></i> Tambah
    </a>
    <a href="jenis-pelanggaran.php" class="btn btn-info mb-3 tambah-btn">Jenis Pelanggaran</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Jenis Pelanggaran</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($dataPelanggaran as $d): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($d['nama_siswa']); ?></td>
                    <td><?= htmlspecialchars($d['nama_pelanggaran']); ?></td>
                    <td><?= htmlspecialchars($d['tanggal']); ?></td>
                    <td>
                        <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detail<?= $d['id_pelanggaran']; ?>"><i class="fas fa-eye"></i></a>
                        <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubah<?= $d['id_pelanggaran']; ?>"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?= $d['id_pelanggaran']; ?>"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php foreach ($dataPelanggaran as $d): ?>
    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pelanggaran</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post"> <!-- Pilih Siswa -->
                        <div class="mb-3"> <label for="id_siswa">Nama Siswa</label>
                            <select name="id_siswa" id="id_siswa" class="form-control" required>
                                <option value="">-- Pilih Siswa --</option>
                                <?php
                                $siswa = mysqli_query($db, "SELECT s.*, k.nama_kelas FROM siswa s JOIN kelas k ON k.id_kelas = s.id_kelas ORDER BY nama_siswa ASC");
                                while ($s = mysqli_fetch_assoc($siswa)) : ?>
                                    <option value="<?= $s['id_siswa']; ?>"><?= $s['nama_siswa']; ?> (<?= $s['nama_kelas']; ?>)</option>
                                <?php endwhile; ?>
                            </select>
                        </div> <!-- Pilih Jenis Pelanggaran -->
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
    <!-- DETAIL -->
    <div class="modal fade" id="detail<?= $d['id_pelanggaran']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5>Detail Pelanggaran</h5>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama</th>
                            <td><?= htmlspecialchars($d['nama_siswa']); ?></td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td><?= htmlspecialchars($d['nama_kelas']); ?></td>
                        </tr>
                        <tr>
                            <th>Poin</th>
                            <td><?= htmlspecialchars($d['poin']); ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Pelanggaran</th>
                            <td><?= htmlspecialchars($d['nama_pelanggaran']); ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><?= htmlspecialchars($d['tanggal']); ?></td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td><?= htmlspecialchars($d['keterangan']); ?></td>
                        </tr>

                        <tr>
                            <th>Dibuat Pada</th>
                            <td><?= date('d-m-Y H:i', strtotime($d['created_at'])); ?></td>
                        </tr>
                        <tr>
                            <th>Dibuat Oleh</th>
                            <td><?= htmlspecialchars($d['dibuat_oleh']); ?></td>
                        </tr>

                        <tr>
                            <th>Terakhir Diubah</th>
                            <td><?= date('d-m-Y H:i', strtotime($d['updated_at'])); ?></td>
                        </tr>
                        <tr>
                            <th>Diubah Oleh</th>
                            <td><?= htmlspecialchars($d['diubah_oleh']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- HAPUS -->
    <div class="modal fade" id="hapus<?= $d['id_pelanggaran']; ?>">
        <div class="modal-dialog">
            <form method="post" class="modal-content">
                <input type="hidden" name="id_pelanggaran" value="<?= $d['id_pelanggaran']; ?>">
                <div class="modal-header bg-danger text-white">
                    <h5>Hapus Data</h5>
                </div>
                <div class="modal-body">Yakin hapus data?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" name="hapus">Hapus</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>

<hr>

<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">Statistik Jenis Pelanggaran</div>
        <div class="card-body">
            <?php if (!empty($chart_labels)): ?>
                <canvas id="chartPelanggaran"></canvas>
            <?php else: ?>
                <p class="text-muted text-center">Belum ada data.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include "../layout/footer.php"; ?>

<?php if (!empty($chart_labels)): ?>
    <script>
        new Chart(document.getElementById('chartPelanggaran'), {
            type: 'bar',
            data: {
                labels: <?= json_encode($chart_labels); ?>,
                datasets: [{
                    label: 'Jumlah Pelanggaran',
                    data: <?= json_encode($chart_totals); ?>,
                    backgroundColor: 'rgba(54,162,235,0.7)'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
<?php endif; ?>