<?php
session_start();
include '../layout/header.php';

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
    if (create_data_kegiatan_event($_POST) > 0) {
        echo "<script>
               alert('Data Berhasil Ditambahkan');
               document.location.href = 'data-kegiatan-event-admin.php';
               </script>";
    } else {
        echo "<script>
               alert('Data Gagal Ditambahkan');
               document.location.href = 'data-kegiatan-event-admin.php';
               </script>";
    }
}
// jika tombol ubah di tekan jalankan script berikut
if (isset($_POST['ubah'])) {
    if (update_data_kegiatan_event($_POST) > 0) {
        echo "<script>
               alert('Data Berhasil Diubahkan');
               document.location.href = 'data-kegiatan-event-admin.php';
               </script>";
    } else {
        echo "<script>
               alert('Data Gagal Diubahkan');
               document.location.href = 'data-kegiatan-event-admin.php';
               </script>";
    }
}
if (isset($_POST['hapus'])) {
    if (delete_data_kegiatan_event($_POST) > 0) {
        echo "<script>
               alert('Data Berhasil Dihapus');
               document.location.href = 'data-kegiatan-event-admin.php';
               </script>";
    } else {
        echo "<script>
               alert('Data Gagal Dihapus');
               document.location.href = 'data-kegiatan-event-admin.php';
               </script>";
    }
}

?>
<div class="content-wrapper">
    <div class="container mt-5 overflow-x-scroll">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Data Event Sekolah</h2>
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
        <hr>
        <a class="btn btn-primary tambah-btn" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah</a>
        <table id="serverside" class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Tanggal Kegiatan</th>
                    <th>Lokasi Kegiatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menghubungkan ke database
                include '../config/koneksi.php';

                // Query untuk mengambil data anggota
                $result = mysqli_query($db, "
                    SELECT dke.*, 
                        ak1.nama AS dibuat_oleh,
                        ak2.nama AS diubah_oleh
                    FROM data_kegiatan_event dke
                    LEFT JOIN akun ak1 ON dke.created_by = ak1.id_akun
                    LEFT JOIN akun ak2 ON dke.updated_by = ak2.id_akun
                    ORDER BY tanggal_kegiatan ASC
                ");

                // Cek apakah query berhasil
                if (!$result) {
                    die('Query gagal: ' . htmlspecialchars(mysqli_error($db)));
                }

                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama_kegiatan']); ?></td>
                        <td><?= htmlspecialchars($row['tanggal_kegiatan']); ?></td>
                        <td><?= htmlspecialchars($row['lokasi_kegiatan']); ?></td>
                        <td>
                            <a class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $row['id_kegiatan']; ?>">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn btn-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $row['id_kegiatan']; ?>">
                                <li class="fas fa-edit"></li>
                            </a>
                            <a class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row['id_kegiatan']; ?>">
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
                        <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                        <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" placeholder="Nama Kegiatan..." required>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                        <input type="date" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan" placeholder="Tanggal Kegiatan..." required>
                    </div>

                    <div class="mb-3">
                        <label for="lokasi_kegiatan" class="form-label">Lokasi Kegiatan</label>
                        <input type="text" class="form-control" id="lokasi_kegiatan" name="lokasi_kegiatan" placeholder="Lokasi Kegiatan..." required>
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
    <div class="modal fade" id="modalUbah<?= $r['id_kegiatan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_kegiatan" value="<?= htmlspecialchars($r['id_kegiatan']); ?>">

                        <div class="mb-3">
                            <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                            <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="<?= htmlspecialchars($r['nama_kegiatan']); ?>" placeholder="Nama Kegiatan..." required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                            <input type="date" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan" value="<?= htmlspecialchars($r['tanggal_kegiatan']); ?>" placeholder="Tanggal Kegiatan..." required>
                        </div>

                        <div class="mb-3">
                            <label for="lokasi_kegiatan" class="form-label">Lokasi Kegiatan</label>
                            <input type="text" class="form-control" id="lokasi_kegiatan" name="lokasi_kegiatan" value="<?= htmlspecialchars($r['lokasi_kegiatan']); ?>" placeholder="Lokasi Kegiatan..." required>
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
    <div class="modal fade" id="modalHapus<?= $r['id_kegiatan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="hidden" name="id_kegiatan" value="<?= $r['id_kegiatan']; ?>">
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
    <div class="modal fade" id="modalDetail<?= $r['id_kegiatan']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Detail Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Kegiatan</th>
                            <td><?= htmlspecialchars($r['nama_kegiatan']); ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Kegiatan</th>
                            <td><?= htmlspecialchars($r['tanggal_kegiatan']); ?></td>
                        </tr>
                        <tr>
                            <th>Lokasi Kegiatan</th>
                            <td><?= htmlspecialchars($r['lokasi_kegiatan']); ?></td>
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
<?php endwhile; 
include '../layout/footer.php'; ?>