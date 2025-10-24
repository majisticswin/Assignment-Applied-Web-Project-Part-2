<?php
// ======================================================
// manage.php
// Purpose: HR manager interface for EOI management
// Author: Can Van Sang (105325766)
// Date: 24th October 2025
// ======================================================

// Start session to check logged-in user
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Initialize variables
$error = "";
$success = "";
$result = null;
$sortField = $_GET['sort'] ?? 'EOInumber';
$allowedSorts = ['EOInumber', 'job_ref', 'first_name', 'last_name', 'status'];
if (!in_array($sortField, $allowedSorts)) {
    $sortField = 'EOInumber';
}

// Include database settings
require_once("settings.php");

// Create database connection
$conn = new mysqli($host, $user, $pwd, $sql_db);

// Check connection
if ($conn->connect_error) {
    $error = "Database connection failed. Please try again later.";
}

// Process form actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // Delete by Job Reference
    if ($action === 'delete_by_jobref') {
        $jobRef = trim($_POST['job_ref'] ?? '');
        
        if (empty($jobRef)) {
            $error = "Please enter a job reference.";
        } else {
            $jobRef = $conn->real_escape_string($jobRef);
            $deleteQuery = "DELETE FROM eoi WHERE job_ref = '$jobRef'";
            
            if ($conn->query($deleteQuery)) {
                $affectedRows = $conn->affected_rows;
                if ($affectedRows > 0) {
                    $success = "Successfully deleted $affectedRows EOI(s) for job reference: $jobRef";
                } else {
                    $error = "No EOIs found for job reference: $jobRef";
                }
            } else {
                $error = "Error deleting EOIs: " . $conn->error;
            }
        }
    }

    // Update Status
    elseif ($action === 'update_status') {
        $updates = $_POST['status'] ?? [];
        $updateCount = 0;

        foreach ($updates as $eoiNumber => $newStatus) {
            $eoiNumber = intval($eoiNumber);
            $newStatus = $conn->real_escape_string($newStatus);

            $updateQuery = "UPDATE eoi SET status = '$newStatus' WHERE EOInumber = $eoiNumber";
            if ($conn->query($updateQuery)) {
                $updateCount++;
            }
        }

        if ($updateCount > 0) {
            $success = "Successfully updated $updateCount EOI status(es).";
        } else {
            $error = "No status updates were made.";
        }
    }
}

// Process GET actions (List operations)
$action = $_GET['action'] ?? $_POST['action'] ?? 'list_all';

if ($action === 'list_all') {
    $query = "SELECT * FROM eoi ORDER BY $sortField ASC";
    $result = $conn->query($query);
} elseif ($action === 'list_by_position') {
    $jobRef = $conn->real_escape_string($_GET['job_ref'] ?? '');
    
    if (!empty($jobRef)) {
        $query = "SELECT * FROM eoi WHERE job_ref = '$jobRef' ORDER BY $sortField ASC";
        $result = $conn->query($query);
    } else {
        $error = "Please select a job reference.";
    }
} elseif ($action === 'list_by_name') {
    $firstName = $conn->real_escape_string(trim($_POST['first_name'] ?? ''));
    $lastName = $conn->real_escape_string(trim($_POST['last_name'] ?? ''));

    $query = "SELECT * FROM eoi WHERE 1=1";
    
    if (!empty($firstName)) {
        $query .= " AND first_name LIKE '%$firstName%'";
    }
    if (!empty($lastName)) {
        $query .= " AND last_name LIKE '%$lastName%'";
    }

    if (empty($firstName) && empty($lastName)) {
        $error = "Please enter at least a first name or last name.";
    } else {
        $query .= " ORDER BY $sortField ASC";
        $result = $conn->query($query);
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

    <!-- Error Message -->
    <?php if (!empty($error)): ?>
      <div class="alert alert-error" role="alert">
        <strong>Error:</strong> <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
      </div>
    <?php endif; ?>

    <!-- ================= MANAGEMENT FORMS ================= -->
    <section class="management-section">
      <h2>Search & Filter Options</h2>

      <!-- List All EOIs -->
      <div class="form-section">
        <h3>List All EOIs</h3>
        <form method="get">
          <input type="hidden" name="action" value="list_all">
          <button type="submit" class="btn">View All EOIs</button>
        </form>
      </div>

      <!-- List by Job Reference -->
      <div class="form-section">
        <h3>Filter by Job Reference</h3>
        <form method="get" class="form-inline">
          <label for="job_ref">Job Reference:</label>
          <select id="job_ref" name="job_ref" required>
            <option value="">-- Select Job Reference --</option>
            <option value="AP103">AP103 - AI Programmer</option>
            <option value="GD401">GD401 - Game Developer</option>
            <option value="NP192">NP192 - Network Programmer</option>
            <option value="TA801">TA801 - Technical Artist</option>
          </select>
          <input type="hidden" name="action" value="list_by_position">
          <button type="submit" class="btn">Filter</button>
        </form>
      </div>

      <!-- List by Applicant Name -->
      <div class="form-section">
        <h3>Search by Applicant Name</h3>
        <form method="post" class="form-grid">
          <div class="form-field">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" maxlength="50">
          </div>

          <div class="form-field">
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" maxlength="50">
          </div>

          <input type="hidden" name="action" value="list_by_name">
          <button type="submit" class="btn">Search</button>
        </form>
      </div>

      <!-- Delete by Job Reference -->
      <div class="form-section danger-section">
        <h3>Delete EOIs by Job Reference</h3>
        <form method="post" class="form-inline" onsubmit="return confirm('Are you sure? This action cannot be undone.');">
          <label for="delete_job_ref">Job Reference:</label>
          <input type="text" id="delete_job_ref" name="job_ref" maxlength="5" required>
          <input type="hidden" name="action" value="delete_by_jobref">
          <button type="submit" class="btn btn-danger">Delete All</button>
        </form>
      </div>
    </section>

    <!-- ================= RESULTS TABLE ================= -->
    <?php if ($result && $result instanceof mysqli_result && $result->num_rows > 0): ?>
      <section class="results-section">
        <h2>Results 
          <?php if ($action === 'list_by_position'): ?>
            (Job: <?php echo htmlspecialchars($_GET['job_ref'], ENT_QUOTES, 'UTF-8'); ?>)
          <?php endif; ?>
        </h2>

        <div class="table-container">
          <form method="post" id="statusForm">
            <table class="eoi-table" role="region" aria-label="EOI Management Table">
              <thead>
                <tr>
                  <th><a href="?action=<?php echo htmlspecialchars($action, ENT_QUOTES, 'UTF-8'); ?>&sort=EOInumber">EOI #</a></th>
                  <th><a href="?action=<?php echo htmlspecialchars($action, ENT_QUOTES, 'UTF-8'); ?>&sort=job_ref">Job Ref</a></th>
                  <th><a href="?action=<?php echo htmlspecialchars($action, ENT_QUOTES, 'UTF-8'); ?>&sort=first_name">First Name</a></th>
                  <th><a href="?action=<?php echo htmlspecialchars($action, ENT_QUOTES, 'UTF-8'); ?>&sort=last_name">Last Name</a></th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>DOB</th>
                  <th>Location</th>
                  <th><a href="?action=<?php echo htmlspecialchars($action, ENT_QUOTES, 'UTF-8'); ?>&sort=status">Status</a></th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                  <tr>
                    <td><?php echo htmlspecialchars($row['EOInumber'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['job_ref'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['first_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['last_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['dob'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['suburb'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                      <select name="status[<?php echo intval($row['EOInumber']); ?>]" class="status-select">
                        <option value="New" <?php if ($row['status'] === 'New') echo 'selected'; ?>>New</option>
                        <option value="Current" <?php if ($row['status'] === 'Current') echo 'selected'; ?>>Current</option>
                        <option value="Final" <?php if ($row['status'] === 'Final') echo 'selected'; ?>>Final</option>
                      </select>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>

            <div class="button-group">
              <input type="hidden" name="action" value="update_status">
              <button type="submit" class="btn">Update Status</button>
            </div>
          </form>
        </div>
      </section>
    <?php elseif ($result && $result instanceof mysqli_result): ?>
      <section class="results-section">
        <p>No EOIs found matching your criteria.</p>
      </section>
    <?php endif; ?>

  </main>

  <!-- ================= FOOTER ================= -->
  <?php include("footer.inc"); ?>
</body>
</html>

<?php
$conn->close();
?>