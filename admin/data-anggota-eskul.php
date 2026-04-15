<?php
include '../config/koneksi.php';
include '../layout/header.php';
$id_eskul = $_GET['id_eskul'];
$eskul = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM eskul WHERE id_eskul = '$id_eskul'"));
$anggota = mysqli_query($db, "
SELECT ae.*, s.nama_siswa, k.nama_kelas, ak1.nama AS dibuat_oleh, ak2.nama AS diubah_oleh
FROM anggota_eskul ae 
JOIN siswa s ON s.id_siswa = ae.id_siswa
LEFT JOIN kelas k ON s.id_kelas = k.id_kelas
LEFT JOIN akun ak1 ON ae.created_by = ak1.id_akun
LEFT JOIN akun ak2 ON ae.updated_by = ak2.id_akun
WHERE id_eskul = '$id_eskul'");

// jika tombol tambah di tekan jalankan script berikut
if (isset($_POST['tambah'])) {
    if (create_data_anggota_eskul($_POST) > 0) {
        echo "<script>
               alert('Data Berhasil Ditambahkan');
               document.location.href = 'data-anggota-eskul.php?id_eskul={$id_eskul}';
               </script>";
    } else {
        echo "<script>
               alert('Data Gagal Ditambahkan');
               document.location.href = 'data-anggota-eskul.php?id_eskul={$id_eskul}';
               </script>";
    }
}
// jika tombol ubah di tekan jalankan script berikut
if (isset($_POST['ubah'])) {
    if (update_data_anggota_eskul($_POST) > 0) {
        echo "<script>
               alert('Data Berhasil Diubahkan');
               document.location.href = 'data-anggota-eskul.php?id_eskul={$id_eskul}';
               </script>";
    } else {
        echo "<script>
               alert('Data Gagal Diubahkan');
               document.location.href = 'data-anggota-eskul.php?id_eskul={$id_eskul}';
               </script>";
    }
}
if (isset($_POST['hapus'])) {
    if (delete_data_anggota_eskul($_POST) > 0) {
        echo "<script>
               alert('Data Berhasil Dihapus');
               document.location.href = 'data-anggota-eskul.php?id_eskul={$id_eskul}';
               </script>";
    } else {
        echo "<script>
               alert('Data Gagal Dihapus');
               document.location.href = 'data-anggota-eskul.php?id_eskul={$id_eskul}';
               </script>";
    }
}
?>
<div class="content-wrapper">
    <div class="container mt-5 overflow-x-scroll">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Data Anggota <?= $eskul['singkatan']; ?></h2>
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
        <hr>
        <a class="btn btn-primary tambah-btn" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah</a>

        <table id="serverside" class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                while ($row = mysqli_fetch_assoc($anggota)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama_siswa'] ?></td>
                        <td><?= $row['jabatan'] ?></td>
                        <td width="144">
                            <a class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $row['id_anggota_eskul']; ?>"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $row['id_anggota_eskul']; ?>"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row['id_anggota_eskul']; ?>"><i class="fas fa-trash"></i></a>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Anggota Eskul</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="id_eskul" value="<?= $id_eskul; ?>">

                    <!-- Nama Siswa -->
                    <div class="mb-3">
                        <label for="id_siswa">Nama Siswa</label>
                        <select name="id_siswa" id="id_siswa" class="form-control" required>
                            <option value="">-- Pilih Siswa --</option>
                            <?php
                            $siswaQuery = mysqli_query($db, "
                            SELECT s.*, k.nama_kelas
                            FROM siswa s
                            JOIN kelas k ON k.id_kelas = s.id_kelas
                            ORDER BY nama_siswa ASC");
                            while ($s = mysqli_fetch_assoc($siswaQuery)) {
                                echo "<option value='{$s['id_siswa']}' data-kelas='{$s['nama_kelas']}'>{$s['nama_siswa']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Kelas otomatis -->
                    <div class="mb-3">
                        <label for="nama_kelas">Kelas</label>
                        <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" readonly>
                    </div>

                    <!-- Jabatan -->
                    <div class="mb-3">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" name="jabatan" id="jabatan" class="form-control" required>
                    </div>

                    <!-- Kontak -->
                    <div class="mb-3">
                        <label for="no_hp">Kontak</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control" required>
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

<script>
    // Saat siswa dipilih, tampilkan kelasnya otomatis
    document.getElementById('id_siswa').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const nama_kelas = selectedOption.getAttribute('data-kelas');
        document.getElementById('nama_kelas').value = nama_kelas || '';
    });
</script>

<!-- Modal Ubah -->
<?php foreach ($anggota as $a): ?>
    <div class="modal fade" id="modalUbah<?= $a['id_anggota_eskul']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_anggota_eskul" value="<?= $a['id_anggota_eskul']; ?>">
                        <input type="hidden" name="id_eskul" value="<?= $a['id_eskul']; ?>">
                        <div class="mb-3">
                            <label for="id_siswa">Nama Siswa</label>
                            <select name="id_siswa" id="id_siswa" class="form-control" required>
                                <?php
                                $siswa = select("SELECT s.*, k.nama_kelas FROM siswa s JOIN kelas k ON s.id_kelas = k.id_kelas ORDER BY id_siswa ASC");
                                foreach ($siswa as $s) :
                                ?>
                                    <option value="<?= $s['id_siswa']; ?>" <?= $s['id_siswa'] == $a['id_siswa'] ? 'selected' : '' ?>>
                                        <?= $s['nama_siswa']; ?> (<?= $s['nama_kelas']; ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Jabatan -->
                        <div class="mb-3">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control" value="<?= $a['jabatan']; ?>" required>
                        </div>

                        <!-- Kontak -->
                        <div class="mb-3">
                            <label for="no_hp">Kontak</label>
                            <input type="text" name="no_hp" id="no_hp" class="form-control" value="<?= $a['no_hp']; ?>" required>
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
<?php foreach ($anggota as $a): ?>
    <div class="modal fade" id="modalHapus<?= $a['id_anggota_eskul']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="hidden" name="id_anggota_eskul" value="<?= $a['id_anggota_eskul']; ?>">
                        <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php mysqli_data_seek($anggota, 0); // reset pointer 
?>
<?php while ($r = mysqli_fetch_assoc($anggota)) : ?>
    <div class="modal fade" id="modalDetail<?= $r['id_anggota_eskul']; ?>" tabindex="-1">
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
                            <td><?= htmlspecialchars($r['nama_siswa']); ?></td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td><?= htmlspecialchars($r['jabatan']); ?></td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td><?= htmlspecialchars($r['nama_kelas']); ?></td>
                        </tr>
                        <tr>
                            <th>Kontak</th>
                            <td><?= htmlspecialchars($r['no_hp']); ?></td>
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