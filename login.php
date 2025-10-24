<?php
// ======================================================
// login.php
// Purpose: Secure login page for HR manager access
// Author: Can Van Sang (105325766)
// Date: 24th October 2025
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
                $storedPassword = $user['password'];
                
                // Check if password matches (plain text or hashed)
                $passwordMatch = false;
                
                // Try hashed password first
                if (strpos($storedPassword, '$2y$') === 0) {
                    $passwordMatch = password_verify($password, $storedPassword);
                } else {
                    // Fallback to plain text comparison
                    $passwordMatch = ($password === $storedPassword);
                }
                
                if ($passwordMatch) {
                    // Login successful
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['username'] = $user['username'];
                    
                    // Redirect to manage page
                    header("Location: manage.php");
                    exit();
                } else {
                    $error = "Invalid username or password.";
                }
            } else {
                $error = "Invalid username or password.";
            }
            
            $stmt->close();
        }
        
        $conn->close();
    }
}

?>
<!DOCTYPE html>
<html lang="en-AU">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
  <link rel="stylesheet" href="/styles/apply_styles.css">
  <link rel="stylesheet" href="/styles/manage_styles.css">
  <meta name="description" content="HR Manager Login - Panda Mice Recruitment System">
</head>
<body>
  <?php include("header.inc"); ?>

  <a class="skip-link" href="#main">Skip to main content</a>

  <!-- ================= MAIN CONTENT ================= -->
  <main id="main" class="site-main container" role="main">
    <h1>HR Manager Login</h1>
    <p class="small">Please login to access the EOI management system.</p>

    <!-- Error Message -->
    <?php if (!empty($error)): ?>
      <div class="alert alert-error" role="alert">
        <strong>Error:</strong> <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
      </div>
    <?php endif; ?>

    <!-- Login Form -->
    <form class="form-grid login-form" method="post" action="login.php">
      <fieldset class="grid-span-2">
        <legend>Login Credentials</legend>

        <div class="form-field">
          <label for="username">Username</label>
          <input 
            type="text" 
            id="username" 
            name="username" 
            maxlength="50"
            required
            autofocus
            value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8') : ''; ?>"
          />
        </div>

        <div class="form-field">
          <label for="password">Password</label>
          <input 
            type="password" 
            id="password" 
            name="password" 
            maxlength="100"
            required
          />
        </div>
      </fieldset>

      <!-- Login Button -->
      <div class="grid-span-2">
        <button type="submit" class="btn">Login</button>
      </div>
    </form>

    <!-- Helper Text -->
    <div class="login-help">
      <p class="small"><strong>Marker Access:</strong> Username: <code>Admin</code> / Password: <code>Admin</code></p>
    </div>
  </main>

  <!-- ================= FOOTER ================= -->
  <?php include("footer.inc"); ?>
</body>
</html>