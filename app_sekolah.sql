-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 01, 2021 at 08:02 PM
-- Server version: 10.3.27-MariaDB-0+deb10u1
-- PHP Version: 7.3.19-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id_absen` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `akses_role`
--

CREATE TABLE `akses_role` (
  `akses_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akses_role`
--

INSERT INTO `akses_role` (`akses_role`, `id_menu`, `id_role`) VALUES
(212, 9, 1),
(213, 10, 1),
(214, 11, 1),
(218, 23, 1),
(219, 24, 1),
(220, 27, 1),
(222, 57, 1),
(223, 62, 1),
(225, 66, 1),
(226, 63, 1),
(228, 1, 1),
(229, 22, 1),
(230, 67, 1),
(231, 68, 1),
(232, 69, 1),
(233, 70, 1),
(234, 71, 1),
(235, 72, 1),
(236, 73, 1),
(237, 74, 1),
(238, 75, 1),
(239, 76, 1),
(240, 77, 1),
(241, 78, 1),
(242, 1, 2),
(243, 66, 2),
(244, 67, 2),
(245, 68, 2),
(246, 69, 2),
(247, 70, 2),
(248, 71, 2),
(249, 72, 2),
(250, 73, 2),
(251, 74, 2),
(252, 75, 2),
(253, 76, 2),
(254, 77, 2),
(255, 78, 2),
(256, 79, 2),
(257, 80, 2),
(258, 22, 2),
(259, 79, 1),
(260, 80, 1);

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE `backup` (
  `id_backup` int(11) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `file` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telepon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nama_guru`, `nip`, `alamat`, `no_telepon`, `email`) VALUES
(1, 'Adiatna Sukmana', '171810009', 'Jl. Soekarno Hatta No.69', '083822623170', 'adiatna@gmail.com'),
(2, 'Abdurrahman Shah', '1718100001', 'Jl. Mawar No. 55', '083822623170', 'abdu@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(1, 'Rekayasa Perangkat Lunak'),
(2, 'Desain Komunikasi Visual'),
(3, 'Bisnis Daring Pemasaran');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `id_jurusan`, `nama_kelas`) VALUES
(3, 1, 'X RPL 1'),
(4, 1, 'X RPL 2'),
(5, 1, 'X RPL 3');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_pelajaran` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `tahun_angkatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `id_kelas`, `id_guru`, `id_pelajaran`, `judul`, `deskripsi`, `lampiran`, `tahun_angkatan`) VALUES
(1, 3, 2, 2, 'Aljabar | Bentuk Aljabar, Rumus Aljabar, dan Operasi Aljabar', 'A. Pengertian Aljabar atau Algebra\r\nAljabar adalah bagian dari ilmu matematika meliputi teori bilangan, geometri, dan analisis penyelesaiannya. Secara harfiah, aljabar berasal dari bahasa arab yaitu الجبر‎ atau yang dibaca \"al-jabr\". Ilmu ini dibuat oleh Muḥammad ibn Mūsā al-Khwārizmī dalam bukunya mengenai konsep dan bentuk aljabar ditulis sekitar tahun 820, yang merupakan seorang matematikawan, astronomer, dan geograf. Ia dijuluki sebagai \"The Father of Algebra\". Dalam bahasa inggris, aljabar dikenal dengan istilah \"algebra\".', '', 2021),
(2, 3, 1, 6, 'Belajar HTML Lengkap untuk Pemula', 'Apa Itu HTML?\r\nHTML (Hypertext Markup Language) merupakan gabungan dari dua istilah: hypertext dan markup language. Apa sih itu?\r\n\r\nHypertext yaitu dokumen berisi tautan yang memungkinkan pengguna terhubung ke halaman lain.\r\n\r\nSedangkan markup language merupakan bahasa komputer yang terdiri dari sekumpulan kode untuk mengatur struktur dan menyajikan informasi.\r\n\r\nJadi, HTML adalah bahasa markup untuk membuat struktur halaman website. \r\n\r\nSejarah HTML\r\nTahun 1991 adalah saksi kelahiran HTML. Dibuat oleh seorang ilmuwan bernama Tim Berners-Lee, HTML awalnya menjadi solusi untuk memudahkan para ilmuwan dalam mengakses dokumen satu sama lain.\r\n\r\nNamun, siapa sangka HTML berkembang dan menjelma sebagai pondasi untuk membuat website di era terkini? Bahkan, 90.8% website di dunia menggunakan bahasa markup ini, lho. Menakjubkan, bukan?', '', 2021);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `ada_submenu` int(11) NOT NULL,
  `submenu` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `icon`, `ada_submenu`, `submenu`, `url`, `urutan`) VALUES
(1, 'Dashboard', 'fa fa-tachometer-alt', 0, 0, 'dashboard', 1),
(9, 'User', 'fas fa-user-friends', 1, 0, 'user', 6),
(10, 'Data User', 'fas fa-user-shield', 0, 9, 'user', 1),
(11, 'Akses Menu User', 'fas fa-shield-alt', 0, 9, 'user/akses', 2),
(22, 'Profil Saya', 'fa fa-user', 0, 0, 'profil', 9),
(23, 'Utilitas', 'fas fa-cog', 1, 0, 'utilitas', 7),
(24, 'Backup Database', 'fas fa-database', 0, 23, 'utilitas/backup', 1),
(27, 'Pengaturan', 'fas fa-cogs', 0, 0, 'pengaturan', 8),
(62, 'Menu Management', 'fa fa-bars', 0, 23, 'menu', 3),
(63, 'CRUD Generator', 'fas fa-edit', 0, 23, 'crud_generator', 2),
(66, 'Data Master', 'fas fa-th-large', 1, 0, 'master', 2),
(67, 'Data Jurusan', 'fas fa-square', 0, 66, 'jurusan', 1),
(68, 'Data Kelas', 'fas fa-square', 0, 66, 'kelas', 2),
(69, 'Data Pelajaran', 'fas fa-square', 0, 66, 'pelajaran', 3),
(70, 'Data Guru', 'fas fa-square', 0, 66, 'guru', 4),
(71, 'Data Siswa', 'fas fa-square', 0, 66, 'siswa', 5),
(72, 'Materi', 'fas fa-book-open', 1, 0, 'materi', 3),
(73, 'Tambah Materi', 'fas fa-square', 0, 72, 'materi/create', 1),
(74, 'Data Materi', 'fas fa-square', 0, 72, 'materi', 2),
(75, 'Tugas', 'fas fa-pen', 1, 0, 'tugas', 4),
(76, 'Tambah Tugas', 'fas fa-square', 0, 75, 'tugas/create', 1),
(77, 'Data Tugas', 'fas fa-square', 0, 75, 'tugas', 2),
(78, 'Pengumpulan Tugas', 'fas fa-square', 0, 75, 'tugas_siswa', 3),
(79, 'Absen', 'fas fa-user-edit', 1, 0, 'absen', 5),
(80, 'Data Absen', '', 0, 79, 'absen', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran`
--

CREATE TABLE `pelajaran` (
  `id_pelajaran` int(11) NOT NULL,
  `nama_pelajaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelajaran`
--

INSERT INTO `pelajaran` (`id_pelajaran`, `nama_pelajaran`) VALUES
(2, 'Matematika'),
(3, 'Bahasa Inggris'),
(4, 'Database'),
(5, 'Pemodelan Perangkat Lunak'),
(6, 'Pemrograman Web dan Perangkat Bergerak'),
(7, 'Produk Kreatif Dan Kewirausahaan');

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran_guru`
--

CREATE TABLE `pelajaran_guru` (
  `id_pelajaran_guru` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_pelajaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_pengaturan` int(11) NOT NULL,
  `nama_aplikasi` varchar(255) NOT NULL,
  `logo` varchar(128) NOT NULL,
  `smtp_host` varchar(128) NOT NULL,
  `smtp_email` varchar(128) NOT NULL,
  `smtp_username` varchar(128) NOT NULL,
  `smtp_password` varchar(128) NOT NULL,
  `smtp_port` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id_pengaturan`, `nama_aplikasi`, `logo`, `smtp_host`, `smtp_email`, `smtp_username`, `smtp_password`, `smtp_port`) VALUES
(1, 'My App', 'layers.png', 'ssl://smtp.gmail.com', 'contoh@email.com', 'email username', 'email password', 465);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'Admin'),
(2, 'Demo');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `nis` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telepon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tahun_angkatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_kelas`, `nama_siswa`, `nis`, `alamat`, `no_telepon`, `email`, `tahun_angkatan`) VALUES
(1, 3, 'Muhammad Rivaldi', '1718100004', 'Jl. Muhammad Hatta No. 45', '083822623170', 'rivaldi@gmail.com', 2021),
(2, 4, 'Dimas Subagja', '1718100006', 'Jl. Violet', '083822623170', 'dimas@gmail.com', 2021);

-- --------------------------------------------------------

--
-- Table structure for table `token_user`
--

CREATE TABLE `token_user` (
  `id` int(11) NOT NULL,
  `id_user` char(10) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp(),
  `token` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_pelajaran` int(11) NOT NULL,
  `judul` varchar(225) NOT NULL,
  `deskripsi` text NOT NULL,
  `lampiran` varchar(225) NOT NULL,
  `tahun_angkatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `id_kelas`, `id_guru`, `id_pelajaran`, `judul`, `deskripsi`, `lampiran`, `tahun_angkatan`) VALUES
(1, 3, 2, 6, 'Tugas Web', 'Buat sebuah halaman web statis dari HTML CSS', '', 2021),
(2, 3, 2, 7, 'Tugas Matematika', 'Hitung 2x9-1 = ?', '', 2021);

-- --------------------------------------------------------

--
-- Table structure for table `tugas_siswa`
--

CREATE TABLE `tugas_siswa` (
  `id_tugas_siswa` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_tugas` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `lampiran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas_siswa`
--

INSERT INTO `tugas_siswa` (`id_tugas_siswa`, `id_siswa`, `id_tugas`, `deskripsi`, `lampiran`) VALUES
(1, 2, 2, 'Saya sudah mengerjakan nya pak, done', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` char(10) NOT NULL,
  `nama_user` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `telepon` char(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `alamat`, `jk`, `telepon`, `email`, `password`, `gambar`, `id_role`) VALUES
('PTS000', 'SUPERADMIN', 'BANDUNG', 'L', '083822623170', 'superadmin@admin.com', '$2y$10$MGcM/fpEsu/SGZYifhZWpOD3qIjU0YU7PVNQHDhLhd6yTm2Tgxzj.', 'man.png', 1),
('PTS00001', 'Administrator', 'Batulawang', 'L', '085864273756', 'admin@admin.com', '$2y$10$t2LIGNkyTgoo.wfFq65HU.RMH3.maKSCVMYL1.ix0l.xZjAOfi1PK', 'man-1.png', 1),
('PTS00002', 'Demo', 'Bandung', 'L', '083822623170', 'demo@demo.com', '$2y$10$t5Faqji2TTAotNsf8CQfyuyrysWr36fPnPi3cv6Dh5verLdvJGGPC', 'boy.png', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `akses_role`
--
ALTER TABLE `akses_role`
  ADD PRIMARY KEY (`akses_role`);

--
-- Indexes for table `backup`
--
ALTER TABLE `backup`
  ADD PRIMARY KEY (`id_backup`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `pelajaran`
--
ALTER TABLE `pelajaran`
  ADD PRIMARY KEY (`id_pelajaran`);

--
-- Indexes for table `pelajaran_guru`
--
ALTER TABLE `pelajaran_guru`
  ADD PRIMARY KEY (`id_pelajaran_guru`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `token_user`
--
ALTER TABLE `token_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- Indexes for table `tugas_siswa`
--
ALTER TABLE `tugas_siswa`
  ADD PRIMARY KEY (`id_tugas_siswa`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `akses_role`
--
ALTER TABLE `akses_role`
  MODIFY `akses_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT for table `backup`
--
ALTER TABLE `backup`
  MODIFY `id_backup` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `pelajaran`
--
ALTER TABLE `pelajaran`
  MODIFY `id_pelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pelajaran_guru`
--
ALTER TABLE `pelajaran_guru`
  MODIFY `id_pelajaran_guru` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `token_user`
--
ALTER TABLE `token_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tugas_siswa`
--
ALTER TABLE `tugas_siswa`
  MODIFY `id_tugas_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
