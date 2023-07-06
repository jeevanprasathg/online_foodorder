-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2023 at 10:41 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orders`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `password`) VALUES
(83, 'raguprasath', '202cb962ac'),
(85, 'jeevanragu', '21232f297a'),
(88, 'balaji', 'e92bcbb1f2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(50) NOT NULL,
  `feature` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `feature`, `active`) VALUES
(55, 'Drinks', 'Food_category580.jpg', 'yes', 'yes'),
(57, 'BreakFast', 'Food_category404.jpg', 'no', 'no'),
(58, 'Dinner', 'Food_category600.jpg', 'yes', 'yes'),
(60, 'lunch', 'Food_category357.jpeg', 'yes', 'yes'),
(61, 'mcac', 'Food_category551.JPG', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(50) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `feature` varchar(20) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `feature`, `active`) VALUES
(33, 'Dosa', 'qwerty', '20.00', 'dosa.jpg', 55, 'yes', 'no'),
(35, 'Lemon Juice', 'TASTY', '15.00', 'lemon juice.jpg', 1, 'yes', 'yes'),
(36, 'Filter Coffee', 'Filter coffee', '20.00', 'coffee.jpg', 0, 'yes', 'yes'),
(37, 'French Fries', 'happy', '50.00', 'french fries.jpg', 56, 'yes', 'yes'),
(39, 'Noodles', '______', '40.00', 'Food_Name125.jpg', 1, 'yes', 'yes'),
(40, 'jeevan', 'iloveus', '32.00', '', 55, 'yes', 'yes'),
(41, 'FOOD', 'WOW', '70.00', '', 55, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(100) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Dosa', '12.00', 1, '12.00', '2022-05-28 09:58:45', 'ordered', 'jeevan', '9876543210', 'bhkj@gmail.com', 'sdf'),
(2, 'dosa', '15.00', 2, '30.00', '2022-05-28 10:06:54', 'ordered', 'admin', '9876543210', 'hi@fgh.com', 'ytdfygu'),
(3, 'Apple Juice', '30.00', 3, '90.00', '2022-05-28 12:37:50', 'ordered', 'GOPAL', '9876543210', 'bhkj@gmail.com', 'sgtdjhdgbgfnfbcvxcbccvxcvfdfsg'),
(4, 'Dosa', '20.00', 5, '100.00', '2022-06-08 07:41:40', 'ordered', 'jeevan', '9876543210', 'hi@fgh.com', 'rtghy6jyh'),
(5, 'jeevan', '32.00', 4, '128.00', '2022-06-08 07:54:23', 'ordered', 'jeevan', '9876543210', 'bhkj@gmail.com', 'kuytuy'),
(6, 'Dosa', '20.00', 1, '20.00', '2022-06-24 07:57:24', 'ordered', 'jeevan', '9876543210', 'hi@fgh.com', 'UHI'),
(7, 'Lemon Juice', '15.00', 1, '15.00', '2022-06-24 08:01:15', 'ordered', 'jee', '9876543210', 'jeevanprasath6460@gmail.com', 'KGH'),
(8, 'Filter Coffee', '20.00', 3, '60.00', '2022-06-24 08:45:42', 'ordered', 'admin', '9876543210', 'bhkj@gmail.com', 'ewter'),
(9, 'Dosa', '20.00', 1, '20.00', '2022-06-24 08:51:09', 'ordered', 'raguprasath', '9876543210', 'jeevanprasath6460@gmail.com', 'qkjd'),
(10, 'Noodles', '40.00', 2, '80.00', '2022-06-24 09:17:50', 'ordered', 'muthu', '99692995923', 'jeevanprasath6460@gmail.com', 'qheft8t65235326363'),
(11, 'French Fries', '50.00', 1, '50.00', '2022-06-24 09:26:50', 'ordered', 'admin', '9876543210', 'bhkj@gmail.com', 'ouhyyug'),
(12, 'Lemon Juice', '15.00', 7, '105.00', '2023-05-07 01:31:12', 'ordered', 'xxx', '8903674069', 'xxx@gmail.com', 'dubai'),
(13, 'Lemon Juice', '15.00', 1, '15.00', '2023-06-20 12:28:34', 'ordered', 'afddv', 'czx x', 'xvbnbb@gmail.com', 'srhtdfvzxcz'),
(14, 'Noodles', '40.00', 1, '40.00', '2023-06-30 07:06:18', 'ordered', 'vinoth', '455666', '22mcac16@kgisliim.ac.in', 'ecfvc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
