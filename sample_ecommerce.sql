-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 23, 2018 at 02:07 AM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.1.16-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sample_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `entity_id` int(10) UNSIGNED DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assets` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_types`
--

CREATE TABLE `history_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_types`
--

INSERT INTO `history_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'User', '2018-04-22 04:23:28', '2018-04-22 04:23:28'),
(2, 'Role', '2018-04-22 04:23:28', '2018-04-22 04:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2015_12_28_171741_create_social_logins_table', 1),
(4, '2015_12_29_015055_setup_access_tables', 1),
(5, '2016_07_03_062439_create_history_tables', 1),
(6, '2017_04_04_131153_create_sessions_table', 1),
(7, '2018_04_22_143840_create_products_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'view-backend', 'View Backend', '2018-04-22 04:23:27', '2018-04-22 04:23:27');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `main_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `main_image`, `created_at`, `updated_at`) VALUES
(1, 'Product 1', NULL, 'nobel1.jpg', '2018-04-21 16:00:00', '2018-04-22 09:36:44'),
(3, 'Product 2', NULL, 'nobel2.jpg', '2018-04-22 09:28:35', '2018-04-22 09:36:32'),
(4, 'Product 3', NULL, 'nobel3.jpg', '2018-04-21 16:00:00', '2018-04-22 09:36:44'),
(5, 'Product 4', NULL, 'nobel4.jpg', '2018-04-22 09:28:35', '2018-04-22 09:36:32'),
(6, 'Product 5', NULL, 'nobel5.jpg', '2018-04-21 16:00:00', '2018-04-22 09:36:44'),
(7, 'Product 6', NULL, 'nobel6.jpg', '2018-04-22 09:28:35', '2018-04-22 09:36:32'),
(8, 'Product 7', NULL, 'nobel7.jpg', '2018-04-21 16:00:00', '2018-04-22 09:36:44'),
(9, 'Product 8', NULL, 'nobel8.jpg', '2018-04-22 09:28:35', '2018-04-22 09:36:32'),
(10, 'Product 9', NULL, 'nobel9.jpg', '2018-04-21 16:00:00', '2018-04-22 09:36:44'),
(11, 'Product 10', NULL, 'nobel10.jpg', '2018-04-22 09:28:35', '2018-04-22 09:36:32'),
(12, 'Product 11', NULL, 'nobel11.jpg', '2018-04-21 16:00:00', '2018-04-22 09:36:44'),
(13, 'Product 12', NULL, 'nobel12.jpg', '2018-04-22 09:28:35', '2018-04-22 09:36:32');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `all` tinyint(1) NOT NULL DEFAULT '0',
  `sort` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `all`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 1, 1, '2018-04-22 04:23:26', '2018-04-22 04:23:26'),
(2, 'Executive', 0, 2, '2018-04-22 04:23:26', '2018-04-22 04:23:26'),
(3, 'User', 0, 3, '2018-04-22 04:23:26', '2018-04-22 04:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ddjoqLRS0gYhU4AGqCFlXiLtrjdPrniBDSOPuH9R', 1, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/65.0.3325.181 Chrome/65.0.3325.181 Safari/537.36', 'ZXlKcGRpSTZJbTV1ZEcwMGJ6ZHBkRkJEWVRKVVduTm9jblYxUzFFOVBTSXNJblpoYkhWbElqb2lTVlJHVEhOWFRUQXdObmRqVDA5WGVEa3hSVmxXYVhoMGNsVTVlQ3R6UzBzclpqVmpWVGd6TmxOdVExQkhiV0Z3T1ZCWldFdG5ZVzlDWjAxTVUzRmhNM0JqYWpoWUt6UjJabloxVmtadkswVm1SRVpsVmt4a1ZscGxZMEZsY1UxWFduZElaME5PTlVOaU9VdDVjVGR5Y0RCWGVuTjZiMk56ZDBOTVZ5dEJkMUJ5TTIxeFNtNVVaakY1ZUhSV2IxYzRaakV4YVVsc1VtWkxhVkpqZUhkeWVVNDROMHhyU3pSSksyMHdja0ptVkRncldVTkRZbFF5WTI4M1prRmxhazFPVmt4MVp6WmlRbmh2ZVhCYU5pdElUalJWVEU5NWRHVlNaREptUkRoMWExaEVNbXB6V0dwMU0yZE5kM1E0VUhrMFFuYzJZbXRNY2pWTlJERlJhRzR6Y0d0a1dWRkJRVlJLVVRkNFFUSnJWemRTV2xoa1oyTkNTbkJRYTFSeE5FWkJjamxOWWpOUVUzVnVORFp0YWt4c1VXRkJWVUpyZURGNU9VaHdkMnBwY1ZkTlZsWk5WMVp6YUVOQldtTTFiWFp5Yms1VFNtZHFURXBjTDFOUWJEUXpNRkpzUjFCaFRVOUJTbGd4YUVacmFGQjFhRlZJUlZOV1ptSktTRTFaVmtoQlZGaFdWV0ZsUlZCSWVXUkdiV295VkRGaU4yOHliMUpoZERONFdFUXJRV2sxYVhvMlR6RkVLemt5T0RJeWFFaFRVVGhWWkdNeFFqZFdia2h5ZVVGMGVuWkNWVnd2Y0RsMmVtTTNlRU01VFZaWFNFSTViSGhyZHowOUlpd2liV0ZqSWpvaU16QXlPV0ZrTnpOa1lqYzVORGs1WlRjNU5XUTFOalUyTkRjM01qTTNPR1JpT1dKak9HSXhNbVJqT0RBNFpEazBORGN5TW1JMk1tWTVZMlF3TUdJek5pSjk=', 1524420298),
('dJQF4MFkwp5SGlVpTLTetsjt88OlU0Jh4RVCggBk', NULL, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/65.0.3325.181 Chrome/65.0.3325.181 Safari/537.36', 'ZXlKcGRpSTZJbEJuZVdGMVZXWnBWSEJ5YWt0UVdub3JlSGh2TkdjOVBTSXNJblpoYkhWbElqb2liRXN5TlVneFRISTNTVkJDZWxsb1ozWkNUWE5TWTBoWVZ6VmtWMmN4TUhoaFZtbGxkbE5VZG14Rk5qSk1kM1oyYUdWUldYZ3ljak5zU1dabFVGd3ZNa3RNWmxoUFVtUTJLMU13YVV0aGJ6TkdNMDQwVlc1cFhDOTNkRGRSU1hSeVVHOUdlbXcwU3psMU5XbG9hVnd2U0RseU4wNXViMUZ6V1RkbVEzQktVVUp2YjB0QlkxUldSalZTSzJ4RmRYYzVUMHM0YVhkRk5GTlNaVTh3ZVVkWU1FY3laRXAwVEZabVRXVXJVV0pZWVdkc1ltMXVTbUp3TUU0MFNISjZWMHBLVVc5Rk5UQkxSRXBvVTJnelIySmhaMXB1ZWsxMWEyUTJSbTQwTUc1SlNuQlVRVFp2WEM5Q2RHWXJPSFZwSzNsMk9HVnZlV3MwYzFSUGJrZElSMGRVZG1jeVlsSkVObEJYTUZGWlExTlFaVlpjTHpsek4wZFhNRlF4WnowOUlpd2liV0ZqSWpvaU1qWXdaV0UyWTJSalpXRTVaalkxT0dZeE1UYzBZbVJqTmpCbFl6ZzFORGN6WkdFNU1HVTBOREU0TnpObU1qVTFZelV6TlRJd1l6Qm1ObVpoTkdJd09DSjk=', 1524420341);

-- --------------------------------------------------------

--
-- Table structure for table `social_logins`
--

CREATE TABLE `social_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `provider` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `confirmation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `status`, `confirmation_code`, `confirmed`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'Istrator', 'admin@admin.com', '$2y$10$iWkbhRSbO6juGrPhjoeNN.dRz9QkT5rUHb6KB7FttLoNejOSoO3EC', 1, 'c850b895444768662eb7eba96d3dffc1', 1, 'EgJUj7nfN9Orms7RNRHDyBZDyOAe46xQsvXzSoKr4XAiUgBiHLfOX8Cwkzyk', '2018-04-22 04:23:26', '2018-04-22 04:23:26', NULL),
(2, 'Backend', 'User', 'executive@executive.com', '$2y$10$gCXWFzWJH5am5baYZ4W3iuTK9JSaK3kl6F/JVWP6.R4eYHNj1SEFO', 1, 'f861e0f0c7654cdc544ac5b6651a51be', 1, NULL, '2018-04-22 04:23:26', '2018-04-22 04:23:26', NULL),
(3, 'Default', 'User', 'user@user.com', '$2y$10$qZTlUWL.hD7v5UwfgHnsHOXVPjxr/dvJwYXXM4e56FSDzT3Ozrbpm', 1, '7633753dcdc00187001e23742bb52b5f', 1, NULL, '2018-04-22 04:23:26', '2018-04-22 04:23:26', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_type_id_foreign` (`type_id`),
  ADD KEY `history_user_id_foreign` (`user_id`);

--
-- Indexes for table `history_types`
--
ALTER TABLE `history_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `social_logins`
--
ALTER TABLE `social_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_logins_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `history_types`
--
ALTER TABLE `history_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `social_logins`
--
ALTER TABLE `social_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `history_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `social_logins`
--
ALTER TABLE `social_logins`
  ADD CONSTRAINT `social_logins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
