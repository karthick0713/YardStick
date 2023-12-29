-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2023 at 08:07 AM
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
-- Table structure for table `course_allocate_to_students`
--

CREATE TABLE `course_allocate_to_students` (
  `id` int(11) NOT NULL,
  `course_id` varchar(30) NOT NULL,
  `college_id` varchar(220) NOT NULL,
  `department_id` varchar(220) NOT NULL,
  `year` int(11) NOT NULL,
  `groups_id` varchar(220) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `course_allocate_to_students`
--

INSERT INTO `course_allocate_to_students` (`id`, `course_id`, `college_id`, `department_id`, `year`, `groups_id`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '1', 1, '1,2,9', '2023-12-21 15:43:20', '2023-12-21 15:43:20'),
(2, '1', '2', '1', 1, '7,8', '2023-12-21 15:43:20', '2023-12-21 15:43:20');

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
(1, 'yardstick academy courses', '2023-12-21', '2023-12-28', '1', '1', '2023-12-21 15:43:20', '2023-12-21 15:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `course_test_parameters`
--

CREATE TABLE `course_test_parameters` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `test_code` varchar(30) NOT NULL,
  `section_name` text DEFAULT NULL,
  `start_date` text NOT NULL,
  `end_date` text NOT NULL,
  `shuffle_questions` int(11) NOT NULL,
  `disable_finish_button` int(11) NOT NULL,
  `re_attempts` int(11) NOT NULL,
  `display_result_status` int(11) NOT NULL,
  `display_result_date` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `is_active` enum('1','2') NOT NULL,
  `error_key` int(11) NOT NULL,
  `trash_key` enum('1','2') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_students`
--

INSERT INTO `master_students` (`student_id`, `student_name`, `register_no`, `college_id`, `skills_id`, `department_id`, `year`, `semester`, `email_id`, `mobile_no`, `is_active`, `error_key`, `trash_key`, `created_at`, `updated_at`) VALUES
(1, 'ADIPI MANOJ KUMAR', '19BCS801', 1, '1,2', 1, 3, 6, 'adipimanojkumar@gmail.com', 8688219585, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(2, 'ALAGU MANIKANDAN', '19BCS802', 1, '1,3', 1, 3, 6, 'alagumani1313@gmail.com', 9790523279, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(3, 'ANU PRIYA E.P ', '19BCS803', 1, '1,4', 1, 3, 6, 'anupriyaprabhakaran@gmail.com', 8891214160, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(4, 'ANUSH KRISHNAN ', '19BCS804', 1, '2,3', 1, 3, 6, 'anushkrishnan02@gmail.com', 7871898764, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(5, 'ATHUL S JOTHI', '19BCS805', 1, '3,4', 1, 3, 6, 'athulsjyothy@gmail.com', 7511102368, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(6, 'BOOMIGA', '19BCS806', 1, '2,4', 1, 3, 6, 'boomigarangaraj2@gmail.com', 9600686204, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(7, 'EKAMBARAM BHANU PRAKASH', '19BCS807', 1, '1,4', 1, 3, 6, 'ekambarambhanuprakash9752@gmail.com', 7093715054, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(8, 'HARI PRASATH C', '19BCS800', 1, '1,4', 1, 3, 6, 'hariprasathyugan07@gmail.com', 8870177682, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(9, 'KAAVYAA S', '721120104010', 1, '1,2', 1, 3, 6, 'kaavyaa157@gmail.com', 8754905157, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(10, 'KABILAN T', '721120104011', 1, '1,3', 1, 3, 6, 'tkabilan2003@gmail.com', 6381592424, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(11, 'KONDAPANENI BHARGAV', '721120104012', 1, '1,4', 1, 3, 6, 'kondapaneni.tpt@gmail.com', 8919170700, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(12, 'KONDAREDDY NIKHILESHWAR REDDY', '721120104013', 1, '1,3', 1, 3, 6, 'nikhilnick1314@gmail.com', 9441007696, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(13, 'KOTHA CHETAN KUMAR', '721120104014', 1, '1,3', 1, 3, 6, 'chetankotha5@gmail.com', 7801039811, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(14, 'MADINENI  MADHVILATHA', '721120104015', 1, '1,4', 1, 3, 6, 'madhinenimadhavi@gmail.com', 9390225239, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(15, 'MALAVIKA R', '721120104016', 1, '1,4', 1, 3, 6, '2002malavikar@gmail.com', 9074491894, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(16, 'NAGIREDDY THRIVIKRAM REDDY', '721120104017', 1, '1,4', 1, 3, 6, 'nagireddyvikram27@gmail.com', 8555975812, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(17, 'NAGARU AJAY NAIDU', '721120104018', 1, '1,4', 1, 3, 6, 'ajaynaidu9908@gmail.com', 7993591116, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(18, 'PALAKONDA  BALA SAI REDDY', '721120104019', 1, '1,4', 1, 3, 6, 'palakondubalasai@gmail.com', 9100242998, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(19, 'PASUMARTHI SAMPATH', '721120104020', 1, '1,4', 1, 3, 6, 'pasumarthisampath879@gmail.com', 9392395719, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(20, 'PEDDI RUPA', '721120104021', 1, '1,4', 1, 3, 6, 'peddirupa2708@gmai.com', 9676195688, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(21, 'POTHANBOINA ANIL KUMAR', '721120104022', 1, '1,4', 1, 3, 6, 'anilk979278@gmail.com', 6309512563, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(22, 'POTHANA BOYINA KARTHIK', '721120104023', 1, '1,4', 1, 3, 6, 'karthikpothanaboina7744486@gmail.com', 8106822127, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(23, 'POTTABTINA  LAVANYA', '721120104024', 1, '1,4', 1, 3, 6, 'pottabattinalavanya@gmail.com', 9573389387, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(24, 'RAHUL R', '721120104025', 1, '1,4', 1, 3, 6, 'ragulvetri12@gmail.com', 6379768147, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(25, 'RENATI VENGAT SRI SUBHASH', '721120104026', 1, '1,4', 1, 3, 6, 'venkatsrisubash@gmail.com', 8500252340, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(26, 'SHAIK PASPULA SOHAIL', '721120104027', 1, '1,4', 1, 3, 6, 'imthiyazs853@gmail.com', 8247468303, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(27, 'SHAIK PEERAVALI', '721120104028', 1, '1,4', 1, 3, 6, 'arjunshaik143@gmail.com', 9392795788, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(28, 'T MOHAMMED TOUHEED', '721120104029', 1, '1,4', 1, 3, 6, 'touhit.md1234@gmail.com', 7729831701, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(30, 'TIRUMANI  KUMARASWAMY', '721120104031', 1, '1,4', 1, 3, 6, 'tirumanikumaraswamy85@gmail.com', 9553370590, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(31, 'YEDIDA  MANIKANTA', '721120104032', 1, '1,4', 1, 3, 6, 'bobbymanikanta07@gmail.com', 6309795084, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(32, 'ERABOINA VENKATA GIRI', '721120104305', 1, '1,4', 1, 3, 6, 'giriiit51@gmail.com', 7569851468, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(33, 'JINKASAGAR', '721120104307', 1, '1,4', 1, 3, 6, 'sagarjinka12@gmail.com', 9398084137, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(34, 'DHANUSH V', '721120104319', 1, '1,4', 1, 3, 6, 'dhanushthippi@gmail.com', 9361081911, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(36, 'CH SUNDAR PAUL', '721120106302', 1, '1,4', 2, 3, 6, 'chirumalasundharpal654@gmail.com', 9848544937, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(37, 'JYOTHI PRAKASH', '721120106306', 1, '1,4', 2, 3, 6, 'prakashboggala4@gmail.com', 9676673594, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(38, 'PECHETTI LAYASREE', '721120106313', 1, '1,4', 2, 3, 6, 'layasreepechetti@gmail.com', 9390707295, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(39, 'SARAN K', '721120105001', 1, '1,4', 3, 3, 6, 'ksaran3007@gmail.com', 8778525131, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(40, 'THAMODARAN S', '721120105002', 1, '1,4', 3, 3, 6, 'sthamu1403@gmail.com', 7010806515, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(41, 'THANGA SELVAN T', '721120105003', 1, '1,4', 3, 3, 6, 'thangaselvan383@gmail.com', 9344532668, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(42, 'KASIMALLA NARASIMHAN', '721120105312', 1, '1,4', 3, 3, 6, 'kasimallanarasimha@gmail.com', 9959251483, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(43, 'SELVA KANNAN A', '721120114001', 1, '1,4', 4, 3, 6, 'selvakannan765@gmail.com', 6384308067, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(44, ' SIDHARTH C CHANDRAN', '721120114002', 1, '1,4', 4, 3, 6, 'sidharthc199@gmail.com', 8606405832, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(45, 'CHITLURI SRI KRISHNA HAASA', '721120114314', 1, '1,4', 4, 3, 6, 'chitluri.srikrishna@gmail.com', 6301744195, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(46, 'GUNDALA DURGARAO', '721120114325', 1, '1,4', 4, 3, 6, 'gundladurgarao017@gmail.com', 8317652368, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(47, 'KARTHI T', '721120114333', 1, '1,4', 4, 3, 6, 'karthi9786962494@gmail.com', 7695842140, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(48, ' KONNE AKASH', '721120114336', 1, '1,4', 4, 3, 6, 'aakashaakash99001@gmail.com', 9391616947, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(49, 'MAHESH B N', '721120114340', 1, '1,4', 4, 3, 6, 'bokkachanna465@gmail.com', 9494292679, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(50, 'SOUNDHAR S', '721120114371', 1, '1,4', 4, 3, 6, 'soundharmech337@gmail.com', 7806883273, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(51, 'SRINATH REDDY M', '721120114373', 1, '1,4', 4, 3, 6, 'marellasrinathreddy@gmail.com', 7995755038, '1', 0, '1', '2023-11-29 16:56:54', '2023-11-29 16:56:54'),
(52, 'THOTA  LOKESWARA  VISHNU VARDHAN', '721120104030', 1, '1,4', 1, 3, 6, 'thota.lvv888@gmail.com', 9965358907, '1', 0, '1', '2023-11-29 16:57:15', '2023-11-29 16:57:15'),
(53, 'MUSBOYINA PAVAN', '721120106001', 1, '1,4', 2, 3, 6, 'pavanmusiboyina@gmail.com', 8978684170, '1', 0, '1', '2023-11-29 16:57:15', '2023-11-29 16:57:15'),
(462, 'ADIPI MANOJ KUMAR', '721120104001', 1, '1,2', 1, 3, 6, 'adipimanojkumar@gmail.com', 8688219585, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(463, 'ALAGU MANIKANDAN', '721120104002', 1, '1,3', 1, 3, 6, 'alagumani1313@gmail.com', 9790523279, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(464, 'ANU PRIYA E.P ', '721120104003', 1, '1,4', 1, 3, 6, 'anupriyaprabhakaran@gmail.com', 8891214160, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(465, 'ANUSH KRISHNAN ', '721120104004', 1, '2,3', 1, 3, 6, 'anushkrishnan02@gmail.com', 7871898764, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(466, 'ATHUL S JOTHI', '721120104005', 1, '3,4', 1, 3, 6, 'athulsjyothy@gmail.com', 7511102368, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(467, 'BOOMIGA', '721120104006', 1, '2,4', 1, 3, 6, 'boomigarangaraj2@gmail.com', 9600686204, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(468, 'EKAMBARAM BHANU PRAKASH', '721120104008', 1, '1,4', 1, 3, 6, 'ekambarambhanuprakash9752@gmail.com', 7093715054, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(469, 'HARI PRASATH C', '721120104009', 1, '1,4', 1, 3, 6, 'hariprasathyugan07@gmail.com', 8870177682, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(470, 'KAAVYAA S', '721120104010', 1, '1,2', 1, 3, 6, 'kaavyaa157@gmail.com', 8754905157, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(471, 'KABILAN T', '721120104011', 1, '1,3', 1, 3, 6, 'tkabilan2003@gmail.com', 6381592424, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(472, 'KONDAPANENI BHARGAV', '721120104012', 1, '1,4', 1, 3, 6, 'kondapaneni.tpt@gmail.com', 8919170700, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(473, 'KONDAREDDY NIKHILESHWAR REDDY', '721120104013', 1, '1,3', 1, 3, 6, 'nikhilnick1314@gmail.com', 9441007696, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(474, 'KOTHA CHETAN KUMAR', '721120104014', 1, '1,3', 1, 3, 6, 'chetankotha5@gmail.com', 7801039811, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(475, 'MADINENI  MADHVILATHA', '721120104015', 1, '1,4', 1, 3, 6, 'madhinenimadhavi@gmail.com', 9390225239, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(476, 'MALAVIKA R', '721120104016', 1, '1,4', 1, 3, 6, '2002malavikar@gmail.com', 9074491894, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(477, 'NAGIREDDY THRIVIKRAM REDDY', '721120104017', 1, '1,4', 1, 3, 6, 'nagireddyvikram27@gmail.com', 8555975812, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(478, 'NAGARU AJAY NAIDU', '721120104018', 1, '1,4', 1, 3, 6, 'ajaynaidu9908@gmail.com', 7993591116, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(479, 'PALAKONDA  BALA SAI REDDY', '721120104019', 1, '1,4', 1, 3, 6, 'palakondubalasai@gmail.com', 9100242998, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(480, 'PASUMARTHI SAMPATH', '721120104020', 1, '1,4', 1, 3, 6, 'pasumarthisampath879@gmail.com', 9392395719, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(481, 'PEDDI RUPA', '721120104021', 1, '1,4', 1, 3, 6, 'peddirupa2708@gmai.com', 9676195688, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(482, 'POTHANBOINA ANIL KUMAR', '721120104022', 1, '1,4', 1, 3, 6, 'anilk979278@gmail.com', 6309512563, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(483, 'POTHANA BOYINA KARTHIK', '721120104023', 1, '1,4', 1, 3, 6, 'karthikpothanaboina7744486@gmail.com', 8106822127, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(484, 'POTTABTINA  LAVANYA', '721120104024', 1, '1,4', 1, 3, 6, 'pottabattinalavanya@gmail.com', 9573389387, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(485, 'RAHUL R', '721120104025', 1, '1,4', 1, 3, 6, 'ragulvetri12@gmail.com', 6379768147, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(486, 'RENATI VENGAT SRI SUBHASH', '721120104026', 1, '1,4', 1, 3, 6, 'venkatsrisubash@gmail.com', 8500252340, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(487, 'SHAIK PASPULA SOHAIL', '721120104027', 1, '1,4', 1, 3, 6, 'imthiyazs853@gmail.com', 8247468303, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(488, 'SHAIK PEERAVALI', '721120104028', 1, '1,4', 1, 3, 6, 'arjunshaik143@gmail.com', 9392795788, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(489, 'T MOHAMMED TOUHEED', '721120104029', 1, '1,4', 1, 3, 6, 'touhit.md1234@gmail.com', 7729831701, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(490, 'THOTA  LOKESWARA  VISHNU VARDHAN', '721120104030', 1, '1,4', 1, 3, 6, 'thota.lvv888@gmail.com', 99653589071, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(491, 'TIRUMANI  KUMARASWAMY', '721120104031', 1, '1,4', 1, 3, 6, 'tirumanikumaraswamy85@gmail.com', 9553370590, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(492, 'YEDIDA  MANIKANTA', '721120104032', 1, '1,4', 1, 3, 6, 'bobbymanikanta07@gmail.com', 6309795084, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(493, 'ERABOINA VENKATA GIRI', '721120104305', 1, '1,4', 1, 3, 6, 'giriiit51@gmail.com', 7569851468, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(494, 'JINKASAGAR', '721120104307', 1, '1,4', 1, 3, 6, 'sagarjinka12@gmail.com', 9398084137, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(495, 'DHANUSH V', '721120104319', 1, '1,4', 1, 3, 6, 'dhanushthippi@gmail.com', 9361081911, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(496, 'MUSBOYINA PAVAN', '721120106001', 1, '1,4', 2, 3, 6, 'pavanmusiboyina@gmail.com', 897868417, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(497, 'CH SUNDAR PAUL', '721120106302', 1, '1,4', 2, 3, 6, 'chirumalasundharpal654@gmail.com', 9848544937, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(498, 'JYOTHI PRAKASH', '721120106306', 1, '1,4', 2, 3, 6, 'prakashboggala4@gmail.com', 9676673594, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(499, 'PECHETTI LAYASREE', '721120106313', 1, '1,4', 2, 3, 6, 'layasreepechetti@gmail.com', 9390707295, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(500, 'SARAN K', '721120105001', 1, '1,4', 3, 3, 6, 'ksaran3007@gmail.com', 8778525131, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(501, 'THAMODARAN S', '721120105002', 1, '1,4', 3, 3, 6, 'sthamu1403@gmail.com', 7010806515, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(502, 'THANGA SELVAN T', '721120105003', 1, '1,4', 3, 3, 6, 'thangaselvan383@gmail.com', 9344532668, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(503, 'KASIMALLA NARASIMHAN', '721120105312', 1, '1,4', 3, 3, 6, 'kasimallanarasimha@gmail.com', 9959251483, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(504, 'SELVA KANNAN A', '721120114001', 1, '1,4', 4, 3, 6, 'selvakannan765@gmail.com', 6384308067, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(505, ' SIDHARTH C CHANDRAN', '721120114002', 1, '1,4', 4, 3, 6, 'sidharthc199@gmail.com', 8606405832, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(506, 'CHITLURI SRI KRISHNA HAASA', '721120114314', 1, '1,4', 4, 3, 6, 'chitluri.srikrishna@gmail.com', 6301744195, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(507, 'GUNDALA DURGARAO', '721120114325', 1, '1,4', 4, 3, 6, 'gundladurgarao017@gmail.com', 8317652368, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(508, 'KARTHI T', '721120114333', 1, '1,4', 4, 3, 6, 'karthi9786962494@gmail.com', 7695842140, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(509, ' KONNE AKASH', '721120114336', 1, '1,4', 4, 3, 6, 'aakashaakash99001@gmail.com', 9391616947, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(510, 'MAHESH B N', '721120114340', 1, '1,4', 4, 3, 6, 'bokkachanna465@gmail.com', 9494292679, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(511, 'SOUNDHAR S', '721120114371', 1, '1,4', 4, 3, 6, 'soundharmech337@gmail.com', 7806883273, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38'),
(512, 'SRINATH REDDY M', '721120114373', 1, '1,4', 4, 3, 6, 'marellasrinathreddy@gmail.com', 7995755038, '1', 2, '1', '2023-11-29 17:28:38', '2023-11-29 17:28:38');

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
(2, 1, '658e6ffd369ac', '<p>asdfasdfsdf</p>', '2023-12-29 12:36:46', '2023-12-29 12:36:46');

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
(13, '2023_12_14_061849_create_test_category_wise_duration_table', 8);

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
(1, '658e6f32188f3', 1, '4', 2, 2, 1, NULL, '<p>asdf</p>', NULL, '2', NULL, NULL, NULL, NULL, '<p>asdfasdfsadfsadf</p>', NULL, 1, '1', '1', '2023-12-29 07:03:14', '2023-12-29 07:06:04'),
(2, '658e6ffd369ac', 1, '4', 4, 3, 1, '<p>asdfasdfsd</p>', NULL, NULL, '2,5', NULL, NULL, NULL, NULL, NULL, NULL, 2, '1', '1', '2023-12-29 07:06:37', '2023-12-29 07:06:46');

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
(5, 1, NULL, '658e6f32188f3', 'Option A', '<p>asdf</p>', '0', '2023-12-29 12:36:04', '2023-12-29 12:36:04'),
(6, 1, NULL, '658e6f32188f3', 'Option B', '<p>asdf</p>', '0', '2023-12-29 12:36:04', '2023-12-29 12:36:04'),
(7, 1, NULL, '658e6f32188f3', 'Option C', '<p>asdf</p>', '0', '2023-12-29 12:36:04', '2023-12-29 12:36:04'),
(8, 1, NULL, '658e6f32188f3', 'Option D', '<p>asdf</p>', '1', '2023-12-29 12:36:04', '2023-12-29 12:36:04'),
(13, 1, 2, '658e6ffd369ac', 'Option A', '<p>asdfasdf</p>', '1', '2023-12-29 12:36:46', '2023-12-29 12:36:46'),
(14, 1, 2, '658e6ffd369ac', 'Option B', '<p>asdfasd</p>', '0', '2023-12-29 12:36:46', '2023-12-29 12:36:46'),
(15, 1, 2, '658e6ffd369ac', 'Option C', '<p>sadfasdf</p>', '0', '2023-12-29 12:36:46', '2023-12-29 12:36:46'),
(16, 1, 2, '658e6ffd369ac', 'Option D', '<p>fsadf</p>', '0', '2023-12-29 12:36:46', '2023-12-29 12:36:46');

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
(1, 'psg 1', 1, 1, 1, 1, '1', '1', 0, '2023-11-30 17:54:11', '2023-12-12 16:59:15'),
(2, 'psg Group 2', 1, 1, 1, 1, '1', '1', 0, '2023-11-30 17:54:11', '2023-11-30 17:54:11'),
(3, ' psg 3', 1, 1, 1, 1, '1', '1', 0, '2023-11-30 17:54:11', '2023-11-30 17:54:11'),
(7, 'hindusatan', 2, 1, 1, 1, '1', '1', 0, '2023-11-30 17:54:24', '2023-11-30 17:54:24'),
(8, 'hindusatan 2', 2, 1, 1, 1, '1', '1', 0, '2023-11-30 17:54:24', '2023-11-30 17:54:24'),
(9, 'psg 4', 1, 1, 1, 1, '1', '1', 0, '2023-11-30 17:54:24', '2023-11-30 17:54:24'),
(13, 'KPR 1', 3, 1, 1, 1, '1', '1', 0, '2023-11-30 17:55:24', '2023-11-30 17:55:24'),
(14, 'KPR 2', 3, 1, 1, 1, '1', '1', 0, '2023-11-30 17:55:24', '2023-11-30 17:55:24'),
(15, 'KPR 3', 3, 1, 1, 1, '1', '1', 0, '2023-11-30 17:55:24', '2023-11-30 17:55:24');

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
(48, 8, 'HARI PRASATH C', 1, '19BCS800', '2023-12-12 11:29:15', '2023-12-12 11:29:15'),
(47, 5, 'ATHUL S JOTHI', 1, '19BCS805', '2023-12-12 11:29:15', '2023-12-12 11:29:15'),
(46, 4, 'ANUSH KRISHNAN ', 1, '19BCS804', '2023-12-12 11:29:15', '2023-12-12 11:29:15'),
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
(49, 22, 'POTHANA BOYINA KARTHIK', 1, '721120104023', '2023-12-12 11:29:15', '2023-12-12 11:29:15'),
(50, 23, 'POTTABTINA  LAVANYA', 1, '721120104024', '2023-12-12 11:29:15', '2023-12-12 11:29:15'),
(51, 25, 'RENATI VENGAT SRI SUBHASH', 1, '721120104026', '2023-12-12 11:29:15', '2023-12-12 11:29:15'),
(52, 26, 'SHAIK PASPULA SOHAIL', 1, '721120104027', '2023-12-12 11:29:15', '2023-12-12 11:29:15'),
(53, 28, 'T MOHAMMED TOUHEED', 1, '721120104029', '2023-12-12 11:29:15', '2023-12-12 11:29:15'),
(54, 30, 'TIRUMANI  KUMARASWAMY', 1, '721120104031', '2023-12-12 11:29:15', '2023-12-12 11:29:15'),
(55, 32, 'ERABOINA VENKATA GIRI', 1, '721120104305', '2023-12-12 11:29:15', '2023-12-12 11:29:15'),
(56, 33, 'JINKASAGAR', 1, '721120104307', '2023-12-12 11:29:15', '2023-12-12 11:29:15');

-- --------------------------------------------------------

--
-- Table structure for table `test_creation`
--

CREATE TABLE `test_creation` (
  `test_id` bigint(20) UNSIGNED NOT NULL,
  `test_code` varchar(30) NOT NULL,
  `test_type` int(11) NOT NULL,
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

INSERT INTO `test_creation` (`test_id`, `test_code`, `test_type`, `title`, `skills_id`, `category`, `topics`, `test_questions`, `is_active`, `trash_key`, `created_at`, `updated_at`) VALUES
(8, '6582d518613e9', 1, 'model test', NULL, NULL, NULL, NULL, '1', '1', NULL, NULL),
(4, '658177aa8ed96', 2, 'Test Package 1', NULL, NULL, NULL, NULL, '1', '1', NULL, NULL),
(5, '65817807655ec', 2, 'Sample test creation', NULL, NULL, NULL, NULL, '1', '1', NULL, NULL),
(7, '6581814ba2fcb', 2, 'Demo Creative Bees', NULL, NULL, NULL, NULL, '1', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `test_section_wise_questions`
--

CREATE TABLE `test_section_wise_questions` (
  `id` int(11) NOT NULL,
  `test_code` varchar(30) NOT NULL,
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

INSERT INTO `test_section_wise_questions` (`id`, `test_code`, `common_test_question`, `section_name`, `duration`, `easy`, `medium`, `hard`, `very_hard`, `created_at`, `updated_at`) VALUES
(1, '658177aa8ed96', '', 'sec', 10, 'n6V5hk1W0Fq1eHcx4B0Ag,r8o1kxOfp0DRKkusJ7xNc,TzxPuF5hHldLROiOauRtv', 'p8xGGCF4TSPE1CtTTJuHs,4AtnNYqJzioRumK2JctPI,4oRh9ujfJ1GT2ABSwI8U4', 'GV3DOvHnhBceNfboC4S8U,S0Fo5P4cbh2VFCrXBdp44', '', '2023-12-19 16:29:54', '2023-12-19 16:29:54'),
(2, '658177aa8ed96', '', 'sec 23', 15, 'ojD0BAgLUrYcStEzZ9efp,PBG4J9gMHmZfMN5YkgusA,Lk23POdOGHrQewmzY19fb', 'e8Hpkh9pVjGlJCWJeCtFK,xuKv65S6Xp1Vis1r9D9pG,h6GRL4cDyFjEdL3vridlf', '', '', '2023-12-19 16:29:54', '2023-12-19 16:29:54'),
(3, '658177aa8ed96', '', 'sec 2233', 20, 'n6V5hk1W0Fq1eHcx4B0Ag,VzPdAHgCU6a9aIueKV57O,4Bp8HaU9itrfLk5OL6LSz,TzxPuF5hHldLROiOauRtv', 'mmcKRP68iUfbrEpdQrtiU,4AtnNYqJzioRumK2JctPI,4oRh9ujfJ1GT2ABSwI8U4,4jirt25EJhVA7JSCN5uY8', 'o2NWHInCK2eOBgxOkY9cZ,C0DC9nYIplwIRT7EEjd63,o4gR1DtqPkC8wJHtmI3wp,RuoETX6Le0HR0YdlM9ZS4', '', '2023-12-19 16:29:54', '2023-12-19 16:29:54'),
(4, '65817807655ec', '', 'sec', 23, 'TzxPuF5hHldLROiOauRtv,r8o1kxOfp0DRKkusJ7xNc', 'p8xGGCF4TSPE1CtTTJuHs,4AtnNYqJzioRumK2JctPI', 'S0Fo5P4cbh2VFCrXBdp44,GV3DOvHnhBceNfboC4S8U', '', '2023-12-19 16:31:27', '2023-12-19 16:31:27'),
(5, '65817807655ec', '', 'sec33', 34, '4Bp8HaU9itrfLk5OL6LSz,cFBJVID7whb9xkOxXymF5,akdr0M7EsJn6oLsspyjt3', '4AtnNYqJzioRumK2JctPI,iz6gHTvWYvjeGwmi915P6,4oRh9ujfJ1GT2ABSwI8U4', 'RuoETX6Le0HR0YdlM9ZS4,o2NWHInCK2eOBgxOkY9cZ,S0Fo5P4cbh2VFCrXBdp44', '', '2023-12-19 16:31:27', '2023-12-19 16:31:27'),
(6, '65817807655ec', '', 'dsfs3', 32, 'iEO05pIF0Pfcsm62PVtFb', 'iz6gHTvWYvjeGwmi915P6,4AtnNYqJzioRumK2JctPI', 'o4gR1DtqPkC8wJHtmI3wp,S0Fo5P4cbh2VFCrXBdp44', '', '2023-12-19 16:31:27', '2023-12-19 16:31:27'),
(7, '6581814ba2fcb', '', 'sdf', 34, 'akdr0M7EsJn6oLsspyjt3,VzPdAHgCU6a9aIueKV57O', '4jirt25EJhVA7JSCN5uY8,iz6gHTvWYvjeGwmi915P6', 'C0DC9nYIplwIRT7EEjd63,o2NWHInCK2eOBgxOkY9cZ,RuoETX6Le0HR0YdlM9ZS4', '', '2023-12-19 17:10:59', '2023-12-19 17:10:59'),
(8, '6581814ba2fcb', '', 'asdfsa', 323, 'TzxPuF5hHldLROiOauRtv,akdr0M7EsJn6oLsspyjt3', '9fEJL8BnUaWua7kH3juEX,4AtnNYqJzioRumK2JctPI', 'o4gR1DtqPkC8wJHtmI3wp,S0Fo5P4cbh2VFCrXBdp44', '', '2023-12-19 17:10:59', '2023-12-19 17:10:59'),
(9, '6581814ba2fcb', '', 'asdfas', 43, 'Lk23POdOGHrQewmzY19fb', 'yIdWLEYetCFB1krSNtfLg', 'GV3DOvHnhBceNfboC4S8U', '', '2023-12-19 17:10:59', '2023-12-19 17:10:59'),
(10, '6582d518613e9', 'xuKv65S6Xp1Vis1r9D9pG,h6GRL4cDyFjEdL3vridlf', 'test', 20, NULL, NULL, NULL, NULL, '2023-12-20 17:20:48', '2023-12-20 17:20:48'),
(11, '6582d518613e9', 'cFBJVID7whb9xkOxXymF5,e8Hpkh9pVjGlJCWJeCtFK,v96BTb4YfI8ubdmbYlFvH', 'test 3', 20, NULL, NULL, NULL, NULL, '2023-12-20 17:20:48', '2023-12-20 17:20:48');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_creation`
--
ALTER TABLE `course_creation`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_test_parameters`
--
ALTER TABLE `course_test_parameters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `student_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=513;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `programming_question_test_case`
--
ALTER TABLE `programming_question_test_case`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_banks`
--
ALTER TABLE `question_banks`
  MODIFY `question_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `question_bank_entry`
--
ALTER TABLE `question_bank_entry`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_bank_for_mcq`
--
ALTER TABLE `question_bank_for_mcq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `student_group`
--
ALTER TABLE `student_group`
  MODIFY `group_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `student_group_entry`
--
ALTER TABLE `student_group_entry`
  MODIFY `group_entry_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `test_creation`
--
ALTER TABLE `test_creation`
  MODIFY `test_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `test_section_wise_questions`
--
ALTER TABLE `test_section_wise_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
