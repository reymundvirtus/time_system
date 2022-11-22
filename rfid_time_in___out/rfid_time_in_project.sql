-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2022 at 05:22 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rfid_time_in_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `registers`
--

CREATE TABLE `registers` (
  `id` int(11) NOT NULL,
  `id_code` varchar(20) DEFAULT NULL,
  `creation_time` time NOT NULL,
  `date_time` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_code` varchar(20) NOT NULL,
  `role_name` varchar(20) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_code`, `role_name`, `date_time`) VALUES
(1, 'Admin', 'Administrator', '2022-11-18 11:59:21'),
(2, 'Mgr', 'Manager', '2022-11-18 11:59:21'),
(3, 'Empl', 'Employee', '2022-11-18 14:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `id_code` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role_id` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `description`, `email`, `id_code`, `password`, `role_id`, `date_time`) VALUES
(16, 'Reymund Virtus', 'Hi, I’m Reymund Virtus, Decisions: If you can’t decide, the answer is no. If two equally difficult paths, choose the one more painful in the short term. Pain avoidance is creating an illusion', 'reymund@gmail.com', '36-7C-AD-E0', '$2y$10$/nuIK2lnkEIjX1DJn/scAeUBUM2nOG1O2fkYc3d/qd/4w1ssnd9Fq', 1, '2022-11-19 03:08:53'),
(21, 'Jordan Aguero', NULL, 'jordan@gmail.com', '16-7C-AD-E0', '$2y$10$.E6.3xk3l9Wkob0cOCvzHus/nZAODj369GHXDjeounVNsIvgQ788K', 2, '2022-11-19 07:15:40'),
(28, 'Loren Borja', 'Hi I\'m John Loren Borja, I love to suck dicks hihi', 'loren@gmail.com', '30-4F-73-1A', '$2y$10$GfEMkSY1EXgyyumCIAq9MOFjQX7VpBF5DsBuFvAVehd1ZXUuXj.w6', 2, '2022-11-20 06:36:19'),
(29, 'Dummy', NULL, 'dum@gmail.com', '10-F4-00-1A', '$2y$10$IF7xch68yz1VWoeBZR2UG.BoBFNmdY0o3EX99dD/sxyX2jUXdbewq', 3, '2022-11-21 19:06:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_times`
--

CREATE TABLE `user_times` (
  `id` int(11) NOT NULL,
  `user_id_code` varchar(20) DEFAULT NULL,
  `date_recorded` date DEFAULT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_times`
--

INSERT INTO `user_times` (`id`, `user_id_code`, `date_recorded`, `time_in`, `time_out`) VALUES
(34, '30-4F-73-1A', '2022-11-22', '21:27:45', '30:32:31'),
(35, '10-F4-00-1A', '2022-11-22', '21:28:10', '21:32:25'),
(36, '36-7C-AD-E0', '2022-11-22', '21:28:19', '21:32:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_code` (`id_code`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_times`
--
ALTER TABLE `user_times`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_code` (`user_id_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_times`
--
ALTER TABLE `user_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_times`
--
ALTER TABLE `user_times`
  ADD CONSTRAINT `user_times_ibfk_2` FOREIGN KEY (`user_id_code`) REFERENCES `users` (`id_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
