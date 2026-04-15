<?php
include '../config/koneksi.php';
include '../layout/header.php';

$id_eskul = $_GET['id_eskul'] ?? null;
if (!$id_eskul) {
    echo "<script>
            alert('ID Eskul tidak ditemukan!');
            document.location.href = 's4-dsop3.php';
          </script>";
    exit;
}

$eskul = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM eskul WHERE id_eskul = '$id_eskul'"));
$jadwal = mysqli_query($db, "SELECT je.*, ak1.nama AS dibuat_oleh, ak2.nama AS diubah_oleh FROM jadwal_eskul je 
LEFT JOIN akun ak1 ON je.created_by = ak1.id_akun
LEFT JOIN akun ak2 ON je.updated_by = ak2.id_akun
WHERE id_eskul = '$id_eskul'
ORDER BY tanggal ASC, waktu_mulai ASC");

// Tambah jadwal
if (isset($_POST['tambah'])) {
    if (create_jadwal_eskul($_POST) > 0) {
        echo "<script>
                alert('Jadwal berhasil ditambahkan!');
                document.location.href = 'jadwal-eskul.php?id_eskul=$id_eskul';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan jadwal!');
              </script>";
    }
}

// Ubah jadwal
if (isset($_POST['ubah'])) {
    if (update_jadwal_eskul($_POST) > 0) {
        echo "<script>
                alert('Jadwal berhasil diubah!');
                document.location.href = 'jadwal-eskul.php?id_eskul=$id_eskul';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mengubah jadwal!');
              </script>";
    }
}

// Hapus jadwal
if (isset($_POST['hapus'])) {
    if (delete_jadwal_eskul($_POST) > 0) {
        echo "<script>
                alert('Jadwal berhasil dihapus!');
                document.location.href = 'jadwal-eskul.php?id_eskul=$id_eskul';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus jadwal!');
              </script>";
    }
}
?>

<div class="content-wrapper">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Jadwal Kumpul <?= $eskul['singkatan']; ?></h2>
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
        <hr>
        <a class="btn btn-primary tambah-btn" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah</a>

        <table id="serverside" class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                while ($row = mysqli_fetch_assoc($jadwal)) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['tanggal']) ?></td>
                        <td><?= htmlspecialchars($row['waktu_mulai']) ?> - <?= htmlspecialchars($row['waktu_selesai']) ?></td>
                        <td><?= htmlspecialchars($row['keterangan']) ?></td>
                        <td width="144">
                            <a class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $row['id_jadwal']; ?>"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $row['id_jadwal']; ?>"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row['id_jadwal']; ?>"><i class="fas fa-trash"></i></a>
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
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Tambah Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <input type="hidden" name="id_eskul" value="<?= $id_eskul ?>">
                    <div class="mb-3">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Jam Mulai</label>
                        <input type="time" name="waktu_mulai" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Jam Selesai</label>
                        <input type="time" name="waktu_selesai" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Tempat</label>
                        <input type="text" name="tempat" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit" name="tambah">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ubah -->
<?php
$jadwalUbah = mysqli_query($db, "SELECT * FROM jadwal_eskul WHERE id_eskul = '$id_eskul'");
while ($r = mysqli_fetch_assoc($jadwalUbah)) :
?>
    <div class="modal fade" id="modalUbah<?= $r['id_jadwal']; ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Ubah Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <input type="hidden" name="id_jadwal" value="<?= $r['id_jadwal']; ?>">
                        <input type="hidden" name="id_eskul" value="<?= $r['id_eskul']; ?>">
                        <div class="mb-3">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" value="<?= $r['tanggal']; ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Jam Mulai</label>
                            <input type="time" name="waktu_mulai" value="<?= $r['waktu_mulai']; ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Jam Selesai</label>
                            <input type="time" name="waktu_selesai" value="<?= $r['waktu_selesai']; ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Tempat</label>
                            <input type="text" name="tempat" value="<?= $r['tempat']; ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="2" required><?= $r['keterangan']; ?></textarea>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-success" type="submit" name="ubah">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>

<!-- Modal Hapus -->
<?php
$jadwalHapus = mysqli_query($db, "SELECT * FROM jadwal_eskul WHERE id_eskul = '$id_eskul'");
while ($h = mysqli_fetch_assoc($jadwalHapus)) :
?>
    <div class="modal fade" id="modalHapus<?= $h['id_jadwal']; ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Hapus Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus jadwal ini?</p>
                </div>
                <div class="modal-footer">
                    <form method="post">
                        <input type="hidden" name="id_jadwal" value="<?= $h['id_jadwal']; ?>">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>
<?php mysqli_data_seek($jadwal, 0); // reset pointer 
?>
<?php while ($r = mysqli_fetch_assoc($jadwal)) : ?>
    <div class="modal fade" id="modalDetail<?= $r['id_jadwal']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Detail Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Tanggal</th>
                            <td><?= htmlspecialchars($r['tanggal']); ?></td>
                        </tr>
                        <tr>
                            <th>Jam</th>
                            <td><?= htmlspecialchars($r['waktu_mulai']) ?> - <?= htmlspecialchars($r['waktu_selesai']) ?></td>
                        </tr>
                        <tr>
                            <th>Tempat</th>
                            <td><?= htmlspecialchars($r['tempat']); ?></td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td><?= htmlspecialchars($r['keterangan']); ?></td>
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