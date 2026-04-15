<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$role = $_SESSION['role'] ?? null;

// Arahkan ke path yang benar sesuai role
switch ($role) {
    case 'Admin':
    case 'Anggota':
        include '../config/app.php';
        break;
    default:
        include 'config/app.php';
        break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
        <title>OSIS SMK PGRI 1 CIMAHI</title>
        <link rel="icon" href="../image/Logo OSIS 1.png" type="image/png">
    <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'Anggota'): ?>
        <title>OSIS SMK PGRI 1 CIMAHI</title>
        <link rel="icon" href="../image/Logo OSIS 1.png" type="image/png">
    <?php else: ?>
        <title>OSIS SMK PGRI 1 CIMAHI</title>
        <link rel="icon" href="image/Logo OSIS 1.png" type="image/png">
    <?php endif; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        /* ===== GLOBAL STYLES ===== */
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            padding: 0 15px;
            margin: 0 auto;
        }

        .container-fluid {
            width: 100%;
            padding: 0;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        /* ===== NAVBAR STYLES ===== */
        .navbar {
            min-height: 100px;
            background-color: #800000;
        }

        .navbar-brand img {
            height: 65px;
            margin: 5px;
        }

        .navbar-brand {
            display: flex;
            align-items: left;
        }

        /* ===== DROPDOWN STYLES - CLICK ONLY ===== */
        .dropdown-toggle::after {
            content: "▾";
            margin-left: 8px;
            border: none !important;
            font-size: 16px;
            transition: transform 0.3s ease;
            display: inline-block !important;
        }

        .dropdown-toggle[aria-expanded="true"]::after {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            background-color: #700000;
            border: none;
            border-radius: 5px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: none !important;
        }

        .dropdown-item {
            color: #ffffff !important;
            padding: 10px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: background-color 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* ===== DROPDOWN SUBMENU STYLES ===== */
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-toggle::after {
            content: "▸";
            margin-left: auto;
            float: right;
            border: none !important;
        }

        .dropdown-submenu>.dropdown-toggle[aria-expanded="true"]::after {
            content: "▾";
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
            margin-left: -1px;
            display: none !important;
            position: absolute;
            background-color: #600000;
            z-index: 1001;
        }

        /* SHOW CLASS UNTUK SEMUA DROPDOWN */
        /* .dropdown.show>.dropdown-menu, */
        .dropdown-submenu.show>.dropdown-menu {
            display: block !important;
        }

        /* ==== SUBMENU HOVER (Desktop) ==== */
        @media (min-width: 992px) {
            .dropdown-submenu {
                position: relative;
            }

            .dropdown-submenu>.dropdown-menu {
                top: 0;
                left: 100%;
                margin-top: -6px;
                margin-left: -1px;
                background-color: #600000;
                display: none;
            }

            .dropdown-submenu:hover>.dropdown-menu {
                display: block !important;
                animation: fadeIn 0.2s ease-in-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(5px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== OFFCANVAS MOBILE STYLES ===== */
        @media (max-width: 992px) {
            .navbar-brand {
                font-size: 14px;
                margin-right: 0;
                flex-wrap: nowrap;
                max-width: 70%;
            }

            .navbar-brand img {
                height: 40px !important;
                margin-right: 8px;
            }

            .navbar-brand span {
                font-size: 13px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .navbar>.container-fluid {
                padding: 0 15px;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .navbar {
                min-height: 70px;
                padding: 8px 0;
            }

            .navbar-toggler {
                border: 1px solid rgba(255, 255, 255, 0.5);
                padding: 4px 8px !important;
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-left: auto;
                order: 2;
            }

            .navbar-toggler-icon {
                width: 20px;
                height: 20px;
            }

            .navbar-brand {
                order: 1;
                flex-shrink: 1;
            }

            .offcanvas {
                background-color: #800000 !important;
            }

            .offcanvas-header {
                background-color: #700000;
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
                padding: 15px 20px;
            }

            .offcanvas-body {
                padding: 0;
            }

            .offcanvas-body .navbar-nav {
                padding: 10px 0;
            }

            .offcanvas-body .nav-item {
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .offcanvas-body .nav-link {
                color: #ffffff !important;
                padding: 12px 20px;
                font-size: 15px;
            }

            .offcanvas-body .dropdown-menu {
                background-color: #700000 !important;
                border: none;
                border-radius: 0;
                margin: 0;
                width: 100%;
            }

            .offcanvas-body .dropdown-item {
                color: #ffffff !important;
                padding: 10px 30px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            /* Mobile submenu styling */
            .offcanvas-body .dropdown-submenu>.dropdown-menu {
                background-color: #600000 !important;
                margin-left: 20px;
                width: calc(100% - 40px);
                position: static !important;
            }

            /* Offcanvas dropdown arrows */
            .offcanvas-body .dropdown-toggle::after {
                content: "▸";
                margin-left: auto;
                float: right;
            }

            .offcanvas-body .dropdown-toggle[aria-expanded="true"]::after {
                content: "▾";
            }
        }

        /* ===== EXTRA SMALL DEVICES ===== */
        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 12px;
                max-width: 80%;
            }

            .navbar-brand img {
                height: 35px !important;
                margin-right: 6px;
            }

            .navbar-brand span {
                font-size: 12px;
            }

            .navbar {
                min-height: 65px;
                padding: 6px 0;
            }

            .navbar-toggler {
                width: 36px;
                height: 36px;
                padding: 3px 6px !important;
            }

            .navbar-toggler-icon {
                width: 18px;
                height: 18px;
            }

            .offcanvas {
                width: 85% !important;
            }

            .offcanvas-body .nav-link {
                padding: 10px 15px;
                font-size: 14px;
            }

            .container-fluid {
                padding: 0 10px;
            }
        }

        /* ===== CARD STYLES ===== */
        .card {
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-img-top:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        /* ===== BUTTON STYLES ===== */
        button.tambah-btn {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 15px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
            width: 10%;
        }

        button.tambah-btn:hover {
            background-color: #0056b3;
        }

        /* ===== CAROUSEL STYLES ===== */
        .carousel-item img {
            height: 500px;
            object-fit: cover;
        }

        /* ===== FOOTER STYLES ===== */
        footer {
            background-color: #333;
            color: #ffffff;
            padding: 20px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin-bottom: 8px;
            font-size: 14px;
        }

        footer a {
            color: #ffffff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #f0f0f0;
            text-decoration: underline;
        }

        /* ===== MISC STYLES ===== */
        .profil {
            width: 200px;
            height: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 14px;
        }

        h2,
        h3 {
            margin-bottom: 20px;
        }

        /* Pastikan submenu tampil di samping kanan */
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
            margin-left: -1px;
            display: none;
            position: absolute;
            background-color: #600000;
        }

        /* Saat show */
        .dropdown-menu.show {
            display: block !important;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
                    <img src="../image/logo pgri.png" alt="Logo PGRI" height="40" class="me-2">
                    <img src="../image/Logo OSIS 1.png" alt="Logo OSIS" height="40" class="me-2">
                <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'Anggota'): ?>
                    <img src="../image/logo pgri.png" alt="Logo PGRI" height="40" class="me-2">
                    <img src="../image/Logo OSIS 1.png" alt="Logo OSIS" height="40" class="me-2">
                <?php else: ?>
                    <img src="image/logo pgri.png" alt="Logo PGRI" height="40" class="me-2">
                    <img src="image/Logo OSIS 1.png" alt="Logo OSIS" height="40" class="me-2">
                <?php endif; ?>
                <span class="fw-bold">OSIS SMK PGRI 1 CIMAHI</span>
            </a>

            <!-- Tombol Toggler -->
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Offcanvas Menu -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel" style="background-color: #800000;">
                <div class="offcanvas-header" style="background-color: #700000; border-bottom: 1px solid rgba(255,255,255,0.1);">
                    <h5 class="offcanvas-title text-white" id="offcanvasNavbarLabel">
                        Navigasi Menu
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
                            <!-- Menu Admin -->
                            <li class="nav-item">
                                <a class="nav-link text-white" href="index.php"><i class="fas fa-home"></i> Home</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" role="button" aria-expanded="false">
                                    <i class="fas fa-database"></i> Data Internal
                                </a>
                                <ul class="dropdown-menu" style="background-color: #700000;">
                                    <li><a class="dropdown-item text-white" href="data-anggota-admin.php"> Data Anggota</a></li>
                                    <li><a class="dropdown-item text-white" href="data-kepengurusan-admin.php"> Data Kepengurusan</a></li>
                                    <li><a class="dropdown-item text-white" href="data-kegiatan-event-admin.php"> Data Kegiatan Event</a></li>
                                    <li><a class="dropdown-item text-white" href="data-pelantikan-admin.php"> Data Pelantikan</a></li>
                                    <li><a class="dropdown-item text-white" href="data-organisasi-luar-admin.php"> Data Organisasi Luar</a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" role="button" aria-expanded="false">
                                    <i class="fas fa-database"></i> Data
                                </a>
                                <ul class="dropdown-menu" style="background-color: #700000;">
                                    <li><a class="dropdown-item text-white" href="data-siswa.php"> Data Siswa</a></li>
                                    <li><a class="dropdown-item text-white" href="data-kelas.php"> Data Kelas</a></li>
                                    <li><a class="dropdown-item text-white" href="infaq.php"> Data Keuangan Infaq</a></li>
                                    <li><a class="dropdown-item text-white" href="data-eskul.php"> Data Eskul</a></li>
                                    <li><a class="dropdown-item text-white" href="data-acara-admin.php"> Acara Sekolah Mendatang</a></li>
                                </ul>
                            </li>

                            <li class="nav-item"><a class="nav-link text-white" href="galery.php"><i class="fas fa-images"></i> Galery</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="profil.php"><i class="fas fa-user"></i> Profil</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="akun.php"><i class="fas fa-user-cog"></i> Akun</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>

                        <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'Anggota'): ?>
                            <!-- Menu Anggota -->
                            <li class="nav-item">
                                <a class="nav-link text-white" href="index.php"><i class="fas fa-home"></i> Home</a>
                            </li>

                            <!-- Sekbid Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" role="button" aria-expanded="false">
                                    <i class="fas fa-book"></i> Sekbid
                                </a>
                                <ul class="dropdown-menu" style="background-color: #700000;">
                                    <!-- Sekbid 1 -->
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle text-white" href="#" role="button">
                                            Sekbid 1
                                        </a>
                                        <ul class="dropdown-menu" style="background-color: #600000;">
                                            <li><a class="dropdown-item text-white" href="s1-dh.php"> Tes Doa Harian</a></li>
                                            <li><a class="dropdown-item text-white" href="s1-hq.php"> Tes Hafalan Quran</a></li>
                                        </ul>
                                    </li>

                                    <!-- Sekbid 2 -->
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle text-white" href="#" role="button">
                                            Sekbid 2
                                        </a>
                                        <ul class="dropdown-menu" style="background-color: #600000;">
                                            <li><a class="dropdown-item text-white" href="s2-dps.php"> Data Pelanggaran Siswa</a></li>
                                            <li><a class="dropdown-item text-white" href="s2-jr.php"> Jadwal Razia</a></li>
                                            <li><a class="dropdown-item text-white" href="s2-jpg.php"> Jadwal Piket Gerbang</a></li>
                                            <li><a class="dropdown-item text-white" href="s2-jpb.php"> Jadwal Piket Barisan</a></li>
                                        </ul>
                                    </li>

                                    <!-- Sekbid 3 -->
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle text-white" href="#" role="button">
                                            Sekbid 3
                                        </a>
                                        <ul class="dropdown-menu" style="background-color: #600000;">
                                            <li><a class="dropdown-item text-white" href="s3-dak.php"> Data Acara Kenegaraan</a></li>
                                        </ul>
                                    </li>

                                    <!-- Sekbid 4 -->
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle text-white" href="#" role="button">
                                            Sekbid 4
                                        </a>
                                        <ul class="dropdown-menu" style="background-color: #600000;">
                                            <li><a class="dropdown-item text-white" href="s4-dsop3.php"> Data Struktur OP3</a></li>
                                        </ul>
                                    </li>

                                    <!-- Sekbid 5 -->
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle text-white" href="#" role="button">
                                            Sekbid 5
                                        </a>
                                        <ul class="dropdown-menu" style="background-color: #600000;">
                                            <li><a class="dropdown-item text-white" href="s5-dkwu.php"> Data Kewirausahaan</a></li>
                                        </ul>
                                    </li>

                                    <!-- Sekbid 6 -->
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle text-white" href="#" role="button">
                                            Sekbid 6
                                        </a>
                                        <ul class="dropdown-menu" style="background-color: #600000;">
                                            <li><a class="dropdown-item text-white" href="s6-ju.php"> Jadwal Upacara</a></li>
                                        </ul>
                                    </li>

                                    <!-- Sekbid 7 -->
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle text-white" href="#" role="button">
                                            Sekbid 7
                                        </a>
                                        <ul class="dropdown-menu" style="background-color: #600000;">
                                            <li><a class="dropdown-item text-white" href="s7-deo.php"> Data Eskul Olahraga</a></li>
                                        </ul>
                                    </li>

                                    <!-- Sekbid 8 -->
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle text-white" href="#" role="button">
                                            Sekbid 8
                                        </a>
                                        <ul class="dropdown-menu" style="background-color: #600000;">
                                            <li><a class="dropdown-item text-white" href="s8-dek.php"> Data Eskul Kesenian</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item"><a class="nav-link text-white" href="galery.php"><i class="fas fa-images"></i> Galery</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="profil.php"><i class="fas fa-user"></i> Profil</a></li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                            </li>

                        <?php else: ?>
                            <!-- Menu Guest -->
                            <li class="nav-item">
                                <a class="nav-link text-white" href="index.php"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" role="button" aria-expanded="false">
                                    <i class="fas fa-database"></i> Data
                                </a>
                                <ul class="dropdown-menu" style="background-color: #700000;">
                                    <li><a class="dropdown-item text-white" href="data-anggota.php">Data Anggota</a></li>
                                    <li><a class="dropdown-item text-white" href="data-kepengurusan.php">Data Kepengurusan</a></li>
                                    <li><a class="dropdown-item text-white" href="data-kegiatan-event.php">Data Kegiatan Event</a></li>
                                    <li><a class="dropdown-item text-white" href="data-pelantikan.php">Data Pelantikan</a></li>
                                    <li><a class="dropdown-item text-white" href="data-organisasi-luar.php">Data Organisasi Luar</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="galery.php"><i class="fas fa-images"></i> Galery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="profil.php"><i class="fas fa-user"></i> Profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="admin/login.php"><i class="fas fa-lock"></i> Login</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // === Klik Dropdown Utama (Sekbid) ===
            const dropdownToggles = document.querySelectorAll('.dropdown > .dropdown-toggle');

            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', e => {
                    e.preventDefault();
                    e.stopPropagation();

                    document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                        if (menu !== toggle.nextElementSibling) menu.classList.remove('show');
                    });

                    toggle.nextElementSibling.classList.toggle('show');
                });
            });

            // === Klik Submenu di Mobile ===
            const subDropdownToggles = document.querySelectorAll('.dropdown-submenu > .dropdown-toggle');
            subDropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', e => {
                    // Hanya aktif di mobile (layar kecil)
                    if (window.innerWidth < 992) {
                        e.preventDefault();
                        e.stopPropagation();
                        toggle.nextElementSibling.classList.toggle('show');
                    }
                });
            });

            // === Tutup semua dropdown jika klik di luar ===
            document.addEventListener('click', e => {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu.show').forEach(menu => menu.classList.remove('show'));
                }
            });
        });
    </script>

</body>

</html>