-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2017 at 11:48 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `affiliate_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `afsys_clients`
--

CREATE TABLE `afsys_clients` (
  `client_id` bigint(20) NOT NULL,
  `client_name` varchar(155) DEFAULT NULL,
  `client_owner_name` varchar(255) DEFAULT NULL,
  `client_app_name` varchar(255) DEFAULT NULL,
  `client_app_id` varchar(255) DEFAULT NULL,
  `client_username` varchar(255) DEFAULT NULL,
  `client_password` varchar(255) DEFAULT NULL,
  `client_email_address` varchar(255) DEFAULT NULL,
  `client_company_name` varchar(255) DEFAULT NULL,
  `client_address_line1` varchar(255) DEFAULT NULL,
  `client_address_line2` varchar(255) DEFAULT NULL,
  `client_postal_code` varchar(255) DEFAULT NULL,
  `client_about_company` text,
  `client_date_format` varchar(20) DEFAULT NULL,
  `client_logo` varchar(100) DEFAULT NULL,
  `client_category` int(11) NOT NULL,
  `client_folder_name` varchar(50) DEFAULT NULL,
  `client_brand_enable` tinyint(1) NOT NULL DEFAULT '0',
  `client_beacon_enable` tinyint(1) NOT NULL DEFAULT '0',
  `client_loyality_enable` tinyint(1) NOT NULL DEFAULT '0',
  `client_gift_enable` tinyint(1) NOT NULL DEFAULT '0',
  `client_whishlist_enable` tinyint(1) NOT NULL DEFAULT '0',
  `client_status` enum('A','I','D') NOT NULL DEFAULT 'I' COMMENT 'A-active, I- Inactive, D-Deleted',
  `client_created_on` datetime DEFAULT NULL,
  `client_creatd_by` tinyint(4) DEFAULT NULL,
  `client_creatd_ip` varchar(20) DEFAULT NULL,
  `client_updated_on` datetime DEFAULT NULL,
  `client_updated_by` tinyint(4) DEFAULT NULL,
  `client_updtaed_ip` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `afsys_clients`
--

INSERT INTO `afsys_clients` (`client_id`, `client_name`, `client_owner_name`, `client_app_name`, `client_app_id`, `client_username`, `client_password`, `client_email_address`, `client_company_name`, `client_address_line1`, `client_address_line2`, `client_postal_code`, `client_about_company`, `client_date_format`, `client_logo`, `client_category`, `client_folder_name`, `client_brand_enable`, `client_beacon_enable`, `client_loyality_enable`, `client_gift_enable`, `client_whishlist_enable`, `client_status`, `client_created_on`, `client_creatd_by`, `client_creatd_ip`, `client_updated_on`, `client_updated_by`, `client_updtaed_ip`) VALUES
(8, 'sdsd', NULL, NULL, '3F8DC941-6E6B-446F-BC09-B4FB74DBD991', 'sdsdsdsds', '02vgxz1cCTVd', 'tesdssdst@test.com', NULL, NULL, NULL, NULL, '', NULL, NULL, 1, 'dev_team', 0, 0, 0, 0, 0, 'A', NULL, NULL, NULL, '2016-02-25 10:47:04', 1, '::1'),
(9, 'aSDADAD', NULL, NULL, 'D022AB3E-3EA5-4CC1-9A5E-80D41940D936', 'ASDASDASDASD', 'Qq7jk3ya15uS', 'benasdasdfdfgz@test.com', NULL, NULL, NULL, NULL, 'sdsdsd', NULL, NULL, 1, 'dev_team', 0, 0, 0, 0, 0, 'A', NULL, NULL, NULL, '2016-02-24 16:03:01', 1, '::1'),
(10, 'sdsdsds', NULL, NULL, '5EBEE8EF-45A2-4E50-A6A9-6F2338F22C47', 'sdsdsdsd', 'lPcaLD0rfy1h', 'testssdsddsd@test.com', NULL, NULL, NULL, NULL, '', NULL, NULL, 1, 'dev_team', 0, 0, 0, 0, 0, 'A', NULL, NULL, NULL, '2016-02-25 07:05:10', 1, '::1'),
(11, 'company1sdsdsd', NULL, NULL, '0A6099DD-CFC1-4CC7-8119-7878E143C786', 'sdsdsdsdsdsds', 'uC4XJnBL3gze', 'sdsdsdtest@test.com', NULL, NULL, NULL, NULL, 'sdsdsd', NULL, NULL, 2, 'dev_team', 0, 0, 0, 0, 0, 'I', NULL, NULL, NULL, '2016-02-25 10:46:23', 1, '::1'),
(12, 'ben wills', NULL, NULL, '4E08E801-CDCA-4221-8D26-FB764BA6DD7D', 'ben wills', 'VY6Hi1M0Spqj', 'bensdsd@test.com', NULL, NULL, NULL, NULL, '', NULL, NULL, 1, 'dev_team', 0, 0, 0, 0, 0, 'A', NULL, NULL, NULL, '2016-02-24 08:03:33', 1, '::1'),
(13, 'company1', NULL, NULL, 'C4FCE82E-575B-4959-A7AA-DBC49C3C8A10', 'dfsdfsfsf', '4Nui2sy6vR9o', 'testdfsdf@test.com', NULL, NULL, NULL, NULL, 'dsfsdfdsfsdfs', NULL, NULL, 2, 'dev_team', 0, 0, 0, 0, 0, 'A', NULL, NULL, NULL, '2016-02-25 15:27:51', 1, '::1'),
(14, 'safdasdfsdf', NULL, NULL, 'F0788065-5010-4F66-B60F-54C974EF6848', 'sdfsfsfsdf', 'aX3ePgi6DpEz', 'befgsfdsn@test.com', NULL, NULL, NULL, NULL, 'sdfsdf', NULL, NULL, 1, 'dev_team', 0, 0, 0, 0, 0, 'I', NULL, NULL, NULL, '2016-02-25 15:26:37', 1, '::1'),
(15, 'safdasdfsdf', NULL, NULL, '1A621412-5456-45CC-B6AB-DA24CDEC4B3F', 'sdfsdssdfdfdfsdffsfsdfsdsd', '3BCgj8uPxN5y', 'befgsfdsddfsfdsnsdsfdsdsd@test.com', NULL, NULL, NULL, NULL, 'sdfsdf', NULL, 'SKs9D12WVNymgaerzc6pGBoRYqXOAHd5ETl04tuJMwnvIbFik8.jpg', 1, 'dev_team', 0, 0, 0, 0, 0, 'I', NULL, NULL, NULL, '2016-02-25 15:26:37', 1, '::1'),
(16, 'sdasdasdadas', NULL, NULL, '80A33D2D-0DEE-41E3-8E66-8CDFEFE5B506', 'sdfsfsfsdfAwerer', 'pxsuYklonA8K', 'asdadadbefgsfdsn@test.com', NULL, NULL, NULL, NULL, '', NULL, '', 1, 'dev_team', 0, 0, 0, 0, 0, 'I', '2016-02-10 00:00:00', 127, '192.168.2.69', '2016-02-25 15:26:37', 1, '::1'),
(17, 'sdsddsfdsf', NULL, NULL, '42348704-1047-4740-A39D-09ABBF6828F5', 'sdfsdfsdfsdf', 'EC9OJkhqoe6t', 'teSdsfsdfsdfDFsrFERTst@test.com', NULL, NULL, NULL, NULL, '', NULL, '', 1, 'dev_team', 0, 0, 0, 0, 0, 'A', '0000-00-00 00:00:00', 127, '192.168.2.69', '2016-02-25 15:27:51', 1, '::1'),
(18, '76t6yutuy', NULL, NULL, '30824627-0697-42DA-92A4-42D5052F9D1F', 'sdfsdfsdfs', 'yHaSEr7MQlYj', 'besdfa3qsdasdn@test.com', NULL, NULL, NULL, NULL, '', NULL, '7Nesd5QwA0oVhZjJWbaKrS3vDn8RkyFcCEtIl2uzBMfPTGO9g4.jpg', 1, 'dev_team', 0, 0, 0, 0, 0, 'A', '2016-02-23 07:00:01', 1, '192.168.2.69', '2016-02-25 12:33:45', 1, '::1'),
(19, 'dfdfdf', NULL, NULL, 'C55A1B32-8528-4904-A4DE-014BBBD7E25A', 'company1', 'ebGxtQPlgTcS', 'befgsfdasdsaddsn@test.coms', NULL, NULL, NULL, NULL, 'sadasd', NULL, '', 1, 'dev_team', 0, 0, 0, 0, 0, 'A', '2016-02-24 14:57:45', 1, '::1', '2016-02-25 12:33:45', 1, '::1'),
(20, 'asdfasdf@test.com', NULL, NULL, '5EDD37F8-C97A-4098-AB0A-5F8D15352030', 'asdfasdf@test.com', 'ciW9ULZCGxRr', 'asdfasdf@test.com', NULL, NULL, NULL, NULL, 'asdfasdf@test.com', NULL, '', 0, 'dev_team', 0, 0, 0, 0, 0, 'D', '2016-02-25 06:44:11', 1, '192.168.2.113', '2016-02-25 07:46:27', 1, '::1'),
(21, 'Pastamania', NULL, NULL, 'ECD89DE9-6378-4876-9A1A-04126A0D6D19', 'Pastamania', 'SHUNh58AtuQ0', 'Pastamania@test.com', NULL, NULL, NULL, NULL, '', NULL, 'qjd7kVDEwS3HP9t2YQLTaoyeGflIbZXcgAzWKpRxshBir416nM.jpg', 1, 'dev_team', 0, 0, 0, 0, 0, 'D', '2016-02-25 10:55:43', 1, '::1', NULL, NULL, NULL),
(22, 'asdasdasd', NULL, NULL, '2D3DF154-2820-4D1B-91FE-3DDB297A2898', 'asdasdasd', 'JMBPD2uzfoEZ', 'tesdasdst@test.com', NULL, NULL, NULL, NULL, 'asdasd', NULL, '', 1, 'dev_team', 0, 0, 0, 0, 0, 'I', '2016-02-25 10:55:59', 1, '::1', '2016-02-25 12:39:38', 1, '192.168.2.65'),
(23, 'sdasa', NULL, NULL, '2F5FCE42-67B6-4903-B97B-162C706FEE2F', 'dsafsadfsdf', 'NK2XlD5oevnE', 'tesdfsdfsst@test.com', NULL, NULL, NULL, NULL, 'sdfs', NULL, '', 1, 'dev_team', 0, 0, 0, 0, 0, 'A', '2016-02-25 12:57:38', 1, '::1', NULL, NULL, NULL),
(24, 'sdsd', NULL, NULL, 'EF42BE79-2EB1-4AB6-BA40-85D3D6BED248', 'sadasd', '5BpONGjmFkUq', 'sadasdasdasd@test.com', NULL, NULL, NULL, NULL, 'sdsdsd', NULL, '', 1, 'dev_team', 0, 0, 0, 0, 0, 'A', '2016-02-25 13:03:48', 1, '::1', NULL, NULL, NULL),
(25, 'asdasd', NULL, NULL, '6F9F904C-8BEB-4E79-8543-636C6D380C82', 'asdasdasdsdasd', 'MKFWaI4l093x', 'test@test.comsa', NULL, NULL, NULL, NULL, '', NULL, '', 1, 'dev_team', 0, 0, 0, 0, 0, 'A', '2016-02-25 13:05:04', 1, '::1', '2016-02-25 15:27:41', 1, '::1'),
(26, 'asdfasf', NULL, NULL, 'E4F99743-4AAC-4F15-88B1-30B40D3A7251', 'testing', 'xX0mFcOH6J49', 'asdfasd@gmail.com', NULL, NULL, NULL, NULL, 'asdfasdf', NULL, '', 1, 'dev_team', 0, 0, 0, 0, 0, 'I', '2016-02-25 13:09:09', 1, '192.168.2.113', '2016-02-25 15:26:53', 1, '::1'),
(27, 'dsfsdfsd', NULL, NULL, '0D82734F-444A-4E5C-B131-758C9A9237A0', 'fsdfsdfsdf', '9t1DRTS7lIqU', 'sadasdfsdfdasdasd@test.com', NULL, NULL, NULL, NULL, '', NULL, '', 1, 'dev_team', 0, 0, 0, 0, 0, 'I', '2016-02-25 13:22:40', 1, '::1', '2016-02-25 15:26:53', 1, '::1'),
(28, 'sdasa', NULL, NULL, '68FF9C3E-05C3-417D-8AD9-002C51103CD9', 'qweqwe', 'JcWhtVY3E7Qj', 'tewqeqwest@test.com', NULL, NULL, NULL, NULL, '', NULL, '', 1, 'dev_team', 0, 0, 0, 0, 0, 'I', '2016-02-25 13:24:44', 1, '::1', '2016-02-25 15:26:53', 1, '::1'),
(29, 'nick2', NULL, NULL, '9827DFF8-DDB4-4C5C-A8AD-9569373544D9', 'nickname', 'XTPpy3an0ACN', 'Tewqeqwest@test.com', NULL, NULL, NULL, NULL, '', NULL, '', 2, 'dev_team', 0, 0, 0, 0, 0, 'A', '2016-02-25 14:26:42', 1, '::1', '2016-02-26 07:54:10', 1, '::1'),
(30, 'Dev admin', NULL, NULL, '46829B35-3C9B-4359-BE81-57D135D98C8D', 'adminuser', '0lJECnaIjVfP', 'admin@123.com', NULL, NULL, NULL, NULL, 'advsdsd', NULL, 'SsBcQn2d8yP36WqYOHvh1bfUrt0AIEjZiCzpgaGFM95kw4leXu.jpg', 2, 'dev_team', 0, 0, 0, 0, 0, 'A', '2016-02-26 07:57:24', 1, '::1', '2016-02-26 07:59:51', 1, '::1'),
(31, 'admin2', NULL, NULL, '61FD6302-A22D-4B8A-B806-ABB52FFFEEB6', 'adminuser2', 'Fv4mg5eSqbDo', 'Admin2@123.com', NULL, NULL, NULL, NULL, 'dfsdf', NULL, 'HQIX8ckPEe3OLz5wgGKA19FxYyfmqiJ2udS4rC7av0pbTN6joh.jpg', 2, 'dev_team', 0, 0, 0, 0, 0, 'A', '2016-02-26 07:57:47', 1, '::1', '2016-03-01 05:37:55', 1, '::1'),
(32, 'kkkkkkkk', NULL, NULL, 'E8C15A2B-5355-4F4F-A04D-CCA6BFA6DA81', 'asdasdasdsadasd', 'SlCDvoXumybP', 'kkkkkkk@123.com', NULL, NULL, NULL, NULL, 'kkkkkkkkkk', NULL, 'Mr20b9uSacqIBPJgyhLNlw3GdK1F7neDVHOk4AifzC5xsmjUoE.jpg', 2, 'dev_team', 0, 0, 0, 0, 0, 'A', '2016-02-26 08:00:12', 1, '::1', '2016-02-26 08:14:51', 1, '::1'),
(33, 'testing_client_admin', 'testing', 'testing', '123123', 'admin', '$2a$08$RLbVYes/SDUgUxbwxAbgX.FAyPqFX5ZgkEtJmRD4UkgSkYm0S4kS.', 'rmarktest4@gmail.com', 'test', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 'A', NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'My Test Company', NULL, NULL, '44801142-949F-49D6-AC55-B55B0291F387', 'Subhashraj', 'ep0YtVAT2bqB', 'tksubhashraj14@gmail.com', NULL, NULL, NULL, NULL, 'tasdasdasd', NULL, '', 2, 'b2WoIkTMPUjvsFuSifCx7L0dVcJt6H5ZOAqXRY3wGln8yB1Epm', 0, 0, 0, 0, 0, 'D', '2016-03-01 05:21:02', 1, '::1', NULL, NULL, NULL),
(35, 'My Test Company2', NULL, NULL, 'BB49847A-F539-4C44-996E-1DB1B33928E6', 'tetstssss', '0lqBsvAtCu3I', 'test@gmail.com', NULL, NULL, NULL, NULL, 'asdasd', NULL, '', 2, 'ZKlN0XsRChUBYOnfGkMQtdLruzDV3xv6qPmiFajAeSWcyb927I', 0, 0, 0, 0, 0, 'D', '2016-03-01 05:25:43', 1, '::1', NULL, NULL, NULL),
(36, 'Teasdasd', NULL, NULL, '3D1190C2-1B76-41C4-BD4E-B5B398EFCEEF', 'asdasdasda', '0QcpF71XWtD4', 'sdasdas@gmail.com', NULL, NULL, NULL, NULL, 'asdasd', NULL, 'P0wklb6KfI9xQ3T1iBMnYWpF7hjSqHtcNZorL5sgD8eymaRzUG.jpg', 2, 'dev_team', 0, 0, 0, 0, 0, 'A', '2016-03-01 05:32:14', 1, '::1', NULL, NULL, NULL),
(37, 'sdfsdf', NULL, NULL, '84876513-43E7-4FBA-B9BD-439C884BE658', 'dsfsdfsdfsd', '8gUYvocJLOBa', 'fsdfsdfsdfsd@fgmail.com', NULL, NULL, NULL, NULL, 'fhhhhhhhhhhhhhhfdsafasdf', NULL, 'KLg7CvfItirkoRwP8e6Vuc4MWYDTx3EnHN5OXByA201SmlFasp.jpg', 1, 'dev_team', 0, 0, 0, 0, 0, 'A', '2016-03-01 05:40:32', 1, '::1', '2016-03-03 14:24:07', 1, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `afsys_client_categories`
--

CREATE TABLE `afsys_client_categories` (
  `cate_id` bigint(20) NOT NULL,
  `cate_name` varchar(100) DEFAULT NULL,
  `cate_status` enum('A','I') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `afsys_client_categories`
--

INSERT INTO `afsys_client_categories` (`cate_id`, `cate_name`, `cate_status`) VALUES
(1, 'Mobile Apps', 'A'),
(2, 'Web  Apps', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `afsys_master_admin`
--

CREATE TABLE `afsys_master_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(100) DEFAULT NULL,
  `admin_email_address` varchar(100) DEFAULT NULL,
  `admin_password` varchar(155) DEFAULT NULL,
  `admin_status` enum('A','I') NOT NULL DEFAULT 'I',
  `admin_pass_key` varchar(50) DEFAULT NULL,
  `admin_updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `afsys_master_admin`
--

INSERT INTO `afsys_master_admin` (`admin_id`, `admin_username`, `admin_email_address`, `admin_password`, `admin_status`, `admin_pass_key`, `admin_updated_on`) VALUES
(1, 'admin', 'tksubhashraj14@gmail.com', '$2a$08$RLbVYes/SDUgUxbwxAbgX.FAyPqFX5ZgkEtJmRD4UkgSkYm0S4kS.', 'A', NULL, '2016-02-02 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `afsys_master_admin_login_history`
--

CREATE TABLE `afsys_master_admin_login_history` (
  `login_id` bigint(20) NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `login_ip` varchar(20) DEFAULT NULL,
  `login_admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `afsys_master_admin_login_history`
--

INSERT INTO `afsys_master_admin_login_history` (`login_id`, `login_time`, `login_ip`, `login_admin_id`) VALUES
(12, '2016-02-19 13:10:46', '::1', 1),
(13, '2016-02-19 13:48:45', '::1', 1),
(14, '2016-02-19 15:36:28', '::1', 1),
(15, '2016-02-20 06:55:26', '::1', 1),
(16, '2016-02-20 10:45:49', '::1', 1),
(17, '2016-02-20 10:48:13', '::1', 1),
(18, '2016-02-22 06:16:15', '::1', 1),
(19, '2016-02-22 07:59:41', '::1', 1),
(20, '2016-02-22 10:05:35', '192.168.2.65', 1),
(21, '2016-02-22 14:44:36', '127.0.0.1', 1),
(22, '2016-02-22 14:57:39', '127.0.0.1', 1),
(23, '2016-02-22 10:52:19', '::1', 1),
(24, '2016-02-22 10:52:55', '::1', 1),
(25, '2016-02-22 10:53:28', '::1', 1),
(26, '2016-02-22 10:55:29', '::1', 1),
(27, '2016-02-22 10:55:49', '::1', 1),
(28, '2016-02-22 15:41:23', '127.0.0.1', 1),
(29, '2016-02-23 05:42:04', '192.168.2.69', 1),
(30, '2016-02-23 06:35:16', '192.168.2.69', 1),
(31, '2016-02-23 06:38:49', '192.168.2.69', 1),
(32, '2016-02-24 05:58:47', '::1', 1),
(33, '2016-02-24 06:05:36', '::1', 1),
(34, '2016-02-24 06:06:08', '::1', 1),
(35, '2016-02-24 06:07:19', '::1', 1),
(36, '2016-02-24 10:17:29', '::1', 1),
(37, '2016-02-24 10:45:13', '192.168.2.113', 1),
(38, '2016-02-24 11:04:21', '::1', 1),
(39, '2016-02-24 11:21:19', '::1', 1),
(40, '2016-02-24 11:54:32', '192.168.2.113', 1),
(41, '2016-02-24 11:56:30', '192.168.2.113', 1),
(42, '2016-02-24 12:02:27', '192.168.2.113', 1),
(43, '2016-02-24 12:50:55', '::1', 1),
(44, '2016-02-24 13:00:39', '192.168.2.113', 1),
(45, '2016-02-24 13:02:58', '192.168.2.113', 1),
(46, '2016-02-24 13:03:23', '192.168.2.113', 1),
(47, '2016-02-24 13:09:58', '192.168.2.113', 1),
(48, '2016-02-24 13:11:38', '192.168.2.113', 1),
(49, '2016-02-24 14:01:35', '192.168.2.113', 1),
(50, '2016-02-24 15:04:45', '192.168.2.113', 1),
(51, '2016-02-24 15:08:49', '192.168.2.113', 1),
(52, '2016-02-24 15:30:37', '192.168.2.113', 1),
(53, '2016-02-25 06:17:48', '::1', 1),
(54, '2016-02-25 06:21:35', '192.168.2.113', 1),
(55, '2016-02-25 07:28:55', '192.168.2.65', 1),
(56, '2016-02-25 08:17:53', '192.168.2.65', 1),
(57, '2016-02-25 08:39:54', '192.168.2.113', 1),
(58, '2016-02-25 09:43:07', '192.168.2.65', 1),
(59, '2016-02-25 10:52:51', '192.168.2.113', 1),
(60, '2016-02-25 13:21:58', '192.168.2.113', 1),
(61, '2016-02-25 15:21:06', '::1', 1),
(62, '2016-02-26 06:06:42', '::1', 1),
(63, '2016-02-26 06:20:21', '::1', 1),
(64, '2016-02-26 13:02:30', '127.0.0.1', 1),
(65, '2016-02-26 09:08:35', '192.168.2.65', 1),
(66, '2016-03-01 05:13:55', '::1', 1),
(67, '2016-03-01 07:21:24', '::1', 1),
(68, '2016-03-01 07:39:01', '::1', 1),
(69, '2016-03-01 08:04:48', '::1', 1),
(70, '2016-03-01 18:08:43', '::1', 1),
(71, '2016-03-02 16:36:24', '::1', 1),
(72, '2016-03-02 16:54:53', '::1', 1),
(73, '2016-03-02 18:30:56', '::1', 1),
(74, '2016-03-03 03:19:57', '::1', 1),
(75, '2016-03-03 14:23:46', '::1', 1),
(76, '2016-03-04 04:45:31', '::1', 1),
(77, '2016-03-04 17:30:19', '::1', 1),
(78, '2016-03-04 17:35:52', '::1', 1),
(79, '2016-03-04 20:19:00', '::1', 1),
(80, '2016-03-05 02:26:54', '::1', 1),
(81, '2016-03-05 17:46:16', '::1', 1),
(82, '2016-03-05 19:09:20', '1.39.60.155', 1),
(83, '2016-03-06 10:58:12', '1.39.63.182', 1),
(84, '2016-03-06 19:30:15', '1.39.60.147', 1),
(85, '2016-03-06 19:48:54', '1.39.60.147', 1),
(86, '2016-03-06 20:01:04', '175.136.214.244', 1),
(87, '2016-03-06 21:09:04', '1.39.63.170', 1),
(88, '2016-03-06 22:03:10', '1.39.60.77', 1),
(89, '2016-03-07 00:46:27', '1.39.60.77', 1),
(90, '2016-03-12 09:40:46', '1.39.80.35', 1),
(91, '2016-03-21 09:01:54', '113.193.147.168', 1),
(92, '2016-03-25 05:18:47', '60.52.64.71', 1),
(93, '2016-04-07 04:26:25', '14.140.167.94', 1),
(94, '2016-07-27 13:29:08', '122.174.67.249', 1),
(95, '2016-07-27 14:07:12', '108.247.232.35', 1),
(96, '2016-10-19 04:32:13', '182.65.99.183', 1),
(97, '2016-11-09 06:07:32', '::1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `afsys_referral`
--

CREATE TABLE `afsys_referral` (
  `ref_id` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `ref_friend_name` varchar(55) NOT NULL,
  `ref_friend_email` varchar(55) NOT NULL,
  `ref_email_status` tinyint(2) NOT NULL DEFAULT '0',
  `ref_created_on` datetime NOT NULL,
  `ref_created_ip` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `afsys_referral`
--

INSERT INTO `afsys_referral` (`ref_id`, `ref_user_id`, `ref_friend_name`, `ref_friend_email`, `ref_email_status`, `ref_created_on`, `ref_created_ip`) VALUES
(17, 23, 'msaudasdasd', 'tksubhashraj14@gmail.com', 1, '2016-03-05 13:31:12', '1.39.61.77'),
(18, 31, 'Gshs', 'Kvinothmsc@gmail.com', 1, '2016-03-05 22:25:21', '66.249.82.91'),
(19, 32, 'subhash', 'tksubhashraj14@gmail.com', 1, '2016-03-06 18:31:50', '1.39.60.147'),
(20, 32, 'Bose', 'tksubhashraj@gmail.com', 1, '2016-03-06 18:31:51', '1.39.60.147'),
(21, 32, 'Rajesh', 'rajeshkali4580@gmail.com', 1, '2016-03-06 18:31:51', '1.39.60.147'),
(22, 33, 'Mohamed', 'mdibram89@gmail.com', 1, '2016-03-06 19:25:11', '1.39.60.147'),
(23, 34, 'tester 2', 'test@justmobileinc.com', 1, '2016-03-06 20:04:45', '175.136.214.244'),
(24, 38, 'teasdasd', 'testgh@gmail.com', 1, '2016-04-07 04:25:35', '14.140.167.94'),
(25, 38, 'sunbashd', 'asdasd@gamil.com', 1, '2016-04-07 04:25:35', '14.140.167.94'),
(26, 38, 'asdasdasd', 'dddssss@gmail.comasd', 1, '2016-04-07 04:25:36', '14.140.167.94');

-- --------------------------------------------------------

--
-- Table structure for table `afsys_site_setting`
--

CREATE TABLE `afsys_site_setting` (
  `setting_id` int(11) NOT NULL,
  `setting_key` varchar(55) NOT NULL,
  `setting_value` text NOT NULL,
  `setting_modify_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `afsys_site_setting`
--

INSERT INTO `afsys_site_setting` (`setting_id`, `setting_key`, `setting_value`, `setting_modify_date`) VALUES
(1, 'mail_from_name', 'Affilate System', '2016-03-05 03:29:06'),
(2, 'from_email', 'admin<admin>', '2016-03-05 03:29:06'),
(3, 'to_email', 'tksubhashraj14@gmail.com', '2016-03-05 03:29:06'),
(4, 'mail_subject', 'You are referred by [USER_NAME]', '2016-03-05 03:29:06'),
(5, 'email_template', 'Hi [FRIEND_NAME], Your friend referred this site, Please register this site [CLICK_HERE] you will get more points. Thank You!', '2016-03-05 03:29:06'),
(6, 'login_points', '10', '2016-03-05 03:29:06'),
(7, 'new_user_points', '50', '2016-03-05 03:29:06'),
(8, 'referral_points', '20', '2016-03-05 03:29:06'),
(9, 'referred_user_register_points', '30', '2016-03-05 03:29:06'),
(10, 'submit', 'Submit', '2016-03-05 03:29:06'),
(11, 'action', 'settings', '2016-03-05 03:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `afsys_users`
--

CREATE TABLE `afsys_users` (
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(155) DEFAULT NULL,
  `user_username` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_email_address` varchar(255) DEFAULT NULL,
  `user_referral_id` varchar(255) DEFAULT NULL,
  `user_company_name` varchar(255) DEFAULT NULL,
  `user_address_line1` varchar(255) DEFAULT NULL,
  `user_address_line2` varchar(255) DEFAULT NULL,
  `user_postal_code` varchar(255) DEFAULT NULL,
  `user_info` text,
  `user_date_format` varchar(20) DEFAULT NULL,
  `user_profile_image` varchar(100) DEFAULT NULL,
  `user_credit_points` int(11) NOT NULL,
  `user_referred_by` int(11) DEFAULT NULL,
  `user_folder_name` varchar(50) DEFAULT NULL,
  `user_brand_enable` tinyint(1) NOT NULL DEFAULT '0',
  `user_beacon_enable` tinyint(1) NOT NULL DEFAULT '0',
  `user_loyality_enable` tinyint(1) NOT NULL DEFAULT '0',
  `user_gift_enable` tinyint(1) NOT NULL DEFAULT '0',
  `user_whishlist_enable` tinyint(1) NOT NULL DEFAULT '0',
  `user_status` enum('A','I','D') NOT NULL DEFAULT 'I' COMMENT 'A-active, I- Inactive, D-Deleted',
  `user_created_on` datetime DEFAULT NULL,
  `user_created_ip` varchar(20) DEFAULT NULL,
  `user_updated_by` int(11) NOT NULL,
  `user_updated_on` datetime DEFAULT NULL,
  `user_updated_ip` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `afsys_users`
--

INSERT INTO `afsys_users` (`user_id`, `user_name`, `user_username`, `user_password`, `user_email_address`, `user_referral_id`, `user_company_name`, `user_address_line1`, `user_address_line2`, `user_postal_code`, `user_info`, `user_date_format`, `user_profile_image`, `user_credit_points`, `user_referred_by`, `user_folder_name`, `user_brand_enable`, `user_beacon_enable`, `user_loyality_enable`, `user_gift_enable`, `user_whishlist_enable`, `user_status`, `user_created_on`, `user_created_ip`, `user_updated_by`, `user_updated_on`, `user_updated_ip`) VALUES
(32, 'mytest', 'mytest', '$2a$08$sACiqFX310nbuaLp6nfuFugrqOPRzM5VzWzVUoK1cr.T.y93ufuTu', 'mytest@gmail.com', '4F6C07F2', NULL, NULL, NULL, NULL, 'I am a Php developer', NULL, 'xCVglnYctXfkPHpJvNFK9AE16shwO5Gz87ToS4IuaZMWiLDd2r.jpg', 170, 0, 'f0Zkx1BMgqFRLG2O4uzTDltmHUEeWwa76cSVs5NyPhjn9KpIJA', 0, 0, 0, 0, 0, 'A', '2016-03-06 18:29:43', '1.39.60.147', 1, '2016-03-06 19:52:32', '1.39.60.147'),
(33, 'Subhash Raj', 'subhash', '$2a$08$TH0ZajfTLnjZBgCM5US/hujrqbItbPwrI01fkNWa/iHYfGXdgh.r.', 'tksubhashraj14@gmail.com', '5A5CA5DB', NULL, NULL, NULL, NULL, 'I am webdeveloper', NULL, 'WQ0H95ACu2qjyvgFRxL3KmesMtcDwaENdP1k8pIh6BlXOfGozZ.jpg', 80, 32, 'iSObeVLjgmT3ZGD9dqaPHMfCBkh5cyRznAJE0ItUvWQNw61rYo', 0, 0, 0, 0, 0, 'A', '2016-03-06 18:56:59', '1.39.60.147', 1, '2016-03-06 19:47:22', '1.39.60.147'),
(34, 'Test', 'tester', '$2a$08$DugIeYKxISG58iteGW4r/O1Eunj42jZrHhNHTK4TN3vh/VobrEZya', 'ain@justmobileinc.com', '8A424551', NULL, NULL, NULL, NULL, '', NULL, '', 100, 0, 'PmlSYpx9BMDq8jL5kbNaTzowG4i0KRVXhJOCF3dv7eAcr6UtsE', 0, 0, 0, 0, 0, 'A', '2016-03-06 20:02:37', '175.136.214.244', 1, '2016-11-09 06:13:39', '::1'),
(35, 'tester 2', 'tester2', '$2a$08$cHgVMvH2NcbYQTiZdftxqOWUbD7KoFf9tEk/Tfsix3FYBJyS1gZva', 'test@justmobileinc.com', '7FCF5F25', NULL, NULL, NULL, NULL, '', NULL, '', 50, 34, '4r5cQAa9qef6THyFv1mdNuRCpZxDOitYn8PsLjKhwoXIB7Vl20', 0, 0, 0, 0, 0, 'A', '2016-03-06 20:07:06', '175.136.214.244', 1, '2016-11-09 06:13:39', '::1'),
(36, 'vijayabharathi', 'bharathi', '$2a$08$DN0bYqz2kflnH/VUnO3QOutgthGVpGmlXPY2M9qWposBnf2M461Am', 'vijayabharathi91@gmail.com', '6DEFCE97', NULL, NULL, NULL, NULL, 'No one is going to hand me success. I must go out & get it myself.', NULL, 'iem904NfIKQs8tSB6p31WFYqJZGVbruLxOavzClw7jnoycHghR.jpg', 50, 0, 'vpu4TkHc02lnJM6ejqZULDXV3WmryOs1hoSG9xQPEFbRNBfA8I', 0, 0, 0, 0, 0, 'A', '2016-03-06 23:28:30', '122.174.182.118', 1, '2016-11-09 06:13:39', '::1'),
(37, 'Burhan', 'Khalib', '$2a$08$LKfkiW5Lb7yxG2/5VA0kqOUBfOqYrTkqDxXAq1aVkFuqMOESlH8pW', 'burhan@fanxt.com', '1F563298', NULL, NULL, NULL, NULL, 'great', NULL, 'J43rzDb8gPNivcwhI9TjA7fXy6toOR201EQlqVnapULZYsdWCM.png', 50, 0, 'thLGA0yFS91olVxs5KMOHY2fWm6vJqXaZTjpriezPEgBNdw7DC', 0, 0, 0, 0, 0, 'A', '2016-03-07 18:17:35', '175.136.214.244', 1, '2016-11-09 06:13:39', '::1'),
(38, 'subhash', 'subhashraj', '$2a$08$SHcm9nAIX6.V5ObHdYRiseAzPI.emCJ.x4S16LiGVp6gIHvmSWUPi', 'tksubhashraj124@gmail.com', 'EE067168', NULL, NULL, NULL, NULL, '', NULL, 'huEw69735pBVySLCZjdleosMFTnX1N2cQJfbYqOmvRG0iUgWK8.jpg', 140, 0, '0tgjhFdacrZTemfsHnQEAX9NvMGzYIbSB7kPRJ6i1LD2l5pWoV', 0, 0, 0, 0, 0, 'A', '2016-04-07 04:23:55', '14.140.167.94', 1, '2016-11-09 06:13:39', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `afsys_user_login_history`
--

CREATE TABLE `afsys_user_login_history` (
  `login_id` bigint(20) NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `login_ip` varchar(20) DEFAULT NULL,
  `login_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `afsys_user_login_history`
--

INSERT INTO `afsys_user_login_history` (`login_id`, `login_time`, `login_ip`, `login_user_id`) VALUES
(1, '2016-02-22 15:47:42', '127.0.0.1', 1),
(2, '2016-02-26 13:03:22', '127.0.0.1', 33),
(3, '2016-03-03 08:37:19', '::1', 5),
(4, '2016-03-03 08:37:55', '::1', 5),
(5, '2016-03-03 13:42:03', '::1', 5),
(6, '2016-03-03 13:53:03', '::1', 5),
(7, '2016-03-03 14:36:10', '::1', 5),
(8, '2016-03-04 05:03:31', '::1', 9),
(9, '2016-03-04 05:57:57', '::1', 9),
(10, '2016-03-04 20:14:21', '::1', 9),
(11, '2016-03-05 02:55:55', '::1', 9),
(12, '2016-03-05 03:30:04', '::1', 9),
(13, '2016-03-05 03:36:53', '::1', 9),
(14, '2016-03-05 04:12:28', '::1', 9),
(15, '2016-03-05 04:25:27', '::1', 9),
(16, '2016-03-05 05:03:43', '::1', 9),
(17, '2016-03-05 05:31:19', '::1', 9),
(18, '2016-03-05 17:17:21', '::1', 19),
(19, '2016-03-05 17:21:52', '::1', 19),
(20, '2016-03-05 17:28:45', '::1', 19),
(21, '2016-03-05 19:01:49', '::1', 9),
(22, '2016-03-05 13:29:38', '1.39.61.77', 23),
(23, '2016-03-06 18:43:59', '1.39.60.147', 32),
(24, '2016-03-06 19:05:02', '1.39.60.147', 32),
(25, '2016-03-06 19:17:03', '1.39.60.147', 33),
(26, '2016-03-06 19:52:32', '1.39.60.147', 32),
(27, '2016-05-02 11:47:45', '182.65.214.75', 38),
(28, '2016-10-19 04:33:13', '182.65.99.183', 38),
(29, '2016-11-07 11:31:52', '::1', 38);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `afsys_clients`
--
ALTER TABLE `afsys_clients`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `client_username` (`client_username`),
  ADD KEY `client_password` (`client_password`),
  ADD KEY `client_email_address` (`client_email_address`),
  ADD KEY `client_whishlist_enable` (`client_whishlist_enable`),
  ADD KEY `client_app_id` (`client_app_id`);

--
-- Indexes for table `afsys_client_categories`
--
ALTER TABLE `afsys_client_categories`
  ADD PRIMARY KEY (`cate_id`),
  ADD KEY `cate_name` (`cate_name`,`cate_status`);

--
-- Indexes for table `afsys_master_admin`
--
ALTER TABLE `afsys_master_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `admin_username` (`admin_username`),
  ADD KEY `admin_password` (`admin_password`),
  ADD KEY `admin_ststus` (`admin_status`);

--
-- Indexes for table `afsys_master_admin_login_history`
--
ALTER TABLE `afsys_master_admin_login_history`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `afsys_referral`
--
ALTER TABLE `afsys_referral`
  ADD PRIMARY KEY (`ref_id`);

--
-- Indexes for table `afsys_site_setting`
--
ALTER TABLE `afsys_site_setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `afsys_users`
--
ALTER TABLE `afsys_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `afsys_user_login_history`
--
ALTER TABLE `afsys_user_login_history`
  ADD PRIMARY KEY (`login_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `afsys_clients`
--
ALTER TABLE `afsys_clients`
  MODIFY `client_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `afsys_client_categories`
--
ALTER TABLE `afsys_client_categories`
  MODIFY `cate_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `afsys_master_admin`
--
ALTER TABLE `afsys_master_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `afsys_master_admin_login_history`
--
ALTER TABLE `afsys_master_admin_login_history`
  MODIFY `login_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `afsys_referral`
--
ALTER TABLE `afsys_referral`
  MODIFY `ref_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `afsys_site_setting`
--
ALTER TABLE `afsys_site_setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `afsys_users`
--
ALTER TABLE `afsys_users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `afsys_user_login_history`
--
ALTER TABLE `afsys_user_login_history`
  MODIFY `login_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
