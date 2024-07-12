-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 10, 2024 at 08:11 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `one-ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`products`)),
  `total_amount` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(255) NULL,
  `stripe_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `products`, `total_amount`, `order_date`, `payment_status`, `stripe_id`) VALUES
(1, 1, '{\"1\":{\"id\":\"1\",\"name\":\"Mu00e9daille\",\"price\":\"29\",\"image_url\":\"images/blog1.jpg\",\"quantity\":1},\"2\":{\"id\":\"2\",\"name\":\"Silicone\",\"price\":\"29\",\"image_url\":\"images/blog2.jpg\",\"quantity\":1}}', 58.00, '2024-07-09 13:20:21', '', 'ch_3PadxxLsWl7p4hyT11ySfxRo'),
(2, 3, '{\"1\":{\"id\":\"1\",\"name\":\"Mu00e9daille\",\"price\":\"29\",\"image_url\":\"images/blog1.jpg\",\"quantity\":1}}', 29.00, '2024-07-09 18:34:09', '', 'ch_3PairdLsWl7p4hyT17e0D2Pm');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float DEFAULT 0,
  `image_url` varchar(191) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image_url`) VALUES
(1, 'Médaille', 29, 'images/blog-lg1.jpg'),
(2, 'Silicone', 29, 'images/blog-lg2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `full_name` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(191) NOT NULL,
  `role` varchar(20) DEFAULT 'user',
  `address` text DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` text DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `password`, `email`, `role`, `address`, `reg_date`, `reset_token`, `token_expiry`) VALUES
(1, 'Mutahar Hafeez', '$2y$10$w9RVwWsjAEWW8cvjQE88p.PHmj.ClaFiAzBrIPtd6frVf7obVRjJC', 'haseeb@gmail.com', 'user', 'New Lahore Road Narowal, Near BISP office', '2024-07-08 11:21:45', NULL, NULL),
(2, 'Mutahar Hafeez', '$2y$10$qYhQc.e2AP6hO8h93HohXeHjclddn/cvTtBbM/L29ou5sNjp63F/G', 'mutaharhafeez@gmail.com ', 'user', 'Street No.2 New Lahore Road, Nare BISP Narowal', '2024-07-09 18:06:40', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
