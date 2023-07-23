-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23 يوليو 2023 الساعة 19:10
-- إصدار الخادم: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expense`
--

-- --------------------------------------------------------

--
-- بنية الجدول `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Food'),
(13, 'shopping'),
(15, 'study');

-- --------------------------------------------------------

--
-- بنية الجدول `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `details` text NOT NULL,
  `expense_date` date NOT NULL,
  `added_on` datetime NOT NULL,
  `added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `expense`
--

INSERT INTO `expense` (`id`, `category_id`, `item`, `price`, `details`, `expense_date`, `added_on`, `added_by`) VALUES
(20, 1, 'pizza', 50, 'card', '2023-07-10', '2023-07-23 06:44:57', 8),
(22, 13, 'shoses', 100, 'cash', '2023-07-23', '2023-07-23 06:47:20', 8),
(24, 15, 'communications', 50, 'cash', '2023-07-19', '2023-07-23 07:04:38', 10),
(25, 13, 'headphones', 100, 'cash', '2023-06-13', '2023-07-23 07:05:44', 10);

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','User') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(4, 'admin', '$2y$10$W7Dk8mAJQEfHttzO2dGOOeTI6jtPQtsHtngq4Jan11qVZvjojBsVi', 'Admin'),
(8, 'admin1', '$2y$10$em26XUjE3tCt41GR3qgPUuw4yDNxP6CTW30ujlsCkWJ3HP1n1KwZe', 'User'),
(9, 'aishamauof', '$2y$10$Ex0oBYxNFs.QVryXq61EIeDnlr2UY9B5d2bru8eHsO9C5mM3MT93y', 'User'),
(10, 'admin_20', '$2y$10$W7Dk8mAJQEfHttzO2dGOOeTI6jtPQtsHtngq4Jan11qVZvjojBsVi', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
