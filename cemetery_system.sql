-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2021 at 12:11 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cemetery_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_message`
--

CREATE TABLE `admin_message` (
  `adminmsg_id` int(11) NOT NULL,
  `user_id` text NOT NULL,
  `reserve_id` text NOT NULL,
  `admin_name` text NOT NULL,
  `admin_cnum` text NOT NULL,
  `admin_email` text NOT NULL,
  `res_status` text NOT NULL,
  `message` text NOT NULL,
  `type` text NOT NULL,
  `status` text NOT NULL,
  `date_sent` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `email` text NOT NULL,
  `contact_number` text NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deceased_details`
--

CREATE TABLE `deceased_details` (
  `deceased_id` int(11) NOT NULL,
  `user_id` text NOT NULL,
  `reserve_id` text NOT NULL,
  `loc_id` text NOT NULL,
  `full_name` text NOT NULL,
  `age` text NOT NULL,
  `gender` text NOT NULL,
  `date_of_birth` datetime NOT NULL,
  `date_of_death` datetime NOT NULL,
  `date_buried` datetime NOT NULL,
  `block` text NOT NULL,
  `number` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deceased_details`
--

INSERT INTO `deceased_details` (`deceased_id`, `user_id`, `reserve_id`, `loc_id`, `full_name`, `age`, `gender`, `date_of_birth`, `date_of_death`, `date_buried`, `block`, `number`) VALUES
(1, '1', '1', '1', 'asdasdasd', '40', 'Male', '2021-07-01 00:00:00', '2021-06-28 00:00:00', '2021-07-04 22:01:50', 'A', '1');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `loc_id` int(11) NOT NULL,
  `block` text NOT NULL,
  `number` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`loc_id`, `block`, `number`, `price`, `status`) VALUES
(1, 'A', '1', 10000.00, 'occupied'),
(2, 'D', '1', 10000.00, 'approved'),
(3, 'A', '2', 10000.00, 'pending'),
(4, 'A', '3', 10000.00, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reserve_id` int(11) NOT NULL,
  `user_id` text NOT NULL,
  `loc_id` text NOT NULL,
  `reserved_by` text NOT NULL,
  `residential_address` text NOT NULL,
  `contact_number` text NOT NULL,
  `email_address` text NOT NULL,
  `block` text NOT NULL,
  `number` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `fullname` text NOT NULL,
  `age` text NOT NULL,
  `gender` text NOT NULL,
  `date_of_birth` datetime NOT NULL,
  `date_of_death` datetime NOT NULL,
  `date_of_burial` datetime NOT NULL,
  `date_reserved` datetime NOT NULL,
  `date_denied` datetime NOT NULL,
  `date_approved` datetime NOT NULL,
  `date_occupied` datetime NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reserve_id`, `user_id`, `loc_id`, `reserved_by`, `residential_address`, `contact_number`, `email_address`, `block`, `number`, `price`, `fullname`, `age`, `gender`, `date_of_birth`, `date_of_death`, `date_of_burial`, `date_reserved`, `date_denied`, `date_approved`, `date_occupied`, `status`) VALUES
(1, '1', '1', 'dsfdssdf sdfsdfs sdfsff', 'dfsdfsf', '09353535355', 'dshsdh@gmail.com', 'A', '1', 10000.00, 'asdasdasd', '40', 'Male', '2021-07-01 00:00:00', '2021-06-28 00:00:00', '2021-07-04 00:00:00', '2021-07-04 21:59:50', '0000-00-00 00:00:00', '2021-07-04 16:00:26', '2021-07-04 16:01:50', 'occupied'),
(2, '1', '2', 'dsfdssdf sdfsdfs sdfsff', 'dfsdfsf', '09353535355', 'dshsdh@gmail.com', 'D', '1', 10000.00, 'asdasdas', '40', 'Male', '2021-07-08 00:00:00', '2021-07-01 00:00:00', '2021-07-04 00:00:00', '2021-07-04 22:06:06', '0000-00-00 00:00:00', '2021-07-05 18:08:41', '0000-00-00 00:00:00', 'approved'),
(3, '1', '3', 'dsfdssdf sdfsdfs sdfsff', 'dfsdfsf', '09353535355', 'dshsdh@gmail.com', 'A', '2', 10000.00, 'Jhecca mante', '40', 'Male', '2021-07-05 00:00:00', '2021-08-07 00:00:00', '2021-07-05 00:00:00', '2021-07-05 22:17:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `mname` text NOT NULL,
  `lname` text NOT NULL,
  `age` text NOT NULL,
  `birthday` text NOT NULL,
  `gender` text NOT NULL,
  `residential_address` text NOT NULL,
  `email_address` text NOT NULL,
  `contact_number` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `date_registered` datetime NOT NULL,
  `photo` text NOT NULL,
  `status` text NOT NULL,
  `user_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `mname`, `lname`, `age`, `birthday`, `gender`, `residential_address`, `email_address`, `contact_number`, `username`, `password`, `date_registered`, `photo`, `status`, `user_type`) VALUES
(1, 'dsfdssdf', 'sdfsdfs', 'sdfsff', '22', '2021-06-16', 'Male', 'dfsdfsf', 'dshsdh@gmail.com', '09353535355', 'reinheart_marl', 'e2be6152d9b1d16765a62b74a821c8fc', '2021-06-30 22:08:14', '', 'active', 'user'),
(2, '', '', '', '', '', '', '', '', '', 'systemadmin', 'f19826e36a24ce639a7036c19b33f97d', '0000-00-00 00:00:00', '', '', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_msg`
--

CREATE TABLE `user_msg` (
  `msg_id` int(11) NOT NULL,
  `reserve_id` text NOT NULL,
  `user_id` text NOT NULL,
  `message_from` text NOT NULL,
  `date_of_burial` datetime NOT NULL,
  `block` text NOT NULL,
  `number` text NOT NULL,
  `res_status` text NOT NULL,
  `contact_number` text NOT NULL,
  `email_address` text NOT NULL,
  `type` text NOT NULL,
  `message` text NOT NULL,
  `date_sent` datetime NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_message`
--
ALTER TABLE `admin_message`
  ADD PRIMARY KEY (`adminmsg_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `deceased_details`
--
ALTER TABLE `deceased_details`
  ADD PRIMARY KEY (`deceased_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reserve_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_msg`
--
ALTER TABLE `user_msg`
  ADD PRIMARY KEY (`msg_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_message`
--
ALTER TABLE `admin_message`
  MODIFY `adminmsg_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deceased_details`
--
ALTER TABLE `deceased_details`
  MODIFY `deceased_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reserve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_msg`
--
ALTER TABLE `user_msg`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
