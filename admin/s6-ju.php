<?php
include '../config/koneksi.php';
include '../layout/header.php';

// total jadwal
$total_jadwal = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS jml FROM jadwal_upacara"))['jml'];

// total Petugas
$total_petugas = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS jml FROM petugas_upacara"))['jml'];

// status minggu ini
$minggu_ini = mysqli_query($db, "SELECT * FROM jadwal_upacara WHERE WEEK(tanggal)=WEEK(CURDATE())");
$jadwal_minggu = mysqli_fetch_assoc($minggu_ini);
?>
<div class="content-wrapper">
    <div class="container mt-5 overflow-x-scroll">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Sekbid 6 – Jadwal Upacara</h2>
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
        <hr>
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card bg-primary text-white mb-3">
                    <div class="card-body">
                        <a href="s6-jadwal-upacara.php" class="text-decoration-none text-light">
                            <h5>Total Jadwal</h5>
                            <h2><?= $total_jadwal ?></h2>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <h5>Total Petugas</h5>
                        <h2><?= $total_petugas ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<?php
include '../layout/footer.php';
?>