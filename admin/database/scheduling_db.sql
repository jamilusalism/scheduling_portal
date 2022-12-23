-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 23, 2022 at 09:08 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scheduling_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `facilitators`
--

CREATE TABLE `facilitators` (
  `id` int(30) NOT NULL,
  `id_no` varchar(100) NOT NULL,
  `programme_id` int(20) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `state` varchar(100) NOT NULL,
  `lga` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facilitators`
--

INSERT INTO `facilitators` (`id`, `id_no`, `programme_id`, `firstname`, `middlename`, `lastname`, `contact`, `gender`, `address`, `email`, `state`, `lga`) VALUES
(7, '64506025', 4, 'Sagir', 'Tanimu', 'Musa', '08022334455', 'Male', 'Gwarzo Road, Rijiyar Zaki, Kano', 'mtsagir@gmail.com', 'Kano', 'Nassarawa'),
(8, '07549615', 1, 'Jamila', 'Mohammed', 'Salisu', '08028752833', 'Female', 'Unguwan Dosa, Kaduna', 'jamilusalis@gmail.com', 'Kaduna', 'Kaduna North'),
(9, '71786277', 5, 'Nabeelah', 'Garba', 'Ahmed', '08066664444', 'Female', 'NDA, Kaduna', 'nabeelah@gmail.com', 'Adamawa', 'Yola North');

-- --------------------------------------------------------

--
-- Table structure for table `programme`
--

CREATE TABLE `programme` (
  `id` int(30) NOT NULL,
  `course` varchar(200) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programme`
--

INSERT INTO `programme` (`id`, `course`, `description`) VALUES
(1, 'Soft Skills Training', 'Communication Skill, Negotiation Skill, Critical Thinking and Problem-Solving Skills'),
(4, 'Financial Literacy Training', 'Cash-Flow, Networth, Money in, Money out.'),
(5, 'Entrepreneurship Training', 'Idea Research, Product Development, Marketing the Product, Cashing out.');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(30) NOT NULL,
  `facilitator_id` int(30) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `state` varchar(50) NOT NULL,
  `lga` varchar(50) NOT NULL,
  `location` text NOT NULL,
  `contact_person` varchar(200) NOT NULL,
  `schedule_date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `description` text NOT NULL,
  `is_repeating` tinyint(1) NOT NULL DEFAULT '1',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `repeating_data` text,
  `schedule_type` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `facilitator_id`, `title`, `state`, `lga`, `location`, `contact_person`, `schedule_date`, `time_from`, `time_to`, `description`, `is_repeating`, `date_created`, `repeating_data`, `schedule_type`) VALUES
(1, 8, 'Soft Skills Training', 'Kaduna', 'Zaria', 'Kofan Doka', '08028752833', '2022-12-22', '01:15:00', '05:00:00', '10000 participant expected', 0, '2022-12-21 12:11:31', NULL, NULL),
(2, 7, 'Financial Literacy Training', 'Kaduna', 'North', 'SMS Unguwan Dosa, Kaduna', '08011223344', '2022-12-23', '10:30:00', '16:00:00', 'You will be needing to come along with a projector', 0, '2022-12-23 08:18:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '3' COMMENT '1=Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'Super Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `facilitators`
--
ALTER TABLE `facilitators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programme`
--
ALTER TABLE `programme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `facilitators`
--
ALTER TABLE `facilitators`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `programme`
--
ALTER TABLE `programme`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
