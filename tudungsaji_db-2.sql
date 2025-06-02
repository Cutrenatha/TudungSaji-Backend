-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 02 Jun 2025 pada 07.05
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tudungsaji_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `favorit_resep`
--

CREATE TABLE `favorit_resep` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `resep_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `favorit_resep`
--

INSERT INTO `favorit_resep` (`id`, `user_id`, `resep_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '2025-05-31 20:14:39', '2025-05-31 20:14:39'),
(2, 5, 1, '2025-06-01 07:08:16', '2025-06-01 07:08:16'),
(3, 9, 6, '2025-06-01 22:01:29', '2025-06-01 22:01:29'),
(5, 9, 4, '2025-06-01 22:01:32', '2025-06-01 22:01:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_31_063638_create_favorits_table', 2),
(5, '2025_05_31_073118_create_reseps_table', 3),
(6, '2025_05_31_165623_create_favorit_resep_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reseps`
--

CREATE TABLE `reseps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `porsi` varchar(255) DEFAULT NULL,
  `lama_memasak` varchar(255) DEFAULT NULL,
  `bahan_bahan` longtext CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `langkah_memasak` longtext CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `reseps`
--

INSERT INTO `reseps` (`id`, `user_id`, `judul`, `deskripsi`, `gambar`, `porsi`, `lama_memasak`, `bahan_bahan`, `langkah_memasak`, `created_at`, `updated_at`) VALUES
(1, 4, 'Soto Ayam Bandung', 'Edisi soto rumahan tapi enak', 'resep-images/TqahiU2Le98vhDo1B1rOuaRpMlq1L353EvLnfrCc.jpg', '10 orang', '1 jam', '[\"500 gram ayam\",\"250 gram ceker\",\"3 lembar daun salam\",\"3 lembar daun jeruk\",\"2 batang serai (geprek)\",\"1 buah tomat (potong sedang)\",\"2 ons daun bawang + seledri (potong 1\\/2 cm)\",\"6 cm lengkuas (geprek)\",\"2 liter air\",\"5 sdm minyak (untuk menumis bumbu)\",\"Garam secukupnya\",\"Gula secukupnya\",\"Secukupnya penyedap ra\"]', '[\"Rebus 1 liter air masukkan ayam dan ceker kurang lebih 10mnt, sisihkan air nya untuk kuah soto\",\"Haluskan bumbu tambahkan serai geprek daun jeruk dan lengkuas geprek\",\"Panaskan minyak, tumis bumbu sampai harum, matikan api\",\"Iris2 tomat dan juga daun bawang sledri sisihkan\",\"Siapkan panci, panaskan 1 liter air dan tambahkan air rebusan ayam tadi masukkan ceker, tuang bumbu yang sudah di tumis ke dalam panci, tambahkan daun salam, gula, garam dan penyedap rasa, tunggu hingga mendidih, masukkan daun bawang dan tomat, koreksi rasa, setelah pas, matikan api, beri bawang goreng\",\"Masukkan ayam yang di rebus tadi ke dalam air garam, goreng sampai kecoklatan, suwir(iris2), siapkan taoge jeruk nipis bawang goreng (bawang gorengnya g keliatan masih di toples) sambal kecapnya jangan lupa dan juga krupuk udang, racik sendiri ya sotonya\",\"Selamat memasak untuk keluarga tercinta\"]', '2025-05-31 20:07:32', '2025-05-31 20:07:32'),
(2, 5, 'Ayam Bakar Padang', '\"Ayam Bakar Padang adalah hidangan khas Minang yang kaya rempah, menggunakan ayam yang dimasak terlebih dahulu dalam bumbu rendang lalu dibakar hingga harum dan berkulit kecokelatan. Cita rasanya pedas gurih dengan aroma asap yang menggugah selera.\"', 'resep-images/8DRsdGqTSq2fuyWQuB6Bi1z7ySU5s9ZyI0cCB6Aw.jpg', '2 orang', '30 menit', '[\"1 kg ayam potong menjadi 15\",\"Secukupnya santan kental\",\"1 lbr daun kunyit disimpulkan\",\"2 lbr daun salam\",\"4 lbr daun jeruk\",\"2 batang serai\",\"Secukup nya gram dan penyedap\",\"1 ons cabe merah keriting\",\"10 buah biji rawit merah\",\"5 siung bawang putih\",\"4 siung bawang putih\",\"1 sdm ketumbar\",\"3 buah kemirI\",\"1 ruas jari jahe\",\"1 ruas jari kunyit\",\"1 ruas jari laos\"]', '[\"Potong ayam cuci bersih sisihkan\",\"Masukkan santan, ayam, bumbu halus, daun_daunan dan serai sambil diaduk sampai mendidih.\",\"Masukkan garam dan penyedap, masak sampai bumbu mengering dan meresap\",\"Bakar ayam sambil dioles bumbu. Angkat dan sajikan.\"]', '2025-06-01 06:59:53', '2025-06-01 06:59:53'),
(3, 6, 'Sayur Lodeh Sederhana', 'Sayur Lodeh adalah masakan tradisional Indonesia berupa sayur-sayuran yang dimasak dalam kuah santan gurih dan kaya rempah.', 'resep-images/zQepekeAibBKcMSDJlB9d2Y1w7jG048hyLBL4FJx.jpg', '4-5 orang', '30 menit', '[\"1 buah Wortel\",\"2 buah Labu siam lejet\",\"100 gram Kacang panjang\",\"1\\/2 papan tempe\",\"1\\/2 potong jagung manis\",\"3 siung bawang putih\",\"3 siung bawang merah\",\"Kemiri\",\"1\\/2 sdt lada bubuk\",\"Daun Salam\",\"Minyak untuk menumis\",\"1 bungkus santan instan\"]', '[\"Potong semua sayuran lalu cuci dan tiriskan\",\"Haluskan bumbu yang sudah disiapkan\",\"Panaskan minyak lalu tumis bumbu halus bersama dengan daun salam. Masak sampai bumbu harum\",\"Setelah bumbu harum, tambahkan air lalu masukan satu persatu sayuran yang sudah di cuci.\",\"Masukan wortel, tunggu sampai setangah matang lalu masukan labu, tunggu sampai setengah matang, lalu masukan jagung tempe dan kacang panjang\",\"Tambahkan garam, penyedap dan gula putih. Koreksi rasa\",\"Setelah air mendidih, masukan santan instan lalu aduk lagi\",\"Setelah mendidih, lalu matikan kompor.\",\"Sayur lodeh sederhana siap disantap\"]', '2025-06-01 07:24:21', '2025-06-01 07:24:21'),
(4, 7, 'Kentang Goreng', 'Kentang Goreng', 'resep-images/4vsvKmSMrwWcyigNjysUfoq7NbNpITDzK4lSGt9d.jpg', '2 orang', '30 menit', '[\"2 bh Kentang (potong bentuk stick)\",\"500 ml Minyak Goreng Rose Brand\",\"3 btr Bawang Putih Geprek\",\"1 ltr Air\",\"1 sdt Garam\",\"3 btr Bawang Putih Geprek\"]', '[\"Siapkan Bahan\",\"Siapkan panci. Masukkan air, garam, kaldu jamur dan bawang putih masak sampai mendidih lalu masukkan kentang masak 7 menit matikan api tiriskan airnya.\",\"Campurkan bahan pelapis, lalu masukkan ke mangkok yg berisi kentang shake seperti video.\",\"Panaskan Minyak Goreng Rose Brand. Lalu masukkan kentang, Goreng kentang hingga terasa mengeras kalo diaduk. Angkat lalu tiriskan minyaknya.\",\"French Fries siap dinikmati dengan saus sambal.\"]', '2025-06-01 07:30:07', '2025-06-01 07:30:07'),
(5, 8, 'Pisang Goreng', 'Pisang Goreng adalah camilan tradisional Indonesia yang terbuat dari pisang matang yang dibalut adonan tepung, lalu digoreng hingga keemasan', 'resep-images/NVUuSenW8jhSD7YkW8r7ezJLfVzEWpwy3nPXdefN.jpg', '3 orang', '30 menit', '[\"1 sisir pisang kepok\",\"1 bungkus tepung serbaguna pisang goreng\",\"2 sdm tepung beras rosebrand\",\"Secukupnya air\",\"Secukulnya taburan gula palem\"]', '[\"Siapkan pisang kepok lalu belah dua bagian\",\"Campur tepung serbaguna pisang giteng dan tambahkan tepung beras rosebrand untum hasil lebih renyah\",\"Celupkan pisang kedalam adonan tepung aduk perlahan hingga semua bagian terselimuti goreng hingga berwarna kekuningan\",\"Angkat dan tiriskan taburi dengan gula palem diatasnya\"]', '2025-06-01 07:35:10', '2025-06-01 07:35:10'),
(6, 9, 'ice matcha', 'matcha rumahan', 'resep-images/uLCts7wyHxrPWMN1jvQXHaKfu6g86WM4TtOqQiyS.jpg', '1 porsi', '10 menit', '[\"bubuk match\",\"susu\",\"air hangat\"]', '[\"larutkan matcha dalam air hangat\",\"aduk dengan teknik m selama 20 detik\",\"siapkan gelas yg berisikan susu dan ice\",\"lalu tambahkan matcha yang sudah larut ke dalam susu\"]', '2025-06-01 22:00:03', '2025-06-01 22:00:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('jSTBjVa3eTSQAOXCDBX1hEQk62WkFfDI6IHNKYXj', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.4 Safari/605.1.15', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicXFWa2xzUm1XaWpTOHVlRmpuUklYbUt4YlVJZk5tdUx2N3JwWmJLNiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9sb2dpbiI7fX0=', 1748840557);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `gender`, `alamat`, `telepon`, `tanggal_lahir`, `lokasi`, `kode_pos`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Raysha', 'Tazkiya', 'kiyaa', NULL, 'jln.nyak adam kamil', '0876543218', '2000-04-19', 'tapaktuan', '23717', 'kiya@gmail.com', NULL, '$2y$12$CRUUO43qixOsDROv0GeyvOQTr4NNYM5M6asuPKJJmv58oBN4hYHI.', NULL, '2025-05-31 09:47:47', '2025-05-31 20:26:13'),
(5, 'Cut', 'Renatha', 'Renatha', NULL, 'JL IR MOHD TAHER LR LHOK PINTAH', '081269668090', '2005-06-10', 'Banda Aceh', '23246', 'cutrenathaf@gmail.com', NULL, '$2y$12$jXT2cFIKtxrhiipyt4S2P.QEsaAK7QXm/AP.23Uw2AHijIKnHE/gW', NULL, '2025-06-01 06:47:36', '2025-06-01 07:06:27'),
(6, 'Nurul', 'Izzati', 'nurul', NULL, 'Lhoknga', '081269668090', '2005-06-18', 'Aceh Besar', '23246', 'nurul@gmail.com', NULL, '$2y$12$xOA9/bw9wiaes8guC.aQrO8AtxHBRjTft3H9tbeyK4zMMyhcLVDO.', NULL, '2025-06-01 07:09:19', '2025-06-01 07:10:40'),
(7, 'Yuyun', 'Nailufar', 'Yuyun', NULL, NULL, NULL, NULL, NULL, NULL, 'Yuyun@gmail.com', NULL, '$2y$12$VNjoL49u5s1zJQV5ulTPFuksI8VVjEeISPpUdcnJlBjaEhpwGQIvu', NULL, '2025-06-01 07:25:13', '2025-06-01 07:25:13'),
(8, 'Tinsari', 'Rauhana', 'titin', NULL, NULL, NULL, NULL, NULL, NULL, 'titin@gmail.com', NULL, '$2y$12$MNMdniEHnFXAsYSoI3O4be/0fN05u9VDweJP7xvch1E3p.ony.IcS', NULL, '2025-06-01 07:31:31', '2025-06-01 07:31:31'),
(9, 'Jessica', 'Jane', 'jane', NULL, 'Jln syiah kuala, no 3', '08521345678', '2000-06-04', 'Banda Aceh', '123456', 'jane@gmail.com', NULL, '$2y$12$BTB9mc/PtHYsSjoviLa97u9CsCsirBK5qwmgykZtg3DQxPX1G9dve', NULL, '2025-06-01 21:53:34', '2025-06-01 21:55:10');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `favorit_resep`
--
ALTER TABLE `favorit_resep`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorit_resep_user_id_foreign` (`user_id`),
  ADD KEY `favorit_resep_resep_id_foreign` (`resep_id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `reseps`
--
ALTER TABLE `reseps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reseps_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `favorit_resep`
--
ALTER TABLE `favorit_resep`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `reseps`
--
ALTER TABLE `reseps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `favorit_resep`
--
ALTER TABLE `favorit_resep`
  ADD CONSTRAINT `favorit_resep_resep_id_foreign` FOREIGN KEY (`resep_id`) REFERENCES `reseps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorit_resep_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `reseps`
--
ALTER TABLE `reseps`
  ADD CONSTRAINT `reseps_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
