-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2020 at 12:54 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fashionboys`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `AdminID` varchar(20) NOT NULL,
  `Password` text NOT NULL,
  `LastLogDate` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`AdminID`, `Password`, `LastLogDate`) VALUES
('admin', '$2y$10$Q0oORc7jWy6BTb5HqPCMoOTxgwV91ObLBbrglCx.4lRYiAFvrCb9q', '2020-10-23');

-- --------------------------------------------------------

--
-- Table structure for table `customers_tbl`
--

CREATE TABLE `customers_tbl` (
  `CustomerID` int(20) NOT NULL,
  `Firstname` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` text NOT NULL,
  `City` varchar(100) NOT NULL,
  `StreetAddress` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers_tbl`
--

INSERT INTO `customers_tbl` (`CustomerID`, `Firstname`, `Lastname`, `Email`, `Password`, `City`, `StreetAddress`) VALUES
(1, 'david', 'david', 'test1@gmail.com', '$2y$10$OQhRXb4o1ENSVrraLyYZ/Oz35UcJSxYXpe4meV0LX3/9C5jtRw4uG', 'colombo', 'kotahena'),
(2, 'hari', 'sugeen', 'hsugeen14@gmail.com', '$2y$10$Ekr9kLr/2AAziL9ea4MBbuCRh4dICx/ZwCQPLSTfyFAySCgWnWxZ.', 'colombp', 'kotahena'),
(3, 'thilagan', 'thilak', 'Thilagan984@gmail.com', '$2y$10$7iw85zBRTZrXjSNDGmbt2.NCn0xajXWtKE.Kir7oU/pOkBNSf5jnm', 'colombo', 'kotahena');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_address`
--

CREATE TABLE `delivery_address` (
  `order_id` int(11) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `appartment` varchar(100) DEFAULT NULL,
  `ctc_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_address`
--

INSERT INTO `delivery_address` (`order_id`, `city`, `address`, `appartment`, `ctc_number`) VALUES
(1, 'colombp', 'kotahena', 'jamsine', 778981646),
(2, 'colombp', 'kotahena', 'jamsine', 887263777),
(3, 'colombp', 'kotahena', 'jamsine', 887263777);

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks_tbl`
--

CREATE TABLE `feedbacks_tbl` (
  `SenderFname` varchar(50) NOT NULL,
  `SenderLname` varchar(50) NOT NULL,
  `SenderMail` varchar(100) NOT NULL,
  `SenderMessage` longtext NOT NULL,
  `QID` int(20) NOT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `replyMsg` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedbacks_tbl`
--

INSERT INTO `feedbacks_tbl` (`SenderFname`, `SenderLname`, `SenderMail`, `SenderMessage`, `QID`, `status`, `replyMsg`) VALUES
('hari', 'sugeen', 'hsugeen14@gmail.com', 'very good service , delivered on time', 1, 'pending', NULL),
('hari', 'sugeen', 'hsugeen14@gmail.com', 'good service', 2, 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_tbl`
--

CREATE TABLE `orders_tbl` (
  `Order_id` int(20) NOT NULL,
  `CID` int(20) NOT NULL,
  `OrderStatus` varchar(50) NOT NULL DEFAULT 'Processing',
  `DateOfOrder` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_tbl`
--

INSERT INTO `orders_tbl` (`Order_id`, `CID`, `OrderStatus`, `DateOfOrder`) VALUES
(1, 2, 'Processed', '2020-10-23'),
(2, 2, 'Processed', '2020-10-23'),
(3, 2, 'Processed', '2020-10-23');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `p_size` varchar(50) NOT NULL,
  `p_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `product_id`, `p_size`, `p_quantity`) VALUES
(1, 1, 'Medium', 1),
(2, 52, 'Medium', 1),
(3, 1, 'Medium', 1),
(3, 2, 'Large', 1),
(3, 52, 'Medium', 1),
(3, 53, 'Medium', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_brands`
--

CREATE TABLE `product_brands` (
  `BrandID` int(20) NOT NULL,
  `BrandName` varchar(100) NOT NULL,
  `BrandImage` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_brands`
--

INSERT INTO `product_brands` (`BrandID`, `BrandName`, `BrandImage`) VALUES
(1, 'Levi\'s', 'Levi\'s.png'),
(2, 'uniqlo', 'uniqlo.png'),
(3, 'Everlane', 'Everlane.png'),
(4, 'Gap', 'Gap.png');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `CID` int(11) NOT NULL,
  `PID` int(11) NOT NULL,
  `Ratings` float NOT NULL,
  `Comments` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shirts_tbl`
--

CREATE TABLE `shirts_tbl` (
  `Product_id` int(20) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Description` longtext NOT NULL,
  `ProductType` int(11) DEFAULT NULL,
  `Brand` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shirts_tbl`
--

INSERT INTO `shirts_tbl` (`Product_id`, `ProductName`, `Description`, `ProductType`, `Brand`) VALUES
(2, 'full sleeve shirt - blue01', 'made of pure cotton', 1, 1),
(3, 'full sleeve shirt - blue03', 'made of pure cotton', 1, 3),
(4, 'full sleeve shirt - blue04', 'made of pure cotton', 1, 4),
(5, 'full sleeve shirt - blue05', 'made of pure cotton', 1, 4),
(6, 'full sleeve shirt - red', 'made of pure cotton', 1, 2),
(7, 'full sleeve shirt - blue06', 'made of pure cotton', 1, 1),
(8, 'full sleeve shirt - orange', 'made of pure cotton', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `shirt_details`
--

CREATE TABLE `shirt_details` (
  `PID` int(20) NOT NULL,
  `Size` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `ProductImage` longtext NOT NULL,
  `Quantity` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shirt_details`
--

INSERT INTO `shirt_details` (`PID`, `Size`, `Price`, `ProductImage`, `Quantity`) VALUES
(2, 'Large', 2150, 'full sleeve shirt - blue01-Large-5f901270e323b1.67842786.png', 20),
(3, 'Large', 1650, 'full sleeve shirt - blue03-Large-5f9188cc308cd7.62385138.png', 20),
(4, 'Large', 1950, 'full sleeve shirt - blue04-Large-5f91890ac61025.96958327.png', 20),
(5, 'Large', 2150, 'full sleeve shirt - blue05-Large-5f91897c384137.53067694.png', 20),
(6, 'Large', 2390, 'full sleeve shirt - red-Large-5f9189e40bfa49.78751937.png', 20),
(7, 'Large', 2290, 'full sleeve shirt - blue06-Large-5f918a0e812f76.98231693.png', 20),
(8, 'Medium', 1790, 'full sleeve shirt - orange-Medium-5f918a3073b320.05564272.png', 20);

-- --------------------------------------------------------

--
-- Table structure for table `shirt_type`
--

CREATE TABLE `shirt_type` (
  `PTID` int(20) NOT NULL,
  `ProductType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shirt_type`
--

INSERT INTO `shirt_type` (`PTID`, `ProductType`) VALUES
(1, 'full sleeve'),
(2, 'short sleeve');

-- --------------------------------------------------------

--
-- Table structure for table `trouser_details`
--

CREATE TABLE `trouser_details` (
  `TID` int(20) NOT NULL,
  `Size` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `ProductImage` longtext NOT NULL,
  `Quantity` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trouser_details`
--

INSERT INTO `trouser_details` (`TID`, `Size`, `Price`, `ProductImage`, `Quantity`) VALUES
(50, 'Medium', 1750, 'cotton trouser ct001-Medium-5f928c226da9e4.96647687.png', 20),
(51, 'Medium', 1890, 'cotton trouser ct002-Medium-5f928c57d2fc82.78434309.png', 20),
(52, 'Medium', 2190, 'cotton trouser ct003-Medium-5f928c7f394f99.75101560.png', 20),
(53, 'Medium', 2390, 'cotton trouser ct004-Medium-5f928caf988010.94330980.png', 20);

-- --------------------------------------------------------

--
-- Table structure for table `trouser_tbl`
--

CREATE TABLE `trouser_tbl` (
  `Trouser_id` int(20) NOT NULL,
  `TrouserName` varchar(100) NOT NULL,
  `Description` longtext NOT NULL,
  `TrouserType` int(11) DEFAULT NULL,
  `Brand` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trouser_tbl`
--

INSERT INTO `trouser_tbl` (`Trouser_id`, `TrouserName`, `Description`, `TrouserType`, `Brand`) VALUES
(50, 'cotton trouser ct001', 'made of pure cotton', 1, 1),
(51, 'cotton trouser ct002', 'made of pure cotton', 1, 2),
(52, 'cotton trouser ct003', 'made of pure cotton', 1, 3),
(53, 'cotton trouser ct004', 'made of pure cotton', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `trouser_type`
--

CREATE TABLE `trouser_type` (
  `PTID` int(20) NOT NULL,
  `TrouserType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trouser_type`
--

INSERT INTO `trouser_type` (`PTID`, `TrouserType`) VALUES
(1, 'Cotton'),
(2, 'Denim');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `customers_tbl`
--
ALTER TABLE `customers_tbl`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `feedbacks_tbl`
--
ALTER TABLE `feedbacks_tbl`
  ADD PRIMARY KEY (`QID`);

--
-- Indexes for table `orders_tbl`
--
ALTER TABLE `orders_tbl`
  ADD PRIMARY KEY (`Order_id`),
  ADD KEY `CID` (`CID`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD KEY `order_details_ibfk_1` (`order_id`),
  ADD KEY `order_details_ibfk_2` (`product_id`);

--
-- Indexes for table `product_brands`
--
ALTER TABLE `product_brands`
  ADD PRIMARY KEY (`BrandID`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD KEY `product_reviews_ibfk_1` (`PID`),
  ADD KEY `CID` (`CID`);

--
-- Indexes for table `shirts_tbl`
--
ALTER TABLE `shirts_tbl`
  ADD PRIMARY KEY (`Product_id`),
  ADD KEY `Brand` (`Brand`),
  ADD KEY `shirts_tbl_ibfk_2` (`ProductType`);

--
-- Indexes for table `shirt_details`
--
ALTER TABLE `shirt_details`
  ADD KEY `PID` (`PID`);

--
-- Indexes for table `shirt_type`
--
ALTER TABLE `shirt_type`
  ADD PRIMARY KEY (`PTID`);

--
-- Indexes for table `trouser_details`
--
ALTER TABLE `trouser_details`
  ADD KEY `TID` (`TID`);

--
-- Indexes for table `trouser_tbl`
--
ALTER TABLE `trouser_tbl`
  ADD PRIMARY KEY (`Trouser_id`),
  ADD KEY `Brand` (`Brand`),
  ADD KEY `trouser_tbl_ibfk_2` (`TrouserType`);

--
-- Indexes for table `trouser_type`
--
ALTER TABLE `trouser_type`
  ADD PRIMARY KEY (`PTID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers_tbl`
--
ALTER TABLE `customers_tbl`
  MODIFY `CustomerID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedbacks_tbl`
--
ALTER TABLE `feedbacks_tbl`
  MODIFY `QID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders_tbl`
--
ALTER TABLE `orders_tbl`
  MODIFY `Order_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_brands`
--
ALTER TABLE `product_brands`
  MODIFY `BrandID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shirts_tbl`
--
ALTER TABLE `shirts_tbl`
  MODIFY `Product_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shirt_type`
--
ALTER TABLE `shirt_type`
  MODIFY `PTID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trouser_tbl`
--
ALTER TABLE `trouser_tbl`
  MODIFY `Trouser_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `trouser_type`
--
ALTER TABLE `trouser_type`
  MODIFY `PTID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`PID`) REFERENCES `shirts_tbl` (`Product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_reviews_ibfk_2` FOREIGN KEY (`CID`) REFERENCES `customers_tbl` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shirts_tbl`
--
ALTER TABLE `shirts_tbl`
  ADD CONSTRAINT `shirts_tbl_ibfk_2` FOREIGN KEY (`ProductType`) REFERENCES `shirt_type` (`PTID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `shirts_tbl_ibfk_3` FOREIGN KEY (`Brand`) REFERENCES `product_brands` (`BrandID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `shirt_details`
--
ALTER TABLE `shirt_details`
  ADD CONSTRAINT `shirt_details_ibfk_1` FOREIGN KEY (`PID`) REFERENCES `shirts_tbl` (`Product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trouser_details`
--
ALTER TABLE `trouser_details`
  ADD CONSTRAINT `trouser_details_ibfk_1` FOREIGN KEY (`TID`) REFERENCES `trouser_tbl` (`Trouser_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
