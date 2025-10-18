<!-- ================= NAVIGATION ================= -->
<nav class="site-nav" aria-label="Primary">
  <ul>
    <li><a href="index.php" class="<?php if(basename($_SERVER['PHP_SELF'])=='index.php') echo 'current'; ?>">Home</a></li>
    <li><a href="jobs.php" class="<?php if(basename($_SERVER['PHP_SELF'])=='jobs.php') echo 'current'; ?>">Jobs</a></li>
    <li><a href="apply.php" class="<?php if(basename($_SERVER['PHP_SELF'])=='apply.php') echo 'current'; ?>">Apply</a></li>
    <li><a href="about.php" class="<?php if(basename($_SERVER['PHP_SELF'])=='about.php') echo 'current'; ?>">About our team</a></li>
  </ul>
</nav>
