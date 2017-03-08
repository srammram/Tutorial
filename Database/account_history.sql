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
-- Table structure for table `account_history`
--

CREATE TABLE `account_history` (
  `id` bigint(20) NOT NULL,
  `user_id` tinyint(4) NOT NULL,
  `change_type` tinyint(4) NOT NULL COMMENT '1-email,2-mobile',
  `activation_key` text NOT NULL,
  `new_one` varchar(200) NOT NULL,
  `old_one` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL,
  `expiry_datetime` datetime NOT NULL,
  `created_ip` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0-Pending,1-Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_history`
--

INSERT INTO `account_history` (`id`, `user_id`, `change_type`, `activation_key`, `new_one`, `old_one`, `created_on`, `expiry_datetime`, `created_ip`, `status`) VALUES
(1, 1, 2, '741685', '9698746280', '8675996643', '2017-03-08 12:39:00', '2017-03-08 12:39:00', 0, 1),
(2, 1, 2, '028714', '8675996643', '9698746280', '2017-03-08 12:40:16', '2017-03-08 12:40:16', 0, 1),
(3, 1, 2, '908457', '9600619919', '8675996643', '2017-03-08 14:18:58', '2017-03-08 14:18:58', 0, 1),
(4, 1, 2, '630948', '9698746280', '9600619919', '2017-03-08 15:02:35', '2017-03-08 15:02:35', 0, 1),
(5, 1, 1, 'e0dd2826aa27e02f8cbd71a50a0ff90e', 'ananthan@srammram.com', 'kalaivanan@gmail.com', '2017-03-08 16:07:12', '2017-03-08 16:07:12', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_history`
--
ALTER TABLE `account_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_history`
--
ALTER TABLE `account_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
