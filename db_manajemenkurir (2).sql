-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2025 at 03:04 PM
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
-- Database: `db_manajemenkurir`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `id_bank` int(11) NOT NULL,
  `nama_bank` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`id_bank`, `nama_bank`) VALUES
(1, 'NTB'),
(2, 'BRI'),
(3, 'Mandiri'),
(4, 'BCA'),
(5, 'BNI'),
(6, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` int(11) NOT NULL,
  `jenis_barang` varchar(100) DEFAULT NULL,
  `berat_barang` float DEFAULT NULL,
  `harga_barang` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `jenis_barang`, `berat_barang`, `harga_barang`) VALUES
(1, 'Kamera', 0.5, 3000000),
(2, 'Laptop', 2, 8000000),
(3, 'Smartphone', 0.3, 1500000),
(4, 'Buku', 1, 50000),
(5, 'Televisi', 5, 4000000),
(6, 'celana', 2, 70000),
(7, 'celana', 2, 70000),
(8, 'celana', 2, 70000),
(9, 'celana', 2, 70000),
(10, 'celana', 2, 70000),
(11, 'celana', 2, 70000),
(12, 'elektronik', 170000, 89000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data_kurir`
--

CREATE TABLE `tbl_data_kurir` (
  `id_kurir` int(11) NOT NULL,
  `nama_kurir` varchar(100) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `status` enum('aktif','non-aktif') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_data_kurir`
--

INSERT INTO `tbl_data_kurir` (`id_kurir`, `nama_kurir`, `no_hp`, `alamat`, `status`) VALUES
(1, 'Andi ', '085678901', 'Gerung', 'aktif'),
(2, 'Jaka ', '0812838237', 'Pringgasela', 'aktif'),
(3, 'iwan', '20913981923', 'masbagik lotim', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kabupaten`
--

CREATE TABLE `tbl_kabupaten` (
  `id_kabupaten` int(11) NOT NULL,
  `nama_kabupaten` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kabupaten`
--

INSERT INTO `tbl_kabupaten` (`id_kabupaten`, `nama_kabupaten`) VALUES
(1, 'Kota Mataram'),
(2, 'Lombok Barat'),
(3, 'Lombok Tengah'),
(4, 'Lombok Timur');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kecamatan`
--

CREATE TABLE `tbl_kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `id_kabupaten` int(11) NOT NULL,
  `nama_kecamatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kecamatan`
--

INSERT INTO `tbl_kecamatan` (`id_kecamatan`, `id_kabupaten`, `nama_kecamatan`) VALUES
(1, 1, 'Kecamatan Cakranegara'),
(2, 2, 'Gerung'),
(3, 1, 'Kecamatan Ampenan'),
(4, 1, 'Kecamatan Cakranegara'),
(5, 1, 'Kecamatan Sandubaya'),
(6, 1, 'Kecamatan Selaparang'),
(7, 2, 'Kecamatan Gerung'),
(8, 2, 'Kecamatan Lingsar'),
(9, 2, 'Kecamatan Narmada'),
(10, 2, 'Kecamatan Kediri'),
(11, 2, 'Kecamatan Batulayar'),
(12, 3, 'Kecamatan Praya'),
(13, 3, 'Kecamatan Praya Barat'),
(14, 3, 'Kecamatan Praya Timur'),
(15, 3, 'Kecamatan Janapria'),
(16, 3, 'Kecamatan Batukliang'),
(17, 4, 'Kecamatan Selong'),
(18, 4, 'Kecamatan Pringgabaya'),
(19, 4, 'Kecamatan Sikur'),
(20, 4, 'Kecamatan Keruak'),
(22, 4, 'Pringgasela'),
(24, 4, 'Aikmel');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penerima`
--

CREATE TABLE `tbl_penerima` (
  `id_penerima` int(11) NOT NULL,
  `nama_penerima` varchar(100) DEFAULT NULL,
  `kabupaten_penerima` varchar(100) DEFAULT NULL,
  `kecamatan_penerima` varchar(100) DEFAULT NULL,
  `alamat_penerima` text DEFAULT NULL,
  `hp_penerima` varchar(20) DEFAULT NULL,
  `link_maps` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_penerima`
--

INSERT INTO `tbl_penerima` (`id_penerima`, `nama_penerima`, `kabupaten_penerima`, `kecamatan_penerima`, `alamat_penerima`, `hp_penerima`, `link_maps`) VALUES
(1, 'Fina', 'Jakarta', 'Tanjung Duren', 'Jl. Tanjung Duren No. 15, Jakarta', '08123456789', 'https://goo.gl/maps/abc'),
(2, 'Gina', 'Bandung', 'Cidadap', 'Jl. Cidadap No. 12, Bandung', '08987654321', 'https://goo.gl/maps/xyz'),
(3, 'Hani', 'Surabaya', 'Dukuh Pakis', 'Jl. Dukuh Pakis No. 7, Surabaya', '08765432109', 'https://goo.gl/maps/pqr'),
(4, 'Indah', 'Medan', 'Percut Sei Tuan', 'Jl. Percut Sei Tuan No. 8, Medan', '08122334455', 'https://goo.gl/maps/lmn'),
(5, 'Jeni', 'Yogyakarta', 'Sleman', 'Jl. Sleman No. 9, Yogyakarta', '08512367890', 'https://goo.gl/maps/uvw'),
(6, 'joko', 'Lombok Barat', 'Kecamatan Janapria', 'akjdskadj', '2919012890', 'https://maps.app.goo.gl/vZjedGwDStbSDSPN8'),
(7, 'joko', 'Lombok Barat', 'Kecamatan Janapria', 'akjdskadj', '2919012890', 'https://maps.app.goo.gl/vZjedGwDStbSDSPN8'),
(8, 'joko', 'Lombok Barat', 'Kecamatan Janapria', 'akjdskadj', '2919012890', 'https://maps.app.goo.gl/vZjedGwDStbSDSPN8'),
(9, 'joko', 'Lombok Barat', 'Kecamatan Janapria', 'akjdskadj', '2919012890', 'https://maps.app.goo.gl/vZjedGwDStbSDSPN8'),
(10, 'joko', 'Lombok Barat', 'Kecamatan Janapria', 'akjdskadj', '2919012890', 'https://maps.app.goo.gl/vZjedGwDStbSDSPN8'),
(11, 'joko', 'Lombok Barat', 'Kecamatan Janapria', 'akjdskadj', '2919012890', 'https://maps.app.goo.gl/vZjedGwDStbSDSPN8'),
(12, 'manda', 'Kota Mataram', 'Kecamatan Batukliang', 'bebas juga', '9213812739', 'https://maps.app.goo.gl/vZjedGwDStbSDSPN8');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengirim`
--

CREATE TABLE `tbl_pengirim` (
  `id_pengirim` int(11) NOT NULL,
  `nama_pengirim` varchar(100) DEFAULT NULL,
  `kabupaten_pengirim` varchar(100) DEFAULT NULL,
  `kecamatan_pengirim` varchar(100) DEFAULT NULL,
  `alamat_pengirim` text DEFAULT NULL,
  `hp_pengirim` varchar(20) DEFAULT NULL,
  `bank_pengirim` varchar(25) DEFAULT NULL,
  `no_rekening` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pengirim`
--

INSERT INTO `tbl_pengirim` (`id_pengirim`, `nama_pengirim`, `kabupaten_pengirim`, `kecamatan_pengirim`, `alamat_pengirim`, `hp_pengirim`, `bank_pengirim`, `no_rekening`) VALUES
(1, 'Ali', 'Jakarta', 'Cengkareng', 'Jl. Raya No. 1, Cengkareng', '08123456789', 'BCA', '1234567890'),
(2, 'Budi', 'Bandung', 'Sumur Bandung', 'Jl. Merdeka No. 10, Bandung', '08987654321', 'Mandiri', '9876543210'),
(3, 'Charlie', 'Surabaya', 'Sukomanunggal', 'Jl. Sukomanunggal No. 5, Surabaya', '08765432109', 'BNI', '1122334455'),
(4, 'Dian', 'Medan', 'Marelan', 'Jl. Medan No. 20, Medan', '08122334455', 'BCA', '2233445566'),
(5, 'Eka', 'Yogyakarta', 'Umbulharjo', 'Jl. Kaliurang No. 25, Yogyakarta', '08512367890', 'BRI', '3344556677'),
(11, 'dian', '1', '13', 'kepo', '91283939', 'NTB', '918319327'),
(12, 'alma olshop', '3', '18', 'bebas', '92083910839', 'NTB', '9182391803');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengiriman`
--

CREATE TABLE `tbl_pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `id_pengirim` int(11) DEFAULT NULL,
  `id_penerima` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `kurir_jemput` varchar(100) DEFAULT NULL,
  `kurir_antar` varchar(100) DEFAULT NULL,
  `resi` varchar(100) DEFAULT NULL,
  `tarif_ongkir` varchar(25) DEFAULT NULL,
  `status_order` varchar(100) DEFAULT NULL,
  `bukti_transfer_admin` varchar(255) DEFAULT NULL,
  `waktu_konfirmasi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pengiriman`
--

INSERT INTO `tbl_pengiriman` (`id_pengiriman`, `id_pengirim`, `id_penerima`, `id_barang`, `kurir_jemput`, `kurir_antar`, `resi`, `tarif_ongkir`, `status_order`, `bukti_transfer_admin`, `waktu_konfirmasi`) VALUES
(1, 1, 1, 1, 'JNE', 'Tiki', 'RESI123', '15000', 'Dikirim', NULL, NULL),
(2, 2, 2, 2, 'POS', 'J&T', 'RESI124', '20000', 'Dikirim', NULL, NULL),
(3, 3, 3, 3, 'SICEPAT', 'Anteraja', 'RESI125', '18000', 'Dikirim', NULL, NULL),
(4, 4, 4, 4, 'Gojek', 'Lalamove', 'RESI126', '12000', 'Dikirim', NULL, NULL),
(5, 5, 5, 5, 'Grab', 'Ninja Xpress', 'RESI127', '25000', 'Dikirim', NULL, NULL),
(6, 11, 11, 11, 'Andi ', 'Jaka ', 'RESI684821F729418', '30000', 'terkonfirmasi', 'img/bukti_tf_admin/1749560431_Maps.png', '2025-06-10 14:26:17'),
(7, 12, 12, 12, '', '', 'RESI684822AB3E23D', '0', 'Menunggu Konfirmasi', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status_order`
--

CREATE TABLE `tbl_status_order` (
  `id_status` int(11) NOT NULL,
  `nama_status` varchar(50) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `warna_badge` varchar(20) DEFAULT 'secondary'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_status_order`
--

INSERT INTO `tbl_status_order` (`id_status`, `nama_status`, `keterangan`, `warna_badge`) VALUES
(1, 'menunggu', 'Order belum dikonfirmasi admin', 'warning'),
(2, 'terkonfirmasi', 'Order sudah dikonfirmasi', 'success'),
(3, 'dijemput', 'Kurir dalam perjalanan menjemput barang', 'info'),
(4, 'diproses', 'Barang sedang diproses di gudang', 'primary'),
(5, 'dikirim', 'Barang sedang dikirim ke penerima', 'dark'),
(6, 'selesai', 'Barang telah diterima oleh penerima', 'success'),
(7, 'dibatalkan', 'Order dibatalkan oleh pengirim/admin', 'danger');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tarif_ongkir`
--

CREATE TABLE `tbl_tarif_ongkir` (
  `id_tarif` int(11) NOT NULL,
  `id_kabupaten_asal` int(11) NOT NULL,
  `id_kabupaten_tujuan` int(11) NOT NULL,
  `tarif` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_tarif_ongkir`
--

INSERT INTO `tbl_tarif_ongkir` (`id_tarif`, `id_kabupaten_asal`, `id_kabupaten_tujuan`, `tarif`) VALUES
(1, 1, 2, 15000.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id_user`, `username`, `password`, `role`, `nama_lengkap`, `no_hp`) VALUES
(1, 'Dianpertiwi', '0192023a7bbd73250516f069df18b500', 'admin', 'Dian Pertiwi', '081937500766');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_data_kurir`
--
ALTER TABLE `tbl_data_kurir`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indexes for table `tbl_kabupaten`
--
ALTER TABLE `tbl_kabupaten`
  ADD PRIMARY KEY (`id_kabupaten`);

--
-- Indexes for table `tbl_kecamatan`
--
ALTER TABLE `tbl_kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`),
  ADD KEY `id_kabupaten` (`id_kabupaten`);

--
-- Indexes for table `tbl_penerima`
--
ALTER TABLE `tbl_penerima`
  ADD PRIMARY KEY (`id_penerima`);

--
-- Indexes for table `tbl_pengirim`
--
ALTER TABLE `tbl_pengirim`
  ADD PRIMARY KEY (`id_pengirim`);

--
-- Indexes for table `tbl_pengiriman`
--
ALTER TABLE `tbl_pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD KEY `id_pengirim` (`id_pengirim`),
  ADD KEY `id_penerima` (`id_penerima`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `tbl_status_order`
--
ALTER TABLE `tbl_status_order`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tbl_tarif_ongkir`
--
ALTER TABLE `tbl_tarif_ongkir`
  ADD PRIMARY KEY (`id_tarif`),
  ADD KEY `id_kabupaten_asal` (`id_kabupaten_asal`),
  ADD KEY `id_kabupaten_tujuan` (`id_kabupaten_tujuan`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_data_kurir`
--
ALTER TABLE `tbl_data_kurir`
  MODIFY `id_kurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_kabupaten`
--
ALTER TABLE `tbl_kabupaten`
  MODIFY `id_kabupaten` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_kecamatan`
--
ALTER TABLE `tbl_kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_penerima`
--
ALTER TABLE `tbl_penerima`
  MODIFY `id_penerima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_pengirim`
--
ALTER TABLE `tbl_pengirim`
  MODIFY `id_pengirim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_pengiriman`
--
ALTER TABLE `tbl_pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_status_order`
--
ALTER TABLE `tbl_status_order`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_tarif_ongkir`
--
ALTER TABLE `tbl_tarif_ongkir`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_kecamatan`
--
ALTER TABLE `tbl_kecamatan`
  ADD CONSTRAINT `tbl_kecamatan_ibfk_1` FOREIGN KEY (`id_kabupaten`) REFERENCES `tbl_kabupaten` (`id_kabupaten`);

--
-- Constraints for table `tbl_pengiriman`
--
ALTER TABLE `tbl_pengiriman`
  ADD CONSTRAINT `tbl_pengiriman_ibfk_1` FOREIGN KEY (`id_pengirim`) REFERENCES `tbl_pengirim` (`id_pengirim`),
  ADD CONSTRAINT `tbl_pengiriman_ibfk_2` FOREIGN KEY (`id_penerima`) REFERENCES `tbl_penerima` (`id_penerima`),
  ADD CONSTRAINT `tbl_pengiriman_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `tbl_barang` (`id_barang`);

--
-- Constraints for table `tbl_tarif_ongkir`
--
ALTER TABLE `tbl_tarif_ongkir`
  ADD CONSTRAINT `tbl_tarif_ongkir_ibfk_1` FOREIGN KEY (`id_kabupaten_asal`) REFERENCES `tbl_kabupaten` (`id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_tarif_ongkir_ibfk_2` FOREIGN KEY (`id_kabupaten_tujuan`) REFERENCES `tbl_kabupaten` (`id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
