-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2025 at 11:26 AM
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
-- Database: `omesaishipyard`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories_table`
--

CREATE TABLE `categories_table` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories_table`
--

INSERT INTO `categories_table` (`id`, `category_name`) VALUES
(2, 'Ship Buildings'),
(3, 'Services'),
(4, 'Off Shore'),
(5, 'Fabrication');

-- --------------------------------------------------------

--
-- Table structure for table `media_table`
--

CREATE TABLE `media_table` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `media_type` enum('image','video') NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media_table`
--

INSERT INTO `media_table` (`id`, `category_id`, `media_type`, `file_path`, `title`, `uploaded_at`) VALUES
(9, 2, 'image', 'media_694a2b63c543e.jpg', 'smaple image', '2025-12-23 05:40:51'),
(10, 3, 'image', 'media_694a2b9c3ad8c.jpg', 'sample', '2025-12-23 05:41:48'),
(11, 4, 'image', 'media_694a2babee8b4.jpg', 'sample', '2025-12-23 05:42:03'),
(12, 5, 'image', 'media_694a2bbb31b05.jpeg', 'sample', '2025-12-23 05:42:19'),
(13, 2, 'image', 'media_694a2bc652de4.jpg', 'sample', '2025-12-23 05:42:30'),
(14, 2, 'image', 'media_694a2bcf8c832.jpg', 'sample', '2025-12-23 05:42:39'),
(15, 3, 'image', 'media_694a2bdc19dfa.jpg', 'sample', '2025-12-23 05:42:52'),
(16, 4, 'image', 'media_694a2c25b0a39.jpg', 'sample', '2025-12-23 05:44:05'),
(17, 4, 'image', 'media_694a2c3193678.jpg', 'sample', '2025-12-23 05:44:17'),
(18, 4, 'image', 'media_694a2c3cdd140.jpg', 'sample', '2025-12-23 05:44:28'),
(19, 4, 'image', 'media_694a2c4e3210f.jpeg', 'sample', '2025-12-23 05:44:46'),
(20, 5, 'image', 'media_694a2c5b92c49.jpeg', 'sample', '2025-12-23 05:44:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`) VALUES
(1, 'free', 'bird', 'freebird@gmail.com', '5b1ce540a542e507fe9331ff753f6483', '2025-12-20 05:57:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories_table`
--
ALTER TABLE `categories_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_table`
--
ALTER TABLE `media_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories_table`
--
ALTER TABLE `categories_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `media_table`
--
ALTER TABLE `media_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `media_table`
--
ALTER TABLE `media_table`
  ADD CONSTRAINT `media_table_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories_table` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
