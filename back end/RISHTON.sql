-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 19, 2024 at 09:14 AM
-- Server version: 8.0.37-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `RISHTON`
--

-- --------------------------------------------------------

--
-- Table structure for table `Classes`
--

CREATE TABLE `Classes` (
  `ClassID` int UNSIGNED NOT NULL,
  `TeacherID` int UNSIGNED DEFAULT NULL,
  `ClassName` varchar(50) NOT NULL,
  `ClassYear` int NOT NULL,
  `ClassStrength` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Classes`
--

INSERT INTO `Classes` (`ClassID`, `TeacherID`, `ClassName`, `ClassYear`, `ClassStrength`) VALUES
(1, 20, 'reception ', 1, 12),
(2, 20, 'reception ', 3, 12);

-- --------------------------------------------------------

--
-- Table structure for table `Parents`
--

CREATE TABLE `Parents` (
  `ParentID` int UNSIGNED NOT NULL,
  `ParentName` varchar(50) NOT NULL,
  `ParentPhoneNumber` varchar(12) NOT NULL,
  `ParentEmailAddress` varchar(100) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Parents`
--

INSERT INTO `Parents` (`ParentID`, `ParentName`, `ParentPhoneNumber`, `ParentEmailAddress`, `Address`, `Gender`) VALUES
(1, 'umarrr', '07493115888', 'zzz@gmail.com', '248 moorside', 'Male'),
(2, 'Authur', '22234567123', 'Authur@gmail', '248 moorside', 'Male'),
(3, 'ALEX', '12346789000', 'ALEX@gmail', '248 moorside', 'Male'),
(4, 'MAX', '19088855522', 'MAX@gmail.COM', '250 moorside', 'Male'),
(5, 'KATIE ', '00000123556', 'KATIE@GMAIL.COM', '250 moorside', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `Students`
--

CREATE TABLE `Students` (
  `StudentID` int UNSIGNED NOT NULL,
  `StudentName` varchar(50) NOT NULL,
  `ParentID` int UNSIGNED DEFAULT NULL,
  `StudentEmailAddress` varchar(50) NOT NULL,
  `StudentHomeAddress` varchar(100) NOT NULL,
  `StudentCity` varchar(50) NOT NULL,
  `StudentPostCode` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Students`
--

INSERT INTO `Students` (`StudentID`, `StudentName`, `ParentID`, `StudentEmailAddress`, `StudentHomeAddress`, `StudentCity`, `StudentPostCode`) VALUES
(1, 'sam', 1, 'tttt@gmail.com', '251 moorside', 'Manchester', 'M279PE'),
(2, 'BEN', 4, 'ben@gmail.com', '248 moorside', 'Manchester', 'M279PD'),
(3, 'Karen', 4, 'karen@gmail.com', '248 moorside', 'Manchester', 'M279PD'),
(4, 'Noor', 5, 'noor@gmail.com', '250 moorside', 'Manchester', 'M279PD');

-- --------------------------------------------------------

--
-- Table structure for table `Teacher`
--

CREATE TABLE `Teacher` (
  `id` int UNSIGNED NOT NULL,
  `Name` varchar(38) DEFAULT NULL,
  `Subject` varchar(38) DEFAULT NULL,
  `Image` varchar(38) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Teacher`
--

INSERT INTO `Teacher` (`id`, `Name`, `Subject`, `Image`) VALUES
(15, 'reece', 'arts', '669a2226d3d6c3.80239132.jpg'),
(20, 'shreef', 'eng', '6698da6fc59716.83536741.jpeg'),
(21, 'Sam', 'COMPUTER', '669a220fedec61.44662033.png'),
(22, 'Jenny', 'Science', '669a226cabd170.96348797.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `usertype` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `usertype`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Classes`
--
ALTER TABLE `Classes`
  ADD PRIMARY KEY (`ClassID`),
  ADD KEY `TeacherID` (`TeacherID`);

--
-- Indexes for table `Parents`
--
ALTER TABLE `Parents`
  ADD PRIMARY KEY (`ParentID`);

--
-- Indexes for table `Students`
--
ALTER TABLE `Students`
  ADD PRIMARY KEY (`StudentID`),
  ADD KEY `ParentID` (`ParentID`);

--
-- Indexes for table `Teacher`
--
ALTER TABLE `Teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Classes`
--
ALTER TABLE `Classes`
  MODIFY `ClassID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Parents`
--
ALTER TABLE `Parents`
  MODIFY `ParentID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Students`
--
ALTER TABLE `Students`
  MODIFY `StudentID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Teacher`
--
ALTER TABLE `Teacher`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Classes`
--
ALTER TABLE `Classes`
  ADD CONSTRAINT `Classes_ibfk_1` FOREIGN KEY (`TeacherID`) REFERENCES `Teacher` (`id`);

--
-- Constraints for table `Students`
--
ALTER TABLE `Students`
  ADD CONSTRAINT `Students_ibfk_1` FOREIGN KEY (`ParentID`) REFERENCES `Parents` (`ParentID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
