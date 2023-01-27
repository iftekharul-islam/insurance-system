-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2023 at 09:48 PM
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
-- Table structure for table `user_loan_profiles`
--

CREATE TABLE `user_loan_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) DEFAULT NULL,
  `re_submit_status` int(11) DEFAULT NULL,
  `loan_officer_id` int(11) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `noticeadmin_check_date` timestamp NULL DEFAULT NULL,
  `admin_check_date` timestamp NULL DEFAULT NULL,
  `manager_aceck_date` timestamp NULL DEFAULT NULL,
  `manager_branch` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `fathers_name` varchar(255) DEFAULT NULL,
  `mothers_name` varchar(255) DEFAULT NULL,
  `loan_owner_card_no` varchar(255) DEFAULT NULL,
  `loan_owner_Occupation` varchar(255) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `loan_owner_zila` varchar(255) DEFAULT NULL,
  `loan_owner_upazila` varchar(255) DEFAULT NULL,
  `loan_owner_union` varchar(255) DEFAULT NULL,
  `loan_owner_pincode` varchar(255) DEFAULT NULL,
  `loan_owner_gram` varchar(255) DEFAULT NULL,
  `loan_owner_branch` varchar(255) DEFAULT NULL,
  `loan_amount` bigint(22) DEFAULT NULL,
  `intrestRate` double(11,2) DEFAULT NULL,
  `loanInstallment` bigint(22) DEFAULT NULL,
  `TotalIntrestAmountForEveryInstallment` double(8,2) DEFAULT NULL,
  `installmentType` varchar(255) DEFAULT NULL,
  `relationgranter` varchar(255) DEFAULT NULL,
  `granter_name` varchar(255) DEFAULT NULL,
  `granter_day` varchar(255) DEFAULT NULL,
  `granter_month` varchar(255) DEFAULT NULL,
  `granter_year` varchar(255) DEFAULT NULL,
  `granter_mobile` varchar(255) DEFAULT NULL,
  `granter_fathers_name` varchar(255) DEFAULT NULL,
  `granter_mothers_name` varchar(255) DEFAULT NULL,
  `granterOccupation` varchar(255) DEFAULT NULL,
  `granter_id_card_no` varchar(255) DEFAULT NULL,
  `granter_zila` varchar(255) DEFAULT NULL,
  `granter_upazila` varchar(255) DEFAULT NULL,
  `granter_union` varchar(255) DEFAULT NULL,
  `granter_pincode` varchar(255) DEFAULT NULL,
  `relationgranter2` varchar(255) DEFAULT NULL,
  `granter_2_name` varchar(255) DEFAULT NULL,
  `granter_2_mobile` varchar(255) DEFAULT NULL,
  `granter_2_fathers_name` varchar(255) DEFAULT NULL,
  `granter_2_mothers_name` varchar(255) DEFAULT NULL,
  `granter_2_id_card_no` varchar(255) DEFAULT NULL,
  `granter_2_day` varchar(255) DEFAULT NULL,
  `granter_2_month` varchar(255) DEFAULT NULL,
  `granter_2_year` varchar(255) DEFAULT NULL,
  `granter_2_zila` varchar(255) DEFAULT NULL,
  `granter_2_upazila` varchar(255) DEFAULT NULL,
  `granter_2_union` varchar(255) DEFAULT NULL,
  `granter_2_pincode` varchar(255) DEFAULT NULL,
  `granter_2_gram` varchar(255) DEFAULT NULL,
  `granter2Occupation` varchar(255) DEFAULT NULL,
  `loan_owner_image` varchar(255) DEFAULT NULL,
  `loan_owner_id_card` varchar(255) DEFAULT NULL,
  `granter_id_photo` varchar(255) DEFAULT NULL,
  `granter_image` varchar(255) DEFAULT NULL,
  `granter2_id_photo` varchar(255) DEFAULT NULL,
  `granter__2_image` varchar(255) DEFAULT NULL,
  `granter_gram` varchar(255) DEFAULT NULL,
  `loan_entry` double(11,2) DEFAULT NULL,
  `chk_img` varchar(255) DEFAULT NULL,
  `sms` varchar(255) DEFAULT NULL,
  `notice_admin_rejected_reason` varchar(255) DEFAULT NULL,
  `manager_rejected_reason` varchar(255) DEFAULT NULL,
  `super_admin_rejected_reason` varchar(255) DEFAULT NULL,
  `loan_close_reason` varchar(255) DEFAULT NULL,
  `manager_name` varchar(255) DEFAULT NULL,
  `form_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_loan_profiles`
--

INSERT INTO `user_loan_profiles` (`id`, `status`, `re_submit_status`, `loan_officer_id`, `manager_id`, `noticeadmin_check_date`, `admin_check_date`, `manager_aceck_date`, `manager_branch`, `name`, `mobile`, `fathers_name`, `mothers_name`, `loan_owner_card_no`, `loan_owner_Occupation`, `day`, `month`, `year`, `loan_owner_zila`, `loan_owner_upazila`, `loan_owner_union`, `loan_owner_pincode`, `loan_owner_gram`, `loan_owner_branch`, `loan_amount`, `intrestRate`, `loanInstallment`, `TotalIntrestAmountForEveryInstallment`, `installmentType`, `relationgranter`, `granter_name`, `granter_day`, `granter_month`, `granter_year`, `granter_mobile`, `granter_fathers_name`, `granter_mothers_name`, `granterOccupation`, `granter_id_card_no`, `granter_zila`, `granter_upazila`, `granter_union`, `granter_pincode`, `relationgranter2`, `granter_2_name`, `granter_2_mobile`, `granter_2_fathers_name`, `granter_2_mothers_name`, `granter_2_id_card_no`, `granter_2_day`, `granter_2_month`, `granter_2_year`, `granter_2_zila`, `granter_2_upazila`, `granter_2_union`, `granter_2_pincode`, `granter_2_gram`, `granter2Occupation`, `loan_owner_image`, `loan_owner_id_card`, `granter_id_photo`, `granter_image`, `granter2_id_photo`, `granter__2_image`, `granter_gram`, `loan_entry`, `chk_img`, `sms`, `notice_admin_rejected_reason`, `manager_rejected_reason`, `super_admin_rejected_reason`, `loan_close_reason`, `manager_name`, `form_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 4, 3, '2023-01-08 20:39:02', '2023-01-03 15:11:44', '2023-01-03 15:11:44', NULL, 'MD. SANU MRIDHA', '01906157682', 'ABDUL KADER MRIDHA', 'MST. AZIMON BIBI', '7341226418', NULL, '8', 'September', '1965', ':Patuakhali', ':Bauphal', ':Adabaria', 'Mohsenuddin', 'Atoshkhali', 'KASHIPUR BAZAR', 2, NULL, NULL, NULL, NULL, NULL, 'MST. KHAHINUR BEGUM', '1', 'January', '1924', '01920934426', 'MD. AFCHER SHIKDIR', 'MST. JABEDA KHATUN', NULL, '4641196680', ':Barisal', ':Agailjhara', ':Bagdha', 'Mohsenuddin', NULL, 'MD. EDRIS MRIDHA', '0197654446', 'Al Amin', 'Al Amin', '1941224220', '1', 'January', '1924', ':Comilla', ':Barura', ':Adda', 'Hohsenuddin', 'Atoskhali', NULL, '3672.jpg', '2508.jpg', '9433.jpg', '3975.jpg', NULL, '1663.jpg', 'Atoskhali', 510.00, NULL, 'send', 'nnnn', NULL, NULL, NULL, NULL, '0001', '2023-01-04 15:11:44', NULL, NULL),
(2, 3, NULL, 4, 3, '2023-01-03 15:11:44', '2023-01-03 15:11:44', '2023-01-03 15:11:44', NULL, 'MD. ALTAF MALLIK', '01708641824', 'Al Amin', 'Al Amin', '7341226418', NULL, '1', 'January', '1924', '1:Comilla', '2:Barura', '27:Adda', 'MOHSENUDDIN', 'Atoshkhali', 'KASHIPUR BAZAR', 2, NULL, NULL, NULL, NULL, NULL, 'MST. KHAHINUR BEGUM', '1', 'January', '1924', '01726667968', 'MD. AFCHER SHIKDIR', 'MST. JABEDA KHATUN', NULL, '4641196680', '1:Comilla', '2:Barura', '27:Adda', 'Mohsenuddin', NULL, 'MD. EDRIS MRIDHA', '01920934456', 'Al Amin', 'MST. DULU JAN BIBI', '1941224220', '1', 'January', '1924', '1:Comilla', '2:Barura', '27:Adda', 'Hohsenuddin', 'Atoskhali', NULL, '9833.jpg', '9389.jpg', '6173.jpg', '3338.jpg', NULL, '8791.jpg', 'KASHIPUR', 0.00, NULL, NULL, 'Nid Porblem', NULL, NULL, NULL, 'Mohiuddin', '0002', '2021-01-01 15:11:44', NULL, NULL),
(3, 3, NULL, 4, 3, '2023-01-03 15:11:44', '2023-01-07 21:02:59', '2023-01-03 15:11:44', NULL, 'Tanisha Akter', '01708741824', 'AL AMIN', 'AL AMIN', '3678985433', 'Government Employment', '1', 'January', '1924', ':Comilla', ':Barura', ':Adda', 'mohseuddin', 'Atoskhali', 'kashipur bazar', 6, 10.00, 5, 13200.00, 'monthly', 'Brother', 'AL AMIN', '1', 'February', '1924', '017984878594', 'AL AMIN', 'AL AMIN 1', 'Farmar', '75656', ':Comilla', ':Barura', ':Adda', 'Madobpur', 'Sister', 'AL AMIN', '046887654354', 'AL AMIN', 'AL AMIN 2', '57584546', '5', 'March', '1928', ':Noakhali', ':Chatkhil', ':Badalkot', 'Mohsenuddin', 'Atoskhali', 'Housewife', '4790.jpg', '650.png', '4154.png', '3680.png', '3069.png', '4246.jpg', 'madobpur', 4830.00, NULL, 'send', NULL, NULL, NULL, NULL, NULL, '0003', '2023-01-03 15:11:44', NULL, NULL),
(4, 3, NULL, 4, 3, '2023-01-03 15:11:44', '2023-01-03 15:11:44', '2023-01-03 15:11:44', NULL, 'MD. SANU MRIDHA', '01708741824', 'ABDUL KADER MRIDA', 'MST. AZIMON BIBI', '7341226418', NULL, '8', 'September', '1965', '31:Patuakhali', '234:Bauphal', '2119:Adabaria', 'mohseuddin', 'Atoskhali', 'kashipur bazar', 2, NULL, NULL, NULL, NULL, NULL, 'MST. KHAHIUNR BEGUM', '5', 'June', '1970', '01708741824', 'MD. AFCHE SHIKDAR', 'MST. JOBEDA KHATUN', NULL, '4641196680', '31:Patuakhali', '234:Bauphal', '2119:Adabaria', 'Mohsenuddin', NULL, 'MD. EDRIS MRIDHA', '01708741824', 'JOBAN ALI MRIDHA', 'MST. DULJAN BIBI', '1941224220', '1', 'June', '1963', '31:Patuakhali', '234:Bauphal', '2119:Adabaria', 'Mohsenuddin', 'Atoskhali', NULL, '4758.jpg', '571.jpg', '4531.jpg', '3228.jpg', NULL, '5536.jpg', 'Atoskhali', 0.00, NULL, NULL, 'LOAN Am0unt', NULL, NULL, NULL, 'Mohiuddin', '0004', '2023-01-03 15:11:44', NULL, NULL),
(5, 3, NULL, 4, 3, '2023-01-03 15:11:44', '2023-01-03 15:11:44', '2023-01-03 15:11:44', NULL, 'MD. ALTAF MALLIK', '01736917298', 'CANDU MALLIK', 'RABEYA KHATUN', '9141294471', NULL, '8', 'May', '1978', '31:Patuakhali', '234:Bauphal', '2119:Adabaria', 'mohseuddin', 'KASHIPUR', 'kashipur bazar', 5, NULL, NULL, NULL, NULL, NULL, 'NARGIS BEGUM', '8', 'May', '1983', '01736917298', 'FAKU SIKDAR', 'SURZU BEGUM', NULL, '5091023506', '31:Patuakhali', '234:Bauphal', '2119:Adabaria', 'Mohsenuddin', NULL, 'MD. JASIM HOWLADAR', '01920934426', 'MD. PANZOR  ALI HOWLADAR', 'MRITO MST. MALEKA BEGUM', '4600675674', '1', 'January', '1976', '31:Patuakhali', '234:Bauphal', '2119:Adabaria', 'Mohsenuddin', 'KASHIPUR', NULL, '9282.jpg', '9297.jpg', '3242.jpg', '2999.jpg', NULL, '4051.jpg', 'KASHIPUR', 0.00, NULL, NULL, 'LONA AMOUNT', NULL, NULL, NULL, 'Mohiuddin', '0005', '2023-01-03 15:11:44', NULL, NULL),
(6, 2, NULL, 4, 3, '2023-01-03 15:11:44', '2023-01-03 15:11:44', '2023-01-03 15:11:44', NULL, 'MD. SANU MRIDHA', '01708741824', 'ABDUL KADIR MRIDHA', 'MST. AZIMON BIBI', '7341226418', 'Government Employment', '8', 'September', '1965', ':Patuakhali', ':Bauphal', ':Adabaria', 'mohseuddin', 'Atoskhali', 'kashipur bazar', 2000000, 10.00, 9, 244444.44, 'monthly', 'Wife', 'MST. KHAHIUNR BEGUM', '5', 'June', '1970', '01708741824', 'MD. AFCHE SHIKDAR', 'SURZU BEGUM', 'Day Laborer', '4641196680', ':Patuakhali', ':Bauphal', ':Adabaria', 'Mohsenuddin', 'Wife', 'MD. EDRIS MRIDHA', '01708741824', 'JOBAN ALI MRIDHA', 'MST. DULJAN BIBI', '1941224220', '2', 'June', '1963', ':Patuakhali', ':Bauphal', ':Adabaria', 'Mohsenuddin', 'Atoskhali', 'Housewife', '4131.jpg', '6118.jpg', '7062.jpg', '7913.jpg', '8046.png', '5742.jpg', 'Atoskhali', 3570.00, NULL, 'send', '', '', '', NULL, NULL, '0006', '2023-01-03 15:11:44', NULL, NULL),
(7, 3, NULL, 4, 3, '2023-01-03 15:11:44', '2023-01-03 15:11:44', '2023-01-03 15:11:44', NULL, 'MD. ALTAF MALLIK', '01742615723', 'CANDU MALLIK', 'RABEYA KHATUN', '9141294471', NULL, '8', 'May', '1978', ':Patuakhali', ':Bauphal', ':Adabaria', 'mohseuddin', 'Atoskhali', 'kashipur bazar', 5, NULL, 5, NULL, NULL, NULL, 'NARGIS BEGUM', '8', 'May', '1983', '01736917298', 'FAKU SIKDAR', 'SURZU BEGUM', NULL, '5091023506', ':Patuakhali', ':Bauphal', ':Adabaria', 'Mohsenuddin', NULL, 'MD. JASIM HOWLADAR', '01920934426', 'MD. PANZOR  ALI HOWLADAR', 'MRITO MST. MALEKA BEGUM', '4600675674', '1', 'January', '1976', ':Patuakhali', ':Bauphal', ':Adabaria', 'Mohsenuddin', 'Atoskhali', NULL, '4285.jpg', '5903.jpg', '3525.jpg', '8383.jpg', NULL, '3806.jpg', 'Atoskhali', 15945.00, NULL, 'send', 'notice-r', 'manager-r', 'supera-r', NULL, NULL, '0007', '2023-01-03 15:11:44', '2023-01-08 20:29:27', NULL),
(8, 3, NULL, 4, 3, '2023-01-03 15:11:44', '2023-01-03 15:11:44', '2023-01-03 15:11:44', NULL, 'MD. SIDIK SIKDAR', '01703530262', 'MD. ROSID SIKDAR', 'MOSA. SOKINA BEGUM', '19807813810100151', NULL, '10', 'February', '1980', '31:Patuakhali', '234:Bauphal', '2119:Adabaria', 'Madubpur', 'Dokhin Lokhibasha', 'kashipur bazar', 2, NULL, NULL, NULL, NULL, NULL, 'MARUM AKTER', '5', 'March', '1994', '01703530262', 'MOTAHAR VUIYA', 'RUPCAN BIBI', NULL, '19947819554000276', '31:Patuakhali', '234:Bauphal', '2119:Adabaria', 'Madobpur', NULL, 'ABDUS SALAM', '01728399981', 'DOLIL SIKDAR', 'AZIMON BIBI', '1905736870', '3', 'April', '1960', '31:Patuakhali', '234:Bauphal', '2119:Adabaria', 'madobpur', 'Dokhin lokhibasha', NULL, '229.jpg', '5868.jpg', '8907.jpg', '5915.jpg', NULL, '6956.jpg', 'Dokhin Madubpur', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0008', '2023-01-03 15:11:44', NULL, NULL),
(9, 2, 1, 4, 3, '2023-01-08 19:55:01', '2023-01-08 20:41:41', '2023-01-08 12:31:38', NULL, 'Rogan Peterson', 'Ut consectetur aute', 'Griffin Diaz', 'Yoko Whitley', 'Dolore velit dolorem', 'Day Laborer', '9', 'May', '1996', ':Feni', ':Daganbhuiyan', ':Purbachandrapur', 'Ea quia dolorem numq', 'Tenetur adipisicing', 'Aut eu mollitia quae', 6, 23.00, 22, 0.34, 'weekly', 'Mother', 'Armand Collins', '14', 'September', '2006', 'Veniam dolor quasi', 'Chandler Blanchard', 'Keith Mason', 'Driver', 'Nihil sit sapiente v', ':Barguna', ':Barguna Sadar', ':Burirchor', 'Expedita dolorem ill', 'Father', 'Jonah Rice', 'Accusantium nostrum', 'Larissa Bruce', 'Vanna Fisher', 'Nulla vitae laboris', '18', 'April', '1984', ':Naogaon', ':Naogaon Sadar', ':Hashaigari', 'Doloribus in id iure', 'Officia dolor sint a', 'Driver', '453.png', '5959.png', '6453.png', '1134.png', '1919.png', '8733.png', 'Dignissimos amet qu', 0.00, NULL, NULL, NULL, NULL, 'JJJJJJJJJJ', NULL, NULL, '0009', '2023-01-03 15:11:44', NULL, NULL),
(10, 2, NULL, 4, 3, '2023-01-03 15:11:44', '2023-01-03 15:11:44', '2023-01-03 15:11:44', NULL, 'SHAB ALI', '01770788873', 'ABUL HOSEN', 'SURAIYA BEGUM', '5960816576', 'Housewife', '7', 'May', '1982', ':Patuakhali', ':Bauphal', ':Adabaria', 'Kashipur', 'Kashipur', 'kashipur bazar', 3, 2.00, 4, 0.76, 'weekly', 'Sister', 'NASIMA', '7', 'August', '1987', '01770788873', 'ALTAF HAWLADER', 'SAHERA BEGUM', 'Government Employment', '4167880303', ':Patuakhali', ':Bauphal', ':Adabaria', 'Hohsenuddin', 'Brother', 'MD. NURUL ISLAM', '01785436543', 'ROWN RARI', 'AZIMON NECHA', '2841017151', '12', 'October', '1978', ':Patuakhali', ':Bauphal', ':Adabaria', 'Mohsenuddin', 'Kashipur', 'Professor', '5602.jpg', '5680.jpg', '6430.jpg', '7637.jpg', '1691.png', '3406.jpg', 'Kashipur', 4435.00, NULL, 'send', NULL, NULL, NULL, NULL, NULL, '0010', '2023-01-03 15:11:44', NULL, NULL),
(11, 0, 1, 4, 3, '2023-01-03 15:11:44', '2023-01-03 15:11:44', '2023-01-08 20:35:29', NULL, 'Alice Rowe', '56', 'Caleb Griffith', 'Ila Blanchard', '8999', 'Day Laborer', '22', 'May', '2002', ':Bogura', ':Gabtali', ':Durgahata', 'Qui laudantium aut', 'Consequat Omnis vol', 'Ut ut molestiae prov', 3, 10.00, 2, 1882.10, 'monthly', 'Wife', 'Portia Mooney', '12', 'May', '1939', '15', 'Herrod Bryant', 'Tatiana Rush', 'Government Employment', '64', ':Chapainawabganj', ':Chapainawabganj Sadar', ':Gobratola', 'Iste totam eius quia', 'Husband', 'Francesca Mckay', '99', 'Fatima Joyner', 'Mara Berry', '63', '16', 'June', '1942', ':Bandarban', ':Lama', ':Fasiakhali', 'Et distinctio Digni', 'Itaque dolores asper', 'Day Laborer', '6759.png', '3451.png', NULL, NULL, NULL, NULL, 'Doloribus id aut et', 0.00, NULL, NULL, NULL, 'images', NULL, NULL, 'Manager', '0011', '2023-01-03 15:11:44', NULL, NULL),
(12, 1, 1, 4, 3, '2023-01-08 19:59:53', '2023-01-03 15:11:44', '2023-01-03 15:11:44', NULL, 'Victor Gilmore', '70', 'Merritt Mcmahon', 'Christopher Walls', '83', NULL, '24', 'December', '2012', '31:Patuakhali', '237:Dashmina', '2155:Baharampur', 'Dignissimos quasi al', 'Lorem consequatur a', 'Consequatur quis de', 9, NULL, NULL, NULL, NULL, NULL, 'Basil Nichols', '14', 'September', '1939', '86', 'Bruno Underwood', 'Zahir Foreman', NULL, '21', '4:Rangamati', '37:Barkal', '360:Barkal', 'Ea est in earum cons', NULL, 'Kato Levine', '15', 'Malcolm Hayes', 'Owen Oneill', '32', '15', 'June', '1939', '14:Bogura', '128:Nondigram', '1161:Bhatra', 'Quasi aut sunt cupi', 'Dolorem debitis sit', NULL, '8918.png', '6624.png', '2015.png', '1682.png', NULL, '5264.png', 'Et consequuntur dign', 0.00, NULL, NULL, 'hh', NULL, NULL, NULL, NULL, '0012', '2023-01-03 15:11:44', NULL, NULL),
(13, 2, 1, 4, 3, '2023-01-03 15:11:44', '2023-01-03 15:11:44', '2023-01-03 15:11:44', NULL, 'MD. SIDIK SIKDAR', '01703530262', 'MD. ROSID SIKDAR', 'MOSA. SOKINA BEGUM', '19807813810100151', NULL, '10', 'February', '1980', '31:Patuakhali', '234:Bauphal', '2119:Adabaria', 'Madubpur', 'Dokhin Lokhibasha', 'kashipur bazar', 3, NULL, NULL, NULL, NULL, NULL, 'MARUM AKTER', '5', 'March', '1994', '01703530262', 'MOTAHAR VUIYA', 'RUPCAN BIBI', NULL, '19947819554000276', '31:Patuakhali', '234:Bauphal', '2119:Adabaria', 'Madobpur', NULL, 'ABDUS SALAM', '01703530262', 'DOLIL SIKDAR', 'AZIMON BIBI', '1994781955400027', '3', 'April', '1960', '31:Patuakhali', '234:Bauphal', '2119:Adabaria', 'madobpur', 'Dokhin lokhibasha', NULL, '6248.jpg', '7974.jpg', '6159.jpg', '1382.jpg', NULL, '8860.jpg', 'Dokhin Lokhibasha', 5320.00, NULL, 'send', NULL, NULL, 'hello', NULL, NULL, '0013', '2023-01-03 15:11:44', NULL, NULL),
(14, 2, NULL, 4, 3, '2023-01-03 15:11:44', '2023-01-03 15:11:44', '2023-01-03 15:11:44', NULL, 'MOSA. AMINA', '01701205857', 'MD. HANIF HAWLADER', 'MST. FATIMA BEGUM', '5069554862', NULL, '24', 'April', '1995', ':Patuakhali', ':Bauphal', ':Boga', 'Sabupura', 'DASER HAWLA', 'kashipur Bazar', 1, NULL, NULL, NULL, NULL, NULL, 'RUHUL  AMIN', '12', 'February', '1991', '01701205857', 'AMIR HOSSAIN', 'FULBANU', NULL, '5085066842', ':Patuakhali', ':Bauphal', ':Adabaria', 'MOHESUDDIN', NULL, 'MST. FUL VANU', '01701205857', 'MD. ALI FORAZI', 'MST. MOIR JAN BIVI', '1941234765', '8', 'June', '1975', ':Patuakhali', ':Bauphal', ':Adabaria', 'MOHESUDDIN', 'ATOSKHALI', NULL, '8850.jpg', '5376.jpg', '1624.jpg', '5770.jpg', NULL, '6562.jpg', 'ATOSKHALI', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0014', '2023-01-03 15:11:44', NULL, NULL),
(15, 2, NULL, 4, 3, '2023-01-03 15:11:44', '2023-01-03 15:11:44', '2023-01-03 15:11:44', NULL, 'H.M NIZUM UDDIN', '01710195698', 'ISMAIL HAWLADER', 'KOMELA BEGUM', '2841278951', 'Housewife', '5', 'June', '1935', ':Patuakhali', ':Bauphal', ':Adabaria', 'Madobpur', 'DokhIn Lokhipasha', 'kashipur Bazar', 5, 12.00, 3, 18666.67, 'weekly', 'Brother', 'MST. ROKSONA BEGUM', '8', 'July', '1985', '01710195698', 'MD. TOFAZZAL HOSSAIN', 'MST. KHYNUR BEGUM', 'Housewife', '1941360883', ':Patuakhali', ':Bauphal', ':Adabaria', 'Madobpur', 'Husband', 'ABDUL KADER MUNSHI', '01307634798', 'MD. HATEM ALI MUNSHI', 'MST. CHOKINA BIBI', '1941355842', '9', 'January', '1957', ':Patuakhali', ':Bauphal', ':Adabaria', 'Madobpur', 'DokhIn Lokhipasha', 'Housewife', '1167.jpg', '3047.png', '999.jpg', '3916.jpg', '4940.jpg', '6297.png', 'DokhIn Lokhipasha', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0015', '2023-01-03 15:11:44', NULL, NULL),
(16, 0, NULL, 4, 3, NULL, NULL, NULL, 'Dhaka', 'Evelyn Humphrey', '45', 'Wynter Suarez', 'Grady Rodriguez', '33', 'Business', '18', 'March', '1979', '25:Kushtia', '197:Kumarkhali', '1798:Charsadipur', 'Cupiditate iste labo', 'Error excepturi ad q', 'Nemo praesentium ea', 1, 10.00, 7, 15.71, 'yearly', 'Sister', 'Amity Sawyer', '15', 'May', '1937', '58', 'Hollee Padilla', 'Ira Ware', 'Professor', '26', '14:Bogura', '125:Shajahanpur', '1146:Gohail', 'Adipisci magna adipi', 'Wife', 'Joshua Mcleod', '12', 'Amela Elliott', 'Louis Peck', '39', '16', 'April', '1938', '11:Bandarban', '97:Bandarban Sadar', '922:Suwalok', 'Deserunt qui nulla e', 'Dolor aut fuga Earu', 'Government Employment', '9158.jpg', '7476.jpg', '1539.png', '3231.png', '2922.png', '4160.png', 'Et fuga Reiciendis', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0016', NULL, NULL, NULL),
(17, 0, NULL, 4, 3, NULL, NULL, NULL, 'Dhaka', 'Wynter Mcfadden', '70', 'Robert Valdez', 'Duncan Gates', '70', 'Driver', '16', 'January', '1985', '62:Mymensingh', '471:Gafargaon', '4362:Niguari', 'Voluptatem dolor qui', 'Nisi est debitis eo', 'Possimus id et odio', 6, 57.00, 63, 1.52, 'daily', 'Husband', 'Rhiannon Mooney', '12', 'July', '1932', '72', 'Idola Finley', 'Rogan Maynard', 'Government Employment', '60', '13:Pabna', '114:Ishurdi', '1044:Pakshi', 'Rem sint quod rem c', 'Brother', 'Zachery Willis', '1', 'Benjamin Gardner', 'Dacey Parrish', '79', '16', 'May', '1938', '15:Rajshahi', '137:Charghat', '1237:Sardah', 'Sunt quo qui illo ve', 'Dolor qui veniam co', 'Private Compny', '1842.jpg', '6314.png', '1232.png', '497.jpg', '5191.png', '2052.jpg', 'Reprehenderit quaera', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0017', '2023-01-05 09:45:25', NULL, NULL),
(18, 0, NULL, 4, 3, NULL, NULL, NULL, 'Dhaka', 'Moses Mathis', '31', 'Fleur Riggs', 'Rae Lara', '69', 'others', '6', 'April', '2017', '10:Khagrachhari', '93:Manikchari', '907:Jogyachola', 'Laborum minus est p', 'Perspiciatis volupt', 'In distinctio Nemo', 63, 70.00, 27, 3.97, 'weekly', 'Husband', 'Davis Mcmillan', '9', 'April', '1931', '31', 'Evelyn Mcknight', 'Asher Koch', 'Housewife', '32', '15:Rajshahi', '135:Durgapur', '1228:Joynogor', 'Voluptatum iusto qui', 'Sister', 'Neville Knight', '89', 'Basil Oliver', 'Regina Hyde', '36', '15', 'August', '1937', '12:Sirajganj', '106:Kamarkhand', '965:Jamtail', 'Perferendis dolor im', 'Expedita at commodo', 'Government Employment', '4499.png', '7726.png', '5348.jpg', '4192.png', '8387.png', '7679.png', 'Vel et voluptatum qu', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1057800018', '2023-01-08 18:30:59', NULL, NULL),
(19, 3, NULL, 4, 3, '2023-01-08 20:39:49', '2023-01-08 20:42:27', '2023-01-08 20:37:03', 'Dhaka', 'Martin Walker', '64', 'Geraldine Carpenter', 'Forrest Ellis', '18', 'Driver', '15', 'March', '2008', ':Madaripur', ':Rajoir', ':Hosenpur', 'Quam et ut dolore cu', 'Cumque odit ullam es', 'Aliquam cupiditate m', 85, 71.00, 98, 1.48, 'weekly', 'Sister', 'Alfonso Mccullough', '13', 'May', '1937', '92', 'Susan Chapman', 'Savannah Briggs', 'Day Laborer', '34', ':Chandpur', ':Kachua', ':Kachua (South)', 'Laudantium irure en', 'Wife', 'Barrett Butler', '52', 'Theodore Larsen', 'Tasha Church', '49', '16', 'June', '1935', ':Sirajganj', ':Kamarkhand', ':Jamtail', 'Sed voluptas aperiam', 'Esse ipsa magnam edit M N S', 'Professor', '1915.png', '2043.png', '1534.png', '2295.png', '2027.png', '4871.png', 'Expedita aperiam ut', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1057800019', '2023-01-08 20:25:39', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_loan_profiles`
--
ALTER TABLE `user_loan_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_loan_profiles`
--
ALTER TABLE `user_loan_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
