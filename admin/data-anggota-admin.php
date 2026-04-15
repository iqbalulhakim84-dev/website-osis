<?php
session_start();
include '../layout/header.php';
// Menghubungkan ke database
include '../config/koneksi.php';
// Query untuk mengambil data anggota
$result = mysqli_query($db, "
    SELECT da.*, 
           ak1.nama AS dibuat_oleh,
           ak2.nama AS diubah_oleh
    FROM data_anggota da
    LEFT JOIN akun ak1 ON da.created_by = ak1.id_akun
    LEFT JOIN akun ak2 ON da.updated_by = ak2.id_akun
");


// Check if user is logged in
if (!isset($_SESSION['login'])) {
    echo "<script>
        alert('Silakan Login Terlebih Dahulu');
        document.location.href = 'login.php';
        </script>";
    exit;
}

// Check user access role
if ($_SESSION["role"] != 'Admin') {
    echo "<script>
        alert('Anda tidak memiliki hak akses');
        document.location.href = 'index.php';
        </script>";
    exit;
}

// jika tombol tambah di tekan jalankan script berikut
if (isset($_POST['tambah'])) {
    if (create_data_anggota($_POST) > 0) {
        echo "<script>
               alert('Data Berhasil Ditambahkan');
               document.location.href = 'data-anggota-admin.php';
               </script>";
    } else {
        echo "<script>
               alert('Data Gagal Ditambahkan');
               document.location.href = 'data-anggota-admin.php';
               </script>";
    }
}
// jika tombol ubah di tekan jalankan script berikut
if (isset($_POST['ubah'])) {
    if (update_data_anggota($_POST) > 0) {
        echo "<script>
               alert('Data Berhasil Diubahkan');
               document.location.href = 'data-anggota-admin.php';
               </script>";
    } else {
        echo "<script>
               alert('Data Gagal Diubahkan');
               document.location.href = 'data-anggota-admin.php';
               </script>";
    }
}
if (isset($_POST['hapus'])) {
    if (delete_data_anggota($_POST) > 0) {
        echo "<script>
               alert('Data Berhasil Dihapus');
               document.location.href = 'data-anggota-admin.php';
               </script>";
    } else {
        echo "<script>
               alert('Data Gagal Dihapus');
               document.location.href = 'data-anggota-admin.php';
               </script>";
    }
}

?>
<div class="content-wrapper">
    <div class="container mt-5 overflow-x-scroll">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Data Anggota OSIS</h2>
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
        <hr>
        <a class="btn btn-primary tambah-btn" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah</a>
        <table id="serverside" class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>JK</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td><?= htmlspecialchars($row['jk']); ?></td>
                        <td><?= htmlspecialchars($row['kelas']); ?></td>
                        <td><?= htmlspecialchars($row['jurusan']); ?></td>
                        <td width="144" class="text-center">
                            <a class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $row['id_anggota']; ?>">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn btn-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $row['id_anggota']; ?>">
                                <li class="fas fa-edit"></li>
                            </a>
                            <a class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row['id_anggota']; ?>">
                                <li class="fas fa-trash"></li>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Anggota..." required>
                    </div>

                    <div class="mb-3">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jk" name="jk" required>
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Kelas..." required>
                    </div>

                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Jurusan..." required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="no_tlp" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="no_tlp" name="no_tlp" placeholder="Nomor Telepon..." required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ubah -->
<?php foreach ($result as $r): ?>
    <div class="modal fade" id="modalUbah<?= $r['id_anggota']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_anggota" value="<?= htmlspecialchars($r['id_anggota']); ?>">

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Anggota</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($r['nama']); ?>" placeholder="Nama anggota..." required>
                        </div>

                        <div class="mb-3">
                            <label for="jk" class="form-label">Jenis Kelamin</label>
                            <select name="jk" id="jk" class="form-control" required>
                                <option value="">--Pilih Jenis Kelamin--</option>
                                <option value="Laki-Laki" <?= $r['jk'] === 'Laki-Laki' ? 'selected' : ''; ?>>Laki-Laki</option>
                                <option value="Perempuan" <?= $r['jk'] === 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas" value="<?= htmlspecialchars($r['kelas']); ?>" placeholder="Kelas..." required>
                        </div>

                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?= htmlspecialchars($r['jurusan']); ?>" placeholder="Jurusan..." required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= htmlspecialchars($r['alamat']); ?>" placeholder="Alamat..." required>
                        </div>

                        <div class="mb-3">
                            <label for="no_tlp" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" id="no_tlp" name="no_tlp" value="<?= htmlspecialchars($r['no_tlp']); ?>" placeholder="No Telepon..." required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Modal Hapus -->
<?php foreach ($result as $r): ?>
    <div class="modal fade" id="modalHapus<?= $r['id_anggota']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="" method="post" class="d-inline">
                        <input type="hidden" name="id_anggota" value="<?= $r['id_anggota']; ?>">
                        <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php mysqli_data_seek($result, 0); // reset pointer 
?>
<?php while ($r = mysqli_fetch_assoc($result)) : ?>
    <div class="modal fade" id="modalDetail<?= $r['id_anggota']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Detail Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama</th>
                            <td><?= htmlspecialchars($r['nama']); ?></td>
                        </tr>
                        <tr>
                            <th>JK</th>
                            <td><?= htmlspecialchars($r['jk']); ?></td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td><?= htmlspecialchars($r['kelas']); ?></td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td><?= htmlspecialchars($r['jurusan']); ?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><?= htmlspecialchars($r['alamat']); ?></td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td><?= htmlspecialchars($r['no_tlp']); ?></td>
                        </tr>

                        <tr>
                            <th>Dibuat Pada</th>
                            <td><?= date('d-m-Y H:i', strtotime($r['created_at'])); ?></td>
                        </tr>
                        <tr>
                            <th>Dibuat Oleh</th>
                            <td><?= htmlspecialchars($r['dibuat_oleh']); ?></td>
                        </tr>

                        <tr>
                            <th>Terakhir Diubah</th>
                            <td><?= date('d-m-Y H:i', strtotime($r['updated_at'])); ?></td>
                        </tr>
                        <tr>
                            <th>Diubah Oleh</th>
                            <td><?= htmlspecialchars($r['diubah_oleh']); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>

<hr>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Tambahkan CDN Chart.js -->
<style type="text/css">
    /* body {
        font-family: roboto;
    } */

    table {
        margin: 0px auto;
    }
</style>

<div class="overflow-x-scroll" style="width: 800px; margin: 0px auto;">
    <canvas id="myChart"></canvas> <!-- Elemen canvas untuk Chart.js -->
</div>

<br />
<hr>

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

<?php
include '../layout/footer.php'; ?>