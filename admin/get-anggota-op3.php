<?php
include '../config/koneksi.php';
$id_eskul = $_GET['id_eskul'];
$result = mysqli_query($db, "SELECT s.id_siswa, s.nama_siswa 
                             FROM anggota_eskul a 
                             JOIN siswa s ON a.id_siswa = s.id_siswa 
                             WHERE a.id_eskul = '$id_eskul'");
echo '<option value="">-- Pilih Siswa --</option>';
while ($s = mysqli_fetch_assoc($result)) {
    echo "<option value='{$s['id_siswa']}'>{$s['nama_siswa']}</option>";
}
