<?php
include '../config/koneksi.php';
include '../layout/header.php';

// Ambil ID jadwal dari parameter URL
if (!isset($_GET['id_jadwal'])) {
    echo "<script>alert('Jadwal tidak ditemukan!'); document.location.href='s6-jadwal-upacara.php';</script>";
    exit;
}

$id_jadwal = $_GET['id_jadwal'];

// Ambil detail jadwal dan kelasnya
$jadwal = mysqli_fetch_assoc(mysqli_query($db, "
    SELECT j.*, k.nama_kelas
    FROM jadwal_upacara j
    LEFT JOIN kelas k ON j.id_kelas = k.id_kelas
    WHERE j.id_jadwal = '$id_jadwal'
"));

// Ambil semua petugas dari jadwal ini
$petugas = mysqli_query($db, "
    SELECT p.*, s.nama_siswa
    FROM petugas_upacara p
    LEFT JOIN siswa s ON p.id_siswa = s.id_siswa
    WHERE p.id_jadwal = '$id_jadwal'
    ORDER BY p.peran ASC
");

$siswaData = [];
$q = mysqli_query($db, "
    SELECT 
        s.id_siswa,
        s.nama_siswa,
        s.id_kelas,
        ae.id_eskul,
        e.kategori
    FROM siswa s
    LEFT JOIN anggota_eskul ae ON s.id_siswa = ae.id_siswa
    LEFT JOIN eskul e ON ae.id_eskul = e.id_eskul
    ORDER BY s.nama_siswa ASC
");

while ($r = mysqli_fetch_assoc($q)) {
    $siswaData[] = $r;
}


// Tambah petugas
if (isset($_POST['tambah'])) {
    if (create_petugas_upacara($_POST) > 0) {
        echo "<script>alert('Petugas Ditambahkan!'); location.href='s6-petugas-upacara.php?id_jadwal=$id_jadwal';</script>";
    } else {
        echo "<script>alert('Gagal menambah Petugas!');</script>";
    }
}

// Tambah petugas
if (isset($_POST['ubah'])) {
    if (update_petugas_upacara($_POST) > 0) {
        echo "<script>alert('Petugas Diubah!'); location.href='s6-petugas-upacara.php?id_jadwal=$id_jadwal';</script>";
    } else {
        echo "<script>alert('Gagal Mengubah Petugas!');</script>";
    }
}

// Hapus petugas
if (isset($_POST['hapus'])) {
    if (delete_petugas_upacara($_POST) > 0) {
        echo "<script>alert('Petugas berhasil dihapus!'); document.location.href='s6-petugas-upacara.php?id_jadwal=$id_jadwal';</script>";
    } else {
        echo "<script>alert('Gagal menghapus Petugas!');</script>";
    }
}
?>
<div class="content-wrapper">
    <div class="container mt-5 overflow-x-scroll">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Petugas Upacara</h2>
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
        <hr>

        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Jadwal: <?= date('d M Y', strtotime($jadwal['tanggal'])) ?></h5>
                <p><b>Kelas Pelaksana:</b> <?= $jadwal['jenis_petugas'] == 'op3' ? 'OP3' : $jadwal['nama_kelas']; ?></p>
            </div>
        </div>

        <div class="text-start mb-3">
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fas fa-circle-plus"></i> Tambah Petugas
            </a>
        </div>

        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Petugas</th>
                    <th>Peran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($petugas) > 0): ?>
                    <?php $no = 1;
                    while ($row = mysqli_fetch_assoc($petugas)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nama_siswa'] ?></td>
                            <td><?= $row['peran'] ?></td>
                            <td>
                                <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPetugas<?= $row['id_petugas']; ?>"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusPetugas<?= $row['id_petugas']; ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada petugas yang ditambahkan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Petugas -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Tambah Petugas Upacara</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="post" data-scope="tambah">
                <div class="modal-body">

                    <div class="mb-3">
                        <label>Sumber Petugas</label>
                        <select name="sumber"
                            id="sumber"
                            class="form-control sumber"
                            required>
                            <option value="">-- Pilih --</option>
                            <option value="kelas">Kelas</option>
                            <option value="op3">OP3</option>
                        </select>
                    </div>

                    <div class="mb-3 kelas-wrapper d-none">
                        <label>Kelas</label>
                        <select name="id_kelas" class="form-control id_kelas">
                            <option value="">-- Pilih Kelas --</option>
                            <?php
                            $kelas = mysqli_query($db, "SELECT * FROM kelas ORDER BY nama_kelas ASC");
                            while ($k = mysqli_fetch_assoc($kelas)) {
                                echo "<option value='{$k['id_kelas']}'>{$k['nama_kelas']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3 op3-wrapper d-none">
                        <label>OP3</label>
                        <select name="id_eskul" class="form-control id_eskul">
                            <option value="">-- Pilih Eskul --</option>
                            <?php
                            $op3 = mysqli_query($db, "SELECT * FROM eskul WHERE kategori='OP3'");
                            while ($e = mysqli_fetch_assoc($op3)) {
                                echo "<option value='{$e['id_eskul']}'>{$e['eskul']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Nama Petugas</label>
                        <select name="id_siswa" class="form-control siswa siswa-tambah" required>
                            <option value="">-- Pilih Siswa --</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Peran</label>
                        <input type="text" name="peran" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah -->
<?php
mysqli_data_seek($petugas, 0);
while ($r = mysqli_fetch_assoc($petugas)):
?>
    <div class="modal fade" id="editPetugas<?= $r['id_petugas'] ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Ubah Jadwal Upacara</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <form action="" method="post">
                        <?php
                        $id_petugas   = $r['id_petugas'] ?? '';
                        $sumber       = $r['sumber'] ?? '';
                        $id_kelas_edit = $r['id_kelas'] ?? '';
                        $id_eskul_edit = $r['id_eskul'] ?? '';
                        $id_siswa_edit = $r['id_siswa'] ?? '';
                        $peran_edit    = $r['peran'] ?? '';
                        ?>
                        <input type="hidden" name="id_petugas" value="<?= $id_petugas; ?>">

                        <!-- Sumber Petugas -->
                        <div class="mb-3">
                            <label>Sumber Petugas</label>
                            <select name="sumber" class="form-control sumber" required>
                                <option value="">-- Pilih Sumber --</option>
                                <option value="kelas" <?= $sumber == 'kelas' ? 'selected' : '' ?>>Kelas</option>
                                <option value="op3" <?= $sumber == 'op3' ? 'selected' : '' ?>>OP3</option>
                            </select>
                        </div>

                        <!-- Kelas -->
                        <div class="mb-3 kelas-wrapper <?= $sumber == 'kelas' ? '' : 'd-none' ?>">
                            <label>Kelas</label>
                            <select name="id_kelas"
                                class="form-control id_kelas"
                                data-id="<?= $id_petugas; ?>">
                                <option value="">-- Pilih Kelas --</option>
                                <?php
                                $kelas = mysqli_query($db, "SELECT * FROM kelas ORDER BY nama_kelas ASC");
                                while ($k = mysqli_fetch_assoc($kelas)):
                                ?>
                                    <option value="<?= $k['id_kelas']; ?>"
                                        <?= $k['id_kelas'] == $id_kelas_edit ? 'selected' : '' ?>>
                                        <?= $k['nama_kelas']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <!-- OP3 -->
                        <div class="mb-3 op3-wrapper <?= $sumber == 'op3' ? '' : 'd-none' ?>">
                            <label>OP3</label>
                            <select name="id_eskul"
                                class="form-control id_eskul"
                                data-id="<?= $id_petugas; ?>">
                                <option value="">-- Pilih Eskul --</option>
                                <?php
                                $op3 = mysqli_query($db, "SELECT * FROM eskul WHERE kategori='OP3' ORDER BY eskul ASC");
                                while ($e = mysqli_fetch_assoc($op3)):
                                ?>
                                    <option value="<?= $e['id_eskul']; ?>"
                                        <?= $e['id_eskul'] == $id_eskul_edit ? 'selected' : '' ?>>
                                        <?= $e['eskul']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <!-- Nama Petugas -->
                        <div class="mb-3">
                            <label>Nama Petugas</label>
                            <select name="id_siswa" class="form-control siswa" required>
                                <option value="">-- Pilih Siswa --</option>
                                <?php
                                $siswa = mysqli_query($db, "SELECT * FROM siswa ORDER BY nama_siswa ASC");
                                while ($s = mysqli_fetch_assoc($siswa)):
                                ?>
                                    <option value="<?= $s['id_siswa']; ?>"
                                        <?= $s['id_siswa'] == $id_siswa_edit ? 'selected' : '' ?>>
                                        <?= $s['nama_siswa']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <!-- Peran -->
                        <div class="mb-3">
                            <label>Petugas</label>
                            <input type="text"
                                name="peran"
                                class="form-control"
                                value="<?= htmlspecialchars($peran_edit); ?>"
                                required>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="ubah" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>

<!-- Modal Hapus Petugas -->
<?php
$petugas_reset = mysqli_query($db, "SELECT * FROM petugas_upacara WHERE id_jadwal = '$id_jadwal'");
while ($r = mysqli_fetch_assoc($petugas_reset)): ?>
    <div class="modal fade" id="hapusPetugas<?= $r['id_petugas']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Hapus Petugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus petugas ini dari jadwal?</p>
                </div>
                <div class="modal-footer">
                    <form action="" method="post">
                        <input type="hidden" name="id_petugas" value="<?= $r['id_petugas']; ?>">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>

<script>
    const siswaData = <?= json_encode($siswaData); ?>;

    function renderSiswa(list, select, selectedId = null) {
        select.innerHTML = '<option value="">-- Pilih Siswa --</option>';

        const used = new Set();
        list.forEach(s => {
            if (!used.has(s.id_siswa)) {
                used.add(s.id_siswa);

                const selected = selectedId == s.id_siswa ? 'selected' : '';
                select.innerHTML += `
                <option value="${s.id_siswa}" ${selected}>
                    ${s.nama_siswa}
                </option>`;
            }
        });
    }

    document.addEventListener('change', function(e) {

        /* ===================================
           GANTI SUMBER (TAMBAH & EDIT)
        ==================================== */
        if (e.target.classList.contains('sumber')) {

            const modal = e.target.closest('.modal');
            const kelasWrapper = modal.querySelector('.kelas-wrapper');
            const op3Wrapper = modal.querySelector('.op3-wrapper');
            const siswaSelect = modal.querySelector('.siswa');

            siswaSelect.innerHTML = '<option value="">-- Pilih Siswa --</option>';

            if (e.target.value === 'kelas') {
                kelasWrapper.classList.remove('d-none');
                op3Wrapper.classList.add('d-none');
            } else if (e.target.value === 'op3') {
                op3Wrapper.classList.remove('d-none');
                kelasWrapper.classList.add('d-none');
            } else {
                kelasWrapper.classList.add('d-none');
                op3Wrapper.classList.add('d-none');
            }
        }

        /* ===================================
           PILIH KELAS
        ==================================== */
        if (e.target.classList.contains('id_kelas')) {

            const modal = e.target.closest('.modal');
            const siswaSelect = modal.querySelector('.siswa');

            const filtered = siswaData.filter(
                s => s.id_kelas === e.target.value
            );

            renderSiswa(filtered, siswaSelect);
        }

        /* ===================================
           PILIH OP3 / ESKUL
        ==================================== */
        if (e.target.classList.contains('id_eskul')) {

            const modal = e.target.closest('.modal');
            const siswaSelect = modal.querySelector('.siswa');

            const filtered = siswaData.filter(
                s => s.id_eskul === e.target.value && s.kategori === 'OP3'
            );

            renderSiswa(filtered, siswaSelect);
        }

    });
</script>

<?php include '../layout/footer.php'; ?>