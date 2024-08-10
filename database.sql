-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Agu 2024 pada 19.45
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_laura`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `busana`
--

CREATE TABLE `busana` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_busana` varchar(255) NOT NULL,
  `upahPcs` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `busana`
--

INSERT INTO `busana` (`id`, `jenis_busana`, `upahPcs`, `created_at`, `updated_at`) VALUES
(3, 'jas', 25000, '2024-03-24 16:11:10', '2024-03-24 16:11:19'),
(4, 'kemeja', 20000, '2024-04-24 02:29:25', '2024-04-24 02:29:25'),
(5, 'celanan', 3000, '2024-04-24 02:30:09', '2024-04-24 02:30:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `nama_pcs` varchar(255) NOT NULL,
  `panjang_lengan` double NOT NULL,
  `lingkar_dada` double NOT NULL,
  `lingkar_pinggang` double NOT NULL,
  `panjang_baju` double NOT NULL,
  `lingkar_lengan` double NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_pengganti` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'belum selesai',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id`, `id_pesanan`, `nama_pcs`, `panjang_lengan`, `lingkar_dada`, `lingkar_pinggang`, `panjang_baju`, `lingkar_lengan`, `id_karyawan`, `id_pengganti`, `status`, `created_at`, `updated_at`) VALUES
(11, 3, 'jaji', 1, 1, 1, 1, 1, 2, NULL, 'selesai', '2024-04-28 09:39:39', '2024-04-28 10:19:51'),
(12, 3, 'onco', 1, 1, 1, 1, 1, 4, NULL, 'selesai', '2024-04-28 09:39:56', '2024-04-28 09:41:02'),
(13, 3, 'gugun', 2, 2, 2, 2, 2, 4, NULL, 'selesai', '2024-04-28 23:27:11', '2024-04-28 23:55:11'),
(14, 3, 'dadan', 3, 3, 3, 3, 3, 2, NULL, 'selesai', '2024-04-28 23:45:30', '2024-04-28 23:55:00'),
(15, 4, 'bani', 1, 1, 11, 1, 1, 4, NULL, 'selesai', '2024-05-02 19:07:18', '2024-05-02 19:10:01'),
(16, 4, 'dodi', 1, 1, 1, 1, 1, 2, NULL, 'selesai', '2024-05-02 19:08:11', '2024-05-02 19:09:22'),
(18, 5, 'siti', 8, 8, 8, 8, 8, 4, NULL, 'selesai', '2024-05-27 03:05:41', '2024-05-27 03:08:21'),
(21, 3, 'dendi', 10, 5, 7, 8, 11, 6, NULL, 'selesai', '2024-06-17 11:40:07', '2024-07-08 16:54:33'),
(23, 4, 'andre', 4, 3, 2, 2, 2, 2, NULL, 'selesai', '2024-07-08 06:56:18', '2024-07-08 14:17:36'),
(24, 3, 'rri', 3, 2, 12, 2, 2, 4, NULL, 'selesai', '2024-07-08 15:12:37', '2024-07-08 16:47:57'),
(25, 3, 'dandi', 9, 2, 2, 2, 2, 6, NULL, 'selesai', '2024-07-11 04:39:44', '2024-07-13 05:50:36'),
(26, 3, 'daril', 2, 1, 3, 4, 5, 4, NULL, 'selesai', '2024-07-11 05:44:57', '2024-07-13 10:21:10'),
(27, 3, 'sinta', 2, 4, 5, 2, 2, 6, NULL, 'belum selesai', '2024-07-11 05:45:15', '2024-07-11 05:45:15'),
(28, 3, 'bb', 2, 2, 2, 2, 2, 4, NULL, 'lepas', '2024-07-13 10:21:50', '2024-07-13 10:22:07');

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
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `nama_kry` varchar(255) NOT NULL,
  `alamat_kry` varchar(255) NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id`, `id_user`, `nama_kry`, `alamat_kry`, `no_tlp`, `created_at`, `updated_at`) VALUES
(4, 4, 'nurvian', 'bandung', '+6285655565857', '2024-04-28 01:14:28', '2024-04-28 01:14:28'),
(6, 9, 'genduk', 'tuban', '081283170307', '2024-06-11 05:40:22', '2024-06-11 05:40:22');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_02_28_181101_create_users_table', 2),
(6, '2024_03_08_090413_create_table_karyawan', 3),
(7, '2024_03_12_142344_create_table_busana', 4),
(8, '2024_03_26_091153_create_pesanan', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `nama_pemesan` varchar(50) NOT NULL,
  `id_busana` int(11) NOT NULL,
  `jumlah` double NOT NULL,
  `tgl_pengambilan` date NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'proses',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `nama_pemesan`, `id_busana`, `jumlah`, `tgl_pengambilan`, `status`, `created_at`, `updated_at`) VALUES
(3, 'maul', 4, 10, '2024-04-16', 'proses', '2024-04-28 09:39:27', '2024-04-28 09:39:27'),
(4, 'egi', 5, 4, '2024-05-29', 'proses', '2024-05-02 19:06:46', '2024-05-02 19:06:46'),
(5, 'ongki', 3, 14, '2024-06-10', 'terlambat', '2024-05-27 03:05:08', '2024-07-07 17:41:25'),
(7, 'nnn', 3, 7, '2024-07-10', 'proses', '2024-07-08 20:07:14', '2024-07-08 20:07:14');

--
-- Trigger `pesanan`
--
DELIMITER $$
CREATE TRIGGER `delete_detail_pesanan` AFTER DELETE ON `pesanan` FOR EACH ROW DELETE FROM detail_pesanan
WHERE id_pesanan = old.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap_gaji`
--

CREATE TABLE `rekap_gaji` (
  `id` int(11) NOT NULL,
  `id_karyawan_gaji` int(11) NOT NULL,
  `jumlah_upah` double NOT NULL,
  `jumlah_jahit` double NOT NULL,
  `tahun_gaji` int(11) NOT NULL,
  `bulan_gaji` tinyint(4) NOT NULL,
  `minggu_gaji` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekap_gaji`
--

INSERT INTO `rekap_gaji` (`id`, `id_karyawan_gaji`, `jumlah_upah`, `jumlah_jahit`, `tahun_gaji`, `bulan_gaji`, `minggu_gaji`, `created_at`, `updated_at`) VALUES
(9, 2, 70000, 3, 2024, 4, 4, '2024-06-16 19:44:28', '2024-06-16 19:44:28'),
(10, 4, 45000, 2, 2024, 4, 4, '2024-06-16 19:54:30', '2024-06-16 19:54:30'),
(11, 2, 6000, 2, 2024, 5, 1, '2024-06-17 07:46:14', '2024-06-17 07:46:14'),
(14, 4, 25000, 1, 2024, 5, 4, '2024-06-17 08:02:38', '2024-06-17 08:02:38'),
(18, 2, 25000, 1, 2024, 5, 4, '2024-06-17 08:20:08', '2024-06-17 08:20:08'),
(19, 2, 40000, 2, 2024, 4, 5, '2024-07-08 06:31:54', '2024-07-08 06:31:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap_jahitan`
--

CREATE TABLE `rekap_jahitan` (
  `id` int(11) NOT NULL,
  `id_detail` int(11) NOT NULL,
  `id_pengerja` int(11) NOT NULL,
  `id_busana` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekap_jahitan`
--

INSERT INTO `rekap_jahitan` (`id`, `id_detail`, `id_pengerja`, `id_busana`, `status`, `created_at`, `updated_at`) VALUES
(18, 21, 6, 4, 'dikonfirmasi', '2024-07-08 15:48:45', '2024-07-08 16:57:13'),
(19, 24, 6, 4, 'disetujui', '2024-07-08 15:49:36', '2024-07-08 16:28:15'),
(20, 24, 6, 4, 'dikonfirmasi', '2024-07-08 16:34:14', '2024-07-08 17:40:17'),
(21, 25, 6, 4, 'dikonfirmasi', '2024-07-13 05:49:48', '2024-07-13 05:50:36'),
(22, 26, 4, 4, 'dikonfirmasi', '2024-07-13 10:20:50', '2024-07-13 10:21:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'nurvian', 'nurvian@gmail.com', NULL, '$2y$12$pAI4MLMW7mavR6xP8sAcburyTs0wRGIpZlw3u/9SuRRMUHIv2QBfK', 'karyawan', NULL, '2024-04-28 00:47:27', '2024-04-28 00:47:27'),
(5, 'dewi', 'dewi@gmail.com', NULL, '$2y$12$CljYJWXEWZTxxPBCrfUBkubHQNYDPWbTOp.M8Sj7wjLnE3Nj2p5MG', 'admin', NULL, '2024-05-27 02:54:10', '2024-05-27 02:54:10'),
(8, 'laura', 'laura@gmail.com', NULL, '$2y$12$8ZqycsO4ooF70bydVrslze2oLSqqeTiE3Dvz6wg/.HtdnTubM9XiC', 'pemilik', NULL, '2024-05-27 02:56:55', '2024-05-27 02:56:55'),
(9, 'genduk', 'genduk@gmail.com', NULL, '$2y$12$M9MavnBMr/oYZ6RQstZ4lukFrN2PexBJ4q2p1yOodHPY2XXm7nRHO', 'karyawan', NULL, '2024-06-11 05:39:58', '2024-06-11 05:39:58');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `busana`
--
ALTER TABLE `busana`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_busana` (`id_busana`);

--
-- Indeks untuk tabel `rekap_gaji`
--
ALTER TABLE `rekap_gaji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_karyawan_gaji` (`id_karyawan_gaji`);

--
-- Indeks untuk tabel `rekap_jahitan`
--
ALTER TABLE `rekap_jahitan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_detail` (`id_detail`),
  ADD KEY `id_pengerja` (`id_pengerja`,`id_busana`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `busana`
--
ALTER TABLE `busana`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `rekap_gaji`
--
ALTER TABLE `rekap_gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `rekap_jahitan`
--
ALTER TABLE `rekap_jahitan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
