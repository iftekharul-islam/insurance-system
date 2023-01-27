-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2023 at 09:50 PM
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
-- Table structure for table `notice_tbls`
--

CREATE TABLE `notice_tbls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notice` varchar(255) NOT NULL,
  `notice_type` varchar(255) NOT NULL,
  `notice_dec` varchar(255) DEFAULT NULL,
  `notice_pdf` varchar(255) DEFAULT NULL,
  `notice_validati` timestamp NULL DEFAULT NULL,
  `noticestatus` varchar(255) NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notice_tbls`
--

INSERT INTO `notice_tbls` (`id`, `notice`, `notice_type`, `notice_dec`, `notice_pdf`, `notice_validati`, `noticestatus`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Welcome', '1', 'আমাদের সকল অফিসারদের জানাচ্ছি শুভেচ্ছা ও অভিনন্দন। আমাদের হেড অফিসের পক্ষ থেকে। সকলের অবগতির জন্য জানানো যাচ্ছে যে, নিচের \'pdf\" ফাইলটি ডাউনলোট কারা জন্য অনুরধ করা হচ্ছে সবাইকে,, ধন্যবাদ’’', '7361.pdf', '2022-12-31 18:00:00', 'general', '2022-11-14 12:16:07', '2023-01-03 18:34:40', '2023-01-03 18:34:40'),
(2, 'জরুরী নোটিশ', '1', 'সকলের অবগতির জন্য জানানো যাচ্ছে যে, লোন ফরম পূরণ করার সময় । সঠিক তথ্য দিয়ে পূরণ করার জন্য অনুরধ করা হচ্ছে সকলকে এবং কোন তথ্য পরির্বতন করতে চাইলে সঠিক তথ্য ইমেল করতে হবে। অনথয় তথ্য পরির্বতন হবে না। bankasiaadabariaudc@gmail.com সকলকে ধন্যবাদ,', '4360.pdf', '2023-01-07 18:00:00', 'general', '2022-11-16 09:29:20', '2023-01-07 18:22:03', '2023-01-07 18:22:03'),
(3, 'Modi vitae commodo v', 'pdf', 'Aperiam modi et dolo', '7894.pdf', '2017-12-09 18:00:00', 'hot', '2023-01-03 17:24:08', '2023-01-03 18:34:42', '2023-01-03 18:34:42'),
(4, 'Assumenda fugiat rei', 'new', 'Sint quia quisquam\r\n\r\njelonankjdsf', '2634.pdf', NULL, 'new', '2023-01-03 17:33:45', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notice_tbls`
--
ALTER TABLE `notice_tbls`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notice_tbls`
--
ALTER TABLE `notice_tbls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
