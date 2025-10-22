
<?php
// ======================================================
// manage.php
// Purpose: HR Manager Dashboard for EOI Management
// Author: Can Van Sang (105325766)
// Date: 19th October 2025
// - List all EOIs
// - Search by job reference
// - Search by applicant name
// - Delete all EOIs by job reference
// - Change EOI status
// - Sort results by any field
// ======================================================
// Start session
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$timeout_duration = 1800;
if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time']) > $timeout_duration) {
    session_destroy();
    header("Location: login.php?timeout=1");
    exit();
}

$_SESSION['login_time'] = time();
require_once("settings.php");

$conn = new mysqli($host, $user, $pwd, $sql_db);

if ($conn->connect_error) {
    die("Database connection failed: " . htmlspecialchars($conn->connect_error, ENT_QUOTES, 'UTF-8'));
}

// ... code ...
$conn->close();
$success_msg = "";
$error_msg = "";
$eoi_results = [];
$search_performed = false;
$sort_field = isset($_GET['sort']) ? $_GET['sort'] : 'EOInumber';
$sort_order = isset($_GET['order']) && $_GET['order'] === 'DESC' ? 'DESC' : 'ASC';

$allowed_sort_fields = ['EOInumber', 'job_ref', 'first_name', 'last_name', 'dob', 'email', 'status'];
if (!in_array($sort_field, $allowed_sort_fields)) {
    $sort_field = 'EOInumber';
}
$action = $_POST['action'] ?? ($_GET['action'] ?? '');

if ($action == 'delete_by_jobref' && !empty($_POST['job_ref'])) {
    $delete_job_ref = trim($_POST['job_ref']);
    $stmt = $conn->prepare("DELETE FROM eoi WHERE job_ref = ?");
    $stmt->bind_param("s", $delete_job_ref);
    
    if ($stmt->execute()) {
        $deleted_count = $stmt->affected_rows;
        if ($deleted_count > 0) {
            $success_msg = "Successfully deleted {$deleted_count} EOI(s) for job reference: " . htmlspecialchars($delete_job_ref, ENT_QUOTES, 'UTF-8');
        } else {
            $error_msg = "No EOIs found for job reference: " . htmlspecialchars($delete_job_ref, ENT_QUOTES, 'UTF-8');
        }
    } else {
        $error_msg = "Error deleting EOIs: " . htmlspecialchars($stmt->error, ENT_QUOTES, 'UTF-8');
    }
    $stmt->close();
}
if ($action == 'update_status' && isset($_POST['status']) && isset($_POST['eoi_number'])) {
    $eoi_number = intval($_POST['eoi_number']);
    $new_status = $_POST['status'];
    
    $valid_statuses = ['New', 'Current', 'Final'];
    if (in_array($new_status, $valid_statuses)) {
        $stmt = $conn->prepare("UPDATE eoi SET status = ? WHERE EOInumber = ?");
        $stmt->bind_param("si", $new_status, $eoi_number);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $success_msg = "Status updated successfully for EOI #{$eoi_number}";
            } else {
                $error_msg = "No changes made or EOI not found.";
            }
        } else {
            $error_msg = "Error updating status: " . htmlspecialchars($stmt->error, ENT_QUOTES, 'UTF-8');
        }
        $stmt->close();
    } else {
        $error_msg = "Invalid status value.";
    }
}
if ($action == 'bulk_update_status' && isset($_POST['status'])) {
    foreach ($_POST['status'] as $eoi_number => $status_value) {
        $eoi_number = intval($eoi_number);
        $status_value = trim($status_value);
        
        $valid_statuses = ['New', 'Current', 'Final'];
        if (in_array($status_value, $valid_statuses)) {
            $stmt = $conn->prepare("UPDATE eoi SET status = ? WHERE EOInumber = ?");
            $stmt->bind_param("si", $status_value, $eoi_number);
            $stmt->execute();
            $stmt->close();
        }
    }
    $success_msg = "Status updated successfully for all selected EOIs.";
}
$query_conditions = [];
$params = [];
$param_types = "";

// Search by job reference
if (isset($_GET['search_job_ref']) && !empty(trim($_GET['search_job_ref']))) {
    $search_job_ref = trim($_GET['search_job_ref']);
    $query_conditions[] = "job_ref = ?";
    $params[] = $search_job_ref;
    $param_types .= "s";
    $search_performed = true;
}

// Search by applicant name
if (isset($_GET['search_name']) && !empty(trim($_GET['search_name']))) {
    $search_name = trim($_GET['search_name']);
    $search_name_like = "%" . $search_name . "%";
    $query_conditions[] = "(first_name LIKE ? OR last_name LIKE ?)";
    $params[] = $search_name_like;
    $params[] = $search_name_like;
    $param_types .= "ss";
    $search_performed = true;
}
$sql = "SELECT EOInumber, job_ref, first_name, last_name, dob, gender, 
               street_address, suburb, state, postcode, email, phone, skills, status 
        FROM eoi";

if (!empty($query_conditions)) {
    $sql .= " WHERE " . implode(" AND ", $query_conditions);
}

$sql .= " ORDER BY " . $sort_field . " " . $sort_order;

if (!empty($params)) {
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param($param_types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $error_msg = "Database query error: " . htmlspecialchars($conn->error, ENT_QUOTES, 'UTF-8');
        $result = null;
    }
} else {
    $result = $conn->query($sql);
}

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $eoi_results[] = $row;
    }
}
$job_refs_query = "SELECT DISTINCT job_ref FROM jobs ORDER BY job_ref";
$job_refs_result = $conn->query($job_refs_query);
$job_refs = [];
if ($job_refs_result && $job_refs_result->num_rows > 0) {
    while ($row = $job_refs_result->fetch_assoc()) {
        $job_refs[] = $row['job_ref'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="keywords" content="HJDJ IT, IT jobs, software jobs, tech careers, job application, software engineering, developer jobs, IT careers, job openings, apply online">
    <title>HJDJ IT Manager Portal</title>
    <link rel="stylesheet" href="styles/styles.css?v2">
    <link rel="icon" type="image/png" href="images/logoweb.png">
    <style>
      select[name^="status"] {
        width: 100px;
        padding: 6px;
        font-size: 13px;
      }
      .sort-btn {
        background: none;
        border: none;
        color: #007bff;
        cursor: pointer;
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <?php include "header.inc"; ?>
    
    <nav>
      <ul class="menu">
        <li>Manager Site</li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
    <?php if (!empty($success_msg)): ?>
  <div class='success-message'><?php echo htmlspecialchars($success_msg, ENT_QUOTES, 'UTF-8'); ?></div>
<?php endif; ?>

<?php if (!empty($error_msg)): ?>
  <div class='error-message'><?php echo htmlspecialchars($error_msg, ENT_QUOTES, 'UTF-8'); ?></div>
<?php endif; ?>