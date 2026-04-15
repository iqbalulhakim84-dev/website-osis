<?php
session_start();
include 'layout/header.php';
?>
<div class="content-wrapper">
    <div class="container mt-5 overflow-x-scroll">
        <h2>Data Organisasi Luar</h2>
        <hr>
        <table id="serverside" class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Nama Organisasi</th>
                    <th>Jabatan</th>
                    <th>Asal Sekolah</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menghubungkan ke database
                include 'config/koneksi.php';

                // Query untuk mengambil data anggota
                $query = "SELECT * FROM data_organisasi_luar";
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
                        <td><?= htmlspecialchars($row['nama_anggota']); ?></td>
                        <td><?= htmlspecialchars($row['nama_organisasi']); ?></td>
                        <td><?= htmlspecialchars($row['jabatan']); ?></td>
                        <td><?= htmlspecialchars($row['asal_sekolah']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'layout/footer.php'; ?>