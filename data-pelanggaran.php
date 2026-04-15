<?php
include 'config/koneksi.php'; // file koneksi ke database
include "layout/header.php";


// Query data pelanggaran
$query = "SELECT * FROM pelanggaran_siswa ORDER BY tanggal DESC";
$result = mysqli_query($db, $query);

// Query statistik untuk grafik
$chartQuery = "SELECT jenis_pelanggaran, COUNT(*) as total FROM pelanggaran_siswa GROUP BY jenis_pelanggaran";
$chartResult = mysqli_query($db, $chartQuery);

$jenis_pelanggaran = [];
$total_pelanggaran = [];

while ($row = mysqli_fetch_assoc($chartResult)) {
    $jenis_pelanggaran[] = $row['jenis_pelanggaran'];
    $total_pelanggaran[] = $row['total'];
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggaran Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-light">

    <div class="container py-5">
        <!-- Bagian Judul dan Penjelasan -->
        <div class="text-center mb-5">
            <h1 class="fw-bold text-primary">Data Pelanggaran Siswa SMK PGRI 1</h1>
            <p class="text-muted">Halaman ini menampilkan data pelanggaran siswa berdasarkan jenis pelanggaran yang tercatat oleh pihak sekolah.</p>
            <img src="assets/img/pelanggaran.png" alt="Ilustrasi Pelanggaran" class="img-fluid rounded shadow-sm" style="max-width: 400px;">
        </div>

        <!-- Bagian Tabel -->
        <div class="card shadow mb-5">
            <div class="card-header bg-primary text-white fw-bold">
                Daftar Pelanggaran Siswa
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>No HP Orangtua</th>
                            <th>Jenis Pelanggaran</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($result)) {
                            echo "<tr class='text-center'>
                            <td>{$no}</td>
                            <td>{$data['nama_siswa']}</td>
                            <td>{$data['kelas']}</td>
                            <td>{$data['no_hp_orangtua']}</td>
                            <td>{$data['jenis_pelanggaran']}</td>
                            <td>{$data['tanggal']}</td>
                            <td>{$data['keterangan']}</td>
                        </tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bagian Grafik -->
        <div class="card shadow">
            <div class="card-header bg-success text-white fw-bold">
                Statistik Jenis Pelanggaran
            </div>
            <div class="card-body">
                <canvas id="chartPelanggaran" height="120"></canvas>
            </div>
        </div>
    </div>
    <?php
    include "layout/footer.php";
    ?>

    <script>
        const ctx = document.getElementById('chartPelanggaran');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($jenis_pelanggaran); ?>,
                datasets: [{
                    label: 'Jumlah Pelanggaran',
                    data: <?php echo json_encode($total_pelanggaran); ?>,
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ]
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>