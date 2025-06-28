-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 27 Jun 2025 pada 19.57
-- Versi server: 8.0.40
-- Versi PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_becat_kurir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `id_bank` int NOT NULL,
  `nama_bank` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_bank`
--

INSERT INTO `tbl_bank` (`id_bank`, `nama_bank`) VALUES
(1, 'BRI'),
(2, 'BNI'),
(3, 'Mandiri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_data_kurir`
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
-- Dumping data untuk tabel `tbl_data_kurir`
--

INSERT INTO `tbl_data_kurir` (`id_kurir`, `id_user`, `nama_kurir`, `no_hp`, `alamat_kurir`, `status`) VALUES
(2, NULL, 'dayat', '087715882995', 'ddddd', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenis_paket`
--

CREATE TABLE `tbl_jenis_paket` (
  `id_jenis_paket` int NOT NULL,
  `nama_jenis_paket` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_jenis_paket`
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
-- Struktur dari tabel `tbl_kabupaten`
--

CREATE TABLE `tbl_kabupaten` (
  `id_kab` int NOT NULL,
  `nama_kabupaten` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_kabupaten`
--

INSERT INTO `tbl_kabupaten` (`id_kab`, `nama_kabupaten`) VALUES
(5201, 'Lombok Barat'),
(5202, 'Lombok Tengah'),
(5203, 'Lombok Timur'),
(5271, 'Kota Mataram');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_log_aktivitas`
--

CREATE TABLE `tbl_log_aktivitas` (
  `id_log` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `aktivitas` text,
  `waktu` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_log_aktivitas`
--

INSERT INTO `tbl_log_aktivitas` (`id_log`, `id_user`, `aktivitas`, `waktu`) VALUES
(1, 1, 'Login ke sistem', '2025-06-28 02:27:48'),
(2, 1, 'Mengubah pengaturan akun', '2025-06-28 02:32:44'),
(3, 1, 'Login ke sistem', '2025-06-28 02:32:56'),
(4, 1, 'Login ke sistem', '2025-06-28 02:33:38'),
(5, 1, 'Login uji coba', '2025-06-28 02:38:26'),
(6, 1, 'Login ke sistem', '2025-06-28 02:39:10'),
(7, 1, 'Login ke sistem', '2025-06-28 02:55:53'),
(8, 1, 'Login ke sistem', '2025-06-28 02:55:57'),
(9, 1, 'Login ke sistem', '2025-06-28 02:56:44'),
(10, 1, 'Login ke sistem', '2025-06-28 02:56:50'),
(11, 1, 'Login ke sistem', '2025-06-28 02:58:31'),
(12, 1, 'Login ke sistem', '2025-06-28 02:59:23'),
(13, 1, 'Login ke sistem', '2025-06-28 03:00:25'),
(14, 1, 'Login ke sistem', '2025-06-28 03:09:13'),
(15, 1, 'Login ke sistem', '2025-06-28 03:14:37'),
(16, 1, 'Login ke sistem', '2025-06-28 03:16:38'),
(17, 1, 'Login ke sistem', '2025-06-28 03:19:00'),
(18, 5, 'Login ke sistem', '2025-06-28 03:21:34'),
(19, 1, 'Login ke sistem', '2025-06-28 03:23:57'),
(20, 1, 'Mengubah pengaturan akun', '2025-06-28 03:24:07'),
(21, 1, 'Login ke sistem', '2025-06-28 03:24:55'),
(22, 2, 'Login ke sistem', '2025-06-28 03:26:29'),
(23, 6, 'Login ke sistem', '2025-06-28 03:28:28'),
(24, 6, 'Login ke sistem', '2025-06-28 03:28:44'),
(25, 6, 'Login ke sistem', '2025-06-28 03:29:53'),
(26, 6, 'Login ke sistem', '2025-06-28 03:31:58'),
(27, 6, 'Login ke sistem', '2025-06-28 03:32:03'),
(28, 6, 'Login ke sistem', '2025-06-28 03:56:04'),
(29, 6, 'Login ke sistem', '2025-06-28 03:56:11'),
(30, 6, 'Login ke sistem', '2025-06-28 03:56:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penerima`
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
-- Dumping data untuk tabel `tbl_penerima`
--

INSERT INTO `tbl_penerima` (`id_penerima`, `id_kab_tujuan`, `nama_penerima`, `kec_pengirim`, `alamat_penerima`, `hp_penerima`, `link_maps`) VALUES
(1, 5201, 'Budi', 'Kediri', 'Jl. Gunung Sari No.2', '081234111111', 'https://maps.app/go1'),
(2, 5203, 'Tini', 'Masbagik', 'Jl. Raya Masbagik', '081234222222', 'https://maps.app/go2'),
(3, 5271, 'Joko', 'Cakranegara', 'Jl. Selaparang No.3', '081234333333', 'https://maps.app/go3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengirim`
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
-- Dumping data untuk tabel `tbl_pengirim`
--

INSERT INTO `tbl_pengirim` (`id_pengirim`, `id_kab_asal`, `id_bank`, `id_user`, `nama_pengirim`, `kec_pengirim`, `alamat_pengirim`, `hp_pengirim`, `no_rekening`) VALUES
(1, 5271, 1, 2, 'Dian Pertiwi', 'Ampenan', 'Jl. Udayana No.10', '081234567890', '1234567890'),
(2, 5201, 2, 2, 'Rina Ayu', 'Gerung', 'Jl. Majapahit No.7', '081223344556', '2233445566'),
(3, 5203, 3, 2, 'Eka Putri', 'Selong', 'Jl. Sultan Agung No.5', '082233445566', '3344556677');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengiriman_paket`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_status_order`
--

CREATE TABLE `tbl_status_order` (
  `id_status` int NOT NULL,
  `nama_status` varchar(100) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_status_order`
--

INSERT INTO `tbl_status_order` (`id_status`, `nama_status`, `keterangan`) VALUES
(1, 'Menunggu Pembayaran', 'Order telah dibuat dan menunggu pembayaran dari pengirim'),
(2, 'Menunggu Konfirmasi Admin', 'Pembayaran telah dilakukan dan menunggu validasi admin'),
(3, 'Diproses Kurir', 'Paket sedang diproses dan dijemput oleh kurir'),
(4, 'Dalam Pengiriman', 'Paket sedang dalam perjalanan ke alamat penerima'),
(5, 'Selesai', 'Paket telah diterima oleh penerima dan pengiriman selesai'),
(6, 'Gagal Dikirim', 'Pengiriman gagal karena alamat tidak ditemukan atau penerima tidak ada'),
(7, 'Retur', 'Paket dikembalikan ke pengirim setelah gagal dikirim');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tarif`
--

CREATE TABLE `tbl_tarif` (
  `id_tarif` int NOT NULL,
  `id_kab_asal` int DEFAULT NULL,
  `id_kab_tujuan` int DEFAULT NULL,
  `tarif` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_tarif`
--

INSERT INTO `tbl_tarif` (`id_tarif`, `id_kab_asal`, `id_kab_tujuan`, `tarif`) VALUES
(1, 5271, 5201, 15000.00),
(2, 5271, 5203, 20000.00),
(3, 5201, 5203, 25000.00),
(4, 5271, 5201, 30000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role` enum('user','admin','kurir') DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `role`, `nama`) VALUES
(1, 'admin01', '326ee55478c4a6c92cdb6d2a255a2e74', 'admin', 'Admin Dayat'),
(2, 'Dianpertiwi@123', '2d26b61eafa05991ceb1a8975604354a', 'user', 'Dian Pertiwi'),
(3, 'kurir01', '1c51520de052c7f69ab4ce0ec9aabba6', 'kurir', 'Kurir Agus'),
(4, 'kurirdedi', '711ccac10b1be72d703acdb209b1d892', 'kurir', 'Kurir Dedi'),
(5, 'kurireko', '8e1a070e9b0340da2b0ea4f193c172f0', 'kurir', 'Kurir Eko'),
(6, 'sibudi', '9c5fa085ce256c7c598f6710584ab25d', 'admin', 'budi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indeks untuk tabel `tbl_data_kurir`
--
ALTER TABLE `tbl_data_kurir`
  ADD PRIMARY KEY (`id_kurir`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tbl_jenis_paket`
--
ALTER TABLE `tbl_jenis_paket`
  ADD PRIMARY KEY (`id_jenis_paket`);

--
-- Indeks untuk tabel `tbl_kabupaten`
--
ALTER TABLE `tbl_kabupaten`
  ADD PRIMARY KEY (`id_kab`);

--
-- Indeks untuk tabel `tbl_log_aktivitas`
--
ALTER TABLE `tbl_log_aktivitas`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tbl_penerima`
--
ALTER TABLE `tbl_penerima`
  ADD PRIMARY KEY (`id_penerima`),
  ADD KEY `id_kab_tujuan` (`id_kab_tujuan`);

--
-- Indeks untuk tabel `tbl_pengirim`
--
ALTER TABLE `tbl_pengirim`
  ADD PRIMARY KEY (`id_pengirim`),
  ADD KEY `id_kab_asal` (`id_kab_asal`),
  ADD KEY `id_bank` (`id_bank`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tbl_pengiriman_paket`
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
-- Indeks untuk tabel `tbl_status_order`
--
ALTER TABLE `tbl_status_order`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `tbl_tarif`
--
ALTER TABLE `tbl_tarif`
  ADD PRIMARY KEY (`id_tarif`),
  ADD KEY `id_kab_asal` (`id_kab_asal`),
  ADD KEY `id_kab_tujuan` (`id_kab_tujuan`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `id_bank` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_data_kurir`
--
ALTER TABLE `tbl_data_kurir`
  MODIFY `id_kurir` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_jenis_paket`
--
ALTER TABLE `tbl_jenis_paket`
  MODIFY `id_jenis_paket` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_kabupaten`
--
ALTER TABLE `tbl_kabupaten`
  MODIFY `id_kab` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5272;

--
-- AUTO_INCREMENT untuk tabel `tbl_log_aktivitas`
--
ALTER TABLE `tbl_log_aktivitas`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tbl_penerima`
--
ALTER TABLE `tbl_penerima`
  MODIFY `id_penerima` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengirim`
--
ALTER TABLE `tbl_pengirim`
  MODIFY `id_pengirim` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengiriman_paket`
--
ALTER TABLE `tbl_pengiriman_paket`
  MODIFY `id_pengiriman` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_status_order`
--
ALTER TABLE `tbl_status_order`
  MODIFY `id_status` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_tarif`
--
ALTER TABLE `tbl_tarif`
  MODIFY `id_tarif` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_data_kurir`
--
ALTER TABLE `tbl_data_kurir`
  ADD CONSTRAINT `tbl_data_kurir_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tbl_log_aktivitas`
--
ALTER TABLE `tbl_log_aktivitas`
  ADD CONSTRAINT `tbl_log_aktivitas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tbl_penerima`
--
ALTER TABLE `tbl_penerima`
  ADD CONSTRAINT `tbl_penerima_ibfk_1` FOREIGN KEY (`id_kab_tujuan`) REFERENCES `tbl_kabupaten` (`id_kab`);

--
-- Ketidakleluasaan untuk tabel `tbl_pengirim`
--
ALTER TABLE `tbl_pengirim`
  ADD CONSTRAINT `tbl_pengirim_ibfk_1` FOREIGN KEY (`id_kab_asal`) REFERENCES `tbl_kabupaten` (`id_kab`),
  ADD CONSTRAINT `tbl_pengirim_ibfk_2` FOREIGN KEY (`id_bank`) REFERENCES `tbl_bank` (`id_bank`),
  ADD CONSTRAINT `tbl_pengirim_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tbl_pengiriman_paket`
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
-- Ketidakleluasaan untuk tabel `tbl_tarif`
--
ALTER TABLE `tbl_tarif`
  ADD CONSTRAINT `tbl_tarif_ibfk_1` FOREIGN KEY (`id_kab_asal`) REFERENCES `tbl_kabupaten` (`id_kab`),
  ADD CONSTRAINT `tbl_tarif_ibfk_2` FOREIGN KEY (`id_kab_tujuan`) REFERENCES `tbl_kabupaten` (`id_kab`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
