<?php
session_start();
$title = 'Tambah Galeri';
include '../layout/header.php'; // Menyertakan file header
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul   = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $file_tmp  = $_FILES['gambar']['tmp_name'];
        $file_name = pathinfo($_FILES['gambar']['name'], PATHINFO_FILENAME);
        $file_ext  = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));

        $new_file_name = $file_name . "_" . time() . ".webp";
        $output_path   = "../image/galeri/" . $new_file_name;

        // Buat resource image sesuai tipe
        switch ($file_ext) {
            case 'jpg':
            case 'jpeg':
                $image = imagecreatefromjpeg($file_tmp);
                break;
            case 'png':
                $image = imagecreatefrompng($file_tmp);
                // hilangkan background transparan jadi putih
                $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
                $white = imagecolorallocate($bg, 255, 255, 255);
                imagefill($bg, 0, 0, $white);
                imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
                $image = $bg;
                break;
            default:
                echo "<script>alert('Format file tidak didukung. Gunakan JPG atau PNG.');</script>";
                exit;
        }

        // Simpan sebagai webp
        imagewebp($image, $output_path, 80);
        imagedestroy($image);

        // Simpan ke DB
        $stmt = $db->prepare("INSERT INTO galeri (judul, gambar, deskripsi) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $judul, $new_file_name, $deskripsi);
        $query = $stmt->execute();

        if ($query) {
            echo "<script>alert('Galeri berhasil ditambahkan!');window.location='galery.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data!');window.location='galery.php';</script>";
        }
    } else {
        echo "<script>alert('Upload gagal! Pastikan memilih file gambar.');</script>";
    }
}
?>
<div class="container mt-5">
    <h2><?= $title; ?></h2>
        <hr>
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