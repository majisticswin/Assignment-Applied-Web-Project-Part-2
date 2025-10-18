<?php
// apply.php - Job Application Form
// Purpose: Collect applicant details with stricter validation and improved UX
$pageTitle = "Apply for a Job - Panda Mice";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Metadata -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Job Application Form for Panda Mice Careers">
  <title><?php echo htmlspecialchars($pageTitle); ?></title>
  <link rel="stylesheet" href="/styles/apply_styles.css">
  <script>
    // Simple live validation feedback
    function validateField(input, regex, message) {
      const errorSpan = input.nextElementSibling;
      if (!regex.test(input.value)) {
        errorSpan.textContent = message;
        errorSpan.style.color = "red";
      } else {
        errorSpan.textContent = "✓";
        errorSpan.style.color = "green";
      }
    }
  </script>
</head>
<body>
  <?php include("header.inc"); ?>


<!-- ================= HEADER ================= -->
<?php include("header.inc"); ?>

<main id="main" class="site-main container" role="main">
  <h1>Job Application</h1>
  <p>Please fill out the form below to apply for a job at Panda Mice. All fields marked with an asterisk (*) are required.</p>

  <!-- Application Form -->
  <form class="form-grid" method="post" action="process_eoi.php" novalidate>
    <p id="form-help" class="small">All fields are required unless marked optional.</p>

    <!-- Personal Information -->
    <fieldset class="grid-span-2">
      <legend>Personal Information</legend>

      <!-- Job Reference: must be 1 letter + 4 digits -->
      <div class="form-field">
        <label for="jobref">Job Reference Number *</label>
        <input type="text" id="jobref" name="jobref" maxlength="5"
          pattern="^[A-Za-z]{1}[0-9]{4}$"
          title="Format: 1 letter followed by 4 digits (e.g., A1234)"
          required
          oninput="validateField(this,/^[A-Za-z]{1}[0-9]{4}$/,'Format: A1234')">
        <span class="error"></span>
      </div>

      <!-- First Name -->
      <div class="form-field">
        <label for="firstname">First Name *</label>
        <input type="text" id="firstname" name="firstname" maxlength="20"
          pattern="^[A-Za-z]{1,20}$"
          title="Letters only, up to 20 characters."
          required>
      </div>

      <!-- Last Name -->
      <div class="form-field">
        <label for="lastname">Last Name *</label>
        <input type="text" id="lastname" name="lastname" maxlength="20"
          pattern="^[A-Za-z]{1,20}$"
          title="Letters only, up to 20 characters."
          required>
      </div>

      <!-- Date of Birth -->
      <div class="form-field">
        <label for="dob">Date of Birth *</label>
        <input type="date" id="dob" name="dob" required>
      </div>
    </fieldset>

    <!-- Gender -->
    <fieldset>
      <legend>Gender *</legend>
      <label><input type="radio" name="gender" value="male" required> Male</label>
      <label><input type="radio" name="gender" value="female"> Female</label>
      <label><input type="radio" name="gender" value="other"> Other</label>
    </fieldset>

    <!-- Address -->
    <fieldset class="grid-span-2">
      <legend>Address Information</legend>
      <div class="form-field">
        <label for="street">Street Address *</label>
        <input type="text" id="street" name="street" maxlength="40" required>
      </div>
      <div class="form-field">
        <label for="suburb">Suburb/Town *</label>
        <input type="text" id="suburb" name="suburb" maxlength="40" required>
      </div>
      <div class="form-field">
        <label for="state">State *</label>
        <select id="state" name="state" required>
          <option value="">Please Select</option>
          <option value="VIC">VIC</option>
          <option value="NSW">NSW</option>
          <option value="QLD">QLD</option>
          <option value="NT">NT</option>
          <option value="WA">WA</option>
          <option value="SA">SA</option>
          <option value="TAS">TAS</option>
          <option value="ACT">ACT</option>
        </select>
      </div>
      <!-- Postcode: must be 4 digits -->
      <div class="form-field">
        <label for="postcode">Postcode *</label>
        <input type="text" id="postcode" name="postcode" maxlength="4"
          pattern="^[0-9]{4}$"
          title="Exactly 4 digits (Australian postcode)"
          required
          oninput="validateField(this,/^[0-9]{4}$/,'Must be 4 digits')">
        <span class="error"></span>
      </div>
    </fieldset>

    <!-- Contact -->
    <fieldset class="grid-span-2">
      <legend>Contact Information</legend>
      <!-- Email: stricter regex -->
      <div class="form-field">
        <label for="email">Email *</label>
        <input type="email" id="email" name="email"
          pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[A-Za-z]{2,}$"
          title="Enter a valid email (e.g., name@example.com)"
          required
          oninput="validateField(this,/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[A-Za-z]{2,}$/,'Invalid email')">
        <span class="error"></span>
      </div>
      <div class="form-field">
        <label for="phone">Phone Number *</label>
        <input type="text" id="phone" name="phone" maxlength="12"
          pattern="^[0-9]{8,12}$"
          title="Enter 8 to 12 digits (numbers only)."
          required>
      </div>
    </fieldset>

    <!-- Skills -->
    <fieldset class="grid-span-2">
      <legend>Skills</legend>
      <div class="checkbox-grid">
        <label><input type="checkbox" name="skills[]" value="programming"> Programming</label>
        <label><input type="checkbox" name="skills[]" value="design"> Web Design</label>
        <label><input type="checkbox" name="skills[]" value="communication"> Communication</label>
        <label><input type="checkbox" name="skills[]" value="teamwork"> Teamwork</label>
        <label><input type="checkbox" name="skills[]" value="other"> Other skills…</label>
      </div>
      <div class="form-field grid-span-2">
        <label for="otherskills">Other Skills</label>
        <textarea id="otherskills" name="otherskills" rows="4"></textarea>
      </div>
    </fieldset>

    <!-- Buttons -->
    <div class="grid-span-2">
      <button type="submit" class="btn">Apply Now</button>
      <button type="reset" class="btn">Reset</button>
    </div>
  </form>
</main>

<!-- ================= FOOTER ================= -->
<?php include("footer.inc"); ?>

</body>
<?php include("footer.inc"); ?>

</html>
