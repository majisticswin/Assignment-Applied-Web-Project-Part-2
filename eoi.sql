-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 17, 2025 at 07:13 AM
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
-- Database: `project2_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `member_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `contribution_part1` text DEFAULT NULL,
  `contribution_part2` text DEFAULT NULL,
  `quote` text DEFAULT NULL,
  `favourite_language` varchar(50) DEFAULT NULL,
  `dream_job` varchar(100) DEFAULT NULL,
  `coding_snack` varchar(100) DEFAULT NULL,
  `hometown` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`member_id`, `name`, `student_id`, `contribution_part1`, `contribution_part2`, `quote`, `favourite_language`, `dream_job`, `coding_snack`, `hometown`) VALUES
(1, 'Mitul Joarder', '205980686', 'About page & CSS (Part 1)', 'Converted About to PHP & DB integration (Part 2)', '“The more you stay quiet, the more you listen”', 'Python & PHP', 'CIA', 'Monster ED', 'Dhaka'),
(2, 'Disha Anchan', '103031430', 'Jobs page & CSS (Part 1)', 'Jobs.php dynamic + filters (Part 2)', '“Design is how it works.”', 'Java & Python', 'Artist', 'Popcorn & Pepsi Max', 'Melbourne'),
(3, 'Can Van Sang', '105325766', 'Apply page & CSS (Part 1)', 'Apply.php validation + process_eoi (Part 2)', '“Smooth is fast.”', 'Python', 'Police', 'Burritos & Diet Coke', 'Vietnam'),
(4, 'Samuel Moore-Coulson', '106188960', 'Content & job descriptions (Part 1)', 'Database seeding & manage.php (Part 2)', '“Yesterday is history, Tomorrow is mystery and Today is a gift”', 'HTML', 'CEO', 'Coffee', 'Australia');

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `job_ref` varchar(5) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `street_address` varchar(100) NOT NULL,
  `suburb` varchar(50) NOT NULL,
  `state` varchar(10) NOT NULL,
  `postcode` char(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `skills` text DEFAULT NULL,
  `status` enum('New','Current','Final') DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_ref` varchar(5) NOT NULL,
  `title` varchar(150) NOT NULL,
  `category` varchar(50) NOT NULL,
  `salary` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `reporting_line` varchar(100) DEFAULT NULL,
  `closing_date` date DEFAULT NULL,
  `description` text NOT NULL,
  `requirements` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_ref`, `title`, `category`, `salary`, `location`, `reporting_line`, `closing_date`, `description`, `requirements`) VALUES
('AP103', 'AI Programmer', 'Programming', '$103k', 'Melbourne', 'Lead Programmer', '2025-12-31', 'Develop advanced AI behaviours and systems for open world gameplay.', 'Bachelor degree in CS, 5+ years experience, strong C++/Unreal skills.'),
('GD401', 'Game Developer', 'Programming', '$100k', 'Melbourne', 'Lead Developer', '2025-12-31', 'Contribute to continuous development of the game by building new features.', 'Bachelor degree in CS, 4+ years experience, strong OOP and Unreal Engine.'),
('NP192', 'Network Programmer', 'Networking', '90-120k', 'Melbourne', 'Networks Manager', '2025-12-31', 'Design and implement network architecture and online systems.', 'Bachelor degree in CS/Engineering, 5+ years experience, strong C++ and networking.'),
('TA801', 'Technical Artist', 'Art', '$95-100k', 'Melbourne', 'Technical Director', '2025-12-31', 'Bridge the gap between art and technology by developing tools and pipelines.', 'Bachelor degree in CS/Graphics, 4+ years experience, proficiency in Python/Maya.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(1, 'Admin', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`),
  ADD KEY `job_ref` (`job_ref`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_ref`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eoi`
--
ALTER TABLE `eoi`
  ADD CONSTRAINT `eoi_ibfk_1` FOREIGN KEY (`job_ref`) REFERENCES `jobs` (`job_ref`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
