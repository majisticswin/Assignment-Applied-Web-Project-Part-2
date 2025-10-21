-- =========================================================
-- COS10026 Web Technology Project - Part 2
-- Database schema for Panda Mice Recruitment Website
-- =========================================================

-- Create database
CREATE DATABASE IF NOT EXISTS project2_db;
USE project2_db;

-- =========================================================
-- JOBS TABLE
-- Stores all job listings
-- =========================================================
DROP TABLE IF EXISTS jobs;
CREATE TABLE jobs (
  job_ref VARCHAR(5) PRIMARY KEY,          -- e.g., AP103
  title VARCHAR(150) NOT NULL,             -- Job title
  category VARCHAR(50) NOT NULL,           -- e.g., Programming, Design, Networking
  location VARCHAR(100) NOT NULL,          -- Job location
  job_type VARCHAR(50) NOT NULL,           -- e.g. Full-Time, Internship etc.
  salary VARCHAR(100) NOT NULL,            -- Salary range
  reporting_line VARCHAR(100) NOT NULL,    -- Who the role reports to
  description TEXT NOT NULL,               -- Short description
  responsibilities TEXT NOT NULL,          -- Key Responsibilities of the role
  essential_req TEXT NOT NULL,             -- Essential Requirements of the job
  preferrable_req TEXT NOT NULL,           -- Preferrable Requirements of the job
  opening_date DATE NOT NULL,              -- Job opening date
  closing_date DATE NOT NULL              -- Application closing date
);

-- Sample jobs 
INSERT INTO jobs (job_ref, title, category, location, job_type, salary, reporting_line, description, responsibilities, essential_req, preferrable_req, opening_date, closing_date) 
VALUES
('AP103', 'AI Programmer', 'Programming', 'Melbourne, VIC', 'Contract', 103000, 'Lead Programmer', 'We are seeking a talented AI programmer to join our technical team! As an AI programmer, you will be developing a highly advanced AI behaviours and systems that will your team in developing a believable open world. This role will require you to have strong understanding in AI algorithms, excellent communication and high proficiency in programming.\r\n', 'Collaborating with designers, artists and developers into creating a smart and efficient AI systems that supports them in its application and tuning.| Maintaining and Improving core AI systems that define AI behaviour in an open world environment.| Writing high quality code engine base that architects and enhances AI characters while aligning with the project goals.|\r\nEnsuring the high-quality user experience for all platforms.', 'A bachelor\'s degree in computer science, Information technology or related fields.| +5 years of professional experience as a programmer in game development, with a focus on AI systems and development.| Strong understanding in AI algorithms and data structures.| Strong proficiency in C++ programming.| Strong proficiency in Unreal Engine.', 'Good understanding in ECS or Mass Framework.| Good communication and interpersonal skills.| Ability to work in a cross-functional team.| Ability to communicate complex concepts to technical and non-technical teams.| Shipped at least 1 AAA title', '2025-10-17', '2025-10-31'),
('GD401', 'Game Developer', 'Development', 'Remote', 'Graduate', 100000, 'Lead Developer', 'We are seeking an innovative and talented Game Developer to join our technical team! As a Game developer, you will be contributing to the continuous development of the game by developing new features and improving the game’s architecture while working closely with designers and other developers.', 'Conceptualize, implement, and maintain gameplay systems that achieve a fulfilling flow state, addictive game loops, and a risk/reward balance.| Developing the storyline, character back-stories, and dialogue, through scripts and storyboards, including any relevant research.| Create and maintain comprehensive documentation (such as design outlines, diagrams, and visual mockups) that details the triggers, interactions, and subsequent events of specific features or aspects of gameplay.| Work closely with User Experience (UX) and User Interface (UI) Designers to optimize the player interface.|  Creating increasingly difficult levels, which include different environments and enemies.', '4 years of professional experience as a game developer.| Completed a bachelor\'s degree in computer science, IT or related fields.| High proficiency in C++ programming and Object oriented programming (OOP).| Strong proficiency in Unreal engine Expertises.| Strong problem-solving, analytical, and self-learning skills.| Experience with modern graphics APIs.', 'Good knowledge in code practices and software development practices.| Good communication and interpersonal skills.| Ability to collaborate with multidisciplinary teams.| Experience with modern graphics APIs  ', '2025-10-15', '2025-10-29'),
('NP192', 'Network Programmer', 'Programming', 'Melbourne, VIC', 'Full-Time', 110000, 'Network Manager', 'We are seeking talented network programmer to join our team! As a network programmer, you will be focusing on designing and implementing network architecture and online systems to ensure the game can be transmitted to multiple devices. Our ideal candidate should have a strong background in network architecture and can effectively work with other developers.', 'Providing support on cloud server deployment and maintenance.| Performing an in-depth analysis of the client\'s and server\'s CPU and memory and determining necessary changes to improve the performance of the game.| Optimising network code to reduce bandwidth usage and ensuring a low-latency and high-performance online experience for players.| Working closely with game developers and other departments to integrate high quality network features seamlessly.| Performing troubleshooting and debugging network code to ensure stability and performance across platforms.', 'Bachelor\'s degree in computer science, engineering or other related fields.| 5 years of professional experience as a network programmer or related experience.| Proficiency in C++ or similar programming.| Ability to collaborate effectively with other team.| Good communication and interpersonal skills. | Strong understanding of network optimization and real-time performance. | Strong analytical, problem-solving, and troubleshooting skills.', 'Strong understanding in game engines like Unreal engine.| Proficient in network replication within game engines| Proficient in the network architecture of a game engine.|  Experience in designing scalable, performant systems.| Understanding of online gaming systems, multiplayer architecture, and backend technologies.', '2025-10-12', '2025-10-26'),
('TA801', 'Technical Artist', 'Design', 'Melbourne, VIC', 'Internship', 98000, 'Technical Director', 'We are seeking a creative and skillful Technical Artist to join our team. As a technical artist, you will be focusing on developing the tools and pipeline for our real-time game production and bridging the gaps between the arts and technology! Our ideal candidate is someone thrives in the gaps between the technical and arts department, bringing in their creative artist direction and their strong critical thinking skills.', 'Collaborating closely with artists, animators, and developers to understand their needs and ensure the best visuals for the game without any technical setbacks.| Designing and optimising production pipelines to production pipeline to ensure seamless flow of assets from art creation to integration.| Ensuring in-game assets are high quality, optimised and efficiently managed throughout the entire production process.| Identifying production bottlenecks and contribute to building and maintaining custom tools and scripts for building efficient workflows', '+4 years of Experience in game development or other related experience.| Bachelor\'s degree in computer science, Graphics Art or other related fields.| Ability to effectively work and collaborate with both artistic and technical teams.| Strong critical thinking and problem-solving skills.| Strong communication skills.| Proficiency in Python, MEL, or similar scripting languages.| Solid Understanding in game development production pipelines and workflows and real time assets.| Proficiency in commercial 3D software like Autodesk, Maya, Blender.', 'Genuine passion for video games.| Proficiency in game engines like Unreal Engine or Unity.| Good understanding with shader development, materials and rendering optimisation.| Strong background in 3D workflows, including modelling, texturing, animation, lighting, VFX, scripting. | Understanding in procedural workflows. | Good Knowledge with version control systems (Git).', '2025-10-16', '2025-10-30');
 

-- =========================================================
-- EOI TABLE
-- Stores Expressions of Interest (applications)
-- =========================================================
DROP TABLE IF EXISTS eoi;
CREATE TABLE eoi (
  EOInumber INT AUTO_INCREMENT PRIMARY KEY, -- Auto-generated ID
  job_ref VARCHAR(5) NOT NULL,              -- FK to jobs
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  dob DATE NOT NULL,
  gender ENUM('Male','Female','Other') NOT NULL,
  street_address VARCHAR(100) NOT NULL,
  suburb VARCHAR(50) NOT NULL,
  state VARCHAR(10) NOT NULL,
  postcode CHAR(4) NOT NULL,
  email VARCHAR(100) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  skills TEXT,
  status ENUM('New','Current','Final') DEFAULT 'New',
  FOREIGN KEY (job_ref) REFERENCES jobs(job_ref)
    ON UPDATE CASCADE ON DELETE RESTRICT
);

-- =========================================================
-- USERS TABLE
-- Stores HR manager login credentials
-- =========================================================
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL
);

-- Insert default admin account (Username: Admin, Password: Admin)
INSERT INTO users (username, password) VALUES ('Admin', 'Admin');

-- =========================================================
-- ABOUT TABLE
-- Stores member contributions for About page
-- =========================================================
DROP TABLE IF EXISTS about;
CREATE TABLE about (
  member_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  student_id VARCHAR(20),
  contribution_part1 TEXT,
  contribution_part2 TEXT,
  quote TEXT,
  favourite_language VARCHAR(50),
  dream_job VARCHAR(100),
  coding_snack VARCHAR(100),
  hometown VARCHAR(100)
);

-- Sample data for group members
INSERT INTO about (name, student_id, contribution_part1, contribution_part2, quote, favourite_language, dream_job, coding_snack, hometown)
VALUES
('Mitul Joarder', '205980686', 'About page & CSS (Part 1)', 'Converted About to PHP & DB integration (Part 2)', '“The more you stay quiet, the more you listen”', 'Python & PHP', 'CIA', 'Monster ED', 'Dhaka'),
('Disha Anchan', '103031430', 'Jobs page & CSS (Part 1)', 'Jobs.php dynamic + filters (Part 2)', '“Design is how it works.”', 'Java & Python', 'Artist', 'Popcorn & Pepsi Max', 'Melbourne'),
('Can Van Sang', '105325766', 'Apply page & CSS (Part 1)', 'Apply.php validation + process_eoi (Part 2)', '“Smooth is fast.”', 'Python', 'Police', 'Burritos & Diet Coke', 'Vietnam'),
('Samuel Moore-Coulson', '106188960', 'Content & job descriptions (Part 1)', 'Database seeding & manage.php (Part 2)', '“Yesterday is history, Tomorrow is mystery and Today is a gift”', 'HTML', 'CEO', 'Coffee', 'Australia');
