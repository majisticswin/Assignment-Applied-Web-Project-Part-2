<?php
// about.php - About Our Team Page
// Purpose: Display group details, team photo, contributions, and fun facts
$pageTitle = "About Our Team — Panda Mice";
?>
<!DOCTYPE html>
<html lang="en-AU">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($pageTitle); ?></title>
  <link rel="stylesheet" href="/styles/about_style.css">
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
  <?php include("header.inc"); ?>

  <a class="skip-link" href="#main">Skip to main content</a>

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
        <img src="/images/group.png" alt="Group G01 members smiling together in the studio lounge" width="960" height="540">
        <figcaption>DSViM — we ship, we test, we snack.</figcaption>
      </figure>
    </section>

    <!-- Member contributions with accordion for interactivity -->
    <section aria-labelledby="contrib">
      <h2 id="contrib">Member contributions and quotes</h2>
      <dl class="member-list">
        <div class="member">
          <dt onclick="toggleAccordion('mitul')">Mitul Joarder <span class="student-id">205980686</span></dt>
          <dd id="mitul" class="accordion">
            <p><strong>Contribution:</strong> about.php & CSS</p>
            <p><strong>Quote:</strong> “The more you stay quiet, the more you listen” — <span lang="bn">তুমি যত চুপ থাকবে, তত বেশি শুনবে</span></p>
            <p><strong>Favourite language:</strong> Python & PHP</p>
          </dd>
        </div>
        <div class="member">
          <dt onclick="toggleAccordion('disha')">Disha Anchan <span class="student-id">103031430</span></dt>
          <dd id="disha" class="accordion">
            <p><strong>Contribution:</strong> jobs.php & styles.css</p>
            <p><strong>Quote:</strong> “Design is how it works.” — <span lang="ja">デザインとは、それがどのように機能するかということです。</span></p>
            <p><strong>Favourite language:</strong> Java & Python</p>
          </dd>
        </div>
        <div class="member">
          <dt onclick="toggleAccordion('van')">Can Van Sang <span class="student-id">105325766</span></dt>
          <dd id="van" class="accordion">
            <p><strong>Contribution:</strong> apply.php & CSS</p>
            <p><strong>Quote:</strong> “Smooth is fast.” — <span lang="vi">Mượt mà tức là nhanh.</span></p>
            <p><strong>Favourite language:</strong> Python</p>
          </dd>
        </div>
        <div class="member">
          <dt onclick="toggleAccordion('samuel')">Samuel Moore-Coulson <span class="student-id">106188960</span></dt>
          <dd id="samuel" class="accordion">
            <p><strong>Contribution:</strong> Content, job descriptions</p>
            <p><strong>Quote:</strong> “Yesterday is history, Tomorrow is mystery and Today is a gift” — <span lang="es">Ayer es historia, mañana es misterio y hoy es un regalo.</span></p>
            <p><strong>Favourite language:</strong> HTML</p>
          </dd>
        </div>
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
          <tr>
            <td>Mitul</td>
            <td>CIA</td>
            <td>Monster ED</td>
            <td>Dhaka</td>
          </tr>
          <tr>
            <td>Disha</td>
            <td>Artist</td>
            <td>Popcorn & Pepsi Max</td>
            <td>Melbourne</td>
          </tr>
          <tr>
            <td>Van</td>
            <td>Police</td>
            <td>Burritos & Diet Coke</td>
            <td>Vietnam</td>
          </tr>
          <tr>
            <td>Samuel</td>
            <td>CEO</td>
            <td>Coffee</td>
            <td>Australia</td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>

  <!-- ================= FOOTER ================= -->
  <?php include("footer.inc"); ?>
</body>
<?php include("footer.inc"); ?>

</html>
