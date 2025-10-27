<?php
// about.php - About Our Team Page
// Purpose: Display group details, team photo, contributions, and fun facts
$pageTitle = "About Our Team — Panda Mice";

// ---------- Simple DB setup (beginner friendly) ----------
/*
  Update the credentials below to match your environment.
  - $db_host: typically 'localhost'
  - $db_user: your DB username (e.g. 'root')
  - $db_pass: your DB password (often empty on dev machines)
  - $db_name: the database created by sb.sql (project2_db)
  Reference: https://www.php.net/manual/en/book.mysqli.php
*/
$db_host = 'localhost';
$db_user = 'root';
$db_pass = ''; // <-- change if your MySQL has a password
$db_name = 'project2_db';

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($mysqli->connect_errno) {
  // Keep this message simple for beginners; use error_log in production
  die("Database connection failed: " . $mysqli->connect_error);
}

// Fetch members from `about` table
$members = [];
if ($result = $mysqli->query("SELECT * FROM about ORDER BY member_id")) {
  while ($row = $result->fetch_assoc()) {
    $members[] = $row;
  }
  $result->free();
} else {
  // If query fails, we log but allow the page to continue with an empty list
  error_log("DB query failed (about): " . $mysqli->error);
}
?>
<!DOCTYPE html>
<html lang="en-AU">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($pageTitle); ?></title>
  <link rel="stylesheet" href="styles/about_style.css">
  <meta name="description" content="Meet the Panda Mice recruitment project group: contributions, fun facts, and team photo.">
  <script>
    // Simple accordion toggle for member contributions
    function toggleAccordion(id) {
      const section = document.getElementById(id);
      section.classList.toggle("open");
    }
  </script>
</head>
<body>
  <!-- ================= HEADER ================= -->
  <?php include("header.inc"); ?>

  <!-- ================= MAIN CONTENT ================= -->
  <main id="main" class="site-main container" role="main">
    <h1>Group G01 — Recruitment Site Team</h1>

    <!-- Group details -->
    <section aria-labelledby="group-meta">
      <h2 id="group-meta">Group details</h2>
      <ul>
        <li><strong>Group name:</strong> <span class="code-tag">DSViM</span></li>
        <li><strong>Class:</strong>
          <ul>
            <li><strong>Day:</strong> Tuesday</li>
            <li><strong>Time:</strong> 2:30–4:30 pm AEST</li>
          </ul>
        </li>
      </ul>
    </section>

    <!-- Team photo with descriptive alt text -->
    <section aria-labelledby="team-photo">
      <h2 id="team-photo">Team photo</h2>
      <figure class="group-figure">
        <img src="images/group.png" alt="Group G01 members smiling together in the studio lounge" width="960" height="540">
        <figcaption>DSViM — we ship, we test, we snack.</figcaption>
      </figure>
    </section>

    <!-- Member contributions with accordion for interactivity -->
    <section aria-labelledby="contrib">
      <h2 id="contrib">Member contributions and quotes</h2>

      <!-- Render members dynamically from the DB -->
       <!-- Reference https://www.php.net/mysqli -->
      <dl class="member-list">
<?php foreach ($members as $m):
      // unique id for JS accordion
      $id = 'member' . (int)$m['member_id'];
?>
        <div class="member">
          <dt onclick="toggleAccordion('<?php echo $id; ?>')">
            <?php echo htmlspecialchars($m['name']); ?>
            <?php if (!empty($m['student_id'])): ?>
              <span class="student-id"><?php echo htmlspecialchars($m['student_id']); ?></span>
            <?php endif; ?>
          </dt>

          <dd id="<?php echo $id; ?>" class="accordion">
            <p><strong>Contribution:</strong>
              <?php
                // combine contribution parts if available, keep newlines readable
                $parts = trim($m['contribution_part1']);
                if (!empty($m['contribution_part2'])) {
                  $parts .= ' & ' . trim($m['contribution_part2']);
                }
                echo nl2br(htmlspecialchars($parts));
              ?>
            </p>
            <p><strong>Quote:</strong> <?php echo htmlspecialchars($m['quote']); ?></p>
            <p><strong>Favourite language:</strong> <?php echo htmlspecialchars($m['favourite_language']); ?></p>
          </dd>
        </div>
<?php endforeach; ?>
      </dl>
    </section>

    <!-- Fun facts table -->
    <section aria-labelledby="funfacts">
      <h2 id="funfacts">Fun facts</h2>
      <table class="fun-table">
        <caption>What fuels our dev hours</caption>
        <thead>
          <tr>
            <th>Member</th>
            <th>Dream job</th>
            <th>Coding snack</th>
            <th>Hometown</th>
          </tr>
        </thead>
        <tbody>
<?php foreach ($members as $m): ?>
          <tr>
            <!-- Show first name (simple split) -->
            <td><?php echo htmlspecialchars(explode(' ', trim($m['name']))[0]); ?></td>
            <td><?php echo htmlspecialchars($m['dream_job']); ?></td>
            <td><?php echo htmlspecialchars($m['coding_snack']); ?></td>
            <td><?php echo htmlspecialchars($m['hometown']); ?></td>
          </tr>
<?php endforeach; ?>
        </tbody>
      </table>
    </section>
  </main>

<?php
// close DB connection
$mysqli->close();
?>

  <!-- ================= FOOTER ================= -->
  <?php include("footer.inc"); ?>
</body>
</html>
