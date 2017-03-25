-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2017 at 06:38 AM
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
-- Table structure for table `email_setting`
--

DROP TABLE IF EXISTS `email_setting`;
CREATE TABLE `email_setting` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `from_email` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reply_to` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_content` text COLLATE utf8_unicode_ci,
  `email_variables` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0-Pending,1-Active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Site Email Templates';

--
-- Dumping data for table `email_setting`
--

INSERT INTO `email_setting` (`id`, `created`, `from_email`, `reply_to`, `name`, `slug`, `subject`, `email_content`, `email_variables`, `status`) VALUES
(1, '2017-03-08 00:00:00', 'ramaiyamani@gmail.com', 'ramaiyamani@gmail.com', 'User Account Activation', 'user-account-activation', 'User Account Activation', '<div style="width:600px; margin:0px; padding:0px; margin:0 auto; border:1px solid #656565;">\r\n<table border="0" cellpadding="0" cellspacing="0" width="600">\r\n	<tbody>\r\n		<tr>\r\n			<td align="center" style=" border-bottom:1px solid #ededed; line-height:1px; font-size:1px; background:#bbbbbb; padding: 8px; text-align: center" valign="top"><a href="[BASEURL]"><img alt="" height="" src="[LOGOURL]" width="" /></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:bold 16px Arial, Helvetica, sans-serif; color:#5D5D5D; padding-left:12px;" valign="top">Hello [NAME],</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">\r\n			<p>Activation Link <a href="[ACTIVATIONLINK]" target="_blank">[ACTIVATIONLINK]</a></p>\r\n\r\n			<p>[SITEURL]</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">Thanks &amp; Regards,<br />\r\n			Web Site Name - [SITE-TITLE]</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center" style="font:normal 11px Arial, Helvetica, sans-serif; color:#fff; background:#282828; padding:11px 0px 11px 0px; margin:15px 0px 0px 0px;border-top: 1px solid #0e5da0;" valign="top">[COPY-CONTENT]</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n', '[NAME],[ACTIVATIONLINK], [SITEURL],[SITE-TITLE]', 0),
(2, '2017-03-08 00:00:00', 'ramaiyamani@gmail.com', 'ramaiyamani@gmail.com', 'Forgot Password', 'forgot-password', 'User Forgot Password', '<div style="width:600px; margin:0px; padding:0px; margin:0 auto; border:1px solid #656565;">\r\n<table border="0" cellpadding="0" cellspacing="0" width="600">\r\n	<tbody>\r\n		<tr>\r\n			<td align="center" style=" border-bottom:1px solid #ededed; line-height:1px; font-size:1px; background:#bbbbbb; padding: 8px; text-align: center" valign="top"><a href="[BASEURL]"><img alt="" height="" src="[LOGOURL]" width="" /></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:bold 16px Arial, Helvetica, sans-serif; color:#5D5D5D; padding-left:12px;" valign="top">Hello [NAME],</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">\r\n			<p>Forgot Password Link <a href="[LINK]" target="_blank">[LINK]</a></p>\r\n\r\n			<p>[SITEURL]</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">Thanks &amp; Regards,<br />\r\n			Web Site Name - [SITE-TITLE]</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center" style="font:normal 11px Arial, Helvetica, sans-serif; color:#fff; background:#282828; padding:11px 0px 11px 0px; margin:15px 0px 0px 0px;border-top: 1px solid #0e5da0;" valign="top">[COPY-CONTENT]</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n', '[NAME],[LINK], [SITEURL],[SITE-TITLE]', 0),
(3, '2017-03-25 11:06:31', 'ramaiyamani@gmail.com', 'ramaiyamani@gmail.com', 'Registration Welcome Email', 'registration-welcome-email', NULL, '<div xss="removed">\r\n<table border="0" cellpadding="0" cellspacing="0" width="600">\r\n <tbody>\r\n  <tr>\r\n   <td align="center" valign="top" xss="removed"><a href="[BASEURL]"><img alt="" height="" src="[LOGOURL]" width=""></a></td>\r\n  </tr>\r\n  <tr>\r\n   <td align="left" valign="top" xss="removed">�</td>\r\n  </tr>\r\n  <tr>\r\n   <td align="left" valign="top" xss="removed">Hello [NAME],</td>\r\n  </tr>\r\n  <tr>\r\n   <td align="left" valign="top" xss="removed">\r\n   <p>Username : [USERNAME]</p>\r\n            <p>Password : [PASSWORD]</p>\r\n\r\n   <p>[SITEURL]</p>\r\n   </td>\r\n  </tr>\r\n  <tr>\r\n   <td align="left" valign="top" xss="removed">Thanks & Regards,<br>\r\n   Web Site Name - [SITE-TITLE]</td>\r\n  </tr>\r\n  <tr>\r\n   <td align="left" valign="top" xss="removed">�</td>\r\n  </tr>\r\n  <tr>\r\n   <td align="center" valign="top" xss="removed">[COPY-CONTENT]</td>\r\n  </tr>\r\n </tbody>\r\n</table>\r\n</div>\r\n\r\n<p>�</p>\r\n', '[NAME],[USERNAME], [PASSWORD], [SITEURL],[SITE-TITLE]', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_setting`
--
ALTER TABLE `email_setting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_setting`
--
ALTER TABLE `email_setting`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
