-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2017 at 02:44 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `sms_setting`
--

CREATE TABLE `sms_setting` (
  `id` int(11) UNSIGNED NOT NULL,
  `created_on` datetime NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` text COLLATE utf8_unicode_ci NOT NULL,
  `sms_content` text COLLATE utf8_unicode_ci,
  `sms_variable` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0-Pending,1-Active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Site Sms Templates';

--
-- Dumping data for table `sms_setting`
--

INSERT INTO `sms_setting` (`id`, `created_on`, `name`, `slug`, `sms_content`, `sms_variable`, `status`) VALUES
(2, '2017-03-07 19:49:44', 'User Mobile Active', 'user-mobile-active', 'your account active code sent to your mobile please check it. OTP : [MOBILE_OTP]', '[MOBILE_OTP]', 1),
(3, '2017-03-07 19:54:14', 'Resend OTP Sms', 'resend-otp-sms', 'Elect TV Resend sms otp code : [MOBILE_OTP]', '[MOBILE_OTP]', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sms_setting`
--
ALTER TABLE `sms_setting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sms_setting`
--
ALTER TABLE `sms_setting`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
