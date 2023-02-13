-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2019 at 09:38 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catid` int(11) NOT NULL,
  `category` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catid`, `category`) VALUES
(1, 'Mobile'),
(2, 'Laptop'),
(4, 'Computer'),
(6, 'Tablets'),
(9, 'ipad'),
(10, 'bags'),
(11, 'Toys'),
(12, 'Books'),
(13, 'Headphones'),
(14, 'Speakers'),
(15, 'Baby Products'),
(16, 'Furnitures'),
(17, 'Mobile Cases'),
(18, 'Mobile Covers'),
(19, 'Mobile Screen Protectors'),
(20, 'Power Banks'),
(21, 'Pen Drives'),
(22, 'Memory Cards'),
(23, 'Printers'),
(24, 'Monitors'),
(25, 'Security Camaras'),
(26, 'Watches'),
(27, 'Sun Glasses'),
(28, 'Shoes'),
(29, 'Wallets'),
(30, 'Smart Watches'),
(31, 'Hard Disk'),
(32, 'External Hard Disks'),
(33, 'Bluetooth Speakers'),
(34, 'Lens'),
(35, 'Tripod'),
(36, 'Bp Monitors');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `invoice_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `subtotal` double NOT NULL,
  `tax` double NOT NULL,
  `discount` double NOT NULL,
  `total` double NOT NULL,
  `paid` double NOT NULL,
  `due` double NOT NULL,
  `payment_type` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`invoice_id`, `customer_name`, `order_date`, `subtotal`, `tax`, `discount`, `total`, `paid`, `due`, `payment_type`) VALUES
(8, 'salman', '2019-04-29', 7500, 375, 0, 7875, 40000, 7875, 'Card'),
(9, 'salman', '2019-04-29', 7500, 375, 0, 7875, 40000, 7875, 'Card'),
(10, 'salman', '2019-04-29', 7500, 375, 0, 7875, 40000, 7875, 'Card'),
(11, 'salman', '2019-04-29', 7500, 375, 0, 7875, 40000, 7875, 'Card'),
(12, 'salman', '2019-04-29', 7500, 375, 0, 7875, 40000, 7875, 'Card'),
(13, 'salman', '2019-04-29', 15000, 750, 0, 15750, 40000, 15750, 'Check'),
(14, 'faizan', '2019-05-12', 14400, 720, 0, 15120, 0, 15120, 'Cash'),
(15, 'Salah uddin', '2019-05-12', 92000, 4600, 0, 96600, 100000, -3400, 'Cash'),
(19, 'Omar ', '2019-05-13', 1250, 62.5, 0, 1312.5, 1500, -187.5, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_details`
--

CREATE TABLE `tbl_invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice_details`
--

INSERT INTO `tbl_invoice_details` (`id`, `invoice_id`, `product_id`, `product_name`, `qty`, `price`, `order_date`) VALUES
(17, 8, 8, 'Apple iPad Air', 1, 700, '2019-04-27'),
(18, 8, 6, 'Apple MacBook Pro', 1, 1250, '2019-04-27'),
(19, 9, 6, 'Apple MacBook Pro', 1, 1250, '2019-04-27'),
(20, 9, 3, 'Hard disk', 1, 150, '2019-04-27'),
(21, 10, 8, 'Apple iPad Air', 10, 700, '2019-04-29'),
(59, 12, 8, '', 20, 700, '2019-04-29'),
(61, 11, 8, '', 20, 700, '2019-04-29'),
(67, 13, 3, '', 100, 150, '2019-04-29'),
(72, 14, 10, '', 16, 900, '2019-05-12'),
(98, 15, 5, '', 20, 450, '2019-05-12'),
(99, 15, 4, '', 83, 1000, '2019-05-12'),
(103, 19, 6, '', 1, 1250, '2019-05-13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `pid` int(11) NOT NULL,
  `pname` varchar(200) NOT NULL,
  `pcategory` varchar(200) NOT NULL,
  `purchaseprice` float NOT NULL,
  `saleprice` float NOT NULL,
  `pstock` int(11) NOT NULL,
  `pdescription` varchar(250) NOT NULL,
  `pimage` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pid`, `pname`, `pcategory`, `purchaseprice`, `saleprice`, `pstock`, `pdescription`, `pimage`) VALUES
(2, 'samsung', 'Mobile', 800, 1200, 41, 'test', '5c725dcab2afe.jpg'),
(3, 'Hard disk', 'Computer', 100, 150, 100, 'test  hard disk      ', '5c8352535c345.jpg'),
(4, 'Nokia Mobile Lumia', 'Mobile', 300, 1000, 1010, 'test Nokia        ', '5c835348cdfbc.jpg'),
(5, 'Redmi 5A', 'Mobile', 300, 450, 40, 'Red,Blue,Black color available', '5c738c1e4a813.jpeg'),
(6, 'Apple MacBook Pro', 'Computer', 1000, 1250, 764, 'Apple MacBook Pro ME865LL/A 13.3-Inch with Retina Display 8GB RAM, 256GB SSD ', '5c738c6be100a.jpg'),
(7, 'Apple iPad Pro', 'ipad', 500, 650, 137, 'Apple iPad Pro 12.9-Inch 64GB Space Gray', '5c738cf15aa2b.jpg'),
(8, 'Apple iPad Air', 'ipad', 500, 700, 126, 'Apple iPad Air MD785LL/B (16GB, Wi-FI, Black with Space Gray)', '5c738d2e492d0.jpg'),
(9, 'Samsung Galaxy Tab', 'Tablets', 500, 650, 40, 'SM-T590NZKAXAR Galaxy Tab A, 10.5\", Black ', '5c738db0931f7.jpg'),
(10, 'Lenovo Miix 630 Laptop', 'Laptop', 700, 900, 74, 'Qualcomm Snapdragon 835, 4 GB LPDDR4X, 128 GB UFS 2.1, Windows 10 S', '5c738e0089024.jpg'),
(11, 'Lenovo ThinkPad Helix', 'Laptop', 600, 850, 100, 'Intel Core M Dual-Core, 128GB SSD, 4GB RAM, 11.6\" FHD (1920x1080) Touch Screen  Windows 10  ', '5c738e7aae9a7.jpg'),
(12, 'Nokia 2 - Android - 8GB', 'Mobile', 500, 750, 999, 'AT&T/T-Mobile/MetroPCS/Cricket/H2O) - 5\" Screen - White   ', '5c738f3b2083c.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `useremail` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `username`, `useremail`, `password`, `role`) VALUES
(1, 'Faizan', 'faizan@gmail.com', '12', 'Admin'),
(2, 'Mohsin', 'mohsin@gmail.com', '1234', 'User'),
(9, 'Farhan', 'farhan@hotmail.com', '123', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `tbl_invoice_details`
--
ALTER TABLE `tbl_invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_invoice_details`
--
ALTER TABLE `tbl_invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
