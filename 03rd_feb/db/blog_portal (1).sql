-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 09, 2020 at 11:38 AM
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
-- Database: `blog_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE `blog_post` (
  `postId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `publishedAt` date NOT NULL DEFAULT current_timestamp(),
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_post`
--

INSERT INTO `blog_post` (`postId`, `userId`, `title`, `url`, `content`, `image`, `publishedAt`, `createdAt`, `updatedAt`) VALUES
(55, 35, 'fitness', 'lllll.html', 'cont', 'uploads/Screenshot (159).png', '2020-11-01', '2020-02-09 10:11:41', '2020-02-09 10:11:41'),
(56, 35, 'ccc', 'lllll.html', 'cont', 'uploads/Screenshot (162).png', '2020-12-31', '2020-02-09 10:19:07', '2020-02-09 10:19:07');

-- --------------------------------------------------------

--
-- Table structure for table `child_parent_cat`
--

CREATE TABLE `child_parent_cat` (
  `categoryId` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `metaTitle` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL,
  `image` varchar(100) NOT NULL,
  `parentCatId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `child_parent_cat`
--

INSERT INTO `child_parent_cat` (`categoryId`, `title`, `metaTitle`, `url`, `content`, `createdAt`, `updatedAt`, `image`, `parentCatId`) VALUES
(15, 'life style', 'ele', 'lll.html', 'all electic items', '2020-02-09 10:19:19', NULL, 'uploads/5.png', NULL),
(18, 'health care', 'ele', 'lll.html', 'all electic items', '2020-02-06 13:12:12', NULL, 'uploads/Screenshot (160).png', NULL),
(23, 'laptop', 'jjj', 'lll.html', 'all electic items', '2020-02-09 10:19:34', NULL, 'uploads/Screenshot (158).png', 18),
(24, 'mobile', 'ele', 'llhhhl.html', 'all electic items', '2020-02-09 10:21:29', NULL, 'uploads/Screenshot (158).png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE `post_category` (
  `postCatId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_category`
--

INSERT INTO `post_category` (`postCatId`, `postId`, `categoryId`) VALUES
(71, 55, 18),
(75, 56, 18);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `prefix` varchar(5) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `phoneNumber` bigint(10) NOT NULL,
  `emailAddress` varchar(75) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastLoginAt` timestamp NULL DEFAULT NULL,
  `selfInfo` varchar(255) NOT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `prefix`, `firstName`, `lastName`, `phoneNumber`, `emailAddress`, `password`, `lastLoginAt`, `selfInfo`, `createdAt`, `updatedAt`) VALUES
(5, 'Mrs', 'Shyam', 'Topiya', 8444515145, 'sam@gmail.com', '7363a0d0604902af7b70b271a0b96480', '2020-02-04 08:26:49', 'sam patel', '2020-02-04 08:26:49', '2020-02-03 09:41:17'),
(35, 'Mr', 'keyur', 'solanki', 9858452512, 'keyursolanki@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-02-09 09:15:22', '                keyur            ', '2020-02-09 08:36:47', '2020-02-04 09:14:28'),
(44, 'Mr', 'admin', 'admin', 1234567890, 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-02-07 12:49:20', 'lklk                            ', '2020-02-07 12:48:49', '2020-02-07 12:48:49'),
(46, 'Mr', 'Rohit', 'kotadiya', 9737967047, 'kotadiya1998@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-02-09 10:28:35', '                hhh                                        ', '2020-02-09 10:27:32', '2020-02-09 10:26:44'),
(48, 'Mr', 'Ankit', 'Patel', 8140530901, 'ankit@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-02-09 10:31:54', 'akit                            ', '2020-02-09 10:31:46', '2020-02-09 10:31:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`postId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `child_parent_cat`
--
ALTER TABLE `child_parent_cat`
  ADD PRIMARY KEY (`categoryId`),
  ADD KEY `parentCatId` (`parentCatId`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`postCatId`),
  ADD KEY `postId` (`postId`),
  ADD KEY `post_category_ibfk_3` (`categoryId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `child_parent_cat`
--
ALTER TABLE `child_parent_cat`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `postCatId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD CONSTRAINT `blog_post_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `child_parent_cat`
--
ALTER TABLE `child_parent_cat`
  ADD CONSTRAINT `child_parent_cat_ibfk_1` FOREIGN KEY (`parentCatId`) REFERENCES `child_parent_cat` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_category`
--
ALTER TABLE `post_category`
  ADD CONSTRAINT `post_category_ibfk_2` FOREIGN KEY (`postId`) REFERENCES `blog_post` (`postId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_category_ibfk_3` FOREIGN KEY (`categoryId`) REFERENCES `child_parent_cat` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
