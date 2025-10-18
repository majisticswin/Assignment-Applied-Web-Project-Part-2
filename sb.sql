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
  salary VARCHAR(100),                     -- Salary range
  location VARCHAR(100),                   -- Job location
  reporting_line VARCHAR(100),             -- Who the role reports to
  closing_date DATE,                       -- Application closing date
  description TEXT NOT NULL,               -- Short description
  requirements TEXT NOT NULL               -- Requirements (essential + preferable)
);

-- Sample jobs 
INSERT INTO jobs (job_ref, title, category, salary, location, reporting_line, closing_date, description, requirements)
VALUES
('AP103', 'AI Programmer', 'Programming', '$103k', 'Melbourne', 'Lead Programmer', '2025-12-31',
 'Develop advanced AI behaviours and systems for open world gameplay.',
 'Bachelor degree in CS, 5+ years experience, strong C++/Unreal skills.'),
('GD401', 'Game Developer', 'Programming', '$100k', 'Melbourne', 'Lead Developer', '2025-12-31',
 'Contribute to continuous development of the game by building new features.',
 'Bachelor degree in CS, 4+ years experience, strong OOP and Unreal Engine.'),
('TA801', 'Technical Artist', 'Art', '$95-100k', 'Melbourne', 'Technical Director', '2025-12-31',
 'Bridge the gap between art and technology by developing tools and pipelines.',
 'Bachelor degree in CS/Graphics, 4+ years experience, proficiency in Python/Maya.'),
('NP192', 'Network Programmer', 'Networking', '90-120k', 'Melbourne', 'Networks Manager', '2025-12-31',
 'Design and implement network architecture and online systems.',
 'Bachelor degree in CS/Engineering, 5+ years experience, strong C++ and networking.');
 

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
