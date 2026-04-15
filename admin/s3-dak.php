<?php
include '../config/koneksi.php';

// ---- Tambah Acara ----
if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $tempat = $_POST['tempat'];

    // Upload gambar
    $gambar = null;
    if (!empty($_FILES['gambar']['name'])) {
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $namaFile = "acara_" . time() . "." . $ext;
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../image/acara/" . $namaFile);
        $gambar = $namaFile;
    }

    $stmt = $db->prepare("INSERT INTO acara (judul, deskripsi, tanggal, jam, tempat, gambar) VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("ssssss", $judul, $deskripsi, $tanggal, $jam, $tempat, $gambar);
    $stmt->execute();
    header("Location: acara.php");
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

    $gambar = $_POST['gambar_lama'];
    if (!empty($_FILES['gambar']['name'])) {
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $namaFile = "acara_" . time() . "." . $ext;
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../image/acara/" . $namaFile);
        $gambar = $namaFile;
    }

    $stmt = $db->prepare("UPDATE acara SET judul=?, deskripsi=?, tanggal=?, jam=?, tempat=?, gambar=? WHERE id_acara=?");
    $stmt->bind_param("ssssssi", $judul, $deskripsi, $tanggal, $jam, $tempat, $gambar, $id);
    $stmt->execute();
    header("Location: acara.php");
    exit;
}

// ---- Hapus Acara ----
if (isset($_POST['hapus'])) {
    $id = $_POST['id_acara'];
    $stmt = $db->prepare("DELETE FROM acara WHERE id_acara=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: acara.php");
    exit;
}

// Ambil semua data acara
$result = $db->query("SELECT * FROM acara ORDER BY id_acara DESC");

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
        <a class="btn btn-primary tambah-btn mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah</a>

        <!-- Tabel -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th width="20">Jam</th>
                    <th>Tempat</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['judul']); ?></td>
                        <td><?= $row['deskripsi']; ?></td>
                        <td><?= date("d-m-Y", strtotime($row['tanggal'])); ?></td>
                        <td><?= $row['jam']; ?></td>
                        <td><?= $row['tempat']; ?></td>
                        <td>
                            <?php if ($row['gambar']): ?>
                                <img src="../image/acara/<?= $row['gambar']; ?>" width="80">
                            <?php endif; ?>
                        </td>
                        <td width="96">
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
<?php
include '../layout/footer.php';
?>