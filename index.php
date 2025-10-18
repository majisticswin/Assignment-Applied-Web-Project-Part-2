<?php
// Set dynamic page title
$pageTitle = "Panda Mice Careers - Join Our Team";
?>
<!DOCTYPE html>
<html lang="en-AU">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
  <link rel="stylesheet" href="/styles/index_styles.css">
  <meta name="description" content="Explore exciting career opportunities at Panda Mice. Join our Melbourne-based team and grow your career in technology, design, and innovation.">
</head>
<body class="home">
  <?php include("header.inc"); ?>

  <a class="skip-link" href="#main">Skip to main content</a>

  <!-- ================= HEADER ================= -->
  <header class="site-header" role="banner">
    <div class="container header-inner">
      <a class="brand" href="index.php" aria-label="Panda Mice home">
        <img src="/images/Panda Mice-logo.png" alt="Panda Mice logo" width="56" height="56">
        <span class="brand-text">
          <span class="brand-name">Panda Mice</span>
          <span class="brand-slogan">Careers Beyond the Bounds</span>
        </span>
      </a>
      <nav class="site-nav" aria-label="Primary">
        <ul>
          <li><a href="index.php" aria-current="page" class="current">Home</a></li>
          <li><a href="jobs.php">Jobs</a></li>
          <li><a href="apply.php">Apply</a></li>
          <li><a href="about.php">About our team</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- ================= MAIN CONTENT ================= -->
  <main id="main" class="site-main" role="main">

    <!-- Hero Section: Clear recruitment focus -->
    <section class="hero" aria-label="Career opportunities">
      <div class="container">
        <h1>Build Your Career with Panda Mice</h1>
        <p>
          We’re more than a game studio — we’re a team of innovators, engineers, and storytellers. 
          Explore open positions and join us in shaping the future of interactive entertainment.
        </p>
        <a class="btn cta" href="jobs.php">Browse Careers</a>
      </div>
    </section>

    <!-- About Section: Company + recruitment purpose -->
    <section class="container" aria-labelledby="about-studio">
      <h2 id="about-studio">Why Work With Us?</h2>
      <p>At Panda Mice, we believe in collaboration, growth, and creativity. Our recruitment program is designed to help you thrive in a supportive and innovative environment.</p>
      
      <figure class="studio-figure">
        <!-- dev image -->
        <img src="/images/developers.png" alt="Team collaborating on projects at Panda Mice" width="960" height="540">
        <figcaption>Our team working together to create world-class experiences.</figcaption>
      </figure>

      <p>We offer opportunities across engineering, design, and production. Whether you’re a graduate or an experienced professional, we have a place for you.</p>
      <p><a class="btn" href="apply.php">Apply Now</a></p>
    </section>

    <!-- Engagement Feature: Testimonial/Quote -->
    <section class="testimonial" aria-label="Employee testimonial">
      <div class="container">
        <blockquote>
          “Joining Panda Mice has been the best career decision I’ve made. 
          The culture of learning and teamwork is unmatched.” 
        </blockquote>
        <cite>— Alex, Software Engineer</cite>
      </div>
    </section>

  </main>

  <!-- ================= FOOTER ================= -->
  <footer class="site-footer" role="contentinfo">
    <div class="container footer-inner">
      <p><strong>Contact:</strong> <a href="mailto:info@pandamicegames.com">info@pandamicegames.com</a></p>
      <ul class="footer-links">
        <li><a href="https://pandamice.atlassian.net/" rel="noopener">Jira</a></li>
        <li><a href="https://github.com/majisticswin/PandaMice" rel="noopener">GitHub</a></li>
      </ul>
      <p class="small">© Panda Mice. Melbourne, Australia.</p>
    </div>
  </footer>
</body>
<?php include("footer.inc"); ?>

</html>
