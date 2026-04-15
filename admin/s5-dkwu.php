<?php
include '../config/koneksi.php';
include '../layout/header.php';

// total produk
$total_produk = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS total FROM produk_osis"))['total'];

// total pemasukan
$pemasukan = mysqli_fetch_assoc(mysqli_query($db, "SELECT SUM(nominal) AS total FROM keuangan_osis WHERE jenis='Pemasukan'"))['total'] ?? 0;

// total pengeluaran
$pengeluaran = mysqli_fetch_assoc(mysqli_query($db, "SELECT SUM(nominal) AS total FROM keuangan_osis WHERE jenis='Pengeluaran'"))['total'] ?? 0;

// saldo akhir
$saldo = $pemasukan - $pengeluaran;
?>
<div class="content-wrapper">
    <div class="container mt-5 overflow-x-scroll">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Sekbid 5 – Data Kewirausahaan</h2>
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
        <hr>
        <div class="row text-center">
            <div class="col-md-3 mt-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5>Produk Aktif</h5>
                        <h2><?= $total_produk ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>Total Pemasukan</h5>
                        <h2>Rp <?= number_format($pemasukan, 0, ',', '.') ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5>Total Pengeluaran</h5>
                        <h2>Rp <?= number_format($pengeluaran, 0, ',', '.') ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="card bg-warning">
                    <div class="card-body">
                        <h5>Saldo Akhir</h5>
                        <h2>Rp <?= number_format($saldo, 0, ',', '.') ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="s5-data-produk.php" class="btn btn-primary m-1">Data Produk</a>
            <a href="s5-transaksi.php" class="btn btn-warning m-1">Transaksi</a>
            <a href="s5-keuangan.php" class="btn btn-success m-1">Keuangan</a>
        </div>
    </div>
</div>

<hr>

<script>
    const ctx = document.getElementById('chartKeuangan');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pemasukan', 'Pengeluaran', 'Saldo'],
            datasets: [{
                label: 'Rupiah',
                data: [<?= $pemasukan ?>, <?= $pengeluaran ?>, <?= $saldo ?>],
                backgroundColor: ['#28a745', '#dc3545', '#ffc107']
            }]
        }
    });
</script>
<?php
include '../layout/footer.php';
?>