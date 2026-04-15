<?php
include '../layout/header.php';
include '../config/koneksi.php';

// Ambil data galeri berdasarkan ID
$result = mysqli_query($db, "
    SELECT g.*, 
        ak1.nama AS dibuat_oleh,
        ak2.nama AS diubah_oleh
    FROM galeri g
    LEFT JOIN akun ak1 ON g.created_by = ak1.id_akun
    LEFT JOIN akun ak2 ON g.updated_by = ak2.id_akun
");

if (isset($_POST['tambah'])) {
    if (create_galeri($_POST) > 0) {
        echo "<script>
               alert('Data Galeri Berhasil Ditambahkan');
               document.location.href = 'galery.php';
               </script>";
    } else {
        echo "<script>
               alert('Data Galeri Gagal Ditambahkan');
               document.location.href = 'galery.php';
               </script>";
    }
}

// Proses form submit
if (isset($_POST['edit'])) {
    if (update_galeri($_POST) > 0) {
        echo "<script>
               alert('Data Galeri Berhasil Diperbarui');
               document.location.href = 'galery.php';
               </script>";
    } else {
        echo "<script>
               alert('Data Galeri Gagal Diperbarui');
               document.location.href = 'galery.php';
               </script>";
    }
}
// Proses form submit
if (isset($_POST['edit'])) {
    if (delete_galeri($_POST) > 0) {
        echo "<script>
               alert('Data Galeri Berhasil Diperbarui');
               document.location.href = 'galery.php';
               </script>";
    } else {
        echo "<script>
               alert('Data Galeri Gagal Diperbarui');
               document.location.href = 'galery.php';
               </script>";
    }
}
?>
<style>
    .card-img-top {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }
</style>

<div class="container-fluid text-center mt-0 my-4 py-3" style="background-color: #ecccccff; height: auto;">
    <div class="row">
        <div class="col-12">
            <h2 class="display-4">GALERY</h2>
            <p class="lead">Dokumentasi Kegiatan OSIS SMK PGRI 1 CIMAHI</p>
        </div>
    </div>
</div>
<div class="container mt-5 my-4">
    <h5>GALERY</h5>
    <h2>KEGIATAN OSIS</h2>
    <p> Beberapa kegiatan OSIS SMK PGRI 1 CIMAHI yang berjalan setiap tahunnya</p>
    <hr>
    <a class="btn btn-primary tambah-btn mb-1" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="fas fa-plus-circle"></i> Tambah
    </a>
</div>

<div class="container">
    <div class="row" style="margin-top: 30px;">
        <?php
        $no = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            if ($no % 3 == 0) echo '<div class="row g-4 justify-content-center px-5" style="margin-top: 30px;">';
        ?>
            <div class="col-md-4 text-center">
                <div class="card mb-4 animate__animated animate__fadeInUp">
                    <img src="../image/galeri/<?= htmlspecialchars($row['gambar']); ?>" class="card-img-top" alt="<?= htmlspecialchars($row['judul']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['judul']); ?></h5>
                        <p class="card-text"><?= htmlspecialchars($row['deskripsi']); ?></p>
                    </div>
                    <div class="card-footer text-center">
                        <!-- Tombol Detail -->
                        <a type="button" class="btn btn-primary btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $row['id_galeri']; ?>"><i class="fas fa-eye"></i></a>

                        <!-- Tombol Edit -->
                        <a type="button" class="btn btn-warning btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id_galeri']; ?>"><i class="fas fa-edit"></i></a>

                        <!-- Tombol Hapus -->
                        <a type="button" class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row['id_galeri']; ?>"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
            </div>

        <?php
            $no++;
            if ($no % 3 == 0) echo '</div>';
        }
        if ($no % 3 != 0) echo '</div>'; // tutup row terakhir kalau belum ketutup
        ?>
        <!-- Modal Tambah -->
        <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul"
                                    placeholder="Judul Galeri..." required>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi..." required>
                            </div>

                            <div class="row mb-3">
                                <label for="gambar" class="col-sm-2 col-form-label">Upload Gambar</label>
                                <div class="col-sm-10">
                                    <input type="file" id="gambar" name="gambar" accept=".jpg,.jpeg,.png" required>
                                </div>
                            </div>

                            <!-- Preview -->
                            <div class="mb-3 text-center">
                                <label class="form-label d-block">Preview Gambar</label>
                                <img id="preview" class="img-thumbnail rounded shadow-sm d-block mx-auto"
                                    style="max-width:300px; display:none;" alt="Preview Gambar">
                            </div>

                            <button type="submit" name="tambah" class="btn btn-success mb-4">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <?php foreach ($result as $galeri): ?>
            <div class="modal fade" id="modalEdit<?= $galeri['id_galeri']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="exampleModalLabel">Edit galeri</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_galeri" value="<?= $galeri['id_galeri']; ?>">
                                <input type="hidden" name="gambar_lama" value="<?= $galeri['gambar']; ?>">
                                <div class="mb-3">
                                    <label for="judul">judul</label>
                                    <input type="text" name="judul" id="judul" class="form-control" value="<?= htmlspecialchars($galeri['judul']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi">deskripsi</label>
                                    <input type="text" name="deskripsi" id="deskripsi" class="form-control" value="<?= htmlspecialchars($galeri['deskripsi']); ?>" required>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Upload Gambar</label>
                                    <div class="col-sm-10">
                                        <input type="file" id="gambar" name="gambar" accept=".jpg,.jpeg,.png">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                    <button type="submit" name="edit" class="btn btn-success">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Modal Hapus -->
        <?php foreach ($result as $galeri): ?>
            <div class="modal fade" id="modalHapus<?= $galeri['id_galeri']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus Galeri</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Yakin Ingin Menghapus Data Galeri: <?= htmlspecialchars($galeri['judul']); ?>?</p>
                        </div>
                        <div class="modal-footer">
                            <a type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Batal</a>
                            <a href="hapus-galeri.php?id_galeri=<?= $galeri['id_galeri']; ?>" class="btn btn-danger btn-md">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <?php mysqli_data_seek($result, 0); // reset pointer 
        ?>
        <?php while ($r = mysqli_fetch_assoc($result)) : ?>
            <div class="modal fade" id="modalDetail<?= $r['id_galeri']; ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title">Detail Anggota</h5>
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
                                    <th>Gambar</th>
                                    <td><?= htmlspecialchars($r['gambar']); ?></td>
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
    </div>
</div>
<script>
    const inputGambar = document.getElementById("gambar");
    const preview = document.getElementById("preview");

    inputGambar.addEventListener("change", function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.style.display = "block";
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        } else {
            preview.style.display = "none";
            preview.src = "";
        }
    });
</script>
<?php include '../layout/footer.php'; ?>