-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2025 at 11:46 AM
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
-- Database: `ome_sai_marine`
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
(4, 2, 'image', 'media_694659769a1ab.png', 'vfvd', '2025-12-20 08:08:22'),
(5, 3, 'video', 'media_694668d1b0054.mp4', 'video', '2025-12-20 08:08:47'),
(7, 2, 'image', 'media_694671e09c854.png', 'dcsdv', '2025-12-20 09:52:32'),
(8, 4, 'image', 'media_694671fe30748.png', 'fdsvs', '2025-12-20 09:53:02');

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
(1, 'raj', 'kumar', 'raj@gmail.com', '39427bc27697ee48679772e4c07c13c1', '2024-07-04 15:48:59'),
(2, 'vascular', 'onestop', 'onestopvascularkkd@gmail.com', '7c17c4fcf8ea300dc90090443ae3caa4', '2024-07-05 06:21:31'),
(3, 'onestop', 'vascular', 'onestop@gmail.com', '742f6be9a59899c0a31f29b18f12d5f9', '2024-10-07 11:07:57'),
(4, 'srinivasa', 'dental', 'srinivasadental@gmail.com', '6bb6774d4cec5dbfc18219af92312d37', '2024-10-08 05:21:55'),
(5, 'free', 'bird', 'freebird@gmail.com', '5b1ce540a542e507fe9331ff753f6483', '2025-12-20 05:57:51');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
