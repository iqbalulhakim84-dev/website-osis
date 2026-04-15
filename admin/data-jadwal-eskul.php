<?php
include '../config/koneksi.php';
include '../layout/header.php';
$id_eskul = $_GET['id'];
$eskul = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM eskul WHERE id_eskul = '$id_eskul'"));
$jadwal = mysqli_query($db, "SELECT je.*, ak1.nama AS dibuat_oleh, ak2.nama AS diubah_oleh FROM jadwal_eskul je 
LEFT JOIN akun ak1 ON hq.created_by = ak1.id_akun
LEFT JOIN akun ak2 ON hq.updated_by = ak2.id_akun
WHERE id_eskul = '$id_eskul'");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Jadwal - <?= $eskul['nama_eskul'] ?></title>
    <link href="../assets/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h3>Jadwal Kegiatan <?= $eskul['nama_eskul'] ?></h3>
        <a href="index.php" class="btn btn-secondary btn-sm mb-3">← Kembali</a>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Hari</th>
                    <th>Waktu</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                while ($row = mysqli_fetch_assoc($jadwal)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['hari'] ?></td>
                        <td><?= date('H:i', strtotime($row['waktu_mulai'])) ?> - <?= date('H:i', strtotime($row['waktu_selesai'])) ?></td>
                        <td><?= $row['lokasi'] ?></td>
                        <td><?= $row['keterangan'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
<?php 
include '../layout/footer.php'
?>
</html>