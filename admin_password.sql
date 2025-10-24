-- ======================================================
-- Create and Update Users Table with Hashed Password
-- Purpose: Fix users table and secure admin password
-- Author: Can Van Sang 105325766
-- Date: 18th October 2025
-- ======================================================

-- Use the correct database
USE project2_db;
DROP TABLE IF EXISTS users;

-- Create users table with proper structure
CREATE TABLE users (
  user_id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (user_id),
  UNIQUE KEY username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO users (username, password) 
VALUES ('Admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Verify the user was created successfully
SELECT user_id, username, 
       CASE 
         WHEN password LIKE '$2y$%' THEN 'HASHED (Secure ✓)'
         ELSE 'PLAIN TEXT (Insecure!)'
       END as password_status
FROM users;