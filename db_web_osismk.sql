-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2026 at 01:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_osismk`
--

-- --------------------------------------------------------

--
-- Table structure for table `acara`
--

CREATE TABLE `acara` (
  `id_acara` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL,
  `jam` varchar(20) NOT NULL,
  `tempat` varchar(100) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acara`
--

INSERT INTO `acara` (`id_acara`, `judul`, `deskripsi`, `tanggal`, `jam`, `tempat`, `gambar`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'CPD', 'cpd di ph 50', '2025-10-10', '07.00', 'PH 50', 'acara_1756732244.png', NULL, '2025-10-28 14:27:31', NULL, '2025-10-28 14:27:31'),
(2, 'Debat & Pilketos', 'Debat & Pemilihan Ketua OSIS Periode 2025/2026', '2025-11-24', '07.00', 'SMK PGRI 1 CIMAHI', 'acara_1762955879.jpeg', NULL, '2025-11-12 20:57:59', 11, '2025-11-12 21:02:57'),
(3, 'Peringatan Hari Guru', 'Peringatan Hari Guru & HUT PGRI', '2025-11-25', '07.00', 'SMK PGRI 1 Cimahi', 'acara_1762956268.png', 11, '2025-11-12 21:04:28', NULL, '2025-11-12 21:04:28'),
(4, 'PORSENI', 'Porseni EXTRAVAGANZA \"Sport and Art Celebration\" SMK PGRI 1 CIMAHI ', '2025-12-15', '07.00', 'SMK PGRI 1 CIMAHI ', NULL, 11, '2025-12-27 10:47:27', NULL, '2025-12-27 10:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('Admin','Anggota') NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `nama`, `username`, `email`, `password`, `role`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(11, 'Iqbalul Hakim', 'dsa', 'dsa@gmail.com', '$2y$10$UYZzi8hZFC1GzG5AQtjHpuB1zg2vqFWTduSUmhbKwz0nznsmk9xny', 'Admin', NULL, '2025-10-28 14:27:31', 11, '2025-10-28 19:46:11'),
(12, 'Hakim Iqbalul', 'asd', 'asd@gmail.com', '$2y$10$12Pmm0/bMtx5IiG04th2feqsrk7gxNo4rto83UfIYLVuD5D5R7y9m', 'Anggota', NULL, '2025-10-28 14:27:31', 11, '2025-10-29 10:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `anggota_eskul`
--

CREATE TABLE `anggota_eskul` (
  `id_anggota_eskul` int(11) NOT NULL,
  `id_eskul` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `foto` varchar(150) DEFAULT NULL,
  `no_hp` varchar(30) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota_eskul`
--

INSERT INTO `anggota_eskul` (`id_anggota_eskul`, `id_eskul`, `id_siswa`, `jabatan`, `foto`, `no_hp`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 4, 2, 'Wakil Ketua', NULL, '082115396778', NULL, '2025-10-28 14:27:31', NULL, '2025-10-28 14:27:31'),
(2, 2, 3, 'Ketua', NULL, '082172378124', NULL, '2025-10-28 14:27:31', NULL, '2025-10-28 14:27:31'),
(3, 2, 4, 'Sekretaris', NULL, '082937429540', NULL, '2025-10-28 14:27:31', NULL, '2025-10-28 14:27:31'),
(4, 2, 5, 'Kepala Sekbid 9', NULL, '082192385556', NULL, '2025-10-28 14:27:31', 12, '2025-10-29 20:27:44'),
(5, 2, 2, 'Wakil Ketua', NULL, '082115396778', 12, '2025-10-29 20:27:31', NULL, '2025-10-29 20:27:31'),
(6, 7, 6, 'Sinden', NULL, '08293742934', 12, '2025-12-30 13:23:28', NULL, '2025-12-30 13:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `data_anggota`
--

CREATE TABLE `data_anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `no_tlp` varchar(30) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_anggota`
--

INSERT INTO `data_anggota` (`id_anggota`, `nama`, `jk`, `kelas`, `jurusan`, `alamat`, `no_tlp`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Salsa Khayla', 'Perempuan', 'XII', 'MPLB 1', 'Jl. Lokomotif No. 32, Komp. PJKA Kel, Padasuka, Kec. Cimahi Tengah', '089652815599', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(2, 'Iqbalul Hakim', 'Laki-Laki', 'XII', 'PPLG 2', 'Kp. Sukanampa, Kel. Cigugur Tengah, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat, Indonesia', '082115396779', NULL, '2025-10-28 14:27:32', 11, '2025-10-28 19:40:33'),
(3, 'Yanti Puspita Sari', 'Perempuan', 'XII', 'MPLB 2', 'Kp. Citaman RT/RW 05/04 No 65 Kel. Cigugur Tengah, Kec. Cimahi Tengah, Kota Cimahi', '082129512935', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(4, 'Ervina Kayla Anandita', 'Perempuan', 'XII', 'MPLB 1', 'Rusunawa Cigugur Tengah, Blok D lantai 2 No 5, Jl. At-Taqwa, Kp. Ciputri, Kota Cimahi', '081322241988', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(5, 'Siti Padilah', 'Perempuan', 'XII', 'MPLB 2', 'Kp. Cijerah, RT 02 RW 04, No. 34, Desa Tanimulya, Kec. Ngamprah, Kabupaten Bandung Barat', '081321018981', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(6, 'Aprilianti', 'Perempuan', 'XII', 'AKL', 'Kp. Tegalkawung, Cipageran, Cimahi Utara', '089646608824', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(7, 'Eva Agustina', 'Perempuan', 'XII', 'PM 2', 'Kp. Tangkil, Kel. Cigugur Tengah, Kec. Cimahi Tengah', '082116905688', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(8, 'Nur Astri Suhartuti', 'Perempuan', 'XII', 'AKL', 'Dimensi Margaasih Jln Krey Payung RW 10 RT 7', ' 083159160037', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(9, 'Ira Djulia', 'Perempuan', 'XII', 'PM 1', 'Jl. Babakan Loa No 36, Kel. Pasirkaliki, Kec. Cimahi Utara, Kota Cimahi', '0805345607100', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(10, 'Anita Dewi', 'Perempuan', 'XII', 'PPLG 2', 'Kp. Cikawati, RT/RW 01/10, Kec. Ngamprah, Kabupaten Bandung Barat', '08812228739', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(11, 'Windia Syazwani Putri', 'Perempuan', 'XII', 'AKL', 'Jl. Cihanjuang, Gg. Santri, RT.05/RW.20, Cibabat, Cimahi Utara, Kota Cimahi', '083152994901', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(12, 'Anisa Rachmawati Dewi', 'Perempuan', 'XII', 'PM 2', 'Kp. Blok Sinyar RT/RW 04/17. Kel Cigugur Tengah, Kec. Cimahi Tengah, Kota Cimahi', '089517476607', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(13, 'Muhammad Anwar Awaludin', 'Laki-Laki', 'XII', 'AKL', 'ln. Jend. H. Amir mahcmud, Gg. H. Martobi RT02/RW17 No 33, Kel Cibeureum, Kec Cimahi Selatan, Kota Cimahi', '085722457328', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(15, 'Valdis Anhar Nur Said', 'Laki-Laki', 'XI', 'PPLG 1', 'Jl Mekarwangi Desa Sariwangi Kec. Parongpong, Kab. Bandung Barat, RT 02 RW 12', '081288799112', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(16, 'Fabian Lintang Artha Ajhari', 'Laki-Laki', 'XI', 'PPLG 2', 'Padasuka Indah 2 RT 08 RW 09, Gadobangkong, Kabupaten Bandung Barat, Jawa Barat', '083829913199', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(17, 'Gheriya Rhoudotul Jannah', 'Perempuan', 'XI', 'AKL', 'Jl Terusan Gg. Sudarma Rt 02 Rw 09 Kec. Cimahi Tengah, Kota Cimahi', '089525492943', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(18, 'Sultan Surya Sivana', 'Laki-Laki', 'XI', 'PPLG 1', 'a', '0', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(19, 'Febby Nursuci', 'Perempuan', 'XI', 'AKL', 'JL Blok Cikendal RT/03 RW/05, Melong, Cimahi Selatan, Kota Cimahi', '085860163934', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(20, 'Muhammad Rasya Aditya', 'Laki-Laki', 'XI', 'PPLG 2', 'Jl Mekarwangi Desa Sariwangi Kec. Parongpong Kab. Bandung Barat RT 03 RW 10', '083101517738', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(21, 'Witri Rohaeti', 'Perempuan', 'XI', 'MPLB 1', 'Jln Kp. Pakuhaji RT 02 RW 17 Kel. Cipageran, Kec. Cimahi Utara Kota Cimahi', '083199734764', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(23, 'Olivia Maharani Khairunisa', 'Perempuan', 'XI', 'MPLB 1', 'Jl. Nusantara Raya (KAVLING IPTN) No.91 RT 003/RW 003, Kel. Cibabat, Kec. Cimahi Utara, Kota Cimahi', '081549404195', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(24, 'Sifa Fauzia', 'Perempuan', 'XI', 'MPLB 1', 'Kp Rawa Girang, Tani Mulya, Ngamprah', '089699179629', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(25, 'Arleta Meilani Putri', 'Perempuan', 'XI', 'PM 1', 'Jl Kebon Kopi Gg H. Safei 2 RT/RW 003/028 Kel. Cibeureum, Kec. Cimahi Selatan', '085795420288', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(26, 'Devita Sari', 'Perempuan', 'XI', 'AKL', 'Kp. Tangkil RT/05, RW/07, Kel. Cigugur Tengah, Kec. Cimahi Tengah, Kota Cimahi', '085803673386', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(27, 'Mohammad Arya Alfikri Agung', 'Laki-Laki', 'XI', 'PM 1', 'Kp. Sindang Sari Kel. Cigugur Tengah, Kota Cimahi, RT/RW 01/13', '083107959066', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(28, 'Nadya Fitri Aurelia', 'Perempuan', 'XI', 'AKL', 'Kp. Karangsari Kec. Parongpong Kab. Bandung Barat RT/RW 02/13 No.100', '081318141131', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(29, 'Muhammad Fikri Anggara', 'Laki-Laki', 'XI', 'MPLB 2', 'Jl Mekarwangi Desa Sariwangi, Kec. Parongpong, Kab. Bandung Barat RT 02 RW 11', '083839290504', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(30, 'Dava Shalehillabi', 'Laki-Laki', 'XI', 'PPLG 1', 'Jl Mekarwangi Desa Sariwangi, Kec. Parongpong, Kab. Bandung Barat RT 02 RW 12', '089652256031', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(31, 'Carisa Septina Azahra', 'Perempuan', 'XI', 'MPLB 1', 'Kp. Citaman, Cigugur Tengah, Cimahi Tengah, Kota Cimahi, RT/RW 03/04', '081573007731', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(32, 'Nazmi Apta Guna', 'Laki-Laki', 'XI', 'PPLG 2', 'Jl. KH. Usman Dhomiri, RT.03 RW.08, Kecamatan Cimahi tengah, Kota Cimahi', '0895631922200', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(33, 'Rifal Muhammad Dafa', 'Laki-Laki', 'XI', 'PPLG 2', 'Jl. Sukasenang Cigugur Tengah, Cimahi Tengah, Rt 01 Rw 04', '0895323491797', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(39, 'Kailla Amalliah', 'Perempuan', 'X', 'MPLB 1', 'Jl. KH. Usman Dhomiri, RT. 05/RW. 18', '0895631920301', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(40, 'Wahyu Muhammad Rizky', 'Laki-Laki', 'X', 'PPLG', 'Jl. Sukarasa', '083175306032', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(41, 'Nadya Hana', 'Perempuan', 'X', 'PPLG 2', 'Jl. Budhi', '085187248556', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(42, 'Husna Rahmadani Nurhabibah', 'Perempuan', 'X', 'MPLB', 'Jl. Panembakan', '0881022812762', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(43, 'Norma Salsabila', 'Perempuan', 'X', 'AKL', 'Jl. Sariwangi Asri V, No. 12B', '083867880516', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(44, 'Anisa Nur Alyah', 'Perempuan', 'X', 'PM 2', 'Gg. Karya 3', '0895402757878', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(45, 'Dewi Lestari', 'Perempuan', 'X', 'PM 1', 'Jl. Pahlawan Desa', '085722177343', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(46, 'Meylani Asri Pratiwi', 'Perempuan', 'X', 'PM 1', 'Gg. Tirta Indah 2', '087869206651', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(47, 'Alika Rabbania Kirana', 'Perempuan', 'X', 'AKL', 'Jl. Panembakan, RT. 05/RW. 06', '087800081159', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(48, 'Fayyaz Deslanno Bahir', 'Laki-Laki', 'X', 'PM 1', 'Jl. Abdul Halim, Gg. Sadar Bakti 3, RT. 04/RW. 19', '085724652458', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(49, 'Olivya Meylani', 'Perempuan', 'X', 'MPLB 2', 'Jl. Jatinagor Blok E 11 No. 12, RT. 04/RW. 08 Kec. Margaasih', '0882000207550', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(50, 'Herlina Melani', 'Perempuan', 'X', 'MPLB 2', 'Jl. Cibaligo, Cibeureum, RT. 04/RW. 16, Kec. Cimahi Selatan', '085759117891', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(51, 'Isma WInda', 'Perempuan', 'X', 'MPLB 2', 'Jl. Rancabentang, Gg. Serbaguna No. 233, RT. 03/RW. 13, Kelurahan Cibeureum, Cimahi Selatan', '081572127868', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(52, 'Syahla Nuraini', 'Perempuan', 'X', 'MPLB 2', 'Jl. Sadarmanah', '088970779725', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(53, 'Dewi Fatimah', 'Perempuan', 'X', 'MPLB 1', 'Kp. Babakan, RT. 02/RW. 09 No. 58, Kel. Padasuka, Kec. Cimahi Tengah', '083875333957', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(54, 'Bima Agung Wijaya', 'Laki-Laki', 'X', 'PPLG 1', 'Jl. Sariwangi, RT. 03/RW. 08 No.66', '081323538572', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `data_kegiatan_event`
--

CREATE TABLE `data_kegiatan_event` (
  `id_kegiatan` int(11) NOT NULL,
  `nama_kegiatan` varchar(100) NOT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `lokasi_kegiatan` varchar(100) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_kegiatan_event`
--

INSERT INTO `data_kegiatan_event` (`id_kegiatan`, `nama_kegiatan`, `tanggal_kegiatan`, `lokasi_kegiatan`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Masa Pengenalan Lingkungan Sekolah (MPLS)', '2023-07-17', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(2, 'Perayaan HUT RI Ke-78', '2023-08-21', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(3, 'Camping Pendidikan Dasar', '2023-10-03', 'Cipeundeuy', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(4, 'Pemilihan Ketua dan Wakil Ketua OSIS', '2023-11-10', 'Lapangan SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(5, 'Memperingati Hari Guru Nasional dan HUT PGRI', '2023-11-27', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(6, 'Pekan Olahraga Antar Kelas', '2023-12-19', 'Lapangan SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(7, 'Serah Terima Jabatan Kepengurusan OSIS', '2023-12-18', 'Lapangan SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(8, 'Memperingati Isra Mi\'raj', '2024-02-05', 'Lapangan SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(9, 'Perkemahan Jum\'at dan Sabtu dan  Latihan Dasar Kepemimpinan Siswa', '2024-02-16', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(10, 'SmartTren SMK PGRI 1 Cimahi', '2025-03-27', 'Aula SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(11, 'Berbagi Takjil', '2024-04-02', 'Jalan', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(12, 'HARDIKNAS', '2024-05-02', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(13, 'Idul Adha dan Praktek Pelaksanaan Qurban', '2024-06-19', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(14, 'Pentas Seni', '2024-06-20', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(15, 'Masa Pengenalan Lingkungan Sekolah (MPLS)', '2024-07-15', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(16, 'Peringatan HUT RI Ke-79', '2024-08-21', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(17, 'Camping Pendidikan Dasar', '2024-08-23', 'PH 50', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(18, 'Maulid Nabi', '2024-09-17', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(19, 'Memperingati Hari Guru Nasional', '2024-11-25', 'Lapangan SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(20, 'Debat dan Pemilihan Ketua OSIS dan Wakil Ketua OSIS', '2024-11-26', 'Lapangan SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(21, 'Classmeet', '2024-12-16', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(22, 'Serah Terima Jabatan Kepengurusan OSIS', '2025-01-06', 'Lapangan SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(23, 'Isra Mi\'raj', '2025-01-31', 'Lapangan SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(24, 'Perkemahan Jum\'at dan Sabtu', '2025-01-31', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(25, 'Gebyar Open House SMK PGRI 1 Cimahi dan Panen Karya P5', '2025-02-20', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(26, 'Smart Tren Ramadhan', '2025-03-06', 'Lapangan SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(27, 'Berbagi Takjil', '2025-03-14', 'Jalan', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(28, 'Halal Bihalal', '2025-04-10', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(29, 'Peringatan Hari Kartini', '2025-04-21', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(30, 'Peringatan Hari Pendidikan Nasional', '2025-05-02', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(31, 'Idul Adha', '2025-06-06', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(32, 'Samudra III', '2025-05-31', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(33, 'MPLS 2025', '2025-06-12', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(34, 'Peringatan HUT RI', '2025-08-20', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(35, 'Peringatan Maulid Nabi Muhammad Saw', '2025-09-12', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(36, 'Sosialisasi & Simulasi Gempa oleh BPBD', '2025-09-29', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(37, 'EKSSKUL FOSJABAR', '2025-09-20', 'Studio Masjid Istiqamah Bandung', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(38, 'Peringatan Hari Batik Nasional', '2025-10-02', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(39, 'Peringatan Hari Santri Nasional', '2025-10-22', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(41, 'Camping Pendidikan Dasar (CPD) 2025', '2025-11-07', 'PH 50', 11, '2026-01-02 14:31:52', NULL, '2026-01-02 14:31:52'),
(42, 'Debat & Pemilihan Ketua & Wakil Ketua OSIS Periode 2025-2026', '2025-11-24', 'SMK PGRI 1 Cimahi', 11, '2026-01-02 14:33:11', NULL, '2026-01-02 14:33:11'),
(43, 'Memperingati Hari Guru Nasional', '2025-11-25', 'SMK PGRI 1 Cimahi', 11, '2026-01-02 14:33:44', NULL, '2026-01-02 14:33:44'),
(44, 'PORSENI', '2025-12-15', 'SMK PGRI 1 Cimahi', 11, '2026-01-02 14:33:59', NULL, '2026-01-02 14:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `data_kepengurusan`
--

CREATE TABLE `data_kepengurusan` (
  `id_kepengurusan` int(11) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `tahun_memulai` date NOT NULL,
  `tahun_selesai` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_kepengurusan`
--

INSERT INTO `data_kepengurusan` (`id_kepengurusan`, `nama_anggota`, `jabatan`, `tahun_memulai`, `tahun_selesai`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Selviani Wulan Ramadani', 'Ketua OSIS', '2023-12-11', '2025-01-06', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(2, 'Susan Salsabilla', 'Wakil Ketua OSIS', '2023-12-11', '2025-01-06', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(3, 'Riska Maulina', 'Sekretaris', '2023-12-11', '2025-01-06', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(4, 'Ajeng Ilmi Nuraeni', 'Bendahara', '2023-12-11', '2025-01-06', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(5, 'Rena', 'Kepala Sekbid 1', '2023-12-11', '2025-01-06', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(6, 'Ai Robiah Adawiah', 'Kepala Sekbid 2', '2023-12-11', '2025-01-06', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(7, 'Dinda Aisyah', 'Kepala Sekbid 3', '2023-12-11', '2025-01-06', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(8, 'Alyca Zaskia', 'Kepala Sekbid 4', '2023-12-11', '2025-01-06', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(9, 'Rieska Hexa Mufida Iryanto', 'Kepala Sekbid 5', '2023-12-11', '2025-01-06', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(10, 'Devi Rosmiati', 'Kepala Sekbid 6', '2023-12-11', '2025-01-06', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(11, 'Rizky Aufa Dilana', 'Kepala Sekbid 7', '2023-12-11', '2025-01-06', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(12, 'Rizka Febrianti', 'Kepala Sekbid 8', '2023-12-11', '2025-01-06', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(13, 'Salsa Khayla', 'Ketua OSIS', '2025-01-06', '2026-01-12', NULL, '2025-10-28 14:27:32', 11, '2026-01-02 14:29:16'),
(14, 'Iqbalul Hakim', 'Wakil Ketua OSIS', '2025-01-06', '2026-01-05', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(15, 'Yanti Puspita Sari', 'Sekretaris', '2025-01-06', '2026-01-05', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(16, 'Ervina Kayla Anandita', 'Bendahara', '2025-01-06', '2026-01-05', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(17, 'Siti Padilah', 'Kepala Sekbid 1', '2025-01-06', '2026-01-05', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(18, 'Aprilianti', 'Kepala Sekbid 2', '2025-01-06', '2026-01-05', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(19, 'Eva Agustina', 'Sekbid 2', '2025-01-06', '2026-01-05', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(20, 'Nur Astri Suhartuti', 'Kepala Sekbid 3', '2025-01-06', '2026-01-05', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(21, 'Ira Djulia', 'Kepala Sekbid 4', '2025-01-06', '2026-01-05', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(22, 'Anita Dewi', 'Kepala Sekbid 5', '2025-01-06', '2026-01-05', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(23, 'Windia Syazwani Putri', 'Kepala Sekbid 6', '2025-01-06', '2026-01-05', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(24, 'Anisa Rachmawati Dewi', 'Kepala Sekbid 7', '2025-01-06', '2026-01-05', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(25, 'Muhammad Anwar Awaludin', 'Kepala Sekbid 8', '2025-01-06', '2026-01-05', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `data_organisasi_luar`
--

CREATE TABLE `data_organisasi_luar` (
  `id_organisasi_luar` int(11) NOT NULL,
  `nama_anggota` varchar(225) NOT NULL,
  `nama_organisasi` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_organisasi_luar`
--

INSERT INTO `data_organisasi_luar` (`id_organisasi_luar`, `nama_anggota`, `nama_organisasi`, `jabatan`, `asal_sekolah`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Ai Robiah Adawiah', 'FOSJABAR', 'Koordinator Wilayah 7', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(2, 'Selviani Wulan Ramadani', 'FOSJABAR', 'Ketua Divisi Kewirausahaan', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(3, 'Rieska Hexa Mufida Iryanto', 'FOSJABAR', 'Sekretaris Divisi Kewirausahaan', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(4, 'Alyca Zaskia', 'FOSJABAR', 'Anggota', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(5, 'Susan Salsabilla', 'FOSJABAR', 'Anggota', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(6, 'Rizka Febrianti', 'FOSJABAR', 'Anggota', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(7, 'Salsa Khayla', 'FOSJABAR', 'Wakil Sekretaris Umum', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(8, 'Yanti Puspita Sari', 'FOSJABAR', 'Staf Divisi Pendidikan Karakter dan Kerohanian', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(9, 'Windia Syazwani Putri', 'FOSJABAR', 'Anggota', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(11, 'Ervina Kayla Anandita', 'FOSJABAR', 'Anggota', 'SMK PGRI 1 Cimahi', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `data_pelantikan`
--

CREATE TABLE `data_pelantikan` (
  `id_pelantikan` int(100) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `tahun_pelantikan` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_pelantikan`
--

INSERT INTO `data_pelantikan` (`id_pelantikan`, `nama_anggota`, `tahun_pelantikan`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Selviani Wulan Ramadani', '2023-12-08', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(2, 'Susan Salsabilla', '2023-12-08', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(3, 'Riska Maulina', '2023-12-08', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(4, 'Ajeng Ilmi Nuraeni', '2023-12-08', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(5, 'Rena', '2023-12-08', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(6, 'Ai Robiah Adawiah', '2023-12-08', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(7, 'Dinda Aisyah', '2023-12-08', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(8, 'Alyca Zaskia', '2023-12-08', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(9, 'Rieska Hexa Mufida Iryanto', '2023-12-08', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(10, 'Devi Rosmiati', '2023-12-08', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(11, 'Rizky Aufa Dilana', '2023-12-08', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(12, 'Rizka Febrianti', '2023-12-08', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(13, 'Salsa Khayla', '2024-07-28', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(14, 'Iqbalul Hakim', '2024-07-28', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(15, 'Yanti Puspita Sari', '2024-07-28', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(16, 'Ervina Kayla Anandita', '2024-07-28', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(17, 'Siti Padilah', '2024-07-28', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(18, 'Aprilianti', '2024-07-28', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(19, 'Eva Agustina', '2024-07-28', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(20, 'Nur Astri Suhartuti', '2024-07-28', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(21, 'Ira Djulia', '2024-07-28', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(22, 'Anita Dewi', '2024-07-28', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(23, 'Windia Syazwani Putri', '2024-07-28', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(24, 'Anisa Rachmawati Dewi', '2024-07-28', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(25, 'Muhammad Anwar Awaludin', '2024-07-28', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `eskul`
--

CREATE TABLE `eskul` (
  `id_eskul` int(11) NOT NULL,
  `eskul` varchar(50) NOT NULL,
  `singkatan` varchar(20) DEFAULT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `pembina` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `kategori` enum('OP3','Olahraga','Kesenian','Lainnya') DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eskul`
--

INSERT INTO `eskul` (`id_eskul`, `eskul`, `singkatan`, `logo`, `pembina`, `keterangan`, `kategori`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(2, 'Organisasi Siswa Intra Sekolah', 'OSIS', 'osis.png', 'Virena, S.Pd', NULL, 'OP3', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(3, 'Pasukan Pengibar Bendera', 'PASKIBRA', NULL, 'Didin Kamaludin', NULL, 'OP3', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(4, 'Palang Merah Remaja', 'PMR', NULL, 'Alifha Rachmadia, S.Pd', NULL, 'OP3', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(5, 'Praja Muda Karana', 'PRAMUKA', NULL, 'Siti Sofia Zukhro, S.Pd', NULL, 'OP3', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(6, 'Pencak Silat', 'Pencak Silat', NULL, 'Bagja', NULL, 'Olahraga', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(7, 'Kulawarga Gentra Galindeng Sunda', 'KAGAGAS', NULL, 'Kang Omas', NULL, 'Kesenian', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(8, 'Basket', 'Hawksone', NULL, 'Rizaldi Dwi Putra Ramadhan', NULL, 'Olahraga', NULL, '2025-11-12 09:36:36', NULL, '2025-11-12 09:36:36'),
(9, 'Voli', 'Voli', NULL, 'Reno Muhammad Sulaeman', NULL, 'Olahraga', NULL, '2025-11-12 09:37:42', NULL, '2025-11-12 09:37:42'),
(10, 'Futsal', 'Futsal', NULL, 'Muhamad Rizky Pirmansah', NULL, 'Olahraga', NULL, '2025-11-12 09:38:13', NULL, '2025-11-12 09:38:13'),
(11, 'Modern Dance', 'Modern Dance', NULL, '....', NULL, 'Kesenian', 11, '2025-11-13 07:36:10', NULL, '2025-11-13 07:36:10'),
(12, 'Ikatan Remaja Masjid ', 'IRMA', NULL, 'Shofy Mustofa Aziz, S.PdI', NULL, 'Lainnya', 11, '2025-12-27 10:51:50', NULL, '2025-12-27 10:51:50');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `judul`, `gambar`, `deskripsi`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(12, 'MPLS', 'mpls23_1756728227.webp', 'Program kerja Masa Pengenalan Lingkungan Sekolah (MPLS) ini bertujuan untuk membantu siswa baru beradaptasi dengan lingkungan SMK PGRI 1 CIMAHI dan teman-teman baru. MPLS juga bertujuan untuk memperkenalkan siswa pada budaya, norma, dan tata tertib sekolah.', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(13, 'MEMPERINGATI 17 AGUSTUSAN', 'agustus_1756728323.webp', 'Program kerja ini diadakan untuk memperingati hari kemerdekaan Republik Indonesia dengan menggelar berbagai lomba.', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(14, 'MEMPERINGATI ISRA MI\'RAJ', 'isramiraj_1756728392.webp', 'Program kerja ini diadakan untuk meningkatkan iman dan taqwa serta lebih mengenal Nabi Besar Muhammad SAW.', NULL, '2025-10-28 14:27:32', NULL, '2025-10-28 14:27:32'),
(15, 'CAMPING PENDIDIKAN DASAR', 'cpd_1756728457.webp', 'Kegiatan Camping Pendidikan Dasar SMK merupakan agenda pembinaan karakter dan kepemimpinan yang bertujuan menanamkan nilai-nilai kedisiplinan, tanggung jawab, serta kerja sama antarsiswa. Melalui berbagai aktivitas seperti pelatihan baris-berbaris, permainan edukatif, penjelajahan alam, hingga kegiatan api unggun, peserta diajak untuk belajar menghadapi tantangan, memperkuat solidaritas, dan menumbuhkan rasa cinta terhadap alam.', NULL, '2025-10-28 14:27:32', 11, '2025-11-12 20:31:27'),
(16, 'PEKAN OLAHRAGA', 'porak2_1756728491.webp', 'Pekan Olahraga Antar Kelas merupakan ajang tahunan yang bertujuan untuk menumbuhkan semangat sportivitas, kebersamaan, dan jiwa kompetitif positif di kalangan siswa. Melalui berbagai cabang olahraga seperti futsal, voli, badminton, dan lomba tradisional, kegiatan ini menjadi sarana bagi siswa untuk menyalurkan bakat serta menjaga kebugaran jasmani. Selain mempererat tali persaudaraan antar kelas, pekan olahraga ini juga mengajarkan pentingnya kerja sama tim, disiplin, dan fair play dalam setiap pertandingan.', NULL, '2025-10-28 14:27:32', 11, '2025-11-12 20:32:56'),
(17, 'PENTAS SENI', 'galeri_68b58d434ebc22.76683857.webp', 'Pentas Seni adalah ajang kreativitas siswa untuk menampilkan bakat di bidang seni seperti musik, tari, dan teater. Kegiatan ini bertujuan menumbuhkan apresiasi terhadap seni serta mempererat kebersamaan antar siswa melalui ekspresi dan karya kreatif.', NULL, '2025-10-28 14:27:32', 11, '2025-11-12 20:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `hafalan_quran`
--

CREATE TABLE `hafalan_quran` (
  `id_tes` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `ayat` varchar(100) DEFAULT NULL,
  `nilai` enum('Sangat Memuaskan','Cukup Memuaskan','Kurang Memuaskan') DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hafalan_quran`
--

INSERT INTO `hafalan_quran` (`id_tes`, `id_anggota`, `tanggal`, `ayat`, `nilai`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(2, 1, '2025-10-29', 'An-Naba Ayat 1-20', 'Cukup Memuaskan', 12, '2025-10-29 13:10:13', NULL, '2025-10-29 13:10:13');

-- --------------------------------------------------------

--
-- Table structure for table `infaq`
--

CREATE TABLE `infaq` (
  `id_infaq` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` enum('pemasukan','pengeluaran') NOT NULL,
  `keterangan` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `infaq`
--

INSERT INTO `infaq` (`id_infaq`, `tanggal`, `jenis`, `keterangan`, `jumlah`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, '2025-09-01', 'pemasukan', 'Infaq Hari Sabtu', 300000, NULL, '2025-10-28 14:27:33', NULL, '2025-11-12 09:20:41'),
(2, '2025-09-01', 'pemasukan', 'Infaq Hari Jumat', 457000, NULL, '2025-10-28 14:27:33', NULL, '2025-10-28 14:27:33'),
(3, '2025-09-02', 'pengeluaran', 'Anggota OSIS Sakit', 250000, NULL, '2025-10-28 14:27:33', NULL, '2025-10-28 14:27:33'),
(4, '2025-09-03', 'pengeluaran', 'Awa Minjem Duit', 15000, NULL, '2025-10-28 14:27:33', NULL, '2025-10-28 14:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `id_info` int(11) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `isi` text NOT NULL,
  `sumber` varchar(255) DEFAULT NULL,
  `tanggal_post` date DEFAULT curdate(),
  `foto` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_eskul`
--

CREATE TABLE `jadwal_eskul` (
  `id_jadwal` int(11) NOT NULL,
  `id_eskul` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `tempat` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_eskul`
--

INSERT INTO `jadwal_eskul` (`id_jadwal`, `id_eskul`, `tanggal`, `waktu_mulai`, `waktu_selesai`, `tempat`, `keterangan`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(5, 2, '2025-10-29', '14:00:00', '16:45:00', 'Kelas XII AKL', 'Kumpul Rutinan Membahas CPD', 12, '2025-10-29 20:29:36', 12, '2025-10-29 20:57:27');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_jaga_barisan`
--

CREATE TABLE `jadwal_jaga_barisan` (
  `id_jadwal` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_jaga_gerbang`
--

CREATE TABLE `jadwal_jaga_gerbang` (
  `id_jadwal` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `shift` enum('Pagi','Sore') DEFAULT 'Pagi',
  `keterangan` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kumpul_eskul`
--

CREATE TABLE `jadwal_kumpul_eskul` (
  `id_jadwal_eskul` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kegiatan` varchar(150) NOT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_razia`
--

CREATE TABLE `jadwal_razia` (
  `id_razia` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_razia` varchar(100) NOT NULL,
  `petugas` enum('Guru','Siswa & Guru') DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_razia`
--

INSERT INTO `jadwal_razia` (`id_razia`, `tanggal`, `jenis_razia`, `petugas`, `keterangan`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(2, '2025-11-03', 'Razia Akbar Paripurna', 'Siswa & Guru', 'Razia Make Up dan Atribut Perhiasan', 12, '2025-10-29 19:52:26', 12, '2025-10-29 19:55:28');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_upacara`
--

CREATE TABLE `jadwal_upacara` (
  `id_jadwal` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `jenis_petugas` varchar(50) DEFAULT NULL,
  `tema` varchar(100) DEFAULT NULL,
  `pembina_upacara` varchar(100) DEFAULT NULL,
  `keterangan` enum('Terjadwal','Selesai','Dibatalkan') DEFAULT 'Terjadwal',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pelanggaran`
--

CREATE TABLE `jenis_pelanggaran` (
  `id_jenis_pelanggaran` int(11) NOT NULL,
  `nama_pelanggaran` varchar(100) DEFAULT NULL,
  `pengurangan_poin` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_pelanggaran`
--

INSERT INTO `jenis_pelanggaran` (`id_jenis_pelanggaran`, `nama_pelanggaran`, `pengurangan_poin`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(7, 'Membawa senjata tajam', 50, 12, '2025-12-31 17:44:47', NULL, '2025-12-31 17:44:47'),
(8, 'Membawa Korek Api', 25, 12, '2026-01-02 15:10:27', NULL, '2026-01-02 15:10:27'),
(9, 'Membawa Make Up', 80, 12, '2026-01-02 15:10:43', NULL, '2026-01-02 15:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran_eskul`
--

CREATE TABLE `kehadiran_eskul` (
  `id_kehadiran` int(11) NOT NULL,
  `id_jadwal_eskul` int(11) NOT NULL,
  `id_anggota_eskul` int(11) NOT NULL,
  `status` enum('Hadir','Tidak Hadir','Izin') DEFAULT 'Hadir',
  `waktu_absen` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'X PPLG 1', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(2, 'X PPLG 2', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(3, 'X AKL', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(4, 'X MPLB 1', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(5, 'X MPLB 2', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(6, 'X PM 1', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(7, 'X PM 2', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(8, 'XI PPLG 1', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(9, 'XI PPLG 2', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(10, 'XI AKL', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(11, 'XI MPLB 1', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(12, 'XI MPLB 2', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(13, 'XI PM 1', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(14, 'XI PM 2', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(15, 'XII PPLG 1', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(16, 'XII PPLG 2', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(17, 'XII AKL', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(18, 'XII MPLB 1', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(19, 'XII MPLB 2', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(20, 'XII MPLB 3', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(21, 'XII PM 1', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(22, 'XII PM 2', NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_osis`
--

CREATE TABLE `keuangan_osis` (
  `id_keuangan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` enum('Pemasukan','Pengeluaran') NOT NULL,
  `sumber` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `nominal` decimal(12,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keuangan_osis`
--

INSERT INTO `keuangan_osis` (`id_keuangan`, `tanggal`, `jenis`, `sumber`, `deskripsi`, `nominal`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, '2025-10-18', 'Pemasukan', NULL, 'Penjualan Es Melon', 30000.00, NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(2, '2025-10-20', 'Pemasukan', NULL, 'Penjualan Risol Mayonaise', 25000.00, NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(3, '2025-10-22', 'Pengeluaran', NULL, 'Pembelian Risol Mayonaise', 50000.00, NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(4, '2025-10-18', 'Pemasukan', NULL, 'Penjualan Risol Mayonaise', 5000.00, NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(5, '2025-10-23', 'Pemasukan', NULL, 'Penjualan Makrame', 22500.00, NULL, '2025-10-28 14:27:34', NULL, '2025-10-28 14:27:34'),
(6, '2025-11-09', 'Pemasukan', NULL, 'Penjualan Ceker Mercon', 30000.00, 12, '2025-11-09 13:19:22', NULL, '2025-11-09 13:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_bulanan`
--

CREATE TABLE `laporan_bulanan` (
  `id_laporan` int(11) NOT NULL,
  `bulan` varchar(20) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `total_pemasukan` decimal(12,2) DEFAULT NULL,
  `total_pengeluaran` decimal(12,2) DEFAULT NULL,
  `saldo_akhir` decimal(12,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran_siswa`
--

CREATE TABLE `pelanggaran_siswa` (
  `id_pelanggaran` int(11) NOT NULL,
  `id_jenis_pelanggaran` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggaran_siswa`
--

INSERT INTO `pelanggaran_siswa` (`id_pelanggaran`, `id_jenis_pelanggaran`, `id_siswa`, `tanggal`, `keterangan`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(10, 7, 2, '2026-01-01', 'asd', 12, '2025-12-31 17:45:22', NULL, '2025-12-31 17:45:22'),
(11, 8, 6, '2026-01-02', 'ddfgfdg', 12, '2026-01-02 15:13:24', NULL, '2026-01-02 15:13:24'),
(12, 8, 6, '2026-01-02', 'ddfgfdg', 12, '2026-01-02 15:35:37', NULL, '2026-01-02 15:35:37'),
(13, 8, 6, '2026-01-02', 'ddfgfdg', 12, '2026-01-02 15:40:36', NULL, '2026-01-02 15:40:36'),
(14, 9, 3, '2026-01-02', 'dghdgvn ', 12, '2026-01-02 15:45:23', NULL, '2026-01-02 15:45:23'),
(15, 9, 7, '2026-01-02', 'jo0poj', 12, '2026-01-02 15:45:43', NULL, '2026-01-02 15:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `petugas_barisan`
--

CREATE TABLE `petugas_barisan` (
  `id_petugas` int(11) NOT NULL,
  `id_jadwal` int(11) DEFAULT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `status` enum('Hadir','Tidak Hadir') DEFAULT 'Hadir',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petugas_gerbang`
--

CREATE TABLE `petugas_gerbang` (
  `id_petugas` int(11) NOT NULL,
  `id_jadwal` int(11) DEFAULT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `status` enum('Hadir','Tidak Hadir') DEFAULT 'Hadir',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petugas_upacara`
--

CREATE TABLE `petugas_upacara` (
  `id_petugas` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `peran` enum('Pemimpin Upacara','Pengibar Bendera','Pembaca Doa','Pembaca Ikrar','Protokol','Pembaca UUD','Pembawa Teks Pancasila','Dirigen','Pengatur','Pemimpin Pasukan','Petugas Lain') NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk_osis`
--

CREATE TABLE `produk_osis` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `harga_jual` decimal(10,2) DEFAULT NULL,
  `stok` int(11) DEFAULT 0,
  `deskripsi` text DEFAULT NULL,
  `foto_produk` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_osis`
--

INSERT INTO `produk_osis` (`id_produk`, `nama_produk`, `kategori`, `harga_jual`, `stok`, `deskripsi`, `foto_produk`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(2, 'Es Melon', 'Minuman', 7500.00, 36, 'Es Melon segar penghilang rasa haus', NULL, NULL, '2025-10-28 14:27:35', NULL, '2025-10-28 14:27:35'),
(3, 'Risol Mayonaise', 'Makanan', 2500.00, 128, 'Risol dengan Isi sayuran dan Mayonaise', NULL, NULL, '2025-10-28 14:27:35', NULL, '2025-10-28 14:27:35'),
(4, 'Makrame', 'Aksesoris', 4500.00, 20, 'Aksesoris makrame yang cantik', NULL, NULL, '2025-10-28 14:27:35', NULL, '2025-10-28 14:27:35'),
(5, 'Ceker Mercon', 'Makanan', 10000.00, 15, 'Ceker Mercon Pedas', NULL, 12, '2025-11-09 13:04:24', NULL, '2025-11-09 13:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(100) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `poin` int(11) DEFAULT 100,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama_siswa`, `id_kelas`, `poin`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(2, 'Iqbalul Hakim', 16, -10, NULL, '2025-10-28 14:27:36', NULL, '2025-12-31 17:45:22'),
(3, 'Salsa Khayla', 18, 10, NULL, '2025-10-28 14:27:36', NULL, '2026-01-02 15:45:23'),
(4, 'Yanti Puspita Sari', 19, 90, NULL, '2025-10-28 14:27:36', NULL, '2025-10-29 19:43:45'),
(6, 'Anita Dewi', 16, 24, NULL, '2025-11-11 20:45:46', NULL, '2026-01-02 15:40:36'),
(7, 'Aprilianti', 17, -70, NULL, '2025-11-11 20:50:16', NULL, '2026-01-02 15:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `struktur_osis`
--

CREATE TABLE `struktur_osis` (
  `id_struktur` int(11) NOT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tahun` varchar(9) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `struktur_osis`
--

INSERT INTO `struktur_osis` (`id_struktur`, `jabatan`, `gambar`, `tahun`, `urutan`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(5, 'Ketua & Wakil Ketua OSIS', '69004c7dbb54c.png', '2025', 1, 0, NULL, '2025-10-28 14:27:36', NULL, '2025-10-28 14:27:36'),
(7, 'Ketua OSIS', '69577770b5541.png', '2025', 1, 1, 11, '2026-01-02 14:44:48', NULL, '2026-01-02 14:44:48');

-- --------------------------------------------------------

--
-- Table structure for table `tes_doa_harian`
--

CREATE TABLE `tes_doa_harian` (
  `id_tes` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `bacaan_doa` varchar(100) DEFAULT NULL,
  `nilai` enum('Sangat Memuaskan','Cukup Memuaskan','Kurang Memuaskan') DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tes_doa_harian`
--

INSERT INTO `tes_doa_harian` (`id_tes`, `id_anggota`, `tanggal`, `bacaan_doa`, `nilai`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(4, 3, '2025-10-29', 'Doa Makan', 'Sangat Memuaskan', 12, '2025-10-29 12:57:59', 12, '2025-10-29 13:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_osis`
--

CREATE TABLE `transaksi_osis` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jenis` enum('Penjualan','Pembelian') NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_osis`
--

INSERT INTO `transaksi_osis` (`id_transaksi`, `tanggal`, `id_produk`, `jenis`, `jumlah`, `total`, `keterangan`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(5, '2025-10-18', 2, 'Penjualan', 4, 30000.00, 'dibeli sama iqbal', NULL, '2025-10-28 14:27:36', NULL, '2025-10-28 14:27:36'),
(6, '2025-10-20', 3, 'Penjualan', 10, 25000.00, 'dibeli sama anwar', NULL, '2025-10-28 14:27:36', NULL, '2025-10-28 14:27:36'),
(7, '2025-10-22', 3, 'Pembelian', 20, 50000.00, 'beli stok risol di salsa', NULL, '2025-10-28 14:27:36', NULL, '2025-10-28 14:27:36'),
(8, '2025-10-18', 3, 'Penjualan', 2, 5000.00, 'dibeli sama yanti', NULL, '2025-10-28 14:27:36', NULL, '2025-10-28 14:27:36'),
(9, '2025-10-23', 4, 'Penjualan', 5, 22500.00, 'di beli sama iki', NULL, '2025-10-28 14:27:36', NULL, '2025-10-28 14:27:36'),
(10, '2025-11-09', 5, 'Penjualan', 3, 30000.00, 'di beli bu rena', 12, '2025-11-09 13:19:22', NULL, '2025-11-09 13:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visi_misi`
--

CREATE TABLE `visi_misi` (
  `id_visi_misi` int(11) NOT NULL,
  `jenis` enum('visi','misi') NOT NULL,
  `isi` text NOT NULL,
  `tahun` varchar(9) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visi_misi`
--

INSERT INTO `visi_misi` (`id_visi_misi`, `jenis`, `isi`, `tahun`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'misi', 'Menciptakan lingkungan sekolah yang harmonis dan nyaman', '2025 - 20', 0, NULL, '2025-10-28 14:27:36', NULL, '2025-10-28 14:27:36'),
(2, 'misi', 'Bagaikan Tawa yang Tak Selesai', '2025', 0, NULL, '2025-10-28 14:27:36', NULL, '2025-10-28 14:27:36'),
(3, 'misi', 'Amin Paling Anjay', '2025', 0, NULL, '2025-10-28 14:27:36', NULL, '2025-10-28 14:27:36'),
(4, 'visi', 'Menciptkan semangat baru menjadi kecil wajahmu meraung sedih siapa yang berlayar pergi melatih mu sendiri menertawakan sunyi sampai hatimu lupa terbiasa perih', '2025', 0, NULL, '2025-10-28 14:27:36', NULL, '2025-10-28 14:27:36'),
(5, 'visi', 'new new new', '2025', 0, NULL, '2025-10-28 14:27:36', NULL, '2025-10-28 14:27:36'),
(6, 'visi', 'pilu penuh pertanyaan', '2025', 0, NULL, '2025-10-28 14:27:36', NULL, '2025-10-28 14:27:36'),
(7, 'misi', 'Entah hari ke berapa', '2025', 0, NULL, '2025-10-28 14:27:36', NULL, '2025-10-28 14:27:36'),
(8, 'visi', 'Menciptkan semangat baru', '2025', 0, NULL, '2025-10-28 14:27:36', NULL, '2025-10-28 14:27:36'),
(9, 'misi', 'Entah hari ke berapa anjay', '2025', 0, NULL, '2025-10-28 14:27:36', NULL, '2025-10-28 14:27:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acara`
--
ALTER TABLE `acara`
  ADD PRIMARY KEY (`id_acara`);

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `anggota_eskul`
--
ALTER TABLE `anggota_eskul`
  ADD PRIMARY KEY (`id_anggota_eskul`),
  ADD KEY `id_eskul` (`id_eskul`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `data_anggota`
--
ALTER TABLE `data_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `data_kegiatan_event`
--
ALTER TABLE `data_kegiatan_event`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `data_kepengurusan`
--
ALTER TABLE `data_kepengurusan`
  ADD PRIMARY KEY (`id_kepengurusan`);

--
-- Indexes for table `data_organisasi_luar`
--
ALTER TABLE `data_organisasi_luar`
  ADD PRIMARY KEY (`id_organisasi_luar`);

--
-- Indexes for table `data_pelantikan`
--
ALTER TABLE `data_pelantikan`
  ADD PRIMARY KEY (`id_pelantikan`);

--
-- Indexes for table `eskul`
--
ALTER TABLE `eskul`
  ADD PRIMARY KEY (`id_eskul`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `hafalan_quran`
--
ALTER TABLE `hafalan_quran`
  ADD PRIMARY KEY (`id_tes`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `infaq`
--
ALTER TABLE `infaq`
  ADD PRIMARY KEY (`id_infaq`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id_info`);

--
-- Indexes for table `jadwal_eskul`
--
ALTER TABLE `jadwal_eskul`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_eskul` (`id_eskul`);

--
-- Indexes for table `jadwal_jaga_barisan`
--
ALTER TABLE `jadwal_jaga_barisan`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `jadwal_jaga_gerbang`
--
ALTER TABLE `jadwal_jaga_gerbang`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `jadwal_kumpul_eskul`
--
ALTER TABLE `jadwal_kumpul_eskul`
  ADD PRIMARY KEY (`id_jadwal_eskul`);

--
-- Indexes for table `jadwal_razia`
--
ALTER TABLE `jadwal_razia`
  ADD PRIMARY KEY (`id_razia`);

--
-- Indexes for table `jadwal_upacara`
--
ALTER TABLE `jadwal_upacara`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `jadwal_upacara_ibfk_1` (`id_kelas`);

--
-- Indexes for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  ADD PRIMARY KEY (`id_jenis_pelanggaran`);

--
-- Indexes for table `kehadiran_eskul`
--
ALTER TABLE `kehadiran_eskul`
  ADD PRIMARY KEY (`id_kehadiran`),
  ADD KEY `id_jadwal_eskul` (`id_jadwal_eskul`),
  ADD KEY `id_anggota_eskul` (`id_anggota_eskul`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `keuangan_osis`
--
ALTER TABLE `keuangan_osis`
  ADD PRIMARY KEY (`id_keuangan`);

--
-- Indexes for table `laporan_bulanan`
--
ALTER TABLE `laporan_bulanan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  ADD PRIMARY KEY (`id_pelanggaran`),
  ADD KEY `id_jenis_pelanggaran` (`id_jenis_pelanggaran`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `petugas_barisan`
--
ALTER TABLE `petugas_barisan`
  ADD PRIMARY KEY (`id_petugas`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `petugas_jaga_ibfk_1` (`id_jadwal`);

--
-- Indexes for table `petugas_gerbang`
--
ALTER TABLE `petugas_gerbang`
  ADD PRIMARY KEY (`id_petugas`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `petugas_gerbang_ibfk_1` (`id_jadwal`);

--
-- Indexes for table `petugas_upacara`
--
ALTER TABLE `petugas_upacara`
  ADD PRIMARY KEY (`id_petugas`),
  ADD KEY `petugas_upacara_ibfk_1` (`id_jadwal`),
  ADD KEY `petugas_upacara_ibfk_2` (`id_siswa`);

--
-- Indexes for table `produk_osis`
--
ALTER TABLE `produk_osis`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `struktur_osis`
--
ALTER TABLE `struktur_osis`
  ADD PRIMARY KEY (`id_struktur`);

--
-- Indexes for table `tes_doa_harian`
--
ALTER TABLE `tes_doa_harian`
  ADD PRIMARY KEY (`id_tes`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `transaksi_osis`
--
ALTER TABLE `transaksi_osis`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- Indexes for table `visi_misi`
--
ALTER TABLE `visi_misi`
  ADD PRIMARY KEY (`id_visi_misi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acara`
--
ALTER TABLE `acara`
  MODIFY `id_acara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `anggota_eskul`
--
ALTER TABLE `anggota_eskul`
  MODIFY `id_anggota_eskul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_anggota`
--
ALTER TABLE `data_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `data_kegiatan_event`
--
ALTER TABLE `data_kegiatan_event`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `data_kepengurusan`
--
ALTER TABLE `data_kepengurusan`
  MODIFY `id_kepengurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `data_organisasi_luar`
--
ALTER TABLE `data_organisasi_luar`
  MODIFY `id_organisasi_luar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `data_pelantikan`
--
ALTER TABLE `data_pelantikan`
  MODIFY `id_pelantikan` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `eskul`
--
ALTER TABLE `eskul`
  MODIFY `id_eskul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `hafalan_quran`
--
ALTER TABLE `hafalan_quran`
  MODIFY `id_tes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `infaq`
--
ALTER TABLE `infaq`
  MODIFY `id_infaq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_eskul`
--
ALTER TABLE `jadwal_eskul`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jadwal_jaga_barisan`
--
ALTER TABLE `jadwal_jaga_barisan`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_jaga_gerbang`
--
ALTER TABLE `jadwal_jaga_gerbang`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_kumpul_eskul`
--
ALTER TABLE `jadwal_kumpul_eskul`
  MODIFY `id_jadwal_eskul` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_razia`
--
ALTER TABLE `jadwal_razia`
  MODIFY `id_razia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jadwal_upacara`
--
ALTER TABLE `jadwal_upacara`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  MODIFY `id_jenis_pelanggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kehadiran_eskul`
--
ALTER TABLE `kehadiran_eskul`
  MODIFY `id_kehadiran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `keuangan_osis`
--
ALTER TABLE `keuangan_osis`
  MODIFY `id_keuangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `laporan_bulanan`
--
ALTER TABLE `laporan_bulanan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  MODIFY `id_pelanggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `petugas_barisan`
--
ALTER TABLE `petugas_barisan`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `petugas_gerbang`
--
ALTER TABLE `petugas_gerbang`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `petugas_upacara`
--
ALTER TABLE `petugas_upacara`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `produk_osis`
--
ALTER TABLE `produk_osis`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `struktur_osis`
--
ALTER TABLE `struktur_osis`
  MODIFY `id_struktur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tes_doa_harian`
--
ALTER TABLE `tes_doa_harian`
  MODIFY `id_tes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi_osis`
--
ALTER TABLE `transaksi_osis`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visi_misi`
--
ALTER TABLE `visi_misi`
  MODIFY `id_visi_misi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota_eskul`
--
ALTER TABLE `anggota_eskul`
  ADD CONSTRAINT `anggota_eskul_ibfk_1` FOREIGN KEY (`id_eskul`) REFERENCES `eskul` (`id_eskul`) ON DELETE CASCADE;

--
-- Constraints for table `hafalan_quran`
--
ALTER TABLE `hafalan_quran`
  ADD CONSTRAINT `hafalan_quran_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `data_anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal_eskul`
--
ALTER TABLE `jadwal_eskul`
  ADD CONSTRAINT `jadwal_eskul_ibfk_1` FOREIGN KEY (`id_eskul`) REFERENCES `eskul` (`id_eskul`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal_upacara`
--
ALTER TABLE `jadwal_upacara`
  ADD CONSTRAINT `jadwal_upacara_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kehadiran_eskul`
--
ALTER TABLE `kehadiran_eskul`
  ADD CONSTRAINT `kehadiran_eskul_ibfk_1` FOREIGN KEY (`id_jadwal_eskul`) REFERENCES `jadwal_kumpul_eskul` (`id_jadwal_eskul`) ON DELETE CASCADE,
  ADD CONSTRAINT `kehadiran_eskul_ibfk_2` FOREIGN KEY (`id_anggota_eskul`) REFERENCES `anggota_eskul` (`id_anggota_eskul`) ON DELETE CASCADE;

--
-- Constraints for table `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  ADD CONSTRAINT `pelanggaran_siswa_ibfk_1` FOREIGN KEY (`id_jenis_pelanggaran`) REFERENCES `jenis_pelanggaran` (`id_jenis_pelanggaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pelanggaran_siswa_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `petugas_barisan`
--
ALTER TABLE `petugas_barisan`
  ADD CONSTRAINT `petugas_barisan_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_jaga_barisan` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `petugas_barisan_ibfk_2` FOREIGN KEY (`id_anggota`) REFERENCES `data_anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `petugas_gerbang`
--
ALTER TABLE `petugas_gerbang`
  ADD CONSTRAINT `petugas_gerbang_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_jaga_gerbang` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `petugas_gerbang_ibfk_2` FOREIGN KEY (`id_anggota`) REFERENCES `data_anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `petugas_upacara`
--
ALTER TABLE `petugas_upacara`
  ADD CONSTRAINT `petugas_upacara_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_upacara` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `petugas_upacara_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tes_doa_harian`
--
ALTER TABLE `tes_doa_harian`
  ADD CONSTRAINT `tes_doa_harian_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `data_anggota` (`id_anggota`);

--
-- Constraints for table `transaksi_osis`
--
ALTER TABLE `transaksi_osis`
  ADD CONSTRAINT `transaksi_osis_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk_osis` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
