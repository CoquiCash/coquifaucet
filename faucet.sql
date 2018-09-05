-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 05, 2018 at 06:53 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faucet`
--

-- --------------------------------------------------------

--
-- Table structure for table `vos_contact`
--

DROP TABLE IF EXISTS `vos_contact`;
CREATE TABLE IF NOT EXISTS `vos_contact` (
  `id_contact` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET latin1 NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` text CHARACTER SET latin1 NOT NULL,
  `comments` text CHARACTER SET latin1 NOT NULL,
  `status` int(1) NOT NULL,
  `status_user` bigint(20) NOT NULL,
  `date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_responded` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `visitor_ip` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `visitor_city` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `visitor_state` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `visitor_country` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `visitor_browser` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `visitor_OS` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `visitor_referer` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visitor_page` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_contact`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vos_contact`
--

INSERT INTO `vos_contact` (`id_contact`, `name`, `phone`, `email`, `comments`, `status`, `status_user`, `date`, `date_responded`, `visitor_ip`, `visitor_city`, `visitor_state`, `visitor_country`, `visitor_browser`, `visitor_OS`, `visitor_referer`, `visitor_page`) VALUES
(1, 'Perencejo', '', 'perencejo@gmail.com', 'RUpibWu6y6ki5esH94o41kH3hWXMFUgSE3', 0, 0, '1536172938', '0', '', '', '', '', 'WebKit', 'Windows 10', 'http://localhost/', '/includes/action/new-request.php'),
(2, 'Perencejo', '', 'perencejo555@gmail.com', 'jdjdjdjjdjjskks', 0, 0, '1536173365', '0', '', '', '', '', 'WebKit', 'Windows 10', 'http://localhost/', '/includes/action/new-request.php');

-- --------------------------------------------------------

--
-- Table structure for table `vos_settings`
--

DROP TABLE IF EXISTS `vos_settings`;
CREATE TABLE IF NOT EXISTS `vos_settings` (
  `id_setting` bigint(20) NOT NULL AUTO_INCREMENT,
  `short_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `long_description` text COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext CHARACTER SET latin1 NOT NULL,
  `cat` int(4) NOT NULL,
  `group_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_setting`),
  UNIQUE KEY `s_id` (`id_setting`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vos_settings`
--

INSERT INTO `vos_settings` (`id_setting`, `short_description`, `long_description`, `value`, `cat`, `group_name`) VALUES
(1, '1_INPUT-TEXT_SITE_NAME', 'Please enter your site name below.', 'Coqui Cash', 1, 'General Settings'),
(5, '1_GROUP:1_INPUT-TEXT_FACEBOOK_PAGE_NAME:SOCIAL MEDIA PAGES', 'If there is no link, the social media will not be displayed on the site.', '', 8, 'Social Media'),
(6, '4_GROUP:1_INPUT-TEXT_YOUTUBE', 'If there is no link, the social media will not be displayed on the site.', '', 8, 'Social Media'),
(8, '3_GROUP:1_INPUT-TEXT_TWITTER', 'If there is no link, the social media will not be displayed on the site.', '', 8, 'Social Media'),
(9, '2_GROUP:1_INPUT-TEXT_INSTAGRAM', 'If there is no link, the social media will not be displayed on the site.', '', 8, 'Social Media'),
(10, 'VOS_LABS_LINK', '', 'http://vosfirm.com', 0, ''),
(23, '1_GROUP:1_INPUT-TEXT_NOTIFICATION_EMAIL_NAME:Request', 'Enter an email address, where you will like to receive notifications every time a person sends a request for coqui cash.', '', 3, 'Notifications'),
(29, '3_GROUP:1_INPUT-BOX_SMTP_USE_NAME:SMTP CONFIGURATION', 'Check the box, if you want to use an SMTP server over your localhost server.', 'false', 1, 'General Settings'),
(30, '4_GROUP:1_INPUT-TEXT_SMTP_HOST', 'Enter your SMTP Host below.', '', 1, 'General Settings'),
(31, '5_GROUP:1_INPUT-TEXT_SMTP_PORT', 'Enter your SMTP Port Number below.', '', 1, 'General Settings'),
(32, '7_GROUP:1_INPUT-TEXT_SMTP_USERNAME', 'Enter your SMTP Username below.', '', 1, 'General Settings'),
(33, '8_GROUP:1_INPUT-TEXT_SMTP_PASSWORD', 'Enter your SMTP Password below.', '', 1, 'General Settings'),
(34, '6_GROUP:1_INPUT-BOX_SMTP_SSL_TLS', 'Check the box, if your SMTP server uses a secure connection.', 'false', 1, 'General Settings'),
(48, '2_GOOGLE_ANALITICS', 'Please enter the full Google Analytics javascript code. For more information search on Google \"\r\nAdding analytics.js to Your Site\"', '', 1, 'General Settings'),
(51, '02_GROUP:1_TRANSLATE_GENERAL_TITLE_SEO', 'Will be used on the home page as a meta title for social media shares. Describe the company vision in up to 120 characters.', '', 6, 'Home Page'),
(52, '5_GROUP:2_INPUT-TEXT_USERNAME_NAME:TWITTER', 'Enter the company twitter username.', '', 8, 'Social Media');

-- --------------------------------------------------------

--
-- Table structure for table `vos_users`
--

DROP TABLE IF EXISTS `vos_users`;
CREATE TABLE IF NOT EXISTS `vos_users` (
  `id_user` bigint(20) NOT NULL AUTO_INCREMENT,
  `fullname` char(80) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` text CHARACTER SET latin1 NOT NULL,
  `privilege` int(4) NOT NULL DEFAULT '1',
  `attempt` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0;',
  `recover` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vos_users`
--

INSERT INTO `vos_users` (`id_user`, `fullname`, `email`, `password`, `privilege`, `attempt`, `recover`, `date`) VALUES
(1, 'VOS ADMIN', 'admin@vosfirm.com', 'yGPmaTH3dRqwJiPvo5ddv9ibMJv7mEontWhrr7WrVZoxAlnw5jTZHuzU3r64RhOaH9xG0OfqW2jMidHyiETkaxiPm1MNzw1exsZsaqXzrmZusJtiQxX3mZy8D6P4Xt6_6ac3db4fa823a86f4a845928b9fb21f70118b25a00311470d39ed9c16e438fd0fc2514506c49622f9245c0267e3ae76dee4733648776f308ac772fc9c721dfa0', 2657, '0;', 'NULL', '2018-06-15 06:52:19'),
(8, 'Luis', 'luis@gmail.com', 'q0DRkivs7Db2v7ADidZCa3mivtt3BFyCGBFSflgmlhbtaHxVuZhxQE09Jmv0XiAJu19LQlGUXW0tCgbF5QldNg40iT2SYUExnBe3WrNSHEV3VRD3wjEboMsWWtHP3nu_c876e10e8c7afd27422e82e09d3bcac5daf5371cfea5096b2a29f8474530c4a14680aff1d7cbc20b2ae88c9332ee592b3a507d3c56c7f94cbba188772ef6791d', 2657, '0;', NULL, '2018-08-10 22:40:03');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
