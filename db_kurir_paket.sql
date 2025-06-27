-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 27, 2025 at 01:40 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kurir_paket`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `id_bank` int NOT NULL,
  `nama_bank` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`id_bank`, `nama_bank`) VALUES
(1, 'BRI'),
(2, 'BNI'),
(3, 'Mandiri');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data_kurir`
--

CREATE TABLE `tbl_data_kurir` (
  `id_kurir` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `nama_kurir` varchar(20) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat_kurir` text,
  `status` enum('aktif','non-aktif') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_data_kurir`
--

INSERT INTO `tbl_data_kurir` (`id_kurir`, `id_user`, `nama_kurir`, `no_hp`, `alamat_kurir`, `status`) VALUES
(1, 3, 'Kurir Agus', '081234000001', 'menyenye', 'aktif'),
(2, 3, 'Kurir Budi', '081234000002', 'Jl. Selagalas No.5', 'non-aktif'),
(3, 3, 'Kurir Andi', '081234000003', 'Jl. Panjitilar Negara No.8', 'aktif'),
(4, 3, 'Kurir Dedi', '081234000004', 'Cakranegara', 'aktif'),
(5, 3, 'Kurir Eko', '081234000005', 'Sekarbela', 'non-aktif'),
(6, 3, 'Kurir Fajar', '081234000006', 'Sandubaya', 'aktif'),
(7, 3, 'Kurir Gita', '081234000007', 'Mataram', 'aktif'),
(8, 3, 'Kurir Hadi', '081234000008', 'Ampenan', 'non-aktif'),
(9, 3, 'Kurir Intan', '081234000009', 'Gunungsari', 'aktif'),
(11, 3, 'Kurir Kevin', '081234000011', 'Narmada', 'aktif'),
(12, 3, 'Kurir Lestari', '081234000012', 'Kediri', 'non-aktif'),
(13, 3, 'Kurir Mahmud', '081234000013', 'Praya', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_paket`
--

CREATE TABLE `tbl_jenis_paket` (
  `id_jenis_paket` int NOT NULL,
  `nama_jenis_paket` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_jenis_paket`
--

INSERT INTO `tbl_jenis_paket` (`id_jenis_paket`, `nama_jenis_paket`) VALUES
(1, 'Pakaian'),
(2, 'Prabotan'),
(3, 'Skincare'),
(4, 'Elektronik'),
(5, 'Dokumen'),
(6, 'Makanan'),
(7, 'Buku'),
(8, 'Aksesoris'),
(9, 'Obat-obatan'),
(10, 'Mainan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kabupaten`
--

CREATE TABLE `tbl_kabupaten` (
  `id_kab` int NOT NULL,
  `nama_kabupaten` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_kabupaten`
--

INSERT INTO `tbl_kabupaten` (`id_kab`, `nama_kabupaten`) VALUES
(5201, 'Lombok Barat'),
(5202, 'Lombok Tengah'),
(5203, 'Lombok Timur'),
(5271, 'Kota Mataram');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penerima`
--

CREATE TABLE `tbl_penerima` (
  `id_penerima` int NOT NULL,
  `id_kab_tujuan` int DEFAULT NULL,
  `nama_penerima` varchar(30) DEFAULT NULL,
  `kec_pengirim` varchar(30) DEFAULT NULL,
  `alamat_penerima` text,
  `hp_penerima` varchar(20) DEFAULT NULL,
  `link_maps` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_penerima`
--

INSERT INTO `tbl_penerima` (`id_penerima`, `id_kab_tujuan`, `nama_penerima`, `kec_pengirim`, `alamat_penerima`, `hp_penerima`, `link_maps`) VALUES
(1, 5201, 'Budi', 'Kediri', 'Jl. Gunung Sari No.2', '081234111111', 'https://maps.app/go1'),
(2, 5203, 'Tini', 'Masbagik', 'Jl. Raya Masbagik', '081234222222', 'https://maps.app/go2'),
(3, 5271, 'Joko', 'Cakranegara', 'Jl. Selaparang No.3', '081234333333', 'https://maps.app/go3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengirim`
--

CREATE TABLE `tbl_pengirim` (
  `id_pengirim` int NOT NULL,
  `id_kab_asal` int DEFAULT NULL,
  `id_bank` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `nama_pengirim` varchar(30) DEFAULT NULL,
  `kec_pengirim` varchar(30) DEFAULT NULL,
  `alamat_pengirim` text,
  `hp_pengirim` varchar(20) DEFAULT NULL,
  `no_rekening` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_pengirim`
--

INSERT INTO `tbl_pengirim` (`id_pengirim`, `id_kab_asal`, `id_bank`, `id_user`, `nama_pengirim`, `kec_pengirim`, `alamat_pengirim`, `hp_pengirim`, `no_rekening`) VALUES
(1, 5271, 1, 2, 'Dian Pertiwi', 'Ampenan', 'Jl. Udayana No.10', '081234567890', '1234567890'),
(2, 5201, 2, 2, 'Rina Ayu', 'Gerung', 'Jl. Majapahit No.7', '081223344556', '2233445566'),
(3, 5203, 3, 2, 'Eka Putri', 'Selong', 'Jl. Sultan Agung No.5', '082233445566', '3344556677');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengiriman_paket`
--

CREATE TABLE `tbl_pengiriman_paket` (
  `id_pengiriman` int NOT NULL,
  `id_tarif` int DEFAULT NULL,
  `id_pengirim` int DEFAULT NULL,
  `id_penerima` int DEFAULT NULL,
  `id_jenis_paket` int DEFAULT NULL,
  `id_status_order` int DEFAULT NULL,
  `id_kurir_jemput` int DEFAULT NULL,
  `id_kurir_antar` int DEFAULT NULL,
  `berat_barang` decimal(10,2) DEFAULT NULL,
  `harga_barang` decimal(10,2) DEFAULT NULL,
  `status_pembayaran` enum('belum bayar','sudah bayar') DEFAULT NULL,
  `resi` varchar(50) DEFAULT NULL,
  `bukti_tf_admin` varchar(225) DEFAULT NULL,
  `waktu_konfirmasi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_pengiriman_paket`
--

INSERT INTO `tbl_pengiriman_paket` (`id_pengiriman`, `id_tarif`, `id_pengirim`, `id_penerima`, `id_jenis_paket`, `id_status_order`, `id_kurir_jemput`, `id_kurir_antar`, `berat_barang`, `harga_barang`, `status_pembayaran`, `resi`, `bukti_tf_admin`, `waktu_konfirmasi`) VALUES
(1, 1, 1, 1, 1, 2, 3, 1, 1.50, 200000.00, 'belum bayar', 'RESI001', 'bukti1.jpg', '2025-06-27 12:37:52'),
(2, 2, 2, 2, 2, 2, 2, 1, 2.00, 30000.00, 'sudah bayar', 'RESI002', 'bukti2.jpg', '2025-06-27 11:00:00'),
(3, 3, 3, 3, 3, 3, 1, 3, 0.80, 25000.00, 'sudah bayar', 'RESI003', 'bukti3.jpg', '2025-06-27 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status_order`
--

CREATE TABLE `tbl_status_order` (
  `id_status` int NOT NULL,
  `nama_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_status_order`
--

INSERT INTO `tbl_status_order` (`id_status`, `nama_status`, `keterangan`) VALUES
(1, 'Menunggu konfirmasi', 'Order telah dibuat dan menunggu konfirmasi admin'),
(2, 'Paket terkonfirmasi', 'Paket sudah terkonfirmasi, selanjutnya menunggu di jemput kurir'),
(3, 'Diproses Kurir', 'Paket sedang diproses dan dijemput oleh kurir'),
(4, 'Dalam Pengiriman', 'Paket sedang dalam perjalanan ke alamat penerima'),
(5, 'Selesai', 'Paket telah diterima oleh penerima dan pengiriman selesai'),
(6, 'Gagal Dikirim', 'Pengiriman gagal karena alamat tidak ditemukan atau penerima tidak ada'),
(7, 'Retur', 'Paket dikembalikan ke pengirim setelah gagal dikirim');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tarif`
--

CREATE TABLE `tbl_tarif` (
  `id_tarif` int NOT NULL,
  `id_kab_asal` int DEFAULT NULL,
  `id_kab_tujuan` int DEFAULT NULL,
  `tarif` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_tarif`
--

INSERT INTO `tbl_tarif` (`id_tarif`, `id_kab_asal`, `id_kab_tujuan`, `tarif`) VALUES
(1, 5271, 5201, 15000.00),
(2, 5271, 5203, 20000.00),
(3, 5201, 5203, 25000.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `role` enum('user','admin','kurir') DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `role`, `nama`) VALUES
(1, 'Admin', 'Admin123', 'admin', 'Admin'),
(2, 'Dianpertiwi@123', 'dian12345', 'user', 'Dian Pertiwi'),
(3, 'kurir01', 'kurir01@001', 'kurir', 'Kurir Agus'),
(4, 'kurirdedi', 'dedi123', 'kurir', 'Kurir Dedi'),
(5, 'kurireko', 'eko123', 'kurir', 'Kurir Eko'),
(6, 'kurirfajar', 'fajar123', 'kurir', 'Kurir Fajar'),
(7, 'kurirgita', 'gita123', 'kurir', 'Kurir Gita'),
(8, 'kurirhadi', 'hadi123', 'kurir', 'Kurir Hadi'),
(9, 'kuririntan', 'intan123', 'kurir', 'Kurir Intan'),
(10, 'kurirjoko', 'joko123', 'kurir', 'Kurir Joko'),
(11, 'kurirkevin', 'kevin123', 'kurir', 'Kurir Kevin'),
(12, 'kurirlestari', 'lestari123', 'kurir', 'Kurir Lestari'),
(13, 'kurirmahmud', 'mahmud123', 'kurir', 'Kurir Mahmud');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `tbl_data_kurir`
--
ALTER TABLE `tbl_data_kurir`
  ADD PRIMARY KEY (`id_kurir`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_jenis_paket`
--
ALTER TABLE `tbl_jenis_paket`
  ADD PRIMARY KEY (`id_jenis_paket`);

--
-- Indexes for table `tbl_kabupaten`
--
ALTER TABLE `tbl_kabupaten`
  ADD PRIMARY KEY (`id_kab`);

--
-- Indexes for table `tbl_penerima`
--
ALTER TABLE `tbl_penerima`
  ADD PRIMARY KEY (`id_penerima`),
  ADD KEY `id_kab_tujuan` (`id_kab_tujuan`);

--
-- Indexes for table `tbl_pengirim`
--
ALTER TABLE `tbl_pengirim`
  ADD PRIMARY KEY (`id_pengirim`),
  ADD KEY `id_kab_asal` (`id_kab_asal`),
  ADD KEY `id_bank` (`id_bank`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_pengiriman_paket`
--
ALTER TABLE `tbl_pengiriman_paket`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD KEY `id_tarif` (`id_tarif`),
  ADD KEY `id_pengirim` (`id_pengirim`),
  ADD KEY `id_penerima` (`id_penerima`),
  ADD KEY `id_jenis_paket` (`id_jenis_paket`),
  ADD KEY `id_status_order` (`id_status_order`),
  ADD KEY `id_kurir_jemput` (`id_kurir_jemput`),
  ADD KEY `id_kurir_antar` (`id_kurir_antar`);

--
-- Indexes for table `tbl_status_order`
--
ALTER TABLE `tbl_status_order`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tbl_tarif`
--
ALTER TABLE `tbl_tarif`
  ADD PRIMARY KEY (`id_tarif`),
  ADD KEY `id_kab_asal` (`id_kab_asal`),
  ADD KEY `id_kab_tujuan` (`id_kab_tujuan`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_data_kurir`
--
ALTER TABLE `tbl_data_kurir`
  ADD CONSTRAINT `tbl_data_kurir_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`);

--
-- Constraints for table `tbl_penerima`
--
ALTER TABLE `tbl_penerima`
  ADD CONSTRAINT `tbl_penerima_ibfk_1` FOREIGN KEY (`id_kab_tujuan`) REFERENCES `tbl_kabupaten` (`id_kab`);

--
-- Constraints for table `tbl_pengirim`
--
ALTER TABLE `tbl_pengirim`
  ADD CONSTRAINT `tbl_pengirim_ibfk_1` FOREIGN KEY (`id_kab_asal`) REFERENCES `tbl_kabupaten` (`id_kab`),
  ADD CONSTRAINT `tbl_pengirim_ibfk_2` FOREIGN KEY (`id_bank`) REFERENCES `tbl_bank` (`id_bank`),
  ADD CONSTRAINT `tbl_pengirim_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`);

--
-- Constraints for table `tbl_pengiriman_paket`
--
ALTER TABLE `tbl_pengiriman_paket`
  ADD CONSTRAINT `tbl_pengiriman_paket_ibfk_1` FOREIGN KEY (`id_tarif`) REFERENCES `tbl_tarif` (`id_tarif`),
  ADD CONSTRAINT `tbl_pengiriman_paket_ibfk_2` FOREIGN KEY (`id_pengirim`) REFERENCES `tbl_pengirim` (`id_pengirim`),
  ADD CONSTRAINT `tbl_pengiriman_paket_ibfk_3` FOREIGN KEY (`id_penerima`) REFERENCES `tbl_penerima` (`id_penerima`),
  ADD CONSTRAINT `tbl_pengiriman_paket_ibfk_4` FOREIGN KEY (`id_jenis_paket`) REFERENCES `tbl_jenis_paket` (`id_jenis_paket`),
  ADD CONSTRAINT `tbl_pengiriman_paket_ibfk_5` FOREIGN KEY (`id_status_order`) REFERENCES `tbl_status_order` (`id_status`),
  ADD CONSTRAINT `tbl_pengiriman_paket_ibfk_6` FOREIGN KEY (`id_kurir_jemput`) REFERENCES `tbl_data_kurir` (`id_kurir`),
  ADD CONSTRAINT `tbl_pengiriman_paket_ibfk_7` FOREIGN KEY (`id_kurir_antar`) REFERENCES `tbl_data_kurir` (`id_kurir`);

--
-- Constraints for table `tbl_tarif`
--
ALTER TABLE `tbl_tarif`
  ADD CONSTRAINT `tbl_tarif_ibfk_1` FOREIGN KEY (`id_kab_asal`) REFERENCES `tbl_kabupaten` (`id_kab`),
  ADD CONSTRAINT `tbl_tarif_ibfk_2` FOREIGN KEY (`id_kab_tujuan`) REFERENCES `tbl_kabupaten` (`id_kab`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
