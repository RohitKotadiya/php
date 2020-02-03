-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 03, 2020 at 01:12 PM
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
  `blogURL` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `publishedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_post`
--

INSERT INTO `blog_post` (`postId`, `userId`, `title`, `blogURL`, `content`, `image`, `publishedAt`, `createdAt`, `updatedAt`) VALUES
(3, 5, 'tt', 'iii.html', 'cont', 'uploads/Capture.PNG', '2020-12-31 11:32:33', '2020-02-03 11:53:33', '2020-02-03 11:53:33'),
(4, 5, 'tt', 'iii.html', 'cont', 'uploads/Capture.PNG', '2020-12-31 11:32:53', '2020-02-03 11:54:53', '2020-02-03 11:54:53'),
(5, 5, 'tt', 'iii.html', 'cont', 'uploads/Capture.PNG', '2020-12-31 11:32:02', '2020-02-03 11:55:02', '2020-02-03 11:55:02'),
(6, 5, 'tt', 'iii.html', 'cont', 'uploads/Capture.PNG', '2020-12-31 11:32:12', '2020-02-03 11:57:12', '2020-02-03 11:57:12'),
(7, 5, 'tt', 'iii.html', 'cont', 'uploads/Capture.PNG', '2020-12-31 11:32:26', '2020-02-03 11:58:26', '2020-02-03 11:58:26'),
(8, 5, 'tt', 'iii.html', 'cont', 'uploads/Capture.PNG', '2020-12-31 11:32:39', '2020-02-03 11:58:39', '2020-02-03 11:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `parentCatId` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `metaTitle` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `parentCatId`, `title`, `metaTitle`, `url`, `content`, `createdAt`, `updatedAt`) VALUES
(1, 1, 'kkk', 'kkk', 'kkk.html', 'lllll', '2020-02-25 18:30:00', '2020-02-19 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `parent_category`
--

CREATE TABLE `parent_category` (
  `parentCatId` int(11) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent_category`
--

INSERT INTO `parent_category` (`parentCatId`, `title`) VALUES
(1, 'LifeStyle'),
(2, 'Education');

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
(3, 6, 1),
(4, 6, 2),
(5, 7, 1),
(6, 7, 2),
(7, 8, 1),
(8, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `prefix` varchar(5) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `mobileNumber` bigint(10) NOT NULL,
  `emailAddress` varchar(75) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastLoginAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `information` varchar(255) NOT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `prefix`, `firstName`, `lastName`, `mobileNumber`, `emailAddress`, `password`, `lastLoginAt`, `information`, `createdAt`, `updatedAt`) VALUES
(1, 'Mr', 'Rohit', 'kotadiya', 9737967047, 'kotadiya1998@gmail.com', '6512bd43d9caa6e02c990b0a82652dca', '2020-02-03 09:31:28', 'tt', '2020-02-02 18:30:00', '2020-02-03 09:31:28'),
(2, 'Mr', 'Rohit', 'kotadiya', 9737967047, 'kotadiya1998@gmail.com', '6512bd43d9caa6e02c990b0a82652dca', '2020-02-03 09:31:31', 'tt', '2020-02-02 18:30:00', '2020-02-03 09:31:31'),
(3, 'Mr', 'Rohit', 'kotadiya', 9737967047, 'kotadiya1998@gmail.com', '6512bd43d9caa6e02c990b0a82652dca', '2020-02-03 09:32:40', 'tt', '2020-02-03 09:32:40', '2020-02-03 09:32:40'),
(4, 'Mr', 'Rohit', 'kotadiya', 9737967047, 'kotadiya1998@gmail.com', '6512bd43d9caa6e02c990b0a82652dca', '2020-02-03 09:33:09', 'tt', '2020-02-03 09:33:09', '2020-02-03 09:33:09'),
(5, 'Mr', 'SAM', 'Patel', 8444515145, 'sam@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-02-03 09:41:17', 'rrr', '2020-02-03 09:41:17', '2020-02-03 09:41:17');

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
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`),
  ADD KEY `parentCatId` (`parentCatId`);

--
-- Indexes for table `parent_category`
--
ALTER TABLE `parent_category`
  ADD PRIMARY KEY (`parentCatId`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`postCatId`),
  ADD KEY `postId` (`postId`),
  ADD KEY `post_category_ibfk_1` (`categoryId`);

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
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `postCatId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD CONSTRAINT `blog_post_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parentCatId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_category`
--
ALTER TABLE `post_category`
  ADD CONSTRAINT `post_category_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `parent_category` (`parentCatId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_category_ibfk_2` FOREIGN KEY (`postId`) REFERENCES `blog_post` (`postId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
