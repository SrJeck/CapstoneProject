-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2022 at 02:19 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `journal`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) NOT NULL,
  `contactNumber` varchar(20) NOT NULL,
  `homeAddress` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `email_password` varchar(255) NOT NULL,
  `degree_status` varchar(255) NOT NULL,
  `login_status` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_type` varchar(255) NOT NULL,
  `image_upload` longblob NOT NULL,
  `registration_year` year(4) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstName`, `middleName`, `lastName`, `contactNumber`, `homeAddress`, `sex`, `birthday`, `email_address`, `email_password`, `degree_status`, `login_status`, `image_name`, `image_type`, `image_upload`, `registration_year`) VALUES
(1, 'Joseph', 'Bautista', 'Dela Cruz', '09301260045', 'San Nicolas, Hagonoy, Bulacan', 'Male', '1999-10-08', 'juan.delacruz@gmail.com', '4321', 'Transfer Degrees', 'offline', '', '', '', 2021),
(3, 'Mohammed', 'Johnson', 'Dela Cruz', '09235748295', 'San Sebastian', 'Male', '2000-11-11', 'moradahmed.mohammed@gmail.com', '4321', 'Transfer Degrees', '', '', '', '', 2021);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
