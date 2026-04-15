<?php include 'layout/header.php';
$visi = mysqli_query($db, "SELECT * FROM visi_misi WHERE jenis='visi' AND status=1");

// Query Misi
$misi = mysqli_query($db, "SELECT * FROM visi_misi WHERE jenis='misi' AND status=1");
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
        <h3 class="text-center">Struktur OSIS SMK PGRI 1 Cimahi</h3>
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="image/ketua dan wakil.png" class="card-img-top" alt="ketua&wakil">
                    <div class="card-body">
                        <p class="card-text text-center">Ketua & Wakil ketua.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="image/sekretaris.png" class="card-img-top" alt="sekretaris">
                    <div class="card-body">
                        <p class="card-text text-center">Sekretaris.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="image/bendahara.png" class="card-img-top" alt="bendahara">
                    <div class="card-body">
                        <p class="card-text text-center">Bendahara.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container my-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="image/sekbid1.png" class="card-img-top" alt="sekbid1">
                <div class="card-body">
                    <p class="card-text">Seksi Bidang 1 Kerohanian</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="image/sekbid2.png" class="card-img-top" alt="sekbid2">
                <div class="card-body">
                    <p class="card-text">Seksi Bidang 2 Tata Krama.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="image/sekbid3.png" class="card-img-top" alt="sekbid3">
                <div class="card-body">
                    <p class="card-text">Seksi Bidang 3 Bela Negara.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container my-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="image/sekbid4.png" class="card-img-top" alt="sekbid4">
                <div class="card-body">
                    <p class="card-text">Seksi Bidang 4 OPPK.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="image/sekbid5.png" class="card-img-top" alt="sekbid5">
                <div class="card-body">
                    <p class="card-text">Seksi Bidang 5 KWU.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="image/sekbid6.png" class="card-img-top" alt="sekbid6">
                <div class="card-body">
                    <p class="card-text">Seksi Bidang 6 Kehidupan Berbangsa & Bernegara.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container my-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="image/sekbid7.png" class="card-img-top" alt="sekbid7">
                <div class="card-body">
                    <p class="card-text">Seksi Bidang 7 Kesehatan & Daya Kreatif.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="image/sekbid8.png" class="card-img-top" alt="sekbid8">
                <div class="card-body">
                    <p class="card-text">Seksi Bidang 8 Apresiasi Seni & Kreasi.</p>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include 'layout/footer.php'; ?>