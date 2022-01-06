-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2022 at 05:34 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_stikom_keuangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(51, '2021-12-17-075700', 'App\\Database\\Migrations\\CreateUserTable', 'default', 'App', 1639892814, 1),
(52, '2021-12-17-075720', 'App\\Database\\Migrations\\CreateJurusanTable', 'default', 'App', 1639892815, 1),
(53, '2021-12-17-075746', 'App\\Database\\Migrations\\CreateAngkatanTable', 'default', 'App', 1639892815, 1),
(54, '2021-12-17-075800', 'App\\Database\\Migrations\\CreateSemesterTable', 'default', 'App', 1639892815, 1),
(55, '2021-12-17-075822', 'App\\Database\\Migrations\\CreateJalurTable', 'default', 'App', 1639892815, 1),
(56, '2021-12-17-075839', 'App\\Database\\Migrations\\CreateSesiKuliahTable', 'default', 'App', 1639892815, 1),
(57, '2021-12-17-075840', 'App\\Database\\Migrations\\CreateMetodePembayaranTable', 'default', 'App', 1639892815, 1),
(58, '2021-12-17-075858', 'App\\Database\\Migrations\\CreatePaketTable', 'default', 'App', 1639892815, 1),
(59, '2021-12-17-075917', 'App\\Database\\Migrations\\CreateItemPaketTable', 'default', 'App', 1639892815, 1),
(60, '2021-12-17-080112', 'App\\Database\\Migrations\\CreateTransaksiTable', 'default', 'App', 1639892815, 1),
(61, '2021-12-17-085159', 'App\\Database\\Migrations\\CreateMahasiswaTable', 'default', 'App', 1639892815, 1),
(62, '2021-12-19-130707', 'App\\Database\\Migrations\\CreateAkunPemasukanTable', 'default', 'App', 1639920329, 2),
(63, '2021-12-19-130722', 'App\\Database\\Migrations\\CreateAkunPengeluaranTable', 'default', 'App', 1639920363, 3),
(64, '2021-12-20-051822', 'App\\Database\\Migrations\\CreateBiayaSKSTable', 'default', 'App', 1639978768, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akun_pemasukan`
--

CREATE TABLE `tbl_akun_pemasukan` (
  `id_akun` int(10) UNSIGNED NOT NULL,
  `kode_akun` varchar(50) NOT NULL,
  `nama_akun` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_akun_pemasukan`
--

INSERT INTO `tbl_akun_pemasukan` (`id_akun`, `kode_akun`, `nama_akun`, `created_at`, `updated_at`) VALUES
(1, '4100-1000', 'Dana Tarikan dari Rek BNI', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(2, '4100-1100', 'Dana Pengembalian dari Kegiatan', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(3, '4100-2100', 'Pembayaran Mhs Lama', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(4, '4100-3000', 'Beasiswa', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(5, '4200-0001', 'Praktikum SMP PGRI', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(6, '4200-0002', 'Diklat & Kegiatan2 non Rutin', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(7, '4200-0009', 'Pendaftaran Maba 2009', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(8, '4200-2001', 'Pemby UTS susulan', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(9, '4200-2002', 'Pemby UAS Susulan', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(10, '4200-2003', 'Pemby Pratikum', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(11, '4200-2017', 'Pemby Pratikum 2007 Ti', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(12, '4200-2018', 'Pemby Pratikum 2008 TI', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(13, '4200-2019', 'Pemby Pratikum 2009 TI', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(14, '4200-2020', 'Pemby Praktikum 2010 TI', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(15, '4200-2037', 'Pemby Pratikum 2007 MI', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(16, '4200-2038', 'Pemby Pratikum 2008 MI', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(17, '4200-2039', 'Pemby Pratikum 2009 MI', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(21, '4200-2040', 'Pemby Praktikum 2010 MI', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(18, '4300-0001', 'Penjualan Komputer Lama', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(19, '4300-0002', 'Penjualan Peralatan Lama', '2021-12-19 13:30:31', '2021-12-19 13:30:31'),
(20, '4400-1000', 'Pemasukan Lain-lain', '2021-12-19 13:30:31', '2021-12-19 13:30:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akun_pengeluaran`
--

CREATE TABLE `tbl_akun_pengeluaran` (
  `id_akun` int(10) UNSIGNED NOT NULL,
  `kode_akun` varchar(50) NOT NULL,
  `nama_akun` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_akun_pengeluaran`
--

INSERT INTO `tbl_akun_pengeluaran` (`id_akun`, `kode_akun`, `nama_akun`, `created_at`, `updated_at`) VALUES
(58, '2-0-110', 'Akreditasi', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(59, '2-0-130', 'Hutang & Iuran PPLP', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(60, '2-0-184', 'Insentif Rapat Pagi & Rapim', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(61, '2-0-187', 'Hutang Karyawan/Hutang Kegiatan Peneliti', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(62, '2-0-188', 'PBB', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(63, '2-0-189', 'Reuni', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(64, '2-0-191', 'VCD & Rekaman', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(65, '2-0-192', 'Insentif DPA', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(66, '2-0-193', 'Sarasehan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(67, '2-0-195', 'Kelas Khusus', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(68, '2-0-196', 'Kuliah Umum', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(69, '2-0-197', 'Ijazah & Prosesi', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(70, '2-0-198', 'Biaya Workshop & Penelitian', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(71, '2-0-199', 'Diskon Maba', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(72, '2-0-200', 'Peningkatan SDM (Pelatihan Pekerti & AA)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(73, '2-0-201', 'Peningkatan SDM (Program Layanan Prima)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(85, '2-0-2013', 'Pembangunan Gedung Baru', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(74, '2-0-202', 'Benchmarking (ketua, puket, kabag)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(75, '2-0-204', 'Renovasi Pagar Belakang', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(77, '2-0-205', 'Renovasi Kantin, Gudang', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(78, '2-0-206', 'Renovasi Ruang Santai & UKM', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(79, '2-0-207', 'Pengadaan Buku Perpustakaan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(80, '2-0-208', 'Renovasi Lab (Penggantian Monitor Lab)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(81, '2-0-209', 'Renovasi Lantai 1 (granit)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(82, '2-0-210', 'Renovasi AC aula', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(83, '2-0-211', 'Sound Sistem + Arisan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(84, '2-0-212', 'Pembelian Kendaraan Kampus', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(86, '2-0-214', 'Prediksi Piutang Mahasiswa', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(87, '2-0-215', 'Pembelihan Hewan Qurban', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(88, '2-0-216', 'Pembelian Lahan untuk Pengembangan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(135, '2-0-217', 'Renovasi Ruang Ketua', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(138, '2-0-321', 'Kantin (Subsidi Kantin)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(136, '2-0-403', 'Peningkatan Kinerja Pimpinan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(139, '2-0000', 'Saving Dana (Non Pengembangan)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(140, '2-0001', 'Perjalanan Dinas', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(141, '2-0002', 'Akreditasi & Visitasi Institusi', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(142, '2-0003', 'Akreditasi & Borang Ti', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(143, '2-0005', 'Hibah (Proposal)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(144, '2-0006', 'Proposal (Dana Pendamping)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(145, '2-0007', 'Hutang Bank', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(146, '2-0008', 'Iuran PPLP-PT PGRI Banyuwangi', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(147, '2-0009', 'Iuran PGRI PUSAT', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(148, '2-0011', 'UPT Promosi (Kalender)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(149, '2-0012', 'UPT Promosi (Brosur)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(150, '2-0013', 'UPT Promosi (Spanduk)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(151, '2-0014', 'UPT Promosi (Radio)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(152, '2-0016', 'Presentasi (Kab.BWI)-Survey/Sosialisasi', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(153, '2-0017', 'Presentasi (Kab.BWI)-Penitipan Brosur', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(154, '2-0018', 'Presentasi (Kab.BWI)-Fee Sekolah (sosial', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(155, '2-0019', 'Presentasi (Kab.BWI)-Insentif Dosen', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(156, '2-0020', 'Presentasi (Kab.BWI)-Insentif Mahasiswa/', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(157, '2-0021', 'Presentasi (Kab.BWI)-Konsumsi', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(158, '2-0022', 'Presentasi (Kab.BWI)-Transport', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(159, '2-0024', 'Presentasi (Bali)-Survey/Sosialisasi', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(160, '2-0025', 'Presentasi (Bali)-Penitipan Brosur', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(161, '2-0026', 'Presentasi (Bali)-Fee Sekolah (sosialisa', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(162, '2-0027', 'Presentasi (Bali)-Insentif Dosen', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(163, '2-0028', 'Presentasi (Bali)-Instf. Mahasiswa/Petug', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(164, '2-0029', 'Presentasi (Bali)-Konsumsi', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(165, '2-0030', 'Presentasi (Bali)-Transport', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(166, '2-0032', 'Promosi Melalui Masjid', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(167, '2-0033', 'Pameran', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(168, '2-0034', 'Multimedia', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(169, '2-0035', 'Lomba/Pelatihan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(170, '2-0036', 'Pemberian Komisi Sponsor MABA', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(171, '2-0037', 'Pemberian Komisi ke sekolah', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(172, '2-0039', 'Sarana Promosi (LCD Proyektor)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(173, '2-0040', 'UPT STIKOM Development Center (SDC)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(174, '2-0041', 'Kantin (Subsidi Gaji Karyawan)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(175, '2-0042', 'Pengembangan Institusi', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(176, '2-0044', 'Besiswa STIKOM Berbagi (S1)-2012', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(177, '2-0045', 'Besiswa STIKOM Berbagi (S1)-2013', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(178, '2-0046', 'Besiswa STIKOM Berbagi (S1)-2014', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(179, '2-0047', 'Besiswa STIKOM Berbagi (S1)-2015', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(180, '2-0049', 'Besiswa STIKOM Berbagi (D3)-2013', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(181, '2-0050', 'Besiswa STIKOM Berbagi (D3)-2014', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(182, '2-0051', 'Besiswa STIKOM Berbagi (D3)-2015', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(183, '2-0053', 'Diskon Karyawan & Anggota PGRI', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(184, '2-0056', 'Pengadaan Komputer Lab', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(185, '2-0057', 'Pengadaan Komputer (Lab.Multimedia)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(186, '2-0058', 'Renovasi Komputer Lab & Server', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(187, '2-0059', 'Renovasi R.Rapat,Lab,R.Kuliah,Teras dll', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(188, '2-0060', 'Kursi', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(189, '2-0061', 'Sound Systim', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(190, '2-0062', 'Meja', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(191, '2-0063', 'Dispencer', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(192, '2-0064', 'Lemari Es (Ketua)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(193, '2-0065', 'Renovasi Ruang Ketua', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(194, '2-0066', 'Renovasi Bangunan R.Santai & Mushola', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(195, '2-0067', 'Renovasi Ruang Ketua Lab.', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(196, '2-0068', 'Renovasi Ruang Perpustakaan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(197, '2-0069', 'Renovasi Ruang LPPM', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(198, '2-0073', 'Peningkatan SDM (Pelatihan Pekerti & AA)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(199, '2-0074', 'Peningkatan SDM (Sertifikasi Profesi)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(200, '2-0075', 'Peningkatan SDM (Upgrade Dosen)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(201, '2-0076', 'Peningkatan SDM (Program Layanan Prima)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(202, '2-0077', 'Peningkatan Kinerja Pimpinan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(203, '2-0078', 'Benchmarking', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(204, '2-0079', 'Peningkatan SDM (studi lanjut & kepangka', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(205, '2-0082', 'Prediksi Piutang Mahasiswa', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(206, '2-0083', 'Penyembelihan Qurban', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(207, '2-0084', 'Rapim', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(279, '2-0085', 'Arisan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(280, '2-0086', 'Lain-lain', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(281, '2-0087', 'Honor/Tunjangan non Rutin/Gaji 13/THR', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(282, '2-0088', 'insentif lembur & Konusmi Lembur', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(283, '2-0089', 'Buka Bersama & Halal Bihalal', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(284, '2-0090', 'Pajak Bumi Bangunan & Pajak Mobil', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(285, '2-0091', 'Pinjaman Koperasi', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(76, '2-02-205', 'Renovasi Pos Satpam', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(89, '2-1-100', 'Rapat Kerja Bidang 1', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(90, '2-1-110', 'Sosialisasi Kegiatan Akademik', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(91, '2-1-120', 'Pembuatan Buku Ajar (5 mata kuliah)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(92, '2-1-130', 'Pembuatan Modul Praktikum/B.Praktikum&in', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(93, '2-1-131', 'Skripsi/TA', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(94, '2-1-132', 'Tugas Proyek', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(95, '2-1-133', 'PKL/KKN', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(96, '2-1-134', 'Ujian Susulan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(97, '2-1-135', 'Biaya Konversi', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(98, '2-1-140', 'biaya Dosen Pengajar (6 mata kuliah)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(99, '2-1-141', 'Biaya konsumsi (18 dosen)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(100, '2-1-142', 'Biaya Transport (18 dosen)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(101, '2-1-143', 'Biaya Penginapan (18 dosen)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(102, '2-1-144', 'Upgrade Internal Dosen', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(103, '2-1-150', 'UTS semester ganjil', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(104, '2-1-151', 'UAS Semester Ganjil', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(105, '2-1-152', 'UTS Semester Genap', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(106, '2-1-153', 'UAS Semester Genap', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(208, '2-1000', 'Rapat Kerja Bidang I', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(209, '2-1001', 'Sosialisasi Kegiatan Akademik(Buku Pandu', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(210, '2-1002', 'Pembuatan Buku Ajar (10MK)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(211, '2-1003', 'Pembuatan Modul Praktikum &B.Praktikum', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(212, '2-1004', 'Peninjauan Kurikulum', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(213, '2-1005', 'Seminar Ilmiah Mahasiswa', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(214, '2-1006', 'Upgrade Internal Dosen', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(215, '2-1007', 'Biaya UTS/UAS', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(216, '2-1008', 'Kepanitiaan Skripsi/TA/Tugas Proyek', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(217, '2-1009', 'Kepanitiaan KKN/PKL', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(218, '2-1010', 'Pendalaman Bahasa Inggris', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(219, '2-1011', 'Maintenance Mahasiswa', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(220, '2-1013', 'Sarana Perkuliahan (LCD Proyektor)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(221, '2-1014', 'Sarana Perkuliahan (Lumen 2800)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(222, '2-1015', 'Sarana Perkuliahan (Lumen 300)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(223, '2-1016', 'Sarana Perkuliahan (spidol/whiteboard/pe', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(224, '2-1017', 'Sound system kelas & Lab dan Aula', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(225, '2-1018', 'Biaya Pemeliharaan Lab.Komputer', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(226, '2-1019', 'Pengadaan Buku Perpustakaan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(227, '2-1020', 'Microsoft Campus Agreement', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(228, '2-1021', 'Pembinaan Prakerin', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(229, '2-1022', 'Uang Saku Prakerin', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(286, '2-1023', 'Konversi Maba Transfer', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(107, '2-2-100', 'Biaya Gaji Pejabat & Karyawan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(108, '2-2-110', 'Honor Dosen Tidak Tetap', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(109, '2-2-120', 'Rapat Kerja Bidang II', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(110, '2-2-130', 'Kepanitian Registrasi semester Ganjil', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(111, '2-2-131', 'Kepanitian Registrasi semester Genap', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(112, '2-2-132', 'Kepanitian Program Hibah Dikti', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(113, '2-2-133', 'Kepanitian Pengadaan&Renov. smstr Genap', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(114, '2-2-134', 'Kepanitian Pengadaan&Renov smstr ganjil', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(115, '2-2-140', 'Tunjangan Sosial', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(116, '2-2-150', 'Pengembangan SDM', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(230, '2-2000', 'B.Gaji Pejabat&Karyawan(Dosen tetap)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(231, '2-2001', 'B.Gaji Pejabat&Karyawan(Karyawan tetap)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(232, '2-2002', 'B.Gaji Pejabat&Karyawan(HR Mengajar Dose', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(233, '2-2003', 'B.Gaji Pejabat&Karyawan(Asisten Dosen te', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(234, '2-2004', 'B.Gaji Pejabat&Karyawan(Asisten Lab)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(235, '2-2005', 'Rapat Kerja Bidang II', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(236, '2-2006', 'Listrik & Telfon', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(237, '2-2007', 'Pengadaan ATK', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(238, '2-2008', 'Keperluan Rumah Tangga', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(239, '2-2009', 'Biaya Pemeliharaan Sarpras,R.Kuliah,R.La', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(240, '2-2010', 'Pengadaan Inventaris Kantor', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(241, '2-2011', 'Pengadaan Seragam', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(242, '2-2013', 'Kepanitian (Registrasi Semester Ganjil)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(243, '2-2014', 'Kepanitian (Registrasi Semester Genap)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(244, '2-2015', 'Kepanitian (Program Hibah Dikti)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(245, '2-2016', 'Kepanitian (Pengadaan&Renovasi Semester ', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(246, '2-2017', 'Kepanitiaan (Pengadaan&Renovasi semeter ', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(247, '2-2019', 'BPJS & Premi Asuransi (Dosen-Karyawan)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(248, '2-2020', 'Dosen Tetap', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(249, '2-2021', 'Karyawan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(250, '2-2022', 'Sumbangan Sosial(Pernikahan,Kelahiran,Ke', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(251, '2-2024', 'Bantuan Alat Komunikasi (Ketua)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(252, '2-2025', 'Bantuan Alat Komunikasi (Waket&Perintis)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(253, '2-2026', 'Bantuan Alat Komunikasi (Kabag)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(254, '2-2027', 'Bantuan Alat Komunikasi (Kabit)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(255, '2-2028', 'Pinjaman Karyawan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(117, '2-3-100', 'Rapat Kerja Bidang III', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(118, '2-3-120', 'Penerbitan Jurnal', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(119, '2-3-121', 'Penelitian', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(120, '2-3-122', 'Seminar Regional Penelitian', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(121, '2-3-123', 'Buku Panduan Akademik', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(122, '2-3-130', 'Kegiatan Pengabdian masyarakat', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(123, '2-3-140', 'Promosi /Stikom Berbagi', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(124, '2-3-150', 'Pengembangan minat Bakat Mahasiswa', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(125, '2-3-151', 'Pemberdayaan Alumni', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(126, '2-3-152', 'Bursa kerja', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(127, '2-3-153', 'Temu Alumni', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(128, '2-3-155', 'Program kreatifitas Mhs/Kegiatan Mhs', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(129, '2-3-160', 'Kewirausahaan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(130, '2-3-161', 'Asuransi Mahasiswa', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(131, '2-3-162', 'Komisi maba', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(132, '2-3-163', 'Penerimaan Maba', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(133, '2-3-164', 'PLK', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(134, '2-3-165', 'Yudisium & Wisuda', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(137, '2-3-166', 'Penerimaan STIKOM Peduli/Berbagi/Survey', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(256, '2-3000', 'Rapat Kerja Bidang III', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(257, '2-3002', 'Penelitian (Penerbitan Jurnal)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(258, '2-3003', 'Penelitian', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(259, '2-3004', 'Penelitian (Seminar Penelitian Nasional)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(260, '2-3006', 'Pengabdian Masyarakat(Biaya Pengabdian)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(261, '2-3008', 'Kerjasama Antar Lembaga(APTIKOM)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(262, '2-3009', 'Pemberdayaan Alumni', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(263, '2-3010', 'Bursa Kerja', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(264, '2-3011', 'Temu Almuni', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(265, '2-3012', 'Program Kreatifitas Mahasiswa', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(266, '2-3013', 'Penerimaan STIKOM Bebagi/Peduli', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(267, '2-3014', 'PLK', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(268, '2-3015', 'Kewirausahaan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(269, '2-3016', 'Asuransi Mahasiswa', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(270, '2-3017', 'UKM', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(271, '2-3019', 'Pengembangan Minat Bakat Mahasiswa', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(272, '2-3020', 'Keikutsertaan Dalam Kegiatan Pemda', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(273, '2-3021', 'Karnaval/Geral Jalan/Upacara', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(274, '2-3023', 'Kepanitiaan (Wisuda)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(275, '2-3024', 'Kepanitiaan (PLK)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(276, '2-3025', 'Kepanitiaan (PMB)', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(277, '2-3026', 'Kepanitiaan (Program Penelitian & Pengem', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(278, '2-3027', 'Kepanitiaan (Program Pengabdian Masyarak', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(1, '5000-1000', 'Biaya Administrasi dan Umum', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(2, '5000-1010', 'Gaji Dosen dan Karyawan Tetap', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(3, '5000-1011', 'Honor Karyawan Tidak Tetap', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(4, '5000-1012', 'Honorarium Dosen Tidak Tetap', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(5, '5000-1013', 'Honor/Tunjangan Non Rutin', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(6, '5000-1014', 'Insentif Rapat', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(7, '5000-1015', 'Insentif lembur', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(8, '5000-1016', 'Konsumsi rapat/lembur', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(9, '5000-1017', 'Biaya Perjalanan Dinas', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(10, '5000-1018', 'Biaya Kegiatan Praktikum', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(51, '5000-1019', 'Insentif Kepanitian', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(53, '5000-1020', 'Yudisium & Wisuda', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(54, '5000-1021', 'Proses Ijazah & Transkrip', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(57, '5000-1023', 'Pelatihan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(11, '5000-1030', 'Alat Tulis Kantor', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(12, '5000-1032', 'Administrasi Kantor & Fto copy', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(13, '5000-1033', 'Administrasi Bank', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(14, '5000-1034', 'Listrik/Air/Komunikasi', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(15, '5000-1035', 'Keperluan dapur/konsumsi rutin', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(16, '5000-1050', 'Angsuran Pinjaman k Pihak III', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(17, '5000-1080', 'Biaya Lain-lain', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(56, '5000-1082', 'Pot. Koperasi', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(18, '5000-1090', 'Perawatan Lab. Komputer', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(19, '5000-1092', 'Perawatan Gedung dan Sapras', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(20, '5000-2000', 'Biaya Ujian', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(21, '5000-2010', 'Biaya UTS', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(22, '5000-2020', 'Biaya UAS', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(23, '5000-2030', 'Biaya Ujian Susulan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(24, '5000-2040', 'Biaya & Insentif TA', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(25, '5000-2050', 'PA & Tugas Proyek', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(26, '5000-2060', 'Biaya/Insentif PKL & KKN', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(27, '5000-3000', 'Biaya Kegiatan Mahasiswa', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(28, '5000-3100', 'Biaya Kegiatan Penelitian', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(29, '5000-3200', 'Biaya Kegiatan DAT', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(48, '5000-3300', 'Kegiatan Pengabdian Masyarakat', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(50, '5000-3400', 'Kewirausahaan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(30, '5000-4000', 'Biaya Maba', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(31, '5000-4010', 'Biaya Promosi Maba', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(32, '5000-4020', 'Komisi Biaya Pendaftaran', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(33, '5000-4030', 'Biaya Penerimaan Maba', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(34, '5000-4040', 'Discount Maba', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(35, '5000-5000', 'Biaya Pengembangan Institusi', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(36, '5000-5010', 'Biaya lokakarya kurikulum ', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(52, '5000-5011', 'biaya lisensi software', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(37, '5000-5020', 'Bantuan Kuliah S2', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(55, '5000-5021', 'Bantuan dari lembaga', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(38, '5000-5030', 'Biaya Akreditasi S1', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(49, '5000-5040', 'PHP-PTS/HIBAH', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(39, '5000-5050', 'Biaya Promosi Stikom', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(40, '5000-5090', 'Pembelian komputer & sapras ', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(41, '5000-5100', 'Pembelian Peralatan Kantor', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(42, '5000-6000', 'Yayasan & Asuransi', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(43, '5000-6010', 'Asuransi Karyawan & Dosen', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(44, '5000-6020', 'Arisan Keluarga Yayasan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(45, '5000-6030', 'Setoran k Yayasan', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(46, '5000-6050', 'Setoran k BNI', '2021-12-19 13:30:37', '2021-12-19 13:30:37'),
(47, '7000-1001', 'Biaya Pembangunan Musholla', '2021-12-19 13:30:37', '2021-12-19 13:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_angkatan`
--

CREATE TABLE `tbl_angkatan` (
  `id_angkatan` varchar(10) NOT NULL,
  `tahun_angkatan` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_angkatan`
--

INSERT INTO `tbl_angkatan` (`id_angkatan`, `tahun_angkatan`, `created_at`, `updated_at`) VALUES
('THN2006', '2006', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('THN2007', '2007', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('THN2008', '2008', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('THN2009', '2009', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('THN2010', '2010', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('THN2011', '2011', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('THN2012', '2012', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('THN2013', '2013', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('THN2014', '2014', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('THN2015', '2015', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('THN2016', '2016', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('THN2017', '2017', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('THN2018', '2018', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('THN2019', '2019', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('THN2020', '2020', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('THN2021', '2021', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('THN2022', '2022', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('THN2023', '2023', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('THN2024', '2024', '2021-12-19 05:46:57', '2021-12-19 05:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_biaya_sks`
--

CREATE TABLE `tbl_biaya_sks` (
  `id_sks` varchar(10) NOT NULL,
  `angkatan_id` varchar(10) NOT NULL,
  `paket_id` varchar(10) NOT NULL,
  `biaya_sks` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_paket`
--

CREATE TABLE `tbl_item_paket` (
  `id_item` int(5) UNSIGNED NOT NULL,
  `kode_item` varchar(10) NOT NULL,
  `nama_item` varchar(100) NOT NULL,
  `nominal_item` int(11) NOT NULL,
  `keterangan_item` text DEFAULT NULL,
  `paket_id` varchar(10) DEFAULT NULL,
  `angkatan_id` varchar(10) DEFAULT NULL,
  `semester_id` varchar(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_item_paket`
--

INSERT INTO `tbl_item_paket` (`id_item`, `kode_item`, `nama_item`, `nominal_item`, `keterangan_item`, `paket_id`, `angkatan_id`, `semester_id`, `created_at`, `updated_at`) VALUES
(1, 'ITEM1', 'Pengembangan', 10000000, NULL, 'PKT01', 'THN2020', 'SMT01', '2021-12-21 11:56:19', '2021-12-26 02:10:35'),
(2, 'ITEM2', 'PLK', 300000, '-', 'PKT01', 'THN2020', 'SMT01', '2021-12-21 11:56:19', '2021-12-21 11:56:19'),
(3, 'ITEM3', 'Konversi', 0, '-', 'PKT01', 'THN2020', 'SMT01', '2021-12-21 11:56:19', '2021-12-21 11:56:19'),
(4, 'ITEM4', 'Jaket Almamater', 250000, '-', 'PKT01', 'THN2020', 'SMT01', '2021-12-21 11:56:19', '2021-12-21 11:56:19'),
(5, 'ITEM5', 'SWM', 3000000, NULL, 'PKT01', 'THN2020', 'SMT01', '2021-12-24 13:17:40', '2021-12-24 13:17:40'),
(6, 'ITEM6', 'UTS dan UAS', 300000, '-', 'PKT01', 'THN2020', 'SMT01', '2021-12-24 13:21:34', '2021-12-26 05:08:23'),
(11, 'ITEM7', 'Registrasi', 200000, '-', 'PKT01', 'THN2020', 'SMT01', '2021-12-24 13:43:16', '2021-12-26 05:08:57'),
(13, 'ITEM8', 'Registrasi', 200000, '-', 'PKT01', 'THN2020', 'SMT02', '2021-12-26 05:09:38', '2021-12-26 05:09:38'),
(14, 'ITEM9', 'SWM', 500000, '-', 'PKT01', 'THN2020', 'SMT02', '2021-12-26 05:11:07', '2021-12-26 05:11:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jalur`
--

CREATE TABLE `tbl_jalur` (
  `id_jalur` varchar(10) NOT NULL,
  `nama_jalur` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_jalur`
--

INSERT INTO `tbl_jalur` (`id_jalur`, `nama_jalur`, `created_at`, `updated_at`) VALUES
('01REG', 'reguler', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('02BAGI', 'berbagi', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('03PEDULI', 'peduli', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('04PKT', 'paket', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('05KARYAWAN', 'karyawan', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('06TF', 'transfer', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('07PRES', 'prestasi', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('08MITRA', 'mitra', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('09NU', 'NU', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('10KIP', 'KIP', '2021-12-19 05:46:57', '2021-12-19 05:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `id_jurusan` varchar(5) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL,
  `nama_program` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`id_jurusan`, `nama_jurusan`, `nama_program`, `created_at`, `updated_at`) VALUES
('01TI', 'TEKNIK INFORMATIKA', 'S1', NULL, NULL),
('02MI', 'MANAJEMEN INFORMATIKA', 'D3', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_metode_pembayaran`
--

CREATE TABLE `tbl_metode_pembayaran` (
  `id_metode` varchar(20) NOT NULL,
  `nama_metode_pembayaran` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_metode_pembayaran`
--

INSERT INTO `tbl_metode_pembayaran` (`id_metode`, `nama_metode_pembayaran`, `created_at`, `updated_at`) VALUES
('01MANDIRI', 'TRANSFER MANDIRI', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('02BRI', 'TRANSFER BRI', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('03BNI', 'TRANSFER BNI', '2021-12-19 05:46:57', '2021-12-19 05:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paket`
--

CREATE TABLE `tbl_paket` (
  `id_paket` varchar(10) NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `keterangan_paket` text DEFAULT NULL,
  `jurusan_id` varchar(10) DEFAULT NULL,
  `sesi_id` varchar(10) DEFAULT NULL,
  `jalur_id` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_paket`
--

INSERT INTO `tbl_paket` (`id_paket`, `nama_paket`, `keterangan_paket`, `jurusan_id`, `sesi_id`, `jalur_id`, `created_at`, `updated_at`) VALUES
('PKT01', 'S1 REGULER PAGI', NULL, '01TI', '01P', '01REG', NULL, NULL),
('PKT02', 'S1 REGULER MALAM', NULL, '01TI', '02M', '01REG', NULL, NULL),
('PKT03', 'STIKOM S1 BERBAGI', NULL, '01TI', '01P', '02BAGI', NULL, NULL),
('PKT04', 'STIKOM D3 PEDULI SORE', NULL, '02MI', '02M', '03PEDULI', NULL, NULL),
('PKT05', 'KELAS S1 PAKET', NULL, '01TI', '02M', '04PKT', NULL, NULL),
('PKT06', 'KELAS S1 KARYAWAN', NULL, '01TI', '02M', '05KARYAWAN', NULL, NULL),
('PKT07', 'D3 REGULER MALAM', NULL, '02MI', '02M', '01REG', NULL, NULL),
('PKT08', 'S1 TRANSFER', NULL, '01TI', '02M', '06TF', NULL, NULL),
('PKT09', 'D3 TRANSFER', NULL, '02MI', '02M', '06TF', NULL, NULL),
('PKT10', 'STIKOM D3 BERBAGI MALAM', NULL, '02MI', '02M', '02BAGI', NULL, NULL),
('PKT11', 'STIKOM D3 PEDULI YATIM', NULL, '02MI', '02M', '03PEDULI', NULL, NULL),
('PKT12', 'D3 REGULER PAGI', NULL, '02MI', '01P', '01REG', NULL, NULL),
('PKT13', 'STIKOM D3 BERBAGI PAGI', NULL, '02MI', '01P', '02BAGI', NULL, NULL),
('PKT14', 'STIKOM D3 PEDULI PAGI', NULL, '02MI', '01P', '03PEDULI', NULL, NULL),
('PKT15', 'S1 PRESTASI', NULL, '01TI', '01P', '07PRES', NULL, NULL),
('PKT16', 'D3 MITRA', NULL, '02MI', '02M', '08MITRA', NULL, NULL),
('PKT17', 'S1 MALAM NU', NULL, '01TI', '02M', '09NU', NULL, NULL),
('PKT18', 'D3 MALAM NU', NULL, '02MI', '02M', '09NU', NULL, NULL),
('PKT19', 'SI TRANSFER NU', NULL, '01TI', '02M', '09NU', NULL, NULL),
('PKT20', 'S1 PAGI NU', NULL, '01TI', '01P', '09NU', NULL, NULL),
('PKT21', 'S1 Transfer Pendidik dan Tenaga Kependidikan', NULL, '01TI', '02M', '06TF', NULL, NULL),
('PKT22', 'D3 KIP PAGI', NULL, '02MI', '01P', '10KIP', NULL, NULL),
('PKT23', 'S1 ACCEL', '-', '01TI', '01P', '01REG', '2021-12-22 04:01:42', '2021-12-22 04:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_semester`
--

CREATE TABLE `tbl_semester` (
  `id_semester` varchar(5) NOT NULL,
  `nama_semester` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_semester`
--

INSERT INTO `tbl_semester` (`id_semester`, `nama_semester`, `created_at`, `updated_at`) VALUES
('SMT01', 'SEMESTER 1', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('SMT02', 'SEMESTER 2', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('SMT03', 'SEMESTER 3', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('SMT04', 'SEMESTER 4', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('SMT05', 'SEMESTER 5', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('SMT06', 'SEMESTER 6', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('SMT07', 'SEMESTER 7', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('SMT08', 'SEMESTER 8', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('SMT09', 'SEMESTER 9', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('SMT10', 'SEMESTER 10', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('SMT11', 'SEMESTER 11', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('SMT12', 'SEMESTER 12', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('SMT13', 'SEMESTER 13', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('SMT14', 'SEMESTER 14', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('SMT15', 'SEMESTER 15', '2021-12-19 05:46:57', '2021-12-19 05:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sesi_kuliah`
--

CREATE TABLE `tbl_sesi_kuliah` (
  `id_sesi` varchar(5) NOT NULL,
  `nama_sesi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_sesi_kuliah`
--

INSERT INTO `tbl_sesi_kuliah` (`id_sesi`, `nama_sesi`, `created_at`, `updated_at`) VALUES
('01P', 'PAGI', '2021-12-19 05:46:57', '2021-12-19 05:46:57'),
('02M', 'MALAM', '2021-12-19 05:46:57', '2021-12-19 05:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int(10) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(50) NOT NULL,
  `kode_unit` varchar(50) NOT NULL,
  `kategori_transaksi` varchar(10) NOT NULL,
  `item_kode` varchar(10) DEFAULT NULL,
  `q_debit` int(11) DEFAULT NULL,
  `q_kredit` int(11) DEFAULT NULL,
  `kode_metode_pembayaran` varchar(20) DEFAULT NULL,
  `bukti_transaksi` text DEFAULT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `kode_transaksi`, `kode_unit`, `kategori_transaksi`, `item_kode`, `q_debit`, `q_kredit`, `kode_metode_pembayaran`, `bukti_transaksi`, `tanggal_transaksi`, `created_at`, `updated_at`) VALUES
(1, 'BY-1120101838-K-1-1', '1120101838', 'K', 'ITEM1', NULL, 10000000, NULL, NULL, '2021-12-21 21:40:57', '2021-12-21 14:40:57', '2021-12-21 14:40:57'),
(2, 'BY-1120101838-K-1-2', '1120101838', 'K', 'ITEM2', NULL, 300000, NULL, NULL, '2021-12-21 21:44:30', '2021-12-21 14:44:30', '2021-12-21 14:44:30'),
(3, 'BY-1120101838-K-1-3', '1120101838', 'K', 'ITEM4', NULL, 250000, NULL, NULL, '2021-12-21 21:44:30', '2021-12-21 14:44:30', '2021-12-21 14:44:30'),
(4, 'BY-1120101838-K-1-4', '1120101838', 'K', 'ITEM3', NULL, 0, NULL, NULL, '2021-12-21 23:13:19', '2021-12-21 16:13:19', '2021-12-21 16:13:19'),
(5, 'BY-1120101838-D-1-1', '1120101838', 'D', 'ITEM1', 4000000, NULL, '01MANDIRI', NULL, '2021-12-21 23:22:55', '2021-12-21 16:22:55', '2021-12-21 16:22:55'),
(6, 'BY-1120101838-D-1-2', '1120101838', 'D', 'ITEM2', 250000, NULL, '01MANDIRI', NULL, '2021-12-21 23:44:01', '2021-12-21 16:44:01', '2021-12-21 16:44:01'),
(7, 'BY-1120101838-D-1-3', '1120101838', 'D', 'ITEM4', 50000, NULL, NULL, '', '2021-12-24 15:26:00', '2021-12-24 08:27:01', '2021-12-24 08:27:01'),
(8, 'BY-1120101838-D-1-4', '1120101838', 'D', 'ITEM1', 1000000, NULL, NULL, '', '2021-12-24 15:37:00', '2021-12-24 08:37:24', '2021-12-24 08:37:24'),
(9, 'BY-1120101838-D-1-5', '1120101838', 'D', 'ITEM1', 500000, NULL, NULL, '', '2021-12-24 15:41:00', '2021-12-24 08:45:59', '2021-12-24 08:45:59'),
(10, 'BY-1120101838-D-1-6', '1120101838', 'D', 'ITEM1', 500000, NULL, NULL, '', '2021-12-24 15:48:00', '2021-12-24 08:48:23', '2021-12-24 08:48:23'),
(11, 'BY-1120101838-D-1-7', '1120101838', 'D', 'ITEM1', 4000000, NULL, NULL, '', '2021-12-24 15:49:00', '2021-12-24 08:50:35', '2021-12-24 08:50:35'),
(13, 'BY-1120101838-D-1-8', '1120101838', 'D', 'ITEM2', 50000, NULL, NULL, '', '2021-12-24 16:01:00', '2021-12-24 09:01:50', '2021-12-24 09:01:50'),
(14, 'BY-1120101838-K-1-5', '1120101838', 'K', 'ITEM5', NULL, 3000000, NULL, NULL, '2021-12-26 13:45:00', '2021-12-26 06:45:54', '2021-12-26 06:45:54'),
(16, 'BY-1120101838-K-1-6', '1120101838', 'K', 'ITEM7', NULL, 200000, NULL, NULL, '2021-12-26 13:54:00', '2021-12-26 06:56:20', '2021-12-26 06:56:20'),
(17, 'BY-1120101838-K-2-7', '1120101838', 'K', 'ITEM9', NULL, 500000, NULL, NULL, '2021-12-26 15:00:00', '2021-12-26 08:00:41', '2021-12-26 08:00:41'),
(18, 'BY-1120101838-K-2-8', '1120101838', 'K', 'ITEM8', NULL, 200000, NULL, NULL, '2021-12-26 15:02:00', '2021-12-26 08:02:43', '2021-12-26 08:02:43'),
(20, 'BY-1120101838-D-1-9', '1120101838', 'D', 'ITEM5', 150000, NULL, NULL, '1120101838_1641179492_993c90f6922689ce3822.png', '2022-01-03 10:07:00', '2022-01-03 03:11:32', '2022-01-03 03:11:32'),
(21, 'BY-1120101838-D-1-10', '1120101838', 'D', 'ITEM5', 150000, NULL, NULL, '1120101838_1641180027_b94baaec1287ccf328d9.png', '2022-01-03 10:20:00', '2022-01-03 03:20:27', '2022-01-03 03:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(5) UNSIGNED NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `user_level` varchar(60) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `fullname`, `username`, `email`, `password`, `user_level`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator', 'admin@example.com', '$2y$10$jeLeg7rdLz3cBbCBtVw86ebTAvwW0AZdV8bxrjqBshSzvTMhBC1OW', 'admin', '2021-12-19 05:46:57', '2021-12-19 05:46:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_akun_pemasukan`
--
ALTER TABLE `tbl_akun_pemasukan`
  ADD PRIMARY KEY (`kode_akun`),
  ADD UNIQUE KEY `id_akun` (`id_akun`);

--
-- Indexes for table `tbl_akun_pengeluaran`
--
ALTER TABLE `tbl_akun_pengeluaran`
  ADD PRIMARY KEY (`kode_akun`),
  ADD UNIQUE KEY `id_akun` (`id_akun`);

--
-- Indexes for table `tbl_angkatan`
--
ALTER TABLE `tbl_angkatan`
  ADD PRIMARY KEY (`id_angkatan`);

--
-- Indexes for table `tbl_biaya_sks`
--
ALTER TABLE `tbl_biaya_sks`
  ADD PRIMARY KEY (`id_sks`),
  ADD KEY `tbl_biaya_sks_angkatan_id_foreign` (`angkatan_id`),
  ADD KEY `tbl_biaya_sks_paket_id_foreign` (`paket_id`);

--
-- Indexes for table `tbl_item_paket`
--
ALTER TABLE `tbl_item_paket`
  ADD PRIMARY KEY (`id_item`),
  ADD UNIQUE KEY `kode_item` (`kode_item`),
  ADD KEY `tbl_item_paket_paket_id_foreign` (`paket_id`),
  ADD KEY `tbl_item_paket_angkatan_id_foreign` (`angkatan_id`),
  ADD KEY `tbl_item_paket_semester_id_foreign` (`semester_id`);

--
-- Indexes for table `tbl_jalur`
--
ALTER TABLE `tbl_jalur`
  ADD PRIMARY KEY (`id_jalur`);

--
-- Indexes for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `tbl_metode_pembayaran`
--
ALTER TABLE `tbl_metode_pembayaran`
  ADD PRIMARY KEY (`id_metode`);

--
-- Indexes for table `tbl_paket`
--
ALTER TABLE `tbl_paket`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `tbl_paket_jurusan_id_foreign` (`jurusan_id`),
  ADD KEY `tbl_paket_sesi_id_foreign` (`sesi_id`),
  ADD KEY `tbl_paket_jalur_id_foreign` (`jalur_id`);

--
-- Indexes for table `tbl_semester`
--
ALTER TABLE `tbl_semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indexes for table `tbl_sesi_kuliah`
--
ALTER TABLE `tbl_sesi_kuliah`
  ADD PRIMARY KEY (`id_sesi`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `kode_transaksi` (`kode_transaksi`),
  ADD KEY `tbl_transaksi_item_kode_foreign` (`item_kode`),
  ADD KEY `tbl_transaksi_kode_metode_pembayaran_foreign` (`kode_metode_pembayaran`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbl_akun_pemasukan`
--
ALTER TABLE `tbl_akun_pemasukan`
  MODIFY `id_akun` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_akun_pengeluaran`
--
ALTER TABLE `tbl_akun_pengeluaran`
  MODIFY `id_akun` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT for table `tbl_item_paket`
--
ALTER TABLE `tbl_item_paket`
  MODIFY `id_item` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_biaya_sks`
--
ALTER TABLE `tbl_biaya_sks`
  ADD CONSTRAINT `tbl_biaya_sks_angkatan_id_foreign` FOREIGN KEY (`angkatan_id`) REFERENCES `tbl_angkatan` (`id_angkatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_biaya_sks_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `tbl_paket` (`id_paket`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_item_paket`
--
ALTER TABLE `tbl_item_paket`
  ADD CONSTRAINT `tbl_item_paket_angkatan_id_foreign` FOREIGN KEY (`angkatan_id`) REFERENCES `tbl_angkatan` (`id_angkatan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_item_paket_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `tbl_paket` (`id_paket`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_item_paket_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `tbl_semester` (`id_semester`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_paket`
--
ALTER TABLE `tbl_paket`
  ADD CONSTRAINT `tbl_paket_jalur_id_foreign` FOREIGN KEY (`jalur_id`) REFERENCES `tbl_jalur` (`id_jalur`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_paket_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `tbl_jurusan` (`id_jurusan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_paket_sesi_id_foreign` FOREIGN KEY (`sesi_id`) REFERENCES `tbl_sesi_kuliah` (`id_sesi`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD CONSTRAINT `tbl_transaksi_item_kode_foreign` FOREIGN KEY (`item_kode`) REFERENCES `tbl_item_paket` (`kode_item`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_transaksi_kode_metode_pembayaran_foreign` FOREIGN KEY (`kode_metode_pembayaran`) REFERENCES `tbl_metode_pembayaran` (`id_metode`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
