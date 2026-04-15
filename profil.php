<?php include 'layout/header.php';
$visi = mysqli_query($db, "SELECT * FROM visi_misi WHERE jenis='visi' AND status=1");

// Query Misi
$misi = mysqli_query($db, "SELECT * FROM visi_misi WHERE jenis='misi' AND status=1");
$struktur = mysqli_query($db, "SELECT * FROM struktur_osis WHERE status=1 ORDER BY urutan ASC");
?>
<div class="container-fluid d-flex justify-content-center align-items-center">
    <img src="image/osiskita.png" class="d-block w-100 animate__animated animate__fadeIn" alt="osiskita" style="width: 200px; height: auto;">
</div>
<div class="container mt-5 text-center">
    <h5>OSIS PRIONECI</h5>
    <h2>Visi dan Misi tahun 2023/2025</h2>
</div>
<div class="container mt-4 text-center">
    <p>Bersama, Kita Wujudkan Perubahan!</p>
</div>
<div class="container my-5">
    <div class="row">
        <!-- Visi Section -->
        <div class="col-12 col-md-6 mb-4">
            <div class="card shadow-sm" style="background-color: #ECDFCC; color: #1E201E;">
                <div class="card-body">
                    <h3 class="card-title text-center">VISI</h3>
                    <?php while ($row = mysqli_fetch_assoc($visi)) : ?>
                        <li class="list-group-item" style="background-color: #add8e6; color: #1E201E;">
                            <?= $row['isi']; ?>
                        </li>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
        <!-- Misi Section -->
        <div class="col-12 col-md-6 mb-4">
            <div class="card shadow-sm" style="background-color: #ECDFCC; color: #1E201E;">
                <div class="card-body">
                    <h3 class="card-title text-center">Misi</h3>
                    <ul class="list-group list-group-flush">
                        <?php while ($row = mysqli_fetch_assoc($misi)) : ?>
                            <li class="list-group-item" style="background-color: #add8e6; color: #1E201E;">
                                <?= $row['isi']; ?>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery Section -->
    <div class="container my-5">
        <h2 class="text-center">Struktur OSIS SMK PGRI 1 Cimahi</h2>
        <div class="row d-flex justify-content-center">
            <?php while ($row = mysqli_fetch_assoc($struktur)) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="image/<?= $row['gambar']; ?>" class="card-img-top" alt="<?= $row['jabatan']; ?>">
                        <div class="card-body text-center">
                            <p class="card-text"><?= $row['jabatan']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<?php include 'layout/footer.php'; ?>