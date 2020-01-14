-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2020 at 02:51 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `NIP` varchar(50) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`NIP`, `nama_pegawai`, `jenis_kelamin`, `tgl_lahir`, `alamat`) VALUES
('15415ASD', 'Dandi', 'Perempuan', '2020-01-10', 'Kendari');

-- --------------------------------------------------------

--
-- Table structure for table `room_book`
--

CREATE TABLE `room_book` (
  `booking_id` int(11) NOT NULL,
  `no_ktp` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `room_id` int(11) NOT NULL,
  `chckin_dt` date NOT NULL,
  `chckout_dt` date NOT NULL,
  `total_price` int(11) NOT NULL,
  `paid_ind` int(1) NOT NULL,
  `user_paid_ind` int(11) NOT NULL,
  `chckout_ind` int(1) NOT NULL,
  `cancel_ind` int(1) NOT NULL,
  `timeout_ind` int(1) NOT NULL,
  `booking_time` time NOT NULL,
  `booking_dt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_book`
--

INSERT INTO `room_book` (`booking_id`, `no_ktp`, `nama`, `no_hp`, `email`, `room_id`, `chckin_dt`, `chckout_dt`, `total_price`, `paid_ind`, `user_paid_ind`, `chckout_ind`, `cancel_ind`, `timeout_ind`, `booking_time`, `booking_dt`) VALUES
(1, 'test', 'test', 'tset', 'test', 1, '2020-01-13', '2020-01-14', 200000, 1, 1, 1, 0, 0, '00:00:00', '0000-00-00'),
(2, 'test1', 'test1', 'test1', 'test1', 3, '2020-01-13', '2020-01-15', 1600000, 1, 1, 0, 0, 0, '00:00:00', '0000-00-00'),
(3, 'test3', 'test3', 'test3', 'test3', 3, '2020-01-13', '2020-01-17', 3200000, 0, 1, 0, 1, 0, '00:00:00', '0000-00-00'),
(4, 'test4', 'test4', 'test4', 'test4', 2, '2020-01-14', '2020-01-15', 300000, 0, 1, 0, 0, 0, '15:18:07', '0000-00-00'),
(5, 'test5', 'test5', 'test5', 'test5', 2, '2020-01-14', '2020-01-15', 300000, 0, 0, 0, 0, 0, '16:25:03', '2020-01-14'),
(6, 'test6', 'test6', 'test6', 'test6', 2, '2020-01-14', '2020-01-15', 300000, 0, 0, 0, 0, 0, '16:27:43', '2020-01-14'),
(7, 'test7', 'test7', 'test7', 'test7', 2, '2020-01-14', '2020-01-15', 300000, 0, 0, 0, 0, 0, '16:29:30', '2020-01-14'),
(8, 'test8', 'test8', 'test8', 'test8', 3, '2020-01-08', '2020-01-09', 800000, 0, 0, 0, 0, 0, '16:30:51', '2020-01-14'),
(9, 'test9', 'test9', 'test9', 'test9', 3, '2020-01-14', '2020-01-18', 3200000, 0, 0, 0, 0, 0, '16:31:35', '2020-01-14'),
(10, 'test10', 'test10', 'test10', 'test10', 2, '2020-01-14', '2020-01-23', 2700000, 0, 1, 0, 0, 0, '16:33:13', '2020-01-14'),
(11, 'test11', 'test11', 'test11', 'test11', 2, '2020-01-16', '2020-01-17', 300000, 0, 0, 0, 0, 0, '16:37:47', '2020-01-14'),
(12, 'test12', 'test12', 'test12', 'test12', 2, '2020-01-16', '2020-01-17', 300000, 0, 0, 0, 0, 0, '16:38:58', '2020-01-14'),
(13, 'test13', 'test13', 'test13', 'test13', 2, '2020-01-14', '2020-01-16', 600000, 0, 0, 0, 0, 0, '16:39:28', '2020-01-14'),
(14, 'test14', 'test14', 'test14', 'test14', 2, '2020-01-14', '2020-01-15', 300000, 0, 0, 0, 0, 1, '16:40:57', '2020-01-14'),
(15, 'test15', 'test15', 'test15', 'test15', 2, '2020-01-14', '2020-01-16', 600000, 0, 1, 0, 0, 0, '16:48:57', '2020-01-14'),
(16, 'test16', 'test16', 'test16', 'test16', 2, '2020-01-14', '2020-01-16', 600000, 0, 1, 0, 0, 0, '17:00:44', '2020-01-14'),
(17, 'test17', 'test17', 'test17', 'test17', 2, '2020-01-14', '2020-01-15', 300000, 0, 1, 0, 0, 0, '19:37:34', '2020-01-14');

-- --------------------------------------------------------

--
-- Table structure for table `room_dim`
--

CREATE TABLE `room_dim` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(50) NOT NULL,
  `room_price` int(11) NOT NULL,
  `room_total` int(11) NOT NULL,
  `room_avail` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_dim`
--

INSERT INTO `room_dim` (`room_id`, `room_name`, `room_price`, `room_total`, `room_avail`) VALUES
(1, 'Single Room', 200000, 20, 20),
(2, 'Family Room', 300000, 25, 13),
(3, 'Luxury Room', 800000, 25, 21);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_ind` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `nama`, `username`, `password`, `email`, `user_ind`) VALUES
(1, 'Pemilik', 'pemilik', 'pemilik', 'pemilik@gmail.com', 1),
(2, 'Admin', 'admin', 'admin', 'admin@gmail.com', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`NIP`);

--
-- Indexes for table `room_book`
--
ALTER TABLE `room_book`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `room_dim`
--
ALTER TABLE `room_dim`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `room_book`
--
ALTER TABLE `room_book`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `room_dim`
--
ALTER TABLE `room_dim`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
