-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2022 at 04:05 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `els_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `password`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE `tbl_items` (
  `id` int(11) NOT NULL,
  `category` varchar(150) NOT NULL,
  `isbn` varchar(150) DEFAULT NULL,
  `title` varchar(250) NOT NULL,
  `publisher` varchar(150) NOT NULL,
  `date` int(4) NOT NULL,
  `genre` varchar(150) DEFAULT NULL,
  `edition` varchar(250) DEFAULT NULL,
  `editionNum` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `authorCount` int(11) NOT NULL,
  `author` varchar(1000) NOT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `img` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`id`, `category`, `isbn`, `title`, `publisher`, `date`, `genre`, `edition`, `editionNum`, `quantity`, `authorCount`, `author`, `description`, `img`) VALUES
(25, 'Book', '9781451648546', 'Steve Jobs', 'Simon and Schuster', 2011, 'Biography & Autobiography', 'none', 0, 0, 1, 'Walter Isaacson', 'Draws on more than forty interviews with Steve Jobs, as well as interviews with family members, friends, competitors, and colleagues to offer a look at the co-founder and leading creative force behind the Apple computer company.', NULL),
(35, 'Book', NULL, 'Physics', 'Addison-Wesley', 1901, 'Physics', 'Edition', 2, 1, 1, 'James S. Walker', 'Intended for algebra-based introductory physics courses. An accessible, problem-solving approach to physics, grounded in real-world applications James Walker\'s Physics provides students with a solid conceptual understanding of physics that can be expressed quantitatively and applied to the world around them. Instructors and students praise Walker\'s Physics for its friendly voice, the author\'s talent for making complex concepts understandable, an inviting art program, and the range of excellent homework problems and example-types that provide guidance with problem solving. The Fifth Edition includes new \"just-in-time\" learning aids such as \"Big Ideas\" to quickly orient students to the overarching principles of each chapter, new Real-World Physics and Biological applications, and a wealth of problem-solving support features to coach students through the process of applying logic and reasoning to problem solving.TheFifth Editionis accompanied by MasteringPhysics, the leading online homework, tutorial, and assessment system. Also Available with MasteringPhysics MasteringPhysics from Pearson is the leading online homework, tutorial, and assessment system, designed to improve results by engaging students before, during, and after class with powerful content. Instructors ensure students arrive ready to learn by assigning educationally effective content before class and encourage critical thinking and retention with in-class resources such as Learning Catalytics. Students can further master concepts after class through traditional and adaptive homework assignments that provide hints and answer-specific feedback. The Mastering gradebook records scores for all automatically graded assignments in one place, while diagnostic tools give instructors access to rich data to assess student understanding and misconceptions. Mastering brings learning full circle by continuously adapting to each student and making learning more personal than ever--before, during, and after class. Note:', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pending_account`
--

CREATE TABLE `tbl_pending_account` (
  `id` int(11) NOT NULL,
  `sid` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `name` varchar(200) NOT NULL,
  `password` varchar(300) NOT NULL,
  `imgid` varchar(300) NOT NULL,
  `isActivated` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pending_account`
--

INSERT INTO `tbl_pending_account` (`id`, `sid`, `email`, `name`, `password`, `imgid`, `isActivated`) VALUES
(4, 'asdd', 'A@asd', 'asd', '7815696ecbf1c96e6894b779456d330e', '/images/ids//20220524IMG_20220517_080316.jpg', 0),
(5, 'c', 'asd@a', 'c', 'cddbbd89a43f63faf13ecceb957a451e', '/images/ids//20220524IMG_20220517_080316.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pending_account`
--
ALTER TABLE `tbl_pending_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_pending_account`
--
ALTER TABLE `tbl_pending_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
