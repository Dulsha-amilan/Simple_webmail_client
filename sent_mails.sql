-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2024 at 12:16 AM
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
-- Database: `webmail_client`
--

-- --------------------------------------------------------

--
-- Table structure for table `sent_mails`
--

CREATE TABLE `sent_mails` (
  `id` int(6) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sent_mails`
--

INSERT INTO `sent_mails` (`id`, `email`, `subject`, `message`, `sent_at`) VALUES
(1, 'dulsjnjnharulzzz@gmail.com', 'kmkmk', 'gdsgfdg', '2024-07-31 11:24:22'),
(2, 'savindunawarathne2000@gmail.com', 'hello', 'hi hi hih hihdsdsgfg', '2024-07-31 12:54:40'),
(3, 'it21357930@my.sliit.lk', 'kmkmk', 'sdfsdfd', '2024-07-31 13:23:52'),
(4, 'it21357930@my.sliit.lk', 'kmkmk', 'sadasdasd', '2024-07-31 13:39:33'),
(5, 'it21357930@my.sliit.lk', 'kmkmk', 'ccvxcvx', '2024-07-31 17:03:30'),
(6, 'dulsharulzzz@gmail.com', 'food', 'ane huke nannane', '2024-07-31 20:02:04'),
(7, 'it21357930@my.sliit.lk', 'food', 'mksmdkasmdas', '2024-07-31 20:59:36'),
(8, 'it21357930@my.sliit.lk', 'hakoesdcsd', 'asdasd', '2024-07-31 21:31:07'),
(9, 'amilasenavirathna396@gmail.com', 'hakoesdcsd', 'gon mu', '2024-07-31 21:33:05'),
(10, 'amilasenavirathna396@gmail.com', 'spem', 'spm', '2024-07-31 21:38:57'),
(11, 'amilasenavirathna396@gmail.com', 'spemsdsad', 'dsadasdasdasdasdasdasdasd', '2024-07-31 21:39:55'),
(12, 'amilasenavirathna396@gmail.com', 'spemsdsad', 'dsfdsf1213213123', '2024-07-31 21:43:28'),
(13, 'amilasenavirathna396@gmail.com', 'spemsdsad', 'dsfsdfqzslllppoo0wie', '2024-07-31 21:45:13'),
(14, 'amilasenavirathna396@gmail.com', 'spemsdsad', 'dfsfsdf82984983204203432-4234i9-23094-23', '2024-07-31 21:48:00'),
(15, 'amilasenavirathna396@gmail.com', 'spemsdsad', 'dfsfsdf82984983204203432-4234i9-23094-23', '2024-07-31 21:49:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sent_mails`
--
ALTER TABLE `sent_mails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sent_mails`
--
ALTER TABLE `sent_mails`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
