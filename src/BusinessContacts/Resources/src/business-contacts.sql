-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 20, 2016 at 10:14 AM
-- Server version: 5.5.50-0ubuntu0.14.04.1-log
-- PHP Version: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `business-contacts`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organisation_id` int(11) DEFAULT NULL,
  `salutation` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_title` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extension` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `home_page` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4C62E6389E6B1585` (`organisation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `organisation_id`, `salutation`, `first_name`, `last_name`, `email`, `job_title`, `phone_number`, `extension`, `home_page`) VALUES
(1, 1, 'Ms', 'Test', 'Tester', 'test@example.com', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `organisations`
--

CREATE TABLE IF NOT EXISTS `organisations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `primary_contact_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `county` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `web_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E6E132B4D905C92C` (`primary_contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `organisations`
--

INSERT INTO `organisations` (`id`, `primary_contact_id`, `name`, `address1`, `address2`, `address3`, `city`, `postcode`, `county`, `country`, `phone_number`, `web_address`) VALUES
(1, 1, 'Test', 'Yada', NULL, NULL, 'Edinburgh', 'eh101010', NULL, 'UK', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `FK_4C62E6389E6B1585` FOREIGN KEY (`organisation_id`) REFERENCES `organisations` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `organisation`
--
ALTER TABLE `organisations`
  ADD CONSTRAINT `FK_E6E132B4D905C92C` FOREIGN KEY (`primary_contact_id`) REFERENCES `contacts` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
