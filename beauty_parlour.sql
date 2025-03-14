-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2025 at 01:00 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beauty_parlour`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `username`, `password_hash`) VALUES
(1, 'admin', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `service` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(20) NOT NULL,
  `specialRequest` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `phone`, `service`, `date`, `time`, `specialRequest`, `created_at`, `status`) VALUES
(1, 'mahes', '8769959435', 'Skin Treatments', '2025-04-11', '4PM-6PM', 'nothing', '2025-03-06 10:12:41', 'rejected'),
(2, 'mahes', '8769959435', 'Hairstyling', '2025-03-21', '1PM-3PM', '', '2025-03-06 10:33:46', 'approved'),
(3, 'mahes', '8769959435', 'Mehendi', '2025-03-20', '7PM-9PM', '', '2025-03-06 10:42:11', 'approved'),
(4, 'jenisha', '9967588434', 'Hairstyling', '2025-06-13', '1PM-3PM', '', '2025-03-06 10:44:43', 'approved'),
(5, 'jeny', '8976895667', 'Skin Treatments', '2025-10-15', '4PM-6PM', '', '2025-03-06 10:50:37', 'approved'),
(6, 'sri', '6789566789', 'Hairstyling', '2025-03-27', '4PM-6PM', '', '2025-03-06 11:43:06', 'approved'),
(7, 'megala', '8870434386', 'Mehendi', '2025-07-13', '7PM-9PM', 'nothing', '2025-03-06 11:54:30', 'approved'),
(8, 'subasri', '9952234736', 'Hairstyling', '2025-03-13', '10AM-12PM', '', '2025-03-06 12:01:36', 'approved'),
(9, 'priya', '9876544676', 'Mehendi', '2025-03-14', '10AM-12PM', '', '2025-03-06 12:11:53', 'approved'),
(10, 'anisha', '7867400987', 'Hairstyling', '2025-03-21', '4PM-6PM', '', '2025-03-11 12:02:47', 'rejected'),
(11, 'devi', '7666578867', 'Bridal Makeup', '2025-03-28', '4PM-6PM', ' i want smokey eye for my eyemakeup ', '2025-03-14 09:34:39', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `service` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `service`, `message`, `submission_date`) VALUES
(1, 'Ramalakshmi', 'ramalaxmi2004@gmail.com', 'Mehendi', 'Very nice', '2025-02-25 12:20:31'),
(2, 'Keerthana', 'keerthana@gmail.com', 'Hairstyling', 'Good', '2025-02-25 12:21:23'),
(4, 'Sri', 'sri@gmail.com', 'Hairstyling', 'good', '2025-02-25 12:25:47'),
(9, 'krithika', 'krithi@gmail.com', 'Hairstyling', 'good', '2025-03-03 09:43:43'),
(10, 'ranjini', 'ranjini@gmail.com', 'Bridal Makeup', 'good', '2025-03-06 09:05:13'),
(13, 'mahes', 'mahes@gmail.com', 'Skin Treatments', 'good', '2025-03-06 11:25:49'),
(22, 'subasri', 'subasri@gmail.com', 'Hairstyling', 'good', '2025-03-06 12:01:57'),
(24, 'priya', 'priya@gmail.com', 'Mehendi', 'good', '2025-03-06 12:12:25'),
(25, 'anisha', 'anisha@gmail.com', 'Hairstyling', 'good', '2025-03-11 12:04:07'),
(26, 'sangeetha', 'sangeetha@gmail.com', 'Hairstyling', 'good', '2025-03-12 10:46:44'),
(27, 'devi', 'devi@gmail.com', 'Bridal Makeup', 'good', '2025-03-14 09:35:01');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'Bridal Makeup', 'Get flawless makeup for your special day or event.', '3000.00', 'makeup1.jpeg'),
(2, 'Mehandi', 'Get Mehendi designs for your special occasion.', '2500.00', 'simpmeh.jpeg'),
(3, 'Hairstyling', 'Get your hair styled by our expert stylists for any occasion.', '1500.00', 'hairstyles.jpeg'),
(4, 'Skin Treatments', 'Relax with a rejuvenating facial to refresh your skin.', '1000.00', 'skin3.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(25) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`) VALUES
('rishi', 'rishi@gmail.com', '$2y$10$RSmu4tlrt/c38SAQHr'),
('rishi', 'rishi@gmail.com', '$2y$10$kJj15ZZIcqESOudCHg'),
('divya', 'divya@gmail.com', '$2y$10$SaaAWSUrip9ecfUbHb'),
('menaga', 'menaga@gmail.com', '$2y$10$6aFUfxz0eeL.uKpXvM'),
('menaga', 'menaga@gmail.com', '$2y$10$UmGPvALAAiO7u5riHd'),
('menaga', 'menaga@gmail.com', '$2y$10$j.CTqJxWAtuNdtIaLk'),
('jack', 'jack@gmail.com', '$2y$10$CWXJxApp0QHb.L4dia'),
('jack', 'jack@gmail.com', '$2y$10$Ne3S8hzMC3QTQIP9l0'),
('ranjini', 'ranjini@gmail.com', '$2y$10$t3JVBmlqpYyFE1Zz9B'),
('shreya', 'shreya@gmail.com', '$2y$10$4kkhsvdoLAGInqv./J'),
('aarthi', 'aarthi@gmail.com', '$2y$10$7bGweHsVO7Sy72mGLD'),
('aarthi', 'aarthi@gmail.com', '$2y$10$hN7e9YxdR104zC4i35'),
('mahes', 'mahes@gmail.com', '$2y$10$3O4grq8ElcTpPybrnN'),
('mahes', 'mahes@gmail.com', '$2y$10$kfXNukjnYbKYC2u67y'),
('mahes', 'mahes@gmail.com', '$2y$10$FCNTrEO9t3bk8WDwu/'),
('mahes', 'mahes@gmail.com', '$2y$10$TDOMHNYft4sDiWUpcE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
