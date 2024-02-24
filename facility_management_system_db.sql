-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2024 at 04:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facility_management_system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `EMPLOYEE_ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(255) NOT NULL,
  `LAST_NAME` varchar(255) NOT NULL,
  `DOB` date DEFAULT NULL,
  `AGE` int(11) DEFAULT NULL,
  `ADDRESS` varchar(50) DEFAULT NULL,
  `EMAIL_ADD` varchar(50) NOT NULL,
  `CONTACT_NO` varchar(11) DEFAULT NULL,
  `PASSWORD` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`EMPLOYEE_ID`, `FIRST_NAME`, `LAST_NAME`, `DOB`, `AGE`, `ADDRESS`, `EMAIL_ADD`, `CONTACT_NO`, `PASSWORD`) VALUES
(1, 'Mikee', 'Gonzaga', '0000-00-00', 30, 'Ph9 Pckg 5 Blck 49 Lot 1 B.S.C.C', 'mikee@employee.com', '09334649776', '$2y$10$dkC7ZpqBK.5XicWCK2X/8ubhV.qrD5YZXSUEBbxMlegF8zp7y59Zm');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facility`
--

CREATE TABLE `tbl_facility` (
  `FACILITY_ID` int(11) NOT NULL,
  `FACILITY_TYPE` varchar(50) DEFAULT NULL,
  `EMPLOYEE_ID` int(11) DEFAULT NULL,
  `FACILITY_STATUS_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_facility`
--

INSERT INTO `tbl_facility` (`FACILITY_ID`, `FACILITY_TYPE`, `EMPLOYEE_ID`, `FACILITY_STATUS_ID`) VALUES
(1, 'Conference Hall', 1, 1),
(2, 'Meeting Room', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facility_reservation`
--

CREATE TABLE `tbl_facility_reservation` (
  `RESERVATION_ID` int(11) NOT NULL,
  `FACILITY_ID` int(11) DEFAULT NULL,
  `USER_ID` int(11) DEFAULT NULL,
  `RESERVATION_DATE` date DEFAULT NULL,
  `RESERVATION_TIME` time DEFAULT NULL,
  `RESERVATION_STATUS_ID` int(11) DEFAULT NULL,
  `EMPLOYEE_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facility_status`
--

CREATE TABLE `tbl_facility_status` (
  `FACILITY_STATUS_ID` int(11) NOT NULL,
  `FACILITY_STATUS` varchar(50) DEFAULT NULL,
  `EMPLOYEE_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_facility_status`
--

INSERT INTO `tbl_facility_status` (`FACILITY_STATUS_ID`, `FACILITY_STATUS`, `EMPLOYEE_ID`) VALUES
(1, 'AVAILABLE', 1),
(2, 'UNAVAILABLE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservation`
--

CREATE TABLE `tbl_reservation` (
  `RESERVATION_ID` int(11) NOT NULL,
  `FACILITY_STATUS_ID` int(11) DEFAULT NULL,
  `EMPLOYEE_ID` int(11) DEFAULT NULL,
  `USER_ID` int(11) DEFAULT NULL,
  `RESERVATION_STATUS_ID` int(11) DEFAULT NULL,
  `FACILITY_ID` int(11) DEFAULT NULL,
  `RESERVATION_DATE` date DEFAULT NULL,
  `RESERVATION_TIME` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservation_status`
--

CREATE TABLE `tbl_reservation_status` (
  `RESERVATION_STATUS_ID` int(11) NOT NULL,
  `RESERVATION_DESC` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reservation_status`
--

INSERT INTO `tbl_reservation_status` (`RESERVATION_STATUS_ID`, `RESERVATION_DESC`) VALUES
(1, 'PENDING'),
(2, 'APPROVED'),
(3, 'DECLINED');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `USER_ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(255) DEFAULT NULL,
  `LAST_NAME` varchar(255) NOT NULL,
  `DOB` date DEFAULT NULL,
  `AGE` int(11) DEFAULT NULL,
  `ADDRESS` varchar(50) DEFAULT NULL,
  `EMAIL_ADD` varchar(50) DEFAULT NULL,
  `CONTACT_NO` varchar(11) DEFAULT NULL,
  `PASSWORD` char(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`USER_ID`, `FIRST_NAME`, `LAST_NAME`, `DOB`, `AGE`, `ADDRESS`, `EMAIL_ADD`, `CONTACT_NO`, `PASSWORD`) VALUES
(1, 'Richard Gabriel', 'Amor', '0000-00-00', 20, 'Ph9 Pckg 5 Blck 49 Lot 1 B.S.C.C', 'richardgabrielamor@gmail.com', '09334649776', '$2y$10$m5nA3JWKOa9zJVA0yQN4guK9QH87MW6kuHbceqP7gIYMkb/bFcUsi'),
(2, 'Ian', 'Dalumpines', '0000-00-00', 20, 'Don Antonio Quezon City', 'ianortega@gmail.com', '0944751887', '$2y$10$5RJVrrvhWqQEelryQOWguuDDqHdXL/TX17E1hJUx/AuvUOdxnt.M6'),
(3, 'Skye Bayot', 'Dingle', '0000-00-00', 19, 'Somewhere Quezon City', 'skye@gmail.com', '09683124407', '$2y$10$8mBgW.Un8p63avFTa6Gauuqayb0Aea60D0egZhbssCnpzN61ggB8O'),
(4, 'Richard Gabriel', 'Amor', '0000-00-00', 54, 'Ph9 Pckg 5 Blck 49 Lot 1 B.S.C.C', 'gabrielamor@gmail.com', '09334649776', '$2y$10$ejoHeXk3kitIwQ7IAcyuMecAPejCn6lV5HFSwE5LDcEmVihFyVc4O'),
(5, 'Jehu', 'Galvez', '0000-00-00', 21, 'Caloocan City', 'jehu@gmail.com', '09464339776', '$2y$10$0Ik3Gwb6fyFpdnceP/QDGexdfOhPyE45UgkYTxf3RYTgtD.Mjg10.'),
(6, 'Gino', 'Noynay', '0000-00-00', 20, 'Ph9 Pckg 5 Blck 49 Lot 1 B.S.C.C', 'gino@gmail.com', '09334649776', '$2y$10$Qd3HBAR/tZv4TNlYdin6GuhjiBNptEr8Cx67DmOVEtE6WMSul4NRe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`EMPLOYEE_ID`),
  ADD UNIQUE KEY `EMAIL_ADD` (`EMAIL_ADD`);

--
-- Indexes for table `tbl_facility`
--
ALTER TABLE `tbl_facility`
  ADD PRIMARY KEY (`FACILITY_ID`),
  ADD KEY `EMPLOYEE_ID` (`EMPLOYEE_ID`);

--
-- Indexes for table `tbl_facility_reservation`
--
ALTER TABLE `tbl_facility_reservation`
  ADD PRIMARY KEY (`RESERVATION_ID`),
  ADD UNIQUE KEY `unique_facility_date` (`FACILITY_ID`,`RESERVATION_DATE`),
  ADD KEY `USER_ID` (`USER_ID`),
  ADD KEY `RESERVATION_STATUS_ID` (`RESERVATION_STATUS_ID`),
  ADD KEY `EMPLOYEE_ID` (`EMPLOYEE_ID`);

--
-- Indexes for table `tbl_facility_status`
--
ALTER TABLE `tbl_facility_status`
  ADD PRIMARY KEY (`FACILITY_STATUS_ID`),
  ADD KEY `EMPLOYEE_ID` (`EMPLOYEE_ID`);

--
-- Indexes for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  ADD PRIMARY KEY (`RESERVATION_ID`),
  ADD KEY `FACILITY_STATUS_ID` (`FACILITY_STATUS_ID`),
  ADD KEY `EMPLOYEE_ID` (`EMPLOYEE_ID`),
  ADD KEY `USER_ID` (`USER_ID`),
  ADD KEY `RESERVATION_STATUS_ID` (`RESERVATION_STATUS_ID`),
  ADD KEY `FACILITY_ID` (`FACILITY_ID`);

--
-- Indexes for table `tbl_reservation_status`
--
ALTER TABLE `tbl_reservation_status`
  ADD PRIMARY KEY (`RESERVATION_STATUS_ID`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `EMPLOYEE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_facility`
--
ALTER TABLE `tbl_facility`
  MODIFY `FACILITY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_facility_reservation`
--
ALTER TABLE `tbl_facility_reservation`
  MODIFY `RESERVATION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_facility_status`
--
ALTER TABLE `tbl_facility_status`
  MODIFY `FACILITY_STATUS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  MODIFY `RESERVATION_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reservation_status`
--
ALTER TABLE `tbl_reservation_status`
  MODIFY `RESERVATION_STATUS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_facility`
--
ALTER TABLE `tbl_facility`
  ADD CONSTRAINT `tbl_facility_ibfk_1` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `tbl_employee` (`EMPLOYEE_ID`),
  ADD CONSTRAINT `tbl_facility_ibfk_2` FOREIGN KEY (`FACILITY_STATUS_ID`) REFERENCES `tbl_facility_status` (`FACILITY_STATUS_ID`);

--
-- Constraints for table `tbl_facility_reservation`
--
ALTER TABLE `tbl_facility_reservation`
  ADD CONSTRAINT `tbl_facility_reservation_ibfk_1` FOREIGN KEY (`FACILITY_ID`) REFERENCES `tbl_facility` (`FACILITY_ID`),
  ADD CONSTRAINT `tbl_facility_reservation_ibfk_2` FOREIGN KEY (`USER_ID`) REFERENCES `tbl_user` (`USER_ID`),
  ADD CONSTRAINT `tbl_facility_reservation_ibfk_3` FOREIGN KEY (`RESERVATION_STATUS_ID`) REFERENCES `tbl_reservation_status` (`RESERVATION_STATUS_ID`),
  ADD CONSTRAINT `tbl_facility_reservation_ibfk_4` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `tbl_employee` (`EMPLOYEE_ID`);

--
-- Constraints for table `tbl_facility_status`
--
ALTER TABLE `tbl_facility_status`
  ADD CONSTRAINT `tbl_facility_status_ibfk_1` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `tbl_employee` (`EMPLOYEE_ID`);

--
-- Constraints for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  ADD CONSTRAINT `tbl_reservation_ibfk_1` FOREIGN KEY (`FACILITY_STATUS_ID`) REFERENCES `tbl_facility_status` (`FACILITY_STATUS_ID`),
  ADD CONSTRAINT `tbl_reservation_ibfk_2` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `tbl_employee` (`EMPLOYEE_ID`),
  ADD CONSTRAINT `tbl_reservation_ibfk_3` FOREIGN KEY (`USER_ID`) REFERENCES `tbl_user` (`USER_ID`),
  ADD CONSTRAINT `tbl_reservation_ibfk_4` FOREIGN KEY (`RESERVATION_STATUS_ID`) REFERENCES `tbl_reservation_status` (`RESERVATION_STATUS_ID`),
  ADD CONSTRAINT `tbl_reservation_ibfk_5` FOREIGN KEY (`FACILITY_ID`) REFERENCES `tbl_facility` (`FACILITY_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
