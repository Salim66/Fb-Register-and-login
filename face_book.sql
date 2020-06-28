-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2020 at 06:07 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `face_book`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cell` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `created_at` varchar(50) NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `uname`, `email`, `cell`, `password`, `photo`, `created_at`, `status`) VALUES
(20, 'Jibon', 'jibon', 'jibon@gmail.com', '01478546922', '$2y$10$1yU00wKNLSAMNJFfETA11eEHwgdm9AdXLkkPMyTAWhNZtbET8SOha', '2b2324d4602e99dbf0825e5a2857f76c.jpg', '2020-06-27 11:49:46', 'active'),
(22, 'Md Salim Hasan Riad', 'salim', 'salim@gmail.com', '01740445608', '$2y$10$24vRmOU2YSUNZ7nHbUa36.QRUygQDsX3sQI5MfCvYVTW0dvnbE49u', '68bf0cc0809e45ab64dfbcbdad5ce068.jpg', '2020-06-28 09:32:09', 'active'),
(23, 'Arbin Babu Ahmad', 'babu', 'babu@gmail.com', '017896587456', '$2y$10$RTeR21szKuIoUwnXCfnh9.q87luIw8rkapzoFkEleln3xAq2ThEjS', 'b8468e39e778dc2d54c786ce73ea70c3.jpg', '2020-06-28 09:37:20', 'active'),
(24, 'Mizanur Rhman', 'mizan', 'mizan@gmail.com', '016985745412', '$2y$10$Jgad4lWxboTmmOSxIzeLiOAcCPrgWP9Cm/AfnGqfd9folWSRCvRUa', 'e3b05cbb37492fb01a65e89e56b3af60.jpg', '2020-06-28 09:38:18', 'active'),
(25, 'Saikat Hasan Hriday', 'saikat', 'saikat@gmail.com', '019658754524', '$2y$10$84sbsijA7R1JpcShmvQ2vun1LufQD5kZKgbE0Ju5p0jeGNle.1yvG', 'aff734bedb5d73619b3896ed9e33279e.jpg', '2020-06-28 09:39:17', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
