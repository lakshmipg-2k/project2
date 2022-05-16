-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 16, 2022 at 09:13 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(4, 1, 'Lakshmi PG', 'lakshmi.pg@outlook.com', '9876543234', 'hi'),
(10, 1, 'Lakshmi PG', 'lakshmi.pg@outlook.com', '9875674324', 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `placed_on` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(2, '1', 'Lakshmi ', '9876543212', 'lakshmi.pg@outlook.com', 'Kolar', '1', '100', '10-4-22', 'completed'),
(5, '1', 'Lakshmi PG', '', 'lakshmi.pg@outlook.com', 'flat no. Sea Educational Trust Road, Bengaluru - 560049', ', Lotus (1) ', '150', '13-Apr-2022', 'pending'),
(6, '1', 'Lakshmi PG', '9876543212', 'lakshmi.pg@outlook.com', 'Sea Educational Trust Road, Bengaluru - 560049', 'Lotus (1) ', '150', '13-Apr-2022', 'completed'),
(7, '1', 'Lakshmi PG', '9876536728', 'lakshmi.pg@outlook.com', 'Sea Educational Trust Road, Bengaluru - 560049', 'Lotus (1) Red Rose (1) ', '250', '14-Apr-2022', 'pending'),
(8, '1', 'Lakshmi PG', '111111111', 'lakshmi.pg@outlook.com', 'Sea Educational Trust Road, Bengaluru - 560049', 'Lotus(flower) (1) Red Rose(flower) (5) ', '650', '19-Apr-2022', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image`) VALUES
(2, 'Lotus(flower)', 'Fresh and aromatic flowers ', 150, '3f.jpeg'),
(4, 'Red Rose(flower)', 'Fresh flowers and aromatic ', 100, '1f.jpeg'),
(5, 'Cactus plant', 'A cactus is a kind of a plant adapted to hot, dry climates.', 100, 'cactus.jpeg'),
(7, 'Yellow rose(flower)', 'Mixed rose flowers', 100, '8f.jpeg'),
(8, 'Dahlia(flower)', 'Dahlia is a genus of plants with large brightly-colored flowers.', 150, 'dahlia.webp'),
(9, 'Snake plant', 'Snake plants have a number of health benefits, like filter indoor air, remove toxic pollutants.', 200, 'snakeplant.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'Lakshmi PG', 'lakshmi.pg@outlook.com', '202cb962ac59075b964b07152d234b70', 'user'),
(2, 'admin', 'admin@outlook.com', 'c20ad4d76fe97759aa27a0c99bff6710', 'admin'),
(3, 'Lucky', 'lucky@outlook.com', '202cb962ac59075b964b07152d234b70', 'user'),
(4, 'admin1', 'admin1@outlook.com', 'c20ad4d76fe97759aa27a0c99bff6710', 'admin'),
(5, 'Test', 'testuser@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'user admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
