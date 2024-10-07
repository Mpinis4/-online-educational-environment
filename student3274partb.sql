-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: webpagesdb.it.auth.gr:3306
-- Generation Time: Sep 16, 2023 at 11:48 PM
-- Server version: 10.1.48-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student3274partb`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `subject` varchar(200) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `date`, `subject`, `text`) VALUES
(1, '2023-09-16', 'Ανάρτηση εργασίας', 'H πρώτη εργασία του μαθήματος έχει αναρτηθεί μπορείτε να την βρείτε '),
(2, '2023-09-15', 'Έναρξη μαθημάτων', 'Τα μαθήματα ξεκινάνε από Δευτέρα 2/10/2023.');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `file_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `title`, `description`, `file_path`) VALUES
(1, 'Χρήσιμες ιστοσελίδες', 'Εδώ θα βρείτε μερικές χρήσιμες ιστοσελίδες σχετικά με το μάθημα', 'file1.doc'),
(2, 'Σημειώσεις', 'Εδώ θα βρείτε τις σημειώσεις του μαθήματος', 'file2.doc');

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL,
  `goals` varchar(200) NOT NULL,
  `file_path` varchar(100) NOT NULL,
  `deliverables` varchar(200) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homework`
--

INSERT INTO `homework` (`id`, `goals`, `file_path`, `deliverables`, `date`) VALUES
(1, 'Δημιουργία one page website', 'ergasia1.doc', 'Σε αυτή την εργασία καλείστε να δημιουργήσετε μία σελίδα για ένα ηλεκτρονικό περιοδικό χωρίς πολλές πληροφοριές.', '2023-10-11'),
(2, 'Δημιουργία πλήρους ιστοσελίδας', 'ergasia2.doc', 'Στη δεύτερη εργασία σας ζητείται να επεκτείνετε την πρώτη εργασία με την δημιουργία ενώς πλήρους στατικού ιστοτόπου.', '2023-10-13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('Tutor','Student') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `surname`, `username`, `password`, `role`) VALUES
('alex', 'mavridis', 'alexmav@gmail.com', 'test2', 'Tutor'),
('Giorgos', 'georgiou', 'georgiou@gmail.com', 'test3', 'Student'),
('Mpampis', 'Xanthopoulos', 'mpinis4@gmail.com', 'test1', 'Student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
