-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2017 at 01:54 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `mid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mssg` varchar(300) NOT NULL,
  `cdate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ordrs`
--

CREATE TABLE `ordrs` (
  `myid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `img` varchar(50) NOT NULL,
  `name` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `addr` varchar(200) NOT NULL,
  `ordr` varchar(200) NOT NULL,
  `pr` varchar(20) NOT NULL,
  `sts` varchar(20) NOT NULL,
  `cdate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordrs`
--

INSERT INTO `ordrs` (`myid`, `uid`, `img`, `name`, `mobile`, `email`, `addr`, `ordr`, `pr`, `sts`, `cdate`) VALUES
(37, 2, 'img/26.jpg', 'jj', '313431433', 'jj@example.com', 'fsdfwe', 'Footbal', 'Free', 'Pending', '2017-11-23'),
(38, 5, '', 'don', '453', 'don@gmail.com', '45345', 'Ad HTML ', '$300', 'Pending', '2017-12-05'),
(39, 5, 'img/25.jpg', 'don', '57297575', 'don@gmail.com', 'Any Address for tEst ', 'Ad HTML ', '$300', 'Pending', '2017-12-05'),
(40, 5, 'img/23.jpg', 'don', '435434', 'don@gmail.com', 'My new test ', 'Advanced', '$500', 'Pending', '2017-12-05'),
(41, 5, 'img/16.jpg', 'don', '45334', 'don@gmail.com', 'tgdgf', 'Blogger', '$200', 'Pending', '2017-12-05'),
(42, 2, 'img/.jpg', 'jj', '5475', 'jj@example.com', 'hrt', 'Photoshop', '$100', 'Pending', '2017-12-05'),
(43, 2, 'img/12.jpg', 'jj', '6756', 'jj@example.com', '6ghfhgf', 'HTML Course', '$200', 'Pending', '2017-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(11) NOT NULL,
  `img` varchar(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `des` varchar(150) NOT NULL,
  `pr` varchar(20) NOT NULL,
  `cdate` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `img`, `name`, `des`, `pr`, `cdate`) VALUES
(26, 'img/25.jpg', 'Ad HTML ', 'Learn new HTML course', '$300', '2017-10-19'),
(30, 'img/26.jpg', 'PHP MySQL ', 'Complete Video training course. ', '$200', '2017-12-05'),
(31, 'img/30.jpg', 'CSS MAster ', 'Complete Course for Web Design', '$300', '2017-12-05'),
(32, 'img/31.jpg', ' JavaScript for Beginners ', 'Best course for basic level', '$200', '2017-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `joining_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`, `joining_date`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$ujej4UpRJsbf3ETJRrqg8uQ7pBv4HX5w77dho8cD9t8zVK/zt75Na', '2017-10-15 11:33:28'),
(2, 'jj', 'jj@example.com', '$2y$10$aQUx3BOwroeFTAWja6ThF.H5y99jgike6o/IskgIlxo.7QLUHB7.C', '2017-10-15 11:33:48'),
(3, 'dd', 'dd@gmail.com', '$2y$10$KR3HabnOr3dgusF4XWJnQ.jnVcNfl8adjN4onmTr66/y045MCCyam', '2017-10-16 07:19:25'),
(4, 'David', 'david@gmail.com', '$2y$10$y3NgKp.DzKIdBoRRbyxnXuUDdB/PlXLGKGUsJmjKciuLU1PN2izUK', '2017-12-04 04:06:52'),
(5, 'don', 'don@gmail.com', '$2y$10$pCo4MOHPDFdk4DgUKbYw4OubecrEm8ZmERG/7tVpPKOh817TFYFV2', '2017-12-04 04:07:27'),
(6, 'John', 'john@gmail.com', '$2y$10$BpV9P7gNd8IGTPoxgXC2beiKpVsFOmgg5aAFAzLVWu1Z7skBYUTYi', '2017-12-04 04:18:26'),
(7, 'don43fe', 'dondfsdf@gmail.com', '$2y$10$KDfwZhbMZ.O9iVqyGmLii.jUHI7wUlpoSzznb1AMLj/k2GGprHnxS', '2017-12-04 04:57:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `ordrs`
--
ALTER TABLE `ordrs`
  ADD PRIMARY KEY (`myid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ordrs`
--
ALTER TABLE `ordrs`
  MODIFY `myid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
