<?php

// Fungsi menampilkan data (SELECT)
function select($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $result;
}

// Fungsi menambahkan data Anggota
function create_data_anggota($post)
{
    global $db;
    $nama       = strip_tags($post['nama']);
    $jk         = strip_tags($post['jk']);
    $kelas      = strip_tags($post['kelas']);
    $jurusan    = strip_tags($post['jurusan']);
    $alamat     = strip_tags($post['alamat']);
    $no_tlp     = strip_tags($post['no_tlp']);
    $created_by = $_SESSION['id_akun'];
    // Query untuk menambahkan data anggota
    $query = "INSERT INTO data_anggota (nama, jk, kelas, jurusan, alamat, no_tlp, created_by)
              VALUES ('$nama', '$jk', '$kelas', '$jurusan', '$alamat', '$no_tlp', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi update data Anggota
function update_data_anggota($post)
{
    global $db;
    $id_anggota = strip_tags($post['id_anggota']);
    $nama       = strip_tags($post['nama']);
    $jk         = strip_tags($post['jk']);
    $kelas      = strip_tags($post['kelas']);
    $jurusan    = strip_tags($post['jurusan']);
    $alamat     = strip_tags($post['alamat']);
    $no_tlp     = strip_tags($post['no_tlp']);
    $updated_by = $_SESSION['id_akun'];
    // Query untuk memperbarui data anggota
    $query = "UPDATE data_anggota SET nama = '$nama', jk = '$jk', kelas = '$kelas', jurusan = '$jurusan', alamat ='$alamat', no_tlp = '$no_tlp', updated_by = '$updated_by'
              WHERE id_anggota = '$id_anggota'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi untuk menghapus data anggota
function delete_data_anggota($post)
{
    global $db;
    $id_anggota = strip_tags($post['id_anggota']);
    // Query untuk menghapus data anggota
    $query = "DELETE FROM data_anggota WHERE id_anggota = '$id_anggota'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi menambahkan data Kepengurusan
function create_data_kepengurusan($post)
{
    global $db;
    $nama_anggota   = strip_tags($post['nama_anggota']);
    $jabatan        = strip_tags($post['jabatan']);
    $tahun_memulai  = strip_tags($post['tahun_memulai']);
    $tahun_selesai  = strip_tags($post['tahun_selesai']);
    $created_by     = $_SESSION['id_akun'];
    // Query untuk menambahkan data kepengurusan
    $query = "INSERT INTO data_kepengurusan (nama_anggota, jabatan, tahun_memulai, tahun_selesai, created_by)
              VALUES ('$nama_anggota', '$jabatan', '$tahun_memulai', '$tahun_selesai', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi update data Kepengurusan 
function update_data_kepengurusan($post)
{
    global $db;
    $id_kepengurusan  = strip_tags($post['id_kepengurusan']);
    $nama_anggota     = strip_tags($post['nama_anggota']);
    $jabatan          = strip_tags($post['jabatan']);
    $tahun_memulai    = strip_tags($post['tahun_memulai']);
    $tahun_selesai    = strip_tags($post['tahun_selesai']);
    $updated_by       = $_SESSION['id_akun'];

    // Query untuk memperbarui data kepengurusan
    $query = "UPDATE data_kepengurusan SET nama_anggota = '$nama_anggota', jabatan = '$jabatan', tahun_memulai = '$tahun_memulai', tahun_selesai = '$tahun_selesai', updated_by = '$updated_by'
              WHERE id_kepengurusan = '$id_kepengurusan'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi untuk menghapus data Kepengurusan
function delete_data_kepengurusan($post)
{
    global $db;
    $id_kepengurusan = strip_tags($post['id_kepengurusan']);
    // Query untuk menghapus data kepengurusan
    $query = "DELETE FROM data_kepengurusan WHERE id_kepengurusan = '$id_kepengurusan'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi menambahkan data Kegiatan Event
function create_data_kegiatan_event($post)
{
    global $db;
    $nama_kegiatan     = strip_tags($post['nama_kegiatan']);
    $tanggal_kegiatan  = strip_tags($post['tanggal_kegiatan']);
    $lokasi_kegiatan   = strip_tags($post['lokasi_kegiatan']);
    $created_by        = $_SESSION['id_akun'];
    // Query untuk menambahkan data kegiatan event
    $query = "INSERT INTO data_kegiatan_event (nama_kegiatan, tanggal_kegiatan, lokasi_kegiatan, created_by)
              VALUES ('$nama_kegiatan', '$tanggal_kegiatan', '$lokasi_kegiatan', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi update data Kegiatan Event
function update_data_kegiatan_event($post)
{
    global $db;
    $id_kegiatan         = strip_tags($post['id_kegiatan']);
    $nama_kegiatan       = strip_tags($post['nama_kegiatan']);
    $tanggal_kegiatan    = strip_tags($post['tanggal_kegiatan']);
    $lokasi_kegiatan     = strip_tags($post['lokasi_kegiatan']);
    $updated_by          = $_SESSION['id_akun'];
    // Query untuk memperbarui data kegiatan event
    $query = "UPDATE data_kegiatan_event SET nama_kegiatan = '$nama_kegiatan', tanggal_kegiatan = '$tanggal_kegiatan', lokasi_kegiatan = '$lokasi_kegiatan', updated_by = '$updated_by'
              WHERE id_kegiatan = '$id_kegiatan'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi untuk menghapus data Kegiatan Event
function delete_data_kegiatan_event($post)
{
    global $db;
    $id_kegiatan = strip_tags($post['id_kegiatan']);
    // Query untuk menghapus data kegiatan event
    $query = "DELETE FROM data_kegiatan_event WHERE id_kegiatan = '$id_kegiatan'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi menambahkan data Pelantikan
function create_data_pelantikan($post)
{
    global $db;
    $nama_anggota      = strip_tags($post['nama_anggota']);
    $tahun_pelantikan  = strip_tags($post['tahun_pelantikan']);
    $created_by        = $_SESSION['id_akun'];
    // Query untuk menambahkan data pelantikan
    $query = "INSERT INTO data_pelantikan (nama_anggota, tahun_pelantikan, created_by)
              VALUES ('$nama_anggota', '$tahun_pelantikan', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi update data Pelantikan
function update_data_pelantikan($post)
{
    global $db;
    $id_pelantikan       = strip_tags($post['id_pelantikan']);
    $nama_anggota        = strip_tags($post['nama_anggota']);
    $tahun_pelantikan    = strip_tags($post['tahun_pelantikan']);
    $updated_by          = $_SESSION['id_akun'];
    // Query untuk memperbarui data kepengurusan
    $query = "UPDATE data_pelantikan SET nama_anggota = '$nama_anggota', tahun_pelantikan = '$tahun_pelantikan', updated_by = '$updated_by'
              WHERE id_pelantikan = '$id_pelantikan'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}
// Fungsi untuk menghapus data Pelantikan
function delete_data_pelantikan($post)
{
    global $db;
    $id_pelantikan = strip_tags($post['id_pelantikan']);
    // Query untuk menghapus data anggota
    $query = "DELETE FROM data_pelantikan WHERE id_pelantikan = '$id_pelantikan'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi menambahkan data Organisasi Luar
function create_data_organisasi_luar($post)
{
    global $db;
    $nama_anggota      = strip_tags($post['nama_anggota']);
    $nama_organisasi   = strip_tags($post['nama_organisasi']);
    $jabatan           = strip_tags($post['jabatan']);
    $asal_sekolah      = strip_tags($post['asal_sekolah']);
    $created_by        = $_SESSION['id_akun'];
    // Query untuk menambahkan data anggota
    $query = "INSERT INTO data_organisasi_luar (nama_anggota, nama_organisasi, jabatan, asal_sekolah, created_by)
              VALUES ('$nama_anggota', '$nama_organisasi', '$jabatan', '$asal_sekolah', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi update data Organisasi Luar
function update_data_organisasi_luar($post)
{
    global $db;
    $id_organisasi_luar   = strip_tags($post['id_organisasi_luar']);
    $nama_anggota         = strip_tags($post['nama_anggota']);
    $nama_organisasi      = strip_tags($post['nama_organisasi']);
    $jabatan              = strip_tags($post['jabatan']);
    $asal_sekolah         = strip_tags($post['asal_sekolah']);
    $updated_by           = $_SESSION['id_akun'];
    // Query untuk memperbarui data kepengurusan
    $query = "UPDATE data_organisasi_luar SET nama_anggota = '$nama_anggota', nama_organisasi = '$nama_organisasi', jabatan = '$jabatan' , asal_sekolah = '$asal_sekolah', updated_by = '$updated_by'
              WHERE id_organisasi_luar = '$id_organisasi_luar'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi untuk menghapus data Organisasi Luar
function delete_data_organisasi_luar($post)
{
    global $db;
    $id_organisasi_luar = strip_tags($post['id_organisasi_luar']);
    // Query untuk menghapus data anggota
    $query = "DELETE FROM data_organisasi_luar WHERE id_organisasi_luar = '$id_organisasi_luar'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi menambahkan data Siswa
function create_siswa($post)
{
    global $db;
    $nama_siswa     = strip_tags($post['nama_siswa']);
    $id_kelas       = strip_tags($post['id_kelas']);
    $poin           = strip_tags($post['poin']);
    $created_by     = $_SESSION['id_akun'];
    // Query untuk menambahkan data anggota
    $query = "INSERT INTO siswa (nama_siswa, id_kelas, poin, created_by)
              VALUES ('$nama_siswa', '$id_kelas', '$poin', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi update data Siswa
function update_siswa($post)
{
    global $db;
    $id_siswa         = strip_tags($post['id_siswa']);
    $nama_siswa       = strip_tags($post['nama_siswa']);
    $id_kelas         = strip_tags($post['id_kelas']);
    $poin             = strip_tags($post['poin']);
    $updated_by       = $_SESSION['id_akun'];
    // Query untuk memperbarui data kepengurusan
    $query = "UPDATE siswa SET nama_siswa = '$nama_siswa', id_kelas = '$id_kelas', poin = '$poin', updated_by = '$updated_by'
              WHERE id_siswa = '$id_siswa'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi untuk menghapus data Siswa
function delete_siswa($post)
{
    global $db;
    $id_siswa = strip_tags($post['id_siswa']);
    // Query untuk menghapus data anggota
    $query = "DELETE FROM siswa WHERE id_siswa = '$id_siswa'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi menambahkan data Kelas
function create_kelas($post)
{
    global $db;
    $nama_kelas   = strip_tags($post['nama_kelas']);
    $created_by   = $_SESSION['id_akun'];
    // Query untuk menambahkan data anggota
    $query = "INSERT INTO kelas (nama_kelas, created_by)
              VALUES ('$nama_kelas', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi update data Kelas
function update_kelas($post)
{
    global $db;
    $id_kelas      = strip_tags($post['id_kelas']);
    $nama_kelas    = strip_tags($post['nama_kelas']);
    $updated_by    = $_SESSION['id_akun'];
    // Query untuk memperbarui data kepengurusan
    $query = "UPDATE kelas SET nama_kelas = '$nama_kelas', id_kelas = '$id_kelas', updated_by = '$updated_by'
              WHERE id_kelas = '$id_kelas'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi untuk menghapus data Kelas
function delete_kelas($post)
{
    global $db;
    $id_kelas = strip_tags($post['id_kelas']);
    // Query untuk menghapus data anggota
    $query = "DELETE FROM kelas WHERE id_kelas = '$id_kelas'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi menambahkan data Eskul
function create_eskul($post)
{
    global $db;
    $eskul       = strip_tags($post['eskul']);
    $singkatan   = strip_tags($post['singkatan']);
    $pembina     = strip_tags($post['pembina']);
    $kategori    = strip_tags($post['kategori']);
    $created_by  = $_SESSION['id_akun'];
    // Query untuk menambahkan data anggota
    $query = "INSERT INTO eskul (eskul, singkatan, pembina, kategori, created_by)
              VALUES ('$eskul', '$singkatan', '$pembina', '$kategori', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi update data Eskul
function update_eskul($post)
{
    global $db;
    $id_eskul    = strip_tags($post['id_eskul']);
    $eskul       = strip_tags($post['eskul']);
    $singkatan   = strip_tags($post['singkatan']);
    $pembina     = strip_tags($post['pembina']);
    $kategori    = strip_tags($post['kategori']);
    $updated_by  = $_SESSION['id_akun'];
    // Query untuk memperbarui data kepengurusan
    $query = "UPDATE eskul SET eskul = '$eskul', id_eskul = '$id_eskul', singkatan = '$singkatan', pembina = '$pembina', kategori = '$kategori', updated_by = '$updated_by'
              WHERE id_eskul = '$id_eskul'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi untuk menghapus data eskul
function delete_eskul($post)
{
    global $db;
    $id_eskul = strip_tags($post['id_eskul']);
    // Query untuk menghapus data anggota
    $query = "DELETE FROM eskul WHERE id_eskul = '$id_eskul'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi menambahkan data Jenis Pelanggaran
function create_jenis_pelanggaran($post)
{
    global $db;
    $nama_pelanggaran   = strip_tags($post['nama_pelanggaran']);
    $pengurangan_poin   = strip_tags($post['pengurangan_poin']);
    $created_by         = $_SESSION['id_akun'];
    // Query untuk menambahkan data anggota
    $query = "INSERT INTO jenis_pelanggaran (nama_pelanggaran, pengurangan_poin, created_by)
              VALUES ('$nama_pelanggaran', '$pengurangan_poin', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi update Jenis Pelanggaran
function update_jenis_pelanggaran($post)
{
    global $db;
    $id_jenis_pelanggaran   = strip_tags($post['id_jenis_pelanggaran']);
    $nama_pelanggaran       = strip_tags($post['nama_pelanggaran']);
    $pengurangan_poin       = strip_tags($post['pengurangan_poin']);
    $updated_by             = $_SESSION['id_akun'];
    // Query untuk memperbarui data kepengurusan
    $query = "UPDATE jenis_pelanggaran SET nama_pelanggaran = '$nama_pelanggaran', pengurangan_poin = '$pengurangan_poin', updated_by = '$updated_by'
              WHERE id_jenis_pelanggaran = '$id_jenis_pelanggaran'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi untuk menghapus data Jenis Pelanggaran
function delete_jenis_pelanggaran($post)
{
    global $db;
    $id_jenis_pelanggaran = strip_tags($post['id_jenis_pelanggaran']);
    // Query untuk menghapus data anggota
    $query = "DELETE FROM jenis_pelanggaran WHERE id_jenis_pelanggaran = '$id_jenis_pelanggaran'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi tambah data Akun
function create_akun($post)
{
    global $db;
    // Sanitasi input
    $nama           = mysqli_real_escape_string($db, strip_tags($post['nama']));
    $username       = mysqli_real_escape_string($db, strip_tags($post['username']));
    $email          = mysqli_real_escape_string($db, strip_tags($post['email']));
    $password       = strip_tags($post['password']);
    $role           = mysqli_real_escape_string($db, strip_tags($post['role']));
    $created_by     = $_SESSION['id_akun'];
    // Cek apakah username sudah terdaftar
    $check = mysqli_query($db, "SELECT username FROM akun WHERE username = '$username'");
    if (mysqli_num_rows($check) > 0) {
        return [
            'status' => false,
            'message' => 'Username sudah digunakan!'
        ];
    }
    // Enkripsi password (bcrypt)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // Gunakan prepared statement untuk keamanan lebih tinggi
    $stmt = mysqli_prepare($db, "INSERT INTO akun (nama, username, email, password, role, created_by) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssssss", $nama, $username, $email, $hashedPassword, $role, $created_by);
    mysqli_stmt_execute($stmt);
    // Cek hasil eksekusi
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        mysqli_stmt_close($stmt);
        return [
            'status' => true,
            'message' => 'Akun berhasil dibuat!'
        ];
    } else {
        mysqli_stmt_close($stmt);
        return [
            'status' => false,
            'message' => 'Gagal membuat akun!'
        ];
    }
}

// Fungsi ubah Akun
function update_akun($post)
{
    global $db;
    $id_akun      = strip_tags($post['id_akun']);
    $nama         = strip_tags($post['nama']);
    $username     = strip_tags($post['username']);
    $email        = strip_tags($post['email']);
    $password     = strip_tags($post['password']);
    $role         = strip_tags($post['role']);
    $updated_by   = $_SESSION['id_akun'];
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE akun SET nama='$nama', username='$username', email='$email', password='$password', role='$role', updated_by = '$updated_by' WHERE id_akun=$id_akun";
    } else {
        $query = "UPDATE akun SET nama='$nama', username='$username', email='$email', role='$role', updated_by = '$updated_by' WHERE id_akun=$id_akun";
    }
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi untuk menghapus data Akun
function delete_akun($data)
{
    global $db;
    $id_akun = $data['id_akun'];
    // query hapus data akun
    $query = "DELETE FROM akun WHERE id_akun = '$id_akun'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi menambahkan data Visi
function create_visi($post)
{
    global $db;
    $isi         = strip_tags($post['isi']);
    $tahun       = strip_tags($post['tahun']);
    $status      = strip_tags($post['status']);
    $created_by  = $_SESSION['id_akun'];
    // Query untuk menambahkan data anggota
    $query = "INSERT INTO visi_misi (isi, tahun, status, jenis, created_by)
              VALUES ('$isi', '$tahun', '$status', 'visi', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi ubah Visi
function update_visi($post)
{
    global $db;
    $id_visi_misi    = strip_tags($post['id_visi_misi']);
    $isi             = strip_tags($post['isi']);
    $tahun           = strip_tags($post['tahun']);
    $status          = strip_tags($post['status']);
    $updated_by      = $_SESSION['id_akun'];
    $query = "UPDATE visi_misi SET isi = '$isi', jenis = 'visi', tahun = '$tahun', status = '$status', updated_by = '$updated_by' WHERE id_visi_misi=$id_visi_misi";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi menambahkan data Misi
function create_misi($post)
{
    global $db;
    $isi         = strip_tags($post['isi']);
    $tahun       = strip_tags($post['tahun']);
    $status      = strip_tags($post['status']);
    $created_by  = $_SESSION['id_akun'];
    // Query untuk menambahkan data anggota
    $query = "INSERT INTO visi_misi (isi, tahun, status, jenis, created_by)
              VALUES ('$isi', '$tahun', '$status', 'misi', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi ubah Misi
function update_misi($post)
{
    global $db;
    $id_visi_misi    = strip_tags($post['id_visi_misi']);
    $isi             = strip_tags($post['isi']);
    $tahun           = strip_tags($post['tahun']);
    $status          = strip_tags($post['status']);
    $updated_by      = $_SESSION['id_akun'];
    $query = "UPDATE visi_misi SET isi = '$isi', jenis = 'misi', tahun = '$tahun', status = '$status', updated_by = '$updated_by' WHERE id_visi_misi=$id_visi_misi";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi menambahkan data Struktur Organisasi
function create_struktur($post)
{
    global $db;
    $jabatan    = strip_tags($post['jabatan']);
    $tahun      = strip_tags($post['tahun']);
    $urutan     = strip_tags($post['urutan']);
    $status     = strip_tags($post['status']);
    $created_by = $_SESSION['id_akun'];
    // Upload gambar
    $gambar = upload_gambar();
    if (!$gambar) {
        return false;
    }
    // Query untuk menambahkan data anggota
    $query = "INSERT INTO struktur_osis (jabatan, gambar, tahun, urutan, status, created_by)
              VALUES ('$jabatan', '$gambar', '$tahun', '$urutan', '$status', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi ubah Struktur Organisasi
function update_struktur($post)
{
    global $db;
    $id_struktur    = strip_tags($post['id_struktur']);
    $jabatan        = strip_tags($post['jabatan']);
    $tahun          = strip_tags($post['tahun']);
    $status         = strip_tags($post['status']);
    $urutan         = strip_tags($post['urutan']);
    $gambarLama     = strip_tags($post['gambarLama']);
    $updated_by     = $_SESSION['id_akun'];
    // Cek apakah ada gambar baru
    if ($_FILES['gambar']['error'] == 4) {
        // Tidak ganti gambar
        $gambar = $gambarLama;
    } else {
        // Upload gambar baru
        $gambar = upload_gambar();
        if (!$gambar) {
            return false; // hentikan jika upload gagal
        }
        // Hapus file lama
        if ($gambarLama != '') {
            unlink('../image/' . $gambarLama);
        }
    }
    $query = "UPDATE struktur_osis SET jabatan = '$jabatan', gambar = '$gambar', tahun = '$tahun', urutan = '$urutan', status = '$status', updated_by = '$updated_by' WHERE id_struktur=$id_struktur";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// Fungsi untuk mengupload Gambar
function upload_gambar()
{
    $namaFile   = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error      = $_FILES['gambar']['error'];
    $tmpName    = $_FILES['gambar']['tmp_name'];

    // Jika tidak ada file yang diupload
    if ($error === 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu!');</script>";
        return false;
    }

    // Cek ekstensi file valid
    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensiFile = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

    if (!in_array($ekstensiFile, $ekstensiValid)) {
        echo "<script>alert('Yang kamu upload bukan gambar! Format harus jpg/jpeg/png');</script>";
        return false;
    }

    // Cek ukuran maksimal 2MB
    if ($ukuranFile > 2000000) {
        echo "<script>alert('Ukuran gambar terlalu besar (max 2MB)');</script>";
        return false;
    }

    // Buat nama baru random supaya tidak bentrok
    $namaBaru = uniqid();
    $namaBaru .= '.';
    $namaBaru .= $ekstensiFile;

    // Pindahkan ke folder image
    move_uploaded_file($tmpName, '../image/' . $namaBaru);

    return $namaBaru;
}

// Fungsi menambahkan data Galeri
function create_galeri($post)
{
    global $db;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $judul   = strip_tags($post['judul']);
        $deskripsi = strip_tags($post['deskripsi']);
        $created_by = $_SESSION['id_akun'];

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
            $stmt = $db->prepare("INSERT INTO galeri (judul, gambar, deskripsi, created_by) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sss", $judul, $new_file_name, $deskripsi, $created_by);
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
}

// Fungsi update data Galeri
function update_galeri($post)
{
    global $db;
    $id          = $post['id_galeri'];
    $judul       = htmlspecialchars($post['judul']);
    $desk        = htmlspecialchars($post['deskripsi']);
    $gambar_lama = $post['gambar_lama'];
    $updated_by  = $_SESSION['id_akun'];
    // Default gambar
    $gambar = $gambar_lama;
    // Kalau user upload gambar baru
    if ($_FILES['gambar']['error'] === 0) {
        $tmp  = $_FILES['gambar']['tmp_name'];
        $ext  = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
        $newName = uniqid('galeri_', true) . ".webp"; // nama unik agar tidak bentrok
        $path    = "../image/galeri/" . $newName;

        // Konversi ke webp
        if ($ext === "jpg" || $ext === "jpeg") {
            $img = imagecreatefromjpeg($tmp);
        } elseif ($ext === "png") {
            $img = imagecreatefrompng($tmp);
            // Biar background png transparan tidak jadi hitam
            imagepalettetotruecolor($img);
            imagealphablending($img, true);
            imagesavealpha($img, true);
        } else {
            // format tidak didukung
            return false;
        }

        // Simpan ke webp dengan kualitas 80
        imagewebp($img, $path, 80);
        imagedestroy($img);

        // Hapus gambar lama kalau ada
        if ($gambar_lama && file_exists("../image/galeri/" . $gambar_lama)) {
            unlink("../image/galeri/" . $gambar_lama);
        }

        $gambar = $newName;
    }

    // Update database
    $query = "UPDATE galeri SET judul='$judul', deskripsi='$desk', gambar='$gambar', updated_by = '$updated_by' WHERE id_galeri=$id";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi untuk menghapus data Galeri
function delete_galeri($id_galeri)
{
    global $db;
    // Query untuk menghapus data galeri
    $query = "DELETE FROM galeri WHERE id_galeri = '$id_galeri'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// ============================================= //

// S E K B I D //

// SEKBID 1 //

// DOA HARIAN //
function create_doa_harian($post)
{
    global $db;
    $id_anggota   = strip_tags($post['id_anggota']);
    $tanggal      = strip_tags($post['tanggal']);
    $bacaan_doa   = strip_tags($post['bacaan_doa']);
    $nilai        = strip_tags($post['nilai']);
    $created_by   = $_SESSION['id_akun'];
    // query tambah data
    $query = "INSERT INTO tes_doa_harian (id_tes, id_anggota, tanggal, bacaan_doa, nilai, created_by) VALUES(null, '$id_anggota', '$tanggal', '$bacaan_doa', '$nilai', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delete_doa_harian($post)
{
    global $db;
    $id_tes = strip_tags($post['id_tes']);
    // query hapus data
    $query = "DELETE FROM tes_doa_harian WHERE id_tes = $id_tes";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function update_doa_harian($post)
{
    global $db;
    $id_tes       = strip_tags($post['id_tes']);
    $id_anggota   = strip_tags($post['id_anggota']);
    $tanggal      = strip_tags($post['tanggal']);
    $bacaan_doa   = strip_tags($post['bacaan_doa']);
    $nilai        = strip_tags($post['nilai']);
    $updated_by   = $_SESSION['id_akun'];
    // query ubah data
    $query = "UPDATE tes_doa_harian SET id_anggota = '$id_anggota', tanggal = '$tanggal', bacaan_doa = '$bacaan_doa', nilai = '$nilai', updated_by = '$updated_by' WHERE id_tes = $id_tes";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// HAFALAN QURAN JUZ 30 //
function create_hafalan_quran($post)
{
    global $db;
    $id_anggota   = strip_tags($post['id_anggota']);
    $tanggal      = strip_tags($post['tanggal']);
    $ayat         = strip_tags($post['ayat']);
    $nilai        = strip_tags($post['nilai']);
    $created_by   = $_SESSION['id_akun'];
    // query tambah data
    $query = "INSERT INTO hafalan_quran (id_tes, id_anggota, tanggal, ayat, nilai, created_by) VALUES (null, '$id_anggota', '$tanggal', '$ayat', '$nilai', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delete_hafalan_quran($post)
{
    global $db;
    $id_tes = strip_tags($post['id_tes']);
    // query hapus data
    $query = "DELETE FROM hafalan_quran WHERE id_tes = $id_tes";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function update_hafalan_quran($post)
{
    global $db;
    $id_tes     = strip_tags($post['id_tes']);
    $id_anggota = strip_tags($post['id_anggota']);
    $tanggal    = strip_tags($post['tanggal']);
    $ayat       = strip_tags($post['ayat']);
    $nilai      = strip_tags($post['nilai']);
    $updated_by = $_SESSION['id_akun'];
    // query ubah data
    $query = "UPDATE hafalan_quran SET id_anggota = '$id_anggota', tanggal = '$tanggal', ayat = '$ayat', nilai = '$nilai', updated_by = '$updated_by' WHERE id_tes = $id_tes";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// SEKBID 2 //

// DATA PELANGGARAN SISWA
function create_data_pelanggaran_siswa($post)
{
    global $db;
    $id_siswa              = strip_tags($post['id_siswa']);
    $id_jenis_pelanggaran  = strip_tags($post['id_jenis_pelanggaran']);
    $tanggal               = strip_tags($post['tanggal']);
    $keterangan            = strip_tags($post['keterangan']);
    $created_by            = $_SESSION['id_akun'];
    // Ambil pengurangan poin dari jenis pelanggaran
    $result           = mysqli_query($db, "SELECT pengurangan_poin FROM jenis_pelanggaran WHERE id_jenis_pelanggaran = '$id_jenis_pelanggaran'");
    $data             = mysqli_fetch_assoc($result);
    $pengurangan_poin = $data['pengurangan_poin'];
    // Kurangi poin siswa
    mysqli_query($db, "UPDATE siswa SET poin = poin - $pengurangan_poin WHERE id_siswa = '$id_siswa'");
    // Tambah data pelanggaran
    $query = "INSERT INTO pelanggaran_siswa (id_siswa, id_jenis_pelanggaran, tanggal, keterangan, created_by)
              VALUES ('$id_siswa', '$id_jenis_pelanggaran', '$tanggal', '$keterangan', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delete_data_pelanggaran_siswa($post)
{
    global $db;
    $id_pelanggaran = strip_tags($post['id_pelanggaran']);
    // query hapus data
    $query = "DELETE FROM pelanggaran_siswa WHERE id_pelanggaran = $id_pelanggaran";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function update_data_pelanggaran_siswa($post)
{
    global $db;
    $id_pelanggaran            = strip_tags($post['id_pelanggaran']);
    $id_siswa                  = strip_tags($post['id_siswa']);
    $id_jenis_pelanggaran_baru = strip_tags($post['id_jenis_pelanggaran']);
    $tanggal                   = strip_tags($post['tanggal']);
    $keterangan                = strip_tags($post['keterangan']);
    $updated_by                = $_SESSION['id_akun'];
    // Ambil jenis pelanggaran lama
    $result                    = mysqli_query($db, "SELECT id_jenis_pelanggaran FROM pelanggaran_siswa WHERE id_pelanggaran = $id_pelanggaran");
    $data_lama                 = mysqli_fetch_assoc($result);
    $id_jenis_pelanggaran_lama = $data_lama['id_jenis_pelanggaran'];
    // Ambil nilai poin lama dan baru
    $poin_lama = mysqli_fetch_assoc(mysqli_query($db, "SELECT pengurangan_poin FROM jenis_pelanggaran WHERE id_jenis_pelanggaran = '$id_jenis_pelanggaran_lama'"))['pengurangan_poin'];
    $poin_baru = mysqli_fetch_assoc(mysqli_query($db, "SELECT pengurangan_poin FROM jenis_pelanggaran WHERE id_jenis_pelanggaran = '$id_jenis_pelanggaran_baru'"))['pengurangan_poin'];
    // Kembalikan poin lama dulu
    mysqli_query($db, "UPDATE siswa SET poin = poin + $poin_lama WHERE id_siswa = $id_siswa");
    // Kurangi dengan poin baru
    mysqli_query($db, "UPDATE siswa SET poin = poin - $poin_baru WHERE id_siswa = $id_siswa");
    // Update data pelanggaran
    $query_update = "
        UPDATE pelanggaran_siswa 
        SET id_siswa = '$id_siswa', 
            tanggal = '$tanggal', 
            id_jenis_pelanggaran = '$id_jenis_pelanggaran_baru', 
            keterangan = '$keterangan',
            updated_by = '$updated_by' 
        WHERE id_pelanggaran = $id_pelanggaran
    ";
    mysqli_query($db, $query_update);
    return mysqli_affected_rows($db);
}

// JADWAL RAZIA //
function create_jadwal_razia($post)
{
    global $db;
    $id_razia    = strip_tags($post['id_razia']);
    $tanggal     = strip_tags($post['tanggal']);
    $jenis_razia = strip_tags($post['jenis_razia']);
    $petugas     = strip_tags($post['petugas']);
    $keterangan  = strip_tags($post['keterangan']);
    $created_by  = $_SESSION['id_akun'];
    // Tambah data pelanggaran
    $query = "INSERT INTO jadwal_razia (id_razia, tanggal, jenis_razia, petugas, keterangan, created_by)
              VALUES ('$id_razia', '$tanggal', '$jenis_razia', '$petugas', '$keterangan', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delete_jadwal_razia($post)
{
    global $db;
    $id_razia = strip_tags($post['id_razia']);
    // query hapus data
    $query = "DELETE FROM jadwal_razia WHERE id_razia = $id_razia";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function update_jadwal_razia($post)
{
    global $db;
    $id_razia     = strip_tags($post['id_razia']);
    $tanggal      = strip_tags($post['tanggal']);
    $jenis_razia  = strip_tags($post['jenis_razia']);
    $petugas      = strip_tags($post['petugas']);
    $keterangan   = strip_tags($post['keterangan']);
    $updated_by   = $_SESSION['id_akun'];
    $query = "UPDATE jadwal_razia SET  tanggal = '$tanggal', jenis_razia = '$jenis_razia', petugas = '$petugas', keterangan = '$keterangan', updated_by = '$updated_by' WHERE id_razia = $id_razia";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// JADWAL RAZIA //
function create_jaga_barisan($post)
{
    global $db;
    $id_razia     = strip_tags($post['id_razia']);
    $tanggal      = strip_tags($post['tanggal']);
    $jenis_razia  = strip_tags($post['jenis_razia']);
    $petugas      = strip_tags($post['petugas']);
    $keterangan   = strip_tags($post['keterangan']);
    $created_by   = $_SESSION['id_akun'];
    // Tambah data pelanggaran
    $query = "INSERT INTO jadwal_jaga_barisan (id_razia, tanggal, jenis_razia, petugas, keterangan, created_by)
              VALUES ('$id_razia', '$tanggal', '$jenis_razia', '$petugas', '$keterangan', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delete_jaga_barisan($post)
{
    global $db;
    $id_razia = strip_tags($post['id_razia']);
    // query hapus data
    $query = "DELETE FROM jadwal_jaga_barisan WHERE id_razia = $id_razia";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function update_jaga_barisan($post)
{
    global $db;
    $id_razia     = strip_tags($post['id_razia']);
    $tanggal      = strip_tags($post['tanggal']);
    $jenis_razia  = strip_tags($post['jenis_razia']);
    $petugas      = strip_tags($post['petugas']);
    $keterangan   = strip_tags($post['keterangan']);
    $updated_by   = $_SESSION['id_akun'];
    $query = "UPDATE jadwal_jaga_barisan SET  tanggal = '$tanggal', jenis_razia = '$jenis_razia', petugas = '$petugas', keterangan = '$keterangan', updated_by = '$updated_by' WHERE id_razia = $id_razia";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// SEKBID 4, 7, 8 //

// ANGGOTA ESKUL //
function create_data_anggota_eskul($post)
{
    global $db;
    $id_siswa   = strip_tags($post['id_siswa']);
    $id_eskul   = strip_tags($post['id_eskul']);
    $jabatan    = strip_tags($post['jabatan']);
    $no_hp      = strip_tags($post['no_hp']);
    $created_by = $_SESSION['id_akun'];
    // Tambah data pelanggaran
    $query = "INSERT INTO anggota_eskul (id_siswa, id_eskul, jabatan, no_hp, created_by)
              VALUES ('$id_siswa', '$id_eskul', '$jabatan', '$no_hp', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delete_data_anggota_eskul($post)
{
    global $db;
    $id_anggota_eskul = strip_tags($post['id_anggota_eskul']);
    // query hapus data
    $query = "DELETE FROM anggota_eskul WHERE id_anggota_eskul = $id_anggota_eskul";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function update_data_anggota_eskul($post)
{
    global $db;
    $id_anggota_eskul = strip_tags($post['id_anggota_eskul']);
    $id_siswa         = strip_tags($post['id_siswa']);
    $id_eskul         = strip_tags($post['id_eskul']);
    $jabatan          = strip_tags($post['jabatan']);
    $no_hp            = strip_tags($post['no_hp']);
    $updated_by       = $_SESSION['id_akun'];
    $query = "UPDATE anggota_eskul SET  id_siswa = '$id_siswa', id_eskul = '$id_eskul', jabatan = '$jabatan', no_hp = '$no_hp', updated_by = '$updated_by' WHERE id_anggota_eskul = $id_anggota_eskul";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// JADWAL ESKUL //
function create_jadwal_eskul($post)
{
    global $db;
    $id_eskul       = strip_tags($post['id_eskul']);
    $tanggal        = strip_tags($post['tanggal']);
    $waktu_mulai    = strip_tags($post['waktu_mulai']);
    $waktu_selesai  = strip_tags($post['waktu_selesai']);
    $tempat         = strip_tags($post['tempat']);
    $keterangan     = strip_tags($post['keterangan']);
    $created_by     = $_SESSION['id_akun'];
    $query = "INSERT INTO jadwal_eskul (id_eskul, tanggal, waktu_mulai, waktu_selesai, tempat, keterangan, created_by)
              VALUES ('$id_eskul', '$tanggal', '$waktu_mulai', '$waktu_selesai', '$tempat', '$keterangan', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delete_jadwal_eskul($post)
{
    global $db;
    $id_jadwal = strip_tags($post['id_jadwal']);
    // query hapus data
    $query = "DELETE FROM jadwal_eskul WHERE id_jadwal = $id_jadwal";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function update_jadwal_eskul($post)
{
    global $db;
    $id_jadwal      = strip_tags($post['id_jadwal']);
    $id_eskul       = strip_tags($post['id_eskul']);
    $tanggal        = strip_tags($post['tanggal']);
    $waktu_mulai    = strip_tags($post['waktu_mulai']);
    $waktu_selesai  = strip_tags($post['waktu_selesai']);
    $tempat         = strip_tags($post['tempat']);
    $keterangan     = strip_tags($post['keterangan']);
    $updated_by     = $_SESSION['id_akun'];
    $query = "UPDATE jadwal_eskul SET  tanggal = '$tanggal', id_eskul = '$id_eskul', waktu_mulai = '$waktu_mulai', waktu_selesai = '$waktu_selesai', tempat = '$tempat', keterangan = '$keterangan', updated_by = '$updated_by' WHERE id_jadwal = $id_jadwal";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// SEKBID 5 //

// PRODUK //
function create_produk_osis($post)
{
    global $db;
    $nama_produk = strip_tags($post['nama_produk']);
    $kategori    = strip_tags($post['kategori']);
    $harga_jual  = strip_tags($post['harga_jual']);
    $stok        = strip_tags($post['stok']);
    $deskripsi   = strip_tags($post['deskripsi']);
    $created_by  = $_SESSION['id_akun'];
    // $foto_produk = strip_tags($post['foto_produk']);
    $query = "INSERT INTO produk_osis (nama_produk, kategori, harga_jual, stok, deskripsi, foto_produk, created_by)
              VALUES ('$nama_produk', '$kategori', '$harga_jual', '$stok', '$deskripsi', null, '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delete_produk_osis($post)
{
    global $db;
    $id_produk = strip_tags($post['id_produk']);
    // query hapus data
    $query = "DELETE FROM produk_osis WHERE id_produk = $id_produk";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function update_produk_osis($post)
{
    global $db;
    $id_produk   = strip_tags($post['id_produk']);
    $nama_produk = strip_tags($post['nama_produk']);
    $kategori    = strip_tags($post['kategori']);
    $harga_jual  = strip_tags($post['harga_jual']);
    $stok        = strip_tags($post['stok']);
    $deskripsi   = strip_tags($post['deskripsi']);
    $updated_by  = $_SESSION['id_akun'];
    // $foto_produk = strip_tags($post['foto_produk']);
    $query = "UPDATE produk_osis SET nama_produk = '$nama_produk', kategori = '$kategori', harga_jual = '$harga_jual', stok = '$stok', deskripsi = '$deskripsi', foto_produk = null, updated_by = '$updated_by' WHERE id_produk = $id_produk";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// TRANSAKSI //
function create_transaksi_osis($post)
{
    global $db;
    $id_produk  = strip_tags($post['id_produk']);
    $jumlah     = strip_tags($post['jumlah']);
    $tanggal    = strip_tags($post['tanggal']);
    $jenis      = strip_tags($post['jenis']); // Penjualan / Pembelian
    $keterangan = strip_tags($post['keterangan']);
    $created_by = $_SESSION['id_akun'];
    // Ambil data produk
    $produk     = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk_osis WHERE id_produk = '$id_produk'"));
    $harga_jual = $produk['harga_jual'];
    $total      = $jumlah * $harga_jual;
    // Simpan transaksi
    $queryTransaksi = "INSERT INTO transaksi_osis (id_produk, jumlah, total, tanggal, jenis, keterangan, created_by)
                       VALUES ('$id_produk', '$jumlah', '$total', '$tanggal', '$jenis', '$keterangan', '$created_by')";
    mysqli_query($db, $queryTransaksi);
    // Update stok dan keuangan
    if ($jenis == 'Penjualan') {
        mysqli_query($db, "UPDATE produk_osis SET stok = stok - $jumlah WHERE id_produk = '$id_produk'");
        mysqli_query($db, "INSERT INTO keuangan_osis (tanggal, deskripsi, jenis, nominal, created_by)
                           VALUES ('$tanggal', 'Penjualan {$produk['nama_produk']}', 'Pemasukan', '$total', '$created_by')");
    } else {
        mysqli_query($db, "UPDATE produk_osis SET stok = stok + $jumlah WHERE id_produk = '$id_produk'");
        mysqli_query($db, "INSERT INTO keuangan_osis (tanggal, deskripsi, jenis, nominal, created_by)
                           VALUES ('$tanggal', 'Pembelian {$produk['nama_produk']}', 'Pengeluaran', '$total', '$created_by')");
    }
    return mysqli_affected_rows($db);
}

function delete_transaksi_osis($post)
{
    global $db;
    $id_produk = strip_tags($post['id_produk']);
    // query hapus data
    $query = "DELETE FROM transaksi_osis WHERE id_produk = $id_produk";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function update_transaksi_osis($post)
{
    global $db;
    $id_produk   = strip_tags($post['id_produk']);
    $nama_produk = strip_tags($post['nama_produk']);
    $kategori    = strip_tags($post['kategori']);
    $harga_jual  = strip_tags($post['harga_jual']);
    $stok        = strip_tags($post['stok']);
    $deskripsi   = strip_tags($post['deskripsi']);
    $updated_by  = $_SESSION['id_akun'];
    // $foto_produk = strip_tags($post['foto_produk']);
    $query = "UPDATE transaksi_osis SET nama_produk = '$nama_produk', kategori = '$kategori', harga_jual = '$harga_jual', stok = '$stok', deskripsi = '$deskripsi', foto_produk = null, updated_by = '$updated_by' WHERE id_produk = $id_produk";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// SEKBID 6 //

// JADWAL UPACARA //
function create_jadwal_upacara($post)
{
    global $db;
    $tanggal         = strip_tags($post['tanggal']);
    $jenis_petugas   = strip_tags($post['jenis_petugas']);
    $tema            = strip_tags($post['tema']);
    $pembina_upacara = strip_tags($post['pembina_upacara']);
    $keterangan      = strip_tags($post['keterangan']);
    $id_kelas = strip_tags($post['id_kelas']);
    $created_by      = $_SESSION['id_akun'];
    if ($jenis_petugas == 'kelas') {
        mysqli_query($db, "INSERT INTO jadwal_upacara (tanggal, jenis_petugas, id_kelas, tema, pembina_upacara, keterangan, created_by) VALUES ('$tanggal', 'kelas', '$id_kelas', '$tema', '$pembina_upacara', '$keterangan', '$created_by')");
    } else {
        // Gabungan OP3 → kita bisa pakai id_kelas NULL dan tandai jenis_petugas='op3'
        mysqli_query($db, "INSERT INTO jadwal_upacara (tanggal, jenis_petugas, id_kelas, tema, pembina_upacara, keterangan, created_by) VALUES ('$tanggal', 'op3', NULL, '$tema', '$pembina_upacara', '$keterangan', '$created_by')");
    }
    return mysqli_affected_rows($db);
}

function update_jadwal_upacara($post)
{
    global $db;
    $id_jadwal         = strip_tags($post['id_jadwal']);
    $tanggal           = strip_tags($post['tanggal']);
    $jenis_petugas     = strip_tags($post['jenis_petugas']);
    $tema              = strip_tags($post['tema']);
    $pembina_upacara   = strip_tags($post['pembina_upacara']);
    $keterangan        = strip_tags($post['keterangan']);
    $updated_by        = $_SESSION['id_akun'];
    if ($jenis_petugas == 'kelas') {
        $id_kelas = strip_tags($post['id_kelas']);
        $query = "UPDATE jadwal_upacara SET tanggal = '$tanggal', jenis_petugas = 'kelas', id_kelas = '$id_kelas', tema = '$tema', pembina_upacara = '$pembina_upacara', keterangan = '$keterangan', updated_by = '$updated_by' WHERE id_jadwal = '$id_jadwal'";
    } else {
        // Gabungan OP3 → kita bisa pakai id_kelas NULL dan tandai jenis_petugas='op3'
        $query = "UPDATE jadwal_upacara SET tanggal = '$tanggal', jenis_petugas = 'op3', id_kelULL, tema = '$tema', pembina_upacara = '$pembina_upacara', keterangan = '$keterangan', updated_by = '$updated_by' WHERE id_jadwal = '$id_jadwal'";
    }
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delete_jadwal_upacara($post)
{
    global $db;
    $id_jadwal = strip_tags($post['id_jadwal']);
    $query     = "DELETE FROM jadwal_upacara WHERE id_jadwal='$id_jadwal'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

// PETUGAS UPACARA //
function create_petugas_upacara($post)
{
    global $db;
    $id_jadwal = $_GET['id_jadwal'];
    $id_siswa  = strip_tags($post['id_siswa']);
    $peran     = strip_tags($post['peran']);
    $created_by = $_SESSION['id_akun'];
    $query     = "INSERT INTO petugas_upacara (id_jadwal, id_siswa, peran, created_by) VALUES ('$id_jadwal', '$id_siswa', '$peran', '$created_by')";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function update_petugas_upacara($post)
{
    global $db;
    $id_jadwal         = $_GET['id_jadwal'];
    $id_petugas           = strip_tags($post['id_petugas']);
    $id_siswa           = strip_tags($post['id_siswa']);
    $peran              = strip_tags($post['peran']);
    $updated_by        = $_SESSION['id_akun'];
    $query = "UPDATE petugas_upacara SET id_siswa = '$id_siswa', id_jadwal = '$id_jadwal', peran = '$peran', updated_by = '$updated_by' WHERE id_petugas = '$id_petugas'";

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delete_petugas_upacara($post)
{
    global $db;
    $id_petugas = strip_tags($post['id_petugas']);
    $query      = "DELETE FROM petugas_upacara WHERE id_petugas='$id_petugas'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}
// ============================================= //