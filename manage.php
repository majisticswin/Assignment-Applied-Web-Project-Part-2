
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