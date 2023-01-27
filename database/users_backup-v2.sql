-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2023 at 09:49 PM
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
-- Database: `loan`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `manager_branch` varchar(255) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `is_admin`, `email`, `phone`, `manager_branch`, `manager_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 1, 'superadmin', NULL, 'All', NULL, '2022-11-06 15:24:30', '$2y$10$OeICqq9K02pURE/lgiTQleWMdQcQAOyulVtt1HkC/qQP4CqzZw23e', 'mcI086yQijXmzrFXx8mLbmXvbmTQuGDnEZ8PC8kOldTKcWUjPQuUpNr7RSNa', NULL, NULL, NULL),
(2, 'Notic Admin', 4, 'noticadmin', NULL, 'All', NULL, '2022-11-06 15:24:30', '$2y$10$OeICqq9K02pURE/lgiTQleWMdQcQAOyulVtt1HkC/qQP4CqzZw23e', 'InOhRd1tPWlXDkpFG1hmAaqt48TlAxKMWdORsX9P4mszgEeEfCsN59L57Q41', '2023-01-03 15:11:44', NULL, NULL),
(3, 'Manager', 2, 'manager', NULL, 'Dhaka', NULL, '2022-11-06 15:24:30', '$2y$10$OeICqq9K02pURE/lgiTQleWMdQcQAOyulVtt1HkC/qQP4CqzZw23e', 'igwfMcR31QnF7PL7gxMqgEkeSr6vGIwGtnZD8joL0altqSZP7QrkAcBpBiqt', NULL, NULL, NULL),
(4, 'Loan Officer', 3, 'loanofficer', NULL, 'Dhaka', 3, '2022-11-06 15:24:30', '$2y$10$OeICqq9K02pURE/lgiTQleWMdQcQAOyulVtt1HkC/qQP4CqzZw23e', 'LzS9BcrhXDd45UIot5Q8ZtGf0tQ0AeNfd9gossyy7A5LnzMgOyum2WbrHc2P', NULL, NULL, NULL),
(5, 'Amdadu Haque Melon', 3, 'kjk', NULL, NULL, NULL, NULL, '$2y$10$Nt2sMBQ.UjujQDhEkkEAIePuYVdJvlapQl/9IU12gtjhff5uUHDD2', NULL, NULL, NULL, NULL),
(6, 'Amdadu Haque Melon', 3, 'melonmia', '01787878990', 'Dhaka', 3, NULL, '$2y$10$mqUPisqmG1unxHw6qnUhYOBWzpMlKkOnZBuVhShzW4tRwPimpD15y', NULL, NULL, NULL, NULL),
(7, 'Lucas Estrada E', 3, 'Mepadah1@mailinator.com', '+1 (587) 236-4421', 'Dhaka', 3, NULL, '$2y$10$Jj0x4HacYEpHToD3KbyGBeBt0PkM6YfXC.oXtt1ZgXKFijn7gnqMS', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
