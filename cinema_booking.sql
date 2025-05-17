-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2025 at 06:08 AM
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
-- Database: `cinema_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL,
  `action` text NOT NULL,
  `log_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`log_id`, `user_id`, `role`, `action`, `log_time`) VALUES
(1, 1, 'admin', 'Accessed admin dashboard', '2025-05-12 12:02:27'),
(2, 1, 'admin', 'Accessed admin dashboard', '2025-05-12 12:04:44'),
(3, 1, 'admin', 'Accessed admin dashboard', '2025-05-12 12:08:23'),
(4, 1, 'admin', 'Accessed admin dashboard', '2025-05-12 12:13:05'),
(5, 1, 'admin', 'Accessed admin dashboard', '2025-05-12 12:13:12'),
(6, 1, 'admin', 'Accessed admin dashboard', '2025-05-12 12:15:45'),
(7, 1, 'admin', 'Accessed admin dashboard', '2025-05-12 12:18:11'),
(8, 1, 'admin', 'Accessed admin dashboard', '2025-05-12 12:18:44'),
(9, 1, 'admin', 'Accessed admin dashboard', '2025-05-12 12:19:58'),
(10, 1, 'admin', 'Accessed admin dashboard', '2025-05-12 12:20:01'),
(11, 1, 'admin', 'Accessed admin dashboard', '2025-05-12 13:52:41'),
(12, 1, 'admin', 'Accessed admin dashboard', '2025-05-12 13:52:44'),
(13, 1, 'admin', 'Accessed admin dashboard', '2025-05-12 13:59:38'),
(14, 1, 'admin', 'Accessed admin dashboard', '2025-05-12 13:59:42'),
(15, 1, 'admin', 'Accessed admin dashboard', '2025-05-12 14:00:01'),
(16, 1, 'admin', 'Accessed admin dashboard', '2025-05-12 14:00:07'),
(17, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:38:59'),
(18, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:39:10'),
(19, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:39:42'),
(20, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:45:30'),
(21, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:49:45'),
(22, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:51:58'),
(23, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:52:08'),
(24, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:52:15'),
(25, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:53:50'),
(26, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:54:03'),
(27, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:54:27'),
(28, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:57:38'),
(29, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:57:40'),
(30, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:57:47'),
(31, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:57:51'),
(32, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:57:56'),
(33, 1, 'admin', 'Deleted movie with ID: 11', '2025-05-17 10:58:00'),
(34, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:58:01'),
(35, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:58:30'),
(36, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:58:33'),
(37, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:58:35'),
(38, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:59:03'),
(39, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:59:07'),
(40, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:59:33'),
(41, 1, 'admin', 'Deleted movie with ID: 12', '2025-05-17 10:59:37'),
(42, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:59:38'),
(43, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:59:43'),
(44, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 10:59:45');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `booking_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `action` text NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `role`, `action`, `timestamp`) VALUES
(13, 1, 'admin', 'Added movie: Sunlight in Calgary', '2025-05-17 11:12:06'),
(14, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 11:12:07'),
(15, 1, 'admin', 'Deleted movie: Sunlight in Calgary', '2025-05-17 11:12:09'),
(16, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 11:12:11'),
(17, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 11:13:25'),
(18, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 11:13:37'),
(19, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 11:13:39'),
(20, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 11:13:44'),
(21, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 11:14:34'),
(22, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 11:14:57'),
(23, 1, 'admin', 'Added movie: NewAvengers', '2025-05-17 11:15:17'),
(24, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 11:15:19'),
(25, 1, 'admin', 'Accessed admin dashboard', '2025-05-17 11:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `showtime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `movie_name`, `duration`, `showtime`) VALUES
(15, 'NewAvengers', 180, '2025-08-09 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff','customer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$f1L4gK0mH1LAEs/6rvIdkOi6TglZAvbwkTppJVp6z8bvC4vKqwHpW', 'admin'),
(2, 'staff', '$2y$10$pVrOQXrdKC0Z9IOsoHjvHOBNy3wYo7DBzDAo.LFEqP8dhqPgQVJa2', 'staff'),
(4, 'shem', '$2y$10$C852evzrCuOWbLPOsUVazeymwfBQekHNXbvWrKgMEyrgGg2cF5I7a', 'customer'),
(5, 'winz', '$2y$10$t.z6dsn.zNBQagxkn6nYv.hYstpzlE5qydGrdsF9yhPj1g0HC3Em6', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
