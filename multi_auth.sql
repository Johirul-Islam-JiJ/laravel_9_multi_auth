-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2023 at 10:38 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multi_auth`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `dob` text DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `image`, `dob`, `phone_number`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', '/20231004051015TCmHwf.webp', '2023-10-11', '01631059182', 'admin@gmail.com', NULL, '$2y$10$D63nXjEbea4J5wQV5NRF9.z3wCTX.O33U1QZxLuiiitvOK1sq0cqa', NULL, '2023-09-03 02:47:28', '2023-10-03 23:49:19', NULL),
(2, 'shamim', NULL, NULL, '01631058245', 'shamim@gmail.com', NULL, '$2y$10$KUldwnMQ7n4IinDNoPexQ.TOFZSHNiUjLRbqETGi.V75kFb5DpVEG', NULL, '2023-09-03 02:57:17', '2023-10-04 22:27:58', NULL),
(4, 'rakib', NULL, NULL, '01631058945', 'rakib12@gmail.com', NULL, '$2y$10$.4qR7StJT2WcwdKhl91RSeFCIuU5p.jQ2K.eaJb9BVnLFdCh5wt1e', NULL, '2023-10-04 22:22:51', '2023-10-04 23:44:14', '2023-10-04 23:44:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_15_164701_create_admins_table', 1),
(6, '2023_08_24_173955_create_sellers_table', 1),
(7, '2023_08_25_132019_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Seller\\Seller', 1),
(1, 'App\\Models\\Seller\\Seller', 14),
(1, 'App\\Models\\Seller\\Seller', 15),
(1, 'App\\Models\\Seller\\Seller', 16),
(1, 'App\\Models\\Seller\\Seller', 17),
(1, 'App\\Models\\Seller\\Seller', 18),
(1, 'App\\Models\\Seller\\Seller', 21),
(1, 'App\\Models\\Seller\\Seller', 22),
(1, 'App\\Models\\Seller\\Seller', 25),
(1, 'App\\Models\\Seller\\Seller', 29),
(1, 'App\\Models\\Seller\\Seller', 30),
(1, 'App\\Models\\Seller\\Seller', 31),
(1, 'App\\Models\\Seller\\Seller', 32),
(1, 'App\\Models\\Seller\\Seller', 33),
(1, 'App\\Models\\Seller\\Seller', 34),
(1, 'App\\Models\\Seller\\Seller', 35),
(1, 'App\\Models\\Seller\\Seller', 36),
(2, 'App\\Models\\Admin\\Admin', 1),
(3, 'App\\Models\\Admin\\Admin', 2),
(5, 'App\\Models\\Admin\\Admin', 2),
(5, 'App\\Models\\Admin\\Admin', 4),
(7, 'App\\Models\\Seller\\Seller', 20),
(8, 'App\\Models\\Seller\\Seller', 19),
(9, 'App\\Models\\Seller\\Seller', 23),
(10, 'App\\Models\\Seller\\Seller', 24),
(11, 'App\\Models\\Seller\\Seller', 26),
(11, 'App\\Models\\Seller\\Seller', 27),
(11, 'App\\Models\\Seller\\Seller', 28);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('shamim.dev2@gmail.com', '$2y$10$wvAkCmICUogCiXp7txQWnOAIUWJk.M6ADazkmWobZCwFEnisDdFDO', '2023-10-06 22:53:22');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `module_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `module_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.show', 'admin', 'Dashboard', NULL, NULL),
(2, 'category.show', 'admin', 'Category-Manage', NULL, NULL),
(3, 'category.add', 'admin', 'Category-Manage', NULL, NULL),
(4, 'category.edit', 'admin', 'Category-Manage', NULL, NULL),
(5, 'category.delete', 'admin', 'Category-Manage', NULL, NULL),
(6, 'category.import', 'admin', 'Category-Manage', NULL, NULL),
(7, 'seller.show', 'admin', 'Seller-Manage', NULL, NULL),
(8, 'user.show', 'admin', 'Access-Control-Manage', NULL, NULL),
(9, 'user.add', 'admin', 'Access-Control-Manage', NULL, NULL),
(10, 'user.edit', 'admin', 'Access-Control-Manage', NULL, NULL),
(11, 'user.delete', 'admin', 'Access-Control-Manage', NULL, NULL),
(12, 'user.restore', 'admin', 'Access-Control-Manage', NULL, NULL),
(13, 'user.delete-permanently', 'admin', 'Access-Control-Manage', NULL, NULL),
(14, 'role.show', 'admin', 'Access-Control-Manage', NULL, NULL),
(15, 'role.add', 'admin', 'Access-Control-Manage', NULL, NULL),
(16, 'role.edit', 'admin', 'Access-Control-Manage', NULL, NULL),
(17, 'dashboard.show', 'seller', 'Dashboard', NULL, NULL),
(18, 'category.show', 'seller', 'Category-Manage', NULL, NULL),
(19, 'category.add', 'seller', 'Category-Manage', NULL, NULL),
(20, 'category.edit', 'seller', 'Category-Manage', NULL, NULL),
(21, 'category.delete', 'seller', 'Category-Manage', NULL, NULL),
(22, 'category.import', 'seller', 'Category-Manage', NULL, NULL),
(23, 'user.show', 'seller', 'Access-Control-Manage', NULL, NULL),
(24, 'user.add', 'seller', 'Access-Control-Manage', NULL, NULL),
(25, 'user.edit', 'seller', 'Access-Control-Manage', NULL, NULL),
(26, 'user.delete', 'seller', 'Access-Control-Manage', NULL, NULL),
(27, 'user.restore', 'seller', 'Access-Control-Manage', NULL, NULL),
(28, 'user.delete-permanently', 'seller', 'Access-Control-Manage', NULL, NULL),
(29, 'role.show', 'seller', 'Access-Control-Manage', NULL, NULL),
(30, 'role.add', 'seller', 'Access-Control-Manage', NULL, NULL),
(31, 'role.edit', 'seller', 'Access-Control-Manage', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `code`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Super Admin', 'seller', '2023-09-03 02:47:28', '2023-09-03 02:47:28'),
(2, NULL, 'Super Admin', 'admin', '2023-09-03 02:47:28', '2023-09-03 02:47:28'),
(3, NULL, 'staf', 'admin', '2023-09-03 02:56:29', '2023-09-03 02:56:29'),
(5, NULL, 'bekar', 'admin', '2023-09-03 03:14:44', '2023-09-03 03:14:44'),
(6, NULL, 'manager', 'admin', '2023-09-10 02:46:39', '2023-09-10 02:46:39'),
(7, '20231067375', 'viewer_1', 'seller', '2023-10-06 00:47:31', '2023-10-06 00:47:31'),
(8, '20231067375', 'manager', 'seller', '2023-10-06 00:49:36', '2023-10-06 00:49:36'),
(9, '20231002321', 'seller2_mamager', 'seller', '2023-10-06 21:18:59', '2023-10-06 21:18:59'),
(10, '20231002321', 'seller2_viewer', 'seller', '2023-10-06 21:19:38', '2023-10-06 21:19:38'),
(11, '20231017402', 'viewer_seller3', 'seller', '2023-10-06 22:03:47', '2023-10-06 22:03:47');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(8, 3),
(8, 5),
(9, 5),
(14, 3),
(14, 5),
(17, 8),
(17, 9),
(18, 7),
(18, 8),
(19, 7),
(19, 8),
(20, 7),
(20, 8),
(21, 7),
(21, 8),
(22, 7),
(22, 8),
(23, 7),
(23, 8),
(23, 9),
(23, 10),
(23, 11),
(24, 7),
(24, 8),
(25, 7),
(25, 8),
(26, 7),
(26, 8),
(27, 7),
(27, 8),
(28, 7),
(28, 8),
(29, 7),
(29, 8),
(29, 9),
(29, 10),
(29, 11),
(30, 7),
(30, 8),
(31, 7),
(31, 8);

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `code`, `name`, `image`, `dob`, `phone_number`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '20231057158', 'Super Admin', '/20231005061010BZN8oe.webp', '2023-09-06', '01631059183', 'seller@gmail.com', '2023-10-07 03:14:43', '$2y$10$TQ73WdRclee9P/B53k4VF.IcUNqGAGz6hhZaskdEpMoHobkbjGaqK', NULL, '2023-09-03 02:47:28', '2023-10-05 00:19:11', NULL),
(22, '20231002321', 'seller 2', NULL, NULL, NULL, 'shamim.dev@gmail.com', '2023-10-06 21:17:40', '$2y$10$NOhB5bna.H1FWwUfGDtfm.CI8BX9xi37lJqAWxT7vNUh.GcZOi3Vy', NULL, '2023-10-06 21:17:01', '2023-10-06 21:17:40', NULL),
(23, '20231002321', 'manager-s-2', NULL, NULL, '01632145678', 'shamim.aham44adxp@gmail.com', '2023-10-07 03:28:37', '$2y$10$CF0ylM8a9XbuASy7ZlPyGeMEJ4eyAroV6zhu.um6Gjs3ciOSgazBW', NULL, '2023-10-06 21:21:19', '2023-10-06 21:21:19', NULL),
(24, '20231002321', 'seller2 viewer', NULL, NULL, '01412589633', 'seller2viewer@gmail.com', '2023-10-06 18:00:00', '$2y$10$aQVl9K8tmaItpLwWfsejReJu/hBbwTBASOaDd0t./1fwGNtYLan9q', NULL, '2023-10-06 21:22:13', '2023-10-06 21:22:13', NULL),
(25, '20231017402', 'seller3', NULL, NULL, NULL, 'shamim.dev2@gmail.com', '2023-10-06 21:55:56', '$2y$10$cWZiV8YQMEEGqow7sqF0V.hHTBIvyU8LmjaT91oltXjvNpbiwIdqi', NULL, '2023-10-06 21:55:16', '2023-10-06 22:54:03', NULL),
(27, '20231017402', 'sssss', NULL, NULL, '01925845612', 'seller3user@gmail.com', '2023-10-06 22:11:35', '$2y$10$CsurfFVco.ijjOsa0MuC7.hQ4fffvc.QOmYicEdge97bF3x6q/iU6', NULL, '2023-10-06 22:11:35', '2023-10-06 22:11:35', NULL),
(28, '20231017402', 'vshdfgiuoheg', NULL, NULL, '01432158865', 'vebh@gmail.com', '2023-10-06 23:00:35', '$2y$10$hHHe4E31YFw8Bu36KOcJXeGyvXWW52YkTYXkRPb/Y62QAAYvklKre', NULL, '2023-10-06 23:00:35', '2023-10-06 23:00:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'shamim', 'shamim@gmail.com', NULL, '$2y$10$MBtbgYXN7r49BPoI2Jy/U.eHFqFMy.1aOD4h8V9UXLiYtzKfSmbUW', NULL, '2023-10-03 23:02:09', '2023-10-03 23:02:09'),
(2, 'shamim', 'admin@gmail.com', NULL, '$2y$10$ILA8VF9ewzakdjgfv3B.NOFs.Z5MP.0ELWgTAAdtoZRqbJqhYGPJq', NULL, '2023-10-05 07:05:57', '2023-10-05 07:05:57'),
(3, 'shamim', 'admisdn@gmail.com', NULL, '$2y$10$y.7/oKOgBmD9GFINFcSV0unRreIejmIXC3t7nQ1/6DMs6XEm7OIYq', NULL, '2023-10-06 22:55:36', '2023-10-06 22:55:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sellers_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
