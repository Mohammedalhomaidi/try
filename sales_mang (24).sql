-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2023 at 10:09 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sales_mang`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) NOT NULL,
  `name` varchar(225) NOT NULL,
  `account_type` int(11) NOT NULL,
  `is_parent` tinyint(1) NOT NULL DEFAULT 0,
  `parent_account_number` bigint(20) DEFAULT NULL,
  `account_number` bigint(20) NOT NULL,
  `start_balance_status` tinyint(4) NOT NULL COMMENT 'e 1-credit -2 debit 3-balanced',
  `start_balance` decimal(10,2) NOT NULL COMMENT 'دائن او مدين او متزن اول المدة',
  `current_balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `other_table_FK` bigint(20) DEFAULT NULL,
  `notes` varchar(225) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'هل مفعل',
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='جدول الشجرة المحاسبية العامة';

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `account_type`, `is_parent`, `parent_account_number`, `account_number`, `start_balance_status`, `start_balance`, `current_balance`, `other_table_FK`, `notes`, `added_by`, `updated_by`, `created_at`, `updated_at`, `active`, `com_code`, `date`) VALUES
(1, 'الموردين الاب', 9, 1, NULL, 1, 3, '0.00', '0.00', NULL, NULL, 1, NULL, '2022-09-22 22:43:44', '2022-09-22 22:43:44', 1, 1, '2022-09-22'),
(2, 'البنوك الاب', 9, 1, NULL, 2, 3, '0.00', '0.00', NULL, NULL, 1, NULL, '2022-09-22 22:43:59', '2022-09-22 22:43:59', 1, 1, '2022-09-22'),
(3, 'العملاء الاب', 9, 1, NULL, 3, 3, '0.00', '0.00', NULL, NULL, 1, NULL, '2022-09-22 22:44:13', '2022-09-22 22:44:13', 1, 1, '2022-09-22'),
(4, 'عاطف دياب محمد', 2, 0, 1, 4, 1, '-5000.00', '-86600.00', 1, NULL, 1, 1, '2022-09-22 22:45:06', '2022-12-19 01:27:46', 1, 1, '2022-09-22'),
(5, 'بنك فيصل الاسلامي', 6, 0, 2, 5, 3, '0.00', '0.00', NULL, NULL, 1, NULL, '2022-09-22 23:00:51', '2022-10-09 04:23:21', 1, 1, '2022-09-22'),
(6, 'محمود محمد', 2, 0, 1, 6, 3, '0.00', '-725000.00', 2, NULL, 1, 1, '2022-09-22 23:29:29', '2023-06-06 01:35:40', 1, 1, '2022-09-22'),
(7, 'المريوطي للبقالة', 3, 0, 3, 7, 2, '5000.00', '5000.00', 3, NULL, 1, 1, '2022-10-03 06:07:00', '2023-03-17 21:47:46', 1, 1, '2022-10-03'),
(8, 'الحساب الاب للمناديب', 9, 1, NULL, 8, 3, '0.00', '0.00', NULL, NULL, 1, 1, '2022-10-06 02:52:13', '2022-10-06 14:30:09', 1, 1, '2022-10-06'),
(9, 'الموظفين الاب', 9, 1, NULL, 9, 3, '0.00', '0.00', NULL, NULL, 1, NULL, '2022-10-06 02:52:31', '2022-10-06 02:52:31', 1, 1, '2022-10-06'),
(10, 'المصروفات الاب', 7, 1, NULL, 10, 3, '0.00', '0.00', NULL, NULL, 1, NULL, '2022-10-06 03:44:39', '2022-10-06 03:44:39', 1, 1, '2022-10-06'),
(11, 'كافتريا الرحاب', 7, 0, 10, 11, 1, '-900.00', '-500.00', NULL, NULL, 1, NULL, '2022-10-06 03:45:25', '2022-10-08 00:34:35', 1, 1, '2022-10-06'),
(12, 'مطعم الاحمدي', 7, 0, 10, 12, 1, '-350.00', '-350.00', NULL, NULL, 1, 1, '2022-10-06 03:47:56', '2022-10-08 00:33:33', 1, 1, '2022-10-06'),
(13, 'كافتريا  الاندلس', 7, 0, 12, 13, 1, '-350.00', '-350.00', NULL, NULL, 1, NULL, '2022-10-06 03:48:36', '2023-06-06 01:35:32', 1, 1, '2022-10-06'),
(14, 'بنك فيصل', 6, 0, 2, 14, 2, '100000.00', '100000.00', NULL, NULL, 1, 1, '2022-10-06 03:49:48', '2023-06-06 01:35:35', 1, 1, '2022-10-06'),
(15, 'فواتير الغاز', 7, 0, 10, 15, 3, '0.00', '0.00', NULL, NULL, 1, 1, '2022-10-06 14:16:20', '2022-10-06 14:29:21', 0, 1, '2022-10-06'),
(16, 'محمود السيد علي', 3, 0, 3, 16, 2, '5000.00', '4500.00', 4, 'تأخر سداد', 1, 1, '2022-10-06 14:39:03', '2022-11-19 11:13:50', 1, 1, '2022-10-06'),
(17, 'الاحمدي للفراخ المجمده', 2, 0, 1, 17, 1, '-5000.00', '-11000.00', 3, 'بانتظار طلبية رقم 15', 1, NULL, '2022-10-06 15:00:21', '2023-09-05 17:33:08', 1, 1, '2022-10-06'),
(18, 'ابو مازن  للفراخ المجمده', 2, 0, 1, 18, 1, '-5000.00', '-5000.00', 4, 'بانتظار طلبية', 1, 1, '2022-10-06 15:02:02', '2022-10-06 15:03:11', 0, 1, '2022-10-06'),
(19, 'محمود البنا', 4, 0, 8, 19, 1, '-500.00', '-500.00', 2, 'احسن مندوب', 1, 1, '2022-10-06 17:14:47', '2023-03-17 14:38:05', 1, 1, '2022-10-06'),
(20, 'معاذ ابو جبل', 4, 0, 8, 20, 3, '0.00', '0.00', 3, NULL, 1, 1, '2022-10-06 17:19:33', '2022-10-08 01:24:19', 1, 1, '2022-10-06'),
(21, 'البدري للحوم المجمده', 2, 0, 1, 21, 1, '0.00', '-3780000.00', 5, NULL, 1, 1, '2022-10-07 23:56:14', '2023-09-05 17:03:24', 1, 1, '2022-10-07'),
(22, 'محمود عز الدين', 3, 0, 3, 22, 3, '0.00', '0.00', 5, NULL, 1, NULL, '2022-10-27 23:11:59', '2022-10-27 23:11:59', 1, 1, '2022-10-27'),
(23, 'عز الدين علي', 3, 0, 3, 23, 3, '0.00', '0.00', 6, NULL, 1, NULL, '2022-10-27 23:27:39', '2023-03-20 09:04:17', 1, 1, '2022-10-27'),
(24, 'حمدي خليفه علي', 3, 0, 3, 24, 3, '0.00', '0.00', 7, NULL, 1, NULL, '2022-10-27 23:28:52', '2022-10-27 23:28:52', 1, 1, '2022-10-27'),
(25, 'علي هاشم محمود السيد', 3, 0, 3, 25, 3, '0.00', '0.00', 8, NULL, 1, NULL, '2022-10-27 23:29:37', '2022-12-02 13:56:50', 1, 1, '2022-10-27'),
(26, 'عمر علي السيد', 3, 0, 3, 26, 3, '0.00', '500.00', 9, NULL, 1, NULL, '2022-10-28 16:07:47', '2022-12-05 23:24:37', 1, 1, '2022-10-28'),
(27, 'محمود هاشم احمد', 3, 0, 3, 27, 3, '0.00', '0.00', 10, NULL, 1, NULL, '2022-10-28 16:16:36', '2023-05-28 00:37:06', 1, 1, '2022-10-28'),
(28, 'السيد ابو الوفا', 3, 0, 3, 28, 3, '0.00', '0.00', 11, NULL, 1, NULL, '2022-10-28 17:59:29', '2022-10-28 17:59:29', 1, 1, '2022-10-28'),
(29, 'حمدان عيسي سلام', 3, 0, 3, 29, 3, '0.00', '0.00', 12, NULL, 1, NULL, '2022-10-28 18:02:52', '2022-10-31 15:48:08', 1, 1, '2022-10-28'),
(30, 'منصور سالم البدري', 3, 0, 3, 30, 3, '0.00', '0.00', 13, NULL, 1, NULL, '2022-10-30 00:16:23', '2022-11-06 09:19:58', 1, 1, '2022-10-30'),
(31, 'فوزي السيد حمدان', 3, 0, 3, 31, 3, '0.00', '0.00', 14, NULL, 1, NULL, '2022-10-31 09:28:00', '2023-03-17 14:38:28', 1, 1, '2022-10-31'),
(32, 'هاشم محمد احمد السيد', 4, 0, 8, 32, 1, '-1000.00', '-30510.00', 4, NULL, 1, NULL, '2022-11-06 08:56:28', '2023-07-04 11:00:32', 1, 1, '2022-11-06'),
(33, 'شركة الرميزان للأجهزة الثقيله', 9, 0, 10, 33, 3, '0.00', '0.00', NULL, NULL, 1, NULL, '2022-11-22 17:41:58', '2022-12-02 13:39:13', 1, 1, '2022-11-22'),
(34, 'الحساب المالي الاب لخطوط الانتاج', 9, 1, NULL, 34, 3, '0.00', '0.00', NULL, NULL, 1, NULL, '2023-01-04 02:48:02', '2023-01-04 02:48:02', 1, 1, '2023-01-04'),
(36, 'خط انتاج الافران الكبيره', 5, 0, 34, 35, 3, '0.00', '0.00', 1, NULL, 1, 1, '2023-01-04 02:55:26', '2023-02-17 01:01:20', 1, 1, '2023-01-04'),
(37, 'خط اننتاج غسالات عادية', 5, 0, 34, 36, 3, '0.00', '0.00', 2, NULL, 1, NULL, '2023-01-07 01:10:00', '2023-01-07 01:10:00', 1, 1, '2023-01-07'),
(38, 'كافتريا الهلال', 9, 1, NULL, 37, 3, '0.00', '0.00', NULL, NULL, 1, 1, '2023-03-04 23:52:44', '2023-03-20 06:06:46', 0, 1, '2023-03-04'),
(39, 'mohamme', 3, 0, 3, 38, 3, '0.00', '0.00', 14, NULL, 1, 2, '2023-03-20 06:07:53', '2023-06-06 01:36:04', 1, 1, '2023-03-20'),
(40, 'Mohammed Alhomaidi', 3, 0, 3, 39, 2, '0.00', '-12345687.00', 15, NULL, 1, 1, '2023-05-11 08:12:01', '2023-06-07 05:05:20', 1, 1, '2023-05-11'),
(41, 'admin1', 7, 0, 9, 40, 3, '0.00', '-58214.00', NULL, NULL, 1, NULL, '2023-06-06 01:49:41', '2023-06-07 05:13:17', 1, 1, '2023-06-06'),
(42, 'admin', 3, 0, 3, 41, 3, '0.00', '0.00', 1, 'this user for enter the admin to webpage', 1, 1, '2023-06-11 17:50:30', '2023-06-20 08:13:14', 1, 1, '2023-06-11'),
(43, 'أشرف الصلاحي', 3, 0, 3, 42, 3, '0.00', '0.00', 2, NULL, 1, NULL, '2023-06-11 17:51:33', '2023-06-11 17:51:33', 1, 1, '2023-06-11'),
(44, 'مهران مسعد عبدالعزيز', 3, 0, 3, 43, 3, '0.00', '2500.00', 3, NULL, 1, 1, '2023-06-11 17:52:50', '2023-09-05 13:54:02', 1, 1, '2023-06-11'),
(45, 'محمد طاهر عبدة سيف', 3, 0, 3, 44, 3, '0.00', '35000.00', 4, NULL, 1, 1, '2023-06-11 17:54:30', '2023-06-20 09:11:22', 1, 1, '2023-06-11'),
(46, 'محمد احمد البخيتي', 3, 0, 3, 45, 3, '0.00', '0.00', 5, NULL, 1, NULL, '2023-06-11 17:55:18', '2023-06-11 17:55:18', 1, 1, '2023-06-11'),
(47, 'عبدالمجيد عبدالله', 3, 0, 3, 46, 3, '0.00', '0.00', 6, NULL, 1, NULL, '2023-06-11 17:56:04', '2023-06-11 17:56:04', 1, 1, '2023-06-11'),
(48, 'احمد عبدالخالق الكامل', 3, 0, 3, 47, 3, '0.00', '0.00', 7, NULL, 1, NULL, '2023-06-11 18:55:47', '2023-06-11 18:55:47', 1, 1, '2023-06-11'),
(49, 'انس نعمان', 3, 0, 3, 48, 3, '0.00', '58800.00', 8, NULL, 1, NULL, '2023-07-04 10:42:21', '2023-07-04 11:02:39', 1, 1, '2023-07-04');

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `relatediternalaccounts` tinyint(4) NOT NULL COMMENT 'هل الحساب يتم تكويده من شاشته الداخلية ام من خلال الشاشه الرئيسية للحسابات\r\nواحد داخلي - صفر من الشاشه الرئيسية'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `name`, `active`, `relatediternalaccounts`) VALUES
(1, 'رأس المال', 1, 0),
(2, 'مورد', 1, 1),
(3, 'عميل', 1, 1),
(4, 'مندوب', 1, 1),
(6, 'بنكي', 1, 0),
(7, 'مصروفات', 1, 0),
(8, 'قسم داخلي', 1, 1),
(9, 'عام', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(225) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `com_code` int(11) NOT NULL,
  `permission_rols_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `password`, `created_at`, `updated_at`, `added_by`, `updated_by`, `com_code`, `permission_rols_id`, `date`, `active`) VALUES
(1, 'admin1', 'test@gmail.com', 'admin1', '$2y$10$qHBrpnmqcJgMX/29x92EA.QbD7T5PWKvYO3p.RH2jclPuE4gEGqBe', '2022-08-27 15:59:31', '2023-05-11 07:44:05', NULL, 1, 1, 3, NULL, 1),
(2, 'account', NULL, 'mohammed', '$2y$10$EBZaPlXpZYbWwbViqCU3kOVcV2XZ7Jdxkm3xNz7nY8eBeBzr5xRVu', '2023-03-19 12:10:28', '2023-05-11 09:09:29', 1, 2, 1, 1, '2023-03-19', 1),
(3, 'mohammed taher abdo saif', NULL, 'adminM', '$2y$10$12G0DdGgCQ6n2UyTGUy0GeuVMAZ.mtjI/KjB4M8d9pbKiDIoxSVmC', '2023-03-19 12:20:34', '2023-03-19 12:20:34', 1, NULL, 1, 2, '2023-03-19', 1),
(4, 'AbduALMAJEED', NULL, 's4423134755', '$2y$10$86t3cIYQOEkjqy7Jy7pJYuhfGOS233b8hpDFvit6vRUi4PNYYYopO', '2023-03-19 12:23:16', '2023-06-16 01:11:06', 1, 1, 1, 10, '2023-03-19', 1),
(5, 'العملاء', NULL, 'admin', '$2y$10$4TkMAHoh4bgVbPW5kshZXO1KMn882NW8kZBwmMeUPENIm6lrgPz.m', '2023-05-11 07:44:52', '2023-05-11 07:44:52', 1, NULL, 1, 11, '2023-05-11', 1),
(6, 'Mohammed Alhomaidi', NULL, 'mo', '$2y$10$kFEb7uyp2JmBCV2DnVwN8OVZFE5ufP8KOYAygPuhXo5H2xRejgaTe', '2023-05-12 14:17:08', '2023-05-12 14:17:08', 1, NULL, 1, 1, '2023-05-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admins_shifts`
--

CREATE TABLE `admins_shifts` (
  `id` bigint(20) NOT NULL,
  `shift_code` bigint(20) NOT NULL COMMENT 'كود الشفت المستخدم بالربط مع جدول حركة النقدية',
  `admin_id` int(11) NOT NULL,
  `treasuries_id` int(11) NOT NULL,
  `treasuries_balnce_in_shift_start` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'رصيد الخزنة في بدايه استلام الشفت للمستخدم',
  `start_date` datetime NOT NULL COMMENT 'توقيت بدايه الشفت',
  `end_date` datetime DEFAULT NULL,
  `is_finished` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'هل تم انتهاء الشفت',
  `is_delivered_and_review` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'هل تم مرراجعه واستلام شفت الخزنة',
  `delivered_to_admin_id` int(11) DEFAULT NULL COMMENT 'كود المستخدم الذي تسلم هذا الشفت واراجعه',
  `delivered_to_admin_sift_id` bigint(20) DEFAULT NULL COMMENT 'كود الشفت الذي تسلم هذا الشفت وارجعه',
  `delivered_to_treasuries_id` int(11) DEFAULT NULL COMMENT 'كود الخزنه التي راجعت واستلمت هذا الشفت',
  `money_should_deviled` decimal(10,2) DEFAULT NULL COMMENT 'النقدية التي يفترض ان تسلم ',
  `what_realy_delivered` decimal(10,2) DEFAULT NULL COMMENT 'المبلغ الفعلي الذي تم تسلمه ',
  `money_state` tinyint(1) DEFAULT NULL COMMENT '0-blanced -1-inability 2-extra \r\nصفر متزن - واحد  يوجد عز - اثنين يوجد زيادة',
  `money_state_value` decimal(10,2) DEFAULT NULL COMMENT 'قيمة العجز او الزياده ان وجدت',
  `receive_type` tinyint(1) DEFAULT NULL COMMENT 'واحد استلام علي نفس الخزنة - اثنين استلام علي خزنة اخري',
  `review_receive_date` datetime DEFAULT NULL COMMENT 'تاريخ مراجعه واستلام هذا الشفت',
  `treasuries_transactions_id` bigint(20) DEFAULT NULL COMMENT 'رقم الايصال بجدول تحصيل النقدية لحركة الخزن',
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `notes` varchar(100) DEFAULT NULL,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='جدول شفتات الخزن للمستخدمين ';

--
-- Dumping data for table `admins_shifts`
--

INSERT INTO `admins_shifts` (`id`, `shift_code`, `admin_id`, `treasuries_id`, `treasuries_balnce_in_shift_start`, `start_date`, `end_date`, `is_finished`, `is_delivered_and_review`, `delivered_to_admin_id`, `delivered_to_admin_sift_id`, `delivered_to_treasuries_id`, `money_should_deviled`, `what_realy_delivered`, `money_state`, `money_state_value`, `receive_type`, `review_receive_date`, `treasuries_transactions_id`, `added_by`, `created_at`, `notes`, `com_code`, `date`, `updated_by`, `updated_at`) VALUES
(1, 1, 1, 3, '0.00', '2023-06-07 02:50:41', '2023-06-07 02:56:11', 1, 1, 1, 2, NULL, '10000.00', '9000.00', 1, '1000.00', NULL, NULL, 4, 1, '2023-06-07 02:50:41', NULL, 1, '2023-06-07', 1, '2023-06-07 02:59:39'),
(2, 2, 1, 1, '0.00', '2023-06-07 02:59:06', '2023-06-11 19:14:00', 1, 0, NULL, NULL, NULL, '12430901.00', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-06-07 02:59:06', NULL, 1, '2023-06-07', 1, '2023-06-11 19:14:00'),
(3, 3, 1, 1, '0.00', '2023-06-11 19:15:00', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-06-11 19:15:00', NULL, 1, '2023-06-11', NULL, '2023-06-11 19:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `admins_stores`
--

CREATE TABLE `admins_stores` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `Store_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='صلاحيات المخازن المستخدمين الخاصة';

--
-- Dumping data for table `admins_stores`
--

INSERT INTO `admins_stores` (`id`, `admin_id`, `Store_id`, `active`, `added_by`, `created_at`, `updated_by`, `updated_at`, `com_code`, `date`) VALUES
(1, 1, 1, 1, 1, '2023-06-07 02:48:55', NULL, '2023-06-07 02:48:55', 1, '2023-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `admins_treasuries`
--

CREATE TABLE `admins_treasuries` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `treasuries_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='صلاحيات خزن المستخدمين الخاصة';

--
-- Dumping data for table `admins_treasuries`
--

INSERT INTO `admins_treasuries` (`id`, `admin_id`, `treasuries_id`, `active`, `added_by`, `created_at`, `updated_by`, `updated_at`, `com_code`, `date`) VALUES
(1, 6, 1, 1, 1, '2023-06-07 02:48:41', NULL, '2023-06-07 02:48:41', 1, '2023-06-07'),
(2, 1, 3, 1, 1, '2023-06-07 02:49:10', NULL, '2023-06-07 02:49:10', 1, '2023-06-07'),
(3, 1, 1, 1, 1, '2023-06-07 02:51:13', NULL, '2023-06-07 02:51:13', 1, '2023-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `admin_panel_settings`
--

CREATE TABLE `admin_panel_settings` (
  `id` int(11) NOT NULL,
  `system_name` varchar(250) NOT NULL,
  `photo` varchar(225) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `general_alert` varchar(150) DEFAULT NULL,
  `address` varchar(250) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `customer_parent_account_number` bigint(20) NOT NULL COMMENT 'رقم الحساب الاب للعملاء',
  `suppliers_parent_account_number` bigint(20) NOT NULL COMMENT 'الحساب الاب للموردين',
  `delegate_parent_account_number` bigint(20) NOT NULL COMMENT 'رقم الحساب المالي  لحساب الاب للمناديب',
  `employees_parent_account_number` bigint(20) NOT NULL COMMENT 'رقم الحساب المالي للموظفين الاب',
  `production_lines_parent_account` bigint(20) NOT NULL COMMENT 'كود الحساب الاب لخطوط الانتاج',
  `added_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `com_code` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `is_set_batches_setting` tinyint(1) NOT NULL,
  `batches_setting_type` tinyint(1) DEFAULT NULL,
  `defualt_unit` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'وحد لبيع الالي بالوحدة الاب 2 بوحدة للبيع بالتجزئة ',
  `Numbers_vist` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin_panel_settings`
--

INSERT INTO `admin_panel_settings` (`id`, `system_name`, `photo`, `active`, `general_alert`, `address`, `phone`, `customer_parent_account_number`, `suppliers_parent_account_number`, `delegate_parent_account_number`, `employees_parent_account_number`, `production_lines_parent_account`, `added_by`, `updated_by`, `created_at`, `updated_at`, `com_code`, `notes`, `is_set_batches_setting`, `batches_setting_type`, `defualt_unit`, `Numbers_vist`) VALUES
(1, 'الصوفي للاحذية', '1686103938768.jpg', 1, 'عمل افضل الأنظمة  و البرامج وغيرها من البرمج', 'اب- شارع العدين', '0715142292', 3, 1, 8, 9, 34, 0, 1, '0000-00-00 00:00:00', '2023-09-09 04:00:07', 1, 'الاضافة بالمبيعات  ctrl او enter', 1, 2, 2, 53);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `value` decimal(10,0) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `com_code` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='جدول الوحدات';

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `value`, `created_at`, `updated_at`, `added_by`, `updated_by`, `com_code`, `active`) VALUES
(1, 'الدولار', '520', '2023-09-05 18:40:44', '2023-09-05 18:51:02', 1, 1, 1, 1),
(2, 'السعودي', '140', '2023-09-05 18:51:55', '2023-09-05 18:51:55', 1, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `custmoer_favorite_itemcard`
--

CREATE TABLE `custmoer_favorite_itemcard` (
  `id` int(11) NOT NULL,
  `itemcard_id` bigint(20) NOT NULL,
  `customer_id` bigint(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `com_code` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `custmoer_favorite_itemcard`
--

INSERT INTO `custmoer_favorite_itemcard` (`id`, `itemcard_id`, `customer_id`, `created_at`, `com_code`, `updated_at`) VALUES
(1, 32, 1, '2023-06-11 19:51:53', 1, '2023-06-11 19:51:53'),
(2, 33, 1, '2023-06-11 19:52:00', 1, '2023-06-11 19:52:00'),
(3, 22, 4, '2023-06-20 07:05:35', 1, '2023-06-20 07:05:35'),
(4, 34, 4, '2023-06-20 09:03:22', 1, '2023-06-20 09:03:22');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) NOT NULL,
  `customer_code` bigint(20) NOT NULL,
  `name` varchar(225) NOT NULL,
  `Name_enter_system` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '$2y$10$qHBrpnmqcJgMX/29x92EA.QbD7T5PWKvYO3p.RH2jclPuE4gEGqBe',
  `account_number` bigint(20) NOT NULL,
  `start_balance_status` tinyint(4) NOT NULL COMMENT 'e 1-credit -2 debit 3-balanced',
  `start_balance` decimal(10,2) NOT NULL COMMENT 'دائن او مدين او متزن اول المدة',
  `current_balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `notes` varchar(225) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `phones` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='جدول الشجرة المحاسبية العامة';

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_code`, `name`, `Name_enter_system`, `password`, `account_number`, `start_balance_status`, `start_balance`, `current_balance`, `notes`, `added_by`, `updated_by`, `created_at`, `updated_at`, `active`, `com_code`, `date`, `address`, `phones`) VALUES
(1, 1, 'admin', 'admin', '$2y$10$9pCoCSiofL0G7n5cTA/hd.q0KkzE9up418EQrWbqbrGlAoKB5Xc8G', 41, 3, '0.00', '0.00', 'this user for enter the admin to webpage', 1, 1, '2023-06-11 17:50:30', '2023-06-20 08:13:14', 1, 1, '2023-06-11', 'locale', '715142292'),
(2, 2, 'أشرف الصلاحي', 'admin', '$2y$10$qHBrpnmqcJgMX/29x92EA.QbD7T5PWKvYO3p.RH2jclPuE4gEGqBe', 42, 3, '0.00', '0.00', NULL, 1, NULL, '2023-06-11 17:51:33', '2023-06-11 17:51:33', 1, 1, '2023-06-11', 'اب- شارع العدين', '0715142292'),
(3, 3, 'مهران مسعد عبدالعزيز', 'مهران', '$2y$10$t5ICwLDjBy7xfmdDgLqRyuCZzUTBy46ZW9Uyw9mEwKGUFekjwpg92', 43, 3, '0.00', '2500.00', NULL, 1, 1, '2023-06-11 17:52:50', '2023-09-05 13:54:02', 1, 1, '2023-06-11', 'شارع الثلاثين', '0716007273'),
(4, 4, 'محمد طاهر عبدة سيف', 'mohammed', '$2y$10$MTz6SZdX6yoX8xjYgFNED.KpJiqe5ZOMXaEXSRUsUTfWDUsX1NnUO', 44, 3, '0.00', '35000.00', NULL, 1, 1, '2023-06-11 17:54:30', '2023-06-20 09:11:22', 1, 1, '2023-06-11', 'اب العدين', '715142292'),
(5, 5, 'محمد احمد البخيتي', 'admin', '$2y$10$qHBrpnmqcJgMX/29x92EA.QbD7T5PWKvYO3p.RH2jclPuE4gEGqBe', 45, 3, '0.00', '0.00', NULL, 1, NULL, '2023-06-11 17:55:18', '2023-06-11 17:55:18', 1, 1, '2023-06-11', 'اب- شارع العدين', '0715142292'),
(6, 6, 'عبدالمجيد عبدالله', 'admin', '$2y$10$qHBrpnmqcJgMX/29x92EA.QbD7T5PWKvYO3p.RH2jclPuE4gEGqBe', 46, 3, '0.00', '0.00', NULL, 1, NULL, '2023-06-11 17:56:04', '2023-06-11 17:56:04', 1, 1, '2023-06-11', 'اب- شارع العدين', '0715142292'),
(7, 7, 'احمد عبدالخالق الكامل', 'احمد', '$2y$10$1bkFpBUhnVcFyAIN2omgJ.lxxqcJXnw.GHi4WemnK7sQSDZl7./g2', 47, 3, '0.00', '0.00', NULL, 1, NULL, '2023-06-11 18:55:47', '2023-06-11 18:55:47', 1, 1, '2023-06-11', 'شارع الثلاثين', '0716007273'),
(8, 8, 'انس نعمان', 'انس', '$2y$10$EA20W5iSrPPdZApMIqWuYuNM81bIOaJ4RKZ5WgTcHlKz.ozl9xRMK', 48, 3, '0.00', '58800.00', NULL, 1, NULL, '2023-07-04 10:42:21', '2023-07-04 11:02:39', 1, 1, '2023-07-04', 'اب- شارع الثلاثين', '0715142292');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `id` bigint(20) NOT NULL,
  `invoice_date` datetime NOT NULL COMMENT 'تاريخ الفاتورة',
  `customer_code` bigint(20) DEFAULT NULL COMMENT 'كود العميل',
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `com_code` int(11) NOT NULL,
  `notes` varchar(225) DEFAULT NULL,
  `discount_percent` decimal(10,2) DEFAULT 0.00 COMMENT 'قيمة نسبة الخصم',
  `discount_value` decimal(10,2) DEFAULT 0.00 COMMENT 'قيمة الخصم',
  `tax_percent` decimal(10,2) DEFAULT 0.00 COMMENT 'نسبة الضريبة ',
  `total_cost_items` decimal(10,2) DEFAULT 0.00 COMMENT 'اجمالي الاصناف فقط',
  `total_befor_discount` decimal(10,2) DEFAULT 0.00,
  `total_cost` decimal(10,2) DEFAULT 0.00 COMMENT 'القيمة الاجمالية النهائية للفاتورة',
  `account_number` bigint(20) DEFAULT NULL,
  `customer_balance_befor` decimal(10,2) DEFAULT NULL COMMENT 'حالة رصيد العميل قبل الفاتروة',
  `customer_balance_after` decimal(10,2) DEFAULT NULL COMMENT 'حالة رصيد العميل بعد الفاتروة',
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='المبيعات للعملاء';

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`id`, `invoice_date`, `customer_code`, `is_approved`, `com_code`, `notes`, `discount_percent`, `discount_value`, `tax_percent`, `total_cost_items`, `total_befor_discount`, `total_cost`, `account_number`, `customer_balance_befor`, `customer_balance_after`, `added_by`, `created_at`, `updated_at`, `updated_by`, `approved_by`) VALUES
(1, '2023-06-11 19:56:38', 1, 2, 1, NULL, '0.00', '0.00', '0.00', '10.00', '0.00', '35000.00', NULL, NULL, NULL, 1, '2023-06-11 19:56:38', '2023-06-11 20:03:06', NULL, 1),
(2, '2023-06-11 20:00:50', 1, 1, 1, NULL, '0.00', '0.00', '0.00', '3.00', '0.00', '22000.00', NULL, NULL, NULL, 1, '2023-06-11 20:00:50', '2023-06-11 20:01:54', NULL, NULL),
(4, '2023-06-15 21:52:54', 1, 1, 1, NULL, '0.00', '0.00', '0.00', '1.00', '0.00', '3500.00', NULL, NULL, NULL, 1, '2023-06-15 21:52:54', '2023-06-20 12:54:04', NULL, NULL),
(6, '2023-06-20 13:11:43', 3, 2, 1, NULL, '0.00', '0.00', '0.00', '1.00', '0.00', '2500.00', NULL, NULL, NULL, 3, '2023-06-20 13:11:43', '2023-09-05 13:54:02', NULL, 1),
(7, '2023-06-20 15:12:46', 1, 1, 1, NULL, '0.00', '0.00', '0.00', '1.00', '0.00', '2500.00', NULL, NULL, NULL, 1, '2023-06-20 15:12:46', '2023-06-20 15:13:01', NULL, NULL),
(8, '2023-09-07 23:48:24', 1, 0, 1, NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL, NULL, 1, '2023-09-07 23:48:24', '2023-09-07 23:48:24', NULL, NULL),
(9, '2023-09-08 01:39:22', 5, 0, 1, NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL, NULL, 5, '2023-09-08 01:39:22', '2023-09-08 01:39:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_order_details`
--

CREATE TABLE `customer_order_details` (
  `id` bigint(20) NOT NULL,
  `customer_order_id` bigint(20) NOT NULL,
  `item_code` bigint(20) NOT NULL,
  `quantity` decimal(10,4) NOT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated _by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='تفاصيل انصاف فاتورة المشتريات والمرتجعات';

--
-- Dumping data for table `customer_order_details`
--

INSERT INTO `customer_order_details` (`id`, `customer_order_id`, `item_code`, `quantity`, `total_price`, `added_by`, `created_at`, `updated_at`, `updated _by`) VALUES
(8, 6, 34, '1.0000', '2500', 3, '2023-06-20 13:11:46', '2023-06-20 13:11:46', NULL),
(9, 7, 34, '1.0000', '2500', 1, '2023-06-20 15:12:49', '2023-06-20 15:12:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delegates`
--

CREATE TABLE `delegates` (
  `id` bigint(20) NOT NULL,
  `delegate_code` bigint(20) NOT NULL,
  `name` varchar(225) NOT NULL,
  `account_number` bigint(20) NOT NULL,
  `start_balance_status` tinyint(4) NOT NULL COMMENT 'e 1-credit -2 debit 3-balanced',
  `start_balance` decimal(10,2) NOT NULL COMMENT 'دائن او مدين او متزن اول المدة',
  `current_balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `notes` varchar(225) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL,
  `phones` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `percent_type` tinyint(4) NOT NULL COMMENT 'نوع عمولة المندوب  بشكل عام\r\nواحد اجر ثابت لكل فاتورة - لو اتنين  نسبة بكل فاتورة	',
  `percent_collect_commission` decimal(10,2) NOT NULL COMMENT 'نسبة المندوب بالتحصيل  الفواتير الاجل ',
  `percent_salaes_commission_kataei` decimal(10,2) NOT NULL COMMENT 'نسبة عمولة المندوب بالمبيعات قطاعلي	',
  `percent_salaes_commission_nosjomla` decimal(10,2) NOT NULL COMMENT 'عمول المندوب بمبيعات نص الجملة	',
  `percent_salaes_commission_jomla` decimal(10,2) NOT NULL COMMENT 'نسبة عمولة المندوب بالمبيعات بالجملة	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='جدول المناديب';

--
-- Dumping data for table `delegates`
--

INSERT INTO `delegates` (`id`, `delegate_code`, `name`, `account_number`, `start_balance_status`, `start_balance`, `current_balance`, `notes`, `added_by`, `updated_by`, `created_at`, `updated_at`, `active`, `com_code`, `date`, `phones`, `address`, `percent_type`, `percent_collect_commission`, `percent_salaes_commission_kataei`, `percent_salaes_commission_nosjomla`, `percent_salaes_commission_jomla`) VALUES
(1, 1, 'المكتب', 6, 0, '0.00', '0.00', NULL, 1, 1, '2022-09-29 00:29:26', '2022-11-09 22:02:56', 1, 1, '2022-09-29', '5446454', NULL, 2, '0.00', '0.00', '0.00', '0.00'),
(2, 2, 'محمود البنا', 19, 1, '-500.00', '-500.00', 'احسن مندوب', 1, 1, '2022-10-06 17:14:47', '2023-03-17 14:38:05', 1, 1, '2022-10-06', '5446454', 'ش 16', 2, '1.75', '1.00', '1.50', '2.00'),
(3, 3, 'معاذ ابو جبل', 20, 3, '0.00', '0.00', 'احسن مندوب', 1, 1, '2022-10-06 17:19:32', '2022-10-08 01:24:19', 1, 1, '2022-10-06', '5446454', 'ش 17', 2, '150.00', '150.00', '150.00', '150.00'),
(4, 4, 'هاشم محمد احمد السيد', 32, 1, '-1000.00', '-30510.00', NULL, 1, NULL, '2022-11-06 08:56:28', '2023-07-04 11:00:32', 1, 1, '2022-11-06', NULL, NULL, 2, '0.00', '2.00', '1.00', '0.50');

-- --------------------------------------------------------

--
-- Table structure for table `inv_itemcard`
--

CREATE TABLE `inv_itemcard` (
  `id` bigint(20) NOT NULL,
  `item_code` bigint(20) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `name` varchar(225) NOT NULL,
  `item_type` tinyint(1) NOT NULL COMMENT 'واحد  مخزني - اتنين استهلاكي - ثلاثه عهده',
  `inv_itemcard_categories_id` int(11) NOT NULL,
  `parent_inv_itemcard_id` bigint(20) DEFAULT NULL COMMENT 'كود الصنف الاب له',
  `does_has_retailunit` tinyint(1) NOT NULL COMMENT 'هل للصنف وحده تجزئة',
  `retail_uom_id` int(11) DEFAULT NULL COMMENT 'كود وحده  قياس التجزئة ',
  `uom_id` int(11) NOT NULL COMMENT 'كود وحده  قياس الاب',
  `retail_uom_quntToParent` decimal(10,2) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `date` date NOT NULL,
  `com_code` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL COMMENT 'السعر القطاعي بوحدة القياس الاساسية	',
  `nos_gomla_price` decimal(10,2) NOT NULL COMMENT 'سعر النص جملة مع الوحده الاب	',
  `gomla_price` decimal(10,2) NOT NULL COMMENT 'السعر جملة بوحدة القياس الاساسية	',
  `price_retail` decimal(10,2) DEFAULT NULL COMMENT 'السعر القطاعي بوحدة قياس التجزئة	',
  `nos_gomla_price_retail` decimal(10,2) DEFAULT NULL COMMENT 'سعر النص جملة قطاعي مع الوحده التجزئة	',
  `gomla_price_retail` decimal(10,2) DEFAULT NULL COMMENT 'السعر الجملة بوحدة قياس التجزئة	',
  `cost_price` decimal(10,2) NOT NULL COMMENT 'متوسط التكلفة للصنف بالوحدة الاساسية	',
  `cost_price_retail` decimal(10,2) DEFAULT NULL COMMENT 'متوسط التكلفة للصنف بوحدة قياس التجزئة	',
  `has_fixced_price` tinyint(1) NOT NULL COMMENT 'هل للصنف سعر ثابت بالفواتير  او قابل للتغير بالفواتير',
  `All_QUENTITY` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'كل كمية الصنف بوحده الاب مباشره بدون اي تحويلات',
  `QUENTITY` decimal(10,3) NOT NULL DEFAULT 0.000 COMMENT 'كل الكمية بوحده الاب بدون الفكه في حاله  لديه وحده تجزئة',
  `QUENTITY_Retail` decimal(10,3) DEFAULT NULL COMMENT 'كمية التجزئة المتبقية من الوحده الاب في حالة وجود وحده تجزئة للصنف',
  `QUENTITY_all_Retails` decimal(10,3) DEFAULT NULL COMMENT 'كل الكمية محولة بوحده التجزئة ',
  `SHOW_IN_WEB` tinyint(4) DEFAULT 1,
  `Discounts` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `inv_itemcard`
--

INSERT INTO `inv_itemcard` (`id`, `item_code`, `barcode`, `name`, `item_type`, `inv_itemcard_categories_id`, `parent_inv_itemcard_id`, `does_has_retailunit`, `retail_uom_id`, `uom_id`, `retail_uom_quntToParent`, `added_by`, `created_at`, `updated_at`, `updated_by`, `active`, `date`, `com_code`, `price`, `nos_gomla_price`, `gomla_price`, `price_retail`, `nos_gomla_price_retail`, `gomla_price_retail`, `cost_price`, `cost_price_retail`, `has_fixced_price`, `All_QUENTITY`, `QUENTITY`, `QUENTITY_Retail`, `QUENTITY_all_Retails`, `SHOW_IN_WEB`, `Discounts`) VALUES
(1, 1, 'item1', 'شميز  هندي', 1, 7, 0, 0, NULL, 11, NULL, 1, '2022-12-19 01:27:11', '2023-05-30 04:46:34', 1, 1, '2022-12-19', 1, '3000.00', '3000.00', '3000.00', NULL, NULL, NULL, '3000.00', NULL, 1, '748.00', '748.000', NULL, NULL, 1, 0),
(2, 2, 'item2', 'شميز صيني', 1, 7, 0, 1, 6, 11, '12.00', 1, '2023-02-11 03:50:59', '2023-07-04 11:00:15', 1, 1, '2023-02-11', 1, '30000.00', '32000.00', '30000.00', '3000.00', '3000.00', '30000.00', '3500.00', '291.67', 1, '7.00', '7.000', '0.000', '84.000', 1, 0),
(3, 3, 'item3', 'جاكت جينز', 1, 7, 0, 0, NULL, 11, NULL, 1, '2023-02-17 00:57:49', '2023-05-18 00:51:40', 1, 1, '2023-02-17', 1, '4000.00', '20000.00', '40000.00', NULL, NULL, NULL, '3500.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(4, 4, 'item-415', 'بنطلون جينز هندي', 1, 7, 0, 0, NULL, 11, NULL, 1, '2023-03-07 07:10:31', '2023-05-18 00:52:17', 1, 1, '2023-03-07', 1, '7000.00', '37000.00', '70000.00', NULL, NULL, NULL, '6500.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(5, 5, '6221025030733', 'جرام هندي', 1, 7, 0, 0, NULL, 11, NULL, 1, '2023-03-08 10:19:36', '2023-05-18 00:52:53', 1, 1, '2023-03-08', 1, '3500.00', '18000.00', '35000.00', NULL, NULL, NULL, '3000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(6, 6, '1111222', 'جرام نص', 1, 7, 0, 0, 9, 11, '2.00', 1, '2023-03-21 10:08:46', '2023-05-18 00:53:51', 1, 1, '2023-03-21', 1, '1200.00', '6000.00', '12000.00', '100.00', '100.00', '100.00', '1000.00', '100.00', 1, '0.00', '0.000', NULL, NULL, 1, 0),
(7, 7, '777', 'شميز طويل هندي', 1, 7, 0, 0, NULL, 11, NULL, 1, '2023-03-21 10:19:47', '2023-05-18 00:54:32', 1, 1, '2023-03-21', 1, '5000.00', '25000.00', '50000.00', NULL, NULL, NULL, '4500.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(8, 8, '1111', 'طقم تركي', 1, 7, 0, 0, NULL, 10, NULL, 1, '2023-03-21 10:34:15', '2023-05-18 00:58:38', 1, 1, '2023-03-21', 1, '30000.00', '150000.00', '300000.00', NULL, NULL, NULL, '25000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(9, 9, '11112221', 'بجامة كوري', 1, 7, 0, 0, NULL, 11, NULL, 1, '2023-03-21 11:51:00', '2023-05-18 01:01:40', 1, 1, '2023-03-21', 1, '3500.00', '17000.00', '32000.00', NULL, NULL, NULL, '3000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(10, 10, 'item10', 'برمودة', 1, 7, 0, 0, NULL, 11, NULL, 1, '2023-03-21 11:55:31', '2023-05-18 01:04:47', 1, 1, '2023-03-21', 1, '2200.00', '21500.00', '21000.00', NULL, NULL, NULL, '2000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(11, 11, 'item11', 'فنيلة رياضية', 1, 7, 0, 0, NULL, 11, NULL, 1, '2023-03-21 12:10:24', '2023-05-18 01:07:28', 1, 1, '2023-03-21', 1, '2500.00', '12000.00', '22000.00', NULL, NULL, NULL, '2000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(12, 12, 'item12', 'فنيلة كم أبو رقبة', 1, 7, 0, 0, NULL, 11, NULL, 1, '2023-03-21 12:14:19', '2023-05-18 01:10:19', 1, 1, '2023-03-21', 1, '4500.00', '22000.00', '42000.00', NULL, NULL, NULL, '40000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(13, 13, 'item13', 'نظارة رجالي', 1, 7, 0, 0, NULL, 10, NULL, 1, '2023-03-21 12:15:33', '2023-05-18 01:12:28', 1, 1, '2023-03-21', 1, '1200.00', '11000.00', '21000.00', NULL, NULL, NULL, '1000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(14, 14, '777771', 'بوتي كوري', 1, 7, 0, 0, 6, 11, '12.00', 1, '2023-05-12 13:01:46', '2023-05-18 01:15:10', 1, 1, '2023-05-12', 1, '4000.00', '19000.00', '38000.00', '100.00', '100.00', '100.00', '3500.00', '90.00', 1, '0.00', '0.000', NULL, NULL, 1, 0),
(15, 15, '5222', 'ساعة سويسري', 1, 7, 0, 0, 6, 10, '12.00', 1, '2023-05-12 13:02:26', '2023-05-20 10:49:36', 1, 1, '2023-05-12', 1, '4500.00', '22000.00', '41000.00', '100.00', '100.00', '100.00', '1200.00', '100.00', 1, '0.00', '0.000', NULL, NULL, 1, 0),
(16, 16, 'item16', 'فستان نص', 1, 8, 0, 0, NULL, 10, NULL, 1, '2023-05-18 01:21:52', '2023-05-18 01:22:48', 1, 1, '2023-05-18', 1, '10000.00', '49000.00', '95000.00', NULL, NULL, NULL, '9000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(17, 17, 'item17', 'فستان صيني', 1, 8, 0, 0, NULL, 10, NULL, 1, '2023-05-18 01:26:01', '2023-05-18 01:26:01', NULL, 1, '2023-05-18', 1, '7000.00', '34000.00', '67000.00', NULL, NULL, NULL, '6500.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(18, 18, 'item18', 'درع هندي', 1, 8, 0, 0, NULL, 10, NULL, 1, '2023-05-18 01:28:44', '2023-05-18 01:28:44', NULL, 1, '2023-05-18', 1, '15000.00', '73000.00', '148000.00', NULL, NULL, NULL, '14000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(19, 19, 'item19', 'تنورة قصير', 1, 8, 0, 0, NULL, 10, NULL, 1, '2023-05-18 04:00:47', '2023-05-18 04:00:47', NULL, 1, '2023-05-18', 1, '3500.00', '17000.00', '32000.00', NULL, NULL, NULL, '3000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(20, 20, 'item20', 'بنطلون اسود', 1, 8, 0, 0, NULL, 10, NULL, 1, '2023-05-18 04:03:07', '2023-05-18 04:03:07', NULL, 1, '2023-05-18', 1, '2500.00', '12000.00', '22000.00', NULL, NULL, NULL, '2000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(21, 21, 'item21', 'درع هندي مخرز', 1, 8, 0, 0, NULL, 10, NULL, 1, '2023-05-18 04:05:58', '2023-05-18 04:05:58', NULL, 1, '2023-05-18', 1, '12000.00', '58000.00', '110000.00', NULL, NULL, NULL, '10000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(22, 22, 'item22', 'طقم نسائي تركي', 1, 8, 0, 0, NULL, 10, NULL, 1, '2023-05-18 04:11:34', '2023-05-18 04:11:34', NULL, 1, '2023-05-18', 1, '25000.00', '120000.00', '220000.00', NULL, NULL, NULL, '20000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(23, 23, 'item23', 'شميز كوري', 1, 8, 0, 0, NULL, 10, NULL, 1, '2023-05-18 04:18:39', '2023-05-18 04:18:39', NULL, 1, '2023-05-18', 1, '3500.00', '17000.00', '32000.00', NULL, NULL, NULL, '3000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(24, 24, 'item24', 'جرم نص', 1, 8, 0, 0, NULL, 10, NULL, 1, '2023-05-18 04:21:34', '2023-05-18 04:21:34', NULL, 1, '2023-05-18', 1, '2200.00', '12000.00', '21000.00', NULL, NULL, NULL, '2000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(25, 25, 'item25', 'جاكت جنز', 1, 8, 0, 0, NULL, 10, NULL, 1, '2023-05-18 04:25:23', '2023-05-18 04:25:23', NULL, 1, '2023-05-18', 1, '5500.00', '28000.00', '52000.00', NULL, NULL, NULL, '5000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(26, 26, 'item26', 'فستان طويل', 1, 9, 0, 0, NULL, 10, NULL, 1, '2023-05-18 04:28:46', '2023-05-18 04:28:46', NULL, 1, '2023-05-18', 1, '9000.00', '44000.00', '85000.00', NULL, NULL, NULL, '8000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(27, 27, 'item27', 'شميز هندي ولادي', 1, 9, 0, 0, NULL, 10, NULL, 1, '2023-05-18 04:32:11', '2023-05-18 04:32:11', NULL, 1, '2023-05-18', 1, '3000.00', '14000.00', '27000.00', NULL, NULL, NULL, '2500.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(28, 28, 'item28', 'جرام نص ولادي', 1, 9, 0, 0, NULL, 10, NULL, 1, '2023-05-18 04:35:16', '2023-05-18 04:35:16', NULL, 1, '2023-05-18', 1, '2500.00', '12000.00', '22000.00', NULL, NULL, NULL, '2000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(29, 29, 'item29', 'بنطلون جينز ولادي', 1, 9, 0, 0, NULL, 10, NULL, 1, '2023-05-18 04:38:41', '2023-05-18 04:38:41', NULL, 1, '2023-05-18', 1, '4000.00', '19000.00', '37000.00', NULL, NULL, NULL, '3500.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(30, 30, 'item30', 'برمودة جينز', 1, 9, 0, 0, NULL, 10, NULL, 1, '2023-05-18 04:41:01', '2023-05-18 04:41:01', NULL, 1, '2023-05-18', 1, '2500.00', '12000.00', '22000.00', NULL, NULL, NULL, '2000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(31, 31, 'item31', 'طقم فرنسي', 1, 9, 0, 0, NULL, 10, NULL, 1, '2023-05-18 04:44:13', '2023-05-18 04:44:13', NULL, 1, '2023-05-18', 1, '15000.00', '74000.00', '145000.00', NULL, NULL, NULL, '14000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(32, 32, 'item32', 'فستان هندي', 1, 9, 0, 0, NULL, 10, NULL, 1, '2023-05-18 04:46:31', '2023-05-18 04:46:31', NULL, 1, '2023-05-18', 1, '6000.00', '29000.00', '55000.00', NULL, NULL, NULL, '5000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(33, 33, 'item33', 'جزمات', 1, 9, 0, 0, NULL, 10, NULL, 1, '2023-05-18 04:52:59', '2023-05-18 04:52:59', NULL, 1, '2023-05-18', 1, '3500.00', '17000.00', '33000.00', NULL, NULL, NULL, '3000.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(34, 34, 'item34', 'جرام كم', 1, 9, 0, 0, NULL, 10, NULL, 1, '2023-05-18 04:55:08', '2023-09-05 13:54:02', NULL, 1, '2023-05-18', 1, '2500.00', '12000.00', '22000.00', NULL, NULL, NULL, '3000.00', NULL, 1, '4.00', '4.000', NULL, NULL, 1, 0),
(35, 35, 'item35', 'بنطلون جينز خفيف', 1, 9, 0, 0, NULL, 10, NULL, 1, '2023-05-18 04:57:40', '2023-09-05 15:21:56', 1, 1, '2023-05-18', 1, '3500.00', '3400.00', '3100.00', NULL, NULL, NULL, '5000.00', '100.00', 1, '10.00', '10.000', NULL, NULL, 1, 10),
(36, 36, 'item36', 'صندل رجالي الميدان وطي', 1, 7, 0, 0, NULL, 11, NULL, 1, '2023-09-05 15:52:25', '2023-09-05 16:39:10', NULL, 1, '2023-09-05', 1, '1200.00', '1000.00', '1000.00', NULL, NULL, NULL, '1000.00', NULL, 1, '3.00', '3.000', NULL, NULL, 1, 0),
(37, 37, 'item37', 'صندل رجالي الميدان وطي439-16', 1, 7, 36, 0, NULL, 11, NULL, 1, '2023-09-05 15:54:49', '2023-09-05 16:10:59', NULL, 1, '2023-09-05', 1, '1200.00', '1230.00', '1500.00', NULL, NULL, NULL, '1000.00', NULL, 1, '10.00', '10.000', NULL, NULL, 1, 0),
(38, 38, 'item38', 'صندل رجالي الميدان وطي438-16', 1, 7, 36, 0, NULL, 11, NULL, 1, '2023-09-05 15:55:50', '2023-09-05 15:55:50', NULL, 1, '2023-09-05', 1, '1200.00', '10222.00', '1500.00', NULL, NULL, NULL, '1200.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(39, 39, 'item39', 'صندل رجالي الميدان وطي429-16', 1, 7, 36, 0, NULL, 11, NULL, 1, '2023-09-05 15:56:51', '2023-09-05 15:56:51', NULL, 1, '2023-09-05', 1, '1200.00', '100.00', '100.00', NULL, NULL, NULL, '100.00', NULL, 1, '0.00', '0.000', NULL, NULL, 1, 0),
(40, 40, 'item40', 'الصقور', 1, 7, 0, 1, 4, 11, '2.00', 1, '2023-09-05 17:01:17', '2023-09-05 17:23:21', 1, 1, '2023-09-05', 1, '1300.00', '1300.00', '1300.00', '130.00', '100.00', '100.00', '1400.00', '233.33', 0, '8.00', '8.000', '0.000', '16.000', 1, 0),
(41, 41, 'item41', 'الصقور 07', 1, 7, 40, 1, 4, 11, '2.00', 1, '2023-09-05 17:30:59', '2023-09-05 17:35:49', NULL, 1, '2023-09-05', 1, '1200.00', '1200.00', '1200.00', '600.00', '600.00', '600.00', '1100.00', '550.00', 0, '9.00', '9.000', '0.000', '18.000', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inv_itemcard_batches`
--

CREATE TABLE `inv_itemcard_batches` (
  `id` bigint(20) NOT NULL,
  `store_id` int(11) NOT NULL COMMENT 'كود المخزن',
  `item_code` int(11) NOT NULL COMMENT 'كود الصنف الالي ',
  `inv_uoms_id` int(11) NOT NULL COMMENT 'كود الوحده الاب ',
  `unit_cost_price` decimal(10,2) NOT NULL COMMENT 'سعر الشراء للوحده',
  `quantity` decimal(10,2) NOT NULL COMMENT 'الكمية بالوحده الاب',
  `total_cost_price` decimal(10,2) NOT NULL COMMENT 'اجمالي سعر شراء الباتش ككل',
  `production_date` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `com_code` int(11) NOT NULL,
  `auto_serial` bigint(20) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_send_to_archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='جدول  باتشات الاصناف بالمخازن';

--
-- Dumping data for table `inv_itemcard_batches`
--

INSERT INTO `inv_itemcard_batches` (`id`, `store_id`, `item_code`, `inv_uoms_id`, `unit_cost_price`, `quantity`, `total_cost_price`, `production_date`, `expired_date`, `com_code`, `auto_serial`, `added_by`, `created_at`, `updated_at`, `updated_by`, `is_send_to_archived`) VALUES
(1, 1, 1, 11, '3000.00', '748.00', '2244000.00', NULL, NULL, 1, 1, 1, '2023-05-20 12:15:05', '2023-05-30 04:46:34', 1, 0),
(2, 3, 35, 10, '5000.00', '10.00', '50000.00', NULL, NULL, 1, 2, 1, '2023-05-20 12:17:16', '2023-06-20 09:11:22', 1, 0),
(3, 1, 2, 11, '3500.00', '7.00', '24500.00', NULL, NULL, 1, 3, 1, '2023-05-24 00:58:25', '2023-07-04 11:00:15', 1, 0),
(4, 1, 34, 10, '3000.00', '4.00', '12000.00', NULL, NULL, 1, 4, 1, '2023-05-24 03:32:19', '2023-09-05 13:54:02', 1, 0),
(5, 1, 37, 11, '1000.00', '10.00', '10000.00', NULL, NULL, 1, 5, 1, '2023-09-05 16:10:59', '2023-09-05 16:10:59', NULL, 0),
(6, 1, 36, 11, '1000.00', '3.00', '3000.00', NULL, NULL, 1, 6, 1, '2023-09-05 16:10:59', '2023-09-05 16:39:10', 1, 0),
(7, 1, 40, 11, '1400.00', '8.00', '11200.00', NULL, NULL, 1, 7, 1, '2023-09-05 17:03:24', '2023-09-05 17:18:51', 1, 0),
(8, 4, 41, 11, '1100.00', '9.00', '9900.00', NULL, NULL, 1, 8, 1, '2023-09-05 17:33:08', '2023-09-05 17:35:49', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inv_itemcard_categories`
--

CREATE TABLE `inv_itemcard_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL COMMENT 'for search ',
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='جدول فئات الاصناف';

--
-- Dumping data for table `inv_itemcard_categories`
--

INSERT INTO `inv_itemcard_categories` (`id`, `name`, `created_at`, `updated_at`, `added_by`, `updated_by`, `com_code`, `date`, `active`) VALUES
(1, 'لحوم ومجمدات', '2022-09-02 00:35:47', '2022-09-02 00:35:47', 1, NULL, 1, '2022-09-02', 1),
(3, 'حبوب', '2022-09-02 00:56:29', '2022-09-02 00:56:29', 1, NULL, 1, '2022-09-02', 1),
(4, 'مخللات', '2022-09-02 01:21:06', '2022-09-02 01:21:06', 1, NULL, 1, '2022-09-02', 1),
(5, 'بقوليات', '2022-10-11 08:34:41', '2022-10-14 03:38:39', 1, 1, 1, '2022-10-11', 1),
(6, 'خردوات', '2022-12-19 01:26:03', '2022-12-19 01:26:03', 1, NULL, 1, '2022-12-19', 1),
(7, 'رجالي', '2023-05-17 23:21:30', '2023-05-17 23:21:30', 1, NULL, 1, '2023-05-17', 1),
(8, 'نسائي', '2023-05-17 23:21:53', '2023-05-17 23:21:53', 1, NULL, 1, '2023-05-17', 1),
(9, 'ولادي', '2023-05-17 23:22:21', '2023-05-17 23:22:21', 1, NULL, 1, '2023-05-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inv_itemcard_movements`
--

CREATE TABLE `inv_itemcard_movements` (
  `id` bigint(20) NOT NULL,
  `inv_itemcard_movements_categories` int(11) NOT NULL,
  `item_code` bigint(20) NOT NULL,
  `store_id` int(11) NOT NULL COMMENT 'كود المخزن',
  `items_movements_types` int(11) NOT NULL,
  `FK_table` bigint(20) NOT NULL,
  `FK_table_details` bigint(20) NOT NULL,
  `byan` varchar(100) NOT NULL,
  `quantity_befor_movement` varchar(60) NOT NULL COMMENT 'بكل المخازن',
  `quantity_after_move` varchar(60) NOT NULL COMMENT 'بكل المخازن',
  `added_by` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `com_code` int(11) NOT NULL,
  `quantity_befor_move_store` varchar(60) NOT NULL COMMENT 'كل الكمية للصنف قبل الحركة  بالمخزن المحدد مع الحركة',
  `quantity_after_move_store` varchar(60) NOT NULL COMMENT 'كل الكمية للصنف بعد الحركة  بالمخزن المحدد مع الحركة'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `inv_itemcard_movements`
--

INSERT INTO `inv_itemcard_movements` (`id`, `inv_itemcard_movements_categories`, `item_code`, `store_id`, `items_movements_types`, `FK_table`, `FK_table_details`, `byan`, `quantity_befor_movement`, `quantity_after_move`, `added_by`, `date`, `created_at`, `com_code`, `quantity_befor_move_store`, `quantity_after_move_store`) VALUES
(1, 1, 1, 1, 1, 1, 1, 'نظير مشتريات من المورد  البدري للحوم المجمده فاتورة رقم 1', 'عدد  0 كرتون', 'عدد  1000 كرتون', 1, '2023-05-20', '2023-05-20 12:15:05', 1, 'عدد  0 كرتون', 'عدد  1000 كرتون'),
(2, 1, 1, 1, 1, 1, 2, 'نظير مشتريات من المورد  البدري للحوم المجمده فاتورة رقم 1', 'عدد  1000 كرتون', 'عدد  1050 كرتون', 1, '2023-05-20', '2023-05-20 12:15:05', 1, 'عدد  1000 كرتون', 'عدد  1050 كرتون'),
(3, 1, 1, 3, 1, 2, 3, 'نظير مشتريات من المورد  محمود محمد فاتورة رقم 2', 'عدد  1050 كرتون', 'عدد  1200 كرتون', 1, '2023-05-20', '2023-05-20 12:17:16', 1, 'عدد  0 كرتون', 'عدد  0 كرتون'),
(4, 1, 35, 3, 1, 2, 4, 'نظير مشتريات من المورد  محمود محمد فاتورة رقم 2', 'عدد  0 وحده', 'عدد  20 وحده', 1, '2023-05-20', '2023-05-20 12:17:16', 1, 'عدد  0 وحده', 'عدد  20 وحده'),
(5, 2, 1, 1, 4, 1, 46, 'نظير مبيعات  للعميل   طياري لايوجد فاتورة رقم 1', 'عدد  1200 كرتون', 'عدد  1000 كرتون', 1, '2023-05-20', '2023-05-20 13:21:52', 1, 'عدد  1200 كرتون', 'عدد  1000 كرتون'),
(6, 3, 1, 1, 6, 2, 15, 'جرد بالمخازن للباتش رقم 1 جرد رقم 2', 'عدد  1000 كرتون', 'عدد  1000 كرتون', 1, '2023-05-20', '2023-05-20 13:23:38', 1, 'عدد  1000 كرتون', 'عدد  1000 كرتون'),
(7, 2, 1, 1, 4, 2, 47, 'نظير مبيعات  للعميل   طياري لايوجد فاتورة رقم 2', 'عدد  1000 كرتون', 'عدد  950 كرتون', 1, '2023-05-20', '2023-05-20 13:24:13', 1, 'عدد  1000 كرتون', 'عدد  950 كرتون'),
(8, 2, 1, 1, 4, 3, 48, 'نظير مبيعات  للعميل   طياري لايوجد فاتورة رقم 3', 'عدد  950 كرتون', 'عدد  900 كرتون', 1, '2023-05-20', '2023-05-20 15:06:02', 1, 'عدد  950 كرتون', 'عدد  900 كرتون'),
(9, 3, 1, 1, 6, 4, 16, 'جرد بالمخازن للباتش رقم 1 جرد رقم 4', 'عدد  900 كرتون', 'عدد  900 كرتون', 1, '2023-05-20', '2023-05-20 15:07:30', 1, 'عدد  900 كرتون', 'عدد  900 كرتون'),
(10, 2, 1, 1, 4, 4, 49, 'نظير مبيعات  للعميل   طياري لايوجد فاتورة رقم 4', 'عدد  900 كرتون', 'عدد  800 كرتون', 1, '2023-05-22', '2023-05-22 00:40:03', 1, 'عدد  900 كرتون', 'عدد  800 كرتون'),
(11, 2, 1, 1, 4, 5, 50, 'نظير مبيعات  للعميل   طياري لايوجد فاتورة رقم 5', 'عدد  800 كرتون', 'عدد  799 كرتون', 1, '2023-05-22', '2023-05-22 00:42:34', 1, 'عدد  800 كرتون', 'عدد  799 كرتون'),
(12, 1, 2, 1, 1, 3, 5, 'نظير مشتريات من المورد  محمود محمد فاتورة رقم 3', 'عدد  0 كرتون', 'عدد  10 كرتون', 1, '2023-05-24', '2023-05-24 00:58:25', 1, 'عدد  0 كرتون', 'عدد  10 كرتون'),
(13, 1, 1, 1, 1, 4, 6, 'نظير مشتريات من المورد  البدري للحوم المجمده فاتورة رقم 4', 'عدد  799 كرتون', 'عدد  849 كرتون', 1, '2023-05-24', '2023-05-24 03:32:19', 1, 'عدد  799 كرتون', 'عدد  849 كرتون'),
(14, 1, 34, 1, 1, 4, 7, 'نظير مشتريات من المورد  البدري للحوم المجمده فاتورة رقم 4', 'عدد  0 وحده', 'عدد  10 وحده', 1, '2023-05-24', '2023-05-24 03:32:19', 1, 'عدد  0 وحده', 'عدد  10 وحده'),
(15, 2, 34, 1, 4, 5, 51, 'نظير مبيعات  للعميل   طياري لايوجد فاتورة رقم 5', 'عدد  10 وحده', 'عدد  5 وحده', 1, '2023-05-24', '2023-05-24 04:36:17', 1, 'عدد  10 وحده', 'عدد  5 وحده'),
(16, 2, 2, 1, 4, 37, 52, 'نظير مبيعات  للعميل  Mohammed Alhomaidi فاتورة رقم ', 'عدد  10 كرتون', 'عدد  9 كرتون', 1, '2023-05-27', '2023-05-27 21:09:31', 1, 'عدد  0 كرتون', 'عدد  0 كرتون'),
(17, 2, 1, 1, 4, 37, 53, 'نظير مبيعات  للعميل  Mohammed Alhomaidi فاتورة رقم ', 'عدد  849 كرتون', 'عدد  848 كرتون', 1, '2023-05-27', '2023-05-27 21:09:31', 1, 'عدد  0 كرتون', 'عدد  0 كرتون'),
(18, 3, 1, 1, 20, 1, 15, ' نظير صرف أصناف  الي مخزن الاستلام  المشروبات أمر تحويل رقم 1', 'عدد  848 كرتون', 'عدد  748 كرتون', 1, '2023-05-30', '2023-05-30 04:46:34', 1, 'عدد  848 كرتون', 'عدد  748 كرتون'),
(19, 2, 35, 3, 4, 40, 54, 'نظير مبيعات  للعميل  محمد طاهر عبدة سيف فاتورة رقم ', 'عدد  20 وحده', 'عدد  10 وحده', 1, '2023-06-20', '2023-06-20 09:11:22', 1, 'عدد  0 وحده', 'عدد  0 وحده'),
(20, 2, 2, 1, 4, 10, 55, 'نظير مبيعات  للعميل  انس نعمان فاتورة رقم 10', 'عدد  9 كرتون', 'عدد  7 كرتون', 1, '2023-07-04', '2023-07-04 11:00:15', 1, 'عدد  9 كرتون', 'عدد  7 كرتون'),
(21, 2, 34, 1, 4, 42, 56, 'نظير مبيعات  للعميل  مهران مسعد عبدالعزيز فاتورة رقم ', 'عدد  5 وحده', 'عدد  4 وحده', 1, '2023-09-05', '2023-09-05 13:54:02', 1, 'عدد  0 وحده', 'عدد  0 وحده'),
(22, 1, 37, 1, 1, 6, 9, 'نظير مشتريات من المورد  البدري للحوم المجمده فاتورة رقم 6', 'عدد  0 كرتون', 'عدد  10 كرتون', 1, '2023-09-05', '2023-09-05 16:10:59', 1, 'عدد  0 كرتون', 'عدد  10 كرتون'),
(23, 1, 36, 1, 1, 6, 10, 'نظير مشتريات من المورد  البدري للحوم المجمده فاتورة رقم 6', 'عدد  0 كرتون', 'عدد  10 كرتون', 1, '2023-09-05', '2023-09-05 16:10:59', 1, 'عدد  0 كرتون', 'عدد  10 كرتون'),
(24, 2, 36, 1, 4, 12, 57, 'نظير مبيعات  للعميل  انس نعمان فاتورة رقم 12', 'عدد  10 كرتون', 'عدد  9 كرتون', 1, '2023-09-05', '2023-09-05 16:18:13', 1, 'عدد  10 كرتون', 'عدد  9 كرتون'),
(25, 2, 36, 1, 4, 12, 58, 'نظير مبيعات  للعميل  انس نعمان فاتورة رقم 12', 'عدد  9 كرتون', 'عدد  6 كرتون', 1, '2023-09-05', '2023-09-05 16:20:06', 1, 'عدد  9 كرتون', 'عدد  6 كرتون'),
(26, 2, 36, 1, 4, 12, 59, 'نظير مبيعات  للعميل  انس نعمان فاتورة رقم 12', 'عدد  6 كرتون', 'عدد  4 كرتون', 1, '2023-09-05', '2023-09-05 16:20:42', 1, 'عدد  6 كرتون', 'عدد  4 كرتون'),
(27, 2, 36, 1, 4, 13, 60, 'نظير مبيعات  للعميل  مهران مسعد عبدالعزيز فاتورة رقم 13', 'عدد  4 كرتون', 'عدد  3 كرتون', 1, '2023-09-05', '2023-09-05 16:39:10', 1, 'عدد  4 كرتون', 'عدد  3 كرتون'),
(28, 1, 40, 1, 1, 7, 11, 'نظير مشتريات من المورد  البدري للحوم المجمده فاتورة رقم 7', 'عدد  0 كرتون', 'عدد  10 كرتون', 1, '2023-09-05', '2023-09-05 17:03:24', 1, 'عدد  0 كرتون', 'عدد  10 كرتون'),
(29, 2, 40, 1, 4, 13, 61, 'نظير مبيعات  للعميل  مهران مسعد عبدالعزيز فاتورة رقم 13', 'عدد  10 كرتون', 'عدد  9.5 كرتون', 1, '2023-09-05', '2023-09-05 17:17:58', 1, 'عدد  10 كرتون', 'عدد  9.5 كرتون'),
(30, 2, 40, 1, 4, 13, 62, 'نظير مبيعات  للعميل  مهران مسعد عبدالعزيز فاتورة رقم 13', 'عدد  9.5 كرتون', 'عدد  8.5 كرتون', 1, '2023-09-05', '2023-09-05 17:18:21', 1, 'عدد  9.5 كرتون', 'عدد  8.5 كرتون'),
(31, 2, 40, 1, 4, 13, 63, 'نظير مبيعات  للعميل  مهران مسعد عبدالعزيز فاتورة رقم 13', 'عدد  8.5 كرتون', 'عدد  8 كرتون', 1, '2023-09-05', '2023-09-05 17:18:51', 1, 'عدد  8.5 كرتون', 'عدد  8 كرتون'),
(32, 1, 41, 4, 1, 5, 12, 'نظير مشتريات من المورد  الاحمدي للفراخ المجمده فاتورة رقم 5', 'عدد  0 كرتون', 'عدد  10 كرتون', 1, '2023-09-05', '2023-09-05 17:33:08', 1, 'عدد  0 كرتون', 'عدد  10 كرتون'),
(33, 2, 41, 4, 4, 13, 64, 'نظير مبيعات  للعميل  مهران مسعد عبدالعزيز فاتورة رقم 13', 'عدد  10 كرتون', 'عدد  9 كرتون', 1, '2023-09-05', '2023-09-05 17:35:49', 1, 'عدد  10 كرتون', 'عدد  9 كرتون');

-- --------------------------------------------------------

--
-- Table structure for table `inv_itemcard_movements_categories`
--

CREATE TABLE `inv_itemcard_movements_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `inv_itemcard_movements_categories`
--

INSERT INTO `inv_itemcard_movements_categories` (`id`, `name`) VALUES
(1, 'حركة علي المشتريات'),
(2, 'حركة علي المبيعات'),
(3, 'حركة علي المخازن');

-- --------------------------------------------------------

--
-- Table structure for table `inv_itemcard_movements_types`
--

CREATE TABLE `inv_itemcard_movements_types` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `inv_itemcard_movements_types`
--

INSERT INTO `inv_itemcard_movements_types` (`id`, `type`) VALUES
(1, 'مشتريات '),
(2, 'مرتجع مشتريات بأصل الفاتورة'),
(3, 'مرتجع مشتريات عام'),
(4, 'مبيعات'),
(5, 'مرتجع مبيعات عام'),
(6, 'جرد بالمخازن'),
(7, 'مرتجع صرف داخلي لمندوب'),
(8, 'تحويل بين مخازن'),
(9, 'مبيعات صرف مباشر لعميل'),
(10, 'مبيعات صرف لمندوب التوصيل'),
(11, 'صرف خامات لخط التصنيع'),
(12, 'رد خامات من خط التصنيع'),
(13, 'استلام انتاج تام من خط التصنيع'),
(14, 'رد انتاج تام الي خط التصنيع'),
(15, 'حذف الصنف من تفاصيل فاتورة مبيعات مفتوحة'),
(16, 'حذف الصنف من تفاصيل فاتورة مرتجع مبيعات عام مفتوحة'),
(17, 'صرف خامات لخط الانتاج'),
(18, 'حذف صنف مضاف علي فاتورة صرف خامات لخط الانتاج'),
(19, 'اعتماد فاتورة استلام انتاج تام من خط الانتاج'),
(20, 'صرف كمية بأمر تحويل بين المخازن'),
(21, 'حذف صنف بأمر تحويل بين المخازن'),
(22, 'اعتماد واستلام كمية صنف بأمر تحويل مخزني وارد');

-- --------------------------------------------------------

--
-- Table structure for table `inv_stores_inventory`
--

CREATE TABLE `inv_stores_inventory` (
  `id` bigint(20) NOT NULL,
  `store_id` int(11) NOT NULL COMMENT 'مخزن الجرد',
  `inventory_date` date NOT NULL,
  `inventory_type` tinyint(1) NOT NULL COMMENT 'واحد جرد يومي - اثنين جرد اسبوعي - ثلاثه جرد شهري - اربعه جرد سنوي ',
  `auto_serial` bigint(20) NOT NULL,
  `is_closed` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'هل امر الجرد مغلق ومرحل',
  `total_cost_batches` decimal(10,2) NOT NULL DEFAULT 0.00,
  `notes` varchar(225) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `com_code` int(11) NOT NULL,
  `cloased_by` int(11) DEFAULT NULL,
  `closed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='جدول جرد المخازن';

--
-- Dumping data for table `inv_stores_inventory`
--

INSERT INTO `inv_stores_inventory` (`id`, `store_id`, `inventory_date`, `inventory_type`, `auto_serial`, `is_closed`, `total_cost_batches`, `notes`, `added_by`, `date`, `created_at`, `updated_by`, `updated_at`, `com_code`, `cloased_by`, `closed_at`) VALUES
(6, 1, '2023-05-12', 1, 2, 1, '4000000.00', NULL, 1, '2023-05-12', '2023-05-12 13:06:08', NULL, '2023-05-20 13:25:17', 1, 1, '2023-05-20 13:25:17'),
(7, 3, '2023-05-20', 2, 3, 1, '100000.00', 'mohammed  al homaidi', 1, '2023-05-20', '2023-05-20 12:28:34', 1, '2023-05-20 13:11:39', 1, 1, '2023-05-20 13:11:39'),
(8, 1, '2023-05-20', 1, 4, 1, '3600000.00', NULL, 1, '2023-05-20', '2023-05-20 13:25:40', NULL, '2023-05-20 15:40:10', 1, 1, '2023-05-20 15:40:10'),
(9, 1, '2023-05-20', 1, 5, 0, '0.00', NULL, 1, '2023-05-20', '2023-05-20 15:40:32', NULL, '2023-06-19 05:52:42', 1, NULL, NULL),
(10, 3, '2023-05-20', 1, 6, 0, '100000.00', NULL, 1, '2023-05-20', '2023-05-20 16:25:19', NULL, '2023-05-20 16:31:26', 1, NULL, NULL),
(11, 5, '2023-06-11', 3, 7, 0, '0.00', NULL, 1, '2023-06-11', '2023-06-11 19:38:59', NULL, '2023-06-11 19:38:59', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inv_stores_inventory_details`
--

CREATE TABLE `inv_stores_inventory_details` (
  `id` bigint(20) NOT NULL,
  `inv_stores_inventory_id` bigint(20) NOT NULL,
  `inv_stores_inventory_auto_serial` bigint(20) NOT NULL,
  `item_code` bigint(20) NOT NULL,
  `inv_uoms_id` int(11) NOT NULL,
  `batch_auto_serial` bigint(20) NOT NULL,
  `old_quantity` decimal(10,2) NOT NULL,
  `new_quantity` decimal(10,2) NOT NULL,
  `diffrent_quantity` decimal(10,2) NOT NULL DEFAULT 0.00,
  `unit_cost_price` decimal(10,2) NOT NULL,
  `total_cost_price` decimal(10,2) NOT NULL,
  `production_date` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `notes` varchar(225) DEFAULT NULL,
  `is_closed` tinyint(1) NOT NULL DEFAULT 0,
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `cloased_by` int(11) DEFAULT NULL,
  `closed_at` datetime DEFAULT NULL,
  `com_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='تفاصيل امر الجرد';

--
-- Dumping data for table `inv_stores_inventory_details`
--

INSERT INTO `inv_stores_inventory_details` (`id`, `inv_stores_inventory_id`, `inv_stores_inventory_auto_serial`, `item_code`, `inv_uoms_id`, `batch_auto_serial`, `old_quantity`, `new_quantity`, `diffrent_quantity`, `unit_cost_price`, `total_cost_price`, `production_date`, `expired_date`, `notes`, `is_closed`, `added_by`, `created_at`, `updated_by`, `updated_at`, `cloased_by`, `closed_at`, `com_code`) VALUES
(14, 7, 3, 35, 10, 2, '20.00', '20.00', '0.00', '5000.00', '100000.00', NULL, NULL, NULL, 0, 1, '2023-05-20 13:00:45', NULL, '2023-05-20 13:00:45', NULL, NULL, 1),
(15, 6, 2, 1, 11, 1, '1000.00', '1000.00', '0.00', '4000.00', '4000000.00', NULL, NULL, NULL, 1, 1, '2023-05-20 13:23:01', NULL, '2023-05-20 13:23:38', 1, '2023-05-20 13:23:38', 1),
(16, 8, 4, 1, 11, 1, '950.00', '900.00', '-50.00', '4000.00', '3600000.00', NULL, NULL, 'dddd', 1, 1, '2023-05-20 14:48:28', 1, '2023-05-20 15:07:30', 1, '2023-05-20 15:07:30', 1),
(17, 10, 6, 35, 10, 2, '20.00', '20.00', '0.00', '5000.00', '100000.00', NULL, NULL, NULL, 0, 1, '2023-05-20 16:31:26', NULL, '2023-05-20 16:31:26', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inv_stores_transfer`
--

CREATE TABLE `inv_stores_transfer` (
  `id` bigint(20) NOT NULL,
  `auto_serial` bigint(20) NOT NULL,
  `transfer_from_store_id` int(11) NOT NULL COMMENT 'مخزن التحويل',
  `transfer_to_store_id` int(11) NOT NULL COMMENT 'مخزن الاستلام',
  `order_date` date NOT NULL COMMENT 'تاريخ التحويل',
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `com_code` int(11) NOT NULL,
  `notes` varchar(225) DEFAULT NULL COMMENT 'اجمالي الفاتورة قبل الخصم',
  `items_counter` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_cost_items` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'اجمالي الاصناف فقط',
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='جدول مشتريات ومترجعات المودين ';

--
-- Dumping data for table `inv_stores_transfer`
--

INSERT INTO `inv_stores_transfer` (`id`, `auto_serial`, `transfer_from_store_id`, `transfer_to_store_id`, `order_date`, `is_approved`, `com_code`, `notes`, `items_counter`, `total_cost_items`, `added_by`, `created_at`, `updated_at`, `updated_by`, `approved_by`, `approved_at`) VALUES
(7, 1, 1, 4, '2023-05-30', 0, 1, NULL, '100.00', '300000.00', 1, '2023-05-30 04:41:05', '2023-05-30 04:46:34', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inv_stores_transfer_details`
--

CREATE TABLE `inv_stores_transfer_details` (
  `id` bigint(20) NOT NULL,
  `inv_stores_transfer_id` bigint(20) NOT NULL,
  `inv_stores_transfer_auto_serial` bigint(20) NOT NULL,
  `com_code` int(11) NOT NULL,
  `deliverd_quantity` decimal(10,2) NOT NULL,
  `uom_id` int(11) NOT NULL,
  `isparentuom` tinyint(1) NOT NULL COMMENT '1-main -0 retail',
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` date NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `item_code` bigint(20) NOT NULL,
  `production_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `item_card_type` tinyint(1) NOT NULL,
  `transfer_from_batch_id` bigint(20) NOT NULL,
  `transfer_to_batch_id` bigint(20) DEFAULT NULL,
  `is_approved` tinyint(1) DEFAULT 0,
  `approved_by` int(11) DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `is_canceld_receive` tinyint(1) DEFAULT 0,
  `canceld_by` int(11) DEFAULT NULL,
  `canceld_at` datetime DEFAULT NULL,
  `canceld_cause` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='تفاصيل اصناف امر الصرف  الخامات  لخط الانتاج';

--
-- Dumping data for table `inv_stores_transfer_details`
--

INSERT INTO `inv_stores_transfer_details` (`id`, `inv_stores_transfer_id`, `inv_stores_transfer_auto_serial`, `com_code`, `deliverd_quantity`, `uom_id`, `isparentuom`, `unit_price`, `total_price`, `order_date`, `added_by`, `created_at`, `updated_by`, `updated_at`, `item_code`, `production_date`, `expire_date`, `item_card_type`, `transfer_from_batch_id`, `transfer_to_batch_id`, `is_approved`, `approved_by`, `approved_at`, `is_canceld_receive`, `canceld_by`, `canceld_at`, `canceld_cause`) VALUES
(15, 7, 1, 1, '100.00', 11, 1, '3000.00', '300000.00', '2023-05-30', 1, '2023-05-30 04:46:34', NULL, '2023-05-30 04:46:34', 1, NULL, NULL, 1, 1, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inv_uoms`
--

CREATE TABLE `inv_uoms` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `is_master` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL COMMENT 'for search ',
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='جدول الوحدات';

--
-- Dumping data for table `inv_uoms`
--

INSERT INTO `inv_uoms` (`id`, `name`, `is_master`, `created_at`, `updated_at`, `added_by`, `updated_by`, `com_code`, `date`, `active`) VALUES
(2, '6 حبات', 0, '2022-09-01 10:20:39', '2023-09-05 16:53:48', 1, 1, 1, '2022-09-01', 1),
(4, 'نص كرتون', 0, '2022-09-01 10:30:29', '2023-09-05 16:54:18', 1, 1, 1, '2022-09-01', 1),
(5, 'كرتونة كوبيات', 1, '2022-09-21 22:22:14', '2022-10-10 09:35:50', 1, 1, 1, '2022-09-21', 1),
(6, 'علبة', 0, '2022-09-21 22:22:25', '2022-10-10 09:24:48', 1, 1, 1, '2022-09-21', 1),
(7, 'نول', 1, '2022-10-10 09:10:41', '2022-10-10 09:10:41', 1, NULL, 1, '2022-10-10', 1),
(8, 'متر', 1, '2022-10-10 09:11:02', '2022-10-10 09:35:19', 1, 1, 1, '2022-10-10', 1),
(9, 'كيس 1 ك', 0, '2022-10-11 08:38:25', '2022-10-11 08:38:25', 1, NULL, 1, '2022-10-11', 1),
(10, 'وحده', 1, '2022-12-19 01:26:35', '2022-12-19 01:26:35', 1, NULL, 1, '2022-12-19', 1),
(11, 'كرتون', 1, '2023-05-17 23:30:01', '2023-05-17 23:30:01', 1, NULL, 1, '2023-05-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `itemcard_photos`
--

CREATE TABLE `itemcard_photos` (
  `id` int(11) NOT NULL,
  `itemcard_id` bigint(20) NOT NULL,
  `photos1` varchar(2500) DEFAULT NULL,
  `photo2` varchar(250) DEFAULT NULL,
  `photo3` varchar(250) DEFAULT NULL,
  `photo4` varchar(250) DEFAULT NULL,
  `photo5` varchar(250) DEFAULT NULL,
  `photo6` varchar(200) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated _by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itemcard_photos`
--

INSERT INTO `itemcard_photos` (`id`, `itemcard_id`, `photos1`, `photo2`, `photo3`, `photo4`, `photo5`, `photo6`, `added_by`, `created_at`, `updated_at`, `updated _by`) VALUES
(1, 7, '1684371271299.jpg', '1684371271659.webp', '1684370739808.webp', '1684370739829.jpg', '1684370739161.jpg', NULL, 1, '2023-03-21 10:19:47', '2023-05-18 00:54:32', NULL),
(2, 8, '1684371389179.webp', '1684371389318.webp', '1684371390347.webp', '1684371390616.webp', '1684371390537.webp', '1679394855279.jpg', 1, '2023-03-21 10:34:15', '2023-05-18 00:56:30', NULL),
(3, 9, '1684371700191.webp', '1684371699914.webp', '1684371700254.webp', '1684371700901.webp', '1684371700578.webp', NULL, 1, '2023-03-21 11:51:00', '2023-05-18 01:01:40', NULL),
(4, 10, '1684371797459.webp', '1684371797803.webp', '1684371797959.webp', '1684371797108.webp', '1684371797902.webp', NULL, 1, '2023-03-21 11:55:31', '2023-05-18 01:03:17', NULL),
(5, 11, '1684372047506.webp', '1684372047684.png', '1684372047551.webp', '1684372047609.png', '1684372048355.webp', NULL, 1, '2023-03-21 12:10:24', '2023-05-18 01:07:28', NULL),
(6, 12, '1684372219688.webp', '1684372219382.webp', '1684372219666.jpg', '1684372219979.webp', '1684372219635.webp', NULL, 1, '2023-03-21 12:14:19', '2023-05-18 01:10:19', NULL),
(7, 13, '1684372348834.webp', '1684372348204.jpg', '1684372348907.webp', '1684372348301.webp', '1684372348365.jpg', NULL, 1, '2023-03-21 12:15:33', '2023-05-18 01:12:28', NULL),
(8, 14, '1684372510671.webp', '1684372510541.webp', '1684372510197.webp', '1684372510135.webp', '1684372510997.webp', NULL, 1, '2023-05-12 13:01:46', '2023-05-18 01:15:10', NULL),
(9, 15, '1684372697500.webp', '1684372697413.webp', '1684372697961.webp', '1684372697310.webp', '1684372697978.webp', NULL, 1, '2023-05-12 13:02:26', '2023-05-18 01:18:17', NULL),
(11, 1, '1684371028528.webp', '1684369207454.webp', '1684369207418.webp', '1684369207720.webp', '1684369207398.webp', NULL, 1, '2023-05-18 02:10:48', '2023-05-18 00:50:28', NULL),
(16, 2, '1684371070108.webp', '1684369614494.webp', '1684369614148.webp', '1684369614535.webp', '1684369614108.webp', NULL, 0, '2023-05-18 02:13:43', '2023-05-18 00:51:10', 1),
(17, 3, '1684371100625.jpg', '1684369813455.jpg', '1684369813707.webp', '1684369813797.webp', '1684369813812.jpg', NULL, 1, '2023-05-18 02:13:43', '2023-05-18 00:51:40', NULL),
(18, 6, '1684371231541.webp', '1684370449831.webp', '1684370449105.webp', '1684370449482.png', '1684370449933.webp', NULL, 1, '2023-05-18 02:16:00', '2023-05-18 00:53:51', NULL),
(19, 5, '1684371173876.jpg', '1684370206974.jpg', '1684370206260.webp', '1684370206315.jpg', '1684370206973.jpg', NULL, 1, '2023-05-18 02:16:00', '2023-05-18 00:52:53', NULL),
(20, 4, '1684371137455.webp', '1684370033839.webp', '1684370033439.webp', '1684370033429.webp', '1684370033823.webp', NULL, 1, '2023-05-18 02:17:06', '2023-05-18 00:52:17', NULL),
(21, 16, '1684372968282.webp', '1684372968491.webp', '1684372968524.webp', '1684372968456.webp', '1684372968291.webp', NULL, 1, '2023-05-18 01:21:52', '2023-05-18 01:22:48', NULL),
(22, 17, '1684373161650.jpg', '1684373161529.webp', '1684373161211.jpg', '1684373161507.jpg', '1684373161626.jpg', NULL, 1, '2023-05-18 01:26:01', '2023-05-18 01:26:01', NULL),
(23, 18, '1684373324723.webp', '1684373324720.webp', '1684373324923.webp', '1684373324471.webp', '1684373324639.webp', NULL, 1, '2023-05-18 01:28:44', '2023-05-18 01:28:44', NULL),
(24, 19, '1684382447945.webp', '1684382447961.webp', '1684382447139.webp', '1684382447196.webp', '1684382447359.webp', NULL, 1, '2023-05-18 04:00:47', '2023-05-18 04:00:47', NULL),
(25, 20, '1684382587333.webp', '1684382587172.webp', '1684382587263.webp', '1684382587737.jpg', '1684382587667.webp', NULL, 1, '2023-05-18 04:03:07', '2023-05-18 04:03:07', NULL),
(26, 21, '1684382758691.webp', '1684382758734.webp', '1684382758144.webp', '1684382758585.webp', '1684382758870.webp', NULL, 1, '2023-05-18 04:05:58', '2023-05-18 04:05:58', NULL),
(27, 22, '1684383093483.webp', '1684383093397.webp', '1684383093854.webp', '1684383093504.webp', NULL, NULL, 1, '2023-05-18 04:11:34', '2023-05-18 04:11:34', NULL),
(28, 23, '1684383518234.jpg', '1684383518550.jpg', '1684383518231.webp', '1684383518941.jpg', '1684383519709.webp', NULL, 1, '2023-05-18 04:18:39', '2023-05-18 04:18:39', NULL),
(29, 24, '1684383694837.jpg', '1684383694230.jpg', '1684383694626.webp', '1684383694998.jpg', '1684383694359.webp', NULL, 1, '2023-05-18 04:21:34', '2023-05-18 04:21:34', NULL),
(30, 25, '1684383923460.webp', '1684383923977.webp', '1684383923834.webp', '1684383923775.webp', '1684383923217.webp', NULL, 1, '2023-05-18 04:25:23', '2023-05-18 04:25:23', NULL),
(31, 26, '1684384126313.webp', '1684384126966.webp', '1684384126179.webp', '1684384126520.webp', '1684384126559.webp', NULL, 1, '2023-05-18 04:28:46', '2023-05-18 04:28:46', NULL),
(32, 27, '1684384331410.webp', '1684384331980.webp', '1684384331886.webp', '1684384331441.webp', '1684384331626.jpg', NULL, 1, '2023-05-18 04:32:11', '2023-05-18 04:32:11', NULL),
(33, 28, '1684384516977.webp', '1684384516809.webp', '1684384516955.webp', '1684384516571.webp', '1684384516957.webp', NULL, 1, '2023-05-18 04:35:16', '2023-05-18 04:35:16', NULL),
(34, 29, '1684384720217.webp', '1684384720338.webp', '1684384720902.webp', '1684384721591.webp', '1684384721335.jpg', NULL, 1, '2023-05-18 04:38:41', '2023-05-18 04:38:41', NULL),
(35, 30, '1684384861274.webp', '1684384861516.webp', '1684384861192.webp', '1684384861448.webp', '1684384861613.webp', NULL, 1, '2023-05-18 04:41:01', '2023-05-18 04:41:01', NULL),
(36, 31, '1684385052923.webp', '1684385052343.webp', '1684385052788.webp', '1684385053475.webp', NULL, NULL, 1, '2023-05-18 04:44:13', '2023-05-18 04:44:13', NULL),
(37, 32, '1684385191255.webp', '1684385191950.webp', '1684385191630.webp', NULL, NULL, NULL, 1, '2023-05-18 04:46:31', '2023-05-18 04:46:31', NULL),
(38, 33, '1684385579569.webp', '1684385579729.webp', '1684385579105.webp', '1684385579470.webp', '1684385579737.webp', NULL, 1, '2023-05-18 04:52:59', '2023-05-18 04:52:59', NULL),
(39, 34, '1684385708488.jpg', '1684385708873.webp', '1684385708980.webp', '1684385708390.jpg', '1684385708459.jpg', NULL, 1, '2023-05-18 04:55:08', '2023-05-18 04:55:08', NULL),
(40, 35, '1684385860910.webp', '1684385860564.webp', '1684385860429.webp', '1684385860944.webp', NULL, NULL, 1, '2023-05-18 04:57:40', '2023-05-18 04:57:40', NULL),
(41, 36, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-09-05 15:52:25', '2023-09-05 15:52:25', NULL),
(42, 37, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-09-05 15:54:49', '2023-09-05 15:54:49', NULL),
(43, 38, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-09-05 15:55:50', '2023-09-05 15:55:50', NULL),
(44, 39, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-09-05 15:56:51', '2023-09-05 15:56:51', NULL),
(45, 40, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-09-05 17:01:17', '2023-09-05 17:01:17', NULL),
(46, 41, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-09-05 17:30:59', '2023-09-05 17:30:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mov_type`
--

CREATE TABLE `mov_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `in_screen` tinyint(1) NOT NULL COMMENT '1-dissmissal 2-collect',
  `is_private_internal` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='الحركة علي الخزنة';

--
-- Dumping data for table `mov_type`
--

INSERT INTO `mov_type` (`id`, `name`, `active`, `in_screen`, `is_private_internal`) VALUES
(1, 'مراجعة واستلام نقدية شفت خزنة مستخدم', 1, 2, 1),
(3, 'صرف مبلغ لحساب مالي', 1, 1, 0),
(4, 'تحصيل مبلغ من حساب مالي', 1, 2, 0),
(5, 'تحصيل ايراد مبيعات', 1, 2, 0),
(6, 'صرف نظير مرتجع مبيعات', 1, 1, 0),
(8, 'صرف سلفة علي راتب موظف', 1, 1, 1),
(9, 'صرف نظير مشتريات من مورد', 1, 1, 0),
(10, 'تحصيل نظير مرتجع مشتريات الي مورد', 1, 2, 0),
(16, 'ايراد زيادة راس المال', 1, 2, 0),
(17, 'مصاريف شراء مثل النولون', 1, 1, 0),
(18, 'صرف للإيداع البنكي', 1, 1, 0),
(21, 'رد سلفة علي راتب موظف', 1, 2, 1),
(22, 'تحصيل خصومات موظفين', 1, 2, 1),
(24, 'صرف مرتب لموظف', 1, 1, 1),
(25, 'سحب من البنك\r\n', 1, 2, 0),
(26, 'صرف لرد رأس المال', 1, 1, 0),
(27, 'صرف بفاتورة خدمات مقدمة لنا', 1, 1, 0),
(28, 'تحصيل بفاتورة خدمات نقدمها للغير', 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `permission_main_menues`
--

CREATE TABLE `permission_main_menues` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='جدول القوايم لريسية لصلاحية';

--
-- Dumping data for table `permission_main_menues`
--

INSERT INTO `permission_main_menues` (`id`, `name`, `created_at`, `added_by`, `updated_at`, `updated_by`, `com_code`, `date`, `active`) VALUES
(1, 'الضبط العام', '2023-03-17 23:00:48', 1, '2023-03-17 23:00:48', NULL, 1, '2023-03-17', 1),
(2, 'الحسابات', '2023-03-17 23:01:06', 1, '2023-03-17 23:01:06', NULL, 1, '2023-03-17', 1),
(3, 'إدارة المخازن', '2023-03-17 23:01:34', 1, '2023-06-05 16:15:14', 1, 1, '2023-03-17', 1),
(4, 'حركات مخزنية', '2023-03-17 23:02:04', 1, '2023-03-17 23:02:04', NULL, 1, '2023-03-17', 1),
(5, 'المبيعات', '2023-03-17 23:02:35', 1, '2023-03-17 23:02:35', NULL, 1, '2023-03-17', 1),
(6, 'خدمات داخلية وخارجية', '2023-03-17 23:03:05', 1, '2023-05-30 02:15:27', 1, 1, '2023-03-17', 0),
(8, 'الصلاحيات', '2023-03-17 23:04:04', 1, '2023-03-17 23:04:04', NULL, 1, '2023-03-17', 1),
(9, 'التقارير', '2023-03-17 23:04:16', 1, '2023-03-17 23:04:16', NULL, 1, '2023-03-17', 1),
(10, 'الدعم الفني', '2023-03-17 23:04:45', 1, '2023-03-17 23:05:13', 1, 1, '2023-03-17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `permission_rols`
--

CREATE TABLE `permission_rols` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='جدول أدوار المستخدمين الرئيسي';

--
-- Dumping data for table `permission_rols`
--

INSERT INTO `permission_rols` (`id`, `name`, `created_at`, `added_by`, `updated_at`, `updated_by`, `com_code`, `date`, `active`) VALUES
(1, 'محاسب', '2023-03-17 19:04:42', 1, '2023-03-17 19:04:42', NULL, 1, '2023-03-17', 1),
(2, 'مشرف', '2023-03-17 19:05:44', 1, '2023-03-18 18:10:07', 1, 1, '2023-03-17', 1),
(3, 'الإدارة العليا', '2023-03-17 22:01:11', 1, '2023-03-17 22:01:11', NULL, 1, '2023-03-17', 1),
(4, 'كاشير', '2023-03-19 11:22:04', 1, '2023-03-19 11:22:04', NULL, 1, '2023-03-19', 1),
(5, 'مدخل بيانات', '2023-03-19 11:22:30', 1, '2023-03-19 11:22:30', NULL, 1, '2023-03-19', 1),
(6, 'مدير حسابات', '2023-03-19 11:23:16', 1, '2023-03-19 11:23:16', NULL, 1, '2023-03-19', 1),
(7, 'امين مخزن', '2023-03-19 11:24:49', 1, '2023-03-19 11:24:49', NULL, 1, '2023-03-19', 1),
(8, 'مندوب مبيعات', '2023-03-19 11:25:11', 1, '2023-03-19 11:25:11', NULL, 1, '2023-03-19', 1),
(9, 'مدير مشتريات', '2023-03-19 11:25:49', 1, '2023-03-19 11:25:49', NULL, 1, '2023-03-19', 1),
(10, 'مراجع شباك', '2023-03-19 11:26:17', 1, '2023-03-19 11:26:17', NULL, 1, '2023-03-19', 1),
(11, 'عملاء', '2023-05-11 07:41:06', 1, '2023-05-11 07:45:17', 1, 1, '2023-05-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permission_rols_main_menues`
--

CREATE TABLE `permission_rols_main_menues` (
  `id` int(11) NOT NULL,
  `permission_rols_id` int(11) NOT NULL,
  `permission_main_menues_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` datetime DEFAULT NULL,
  `com_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission_rols_main_menues`
--

INSERT INTO `permission_rols_main_menues` (`id`, `permission_rols_id`, `permission_main_menues_id`, `added_by`, `created_at`, `updated_at`, `updated_by`, `com_code`) VALUES
(1, 3, 1, 1, '2023-03-18 18:24:03', '2023-03-18 18:24:03', NULL, 1),
(2, 3, 2, 1, '2023-03-18 18:26:34', '2023-03-18 18:26:34', NULL, 1),
(4, 3, 3, 1, '2023-03-18 18:53:02', '2023-03-18 18:53:02', NULL, 1),
(5, 3, 5, 1, '2023-03-18 18:59:18', '2023-03-18 18:59:18', NULL, 1),
(6, 10, 1, 1, '2023-03-19 16:36:56', '2023-03-19 16:36:56', NULL, 1),
(7, 4, 5, 1, '2023-03-19 17:00:56', '2023-03-19 17:00:56', NULL, 1),
(8, 4, 3, 1, '2023-03-19 17:33:45', '2023-03-19 17:33:45', NULL, 1),
(9, 4, 4, 1, '2023-03-19 17:37:43', '2023-03-19 17:37:43', NULL, 1),
(10, 10, 2, 1, '2023-03-19 17:48:01', '2023-03-19 17:48:01', NULL, 1),
(11, 1, 1, 2, '2023-03-20 08:59:32', '2023-03-20 08:59:32', NULL, 1),
(12, 3, 8, 1, '2023-06-05 16:10:45', '2023-06-05 16:10:45', NULL, 1),
(13, 3, 4, 1, '2023-06-05 16:13:41', '2023-06-05 16:13:41', NULL, 1),
(14, 3, 9, 1, '2023-06-05 16:14:13', '2023-06-05 16:14:13', NULL, 1),
(15, 4, 2, 1, '2023-06-11 19:30:31', '2023-06-11 19:30:31', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permission_rols_sub_menues`
--

CREATE TABLE `permission_rols_sub_menues` (
  `id` int(11) NOT NULL,
  `permission_rols_main_menues_id` int(11) NOT NULL,
  `permission_rols_id` int(11) NOT NULL,
  `permission_sub_menues` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `com_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission_rols_sub_menues`
--

INSERT INTO `permission_rols_sub_menues` (`id`, `permission_rols_main_menues_id`, `permission_rols_id`, `permission_sub_menues`, `added_by`, `created_at`, `updated_by`, `updated_at`, `com_code`) VALUES
(3, 1, 3, 5, 1, '2023-03-19 22:50:10', NULL, '2023-03-19 22:50:10', 1),
(4, 11, 1, 5, 2, '2023-03-20 08:59:48', NULL, '2023-03-20 08:59:48', 1),
(5, 1, 3, 1, 1, '2023-06-05 16:00:16', NULL, '2023-06-05 16:00:16', 1),
(6, 1, 3, 9, 1, '2023-06-05 16:00:16', NULL, '2023-06-05 16:00:16', 1),
(7, 1, 3, 26, 1, '2023-06-05 16:00:16', NULL, '2023-06-05 16:00:16', 1),
(8, 2, 3, 3, 1, '2023-06-05 16:01:50', NULL, '2023-06-05 16:01:50', 1),
(9, 2, 3, 6, 1, '2023-06-05 16:01:50', NULL, '2023-06-05 16:01:50', 1),
(10, 2, 3, 7, 1, '2023-06-05 16:01:50', NULL, '2023-06-05 16:01:50', 1),
(11, 2, 3, 8, 1, '2023-06-05 16:01:50', NULL, '2023-06-05 16:01:50', 1),
(12, 2, 3, 10, 1, '2023-06-05 16:01:50', NULL, '2023-06-05 16:01:50', 1),
(13, 2, 3, 11, 1, '2023-06-05 16:01:50', NULL, '2023-06-05 16:01:50', 1),
(14, 2, 3, 12, 1, '2023-06-05 16:01:50', NULL, '2023-06-05 16:01:50', 1),
(15, 2, 3, 28, 1, '2023-06-05 16:01:50', NULL, '2023-06-05 16:01:50', 1),
(16, 4, 3, 13, 1, '2023-06-05 16:05:30', NULL, '2023-06-05 16:05:30', 1),
(17, 4, 3, 14, 1, '2023-06-05 16:05:30', NULL, '2023-06-05 16:05:30', 1),
(18, 4, 3, 15, 1, '2023-06-05 16:05:30', NULL, '2023-06-05 16:05:30', 1),
(19, 4, 3, 16, 1, '2023-06-05 16:05:30', NULL, '2023-06-05 16:05:30', 1),
(20, 4, 3, 17, 1, '2023-06-05 16:05:30', NULL, '2023-06-05 16:05:30', 1),
(21, 5, 3, 24, 1, '2023-06-05 16:07:39', NULL, '2023-06-05 16:07:39', 1),
(22, 5, 3, 25, 1, '2023-06-05 16:07:39', NULL, '2023-06-05 16:07:39', 1),
(23, 5, 3, 27, 1, '2023-06-05 16:07:39', NULL, '2023-06-05 16:07:39', 1),
(24, 12, 3, 29, 1, '2023-06-05 16:11:01', NULL, '2023-06-05 16:11:01', 1),
(27, 12, 3, 32, 1, '2023-06-05 16:11:01', NULL, '2023-06-05 16:11:01', 1),
(28, 13, 3, 18, 1, '2023-06-05 16:16:56', NULL, '2023-06-05 16:16:56', 1),
(29, 13, 3, 19, 1, '2023-06-05 16:16:56', NULL, '2023-06-05 16:16:56', 1),
(30, 13, 3, 20, 1, '2023-06-05 16:16:56', NULL, '2023-06-05 16:16:56', 1),
(31, 13, 3, 21, 1, '2023-06-05 16:16:56', NULL, '2023-06-05 16:16:56', 1),
(32, 13, 3, 22, 1, '2023-06-05 16:16:56', NULL, '2023-06-05 16:16:56', 1),
(33, 13, 3, 23, 1, '2023-06-05 16:16:56', NULL, '2023-06-05 16:16:56', 1),
(34, 14, 3, 20, 1, '2023-06-05 16:21:02', NULL, '2023-06-05 16:21:02', 1),
(35, 14, 3, 33, 1, '2023-06-05 16:21:02', NULL, '2023-06-05 16:21:02', 1),
(36, 14, 3, 34, 1, '2023-06-05 16:21:02', NULL, '2023-06-05 16:21:02', 1),
(37, 14, 3, 35, 1, '2023-06-05 16:21:02', NULL, '2023-06-05 16:21:02', 1),
(38, 15, 4, 12, 1, '2023-06-11 19:31:00', NULL, '2023-06-11 19:31:00', 1),
(39, 7, 4, 24, 1, '2023-06-11 19:32:08', NULL, '2023-06-11 19:32:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permission_rols_sub_menues_action`
--

CREATE TABLE `permission_rols_sub_menues_action` (
  `id` int(11) NOT NULL,
  `permission_rols_id` int(11) NOT NULL,
  `permission_rols_sub_menues_id` int(11) NOT NULL,
  `permission_sub_menues_action_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `com_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission_rols_sub_menues_action`
--

INSERT INTO `permission_rols_sub_menues_action` (`id`, `permission_rols_id`, `permission_rols_sub_menues_id`, `permission_sub_menues_action_id`, `added_by`, `created_at`, `updated_by`, `updated_at`, `com_code`) VALUES
(1, 3, 3, 34, 1, '2023-03-20 00:40:17', NULL, '2023-03-20 00:40:17', 1),
(3, 3, 3, 35, 1, '2023-06-05 16:00:27', NULL, '2023-06-05 16:00:27', 1),
(4, 3, 5, 16, 1, '2023-06-05 16:00:41', NULL, '2023-06-05 16:00:41', 1),
(5, 3, 5, 17, 1, '2023-06-05 16:00:41', NULL, '2023-06-05 16:00:41', 1),
(6, 3, 5, 18, 1, '2023-06-05 16:00:41', NULL, '2023-06-05 16:00:41', 1),
(7, 3, 5, 22, 1, '2023-06-05 16:00:41', NULL, '2023-06-05 16:00:41', 1),
(8, 3, 6, 44, 1, '2023-06-05 16:01:04', NULL, '2023-06-05 16:01:04', 1),
(9, 3, 6, 45, 1, '2023-06-05 16:01:04', NULL, '2023-06-05 16:01:04', 1),
(10, 3, 6, 46, 1, '2023-06-05 16:01:04', NULL, '2023-06-05 16:01:04', 1),
(11, 3, 7, 71, 1, '2023-06-05 16:01:16', NULL, '2023-06-05 16:01:16', 1),
(12, 3, 7, 72, 1, '2023-06-05 16:01:16', NULL, '2023-06-05 16:01:16', 1),
(13, 3, 7, 73, 1, '2023-06-05 16:01:16', NULL, '2023-06-05 16:01:16', 1),
(14, 3, 8, 29, 1, '2023-06-05 16:02:08', NULL, '2023-06-05 16:02:08', 1),
(15, 3, 8, 31, 1, '2023-06-05 16:02:08', NULL, '2023-06-05 16:02:08', 1),
(16, 3, 8, 32, 1, '2023-06-05 16:02:08', NULL, '2023-06-05 16:02:08', 1),
(17, 3, 9, 36, 1, '2023-06-05 16:02:20', NULL, '2023-06-05 16:02:20', 1),
(18, 3, 10, 37, 1, '2023-06-05 16:02:35', NULL, '2023-06-05 16:02:35', 1),
(19, 3, 10, 38, 1, '2023-06-05 16:02:35', NULL, '2023-06-05 16:02:35', 1),
(20, 3, 10, 39, 1, '2023-06-05 16:02:35', NULL, '2023-06-05 16:02:35', 1),
(21, 3, 11, 40, 1, '2023-06-05 16:02:53', NULL, '2023-06-05 16:02:53', 1),
(22, 3, 11, 41, 1, '2023-06-05 16:02:53', NULL, '2023-06-05 16:02:53', 1),
(23, 3, 11, 42, 1, '2023-06-05 16:02:53', NULL, '2023-06-05 16:02:53', 1),
(24, 3, 11, 43, 1, '2023-06-05 16:02:53', NULL, '2023-06-05 16:02:53', 1),
(25, 3, 12, 47, 1, '2023-06-05 16:03:06', NULL, '2023-06-05 16:03:06', 1),
(26, 3, 12, 48, 1, '2023-06-05 16:03:06', NULL, '2023-06-05 16:03:06', 1),
(27, 3, 12, 49, 1, '2023-06-05 16:03:06', NULL, '2023-06-05 16:03:06', 1),
(28, 3, 14, 91, 1, '2023-06-05 16:03:28', NULL, '2023-06-05 16:03:28', 1),
(29, 3, 15, 65, 1, '2023-06-05 16:03:50', NULL, '2023-06-05 16:03:50', 1),
(30, 3, 15, 67, 1, '2023-06-05 16:03:50', NULL, '2023-06-05 16:03:50', 1),
(31, 3, 15, 68, 1, '2023-06-05 16:03:50', NULL, '2023-06-05 16:03:50', 1),
(32, 3, 16, 92, 1, '2023-06-05 16:05:45', NULL, '2023-06-05 16:05:45', 1),
(33, 3, 16, 93, 1, '2023-06-05 16:05:45', NULL, '2023-06-05 16:05:45', 1),
(34, 3, 17, 94, 1, '2023-06-05 16:05:59', NULL, '2023-06-05 16:05:59', 1),
(35, 3, 17, 95, 1, '2023-06-05 16:05:59', NULL, '2023-06-05 16:05:59', 1),
(36, 3, 17, 96, 1, '2023-06-05 16:05:59', NULL, '2023-06-05 16:05:59', 1),
(37, 3, 18, 97, 1, '2023-06-05 16:06:13', NULL, '2023-06-05 16:06:13', 1),
(38, 3, 18, 98, 1, '2023-06-05 16:06:13', NULL, '2023-06-05 16:06:13', 1),
(39, 3, 18, 99, 1, '2023-06-05 16:06:13', NULL, '2023-06-05 16:06:13', 1),
(40, 3, 19, 77, 1, '2023-06-05 16:06:31', NULL, '2023-06-05 16:06:31', 1),
(41, 3, 19, 78, 1, '2023-06-05 16:06:31', NULL, '2023-06-05 16:06:31', 1),
(42, 3, 19, 79, 1, '2023-06-05 16:06:31', NULL, '2023-06-05 16:06:31', 1),
(43, 3, 20, 80, 1, '2023-06-05 16:06:47', NULL, '2023-06-05 16:06:47', 1),
(44, 3, 20, 81, 1, '2023-06-05 16:06:47', NULL, '2023-06-05 16:06:47', 1),
(45, 3, 20, 82, 1, '2023-06-05 16:06:47', NULL, '2023-06-05 16:06:47', 1),
(46, 3, 20, 83, 1, '2023-06-05 16:06:47', NULL, '2023-06-05 16:06:47', 1),
(47, 3, 21, 125, 1, '2023-06-05 16:07:58', NULL, '2023-06-05 16:07:58', 1),
(48, 3, 21, 126, 1, '2023-06-05 16:07:58', NULL, '2023-06-05 16:07:58', 1),
(49, 3, 21, 127, 1, '2023-06-05 16:07:58', NULL, '2023-06-05 16:07:58', 1),
(50, 3, 21, 128, 1, '2023-06-05 16:07:58', NULL, '2023-06-05 16:07:58', 1),
(51, 3, 21, 129, 1, '2023-06-05 16:07:58', NULL, '2023-06-05 16:07:58', 1),
(52, 3, 21, 130, 1, '2023-06-05 16:07:58', NULL, '2023-06-05 16:07:58', 1),
(53, 3, 21, 131, 1, '2023-06-05 16:07:58', NULL, '2023-06-05 16:07:58', 1),
(54, 3, 21, 132, 1, '2023-06-05 16:07:58', NULL, '2023-06-05 16:07:58', 1),
(55, 3, 22, 133, 1, '2023-06-05 16:08:44', NULL, '2023-06-05 16:08:44', 1),
(56, 3, 22, 134, 1, '2023-06-05 16:08:44', NULL, '2023-06-05 16:08:44', 1),
(57, 3, 22, 135, 1, '2023-06-05 16:08:44', NULL, '2023-06-05 16:08:44', 1),
(58, 3, 22, 136, 1, '2023-06-05 16:08:44', NULL, '2023-06-05 16:08:44', 1),
(59, 3, 22, 137, 1, '2023-06-05 16:08:44', NULL, '2023-06-05 16:08:44', 1),
(60, 3, 22, 138, 1, '2023-06-05 16:08:44', NULL, '2023-06-05 16:08:44', 1),
(61, 3, 22, 139, 1, '2023-06-05 16:08:44', NULL, '2023-06-05 16:08:44', 1),
(62, 3, 23, 69, 1, '2023-06-05 16:09:17', NULL, '2023-06-05 16:09:17', 1),
(63, 3, 23, 70, 1, '2023-06-05 16:09:17', NULL, '2023-06-05 16:09:17', 1),
(64, 3, 23, 74, 1, '2023-06-05 16:09:17', NULL, '2023-06-05 16:09:17', 1),
(65, 3, 23, 75, 1, '2023-06-05 16:09:17', NULL, '2023-06-05 16:09:17', 1),
(66, 3, 23, 76, 1, '2023-06-05 16:09:17', NULL, '2023-06-05 16:09:17', 1),
(67, 3, 24, 59, 1, '2023-06-05 16:11:36', NULL, '2023-06-05 16:11:36', 1),
(68, 3, 24, 60, 1, '2023-06-05 16:11:36', NULL, '2023-06-05 16:11:36', 1),
(69, 3, 24, 61, 1, '2023-06-05 16:11:36', NULL, '2023-06-05 16:11:36', 1),
(70, 3, 24, 62, 1, '2023-06-05 16:11:36', NULL, '2023-06-05 16:11:36', 1),
(71, 3, 24, 63, 1, '2023-06-05 16:11:36', NULL, '2023-06-05 16:11:36', 1),
(72, 3, 24, 64, 1, '2023-06-05 16:11:36', NULL, '2023-06-05 16:11:36', 1),
(73, 3, 24, 66, 1, '2023-06-05 16:11:36', NULL, '2023-06-05 16:11:36', 1),
(74, 3, 27, 53, 1, '2023-06-05 16:13:18', NULL, '2023-06-05 16:13:18', 1),
(75, 3, 27, 54, 1, '2023-06-05 16:13:18', NULL, '2023-06-05 16:13:18', 1),
(76, 3, 27, 55, 1, '2023-06-05 16:13:18', NULL, '2023-06-05 16:13:18', 1),
(77, 3, 27, 56, 1, '2023-06-05 16:13:18', NULL, '2023-06-05 16:13:18', 1),
(78, 3, 27, 57, 1, '2023-06-05 16:13:18', NULL, '2023-06-05 16:13:18', 1),
(79, 3, 27, 58, 1, '2023-06-05 16:13:18', NULL, '2023-06-05 16:13:18', 1),
(80, 3, 28, 84, 1, '2023-06-05 16:17:25', NULL, '2023-06-05 16:17:25', 1),
(81, 3, 28, 85, 1, '2023-06-05 16:17:25', NULL, '2023-06-05 16:17:25', 1),
(82, 3, 28, 86, 1, '2023-06-05 16:17:25', NULL, '2023-06-05 16:17:25', 1),
(83, 3, 28, 87, 1, '2023-06-05 16:17:25', NULL, '2023-06-05 16:17:25', 1),
(84, 3, 28, 90, 1, '2023-06-05 16:17:25', NULL, '2023-06-05 16:17:25', 1),
(85, 3, 29, 100, 1, '2023-06-05 16:17:41', NULL, '2023-06-05 16:17:41', 1),
(86, 3, 29, 101, 1, '2023-06-05 16:17:41', NULL, '2023-06-05 16:17:41', 1),
(87, 3, 29, 102, 1, '2023-06-05 16:17:41', NULL, '2023-06-05 16:17:41', 1),
(88, 3, 29, 103, 1, '2023-06-05 16:17:41', NULL, '2023-06-05 16:17:41', 1),
(89, 3, 29, 104, 1, '2023-06-05 16:17:41', NULL, '2023-06-05 16:17:41', 1),
(90, 3, 30, 105, 1, '2023-06-05 16:17:56', NULL, '2023-06-05 16:17:56', 1),
(91, 3, 30, 106, 1, '2023-06-05 16:17:56', NULL, '2023-06-05 16:17:56', 1),
(92, 3, 30, 107, 1, '2023-06-05 16:17:56', NULL, '2023-06-05 16:17:56', 1),
(93, 3, 30, 108, 1, '2023-06-05 16:17:56', NULL, '2023-06-05 16:17:56', 1),
(94, 3, 30, 109, 1, '2023-06-05 16:17:56', NULL, '2023-06-05 16:17:56', 1),
(95, 3, 30, 110, 1, '2023-06-05 16:17:56', NULL, '2023-06-05 16:17:56', 1),
(96, 3, 31, 111, 1, '2023-06-05 16:18:06', NULL, '2023-06-05 16:18:06', 1),
(97, 3, 32, 117, 1, '2023-06-05 16:18:30', NULL, '2023-06-05 16:18:30', 1),
(98, 3, 32, 118, 1, '2023-06-05 16:18:30', NULL, '2023-06-05 16:18:30', 1),
(99, 3, 32, 119, 1, '2023-06-05 16:18:30', NULL, '2023-06-05 16:18:30', 1),
(100, 3, 32, 120, 1, '2023-06-05 16:18:30', NULL, '2023-06-05 16:18:30', 1),
(101, 3, 32, 121, 1, '2023-06-05 16:18:30', NULL, '2023-06-05 16:18:30', 1),
(102, 3, 32, 122, 1, '2023-06-05 16:18:30', NULL, '2023-06-05 16:18:30', 1),
(103, 3, 32, 123, 1, '2023-06-05 16:18:30', NULL, '2023-06-05 16:18:30', 1),
(104, 3, 32, 124, 1, '2023-06-05 16:18:30', NULL, '2023-06-05 16:18:30', 1),
(105, 3, 33, 112, 1, '2023-06-05 16:18:45', NULL, '2023-06-05 16:18:45', 1),
(106, 3, 33, 113, 1, '2023-06-05 16:18:45', NULL, '2023-06-05 16:18:45', 1),
(107, 3, 33, 114, 1, '2023-06-05 16:18:45', NULL, '2023-06-05 16:18:45', 1),
(108, 3, 33, 115, 1, '2023-06-05 16:18:45', NULL, '2023-06-05 16:18:45', 1),
(109, 3, 33, 116, 1, '2023-06-05 16:18:45', NULL, '2023-06-05 16:18:45', 1),
(110, 3, 34, 105, 1, '2023-06-05 16:21:50', NULL, '2023-06-05 16:21:50', 1),
(111, 3, 34, 106, 1, '2023-06-05 16:21:50', NULL, '2023-06-05 16:21:50', 1),
(112, 3, 34, 107, 1, '2023-06-05 16:21:50', NULL, '2023-06-05 16:21:50', 1),
(113, 3, 34, 108, 1, '2023-06-05 16:21:50', NULL, '2023-06-05 16:21:50', 1),
(114, 3, 34, 109, 1, '2023-06-05 16:21:50', NULL, '2023-06-05 16:21:50', 1),
(115, 3, 34, 110, 1, '2023-06-05 16:21:50', NULL, '2023-06-05 16:21:50', 1),
(116, 3, 35, 52, 1, '2023-06-05 16:22:00', NULL, '2023-06-05 16:22:00', 1),
(117, 3, 36, 51, 1, '2023-06-05 16:22:11', NULL, '2023-06-05 16:22:11', 1),
(118, 3, 37, 50, 1, '2023-06-05 16:22:20', NULL, '2023-06-05 16:22:20', 1),
(119, 4, 38, 91, 1, '2023-06-11 19:31:37', NULL, '2023-06-11 19:31:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permission_sub_menues`
--

CREATE TABLE `permission_sub_menues` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `permission_main_menues_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='جدول القوايم الفرعية الصلاحية';

--
-- Dumping data for table `permission_sub_menues`
--

INSERT INTO `permission_sub_menues` (`id`, `name`, `created_at`, `added_by`, `updated_at`, `updated_by`, `com_code`, `date`, `active`, `permission_main_menues_id`) VALUES
(1, 'بيانات الخزن', '2023-03-18 00:02:25', 1, '2023-03-19 23:20:10', 1, 1, '2023-03-18', 1, 1),
(3, 'حسابات العملاء', '2023-03-18 06:50:28', 1, '2023-03-18 06:50:28', NULL, 1, '2023-03-18', 1, 2),
(5, 'الضبط العام', '2023-03-19 22:49:22', 1, '2023-03-19 22:49:22', NULL, 1, '2023-03-19', 1, 1),
(6, 'انواع الحسابات المالية', '2023-03-19 23:22:43', 1, '2023-03-19 23:22:43', NULL, 1, '2023-03-19', 1, 2),
(7, 'الشجرة الحسابات المالية', '2023-03-19 23:23:41', 1, '2023-03-19 23:23:41', NULL, 1, '2023-03-19', 1, 2),
(8, 'حسابات المناديب', '2023-03-19 23:24:17', 1, '2023-03-19 23:24:17', NULL, 1, '2023-03-19', 1, 2),
(9, 'فئات الموردين', '2023-03-19 23:25:34', 1, '2023-06-05 15:55:41', 1, 1, '2023-03-19', 1, 1),
(10, 'حسابات الموردين', '2023-03-19 23:25:58', 1, '2023-03-19 23:25:58', NULL, 1, '2023-03-19', 1, 2),
(11, 'شاشة صرف النقدية', '2023-03-19 23:27:10', 1, '2023-03-19 23:27:10', NULL, 1, '2023-03-19', 1, 2),
(12, 'شاشة تحصيل النقدية', '2023-03-19 23:27:59', 1, '2023-03-19 23:27:59', NULL, 1, '2023-03-19', 1, 2),
(13, 'بيانات فئات الفواتير', '2023-03-19 23:29:20', 1, '2023-03-19 23:29:20', NULL, 1, '2023-03-19', 1, 3),
(14, 'بيانات المخازن', '2023-03-19 23:29:56', 1, '2023-03-19 23:29:56', NULL, 1, '2023-03-19', 1, 3),
(15, 'بيانات الوحدات', '2023-03-19 23:30:36', 1, '2023-03-19 23:30:36', NULL, 1, '2023-03-19', 1, 3),
(16, 'فئات الأصناف', '2023-03-19 23:31:20', 1, '2023-03-19 23:31:20', NULL, 1, '2023-03-19', 1, 3),
(17, 'الأصناف', '2023-03-19 23:32:52', 1, '2023-03-19 23:32:52', NULL, 1, '2023-03-19', 1, 3),
(18, 'فواتير المشتريات', '2023-03-19 23:34:34', 1, '2023-03-19 23:34:34', NULL, 1, '2023-03-19', 1, 4),
(19, 'فواتير  مرتجع المشتريات', '2023-03-19 23:35:22', 1, '2023-03-19 23:35:22', NULL, 1, '2023-03-19', 1, 4),
(20, 'جرد المخازن', '2023-03-19 23:36:20', 1, '2023-06-05 16:20:34', 1, 1, '2023-03-19', 1, 9),
(21, 'ارصدة الاصناف', '2023-03-19 23:37:05', 1, '2023-03-19 23:37:05', NULL, 1, '2023-03-19', 1, 4),
(22, 'اوامر تحويل مخزنية صادرة', '2023-03-19 23:39:17', 1, '2023-03-19 23:39:17', NULL, 1, '2023-03-19', 1, 4),
(23, 'اوامر تحويل مخزنية واردة', '2023-03-19 23:40:09', 1, '2023-03-19 23:40:09', NULL, 1, '2023-03-19', 1, 4),
(24, 'فواتير المبيعات', '2023-03-19 23:42:19', 1, '2023-03-19 23:42:19', NULL, 1, '2023-03-19', 1, 5),
(25, 'مرتجع المبيعات', '2023-03-19 23:42:36', 1, '2023-03-19 23:42:36', NULL, 1, '2023-03-19', 1, 5),
(26, 'ضبط الخدمات', '2023-03-19 23:43:41', 1, '2023-06-05 15:56:17', 1, 1, '2023-03-19', 1, 1),
(27, 'فواتير الخدمات', '2023-03-19 23:44:10', 1, '2023-05-30 02:13:34', 1, 1, '2023-03-19', 1, 5),
(28, 'شفتات الخزن', '2023-03-19 23:47:08', 1, '2023-05-30 04:10:09', 1, 1, '2023-03-19', 1, 2),
(29, 'أدوار المستخدم', '2023-03-19 23:56:58', 1, '2023-03-19 23:56:58', NULL, 1, '2023-03-19', 1, 8),
(30, 'القوائم الرئيسية للصلاحية', '2023-03-19 23:57:56', 1, '2023-03-19 23:57:56', NULL, 1, '2023-03-19', 1, 8),
(31, 'القوائم الفرعية للصلاحية', '2023-03-19 23:58:27', 1, '2023-03-19 23:58:27', NULL, 1, '2023-03-19', 1, 8),
(32, 'المستخدمين', '2023-03-19 23:59:06', 1, '2023-03-19 23:59:06', NULL, 1, '2023-03-19', 1, 8),
(33, 'كشف حساب مورد', '2023-03-19 23:59:54', 1, '2023-03-19 23:59:54', NULL, 1, '2023-03-19', 1, 9),
(34, 'كشف حساب عميل', '2023-03-20 00:00:22', 1, '2023-03-20 00:00:22', NULL, 1, '2023-03-20', 1, 9),
(35, 'كشف حساب مندوب', '2023-03-20 00:01:21', 1, '2023-03-20 00:01:21', NULL, 1, '2023-03-20', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `permission_sub_menues_actions`
--

CREATE TABLE `permission_sub_menues_actions` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `permission_sub_menues_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='جدول الصلاحيات النهاية على القوائم ا';

--
-- Dumping data for table `permission_sub_menues_actions`
--

INSERT INTO `permission_sub_menues_actions` (`id`, `name`, `created_at`, `added_by`, `updated_at`, `updated_by`, `com_code`, `date`, `active`, `permission_sub_menues_id`) VALUES
(16, 'اضافة', '2023-03-18 05:53:47', 1, '2023-03-18 13:33:02', 1, 1, '2023-03-18', 1, 1),
(17, 'تعديل', '2023-03-18 05:54:52', 1, '2023-03-18 05:54:52', NULL, 1, '2023-03-18', 1, 1),
(18, 'عرض', '2023-03-18 05:55:54', 1, '2023-05-30 02:58:07', 1, 1, '2023-03-18', 1, 1),
(22, 'عرض التفاصيل', '2023-03-18 06:04:24', 1, '2023-05-30 02:58:34', 1, 1, '2023-03-18', 1, 1),
(29, 'اضافة', '2023-03-18 10:38:48', 1, '2023-05-30 02:18:27', 1, 1, '2023-03-18', 1, 3),
(31, 'عرض', '2023-03-18 10:38:58', 1, '2023-05-30 02:43:24', 1, 1, '2023-03-18', 1, 3),
(32, 'تعديل', '2023-03-18 10:39:19', 1, '2023-03-18 10:39:19', NULL, 1, '2023-03-18', 1, 3),
(34, 'تعديل', '2023-03-20 00:07:13', 1, '2023-03-20 00:07:13', NULL, 1, '2023-03-20', 1, 5),
(35, 'عرض', '2023-03-20 01:04:15', 1, '2023-03-20 01:04:15', NULL, 1, '2023-03-20', 1, 5),
(36, 'عرض', '2023-05-30 03:06:51', 1, '2023-05-30 03:06:51', NULL, 1, '2023-05-30', 1, 6),
(37, 'عرض', '2023-05-30 03:08:45', 1, '2023-05-30 03:08:45', NULL, 1, '2023-05-30', 1, 7),
(38, 'تعديل', '2023-05-30 03:09:13', 1, '2023-05-30 03:09:13', NULL, 1, '2023-05-30', 1, 7),
(39, 'اضافة', '2023-05-30 03:09:50', 1, '2023-05-30 03:09:50', NULL, 1, '2023-05-30', 1, 7),
(40, 'اضافة', '2023-05-30 03:22:32', 1, '2023-05-30 03:22:32', NULL, 1, '2023-05-30', 1, 8),
(41, 'تعديل', '2023-05-30 03:23:32', 1, '2023-05-30 03:23:32', NULL, 1, '2023-05-30', 1, 8),
(42, 'عرض التفاصيل', '2023-05-30 03:24:10', 1, '2023-05-30 03:24:10', NULL, 1, '2023-05-30', 1, 8),
(43, 'عرض', '2023-05-30 03:24:24', 1, '2023-05-30 03:24:24', NULL, 1, '2023-05-30', 1, 8),
(44, 'اضافة', '2023-05-30 03:29:21', 1, '2023-05-30 03:29:21', NULL, 1, '2023-05-30', 1, 9),
(45, 'تعديل', '2023-05-30 03:29:34', 1, '2023-05-30 03:29:34', NULL, 1, '2023-05-30', 1, 9),
(46, 'عرض', '2023-05-30 03:30:11', 1, '2023-05-30 03:30:11', NULL, 1, '2023-05-30', 1, 9),
(47, 'اضافة', '2023-05-30 03:30:23', 1, '2023-05-30 03:30:23', NULL, 1, '2023-05-30', 1, 10),
(48, 'تعديل', '2023-05-30 03:30:44', 1, '2023-05-30 03:30:44', NULL, 1, '2023-05-30', 1, 10),
(49, 'عرض', '2023-05-30 03:31:03', 1, '2023-05-30 03:31:03', NULL, 1, '2023-05-30', 1, 10),
(50, 'عرض', '2023-05-30 03:57:24', 1, '2023-05-30 03:57:24', NULL, 1, '2023-05-30', 1, 35),
(51, 'عرض', '2023-05-30 03:57:34', 1, '2023-05-30 03:57:34', NULL, 1, '2023-05-30', 1, 34),
(52, 'عرض', '2023-05-30 03:57:44', 1, '2023-05-30 03:57:44', NULL, 1, '2023-05-30', 1, 33),
(53, 'اضافة', '2023-05-30 03:58:54', 1, '2023-05-30 03:58:54', NULL, 1, '2023-05-30', 1, 32),
(54, 'تعديل', '2023-05-30 03:59:03', 1, '2023-05-30 03:59:03', NULL, 1, '2023-05-30', 1, 32),
(55, 'الصلاحيات الخاصة', '2023-05-30 03:59:41', 1, '2023-05-30 04:01:03', 1, 1, '2023-05-30', 1, 32),
(56, 'عرض', '2023-05-30 03:59:58', 1, '2023-05-30 03:59:58', NULL, 1, '2023-05-30', 1, 32),
(57, 'اضافة مخزن للصلاحية', '2023-05-30 04:01:33', 1, '2023-05-30 04:01:33', NULL, 1, '2023-05-30', 1, 32),
(58, 'اضافة صلاحية خزنة', '2023-05-30 04:02:00', 1, '2023-05-30 04:02:00', NULL, 1, '2023-05-30', 1, 32),
(59, 'اضافة', '2023-05-30 04:05:25', 1, '2023-05-30 04:05:25', NULL, 1, '2023-05-30', 1, 29),
(60, 'تعديل', '2023-05-30 04:05:41', 1, '2023-05-30 04:05:41', NULL, 1, '2023-05-30', 1, 29),
(61, 'التفاصيل', '2023-05-30 04:05:59', 1, '2023-05-30 04:05:59', NULL, 1, '2023-05-30', 1, 29),
(62, 'اضافة قائمة', '2023-05-30 04:06:39', 1, '2023-05-30 04:08:31', 1, 1, '2023-05-30', 1, 29),
(63, 'اضافة قائمة فرعية', '2023-05-30 04:09:09', 1, '2023-05-30 04:09:09', NULL, 1, '2023-05-30', 1, 29),
(64, 'اضافة مهام', '2023-05-30 04:09:30', 1, '2023-05-30 04:09:30', NULL, 1, '2023-05-30', 1, 29),
(65, 'اضافة', '2023-05-30 04:10:26', 1, '2023-05-30 04:10:26', NULL, 1, '2023-05-30', 1, 28),
(66, 'عرض', '2023-05-30 04:10:48', 1, '2023-05-30 04:10:48', NULL, 1, '2023-05-30', 1, 29),
(67, 'طباعة', '2023-05-30 04:12:04', 1, '2023-05-30 04:12:04', NULL, 1, '2023-05-30', 1, 28),
(68, 'مراجعة وستلام الشفت', '2023-05-30 04:12:32', 1, '2023-05-30 04:12:32', NULL, 1, '2023-05-30', 1, 28),
(69, 'اضافة', '2023-05-30 04:12:59', 1, '2023-05-30 04:12:59', NULL, 1, '2023-05-30', 1, 27),
(70, 'تعديل', '2023-05-30 04:13:16', 1, '2023-05-30 04:13:16', NULL, 1, '2023-05-30', 1, 27),
(71, 'اضافة', '2023-05-30 04:17:19', 1, '2023-05-30 04:17:19', NULL, 1, '2023-05-30', 1, 26),
(72, 'تعديل', '2023-05-30 04:17:37', 1, '2023-05-30 04:17:37', NULL, 1, '2023-05-30', 1, 26),
(73, 'حذف', '2023-05-30 04:17:46', 1, '2023-05-30 04:17:46', NULL, 1, '2023-05-30', 1, 26),
(74, 'التفاصيل', '2023-05-30 04:18:10', 1, '2023-05-30 04:18:10', NULL, 1, '2023-05-30', 1, 27),
(75, 'طباعة', '2023-05-30 04:18:33', 1, '2023-05-30 04:18:33', NULL, 1, '2023-05-30', 1, 27),
(76, 'حذف', '2023-05-30 04:19:20', 1, '2023-05-30 04:19:20', NULL, 1, '2023-05-30', 1, 27),
(77, 'اضافة', '2023-05-30 04:21:20', 1, '2023-05-30 04:21:20', NULL, 1, '2023-05-30', 1, 16),
(78, 'تعديل', '2023-05-30 04:21:30', 1, '2023-05-30 04:21:30', NULL, 1, '2023-05-30', 1, 16),
(79, 'عرض', '2023-05-30 04:21:41', 1, '2023-05-30 04:21:41', NULL, 1, '2023-05-30', 1, 16),
(80, 'اضافة', '2023-05-30 04:23:16', 1, '2023-05-30 04:23:16', NULL, 1, '2023-05-30', 1, 17),
(81, 'تعديل', '2023-05-30 04:23:29', 1, '2023-05-30 04:23:29', NULL, 1, '2023-05-30', 1, 17),
(82, 'عرض التفاصيل', '2023-05-30 04:23:59', 1, '2023-05-30 04:23:59', NULL, 1, '2023-05-30', 1, 17),
(83, 'عرض', '2023-05-30 04:24:20', 1, '2023-05-30 04:24:20', NULL, 1, '2023-05-30', 1, 17),
(84, 'اضافة', '2023-05-30 04:24:57', 1, '2023-05-30 04:24:57', NULL, 1, '2023-05-30', 1, 18),
(85, 'تعديل', '2023-05-30 04:25:22', 1, '2023-05-30 04:25:22', NULL, 1, '2023-05-30', 1, 18),
(86, 'عرض التفاصيل', '2023-05-30 04:26:05', 1, '2023-05-30 04:26:05', NULL, 1, '2023-05-30', 1, 18),
(87, 'عرض', '2023-05-30 04:26:22', 1, '2023-05-30 04:26:22', NULL, 1, '2023-05-30', 1, 18),
(90, 'طباعة', '2023-05-30 04:28:12', 1, '2023-05-30 04:28:12', NULL, 1, '2023-05-30', 1, 18),
(91, 'اضافة', '2023-05-30 04:28:56', 1, '2023-05-30 04:28:56', NULL, 1, '2023-05-30', 1, 12),
(92, 'اضافة', '2023-05-30 04:29:28', 1, '2023-05-30 04:29:28', NULL, 1, '2023-05-30', 1, 13),
(93, 'تعديل', '2023-05-30 04:29:41', 1, '2023-05-30 04:29:41', NULL, 1, '2023-05-30', 1, 13),
(94, 'اضافة', '2023-05-30 04:30:54', 1, '2023-05-30 04:30:54', NULL, 1, '2023-05-30', 1, 14),
(95, 'تعديل', '2023-05-30 04:31:18', 1, '2023-05-30 04:31:18', NULL, 1, '2023-05-30', 1, 14),
(96, 'عرض', '2023-05-30 04:32:03', 1, '2023-05-30 04:32:03', NULL, 1, '2023-05-30', 1, 14),
(97, 'اضافة', '2023-05-30 04:32:38', 1, '2023-05-30 04:32:38', NULL, 1, '2023-05-30', 1, 15),
(98, 'تعديل', '2023-05-30 04:32:46', 1, '2023-05-30 04:32:46', NULL, 1, '2023-05-30', 1, 15),
(99, 'عرض', '2023-05-30 04:32:55', 1, '2023-05-30 04:32:55', NULL, 1, '2023-05-30', 1, 15),
(100, 'اضافة', '2023-05-30 04:34:05', 1, '2023-05-30 04:34:05', NULL, 1, '2023-05-30', 1, 19),
(101, 'تعديل', '2023-05-30 04:34:16', 1, '2023-05-30 04:34:16', NULL, 1, '2023-05-30', 1, 19),
(102, 'عرض', '2023-05-30 04:34:30', 1, '2023-05-30 04:34:30', NULL, 1, '2023-05-30', 1, 19),
(103, 'عرض التفاصيل', '2023-05-30 04:35:28', 1, '2023-05-30 04:35:28', NULL, 1, '2023-05-30', 1, 19),
(104, 'طباعة', '2023-05-30 04:35:51', 1, '2023-05-30 04:35:51', NULL, 1, '2023-05-30', 1, 19),
(105, 'اضافة', '2023-05-30 04:36:46', 1, '2023-05-30 04:36:46', NULL, 1, '2023-05-30', 1, 20),
(106, 'تعديل', '2023-05-30 04:36:57', 1, '2023-05-30 04:36:57', NULL, 1, '2023-05-30', 1, 20),
(107, 'حذف', '2023-05-30 04:37:15', 1, '2023-05-30 04:37:15', NULL, 1, '2023-05-30', 1, 20),
(108, 'عرض التفاصيل', '2023-05-30 04:37:58', 1, '2023-05-30 04:38:13', 1, 1, '2023-05-30', 1, 20),
(109, 'عرض', '2023-05-30 04:38:23', 1, '2023-05-30 04:38:23', NULL, 1, '2023-05-30', 1, 20),
(110, 'طباعة', '2023-05-30 04:38:43', 1, '2023-05-30 04:38:43', NULL, 1, '2023-05-30', 1, 20),
(111, 'عرض', '2023-05-30 04:39:37', 1, '2023-05-30 04:39:37', NULL, 1, '2023-05-30', 1, 21),
(112, 'طباعة', '2023-05-30 04:48:53', 1, '2023-05-30 04:48:53', NULL, 1, '2023-05-30', 1, 23),
(113, 'عرض التفاصيل', '2023-05-30 04:49:20', 1, '2023-05-30 04:49:20', NULL, 1, '2023-05-30', 1, 23),
(114, 'عرض', '2023-05-30 04:49:31', 1, '2023-05-30 04:49:31', NULL, 1, '2023-05-30', 1, 23),
(115, 'استلام الكمية', '2023-05-30 04:49:52', 1, '2023-05-30 04:49:52', NULL, 1, '2023-05-30', 1, 23),
(116, 'رفض الكمية', '2023-05-30 04:50:31', 1, '2023-05-30 04:50:31', NULL, 1, '2023-05-30', 1, 23),
(117, 'اضافة', '2023-05-30 04:50:42', 1, '2023-05-30 04:50:42', NULL, 1, '2023-05-30', 1, 22),
(118, 'عرض التفاصيل', '2023-05-30 04:51:07', 1, '2023-05-30 04:51:07', NULL, 1, '2023-05-30', 1, 22),
(119, 'عرض', '2023-05-30 04:51:23', 1, '2023-05-30 04:51:23', NULL, 1, '2023-05-30', 1, 22),
(120, 'تعديل', '2023-05-30 04:51:39', 1, '2023-05-30 04:51:39', NULL, 1, '2023-05-30', 1, 22),
(121, 'حذف', '2023-05-30 04:52:20', 1, '2023-05-30 04:52:20', NULL, 1, '2023-05-30', 1, 22),
(122, 'طباعة', '2023-05-30 04:52:42', 1, '2023-05-30 04:52:42', NULL, 1, '2023-05-30', 1, 22),
(123, 'اضافة صنف للفاتورة', '2023-05-30 04:53:28', 1, '2023-05-30 04:53:28', NULL, 1, '2023-05-30', 1, 22),
(124, 'حذف صنف من  الفاتورة', '2023-05-30 04:54:39', 1, '2023-05-30 04:54:39', NULL, 1, '2023-05-30', 1, 22),
(125, 'اضافة', '2023-05-30 04:55:46', 1, '2023-05-30 04:55:46', NULL, 1, '2023-05-30', 1, 24),
(126, 'تعديل', '2023-05-30 04:55:54', 1, '2023-05-30 04:55:54', NULL, 1, '2023-05-30', 1, 24),
(127, 'حذف', '2023-05-30 04:56:04', 1, '2023-05-30 04:56:04', NULL, 1, '2023-05-30', 1, 24),
(128, 'عرض', '2023-05-30 04:56:21', 1, '2023-05-30 04:56:21', NULL, 1, '2023-05-30', 1, 24),
(129, 'عرض التفاصيل', '2023-05-30 04:56:40', 1, '2023-05-30 04:56:40', NULL, 1, '2023-05-30', 1, 24),
(130, 'اعتماد وترحيل الفاتورة', '2023-05-30 04:57:15', 1, '2023-05-30 04:57:15', NULL, 1, '2023-05-30', 1, 24),
(131, 'طباعة', '2023-05-30 04:57:41', 1, '2023-05-30 04:57:41', NULL, 1, '2023-05-30', 1, 24),
(132, 'اضافة صنف للفاتورة', '2023-05-30 04:58:07', 1, '2023-05-30 04:58:07', NULL, 1, '2023-05-30', 1, 24),
(133, 'اضافة', '2023-05-30 04:58:21', 1, '2023-05-30 04:58:21', NULL, 1, '2023-05-30', 1, 25),
(134, 'حذف', '2023-05-30 04:58:29', 1, '2023-05-30 04:58:29', NULL, 1, '2023-05-30', 1, 25),
(135, 'تعديل', '2023-05-30 04:58:41', 1, '2023-05-30 04:58:41', NULL, 1, '2023-05-30', 1, 25),
(136, 'عرض التفاصيل', '2023-05-30 04:59:00', 1, '2023-05-30 04:59:00', NULL, 1, '2023-05-30', 1, 25),
(137, 'عرض', '2023-05-30 04:59:12', 1, '2023-05-30 04:59:12', NULL, 1, '2023-05-30', 1, 25),
(138, 'طباعة', '2023-05-30 04:59:43', 1, '2023-05-30 04:59:43', NULL, 1, '2023-05-30', 1, 25),
(139, 'اعتماد وترحيل الفاتورة', '2023-05-30 05:00:04', 1, '2023-05-30 05:00:04', NULL, 1, '2023-05-30', 1, 25);

-- --------------------------------------------------------

--
-- Table structure for table `sales_invoices`
--

CREATE TABLE `sales_invoices` (
  `id` bigint(20) NOT NULL,
  `sales_matrial_types` int(11) DEFAULT NULL COMMENT 'فئة الفاتورة',
  `auto_serial` bigint(20) NOT NULL,
  `invoice_date` date NOT NULL COMMENT 'تاريخ الفاتورة',
  `is_has_customer` tinyint(1) NOT NULL COMMENT 'هل الفاتورة مرتبطه بعميل - واحد يبقي نعم - لو صفر يبقي عميل طياري بدون عميل',
  `customer_code` bigint(20) DEFAULT NULL COMMENT 'كود العميل',
  `delegate_code` bigint(20) DEFAULT NULL COMMENT 'كود المندوب',
  `delegate_commission_percent_type` decimal(10,2) DEFAULT NULL,
  `delegate_commission_percent` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'نسبة عمولة المندوب',
  `delegate_commission_value` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'قيمة عمولة المندوب',
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `com_code` int(11) NOT NULL,
  `notes` varchar(225) DEFAULT NULL,
  `discount_type` tinyint(1) DEFAULT NULL COMMENT 'نواع الخصم - واحد خصم نسبة  - اثنين خصم يدوي قيمة',
  `discount_percent` decimal(10,2) DEFAULT 0.00 COMMENT 'قيمة نسبة الخصم',
  `discount_value` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'قيمة الخصم',
  `tax_percent` decimal(10,2) DEFAULT 0.00 COMMENT 'نسبة الضريبة ',
  `total_cost_items` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'اجمالي الاصناف فقط',
  `tax_value` decimal(10,2) DEFAULT 0.00 COMMENT 'قيمة الضريبة القيمة المضافة',
  `total_befor_discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_cost` decimal(10,2) DEFAULT 0.00 COMMENT 'القيمة الاجمالية النهائية للفاتورة',
  `account_number` bigint(20) DEFAULT NULL,
  `money_for_account` decimal(10,2) DEFAULT NULL,
  `pill_type` tinyint(1) DEFAULT NULL COMMENT 'نوع الفاتورة - كاش او اجل  - واحد واثنين',
  `what_paid` decimal(10,2) DEFAULT 0.00,
  `what_remain` decimal(10,2) DEFAULT 0.00,
  `treasuries_transactions_id` bigint(20) DEFAULT NULL,
  `customer_balance_befor` decimal(10,2) DEFAULT NULL COMMENT 'حالة رصيد العميل قبل الفاتروة',
  `customer_balance_after` decimal(10,2) DEFAULT NULL COMMENT 'حالة رصيد العميل بعد الفاتروة',
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `sales_item_type` tinyint(1) NOT NULL COMMENT 'e	نوع البيع مع الصنف واحد قطاعي - اتنين نص جمية -ثلاثه جملة	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='المبيعات للعملاء';

--
-- Dumping data for table `sales_invoices`
--

INSERT INTO `sales_invoices` (`id`, `sales_matrial_types`, `auto_serial`, `invoice_date`, `is_has_customer`, `customer_code`, `delegate_code`, `delegate_commission_percent_type`, `delegate_commission_percent`, `delegate_commission_value`, `is_approved`, `com_code`, `notes`, `discount_type`, `discount_percent`, `discount_value`, `tax_percent`, `total_cost_items`, `tax_value`, `total_befor_discount`, `total_cost`, `account_number`, `money_for_account`, `pill_type`, `what_paid`, `what_remain`, `treasuries_transactions_id`, `customer_balance_befor`, `customer_balance_after`, `added_by`, `created_at`, `updated_at`, `updated_by`, `approved_by`, `date`, `sales_item_type`) VALUES
(32, 4, 1, '2023-05-20', 0, NULL, 4, '2.00', '2.00', '-16000.00', 1, 1, NULL, NULL, '0.00', '0.00', '0.00', '800000.00', '0.00', '800000.00', '800000.00', NULL, '800000.00', 2, '0.00', '800000.00', NULL, NULL, NULL, 1, '2023-05-20 13:20:03', '2023-05-20 13:22:30', 1, 1, '2023-05-20', 1),
(33, 4, 2, '2023-05-20', 0, NULL, 4, '2.00', '2.00', '-3000.00', 1, 1, NULL, NULL, '0.00', '0.00', '0.00', '150000.00', '0.00', '150000.00', '150000.00', NULL, '150000.00', 2, '0.00', '150000.00', NULL, NULL, NULL, 1, '2023-05-20 13:23:54', '2023-05-20 13:24:23', 1, 1, '2023-05-20', 1),
(34, 4, 3, '2023-05-20', 0, NULL, 4, '2.00', '2.00', '-3000.00', 1, 1, NULL, NULL, '0.00', '0.00', '0.00', '150000.00', '0.00', '150000.00', '150000.00', NULL, '150000.00', 2, '0.00', '150000.00', NULL, NULL, NULL, 1, '2023-05-20 15:05:17', '2023-05-20 15:06:09', 1, 1, '2023-05-20', 1),
(35, 4, 4, '2023-05-21', 0, NULL, 4, '2.00', '2.00', '-6000.00', 1, 1, NULL, NULL, '0.00', '0.00', '0.00', '300000.00', '0.00', '300000.00', '300000.00', NULL, '300000.00', 1, '300000.00', '0.00', NULL, NULL, NULL, 1, '2023-05-21 20:56:55', '2023-05-22 00:40:14', 1, 1, '2023-05-21', 1),
(36, 5, 5, '2023-05-22', 0, NULL, 4, '2.00', '2.00', '-310.00', 1, 1, NULL, NULL, '0.00', '0.00', '0.00', '15500.00', '0.00', '15500.00', '15500.00', NULL, '15500.00', 2, '0.00', '15500.00', NULL, NULL, NULL, 1, '2023-05-22 00:41:50', '2023-05-24 04:36:23', 1, 1, '2023-05-22', 1),
(37, 6, 6, '2023-05-19', 1, 21, NULL, NULL, '0.00', '0.00', 1, 1, NULL, NULL, '0.00', '0.00', '0.00', '2.00', '0.00', '0.00', '33000.00', 39, '33000.00', 2, '0.00', '33000.00', NULL, NULL, NULL, 1, '2023-05-27 21:09:31', '2023-05-27 21:09:31', 1, 1, '2023-05-27', 1),
(38, 6, 7, '2023-06-11', 1, 1, NULL, NULL, '0.00', '0.00', 1, 1, NULL, NULL, '0.00', '0.00', '0.00', '10.00', '0.00', '0.00', '35000.00', 41, '35000.00', 2, '0.00', '35000.00', NULL, NULL, NULL, 1, '2023-06-11 20:03:06', '2023-06-11 20:03:06', 1, 1, '2023-06-11', 1),
(39, 6, 8, '2023-06-11', 1, 1, NULL, NULL, '0.00', '0.00', 0, 1, NULL, NULL, '0.00', '0.00', '0.00', '3.00', '0.00', '0.00', '22000.00', NULL, '22000.00', 2, '0.00', '0.00', NULL, NULL, NULL, 1, '2023-06-11 20:46:21', '2023-06-11 20:46:21', NULL, NULL, '2023-06-11', 1),
(40, 6, 9, '2023-06-20', 1, 4, NULL, NULL, '0.00', '0.00', 1, 1, NULL, NULL, '0.00', '0.00', '0.00', '10.00', '0.00', '0.00', '35000.00', 44, '35000.00', 2, '0.00', '35000.00', NULL, NULL, NULL, 1, '2023-06-20 09:11:22', '2023-06-20 09:11:22', 1, 1, '2023-06-20', 1),
(41, 5, 10, '2023-07-04', 1, 8, 4, '2.00', '2.00', '-1200.00', 1, 1, NULL, NULL, '0.00', '0.00', '0.00', '60000.00', '0.00', '60000.00', '60000.00', 48, '60000.00', 2, '0.00', '60000.00', NULL, NULL, NULL, 1, '2023-07-04 10:58:57', '2023-07-04 11:00:32', 1, 1, '2023-07-04', 1),
(42, 6, 11, '2023-06-20', 1, 3, NULL, NULL, '0.00', '0.00', 1, 1, NULL, NULL, '0.00', '0.00', '0.00', '1.00', '0.00', '0.00', '2500.00', 43, '2500.00', 2, '0.00', '2500.00', NULL, NULL, NULL, 1, '2023-09-05 13:54:01', '2023-09-05 13:54:02', 1, 1, '2023-09-05', 1),
(43, 5, 12, '2023-09-05', 1, 8, 4, NULL, '0.00', '0.00', 0, 1, NULL, NULL, '0.00', '0.00', '0.00', '6100.00', '0.00', '6100.00', '6100.00', NULL, NULL, 1, '0.00', '0.00', NULL, NULL, NULL, 1, '2023-09-05 16:12:09', '2023-09-05 16:20:44', 1, NULL, '2023-09-05', 1),
(44, 5, 13, '2023-09-05', 1, 3, 4, NULL, '0.00', '0.00', 0, 1, NULL, NULL, '0.00', '0.00', '0.00', '3700.00', '0.00', '3700.00', '3700.00', NULL, NULL, 1, '0.00', '0.00', NULL, NULL, NULL, 1, '2023-09-05 16:38:03', '2023-09-05 17:35:50', 1, NULL, '2023-09-05', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sales_invoices_details`
--

CREATE TABLE `sales_invoices_details` (
  `id` bigint(20) NOT NULL,
  `sales_invoices_id` bigint(20) NOT NULL,
  `sales_invoices_auto_serial` bigint(20) NOT NULL,
  `store_id` int(11) NOT NULL,
  `sales_item_type` tinyint(1) NOT NULL COMMENT 'نوع البيع مع الصنف\r\nواحد قطاعي - اتنين نص جمية -ثلاثه جملة',
  `item_code` bigint(20) NOT NULL,
  `uom_id` int(11) NOT NULL,
  `batch_auto_serial` bigint(20) DEFAULT NULL COMMENT 'رقم الباتش بالمخزن التي تم خروج الصنف منها ',
  `quantity` decimal(10,4) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `is_normal_orOther` tinyint(1) NOT NULL COMMENT 'واحد بيع عادي\r\nاتنين بونص \r\nثلاثه دعاية\r\nهالك \r\n- كلهم بدون سعر',
  `isparentuom` tinyint(1) NOT NULL COMMENT '1-main -0 retail',
  `com_code` int(11) NOT NULL,
  `invoice_date` date NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `production_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `date` date NOT NULL,
  `itemCostPriceFromBatah` decimal(10,0) NOT NULL COMMENT 'سعر تكلفة شراء وحدة البيع للصنف من الباتش المسحوب منها ',
  `taoalitemCostPriceFromBatah` decimal(10,0) NOT NULL COMMENT 'اجمالي سعر شراء وحدة البيع للصنف من الباتش المسحوب منها ',
  `item_total_earnings` decimal(10,0) NOT NULL COMMENT 'اجمالي ربح الصنف بالفاتورة '
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='تفاصيل انصاف فاتورة المشتريات والمرتجعات';

--
-- Dumping data for table `sales_invoices_details`
--

INSERT INTO `sales_invoices_details` (`id`, `sales_invoices_id`, `sales_invoices_auto_serial`, `store_id`, `sales_item_type`, `item_code`, `uom_id`, `batch_auto_serial`, `quantity`, `unit_price`, `total_price`, `is_normal_orOther`, `isparentuom`, `com_code`, `invoice_date`, `added_by`, `created_at`, `updated_by`, `updated_at`, `production_date`, `expire_date`, `date`, `itemCostPriceFromBatah`, `taoalitemCostPriceFromBatah`, `item_total_earnings`) VALUES
(46, 32, 1, 1, 1, 1, 11, 1, '200.0000', '4000.00', '800000.00', 1, 1, 1, '2023-05-20', 1, '2023-05-20 13:21:52', NULL, '2023-05-20 13:21:52', NULL, NULL, '2023-05-20', '4000', '0', '0'),
(47, 33, 2, 1, 1, 1, 11, 1, '50.0000', '3000.00', '150000.00', 1, 1, 1, '2023-05-20', 1, '2023-05-20 13:24:13', NULL, '2023-05-20 13:24:13', NULL, NULL, '2023-05-20', '4000', '0', '-50000'),
(48, 34, 3, 1, 1, 1, 11, 1, '50.0000', '3000.00', '150000.00', 1, 1, 1, '2023-05-20', 1, '2023-05-20 15:06:02', NULL, '2023-05-20 15:06:02', NULL, NULL, '2023-05-20', '4000', '0', '-50000'),
(49, 35, 4, 1, 1, 1, 11, 1, '100.0000', '3000.00', '300000.00', 1, 1, 1, '2023-05-21', 1, '2023-05-22 00:40:03', NULL, '2023-05-22 00:40:03', NULL, NULL, '2023-05-22', '4000', '0', '-100000'),
(50, 36, 5, 1, 1, 1, 11, 1, '1.0000', '3000.00', '3000.00', 1, 1, 1, '2023-05-22', 1, '2023-05-22 00:42:34', NULL, '2023-05-22 00:42:34', NULL, NULL, '2023-05-22', '4000', '0', '-1000'),
(51, 36, 5, 1, 1, 34, 10, 4, '5.0000', '2500.00', '12500.00', 1, 1, 1, '2023-05-22', 1, '2023-05-24 04:36:17', NULL, '2023-05-24 04:36:17', NULL, NULL, '2023-05-24', '3000', '0', '-2500'),
(52, 37, 6, 1, 1, 2, 1, 3, '1.0000', '30000.00', '30000.00', 1, 1, 1, '2023-05-19', 1, '2023-05-27 21:09:31', NULL, '2023-05-27 21:09:31', NULL, NULL, '2023-05-27', '3500', '3500', '26500'),
(53, 37, 7, 1, 1, 1, 1, 1, '1.0000', '3000.00', '3000.00', 1, 1, 1, '2023-05-19', 1, '2023-05-27 21:09:31', NULL, '2023-05-27 21:09:31', NULL, NULL, '2023-05-27', '3000', '3000', '0'),
(54, 40, 8, 3, 1, 35, 1, 2, '10.0000', '3500.00', '35000.00', 1, 1, 1, '2023-06-20', 1, '2023-06-20 09:11:22', NULL, '2023-06-20 09:11:22', NULL, NULL, '2023-06-20', '5000', '50000', '-15000'),
(55, 41, 10, 1, 1, 2, 11, 3, '2.0000', '30000.00', '60000.00', 1, 1, 1, '2023-07-04', 1, '2023-07-04 11:00:15', NULL, '2023-07-04 11:00:15', NULL, NULL, '2023-07-04', '3500', '0', '53000'),
(56, 42, 11, 1, 1, 34, 1, 4, '1.0000', '2500.00', '2500.00', 1, 1, 1, '2023-06-20', 1, '2023-09-05 13:54:02', NULL, '2023-09-05 13:54:02', NULL, NULL, '2023-09-05', '3000', '3000', '-500'),
(57, 43, 12, 1, 1, 36, 11, 6, '1.0000', '100.00', '100.00', 1, 1, 1, '2023-09-05', 1, '2023-09-05 16:18:13', NULL, '2023-09-05 16:18:13', NULL, NULL, '2023-09-05', '1000', '0', '-900'),
(58, 43, 12, 1, 1, 36, 11, 6, '3.0000', '1200.00', '3600.00', 1, 1, 1, '2023-09-05', 1, '2023-09-05 16:20:06', NULL, '2023-09-05 16:20:06', NULL, NULL, '2023-09-05', '1000', '0', '600'),
(59, 43, 12, 1, 1, 36, 11, 6, '2.0000', '1200.00', '2400.00', 1, 1, 1, '2023-09-05', 1, '2023-09-05 16:20:42', NULL, '2023-09-05 16:20:42', NULL, NULL, '2023-09-05', '1000', '0', '400'),
(60, 44, 13, 1, 3, 36, 11, 6, '1.0000', '1000.00', '1000.00', 1, 1, 1, '2023-09-05', 1, '2023-09-05 16:39:10', NULL, '2023-09-05 16:39:10', NULL, NULL, '2023-09-05', '1000', '0', '0'),
(61, 44, 13, 1, 3, 40, 4, 7, '1.0000', '100.00', '100.00', 1, 0, 1, '2023-09-05', 1, '2023-09-05 17:17:58', NULL, '2023-09-05 17:17:58', NULL, NULL, '2023-09-05', '700', '700', '-600'),
(62, 44, 13, 1, 3, 40, 11, 7, '1.0000', '1300.00', '1300.00', 1, 1, 1, '2023-09-05', 1, '2023-09-05 17:18:21', NULL, '2023-09-05 17:18:21', NULL, NULL, '2023-09-05', '1400', '0', '-100'),
(63, 44, 13, 1, 3, 40, 4, 7, '1.0000', '100.00', '100.00', 1, 0, 1, '2023-09-05', 1, '2023-09-05 17:18:51', NULL, '2023-09-05 17:18:51', NULL, NULL, '2023-09-05', '700', '700', '-600'),
(64, 44, 13, 4, 3, 41, 11, 8, '1.0000', '1200.00', '1200.00', 1, 1, 1, '2023-09-05', 1, '2023-09-05 17:35:49', NULL, '2023-09-05 17:35:49', NULL, NULL, '2023-09-05', '1100', '0', '100');

-- --------------------------------------------------------

--
-- Table structure for table `sales_invoices_return`
--

CREATE TABLE `sales_invoices_return` (
  `id` bigint(20) NOT NULL,
  `return_type` tinyint(1) NOT NULL COMMENT 'واحد مرتجع بأصل الفاتورة - اثنين مرتجع عام',
  `sales_matrial_types` int(11) DEFAULT NULL COMMENT 'فئة الفاتورة',
  `auto_serial` bigint(20) NOT NULL,
  `invoice_date` date NOT NULL COMMENT 'تاريخ الفاتورة',
  `is_has_customer` tinyint(1) NOT NULL COMMENT 'هل الفاتورة مرتبطه بعميل - واحد يبقي نعم - لو صفر يبقي عميل طياري بدون عميل',
  `customer_code` bigint(20) DEFAULT NULL COMMENT 'كود العميل',
  `delegate_code` bigint(20) DEFAULT NULL COMMENT 'كود المندوب',
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `com_code` int(11) NOT NULL,
  `notes` varchar(225) DEFAULT NULL,
  `discount_type` tinyint(1) DEFAULT NULL COMMENT 'نواع الخصم - واحد خصم نسبة  - اثنين خصم يدوي قيمة',
  `discount_percent` decimal(10,2) DEFAULT 0.00 COMMENT 'قيمة نسبة الخصم',
  `discount_value` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'قيمة الخصم',
  `tax_percent` decimal(10,2) DEFAULT 0.00 COMMENT 'نسبة الضريبة ',
  `total_cost_items` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'اجمالي الاصناف فقط',
  `tax_value` decimal(10,2) DEFAULT 0.00 COMMENT 'قيمة الضريبة القيمة المضافة',
  `total_befor_discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_cost` decimal(10,2) DEFAULT 0.00 COMMENT 'القيمة الاجمالية النهائية للفاتورة',
  `account_number` bigint(20) DEFAULT NULL,
  `money_for_account` decimal(10,2) DEFAULT NULL,
  `pill_type` tinyint(1) DEFAULT NULL COMMENT 'نوع الفاتورة - كاش او اجل  - واحد واثنين',
  `what_paid` decimal(10,2) DEFAULT 0.00,
  `what_remain` decimal(10,2) DEFAULT 0.00,
  `treasuries_transactions_id` bigint(20) DEFAULT NULL,
  `customer_balance_befor` decimal(10,2) DEFAULT NULL COMMENT 'حالة رصيد العميل قبل الفاتروة',
  `customer_balance_after` decimal(10,2) DEFAULT NULL COMMENT 'حالة رصيد العميل بعد الفاتروة',
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='مرتجع المبيعات للعملاء';

--
-- Dumping data for table `sales_invoices_return`
--

INSERT INTO `sales_invoices_return` (`id`, `return_type`, `sales_matrial_types`, `auto_serial`, `invoice_date`, `is_has_customer`, `customer_code`, `delegate_code`, `is_approved`, `com_code`, `notes`, `discount_type`, `discount_percent`, `discount_value`, `tax_percent`, `total_cost_items`, `tax_value`, `total_befor_discount`, `total_cost`, `account_number`, `money_for_account`, `pill_type`, `what_paid`, `what_remain`, `treasuries_transactions_id`, `customer_balance_befor`, `customer_balance_after`, `added_by`, `created_at`, `updated_at`, `updated_by`, `approved_by`, `date`) VALUES
(5, 2, 6, 1, '2023-06-11', 1, 1, 4, 0, 1, NULL, NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL, 1, '0.00', '0.00', NULL, NULL, NULL, 1, '2023-06-11 20:06:00', '2023-06-11 20:06:00', NULL, NULL, '2023-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `sales_invoices_return_details`
--

CREATE TABLE `sales_invoices_return_details` (
  `id` bigint(20) NOT NULL,
  `sales_invoices_return_id` bigint(20) NOT NULL,
  `sales_invoices_auto_serial` bigint(20) NOT NULL,
  `store_id` int(11) NOT NULL,
  `sales_item_type` tinyint(1) NOT NULL COMMENT 'نوع البيع مع الصنف\r\nواحد قطاعي - اتنين نص جمية -ثلاثه جملة',
  `item_code` bigint(20) NOT NULL,
  `uom_id` int(11) NOT NULL,
  `batch_auto_serial` bigint(20) DEFAULT NULL COMMENT 'رقم الباتش بالمخزن التي تم خروج الصنف منها ',
  `quantity` decimal(10,4) NOT NULL,
  `unit_cost_price` decimal(10,2) DEFAULT NULL COMMENT 'في حاله المرتجع بدون تحديد باتش للمرتجع',
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `is_normal_orOther` tinyint(1) NOT NULL COMMENT 'واحد بيع عادي\r\nاتنين بونص \r\nثلاثه دعاية\r\nهالك \r\n- كلهم بدون سعر',
  `isparentuom` tinyint(1) NOT NULL COMMENT '1-main -0 retail',
  `com_code` int(11) NOT NULL,
  `invoice_date` date NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `production_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='تفاصيل اصناف فاتورة مرتجع المبيعات';

-- --------------------------------------------------------

--
-- Table structure for table `sales_matrial_types`
--

CREATE TABLE `sales_matrial_types` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL COMMENT 'for search ',
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sales_matrial_types`
--

INSERT INTO `sales_matrial_types` (`id`, `name`, `created_at`, `updated_at`, `added_by`, `updated_by`, `com_code`, `date`, `active`) VALUES
(5, 'عادي', '2023-05-24 02:28:45', '2023-05-24 02:28:45', 1, NULL, 1, '2023-05-24', 1),
(6, 'ويب', '2023-05-24 02:29:03', '2023-05-24 02:29:03', 1, NULL, 1, '2023-05-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `type` tinyint(1) NOT NULL COMMENT '1- done for us 2- we done for other',
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='خدمات نقدمها للغير ومقدمه لنا ';

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `active`, `type`, `added_by`, `created_at`, `updated_by`, `updated_at`, `com_code`, `date`) VALUES
(1, 'ميزان بسكول كبير', 1, 1, 1, '2022-11-22 17:06:09', 1, '2022-11-22 17:06:09', 1, '2022-11-22'),
(3, 'طباعه', 1, 2, 1, '2022-11-23 16:12:14', NULL, '2022-11-23 16:12:14', 1, '2022-11-23'),
(4, 'تركيب كاميرات مراقبة', 1, 2, 1, '2022-11-23 16:12:34', NULL, '2022-11-23 16:12:34', 1, '2022-11-23');

-- --------------------------------------------------------

--
-- Table structure for table `services_with_orders`
--

CREATE TABLE `services_with_orders` (
  `id` bigint(20) NOT NULL,
  `order_type` tinyint(1) NOT NULL COMMENT '1-for us 2-for other',
  `auto_serial` bigint(20) NOT NULL,
  `order_date` date NOT NULL COMMENT 'تاريخ الفاتورة',
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `com_code` int(11) NOT NULL,
  `notes` varchar(225) DEFAULT NULL COMMENT 'ملاحظات',
  `total_services` decimal(10,2) DEFAULT 0.00,
  `discount_type` tinyint(1) DEFAULT NULL COMMENT 'نواع الخصم - واحد خصم نسبة  - اثنين خصم يدوي قيمة',
  `discount_percent` decimal(10,2) DEFAULT 0.00 COMMENT 'قيمة نسبة الخصم',
  `discount_value` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'قيمة الخصم',
  `tax_percent` decimal(10,2) DEFAULT 0.00 COMMENT 'نسبة الضريبة ',
  `tax_value` decimal(10,2) DEFAULT 0.00 COMMENT 'قيمة الضريبة القيمة المضافة',
  `total_befor_discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_cost` decimal(10,2) DEFAULT 0.00 COMMENT 'القيمة الاجمالية النهائية للفاتورة',
  `is_account_number` tinyint(1) NOT NULL,
  `entity_name` varchar(150) DEFAULT NULL COMMENT 'اسم الجهه في حالة انه ليس حساب مالي',
  `account_number` bigint(20) DEFAULT NULL COMMENT 'رقم الحساب المالي المقدم له الخدمه او المقدم لنا الخدمة',
  `money_for_account` decimal(10,2) DEFAULT NULL,
  `pill_type` tinyint(1) NOT NULL COMMENT 'نوع الفاتورة - كاش او اجل  - واحد واثنين',
  `what_paid` decimal(10,2) DEFAULT 0.00,
  `what_remain` decimal(10,2) DEFAULT 0.00,
  `treasuries_transactions_id` bigint(20) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='جدول مشتريات ومترجعات المودين ';

--
-- Dumping data for table `services_with_orders`
--

INSERT INTO `services_with_orders` (`id`, `order_type`, `auto_serial`, `order_date`, `is_approved`, `com_code`, `notes`, `total_services`, `discount_type`, `discount_percent`, `discount_value`, `tax_percent`, `tax_value`, `total_befor_discount`, `total_cost`, `is_account_number`, `entity_name`, `account_number`, `money_for_account`, `pill_type`, `what_paid`, `what_remain`, `treasuries_transactions_id`, `added_by`, `created_at`, `updated_at`, `updated_by`, `approved_by`) VALUES
(2, 2, 1, '2023-05-23', 0, 1, NULL, '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, 'mmmm', NULL, NULL, 1, '0.00', '0.00', NULL, 1, '2023-05-23 19:21:28', '2023-05-23 19:22:04', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services_with_orders_details`
--

CREATE TABLE `services_with_orders_details` (
  `id` bigint(20) NOT NULL,
  `services_with_orders_id` bigint(20) NOT NULL,
  `services_with_orders_auto_serial` bigint(20) NOT NULL,
  `order_type` tinyint(4) NOT NULL,
  `service_id` int(11) NOT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `services_with_orders_details`
--

INSERT INTO `services_with_orders_details` (`id`, `services_with_orders_id`, `services_with_orders_auto_serial`, `order_type`, `service_id`, `notes`, `total`, `added_by`, `updated_by`, `created_at`, `updated_at`, `com_code`, `date`) VALUES
(2, 2, 1, 2, 4, NULL, '0.00', 1, NULL, '2023-05-23 19:22:04', '2023-05-23 19:22:04', 1, '2023-05-23');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `phones` varchar(100) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL COMMENT 'for search ',
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `phones`, `address`, `created_at`, `updated_at`, `added_by`, `updated_by`, `com_code`, `date`, `active`) VALUES
(1, 'الرئيسي', '01695845', 'شارع النصر ', '2022-09-01 00:59:33', '2022-09-21 00:59:33', 1, 1, 1, '2022-09-07', 1),
(3, 'مخزن الجولة', '6958525', 'شارع 15', '2022-09-01 01:37:04', '2023-06-20 13:14:36', 1, 1, 1, '2022-09-01', 1),
(4, 'مخزن السبل', '6151', 'شارع النصر', '2022-09-02 21:31:47', '2023-06-20 13:14:02', 1, 1, 1, '2022-09-02', 1),
(5, 'مخزن شارع العدين', '0165987575', 'ش 16 عمارة 4', '2022-10-10 09:09:19', '2023-06-20 13:15:13', 1, 1, 1, '2022-10-10', 1),
(6, 'mohamme', '0716007273', 'شارع الثلاثين', '2023-03-20 06:13:49', '2023-03-20 06:13:49', 1, NULL, 1, '2023-03-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_categories`
--

CREATE TABLE `suppliers_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL COMMENT 'for search ',
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `suppliers_categories`
--

INSERT INTO `suppliers_categories` (`id`, `name`, `created_at`, `updated_at`, `added_by`, `updated_by`, `com_code`, `date`, `active`) VALUES
(1, 'لحوم', '2022-09-12 00:25:02', '2022-10-06 14:51:47', 1, 1, 1, '2022-09-12', 1),
(2, 'فراخ', '2022-09-12 00:28:07', '2022-09-12 00:28:07', 1, NULL, 1, '2022-09-12', 1),
(4, 'خضروات', '2022-09-12 00:28:47', '2022-10-06 14:51:54', 1, 1, 1, '2022-09-12', 1),
(5, 'خردوات', '2022-10-06 14:51:44', '2022-10-06 14:51:51', 1, 1, 1, '2022-10-06', 1),
(6, 'خضروات طازجه', '2022-10-07 23:53:45', '2022-10-07 23:53:49', 1, 1, 1, '2022-10-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_with_orders`
--

CREATE TABLE `suppliers_with_orders` (
  `id` bigint(20) NOT NULL,
  `Invoice_orignal_id` int(20) DEFAULT NULL COMMENT 'رقم الفاتورة االتي بعمل عليها ارجع المشتريات',
  `order_type` tinyint(1) NOT NULL COMMENT '1-Burshase 2-return on same pill 3-return on general',
  `auto_serial` bigint(20) NOT NULL,
  `DOC_NO` varchar(25) DEFAULT NULL,
  `order_date` date NOT NULL COMMENT 'تاريخ الفاتورة',
  `suuplier_code` bigint(20) NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `com_code` int(11) NOT NULL,
  `notes` varchar(225) DEFAULT NULL COMMENT 'اجمالي الفاتورة قبل الخصم',
  `discount_type` tinyint(1) DEFAULT NULL COMMENT 'نواع الخصم - واحد خصم نسبة  - اثنين خصم يدوي قيمة',
  `discount_percent` decimal(10,2) DEFAULT 0.00 COMMENT 'قيمة نسبة الخصم',
  `discount_value` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'قيمة الخصم',
  `tax_percent` decimal(10,2) DEFAULT 0.00 COMMENT 'نسبة الضريبة ',
  `total_cost_items` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'اجمالي الاصناف فقط',
  `tax_value` decimal(10,2) DEFAULT 0.00 COMMENT 'قيمة الضريبة القيمة المضافة',
  `total_befor_discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_cost` decimal(10,2) DEFAULT 0.00 COMMENT 'القيمة الاجمالية النهائية للفاتورة',
  `account_number` bigint(20) NOT NULL,
  `money_for_account` decimal(10,2) DEFAULT NULL,
  `pill_type` tinyint(1) NOT NULL COMMENT 'نوع الفاتورة - كاش او اجل  - واحد واثنين',
  `what_paid` decimal(10,2) DEFAULT 0.00,
  `what_remain` decimal(10,2) DEFAULT 0.00,
  `treasuries_transactions_id` bigint(20) DEFAULT NULL,
  `Supplier_balance_befor` decimal(10,2) DEFAULT NULL COMMENT 'حالة رصيد المورد قبل الفاتروة',
  `Supplier_balance_after` decimal(10,2) DEFAULT NULL COMMENT 'حالة رصيد المورد بعد الفاتروة',
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `store_id` int(11) NOT NULL COMMENT 'كود المخزن المستلم للفاتورة',
  `approved_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='جدول مشتريات ومترجعات المودين ';

--
-- Dumping data for table `suppliers_with_orders`
--

INSERT INTO `suppliers_with_orders` (`id`, `Invoice_orignal_id`, `order_type`, `auto_serial`, `DOC_NO`, `order_date`, `suuplier_code`, `is_approved`, `com_code`, `notes`, `discount_type`, `discount_percent`, `discount_value`, `tax_percent`, `total_cost_items`, `tax_value`, `total_befor_discount`, `total_cost`, `account_number`, `money_for_account`, `pill_type`, `what_paid`, `what_remain`, `treasuries_transactions_id`, `Supplier_balance_befor`, `Supplier_balance_after`, `added_by`, `created_at`, `updated_at`, `updated_by`, `store_id`, `approved_by`) VALUES
(9, NULL, 1, 1, '5', '2023-05-20', 5, 1, 1, NULL, NULL, '0.00', '0.00', '0.00', '3600000.00', '0.00', '3600000.00', '3600000.00', 21, '-3600000.00', 2, '0.00', '3600000.00', NULL, NULL, NULL, 1, '2023-05-20 12:13:19', '2023-05-20 12:15:05', 1, 1, 1),
(10, NULL, 1, 2, '6', '2023-05-20', 2, 1, 1, NULL, NULL, '0.00', '0.00', '0.00', '700000.00', '0.00', '700000.00', '700000.00', 6, '-700000.00', 2, '0.00', '700000.00', NULL, NULL, NULL, 1, '2023-05-20 12:16:17', '2023-05-20 12:17:16', 1, 3, 1),
(11, NULL, 1, 3, '6', '2023-05-24', 2, 1, 1, NULL, NULL, '0.00', '0.00', '0.00', '35000.00', '0.00', '35000.00', '35000.00', 6, '-35000.00', 2, '0.00', '35000.00', NULL, NULL, NULL, 1, '2023-05-24 00:56:41', '2023-05-24 00:58:25', 1, 1, 1),
(12, NULL, 1, 4, '6', '2023-05-24', 5, 1, 1, NULL, NULL, '0.00', '0.00', '0.00', '180000.00', '0.00', '180000.00', '180000.00', 21, '-180000.00', 2, '0.00', '180000.00', NULL, NULL, NULL, 1, '2023-05-24 03:31:21', '2023-05-24 03:32:19', 1, 1, 1),
(13, NULL, 1, 5, '5', '2023-05-24', 3, 1, 1, NULL, NULL, '0.00', '0.00', '0.00', '11000.00', '0.00', '11000.00', '11000.00', 17, '-11000.00', 2, '0.00', '11000.00', NULL, NULL, NULL, 1, '2023-05-24 04:27:16', '2023-09-05 17:33:08', 1, 4, 1),
(14, NULL, 1, 6, '6', '2023-07-04', 5, 1, 1, NULL, NULL, '0.00', '0.00', '0.00', '20000.00', '0.00', '20000.00', '20000.00', 21, '-20000.00', 1, '20000.00', '0.00', NULL, NULL, NULL, 1, '2023-07-04 10:48:02', '2023-09-05 16:10:59', 1, 1, 1),
(15, NULL, 1, 7, '5', '2023-09-05', 5, 1, 1, NULL, NULL, '0.00', '0.00', '0.00', '14000.00', '0.00', '14000.00', '14000.00', 21, '-14000.00', 1, '14000.00', '0.00', NULL, NULL, NULL, 1, '2023-09-05 17:01:51', '2023-09-05 17:03:24', 1, 1, 1),
(16, NULL, 1, 8, '2', '2023-09-05', 5, 0, 1, NULL, NULL, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 21, NULL, 2, '0.00', '0.00', NULL, NULL, NULL, 1, '2023-09-05 19:00:23', '2023-09-05 19:00:23', NULL, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_with_orders_details`
--

CREATE TABLE `suppliers_with_orders_details` (
  `id` bigint(20) NOT NULL,
  `suppliers_with_order_id` bigint(20) NOT NULL,
  `suppliers_with_orders_auto_serial` bigint(20) NOT NULL,
  `order_type` tinyint(1) NOT NULL,
  `com_code` int(11) NOT NULL,
  `deliverd_quantity` decimal(10,2) NOT NULL,
  `uom_id` int(11) NOT NULL,
  `isparentuom` tinyint(1) NOT NULL COMMENT '1-main -0 retail',
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` date NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `item_code` bigint(20) NOT NULL,
  `batch_auto_serial` bigint(20) DEFAULT NULL COMMENT 'رقم الباتش بالمخزن التي تم تخزنن الصنف بها',
  `production_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `item_card_type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='تفاصيل انصاف فاتورة المشتريات والمرتجعات';

--
-- Dumping data for table `suppliers_with_orders_details`
--

INSERT INTO `suppliers_with_orders_details` (`id`, `suppliers_with_order_id`, `suppliers_with_orders_auto_serial`, `order_type`, `com_code`, `deliverd_quantity`, `uom_id`, `isparentuom`, `unit_price`, `total_price`, `order_date`, `added_by`, `created_at`, `updated_by`, `updated_at`, `item_code`, `batch_auto_serial`, `production_date`, `expire_date`, `item_card_type`) VALUES
(1, 9, 1, 1, 1, '1000.00', 11, 1, '3500.00', '3500000.00', '2023-05-20', 1, '2023-05-20 12:13:51', NULL, '2023-05-20 12:13:51', 1, NULL, NULL, NULL, 1),
(2, 9, 1, 1, 1, '50.00', 11, 1, '2000.00', '100000.00', '2023-05-20', 1, '2023-05-20 12:14:29', NULL, '2023-05-20 12:14:29', 1, NULL, NULL, NULL, 1),
(3, 10, 2, 1, 1, '150.00', 11, 1, '4000.00', '600000.00', '2023-05-20', 1, '2023-05-20 12:16:46', NULL, '2023-05-20 12:16:46', 1, NULL, NULL, NULL, 1),
(4, 10, 2, 1, 1, '20.00', 10, 1, '5000.00', '100000.00', '2023-05-20', 1, '2023-05-20 12:17:08', NULL, '2023-05-20 12:17:08', 35, NULL, NULL, NULL, 1),
(5, 11, 3, 1, 1, '10.00', 11, 1, '3500.00', '35000.00', '2023-05-24', 1, '2023-05-24 00:57:19', NULL, '2023-05-24 00:57:19', 2, NULL, NULL, NULL, 1),
(6, 12, 4, 1, 1, '50.00', 11, 1, '3000.00', '150000.00', '2023-05-24', 1, '2023-05-24 03:31:50', NULL, '2023-05-24 03:31:50', 1, NULL, NULL, NULL, 1),
(7, 12, 4, 1, 1, '10.00', 10, 1, '3000.00', '30000.00', '2023-05-24', 1, '2023-05-24 03:32:10', NULL, '2023-05-24 03:32:10', 34, NULL, NULL, NULL, 1),
(9, 14, 6, 1, 1, '10.00', 11, 1, '1000.00', '10000.00', '2023-07-04', 1, '2023-09-05 16:03:07', NULL, '2023-09-05 16:03:07', 37, NULL, NULL, NULL, 1),
(10, 14, 6, 1, 1, '10.00', 11, 1, '1000.00', '10000.00', '2023-07-04', 1, '2023-09-05 16:10:46', NULL, '2023-09-05 16:10:46', 36, NULL, NULL, NULL, 1),
(11, 15, 7, 1, 1, '10.00', 11, 1, '1400.00', '14000.00', '2023-09-05', 1, '2023-09-05 17:03:08', NULL, '2023-09-05 17:03:08', 40, NULL, NULL, NULL, 1),
(12, 13, 5, 1, 1, '10.00', 11, 1, '1100.00', '11000.00', '2023-05-24', 1, '2023-09-05 17:32:51', NULL, '2023-09-05 17:32:51', 41, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `suupliers`
--

CREATE TABLE `suupliers` (
  `id` bigint(20) NOT NULL,
  `suuplier_code` bigint(20) NOT NULL,
  `suppliers_categories_id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `account_number` bigint(20) NOT NULL,
  `start_balance_status` tinyint(4) NOT NULL COMMENT 'e 1-credit -2 debit 3-balanced',
  `start_balance` decimal(10,2) NOT NULL COMMENT 'دائن او مدين او متزن اول المدة',
  `current_balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `notes` varchar(225) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `phones` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='جدول الشجرة المحاسبية العامة';

--
-- Dumping data for table `suupliers`
--

INSERT INTO `suupliers` (`id`, `suuplier_code`, `suppliers_categories_id`, `name`, `account_number`, `start_balance_status`, `start_balance`, `current_balance`, `notes`, `added_by`, `updated_by`, `created_at`, `updated_at`, `active`, `com_code`, `date`, `address`, `phones`) VALUES
(1, 1, 1, 'عاطف دياب محمد', 4, 1, '-5000.00', '-86600.00', NULL, 1, NULL, '2022-09-22 22:45:06', '2022-12-19 01:27:46', 1, 1, '2022-09-22', NULL, NULL),
(2, 2, 2, 'محمود محمد', 6, 3, '0.00', '-725000.00', NULL, 1, NULL, '2022-09-22 23:29:29', '2023-06-06 01:35:40', 1, 1, '2022-09-22', NULL, NULL),
(3, 3, 2, 'الاحمدي للفراخ المجمده', 17, 1, '-5000.00', '-11000.00', 'بانتظار طلبية رقم 15', 1, NULL, '2022-10-06 15:00:21', '2023-09-05 17:33:08', 1, 1, '2022-10-06', 'ش النصر', '0569585285'),
(4, 4, 2, 'ابو مازن  للفراخ المجمده', 18, 1, '-5000.00', '-5000.00', 'بانتظار طلبية', 1, 1, '2022-10-06 15:02:02', '2022-10-06 15:03:11', 0, 1, '2022-10-06', 'ش  النصر', '096258258'),
(5, 5, 1, 'البدري للحوم المجمده', 21, 1, '-5000.00', '-3780000.00', NULL, 1, 1, '2022-10-07 23:56:14', '2023-09-05 17:03:24', 1, 1, '2022-10-07', 'ش سيتي', '0152658');

-- --------------------------------------------------------

--
-- Table structure for table `treasuries`
--

CREATE TABLE `treasuries` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `is_mester` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'هل خزنة رئيسية -0-1',
  `last_isal_exhcange` bigint(20) NOT NULL COMMENT 'رقم اخر ايصال للصرف',
  `last_isal_collect` bigint(20) NOT NULL COMMENT 'رقم اخر ايصال للتحصيل',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `com_code` int(11) NOT NULL,
  `date` date NOT NULL COMMENT 'for search ',
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `treasuries`
--

INSERT INTO `treasuries` (`id`, `name`, `is_mester`, `last_isal_exhcange`, `last_isal_collect`, `created_at`, `updated_at`, `added_by`, `updated_by`, `com_code`, `date`, `active`) VALUES
(1, 'الرئيسية', 1, 35, 31, '2022-08-30 15:05:08', '2023-09-05 17:03:24', 1, 1, 1, '2022-08-30', 1),
(2, 'كاشير 1  يي  ddd', 0, 1, 1, '2022-08-30 17:14:15', '2022-08-30 18:43:43', 1, 1, 1, '2022-08-30', 0),
(3, 'كاشير 2', 0, 1, 1, '2022-08-30 19:09:55', '2023-06-07 02:54:32', 1, NULL, 1, '2022-08-30', 1),
(4, 'كاشير 3', 0, 0, 0, '2022-08-30 19:10:20', '2022-08-31 09:54:08', 1, 1, 1, '2022-08-30', 1),
(5, 'كاشير 4', 0, 1, 1, '2022-10-06 02:57:25', '2023-03-20 09:05:45', 1, 1, 1, '2022-10-06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `treasuries_delivery`
--

CREATE TABLE `treasuries_delivery` (
  `id` int(11) NOT NULL,
  `treasuries_id` int(11) NOT NULL COMMENT 'الخزنة التي سوف تستلم',
  `treasuries_can_delivery_id` int(11) NOT NULL COMMENT 'الخزنة التي سيتم تسليمها',
  `created_at` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `com_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `treasuries_delivery`
--

INSERT INTO `treasuries_delivery` (`id`, `treasuries_id`, `treasuries_can_delivery_id`, `created_at`, `added_by`, `updated_by`, `updated_at`, `com_code`) VALUES
(1, 1, 1, '2023-06-07 02:50:12', 1, NULL, '2023-06-07 02:50:12', 1),
(2, 1, 3, '2023-06-07 02:50:21', 1, NULL, '2023-06-07 02:50:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `treasuries_transactions`
--

CREATE TABLE `treasuries_transactions` (
  `id` bigint(20) NOT NULL,
  `auto_serial` bigint(20) NOT NULL COMMENT 'كود تلقائي للحركة ',
  `isal_number` bigint(20) NOT NULL COMMENT 'كود العملية الالي',
  `shift_code` bigint(20) NOT NULL COMMENT 'كود الشفت للمستخدم',
  `money` decimal(10,0) NOT NULL COMMENT 'قيمة المبلغ المصروف او المحصل بالخزنة',
  `treasuries_id` int(11) NOT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `mov_type` int(11) NOT NULL COMMENT 'نوع حركة النقدية ',
  `move_date` date NOT NULL,
  `the_foregin_key` bigint(20) DEFAULT NULL COMMENT 'كود الجدول الاخر المرتبط بالحركة',
  `account_number` bigint(20) DEFAULT NULL COMMENT 'رقم الحساب المالي ',
  `is_account` tinyint(1) DEFAULT NULL COMMENT 'هل هو حساب مالي',
  `money_for_account` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'قيمة المبلغ المستحق للحساب او علي الحساب',
  `byan` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `com_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='جدول حركة النقدية بالشفتات';

--
-- Dumping data for table `treasuries_transactions`
--

INSERT INTO `treasuries_transactions` (`id`, `auto_serial`, `isal_number`, `shift_code`, `money`, `treasuries_id`, `is_approved`, `mov_type`, `move_date`, `the_foregin_key`, `account_number`, `is_account`, `money_for_account`, `byan`, `created_at`, `added_by`, `updated_at`, `updated_by`, `com_code`) VALUES
(1, 1, 25, 6, '29988', 1, 1, 1, '2023-06-07', NULL, NULL, NULL, '0.00', 'مراجعة واستلام نقدية خزنةالرئيسيةللمستخدمadmin1رقم الشفت3', '2023-06-07 02:36:46', 1, '2023-06-07 02:36:46', NULL, 1),
(2, 2, 1, 1, '15000', 3, 1, 5, '2023-06-07', NULL, 39, 1, '-15000.00', 'تحصيل نظير', '2023-06-07 02:53:26', 1, '2023-06-07 02:53:26', NULL, 1),
(3, 3, 1, 1, '-5000', 3, 1, 9, '2023-06-07', NULL, 17, 1, '5000.00', 'صرف نظير', '2023-06-07 02:54:32', 1, '2023-06-07 02:54:32', NULL, 1),
(4, 4, 25, 2, '9000', 1, 1, 1, '2023-06-07', NULL, NULL, NULL, '0.00', 'مراجعة واستلام نقدية خزنةكاشير 2للمستخدمadmin1رقم الشفت1', '2023-06-07 02:59:39', 1, '2023-06-07 02:59:39', NULL, 1),
(5, 5, 25, 2, '18000', 1, 1, 5, '2023-06-07', NULL, 39, 1, '-18000.00', 'تحصيل نظير', '2023-06-07 04:55:32', 1, '2023-06-07 04:55:32', NULL, 1),
(6, 6, 26, 2, '12345687', 1, 1, 5, '2023-06-07', NULL, 39, 1, '-12345687.00', 'تحصيل نظير', '2023-06-07 05:05:20', 1, '2023-06-07 05:05:20', NULL, 1),
(7, 7, 27, 2, '23647', 1, 1, 4, '2023-06-07', NULL, 40, 1, '-23647.00', 'تحصيل نظير', '2023-06-07 05:11:09', 1, '2023-06-07 05:11:09', NULL, 1),
(8, 8, 28, 2, '20000', 1, 1, 4, '2023-06-07', NULL, 40, 1, '-20000.00', 'تحصيل نظير', '2023-06-07 05:12:06', 1, '2023-06-07 05:12:06', NULL, 1),
(9, 9, 29, 2, '14567', 1, 1, 4, '2023-06-07', NULL, 40, 1, '-14567.00', 'تحصيل نظير', '2023-06-07 05:13:17', 1, '2023-06-07 05:13:17', NULL, 1),
(10, 10, 30, 3, '35000', 1, 1, 5, '2023-06-11', NULL, 41, 1, '-35000.00', 'تحصيل نظير', '2023-06-11 20:07:51', 1, '2023-06-11 20:07:51', NULL, 1),
(11, 11, 31, 3, '1200', 1, 1, 5, '2023-07-04', NULL, 48, 1, '-1200.00', 'تحصيل نظير', '2023-07-04 10:43:38', 1, '2023-07-04 10:43:38', NULL, 1),
(12, 12, 34, 3, '-20000', 1, 1, 9, '2023-09-05', NULL, 21, 1, '20000.00', 'صرف نظير فاتورة مشتريات  رقم6', '2023-09-05 16:10:59', 1, '2023-09-05 16:10:59', NULL, 1),
(13, 13, 35, 3, '-14000', 1, 1, 9, '2023-09-05', NULL, 21, 1, '14000.00', 'صرف نظير فاتورة مشتريات  رقم7', '2023-09-05 17:03:24', 1, '2023-09-05 17:03:24', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_type` (`account_type`);

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `com_code` (`com_code`);

--
-- Indexes for table `admins_shifts`
--
ALTER TABLE `admins_shifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `treasuries_id` (`treasuries_id`);

--
-- Indexes for table `admins_stores`
--
ALTER TABLE `admins_stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `Store_id` (`Store_id`);

--
-- Indexes for table `admins_treasuries`
--
ALTER TABLE `admins_treasuries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `treasuries_id` (`treasuries_id`);

--
-- Indexes for table `admin_panel_settings`
--
ALTER TABLE `admin_panel_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custmoer_favorite_itemcard`
--
ALTER TABLE `custmoer_favorite_itemcard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itemcard_id` (`itemcard_id`),
  ADD KEY `supplier_id` (`customer_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_code` (`customer_code`);

--
-- Indexes for table `customer_order_details`
--
ALTER TABLE `customer_order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_order_id` (`customer_order_id`);

--
-- Indexes for table `delegates`
--
ALTER TABLE `delegates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_number` (`account_number`),
  ADD KEY `com_code` (`com_code`);

--
-- Indexes for table `inv_itemcard`
--
ALTER TABLE `inv_itemcard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inv_itemcard_categories_id` (`inv_itemcard_categories_id`),
  ADD KEY `com_code` (`com_code`);

--
-- Indexes for table `inv_itemcard_batches`
--
ALTER TABLE `inv_itemcard_batches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_id` (`store_id`,`item_code`);

--
-- Indexes for table `inv_itemcard_categories`
--
ALTER TABLE `inv_itemcard_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inv_itemcard_movements`
--
ALTER TABLE `inv_itemcard_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_code` (`item_code`,`store_id`,`FK_table_details`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `items_movements_types` (`items_movements_types`);

--
-- Indexes for table `inv_itemcard_movements_categories`
--
ALTER TABLE `inv_itemcard_movements_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inv_itemcard_movements_types`
--
ALTER TABLE `inv_itemcard_movements_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inv_stores_inventory`
--
ALTER TABLE `inv_stores_inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auto_serial` (`auto_serial`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `inv_stores_inventory_details`
--
ALTER TABLE `inv_stores_inventory_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batch_auto_serial` (`batch_auto_serial`),
  ADD KEY `inv_stores_inventory_auto_serial` (`inv_stores_inventory_auto_serial`),
  ADD KEY `inv_stores_inventory_id` (`inv_stores_inventory_id`);

--
-- Indexes for table `inv_stores_transfer`
--
ALTER TABLE `inv_stores_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inv_stores_transfer_details`
--
ALTER TABLE `inv_stores_transfer_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inv_stores_transfer_id` (`inv_stores_transfer_id`);

--
-- Indexes for table `inv_uoms`
--
ALTER TABLE `inv_uoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemcard_photos`
--
ALTER TABLE `itemcard_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itemcard_id` (`itemcard_id`);

--
-- Indexes for table `mov_type`
--
ALTER TABLE `mov_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `permission_main_menues`
--
ALTER TABLE `permission_main_menues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_rols`
--
ALTER TABLE `permission_rols`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_rols_main_menues`
--
ALTER TABLE `permission_rols_main_menues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_rols_id` (`permission_rols_id`),
  ADD KEY `permission_main_menues_id` (`permission_main_menues_id`);

--
-- Indexes for table `permission_rols_sub_menues`
--
ALTER TABLE `permission_rols_sub_menues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_rols_main_menues_id` (`permission_rols_main_menues_id`),
  ADD KEY `permission_rols_id` (`permission_rols_id`);

--
-- Indexes for table `permission_rols_sub_menues_action`
--
ALTER TABLE `permission_rols_sub_menues_action`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_rols_sub_menues_id` (`permission_rols_sub_menues_id`),
  ADD KEY `permission_sub_menues_action_id` (`permission_sub_menues_action_id`);

--
-- Indexes for table `permission_sub_menues`
--
ALTER TABLE `permission_sub_menues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_main_menues_id` (`permission_main_menues_id`);

--
-- Indexes for table `permission_sub_menues_actions`
--
ALTER TABLE `permission_sub_menues_actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_sub_menues_id` (`permission_sub_menues_id`);

--
-- Indexes for table `sales_invoices`
--
ALTER TABLE `sales_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auto_serial` (`auto_serial`);

--
-- Indexes for table `sales_invoices_details`
--
ALTER TABLE `sales_invoices_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_invoices_auto_serial` (`sales_invoices_auto_serial`),
  ADD KEY `sales_invoices_id` (`sales_invoices_id`),
  ADD KEY `item_code` (`item_code`);

--
-- Indexes for table `sales_invoices_return`
--
ALTER TABLE `sales_invoices_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_invoices_return_details`
--
ALTER TABLE `sales_invoices_return_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_invoices_auto_serial` (`sales_invoices_auto_serial`),
  ADD KEY `sales_invoices_return_id` (`sales_invoices_return_id`);

--
-- Indexes for table `sales_matrial_types`
--
ALTER TABLE `sales_matrial_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_with_orders`
--
ALTER TABLE `services_with_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_with_orders_details`
--
ALTER TABLE `services_with_orders_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_with_orders_id` (`services_with_orders_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `com_code` (`com_code`);

--
-- Indexes for table `suppliers_categories`
--
ALTER TABLE `suppliers_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers_with_orders`
--
ALTER TABLE `suppliers_with_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `suppliers_with_orders_details`
--
ALTER TABLE `suppliers_with_orders_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suppliers_with_order_id` (`suppliers_with_order_id`);

--
-- Indexes for table `suupliers`
--
ALTER TABLE `suupliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suppliers_categories_id` (`suppliers_categories_id`);

--
-- Indexes for table `treasuries`
--
ALTER TABLE `treasuries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `com_code` (`com_code`);

--
-- Indexes for table `treasuries_delivery`
--
ALTER TABLE `treasuries_delivery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `treasuries_id` (`treasuries_id`);

--
-- Indexes for table `treasuries_transactions`
--
ALTER TABLE `treasuries_transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admins_shifts`
--
ALTER TABLE `admins_shifts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admins_stores`
--
ALTER TABLE `admins_stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins_treasuries`
--
ALTER TABLE `admins_treasuries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_panel_settings`
--
ALTER TABLE `admin_panel_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `custmoer_favorite_itemcard`
--
ALTER TABLE `custmoer_favorite_itemcard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer_order_details`
--
ALTER TABLE `customer_order_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `delegates`
--
ALTER TABLE `delegates`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inv_itemcard`
--
ALTER TABLE `inv_itemcard`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `inv_itemcard_batches`
--
ALTER TABLE `inv_itemcard_batches`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `inv_itemcard_categories`
--
ALTER TABLE `inv_itemcard_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `inv_itemcard_movements`
--
ALTER TABLE `inv_itemcard_movements`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `inv_itemcard_movements_categories`
--
ALTER TABLE `inv_itemcard_movements_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inv_itemcard_movements_types`
--
ALTER TABLE `inv_itemcard_movements_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `inv_stores_inventory`
--
ALTER TABLE `inv_stores_inventory`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `inv_stores_inventory_details`
--
ALTER TABLE `inv_stores_inventory_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `inv_stores_transfer`
--
ALTER TABLE `inv_stores_transfer`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inv_stores_transfer_details`
--
ALTER TABLE `inv_stores_transfer_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `inv_uoms`
--
ALTER TABLE `inv_uoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `itemcard_photos`
--
ALTER TABLE `itemcard_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `mov_type`
--
ALTER TABLE `mov_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `permission_main_menues`
--
ALTER TABLE `permission_main_menues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `permission_rols`
--
ALTER TABLE `permission_rols`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permission_rols_main_menues`
--
ALTER TABLE `permission_rols_main_menues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `permission_rols_sub_menues`
--
ALTER TABLE `permission_rols_sub_menues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `permission_rols_sub_menues_action`
--
ALTER TABLE `permission_rols_sub_menues_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `permission_sub_menues`
--
ALTER TABLE `permission_sub_menues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `permission_sub_menues_actions`
--
ALTER TABLE `permission_sub_menues_actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `sales_invoices`
--
ALTER TABLE `sales_invoices`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `sales_invoices_details`
--
ALTER TABLE `sales_invoices_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `sales_invoices_return`
--
ALTER TABLE `sales_invoices_return`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales_invoices_return_details`
--
ALTER TABLE `sales_invoices_return_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sales_matrial_types`
--
ALTER TABLE `sales_matrial_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services_with_orders`
--
ALTER TABLE `services_with_orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services_with_orders_details`
--
ALTER TABLE `services_with_orders_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suppliers_categories`
--
ALTER TABLE `suppliers_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suppliers_with_orders`
--
ALTER TABLE `suppliers_with_orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `suppliers_with_orders_details`
--
ALTER TABLE `suppliers_with_orders_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `suupliers`
--
ALTER TABLE `suupliers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `treasuries`
--
ALTER TABLE `treasuries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `treasuries_delivery`
--
ALTER TABLE `treasuries_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `treasuries_transactions`
--
ALTER TABLE `treasuries_transactions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`com_code`) REFERENCES `admin_panel_settings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `admins_shifts`
--
ALTER TABLE `admins_shifts`
  ADD CONSTRAINT `admins_shifts_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `admins_shifts_ibfk_2` FOREIGN KEY (`treasuries_id`) REFERENCES `treasuries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `admins_stores`
--
ALTER TABLE `admins_stores`
  ADD CONSTRAINT `admins_stores_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `admins_stores_ibfk_2` FOREIGN KEY (`Store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `admins_treasuries`
--
ALTER TABLE `admins_treasuries`
  ADD CONSTRAINT `admins_treasuries_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `admins_treasuries_ibfk_2` FOREIGN KEY (`treasuries_id`) REFERENCES `treasuries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `custmoer_favorite_itemcard`
--
ALTER TABLE `custmoer_favorite_itemcard`
  ADD CONSTRAINT `custmoer_favorite_itemcard_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `customer_order_ibfk_1` FOREIGN KEY (`customer_code`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_order_details`
--
ALTER TABLE `customer_order_details`
  ADD CONSTRAINT `customer_order_details_ibfk_1` FOREIGN KEY (`customer_order_id`) REFERENCES `customer_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `delegates`
--
ALTER TABLE `delegates`
  ADD CONSTRAINT `delegates_ibfk_1` FOREIGN KEY (`account_number`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `delegates_ibfk_2` FOREIGN KEY (`com_code`) REFERENCES `admin_panel_settings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inv_itemcard`
--
ALTER TABLE `inv_itemcard`
  ADD CONSTRAINT `inv_itemcard_ibfk_1` FOREIGN KEY (`inv_itemcard_categories_id`) REFERENCES `inv_itemcard_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inv_itemcard_ibfk_2` FOREIGN KEY (`com_code`) REFERENCES `admin_panel_settings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inv_itemcard_batches`
--
ALTER TABLE `inv_itemcard_batches`
  ADD CONSTRAINT `inv_itemcard_batches_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inv_itemcard_movements`
--
ALTER TABLE `inv_itemcard_movements`
  ADD CONSTRAINT `inv_itemcard_movements_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inv_itemcard_movements_ibfk_2` FOREIGN KEY (`item_code`) REFERENCES `inv_itemcard` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inv_itemcard_movements_ibfk_3` FOREIGN KEY (`items_movements_types`) REFERENCES `inv_itemcard_movements_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inv_stores_inventory`
--
ALTER TABLE `inv_stores_inventory`
  ADD CONSTRAINT `inv_stores_inventory_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inv_stores_inventory_details`
--
ALTER TABLE `inv_stores_inventory_details`
  ADD CONSTRAINT `inv_stores_inventory_details_ibfk_1` FOREIGN KEY (`inv_stores_inventory_id`) REFERENCES `inv_stores_inventory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inv_stores_transfer_details`
--
ALTER TABLE `inv_stores_transfer_details`
  ADD CONSTRAINT `inv_stores_transfer_details_ibfk_1` FOREIGN KEY (`inv_stores_transfer_id`) REFERENCES `inv_stores_transfer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `itemcard_photos`
--
ALTER TABLE `itemcard_photos`
  ADD CONSTRAINT `itemcard_photos_ibfk_1` FOREIGN KEY (`itemcard_id`) REFERENCES `inv_itemcard` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_rols_main_menues`
--
ALTER TABLE `permission_rols_main_menues`
  ADD CONSTRAINT `permission_rols_main_menues_ibfk_1` FOREIGN KEY (`permission_rols_id`) REFERENCES `permission_rols` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_rols_main_menues_ibfk_2` FOREIGN KEY (`permission_main_menues_id`) REFERENCES `permission_main_menues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_rols_sub_menues`
--
ALTER TABLE `permission_rols_sub_menues`
  ADD CONSTRAINT `permission_rols_sub_menues_ibfk_1` FOREIGN KEY (`permission_rols_main_menues_id`) REFERENCES `permission_rols_main_menues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_rols_sub_menues_ibfk_2` FOREIGN KEY (`permission_rols_id`) REFERENCES `permission_rols` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `permission_rols_sub_menues_action`
--
ALTER TABLE `permission_rols_sub_menues_action`
  ADD CONSTRAINT `permission_rols_sub_menues_action_ibfk_1` FOREIGN KEY (`permission_rols_sub_menues_id`) REFERENCES `permission_rols_sub_menues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_rols_sub_menues_action_ibfk_2` FOREIGN KEY (`permission_sub_menues_action_id`) REFERENCES `permission_sub_menues_actions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_sub_menues`
--
ALTER TABLE `permission_sub_menues`
  ADD CONSTRAINT `permission_sub_menues_ibfk_1` FOREIGN KEY (`permission_main_menues_id`) REFERENCES `permission_main_menues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_sub_menues_actions`
--
ALTER TABLE `permission_sub_menues_actions`
  ADD CONSTRAINT `permission_sub_menues_actions_ibfk_1` FOREIGN KEY (`permission_sub_menues_id`) REFERENCES `permission_sub_menues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales_invoices_details`
--
ALTER TABLE `sales_invoices_details`
  ADD CONSTRAINT `sales_invoices_details_ibfk_1` FOREIGN KEY (`sales_invoices_id`) REFERENCES `sales_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_invoices_details_ibfk_2` FOREIGN KEY (`item_code`) REFERENCES `inv_itemcard` (`id`);

--
-- Constraints for table `sales_invoices_return_details`
--
ALTER TABLE `sales_invoices_return_details`
  ADD CONSTRAINT `sales_invoices_return_details_ibfk_1` FOREIGN KEY (`sales_invoices_return_id`) REFERENCES `sales_invoices_return` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `services_with_orders_details`
--
ALTER TABLE `services_with_orders_details`
  ADD CONSTRAINT `services_with_orders_details_ibfk_1` FOREIGN KEY (`services_with_orders_id`) REFERENCES `services_with_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `stores_ibfk_1` FOREIGN KEY (`com_code`) REFERENCES `admin_panel_settings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suppliers_with_orders`
--
ALTER TABLE `suppliers_with_orders`
  ADD CONSTRAINT `suppliers_with_orders_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`);

--
-- Constraints for table `suppliers_with_orders_details`
--
ALTER TABLE `suppliers_with_orders_details`
  ADD CONSTRAINT `suppliers_with_orders_details_ibfk_1` FOREIGN KEY (`suppliers_with_order_id`) REFERENCES `suppliers_with_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suupliers`
--
ALTER TABLE `suupliers`
  ADD CONSTRAINT `suupliers_ibfk_1` FOREIGN KEY (`suppliers_categories_id`) REFERENCES `suppliers_categories` (`id`);

--
-- Constraints for table `treasuries`
--
ALTER TABLE `treasuries`
  ADD CONSTRAINT `treasuries_ibfk_1` FOREIGN KEY (`com_code`) REFERENCES `admin_panel_settings` (`id`);

--
-- Constraints for table `treasuries_delivery`
--
ALTER TABLE `treasuries_delivery`
  ADD CONSTRAINT `treasuries_delivery_ibfk_1` FOREIGN KEY (`treasuries_id`) REFERENCES `treasuries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
