-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2019 at 12:29 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kampungsapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `status`, `createAt`) VALUES
(1, 'admin', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 1, '2019-09-26 08:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `nama`, `deskripsi`, `foto`) VALUES
(7, '<b>Pengetahuan Tentang Anak dan Induk Sapi </b>', '<br>\r\nPenasaran nggak sih kamu gimana cara merawat hewan ternak khususnya pada induk dan anak sapi?. <br> <br>\r\nNah, kalo kamu penasaran mending langsung aja ikuti kegiatan ini. Kamu dapat mengetahui cara merawat induk dan anak sapi sekaligus cara berternak sapi.', '4.jpg'),
(8, '<b> Berinteraksi Dengan Hewan Ternak dan Memberi Makan Sapi </b>', '<br>\r\nMemberi makan binatang kesayangan seperti kucing, anjing dan sebagainya sudah biasa kan? Kalau memberi makan sapi kamu udah pernah belum? Wah pastinya bagi kamu yang belum pernah jadi pengalaman baru. <br><br>\r\nYuk segera ajak teman dan keluarga kamu ke Wisata Kampung Sapi Adventure jangan sampek melewatkan pengelaman terbarumu.\r\n', '8.jpg'),
(14, 'Outbound ', '<p>Kampung Sapi adalah lokasi wisata yang tepat bagi wisatawan yang ingin mengajak anak-anak untuk bermain sebari belajar. Tak jauh dari kandang sapi, terdapat area outbond untuk mengasah ketangkasan. Ada jembatan bambu kecil untuk menguji keseimbangan dan juga tempat memanjat dari tumpukan ban warna-warni.</p>\r\n\r\n<p>Bagi yang sudah kelelahan dan ingin beristirahat, di lokasi ini juga terdapat banyak bangku-bangku kayu. Duduk-duduk di sini sembari menikmati semilir angin dingin khas pegunungan dan menikmati panorama sekitar juga tidak kalah mengasyikkan. Apalagi Anda juga bisa santai sambil mengawasi buah hati yang sedang asyik bermain. </p>\r\n', '1573807899.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `id_tiket` int(11) NOT NULL,
  `jumlah_tiket` int(11) NOT NULL,
  `tgl_pesanan` datetime NOT NULL,
  `tgl_expired` datetime NOT NULL,
  `tg_diambil` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `id_user`, `id_tiket`, `jumlah_tiket`, `tgl_pesanan`, `tgl_expired`, `tg_diambil`) VALUES
(68, 18, 10, 1, '2019-11-07 15:45:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `fasilitas` text NOT NULL,
  `kegiatan` text NOT NULL,
  `stok` smallint(6) NOT NULL,
  `type` int(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `harga` mediumint(9) NOT NULL,
  `img` varchar(255) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id`, `nama`, `fasilitas`, `kegiatan`, `stok`, `type`, `status`, `harga`, `img`, `createAt`) VALUES
(10, 'Edukasi Dairy 1', '- Welcome Drink Milkshake <br>\r\n- Tour Guide', '- Berinteraksi Dengan Hewan Ternak <br>\r\n- Memberi Makan Sapi <br>\r\n- Memerah Susu Sapi <br>\r\n- Edukasi Tentang Kelinci\r\n ', 0, 1, 0, 15000, '1.jpg', '2019-09-29 00:52:52'),
(11, 'Edukasi Dairy 2', '- Welcome Drink Milkshake <br>\r\n- Tour Guide', '- Berinteraksi Dengan Hewan Ternak <br>\r\n- Mengenal Anak Sapi <br>\r\n- Memberi Makan Sapi <br>\r\n- Memerah Susu Sapi <br>\r\n- Edukasi Tentang Kelinci <br>\r\n- <b> Edukasi Seputar Susu dan Pemanfaatannya </b>', 0, 1, 0, 25000, '2.jpg', '2019-09-29 00:53:08'),
(13, 'Edukasi Dan Outbound (Kids)', '- Welcome Drink Milkshake <br>\r\n- Tour Guide', '- Berinteraksi dengan hewan ternak <br>\r\n- Mengenal Anak Sapi <br>\r\n- Memberi Makan Sapi <br>\r\n- Memerah Susu Sapi <br>\r\n- Edukasi Tentang Kelinci <br>\r\n- Edukasi Seputar Susu Dan Pemanfaatannya <br>\r\n- Outbound Ala Ninja Warrior <br>\r\n- Menangkap Ikan <br>', 0, 2, 0, 35000, '1569745006.jpg', '2019-09-29 15:16:46'),
(14, 'One Day On Farm (Kids)', '- Welcome Drink Milkshake <br>\r\n- Tour Guide <br>\r\n- Makan siang\r\n', '- Berinteraksi Dengan Hewan Ternak <br>\r\n- Mengenal Anak Sapi <br>\r\n- Memberi Makan Sapi <br>\r\n- Memerah Susu Sapi <br>\r\n- Edukasi Tentang Kelinci <br>\r\n- Edukasi Seputar Susu Dan Pemanfaatannya <br>\r\n- Outbound Ala Ninja Warrior <br>\r\n- Menangkap Ikan <br>\r\n- <b>Makan Siang Bersama </b>', 0, 2, 0, 50000, '1569747520.jpg', '2019-09-29 15:58:40'),
(123, 'Edukasi', '<p>-Shuttle Car (bila rombongan menggunakan bus)</p>\r\n\r\n<p>-Tour guide</p>\r\n\r\n<p>-Welcome drink milkshake</p>\r\n', '<p>-Pengenalan Tentang Anak Sapi</p>\r\n\r\n<p>-Pengenalan Tentang Induk Sapi</p>\r\n\r\n<p>-Pemberian Pakan Pada Sapi</p>\r\n\r\n<p>-Pengetahuan Tentang Susu</p>\r\n\r\n<p>-Pengetahuan Tentang Tulang Sapi</p>\r\n\r\n<p>-Pengetahuan Pengolahan Biogas</p>\r\n', 0, 3, 0, 35000, '1570458077.jpg', '2019-10-07 21:21:17'),
(125, 'One Day On Farm', '<p>-Shuttle Car (bila rombongan menggunakan bus)</p>\r\n\r\n<p>-Tour Guide</p>\r\n\r\n<p>-Welcome Drink Milkshake</p>\r\n\r\n<p>-Makan Siang</p>\r\n', '<p><strong>Edukasi</strong></p>\r\n\r\n<p>-Pengenalan Tentang Anak Sapi</p>\r\n\r\n<p>-Pengenalan Tentang Induk Sapi</p>\r\n\r\n<p>-Pemberian Pakan Pada Sapi</p>\r\n\r\n<p>-Pengetahuan Tentang Susu</p>\r\n\r\n<p>-Pengetahuan Tentang Tulang Sapi</p>\r\n\r\n<p>-Pengetahuan Pengolahan Biogas</p>\r\n\r\n<p><strong>-Makan Siang Bersama</strong></p>\r\n\r\n<p><strong>Outbound </strong><br>\r\n-Team Building <br>\r\n-Fungame</p>\r\n', 0, 3, 0, 75000, '1570458745.jpg', '2019-10-07 21:32:25'),
(126, 'Dairy Tour & Outbound', '<p>-Shuttle Car (bila rombongan menggunakan bus)</p>\r\n\r\n<p>-Tour Guide</p>\r\n\r\n<p>-Welcome Drink Milkshake</p>\r\n', '<p><strong>Edukasi</strong></p>\r\n\r\n<p>-Pengenalan Tentang Anak Sapi</p>\r\n\r\n<p>-Pengenalan Tentang Induk Sapi</p>\r\n\r\n<p>-Pemberian Pakan Pada Sapi</p>\r\n\r\n<p>-Pengetahuan Tentang Susu</p>\r\n\r\n<p>-Pengetahuan Tentang Tulang Sapi</p>\r\n\r\n<p><strong>Outbound </strong></p>\r\n\r\n<p>-Team Building</p>\r\n\r\n<p>-Fungame</p>\r\n', 0, 3, 0, 50000, '1570460078.jpg', '2019-10-07 21:54:38'),
(127, 'Inspirasi Bisnis 1', '<p>-Pemateri (Dokter Hewan)</p>\r\n\r\n<p>-Shuttle Car (bila rombongan menggunakan bus)</p>\r\n\r\n<p>-Tour Guide</p>\r\n\r\n<p>-Welcome Drink Milkshake</p>\r\n', '<p>-Materi Inspirasi Bisnis Peternakan (Oleh Dokter Hewan)</p>\r\n\r\n<p>-Dairy tour (pengetahuan tentang sistem bisnis peternakan<br>\r\npemeliharaan sapi, pemberian pakan sapi dan pemanfaatan limbah sapi)</p>\r\n\r\n<p>-Demo Memasak Susu Dan Inspirasi Bisnis Pengolahan Susu Dengan Alat Yang Sederhana</p>\r\n', 0, 4, 0, 35000, '1570490906.jpg', '2019-10-08 06:28:26'),
(128, 'Insiprasi Bisnis 2', '<p>-Pemateri (Dokter Hewan)</p>\r\n\r\n<p>-Shuttle Car (bila rombongan menggunakan bus)</p>\r\n\r\n<p>-Tour Guide</p>\r\n\r\n<p>-Welcome Drink Milkshake</p>\r\n\r\n<p><strong>-Makan Siang</strong></p>\r\n\r\n<p><strong>-Membawa Produk Olahan Susu</strong></p>\r\n', '<p>-Materi Inspirasi Bisnis Peternakan (Oleh Dokter Hewan)</p>\r\n\r\n<p>-Dairy Tour (pengetahuan tentang sistem bisnis peternakan<br>\r\npemeliharaan sapi, pemberian pakan sapi dan pemanfaatan limbah sapi)</p>\r\n\r\n<p>-Demo Memasak Susu Dan Inspirasi Bisnis Pengolahan Susu Dengan Alat Yang Sederhana</p>\r\n\r\n<p>-<strong>Makan Siang Bersama</strong></p>\r\n', 0, 4, 0, 65000, '1570491168.jpg', '2019-10-08 06:32:48'),
(129, 'Insipirasi Bisnis & Outbound', '<p>-Pemateri (Dokter Hewan)</p>\r\n\r\n<p>-Shuttle Car (bila rombongan menggunakan bus)</p>\r\n\r\n<p>-Tour Guide</p>\r\n\r\n<p>-Welcome Drink Milkshake</p>\r\n\r\n<p><strong>-Makang Siang</strong></p>\r\n\r\n<p><strong>-Membawa Produk Olahan Susu</strong></p>\r\n', '<p>-Materi Inspirasi Bisnis Peternakan (Oleh Dokter Hewan)</p>\r\n\r\n<p>-Dairy Tour (pengetahuan tentang sistem bisnis peternakan<br>\r\npemeliharaan sapi, pemberian pakan sapi dan pemanfaatan limbah sapi)</p>\r\n\r\n<p>-Demo Memasak susu</p>\r\n\r\n<p>-Inspirasi Bisnis Pengolahan Susu Dengan Alat Yang Sederhana</p>\r\n\r\n<p>-<strong>Outbound</strong></p>\r\n', 0, 4, 0, 90000, '1570491432.jpg', '2019-10-08 06:37:12');

-- --------------------------------------------------------

--
-- Table structure for table `type_tiket`
--

CREATE TABLE `type_tiket` (
  `id` int(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tipe` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_tiket`
--

INSERT INTO `type_tiket` (`id`, `nama`, `tipe`) VALUES
(1, 'goshow', 0),
(2, 'tk', 1),
(3, 'smp', 1),
(4, 'mahasiswa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `kode` varchar(7) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `status`, `kode`, `createAt`) VALUES
(14, 'khan', 'fliazmi@gmail.com', '303958a13f3a8817f140cfd1425c453a0ca28dfadeaf809346e96e822b6ed9ac07ffe3642eaf02d6f210d1df58595f932b948b86b0daae80b7d86f7adae80bf4', 1, 'b631184', '2019-09-29 01:56:14'),
(18, 'yunski', 'yunindaeka06@gmail.com', 'b5f154bb64b5a405e355945bb6ea0505da0e971565aa4b12206f44c4b988c6767a9db04d928d530383b850d2afa481a95bebe7935fe23bdbc63115d62e25dcc8', 1, 'e997abf', '2019-09-29 09:24:33'),
(28, '', '', 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e', 0, '3f27192', '2019-11-03 11:15:39'),
(29, '', '', 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e', 0, '2fbba4b', '2019-11-03 11:16:17'),
(30, '', '', 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e', 0, 'f483284', '2019-11-03 11:16:27'),
(31, '', '', 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e', 0, '29e7e54', '2019-11-03 11:16:34'),
(32, 'vedo', 'vedoraku@gmail.com', 'fb131bc57a477c8c9d068f1ee5622ac304195a77164ccc2d75d82dfe1a727ba8d674ed87f96143b2b416aacefb555e3045c356faa23e6d21de72b85822e39fdd', 1, '9587830', '2019-11-03 11:54:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tiket` (`id_tiket`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `type_tiket`
--
ALTER TABLE `type_tiket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `type_tiket`
--
ALTER TABLE `type_tiket`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_tiket`) REFERENCES `tiket` (`id`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `tiket_ibfk_1` FOREIGN KEY (`type`) REFERENCES `type_tiket` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
