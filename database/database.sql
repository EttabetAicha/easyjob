-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 03:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobeasy`
--

-- --------------------------------------------------------

--
-- Table structure for table `applyonline`
--

CREATE TABLE `applyonline` (
  `ApplyOnlineID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `jobID` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `notification` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `jobID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `entreprise` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `IsActive` tinyint(1) NOT NULL DEFAULT 1,
  `approve` tinyint(1) NOT NULL,
  `imageURL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`jobID`, `title`, `description`, `entreprise`, `location`, `IsActive`, `approve`, `imageURL`) VALUES
(1, 'Software Developer', 'Exciting software development opportunity', 'ABC Techzzzzzzzzzzzzzzzzzzz', 'City A', 1, 0, 'pic1.png'),
(21, 'zzzzzzzzzzzzzzzz', 'zzzzzzzzzzzzzzzzzz', 'zzzzzzzzzzzzzz', 'zzzzzzzzzzzzz', 1, 0, '657f395e74938_pic4.png'),
(22, 'yyyyyyyyyyyyyyyyy', 'yyyyyyyyyyyyyyyyyyyyy', 'yyyyyyyyyyyyyyyyyy', 'yyyyyyyyyyyyyyy', 1, 0, 'pic2.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','condidate') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `email`, `password`, `role`) VALUES
(1, 'aichaa', 'aicha@gmail.com', '$2y$10$FtlkM0Jp9VRy2UN50mBSZ.2fwTbGYzlJAr0qWpPfPns6tiOZ5If3m', 'condidate'),
(2, 'salma', 'salma@gmail.com', '$2y$10$RgOOfxorTJyP3PDX5xqdqOCeW0WIWpcQuakgKcYjunyJJ2w5cwJYO', 'condidate'),
(3, 's', 'salma@gmail.com', '$2y$10$F80aZSMMpCKwwAEy9zsB8O9H91sIxlOs5Dz0bEbZVVC87dJbcn80e', 'condidate'),
(4, 'rghia', 'rghia@gmail.com', '$2y$10$rGW0kcawVypBS6rDXCWA9OQZq6SZ8xHXzcbtrRmrcvvqd0f7W58iu', 'condidate'),
(5, 'souma', 'souma@gmail.com', '$2y$10$VddX4xfh9uAPNUAM/f9GCu/T18pn9P.qnTTd7ljWdoiHZwCHNrbYW', 'admin'),
(7, 'noha', 'noha@gmail.com', '$2y$10$CQ1/G.kGi.VR3Jye2WPhB.cS.y0TrU.ZKkQK12moJ96tt5hGp1Sf.', 'condidate');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applyonline`
--
ALTER TABLE `applyonline`
  ADD PRIMARY KEY (`ApplyOnlineID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `jobID` (`jobID`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`jobID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applyonline`
--
ALTER TABLE `applyonline`
  MODIFY `ApplyOnlineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applyonline`
--
ALTER TABLE `applyonline`
  ADD CONSTRAINT `applyonline_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `applyonline_ibfk_2` FOREIGN KEY (`jobID`) REFERENCES `jobs` (`jobID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
