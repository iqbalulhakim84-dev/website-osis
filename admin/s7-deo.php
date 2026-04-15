<?php
include '../config/koneksi.php'; // koneksi ke DB
include '../layout/header.php';
$query = "SELECT * FROM eskul WHERE kategori = 'Olahraga' ORDER BY eskul ASC";
$result = mysqli_query($db, $query);
?>
<div class="content-wrapper">
    <div class="container mt-5 overflow-x-scroll">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Sekbid 7 – Data Ekstrakurikuler Olahraga</h2>
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
        <hr>
        <div class="row justify-content-center align-items-center">
            <?php while ($eskul = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm">
                        <img src="../image/logo/<?= $eskul['logo'] ?: 'default.png' ?>" class="card-img-top" alt="<?= $eskul['eskul'] ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= $eskul['singkatan'] ?></h5>
                            <p class="text-muted"><?= $eskul['eskul'] ?></p>
                            <hr>
                            <p class="text-muted"><?= $eskul['pembina'] ?></p>
                            <a href="data-anggota-eskul.php?id_eskul=<?= $eskul['id_eskul'] ?>" class="btn btn-primary btn-sm">Anggota</a>
                            <a href="jadwal-eskul.php?id_eskul=<?= $eskul['id_eskul'] ?>" class="btn btn-outline-secondary btn-sm">Jadwal</a>
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