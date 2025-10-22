
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