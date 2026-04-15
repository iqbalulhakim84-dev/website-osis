<?php 
include "layout/header.php";
include 'config/koneksi.php';
$result = mysqli_query($db, "SELECT * FROM galeri");
?>
<div class="container-fluid text-center mt-0 my-4 py-3" style="background-color: #ecccccff; height: auto;">
    <div class="row">
        <div class="col-12">
            <h2 class="display-4">GALERY</h2>
            <p class="lead">Dokumentasi Kegiatan OSIS SMK PGRI 1 CIMAHI</p>
        </div>
    </div>
</div>
<div class="container mt-5 my-4">
    <h5>GALERY</h5>
    <h2>KEGIATAN OSIS</h2>
    <p> Beberapa kegiatan OSIS SMK PGRI 1 CIMAHI yang berjalan setiap tahunnya</p>
</div>
<div class="container">
    <div class="row" style="margin-top: 20px;">
        <?php
        $no = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            if ($no % 3 == 0) echo '<div class="row g-4 justify-content-center px-5" style="margin-top: 20px;">';
        ?>
            <div class="col-md-4 text-center">
                <div class="card mb-4 animate__animated animate__fadeInUp">
                    <img src="image/galeri/<?= htmlspecialchars($row['gambar']); ?>" class="card-img-top" alt="<?= htmlspecialchars($row['judul']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['judul']); ?></h5>
                        <p class="card-text"><?= htmlspecialchars($row['deskripsi']); ?></p>
                    </div>
                </div>
            </div>

        <?php
            $no++;
            if ($no % 3 == 0) echo '</div>';
        }
        if ($no % 3 != 0) echo '</div>'; // tutup row terakhir kalau belum ketutup
        ?>
    </div>
</div>
<hr>
<?php include 'layout/footer.php'; ?>