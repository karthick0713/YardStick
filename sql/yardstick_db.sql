-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2023 at 09:59 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yardstick_db`
--

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
-- Table structure for table `master_colleges`
--

CREATE TABLE `master_colleges` (
  `college_id` bigint(20) NOT NULL,
  `college_name` varchar(150) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `primary_mobile_no` varchar(20) NOT NULL,
  `alternate_mobile_no` varchar(20) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state_id` int(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `pincode` varchar(11) NOT NULL,
  `is_active` enum('1','2') NOT NULL,
  `trash_key` enum('1','2') NOT NULL,
  `error_key` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_departments`
--

CREATE TABLE `master_departments` (
  `department_id` bigint(20) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `is_active` enum('1','2') NOT NULL,
  `trash_key` enum('1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_departments`
--

INSERT INTO `master_departments` (`department_id`, `department_name`, `is_active`, `trash_key`, `created_at`, `updated_at`) VALUES
(1, 'Cs department', '1', '2', '2023-11-20 18:46:31', '2023-11-20 18:56:19'),
(2, 'ece', '1', '1', '2023-11-20 18:46:51', '2023-11-20 18:46:51'),
(3, 'b.tech iT', '1', '1', '2023-11-20 18:47:18', '2023-11-20 18:47:18');

-- --------------------------------------------------------

--
-- Table structure for table `master_difficulties`
--

CREATE TABLE `master_difficulties` (
  `difficulty_id` int(11) NOT NULL,
  `difficulty_name` varchar(50) NOT NULL,
  `is_active` enum('1','2','','') NOT NULL,
  `trash_key` enum('1','2','','') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_difficulties`
--

INSERT INTO `master_difficulties` (`difficulty_id`, `difficulty_name`, `is_active`, `trash_key`, `created_at`, `updated_at`) VALUES
(1, 'Easy', '2', '1', '2023-11-20 05:27:29', '2023-11-21 16:34:41'),
(3, 'Medium', '2', '1', '2023-11-20 06:26:29', '2023-11-21 16:34:42'),
(4, 'Hard', '2', '1', '2023-11-20 06:26:34', '2023-11-21 16:34:42'),
(5, 'very hard', '2', '1', '2023-11-20 18:35:16', '2023-11-21 16:34:42'),
(6, 'Medium', '1', '2', '2023-11-20 18:35:26', '2023-11-20 18:35:26');

-- --------------------------------------------------------

--
-- Table structure for table `master_profile`
--

CREATE TABLE `master_profile` (
  `profile_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_role` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `profile_image` varchar(100) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `contact_no` bigint(12) NOT NULL,
  `address` varchar(255) NOT NULL,
  `skills_id` varchar(100) NOT NULL,
  `certifications` varchar(255) NOT NULL,
  `projects_done` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `security_questions` varchar(100) NOT NULL,
  `primary_mobile_no` bigint(12) NOT NULL,
  `is_active` enum('1','2') NOT NULL,
  `trash_key` enum('1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_profile`
--

INSERT INTO `master_profile` (`profile_id`, `user_id`, `user_role`, `name`, `profile_image`, `email_id`, `contact_no`, `address`, `skills_id`, `certifications`, `projects_done`, `password`, `security_questions`, `primary_mobile_no`, `is_active`, `trash_key`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Karthick', 'assets/img/profile/655c5921da3e78.63948643.jpg', 'admin@gmail.com', 9361872238, 'Mullaivadi, Attur, Salem.', '1,3,4', 'PHP Certificate', 'Test project', '1234', 'test question', 9361872238, '1', '1', '2023-11-21 05:48:16', '2023-11-21 05:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `master_skills`
--

CREATE TABLE `master_skills` (
  `skill_id` bigint(20) NOT NULL,
  `skill_name` varchar(100) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `is_active` enum('1','2','','') NOT NULL,
  `trash_key` enum('1','2','','') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_skills`
--

INSERT INTO `master_skills` (`skill_id`, `skill_name`, `logo`, `is_active`, `trash_key`, `created_at`, `updated_at`) VALUES
(1, 'angular', 'assets/img/lang-icons/655b0bddec17a5.31525929.png', '1', '1', '2023-11-20 13:03:49', '2023-11-21 12:38:35'),
(3, 'python', 'assets/img/lang-icons/655b247c3a5198.29169984.png', '1', '1', '2023-11-20 14:48:52', '2023-11-20 14:48:52'),
(4, 'c++', 'assets/img/lang-icons/655b3ca275f380.80806518.png', '1', '1', '2023-11-20 16:31:54', '2023-11-20 16:31:54');

-- --------------------------------------------------------

--
-- Table structure for table `master_students`
--

CREATE TABLE `master_students` (
  `student_id` bigint(20) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `register_no` varchar(20) NOT NULL,
  `college_id` int(11) NOT NULL,
  `skills_id` varchar(100) NOT NULL,
  `department_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `mobile_no` bigint(20) NOT NULL,
  `is_active` enum('1','2') NOT NULL,
  `trash_key` enum('1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_students`
--

INSERT INTO `master_students` (`student_id`, `student_name`, `register_no`, `college_id`, `skills_id`, `department_id`, `year`, `semester`, `email_id`, `mobile_no`, `is_active`, `trash_key`, `created_at`, `updated_at`) VALUES
(1, 'Karthick Raja', '19BCS00256', 1, '3,4', 2, 3, 6, 'studyworld@gmail.com', 9874563214, '1', '1', '2023-11-21 12:47:54', '2023-11-21 12:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `master_topics`
--

CREATE TABLE `master_topics` (
  `topic_id` bigint(20) NOT NULL,
  `topic_name` varchar(100) NOT NULL,
  `skills_id` varchar(100) NOT NULL,
  `is_active` enum('1','2') NOT NULL,
  `trash_key` enum('1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_topics`
--

INSERT INTO `master_topics` (`topic_id`, `topic_name`, `skills_id`, `is_active`, `trash_key`, `created_at`, `updated_at`) VALUES
(1, 'Arrays', '1,3', '1', '1', '2023-11-20 15:07:49', '2023-11-20 18:11:34'),
(2, 'Loops', '1,4', '1', '1', '2023-11-20 18:29:48', '2023-11-20 18:29:54'),
(4, 'STATEMENTS', '1,3', '1', '1', '2023-11-20 19:04:02', '2023-11-21 13:02:04'),
(5, 'Operators', '3', '1', '1', '2023-11-21 12:58:59', '2023-11-21 13:02:09');

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
(5, '2023_11_18_063330_create_profile_master_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_master`
--

CREATE TABLE `profile_master` (
  `profile_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_role` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `contact_no` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `skills_id` varchar(100) NOT NULL,
  `certifications` varchar(255) NOT NULL,
  `projects_done` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `security_questions` varchar(100) NOT NULL,
  `primary_mobile_no` int(11) NOT NULL,
  `is_active` enum('1','2') NOT NULL,
  `trash_key` enum('1','2') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `state_list`
--

CREATE TABLE `state_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `state_list`
--

INSERT INTO `state_list` (`id`, `state`) VALUES
(1, 'ANDAMAN AND NICOBAR ISLANDS'),
(2, 'ANDHRA PRADESH'),
(3, 'ARUNACHAL PRADESH'),
(4, 'ASSAM'),
(5, 'BIHAR'),
(6, 'CHATTISGARH'),
(7, 'CHANDIGARH'),
(8, 'DAMAN AND DIU'),
(9, 'DELHI'),
(10, 'DADRA AND NAGAR HAVELI'),
(11, 'GOA'),
(12, 'GUJARAT'),
(13, 'HIMACHAL PRADESH'),
(14, 'HARYANA'),
(15, 'JAMMU AND KASHMIR'),
(16, 'JHARKHAND'),
(17, 'KERALA'),
(18, 'KARNATAKA'),
(19, 'LAKSHADWEEP'),
(20, 'MEGHALAYA'),
(21, 'MAHARASHTRA'),
(22, 'MANIPUR'),
(23, 'MADHYA PRADESH'),
(24, 'MIZORAM'),
(25, 'NAGALAND'),
(26, 'ORISSA'),
(27, 'PUNJAB'),
(28, 'PONDICHERRY'),
(29, 'RAJASTHAN'),
(30, 'SIKKIM'),
(31, 'TAMIL NADU'),
(32, 'TRIPURA'),
(33, 'UTTARAKHAND'),
(34, 'UTTAR PRADESH'),
(35, 'WEST BENGAL'),
(36, 'TELANGANA');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 1, 'admin@gmail.com', NULL, '1234', 'PS8ZoaOaPkNfQIK7VqiZ2sZGuBkJAkmspwU0jEUR', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `master_colleges`
--
ALTER TABLE `master_colleges`
  ADD PRIMARY KEY (`college_id`);

--
-- Indexes for table `master_departments`
--
ALTER TABLE `master_departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `master_difficulties`
--
ALTER TABLE `master_difficulties`
  ADD PRIMARY KEY (`difficulty_id`);

--
-- Indexes for table `master_profile`
--
ALTER TABLE `master_profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `master_skills`
--
ALTER TABLE `master_skills`
  ADD PRIMARY KEY (`skill_id`);

--
-- Indexes for table `master_students`
--
ALTER TABLE `master_students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `master_topics`
--
ALTER TABLE `master_topics`
  ADD PRIMARY KEY (`topic_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `profile_master`
--
ALTER TABLE `profile_master`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `state_list`
--
ALTER TABLE `state_list`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_colleges`
--
ALTER TABLE `master_colleges`
  MODIFY `college_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_departments`
--
ALTER TABLE `master_departments`
  MODIFY `department_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_difficulties`
--
ALTER TABLE `master_difficulties`
  MODIFY `difficulty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_profile`
--
ALTER TABLE `master_profile`
  MODIFY `profile_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_skills`
--
ALTER TABLE `master_skills`
  MODIFY `skill_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_students`
--
ALTER TABLE `master_students`
  MODIFY `student_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_topics`
--
ALTER TABLE `master_topics`
  MODIFY `topic_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile_master`
--
ALTER TABLE `profile_master`
  MODIFY `profile_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `state_list`
--
ALTER TABLE `state_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
