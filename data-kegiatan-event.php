<?php
session_start();
include 'layout/header.php'; 
?>
<div class="content-wrapper">
    <div class="container mt-5 overflow-x-scroll">
        <h2>Data Event Sekolah</h2>
        <hr>
        <table id="serverside" class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Tanggal Kegiatan</th>
                    <th>Lokasi Kegiatan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menghubungkan ke database
                include 'config/koneksi.php';

                // Query untuk mengambil data anggota
                $query = "SELECT * FROM data_kegiatan_event";
                $result = mysqli_query($db, $query);

// Cek apakah query berhasil
if (!$result) {
die('Query gagal: ' . htmlspecialchars(mysqli_error($db)));
    }

$no = 1;
while ($row = mysqli_fetch_assoc($result)) :
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($row['nama_kegiatan']); ?></td>
        <td><?= htmlspecialchars($row['tanggal_kegiatan']); ?></td>
        <td><?= htmlspecialchars($row['lokasi_kegiatan']); ?></td>
    </tr>
             <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'layout/footer.php'; ?>
