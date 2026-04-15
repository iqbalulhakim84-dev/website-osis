<?php
session_start();
include '../config/koneksi.php';

// Ambil semua data acara
$result = $db->query("SELECT a.*, ak1.nama AS dibuat_oleh, ak2.nama AS diubah_oleh FROM acara a 
                    LEFT JOIN akun ak1 ON a.created_by = ak1.id_akun
                    LEFT JOIN akun ak2 ON a.updated_by = ak2.id_akun ORDER BY id_acara DESC");

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

// ---- Tambah Acara ----
if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $tempat = $_POST['tempat'];
    $created_by = $_SESSION['id_akun'];

    // Upload gambar
    $gambar = null;
    if (!empty($_FILES['gambar']['name'])) {
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $namaFile = "acara_" . time() . "." . $ext;
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../image/acara/" . $namaFile);
        $gambar = $namaFile;
    }

    $stmt = $db->prepare("INSERT INTO acara (judul, deskripsi, tanggal, jam, tempat, gambar, created_by) VALUES (?, ?, ?,?,?,?,?)");
    $stmt->bind_param("sssssss", $judul, $deskripsi, $tanggal, $jam, $tempat, $gambar, $created_by);
    $stmt->execute();
    header("Location: data-acara-admin.php");
    exit;
}

// ---- Edit Acara ----
if (isset($_POST['edit'])) {
    $id = $_POST['id_acara'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $tempat = $_POST['tempat'];
    $updated_by = $_SESSION['id_akun'];

    $gambar = $_POST['gambar_lama'];
    if (!empty($_FILES['gambar']['name'])) {
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $namaFile = "acara_" . time() . "." . $ext;
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../image/acara/" . $namaFile);
        $gambar = $namaFile;
    }

    $stmt = $db->prepare("UPDATE acara SET judul=?, deskripsi=?, tanggal=?, jam=?, tempat=?, gambar=?, updated_by=? WHERE id_acara=?");
    $stmt->bind_param("sssssssi", $judul, $deskripsi, $tanggal, $jam, $tempat, $gambar, $updated_by, $id);
    $stmt->execute();
    header("Location: data-acara-admin.php");
    exit;
}

// ---- Hapus Acara ----
if (isset($_POST['hapus'])) {
    $id = $_POST['id_acara'];
    $stmt = $db->prepare("DELETE FROM acara WHERE id_acara=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: data-acara-admin.php");
    exit;
}

include '../layout/header.php';
?>
<div class="content-wrapper">
    <div class="container mt-5 overflow-x-scroll">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Manajemen Acara OSIS</h2>
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
        <hr>

        <!-- Tombol Tambah -->
        <a class="btn btn-primary tambah-btn" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah</a>

        <!-- Tabel -->
        <table id="serverside" class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['judul']); ?></td>
                        <td><?= date("d-m-Y", strtotime($row['tanggal'])); ?></td>
                        <td width="144">
                            <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $row['id_acara']; ?>"><i class="fas fa-eye"></i></a> |
                            <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id_acara']; ?>"><i class="fas fa-edit"></i></a> |
                            <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row['id_acara']; ?>"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit<?= $row['id_acara']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title">Edit Acara</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id_acara" value="<?= $row['id_acara']; ?>">
                                        <div class="mb-3">
                                            <label>Judul</label>
                                            <input type="text" name="judul" class="form-control" value="<?= $row['judul']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control" required><?= $row['deskripsi']; ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label>Tanggal</label>
                                            <input type="date" name="tanggal" class="form-control" value="<?= $row['tanggal']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Jam</label>
                                            <input type="text" name="jam" class="form-control" value="<?= $row['jam']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Tempat</label>
                                            <input type="text" name="tempat" class="form-control" value="<?= $row['tempat']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Gambar</label>
                                            <input type="file" name="gambar" class="form-control">
                                            <input type="hidden" name="gambar_lama" value="<?= $row['gambar']; ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" name="edit" class="btn btn-success">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Hapus -->
                    <div class="modal fade" id="modalHapus<?= $row['id_acara']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Hapus Acara</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin menghapus acara <b><?= $row['judul']; ?></b>?
                                        <input type="hidden" name="id_acara" value="<?= $row['id_acara']; ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Tambah Acara</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Jam</label>
                            <input type="text" name="jam" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Tempat</label>
                            <input type="text" name="tempat" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php mysqli_data_seek($result, 0); // reset pointer 
?>
<?php while ($r = mysqli_fetch_assoc($result)) : ?>
    <div class="modal fade" id="modalDetail<?= $r['id_acara']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Detail Acara</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Judul</th>
                            <td><?= htmlspecialchars($r['judul']); ?></td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td><?= htmlspecialchars($r['deskripsi']); ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><?= date("d-m-Y", strtotime($r['tanggal'])); ?></td>
                        </tr>
                        <tr>
                            <th>Jam</th>
                            <td><?= htmlspecialchars($r['jam']); ?></td>
                        </tr>
                        <tr>
                            <th>Tempat</th>
                            <td><?= htmlspecialchars($r['tempat']); ?></td>
                        </tr>
                        <tr>
                            <th>Gambar</th>
                            <td>
                                <?php if ($r['gambar']): ?>
                                    <img src="../image/acara/<?= $r['gambar']; ?>" width="320">
                                <?php endif; ?>
                            </td>
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
include '../layout/footer.php';
?>