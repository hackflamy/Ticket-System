-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2019 at 05:47 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cp`
--

CREATE TABLE `tbl_cp` (
  `cp_id` varchar(10) NOT NULL,
  `cp_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_site`
--

CREATE TABLE `tbl_site` (
  `site_id` varchar(10) NOT NULL,
  `site_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tech`
--

CREATE TABLE `tbl_tech` (
  `tech_id` varchar(10) NOT NULL,
  `tech_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ticket`
--

CREATE TABLE `tbl_ticket` (
  `ticket_no` varchar(10) NOT NULL,
  `site` varchar(50) NOT NULL,
  `check_point` varchar(50) NOT NULL,
  `problem` text NOT NULL,
  `technician` varchar(50) NOT NULL,
  `cro` varchar(50) NOT NULL,
  `solution` varchar(1000) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ticket`
--

INSERT INTO `tbl_ticket` (`ticket_no`, `site`, `check_point`, `problem`, `technician`, `cro`, `solution`, `date`, `time`) VALUES
('#8266', 'Roodepoort', 'secondary in', 'hit by truck', 'Tech Benny', 'MH', '', '2019-07-26', '00:00:00'),
('#8267', 'TNDB', 'EXIT LANE', 'Boom gate not closing', 'Ashley', 'EM', '', '2019-07-26', '00:00:00'),
('#8268', 'Inyanda', 'WB OUT', 'printer not working', 'Tech Benny', 'CP', '', '2019-07-27', '00:00:00'),
('#8269', 'Kleinfontein', 'secondary IN', 'boom gate standing open', 'Ashley', 'SD', '', '2019-07-27', '00:00:00'),
('#8270', 'TNDB', 'EXIT LANE', 'boom gate standing open', 'Benny', 'em', '', '2019-07-27', '00:00:00'),
('#8271', 'Kleinfontein', 'WB-OUT', 'rinter is jammed', 'Tech Benny', 'EM', '', '2019-07-27', '00:00:00'),
('#8272', 'Klipfontein', 'WB OUT', 'Printer is ofline ', 'Charel', 'EM', '', '2019-07-27', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `username` varchar(50) NOT NULL,
  `initials` char(4) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`username`, `initials`, `surname`, `password`, `role`) VALUES
('admin', 'AD', 'BGH', 'admin', 'admin'),
('champ', 'CP', 'Dlamini', '123456789', 'CRO'),
('elias@BGH', '', '', 'elias@CRO', 'CRO'),
('raymond@BGH', '', '', 'raymond@CRO', 'CRO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_ticket`
--
ALTER TABLE `tbl_ticket`
  ADD PRIMARY KEY (`ticket_no`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
