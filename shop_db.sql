-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 12:04 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `quantity`, `image`) VALUES
(118, 3, 'bee', 200, 2, 'be_well_bee.jpg'),
(128, 21, 'Boring girls', 90, 1, 'boring_girls_a_novel.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(20, 11, 'abhishek', '7909295102', 'linto@gmail.com', 'credit card', 'flat no. 65, nethloor, Kottayam, India - 686540', ', linto baby (1) , bee (1) , boring girls (1) ', 545, '15-Nov-2023', 'delivered'),
(30, 21, 'user', '1234567890', 'user@gmail.com', 'cash on delivery', 'flat no. 12, chry, kottayam, india - 121212', ', Economics (1) , Bash and Lucy (2) ', 700, '10-Jan-2024', 'processing'),
(32, 25, 'leo', '9999999999', 'leoo@gmail.com', 'cash on delivery', 'flat no. 234, 123, kottayam, india - 123456', ', Bash and Lucy (1) , Boring girls (1) , Darknetwet (1) ', 1391, '11-Jan-2024', 'shipping');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `cust_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cust_id`, `name`, `price`, `image`, `genre`, `description`, `author`) VALUES
(34, 21, 'Be Well Bee', 250, 'be_well_bee.jpg', 'Romance', 'Be well bee', 'Cabe Lindsay'),
(35, 21, 'Darknetwet', 300, 'darknet.jpg', 'Horror,drama', 'hi\r\n', 'Euichro oda'),
(36, 21, 'Bash and Lucy', 1001, 'bash_and_lucy-2.jpg', 'Drama', 'Bash and Lucy', 'Cabe Lindsay'),
(37, 21, 'Boring girls', 90, 'boring_girls_a_novel.jpg', 'comedy', 'Boring girls', 'Cabe Lindsay'),
(38, 21, 'Clever Lands', 400, 'clever_lands.jpg', 'drama', 'Clever lands', 'Cabe Lindsay'),
(39, 21, 'Economics', 500, 'economic.jpg', 'Science', 'Economics', 'Cabe Lindsay'),
(40, 21, 'Freefall', 200, 'freefall.jpg', 'Drama', 'Freefall', 'Cabe Lindsay'),
(41, 21, 'Red Queen', 290, 'red_queen.jpg', 'Horror,drama', 'Red Queen', 'Euichro oda'),
(42, 21, 'Lloyd', 310, 'lloyd.jpg', 'Romance', 'Lloyd', 'Euichro oda');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `phone_no` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `gender`, `phone_no`, `address`, `password`, `user_type`) VALUES
(21, 'user', 'user@gmail.com', 'the_girl_of_ink_and_stars.jpg', 'male', '1234567890', 'House', '5cc32e366c87c4cb49e4309b75f57d64', 'user'),
(22, 'admin', 'admin@gmail.com', '', '', '', '', 'f6fdffe48c908deb0f4c3bd36c032e72', 'admin'),
(24, 'leo', 'leo@gmail.com', 'darknet.jpg', 'male', '', 'hhouse', 'e10adc3949ba59abbe56e057f20f883e', 'user'),
(25, 'leo', 'leoo@gmail.com', '', '', '', '', 'fcea920f7412b5da7be0cf42b8c93759', 'user'),
(26, 'milo', 'm@gmail.com', 'roronoa-zoro-purple-5120x2880-16930.jpg', '', '', '', '36f17c3939ac3e7b2fc9396fa8e953ea', 'user');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `cust_id` (`cust_id`);

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
