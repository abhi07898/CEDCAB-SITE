-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2020 at 10:53 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cabbooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(155) NOT NULL,
  `name` varchar(255) NOT NULL,
  `distance` int(255) NOT NULL,
  `isavailable` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `name`, `distance`, `isavailable`) VALUES
(10, 'INDRANAGAR', 10, 0),
(11, 'BBD', 30, 0),
(12, 'BARABANKI', 60, 0),
(13, 'FAIZABAD', 100, 0),
(14, 'BASTI', 150, 0),
(15, 'GORAKHPUR', 210, 1),
(16, 'KANPUR', 45, 0),
(20, 'CHARBAGH', 0, 0),
(26, 'BBD', 20, 0),
(27, 'test', 1000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ride`
--

CREATE TABLE `ride` (
  `ride_id` int(155) NOT NULL,
  `ride_date` varchar(255) NOT NULL,
  `loc_from` varchar(255) NOT NULL,
  `loc_to` varchar(255) NOT NULL,
  `total_distance` int(255) NOT NULL,
  `luggage` varchar(255) NOT NULL,
  `total_fare` varchar(255) NOT NULL,
  `status` int(155) NOT NULL DEFAULT 1,
  `cust_id` int(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ride`
--

INSERT INTO `ride` (`ride_id`, `ride_date`, `loc_from`, `loc_to`, `total_distance`, `luggage`, `total_fare`, `status`, `cust_id`) VALUES
(2, '2020-11-25 14:46:59', 'BBD', 'CHARBAGH', 30, '', '425', 3, 11),
(27, '2020-11-25 15:23:46', 'BARABANKI', 'BBD', 30, '', '555', 2, 11),
(50, '2020-11-25 16:19:34', 'BARABANKI', 'BBD', 30, '', '555', 2, 11),
(51, '2020-11-25 16:19:35', 'BARABANKI', 'BBD', 30, '', '555', 2, 11),
(52, '2020-11-25 16:42:00', 'INDRANAGAR', 'FAIZABAD', 90, '', '1091', 2, 4),
(53, '2020-11-25 17:00:39', 'FAIZABAD', 'BARABANKI', 40, '', '775', 2, 11),
(54, '2020-11-25 17:06:18', 'FAIZABAD', 'BARABANKI', 40, '', '775', 2, 11),
(59, '2020-11-27 08:46:33', 'BBD', 'FAIZABAD', 70, '', '887', 2, 11),
(60, '2020-11-27 08:49:46', 'BBD', 'FAIZABAD', 70, '', '887', 2, 11),
(61, '2020-11-27 08:52:33', 'BBD', 'FAIZABAD', 70, '', '887', 2, 11),
(62, '2020-11-27 08:53:12', 'BBD', 'FAIZABAD', 70, '', '887', 2, 11),
(63, '2020-11-27 08:54:27', 'BBD', 'FAIZABAD', 70, '', '887', 2, 11),
(64, '2020-11-27 08:56:13', 'BBD', 'FAIZABAD', 70, '', '887', 2, 11),
(65, '2020-11-27 08:57:44', 'BBD', 'FAIZABAD', 70, '', '887', 3, 11),
(66, '2020-11-27 08:58:15', 'BBD', 'FAIZABAD', 70, '', '887', 2, 11),
(67, '2020-11-27 08:58:57', 'BBD', 'FAIZABAD', 70, '', '887', 2, 11),
(68, '2020-11-27 08:59:54', 'BBD', 'FAIZABAD', 70, '', '887', 2, 11),
(69, '2020-11-27 09:00:35', 'BBD', 'FAIZABAD', 70, '', '887', 3, 11),
(70, '2020-11-27 09:01:15', 'BBD', 'FAIZABAD', 70, '', '887', 3, 11),
(71, '2020-11-27 09:02:49', 'BBD', 'FAIZABAD', 70, '', '887', 2, 11),
(72, '2020-11-27 09:02:51', 'BBD', 'FAIZABAD', 70, '', '887', 2, 11),
(73, '2020-11-27 09:03:07', 'BBD', 'FAIZABAD', 70, '', '887', 2, 11),
(74, '2020-11-27 09:06:00', 'BBD', 'FAIZABAD', 70, '', '887', 2, 11),
(75, '2020-11-27 09:08:13', 'BBD', 'FAIZABAD', 70, '', '887', 2, 11),
(76, '2020-11-27 09:08:30', 'BBD', 'FAIZABAD', 70, '', '887', 2, 11),
(77, '2020-11-27 09:09:24', 'BBD', 'FAIZABAD', 70, '', '887', 2, 11),
(78, '2020-11-27 09:09:26', 'BBD', 'FAIZABAD', 70, '', '887', 2, 11),
(167, '2020-11-27 11:15:57', 'BBD', 'GORAKHPUR', 180, '', '2485', 2, 11),
(168, '2020-11-27 15:04:10', 'BBD', 'INDRANAGAR', 20, '', '425', 2, 4),
(169, '2020-11-27 15:12:10', 'BBD', 'GORAKHPUR', 180, '', '1975', 2, 4),
(174, '2020-11-28 13:02:09', 'FAIZABAD', 'CHARBAGH', 100, '123', '2093', 2, 12),
(176, '2020-11-30 16:10:07', 'BBD', 'BARABANKI', 30, '', '715', 2, 12),
(177, '2020-11-30 16:13:07', 'FAIZABAD', 'BARABANKI', 40, '', '545', 2, 12),
(179, '2020-11-30 17:47:49', 'BARABANKI', 'FAIZABAD', 40, '', '685', 2, 11),
(180, '2020-11-30 17:58:53', 'BARABANKI', 'BASTI', 90, '', '1561', 2, 12),
(181, '2020-11-30 18:03:34', 'BARABANKI', 'BASTI', 90, '', '1281', 2, 11),
(182, '2020-11-30 18:04:14', 'BASTI', 'KANPUR', 105, '', '1759', 1, 11),
(183, '2020-11-30 18:04:30', 'BBD', 'KANPUR', 15, '', '490', 1, 11),
(184, '2020-11-30 18:33:42', 'BBD', 'CHARBAGH', 30, '', '715', 1, 11),
(185, '2020-11-30 18:35:19', 'INDRANAGAR', 'CHARBAGH', 10, '', '295', 1, 11),
(186, '2020-11-30 18:38:17', 'INDRANAGAR', 'CHARBAGH', 10, '', '295', 1, 11),
(187, '2020-11-30 18:42:35', 'INDRANAGAR', 'CHARBAGH', 10, '', '295', 1, 11),
(188, '2020-11-30 18:42:42', 'INDRANAGAR', 'CHARBAGH', 10, '', '295', 1, 11),
(189, '2020-11-30 18:54:22', 'INDRANAGAR', 'KANPUR', 35, '', '705', 1, 11),
(190, '2020-12-01 08:35:45', 'BBD', 'BARABANKI', 30, '12', '915', 1, 11),
(191, '2020-12-01 08:42:37', 'BASTI', 'INDRANAGAR', 140, '', '1841', 1, 11),
(192, '2020-12-01 10:30:05', 'BASTI', 'INDRANAGAR', 140, '', '2031', 1, 12),
(193, '2020-12-01 10:38:36', 'INDRANAGAR', 'CHARBAGH', 10, '53456435634', '555', 1, 12),
(194, '2020-12-01 12:50:41', 'BARABANKI', 'CHARBAGH', 60, '', '1165', 1, 11),
(195, '2020-12-01 14:44:08', 'INDRANAGAR', 'BBD', 20, '10', '475', 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(155) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_of_signup` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `isblock` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `isadmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `user_name`, `name`, `date_of_signup`, `mobile`, `isblock`, `password`, `isadmin`) VALUES
(4, 'aa', 'aa', '2020-11-24 10:27:08', '234234', 1, '25f9e794323b453885f5181f1b624d0b', 1),
(5, 'adfsasd', 'aadfsg', '2020-11-24 16:14:49', '43667', 1, '81dc9bdb52d04dc20036dbd8313ed055', 0),
(7, 'sdafcsd', 'aaasdfasdf', '2020-11-24 16:48:23', '123456789', 1, '', 0),
(9, 'sadf', 'aae', '2020-11-24 17:52:33', '12345', 1, '81dc9bdb52d04dc20036dbd8313ed055', 0),
(11, 'abhi07898', 'Abhishke Updated', '2020-11-24 18:26:33', '8874651887', 1, '827ccb0eea8a706c4c34a16891f84e7b', 0),
(12, 'admin', 'admin', '2020-11-27 15:11:00', '1234', 1, '827ccb0eea8a706c4c34a16891f84e7b', 1),
(13, 'user', 'user', '2020-11-30 15:32:14', '1234567890', 1, '81dc9bdb52d04dc20036dbd8313ed055', 0),
(22, 'usrer', 'qwert', '2020-12-01 10:30:49', '1234567890', 1, '202cb962ac59075b964b07152d234b70', 0),
(23, 'usrr', 'wedqewds', '2020-12-01 14:02:01', '1234567890', 1, '202cb962ac59075b964b07152d234b70', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `ride`
--
ALTER TABLE `ride`
  ADD PRIMARY KEY (`ride_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(155) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ride`
--
ALTER TABLE `ride`
  MODIFY `ride_id` int(155) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(155) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ride`
--
ALTER TABLE `ride`
  ADD CONSTRAINT `ride_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
