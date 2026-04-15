<?php
session_start();
include '../config/app.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $result = mysqli_query($db, "SELECT * FROM akun WHERE username ='$username'");

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password yang sudah di-hash
        if (password_verify($password, $user['password'])) {
            // Jika cocok
            $_SESSION['login']     = true;
            $_SESSION['id_akun']   = $user['id_akun'];
            $_SESSION['nama']      = $user['nama'];
            $_SESSION['username']  = $user['username'];
            $_SESSION['email']     = $user['email'];
            $_SESSION['role']      = $user['role'];

            header("Location: index.php");
            exit;
        }
    }

    // Jika username atau password salah
    $error = true;
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OSIS SMK PGRI 1 CIMAHI</title>
    <link rel="icon" href="../image/Logo OSIS 1.png" type="image/png">

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">

    <!-- Custom styles for this template -->
    <link href="assets/css/signin.css" rel="stylesheet">
    <style>
        /* signin.css */
        body {
            background-color:burlywood ;
        }

        /* Tambahkan gaya ini pada elemen pembungkus form, misalnya body atau div yang membungkus form */
        .container {
            position: relative;
            height: 100vh;
            /* Mengatur tinggi kontainer agar sesuai dengan tinggi viewport */
        }

        /* Gaya form itu sendiri */
        .form-signin {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            /* Mengatur posisi form ke tengah dengan transformasi */
            max-width: 400px;
            padding: 15px;
        }


        .form-signin .form-floating {
            margin-bottom: 15px;
        }

        .form-signin img {
            margin-bottom: 15px;
        }

        .form-signin .form-control {
            border-radius: 0.25rem;
        }

        .form-signin .btn-primary {
            border-radius: 0.25rem;
        }

        .alert {
            margin-top: 15px;
        }
    </style>
</head>

<body class="text-center">

    <main class="form-signin">
        <form action="" method="POST">
            <img class="mb-2" src="../image/logopgri.png" alt="" width="100" height="80">
            <img class="mb-2" src="../image/logo OSIS 1.png" alt="" width="80" height="80">

            <h1 class="">Admin Login</h1>

            <?php if (isset($error)) : ?>
                <div class="alert alert-danger text-center">
                    <b>Username/Password Salah</b>
                </div>
            <?php endif; ?>

            <div class="form-floating">
                <input type="text" name="username" class="form-control" id="floatingInput"
                    placeholder="Username..." required>
                <label for="floatingInput">Username</label>
            </div>

            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword"
                    placeholder="Password..." required>
                <label for="floatingPassword">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-danger" type="submit" name="login">Login</button>
            <p class="mt-5 mb-3 text-muted">&copy; SMK PGRI 1 CIMAHI </p>
        </form>
    </main>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</html>