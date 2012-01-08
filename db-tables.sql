-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 03, 2012 at 09:25 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `devsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `bowls`
--

CREATE TABLE IF NOT EXISTS `bowls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` mediumint(9) NOT NULL,
  `bowl` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `network` varchar(25) NOT NULL,
  `team_1` varchar(100) DEFAULT NULL,
  `team_2` varchar(100) DEFAULT NULL,
  `won` varchar(100) DEFAULT NULL,
  `winning_score` smallint(6) DEFAULT NULL,
  `losing_score` smallint(6) DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `bowls`
--

INSERT INTO `bowls` (`id`, `year`, `bowl`, `location`, `date`, `network`, `team_1`, `team_2`, `won`, `winning_score`, `losing_score`, `notes`) VALUES
(1, 2011, 'Gildan New Mexico', 'Albuquerque, N.M.', 'Dec. 17 2:00 p.m.', 'ESPN', 'Temple', 'Wyoming', 'Temple', 37, 15, NULL),
(2, 2011, 'Famous Idaho Potato Bowl', 'Boise, Idaho', 'Dec. 17 5:00 p.m.', 'ESPN', 'Ohio', 'Utah State', 'Ohio', 24, 23, NULL),
(3, 2011, 'R+L Carriers New Orleans', 'New Orleans', 'Dec. 17 9:00 p.m.', 'ESPN', 'San Diego State', 'Louisiana-Lafayette', 'Louisiana-Lafayette', 32, 30, NULL),
(4, 2011, 'Beef ''O'' Brady''s St. Petersburg', 'St. Petersburg, Fla.', 'Dec. 20, 8:00 p.m.', 'ESPN', 'FIU', 'Marshall', 'Marshall', 20, 10, NULL),
(5, 2011, 'S.D. County Credit Union Poinsettia', 'San Diego', 'Dec. 21, 8:00 p.m.', 'ESPN', 'TCU', 'Louisiana Tech', 'TCU', 31, 24, NULL),
(6, 2011, 'MAACO Las Vegas', 'Las Vegas', 'Dec. 22, 8:00 p.m.', 'ESPN', 'Arizona State', 'Boise State', 'Boise State', 56, 24, NULL),
(7, 2011, 'Sheraton Hawaii', 'Honolulu', 'Dec. 24, 8:00 p.m.', 'ESPN', 'Nevada', 'Southern Miss', 'Southern Miss', 24, 17, NULL),
(8, 2011, 'AdvoCare V100 Independence', 'Shreveport, La.', 'Dec. 26, 5:00 p.m.', 'ESPN2', 'Missouri', 'North Carolina', 'Missouri', 41, 24, NULL),
(9, 2011, 'Little Caesars', 'Detroit', 'Dec. 27, 4:30 p.m.', 'ESPN', 'Western Michigan', 'Purdue', 'Purdue', 37, 32, NULL),
(10, 2011, 'Belk', 'Charlotte, N.C.', 'Dec. 27, 8:00 p.m.', 'ESPN', 'Louisville', 'NC State', 'NC State', 31, 24, NULL),
(11, 2011, 'Military Bowl Presented By Northrop Grumman', 'Washington, D.C.', 'Dec. 28, 4:30 p.m.', 'ESPN', 'Toledo', 'Air Force', 'Toledo', 42, 41, NULL),
(12, 2011, 'Bridgepoint Education Holiday', 'San Diego', 'Dec. 28, 8:00 p.m.', 'ESPN', 'California', 'Texas', 'Texas', 21, 10, NULL),
(13, 2011, 'Champs Sports', 'Orlando, Fla.', 'Dec. 29, 5:30 p.m.', 'ESPN', 'Florida State', 'Notre Dame', 'Florida State', 18, 14, NULL),
(14, 2011, 'Valero Alamo', 'San Antonio', 'Dec. 29, 9:00 p.m.', 'ESPN', 'Washington', 'Baylor', 'Baylor', 67, 56, NULL),
(15, 2011, 'Bell Helicopter Armed Forces', 'Dallas', 'Dec. 30, 12:00 p.m.', 'ESPN', 'BYU', 'Tulsa', 'BYU', 24, 21, NULL),
(16, 2011, 'New Era Pinstripe', 'Bronx, N.Y.', 'Dec. 30, 3:20 p.m.', 'ESPN', 'Rutgers', 'Iowa State', 'Rutgers', 27, 13, NULL),
(17, 2011, 'Franklin American Mortgage Music City', 'Nashville, Tenn.', 'Dec. 30, 6:40 p.m.', 'ESPN', 'Mississippi State', 'Wake Forest', 'Mississippi State', 23, 17, NULL),
(18, 2011, 'Insight', 'Tempe, Ariz.', 'Dec. 30, 10:00 p.m.', 'ESPN', 'Iowa', 'Oklahoma', 'Oklahoma', 31, 14, NULL),
(19, 2011, 'Meineke Car Care of Texas', 'Houston', 'Dec. 31, 12:00 p.m.', 'ESPN', 'Texas A&M', 'Northwestern', 'Texas A&M', 33, 22, NULL),
(20, 2011, 'Hyundai Sun', 'El Paso, Texas', 'Dec. 31, 2:00 p.m.', 'CBS', 'Georgia Tech', 'Utah', 'Utah', 30, 27, NULL),
(21, 2011, 'AutoZone Liberty', 'Memphis, Tenn.', 'Dec. 31, 3:30 p.m.', 'ABC', 'Cincinnati', 'Vanderbilt', 'Cincinnati', 31, 24, NULL),
(22, 2011, 'Kraft Fight Hunger', 'San Francisco', 'Dec. 31, 3:30 p.m.', 'ESPN', 'Illinois', 'UCLA', 'Illinois', 20, 14, NULL),
(23, 2011, 'Chick-fil-A', 'Atlanta', 'Dec. 31, 7:30 p.m.', 'ESPN', 'Virginia', 'Auburn', 'Auburn', 43, 24, NULL),
(24, 2011, 'TicketCity', 'Dallas', 'Jan. 2, 12:00 p.m.', 'ESPNU', 'Houston', 'Penn State', 'Houston', 30, 14, NULL),
(25, 2011, 'Outback', 'Tampa, Fla.', 'Jan. 2, 1:00 p.m.', 'ABC', 'Michigan State', 'Georgia', 'Michigan State', 33, 30, NULL),
(26, 2011, 'Capital One', 'Orlando, Fla.', 'Jan. 2, 1:00 p.m.', 'ESPN', 'Nebraska', 'South Carolina', 'South Carolina', 30, 13, NULL),
(27, 2011, 'Taxslayer.com Gator Bowl', 'Jacksonville, Fla.', 'Jan. 2, 1:00 p.m.', 'ESPN2', 'Ohio State', 'Florida', 'Florida', 24, 17, NULL),
(28, 2011, 'Rose Bowl Game presented by Vizio', 'Pasadena, Calif.', 'Jan. 2, 5:00 p.m.', 'ESPN', 'Wisconsin', 'Oregon', 'Oregon', 45, 38, NULL),
(29, 2011, 'Tostitos Fiesta', 'Glendale, Ariz.', 'Jan. 2, 8:30 p.m.', 'ESPN', 'Stanford', 'Oklahoma State', 'Oklahoma State', 41, 38, NULL),
(30, 2011, 'Allstate Sugar', 'New Orleans', 'Jan. 3, 8:30 p.m.', 'ESPN', 'Michigan', 'Virginia Tech', NULL, NULL, NULL, NULL),
(31, 2011, 'Discover Orange', 'Miami', 'Jan. 4, 8:30 p.m.', 'ESPN', 'West Virginia', 'Clemson', NULL, NULL, NULL, NULL),
(32, 2011, 'AT&T Cotton', 'Arlington, Texas', 'Jan. 6, 8:00 p.m.', 'FOX', 'Kansas State', 'Arkansas', NULL, NULL, NULL, NULL),
(33, 2011, 'BBVA Compass Bowl', 'Birmingham, Ala.', 'Jan. 7, 1:00 p.m.', 'ESPN', 'SMU', 'Pittsburgh', NULL, NULL, NULL, NULL),
(34, 2011, 'GoDaddy.com', 'Mobile, Ala.', 'Jan. 8, 9:00 p.m.', 'ESPN', 'Arkansas State', 'Northern Illinois', NULL, NULL, NULL, NULL),
(35, 2011, 'Allstate BCS National Championship Game', 'New Orleans', 'Jan. 9, 8:30 p.m.', 'ESPN', 'LSU', 'Alabama', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `picks`
--

CREATE TABLE IF NOT EXISTS `picks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sheets_id` int(11) NOT NULL,
  `bowls_id` int(11) NOT NULL,
  `winner` varchar(100) NOT NULL,
  `confidence` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sheets`
--

CREATE TABLE IF NOT EXISTS `sheets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tie_break` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` int(10) unsigned NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, 2130706433, 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'admin@admin.com', '', NULL, '9d029802e28cd9c768e8e62277c0df49ec65c48c', 1268889823, 1325618554, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
