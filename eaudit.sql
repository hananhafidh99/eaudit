-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Sep 2025 pada 16.21
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eaudit`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `eselons`
--

CREATE TABLE `eselons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_eselon` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `eselons`
--

INSERT INTO `eselons` (`id`, `nama_eselon`, `created_at`, `updated_at`) VALUES
(2, 'II', '2025-04-24 05:06:26', '2025-06-22 23:30:46'),
(3, 'III', '2025-04-24 05:08:29', '2025-04-24 05:08:29'),
(4, 'IV', '2025-06-22 23:30:54', '2025-06-22 23:30:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatans`
--

CREATE TABLE `jabatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jabatans`
--

INSERT INTO `jabatans` (`id`, `nama_jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Auditor Madya', '2025-04-13 06:35:18', '2025-06-22 23:25:27'),
(2, 'Auditor Utama', '2025-04-13 07:16:03', '2025-06-22 23:25:20'),
(3, 'Inspektur Pembantu III', '2025-06-22 23:25:36', '2025-06-22 23:25:36'),
(4, 'Inspektur Pembantu I', '2025-06-22 23:25:44', '2025-06-22 23:25:44'),
(5, 'Inspektur Pembantu IV', '2025-06-22 23:25:51', '2025-06-22 23:25:51'),
(6, 'Sekretaris', '2025-06-22 23:25:58', '2025-06-22 23:25:58'),
(7, 'Pengawas Pemerintahan Madya', '2025-06-22 23:26:07', '2025-06-22 23:26:07'),
(8, 'PPUPD Ahli Muda Sekretariat', '2025-06-22 23:26:15', '2025-06-22 23:26:15'),
(9, 'Auditor Muda', '2025-06-22 23:26:22', '2025-06-22 23:26:22'),
(10, 'Perencana Ahli Muda', '2025-06-22 23:26:35', '2025-06-22 23:26:35'),
(11, 'Pengawas Pemerintahan Muda', '2025-06-22 23:26:43', '2025-06-22 23:26:43'),
(12, 'Kasubbag Administrasi Umum dan Keuangan', '2025-06-22 23:26:50', '2025-06-22 23:26:50'),
(13, 'Pejabat Pelaksana', '2025-06-22 23:26:58', '2025-06-22 23:26:58'),
(14, 'Auditor Pertama', '2025-06-22 23:27:06', '2025-06-22 23:27:06'),
(15, 'Pranata Komputer Terampil', '2025-06-22 23:27:19', '2025-06-22 23:27:19'),
(16, 'Inspektur Pembantu II', '2025-06-22 23:27:48', '2025-06-22 23:27:48'),
(17, 'Inspektur Daerah', '2025-06-22 23:27:58', '2025-06-22 23:27:58'),
(18, 'Penyusun Rencana Kegiatan dan Anggaran', '2025-06-22 23:28:06', '2025-06-22 23:28:06'),
(19, 'Pengelola Gaji', '2025-06-22 23:28:13', '2025-06-22 23:28:13'),
(20, 'Pengelola Sarana dan Prasarana', '2025-06-22 23:28:21', '2025-06-22 23:28:21'),
(21, 'Petugas Keamanan', '2025-06-22 23:28:36', '2025-06-22 23:28:36'),
(22, 'Penyusun Laporan Keuangan', '2025-06-22 23:28:48', '2025-06-22 23:28:48'),
(23, 'THL', '2025-06-22 23:28:54', '2025-06-22 23:28:54'),
(24, 'Inspektur Pembantu Khusus', '2025-06-22 23:29:01', '2025-06-22 23:29:01'),
(25, 'Pengelola Pengawasan', '2025-06-22 23:29:07', '2025-06-22 23:29:07'),
(26, 'Analis Pengawasan', '2025-06-22 23:29:16', '2025-06-22 23:29:16'),
(27, 'Perencana Ahli Pertama', '2025-06-22 23:29:42', '2025-06-22 23:29:42'),
(28, 'Pranata Komputer Ahli Pertama', '2025-06-22 23:29:52', '2025-06-22 23:29:52'),
(29, 'Pengadministrasi Perkantoran Sekretariat', '2025-06-22 23:29:59', '2025-06-22 23:29:59'),
(30, 'Penelaah Teknis Jabatan', '2025-06-22 23:30:05', '2025-06-22 23:30:05'),
(31, 'Penata Kelola Bangunan Gedung dan Kawasan Permukiman Ahli Pertama', '2025-06-22 23:30:12', '2025-06-22 23:30:12'),
(32, 'Kepala bidang Pejabat Pengelola Informasi dan Dokumentasi', '2025-06-22 23:30:26', '2025-06-22 23:30:26'),
(33, 'Kepala bidang Penataan dan Pembinaan Administrasi Desa', '2025-06-22 23:30:34', '2025-06-22 23:30:34'),
(34, 'Penyusun Laporan Keuangan Subbagian Administrasi Umum dan Keuangan', '2025-07-22 23:58:56', '2025-07-22 23:58:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_pengawasans`
--

CREATE TABLE `jenis_pengawasans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jenispengawasan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_pengawasans`
--

INSERT INTO `jenis_pengawasans` (`id`, `nama_jenispengawasan`, `created_at`, `updated_at`) VALUES
(1, 'Monitoring dan Evaluasi Dana BOS pada SMP Negeri se-Kecamatan Gondang', '2025-04-25 03:45:18', '2025-06-23 00:01:34'),
(3, 'Monitoring dan Evaluasi Dana BOS pada SMP Negeri se-Kecamatan Jenar', '2025-06-23 00:01:43', '2025-06-23 00:01:43'),
(4, 'Asestensi Penyusunan Laporan Pertanggungjawaban Dana Bos TA.2021 di SMPN se Kec.Sragen,Gesi,Tanon,Sambirejo,Sumberlawang', '2025-06-23 00:01:58', '2025-06-23 00:01:58'),
(5, 'Asistensi Penyusunan Laporan Pertanggungjawaban Dana Bos TA,2021 di SDN se Kec.Karangmalang,Sambungmacan,Tangen, Sukodono,Gemolong', '2025-06-23 00:02:06', '2025-06-23 00:02:06'),
(6, 'Asistensi Pengumpulan & penyusunan Dokumen Data dasar IKK urusan Sosial, PMD, Perhubungan, Kominfo, Statistik, Persandian, Perencanaan Keuangan, Kepegawaian,Manajemen Keuangan, Transparasi dan Partisipasi', '2025-06-23 00:02:20', '2025-06-23 00:02:20'),
(7, 'Asistensi Pengumpulan dan penyusunan Dokumen Data dasar Indikator Kinerja Kunci urusan', '2025-06-23 00:02:29', '2025-06-23 00:02:29'),
(8, 'Asistensi pengumpulan dan penyusunan dokumen data Dasar indikator kinerja makro', '2025-06-23 00:02:47', '2025-06-23 00:02:47'),
(9, 'Asistensi Penyusunan Laporan Pertanggungjawaban BOS TA 2020', '2025-06-23 00:02:57', '2025-06-23 00:02:57'),
(10, 'Asistensi Penyusunan Laporan Pertanggungjawaban Dana Bos TA.2021 di SDN se Kec.Ngrampal,Masaran,Gondang,Plupuh,Kalijambe', '2025-06-23 00:03:10', '2025-06-23 00:03:10'),
(11, 'Asistensi Penyusunan Laporan Pertanggungjawaban Dana BOS TA.2021 di SDN se Kec.Sidoharjo, Kedawung,Mondokan,Jenar, Miri', '2025-06-23 00:03:16', '2025-06-23 00:03:16'),
(12, 'Asistensi Penyusunan Laporan Pertanggungjawaban Dana Bos TA.2021 di SDN se Kec.Sragen,Gesi,Tanon,Sambirejo,Sumberlawang', '2025-06-23 00:03:23', '2025-06-23 00:03:23'),
(13, 'Evaluasi SAKIP Tahun 2024', '2025-07-23 18:45:20', '2025-07-23 18:45:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_temuans`
--

CREATE TABLE `jenis_temuans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `id_penugasan` bigint(20) UNSIGNED DEFAULT NULL,
  `id_pengawasan` int(11) DEFAULT NULL,
  `nama_temuan` varchar(255) DEFAULT NULL,
  `kode_temuan` varchar(255) DEFAULT NULL,
  `rekomendasi` varchar(255) DEFAULT NULL,
  `pengembalian` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `kode_rekomendasi` varchar(255) DEFAULT NULL,
  `Rawdata` longtext DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_temuans`
--

INSERT INTO `jenis_temuans` (`id`, `id_parent`, `id_penugasan`, `id_pengawasan`, `nama_temuan`, `kode_temuan`, `rekomendasi`, `pengembalian`, `keterangan`, `kode_rekomendasi`, `Rawdata`, `password`, `created_at`, `updated_at`) VALUES
(31, 31, 24, 5, NULL, NULL, 'HONDA', '50000000', 'TES', NULL, NULL, '', '2025-09-11 19:57:41', '2025-09-11 19:57:41'),
(32, 31, 24, 5, NULL, NULL, 'VARIO', '50000000', 'TES', NULL, NULL, '', '2025-09-11 19:57:41', '2025-09-11 19:57:41'),
(33, 31, 24, 5, NULL, NULL, 'PCX', '50000000', 'TES', NULL, NULL, '', '2025-09-11 19:57:41', '2025-09-11 19:57:41'),
(34, 34, 24, 5, NULL, NULL, 'YAMAHA', '45000000', 'TES', NULL, NULL, '', '2025-09-11 19:57:41', '2025-09-11 19:57:41'),
(35, 34, 24, 5, NULL, NULL, 'NMAX', '45000000', 'TES', NULL, NULL, '', '2025-09-11 19:57:41', '2025-09-11 19:57:41'),
(36, NULL, 23, 6, 'JENIS MOTOR', '2500', '2501', '500000000', 'HONDA', NULL, '{\"_method\":\"POST\",\"_token\":\"KhfzcDxQuV3hB9VBSNI21GY88fmb1ZpmUNkfmtob\",\"id_pengawasan\":\"6\",\"id_penugasan\":\"23\",\"temuan\":[{\"kode_temuan\":\"2500\",\"nama_temuan\":\"JENIS MOTOR\",\"rekomendasi\":[{\"rekomendasi\":\"2501\",\"keterangan\":\"HONDA\",\"pengembalian\":\"500000000\"}]}]}', NULL, '2025-09-14 06:46:29', '2025-09-14 06:46:29'),
(37, NULL, 23, 6, 'JENIS MOBIL', '3500', '3501', '50000000', 'HONDA', NULL, '{\"_method\":\"POST\",\"_token\":\"KhfzcDxQuV3hB9VBSNI21GY88fmb1ZpmUNkfmtob\",\"id_pengawasan\":\"6\",\"id_penugasan\":\"23\",\"temuan\":[{\"kode_temuan\":\"3500\",\"nama_temuan\":\"JENIS MOBIL\",\"rekomendasi\":[{\"rekomendasi\":\"3501\",\"keterangan\":\"HONDA\",\"pengembalian\":\"50000000\"}]}],\"tipeA\":{\"rekomendasi\":\"SUZUKI\",\"keterangan\":\"TES\",\"pengembalian\":\"30000000\"}}', NULL, '2025-09-14 06:48:27', '2025-09-14 06:48:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatans`
--

CREATE TABLE `kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pptk` bigint(20) UNSIGNED DEFAULT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `norek` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kegiatans`
--

INSERT INTO `kegiatans` (`id`, `id_pptk`, `kegiatan`, `norek`, `created_at`, `updated_at`) VALUES
(1, 42, 'Pengawasan Kinerja Pemerintah Daerah', '6.01.02.2.01.01.5.1.02.04.01.0003', '2025-06-22 23:47:42', '2025-07-23 18:30:42'),
(2, 22, 'Pengawasan Keuangan Pemerintah Daerah', '6.01.02.2.01.02.5.1.02.04.01.0003', '2025-06-22 23:49:14', '2025-07-23 18:31:17'),
(3, 42, 'Reviu Laporan Kinerja', '6.01.02.2.01.03.5.1.02.04.01.0003', '2025-06-22 23:49:37', '2025-07-23 18:31:52'),
(4, 10, 'Reviu Laporan Keuangan', '6.01.02.2.01.04.5.1.02.04.01.0003', '2025-07-23 18:33:00', '2025-07-23 18:33:00'),
(5, 22, 'Pengawasan Desa', '6.01.02.2.01.05.5.1.02.04.01.0003', '2025-07-23 18:33:26', '2025-07-23 18:33:26'),
(6, 33, 'Monitoring dan Evaluasi Tindak Lanjut Hasil Pemeriksaan BPK RI dan Tindak Lanjut Hasil Pemeriksaan APIP', '6.01.02.2.01.07.5.1.02.04.01.0003', '2025-07-23 18:33:55', '2025-07-23 18:33:55'),
(7, 33, 'Pengawasan dengan Tujuan Tertentu', '6.01.02.2.02.02.5.1.02.04.01.0003', '2025-07-23 18:34:31', '2025-07-23 18:34:31'),
(8, 36, 'Perumusan Kebijakan Teknis di Bidang Pengawasan', '6.01.03.2.01.01.5.1.02.04.01.0003', '2025-07-23 18:35:00', '2025-07-23 18:35:00'),
(9, 26, 'Pendampingan dan Asistensi Urusan Pemerintahan Daerah', '6.01.03.2.02.01.5.1.02.04.01.0003', '2025-07-23 18:35:36', '2025-07-23 18:35:36'),
(10, 26, 'Pendampingan, Asistensi, Verifikasi, dan Penilaian Reformasi Birokrasi', '6.01.03.2.02.02.5.1.02.04.01.0003', '2025-07-23 18:37:19', '2025-07-23 18:37:19'),
(11, 33, 'Penanganan Penyelesaian Kerugian Negara/Daerah', '6.01.02.2.02.01.5.1.02.04.01.0003', '2025-07-23 18:37:49', '2025-07-23 18:37:49'),
(12, 1, 'TES', '000', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2025_03_01_005036_create_s_k_p_d_s_table', 1),
(5, '2025_03_01_034905_create_jabatans_table', 1),
(6, '2025_03_01_034920_create_pangkats_table', 1),
(7, '2025_03_01_034937_create_eselons_table', 1),
(8, '2025_03_01_035024_create_obriks_table', 1),
(9, '2025_03_01_035036_create_jenis_pengawasans_table', 1),
(10, '2025_03_04_010634_create_pegawais_table', 1),
(11, '2025_03_04_011015_add_id_jabatan', 1),
(12, '2025_03_04_025304_create_perans_table', 1),
(13, '2025_05_16_101519_create_kegiatans_table', 2),
(14, '2025_05_16_103847_add_id_pegawai', 2),
(15, '2025_05_24_223651_create_penugasans_table', 2),
(16, '2025_05_24_224036_add_id_anggaran', 2),
(17, '2025_05_24_224729_create_surat_tugas_table', 2),
(18, '2025_05_24_224917_add_id_peran', 2),
(19, '2025_08_07_135610_add_level', 3),
(20, '2025_08_19_142422_create_pengawasans_table', 4),
(21, '2025_08_19_142950_add_tglkeluar_to_pengawasans_table', 5),
(0, '2025_08_25_065948_create_pengawasans_table', 6),
(0, '2025_08_26_105758_create_jenis_temuans_table', 6),
(0, '2025_08_26_110702_add_id_pengawasan', 6),
(0, '2025_09_09_114601_add_id_penugasans', 6),
(0, '2025_09_09_125254_add_id_penugasans_temuans', 7),
(0, '2025_09_09_130924_create_jenis_temuans_table', 8),
(0, '2025_09_09_131018_add_id_penugasans_temuans', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obriks`
--

CREATE TABLE `obriks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_obrik` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `obriks`
--

INSERT INTO `obriks` (`id`, `nama_obrik`, `created_at`, `updated_at`) VALUES
(1, 'Dinas Pekerjaan Umum (DPU) Kab. Sragen', '2025-04-25 03:25:21', '2025-04-25 03:40:14'),
(3, 'Badan Kepegawaian Dan Pengembangan Sumber Daya Manusia (BKPSDM) Kab. Sragen', '2025-06-22 23:50:22', '2025-06-22 23:50:22'),
(4, 'Badan Kesatuan Bangsa dan Politik Kab. Sragen', '2025-06-22 23:50:33', '2025-06-22 23:50:33'),
(5, 'Badan Penanggulangan Bencana Daerah Kab. Sragen', '2025-06-22 23:50:44', '2025-06-22 23:50:44'),
(6, 'Badan Pengelolaan Keuangan dan Pendapatan Daerah (BPKPD) Kab. Sragen', '2025-06-22 23:50:54', '2025-06-22 23:50:54'),
(7, 'Badan Perencanaan Pembangunan, Riset dan Inovasi Daerah Kab. Sragen', '2025-06-22 23:59:15', '2025-06-22 23:59:15'),
(8, 'Bagian Administrasi Pembangunan Sekretariat Daerah Kab. Sragen', '2025-06-22 23:59:37', '2025-06-22 23:59:37'),
(9, 'Bagian Organisasi Setda Kab. Sragen', '2025-06-22 23:59:51', '2025-06-22 23:59:51'),
(10, 'Bagian Pembangunan Sekretariat Daerah Kabupaten Sragen', '2025-06-22 23:59:59', '2025-06-22 23:59:59'),
(11, 'Bagian Pemerintahan Sekretariat Daerah Kab. Sragen', '2025-06-23 00:00:07', '2025-06-23 00:00:07'),
(12, 'Bagian Pengadaan Barang dan Jasa Sekretariat Daerah Kab. Sragen', '2025-06-23 00:00:24', '2025-06-23 00:00:24'),
(13, 'Sekretariat DPRD Kab. Sragen', '2025-07-23 18:45:53', '2025-07-23 18:45:53'),
(14, 'Kecamatan Sumberlawang, Kab. Sragen', '2025-07-23 18:46:08', '2025-07-23 18:46:08'),
(15, 'Sekretariat Daerah Kab. Sragen', '2025-07-23 18:46:21', '2025-07-23 18:46:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pangkats`
--

CREATE TABLE `pangkats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pangkat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pangkats`
--

INSERT INTO `pangkats` (`id`, `nama_pangkat`, `created_at`, `updated_at`) VALUES
(1, 'Pembina Utama Muda/IVc', NULL, '2025-06-22 23:22:48'),
(2, 'Pembina Tingkat I/IVb', '2025-06-22 23:23:02', '2025-06-22 23:23:02'),
(3, 'Pembina/IVa', '2025-06-22 23:23:14', '2025-06-22 23:23:14'),
(4, 'Penata Tingkat I/IIId', '2025-06-22 23:23:26', '2025-06-22 23:23:26'),
(5, 'IIIb', '2025-06-22 23:23:36', '2025-06-22 23:23:36'),
(7, 'Penata Muda/IIIa', '2025-06-22 23:23:56', '2025-06-22 23:23:56'),
(8, 'IIc', '2025-06-22 23:24:06', '2025-06-22 23:24:06'),
(9, 'Penata/IIIc', '2025-06-22 23:24:17', '2025-06-22 23:24:17'),
(10, 'Penata Tingkat I/IIId', '2025-06-22 23:24:25', '2025-06-22 23:24:25'),
(11, 'Pembina/IVa', '2025-06-22 23:24:33', '2025-06-22 23:24:33'),
(15, 'V', '2025-07-22 23:57:03', '2025-07-22 23:57:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawais`
--

CREATE TABLE `pegawais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_eselon` bigint(20) UNSIGNED DEFAULT NULL,
  `id_jabatan` bigint(20) UNSIGNED DEFAULT NULL,
  `id_pangkat` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_pegawai` varchar(255) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `status_pegawai` varchar(255) DEFAULT NULL,
  `rekening_pegawai` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pegawais`
--

INSERT INTO `pegawais` (`id`, `id_eselon`, `id_jabatan`, `id_pangkat`, `nama_pegawai`, `nip`, `status_pegawai`, `rekening_pegawai`, `created_at`, `updated_at`) VALUES
(1, NULL, 9, 10, 'Agus Broto Nugroho, S.E., M.Si.', '19720813 201001 1 002', 'Aktif', '3010154722', NULL, '2025-06-22 23:32:43'),
(2, NULL, 7, 12, 'Agus Purnosudjati, S.H.', '19700811 199803 1 012', 'Aktif', '3010023628', NULL, '2025-06-22 23:33:40'),
(3, NULL, 1, 11, 'Addwi Suratman, S.T., M.M.', '19771220 200901 1 007', 'Aktif', '2010227880', '2025-04-25 06:05:36', '2025-06-22 23:31:55'),
(4, NULL, 26, 5, 'Andi Pramono, S.T.', '19870409 201101 1 007', 'Aktif', '3010158752', '2025-04-26 07:00:42', '2025-06-22 23:35:08'),
(5, 4, 30, 15, 'Agus Saputro, A.Md.T', '19990809 202504 1 002', 'Aktif', '3010040037', '2025-06-22 23:34:24', '2025-06-22 23:34:24'),
(6, 2, 17, 1, 'Badrus Samsu Darusi, S.STP, M.Si.', '19780923 199803 1 003', 'Aktif', '2010228207', '2025-06-22 23:35:50', '2025-06-22 23:35:50'),
(7, NULL, 30, 7, 'Bryant Satria Perdana, S.Tr. IP', '20010503 202308 1 001', 'Aktif', '3010345773', '2025-06-22 23:36:28', '2025-06-22 23:36:28'),
(8, NULL, 11, 10, 'Danik Puji Hastutik, S.E.', '19820203 201001 2 022', 'Aktif', '3010154749', '2025-06-22 23:39:45', '2025-06-22 23:39:45'),
(9, NULL, 11, 7, 'Diaz Efrissa, S.I.P', '19990402 202504 2 003', 'Aktif', '3010347644', '2025-06-22 23:40:51', '2025-06-22 23:40:51'),
(10, 3, 5, 12, 'Drs. Triyanta, M.Si.', '19680412 199203 1 009', 'Aktif', '3010023571', '2025-06-22 23:41:29', '2025-06-22 23:41:29'),
(11, NULL, 6, 12, 'Dwi Sigit Kartanto, A.P.', '19731014 199311 1 002', 'Aktif', '2010157156', '2025-06-22 23:42:00', '2025-06-22 23:42:00'),
(12, NULL, 29, 3, 'Eka Rokayati', '19821105 201001 2 001', 'Aktif', '3010339293', '2025-06-22 23:42:46', '2025-06-22 23:42:46'),
(15, NULL, 23, 1, 'Bayu Aji Pamungkas', '-/-', 'Aktif', '2010305597', '2025-07-23 00:58:31', '2025-07-23 00:58:31'),
(16, NULL, 23, 1, 'Dwi Nurhadi', '-/-', 'Aktif', '2010305597', '2025-07-23 01:02:17', '2025-07-23 01:02:17'),
(17, NULL, 34, 10, 'Eko Widiyanto, S.E., M.Si.', '19841104 201101 1 008', 'Aktif', '2019210866', '2025-07-23 01:03:19', '2025-07-23 01:03:19'),
(18, NULL, 19, 10, 'Eli Sutanti, S.E.', '19671023 199203 2 007', 'Aktif', '3010023512', '2025-07-23 01:05:13', '2025-07-23 01:05:13'),
(19, NULL, 23, 1, 'Endratno Aldo Yanuar P', '-/-', 'Aktif', '2010228100', '2025-07-23 01:05:44', '2025-07-23 01:05:44'),
(20, NULL, 11, 10, 'Erna Sri Rejeki, S.E.', '19780129 200801 2 011', 'Aktif', '3010071541', '2025-07-23 01:06:38', '2025-07-23 01:06:38'),
(21, NULL, 11, 10, 'Evi Dhamayanti, S.E.', '19760420 200801 2 010', 'Aktif', '3010071550', '2025-07-23 01:07:20', '2025-07-23 01:07:20'),
(22, NULL, 16, 12, 'Fajar Adhi Nugroho, S.T', '19751129 200312 1 004', 'Aktif', '3010038021', '2025-07-23 01:07:59', '2025-07-23 01:07:59'),
(23, NULL, 9, 10, 'Faya Firdianawati, S.E.', '19870729 201110 2 009', 'Aktif', '3010154781', '2025-07-23 01:08:39', '2025-07-23 01:08:39'),
(24, NULL, 21, 7, 'Gimanto', '19680909 199101 1 001', 'Aktif', '3010045117', '2025-07-23 01:10:02', '2025-07-23 01:10:02'),
(25, NULL, 11, 10, 'Ginarsih, S.E.', '19730122 199603 2 003', 'Aktif', '3010023458', '2025-07-23 01:10:48', '2025-07-23 01:10:48'),
(26, NULL, 3, 2, 'Heri Adi Prabowo, S.E., M.Si.', '19760526 200312 1 009', 'Aktif', '3010023199', '2025-07-23 01:11:33', '2025-07-23 01:11:33'),
(27, NULL, 27, 2, 'Hetty Triwahyuni, S.E.', '19810824 202421 2 010', 'Aktif', '3010249472', '2025-07-23 01:12:12', '2025-07-23 01:12:12'),
(28, NULL, 15, 5, 'Ibnu Salifi, A.Md.Kom', '19890730 202012 1 009', 'Aktif', '3010033144', '2025-07-23 01:17:39', '2025-07-23 01:17:39'),
(29, NULL, 1, 12, 'Ika Rochmawati Oktavia, S.E., M.Si.', '19811029 200501 2 009', 'Aktif', '3010023482', '2025-07-23 01:18:14', '2025-07-23 01:18:14'),
(30, NULL, 14, 7, 'Ilham Sholeh, S.A.', '19871227 202012 1 006', '- Pilih Status Pegawai -', '3010033159', '2025-07-23 01:19:08', '2025-07-23 01:19:08'),
(31, NULL, 30, 15, 'Joko Kuswanto', '19831217 202521 1 004', 'Aktif', '3010101201020761', '2025-07-23 01:19:54', '2025-07-23 01:19:54'),
(32, NULL, 9, 10, 'Joko Mujiarto, S. Farm, Apt.', '19680831 199103 1 008', 'Aktif', '3010025761', '2025-07-23 01:20:31', '2025-07-23 01:20:31'),
(33, NULL, 24, 14, 'Joko Sunaryo, S.E., M.M.', '19721204 199703 1 005', 'Aktif', '3010023661', '2025-07-23 01:21:03', '2025-07-23 01:21:03'),
(34, NULL, 30, 15, 'Khoirun Nisa Rofiqoh', '19890731 202521 2 003', 'Aktif', '3010105201002754', '2025-07-23 01:21:35', '2025-07-23 01:21:35'),
(35, NULL, 23, 1, 'M. Hanan Hafidh Arindra,S.Kom', '-/-', 'Aktif', '2010345262', '2025-07-23 01:22:10', '2025-07-23 01:22:10'),
(36, NULL, 10, 10, 'Nanang Budi Rahayu, S.E., M.Si.', '19841022 200903 1 003', 'Aktif', '2010230121', '2025-07-23 01:22:52', '2025-07-23 01:22:52'),
(37, NULL, 28, 2, 'Nanda Didik Hermawan, S.Kom', '20000428 202421 1 003', 'Aktif', '2010218791', '2025-07-23 01:23:37', '2025-07-23 01:23:37'),
(38, NULL, 9, 10, 'Naomi Ratna Adiyati, S.Psi., M.M.', '19831130 201001 2 018', 'Aktif', '3010262185', '2025-07-23 01:24:16', '2025-07-23 01:24:16'),
(39, NULL, 7, 12, 'Nila Kusuma Dewi, S.E., M.M., M.Si.', '19761221 200312 2 006', 'Aktif', '3010023253', '2025-07-23 01:24:54', '2025-07-23 01:24:54'),
(40, NULL, 9, 10, 'Ninuk Retnowati, S.E.', '19810525 201101 2 008', 'Aktif', '3010154773', '2025-07-23 01:25:36', '2025-07-23 01:25:36'),
(41, NULL, 23, 1, 'Okta Wahyu Tri W, A.Md. Kom', '-/-', 'Aktif', '2010228118', '2025-07-23 01:26:07', '2025-07-23 01:26:07'),
(42, NULL, 4, 12, 'Pancagus Suharno, S.T., M.Eng.', '19710514 200312 1 004', 'Aktif', '3010023849', '2025-07-23 01:26:44', '2025-07-23 01:26:44'),
(43, NULL, 7, 12, 'Purwaningsih, S.E.', '19660614 199301 2 002', 'Aktif', '3010023466', '2025-07-23 01:27:22', '2025-07-23 01:27:22'),
(44, NULL, 30, 15, 'Ramandhita Putri Kurniawati', '19980111 202521 2 004', 'Aktif', '3010104201001925', '2025-07-23 01:28:19', '2025-07-23 01:28:19'),
(45, NULL, 1, 11, 'Ririn Triani, S.E., M.Si.', '19710122 199403 2 002', 'Aktif', '3010043807', '2025-07-23 01:28:46', '2025-07-23 01:28:46'),
(46, NULL, 30, 15, 'Rizki Indrasetyawan Adinugroho', '19920317 202521 1 008', 'Aktif', '3010101201020755', '2025-07-23 01:29:16', '2025-07-23 01:29:16'),
(47, NULL, 25, 3, 'Sakti Setya Ulida, A.Md', '19901002 201903 1 008', 'Aktif', '3010029060', '2025-07-23 01:29:53', '2025-07-23 01:29:53'),
(48, NULL, 14, 8, 'Septiana Endah Prasetyowati, S.H.', '19880912 202012 2 011', 'Aktif', '3010033450', '2025-07-23 01:30:24', '2025-07-23 01:30:24'),
(49, NULL, 7, 14, 'Subronto, S.E., M.Si.', '19730724 200312 1 005', 'Aktif', '3010023695', '2025-07-23 01:30:57', '2025-07-23 01:30:57'),
(50, NULL, 9, 10, 'Sumarmi, S.E, M.M.', '19760621 200804 2 001', 'Aktif', '3010196506', '2025-07-23 01:31:40', '2025-07-23 01:31:40'),
(51, NULL, 9, 10, 'Sumberasih, S.E., M.M.', '19781219 200903 2 001', 'Aktif', '3010071584', '2025-07-23 18:26:27', '2025-07-23 18:26:27'),
(52, NULL, 12, 10, 'Urip Sarwo Sambodo, S.T.', '19800128 200901 1 007', 'Aktif', '3010169045', '2025-07-23 18:27:19', '2025-07-23 18:27:19'),
(53, NULL, 11, 10, 'Wariniyanti, S.E.', '19780427 200903 2 006', 'Aktif', '3010071576', '2025-07-23 18:28:13', '2025-07-23 18:28:13'),
(54, NULL, 7, 12, 'Wiewien Kurniawati, S.T., M.Si.', '19810529 200501 2 014', 'Aktif', '3010023491', '2025-07-23 18:29:03', '2025-07-23 18:29:03'),
(55, NULL, 30, 4, 'Yuni Kusumawati, S.I.P', '19880626 201503 2 004', 'Aktif', '3010285631', '2025-07-23 18:29:41', '2025-07-23 18:29:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengawasans`
--

CREATE TABLE `pengawasans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_penugasan` bigint(20) UNSIGNED DEFAULT NULL,
  `tipe` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `wilayah` varchar(255) NOT NULL,
  `pemeriksa` varchar(255) NOT NULL,
  `status_LHP` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tglkeluar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengawasans`
--

INSERT INTO `pengawasans` (`id`, `id_penugasan`, `tipe`, `jenis`, `wilayah`, `pemeriksa`, `status_LHP`, `created_at`, `updated_at`, `tglkeluar`) VALUES
(5, 24, 'Rekomendasi', 'pdtt', 'wilayah1', 'auditor', 'Belum Jadi', '2025-09-11 19:09:17', '2025-09-11 19:09:17', '2025-09-12'),
(6, 23, 'TemuandanRekomendasi', 'pdtt', 'wilayah1', 'auditor', 'Belum Jadi', '2025-09-11 20:04:35', '2025-09-11 20:04:35', '2025-09-11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penugasans`
--

CREATE TABLE `penugasans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_jenisPengawasan` bigint(20) UNSIGNED DEFAULT NULL,
  `id_obrik` bigint(20) UNSIGNED DEFAULT NULL,
  `id_anggaran` bigint(20) UNSIGNED DEFAULT NULL,
  `noSurat` varchar(255) DEFAULT NULL,
  `tanggalAwalPenugasan` varchar(255) DEFAULT NULL,
  `tanggalAkhirPenugasan` varchar(255) DEFAULT NULL,
  `tanggalTerbitPenugasan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penugasans`
--

INSERT INTO `penugasans` (`id`, `id_jenisPengawasan`, `id_obrik`, `id_anggaran`, `noSurat`, `tanggalAwalPenugasan`, `tanggalAkhirPenugasan`, `tanggalTerbitPenugasan`, `created_at`, `updated_at`) VALUES
(18, 12, 12, 1, '1000', '2025-06-16', '2025-06-23', '2025-06-23', '2025-06-28 00:32:19', '2025-07-27 07:12:11'),
(19, 1, 1, 2, '100', '2025-02-03', '2025-02-21', '2025-02-03', '2025-07-07 19:24:43', '2025-07-27 22:46:30'),
(20, 13, 13, 3, '1857', '2025-07-29', '2025-07-30', '2025-07-02', '2025-07-23 19:23:27', '2025-08-09 03:08:24'),
(21, 11, 11, 4, '19999', '2025-07-21', '2025-07-25', '2025-07-14', '2025-07-27 21:49:01', '2025-07-27 21:49:01'),
(22, 13, 11, 5, '123', '2025-07-28', '2025-07-31', '2025-07-25', '2025-07-27 21:59:04', '2025-07-27 21:59:04'),
(23, 11, 11, 5, '0098', '2025-08-25', '2025-08-29', '2025-08-25', '2025-08-09 03:33:48', '2025-08-10 01:14:41'),
(24, 10, 10, 1, '1250', '2025-09-01', '2025-09-05', '2025-08-29', '2025-08-10 01:46:21', '2025-08-14 04:23:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perans`
--

CREATE TABLE `perans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_peran` varchar(255) NOT NULL,
  `tarif` varchar(255) NOT NULL,
  `sort_order` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `perans`
--

INSERT INTO `perans` (`id`, `nama_peran`, `tarif`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Penanggung Jawab', '150000', 1, NULL, '2025-04-25 04:29:44'),
(2, 'Wakil Penanggung Jawab', '150000', 2, '2025-04-25 04:20:54', '2025-04-25 04:20:54'),
(3, 'Wakil Penanggungjawab II', '150000', 3, '2025-06-23 00:13:47', '2025-06-23 00:13:47'),
(4, 'Pengendali Teknis', '150000', 4, '2025-06-23 00:14:02', '2025-06-23 00:14:02'),
(5, 'Supervisor', '150000', 5, '2025-06-23 00:14:15', '2025-06-23 00:14:15'),
(6, 'Ketua Tim', '150000', 6, '2025-06-23 00:14:32', '2025-06-23 00:14:32'),
(8, 'Anggota', '150000', 8, '2025-06-23 00:14:44', '2025-06-23 00:14:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_tugas`
--

CREATE TABLE `surat_tugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_penugasan` bigint(20) UNSIGNED DEFAULT NULL,
  `id_peran` bigint(20) UNSIGNED DEFAULT NULL,
  `id_pegawai` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggalAwalPemeriksaan` date DEFAULT NULL,
  `tanggalAkhirPemeriksaan` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `surat_tugas`
--

INSERT INTO `surat_tugas` (`id`, `id_penugasan`, `id_peran`, `id_pegawai`, `tanggalAwalPemeriksaan`, `tanggalAkhirPemeriksaan`, `created_at`, `updated_at`) VALUES
(10, 18, 5, 2, '2025-06-18', '2025-06-19', '2025-06-28 00:32:19', '2025-07-27 07:12:11'),
(11, 18, 6, 16, '2025-06-18', '2025-06-19', '2025-06-28 00:32:19', '2025-07-27 07:12:11'),
(12, 18, 8, 15, '2025-06-17', '2025-06-19', '2025-06-28 00:32:19', '2025-07-27 07:12:11'),
(13, 18, 8, 9, '2025-07-01', '2025-07-02', '2025-06-28 00:32:19', '2025-07-27 07:12:11'),
(14, 19, 1, 6, '2025-02-03', '2025-02-03', '2025-07-07 19:24:43', '2025-07-27 22:46:30'),
(15, 19, 2, 2, '2025-02-03', '2025-02-03', '2025-07-07 19:24:43', '2025-07-27 22:46:30'),
(16, 19, 6, 4, '2025-02-03', '2025-02-03', '2025-07-07 19:24:43', '2025-07-27 22:46:30'),
(17, 19, 8, 8, '2025-02-03', '2025-02-03', '2025-07-07 19:24:43', '2025-07-07 19:24:43'),
(18, 20, 1, 6, NULL, NULL, '2025-07-23 19:23:27', '2025-08-09 03:08:24'),
(20, 20, 5, 43, NULL, NULL, '2025-07-23 19:23:27', '2025-08-09 03:08:24'),
(21, 20, 6, 20, NULL, NULL, '2025-07-23 19:23:27', '2025-08-09 03:08:24'),
(22, 20, 8, 49, NULL, NULL, '2025-07-23 19:23:27', '2025-08-09 03:08:24'),
(23, 20, 8, 21, NULL, NULL, '2025-07-23 19:23:27', '2025-08-09 03:08:24'),
(24, 20, 8, 8, NULL, NULL, '2025-07-23 19:23:27', '2025-08-09 03:08:24'),
(25, 18, 2, 33, '2025-06-16', '2025-06-23', '2025-07-27 07:12:11', '2025-07-27 07:12:11'),
(26, 18, 4, 3, '2025-06-16', '2025-06-16', '2025-07-27 07:12:11', '2025-07-27 07:12:11'),
(27, 18, 8, 23, '2025-06-17', '2025-06-17', '2025-07-27 07:12:11', '2025-07-27 07:12:11'),
(28, 21, 8, 7, NULL, NULL, '2025-07-27 21:49:01', '2025-07-27 21:49:01'),
(29, 21, 8, 37, NULL, NULL, '2025-07-27 21:49:01', '2025-07-27 21:49:01'),
(30, 21, 8, 15, NULL, NULL, '2025-07-27 21:49:01', '2025-07-27 21:49:01'),
(31, 22, 1, 6, NULL, NULL, '2025-07-27 21:59:04', '2025-07-27 21:59:04'),
(32, 22, 2, 26, NULL, NULL, '2025-07-27 21:59:04', '2025-07-27 21:59:04'),
(33, 22, 6, 49, NULL, NULL, '2025-07-27 21:59:04', '2025-07-27 21:59:04'),
(34, 22, 8, 20, NULL, NULL, '2025-07-27 21:59:04', '2025-07-27 21:59:04'),
(36, 20, 2, 26, NULL, NULL, '2025-08-09 02:45:46', '2025-08-09 03:08:24'),
(38, 20, 8, 4, NULL, NULL, '2025-08-09 03:07:30', '2025-08-09 03:08:24'),
(39, 20, 8, 2, NULL, NULL, '2025-08-09 03:08:24', '2025-08-09 03:08:24'),
(40, 23, 1, 6, NULL, NULL, '2025-08-09 03:33:48', '2025-08-10 01:14:41'),
(42, 23, 5, 30, NULL, NULL, '2025-08-09 03:33:48', '2025-08-10 01:14:41'),
(43, 23, 6, 5, NULL, NULL, '2025-08-09 03:33:48', '2025-08-10 01:14:41'),
(44, 23, 8, 7, NULL, NULL, '2025-08-09 03:33:48', '2025-08-10 01:14:41'),
(45, 23, 8, 9, NULL, NULL, '2025-08-09 03:33:48', '2025-08-10 01:14:41'),
(46, 23, 8, 4, NULL, NULL, '2025-08-09 03:35:41', '2025-08-10 01:14:41'),
(47, 23, 2, 26, NULL, NULL, '2025-08-10 01:14:41', '2025-08-10 01:14:41'),
(48, 24, 1, 6, NULL, NULL, '2025-08-10 01:46:21', '2025-08-14 04:23:49'),
(49, 24, 2, 26, NULL, NULL, '2025-08-10 01:46:21', '2025-08-14 04:23:49'),
(50, 24, 5, 49, NULL, NULL, '2025-08-10 01:46:21', '2025-08-14 04:23:49'),
(51, 24, 6, 43, NULL, NULL, '2025-08-10 01:46:21', '2025-08-14 04:23:49'),
(52, 24, 8, 21, NULL, NULL, '2025-08-10 01:46:21', '2025-08-14 04:23:49'),
(53, 24, 8, 20, NULL, NULL, '2025-08-10 01:46:21', '2025-08-14 04:23:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `s_k_p_d_s`
--

CREATE TABLE `s_k_p_d_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instansi` varchar(255) NOT NULL,
  `skpd` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `kodepos` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `nomorsurat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_bendahara` int(11) DEFAULT NULL,
  `id_pemimpin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `s_k_p_d_s`
--

INSERT INTO `s_k_p_d_s` (`id`, `instansi`, `skpd`, `alamat`, `telp`, `website`, `email`, `kodepos`, `logo`, `nomorsurat`, `created_at`, `updated_at`, `id_bendahara`, `id_pemimpin`) VALUES
(1, 'Pemerintah Kabupaten Sragen', 'Inspektorat Sragen', 'Jalan Dr. Sutomo Nomor 10, Sragen, Jawa Tengah', '(0271) 891147', 'www.sragenkab.go.id', 'Inspektorat@sragenkab.go.id', '57213', 'Ak0vBo7Q7pSHVOYIMsgVyqRQbtmu63WW5bL33vXp.png', '700.1.1/', NULL, '2025-07-04 18:52:32', 5, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hanan', 'Hanan99', NULL, '$2y$10$WTsFTw4lbQ/xH/kIM3OHF.ziy16l1YBwF0ziiVkv/35WKyuDYfJ9u', 'admineaudit', '$2y$10$CgKbXprphrxTKJ8zOIcYN.gm9c9VyKb702/BQABTJbP/3pHBm1mSu', NULL, '2025-09-10 03:40:56'),
(2, 'Rara', 'Rara99', NULL, '$2y$10$WTsFTw4lbQ/xH/kIM3OHF.ziy16l1YBwF0ziiVkv/35WKyuDYfJ9u', 'adminTL', '$2y$10$il5qFSVTz0oSjAHF5AnkluqIUyneIaYyQUg.1RvmoDngqjek/Cij6', NULL, '2025-09-14 05:47:03'),
(3, 'muthia', 'Muthia75', NULL, '$2y$10$WTsFTw4lbQ/xH/kIM3OHF.ziy16l1YBwF0ziiVkv/35WKyuDYfJ9u', 'pemeriksa', '$2y$10$zn7HpVOkxaRuNPhDdZFkZemZh2Tf0T7zGVlUbziYtnjOzYBcvws/6', NULL, '2025-08-14 15:43:21');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_demo3`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_demo3` (
`id` bigint(20) unsigned
,`noSurat` varchar(255)
,`tanggalAwalPenugasan` varchar(255)
,`tanggalAkhirPenugasan` varchar(255)
,`tanggalTerbitPenugasan` varchar(255)
,`nama_jenispengawasan` varchar(255)
,`nama_obrik` varchar(255)
,`kegiatan` varchar(255)
,`tanggalAwalPemeriksaan` date
,`tanggalAkhirPemeriksaan` date
,`daftar_pegawai` mediumtext
,`detail_petugas` mediumtext
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_demo4`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_demo4` (
`id` bigint(20) unsigned
,`tanggalAwalPenugasan` varchar(255)
,`tanggalAkhirPenugasan` varchar(255)
,`tanggalTerbitPenugasan` varchar(255)
,`nama_jenispengawasan` varchar(255)
,`nama_obrik` varchar(255)
,`daftar_pegawai` mediumtext
,`detail_petugas` mediumtext
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_demo5`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_demo5` (
`id` bigint(20) unsigned
,`tanggalAwalPenugasan` varchar(255)
,`tanggalAkhirPenugasan` varchar(255)
,`tanggalTerbitPenugasan` varchar(255)
,`nama_jenispengawasan` varchar(255)
,`nama_obrik` varchar(255)
,`norek` varchar(255)
,`daftar_pegawai` mediumtext
,`detail_petugas` mediumtext
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_demo6`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_demo6` (
`id` bigint(20) unsigned
,`noSurat` varchar(255)
,`tanggalTerbitPenugasan` varchar(255)
,`nama_jenispengawasan` varchar(255)
,`nama_obrik` varchar(255)
,`kegiatan` varchar(255)
,`daftar_pegawai` mediumtext
,`detail_petugas` mediumtext
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_demo7`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_demo7` (
`id` bigint(20) unsigned
,`tanggalAwalPenugasan` varchar(255)
,`tanggalAkhirPenugasan` varchar(255)
,`tanggalTerbitPenugasan` varchar(255)
,`nama_jenispengawasan` varchar(255)
,`nama_obrik` varchar(255)
,`norek` varchar(255)
,`pptk_info` text
,`daftar_pegawai` mediumtext
,`detail_petugas` mediumtext
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_demo8`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_demo8` (
`id` bigint(20) unsigned
,`noSurat` varchar(255)
,`tanggalTerbitPenugasan` varchar(255)
,`nama_jenispengawasan` varchar(255)
,`nama_obrik` varchar(255)
,`kegiatan` varchar(255)
,`daftar_pegawai` mediumtext
,`detail_petugas` mediumtext
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_tl1`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_tl1` (
`id` bigint(20) unsigned
,`tglkeluar` varchar(255)
,`status_LHP` varchar(255)
,`tipe` varchar(255)
,`jenis` varchar(255)
,`wilayah` varchar(255)
,`pemeriksa` varchar(255)
,`noSurat` varchar(255)
,`id_penugasan` bigint(20) unsigned
,`tanggalAwalPenugasan` varchar(255)
,`tanggalAkhirPenugasan` varchar(255)
,`nama_jenispengawasan` varchar(255)
,`nama_obrik` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_tl2`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_tl2` (
`id` bigint(20) unsigned
,`tglkeluar` varchar(255)
,`status_LHP` varchar(255)
,`tipe` varchar(255)
,`jenis` varchar(255)
,`wilayah` varchar(255)
,`pemeriksa` varchar(255)
,`noSurat` varchar(255)
,`id_penugasan` bigint(20) unsigned
,`tanggalAwalPenugasan` varchar(255)
,`tanggalAkhirPenugasan` varchar(255)
,`nama_jenispengawasan` varchar(255)
,`nama_obrik` varchar(255)
,`daftar_rekom` mediumtext
,`detail_rekom` mediumtext
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_demo3`
--
DROP TABLE IF EXISTS `v_demo3`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_demo3`  AS SELECT `p`.`id` AS `id`, `p`.`noSurat` AS `noSurat`, `p`.`tanggalAwalPenugasan` AS `tanggalAwalPenugasan`, `p`.`tanggalAkhirPenugasan` AS `tanggalAkhirPenugasan`, `p`.`tanggalTerbitPenugasan` AS `tanggalTerbitPenugasan`, `jp`.`nama_jenispengawasan` AS `nama_jenispengawasan`, `o`.`nama_obrik` AS `nama_obrik`, `k`.`kegiatan` AS `kegiatan`, min(`st`.`tanggalAwalPemeriksaan`) AS `tanggalAwalPemeriksaan`, max(`st`.`tanggalAkhirPemeriksaan`) AS `tanggalAkhirPemeriksaan`, group_concat(`pg`.`nama_pegawai` order by `pr`.`id` ASC,`st`.`id` ASC separator '@@ ') AS `daftar_pegawai`, concat('[',group_concat(json_object('namapegawai',`pg`.`nama_pegawai`,'nip',`pg`.`nip`,'peran',`pr`.`nama_peran`) order by `pr`.`id` ASC separator ','),']') AS `detail_petugas` FROM ((((((`penugasans` `p` join `jenis_pengawasans` `jp` on(`jp`.`id` = `p`.`id_jenisPengawasan`)) join `obriks` `o` on(`o`.`id` = `p`.`id_obrik`)) join `kegiatans` `k` on(`k`.`id` = `p`.`id_anggaran`)) join `surat_tugas` `st` on(`st`.`id_penugasan` = `p`.`id`)) join `pegawais` `pg` on(`pg`.`id` = `st`.`id_pegawai`)) join `perans` `pr` on(`pr`.`id` = `st`.`id_peran`)) GROUP BY `p`.`id`, `p`.`noSurat`, `p`.`tanggalAwalPenugasan`, `p`.`tanggalAkhirPenugasan`, `p`.`tanggalTerbitPenugasan`, `jp`.`nama_jenispengawasan`, `o`.`nama_obrik`, `k`.`kegiatan``kegiatan`  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_demo4`
--
DROP TABLE IF EXISTS `v_demo4`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_demo4`  AS SELECT `p`.`id` AS `id`, `p`.`tanggalAwalPenugasan` AS `tanggalAwalPenugasan`, `p`.`tanggalAkhirPenugasan` AS `tanggalAkhirPenugasan`, `p`.`tanggalTerbitPenugasan` AS `tanggalTerbitPenugasan`, `jp`.`nama_jenispengawasan` AS `nama_jenispengawasan`, `o`.`nama_obrik` AS `nama_obrik`, group_concat(`pg`.`nama_pegawai` order by `pg`.`nama_pegawai` ASC separator '@@ ') AS `daftar_pegawai`, concat('[',group_concat(json_object('namapegawai',`pg`.`nama_pegawai`,'peran',`pr`.`nama_peran`) order by `pg`.`nama_pegawai` ASC separator ','),']') AS `detail_petugas` FROM (((((`penugasans` `p` join `jenis_pengawasans` `jp` on(`jp`.`id` = `p`.`id_jenisPengawasan`)) join `obriks` `o` on(`o`.`id` = `p`.`id_obrik`)) join `surat_tugas` `st` on(`st`.`id_penugasan` = `p`.`id`)) join `pegawais` `pg` on(`pg`.`id` = `st`.`id_pegawai`)) join `perans` `pr` on(`pr`.`id` = `st`.`id_peran`)) GROUP BY `p`.`id`, `p`.`noSurat`, `p`.`tanggalAwalPenugasan`, `p`.`tanggalAkhirPenugasan`, `p`.`tanggalTerbitPenugasan`, `jp`.`nama_jenispengawasan`, `o`.`nama_obrik``nama_obrik`  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_demo5`
--
DROP TABLE IF EXISTS `v_demo5`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_demo5`  AS SELECT `p`.`id` AS `id`, `p`.`tanggalAwalPenugasan` AS `tanggalAwalPenugasan`, `p`.`tanggalAkhirPenugasan` AS `tanggalAkhirPenugasan`, `p`.`tanggalTerbitPenugasan` AS `tanggalTerbitPenugasan`, `jp`.`nama_jenispengawasan` AS `nama_jenispengawasan`, `o`.`nama_obrik` AS `nama_obrik`, `k`.`norek` AS `norek`, group_concat(`pg`.`nama_pegawai` order by `pg`.`nama_pegawai` ASC separator '@@ ') AS `daftar_pegawai`, concat('[',group_concat(json_object('namapegawai',`pg`.`nama_pegawai`,'peran',`pr`.`nama_peran`,'tarif',`pr`.`tarif`,'Hari',to_days(`st`.`tanggalAkhirPemeriksaan`) - to_days(`st`.`tanggalAwalPemeriksaan`),'Jumlah',(to_days(`st`.`tanggalAkhirPemeriksaan`) - to_days(`st`.`tanggalAwalPemeriksaan`)) * `pr`.`tarif`,'Rekening',`pg`.`rekening_pegawai`,'tanggalPemeriksaanAwal',`st`.`tanggalAwalPemeriksaan`,'tanggalPemeriksaanAkhir',`st`.`tanggalAkhirPemeriksaan`) order by `pg`.`nama_pegawai` ASC separator ','),']') AS `detail_petugas` FROM ((((((`penugasans` `p` join `jenis_pengawasans` `jp` on(`jp`.`id` = `p`.`id_jenisPengawasan`)) join `obriks` `o` on(`o`.`id` = `p`.`id_obrik`)) join `kegiatans` `k` on(`k`.`id` = `p`.`id_anggaran`)) join `surat_tugas` `st` on(`st`.`id_penugasan` = `p`.`id`)) join `pegawais` `pg` on(`pg`.`id` = `st`.`id_pegawai`)) join `perans` `pr` on(`pr`.`id` = `st`.`id_peran`)) GROUP BY `p`.`id`, `p`.`noSurat`, `p`.`tanggalAwalPenugasan`, `p`.`tanggalAkhirPenugasan`, `p`.`tanggalTerbitPenugasan`, `jp`.`nama_jenispengawasan`, `o`.`nama_obrik`, `k`.`norek``norek`  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_demo6`
--
DROP TABLE IF EXISTS `v_demo6`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_demo6`  AS SELECT `p`.`id` AS `id`, `p`.`noSurat` AS `noSurat`, `p`.`tanggalTerbitPenugasan` AS `tanggalTerbitPenugasan`, `jp`.`nama_jenispengawasan` AS `nama_jenispengawasan`, `o`.`nama_obrik` AS `nama_obrik`, `k`.`kegiatan` AS `kegiatan`, group_concat(`pg`.`nama_pegawai` order by `pg`.`nama_pegawai` ASC separator '@@ ') AS `daftar_pegawai`, concat('[',group_concat(json_object('namapegawai',`pg`.`nama_pegawai`,'nip',`pg`.`nip`,'Hari',to_days(`st`.`tanggalAkhirPemeriksaan`) - to_days(`st`.`tanggalAwalPemeriksaan`),'tanggalawalpemeriksaan',`st`.`tanggalAwalPemeriksaan`,'tanggalakhirpemeriksaan',`st`.`tanggalAkhirPemeriksaan`) order by `pg`.`nama_pegawai` ASC separator ','),']') AS `detail_petugas` FROM (((((`penugasans` `p` join `jenis_pengawasans` `jp` on(`jp`.`id` = `p`.`id_jenisPengawasan`)) join `obriks` `o` on(`o`.`id` = `p`.`id_obrik`)) join `kegiatans` `k` on(`k`.`id` = `p`.`id_anggaran`)) join `surat_tugas` `st` on(`st`.`id_penugasan` = `p`.`id`)) join `pegawais` `pg` on(`pg`.`id` = `st`.`id_pegawai`)) GROUP BY `p`.`id`, `p`.`noSurat`, `p`.`tanggalTerbitPenugasan`, `jp`.`nama_jenispengawasan`, `o`.`nama_obrik`, `k`.`kegiatan``kegiatan`  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_demo7`
--
DROP TABLE IF EXISTS `v_demo7`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_demo7`  AS SELECT `p`.`id` AS `id`, `p`.`tanggalAwalPenugasan` AS `tanggalAwalPenugasan`, `p`.`tanggalAkhirPenugasan` AS `tanggalAkhirPenugasan`, `p`.`tanggalTerbitPenugasan` AS `tanggalTerbitPenugasan`, `jp`.`nama_jenispengawasan` AS `nama_jenispengawasan`, `o`.`nama_obrik` AS `nama_obrik`, `k`.`norek` AS `norek`, json_object('pptk_nama',`pptk`.`nama_pegawai`,'pptk_nip',`pptk`.`nip`) AS `pptk_info`, group_concat(`pg`.`nama_pegawai` order by `pg`.`nama_pegawai` ASC separator '@@ ') AS `daftar_pegawai`, concat('[',group_concat(json_object('namapegawai',`pg`.`nama_pegawai`,'peran',`pr`.`nama_peran`,'tarif',`pr`.`tarif`,'Hari',to_days(`st`.`tanggalAkhirPemeriksaan`) - to_days(`st`.`tanggalAwalPemeriksaan`),'Jumlah',(to_days(`st`.`tanggalAkhirPemeriksaan`) - to_days(`st`.`tanggalAwalPemeriksaan`)) * `pr`.`tarif`,'Rekening',`pg`.`rekening_pegawai`,'tanggalPemeriksaanAwal',`st`.`tanggalAwalPemeriksaan`,'tanggalPemeriksaanAkhir',`st`.`tanggalAkhirPemeriksaan`) order by `pr`.`id` ASC separator ','),']') AS `detail_petugas` FROM (((((((`penugasans` `p` join `jenis_pengawasans` `jp` on(`jp`.`id` = `p`.`id_jenisPengawasan`)) join `obriks` `o` on(`o`.`id` = `p`.`id_obrik`)) join `kegiatans` `k` on(`k`.`id` = `p`.`id_anggaran`)) left join `pegawais` `pptk` on(`pptk`.`id` = `k`.`id_pptk`)) join `surat_tugas` `st` on(`st`.`id_penugasan` = `p`.`id`)) join `pegawais` `pg` on(`pg`.`id` = `st`.`id_pegawai`)) join `perans` `pr` on(`pr`.`id` = `st`.`id_peran`)) GROUP BY `p`.`id`, `p`.`noSurat`, `p`.`tanggalAwalPenugasan`, `p`.`tanggalAkhirPenugasan`, `p`.`tanggalTerbitPenugasan`, `jp`.`nama_jenispengawasan`, `o`.`nama_obrik`, `k`.`norek`, `pptk`.`nama_pegawai`, `pptk`.`nip``nip`  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_demo8`
--
DROP TABLE IF EXISTS `v_demo8`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_demo8`  AS SELECT `p`.`id` AS `id`, `p`.`noSurat` AS `noSurat`, `p`.`tanggalTerbitPenugasan` AS `tanggalTerbitPenugasan`, `jp`.`nama_jenispengawasan` AS `nama_jenispengawasan`, `o`.`nama_obrik` AS `nama_obrik`, `k`.`kegiatan` AS `kegiatan`, group_concat(`pg`.`nama_pegawai` order by `pg`.`nama_pegawai` ASC separator '@@ ') AS `daftar_pegawai`, concat('[',group_concat(json_object('namapegawai',`pg`.`nama_pegawai`,'nip',`pg`.`nip`,'pangkat',`pangkat`.`nama_pangkat`,'jabatan',`jabatan`.`nama_jabatan`,'peran',`pr`.`nama_peran`,'tarif',`pr`.`tarif`,'Hari',to_days(`st`.`tanggalAkhirPemeriksaan`) - to_days(`st`.`tanggalAwalPemeriksaan`),'Jumlah',(to_days(`st`.`tanggalAkhirPemeriksaan`) - to_days(`st`.`tanggalAwalPemeriksaan`)) * `pr`.`tarif`,'Rekening',`pg`.`rekening_pegawai`,'tanggalPemeriksaanAwal',`st`.`tanggalAwalPemeriksaan`,'tanggalPemeriksaanAkhir',`st`.`tanggalAkhirPemeriksaan`) order by `pr`.`id` ASC separator ','),']') AS `detail_petugas` FROM ((((((((`penugasans` `p` join `jenis_pengawasans` `jp` on(`jp`.`id` = `p`.`id_jenisPengawasan`)) join `obriks` `o` on(`o`.`id` = `p`.`id_obrik`)) join `kegiatans` `k` on(`k`.`id` = `p`.`id_anggaran`)) join `surat_tugas` `st` on(`st`.`id_penugasan` = `p`.`id`)) join `perans` `pr` on(`pr`.`id` = `st`.`id_peran`)) join `pegawais` `pg` on(`pg`.`id` = `st`.`id_pegawai`)) left join `pangkats` `pangkat` on(`pangkat`.`id` = `pg`.`id_pangkat`)) left join `jabatans` `jabatan` on(`jabatan`.`id` = `pg`.`id_jabatan`)) GROUP BY `p`.`id`, `p`.`noSurat`, `p`.`tanggalTerbitPenugasan`, `jp`.`nama_jenispengawasan`, `o`.`nama_obrik`, `k`.`kegiatan``kegiatan`  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_tl1`
--
DROP TABLE IF EXISTS `v_tl1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tl1`  AS SELECT `pt`.`id` AS `id`, `pt`.`tglkeluar` AS `tglkeluar`, `pt`.`status_LHP` AS `status_LHP`, `pt`.`tipe` AS `tipe`, `pt`.`jenis` AS `jenis`, `pt`.`wilayah` AS `wilayah`, `pt`.`pemeriksa` AS `pemeriksa`, `p`.`noSurat` AS `noSurat`, `p`.`id` AS `id_penugasan`, `p`.`tanggalAwalPenugasan` AS `tanggalAwalPenugasan`, `p`.`tanggalAkhirPenugasan` AS `tanggalAkhirPenugasan`, `jp`.`nama_jenispengawasan` AS `nama_jenispengawasan`, `o`.`nama_obrik` AS `nama_obrik` FROM (((`pengawasans` `pt` join `penugasans` `p` on(`p`.`id` = `pt`.`id_penugasan`)) join `obriks` `o` on(`o`.`id` = `p`.`id_obrik`)) join `jenis_pengawasans` `jp` on(`jp`.`id` = `p`.`id_jenisPengawasan`)) GROUP BY `pt`.`id`, `jp`.`nama_jenispengawasan`, `o`.`nama_obrik``nama_obrik`  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_tl2`
--
DROP TABLE IF EXISTS `v_tl2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tl2`  AS SELECT `pt`.`id` AS `id`, `pt`.`tglkeluar` AS `tglkeluar`, `pt`.`status_LHP` AS `status_LHP`, `pt`.`tipe` AS `tipe`, `pt`.`jenis` AS `jenis`, `pt`.`wilayah` AS `wilayah`, `pt`.`pemeriksa` AS `pemeriksa`, `p`.`noSurat` AS `noSurat`, `p`.`id` AS `id_penugasan`, `p`.`tanggalAwalPenugasan` AS `tanggalAwalPenugasan`, `p`.`tanggalAkhirPenugasan` AS `tanggalAkhirPenugasan`, `jp`.`nama_jenispengawasan` AS `nama_jenispengawasan`, `o`.`nama_obrik` AS `nama_obrik`, group_concat(`jt`.`rekomendasi` order by `jt`.`id` ASC separator '@@ ') AS `daftar_rekom`, concat('[',group_concat(json_object('kode_rekomendasi',`jt`.`kode_rekomendasi`,'rekomendasi',`jt`.`rekomendasi`,'keterangan',`jt`.`keterangan`,'pengembalian',`jt`.`pengembalian`) order by `jt`.`id_parent` ASC separator ','),']') AS `detail_rekom` FROM ((((`jenis_temuans` `jt` join `penugasans` `p` on(`jt`.`id_penugasan` = `p`.`id`)) join `obriks` `o` on(`o`.`id` = `p`.`id_obrik`)) join `jenis_pengawasans` `jp` on(`jp`.`id` = `p`.`id_jenisPengawasan`)) join `pengawasans` `pt` on(`jt`.`id_pengawasan` = `pt`.`id`))  ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jenis_temuans`
--
ALTER TABLE `jenis_temuans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kegiatans`
--
ALTER TABLE `kegiatans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengawasans`
--
ALTER TABLE `pengawasans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jenis_temuans`
--
ALTER TABLE `jenis_temuans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `kegiatans`
--
ALTER TABLE `kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pengawasans`
--
ALTER TABLE `pengawasans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
