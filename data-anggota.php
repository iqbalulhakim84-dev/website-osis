<?php
session_start();
include 'layout/header.php';
?>
<div class="content-wrapper">
    <div class="container mt-5 overflow-x-scroll">
        <h2>Data Anggota</h2>
        <hr>
        <table id="serverside" class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>JK</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Telepon</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menghubungkan ke database
                include 'config/koneksi.php';
                // Query untuk mengambil data anggota
                $result = mysqli_query($db, "SELECT * FROM data_anggota");
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td><?= htmlspecialchars($row['jk']); ?></td>
                        <td><?= htmlspecialchars($row['kelas']); ?></td>
                        <td><?= htmlspecialchars($row['jurusan']); ?></td>
                        <td><?= htmlspecialchars($row['no_tlp']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'layout/footer.php'; ?>