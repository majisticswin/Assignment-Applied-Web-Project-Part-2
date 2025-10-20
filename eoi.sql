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
  `location` varchar(100) NOT NULL,       
  `job_type` varchar(50) NOT NULL,        -- (21/10/2025): added new category "job_type"; e.g. Full-Time, Internship
  `salary` int(12) NOT NULL,              -- (21/10/2025): change data type from varchar to int
  `reporting_line` varchar(100) NOT NULL, 
  `description` text NOT NULL,
  `responsibilities` text NOT NULL,       -- (21/10/2025): added new category; used for key responsibilities
  `essential_req` text NOT NULL,          -- (21/10/2025): add new category; used for essential requirements
  `preferrable_req` text NOT NULL,        -- (21/10/2025): add new category; used for preferrable requirements
  `opening_date` date NOT NULL,           -- (21/10/2025): add new category; used for job opening date
  `closing_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_ref`, `title`, `category`, `location`, `job_type`, `salary`, `reporting_line`, `description`, `responsibilities`, `essential_req`, `preferrable_req`, `opening_date`, `closing_date`) VALUES
('AP103', 'AI Programmer', 'Programming', 'Melbourne, VIC', 'Contract', 103000, 'Lead Programmer', 'We are seeking a talented AI programmer to join our technical team! As an AI programmer, you will be developing a highly advanced AI behaviours and systems that will your team in developing a believable open world. This role will require you to have strong understanding in AI algorithms, excellent communication and high proficiency in programming.\r\n', 'Collaborating with designers, artists and developers into creating a smart and efficient AI systems that supports them in its application and tuning.| Maintaining and Improving core AI systems that define AI behaviour in an open world environment.| Writing high quality code engine base that architects and enhances AI characters while aligning with the project goals.|\r\nEnsuring the high-quality user experience for all platforms.', 'A bachelor\'s degree in computer science, Information technology or related fields.| +5 years of professional experience as a programmer in game development, with a focus on AI systems and development.| Strong understanding in AI algorithms and data structures.| Strong proficiency in C++ programming.| Strong proficiency in Unreal Engine.', 'Good understanding in ECS or Mass Framework.| Good communication and interpersonal skills.| Ability to work in a cross-functional team.| Ability to communicate complex concepts to technical and non-technical teams.| Shipped at least 1 AAA title', '2025-10-17', '2025-10-31'),
('GD401', 'Game Developer', 'Development', 'Remote', 'Graduate', 100000, 'Lead Developer', 'We are seeking an innovative and talented Game Developer to join our technical team! As a Game developer, you will be contributing to the continuous development of the game by developing new features and improving the game’s architecture while working closely with designers and other developers.', 'Conceptualize, implement, and maintain gameplay systems that achieve a fulfilling flow state, addictive game loops, and a risk/reward balance.| Developing the storyline, character back-stories, and dialogue, through scripts and storyboards, including any relevant research.| Create and maintain comprehensive documentation (such as design outlines, diagrams, and visual mockups) that details the triggers, interactions, and subsequent events of specific features or aspects of gameplay.| Work closely with User Experience (UX) and User Interface (UI) Designers to optimize the player interface.|  Creating increasingly difficult levels, which include different environments and enemies.', '4 years of professional experience as a game developer.| Completed a bachelor\'s degree in computer science, IT or related fields.| High proficiency in C++ programming and Object oriented programming (OOP).| Strong proficiency in Unreal engine Expertises.| Strong problem-solving, analytical, and self-learning skills.| Experience with modern graphics APIs.', 'Good knowledge in code practices and software development practices.| Good communication and interpersonal skills.| Ability to collaborate with multidisciplinary teams.| Experience with modern graphics APIs  ', '2025-10-15', '2025-10-29'),
('NP192', 'Network Programmer', 'Programming', 'Melbourne, VIC', 'Full-Time', 110000, 'Network Manager', 'We are seeking talented network programmer to join our team! As a network programmer, you will be focusing on designing and implementing network architecture and online systems to ensure the game can be transmitted to multiple devices. Our ideal candidate should have a strong background in network architecture and can effectively work with other developers.', 'Providing support on cloud server deployment and maintenance.| Performing an in-depth analysis of the client\'s and server\'s CPU and memory and determining necessary changes to improve the performance of the game.| Optimising network code to reduce bandwidth usage and ensuring a low-latency and high-performance online experience for players.| Working closely with game developers and other departments to integrate high quality network features seamlessly.| Performing troubleshooting and debugging network code to ensure stability and performance across platforms.', 'Bachelor\'s degree in computer science, engineering or other related fields.| 5 years of professional experience as a network programmer or related experience.| Proficiency in C++ or similar programming.| Ability to collaborate effectively with other team.| Good communication and interpersonal skills. | Strong understanding of network optimization and real-time performance. | Strong analytical, problem-solving, and troubleshooting skills.', 'Strong understanding in game engines like Unreal engine.| Proficient in network replication within game engines| Proficient in the network architecture of a game engine.|  Experience in designing scalable, performant systems.| Understanding of online gaming systems, multiplayer architecture, and backend technologies.', '2025-10-12', '2025-10-26'),
('TA801', 'Technical Artist', 'Design', 'Melbourne, VIC', 'Internship', 98000, 'Technical Director', 'We are seeking a creative and skillful Technical Artist to join our team. As a technical artist, you will be focusing on developing the tools and pipeline for our real-time game production and bridging the gaps between the arts and technology! Our ideal candidate is someone thrives in the gaps between the technical and arts department, bringing in their creative artist direction and their strong critical thinking skills.', 'Collaborating closely with artists, animators, and developers to understand their needs and ensure the best visuals for the game without any technical setbacks.| Designing and optimising production pipelines to production pipeline to ensure seamless flow of assets from art creation to integration.| Ensuring in-game assets are high quality, optimised and efficiently managed throughout the entire production process.| Identifying production bottlenecks and contribute to building and maintaining custom tools and scripts for building efficient workflows', '+4 years of Experience in game development or other related experience.| Bachelor\'s degree in computer science, Graphics Art or other related fields.| Ability to effectively work and collaborate with both artistic and technical teams.| Strong critical thinking and problem-solving skills.| Strong communication skills.| Proficiency in Python, MEL, or similar scripting languages.| Solid Understanding in game development production pipelines and workflows and real time assets.| Proficiency in commercial 3D software like Autodesk, Maya, Blender.', 'Genuine passion for video games.| Proficiency in game engines like Unreal Engine or Unity.| Good understanding with shader development, materials and rendering optimisation.| Strong background in 3D workflows, including modelling, texturing, animation, lighting, VFX, scripting. | Understanding in procedural workflows. | Good Knowledge with version control systems (Git).', '2025-10-16', '2025-10-30');

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
