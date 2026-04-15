<?php
include '../config/koneksi.php';

if (isset($_GET['id_kelas'])) {
    $id_kelas = $_GET['id_kelas'];
    $result = mysqli_query($db, "SELECT * FROM siswa WHERE id_kelas = '$id_kelas' ORDER BY nama_siswa ASC");

    echo '<option value="">-- Pilih Siswa --</option>';
    while ($s = mysqli_fetch_assoc($result)) {
        echo "<option value='{$s['id_siswa']}'>{$s['nama_siswa']}</option>";
    }
}
