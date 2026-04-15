<!DOCTYPE html>
<html>
<head>
    <title>Grafik Jumlah Anggota OSIS Berdasarkan Tingkatan dan Jenis Kelamin</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Tambahkan CDN Chart.js -->
</head>
<body>
    <style type="text/css">
    body {
        font-family: roboto;
    }
    table {
        margin: 0px auto;
    }
    </style>

    <center>
        <h2>Data Jumlah Anggota OSIS Berdasarkan Tingkatan dan Jenis Kelamin</h2>
    </center>

    <?php
    include 'config/app.php'; // Pastikan koneksi ke database sudah benar
    ?>

    <div style="width: 800px; margin: 0px auto;">
        <canvas id="myChart"></canvas> <!-- Elemen canvas untuk Chart.js -->
    </div>

    <br/><br/>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Jenis Kelamin</th>
                <th>Kelas</th>
                <th>Jurusan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $data = mysqli_query($db, "SELECT * FROM data_anggota");
            while ($d = mysqli_fetch_array($data)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $d['nama']; ?></td>
                    <td><?php echo $d['jk']; ?></td>
                    <td><?php echo $d['kelas']; ?></td>
                    <td><?php echo $d['jurusan']; ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

    <script>
    // Ambil context dari canvas
    var ctx = document.getElementById("myChart").getContext('2d');

    // Buat objek chart baru
    var myChart = new Chart(ctx, {
        type: 'bar', // Tipe chart: Bar chart
        data: {
            labels: ["Kelas X", "Kelas XI", "Kelas XII"], // Label untuk sumbu X
            datasets: [{
                label: 'Laki-laki',
                data: [
                    <?php
                    $jumlah_laki_x = mysqli_query($db, "SELECT * FROM data_anggota WHERE jk='laki-laki' AND kelas='X'");
                    echo mysqli_num_rows($jumlah_laki_x);
                    ?>,
                    <?php
                    $jumlah_laki_xi = mysqli_query($db, "SELECT * FROM data_anggota WHERE jk='laki-laki' AND kelas='XI'");
                    echo mysqli_num_rows($jumlah_laki_xi);
                    ?>,
                    <?php
                    $jumlah_laki_xii = mysqli_query($db, "SELECT * FROM data_anggota WHERE jk='laki-laki' AND kelas='XII'");
                    echo mysqli_num_rows($jumlah_laki_xii);
                    ?>
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Perempuan',
                data: [
                    <?php
                    $jumlah_perempuan_x = mysqli_query($db, "SELECT * FROM data_anggota WHERE jk='perempuan' AND kelas='X'");
                    echo mysqli_num_rows($jumlah_perempuan_x);
                    ?>,
                    <?php
                    $jumlah_perempuan_xi = mysqli_query($db, "SELECT * FROM data_anggota WHERE jk='perempuan' AND kelas='XI'");
                    echo mysqli_num_rows($jumlah_perempuan_xi);
                    ?>,
                    <?php
                    $jumlah_perempuan_xii = mysqli_query($db, "SELECT * FROM data_anggota WHERE jk='perempuan' AND kelas='XII'");
                    echo mysqli_num_rows($jumlah_perempuan_xii);
                    ?>
                ],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
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
