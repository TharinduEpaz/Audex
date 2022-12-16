-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 16, 2022 at 07:09 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `userdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `date` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `public_event` tinyint(1) DEFAULT NULL,
  `location` varchar(30) NOT NULL,
  `ticket_link` varchar(30) NOT NULL,
  `time` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `name`, `description`, `date`, `user_id`, `public_event`, `location`, `ticket_link`, `time`) VALUES
(1, 'DJ', 'dfdfdfdfdfdfdf', '12/11', 11, 1, 'dfdfdf', 'dfdfdf', '12.40'),
(2, 'sdsd', 'sdsdsdsd', '12/11', 11, 1, 'sdsds', 'ssdsdsd', '12.40'),
(3, 'eer', 'eerer', '1212', 2, NULL, 'dfdf', 'dfdf', ''),
(4, 'q', 'eee', 'w', 11, NULL, 'e', 'e', '12'),
(5, 'DJ FX', 'sdfdfddfdfdfdfdfdfdfdfdfdfdfdfdf', '12/21', 11, NULL, 'Nelum pokuna', 'www.hhrhhrhhr.com', '12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
