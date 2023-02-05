-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2023 at 02:22 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `custName` varchar(255) DEFAULT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `custNumber` varchar(255) DEFAULT NULL,
  `custEmail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `id` int(11) NOT NULL,
  `fkCustomerId` int(11) NOT NULL,
  `homeAddress` varchar(255) DEFAULT NULL,
  `officeAddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_cart`
--

CREATE TABLE `customer_cart` (
  `id` int(11) NOT NULL,
  `fkCustomerId` int(11) NOT NULL,
  `fkProductId` int(11) NOT NULL,
  `cartItems` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_payment`
--

CREATE TABLE `customer_payment` (
  `id` int(11) NOT NULL,
  `fkCustomerId` int(11) NOT NULL,
  `paymentMethod` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_wishlist`
--

CREATE TABLE `customer_wishlist` (
  `id` int(11) NOT NULL,
  `fkCustomerId` int(11) NOT NULL,
  `fkProductId` int(11) NOT NULL,
  `wishlistProduct` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `fkCustomerId` int(11) NOT NULL,
  `orderType` char(10) NOT NULL,
  `orderDate` date DEFAULT NULL,
  `totalAmount` int(11) DEFAULT NULL,
  `shippingAddress` varchar(255) DEFAULT NULL,
  `paymentMethod` varchar(255) DEFAULT NULL,
  `status` char(3) DEFAULT 'I'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_email`
--

CREATE TABLE `order_email` (
  `id` int(11) NOT NULL,
  `fkOrderId` int(11) NOT NULL,
  `emailType` varchar(255) DEFAULT NULL,
  `emailTo` varchar(255) DEFAULT NULL,
  `emailSubject` varchar(255) DEFAULT NULL,
  `emailBody` varchar(255) DEFAULT NULL,
  `status` char(3) DEFAULT 'I'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `fkOrderId` int(11) NOT NULL,
  `fkProductId` int(11) NOT NULL,
  `unitPrice` int(11) DEFAULT NULL,
  `itemQuantity` int(11) DEFAULT NULL,
  `totalPrice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `fkOrderId` int(11) NOT NULL,
  `orderStatusName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `productPrice` int(11) DEFAULT NULL,
  `productQty` int(11) DEFAULT NULL,
  `productDesc` text DEFAULT NULL,
  `productImg` varchar(255) DEFAULT NULL,
  `dateCreated` date DEFAULT NULL,
  `useridCreated` int(11) NOT NULL,
  `dateUpdated` varchar(255) DEFAULT NULL,
  `useridUpdated` varchar(255) DEFAULT NULL,
  `status` char(3) DEFAULT 'I'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_ratings`
--

CREATE TABLE `product_ratings` (
  `id` int(11) NOT NULL,
  `fkProductId` int(11) NOT NULL,
  `fkRoleId` int(11) NOT NULL,
  `ratings` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_stock`
--

CREATE TABLE `product_stock` (
  `id` int(11) NOT NULL,
  `fkProductId` int(11) NOT NULL,
  `fkVendorId` int(11) NOT NULL,
  `qtyOnHand` int(11) DEFAULT NULL,
  `newQty` int(11) DEFAULT NULL,
  `totalQty` int(11) DEFAULT NULL,
  `dateOfPruch` date DEFAULT NULL,
  `status` char(3) DEFAULT 'I'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_request`
--

CREATE TABLE `stock_request` (
  `id` int(11) NOT NULL,
  `fkVendor` int(11) NOT NULL,
  `status` char(3) DEFAULT 'I',
  `requestDate` datetime DEFAULT NULL,
  `noOfItems` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_request_prod`
--

CREATE TABLE `stock_request_prod` (
  `id` int(11) NOT NULL,
  `fkProductId` int(11) NOT NULL,
  `fkStockRequest` int(11) NOT NULL,
  `requestStock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_request_status`
--

CREATE TABLE `stock_request_status` (
  `id` int(11) NOT NULL,
  `fkStockRequest` int(11) NOT NULL,
  `requestStatusName` varchar(255) DEFAULT NULL,
  `status` char(3) DEFAULT 'I'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fkRoleId` int(11) NOT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `status` char(3) DEFAULT 'I'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` char(3) DEFAULT 'I'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `vendorName` varchar(255) DEFAULT NULL,
  `vendorAddress` varchar(255) DEFAULT NULL,
  `vendorPhone` varchar(255) DEFAULT NULL,
  `vendorEmail` varchar(255) DEFAULT NULL,
  `status` char(3) DEFAULT 'I'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkCustomerId` (`fkCustomerId`);

--
-- Indexes for table `customer_cart`
--
ALTER TABLE `customer_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkCustomerId` (`fkCustomerId`),
  ADD KEY `fkProductId` (`fkProductId`);

--
-- Indexes for table `customer_payment`
--
ALTER TABLE `customer_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkCustomerId` (`fkCustomerId`);

--
-- Indexes for table `customer_wishlist`
--
ALTER TABLE `customer_wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkCustomerId` (`fkCustomerId`),
  ADD KEY `fkProductId` (`fkProductId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkCustomerId` (`fkCustomerId`);

--
-- Indexes for table `order_email`
--
ALTER TABLE `order_email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkOrderId` (`fkOrderId`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkOrderId` (`fkOrderId`),
  ADD KEY `fkProductId` (`fkProductId`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkOrderId` (`fkOrderId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkProductId` (`fkProductId`),
  ADD KEY `fkRoleId` (`fkRoleId`);

--
-- Indexes for table `product_stock`
--
ALTER TABLE `product_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkProductId` (`fkProductId`),
  ADD KEY `fkVendorId` (`fkVendorId`);

--
-- Indexes for table `stock_request`
--
ALTER TABLE `stock_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkVendor` (`fkVendor`);

--
-- Indexes for table `stock_request_prod`
--
ALTER TABLE `stock_request_prod`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkProductId` (`fkProductId`),
  ADD KEY `fkStockRequest` (`fkStockRequest`);

--
-- Indexes for table `stock_request_status`
--
ALTER TABLE `stock_request_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkStockRequest` (`fkStockRequest`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkRoleId` (`fkRoleId`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`fkCustomerId`) REFERENCES `customer` (`id`);

--
-- Constraints for table `customer_cart`
--
ALTER TABLE `customer_cart`
  ADD CONSTRAINT `customer_cart_ibfk_1` FOREIGN KEY (`fkCustomerId`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `customer_cart_ibfk_2` FOREIGN KEY (`fkProductId`) REFERENCES `product` (`id`);

--
-- Constraints for table `customer_payment`
--
ALTER TABLE `customer_payment`
  ADD CONSTRAINT `customer_payment_ibfk_1` FOREIGN KEY (`fkCustomerId`) REFERENCES `customer` (`id`);

--
-- Constraints for table `customer_wishlist`
--
ALTER TABLE `customer_wishlist`
  ADD CONSTRAINT `customer_wishlist_ibfk_1` FOREIGN KEY (`fkCustomerId`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `customer_wishlist_ibfk_2` FOREIGN KEY (`fkProductId`) REFERENCES `product` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`fkCustomerId`) REFERENCES `customer` (`id`);

--
-- Constraints for table `order_email`
--
ALTER TABLE `order_email`
  ADD CONSTRAINT `order_email_ibfk_1` FOREIGN KEY (`fkOrderId`) REFERENCES `orders` (`id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`fkOrderId`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`fkProductId`) REFERENCES `product` (`id`);

--
-- Constraints for table `order_status`
--
ALTER TABLE `order_status`
  ADD CONSTRAINT `order_status_ibfk_1` FOREIGN KEY (`fkOrderId`) REFERENCES `orders` (`id`);

--
-- Constraints for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD CONSTRAINT `product_ratings_ibfk_1` FOREIGN KEY (`fkProductId`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `product_ratings_ibfk_2` FOREIGN KEY (`fkRoleId`) REFERENCES `user_role` (`id`);

--
-- Constraints for table `product_stock`
--
ALTER TABLE `product_stock`
  ADD CONSTRAINT `product_stock_ibfk_1` FOREIGN KEY (`fkProductId`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `product_stock_ibfk_2` FOREIGN KEY (`fkVendorId`) REFERENCES `vendor` (`id`);

--
-- Constraints for table `stock_request`
--
ALTER TABLE `stock_request`
  ADD CONSTRAINT `stock_request_ibfk_1` FOREIGN KEY (`fkVendor`) REFERENCES `vendor` (`id`);

--
-- Constraints for table `stock_request_prod`
--
ALTER TABLE `stock_request_prod`
  ADD CONSTRAINT `stock_request_prod_ibfk_1` FOREIGN KEY (`fkProductId`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `stock_request_prod_ibfk_2` FOREIGN KEY (`fkStockRequest`) REFERENCES `stock_request` (`id`);

--
-- Constraints for table `stock_request_status`
--
ALTER TABLE `stock_request_status`
  ADD CONSTRAINT `stock_request_status_ibfk_1` FOREIGN KEY (`fkStockRequest`) REFERENCES `stock_request` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`fkRoleId`) REFERENCES `user_role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
