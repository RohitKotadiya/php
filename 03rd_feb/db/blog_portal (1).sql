-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 04, 2020 at 01:19 PM
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
(22, 5, 'fitness', 'lllll.html', 'aboiut fitness', 'uploads/Screenshot (159).png', '4444-04-04', '2020-02-04 08:09:33', '2020-02-04 08:09:33'),
(24, 5, 'new Blg', 'jjj.html', 'jjj', 'uploads/Screenshot (18).png', '2020-02-04', '2020-02-04 06:03:44', '2020-02-04 06:03:44'),
(25, 5, 'latest', 'ppp/html', 'ppp', 'uploads/Screenshot (19).png', '2020-02-04', '2020-02-04 06:04:27', '2020-02-04 06:04:27'),
(26, 5, 'latest2', 'ooo.html', 'llll', 'uploads/Screenshot (325).png', '2020-05-04', '2020-02-04 06:06:52', '2020-02-04 06:06:52'),
(28, 35, 'about config', 'ooo.html', 'how are you', 'uploads/Screenshot (159).png', '1111-11-11', '2020-02-04 09:41:48', '2020-02-04 09:41:48'),
(31, 35, 'hello', 'ooo.html', 'how are you', 'uploads/Screenshot (157).png', '2222-02-22', '2020-02-04 09:50:00', '2020-02-04 09:50:00'),
(34, 35, 'hello', 'lllll.html', 'how are you', 'uploads/Screenshot (166).png', '1111-11-11', '2020-02-04 10:02:35', '2020-02-04 10:02:35'),
(37, 35, 'hello', 'kkkk.html', 'cont', 'uploads/', '0001-01-01', '2020-02-04 10:24:13', '2020-02-04 10:24:13');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `metaTitle` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `content` varchar(100) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) NOT NULL,
  `parentCatId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `title`, `metaTitle`, `url`, `content`, `createdAt`, `updatedAt`, `image`, `parentCatId`) VALUES
(12, 'laptop', 'ele', '', 'all electic items', '2020-02-04 05:32:51', '2020-02-04 05:32:51', 'uploads/Screenshot (162).png', 8),
(13, 'health', 'ele', '', 'all electic items', '2020-02-04 05:38:30', '2020-02-04 05:38:30', 'uploads/Screenshot (165).png', 9),
(16, 'yyy', 'kkk', 'jjj.html', 'jjj', '2020-02-04 10:37:35', '2020-02-04 10:37:35', 'uploads/Screenshot (163).png', 12);

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
(8, 'Electronics'),
(9, 'laptop'),
(10, 'health'),
(11, 'laptop'),
(12, 'Electronics'),
(13, 'yyy');

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
(25, 24, 12),
(26, 25, 12),
(27, 26, 12),
(29, 22, 13),
(32, 28, 12),
(35, 31, 12),
(38, 34, 12),
(41, 37, 12);

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
  `lastLoginAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `selfInfo` varchar(255) NOT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `prefix`, `firstName`, `lastName`, `phoneNumber`, `emailAddress`, `password`, `lastLoginAt`, `selfInfo`, `createdAt`, `updatedAt`) VALUES
(5, 'Mrs', 'Shyam', 'Topiya', 8444515145, 'sam@gmail.com', '7363a0d0604902af7b70b271a0b96480', '2020-02-04 08:26:49', 'sam patel', '2020-02-04 08:26:49', '2020-02-03 09:41:17'),
(35, 'Mr', 'keyur', 'solanki', 9858452512, 'keyursolanki@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-02-04 09:14:28', 'keyur', '2020-02-04 09:14:28', '2020-02-04 09:14:28');

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
  ADD KEY `categoryId` (`categoryId`);

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
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `parent_category`
--
ALTER TABLE `parent_category`
  MODIFY `parentCatId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `postCatId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parentCatId`) REFERENCES `parent_category` (`parentCatId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_category`
--
ALTER TABLE `post_category`
  ADD CONSTRAINT `post_category_ibfk_2` FOREIGN KEY (`postId`) REFERENCES `blog_post` (`postId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_category_ibfk_3` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
