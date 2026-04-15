<?php
include '../config/koneksi.php';
include '../layout/header.php';
$info = mysqli_query($db, "SELECT * FROM informasi ORDER BY tanggal_post DESC");
?>
<div class="content-wrapper">
    <div class="container mt-5 overflow-x-scroll">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Sekbid 8 – Data Konten Informasi</h2>
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
        <hr>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($info)) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="../upload/olahraga/<?= $row['foto'] ?>" class="card-img-top" alt="<?= $row['judul'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['judul'] ?></h5>
                            <small class="text-muted"><?= $row['tanggal_post'] ?> | <?= $row['kategori'] ?></small>
                            <p class="card-text mt-2"><?= substr($row['isi'], 0, 100) ?>...</p>
                            <a href="detail.php?id=<?= $row['id_info'] ?>" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<?php
include '../layout/footer.php'
?>