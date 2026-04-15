<?php
include '../config/koneksi.php';
include '../layout/header.php';
$jadwal = mysqli_query($db, "SELECT * FROM jadwal_gabungan WHERE penyelenggara = 'OP3' ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Jadwal Gabungan OP3</title>
    <link href="../assets/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h3 class="mb-3 text-center">Jadwal Gabungan OP3</h3>
        <a href="index.php" class="btn btn-secondary btn-sm mb-3">← Kembali</a>

        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kegiatan</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                while ($row = mysqli_fetch_assoc($jadwal)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                        <td><?= $row['kegiatan'] ?></td>
                        <td><?= $row['lokasi'] ?></td>
                        <td><?= $row['keterangan'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
<?php 
include '../layout/footer.php';
?>
</html>