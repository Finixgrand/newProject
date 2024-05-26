-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 07:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `b_id` int(6) NOT NULL,
  `b_time` time NOT NULL,
  `b_date` date NOT NULL,
  `u_name` varchar(15) NOT NULL,
  `qt_id` int(10) NOT NULL,
  `s_id` tinyint(4) NOT NULL,
  `cus_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`b_id`, `b_time`, `b_date`, `u_name`, `qt_id`, `s_id`, `cus_id`) VALUES
(30, '09:00:00', '2024-05-17', '', 0, 5, 16),
(31, '09:00:00', '2024-05-10', '', 0, 7, 17),
(32, '09:00:00', '2024-05-24', '', 0, 4, 18),
(33, '09:00:00', '2024-05-29', '', 0, 3, 19),
(35, '17:47:00', '2024-05-29', '', 156, 2, 21),
(36, '17:47:00', '2024-05-29', '', 156, 2, 22),
(37, '09:00:00', '2024-05-13', 'root2', 0, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_id` int(10) NOT NULL,
  `IDcardnumber` varchar(13) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(300) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `age` tinyint(2) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `u_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `IDcardnumber`, `name`, `address`, `tel`, `age`, `gender`, `u_name`) VALUES
(16, '0001', 'Supachai Saoong', '99', '1122', 33, 0, ''),
(17, '1111', 'ศุภชัย เสาองค์', '9/6 ถ.นารีพัฒนา ต.ในเมือง\r\nภัทรนรี แมนชั่น', '14444', 14, 1, ''),
(18, '555', 'ศุภชัย เสาองค์', '9 Phetcharat', '14444', 33, 0, ''),
(19, '555', 'มนัท ธรรมวงษ์', '9/6 ถ.นารีพัฒนา ต.ในเมือง\r\nภัทรนรี แมนชั่น', '0956292642', 13, 1, 'root2'),
(21, '555', 'Finix Grand', '1', '14444', 33, 1, ''),
(22, '555', 'Finix Grand', '1', '14444', 33, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `p_id` int(10) NOT NULL,
  `p_name` varchar(50) NOT NULL,
  `p_start` date NOT NULL,
  `p_end` date NOT NULL,
  `t_id` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`p_id`, `p_name`, `p_start`, `p_end`, `t_id`) VALUES
(351, 'New', '2024-05-06', '2024-05-29', 2);

-- --------------------------------------------------------

--
-- Table structure for table `queue_table`
--

CREATE TABLE `queue_table` (
  `qt_id` int(10) NOT NULL,
  `qt_date` date NOT NULL,
  `quota` tinyint(1) NOT NULL,
  `qt_time` time NOT NULL,
  `p_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `queue_table`
--

INSERT INTO `queue_table` (`qt_id`, `qt_date`, `quota`, `qt_time`, `p_id`) VALUES
(135, '2024-05-06', 3, '09:00:00', 351),
(136, '2024-05-07', 3, '09:00:00', 351),
(137, '2024-05-08', 3, '09:00:00', 351),
(138, '2024-05-09', 3, '09:00:00', 351),
(139, '2024-05-10', 3, '09:00:00', 351),
(140, '2024-05-13', 3, '09:00:00', 351),
(141, '2024-05-14', 3, '09:00:00', 351),
(142, '2024-05-15', 3, '09:00:00', 351),
(143, '2024-05-16', 3, '09:00:00', 351),
(144, '2024-05-17', 3, '09:00:00', 351),
(145, '2024-05-20', 3, '09:00:00', 351),
(146, '2024-05-21', 3, '09:00:00', 351),
(147, '2024-05-22', 3, '09:00:00', 351),
(148, '2024-05-23', 3, '09:00:00', 351),
(149, '2024-05-24', 3, '09:00:00', 351),
(150, '2024-05-27', 3, '09:00:00', 351),
(151, '2024-05-28', 3, '09:00:00', 351),
(152, '2024-05-29', 3, '09:00:00', 351),
(153, '2024-05-08', 4, '18:27:00', 351),
(154, '2024-05-15', 4, '18:27:00', 351),
(155, '2024-05-28', 4, '18:27:00', 351),
(156, '2024-05-29', 4, '17:47:00', 351);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `s_id` tinyint(4) NOT NULL,
  `s_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`s_id`, `s_name`) VALUES
(1, 'ตรวจ วินิจฉัย รักษาโรคด้วยยาสมุนไพร'),
(2, 'นวดรักษา - ฟื้นฟูฯ (นวดไทยแบบราชสำนัก ประคบสมุนไพร'),
(3, 'อบไอน้ำสมุนไพร'),
(4, 'ดูแลมารดาหลังคลอด'),
(5, 'นวดเปิดท่อน้ำนม'),
(6, 'นวดไทยเพื่อสุขภาพ'),
(7, 'นวดฝ่าเท้าเพื่อสขุภาพ');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `t_id` tinyint(2) NOT NULL,
  `t_name` varchar(50) NOT NULL,
  `t_address` varchar(500) NOT NULL,
  `t_tel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`t_id`, `t_name`, `t_address`, `t_tel`) VALUES
(1, 'สมชาย ใจดีสุด', 'หน้าเซเว่น', '12345'),
(2, 'สมหญิง จริงแท้', 'หลังเซเว่น', '4321');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_name` varchar(15) NOT NULL,
  `u_pass` varchar(15) NOT NULL,
  `u_type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_name`, `u_pass`, `u_type`) VALUES
('root', '1234', 1),
('root2', '1234', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `queue_table`
--
ALTER TABLE `queue_table`
  ADD PRIMARY KEY (`qt_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `b_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- AUTO_INCREMENT for table `queue_table`
--
ALTER TABLE `queue_table`
  MODIFY `qt_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `s_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `t_id` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
