-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 08, 2017 at 03:05 PM
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
-- Table structure for table `default_leftmenus`
--

DROP TABLE IF EXISTS `default_leftmenus`;
CREATE TABLE `default_leftmenus` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(200) NOT NULL,
  `menu_slug` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0-Pending,1-Active,2-Ignored,3-Stop,4-Pause'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_leftmenus`
--

INSERT INTO `default_leftmenus` (`id`, `menu_name`, `menu_slug`, `created_on`, `status`) VALUES
(1, 'Users', 'users', '2017-03-08 00:00:00', 1),
(2, 'User Type', 'user-type', '2017-03-08 00:00:00', 1),
(3, 'Departments', 'departments', '2017-03-08 00:00:00', 1),
(4, 'Projects', 'projects', '2017-03-08 00:00:00', 1),
(5, 'Tasks', 'tasks', '2017-03-08 00:00:00', 1),
(6, 'Settings', 'settings', '2017-03-08 00:00:00', 1),
(7, 'Edit Profile', 'edit-profile', '2017-03-08 00:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `default_leftmenus`
--
ALTER TABLE `default_leftmenus`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `default_leftmenus`
--
ALTER TABLE `default_leftmenus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
