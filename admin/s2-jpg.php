<?php
include '../config/koneksi.php';
include '../layout/header.php';
$query = "SELECT * FROM jadwal_jaga_barisan ORDER BY tanggal DESC";
$result = mysqli_query($db, $query);
?>

<div class="content-wrapper">
    <div class="container mt-5 overflow-x-scroll">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Sekbid 2 – Jadwal Piket Gerbang</h2>
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
        <hr>
        <a href="s2-jpg-tambah.php" class="btn btn-primary mb-1"><i class="fas fa-plus-circle"></i> Tambah</a>

        <table id="serverside" class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($data = mysqli_fetch_assoc($result)) : ?>

                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= date('d-m-Y', strtotime($data['tanggal'])) ?></td>
                        <td><?= $data['keterangan']; ?></td>
                        <td>
                            <a href="s2-jpg-edit.php?id=<?= $data['id_tes'] ?> " class="btn btn-warning btn-sm">Edit</a>
                            <a href="s2-jpg-hapus.php?id=<?= $data["id_tes"] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?');">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include '../layout/footer.php';
?>