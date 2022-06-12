-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2022 at 07:38 AM
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
-- Table structure for table `tbl_bookmarks`
--

CREATE TABLE `tbl_bookmarks` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bookmarks`
--

INSERT INTO `tbl_bookmarks` (`id`, `item_id`, `user_id`) VALUES
(22, 42, 17),
(23, 25, 17),
(24, 25, 12),
(27, 25, 50),
(28, 35, 50),
(38, 41, 48),
(40, 40, 48),
(41, 45, 48),
(42, 25, 51);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_borrow`
--

CREATE TABLE `tbl_borrow` (
  `borrow_id` int(11) NOT NULL,
  `borrower_sid` varchar(300) NOT NULL,
  `book_id` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `borrow_date` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `returned_date` datetime NOT NULL,
  `accession_id` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_borrow`
--

INSERT INTO `tbl_borrow` (`borrow_id`, `borrower_sid`, `book_id`, `days`, `borrow_date`, `due_date`, `returned_date`, `accession_id`, `status`) VALUES
(9, '109384132231', 25, 2, '2022-06-11 19:58:27', '2022-06-13 19:58:27', '0000-00-00 00:00:00', 'f11', 'Returned'),
(10, '109384132231', 35, 1, '2022-06-11 20:01:46', '2022-06-12 20:01:46', '0000-00-00 00:00:00', 'f12', 'Returned'),
(11, '107123131', 40, 2, '2022-06-11 20:55:50', '2022-06-13 20:55:50', '0000-00-00 00:00:00', 'f1', 'Returned');

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
  `call_number` varchar(150) NOT NULL,
  `available` int(11) NOT NULL,
  `img` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`id`, `category`, `isbn`, `title`, `publisher`, `date`, `genre`, `edition`, `editionNum`, `quantity`, `authorCount`, `author`, `description`, `call_number`, `available`, `img`) VALUES
(25, 'Book', '9781451648546', 'Steve Jobs', 'Simon and Schuster', 2011, 'Biography & Autobiography', 'none', 0, 1, 1, 'Walter Isaacson', 'Draws on more than forty interviews with Steve Jobs, as well as interviews with family members, friends, competitors, and colleagues to offer a look at the co-founder and leading creative force behind the Apple computer company.', 'C 400.5 WI2011', 1, NULL),
(35, 'Book', NULL, 'Physics', 'Addison-Wesley', 1901, 'Physics', 'Edition', 2, 1, 1, 'James S. Walker', 'Intended for algebra-based introductory physics courses. An accessible, problem-solving approach to physics, grounded in real-world applications James Walker\'s Physics provides students with a solid conceptual understanding of physics that can be expressed quantitatively and applied to the world around them. Instructors and students praise Walker\'s Physics for its friendly voice, the author\'s talent for making complex concepts understandable, an inviting art program, and the range of excellent homework problems and example-types that provide guidance with problem solving. The Fifth Edition includes new \"just-in-time\" learning aids such as \"Big Ideas\" to quickly orient students to the overarching principles of each chapter, new Real-World Physics and Biological applications, and a wealth of problem-solving support features to coach students through the process of applying logic and reasoning to problem solving.TheFifth Editionis accompanied by MasteringPhysics, the leading online homework, tutorial, and assessment system. Also Available with MasteringPhysics MasteringPhysics from Pearson is the leading online homework, tutorial, and assessment system, designed to improve results by engaging students before, during, and after class with powerful content. Instructors ensure students arrive ready to learn by assigning educationally effective content before class and encourage critical thinking and retention with in-class resources such as Learning Catalytics. Students can further master concepts after class through traditional and adaptive homework assignments that provide hints and answer-specific feedback. The Mastering gradebook records scores for all automatically graded assignments in one place, while diagnostic tools give instructors access to rich data to assess student understanding and misconceptions. Mastering brings learning full circle by continuously adapting to each student and making learning more personal than ever--before, during, and after class. Note:', 'Eng 600.1 F1901 E2', 1, NULL),
(40, 'Book', '9780135957059', 'The Pragmatic Programmer', 'Addison-Wesley Professional', 1902, 'Computers', 'none', 0, 10, 2, 'David Hurst Thomas,Andrew Hunt', 'Using anecdotes, analogies, examples and parables, this user-friendly guide offers techniques for getting any programming job done effectively, and can help any programmer improve skills, no matter what level. Incorporates today\'s top languages, including Java, C, C++, and Perl.', 'Fil 413 DHT1902', 9, NULL),
(41, 'Book', '9781941691243', 'Essential Calculus Skills Practice Workbook with Full Solutions', 'Unknown', 1904, 'Calculus', 'none', 0, 1, 1, 'Chris McMullen', 'The author, Chris McMullen, Ph.D., has over twenty years of experience teaching math skills to physics students. He prepared this comprehensive workbook (with full solutions to every problem) to share his strategies for mastering calculus. This workbook covers a variety of essential calculus skills, including: derivatives of polynomials, trig functions, exponentials, and logarithms the chain rule, product rule, and quotient rule second derivatives how to find the extreme values of a function limits, including l\'Hopital\'s rule antiderivatives of polynomials, trig functions, exponentials, and logarithms definite and indefinite integrals techniques of integration, including substitution, trig sub, and integration by parts multiple integrals The goal of this workbook isn\'t to cover every possible topic from calculus, but to focus on the most essential skills needed to apply calculus to other subjects, such as physics or engineering', 'Fil  551.1 CM1904', 1, NULL),
(44, 'Book', '1597070149', 'The Hardy Boys #4: Malled', 'Papercutz', 2005, 'Juvenile Fiction', 'none', 0, 1, 1, 'Scott Lobdell', 'Frank and Joe Hardy finish up a case helping a fellow ATAC (American Teens Against Crime) agent, who sharp-eyed fans may recognize despite her Alias. Things seem to quiet down when ATAC sends Frank and Joe undercover to investigate a new Mall opening in Bayport, due to several suspicious accidents there. But things get exciting when the night before the big opening, Joe, Frank, and seven others are mysteriously locked in the mall -with a murderer on the loose. If that wasn\'t enough, everything that could go horribly wrong in a mall, does. A flood caused by water beds. An electrocution at an electronics shop. A bow and arrow used to kill in the Sporting Goods store. A runaway elevator. A damsel in distress in the dress shop. Fire in the food court. And much, much more. Ages 8 to 12. Papercutz is the exciting new graphic novel publisher that\'s building a huge following among the next generation of comics fans. Even the most reluctant readers are becoming addicted to the Papercutz approach of giving classic characters a modern makeover! Each Papercutz graphic novel features comics stories drawn in the style of the popular Japanese comics known as manga, and beautifully rendered with state of the art color. While educators rave about the high quality of the Papercutz writing and artwork, readers 8 and up are simply enjoying the great adventures found in each fun-filled volume. Be sure to check out other Papercutz titles such as Nancy Drew, Totally Spies, and Zorro.', 'sample H10', 1, NULL),
(45, 'Book', '9781453661383', 'Algebra Essentials Practice Workbook with Answers: Linear and Quadratic Equations, Cross Multiplying, and Systems of Equations', 'CreateSpace', 1912, 'Mathematics', 'Edition', 1, 1, 2, 'Chris Mcmullen, Ph.d.', 'This Algebra Essentials Practice Workbook with Answers provides ample practice for developing fluency in very fundamental algebra skills - in particular, how to solve standard equations for one or more unknowns. These algebra 1 practice exercises are relevant for students of all levels - from grade 7 thru college algebra. With no pictures, this workbook is geared strictly toward learning the material and developing fluency through practice. This workbook is conveniently divided up into seven chapters so that students can focus on one algebraic method at a time. Skills include solving linear equations with a single unknown (with a separate chapter dedicated toward fractional coefficients), factoring quadratic equations, using the quadratic formula, cross multiplying, and solving systems of linear equations. Not intended to serve as a comprehensive review of algebra, this workbook is instead geared toward the most essential algebra skills. Each section begins with a few pages of instructions for how to solve the equations followed by a few examples. These examples should serve as a useful guide until students are able to solve the problems independently. Answers to exercises are tabulated at the back of the book. This helps students develop confidence and ensures that students practice correct techniques, rather than practice making mistakes. The copyright notice permits parents/teachers who purchase one copy or borrow one copy from a library to make photocopies for their own children/students only. This is very convenient for parents/teachers who have multiple children/students or if a child/student needs additional practice. An introduction describes how parents and teachers can help students make the most of this workbook. Students are encouraged to time and score each page. In this way, they can try to have fun improving on their records, which can help lend them confidence in their math skills.', 'F113123', 1, NULL);

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
  `account_type` varchar(300) NOT NULL,
  `imgid` varchar(300) NOT NULL,
  `isActivated` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pending_account`
--

INSERT INTO `tbl_pending_account` (`id`, `sid`, `email`, `name`, `password`, `account_type`, `imgid`, `isActivated`) VALUES
(48, '107123131', 'montes@gmail.com', 'Marck Andrie Montes', '202cb962ac59075b964b07152d234b70', 'Student', '', 1),
(49, '1071231273', 'haboc.kristine.eccinfotech@gmail.com', 'Kristine B. Haboc', '202cb962ac59075b964b07152d234b70', 'Student', '', 1),
(50, '1111', 'galvez@gmail.com', 'Marry Anne Galvez', '202cb962ac59075b964b07152d234b70', 'Personnel', '/images/ids//20220604Screenshot 2022-05-31 090302.png', 1),
(51, '109384132231', 'patria@gmail.com', 'Jacob Patria', '202cb962ac59075b964b07152d234b70', 'Student', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_personnels`
--

CREATE TABLE `tbl_personnels` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(400) NOT NULL,
  `name` varchar(400) NOT NULL,
  `email` varchar(400) NOT NULL,
  `designation` varchar(400) NOT NULL,
  `phone` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_personnels`
--

INSERT INTO `tbl_personnels` (`id`, `employee_id`, `name`, `email`, `designation`, `phone`) VALUES
(3, '1111', 'Marry Anne Galvez', 'galvez@gmail.com', 'Teacher', '09993346761');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservations`
--

CREATE TABLE `tbl_reservations` (
  `reservation_id` int(11) NOT NULL,
  `borrower_sid` varchar(300) NOT NULL,
  `book_id` int(11) NOT NULL,
  `reservation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_reservations`
--

INSERT INTO `tbl_reservations` (`reservation_id`, `borrower_sid`, `book_id`, `reservation_date`, `status`) VALUES
(6, '109384132231', 35, '2022-06-10 00:15:01', 'Expired'),
(47, '107123131', 44, '2022-06-11 15:08:27', 'Completed'),
(48, '109384132231', 41, '2022-06-11 15:08:58', 'Completed'),
(49, '107123131', 40, '2022-06-11 10:29:36', 'Completed'),
(50, '107123131', 45, '2022-06-11 15:08:48', 'Completed'),
(51, '109384132231', 35, '2022-06-11 17:29:30', 'Completed'),
(52, '109384132231', 35, '2022-06-11 17:50:18', 'Completed'),
(53, '1111', 35, '2022-06-11 17:47:41', 'Completed'),
(54, '109384132231', 25, '2022-06-11 17:59:05', 'Completed'),
(55, '109384132231', 35, '2022-06-11 18:01:55', 'Completed'),
(57, '107123131', 40, '2022-06-11 18:55:55', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE `tbl_students` (
  `id` int(11) NOT NULL,
  `lrn` varchar(400) NOT NULL,
  `name` varchar(400) NOT NULL,
  `email` varchar(400) NOT NULL,
  `phone` varchar(400) NOT NULL,
  `grade_section` varchar(400) NOT NULL,
  `adviser` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`id`, `lrn`, `name`, `email`, `phone`, `grade_section`, `adviser`) VALUES
(19, '107123131', 'Marck Andrie Montes', 'montes@gmail.com', '09137312734', 'Grade 9 Marangal', 'Mrs. Ethyl Condino'),
(20, '1071231273', 'Kristine B. Haboc', 'haboc.kristine.eccinfotech@gmail.com', '09993346761', 'Grade 12 Diamond', 'Mrs. Ethyl Condino'),
(21, '109384132231', 'Jacob Patria', 'patria@gmail.com', '09313212313', 'Grade 8 Mabuhay', 'Ethyl Condino');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `provider_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `provider`, `provider_value`) VALUES
(1, 'google', '1//0el_ig9chxlNSCgYIARAAGA4SNwF-L9IrwXTbzHEdVAqTWfaTftNbK8pyxXIo2F7cHfisFwvjyjFZsUoLa3IWTTT-f_SetXiEg3A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bookmarks`
--
ALTER TABLE `tbl_bookmarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_borrow`
--
ALTER TABLE `tbl_borrow`
  ADD PRIMARY KEY (`borrow_id`);

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
-- Indexes for table `tbl_personnels`
--
ALTER TABLE `tbl_personnels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reservations`
--
ALTER TABLE `tbl_reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
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
-- AUTO_INCREMENT for table `tbl_bookmarks`
--
ALTER TABLE `tbl_bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_borrow`
--
ALTER TABLE `tbl_borrow`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_pending_account`
--
ALTER TABLE `tbl_pending_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_personnels`
--
ALTER TABLE `tbl_personnels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_reservations`
--
ALTER TABLE `tbl_reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tbl_students`
--
ALTER TABLE `tbl_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
