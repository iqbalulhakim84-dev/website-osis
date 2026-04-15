<?php
session_start();

// // Membatasi halaman sebelum login
// if (!isset($_SESSION["login"])) {
//     echo "<script>
//         alert('Login dulu');
//         document.location.href = 'login.php';
//     </script>";
//     exit;
// }

// Kosongkan $_SESSION user login
$_SESSION = [];

session_unset();
session_destroy();
header('Location: ../index.php');
exit;