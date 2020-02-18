-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 18, 2020 at 07:11 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(50) NOT NULL,
  `urlKey` varchar(255) NOT NULL,
  `categoryImage` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `parentCategoryId` int(11) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `categoryName`, `urlKey`, `categoryImage`, `status`, `description`, `parentCategoryId`, `createdAt`, `updatedAt`) VALUES
(1, 'electronics', 'electronics', '../Public/uploads/categories/Screenshot (160).png', 1, 'dddfff', NULL, NULL, '2020-02-16 05:15:31'),
(4, 'Computers', 'computers', '../Public/uploads/categories/Screenshot (158).png', 1, 'all Computers', 1, '2020-02-15 02:54:13', NULL),
(5, 'Home Decor', 'home-decor', '../Public/uploads/categories/Screenshot (163).png', 1, 'all dedcorations hg', NULL, '2020-02-15 08:05:04', NULL),
(6, 'Footwear', 'foot-wear', '../Public/uploads/categories/Screenshot (158).png', 2, 'all footwear for all', NULL, '2020-02-15 04:38:38', NULL),
(9, 'child wear', 'child-wear', '../Public/uploads/categories/Screenshot (164).png', 1, 'all Computers', 6, '2020-02-17 03:28:15', NULL),
(10, 'mens wear', 'mens-wear', '../Public/uploads/categories/Screenshot (159).png', 1, 'all Computers', 6, '2020-02-17 03:28:36', '2020-02-17 03:29:31'),
(14, 'clothes', 'clothes', '../Public/uploads/categories/Screenshot (103).png', 1, 'all clothes', NULL, '2020-02-17 12:35:16', NULL),
(17, 'Mens Shirt', 'clothes', '../Public/uploads/Konfest-PNG-JPG-Image-Pic-Photo-Free-Download-Royalty-Unlimited-clip-art-sticker-infographicbannerchartbusinessinfo-20-1-400x388.png', 1, 'all clothes', 14, '2020-02-17 12:42:35', '2020-02-18 01:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE `cms_pages` (
  `pageId` int(11) NOT NULL,
  `pageTitle` varchar(100) NOT NULL,
  `urlKey` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`pageId`, `pageTitle`, `urlKey`, `status`, `content`, `createdAt`, `updatedAt`) VALUES
(2, 'footer', 'footer', 1, 'footer links', '2020-02-16 04:00:05', '2020-02-16 04:01:34'),
(3, 'about us', 'about-us', 1, 'jj', '2020-02-16 05:15:51', NULL),
(4, 'homePage', 'home', 1, 'home page', '2020-02-16 18:30:00', NULL),
(5, 'Contact us', 'contact-us', 1, 'method to connect with us', '2020-02-17 13:28:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `productDesc` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `stock` int(11) NOT NULL,
  `shortDesc` varchar(200) NOT NULL,
  `productImage` varchar(255) NOT NULL,
  `SKU` varchar(255) NOT NULL,
  `urlKey` varchar(255) NOT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `productName`, `productDesc`, `price`, `stock`, `shortDesc`, `productImage`, `SKU`, `urlKey`, `createdAt`, `updatedAt`, `status`) VALUES
(29, 'laptop', 'dell ', '55000', 15, '3560', '../Public/uploads/Screenshot (160).png', 'huhhkkk', 'laptop', '2020-02-15 07:51:23', '2020-02-16 04:55:25', 1),
(30, 'mobile', 'dell ', '55000', 155, '3560', '../Public/uploads/Screenshot (164).png', 'huhh', 'mobile', '2020-02-15 08:08:14', '2020-02-15 08:08:14', 1),
(32, 'lenovo laptop', 'dell ', '55000', 250, '3560', '../Public/uploads/58ef88d1657815ef08e10ad7cee40760.jpg', '120', 'lenovo-laptop', '2020-02-17 12:43:41', NULL, 1),
(33, 'gents shirt', 'dell ', '55000', 52, '3560', '../Public/uploads/Konfest-PNG-JPG-Image-Pic-Photo-Free-Download-Royalty-Unlimited-clip-art-sticker-infographicbannerchartbusinessinfo-19-1-400x490.png', '12', 'shirt', '2020-02-17 13:31:14', NULL, 1),
(34, 'formal shirt', 'long foramal shirts', '500', 25, 'shirt', '../Public/uploads/images (2).jpg', '12', 'formal-shirt', '2020-02-18 01:22:57', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `productCatId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`productCatId`, `productId`, `categoryId`) VALUES
(9, 29, 4),
(10, 30, 4),
(12, 32, 1),
(13, 33, 10),
(14, 34, 17);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `emailId` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `firstName`, `emailId`, `password`) VALUES
(1, 'Rohit', 'kotadiya1998@gmail.com', '123'),
(3, 'keyur', 'ksolanki@gmail.com', '12'),
(4, 'Shyam', 'sam@gmail.com', '123'),
(10, 'mohil', 'mohil@123gmail.com', '123'),
(11, 'Kishan', 'kishan@gmail.com', '123'),
(13, 'Afzal', 'kotadiya1998@gmail.com', '123'),
(15, 'ankit', 'kotadiya1998@gmail.com', '456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`),
  ADD KEY `parentCategoryId` (`parentCategoryId`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`pageId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`productCatId`),
  ADD KEY `categoryId` (`categoryId`),
  ADD KEY `product_category_ibfk_1` (`productId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `productCatId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parentCategoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_category_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
