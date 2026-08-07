-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Agu 2026 pada 03.06
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `portfolio_cms`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `about`
--

CREATE TABLE `about` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `birth_date` varchar(50) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `about`
--

INSERT INTO `about` (`id`, `photo`, `title`, `description`, `birth_date`, `location`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, '20260807-084717-f0ef03.jpg', 'UI/UX Designer & Web Developer', 'I am a passionate developer who loves creating elegant and functional web solutions.', '2003-09-02', 'Jakarta, Indonesia', 'azissetiawan0813@gmail.com', '081388401904', '2026-08-04 05:57:00', '2026-08-07 01:47:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `certificates`
--

CREATE TABLE `certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `issuer` varchar(255) DEFAULT NULL,
  `issue_date` varchar(50) DEFAULT NULL,
  `credential_id` varchar(255) DEFAULT NULL,
  `credential_url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `certificates`
--

INSERT INTO `certificates` (`id`, `title`, `issuer`, `issue_date`, `credential_id`, `credential_url`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'SQL & Database Fundamentals', 'Dicoding', '', '', 'https://www.simplilearn.com/ice9/skillupcertificates/Introduction_to_SQL.png', '20260807-084106-4b80e0.png', 1, '2026-08-07 01:39:55', '2026-08-07 01:41:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `education`
--

CREATE TABLE `education` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institution` varchar(255) NOT NULL,
  `degree` varchar(200) NOT NULL,
  `start_year` varchar(20) DEFAULT NULL,
  `end_year` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `education`
--

INSERT INTO `education` (`id`, `institution`, `degree`, `start_year`, `end_year`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'SMA N 43 Jakarta', 'None', '2018', '2021', 'Selama menempuh pendidikan di tingkat SMA, saya membangun dasar kemampuan berpikir kritis, kerja sama tim, dan pemecahan masalah. Pengalaman belajar ini menjadi fondasi untuk mengembangkan minat saya di bidang teknologi dan pengembangan perangkat lunak.', 1, '2026-08-04 06:44:37', '2026-08-07 01:29:48'),
(3, 'Universitas Indraprasta PGRI', 'S1', '2021', '2025', 'Menempuh pendidikan di bidang [Nama Jurusan] dengan fokus pada pengembangan perangkat lunak, pemrograman, basis data, analisis sistem, dan teknologi web. Selama perkuliahan, saya mengerjakan berbagai proyek yang membantu meningkatkan kemampuan dalam membangun aplikasi menggunakan PHP, MySQL, JavaScript, dan Bootstrap, serta memahami praktik pengembangan perangkat lunak yang baik.', 2, '2026-08-06 07:18:24', '2026-08-07 01:30:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `experience`
--

CREATE TABLE `experience` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company` varchar(255) NOT NULL,
  `position` varchar(200) NOT NULL,
  `start_date` varchar(50) DEFAULT NULL,
  `end_date` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `experience`
--

INSERT INTO `experience` (`id`, `company`, `position`, `start_date`, `end_date`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Freelance Web Developer', 'FullStack', '2025-01', '2026-08', 'Membuat website portfolio.\r\nMembangun sistem CRUD menggunakan PHP Native.\r\nMendesain UI responsive menggunakan Bootstrap.\r\nIntegrasi database MySQL.\r\nVersion control menggunakan Git & GitHub.', 1, '2026-08-06 08:07:33', '2026-08-06 08:07:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hero`
--

CREATE TABLE `hero` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `greeting` varchar(150) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `profession` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `hero_image` varchar(255) DEFAULT NULL,
  `button1_text` varchar(100) DEFAULT NULL,
  `button1_link` varchar(255) DEFAULT NULL,
  `button2_text` varchar(100) DEFAULT NULL,
  `button2_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `hero`
--

INSERT INTO `hero` (`id`, `greeting`, `title`, `profession`, `description`, `hero_image`, `button1_text`, `button1_link`, `button2_text`, `button2_link`, `created_at`, `updated_at`) VALUES
(1, 'Hello, I am', 'Azis Setiawan', 'Full-Stack Developer', 'Saya adalah Web Developer yang berfokus pada pengembangan website modern, cepat, responsif, dan mudah dikelola menggunakan PHP, MySQL, Bootstrap, dan JavaScript.', '20260807-084655-c9206f.jpg', 'Instagram', 'https://instagram.com/stywanjis', 'Youtube', 'https://www.youtube.com/@stywanjis', '2026-08-04 05:57:00', '2026-08-07 01:46:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `message`, `is_read`, `created_at`) VALUES
(1, 'Baskom', 'baskom@gmail.com', 'tes', 'ini meassage', 1, '2026-08-04 06:45:48'),
(2, 'Baskom', 'baskom@gmail.com', 'tes2', 'ini message asdasdasads', 1, '2026-08-04 07:46:59'),
(3, 'belajar web', 'belajarwebuhuy@gmail.com', 'subject', 'messageeeee', 1, '2026-08-07 01:33:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `tech_stack` text DEFAULT NULL,
  `github_url` varchar(255) DEFAULT NULL,
  `demo_url` varchar(255) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT 0,
  `status` enum('draft','published') DEFAULT 'draft',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `projects`
--

INSERT INTO `projects` (`id`, `title`, `slug`, `thumbnail`, `short_description`, `description`, `tech_stack`, `github_url`, `demo_url`, `featured`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Portfolio CMS', 'Portfolio CMS', '20260807-082638-c1b8db.png', 'Website CMS untuk mengelola seluruh isi portfolio tanpa perlu mengubah kode.', 'Portfolio CMS adalah aplikasi web yang dirancang untuk memudahkan pengguna dalam mengelola seluruh konten website portofolio melalui dashboard admin. Seluruh data seperti profil, pengalaman kerja, pendidikan, keterampilan, proyek, sertifikat, hingga artikel blog dapat ditambahkan, diperbarui, maupun dihapus tanpa perlu mengubah kode program secara langsung. Sistem ini mengutamakan kemudahan penggunaan, keamanan autentikasi, serta tampilan yang modern dan responsif sehingga dapat diakses dengan baik di berbagai perangkat.', 'PHP Native, MySQL, Bootstrap, JavaScript', 'https://github.com/belajarwebuhuy-coder/portofolio', 'https://github.com/belajarwebuhuy-coder/portofolio', 0, 'published', '2026-08-05 03:14:14', '2026-08-07 01:28:44'),
(2, 'Inventory Management System', 'inventory-management-system', '20260807-082815-fd6427.png', 'Sistem manajemen inventaris berbasis web.', 'Inventory Management System merupakan aplikasi berbasis web yang membantu proses pencatatan dan pengelolaan data inventaris secara digital. Sistem ini memungkinkan administrator untuk mengelola data barang, kategori, pemasok, serta memantau stok secara lebih efisien. Dengan proses yang terkomputerisasi, risiko kesalahan pencatatan dapat dikurangi dan informasi inventaris dapat diakses dengan cepat melalui dashboard.', 'PHP, Native, MySQL, Bootstrap, JavaScript', 'https://inventrastock.vercel.app/', '', 1, 'published', '2026-08-07 01:28:09', '2026-08-07 01:37:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `project_images`
--

CREATE TABLE `project_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `website_name` varchar(150) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `owner_name` varchar(150) DEFAULT NULL,
  `owner_profession` varchar(150) DEFAULT NULL,
  `owner_photo` varchar(255) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `x` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `meta_title` varchar(200) DEFAULT NULL,
  `meta_description` varchar(500) DEFAULT NULL,
  `google_verification` varchar(255) DEFAULT NULL,
  `default_dark_mode` tinyint(1) DEFAULT 0,
  `maintenance_mode` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `website_name`, `logo`, `favicon`, `owner_name`, `owner_profession`, `owner_photo`, `email`, `phone`, `address`, `github`, `linkedin`, `instagram`, `facebook`, `x`, `youtube`, `meta_title`, `meta_description`, `google_verification`, `default_dark_mode`, `maintenance_mode`, `created_at`, `updated_at`) VALUES
(1, 'Azis Portofolio', '20260807-081305-7a4d7e.jpg', '20260807-081305-6c1b01.jpg', 'Muhamad Azis Setiawan', 'Full-Stack Developer', '20260807-081305-6d3b5f.jpg', 'azissetiawan0813@gmail.com', '081388401904', 'Jakarta, Indonesia', '', '', '', '', '', '', 'Azis Portfolio', 'A modern personal portfolio built with PHP Native and MySQL', '', 1, 1, '2026-08-04 05:57:00', '2026-08-07 01:31:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `percentage` int(11) NOT NULL DEFAULT 0,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `skills`
--

INSERT INTO `skills` (`id`, `name`, `percentage`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'HTML', 80, 20, '2026-08-04 06:42:50', '2026-08-04 06:43:00'),
(2, 'CSS', 80, 0, '2026-08-07 01:22:05', '2026-08-07 01:22:05'),
(3, 'JavaScript', 60, 0, '2026-08-07 01:22:16', '2026-08-07 01:22:16'),
(4, 'PHP Native', 70, 0, '2026-08-07 01:22:25', '2026-08-07 01:22:25'),
(5, 'MySQL', 85, 0, '2026-08-07 01:22:35', '2026-08-07 01:22:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', '$2y$10$ua8i2Whz6cZJITjUfLra1.haMMkdNZNobFRN5oBXz0r0PTX011EUK', '20260807-081944-d8ca8e.jpg', '2026-08-04 05:57:00', '2026-08-07 01:19:44');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_blogs_status` (`status`);

--
-- Indeks untuk tabel `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hero`
--
ALTER TABLE `hero`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_messages_is_read` (`is_read`);

--
-- Indeks untuk tabel `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_projects_status` (`status`),
  ADD KEY `idx_projects_featured` (`featured`);

--
-- Indeks untuk tabel `project_images`
--
ALTER TABLE `project_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_project_images_project` (`project_id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `about`
--
ALTER TABLE `about`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `education`
--
ALTER TABLE `education`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `experience`
--
ALTER TABLE `experience`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `hero`
--
ALTER TABLE `hero`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `project_images`
--
ALTER TABLE `project_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `project_images`
--
ALTER TABLE `project_images`
  ADD CONSTRAINT `fk_project_images_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
