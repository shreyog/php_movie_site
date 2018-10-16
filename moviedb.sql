-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2018 at 03:38 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genreId` int(11) NOT NULL,
  `genreName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genreId`, `genreName`) VALUES
(101, 'Sci-fi'),
(102, 'Action'),
(103, 'Horror'),
(104, 'Drama'),
(105, 'Comedy'),
(106, 'Animation');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `languageId` int(11) NOT NULL,
  `languageName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`languageId`, `languageName`) VALUES
(1, 'English'),
(2, 'Hindi');

-- --------------------------------------------------------

--
-- Table structure for table `moviedetails`
--

CREATE TABLE `moviedetails` (
  `mId` int(11) NOT NULL,
  `mName` text NOT NULL,
  `Rating` int(11) NOT NULL,
  `releaseDate` date NOT NULL,
  `genreId` int(11) NOT NULL,
  `genrename` text NOT NULL,
  `languageId` int(11) NOT NULL,
  `languagename` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moviedetails`
--

INSERT INTO `moviedetails` (`mId`, `mName`, `Rating`, `releaseDate`, `genreId`, `genrename`, `languageId`, `languagename`) VALUES
(1, 'Venom', 5, '2018-10-09', 101, 'Sci-fi', 1, 'English'),
(2, 'Avengers', 5, '2018-05-04', 101, 'Sci-fi', 1, 'English'),
(3, 'Insidious: The Last Key', 3, '2018-03-09', 103, 'Horror', 1, 'English'),
(4, 'The Strange Ones', 2, '2018-06-05', 104, 'Drama', 2, 'Hindi'),
(5, 'Stratton', 4, '2018-09-12', 102, 'Action', 1, 'English'),
(6, 'Humor Me', 3, '2018-07-11', 105, 'Comedy', 2, 'Hindi'),
(7, '12 Strong', 2, '2018-08-22', 104, 'Drama', 1, 'English'),
(8, 'Maze Runner: The Death Cure', 4, '2018-08-14', 102, 'Action', 2, 'Hindi'),
(9, 'Armed', 3, '2018-09-05', 106, 'Animation', 1, 'English'),
(10, 'Fifty Shades Freed', 5, '2018-02-14', 104, 'Drama', 1, 'English');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genreId`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`languageId`);

--
-- Indexes for table `moviedetails`
--
ALTER TABLE `moviedetails`
  ADD PRIMARY KEY (`mId`),
  ADD KEY `mdfkey` (`genreId`,`languageId`) USING BTREE,
  ADD KEY `lid_md` (`languageId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `moviedetails`
--
ALTER TABLE `moviedetails`
  ADD CONSTRAINT `gid_md` FOREIGN KEY (`genreId`) REFERENCES `genre` (`genreId`),
  ADD CONSTRAINT `lid_md` FOREIGN KEY (`languageId`) REFERENCES `language` (`languageId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
