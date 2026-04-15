<?php
include '../layout/header.php'; // Query Visi
$visi = mysqli_query($db, "SELECT * FROM visi_misi WHERE jenis='visi' AND status=1");

$misi = mysqli_query($db, "SELECT * FROM visi_misi WHERE jenis='misi' AND status=1");

$struktur = mysqli_query($db, "SELECT * FROM struktur_osis WHERE status=1 ORDER BY urutan ASC");

// jika tombol tambah di tekan jalankan script berikut
if (isset($_POST['tambah_visi'])) {
    if (create_visi($_POST) > 0) {
        echo "<script>
               alert('Visi Berhasil Ditambahkan');
               document.location.href = 'profil.php';
               </script>";
    } else {
        echo "<script>
               alert('Visi Gagal Ditambahkan');
               document.location.href = 'profil.php';
               </script>";
    }
}

// jika tombol ubah di tekan jalankan script berikut
if (isset($_POST['ubah_visi'])) {
    if (update_visi($_POST) > 0) {
        echo "<script>
               alert('Visi Berhasil Diubah');
               document.location.href = 'profil.php';
               </script>";
    } else {
        echo "<script>
               alert('Visi Gagal Diubah');
               document.location.href = 'profil.php';
               </script>";
    }
}

// jika tombol tambah di tekan jalankan script berikut
if (isset($_POST['tambah_misi'])) {
    if (create_misi($_POST) > 0) {
        echo "<script>
               alert('Misi Berhasil Ditambahkan');
               document.location.href = 'profil.php';
               </script>";
    } else {
        echo "<script>
               alert('Misi Gagal Ditambahkan');
               document.location.href = 'profil.php';
               </script>";
    }
}

// jika tombol ubah di tekan jalankan script berikut
if (isset($_POST['ubah_misi'])) {
    if (update_misi($_POST) > 0) {
        echo "<script>
               alert('Misi Berhasil Diubah');
               document.location.href = 'profil.php';
               </script>";
    } else {
        echo "<script>
               alert('Misi Gagal Diubah');
               document.location.href = 'profil.php';
               </script>";
    }
}

// jika tombol tambah di tekan jalankan script berikut
if (isset($_POST['tambah_struktur'])) {
    if (create_struktur($_POST) > 0) {
        echo "<script>
               alert('Struktur Berhasil Ditambahkan');
               document.location.href = 'profil.php';
               </script>";
    } else {
        echo "<script>
               alert('Struktur Gagal Ditambahkan');
               document.location.href = 'profil.php';
               </script>";
    }
}

// jika tombol ubah di tekan jalankan script berikut
if (isset($_POST['ubah_struktur'])) {
    if (update_struktur($_POST) > 0) {
        echo "<script>
               alert('Struktur Berhasil Diubah');
               document.location.href = 'profil.php';
               </script>";
    } else {
        echo "<script>
               alert('Struktur Gagal Diubah');
               document.location.href = 'profil.php';
               </script>";
    }
}

?>
<div class="container-fluid d-flex justify-content-center align-items-center">
    <img src="../image/osiskita.png" class="d-block w-100 animate__animated animate__fadeIn" alt="osiskita" style="width: 200px; height: auto;">
</div>
<div class="container mt-5 text-center">
    <h5>OSIS PRIONECI</h5>
    <h2>Visi dan Misi tahun 2023/2025</h2>
</div>
<div class="container mt-4 text-center">
    <p>Bersama, Kita Wujudkan Perubahan!</p>
</div>
<div class="container my-5">
    <div class="row">
        <!-- Visi Section -->
        <div class="col-12 col-md-6 mb-4">
            <div class="card shadow-sm" style="background-color: #ECDFCC; color: #1E201E;">
                <div class="card-body">
                    <h3 class="card-title text-center">VISI</h3>
                    <ul class="list-group list-group-flush">
                        <?php while ($row = mysqli_fetch_assoc($visi)) : ?>
                            <li class="list-group-item" style="background-color: #add8e6; color: #1E201E;">
                                <?= $row['isi']; ?>
                                <a class="btn btn-warning btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modalUbahVisi<?= $row['id_visi_misi'] ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <a class="btn btn-success btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#modalTambahVisi">
                        <li class="fas fa-plus-circle"></li>
                    </a>
                </div>
            </div>
        </div>

        <!-- Misi Section -->
        <div class="col-12 col-md-6 mb-4">
            <div class="card shadow-sm" style="background-color: #ECDFCC; color: #1E201E;">
                <div class="card-body">
                    <h3 class="card-title text-center">Misi</h3>
                    <ul class="list-group list-group-flush">
                        <?php while ($row = mysqli_fetch_assoc($misi)) : ?>
                            <li class="list-group-item" style="background-color: #add8e6; color: #1E201E;">
                                <?= $row['isi']; ?>
                                <a class="btn btn-warning btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modalUbahMisi<?= $row['id_visi_misi'] ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <a class="btn btn-success btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#modalTambahMisi">
                        <li class="fas fa-plus-circle"></li>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Visi -->
    <div class="modal fade" id="modalTambahVisi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="isi" class="form-label">Isi Visi</label>
                            <input type="text" class="form-control" id="isi" name="isi" placeholder="Isi Visi..." required>
                        </div>

                        <div class="mb-3">
                            <label for="tahun" class="form-label">Periode</label>
                            <input type="text" class="form-control" id="tahun" name="tahun" placeholder="Periode..." required>
                        </div>

                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">-- Status --</option>
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" name="tambah_visi" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Misi -->
    <div class="modal fade" id="modalTambahMisi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="isi" class="form-label">Isi Misi</label>
                            <input type="text" class="form-control" id="isi" name="isi" placeholder="Isi Misi..." required>
                        </div>

                        <div class="mb-3">
                            <label for="tahun" class="form-label">Periode</label>
                            <input type="text" class="form-control" id="tahun" name="tahun" placeholder="Periode..." required>
                        </div>

                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">-- Status --</option>
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" name="tambah_misi" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php foreach ($visi as $v): ?>
        <!-- Modal Ubah -->
        <div class="modal fade" id="modalUbahVisi<?= $v['id_visi_misi'] ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Visi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <input type="hidden" name="id_visi_misi" value="<?= $v['id_visi_misi'] ?>">
                            <div class="mb-3">
                                <label for="isi" class="form-label">Isi Visi</label>
                                <textarea name="isi" class="form-control" rows="3"><?= $v['isi'] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Periode</label>
                                <input type="text" class="form-control" id="tahun" name="tahun" value="<?= $v['tahun']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="">-- Status --</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" name="ubah_visi" class="btn btn-success">Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <?php foreach ($misi as $m): ?>
        <!-- Modal Ubah -->
        <div class="modal fade" id="modalUbahMisi<?= $m['id_visi_misi'] ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Misi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <input type="hidden" name="id_visi_misi" value="<?= $m['id_visi_misi'] ?>">
                            <div class="mb-3">
                                <label for="isi" class="form-label">Isi Misi</label>
                                <textarea name="isi" class="form-control" rows="3"><?= $m['isi'] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Periode</label>
                                <input type="text" class="form-control" id="tahun" name="tahun" value="<?= $m['tahun']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="">-- Status --</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" name="ubah_misi" class="btn btn-success">Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <!-- Gallery Section -->
    <div class="container my-5">
        <h2 class="text-center">Struktur OSIS SMK PGRI 1 Cimahi</h2>
        <div class="row d-flex justify-content-center">
            <?php while ($row = mysqli_fetch_assoc($struktur)) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="../image/<?= $row['gambar']; ?>" class="card-img-top" alt="<?= $row['jabatan']; ?>">
                        <div class="card-body text-center">
                            <p class="card-text"><?= $row['jabatan']; ?></p>

                            <!-- Tombol Ubah + Hapus -->
                            <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $row['id_struktur']; ?>"><i class="fas fa-edit"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Modal Ubah Struktur -->
                <div class="modal fade" id="modalUbah<?= $row['id_struktur']; ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title">Ubah Struktur</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id_struktur" value="<?= $row['id_struktur']; ?>">
                                    <div class="mb-3">
                                        <label>Jabatan:</label>
                                        <input type="text" name="jabatan" class="form-control mb-3" value="<?= $row['jabatan']; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label>Gambar Baru (Optional):</label>
                                        <input type="file" name="gambar" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="tahun" class="form-label">Periode</label>
                                        <input type="text" class="form-control" id="tahun" name="tahun" value="<?= $row['tahun']; ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="urutan" class="form-label">Urutan</label>
                                        <input type="text" class="form-control" id="urutan" name="urutan" value="<?= $row['urutan']; ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="">-- Status --</option>
                                            <option value="1" <?= $row['status'] == 1 ? 'selected' : '' ?>>Aktif</option>
                                            <option value="0" <?= $row['status'] == 0 ? 'selected' : '' ?>>Nonaktif</option>

                                        </select>
                                    </div>

                                    <input type="hidden" name="gambarLama" value="<?= $row['gambar']; ?>">

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="ubah_struktur" class="btn btn-primary">Ubah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            <?php endwhile; ?>
        </div>

        <!-- Tombol Tambah Struktur -->
        <div class="text-center">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahStruktur">
                <i class="fas fa-plus-circle"></i> Tambah
            </button>
        </div>
        <!-- Modal Tambah Misi -->
        <div class="modal fade" id="modalTambahStruktur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                            </div>

                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="gambar" name="gambar" required>
                            </div>

                            <div class="mb-3">
                                <label for="tahun" class="form-label">Periode</label>
                                <input type="text" class="form-control" id="tahun" name="tahun" required>
                            </div>

                            <div class="mb-3">
                                <label for="urutan" class="form-label">Urutan</label>
                                <input type="number" class="form-control" id="urutan" name="urutan" required>
                            </div>

                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="">-- Status --</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" name="tambah_struktur" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../layout/footer.php'; ?>