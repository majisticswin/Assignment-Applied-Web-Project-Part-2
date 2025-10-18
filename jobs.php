<?php
// jobs.php - Dynamic Job Listings Page
// Purpose: Display job opportunities from the database with search and filter functionality

// Include database settings
require_once("settings.php");

// Connect to database
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn) {
    die("<p>Database connection failure</p>");
}

// Capture search and filter inputs
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';

// Build SQL query dynamically
$sql = "SELECT * FROM jobs WHERE 1=1";
if ($search !== '') {
    $searchEsc = mysqli_real_escape_string($conn, $search);
    $sql .= " AND (title LIKE '%$searchEsc%' OR description LIKE '%$searchEsc%' OR requirements LIKE '%$searchEsc%')";
}
if ($category !== '') {
    $catEsc = mysqli_real_escape_string($conn, $category);
    $sql .= " AND category = '$catEsc'";
}

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panda Mice Careers - Job Listings</title>
  <link rel="stylesheet" href="/styles/jobs_styles.css">
  <meta name="description" content="Explore open job opportunities at Panda Mice. Filter by category or search to find your perfect role.">
</head>
<body>
  <?php include("header.inc"); ?>


<!-- ================= HEADER ================= -->
<?php include("header.inc"); ?>

<main>
  <h1>Careers</h1>

  <!-- Why Join Us Section -->
  <aside class="join-us">
    <h2>Why Join Us!</h2>
    <ol>
      <li>Flexible working options, including remote work opportunities</li>
      <li>Competitive salary with performance bonuses</li>
      <li>Extended parental leave for new families</li>
      <li>Discounted mental health assistance</li>
      <li>Supportive and inclusive culture</li>
    </ol>
  </aside>

  <!-- Search and Filter Form -->
  <section class="job-filters">
    <form method="get" action="jobs.php">
      <input type="text" name="search" placeholder="Search jobs..." value="<?php echo htmlspecialchars($search); ?>">
      <select name="category">
        <option value="">All Categories</option>
        <option value="Programming" <?php if($category=="Programming") echo "selected"; ?>>Programming</option>
        <option value="Design" <?php if($category=="Design") echo "selected"; ?>>Design</option>
        <option value="Art" <?php if($category=="Art") echo "selected"; ?>>Art</option>
        <option value="Networking" <?php if($category=="Networking") echo "selected"; ?>>Networking</option>
      </select>
      <button type="submit">Filter</button>
    </form>
  </section>

  <!-- Job Listings Section -->
  <section class="job-listings">
    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<article class='job-position'>";
            echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";

            // Job details
            echo "<section class='job-details'>";
            echo "<p><strong>Reference Number:</strong> " . htmlspecialchars($row['job_ref']) . "</p>";
            echo "<p><strong>Salary:</strong> " . htmlspecialchars($row['salary']) . "</p>";
            echo "<p><strong>Reporting Line:</strong> " . htmlspecialchars($row['reporting_line']) . "</p>";
            echo "</section>";

            // Short description
            echo "<section class='job-desc'>";
            echo "<h3>Short Description</h3>";
            echo "<p>" . nl2br(htmlspecialchars($row['description'])) . "</p>";
            echo "</section>";

            // Requirements
            echo "<section class='job-req'>";
            echo "<h3>Requirements</h3>";
            echo "<p>" . nl2br(htmlspecialchars($row['requirements'])) . "</p>";
            echo "</section>";

            // Apply button
            echo "<p><a class='btn' href='apply.php?job_ref=" . urlencode($row['job_ref']) . "'>Apply Now</a></p>";

            echo "</article><hr>";
        }
    } else {
        echo "<p>No jobs found. Try adjusting your search or filter.</p>";
    }
    ?>
  </section>
</main>

<!-- ================= FOOTER ================= -->
<?php include("footer.inc"); ?>

</body>
<?php include("footer.inc"); ?>

</html>
<?php
// Free result set and close connection
if ($result) mysqli_free_result($result);
mysqli_close($conn);
?>
