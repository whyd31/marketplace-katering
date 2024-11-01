-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Nov 2024 pada 03.02
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cimahi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(16, 10, 14, 1, '2024-10-30 23:42:49', '2024-10-30 23:42:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `footers`
--

CREATE TABLE `footers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `maps` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `footers`
--

INSERT INTO `footers` (`id`, `name`, `slug`, `address`, `telephone`, `email`, `maps`, `created_at`, `updated_at`) VALUES
(2, 'Marketplace Katering', 'marketplace-katering', 'Jl. Baros Utama No.15, Utama, Cimahi Selatan, Cimah Jawa Barat - 40533', '0895-0358-8488', 'wahyudhinugroho31@gmail.com', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247.5604381762232!2d107.5377095320279!3d-6.894549434599949!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e5ade4aa0b8b%3A0x54ce67a74076ba9c!2sMesjid%20Al%20Muqorobbin!5e0!3m2!1sid!2sid!4v1730387255767!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '2022-02-08 01:21:42', '2024-10-31 08:09:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `image_properties`
--

CREATE TABLE `image_properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `image_properties`
--

INSERT INTO `image_properties` (`id`, `property`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(3, 'Banner', 'Banner Home', 'banner-home', 'image-property/gjulHep8hDquJhDwwexRSeFfX05gwTWmJtZN8rtp.jpg', '2022-02-08 08:15:22', '2024-10-31 08:02:40'),
(9, 'Logo', 'Logo Baru', 'logo-baru', 'image-property/j49DdovzKVCq7JC0tXKoufU28aqESP0n7mCG6mv2.png', '2022-02-25 09:08:13', '2024-10-31 08:00:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(12,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `total_price`, `created_at`, `updated_at`) VALUES
(35, 10, 13, 1, 150000, '2024-10-30 23:27:51', '2024-10-30 23:27:51'),
(36, 10, 16, 1, 200000, '2024-10-30 23:37:52', '2024-10-30 23:37:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga` decimal(12,0) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `deskripsi`, `harga`, `image`, `created_at`, `updated_at`) VALUES
(13, 11, 'Mie Dower', 'Mie Dower', 150000, 'image-product/JshawGokvwJLQVK4oXLejZmJCiGrwVpBCD0FUyKj.jpg', '2024-10-30 04:23:59', '2024-10-30 04:23:59'),
(14, 11, 'Ayam Geprek', 'Ayam geprek', 200000, 'image-product/u7s0gp9RM5HsHQ3E5NNDnorNIVznOlMa96JGV3SZ.jpg', '2024-10-30 04:30:47', '2024-10-30 04:30:47'),
(15, 11, 'Sambal', 'Sambal', 100000, 'image-product/i8DtqvgU6FIEIeZoomMeQSrbwvbjKMjyE7LAhnIU.jpg', '2024-10-30 04:49:04', '2024-10-30 05:12:59'),
(16, 12, 'Bakar Bakar', 'Bakar Bakar', 200000, 'image-product/0DGioAxGKkk9ExaRhKWDcHTb3DZvqyVwNAuTv0c0.jpg', '2024-10-30 23:21:06', '2024-10-30 23:21:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profils`
--

CREATE TABLE `profils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `link` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `profils`
--

INSERT INTO `profils` (`id`, `name`, `content`, `link`, `created_at`, `updated_at`) VALUES
(4, 'Marketplace Katering', 'Wahyudhi', '2024 © Sukses PKL', '2024-10-30 00:59:34', '2024-10-31 07:51:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` tinyint(3) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `no_hp` bigint(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `role`, `email`, `password`, `name`, `no_hp`, `alamat`, `image`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 2, 'admin@gmail.com', '$2y$10$AiZOHPXqCupZ1uyCtRGN5.MRXkqzTnHXVfr.6imFvGWxhkB2Mp2X6', 'Admin', 0, '', '', NULL, NULL, '2022-02-08 00:53:15', '2024-10-31 18:58:45'),
(2, 0, 'asmadi96@gmail.com', '$2y$10$p9H.uowRTEv4bsmWGzXQWe9f501.Uuse0f0M/vQbsSiNIomiKB4Nu', 'Ira Laksita', 0, '', '', '2022-02-08 00:53:16', 'gAVaycR57G', '2022-02-08 00:53:16', '2022-02-17 19:34:29'),
(3, 0, 'fsudiati@gmail.com', '$2y$10$59zStDUhNxXuozXLHc.LGe9tvYPV83yG4bQn7lmROjoCl0YTro.TG', 'Argono Slamet Pradipta S.Sos', 0, '', '', '2022-02-08 00:53:16', 'aR54JR8tJ9', '2022-02-08 00:53:16', '2022-02-17 19:34:44'),
(4, 0, 'farah32@gmail.com', '$2y$10$dnhdbDye8SPT9kQe/I1s.uAbc98cukrbf7.JRvN5AoQuHs.Yx8tpi', 'Hasta Mustofa S.Gz', 0, '', '', '2022-02-08 00:53:16', 'zBIKbenMsk', '2022-02-08 00:53:16', '2022-02-17 19:34:55'),
(5, 1, 'ella.prayoga@gmail.com', '$2y$10$s6HMEkw0IfxZ5ptoljiPx.zgObWtxGRjYceTfM1/HNeirklacmAdi', 'Yessi Pertiwi', 0, '', '', '2022-02-08 00:53:16', 'hBEdkv7hrxeDqVKHFSy1y1ZMcgujfQ5iAiybPd3prqBzELa2bUmoQFvYEQ8y', '2022-02-08 00:53:16', '2022-02-17 17:42:11'),
(10, 0, 'wahyudhinugroho31@gmail.com', '$2y$10$pTSRRcKrHX.XdGht4GIOrOm5Fnq.IPR.svVnbB1wDUcuaa6HHImUy', 'Politeknik TEDC', 89503588488, 'Jl Baros Utama No 15', 'image-user/J3fWVJ4FKCUSXAycQIMWesQ3LVDknmpSCYS0VZLt.jpg', NULL, NULL, '2024-10-29 21:23:00', '2024-10-31 18:51:36'),
(11, 1, 'wahyudhinugroho@gmail.com', '$2y$10$LEDLTovXiNEEdrF2azQz5.8j2ZuPAeSacfwhNOFgEbin3TOCsoUD2', 'WAN FOOD', 89503588488, 'Jl Baros Utama No 15', 'image-user/UdfEkAveuvDAivHYBZJqp5ef5j0tyz2FOdpHpJf4.jpg', NULL, NULL, '2024-10-30 00:34:42', '2024-10-31 08:27:04'),
(12, 1, 'wahyudhi@gmail.com', '$2y$10$N6CyfuTDNJW2cdRU9lXAIe91FEAnjukexkG9emUvWdLLVzcm67czi', 'ASEK SPOT', 89503588488, 'Jl Cibeber No 15', 'image-user/UljKNoGNoR5f1yjnd8pChUK4od8nx1LNa0mqXDmY.jpg', NULL, NULL, '2024-10-30 23:14:48', '2024-10-31 08:31:11');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `footers`
--
ALTER TABLE `footers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `footers_name_unique` (`name`),
  ADD UNIQUE KEY `footers_slug_unique` (`slug`);

--
-- Indeks untuk tabel `image_properties`
--
ALTER TABLE `image_properties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `image_properties_name_unique` (`name`),
  ADD UNIQUE KEY `image_properties_slug_unique` (`slug`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guidances_name_unique` (`name`);

--
-- Indeks untuk tabel `profils`
--
ALTER TABLE `profils`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profils_name_unique` (`name`);

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
-- AUTO_INCREMENT untuk tabel `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `footers`
--
ALTER TABLE `footers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `image_properties`
--
ALTER TABLE `image_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `profils`
--
ALTER TABLE `profils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
