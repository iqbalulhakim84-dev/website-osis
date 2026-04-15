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
    if (create_siswa($_POST) > 0) {
        echo "<script>
               alert('Data Berhasil Ditambahkan');
               document.location.href = 'data-siswa.php';
               </script>";
    } else {
        echo "<script>
               alert('Data Gagal Ditambahkan');
               document.location.href = 'data-siswa.php';
               </script>";
    }
}
// jika tombol ubah di tekan jalankan script berikut
if (isset($_POST['ubah'])) {
    if (update_siswa($_POST) > 0) {
        echo "<script>
               alert('Data Berhasil Diubahkan');
               document.location.href = 'data-siswa.php';
               </script>";
    } else {
        echo "<script>
               alert('Data Gagal Diubahkan');
               document.location.href = 'data-siswa.php';
               </script>";
    }
}
if (isset($_POST['hapus'])) {
    if (delete_siswa($_POST) > 0) {
        echo "<script>
               alert('Data Berhasil Dihapus');
               document.location.href = 'data-siswa.php';
               </script>";
    } else {
        echo "<script>
               alert('Data Gagal Dihapus');
               document.location.href = 'data-siswa.php';
               </script>";
    }
}

?>
<div class="content-wrapper">
    <div class="container mt-5 overflow-x-scroll">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Data Siswa</h2>
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
        <hr>
        <a class="btn btn-primary tambah-btn" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah</a>
        <table id="serverside" class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Poin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menghubungkan ke database
                include '../config/koneksi.php';
                // Query untuk mengambil data anggota
                $result = mysqli_query($db, "
                SELECT s.*, k.nama_kelas, ak1.nama AS dibuat_oleh, ak2.nama AS diubah_oleh 
                FROM siswa s
                JOIN kelas k ON k.id_kelas = s.id_kelas
                LEFT JOIN akun ak1 ON s.created_by = ak1.id_akun
                LEFT JOIN akun ak2 ON s.updated_by = ak2.id_akun
                ORDER BY id_kelas ASC");
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama_siswa']); ?></td>
                        <td><?= htmlspecialchars($row['nama_kelas']); ?></td>
                        <td><?= htmlspecialchars($row['poin']); ?></td>
                        <td width="144">
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin'): // Admin 
                            ?>
                                <a class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $row['id_siswa']; ?>"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $row['id_siswa']; ?>"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row['id_siswa']; ?>"><i class="fas fa-trash"></i></a>
                            <?php endif; ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <div class="mb-3">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" required>
                    </div>

                    <!-- Pilih Jenis Pelanggaran -->
                    <div class="mb-3">
                        <label for="id_kelas">Jenis Pelanggaran</label>
                        <select name="id_kelas" id="id_kelas" class="form-control" required>
                            <option value="">-- Pilih Kelas --</option>
                            <?php
                            $kelas = mysqli_query($db, "SELECT * FROM kelas ORDER BY nama_kelas ASC");
                            while ($k = mysqli_fetch_assoc($kelas)) :
                            ?>
                                <option value="<?= $k['id_kelas']; ?>"><?= $k['nama_kelas']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="poin">Poin</label>
                        <input type="number" name="poin" id="poin" class="form-control" required>
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
    <div class="modal fade" id="modalUbah<?= $r['id_siswa']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_siswa" value="<?= $r['id_siswa']; ?>">
                        <div class="mb-3">
                            <label for="nama_siswa">Nama Siswa</label>
                            <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" value="<?= htmlspecialchars($r['nama_siswa']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_kelas">Kelas</label>
                            <select name="id_kelas" id="id_kelas" class="form-control" required>
                                <?php
                                $kelas = select("SELECT * FROM kelas ORDER BY id_kelas ASC");
                                foreach ($kelas as $k) :
                                ?>
                                    <option value="<?= $k['id_kelas']; ?>" <?= $k['id_kelas'] == $r['id_kelas'] ? 'selected' : '' ?>>
                                        <?= $k['nama_kelas']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="poin">Poin</label>
                            <input type="number" name="poin" id="poin" class="form-control" value="<?= htmlspecialchars($r['poin']); ?>" required>
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
    <div class="modal fade" id="modalHapus<?= $r['id_siswa']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="hidden" name="id_siswa" value="<?= $r['id_siswa']; ?>">
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
    <div class="modal fade" id="modalDetail<?= $r['id_siswa']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Detail Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Siswa</th>
                            <td><?= htmlspecialchars($r['nama_siswa']); ?></td>
                        </tr>
                        <tr>
                            <th>Nama Kelas</th>
                            <td><?= htmlspecialchars($r['nama_kelas']); ?></td>
                        </tr>
                        <tr>
                            <th>Poin</th>
                            <td><?= htmlspecialchars($r['poin']); ?></td>
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