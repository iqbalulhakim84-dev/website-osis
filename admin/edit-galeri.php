<?php
session_start();
$title = 'Edit Galeri';
include '../layout/header.php'; // Menyertakan file header
include '../config/koneksi.php'; // Menghubungkan ke database

// Ambil ID galeri dari parameter URL
$id_galeri = $_GET['id'] ?? '';

if (empty($id_galeri)) {
    echo "<script>
           alert('ID Galeri Tidak Valid.');
           document.location.href = 'galery.php';
           </script>";
    exit;
}

// Ambil data galeri berdasarkan ID
$result = mysqli_query($db, "SELECT * FROM galeri WHERE id_galeri = '$id_galeri'");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>
           alert('Data Galeri Tidak Ditemukan.');
           document.location.href = 'galery.php';
           </script>";
    exit;
}

// Proses form submit
if (isset($_POST['update'])) {
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
?>

<div class="container mt-5">
    <h2>Edit Galeri</h2>
    <hr>
    <form action="" method="post">
        <input type="hidden" name="id_galeri" value="<?= htmlspecialchars($data['id_galeri']); ?>">

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" value="<?= htmlspecialchars($data['judul']); ?>" placeholder="Judul..." required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= htmlspecialchars($data['deskripsi']); ?>" placeholder="Deskripsi..." required>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Upload Gambar</label>
            <div class="col-sm-10">
                <input type="file" id="gambar" name="gambar" accept=".jpg,.jpeg,.png" value="<?= htmlspecialchars($data['gambar']); ?>" required>
            </div>
        </div>
        <button type="submit" name="update" class="btn btn-success mb-4">Update</button>

    </form>
</div>

<?php include '../layout/footer.php'; ?>