-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2025 at 12:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fooddb`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(250) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(100) NOT NULL,
  `menu_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`, `price`, `category`, `menu_status`) VALUES
(1, 'ผัดกระเพราไก่', 45.00, 'ผัด', 1),
(2, 'ผัดกระเพราหมู', 50.00, 'ผัด', 1),
(3, 'ไข่ดาว', 10.00, 'ทอด', 1),
(4, 'ไข่เจียว', 20.00, 'ทอด', 1),
(5, 'ต้มยำกุ้ง', 120.00, 'ต้ม', 1),
(6, 'ลาบหมู', 60.00, 'ยำ', 1),
(7, 'แกงมัสมั่นไก่', 150.00, 'แกง', 1),
(8, 'ปลาราดพริก', 150.00, 'ทอด', 1),
(9, 'ยำวุ้นเส้น', 70.00, 'ยำ', 1),
(10, 'ยำมาม่า', 70.00, 'ยำ', 1),
(12, 'ผัดขี้เมา', 50.00, 'ผัด', 1);

-- --------------------------------------------------------

--
-- Table structure for table `summary`
--

CREATE TABLE `summary` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(250) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `summary`
--

INSERT INTO `summary` (`menu_id`, `menu_name`, `price`, `quantity`, `total_price`, `order_date`, `user_name`, `order_id`, `order_group_id`) VALUES
(1, 'ผัดกระเพราไก่', 45.00, 1, 45.00, '2025-03-26 16:13:45', 'admin', 16, 1742980425),
(4, 'ไข่เจียว', 20.00, 1, 20.00, '2025-03-26 16:13:45', 'admin', 17, 1742980425),
(2, 'ผัดกระเพราหมู', 50.00, 2, 100.00, '2025-03-26 16:14:00', 'admin', 18, 1742980440),
(3, 'ไข่ดาว', 10.00, 1, 10.00, '2025-03-26 16:14:00', 'admin', 19, 1742980440),
(4, 'ไข่เจียว', 20.00, 1, 20.00, '2025-03-26 16:14:00', 'admin', 20, 1742980440),
(2, 'ผัดกระเพราหมู', 50.00, 1, 50.00, '2025-03-26 16:44:51', 'admin', 21, 1742982291),
(3, 'ไข่ดาว', 10.00, 1, 10.00, '2025-03-26 16:44:51', 'admin', 22, 1742982291),
(6, 'ลาบหมู', 60.00, 1, 60.00, '2025-03-26 16:54:42', 'admin', 23, 1742982882),
(8, 'ปลาราดพริก', 150.00, 1, 150.00, '2025-03-26 16:54:42', 'admin', 24, 1742982882);

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `user_id` int(11) NOT NULL,
  `username` char(100) NOT NULL,
  `pwd` char(20) NOT NULL,
  `user_group` tinyint(4) NOT NULL,
  `user_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`user_id`, `username`, `pwd`, `user_group`, `user_status`) VALUES
(1, 'admin', 'a123', 1, 1),
(2, 'user1', '123', 2, 1),
(3, 'user2', '1234', 2, 2),
(4, 'user3', '12345', 2, 1),
(7, 'user 4', '123456', 2, 1),
(8, 'user 5', 'user5', 2, 1),
(9, 'user 6', '1234567', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `summary`
--
ALTER TABLE `summary`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `summary`
--
ALTER TABLE `summary`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
