<?php
// process_eoi.php - Handles job application submissions
// Purpose: Validate, sanitize, and insert EOI records into the database

// Block direct access if no POST data
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['jobref'])) {
    header("Location: apply.php");
    exit();
}

require_once("settings.php");

// Connect to database
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn) {
    die("<p>Database connection failure</p>");
}

// Ensure EOI table exists
$createTable = "
CREATE TABLE IF NOT EXISTS eoi (
  EOInumber INT AUTO_INCREMENT PRIMARY KEY,
  job_ref VARCHAR(5) NOT NULL,
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
)";
mysqli_query($conn, $createTable);

// Helper: sanitize input
function clean_input($data, $conn) {
    return mysqli_real_escape_string($conn, htmlspecialchars(trim($data)));
}

// Collect and validate inputs
$errors = [];
$job_ref   = clean_input($_POST['jobref'], $conn);
$firstname = clean_input($_POST['firstname'], $conn);
$lastname  = clean_input($_POST['lastname'], $conn);
$dob       = clean_input($_POST['dob'], $conn);
$gender    = clean_input($_POST['gender'], $conn);
$street    = clean_input($_POST['street'], $conn);
$suburb    = clean_input($_POST['suburb'], $conn);
$state     = clean_input($_POST['state'], $conn);
$postcode  = clean_input($_POST['postcode'], $conn);
$email     = clean_input($_POST['email'], $conn);
$phone     = clean_input($_POST['phone'], $conn);
$skillsArr = isset($_POST['skills']) ? $_POST['skills'] : [];
$skills    = clean_input(implode(", ", $skillsArr) . " " . ($_POST['otherskills'] ?? ""), $conn);

// Validation rules
if (!preg_match("/^[A-Za-z]{1}[0-9]{4}$/", $job_ref)) {
    $errors[] = "Job reference must be 1 letter followed by 4 digits (e.g., A1234).";
}
if (!preg_match("/^[A-Za-z]{1,20}$/", $firstname)) {
    $errors[] = "First name must be letters only, up to 20 characters.";
}
if (!preg_match("/^[A-Za-z]{1,20}$/", $lastname)) {
    $errors[] = "Last name must be letters only, up to 20 characters.";
}
if (!preg_match("/^[0-9]{4}$/", $postcode)) {
    $errors[] = "Postcode must be exactly 4 digits.";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}
if (!preg_match("/^[0-9]{8,12}$/", $phone)) {
    $errors[] = "Phone number must be 8–12 digits.";
}

// If errors, show them
if (!empty($errors)) {
    echo "<h1>Application Error</h1><ul>";
    foreach ($errors as $e) { //Using $e without initializing it will trigger an "undefined variable" notice when error reporting is enabled.
        echo "<li>" . htmlspecialchars($e) . "</li>"; //$e is different from superglobals like $_GET['e']
    }
    echo "</ul><p><a href='apply.php'>Go back to the application form</a></p>";
    exit();
}

// Insert into database
$sql = "INSERT INTO eoi (job_ref, first_name, last_name, dob, gender, street_address, suburb, state, postcode, email, phone, skills)
        VALUES ('$job_ref', '$firstname', '$lastname', '$dob', '$gender', '$street', '$suburb', '$state', '$postcode', '$email', '$phone', '$skills')";

if (mysqli_query($conn, $sql)) {
    $eoiNumber = mysqli_insert_id($conn);
    echo "<h1>Application Submitted Successfully</h1>";
    echo "<p>Thank you, " . htmlspecialchars($firstname) . " " . htmlspecialchars($lastname) . ".</p>";
    echo "<p>Your Expression of Interest has been recorded with EOI Number: <strong>$eoiNumber</strong></p>";
    echo "<p><a href='index.php'>Return to Home</a></p>";
} else {
    echo "<p>Something went wrong: " . mysqli_error($conn) . "</p>";
}

mysqli_close($conn);
?>
