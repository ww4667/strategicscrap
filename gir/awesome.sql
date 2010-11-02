-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2010 at 12:27 AM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `awesomedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `objects`
--

CREATE TABLE IF NOT EXISTS `objects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_name_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `object_name_id` (`object_name_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `objects`
--

INSERT INTO `objects` (`id`, `object_name_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `object_definitions`
--

CREATE TABLE IF NOT EXISTS `object_definitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_name_id` int(11) NOT NULL,
  `property_name_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `object_name_id` (`object_name_id`,`property_name_id`),
  KEY `object_name_id_2` (`object_name_id`),
  KEY `property_name_id` (`property_name_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `object_definitions`
--

INSERT INTO `object_definitions` (`id`, `object_name_id`, `property_name_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `object_names`
--

CREATE TABLE IF NOT EXISTS `object_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `object_names`
--

INSERT INTO `object_names` (`id`, `label`) VALUES
(1, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `property_names`
--

CREATE TABLE IF NOT EXISTS `property_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(128) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `label` (`label`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `property_names`
--

INSERT INTO `property_names` (`id`, `label`) VALUES
(4, 'color'),
(2, 'email'),
(5, 'height'),
(3, 'name'),
(1, 'username');

-- --------------------------------------------------------

--
-- Table structure for table `property_values_dates`
--

CREATE TABLE IF NOT EXISTS `property_values_dates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` datetime DEFAULT NULL,
  `property_name_id` int(11) DEFAULT NULL,
  `object_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attr_id` (`property_name_id`),
  KEY `value` (`value`),
  KEY `data_id` (`object_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=14 ;

--
-- Dumping data for table `property_values_dates`
--

INSERT INTO `property_values_dates` (`id`, `value`, `property_name_id`, `object_id`) VALUES
(13, '0000-00-00 00:00:00', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `property_values_numbers`
--

CREATE TABLE IF NOT EXISTS `property_values_numbers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `property_name_id` int(11) DEFAULT NULL,
  `object_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attr_id` (`property_name_id`),
  KEY `value` (`value`),
  KEY `data_id` (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `property_values_numbers`
--


-- --------------------------------------------------------

--
-- Table structure for table `property_values_text`
--

CREATE TABLE IF NOT EXISTS `property_values_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` text CHARACTER SET latin1,
  `property_name_id` int(11) DEFAULT NULL,
  `object_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attr_id` (`property_name_id`),
  KEY `object_id` (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `property_values_text`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `objects`
--
ALTER TABLE `objects`
  ADD CONSTRAINT `objects_ibfk_1` FOREIGN KEY (`object_name_id`) REFERENCES `object_names` (`id`);

--
-- Constraints for table `object_definitions`
--
ALTER TABLE `object_definitions`
  ADD CONSTRAINT `object_definitions_ibfk_3` FOREIGN KEY (`object_name_id`) REFERENCES `object_names` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `object_definitions_ibfk_2` FOREIGN KEY (`property_name_id`) REFERENCES `property_names` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `property_values_dates`
--
ALTER TABLE `property_values_dates`
  ADD CONSTRAINT `property_values_dates_ibfk_2` FOREIGN KEY (`object_id`) REFERENCES `objects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `property_values_dates_ibfk_1` FOREIGN KEY (`property_name_id`) REFERENCES `property_names` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `property_values_numbers`
--
ALTER TABLE `property_values_numbers`
  ADD CONSTRAINT `property_values_numbers_ibfk_1` FOREIGN KEY (`property_name_id`) REFERENCES `property_names` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `property_values_numbers_ibfk_2` FOREIGN KEY (`object_id`) REFERENCES `objects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `property_values_text`
--
ALTER TABLE `property_values_text`
  ADD CONSTRAINT `property_values_text_ibfk_2` FOREIGN KEY (`object_id`) REFERENCES `objects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `property_values_text_ibfk_1` FOREIGN KEY (`property_name_id`) REFERENCES `property_names` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
