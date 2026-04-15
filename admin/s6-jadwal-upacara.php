<?php
include '../config/koneksi.php';
include '../layout/header.php';

// Ambil semua jadwal upacara
$jadwal = mysqli_query($db, "
    SELECT j.*, k.nama_kelas, ak1.nama AS dibuat_oleh, ak2.nama AS diubah_oleh
    FROM jadwal_upacara j
    LEFT JOIN kelas k ON j.id_kelas = k.id_kelas
    LEFT JOIN akun ak1 ON j.created_by = ak1.id_akun
    LEFT JOIN akun ak2 ON j.updated_by = ak2.id_akun
    ORDER BY j.tanggal DESC
");

// Tambah data jadwal
if (isset($_POST['tambah'])) {
    if (create_jadwal_upacara($_POST) > 0) {
        echo "<script>alert('Jadwal Ditambahkan!'); location.href='s6-jadwal-upacara.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah Jadwal!');</script>";
    }
}

// Tambah data jadwal
if (isset($_POST['ubah'])) {
    if (update_jadwal_upacara($_POST) > 0) {
        echo "<script>alert('Jadwal Diubah!'); location.href='s6-jadwal-upacara.php';</script>";
    } else {
        echo "<script>alert('Gagal Mengubah Jadwal!');</script>";
    }
}

// Hapus data jadwal
if (isset($_POST['hapus'])) {
    if (delete_jadwal_upacara($_POST) > 0) {
        echo "<script>alert('Jadwal berhasil dihapus!'); document.location.href='s6-jadwal-upacara.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus Jadwal!');</script>";
    }
}
?>
<div class="content-wrapper">
    <div class="container mt-5 overflow-x-scroll">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Jadwal Upacara</h2>
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
        <hr>
        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="fas fa-plus-circle"></i> Tambah Jadwal
        </a>

        <table id="serverside" class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th width="24">No</th>
                    <th>Tanggal</th>
                    <th>Petugas</th>
                    <th>Pembina</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                while ($row = mysqli_fetch_assoc($jadwal)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
                        <td><?= $row['jenis_petugas'] == 'op3' ? 'OP3' : $row['nama_kelas']; ?></td>
                        <td><?= $row['pembina_upacara']; ?></td>
                        <td width="160">
                            <a href="s6-petugas-upacara.php?id_jadwal=<?= $row['id_jadwal'] ?>" class="btn btn-warning btn-sm mb-1"><i class="fas fa-user-tie"></i></a>
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
                <h5 class="modal-title">Tambah Jadwal Upacara</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <!-- Pilih tanggal -->
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal Upacara</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                    </div>

                    <!-- Pilih jenis petugas -->
                    <div class="mb-3">
                        <label class="form-label">Jenis Petugas</label>
                        <select name="jenis_petugas" id="jenis_petugas_tambah" class="form-control" required>
                            <option value="">-- Pilih Jenis Petugas --</option>
                            <option value="kelas">Kelas</option>
                            <option value="op3">Gabungan OP3</option>
                        </select>
                    </div>

                    <!-- Pilihan kelas -->
                    <div class="mb-3" id="kelas_tambah" style="display:none;">
                        <label for="id_kelas" class="form-label">Kelas Petugas</label>
                        <select name="id_kelas" id="id_kelas" class="form-control">
                            <option value="">-- Pilih Kelas --</option>
                            <?php
                            $kelas = mysqli_query($db, "SELECT * FROM kelas ORDER BY nama_kelas ASC");
                            while ($k = mysqli_fetch_assoc($kelas)) {
                                echo "<option value='{$k['id_kelas']}'>{$k['nama_kelas']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Info OP3 -->
                    <div class="mb-3" id="op3_tambah" style="display:none;">
                        <div class="alert alert-info">
                            Petugas dari <b>OP3</b> terdiri dari anggota OSIS, Paskibra, PMR, dan Pramuka.
                        </div>
                    </div>

                    <!-- Tema -->
                    <div class="mb-3">
                        <label for="tema" class="form-label">Tema Upacara</label>
                        <input type="text" name="tema" id="tema" class="form-control" placeholder="Contoh: Hari Pahlawan" required>
                    </div>

                    <!-- Pembina -->
                    <div class="mb-3">
                        <label for="pembina_upacara" class="form-label">Pembina Upacara</label>
                        <input type="text" name="pembina_upacara" id="pembina_upacara" class="form-control" placeholder="Nama Pembina Upacara" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan">Keterangan</label>
                        <select name="keterangan" id="keterangan" class="form-control" required>
                            <option value="">-- Keterangan --</option>
                            <option value="Terjadwal">Terjadwal</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Dibatalkan">Dibatalkan</option>
                        </select>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ubah -->
<?php
mysqli_data_seek($jadwal, 0);
while ($r = mysqli_fetch_assoc($jadwal)):
?>
    <div class="modal fade" id="modalUbah<?= $r['id_jadwal'] ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Ubah Jadwal Upacara</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form method="post">
                    <input type="hidden" name="id_jadwal" value="<?= $r['id_jadwal'] ?>">

                    <div class="modal-body">

                        <!-- Tanggal -->
                        <div class="mb-3">
                            <label>Tanggal Upacara</label>
                            <input type="date" name="tanggal" class="form-control"
                                value="<?= $r['tanggal'] ?>" required>
                        </div>

                        <!-- Jenis Petugas -->
                        <div class="mb-3">
                            <label>Jenis Petugas</label>
                            <select name="jenis_petugas"
                                class="form-control jenis-petugas-edit"
                                data-id="<?= $r['id_jadwal'] ?>"
                                required>
                                <option value="" disabled>-- Pilih --</option>
                                <option value="kelas" <?= $r['jenis_petugas'] == 'kelas' ? 'selected' : '' ?>>Kelas</option>
                                <option value="op3" <?= $r['jenis_petugas'] == 'op3' ? 'selected' : '' ?>>OP3</option>
                            </select>
                        </div>

                        <!-- Kelas -->
                        <div class="mb-3 kelas-wrapper"
                            id="kelas_edit_<?= $r['id_jadwal'] ?>"
                            style="<?= $r['jenis_petugas'] == 'kelas' ? '' : 'display:none;' ?>">
                            <label>Kelas Petugas</label>
                            <select name="id_kelas" class="form-control">
                                <option value="" disabled>-- Pilih Kelas --</option>
                                <?php
                                $kelas = mysqli_query($db, "SELECT * FROM kelas ORDER BY nama_kelas ASC");
                                while ($k = mysqli_fetch_assoc($kelas)):
                                ?>
                                    <option value="<?= $k['id_kelas'] ?>"
                                        <?= $k['id_kelas'] == $r['id_kelas'] ? 'selected' : '' ?>>
                                        <?= $k['nama_kelas'] ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <!-- OP3 -->
                        <div class="mb-3 op3-wrapper"
                            id="op3_edit_<?= $r['id_jadwal'] ?>"
                            style="<?= $r['jenis_petugas'] == 'op3' ? '' : 'display:none;' ?>">
                            <div class="alert alert-info">
                                Petugas OP3 terdiri dari OSIS, Paskibra, PMR, dan Pramuka.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Tema Upacara</label>
                            <input type="text" name="tema" class="form-control"
                                value="<?= htmlspecialchars($r['tema']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>Pembina Upacara</label>
                            <input type="text" name="pembina_upacara" class="form-control"
                                value="<?= htmlspecialchars($r['pembina_upacara']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>Status Jadwal</label>
                            <select name="keterangan" class="form-control" required>
                                <option value="Terjadwal" <?= $r['keterangan'] == 'Terjadwal' ? 'selected' : '' ?>>Terjadwal</option>
                                <option value="Selesai" <?= $r['keterangan'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                <option value="Dibatalkan" <?= $r['keterangan'] == 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                            </select>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" name="ubah" class="btn btn-success">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
<?php endwhile; ?>

<!-- Modal Hapus -->
<?php
$jadwal_reset = mysqli_query($db, "SELECT * FROM jadwal_upacara");
while ($r = mysqli_fetch_assoc($jadwal_reset)): ?>
    <div class="modal fade" id="modalHapus<?= $r['id_jadwal']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Hapus Jadwal Upacara</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus jadwal tanggal <b><?= date('d M Y', strtotime($r['tanggal'])) ?></b>?</p>
                </div>
                <div class="modal-footer">
                    <form action="" method="post">
                        <input type="hidden" name="id_jadwal" value="<?= $r['id_jadwal']; ?>">
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
                    <h5 class="modal-title">Detail Jadwal Upacara</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Tanggal</th>
                            <td><?= date('d-m-Y', strtotime($r['tanggal'])) ?></td>
                        </tr>
                        <tr>
                            <th>Petugas</th>
                            <td><?= $r['jenis_petugas'] == 'op3' ? 'OP3' : $r['nama_kelas']; ?></td>
                        </tr>
                        <tr>
                            <th>Pembina</th>
                            <td><?= htmlspecialchars($r['pembina_upacara']); ?></td>
                        </tr>
                        <tr>
                            <th>Tema</th>
                            <td><?= htmlspecialchars($r['tema']); ?></td>
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
<?php endwhile; ?>
<script>
    document.querySelectorAll('.jenis-petugas').forEach(select => {
        select.addEventListener('change', function() {
            const id = this.dataset.id;
            const kelas = document.getElementById('kelas' + id);
            const op3 = document.getElementById('op3' + id);

            if (this.value === 'kelas') {
                kelas.style.display = 'block';
                op3.style.display = 'none';
            } else if (this.value === 'op3') {
                kelas.style.display = 'none';
                op3.style.display = 'block';
            } else {
                kelas.style.display = 'none';
                op3.style.display = 'none';
            }
        });
    });
</script>

<script>
    const jenisTambah = document.getElementById('jenis_petugas_tambah');
    const kelasTambah = document.getElementById('kelas_tambah');
    const op3Tambah = document.getElementById('op3_tambah');

    jenisTambah.addEventListener('change', function() {
        kelasTambah.style.display = this.value === 'kelas' ? 'block' : 'none';
        op3Tambah.style.display = this.value === 'op3' ? 'block' : 'none';
    });
</script>

<script>
    document.querySelectorAll('.jenis-petugas-edit').forEach(select => {
        select.addEventListener('change', function() {
            const id = this.dataset.id;
            const kelas = document.getElementById('kelas_edit_' + id);
            const op3 = document.getElementById('op3_edit_' + id);

            kelas.style.display = this.value === 'kelas' ? 'block' : 'none';
            op3.style.display = this.value === 'op3' ? 'block' : 'none';
        });
    });
</script>


<?php include '../layout/footer.php'; ?>