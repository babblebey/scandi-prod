-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 10.123.0.54:3306
-- Generation Time: Jun 09, 2023 at 03:19 PM
-- Server version: 8.0.22
-- PHP Version: 7.0.33-0+deb9u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scandiprod`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int NOT NULL,
  `product_sku` varchar(255) DEFAULT NULL,
  `weight` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 TABLESPACE `scandiprod`;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `product_sku`, `weight`) VALUES
(1, 'BKT20015A', 2),
(2, 'BKZ20317C', 3),
(3, 'BK0568720', 2);

-- --------------------------------------------------------

--
-- Table structure for table `dvd`
--

CREATE TABLE `dvd` (
  `id` int NOT NULL,
  `product_sku` varchar(255) DEFAULT NULL,
  `size` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 TABLESPACE `scandiprod`;

--
-- Dumping data for table `dvd`
--

INSERT INTO `dvd` (`id`, `product_sku`, `size`) VALUES
(1, 'DVR67564V', 500),
(2, 'DVR77127V', 200),
(3, 'DVU215756', 600);

-- --------------------------------------------------------

--
-- Table structure for table `furniture`
--

CREATE TABLE `furniture` (
  `id` int NOT NULL,
  `product_sku` varchar(255) DEFAULT NULL,
  `dimension` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 TABLESPACE `scandiprod`;

--
-- Dumping data for table `furniture`
--

INSERT INTO `furniture` (`id`, `product_sku`, `dimension`) VALUES
(1, 'FT671258V', '21x42x12'),
(2, 'FTB6512GX', '43x33x22'),
(3, 'FT594275X', '8x9x8'),
(4, 'FTR02458X', '21x24x23');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 TABLESPACE `scandiprod`;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `sku`, `name`, `price`, `type`) VALUES
(1, 'BKT20015A', 'The Daily Stoic', '50.00', 'Book'),
(2, 'BKZ20317C', 'Think & Grow Rich', '30.00', 'Book'),
(3, 'DVR67564V', 'Harry Potter', '14.50', 'DVD'),
(4, 'DVR77127V', 'Star Wars', '34.00', 'DVD'),
(5, 'FT671258V', 'Dike Bed/Side Table', '34.00', 'Furniture'),
(5, 'FTB6512GX', 'V.Amakisi Console', '560.00', 'Furniture'),
(7, 'FT594275X', 'Zigi Lounger', '12.00', 'Furniture'),
(8, 'FTR02458X', 'Ada L-Shaped Sofa', '345.00', 'Furniture'),
(9, 'DVU215756', 'Battleship', '12.50', 'DVD'),
(10, 'BK0568720', 'Atomic Habit', '23.00', 'Book');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_sku` (`product_sku`);

--
-- Indexes for table `dvd`
--
ALTER TABLE `dvd`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_sku` (`product_sku`);

--
-- Indexes for table `furniture`
--
ALTER TABLE `furniture`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_sku` (`product_sku`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dvd`
--
ALTER TABLE `dvd`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `furniture`
--
ALTER TABLE `furniture`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`product_sku`) REFERENCES `product` (`sku`);

--
-- Constraints for table `dvd`
--
ALTER TABLE `dvd`
  ADD CONSTRAINT `dvd_ibfk_1` FOREIGN KEY (`product_sku`) REFERENCES `product` (`sku`);

--
-- Constraints for table `furniture`
--
ALTER TABLE `furniture`
  ADD CONSTRAINT `furniture_ibfk_1` FOREIGN KEY (`product_sku`) REFERENCES `product` (`sku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
