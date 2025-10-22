<?php
// ======================================================
// login.php
// Purpose: Secure login page for HR manager access
// Author: Can Van Sang (105325766)
// Date: 19th October 2025
// ======================================================

// Start session to track logged-in users
session_start();

// If already logged in, redirect to manage page
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: manage.php");
    exit();
}

// Initialize variables
$error = "";
$pageTitle = "HR Manager Login - Panda Mice";

// Process login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include database settings
    require_once("settings.php");
    
    // Create database connection
    $conn = new mysqli($host, $user, $pwd, $sql_db);
    
    // Check connection
    if ($conn->connect_error) {
        $error = "Database connection failed. Please try again later.";
    } else {
        // Sanitize input
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        
        // Validate input
        if (empty($username) || empty($password)) {
            $error = "Please enter both username and password.";
        } else {
            // Prepare statement to prevent SQL injection
            $stmt = $conn->prepare("SELECT user_id, username, password FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                
                // Check if password is hashed (starts with $2y$ for bcrypt)
                if (strpos($user['password'], '$2y$') === 0) {
                    // Use password_verify for hashed passwords
                    if (password_verify($password, $user['password'])) {
                        // Login successful
                        $_SESSION['logged_in'] = true;
                        $_SESSION['user_id'] = $user['user_id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['login_time'] = time();