-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2017 at 01:33 PM
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
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(20) NOT NULL,
  `name` varchar(300) NOT NULL,
  `slug` varchar(300) NOT NULL,
  `menuicon` varchar(250) NOT NULL,
  `menulink` text NOT NULL,
  `menusort` bigint(20) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_ip` bigint(20) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL COMMENT '0-pending, 1-active, 2-ignore'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `menuicon`, `menulink`, `menusort`, `parent_id`, `created_by`, `created_ip`, `created_on`, `status`) VALUES
(1, 'Users', 'users', 'fa-user', 'none', 2, 0, 1, 0, '2017-03-20 09:47:49', 1),
(2, 'User Type', 'user-type', 'fa-cube', 'none', 3, 0, 1, 0, '2017-03-20 09:48:25', 1),
(3, 'Departments', 'departments', 'fa-cubes', 'none', 4, 0, 1, 0, '2017-03-20 09:48:54', 1),
(4, 'Projects', 'projects', 'fa-life-ring', 'none', 5, 0, 1, 0, '2017-03-20 09:49:33', 1),
(5, 'Tasks', 'tasks', 'fa-tasks', 'none', 6, 0, 1, 0, '2017-03-20 09:50:03', 1),
(6, 'Settings', 'settings', 'fa-cog', 'none', 7, 0, 1, 0, '2017-03-20 09:50:13', 1),
(7, 'Holidays', 'holidays', 'fa-tree', 'none', 8, 0, 1, 0, '2017-03-20 09:50:26', 1),
(8, 'Email Settings', 'email-settings', 'fa-envelope', 'none', 9, 0, 1, 0, '2017-03-20 09:50:53', 1),
(9, 'SMS Settings', 'sms-settings', 'fa-mobile', 'none', 10, 0, 1, 0, '2017-03-20 09:51:04', 1),
(10, 'Reporting', 'reporting', 'fa-server', 'none', 11, 0, 1, 0, '2017-03-20 09:51:30', 1),
(11, 'Menus', 'menus', 'fa-bar-chart', 'none', 12, 0, 1, 0, '2017-03-20 09:50:42', 1),
(12, 'Add User', 'add-user', '', 'employee/add', 0, 1, 1, 0, '2017-03-20 06:04:53', 1),
(13, 'Manage Users', 'manage-users', '', 'employee', 0, 1, 1, 0, '2017-03-20 06:05:20', 1),
(14, 'Add User Type', 'add-user-type', '', 'usertype/add', 0, 2, 1, 0, '2017-03-20 06:06:09', 1),
(15, 'Manage User Type', 'manage-user-type', '', 'usertype', 0, 2, 1, 0, '2017-03-20 06:06:28', 1),
(16, 'Add Department', 'add-department', '', 'departments/add', 0, 3, 1, 0, '2017-03-20 06:07:19', 1),
(17, 'Manage Departments', 'manage-departments', '', 'departments', 0, 3, 1, 0, '2017-03-20 06:07:34', 1),
(18, 'Add Projects', 'add-projects', '', 'projects/add', 0, 4, 1, 0, '2017-03-20 06:08:25', 1),
(19, 'Manage Projects', 'manage-projects', '', 'projects/', 0, 4, 1, 0, '2017-03-20 06:08:40', 1),
(20, 'Assign Task', 'assign-task', '', 'tasks/asign', 0, 5, 1, 0, '2017-03-20 06:09:28', 1),
(21, 'Manage Assign Tasks', 'manage-assign-tasks', '', 'tasks/manage_asign_task', 0, 5, 1, 0, '2017-03-20 06:09:42', 1),
(22, 'Add Task', 'add-task', '', 'tasks/add_new_task', 0, 5, 1, 0, '2017-03-20 06:09:55', 1),
(23, 'Manage Tasks', 'manage-tasks', '', 'tasks/manage_new_task', 0, 5, 1, 0, '2017-03-20 06:10:10', 1),
(24, 'Profile Edit', 'profile-edit', '', 'profile', 0, 6, 1, 0, '2017-03-20 06:10:53', 1),
(25, 'Change Password', 'change-password', '', 'changepassword', 0, 6, 1, 0, '2017-03-20 06:11:07', 1),
(26, 'Change Email Address', 'change-email-address', '', 'emailchange', 0, 6, 1, 0, '2017-03-20 06:11:19', 1),
(27, 'Change Mobile Number', 'change-mobile-number', '', 'mobilechange', 0, 6, 1, 0, '2017-03-20 06:11:31', 1),
(28, 'Add Holiday', 'add-holiday', '', 'holidays/add', 0, 7, 1, 0, '2017-03-20 06:12:07', 1),
(29, 'Manage Holidays', 'manage-holidays', '', 'holidays', 0, 7, 1, 0, '2017-03-20 06:12:20', 1),
(30, 'Add Email', 'add-email', '', 'emailsetting/add', 0, 8, 1, 0, '2017-03-20 06:12:54', 1),
(31, 'Email Setting', 'email-setting', '', 'emailsetting', 0, 8, 1, 0, '2017-03-20 06:13:26', 1),
(32, 'Add Sms Setting', 'add-sms-setting', '', 'smssetting/add', 0, 9, 1, 0, '2017-03-20 06:14:07', 1),
(33, 'Manage Sms Setting', 'manage-sms-setting', '', 'smssetting', 0, 9, 1, 0, '2017-03-20 06:14:23', 1),
(34, 'Manage Reporting', 'manage-reporting', '', 'reporting', 0, 10, 1, 0, '2017-03-20 06:15:21', 1),
(35, 'Dashboard', 'dashboard', 'fa-gavel', 'dashboard', 1, 0, 1, 0, '2017-03-20 09:52:49', 1),
(36, 'Add Menus', 'add-menus', '', 'menus/add', 0, 11, 1, 0, '2017-03-20 09:25:54', 1),
(37, 'Manage Menus', 'manage-menus', '', 'menus', 0, 11, 1, 0, '2017-03-20 09:26:16', 1),
(38, 'Remainder', 'remainder', 'fa-bell', 'none', 13, 0, 1, 0, '2017-03-23 06:18:13', 1),
(39, 'Add Remainder', 'add-remainder', '', 'remainder/add', 0, 38, 1, 0, '2017-03-23 06:15:01', 1),
(40, 'Manage Remainder', 'manage-remainder', '', 'remainder', 0, 38, 1, 0, '2017-03-23 06:15:08', 1),
(41, 'gdgdf dfg dg', 'gdgdf-dfg-dg', 'fa-bell', 'none', 22, 0, 1, 0, '2017-03-23 10:04:29', 3),
(42, 'df ff fdgfd', 'df-ff-fdgfd', '', 'dsdsfsdf', 1, 41, 1, 0, '2017-03-23 10:01:30', 1),
(43, 'Dgdg', 'dgdg', '', 'gdsfsf', 2, 41, 1, 0, '2017-03-23 10:02:03', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
