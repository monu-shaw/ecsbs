-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 18, 2024 at 01:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecsbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `sellerId` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `Image`, `sellerId`, `slug`, `createdAt`) VALUES
(1, 'pets fooda', 'https://i.ibb.co/w01dPCX/unnamed.jpg', 1, 'pets-foodsG2zg', '2024-03-15 13:37:29'),
(2, 'Inner Wear', 'https://i.ibb.co/XbmDsMS/Screenshot-from-2024-03-14-17-38-24.png', 1, 'inner-wearO3HY', '2024-03-15 14:46:00'),
(3, 'Shirt', 'https://i.ibb.co/2vn2vfj/It-s-Not-A-Bug-It-s-A-Feature-Half-Sleeve-Bottle-Green-scaled-1-112169.jpg', 1, 'shirtYw5m', '2024-03-15 14:58:40'),
(4, 'chaman', 'https://i.ibb.co/6sdRj8H/39084181.png', 1, 'chamanLFr5', '2024-03-15 16:30:05'),
(6, 'new testjkl', 'https://i.ibb.co/6sdRj8H/39084181.png', 1, 'new-testOgKc', '2024-03-15 17:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `orderItem`
--

CREATE TABLE `orderItem` (
  `orderId` varchar(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderItem`
--

INSERT INTO `orderItem` (`orderId`, `productId`, `quantity`, `date`) VALUES
('aq9IS', 12, 1, '2024-03-18 15:50:31'),
('PSU1V', 12, 1, '2024-03-18 15:55:05'),
('xZBpd', 1, 1, '2024-03-18 16:15:22'),
('xZBpd', 12, 1, '2024-03-18 16:15:22'),
('m9h1W', 11, 1, '2024-03-18 17:56:12'),
('m9h1W', 12, 1, '2024-03-18 17:56:12');

-- --------------------------------------------------------

--
-- Table structure for table `ordertable`
--

CREATE TABLE `ordertable` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `customerPhone` varchar(255) NOT NULL,
  `customerAddress` varchar(255) NOT NULL,
  `customerPincode` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `sellerId` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `orderId` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordertable`
--

INSERT INTO `ordertable` (`id`, `amount`, `customerName`, `customerPhone`, `customerAddress`, `customerPincode`, `date`, `sellerId`, `status`, `orderId`) VALUES
(1, 200, '', '', '', 700060, '2024-03-18 15:42:12', 1, 'pending', 'XvLJY'),
(2, 100, 'raju', '1425369857', 'pdkhkfg dnmlfg', 700060, '2024-03-18 15:47:28', 1, 'pending', 'E4GUq'),
(3, 100, 'ammn', '7896584221', 'pdkhkfg dnmlfg', 700060, '2024-03-18 15:48:26', 1, 'pending', 'dWa8u'),
(4, 100, 'ammn', '1425369857', 'pdkhkfg dnmlfg', 700060, '2024-03-18 15:49:23', 1, 'pending', 'J40VK'),
(5, 100, 'ammn', '1425369857', 'pdkhkfg dnmlfg', 700060, '2024-03-18 15:50:31', 1, 'pending', 'aq9IS'),
(6, 100, 'ammn', '7896584221', 'pdkhkfg dnmlfg', 700060, '2024-03-18 15:55:05', 1, 'pending', 'PSU1V'),
(7, 100, 'raju', '7896584221', 'pdkhkfg dnmlfg', 700060, '2024-03-18 16:15:22', 1, 'pending', 'xZBpd'),
(8, 100, 'ammn', '7896584221', 'pdkhkfg dnmlfg', 700060, '2024-03-18 17:56:12', 1, 'pending', 'm9h1W');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `mrp` int(11) NOT NULL DEFAULT 0,
  `MeasuringSize` varchar(255) NOT NULL,
  `MeasuringUnit` varchar(255) NOT NULL,
  `Image` varchar(500) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `SellerId` int(11) NOT NULL,
  `slug` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `mrp`, `MeasuringSize`, `MeasuringUnit`, `Image`, `Description`, `CategoryId`, `SellerId`, `slug`) VALUES
(1, 'shirtji', 0, 0, '1', 'fsdfsd', 'https://i.ibb.co/2vn2vfj/It-s-Not-A-Bug-It-s-A-Feature-Half-Sleeve-Bottle-Green-scaled-1-112169.jpg', 'dsfdfs', 3, 1, 'shirtjNWB'),
(2, 'Sama Sayaksxzzxss', 0, 0, '1', 'dsadsd', 'https://i.ibb.co/6sdRj8H/39084181.png', 'dsadfas', 4, 1, 'sama-sayakvXYh'),
(6, 'Sam', 0, 0, '1', 's', 'https://i.ibb.co/w01dPCX/unnamed.jpg', 'zxcsad', 2, 1, 'samtVoJ'),
(7, 'kasla', 0, 0, '1', 'asas', 'https://i.ibb.co/w01dPCX/unnamed.jpg', 'asasas', 4, 1, 'kaslaQdw2'),
(9, 'monu', 0, 0, '1', 'dsadsd', 'https://i.ibb.co/2vn2vfj/It-s-Not-A-Bug-It-s-A-Feature-Half-Sleeve-Bottle-Green-scaled-1-112169.jpg', 'jjj', 3, 1, 'monutglx'),
(10, 'monu', 0, 0, '1', 'sadasd', 'https://i.ibb.co/XbmDsMS/Screenshot-from-2024-03-14-17-38-24.png', 'sdcsa', 1, 1, 'monumS3a'),
(11, 'test212', 0, 0, '1', 'ds', 'https://i.ibb.co/6sdRj8H/39084181.png', 'zdds', 1, 1, 'test7u8B'),
(12, 'INSHOET sayak', 100, 500, '1', 'pc', 'https://i.ibb.co/xLXcnZs/banner6-1.jpg', 'fjsekfjsklfsd&amp;lt;br&amp;gt;fjsdfjkkdsf&amp;lt;br&amp;gt;jmsdlkfjlksdf&amp;lt;br&amp;gt;sdnfjsdjkfsd&amp;lt;br&amp;gt;jsdlkfjsdkf', 4, 1, 'inshoet-test17Lg');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id` int(11) NOT NULL,
  `sellerName` varchar(255) NOT NULL,
  `businessName` varchar(100) NOT NULL,
  `businessAddress` varchar(225) NOT NULL,
  `country` varchar(50) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `sellerName`, `businessName`, `businessAddress`, `country`, `currency`, `email`, `phone`, `password`, `slug`, `createdOn`) VALUES
(1, 'Kirk Kirby', 'Kirby Long', 'Dolor est cumque dol', 'INDIA', 'INR', 'wepapeqik@mailinator.com', '17691699765', '$2y$10$FRkszbULAA363Fvu/4tzcu6qWS48Oi5bDxg7hbWwcwTVIXFTNwFS2', 'kirby-long1Whf', '2024-03-15 13:34:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `onDelete` (`sellerId`);

--
-- Indexes for table `ordertable`
--
ALTER TABLE `ordertable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ordertable`
--
ALTER TABLE `ordertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `onDelete` FOREIGN KEY (`sellerId`) REFERENCES `seller` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
