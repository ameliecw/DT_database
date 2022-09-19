-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 19, 2022 at 12:02 AM
-- Server version: 8.0.30-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ameliechowworn_assessment`
--

-- --------------------------------------------------------

--
-- Table structure for table `drink`
--

CREATE TABLE `drink` (
  `drink_id` tinyint UNSIGNED NOT NULL,
  `drink_name` varchar(25) NOT NULL,
  `availability` enum('available','out of stock') NOT NULL,
  `price` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `drink`
--

INSERT INTO `drink` (`drink_id`, `drink_name`, `availability`, `price`) VALUES
(1, 'Up and Go', 'available', 3.2),
(2, 'Pump Water', 'available', 3.5),
(3, 'E2', 'available', 2.8),
(4, 'Keri Juice', 'out of stock', 3.3),
(5, 'Herbal Teas', 'available', 3.5),
(6, 'English Tea', 'available', 3.5);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` tinyint UNSIGNED NOT NULL,
  `dietary` enum('v','vg','df','') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `food_name` varchar(35) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `availability` enum('available','out of stock') NOT NULL,
  `price` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `dietary`, `food_name`, `availability`, `price`) VALUES
(1, '', 'Beef Nachos', 'available', 5.5),
(2, 'v', 'Bean Nachos', 'out of stock', 5.5),
(3, 'v', 'Veg Sausage Rolls', 'available', 3),
(4, '', 'Bacon & Egg Slice', 'available', 5),
(5, 'v', 'Croissant ', 'available', 5),
(6, 'v', 'Caramel Slice ', 'available', 3.5),
(7, 'v', 'Lolly Cake ', 'out of stock', 1.8),
(8, 'v', 'Afghans ', 'available', 3),
(9, '', 'Jelly', 'available', 1.8),
(10, 'vg', 'Salad', 'available', 4.5),
(11, '', 'Panini', 'available', 5),
(12, '', 'Toasted Sandwich', 'out of stock', 3),
(13, 'v', 'Berry Muesli', 'available', 4),
(14, '', 'Sushi 4pkt ', 'available', 5),
(15, 'v', 'Scones ', 'available', 3.5),
(16, 'v', 'Black Forest Cake ', 'available', 4),
(17, 'vg', 'Fruit Salad ', 'available', 4.5);

-- --------------------------------------------------------

--
-- Table structure for table `week_specials`
--

CREATE TABLE `week_specials` (
  `week_id` tinyint UNSIGNED NOT NULL,
  `week_num` enum('1','2','3','4','5','6','7','8','9','10','11') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `food_id` tinyint UNSIGNED NOT NULL,
  `drink_id` tinyint UNSIGNED NOT NULL,
  `availability` enum('available','out of stock') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `new_price` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `week_specials`
--

INSERT INTO `week_specials` (`week_id`, `week_num`, `food_id`, `drink_id`, `availability`, `new_price`) VALUES
(1, '8', 16, 4, 'out of stock', 5),
(2, '9', 10, 1, 'available', 6),
(3, '10', 3, 2, 'available', 5.5),
(4, '6', 1, 3, 'available', 6.5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drink`
--
ALTER TABLE `drink`
  ADD PRIMARY KEY (`drink_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `week_specials`
--
ALTER TABLE `week_specials`
  ADD PRIMARY KEY (`week_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drink`
--
ALTER TABLE `drink`
  MODIFY `drink_id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `week_specials`
--
ALTER TABLE `week_specials`
  MODIFY `week_id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
