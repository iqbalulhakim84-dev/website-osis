<?php
$servername = "localhost";  // Sesuaikan dengan server database
$username   = "root";       // Sesuaikan dengan username database
$password   = "";           // Sesuaikan dengan password database
$dbname     = "db_osismk"; // Ganti dengan nama database kamu

$db = mysqli_connect('localhost', 'root', '', 'db_osismk');
if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>