<?php
session_start();
$title = 'Hapus Galeri';
include '../layout/header.php'; // Menyertakan file header
include '../config/koneksi.php'; // Menghubungkan ke database

// Ambil ID galeri dari parameter URL
$id_galeri = $_GET['id_galeri'] ?? '';

if (empty($id_galeri)) {
    echo "<script>
           alert('ID Galeri Tidak Valid.');
           document.location.href = 'galery.php';
           </script>";
    exit;
}
// Proses penghapusan data
if (delete_galeri($id_galeri) > 0) {
    echo "<script>
           alert('Data Galeri Berhasil Dihapus');
           document.location.href = 'galery.php';
           </script>";
} else {
    echo "<script>
           alert('Data Galeri Gagal Dihapus');
           document.location.href = 'galery.php';
           </script>";
}
?>
<?php include '../layout/footer.php'; ?>