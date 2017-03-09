-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 09, 2017 at 08:37 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.24

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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_type_id` bigint(20) NOT NULL COMMENT 'refer from user_type table',
  `user_name` varchar(200) NOT NULL,
  `user_pass` varchar(300) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_slug` varchar(200) NOT NULL,
  `user_emp_code` varchar(50) NOT NULL,
  `user_departments_id` bigint(20) NOT NULL COMMENT 'refer from departments table',
  `user_mobile` varchar(50) NOT NULL,
  `user_dob` date NOT NULL,
  `user_address` varchar(300) NOT NULL,
  `user_access_menus_id` varchar(300) NOT NULL COMMENT 'refer from default_leftmenus table',
  `user_access_menus_details` text NOT NULL,
  `user_country` bigint(20) NOT NULL COMMENT 'refer from country table',
  `user_state` bigint(20) NOT NULL COMMENT 'refer from state table',
  `user_city` bigint(20) NOT NULL COMMENT 'refer from city table',
  `user_details` text NOT NULL COMMENT 'json values for country,state and city name and slug',
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_ip` bigint(20) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0-Pending,1-Active,2-Ignored,3-Blocked'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type_id`, `user_name`, `user_pass`, `user_email`, `user_slug`, `user_emp_code`, `user_departments_id`, `user_mobile`, `user_dob`, `user_address`, `user_access_menus_id`, `user_access_menus_details`, `user_country`, `user_state`, `user_city`, `user_details`, `created_on`, `updated_on`, `created_ip`, `created_by`, `status`) VALUES
(1, 1, 'Super Admin', 'e10adc3949ba59abbe56e057f20f883e', 'superadmin@gmail.com', 'super-admin', '', 9999, '9944668971', '2017-03-08', 'Chennai', '', '', 109, 28, 144, '', '2017-03-08 00:00:00', '2017-03-08 00:00:00', 5545454848484, 1, 1),
(2, 6, 'Sankar', 'e10adc3949ba59abbe56e057f20f883e', 'sankar@gmail.com', 'sankargmailcom', '', 5, '9876543210', '2017-03-09', 'Chennai', '5,6,7', '{"menu_details":[{"name":"Tasks","slug":"tasks","id":"5"},{"name":"Settings","slug":"settings","id":"6"},{"name":"Edit Profile","slug":"edit-profile","id":"7"}]}', 109, 28, 456, '{"countries":{"id":"109","name":"India"},"states":{"id":"28","name":"Tamil Nadu","slug":"tamil-nadu"},"cities":{"id":"456","name":"Chennai","slug":"chennai"}}', '2017-03-08 16:08:42', '0000-00-00 00:00:00', 0, 4, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
