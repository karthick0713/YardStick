-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2024 at 02:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `course_allocate_to_students`
--

CREATE TABLE `course_allocate_to_students` (
  `id` int(11) NOT NULL,
  `course_id` varchar(30) NOT NULL,
  `college_id` varchar(220) DEFAULT NULL,
  `department_id` varchar(220) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `groups_id` varchar(220) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `course_allocate_to_students`
--

INSERT INTO `course_allocate_to_students` (`id`, `course_id`, `college_id`, `department_id`, `year`, `groups_id`, `created_at`, `updated_at`) VALUES
(12, '1', '1', '1', 1, '1,2', '2024-01-22 16:30:59', '2024-01-22 16:30:59'),
(11, '3', '1', NULL, NULL, NULL, '2024-01-22 10:57:37', '2024-01-22 10:57:37'),
(13, '1', '2', NULL, NULL, NULL, '2024-01-22 16:30:59', '2024-01-22 16:30:59'),
(14, '4', '1', NULL, NULL, NULL, '2024-01-23 10:52:16', '2024-01-23 10:52:16');

-- --------------------------------------------------------

--
-- Table structure for table `course_creation`
--

CREATE TABLE `course_creation` (
  `course_id` int(11) NOT NULL,
  `course_title` text NOT NULL,
  `validity_from` text NOT NULL,
  `validity_to` text NOT NULL,
  `is_active` enum('1','2') NOT NULL,
  `trash_key` enum('1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `course_creation`
--

INSERT INTO `course_creation` (`course_id`, `course_title`, `validity_from`, `validity_to`, `is_active`, `trash_key`, `created_at`, `updated_at`) VALUES
(1, 'DEMO CREATIVE BEES', '2024-01-13', '2024-01-15', '1', '1', '2024-01-22 16:30:59', '2024-01-22 16:30:59'),
(2, 'PSG NEW COURSE', '2024-01-18', '2024-01-20', '1', '1', '2024-01-18 22:34:58', '2024-01-18 22:34:58'),
(3, 'new courses', '2024-01-22', '2024-01-25', '1', '1', '2024-01-22 10:57:37', '2024-01-22 10:57:37'),
(4, 'MCQ GROUPING TEST COURSE', '2024-01-23', '2024-01-27', '1', '1', '2024-01-23 10:52:16', '2024-01-23 10:52:16');

-- --------------------------------------------------------

--
-- Table structure for table `course_negative_marks`
--

CREATE TABLE `course_negative_marks` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `test_code` varchar(40) NOT NULL,
  `question_codes` text DEFAULT NULL,
  `negative_marks` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_negative_marks`
--

INSERT INTO `course_negative_marks` (`id`, `course_id`, `test_code`, `question_codes`, `negative_marks`, `created_at`, `updated_at`) VALUES
(11, 3, '65a959fa9696f', '6593f767e95ca,6593f8371f85e,6593f86ce1416,6593f89c9e824,6593f912cb091,6597d21560fd7,6597ddd20f94b', '0,0,0,0,0,0,0', '2024-01-22 10:57:37', '2024-01-22 10:57:37'),
(12, 1, '65a959fa9696f', '6593f736d7fee,6593f767e95ca,6593f79663ec6,6593f7cd083dc,6593f7f744450,6593f8371f85e,6593f86ce1416,6593f89c9e824,6593f912cb091,6593f94ad8238,6593f99c5036d,6593f9c96411d,6597d21560fd7,6597d431331e5,6597ddd20f94b', '1,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '2024-01-22 16:30:59', '2024-01-22 16:30:59'),
(13, 1, '65a959fa9696f', '6593f736d7fee,6593f767e95ca,6593f79663ec6,6593f7cd083dc,6593f7f744450,6593f8371f85e,6593f86ce1416,6593f89c9e824,6593f912cb091,6593f94ad8238,6593f99c5036d,6593f9c96411d,6597d21560fd7,6597d431331e5,6597ddd20f94b', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '2024-01-22 16:30:59', '2024-01-22 16:30:59'),
(14, 4, '65af4ca250fba', '65ae572a765b5,65ae5d9a22659,65af481a77470,65af495f1be6f,65af4b42945c5', '0,0,0,0,0', '2024-01-23 10:52:16', '2024-01-23 10:52:16');

-- --------------------------------------------------------

--
-- Table structure for table `course_test_parameters`
--

CREATE TABLE `course_test_parameters` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `test_code` varchar(30) NOT NULL,
  `section_name` text DEFAULT NULL,
  `test_grouping_name` text DEFAULT NULL,
  `start_date` text NOT NULL,
  `end_date` text NOT NULL,
  `shuffle_questions` int(11) NOT NULL,
  `disable_finish_button` int(11) NOT NULL,
  `re_attempts` varchar(11) NOT NULL,
  `display_result_status` int(11) NOT NULL,
  `display_result_date` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `course_test_parameters`
--

INSERT INTO `course_test_parameters` (`id`, `course_id`, `test_code`, `section_name`, `test_grouping_name`, `start_date`, `end_date`, `shuffle_questions`, `disable_finish_button`, `re_attempts`, `display_result_status`, `display_result_date`, `created_at`, `updated_at`) VALUES
(13, 1, '65a959fa9696f', NULL, NULL, '2024-01-13T17:17', '2024-01-24T05:17', 1, 0, '1', 1, '0', '2024-01-22 16:30:59', '2024-01-22 16:30:59'),
(12, 1, '65a12d9baa130', NULL, NULL, '2024-01-13T17:17', '2024-01-24T05:17', 1, 0, '1', 1, '0', '2024-01-22 16:30:59', '2024-01-22 16:30:59'),
(11, 3, '65a959fa9696f', NULL, '1st Part Test', '2024-01-22T10:57', '2024-01-24T10:57', 1, 0, '2', 1, '0', '2024-01-22 10:57:37', '2024-01-22 10:57:37'),
(14, 4, '65af4ca250fba', NULL, 'Grouping Test', '2024-01-23T10:51', '2024-01-26T00:00', 1, 1, '2', 1, '0', '2024-01-23 10:52:16', '2024-01-23 10:52:16');

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
-- Table structure for table `master_categories`
--

CREATE TABLE `master_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `is_active` enum('1','2') NOT NULL,
  `trash_key` enum('1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `master_categories`
--

INSERT INTO `master_categories` (`category_id`, `category_name`, `is_active`, `trash_key`, `created_at`, `updated_at`) VALUES
(1, 'Programming', '1', '1', '2023-12-11 14:47:43', '2023-12-11 14:55:18'),
(2, 'MCQ', '1', '1', '2023-12-11 14:50:41', '2023-12-11 15:00:55'),
(3, 'MCQ Grouping', '1', '1', '2023-12-11 14:50:47', '2023-12-11 14:50:47');

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

--
-- Dumping data for table `master_colleges`
--

INSERT INTO `master_colleges` (`college_id`, `college_name`, `email_id`, `primary_mobile_no`, `alternate_mobile_no`, `address_1`, `address_2`, `city`, `state_id`, `country`, `pincode`, `is_active`, `trash_key`, `error_key`, `created_at`, `updated_at`) VALUES
(1, 'PSG', 'psg@gmail.com', '8523647910', '9855552355', 'Peelamedu', 'PSG Road', 'Coimbatore', 31, '1', '654123', '1', '1', 0, '2023-11-29 09:49:32', '2023-11-29 09:49:32'),
(2, 'Hindustan', 'hindustan@gmail.com', '6398521470', '8956237410', 'avinashi road', 'ganapathy', 'Coimbatore', 31, '1', '654123', '1', '1', 0, '2023-11-29 09:50:37', '2023-11-29 09:50:37'),
(3, 'KPR', 'kpr@gmail.com', '8795461230', '9512456870', 'near tollgate', 'Arasur', 'Coimbatore', 31, '1', '625314', '1', '1', 0, '2023-11-29 09:50:37', '2023-11-29 09:50:37'),
(4, 'Ramakrishna', 'ramakrish@gmail.com', '8456321789', '8410236579', 'Radison road', 'Nava India', 'Coimbatore', 31, '1', '685201', '1', '1', 0, '2023-11-29 09:50:37', '2023-11-29 09:50:37'),
(5, 'Avs', 'avs@gmail.com', '9361872238', '8883606886', 'ramanaikanpalayam', 'Ayothiyapatnam', 'Salem', 31, '1', '636003', '1', '1', 0, '2023-11-29 09:49:32', '2023-11-29 09:49:32'),
(6, 'karpagam', 'karpagam@gmail.com', '6547891230', '9812546370', 'sanganoor', 'gandhipuram', 'Coimbatore', 31, '1', '685201', '1', '1', 0, '2023-11-29 09:50:37', '2023-11-29 09:50:37'),
(37, 'PSG', 'psg@gmail.com', '8523647910', '9855552355', 'Peelamedu', 'PSG Road', 'Coimbatore', 31, '1', '654123', '1', '1', 2, '2023-11-29 11:53:48', '2023-11-29 11:53:48'),
(38, 'Hindustan', 'hindustan@gmail.com', '6398521470', '8956237410', 'avinashi road', 'ganapathy', 'Coimbatore', 3155, '1', '654123', '1', '1', 2, '2023-11-29 11:53:48', '2023-11-29 11:53:48'),
(39, 'KPR', 'kpr@gmail.com', '8795461230', '9512456870', 'near tollgate', 'Arasur', 'Coimbatore', 31, '1', '62531463', '1', '1', 2, '2023-11-29 11:53:48', '2023-11-29 11:53:48'),
(40, 'Ramakrishna', 'ramakrishgmail.com', '8456321789', '8410236579', 'Radison road', 'Nava India', 'Coimbatore', 31, '1', '685201', '1', '1', 2, '2023-11-29 11:53:48', '2023-11-29 11:53:48'),
(41, 'Avs', 'avs@gmail.com', '9361872238', '8883606886', 'ramanaikanpalayam', 'Ayothiyapatnam', 'Salem', 31, '1', '636003', '1', '1', 2, '2023-11-29 11:53:48', '2023-11-29 11:53:48'),
(42, 'karpagam', 'karpagamgmail.com', '6547891230', '9812546370', 'sanganoor', 'gandhipuram', 'Coimbatore', 31, '1', '685201', '1', '1', 2, '2023-11-29 11:53:48', '2023-11-29 11:53:48');

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
(1, 'CSE', '1', '1', '2023-11-20 18:46:31', '2023-12-11 15:01:38'),
(2, 'ECE', '1', '1', '2023-11-20 18:46:51', '2023-11-28 10:47:03'),
(3, 'EEE', '1', '1', '2023-11-20 18:47:18', '2023-11-28 10:46:56'),
(4, 'MECH', '1', '1', '2023-11-28 10:46:49', '2023-11-28 10:46:49');

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
(1, 'Easy', '1', '1', '2023-11-20 05:27:29', '2023-11-24 14:54:53'),
(2, 'Medium', '1', '1', '2023-11-20 06:26:29', '2023-11-24 14:54:55'),
(3, 'Hard', '1', '1', '2023-11-20 06:26:34', '2023-11-28 14:17:46'),
(4, 'very hard', '1', '1', '2023-11-20 18:35:16', '2023-12-11 15:03:02');

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
(1, 1, 1, 'Karthick', 'assets/img/profile/655c5921da3e78.63948643.jpg', 'admin@gmail.com', 9361872238, 'Mullaivadi, Attur, Salem.', '1,3', 'PHP Certificate', 'Test project', '1234', 'test question', 9361872238, '1', '1', '2023-11-21 05:48:16', '2023-11-21 05:48:16');

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
(1, 'angular', 'assets/img/lang-icons/65695ea86036e4.54249843.png', '1', '1', '2023-11-20 13:03:49', '2023-12-01 09:48:48'),
(3, 'python', 'assets/img/lang-icons/655b247c3a5198.29169984.png', '1', '1', '2023-11-20 14:48:52', '2023-12-11 14:57:47'),
(4, 'c++', 'assets/img/lang-icons/655b3ca275f380.80806518.png', '1', '1', '2023-11-20 16:31:54', '2023-11-30 10:20:42'),
(5, 'JAVA', 'assets/img/lang-icons/6565d365a7b612.49711992.png', '1', '1', '2023-11-28 17:17:49', '2023-11-28 17:17:49');

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
  `role` int(11) NOT NULL DEFAULT 3,
  `is_active` enum('1','2') NOT NULL,
  `error_key` int(11) NOT NULL,
  `trash_key` enum('1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_students`
--

INSERT INTO `master_students` (`student_id`, `student_name`, `register_no`, `college_id`, `skills_id`, `department_id`, `year`, `semester`, `email_id`, `mobile_no`, `role`, `is_active`, `error_key`, `trash_key`, `created_at`, `updated_at`) VALUES
(1, 'ADIPI MANOJ KUMAR', '19BCS801', 1, '1,2', 1, 3, 6, 'adipimanojkumar@gmail.com', 8688219585, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(2, 'ALAGU MANIKANDAN', '19BCS802', 1, '1,3', 1, 3, 6, 'alagumani1313@gmail.com', 9790523279, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(3, 'ANU PRIYA E.P ', '19BCS803', 1, '1,4', 1, 3, 6, 'anupriyaprabhakaran@gmail.com', 8891214160, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(4, 'ANUSH KRISHNAN ', '19BCS804', 1, '2,3', 1, 3, 6, 'anushkrishnan02@gmail.com', 7871898764, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(5, 'ATHUL S JOTHI', '19BCS805', 1, '3,4', 1, 3, 6, 'athulsjyothy@gmail.com', 7511102368, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(6, 'BOOMIGA', '19BCS806', 1, '2,4', 1, 3, 6, 'boomigarangaraj2@gmail.com', 9600686204, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(7, 'EKAMBARAM BHANU PRAKASH', '19BCS807', 1, '1,4', 1, 3, 6, 'ekambarambhanuprakash9752@gmail.com', 7093715054, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(8, 'HARI PRASATH C', '19BCS800', 1, '1,4', 1, 3, 6, 'hariprasathyugan07@gmail.com', 8870177682, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(9, 'KAAVYAA S', '721120104010', 1, '1,2', 1, 3, 6, 'kaavyaa157@gmail.com', 8754905157, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(10, 'KABILAN T', '721120104011', 1, '1,3', 1, 3, 6, 'tkabilan2003@gmail.com', 6381592424, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(11, 'KONDAPANENI BHARGAV', '721120104012', 1, '1,4', 1, 3, 6, 'kondapaneni.tpt@gmail.com', 8919170700, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(12, 'KONDAREDDY NIKHILESHWAR REDDY', '721120104013', 1, '1,3', 1, 3, 6, 'nikhilnick1314@gmail.com', 9441007696, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(13, 'KOTHA CHETAN KUMAR', '721120104014', 1, '1,3', 1, 3, 6, 'chetankotha5@gmail.com', 7801039811, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(14, 'MADINENI  MADHVILATHA', '721120104015', 1, '1,4', 1, 3, 6, 'madhinenimadhavi@gmail.com', 9390225239, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(15, 'MALAVIKA R', '721120104016', 1, '1,4', 1, 3, 6, '2002malavikar@gmail.com', 9074491894, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(16, 'NAGIREDDY THRIVIKRAM REDDY', '721120104017', 1, '1,4', 1, 3, 6, 'nagireddyvikram27@gmail.com', 8555975812, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(17, 'NAGARU AJAY NAIDU', '721120104018', 1, '1,4', 1, 3, 6, 'ajaynaidu9908@gmail.com', 7993591116, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(18, 'PALAKONDA  BALA SAI REDDY', '721120104019', 1, '1,4', 1, 3, 6, 'palakondubalasai@gmail.com', 9100242998, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(19, 'PASUMARTHI SAMPATH', '721120104020', 1, '1,4', 1, 3, 6, 'pasumarthisampath879@gmail.com', 9392395719, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(20, 'PEDDI RUPA', '721120104021', 1, '1,4', 1, 3, 6, 'peddirupa2708@gmai.com', 9676195688, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(21, 'POTHANBOINA ANIL KUMAR', '721120104022', 1, '1,4', 1, 3, 6, 'anilk979278@gmail.com', 6309512563, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(22, 'POTHANA BOYINA KARTHIK', '721120104023', 1, '1,4', 1, 3, 6, 'karthikpothanaboina7744486@gmail.com', 8106822127, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(23, 'POTTABTINA  LAVANYA', '721120104024', 1, '1,4', 1, 3, 6, 'pottabattinalavanya@gmail.com', 9573389387, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(24, 'RAHUL R', '721120104025', 1, '1,4', 1, 3, 6, 'ragulvetri12@gmail.com', 6379768147, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(25, 'RENATI VENGAT SRI SUBHASH', '721120104026', 1, '1,4', 1, 3, 6, 'venkatsrisubash@gmail.com', 8500252340, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(26, 'SHAIK PASPULA SOHAIL', '721120104027', 1, '1,4', 1, 3, 6, 'imthiyazs853@gmail.com', 8247468303, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(27, 'SHAIK PEERAVALI', '721120104028', 1, '1,4', 1, 3, 6, 'arjunshaik143@gmail.com', 9392795788, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(28, 'T MOHAMMED TOUHEED', '721120104029', 1, '1,4', 1, 3, 6, 'touhit.md1234@gmail.com', 7729831701, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(30, 'TIRUMANI  KUMARASWAMY', '721120104031', 1, '1,4', 1, 3, 6, 'tirumanikumaraswamy85@gmail.com', 9553370590, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(31, 'YEDIDA  MANIKANTA', '721120104032', 1, '1,4', 1, 3, 6, 'bobbymanikanta07@gmail.com', 6309795084, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(32, 'ERABOINA VENKATA GIRI', '721120104305', 1, '1,4', 1, 3, 6, 'giriiit51@gmail.com', 7569851468, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(33, 'JINKASAGAR', '721120104307', 1, '1,4', 1, 3, 6, 'sagarjinka12@gmail.com', 9398084137, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(34, 'DHANUSH V', '721120104319', 1, '1,4', 1, 3, 6, 'dhanushthippi@gmail.com', 9361081911, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(36, 'CH SUNDAR PAUL', '721120106302', 1, '1,4', 2, 3, 6, 'chirumalasundharpal654@gmail.com', 9848544937, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(37, 'JYOTHI PRAKASH', '721120106306', 1, '1,4', 2, 3, 6, 'prakashboggala4@gmail.com', 9676673594, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(38, 'PECHETTI LAYASREE', '721120106313', 1, '1,4', 2, 3, 6, 'layasreepechetti@gmail.com', 9390707295, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(39, 'SARAN K', '721120105001', 1, '1,4', 3, 3, 6, 'ksaran3007@gmail.com', 8778525131, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(40, 'THAMODARAN S', '721120105002', 1, '1,4', 3, 3, 6, 'sthamu1403@gmail.com', 7010806515, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(41, 'THANGA SELVAN T', '721120105003', 1, '1,4', 3, 3, 6, 'thangaselvan383@gmail.com', 9344532668, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(42, 'KASIMALLA NARASIMHAN', '721120105312', 1, '1,4', 3, 3, 6, 'kasimallanarasimha@gmail.com', 9959251483, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(43, 'SELVA KANNAN A', '721120114001', 1, '1,4', 4, 3, 6, 'selvakannan765@gmail.com', 6384308067, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(44, ' SIDHARTH C CHANDRAN', '721120114002', 1, '1,4', 4, 3, 6, 'sidharthc199@gmail.com', 8606405832, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(45, 'CHITLURI SRI KRISHNA HAASA', '721120114314', 1, '1,4', 4, 3, 6, 'chitluri.srikrishna@gmail.com', 6301744195, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(46, 'GUNDALA DURGARAO', '721120114325', 1, '1,4', 4, 3, 6, 'gundladurgarao017@gmail.com', 8317652368, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(47, 'KARTHI T', '721120114333', 1, '1,4', 4, 3, 6, 'karthi9786962494@gmail.com', 7695842140, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(48, ' KONNE AKASH', '721120114336', 1, '1,4', 4, 3, 6, 'aakashaakash99001@gmail.com', 9391616947, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(49, 'MAHESH B N', '721120114340', 1, '1,4', 4, 3, 6, 'bokkachanna465@gmail.com', 9494292679, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(50, 'SOUNDHAR S', '721120114371', 1, '1,4', 4, 3, 6, 'soundharmech337@gmail.com', 7806883273, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(51, 'SRINATH REDDY M', '721120114373', 1, '1,4', 4, 3, 6, 'marellasrinathreddy@gmail.com', 7995755038, 3, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(52, 'THOTA  LOKESWARA  VISHNU VARDHAN', '721120104030', 1, '1,4', 1, 3, 6, 'thota.lvv888@gmail.com', 9965358907, 3, '1', 0, '1', '2023-11-29 16:57:15', '2023-11-29 16:57:15'),
(53, 'MUSBOYINA PAVAN', '721120106001', 1, '1,4', 2, 3, 6, 'pavanmusiboyina@gmail.com', 8978684170, 3, '1', 0, '1', '2023-11-29 16:57:15', '2023-11-29 16:57:15'),
(462, 'ADIPI MANOJ KUMAR', '721120104001', 1, '1,2', 1, 3, 6, 'adipimanojkumar@gmail.com', 8688219585, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(463, 'ALAGU MANIKANDAN', '721120104002', 1, '1,3', 1, 3, 6, 'alagumani1313@gmail.com', 9790523279, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(464, 'ANU PRIYA E.P ', '721120104003', 1, '1,4', 1, 3, 6, 'anupriyaprabhakaran@gmail.com', 8891214160, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(465, 'ANUSH KRISHNAN ', '721120104004', 1, '2,3', 1, 3, 6, 'anushkrishnan02@gmail.com', 7871898764, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(466, 'ATHUL S JOTHI', '721120104005', 1, '3,4', 1, 3, 6, 'athulsjyothy@gmail.com', 7511102368, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(467, 'BOOMIGA', '721120104006', 1, '2,4', 1, 3, 6, 'boomigarangaraj2@gmail.com', 9600686204, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(468, 'EKAMBARAM BHANU PRAKASH', '721120104008', 1, '1,4', 1, 3, 6, 'ekambarambhanuprakash9752@gmail.com', 7093715054, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(469, 'HARI PRASATH C', '721120104009', 1, '1,4', 1, 3, 6, 'hariprasathyugan07@gmail.com', 8870177682, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(470, 'KAAVYAA S', '721120104010', 1, '1,2', 1, 3, 6, 'kaavyaa157@gmail.com', 8754905157, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(471, 'KABILAN T', '721120104011', 1, '1,3', 1, 3, 6, 'tkabilan2003@gmail.com', 6381592424, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(472, 'KONDAPANENI BHARGAV', '721120104012', 1, '1,4', 1, 3, 6, 'kondapaneni.tpt@gmail.com', 8919170700, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(473, 'KONDAREDDY NIKHILESHWAR REDDY', '721120104013', 1, '1,3', 1, 3, 6, 'nikhilnick1314@gmail.com', 9441007696, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(474, 'KOTHA CHETAN KUMAR', '721120104014', 1, '1,3', 1, 3, 6, 'chetankotha5@gmail.com', 7801039811, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(475, 'MADINENI  MADHVILATHA', '721120104015', 1, '1,4', 1, 3, 6, 'madhinenimadhavi@gmail.com', 9390225239, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(476, 'MALAVIKA R', '721120104016', 1, '1,4', 1, 3, 6, '2002malavikar@gmail.com', 9074491894, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(477, 'NAGIREDDY THRIVIKRAM REDDY', '721120104017', 1, '1,4', 1, 3, 6, 'nagireddyvikram27@gmail.com', 8555975812, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(478, 'NAGARU AJAY NAIDU', '721120104018', 1, '1,4', 1, 3, 6, 'ajaynaidu9908@gmail.com', 7993591116, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(479, 'PALAKONDA  BALA SAI REDDY', '721120104019', 1, '1,4', 1, 3, 6, 'palakondubalasai@gmail.com', 9100242998, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(480, 'PASUMARTHI SAMPATH', '721120104020', 1, '1,4', 1, 3, 6, 'pasumarthisampath879@gmail.com', 9392395719, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(481, 'PEDDI RUPA', '721120104021', 1, '1,4', 1, 3, 6, 'peddirupa2708@gmai.com', 9676195688, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(482, 'POTHANBOINA ANIL KUMAR', '721120104022', 1, '1,4', 1, 3, 6, 'anilk979278@gmail.com', 6309512563, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(483, 'POTHANA BOYINA KARTHIK', '721120104023', 1, '1,4', 1, 3, 6, 'karthikpothanaboina7744486@gmail.com', 8106822127, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(484, 'POTTABTINA  LAVANYA', '721120104024', 1, '1,4', 1, 3, 6, 'pottabattinalavanya@gmail.com', 9573389387, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(485, 'RAHUL R', '721120104025', 1, '1,4', 1, 3, 6, 'ragulvetri12@gmail.com', 6379768147, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(486, 'RENATI VENGAT SRI SUBHASH', '721120104026', 1, '1,4', 1, 3, 6, 'venkatsrisubash@gmail.com', 8500252340, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(487, 'SHAIK PASPULA SOHAIL', '721120104027', 1, '1,4', 1, 3, 6, 'imthiyazs853@gmail.com', 8247468303, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(488, 'SHAIK PEERAVALI', '721120104028', 1, '1,4', 1, 3, 6, 'arjunshaik143@gmail.com', 9392795788, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(489, 'T MOHAMMED TOUHEED', '721120104029', 1, '1,4', 1, 3, 6, 'touhit.md1234@gmail.com', 7729831701, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(490, 'THOTA  LOKESWARA  VISHNU VARDHAN', '721120104030', 1, '1,4', 1, 3, 6, 'thota.lvv888@gmail.com', 99653589071, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(491, 'TIRUMANI  KUMARASWAMY', '721120104031', 1, '1,4', 1, 3, 6, 'tirumanikumaraswamy85@gmail.com', 9553370590, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(492, 'YEDIDA  MANIKANTA', '721120104032', 1, '1,4', 1, 3, 6, 'bobbymanikanta07@gmail.com', 6309795084, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(493, 'ERABOINA VENKATA GIRI', '721120104305', 1, '1,4', 1, 3, 6, 'giriiit51@gmail.com', 7569851468, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(494, 'JINKASAGAR', '721120104307', 1, '1,4', 1, 3, 6, 'sagarjinka12@gmail.com', 9398084137, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(495, 'DHANUSH V', '721120104319', 1, '1,4', 1, 3, 6, 'dhanushthippi@gmail.com', 9361081911, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(496, 'MUSBOYINA PAVAN', '721120106001', 1, '1,4', 2, 3, 6, 'pavanmusiboyina@gmail.com', 897868417, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(497, 'CH SUNDAR PAUL', '721120106302', 1, '1,4', 2, 3, 6, 'chirumalasundharpal654@gmail.com', 9848544937, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(498, 'JYOTHI PRAKASH', '721120106306', 1, '1,4', 2, 3, 6, 'prakashboggala4@gmail.com', 9676673594, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(499, 'PECHETTI LAYASREE', '721120106313', 1, '1,4', 2, 3, 6, 'layasreepechetti@gmail.com', 9390707295, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(500, 'SARAN K', '721120105001', 1, '1,4', 3, 3, 6, 'ksaran3007@gmail.com', 8778525131, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(501, 'THAMODARAN S', '721120105002', 1, '1,4', 3, 3, 6, 'sthamu1403@gmail.com', 7010806515, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(502, 'THANGA SELVAN T', '721120105003', 1, '1,4', 3, 3, 6, 'thangaselvan383@gmail.com', 9344532668, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(503, 'KASIMALLA NARASIMHAN', '721120105312', 1, '1,4', 3, 3, 6, 'kasimallanarasimha@gmail.com', 9959251483, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(504, 'SELVA KANNAN A', '721120114001', 1, '1,4', 4, 3, 6, 'selvakannan765@gmail.com', 6384308067, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(505, ' SIDHARTH C CHANDRAN', '721120114002', 1, '1,4', 4, 3, 6, 'sidharthc199@gmail.com', 8606405832, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(506, 'CHITLURI SRI KRISHNA HAASA', '721120114314', 1, '1,4', 4, 3, 6, 'chitluri.srikrishna@gmail.com', 6301744195, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(507, 'GUNDALA DURGARAO', '721120114325', 1, '1,4', 4, 3, 6, 'gundladurgarao017@gmail.com', 8317652368, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(508, 'KARTHI T', '721120114333', 1, '1,4', 4, 3, 6, 'karthi9786962494@gmail.com', 7695842140, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(509, ' KONNE AKASH', '721120114336', 1, '1,4', 4, 3, 6, 'aakashaakash99001@gmail.com', 9391616947, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(510, 'MAHESH B N', '721120114340', 1, '1,4', 4, 3, 6, 'bokkachanna465@gmail.com', 9494292679, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(511, 'SOUNDHAR S', '721120114371', 1, '1,4', 4, 3, 6, 'soundharmech337@gmail.com', 7806883273, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(512, 'SRINATH REDDY M', '721120114373', 1, '1,4', 4, 3, 6, 'marellasrinathreddy@gmail.com', 7995755038, 3, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `master_tags`
--

CREATE TABLE `master_tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` text NOT NULL,
  `is_active` enum('1','2') NOT NULL,
  `trash_key` enum('1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_tags`
--

INSERT INTO `master_tags` (`tag_id`, `tag_name`, `is_active`, `trash_key`, `created_at`, `updated_at`) VALUES
(1, 'test', '2', '2', '2023-12-27 10:04:36', '2023-12-27 10:09:34'),
(2, 'Infosys tag', '1', '1', '2023-12-27 10:11:11', '2023-12-27 10:11:11'),
(3, 'TCS tag', '1', '1', '2023-12-27 10:11:17', '2023-12-27 10:11:17'),
(4, 'Wipro tag', '1', '1', '2023-12-27 10:11:26', '2023-12-27 10:11:26'),
(5, 'Accenture Tag', '1', '1', '2023-12-27 10:11:36', '2023-12-27 10:11:36');

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
(1, 'Arrays', '3,4', '1', '1', '2023-11-20 15:07:49', '2023-11-24 12:39:13'),
(2, 'Loops', '1,3', '1', '1', '2023-11-20 18:29:48', '2023-11-20 18:29:54'),
(4, 'STATEMENTS', '1,3', '1', '1', '2023-11-20 19:04:02', '2023-11-21 13:02:04'),
(5, 'Operators', '3', '1', '1', '2023-11-21 12:58:59', '2023-11-21 13:02:09');

-- --------------------------------------------------------

--
-- Table structure for table `mcq_grouping_questions`
--

CREATE TABLE `mcq_grouping_questions` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `question_code` varchar(40) DEFAULT NULL,
  `questions` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mcq_grouping_questions`
--

INSERT INTO `mcq_grouping_questions` (`id`, `question_id`, `question_code`, `questions`, `created_at`, `updated_at`) VALUES
(1, 25, '65ae572a765b5', '<p><strong style=\"color: rgb(68, 68, 68);\">&nbsp;In the ABO system, blood group ‘O’ is characterized by the:</strong></p>', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(2, 25, '65ae572a765b5', '<p><strong style=\"color: rgb(68, 68, 68);\">Antiserum is</strong></p>', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(3, 25, '65ae572a765b5', '<p><strong style=\"color: rgb(68, 68, 68);\">A false positive result is best described as one that is given</strong></p>', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(4, 25, '65ae572a765b5', '<p><strong style=\"color: rgb(68, 68, 68);\">Under this circumstance, an antigen-antibody reaction will occur. A person with</strong></p>', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(5, 25, '65ae572a765b5', '<p><strong style=\"color: rgb(68, 68, 68);\">Which antibodies are found in the plasma of a person with type A blood?</strong></p>', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(6, 26, '65ae5d9a22659', '<p>The Rh factor in blood groups is also known as:</p>', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(7, 26, '65ae5d9a22659', '<p>Which blood type is considered the universal donor in the ABO blood group system?</p>', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(8, 26, '65ae5d9a22659', '<p>In the ABO system, blood group \'AB\' is characterized by the presence of:</p>', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(9, 26, '65ae5d9a22659', '<p>What is the significance of the \'+\' or \'-\' in blood typing (e.g., A+, B-)?</p>', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(10, 26, '65ae5d9a22659', '<p>Which blood type is known as the \"universal recipient\" in the ABO blood group system?</p>', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(16, 27, '65af481a77470', '<p><span style=\"color: rgb(58, 58, 58);\">How did Thomas spend his day?</span></p>', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(17, 27, '65af481a77470', '<p><span style=\"color: rgb(58, 58, 58);\">Who did Thomas see on his way to school?</span></p>', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(18, 27, '65af481a77470', '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;What did Thomas want to ask the old man?</span></p>', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(19, 27, '65af481a77470', '<p><span style=\"color: rgb(58, 58, 58);\">What is the synonym of gasp?</span></p>', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(20, 27, '65af481a77470', '<p><span style=\"color: rgb(58, 58, 58);\">How much money did Thomas give to the beggar?</span></p>', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(21, 28, '65af495f1be6f', '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;The book ‘Aryabhatiya’ was written by Aryabhata when he was</span></p>', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(22, 28, '65af495f1be6f', '<p><span style=\"color: rgb(58, 58, 58);\">In modern Mathematics, what’s the approximate value of Pi?</span></p>', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(23, 28, '65af495f1be6f', '<p><span style=\"color: rgb(58, 58, 58);\">Who was the most famous disciple of Aryabhata?</span></p>', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(24, 28, '65af495f1be6f', '<p><span style=\"color: rgb(58, 58, 58);\">Which book was written by Aryabhata?</span></p>', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(25, 28, '65af495f1be6f', '<p><span style=\"color: rgb(58, 58, 58);\">What is the antonym of versed?</span></p>', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(26, 29, '65af4b42945c5', '<p>When was the term \"artificial intelligence\" first coined?</p>', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(27, 29, '65af4b42945c5', '<p>What marked a significant milestone in early AI development?</p>', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(28, 29, '65af4b42945c5', '<p>Which decade saw the rise of statistical and probabilistic models in AI?</p>', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(29, 29, '65af4b42945c5', '<p>What hindered the training of deep neural networks in the 1990s?</p>', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(30, 29, '65af4b42945c5', '<p>Which subset of machine learning gained prominence in the 21st century?</p><p><br></p>', '2024-01-23 10:44:42', '2024-01-23 10:44:42');

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
(5, '2023_11_18_063330_create_profile_master_table', 1),
(6, '2023_11_25_071431_create_student_group_table', 2),
(7, '2023_11_25_072528_create_student_group_entry_table', 3),
(8, '2023_11_25_073143_add_register_no_to_students_group_entry_table', 4),
(9, '2023_11_28_122202_create_question_bank_table', 5),
(10, '2023_11_28_122520_create_question_bank_entry_table', 5),
(11, '2023_12_05_091801_create_test_creation_table', 6),
(12, '2023_12_05_092408_create_test_creation_difficulty_wise_count_table', 7),
(13, '2023_12_14_061849_create_test_category_wise_duration_table', 8),
(15, '2024_01_04_044246_create_student_test_entries_table', 9),
(16, '2024_01_04_090612_create_students_test_question_answer_entry_table', 10);

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
-- Table structure for table `programming_question_test_case`
--

CREATE TABLE `programming_question_test_case` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `question_code` varchar(40) DEFAULT NULL,
  `input` text DEFAULT NULL,
  `output` text DEFAULT NULL,
  `sample` int(11) DEFAULT NULL,
  `weightage` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programming_question_test_case`
--

INSERT INTO `programming_question_test_case` (`id`, `question_id`, `question_code`, `input`, `output`, `sample`, `weightage`, `created_at`, `updated_at`) VALUES
(1, 21, '6597d21560fd7', '11\r\n22', 'The sum of 11 and 22 is: 33', 1, '50', '2024-01-05 15:25:33', '2024-01-05 15:25:33'),
(2, 22, '6597d431331e5', '234\r\n345\r\n456\r\n567\r\n678', 'The largest number is: 678', 1, '50', '2024-01-05 15:34:33', '2024-01-05 15:34:33'),
(3, 22, '6597d431331e5', '21\r\n54\r\n87\r\n63\r\n66', 'The largest number is: 87', 1, '50', '2024-01-05 15:34:33', '2024-01-05 15:34:33'),
(4, 23, '6597ddd20f94b', '6\r\n12 34 56 78 90 43\r\n9', 'Original array: 12 34 56 78 90 43 \nInvalid position!', 1, '30', '2024-01-05 16:15:38', '2024-01-05 16:15:38'),
(5, 23, '6597ddd20f94b', '5\r\n1 2 3 4 5\r\n3', 'Original array: 1 2 3 4 5 \r\nUpdated array: 1 2 4 5', 0, '35', '2024-01-05 16:15:38', '2024-01-05 16:15:38'),
(6, 23, '6597ddd20f94b', '7\r\n12 65 34 80 38 51 72\r\n10', 'Original array: 12 65 34 80 38 51 7 \nInvalid position!', 1, '15', '2024-01-05 16:15:38', '2024-01-05 16:15:38'),
(7, 23, '6597ddd20f94b', '5\r\n8 -2 3 -4 6\r\n4', 'Original array: 8 -2 3 -4 6 \r\nUpdated array: 8 -2 3 6', 0, '10', '2024-01-05 16:15:38', '2024-01-05 16:15:38'),
(8, 23, '6597ddd20f94b', '9\r\n10 -20 -30 40 50 -60 70 80 90\r\n6', 'Original array: 10 -20 -30 40 50 -60 70 80 90 \r\nUpdated array: 10 -20 -30 40 50 70 80 90', 0, '10', '2024-01-05 16:15:38', '2024-01-05 16:15:38'),
(9, 24, '65a8f9e0d806c', '1\r\n2', 'Enter the first number: Enter the second number: Sum: 3', 0, '100', '2024-01-18 15:43:52', '2024-01-18 15:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `question_banks`
--

CREATE TABLE `question_banks` (
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `question_code` varchar(25) NOT NULL,
  `skills_id` bigint(20) DEFAULT NULL,
  `difficulties_id` varchar(20) DEFAULT NULL,
  `topics_id` bigint(20) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `questions` text DEFAULT NULL,
  `solutions` text DEFAULT NULL,
  `tags` varchar(200) DEFAULT NULL,
  `output_run_language` varchar(200) DEFAULT NULL,
  `input_format` text DEFAULT NULL,
  `output_format` text DEFAULT NULL,
  `code_constraints` text DEFAULT NULL,
  `explanation` text DEFAULT NULL,
  `language_for_test` varchar(220) DEFAULT NULL,
  `saving_status` int(11) NOT NULL COMMENT '1=>active, 2=>draft',
  `is_active` enum('1','2') NOT NULL,
  `trash_key` enum('1','2') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_banks`
--

INSERT INTO `question_banks` (`question_id`, `question_code`, `skills_id`, `difficulties_id`, `topics_id`, `category`, `marks`, `title`, `questions`, `solutions`, `tags`, `output_run_language`, `input_format`, `output_format`, `code_constraints`, `explanation`, `language_for_test`, `saving_status`, `is_active`, `trash_key`, `created_at`, `updated_at`) VALUES
(1, '6593f736d7fee', 1, '1', 2, 2, 1, NULL, '<p>If in a certain language, MADRAS is coded as NBESBT. Then how is BOMBAY coded in that language?</p>', NULL, '2', NULL, NULL, NULL, NULL, '<p>Each letter in the word is moved one step forward to obtain the corresponding&nbsp;letter of the code.</p>', NULL, 1, '1', '1', '2024-01-02 11:44:54', '2024-01-02 11:44:54'),
(2, '6593f767e95ca', 4, '1', 1, 2, 1, NULL, '<p>In a certain code, TRIPPLE is written as SQHOOKD. How is DISPOSE written in that&nbsp;code?</p>', NULL, '4,5', NULL, NULL, NULL, NULL, '<p>Each letter in the word is moved one step backward to obtain the corresponding&nbsp;letter of the code.</p>', NULL, 1, '1', '1', '2024-01-02 11:45:43', '2024-01-02 11:45:43'),
(3, '6593f79663ec6', 1, '1', 4, 2, 1, NULL, '<p>In certain code, TOGETHER is written as RQEGRJCT. In the same code PAROLE will&nbsp;be written as?</p>', NULL, '3,5', NULL, NULL, NULL, NULL, '<p>The letters at odd positions are each moved two steps backward and those at even&nbsp;positions are each moved two steps forward to obtain the corresponding letters of the&nbsp;code.</p>', NULL, 1, '1', '1', '2024-01-02 11:46:30', '2024-01-02 11:46:30'),
(4, '6593f7cd083dc', 3, '1', 5, 2, 2, NULL, '<p>In certain language, CHAMPION is coded as HCMAIPNO, how is NEGATIVE coded in&nbsp;that code ?</p>', NULL, NULL, NULL, NULL, NULL, NULL, '<p>The letters of the word are reversed in order, taking two at a time, to obtain the&nbsp;code.</p>', NULL, 1, '1', '1', '2024-01-02 11:47:25', '2024-01-02 11:47:25'),
(5, '6593f7f744450', 3, '1', 2, 2, 1, NULL, '<p>If DELHI is coded as CCIDD, how would you encode BOMBAY?</p>', NULL, '3', NULL, NULL, NULL, NULL, '<p>The first, second, third,……. letters of the word are respectively moved one, two,&nbsp;three,…………steps backward to obtain the corresponding letters of the code.</p>', NULL, 1, '1', '1', '2024-01-02 11:48:07', '2024-01-02 11:48:07'),
(6, '6593f8371f85e', 4, '2', 1, 2, 1, NULL, '<p>Which of the followings is/are automatically added to every class in C++, if we do not write our own.</p>', NULL, NULL, NULL, NULL, NULL, NULL, '<p>In C++, if we do not write our own, the compiler automatically creates a default constructor, a copy constructor and an assignment operator for every class.</p>', NULL, 1, '1', '1', '2024-01-02 11:49:11', '2024-01-02 11:49:11'),
(7, '6593f86ce1416', 4, '2', 1, 2, 1, NULL, '<p>When a Copy Constructor may be called?</p>', NULL, NULL, NULL, NULL, NULL, NULL, '<p>All the given options are True with respect to Copy Constructor.&nbsp;</p>', NULL, 1, '1', '1', '2024-01-02 11:50:04', '2024-01-02 11:50:04'),
(8, '6593f89c9e824', 4, '4', 1, 2, 1, NULL, '<p>#include&lt;iostream&gt;using namespace std;</p><p>class Point {</p><p>&nbsp;&nbsp;Point() { cout &lt;&lt; \"Constructor called\"; }</p><p>};</p><p><br></p><p>int main(){</p><p>&nbsp;&nbsp;Point t1;</p><p>&nbsp;&nbsp;return 0;</p><p>}</p>', NULL, '4', NULL, NULL, NULL, NULL, '<p>In C++, by default all members of a class are private. So, the class Point() becomes private, as no access specifier is specified inside it. It cannot be called from inside the main() function during object creation. Hence, the compiler throws an error.</p>', NULL, 1, '1', '1', '2024-01-02 11:50:52', '2024-01-03 10:18:30'),
(9, '6593f912cb091', 4, '4', 1, 2, 1, NULL, '<p>#include&lt;iostream&gt;the using namespace std;</p><p><br></p><p>class Point {public:</p><p>&nbsp;&nbsp;Point() { cout &lt;&lt; \"Normal Constructor called\\n\"; }</p><p>&nbsp;&nbsp;Point(const Point &amp;t) { cout &lt;&lt; \"Copy constructor called\\n\"; }</p><p>};</p><p><br></p><p>int main(){</p><p>&nbsp;&nbsp;Point *t1, *t2;</p><p>&nbsp;&nbsp;t1 = new Point();</p><p>&nbsp;&nbsp;t2 = new Point(*t1);</p><p>&nbsp;&nbsp;Point t3 = *t1;</p><p>&nbsp;&nbsp;Point t4;</p><p>&nbsp;&nbsp;t4 = t3;</p><p>&nbsp;&nbsp;return 0;</p><p>}</p>', NULL, NULL, NULL, NULL, NULL, NULL, '<p>In the line t1 = new Point(10, 15);, normal constructor is called. So, the string \"Normal Constructor called\" gets printed. In the lines t2 = new Point(*t1); and Point t3 = *t1;, copy constructor is called. So, the string \"Copy constructor called\" gets printed twice. Finally, in the line Point t4;, normal constructor is called. So, the string \"Normal Constructor called\" gets printed.</p>', NULL, 1, '1', '1', '2024-01-02 11:52:50', '2024-01-03 10:17:28'),
(10, '6593f94ad8238', 4, '2', 1, 2, 1, NULL, '<p>#include&lt;iostream&gt;using namespace std;</p><p><br></p><p>class X&nbsp;</p><p>{public:</p><p>&nbsp;&nbsp;int x;</p><p>};</p><p><br></p><p>int main(){</p><p>&nbsp;&nbsp;X a = {10};</p><p>&nbsp;&nbsp;X b = a;</p><p>&nbsp;&nbsp;cout &lt;&lt; a.x &lt;&lt; \" \" &lt;&lt; b.x;</p><p>&nbsp;&nbsp;return 0;</p><p>}</p>', NULL, NULL, NULL, NULL, NULL, NULL, '<p>#include &lt;iostream&gt;using namespace std;</p><p><br></p><p>class Point</p><p>{int x, y;</p><p>public:</p><p>&nbsp;&nbsp;Point(const Point &amp;p) { x = p.x; y = p.y; }</p><p>&nbsp;&nbsp;int getX() { return x; }</p><p>&nbsp;&nbsp;int getY() { return y; }</p><p>};</p><p><br></p><p>int main(){</p><p>&nbsp;&nbsp;Point p1;</p><p>&nbsp;&nbsp;Point p2 = p1;</p><p>&nbsp;&nbsp;cout &lt;&lt; \"x = \" &lt;&lt; p2.getX() &lt;&lt; \" y = \" &lt;&lt; p2.getY();</p><p>&nbsp;&nbsp;return 0;</p><p>}</p>', NULL, 1, '1', '1', '2024-01-02 11:53:46', '2024-01-02 11:53:46'),
(11, '6593f99c5036d', 3, '3', 2, 2, 1, NULL, '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;Which type of Programming does Python support?</span></p>', NULL, NULL, NULL, NULL, NULL, NULL, '<p>P<span style=\"color: rgb(58, 58, 58);\">ython is an interpreted programming language, which supports object-oriented, structured, and functional programming.</span></p>', NULL, 1, '1', '1', '2024-01-02 11:55:08', '2024-01-02 11:55:08'),
(12, '6593f9c96411d', 3, '3', 5, 2, 1, NULL, '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;Is Python code compiled or interpreted?</span></p>', NULL, NULL, NULL, NULL, NULL, NULL, '<p><span style=\"color: rgb(58, 58, 58);\">Many languages have been implemented using both compilers and interpreters, including C, Pascal, and Python.</span></p>', NULL, 1, '1', '1', '2024-01-02 11:55:53', '2024-01-02 11:55:53'),
(13, '6593fa7256d3f', 3, '3', 5, 2, 1, NULL, '<p>i = 1</p><p>while True:</p><p>&nbsp;&nbsp;if i%3 == 0:</p><p>&nbsp;&nbsp;&nbsp;&nbsp;break</p><p>&nbsp;&nbsp;print(i)</p><p>&nbsp;</p><p>&nbsp;&nbsp;i + = 1</p>', NULL, NULL, NULL, NULL, NULL, NULL, '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;SyntaxError, there shouldn’t be a space between + and = in +=.</span></p>', NULL, 1, '1', '1', '2024-01-02 11:58:42', '2024-01-02 11:58:42'),
(14, '6593faa71083e', 3, '3', 5, 2, 1, NULL, '<p><span style=\"color: rgb(58, 58, 58);\">. Python supports the creation of anonymous functions at runtime, using a construct called __________</span></p>', NULL, NULL, NULL, NULL, NULL, NULL, '<p><span style=\"color: rgb(58, 58, 58);\">ython supports the creation of anonymous functions (i.e. functions that are not bound to a name) at runtime, using a construct called lambda. Lambda functions are restricted to a single expression. They can be used wherever normal functions can be used.</span></p>', NULL, 1, '1', '1', '2024-01-02 11:59:35', '2024-01-02 11:59:35'),
(15, '6593fada01494', 3, '3', 4, 2, 1, NULL, '<p><span style=\"color: rgb(58, 58, 58);\">What does pip stand for python?</span></p>', NULL, NULL, NULL, NULL, NULL, NULL, '<p><span style=\"color: rgb(58, 58, 58);\">pip is a package manager for python. Which is also called Preferred Installer Program.</span></p>', NULL, 1, '1', '1', '2024-01-02 12:00:26', '2024-01-02 12:00:26'),
(16, '6593fb217170a', 1, '4', 4, 2, 1, NULL, '<p>One type of liquid contains 25% of benzene, the other contains 30% of benzene. A can is filled with 6 parts of the first liquid and 4 parts of the second liquid. Find the percentage of benzene in the new mixture.</p>', NULL, NULL, NULL, NULL, NULL, NULL, '<p>Benzene in first type of liquid = 25%</p><p>Benzene in second type of liquid = 30%</p><p>Now , A can is filled with 6 parts of the first type of liquid and 4 parts of the second type of liquid.</p><p>Which means Benzene from first type of liquid = 6×(25/100)</p><p>Benzene from second type of liquid= 4×(30/100)</p><p>Therefore , Total part of benzene present in the can = 6×(25/100) + 4×(30/100)</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;= 150/100 + 120/100</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;= 270/100</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;= 27/10</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;= 2.7</p><p>Now , Total part of liquid present in the can = 6 + 4 = 10</p><p>Therefore , the percentage of Benzene in new mixture = (2.7/10)×100 = 270/10 = 27%</p><p><br></p><p><strong>Alternate:</strong></p><p><br></p><p>Let the percentage of benzene =X</p><p>(30 - X)/(X-&nbsp;25) = 6/4 = 3/2&nbsp;</p><p>=&gt; 5X = 135 or</p><p>X = 27 so,&nbsp;</p><p>required percentage of benzene = 27 %</p>', NULL, 1, '1', '1', '2024-01-02 12:01:37', '2024-01-02 12:01:37'),
(17, '6593fb54e2e68', 3, '4', 5, 2, 1, NULL, '<p>A housewife has 11 litre of solution that contains sodium carbonate solution and benzene solution in the ratio 3 : 1. She adds 250 ml of 3 : 2 solution of sodium carbonate and benzene solution to it and then uses 250 ml of the combined mixture to make strong organic solution How much of pure sodium carbonate solution is she left with?</p>', NULL, NULL, NULL, NULL, NULL, NULL, '<p>ln a mixture of 1,000 ml sodium carbonate : benzene solution = 3 : 1.</p><p>Hence, sodium carbonate: 750 ml benzene solution 250 ml</p><p>A 250 ml of 3 : 2 solution contains 150 ml sodium carbonate solution and l00ml benzene solution.</p><p>Total sodium carbonate solution = 900 ml, total benzene solution = 350 ml</p><p>After using 250 ml to make strong organic solution , sodium carbonate solution used</p><p>= 250/1250 x 900 = 180 ml</p><p>pure sodium carbonate solution left = 900 -180 =720ml</p>', NULL, 1, '1', '1', '2024-01-02 12:02:28', '2024-01-02 12:02:28'),
(18, '6593fc1ee708a', 1, '4', 4, 2, 1, NULL, '<p>There are two alloys made up of copper and aluminium. In the first alloy copper is half as much as aluminium and in the second alloy copper is thrice as much as aluminium. How many times the second alloy must be mixed with first alloy to get the new alloy in which copper is twice as much as aluminium?</p>', NULL, NULL, NULL, NULL, NULL, NULL, '<p>first alloy second alloy</p><p>C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Al&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Al</p><p>Required alloy</p><p>&nbsp;&nbsp;&nbsp;C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Al</p><p>&nbsp;&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1</p><p>Thus, Copper in first alloy = 1/3</p><p>copper in second alloy = 3/4</p><p>copper in required alloy =2/3</p>', NULL, 1, '1', '1', '2024-01-02 12:05:50', '2024-01-02 12:05:50'),
(19, '6593fc4cb6efb', 1, '4', 2, 2, 1, NULL, '<p><u>A jar contains a mixture of two liquids Acid </u> (Nitric acid) and Base (Ammonium chloride) in the ratio 4 : 1. When 10 litres of the mixture is taken out and 10 litres of liquid Base is poured into the jar, the ratio becomes 2 : 3. How many litres of liquid Acid was contained in the jar?</p>', NULL, NULL, NULL, NULL, NULL, NULL, '<p>Let quantity of liquid Base in the mixture be x litres.</p><p>Then quantity of Acid in the mixture= 4x litres</p><p>Quantity of Acid in 10 litres of mixture = (4/5) × 10 = 8 litres</p><p>Quantity of Base in 10 litres of mixture = 10–8 = 2 litres</p><p>So, the remaining quantity of Acid and Base in the mixture 4x-8, x-2 litres respectively.</p><p>After adding 10 litres of Base with the mixture the ratio of the quantity of Acid and Base</p><p>= (4x-8)/(x-2+10)=(4x-8)/(x+8) = 2/3</p><p>=&gt; 12x - 24 = 2x + 16 =&gt; 12x - 2x = 16 + 24</p><p>=&gt; 10x = 40 =&gt; x = 40/10= 4 lit</p><p>So, quantity of liquid A in the mixture = 4x = 4 × 4 =16 litres</p><p><br></p><p>Alternate:</p><p>Percentage of liquid Base in the original mixture = 1/5 x 100 = 20%</p><p>In the final mixture % of the liquid Base = 3/5 x 100 = 60%</p><p>Now, using the rule of allegation</p><p>Hence, reduced quantity of the first mixture and the quantity of mixture B which is to be added are the same.</p><p>Total mixture = 10 + 10 = 20 liters and quantity of liquid A = 20/5 x 4 = 16</p>', NULL, 1, '1', '1', '2024-01-02 12:06:36', '2024-01-03 10:01:40'),
(20, '6593fc77c2a2a', 1, '4', 4, 2, 1, NULL, '<p>A solution of cough syrup has 15% alcohol. Another solution has 5% alcohol. How many litres of the second solution must be added to 20 litres of the first solution to make a solution of 10% alcohol?</p>', NULL, NULL, NULL, NULL, NULL, NULL, '<p>Hence both the types should be added in the ratio of 1 : 1 to obtain the required strength.&nbsp;</p><p>Hence 20 litres of first type should be added to the 20 litres of the second type to get the desired solution.</p>', NULL, 1, '1', '1', '2024-01-02 12:07:19', '2024-01-02 12:07:39'),
(21, '6597d21560fd7', 4, '1', 1, 1, 10, NULL, '<h3>&nbsp;Find the largest number among the three numbers.</h3><p><br></p>', '#include <stdio.h>\r\n\r\nint main() {\r\n    // Declare variables to store input and result\r\n    int num1, num2, sum;\r\n\r\n    // Get user input\r\n    scanf(\"%d\", &num1);\r\n\r\n    scanf(\"%d\", &num2);\r\n\r\n    // Calculate the sum\r\n    sum = num1 + num2;\r\n\r\n    // Display the result\r\n    printf(\"The sum of %d and %d is: %d\\n\", num1, num2, sum);\r\n\r\n    return 0;\r\n}', '2', 'csharp', 'The sum of a and b', 'The sum of 11 and 22 is: 33', 'Code Constraints', NULL, NULL, 1, '1', '1', '2024-01-05 09:55:33', '2024-01-05 09:55:33'),
(22, '6597d431331e5', 4, '1', 1, 1, 10, NULL, '<p>find largest numbers from 5 numbers</p>', '#include <stdio.h>\r\n\r\nint main() {\r\n    // Declare variables to store input and result\r\n    int num1, num2, num3, num4, num5, largest;\r\n\r\n    // Get user input\r\n    scanf(\"%d %d %d %d %d\", &num1, &num2, &num3, &num4, &num5);\r\n\r\n    // Assume the first number is the largest initially\r\n    largest = num1;\r\n\r\n    // Compare with the remaining numbers\r\n    if (num2 > largest) {\r\n        largest = num2;\r\n    }\r\n    if (num3 > largest) {\r\n        largest = num3;\r\n    }\r\n    if (num4 > largest) {\r\n        largest = num4;\r\n    }\r\n    if (num5 > largest) {\r\n        largest = num5;\r\n    }\r\n\r\n    // Display the result\r\n    printf(\"The largest number is: %d\\n\", largest);\r\n\r\n    return 0;\r\n}', '3', 'csharp', 'num 1\r\nnum 2\r\nnum 3\r\nnum 4\r\nnum 5', 'The largest number is: 87', 'Code Constraints', NULL, NULL, 1, '1', '1', '2024-01-05 10:04:33', '2024-01-05 10:04:33'),
(23, '6597ddd20f94b', 4, '2', 1, 1, 20, NULL, '<p>Write a program to delete an element from an array. The program should prompt the user to enter the position of the element to</p><p>be deleted and then display the updated array without that element.</p>', '#include <iostream>\nint main() {\nconst int MAX_SIZE = 100; // Maximum size of the array\nint arr[MAX_SIZE]; // Array to store the elements\nint size; // Actual size of the array\n// Read the size of the array from the user\n//std::cout << \"Enter the size of the array: \";\nstd::cin >> size;\n// Read the elements of the array from the user\n// std::cout << \"Enter the elements of the array:\\n\";\nfor (int i = 0; i < size; i++) {\n// std::cout << \"Element \" << i + 1 << \": \";\nstd::cin >> arr[i];\n}\n// Display the original array\nstd::cout << \"Original array: \";\nfor (int i = 0; i < size; i++) {\nstd::cout << arr[i] << \" \";\n}\nstd::cout << std::endl;\n// Prompt the user to enter the position of the element to be deleted\nint position;\n// std::cout << \"Enter the position of the element to be deleted: \";\nstd::cin >> position;\n// Validate the position\nif (position < 1 || position > size) {\nstd::cout << \"Invalid position!\" << std::endl;\nreturn 0;\n}\n// Shift the elements to the left to overwrite the element to be deleted\nfor (int i = position - 1; i < size - 1; i++) {\narr[i] = arr[i + 1];\n}\n// Decrement the size of the array\nsize--;\n// Display the updated array\nstd::cout << \"Updated array: \";\nfor (int i = 0; i < size; i++) {\nstd::cout << arr[i] << \" \";\n}std::cout << std::endl;\nreturn 0;\n}', NULL, 'csharp', 'The first line of input contains an integer representing the size of the array.\r\nThe second line of input contains the elements of the array, separated by a space.\r\nThe last line of input contains an integer to enter the position of the element to be deleted.', 'The output displays the original array before deletion and the updated array after deletion.', 'Maximum size of the array (MAX_SIZE = 100)\r\nThe size of the array should be a positive integer.\r\nThe elements of the array can be both positive and negative integers.', NULL, NULL, 1, '1', '1', '2024-01-05 10:45:38', '2024-01-05 10:45:38'),
(24, '65a8f9e0d806c', NULL, NULL, NULL, 1, NULL, NULL, NULL, '#include <stdio.h>\r\n\r\nint main() {\r\n    // Declare variables to store the two numbers\r\n    int num1, num2;\r\n\r\n    // Prompt the user to enter the first number\r\n    printf(\"Enter the first number: \");\r\n    scanf(\"%d\", &num1);\r\n\r\n    // Prompt the user to enter the second number\r\n    printf(\"Enter the second number: \");\r\n    scanf(\"%d\", &num2);\r\n\r\n    // Calculate the sum\r\n    int sum = num1 + num2;\r\n\r\n    // Display the result\r\n    printf(\"Sum: %d\\n\", sum);\r\n\r\n    return 0;\r\n}', NULL, 'csharp', NULL, NULL, NULL, NULL, NULL, 2, '1', '2', '2024-01-18 10:13:52', '2024-01-18 10:13:52'),
(25, '65ae572a765b5', 4, '1', 1, 3, 5, '<p><span style=\"color: rgb(68, 68, 68);\">A blood group or blood type is a blood-classification, categorized on the basis of presence and absence of antibodies and inherited antigenic particles on the surface of RBCs.</span></p>', NULL, NULL, '4', NULL, NULL, NULL, NULL, NULL, NULL, 1, '1', '1', '2024-01-22 11:53:14', '2024-01-22 11:53:14'),
(26, '65ae5d9a22659', 1, '2', 2, 3, 5, '<p>Blood group classification is a system that categorizes individuals based on the presence or absence of specific antigens and antibodies in their blood. The ABO system, one of the most widely used, classifies blood into four main types: A, B, AB, and O. Additionally, the Rh factor, denoted by the presence (+) or absence (-) of the Rhesus factor, further refines classifications. Understanding blood groups is crucial for safe blood transfusions and organ transplants</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1', '1', '2024-01-22 12:20:42', '2024-01-22 12:20:42'),
(27, '65af481a77470', 1, '4', 2, 3, 5, '<p>When Thomas was fifteen, he was a very intelligent and generous boy. He spent his day only reading, eating, and sleeping. Other than that, he didn’t do anything. When the teachers of his class asked him any question, he would answer it very immediately.</p><p>He always kept himself away from social activities, but once when he was going to his school, he saw a very old man begging on the roadside.</p><p>At first, he thought that he should stop there and ask him why he was begging because he was too old to do that, instead, he should rest. At the same time, he realized that if he stopped there, he would be late for school.</p><p>He thought for a while and went to the old man. He saw that everyone was passing by him but no one was giving him alms. After seeing the incident, he took out twenty rupees from his pocket and gave them to the beggar. By doing that, he felt very good and reached the school gasping.</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1', '1', '2024-01-23 05:01:14', '2024-01-23 05:02:00'),
(28, '65af495f1be6f', 1, '1', 2, 3, 5, '<p>It’s believed that Aryabhata was born in 476 AD at Kusumpur, Bihar. He was a versed and intelligent person, so he had many disciples. Varaha Mihir was one of his most famous disciples. When he was twenty-three years old, he wrote a book called Aryabhatiya.</p><p>He completed his education at Nalanda University. He was also the Vice-Chancellor of the University.</p><iframe class=\"ql-video ql-align-center\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://googleads.g.doubleclick.net/pagead/ads?gdpr=0&amp;client=ca-pub-8539933879463593&amp;output=html&amp;h=280&amp;adk=303147746&amp;adf=3159996084&amp;pi=t.aa~a.2864569533~i.167~rp.4&amp;w=785&amp;fwrn=4&amp;fwrnh=100&amp;lmt=1705925664&amp;num_ads=1&amp;rafmt=1&amp;armr=3&amp;sem=mc&amp;pwprc=1622821286&amp;ad_type=text_image&amp;format=785x280&amp;url=https%3A%2F%2Fsyllabusfy.in%2Funseen-passage-with-multiple-choice-questions%2F&amp;host=ca-host-pub-2644536267352236&amp;fwr=0&amp;pra=3&amp;rh=197&amp;rw=785&amp;rpe=1&amp;resp_fmts=3&amp;wgl=1&amp;fa=27&amp;uach=WyJXaW5kb3dzIiwiMTUuMC4wIiwieDg2IiwiIiwiMTIwLjAuNjA5OS4yMjUiLG51bGwsMCxudWxsLCI2NCIsW1siTm90X0EgQnJhbmQiLCI4LjAuMC4wIl0sWyJDaHJvbWl1bSIsIjEyMC4wLjYwOTkuMjI1Il0sWyJHb29nbGUgQ2hyb21lIiwiMTIwLjAuNjA5OS4yMjUiXV0sMF0.&amp;dt=1705985788072&amp;bpp=1&amp;bdt=1673&amp;idt=0&amp;shv=r20240118&amp;mjsv=m202401220101&amp;ptt=9&amp;saldr=aa&amp;abxe=1&amp;cookie=ID%3Dc65fb7dc9e826336%3AT%3D1705985789%3ART%3D1705985789%3AS%3DALNI_MbWPIBIeZE6xz_L_wmTBuC50vVbeA&amp;gpic=UID%3D00000cedf5307131%3AT%3D1705985789%3ART%3D1705985789%3AS%3DALNI_MaOA4jTmJctNefVrZbJoorwmjQCVA&amp;prev_fmts=0x0%2C785x280%2C1903x945%2C200x600%2C1005x124%2C785x280%2C785x280&amp;nras=8&amp;correlator=955275033654&amp;rume=1&amp;frm=20&amp;pv=1&amp;ga_vid=1253816125.1705985787&amp;ga_sid=1705985787&amp;ga_hid=30499733&amp;ga_fc=1&amp;u_tz=330&amp;u_his=2&amp;u_h=1080&amp;u_w=1920&amp;u_ah=1032&amp;u_aw=1920&amp;u_cd=24&amp;u_sd=1&amp;dmc=8&amp;adx=402&amp;ady=7729&amp;biw=1903&amp;bih=945&amp;scr_x=0&amp;scr_y=3959&amp;eid=95320239%2C44759876%2C44759927%2C44759837%2C31079265%2C31080334%2C95322746%2C31080602%2C95321626%2C95321967%2C95322164%2C31061691%2C31061693%2C31078663%2C31078665%2C31078668%2C31078670&amp;oid=2&amp;psts=AOrYGskc6QsTiZ8KmbgEPSOZqI3DltAsiXfqU1OsljwYQkLFEpi5usdUolrLd7vKouMNhREwVAlBtKoBgCF9HdE_Rj1tDl65E309Y3FcHlKTO9hVNIET9w%2CAOrYGsmrpjzAkxqwI2DIjxJRiF904IgvvH4ooweLx4rh072UHMg81zGQ6E3UZuq-5Svi1cyEz8g9rr7Aob-r3PK-t37mzjmYdLpIw-e6xHQNTOt2YRkNqg%2CAOrYGsmW-nt9p3DmXg6MxWbwVB1R6zK5nl710qIF0NNvS2ghOISgBCYFDJCyLTfSfnqjdkVbbdcyp24IGK1A1LqR%2CAOrYGsnX9eYCpcB_ix4BtpC2hQ6QyXKPrP20CFkyVSgm6yLkeDIkxS5GzDuh3XS2C6-YhNV8tM3H_C9yt62LR2Hw%2CAOrYGsk5uK3qLiAfXFIkM-op6aDbO3o6wLxtMA9u6eE7yC_brnN0_hI-LuuKBr-YTdTZyTnzEDIlA7yOON8NaF9x&amp;pvsid=4344685189559183&amp;tmod=1176842998&amp;uas=1&amp;nvt=1&amp;topics=1&amp;tps=1&amp;ref=https%3A%2F%2Fwww.google.com%2F&amp;fc=1408&amp;brdim=0%2C0%2C0%2C0%2C1920%2C0%2C1920%2C1032%2C1920%2C945&amp;vis=1&amp;rsz=%7C%7Cs%7C&amp;abl=NS&amp;fu=128&amp;bc=31&amp;bz=1&amp;td=1&amp;psd=W251bGwsbnVsbCxudWxsLDNd&amp;nt=1&amp;ifi=5&amp;uci=a!5&amp;btvi=6&amp;fsb=1&amp;dtd=73101\" height=\"0\" width=\"785\"></iframe><p class=\"ql-align-center\"><br></p><p>On the principles of Aryabhata or influenced by him, Bhaskar wrote a book called Tika. He also wrote many other books like Mahabhaskariya, Laghubhaskariya, and Bhashya.</p><p>Aryabhata was a great Mathematician of ancient times. He made his contribution not only to the field of mathematics but also to astronomy. It was he who told us that the earth rotates on its axis. Apart from this, he also represented the Pi value more accurately.</p><p>In modern mathematics, the Pi value is considered to be approximately 3.14159. He also discovered Zero.</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1', '1', '2024-01-23 05:06:39', '2024-01-23 05:06:39'),
(29, '65af4b42945c5', 1, '1', 2, 3, 5, '<p>Artificial Intelligence (AI) is a multidisciplinary field that involves the development of intelligent agents capable of performing tasks that typically require human intelligence. The journey of AI dates back to ancient times when humans sought to create machines that could mimic cognitive functions. However, the modern era of AI began in the mid-20th century.</p><p>The term \"artificial intelligence\" was coined in 1956, during the Dartmouth Conference, where researchers aimed to explore how machines could simulate human thought processes. Early AI efforts focused on symbolic reasoning, logic, and problem-solving. The development of the first AI programs, such as the Logic Theorist and General Problem Solver, marked significant milestones.</p><p>In the 1960s and 1970s, AI researchers faced challenges as symbolic AI struggled to handle uncertainty and real-world complexity. This led to the emergence of new approaches, including machine learning. The idea of enabling machines to learn from data and improve their performance over time gained traction.</p><p>The 1980s saw advancements in expert systems, rule-based systems that attempted to emulate human expertise in specific domains. While these systems demonstrated success in some applications, they were limited by their rigid rule structures and inability to adapt to new information.</p><p>The 1990s brought a shift towards statistical and probabilistic models, with a renewed emphasis on machine learning. The rise of neural networks, inspired by the human brain\'s structure, contributed to breakthroughs in pattern recognition and language processing. However, computational limitations hindered the training of deep neural networks during this period.</p><p>The 21st century witnessed the resurgence of AI, fueled by increased computational power, big data, and algorithmic advancements. Deep learning, a subset of machine learning, gained prominence, enabling the training of complex neural networks. Applications like image recognition, natural language processing, and game-playing demonstrated the power of deep learning.</p><p>In recent years, AI has permeated various aspects of our lives, from virtual assistants and recommendation systems to autonomous vehicles and healthcare applications. Ethical considerations and concerns about bias in AI algorithms have also become significant topics of discussion.</p><p>The future of AI holds promises and challenges. Continued research aims to address issues of interpretability, robustness, and the ethical implications of AI technologies. As AI evolves, it is likely to play an increasingly vital role in shaping industries, economies, and society as a whole.</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1', '1', '2024-01-23 05:14:42', '2024-01-23 05:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `question_bank_entry`
--

CREATE TABLE `question_bank_entry` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_code` varchar(30) NOT NULL,
  `title_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `trash_key` enum('1','2') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_bank_for_mcq`
--

CREATE TABLE `question_bank_for_mcq` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `grouping_question_id` int(11) DEFAULT NULL,
  `question_code` varchar(40) DEFAULT NULL,
  `option_name` text DEFAULT NULL,
  `option_answer` text DEFAULT NULL,
  `correct_answer` varchar(10) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_bank_for_mcq`
--

INSERT INTO `question_bank_for_mcq` (`id`, `question_id`, `grouping_question_id`, `question_code`, `option_name`, `option_answer`, `correct_answer`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '6593f736d7fee', 'Option A', '<p>CPNCBX</p>', '0', '2024-01-02 17:14:54', '2024-01-02 17:14:54'),
(2, 1, NULL, '6593f736d7fee', 'Option B', '<p>CPNCBZ</p>', '1', '2024-01-02 17:14:54', '2024-01-02 17:14:54'),
(3, 1, NULL, '6593f736d7fee', 'Option C', '<p>CPOCBZ</p>', '0', '2024-01-02 17:14:54', '2024-01-02 17:14:54'),
(4, 1, NULL, '6593f736d7fee', 'Option D', '<p>CQOCBZ</p>', '0', '2024-01-02 17:14:54', '2024-01-02 17:14:54'),
(5, 2, NULL, '6593f767e95ca', 'Option A', '<p>CHRONRD</p>', '1', '2024-01-02 17:15:43', '2024-01-02 17:15:43'),
(6, 2, NULL, '6593f767e95ca', 'Option B', '<p>DSOESPI</p>', '0', '2024-01-02 17:15:43', '2024-01-02 17:15:43'),
(7, 2, NULL, '6593f767e95ca', 'Option C', '<p>ESJTPTF</p>', '0', '2024-01-02 17:15:43', '2024-01-02 17:15:43'),
(8, 2, NULL, '6593f767e95ca', 'Option D', '<p>ESOPSID</p>', '0', '2024-01-02 17:15:43', '2024-01-02 17:15:43'),
(9, 3, NULL, '6593f79663ec6', 'Option A', '<p>NCPQJG</p>', '1', '2024-01-02 17:16:30', '2024-01-02 17:16:30'),
(10, 3, NULL, '6593f79663ec6', 'Option B', '<p>NCQPJG</p>', '0', '2024-01-02 17:16:30', '2024-01-02 17:16:30'),
(11, 3, NULL, '6593f79663ec6', 'Option C', '<p>RCPQJK</p><p><br></p><p><br></p>', '0', '2024-01-02 17:16:30', '2024-01-02 17:16:30'),
(12, 3, NULL, '6593f79663ec6', 'Option D', '<p>RCTQNG</p>', '0', '2024-01-02 17:16:30', '2024-01-02 17:16:30'),
(13, 4, NULL, '6593f7cd083dc', 'Option A', '<p>ENAGITEV</p><p><br></p><p><br></p><p><br></p>', '1', '2024-01-02 17:17:25', '2024-01-02 17:17:25'),
(14, 4, NULL, '6593f7cd083dc', 'Option B', '<p>NEAGVEIT</p>', '0', '2024-01-02 17:17:25', '2024-01-02 17:17:25'),
(15, 4, NULL, '6593f7cd083dc', 'Option C', '<p>MGAETVIE</p>', '0', '2024-01-02 17:17:25', '2024-01-02 17:17:25'),
(16, 4, NULL, '6593f7cd083dc', 'Option D', '<p>EGAITEVN</p>', '0', '2024-01-02 17:17:25', '2024-01-02 17:17:25'),
(17, 5, NULL, '6593f7f744450', 'Option A', '<p>AJMTVT</p><p><br></p><p><br></p><p><br></p><p><br></p>', '0', '2024-01-02 17:18:07', '2024-01-02 17:18:07'),
(18, 5, NULL, '6593f7f744450', 'Option B', '<p>AMJXVS</p>', '1', '2024-01-02 17:18:07', '2024-01-02 17:18:07'),
(19, 5, NULL, '6593f7f744450', 'Option C', '<p>MJXVSU</p>', '0', '2024-01-02 17:18:07', '2024-01-02 17:18:07'),
(20, 5, NULL, '6593f7f744450', 'Option D', '<p>WXYZAX</p>', '0', '2024-01-02 17:18:07', '2024-01-02 17:18:07'),
(21, 6, NULL, '6593f8371f85e', 'Option A', '<p>Copy Constructor</p><p><br></p><p><br></p>', '0', '2024-01-02 17:19:11', '2024-01-02 17:19:11'),
(22, 6, NULL, '6593f8371f85e', 'Option B', '<p>Assignment Operator</p><p><br></p>', '0', '2024-01-02 17:19:11', '2024-01-02 17:19:11'),
(23, 6, NULL, '6593f8371f85e', 'Option C', '<p>A constructor without any parameter</p>', '0', '2024-01-02 17:19:11', '2024-01-02 17:19:11'),
(24, 6, NULL, '6593f8371f85e', 'Option D', '<p>All of the above</p>', '1', '2024-01-02 17:19:11', '2024-01-02 17:19:11'),
(25, 7, NULL, '6593f86ce1416', 'Option A', '<p>When an object of the class is returned by value.</p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p>', '0', '2024-01-02 17:20:04', '2024-01-02 17:20:04'),
(26, 7, NULL, '6593f86ce1416', 'Option B', '<p>When an object of the class is passed (to a function) by value as an argument.</p>', '0', '2024-01-02 17:20:04', '2024-01-02 17:20:04'),
(27, 7, NULL, '6593f86ce1416', 'Option C', '<p>When an object is constructed based on another object of the same class</p>', '0', '2024-01-02 17:20:04', '2024-01-02 17:20:04'),
(28, 7, NULL, '6593f86ce1416', 'Option D', '<p>When compiler generates a temporary object.</p>', '0', '2024-01-02 17:20:04', '2024-01-02 17:20:04'),
(29, 7, NULL, '6593f86ce1416', 'Option E', '<p>All of the above</p>', '1', '2024-01-02 17:20:04', '2024-01-02 17:20:04'),
(38, 10, NULL, '6593f94ad8238', 'Option A', '<p>Compiler Error</p>', '0', '2024-01-02 17:23:46', '2024-01-02 17:23:46'),
(39, 10, NULL, '6593f94ad8238', 'Option B', '<p>10 followed by Garbage Value</p>', '0', '2024-01-02 17:23:46', '2024-01-02 17:23:46'),
(40, 10, NULL, '6593f94ad8238', 'Option C', '<p>10 10</p>', '1', '2024-01-02 17:23:46', '2024-01-02 17:23:46'),
(41, 10, NULL, '6593f94ad8238', 'Option D', '<p>10 0</p>', '0', '2024-01-02 17:23:46', '2024-01-02 17:23:46'),
(42, 11, NULL, '6593f99c5036d', 'Option A', '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;object-oriented programming</span></p>', '0', '2024-01-02 17:25:08', '2024-01-02 17:25:08'),
(43, 11, NULL, '6593f99c5036d', 'Option B', '<p><span style=\"color: rgb(58, 58, 58);\">structured programming</span></p>', '0', '2024-01-02 17:25:08', '2024-01-02 17:25:08'),
(44, 11, NULL, '6593f99c5036d', 'Option C', '<p><span style=\"color: rgb(58, 58, 58);\">functional programming</span></p>', '0', '2024-01-02 17:25:08', '2024-01-02 17:25:08'),
(45, 11, NULL, '6593f99c5036d', 'Option D', '<p><span style=\"color: rgb(58, 58, 58);\">all of the mentioned</span></p>', '1', '2024-01-02 17:25:08', '2024-01-02 17:25:08'),
(46, 12, NULL, '6593f9c96411d', 'Option A', '<p><span style=\"color: rgb(58, 58, 58);\">Python code is both compiled and interpreted</span></p>', '1', '2024-01-02 17:25:53', '2024-01-02 17:25:53'),
(47, 12, NULL, '6593f9c96411d', 'Option B', '<p><span style=\"color: rgb(58, 58, 58);\">Python code is neither compiled nor interpreted</span></p>', '0', '2024-01-02 17:25:53', '2024-01-02 17:25:53'),
(48, 12, NULL, '6593f9c96411d', 'Option C', '<p><span style=\"color: rgb(58, 58, 58);\">Python code is only compiled</span></p>', '0', '2024-01-02 17:25:53', '2024-01-02 17:25:53'),
(49, 12, NULL, '6593f9c96411d', 'Option D', '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;Python code is only interpreted</span></p>', '0', '2024-01-02 17:25:53', '2024-01-02 17:25:53'),
(50, 13, NULL, '6593fa7256d3f', 'Option A', '<p>1 2 3</p>', '0', '2024-01-02 17:28:42', '2024-01-02 17:28:42'),
(51, 13, NULL, '6593fa7256d3f', 'Option B', '<p>error</p>', '1', '2024-01-02 17:28:42', '2024-01-02 17:28:42'),
(52, 13, NULL, '6593fa7256d3f', 'Option C', '<p>1 2</p>', '0', '2024-01-02 17:28:42', '2024-01-02 17:28:42'),
(53, 13, NULL, '6593fa7256d3f', 'Option D', '<p><span style=\"color: rgb(58, 58, 58);\">none of the mentioned</span></p>', '0', '2024-01-02 17:28:42', '2024-01-02 17:28:42'),
(54, 14, NULL, '6593faa71083e', 'Option A', '<p>pi</p>', '0', '2024-01-02 17:29:35', '2024-01-02 17:29:35'),
(55, 14, NULL, '6593faa71083e', 'Option B', '<p><span style=\"color: rgb(58, 58, 58);\">anonymous</span></p>', '0', '2024-01-02 17:29:35', '2024-01-02 17:29:35'),
(56, 14, NULL, '6593faa71083e', 'Option C', '<p><span style=\"color: rgb(58, 58, 58);\">lambda</span></p>', '1', '2024-01-02 17:29:35', '2024-01-02 17:29:35'),
(57, 14, NULL, '6593faa71083e', 'Option D', '<p><span style=\"color: rgb(58, 58, 58);\">none of the mentioned</span></p>', '0', '2024-01-02 17:29:35', '2024-01-02 17:29:35'),
(58, 15, NULL, '6593fada01494', 'Option A', '<p><span style=\"color: rgb(58, 58, 58);\">Pip Installs Python</span></p>', '0', '2024-01-02 17:30:26', '2024-01-02 17:30:26'),
(59, 15, NULL, '6593fada01494', 'Option B', '<p><span style=\"color: rgb(58, 58, 58);\">Pip Installs Packages</span></p>', '0', '2024-01-02 17:30:26', '2024-01-02 17:30:26'),
(60, 15, NULL, '6593fada01494', 'Option C', '<p><span style=\"color: rgb(58, 58, 58);\">Preferred Installer Program</span></p>', '1', '2024-01-02 17:30:26', '2024-01-02 17:30:26'),
(61, 15, NULL, '6593fada01494', 'Option D', '<p><span style=\"color: rgb(58, 58, 58);\">All of the mentioned</span></p>', '0', '2024-01-02 17:30:26', '2024-01-02 17:30:26'),
(62, 16, NULL, '6593fb217170a', 'Option A', '<p>28</p>', '0', '2024-01-02 17:31:37', '2024-01-02 17:31:37'),
(63, 16, NULL, '6593fb217170a', 'Option B', '<p>35</p>', '0', '2024-01-02 17:31:37', '2024-01-02 17:31:37'),
(64, 16, NULL, '6593fb217170a', 'Option C', '<p>30</p>', '0', '2024-01-02 17:31:37', '2024-01-02 17:31:37'),
(65, 16, NULL, '6593fb217170a', 'Option D', '<p>27</p>', '1', '2024-01-02 17:31:37', '2024-01-02 17:31:37'),
(66, 17, NULL, '6593fb54e2e68', 'Option A', '<p>1000 ml</p>', '0', '2024-01-02 17:32:28', '2024-01-02 17:32:28'),
(67, 17, NULL, '6593fb54e2e68', 'Option B', '<p>912.5 ml</p>', '0', '2024-01-02 17:32:28', '2024-01-02 17:32:28'),
(68, 17, NULL, '6593fb54e2e68', 'Option C', '<p>750 ml</p>', '0', '2024-01-02 17:32:28', '2024-01-02 17:32:28'),
(69, 17, NULL, '6593fb54e2e68', 'Option D', '<p>720 ml</p>', '1', '2024-01-02 17:32:28', '2024-01-02 17:32:28'),
(70, 18, NULL, '6593fc1ee708a', 'Option A', '<p>2</p>', '0', '2024-01-02 17:35:50', '2024-01-02 17:35:50'),
(71, 18, NULL, '6593fc1ee708a', 'Option B', '<p>3</p>', '0', '2024-01-02 17:35:50', '2024-01-02 17:35:50'),
(72, 18, NULL, '6593fc1ee708a', 'Option C', '<p>4</p>', '1', '2024-01-02 17:35:50', '2024-01-02 17:35:50'),
(73, 18, NULL, '6593fc1ee708a', 'Option D', '<p>5</p>', '0', '2024-01-02 17:35:50', '2024-01-02 17:35:50'),
(86, 20, NULL, '6593fc77c2a2a', 'Option A', '<p>5</p>', '0', '2024-01-02 17:37:39', '2024-01-02 17:37:39'),
(87, 20, NULL, '6593fc77c2a2a', 'Option B', '<p>10</p>', '0', '2024-01-02 17:37:39', '2024-01-02 17:37:39'),
(88, 20, NULL, '6593fc77c2a2a', 'Option C', '<p>15</p>', '0', '2024-01-02 17:37:39', '2024-01-02 17:37:39'),
(89, 20, NULL, '6593fc77c2a2a', 'Option D', '<p>20</p>', '1', '2024-01-02 17:37:39', '2024-01-02 17:37:39'),
(90, 19, NULL, '6593fc4cb6efb', 'Option A', '<p>14</p>', '0', '2024-01-03 15:31:40', '2024-01-03 15:31:40'),
(91, 19, NULL, '6593fc4cb6efb', 'Option B', '<p>18</p>', '0', '2024-01-03 15:31:40', '2024-01-03 15:31:40'),
(92, 19, NULL, '6593fc4cb6efb', 'Option C', '<p>20</p>', '0', '2024-01-03 15:31:40', '2024-01-03 15:31:40'),
(93, 19, NULL, '6593fc4cb6efb', 'Option D', '<p>16</p>', '1', '2024-01-03 15:31:40', '2024-01-03 15:31:40'),
(94, 9, NULL, '6593f912cb091', 'Option A', '<p>Normal Constructor called</p><p>Normal Constructor called</p><p>Normal Constructor called</p><p><br></p><p>Copy Constructor called</p><p>Copy Constructor called</p><p>Normal Constructor called</p><p><br></p><p>Copy Constructor called</p>', '0', '2024-01-03 15:47:28', '2024-01-03 15:47:28'),
(95, 9, NULL, '6593f912cb091', 'Option B', '<p>Normal Constructor called</p><p>Copy Constructor called</p><p>Copy Constructor called</p><p>Normal Constructor called</p><p>Copy Constructor called</p>', '0', '2024-01-03 15:47:28', '2024-01-03 15:47:28'),
(96, 9, NULL, '6593f912cb091', 'Option C', '<p>Normal Constructor called</p><p><br></p><p>Copy Constructor called</p><p><br></p><p>Copy Constructor called</p><p><br></p><p>Normal Constructor called</p>', '1', '2024-01-03 15:47:28', '2024-01-03 15:47:28'),
(97, 9, NULL, '6593f912cb091', 'Option D', '<p>Normal Constructor called</p><p><br></p><p>Copy Constructor called</p><p><br></p><p>Normal Constructor called</p>', '0', '2024-01-03 15:47:28', '2024-01-03 15:47:28'),
(98, 8, NULL, '6593f89c9e824', 'Option A', '<p>Compiler Error</p><p><br></p>', '1', '2024-01-03 15:48:30', '2024-01-03 15:48:30'),
(99, 8, NULL, '6593f89c9e824', 'Option B', '<p>Runtime Error</p><p><br></p>', '0', '2024-01-03 15:48:30', '2024-01-03 15:48:30'),
(100, 8, NULL, '6593f89c9e824', 'Option C', '<p>Constructor called</p>', '0', '2024-01-03 15:48:30', '2024-01-03 15:48:30'),
(101, 8, NULL, '6593f89c9e824', 'Option D', '<p>All of the above</p>', '0', '2024-01-03 15:48:30', '2024-01-03 15:48:30'),
(102, 25, 1, '65ae572a765b5', 'Option A', '<p><span style=\"color: rgb(68, 68, 68);\">&nbsp;presence of antigen O</span></p>', '0', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(103, 25, 1, '65ae572a765b5', 'Option B', '<p><span style=\"color: rgb(68, 68, 68);\">presence of both antigen A and antigen B</span></p>', '0', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(104, 25, 1, '65ae572a765b5', 'Option C', '<p><span style=\"color: rgb(68, 68, 68);\">absence of both antigen A and antigen B</span></p>', '1', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(105, 25, 1, '65ae572a765b5', 'Option D', '<p><span style=\"color: rgb(68, 68, 68);\">presence of antigen A and absence of antigen B</span></p>', '0', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(106, 25, 2, '65ae572a765b5', 'Option A', '<p><span style=\"color: rgb(68, 68, 68);\">blood serum containing specific antibodies</span></p>', '1', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(107, 25, 2, '65ae572a765b5', 'Option B', '<p><span style=\"color: rgb(68, 68, 68);\">blood serum containing specific antigens</span></p>', '0', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(108, 25, 2, '65ae572a765b5', 'Option C', '<p><span style=\"color: rgb(68, 68, 68);\">&nbsp;blood serum containing a mixture of antigens and antibodies</span></p>', '0', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(109, 25, 2, '65ae572a765b5', 'Option D', '<p><span style=\"color: rgb(68, 68, 68);\">&nbsp;blood serum in which antigens and antibodies are both absent</span></p>', '0', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(110, 25, 3, '65ae572a765b5', 'Option A', '<p><span style=\"color: rgb(68, 68, 68);\">&nbsp;by a substance other than that being tested for</span></p>', '1', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(111, 25, 3, '65ae572a765b5', 'Option B', '<p><span style=\"color: rgb(68, 68, 68);\">&nbsp;when the substance being tested for is present in large amounts</span></p>', '0', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(112, 25, 3, '65ae572a765b5', 'Option C', '<p><span style=\"color: rgb(68, 68, 68);\">&nbsp;when substance being tested for is present in minute quantities</span></p>', '0', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(113, 25, 3, '65ae572a765b5', 'Option D', '<p><span style=\"color: rgb(68, 68, 68);\">when substance being tested for is absent</span></p>', '0', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(114, 25, 4, '65ae572a765b5', 'Option A', '<p><span style=\"color: rgb(68, 68, 68);\">Type A blood is given type O blood</span></p>', '0', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(115, 25, 4, '65ae572a765b5', 'Option B', '<p><span style=\"color: rgb(68, 68, 68);\">Type AB blood is given type O blood</span></p>', '0', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(116, 25, 4, '65ae572a765b5', 'Option C', '<p><span style=\"color: rgb(68, 68, 68);\">Type O blood is given type A blood</span></p>', '1', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(117, 25, 4, '65ae572a765b5', 'Option D', '<p><span style=\"color: rgb(68, 68, 68);\">&nbsp;Type AB blood is given type B blood</span></p>', '0', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(118, 25, 5, '65ae572a765b5', 'Option A', '<p><span style=\"color: rgb(68, 68, 68);\">anti-A, but not anti B</span></p>', '0', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(119, 25, 5, '65ae572a765b5', 'Option B', '<p><span style=\"color: rgb(68, 68, 68);\">neither anti-A nor anti B</span></p>', '0', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(120, 25, 5, '65ae572a765b5', 'Option C', '<p><span style=\"color: rgb(68, 68, 68);\">both anti-A and anti B</span></p>', '1', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(121, 25, 5, '65ae572a765b5', 'Option D', '<p><span style=\"color: rgb(68, 68, 68);\">&nbsp;anti-B, but not anti-A</span></p>', '0', '2024-01-22 17:23:14', '2024-01-22 17:23:14'),
(122, 26, 6, '65ae5d9a22659', 'Option A', '<p>Recessive factor</p>', '0', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(123, 26, 6, '65ae5d9a22659', 'Option B', '<p>Resistant factor</p>', '0', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(124, 26, 6, '65ae5d9a22659', 'Option C', '<p>Rhesus factor</p>', '1', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(125, 26, 6, '65ae5d9a22659', 'Option D', '<p>Reaction factor</p>', '0', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(126, 26, 7, '65ae5d9a22659', 'Option A', '<p>Type A</p>', '0', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(127, 26, 7, '65ae5d9a22659', 'Option B', '<p>Type B</p>', '0', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(128, 26, 7, '65ae5d9a22659', 'Option C', '<p>Type AB</p>', '0', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(129, 26, 7, '65ae5d9a22659', 'Option D', '<p>Type O</p>', '1', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(130, 26, 8, '65ae5d9a22659', 'Option A', '<p>&nbsp;Antigen A only</p>', '0', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(131, 26, 8, '65ae5d9a22659', 'Option B', '<p>&nbsp;Antigen B only</p>', '0', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(132, 26, 8, '65ae5d9a22659', 'Option C', '<p>Both Antigen A and Antigen B</p>', '1', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(133, 26, 8, '65ae5d9a22659', 'Option D', '<p>Neither Antigen A nor Antigen B</p>', '0', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(134, 26, 9, '65ae5d9a22659', 'Option A', '<p>It denotes the presence of antigens</p>', '0', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(135, 26, 9, '65ae5d9a22659', 'Option B', '<p>It denotes the presence of antibodies</p>', '0', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(136, 26, 9, '65ae5d9a22659', 'Option C', '<p>It denotes the Rh factor</p>', '1', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(137, 26, 9, '65ae5d9a22659', 'Option D', '<p>&nbsp;It denotes the absence of antigens</p>', '0', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(138, 26, 10, '65ae5d9a22659', 'Option A', '<p>Type A</p>', '0', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(139, 26, 10, '65ae5d9a22659', 'Option B', '<p>Type B</p>', '0', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(140, 26, 10, '65ae5d9a22659', 'Option C', '<p>&nbsp;Type AB</p>', '1', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(141, 26, 10, '65ae5d9a22659', 'Option D', '<p>Type O</p>', '0', '2024-01-22 17:50:42', '2024-01-22 17:50:42'),
(163, 1, 16, '65af481a77470', 'Option A', '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;Only doing social activities</span></p>', '0', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(164, 1, 16, '65af481a77470', 'Option B', '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;Only reading, eating, and sleeping</span></p>', '1', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(165, 1, 16, '65af481a77470', 'Option C', '<p><span style=\"color: rgb(58, 58, 58);\">Only eating and sleeping</span></p>', '0', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(166, 1, 16, '65af481a77470', 'Option D', '<p><span style=\"color: rgb(58, 58, 58);\">None of the above</span></p>', '0', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(167, 1, 17, '65af481a77470', 'Option A', '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;A hermit</span></p>', '0', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(168, 1, 17, '65af481a77470', 'Option B', '<p><span style=\"color: rgb(58, 58, 58);\">A poor man</span></p>', '0', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(169, 1, 17, '65af481a77470', 'Option C', '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;An old child</span></p>', '0', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(170, 1, 17, '65af481a77470', 'Option D', '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;A poor woman</span></p>', '0', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(171, 1, 17, '65af481a77470', 'Option E', '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;An old man</span></p>', '1', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(172, 1, 18, '65af481a77470', 'Option A', '<p><span style=\"color: rgb(58, 58, 58);\">The reason for begging</span></p>', '0', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(173, 1, 18, '65af481a77470', 'Option B', '<p><span style=\"color: rgb(58, 58, 58);\">To eat healthy food.</span></p>', '0', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(174, 1, 18, '65af481a77470', 'Option C', '<p><span style=\"color: rgb(58, 58, 58);\">To beg as much as he could</span></p>', '0', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(175, 1, 18, '65af481a77470', 'Option D', '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;To rest instead of begging</span></p>', '1', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(176, 1, 19, '65af481a77470', 'Option A', '<p><span style=\"color: rgb(58, 58, 58);\">Heave</span></p>', '1', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(177, 1, 19, '65af481a77470', 'Option B', '<p><span style=\"color: rgb(58, 58, 58);\">Breath</span></p>', '0', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(178, 1, 19, '65af481a77470', 'Option C', '<p><span style=\"color: rgb(58, 58, 58);\">Blow</span></p>', '0', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(179, 1, 19, '65af481a77470', 'Option D', '<p><span style=\"color: rgb(58, 58, 58);\">Inhale</span></p>', '0', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(180, 1, 20, '65af481a77470', 'Option A', '<p><span style=\"color: rgb(58, 58, 58);\">Thirty rupees</span></p>', '0', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(181, 1, 20, '65af481a77470', 'Option B', '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;Twenty rupees</span></p>', '1', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(182, 1, 20, '65af481a77470', 'Option C', '<p><span style=\"color: rgb(58, 58, 58);\">Fifteen rupees</span></p>', '0', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(183, 1, 20, '65af481a77470', 'Option D', '<p><span style=\"color: rgb(58, 58, 58);\">Twenty-five rupees</span></p>', '0', '2024-01-23 10:32:00', '2024-01-23 10:32:00'),
(184, 28, 21, '65af495f1be6f', 'Option A', '<p><span style=\"color: rgb(58, 58, 58);\">Twenty-five years old</span></p>', '0', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(185, 28, 21, '65af495f1be6f', 'Option B', '<p><span style=\"color: rgb(58, 58, 58);\">Twenty-three years old</span></p>', '1', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(186, 28, 21, '65af495f1be6f', 'Option C', '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;Twenty-two years old</span></p>', '0', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(187, 28, 21, '65af495f1be6f', 'Option D', '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;Twenty-one years old</span></p>', '0', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(188, 28, 22, '65af495f1be6f', 'Option A', '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;3.14216</span></p>', '0', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(189, 28, 22, '65af495f1be6f', 'Option B', '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;3.14630</span></p>', '0', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(190, 28, 22, '65af495f1be6f', 'Option C', '<p><span style=\"color: rgb(58, 58, 58);\">3.14597</span></p>', '0', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(191, 28, 22, '65af495f1be6f', 'Option D', '<p><span style=\"color: rgb(58, 58, 58);\">3.14159</span></p>', '1', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(192, 28, 23, '65af495f1be6f', 'Option A', '<p><span style=\"color: rgb(58, 58, 58);\">Varaha Mihir</span></p>', '1', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(193, 28, 23, '65af495f1be6f', 'Option B', '<p><span style=\"color: rgb(58, 58, 58);\">&nbsp;Bhaskar I</span></p>', '0', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(194, 28, 23, '65af495f1be6f', 'Option C', '<p><span style=\"color: rgb(58, 58, 58);\">Both</span></p>', '0', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(195, 28, 23, '65af495f1be6f', 'Option D', '<p><span style=\"color: rgb(58, 58, 58);\">None of these</span></p>', '0', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(196, 28, 24, '65af495f1be6f', 'Option A', '<p><span style=\"color: rgb(58, 58, 58);\">Mahabhaskariya</span></p>', '0', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(197, 28, 24, '65af495f1be6f', 'Option B', '<p><span style=\"color: rgb(58, 58, 58);\">Laghubhaskariya</span></p>', '0', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(198, 28, 24, '65af495f1be6f', 'Option C', '<p><span style=\"color: rgb(58, 58, 58);\">Bhashya</span></p>', '0', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(199, 28, 24, '65af495f1be6f', 'Option D', '<p><span style=\"color: rgb(58, 58, 58);\">None of the above</span></p>', '1', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(200, 28, 25, '65af495f1be6f', 'Option A', '<p><span style=\"color: rgb(58, 58, 58);\">Poor</span></p>', '0', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(201, 28, 25, '65af495f1be6f', 'Option B', '<p><span style=\"color: rgb(58, 58, 58);\">Adroit</span></p>', '0', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(202, 28, 25, '65af495f1be6f', 'Option C', '<p><span style=\"color: rgb(58, 58, 58);\">unskilled</span></p>', '1', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(203, 28, 25, '65af495f1be6f', 'Option D', '<p><span style=\"color: rgb(58, 58, 58);\">Good</span></p>', '0', '2024-01-23 10:36:39', '2024-01-23 10:36:39'),
(204, 29, 26, '65af4b42945c5', 'Option A', '<p>1940s</p>', '0', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(205, 29, 26, '65af4b42945c5', 'Option B', '<p>1956</p>', '1', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(206, 29, 26, '65af4b42945c5', 'Option C', '<p>1960s</p>', '0', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(207, 29, 26, '65af4b42945c5', 'Option D', '<p>1970s</p>', '0', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(208, 29, 27, '65af4b42945c5', 'Option A', '<p>Development of expert systems</p>', '0', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(209, 29, 27, '65af4b42945c5', 'Option B', '<p>Dartmouth Conference</p>', '1', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(210, 29, 27, '65af4b42945c5', 'Option C', '<p>Emergence of machine learning</p>', '0', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(211, 29, 27, '65af4b42945c5', 'Option D', '<p>Invention of the computer</p>', '0', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(212, 29, 28, '65af4b42945c5', 'Option A', '<p>1960s</p>', '0', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(213, 29, 28, '65af4b42945c5', 'Option B', '<p>1970s</p>', '0', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(214, 29, 28, '65af4b42945c5', 'Option C', '<p>1980s</p>', '1', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(215, 29, 28, '65af4b42945c5', 'Option D', '<p>1990s</p>', '0', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(216, 29, 29, '65af4b42945c5', 'Option A', '<p>Lack of data</p>', '0', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(217, 29, 29, '65af4b42945c5', 'Option B', '<p>Computational limitations</p>', '1', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(218, 29, 29, '65af4b42945c5', 'Option C', '<p>Inadequate algorithms</p>', '0', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(219, 29, 29, '65af4b42945c5', 'Option D', '<p>Ethical concerns</p>', '0', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(220, 29, 30, '65af4b42945c5', 'Option A', '<p>&nbsp;Symbolic reasoning</p>', '0', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(221, 29, 30, '65af4b42945c5', 'Option B', '<p>Expert systems</p>', '0', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(222, 29, 30, '65af4b42945c5', 'Option C', '<p>&nbsp;Deep learning</p>', '1', '2024-01-23 10:44:42', '2024-01-23 10:44:42'),
(223, 29, 30, '65af4b42945c5', 'Option D', '<p>Rule-based systems</p>', '0', '2024-01-23 10:44:42', '2024-01-23 10:44:42');

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
-- Table structure for table `students_test_entries`
--

CREATE TABLE `students_test_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_reg_no` varchar(50) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `test_code` varchar(50) DEFAULT NULL,
  `total_questions` int(11) DEFAULT NULL,
  `total_duration` int(11) DEFAULT NULL,
  `total_marks` int(11) DEFAULT NULL,
  `total_attend_questions` int(11) DEFAULT NULL,
  `time_taken` varchar(50) DEFAULT NULL,
  `total_attempts` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students_test_entries`
--

INSERT INTO `students_test_entries` (`id`, `student_reg_no`, `course_id`, `test_code`, `total_questions`, `total_duration`, `total_marks`, `total_attend_questions`, `time_taken`, `total_attempts`, `created_at`, `updated_at`) VALUES
(1, '19BCS801', 4, '65af4ca250fba', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-24 11:53:27', NULL),
(2, '19BCS801', 4, '65af4ca250fba', NULL, 90, NULL, NULL, NULL, NULL, '2024-01-24 11:53:39', NULL),
(3, '19BCS801', 1, '65a959fa9696f', NULL, 20, NULL, NULL, NULL, NULL, '2024-01-24 12:04:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students_test_questions_answers_entry`
--

CREATE TABLE `students_test_questions_answers_entry` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_entry_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_reg_no` varchar(50) DEFAULT NULL,
  `test_code` varchar(50) DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `time_taken_for_each_question` varchar(12) DEFAULT NULL,
  `mark_for_each_question` int(11) DEFAULT NULL,
  `question_code` varchar(50) DEFAULT NULL,
  `group_question_id` int(11) DEFAULT NULL COMMENT 'If category = 3, set group question id \r\n',
  `category_id` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `student_code` text DEFAULT NULL,
  `answer_selected` varchar(12) DEFAULT NULL COMMENT 'option id',
  `correct_answer` varchar(12) DEFAULT NULL COMMENT 'option id\r\n',
  `mark_taken_for_this_question` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students_test_questions_answers_entry`
--

INSERT INTO `students_test_questions_answers_entry` (`id`, `test_entry_id`, `student_reg_no`, `test_code`, `course_id`, `time_taken_for_each_question`, `mark_for_each_question`, `question_code`, `group_question_id`, `category_id`, `question`, `student_code`, `answer_selected`, `correct_answer`, `mark_taken_for_this_question`, `created_at`, `updated_at`) VALUES
(1, 2, '19BCS801', '65af4ca250fba', 4, NULL, 5, '65ae572a765b5', 1, 3, NULL, NULL, '103', '104', 0, '2024-01-24 11:58:44', '2024-01-24 11:58:44'),
(2, 3, '19BCS801', '65a959fa9696f', 1, NULL, 1, '6593f767e95ca', NULL, 2, NULL, NULL, '8', '5', 0, '2024-01-24 12:04:30', '2024-01-24 12:04:30'),
(3, 3, '19BCS801', '65a959fa9696f', 1, NULL, 1, '6593f8371f85e', NULL, 2, NULL, NULL, '23', '24', 0, '2024-01-24 12:04:32', '2024-01-24 12:04:32'),
(4, 3, '19BCS801', '65a959fa9696f', 1, NULL, 1, '6593f86ce1416', NULL, 2, NULL, NULL, '27', '29', 0, '2024-01-24 12:04:34', '2024-01-24 12:04:34'),
(5, 3, '19BCS801', '65a959fa9696f', 1, NULL, 1, '6593f89c9e824', NULL, 2, NULL, NULL, '101', '98', 0, '2024-01-24 12:04:38', '2024-01-24 12:04:38'),
(6, 3, '19BCS801', '65a959fa9696f', 1, NULL, 1, '6593f912cb091', NULL, 2, NULL, NULL, '95', '96', 0, '2024-01-24 12:04:40', '2024-01-24 12:04:40'),
(7, 2, '19BCS801', '65af4ca250fba', 4, NULL, 5, '65ae572a765b5', 1, 3, NULL, NULL, '105', '104', 0, '2024-01-24 13:20:11', '2024-01-24 13:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `student_group`
--

CREATE TABLE `student_group` (
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `college_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `is_active` enum('1','2') NOT NULL,
  `trash_key` enum('1','2') NOT NULL,
  `error_key` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_group`
--

INSERT INTO `student_group` (`group_id`, `group_name`, `college_id`, `department_id`, `year`, `semester`, `is_active`, `trash_key`, `error_key`, `created_at`, `updated_at`) VALUES
(1, 'psg 1', 1, 1, 1, 1, '1', '1', 0, '2023-11-30 17:54:11', '2024-01-02 10:59:39'),
(2, 'psg Group 2', 1, 1, 1, 1, '1', '1', 0, '2023-11-30 17:54:11', '2023-11-30 17:54:11'),
(3, ' psg 3', 1, 1, 1, 1, '1', '1', 0, '2023-11-30 17:54:11', '2023-11-30 17:54:11'),
(7, 'hindusatan', 2, 1, 1, 1, '1', '1', 0, '2023-11-30 17:54:24', '2023-11-30 17:54:24'),
(8, 'hindusatan 2', 2, 1, 1, 1, '1', '1', 0, '2023-11-30 17:54:24', '2023-11-30 17:54:24'),
(9, 'psg 4', 1, 1, 1, 1, '1', '1', 0, '2023-11-30 17:54:24', '2023-11-30 17:54:24'),
(13, 'KPR 1', 3, 1, 1, 1, '1', '1', 0, '2023-11-30 17:55:24', '2023-11-30 17:55:24'),
(14, 'KPR 2', 3, 1, 1, 1, '1', '1', 0, '2023-11-30 17:55:24', '2023-11-30 17:55:24'),
(15, 'KPR 3', 3, 1, 1, 1, '1', '1', 0, '2023-11-30 17:55:24', '2023-11-30 17:55:24'),
(16, 'Testing student group', 1, 1, 3, 6, '1', '1', 0, '2024-01-02 11:06:10', '2024-01-02 11:06:10');

-- --------------------------------------------------------

--
-- Table structure for table `student_group_entry`
--

CREATE TABLE `student_group_entry` (
  `group_entry_id` bigint(20) UNSIGNED NOT NULL,
  `students_id` bigint(20) UNSIGNED NOT NULL,
  `students_name` varchar(50) NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `register_no` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_group_entry`
--

INSERT INTO `student_group_entry` (`group_entry_id`, `students_id`, `students_name`, `group_id`, `register_no`, `created_at`, `updated_at`) VALUES
(64, 28, 'T MOHAMMED TOUHEED', 1, '721120104029', '2024-01-02 05:29:39', '2024-01-02 05:29:39'),
(4, 1, 'ADIPI MANOJ KUMAR', 2, '19BCS801', '2023-11-30 12:24:11', '2023-11-30 12:24:11'),
(5, 3, 'ANU PRIYA E.P ', 2, '19BCS803', '2023-11-30 12:24:11', '2023-11-30 12:24:11'),
(6, 4, 'ANUSH KRISHNAN ', 2, '19BCS804', '2023-11-30 12:24:11', '2023-11-30 12:24:11'),
(7, 1, 'ADIPI MANOJ KUMAR', 3, '19BCS801', '2023-11-30 12:24:11', '2023-11-30 12:24:11'),
(8, 3, 'ANU PRIYA E.P ', 3, '19BCS803', '2023-11-30 12:24:11', '2023-11-30 12:24:11'),
(9, 5, 'ATHUL S JOTHI', 3, '19BCS805', '2023-11-30 12:24:11', '2023-11-30 12:24:11'),
(35, 3, 'ANU PRIYA E.P ', 12, '19BCS803', '2023-11-30 12:25:20', '2023-11-30 12:25:20'),
(34, 1, 'ADIPI MANOJ KUMAR', 12, '19BCS801', '2023-11-30 12:25:20', '2023-11-30 12:25:20'),
(33, 4, 'ANUSH KRISHNAN ', 11, '19BCS804', '2023-11-30 12:25:20', '2023-11-30 12:25:20'),
(32, 3, 'ANU PRIYA E.P ', 11, '19BCS803', '2023-11-30 12:25:20', '2023-11-30 12:25:20'),
(31, 1, 'ADIPI MANOJ KUMAR', 11, '19BCS801', '2023-11-30 12:25:20', '2023-11-30 12:25:20'),
(30, 4, 'ANUSH KRISHNAN ', 10, '19BCS804', '2023-11-30 12:25:20', '2023-11-30 12:25:20'),
(29, 5, 'ATHUL S JOTHI', 10, '19BCS805', '2023-11-30 12:25:20', '2023-11-30 12:25:20'),
(28, 8, 'HARI PRASATH C', 10, '19BCS800', '2023-11-30 12:25:20', '2023-11-30 12:25:20'),
(19, 8, 'HARI PRASATH C', 7, '19BCS800', '2023-11-30 12:24:24', '2023-11-30 12:24:24'),
(20, 5, 'ATHUL S JOTHI', 7, '19BCS805', '2023-11-30 12:24:24', '2023-11-30 12:24:24'),
(21, 4, 'ANUSH KRISHNAN ', 7, '19BCS804', '2023-11-30 12:24:24', '2023-11-30 12:24:24'),
(22, 1, 'ADIPI MANOJ KUMAR', 8, '19BCS801', '2023-11-30 12:24:24', '2023-11-30 12:24:24'),
(23, 3, 'ANU PRIYA E.P ', 8, '19BCS803', '2023-11-30 12:24:24', '2023-11-30 12:24:24'),
(24, 4, 'ANUSH KRISHNAN ', 8, '19BCS804', '2023-11-30 12:24:24', '2023-11-30 12:24:24'),
(25, 1, 'ADIPI MANOJ KUMAR', 9, '19BCS801', '2023-11-30 12:24:24', '2023-11-30 12:24:24'),
(26, 3, 'ANU PRIYA E.P ', 9, '19BCS803', '2023-11-30 12:24:24', '2023-11-30 12:24:24'),
(27, 5, 'ATHUL S JOTHI', 9, '19BCS805', '2023-11-30 12:24:24', '2023-11-30 12:24:24'),
(36, 5, 'ATHUL S JOTHI', 12, '19BCS805', '2023-11-30 12:25:20', '2023-11-30 12:25:20'),
(37, 3, 'ANU PRIYA E.P ', 13, '19BCS803', '2023-11-30 12:25:24', '2023-11-30 12:25:24'),
(38, 1, 'ADIPI MANOJ KUMAR', 13, '19BCS801', '2023-11-30 12:25:24', '2023-11-30 12:25:24'),
(39, 5, 'ATHUL S JOTHI', 13, '19BCS805', '2023-11-30 12:25:24', '2023-11-30 12:25:24'),
(40, 4, 'ANUSH KRISHNAN ', 14, '19BCS804', '2023-11-30 12:25:24', '2023-11-30 12:25:24'),
(41, 3, 'ANU PRIYA E.P ', 14, '19BCS803', '2023-11-30 12:25:24', '2023-11-30 12:25:24'),
(42, 1, 'ADIPI MANOJ KUMAR', 14, '19BCS801', '2023-11-30 12:25:24', '2023-11-30 12:25:24'),
(43, 4, 'ANUSH KRISHNAN ', 15, '19BCS804', '2023-11-30 12:25:24', '2023-11-30 12:25:24'),
(44, 5, 'ATHUL S JOTHI', 15, '19BCS805', '2023-11-30 12:25:24', '2023-11-30 12:25:24'),
(45, 8, 'HARI PRASATH C', 15, '19BCS800', '2023-11-30 12:25:24', '2023-11-30 12:25:24'),
(63, 26, 'SHAIK PASPULA SOHAIL', 1, '721120104027', '2024-01-02 05:29:39', '2024-01-02 05:29:39'),
(62, 25, 'RENATI VENGAT SRI SUBHASH', 1, '721120104026', '2024-01-02 05:29:39', '2024-01-02 05:29:39'),
(61, 23, 'POTTABTINA  LAVANYA', 1, '721120104024', '2024-01-02 05:29:39', '2024-01-02 05:29:39'),
(60, 22, 'POTHANA BOYINA KARTHIK', 1, '721120104023', '2024-01-02 05:29:39', '2024-01-02 05:29:39'),
(59, 8, 'HARI PRASATH C', 1, '19BCS800', '2024-01-02 05:29:39', '2024-01-02 05:29:39'),
(58, 5, 'ATHUL S JOTHI', 1, '19BCS805', '2024-01-02 05:29:39', '2024-01-02 05:29:39'),
(57, 4, 'ANUSH KRISHNAN ', 1, '19BCS804', '2024-01-02 05:29:39', '2024-01-02 05:29:39'),
(65, 30, 'TIRUMANI  KUMARASWAMY', 1, '721120104031', '2024-01-02 05:29:39', '2024-01-02 05:29:39'),
(66, 32, 'ERABOINA VENKATA GIRI', 1, '721120104305', '2024-01-02 05:29:39', '2024-01-02 05:29:39'),
(67, 33, 'JINKASAGAR', 1, '721120104307', '2024-01-02 05:29:39', '2024-01-02 05:29:39'),
(68, 516, 'karthick raja', 1, '12354', '2024-01-02 05:29:39', '2024-01-02 05:29:39'),
(69, 1, 'ADIPI MANOJ KUMAR', 16, '19BCS801', '2024-01-02 05:36:10', '2024-01-02 05:36:10'),
(70, 5, 'ATHUL S JOTHI', 16, '19BCS805', '2024-01-02 05:36:10', '2024-01-02 05:36:10'),
(71, 7, 'EKAMBARAM BHANU PRAKASH', 16, '19BCS807', '2024-01-02 05:36:10', '2024-01-02 05:36:10'),
(72, 8, 'HARI PRASATH C', 16, '19BCS800', '2024-01-02 05:36:10', '2024-01-02 05:36:10'),
(73, 9, 'KAAVYAA S', 16, '721120104010', '2024-01-02 05:36:10', '2024-01-02 05:36:10'),
(74, 11, 'KONDAPANENI BHARGAV', 16, '721120104012', '2024-01-02 05:36:10', '2024-01-02 05:36:10'),
(75, 12, 'KONDAREDDY NIKHILESHWAR REDDY', 16, '721120104013', '2024-01-02 05:36:10', '2024-01-02 05:36:10'),
(76, 13, 'KOTHA CHETAN KUMAR', 16, '721120104014', '2024-01-02 05:36:10', '2024-01-02 05:36:10'),
(77, 27, 'SHAIK PEERAVALI', 16, '721120104028', '2024-01-02 05:36:10', '2024-01-02 05:36:10'),
(78, 28, 'T MOHAMMED TOUHEED', 16, '721120104029', '2024-01-02 05:36:10', '2024-01-02 05:36:10'),
(79, 32, 'ERABOINA VENKATA GIRI', 16, '721120104305', '2024-01-02 05:36:10', '2024-01-02 05:36:10'),
(80, 33, 'JINKASAGAR', 16, '721120104307', '2024-01-02 05:36:10', '2024-01-02 05:36:10'),
(81, 34, 'DHANUSH V', 16, '721120104319', '2024-01-02 05:36:10', '2024-01-02 05:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `student_test_programming_test_cases`
--

CREATE TABLE `student_test_programming_test_cases` (
  `id` int(11) NOT NULL,
  `test_entry_id` int(11) NOT NULL,
  `question_code` varchar(30) NOT NULL,
  `input` text NOT NULL,
  `expected_output` text NOT NULL,
  `executed_output` text NOT NULL,
  `matched_status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test_creation`
--

CREATE TABLE `test_creation` (
  `test_id` bigint(20) UNSIGNED NOT NULL,
  `test_code` varchar(30) NOT NULL,
  `test_type` int(11) NOT NULL,
  `practice_status` varchar(15) NOT NULL,
  `title` varchar(100) NOT NULL,
  `skills_id` varchar(200) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `topics` varchar(200) DEFAULT NULL,
  `test_questions` text DEFAULT NULL COMMENT 'if test type= 1, this field will be work.',
  `is_active` enum('1','2') NOT NULL,
  `trash_key` enum('1','2') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_creation`
--

INSERT INTO `test_creation` (`test_id`, `test_code`, `test_type`, `practice_status`, `title`, `skills_id`, `category`, `topics`, `test_questions`, `is_active`, `trash_key`, `created_at`, `updated_at`) VALUES
(1, '65a0c94901134', 1, 'no', 'Mcq Sample Test', NULL, NULL, NULL, NULL, '1', '1', '2024-01-12 05:08:25', '2024-01-12 05:08:25'),
(2, '65a12d9baa130', 1, 'no', 'Both test', NULL, NULL, NULL, NULL, '1', '1', '2024-01-12 12:16:27', '2024-01-12 12:16:27'),
(3, '65a959fa9696f', 1, 'no', 'C++', NULL, NULL, NULL, NULL, '1', '1', '2024-01-18 17:03:54', '2024-01-18 17:03:54'),
(4, '65af4ca250fba', 1, 'yes', 'mcq grouping test', NULL, NULL, NULL, NULL, '1', '1', '2024-01-23 05:20:34', '2024-01-23 05:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `test_section_wise_questions`
--

CREATE TABLE `test_section_wise_questions` (
  `id` int(11) NOT NULL,
  `test_code` varchar(30) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `common_test_question` text DEFAULT NULL,
  `section_name` varchar(200) NOT NULL,
  `duration` int(11) NOT NULL,
  `easy` text DEFAULT NULL,
  `medium` text DEFAULT NULL,
  `hard` text DEFAULT NULL,
  `very_hard` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `test_section_wise_questions`
--

INSERT INTO `test_section_wise_questions` (`id`, `test_code`, `category`, `common_test_question`, `section_name`, `duration`, `easy`, `medium`, `hard`, `very_hard`, `created_at`, `updated_at`) VALUES
(1, '65a0c94901134', 2, '6593f736d7fee,6593f767e95ca,6593f79663ec6,6593f7cd083dc,6593f7f744450,6593f8371f85e,6593f86ce1416,6593f89c9e824,6593f912cb091,6593f94ad8238', 'MCQ Section', 30, NULL, NULL, NULL, NULL, '2024-01-12 10:38:25', '2024-01-12 10:38:25'),
(3, '65a12d9baa130', 2, '6593f736d7fee,6593f767e95ca,6593f79663ec6,6593f7cd083dc,6593f7f744450,6593f8371f85e,6593f86ce1416,6593f89c9e824,6593f912cb091,6593f94ad8238,6593f99c5036d,6593f9c96411d', 'mcq', 30, NULL, NULL, NULL, NULL, '2024-01-12 17:46:27', '2024-01-12 17:46:27'),
(4, '65a12d9baa130', 1, '6597d21560fd7,6597d431331e5,6597ddd20f94b', 'programming', 60, NULL, NULL, NULL, NULL, '2024-01-12 17:46:27', '2024-01-12 17:46:27'),
(5, '65a959fa9696f', 2, '6593f767e95ca,6593f8371f85e,6593f86ce1416,6593f89c9e824,6593f912cb091', 'MCQ', 10, NULL, NULL, NULL, NULL, '2024-01-18 22:33:54', '2024-01-18 22:33:54'),
(6, '65a959fa9696f', 1, '6597d21560fd7,6597ddd20f94b', 'Coding', 10, NULL, NULL, NULL, NULL, '2024-01-18 22:33:54', '2024-01-18 22:33:54'),
(7, '65af4ca250fba', 3, '65ae572a765b5,65ae5d9a22659,65af481a77470,65af495f1be6f,65af4b42945c5', 'Grouping section', 90, NULL, NULL, NULL, NULL, '2024-01-23 10:50:34', '2024-01-23 10:50:34');

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
(1, 'admin', 1, 'admin@gmail.com', NULL, '$2a$12$pLhS4rBX4vLCNIXQILjELe0y.k.YwXsTI28HiFl18qgvxd3dAXByO', 'PS8ZoaOaPkNfQIK7VqiZ2sZGuBkJAkmspwU0jEUR', NULL, NULL),
(4, 'karthick raja', 3, 'karthick@gmail.com', NULL, '$2y$10$3oefRvI2rhpojSg1IPSmHuecrXAmojzC3WFp2lilA.bBIV9Sx7jua', 'sm5A3WwpMdVOc9nyZEQEvVDfH4CbeUBJ6P7cMVUH1zbt0v5WNf8AV7mahdBl', '2023-12-30 11:35:04', '2023-12-30 11:35:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course_allocate_to_students`
--
ALTER TABLE `course_allocate_to_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_creation`
--
ALTER TABLE `course_creation`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_negative_marks`
--
ALTER TABLE `course_negative_marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_test_parameters`
--
ALTER TABLE `course_test_parameters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_categories`
--
ALTER TABLE `master_categories`
  ADD PRIMARY KEY (`category_id`);

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
-- Indexes for table `master_tags`
--
ALTER TABLE `master_tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `master_topics`
--
ALTER TABLE `master_topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `mcq_grouping_questions`
--
ALTER TABLE `mcq_grouping_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_master`
--
ALTER TABLE `profile_master`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `programming_question_test_case`
--
ALTER TABLE `programming_question_test_case`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_banks`
--
ALTER TABLE `question_banks`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `question_banks_skills_id_foreign` (`skills_id`),
  ADD KEY `question_banks_difficulties_id_foreign` (`difficulties_id`),
  ADD KEY `question_banks_topics_id_foreign` (`topics_id`);

--
-- Indexes for table `question_bank_entry`
--
ALTER TABLE `question_bank_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_bank_entry_question_code_foreign` (`question_code`);

--
-- Indexes for table `question_bank_for_mcq`
--
ALTER TABLE `question_bank_for_mcq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state_list`
--
ALTER TABLE `state_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_test_entries`
--
ALTER TABLE `students_test_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_test_questions_answers_entry`
--
ALTER TABLE `students_test_questions_answers_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_group`
--
ALTER TABLE `student_group`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `student_group_college_id_foreign` (`college_id`),
  ADD KEY `student_group_department_id_foreign` (`department_id`);

--
-- Indexes for table `student_group_entry`
--
ALTER TABLE `student_group_entry`
  ADD PRIMARY KEY (`group_entry_id`),
  ADD KEY `student_group_entry_students_id_foreign` (`students_id`),
  ADD KEY `student_group_entry_group_id_foreign` (`group_id`);

--
-- Indexes for table `student_test_programming_test_cases`
--
ALTER TABLE `student_test_programming_test_cases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_creation`
--
ALTER TABLE `test_creation`
  ADD PRIMARY KEY (`test_id`),
  ADD UNIQUE KEY `test_creation_test_code_unique` (`test_code`);

--
-- Indexes for table `test_section_wise_questions`
--
ALTER TABLE `test_section_wise_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course_allocate_to_students`
--
ALTER TABLE `course_allocate_to_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `course_creation`
--
ALTER TABLE `course_creation`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course_negative_marks`
--
ALTER TABLE `course_negative_marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `course_test_parameters`
--
ALTER TABLE `course_test_parameters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `master_categories`
--
ALTER TABLE `master_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `master_colleges`
--
ALTER TABLE `master_colleges`
  MODIFY `college_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `master_departments`
--
ALTER TABLE `master_departments`
  MODIFY `department_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_difficulties`
--
ALTER TABLE `master_difficulties`
  MODIFY `difficulty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_profile`
--
ALTER TABLE `master_profile`
  MODIFY `profile_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_skills`
--
ALTER TABLE `master_skills`
  MODIFY `skill_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `master_students`
--
ALTER TABLE `master_students`
  MODIFY `student_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=517;

--
-- AUTO_INCREMENT for table `master_tags`
--
ALTER TABLE `master_tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `master_topics`
--
ALTER TABLE `master_topics`
  MODIFY `topic_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mcq_grouping_questions`
--
ALTER TABLE `mcq_grouping_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `programming_question_test_case`
--
ALTER TABLE `programming_question_test_case`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `question_banks`
--
ALTER TABLE `question_banks`
  MODIFY `question_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `question_bank_entry`
--
ALTER TABLE `question_bank_entry`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_bank_for_mcq`
--
ALTER TABLE `question_bank_for_mcq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `students_test_entries`
--
ALTER TABLE `students_test_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students_test_questions_answers_entry`
--
ALTER TABLE `students_test_questions_answers_entry`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_group`
--
ALTER TABLE `student_group`
  MODIFY `group_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `student_group_entry`
--
ALTER TABLE `student_group_entry`
  MODIFY `group_entry_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `student_test_programming_test_cases`
--
ALTER TABLE `student_test_programming_test_cases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_creation`
--
ALTER TABLE `test_creation`
  MODIFY `test_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `test_section_wise_questions`
--
ALTER TABLE `test_section_wise_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
