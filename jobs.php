<!-- //====================================================== -->
<!-- // Filename: jobs.php -->
<!-- // Purpose: Main Page for Jobs. Displays a list of job summaries-->
<!-- // Author: Disha Anchan (103031430)-->
<!-- // Date: 25th October 2025 -->
<!-- // ====================================================== -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta tags for Job Description Page -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Job Description page with PHP and SQL">
        <meta name="keywords" content="Job, Description, Roles, PHP, Search, SQL">
        <meta name="author" content="Disha Anchan">
        
        <!-- Title of the tab -->
        <title>Job Description</title>

        <!-- Link HTML to the CSS document -->
        <link rel="stylesheet" href="styles/jobs_main_styles.css">

    </head>
    <body>
        <!-- ============================ HEADER SECTION ============================ -->

        <?php include 'header.inc'?>   <!-- Include the header.inc file for layout consistency -->

        <!-- ============================ MAIN SECTION ============================== -->
        <!-- Contains the hero image, search bar, filter and sort fields and the listed job summary from the database -->

        <main class="site-main">

            <!-- ============================ HERO SECTION ============================== -->
            <!-- A Hero image with a list of the benefits on why work with PandaMice company in order to attract users and visual aethetic -->

            <div class="hero">
                <div class="hero-content">

                    <!-- Embedded image for the Hero image -->
                    <img src="images/careers.jpg" alt="A group of developers working on computers">

                    <!-- List of benefits when working with PandaMice -->
                    <aside aria-labelledby='benefits'>
                        <h1 id='benefits'>Reasons to join the team!</h1>
                        <ul>
                            <li><p>Flexible working opportunities, including remote work!</p></li>
                            <li><p>Competitive salary, including additional bonuses!</p></li>
                            <li><p>Extended parental leave for new parents!</p></li>
                            <li><p>Access to mental health assistance!</p></li>
                            <li><p>Be a part of a supportive and inclusive culture!</p></li>
                        </ul>
                    </aside>

                </div>
            </div>

            <div class="container jobs-page">

                <!-- ============================ FORM SECTION ============================== -->
                <!-- A form containing the search bar, filter field and sort field that will be used to filter the job results -->

                <form action="jobs.php" method="GET"> 

                    <!-- ============================ SEARCH BAR SECTION ======================== -->
                    <!-- Conatains the search bar and search button to allow users to search up a specific job -->

                    <div class="search">
                        <input class="search-bar" type="text" name="title" id="title" value="<?php if (isset($_GET['title'])){ echo htmlspecialchars($_GET['title']);}?>" placeholder="Enter Job title here" aria-label='Search bar'>
                        <input class="search-btn" name="search" type="submit" value="Search" aria-label="Submit Search">
                    </div>

                    <!-- The code "</?php //if (isset($_GET['title'])) { echo htmlspecialchars($_GET['title']);}?>"
                         is used to retain the value submitted after pressing the submit button -->

                    <!-- Allow the user to keep the searched value on search bar and potentially include other fields from 
                    the filter and sort section should they wish to further filter out the results -->

                    <!-- NOTE: The code was taken from a YouTube video (Reference: https://www.youtube.com/watch?v=Eq7bGWQsOdI)
                    to retain the values in the in the search bar-->


                    <!-- ============================ FILTER & SORT BY SECTION ============================ -->

                    <!-- Select elements and input type="radio" have the code below inside the value attribute:
                        E.g. </?php if(isset($_GET['category']) && $_GET['category'] === "Programming"){echo 'selected' (or 'checked' if input type='radio');}?> 
                    -->
                    
                    <!-- The command was taken from ChatGPT to determine the code for retaining values in a dropdown menu -->
                    <!-- PROMPT: how to keep value on select element after submitting form using only PHP -->
                    <!-- Code for the input type="radio" is also based on the code taken from ChatGPT -->


                    <div class="filter-sort">
                        <!-- ================================ FILTER SECTION ============================ -->
                        <!-- Contains a lists of fields for filtering job results  -->

                        <fieldset>
                            <legend>Filter</legend>

                            <!-- ============================ SALARY RANGE FILTER SECTION ============================ -->
                            <!-- Implement Salary range using two input elements with the type "number": Min. Salary and Max. Salary -->
                            <!-- Input type="number" is used for preventing users from entering a non-numeric value or special characters-->
                            <!-- Note: The code in the value attribute is based on the YouTube link above -->
                            <!-- Reference: https://www.youtube.com/watch?v=Eq7bGWQsOdI -->

                            <!-- ===== Minimum Salary Input field ===== -->
                            <div class="min-salary">
                                <label for="min-salary">Minimum Salary: </label>
                                <input class="salary" type="number" id="min-salary" name="min-salary" min="0" max="350000" step="10000" value="<?php if(isset($_GET['min-salary'])) {echo $_GET['min-salary'];}?>">              <!-- Range is from 0 to 350K with an increment of 10K -->
                            </div>

                            <!-- ===== Maximum Salary input element ===== -->
                            <div class="max-salary">
                                <label for="max-salary">Maximum Salary: </label>
                                <input class="salary" type="number" id="max-salary" name="max-salary" min="0" max="350000" step="10000" value="<?php if(isset($_GET['max-salary'])) {echo $_GET['max-salary'];}?>">
                            </div>

                            <!-- ============================ CATEGORY FILTER SECTION ============================ -->

                            <!-- Category Selection using Dropdown Menu -->
                            <div class="category">
                                <label for="category">Category: </label>
                                <select name="category" id="category">
                                    <option value="" <?php if(isset($_GET['category']) && $_GET['category'] === ""){echo 'selected';}?> >Select Option</option>             <!-- Blank values allows for users to undo the filter if the user no longer needs it -->
                                    <option value="Programming"     <?php if(isset($_GET['category']) && $_GET['category'] === "Programming"){echo 'selected';}?>>Programming</option>
                                    <option value="Design"          <?php if(isset($_GET['category']) && $_GET['category'] === "Design")     {echo 'selected';}?>>Design</option>
                                    <option value="Development"     <?php if(isset($_GET['category']) && $_GET['category'] === "Development"){echo 'selected';}?> >Development</option>
                            </select>
                            </div>

                            <!-- ============================ CATEGORY FILTER SECTION ============================ -->

                            <!-- Work Type Selection using Dropdown Menu -->
                            <div class="job_type">
                                <label for="job_type">Work Type: </label>
                                <select name="job_type" id="job_type">
                                    <option value="" <?php if(isset($_GET['job_type']) && $_GET['job_type'] === ""){echo 'selected';}?> >Select Option</option>
                                    <option value="Full-Time" <?php if(isset($_GET['job_type']) && $_GET['job_type'] === "Full-Time"){echo 'selected';} ?>>Full-Time</option>
                                    <option value="Graduate"  <?php if(isset($_GET['job_type']) && $_GET['job_type'] === "Graduate"){echo 'selected';}?>>Graduate</option>
                                    <option value="Internship"<?php if(isset($_GET['job_type']) && $_GET['job_type'] === "Internship"){echo 'selected';}?>>Internship</option>
                                    <option value="Contract"  <?php if(isset($_GET['job_type']) && $_GET['job_type'] === "Contract"){echo 'selected';}?>>Contract</option>
                                </select>
                            </div>

                            <!-- ============================ LOCATION FILTER SECTION ============================ -->

                            <!-- Location Selection using Dropdown menu -->
                            <div class="location">
                                <label for="location">Location: </label>
                                <select name="location" id="location">                  <!-- Submits value under the id "location" -->
                                    <option value="" <?php if(isset($_GET['location']) && $_GET['location'] === ""){echo 'selected';}?>>Select Option</option>
                                    <option value="Melbourne"<?php if(isset($_GET['location']) && $_GET['location'] === "Melbourne"){echo 'selected';}?>>Melbourne</option>
                                </select>
                            </div>

                            <!-- ============================ REMOTE OPTION SECTION ============================ -->

                            <div class="remote">
                                <label for="remote">Remote Options: </label>
                                <select name="remote" id="remote">
                                    <option value="" <?php if(isset($_GET['remote']) && $_GET['remote'] === ""){echo 'selected';}?>>Select Option</option>                       <!-- Submits value under the id "remote" -->
                                    <option value="On-site" <?php if(isset($_GET['remote']) && $_GET['remote'] === "On-site"){echo 'selected';}?> >On-site</option>             <!-- Select option value allows for blank values to be submitted -->
                                    <option value="Hybrid" <?php if(isset($_GET['remote']) && $_GET['remote'] === "Hybrid"){echo 'selected';}?> >Hybrid</option>
                                    <option value="Remote" <?php if(isset($_GET['remote']) && $_GET['remote'] === "Remote"){echo 'selected';}?> >Remote</option>
                                </select>
                            </div>

                            <!-- ============================ JOB LISTING SECTION ============================ -->

                            <div class="listed">
                                <label for="listed">Listed: </label>
                                <select name="listed" id="listed">                       <!-- Submits value under the id "remote" -->
                                    <option value="" <?php if(isset($_GET['listed']) && $_GET['listed'] === ""){echo 'selected';}?> >Any time</option>                   <!-- Select option value allows for blank values to be submitted -->
                                    <option value="today" <?php if(isset($_GET['listed']) && $_GET['listed'] === "today"){echo 'selected';} ?>>Today</option>
                                    <option value="3days" <?php if(isset($_GET['listed']) && $_GET['listed'] === "3days"){echo 'selected';} ?>>Last 3 days</option>
                                    <option value="7days" <?php if(isset($_GET['listed']) && $_GET['listed'] === "7days"){echo 'selected';} ?>>Last 7 days</option>
                                    <option value="14days"<?php if(isset($_GET['listed']) && $_GET['listed'] === "14days"){echo 'selected';} ?>>Last 14 days</option>
                                    <option value="30days"<?php if(isset($_GET['listed']) && $_GET['listed'] === "30days"){echo 'selected';} ?>>Last 30 days</option>
                                </select>
                            </div>

                            <!-- ============================ FILTER SUBMIT SECTION ============================ -->

                            <input class="filter-btn" name="filter" type="submit" value="Filter" aria-label="Submit Filter" >
                        
                        </fieldset>

                        <fieldset>
                            <!-- ================================ SORT BY SECTION ============================ -->
                            <!-- Users can sort the job listings by either relevance or date  -->
                            <legend>Sort by</legend>
                            <input type="radio" name="sort" id="date" value="date"<?php if(isset($_GET['sort']) && $_GET['sort'] === "date"){echo 'checked';}?>>
                            <label for="date">Date</label>
                            <br>
                            <input type="radio" name="sort" id="relevance" value="relevance" <?php if(isset($_GET['sort']) && $_GET['sort'] === "relevance"){echo 'checked';} if (!isset($_GET['sort'])){echo 'checked';}?>>
                            <!-- Relevance option is set as default at the beginning of each page -->
                            <label for="relevance">Relevance</label>
                            <br>
                            <input class="sort-btn" type="submit" value="Sort" aria-label="Submit Sort">
                        </fieldset>
                    </div>
                </form>  

                <!-- ============================ JOB SUMMARY RESULTS SECTION ============================ -->

                <?php
                    // ============================ DATABASE CONNECTION ============================ //

                    // Connect to SQL database
                    require_once "settings.php";
                    $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
                    if ($conn) {

                        // Check if all values after submit are null
                        $gettitle = isset($_GET['title']);                 // Job Title
                        $getMinSalary = isset($_GET['min-salary']);        // Minimum Salary
                        $getMaxSalary = isset($_GET['max-salary']);        // Maximum Salary
                        $getCategory = isset($_GET['category']);           // Category = e.g. Development, Programming etc.
                        $getType = isset($_GET['job_type']);               // Employment Type = e.g. Full-Time
                        $getLocation = isset($_GET['location']);           // Location
                        $getRemote = isset($_GET['remote']);               // Remote options = e.g. Remote, Hybrid etc.
                        $getListed = isset($_GET['listed']);               // Date job was posted on
                        $getSort = isset($_GET['sort']);                   // Sort value = e.g. by date or relevance

                        if ($gettitle || $getMinSalary || $getMaxSalary || $getCategory || $getType || $getLocation || $getRemote || $getListed || $getSort) {


                            // Set default timezone to get the correct date
	                        date_default_timezone_set('Australia/Melbourne');                   // NOTE: Found the function from the following website
                                                                                                // Link: https://stackoverflow.com/questions/26269364/how-to-setup-timezone-xampp-mysql-and-apache
                                                                                                // It is the second answer from the user "Putra L Zendatro"


                            // Search bar results
	                        $title = mysqli_real_escape_string($conn, trim($_GET['title']));    // trim: Remove any whitespaces from the value
                                                                                                // mysqli_real_escape_string() = escape any special charcters

                            // Obtain Search, Filter and Sort results
                            $minSalary =  $_GET['min-salary'];
                            $maxSalary =  $_GET['max-salary'];
                            $category = $_GET['category'];
                            $type = $_GET['job_type'];
                            $location = $_GET['location'];
                            $remote = $_GET['remote'];
                            $listed = $_GET['listed'];
                            $sort = $_GET['sort'];
                            $today = date("Y-m-d");
                                                                                                // gets the current date
                                                                                                // NOTE: Found the function from the following website
                                                                                                // Link: https://www.w3schools.com/php/func_date_date.asp
                            
                            // Determine if the value of Minimum and Maximum Salary are blank
                            if ($minSalary === '') {
                                $minSalary = 0;
                            }
                            if ($maxSalary === '') {
                                $maxSalary = 350000;
                            }

                            // Calculate job listing date for values "today", "3days", "7days", "14days", "30days" 
                            switch ($listed) {
                                case "today":
                                    $listed = date("Y-m-d");
                                    break;
                                case "3days":
                                    $getDay = date("d");
                                    $lastThree = $getDay - 3;
                                    // Go back one month to find the job listing date if it is less than the variable
                                    if ($lastThree < 0) {
                                        $lastThree += 30;
                                        $Month = date("m") - 1;
                                        // if the previous month is january, go back to December last year
                                        if ($Month == 0) {
                                            $Month = 12;
                                            $getYear = date("Y");
                                            $Year = $getYear - 1;
                                            $date = $Year. "-". $Month . "-". $lastThree;
                                            $listed = "$date";
                                        } else {
                                            $concatDate = date("Y"). "-". $Month . "-". $lastThree;
                                            $date = date("Y-m-d", strtotime($concatDate));
                                            $listed = "$date";
                                        }
                                    }  else {
                                        $date = date("Y-m")."-".$lastThree;
                                        $listed = "$date";
                                    }
                                    break;
                                case "7days":
                                    $getDay = date("d");
                                    $lastSeven = $getDay - 7;
                                    // Go back one month to find the job listing date if it is less than the variable
                                    if ($lastSeven < 0) {
                                        $lastSeven += 30;
                                        $Month = date("m") - 1;
                                        if ($Month == 0) {
                                            $Month = 12;
                                            $getYear = date("Y");
                                            $Year = $getYear - 1;
                                            $date = $Year. "-". $Month . "-". $lastSeven;
                                            $listed = "$date";
                                        } else {
                                            $concatDate = date("Y"). "-". $Month . "-". $lastSeven;
                                            $date = date("Y-m-d", strtotime($concatDate));
                                            $listed = "$date";
                                        }
                                    }  else {
                                        $date = date("Y-m")."-".$lastSeven;
                                        $listed = "$date";
                                    }
                                    break;
                                case "14days":
                                    $getDay = date("d");
                                    $lastFourteen = $getDay - 14;
                                    // Go back one month to find the job listing date if it is less than the variable
                                    if ($lastFourteen < 0) {
                                        $lastFourteen += 30;
                                        $Month = date("m") - 1;
                                        // if the previous month is january, go back to December last year
                                        if ($Month == 0) {
                                            $Month = 12;
                                            $getYear = date("Y");
                                            $Year = $getYear - 1;
                                            $date = $Year. "-". $Month . "-". $lastFourteen;
                                            $listed = "$date";
                                        } else {
                                            $concatDate = date("Y"). "-". $Month . "-". $lastFourteen;
                                            $date = date("Y-m-d", strtotime($concatDate));
                                            $listed = "$date";
                                        }
                                    } else {
                                        $date = date("Y-m")."-".$lastFourteen;
                                        $listed = "$date";
                                    }
                                    break;
                                case "30days":
                                    $getDay = date("d");
                                    $lastThirty = $getDay - 30;
                                    // Go back one month to find the job listing date if it is less than the variable
                                    if ($lastThirty < 0) {
                                        $lastThirty += 30;
                                        $Month = date("m") - 1;
                                        // if the previous month is january, go back to December last year
                                        if ($Month == 0) {
                                            $Month = 12;
                                            $getYear = date("Y");
                                            $Year = $getYear - 1;
                                            $date = $Year. "-". $Month . "-". $lastThirty;
                                            $listed = "$date";
                                        } else {
                                            $concatDate = date("Y"). "-". $Month . "-". $lastThirty;
                                            $date = date("Y-m-d", strtotime($concatDate));
                                            $listed = "$date";
                                        }
                                    }
                                    break;
                                default:
                                    $listed = "";
                            }

                            // Determine if the results need to sort by date or relevance
                            if ($sort === "date") {
                                // prepare query with placeholders for prepared statements
                                 $query = "SELECT * FROM jobs WHERE title LIKE '%$title%' AND salary BETWEEN $minSalary AND $maxSalary AND category LIKE '%$category%' AND job_type LIKE '%$type%' AND `location` LIKE '%$location%'  AND `remote` LIKE '%$remote%' AND opening_date >= '$listed' AND closing_date >= '$today' ORDER BY opening_date DESC";
                            } else {
                                 $query = "SELECT * FROM jobs WHERE title LIKE '%$title%' AND salary BETWEEN $minSalary AND $maxSalary AND category LIKE '%$category%' AND job_type LIKE '%$type%' AND `location` LIKE '%$location%'  AND `remote` LIKE '%$remote%' AND opening_date >= '$listed' AND closing_date >= '$today'";
                            }

                            // Execute SQL query
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) > 0) {
                                // Found matched results
                                echo"
                                <div class='results'>   
                                    <div class='search-result'>
                                        <p>Search results: ".mysqli_num_rows($result). " job(s).</p>
                                    </div>
                                    <div class='job-container'>";
                                        include "job-sum.php";                  // Attaches the job-sum.php to create a list of job summary to be displayed on the webpage 
                                                                                // Refer to job-sum.php to see the code.
                                echo "</div>
                                </div>";                          
                            } else {
                                // No matched results
                                echo 
                                "
                                <div class='search-result'>
                                    <p>Search results: ".mysqli_num_rows($result). " job(s).</p>
                                    <p>No matching jobs found.</p>
                                </div>
                                ";
                            }
                        } else {
                            // Displays job summary with no filters have been applied; used mostly when the page is opened initially
                            $today = date("Y-m-d");
                            $query = "SELECT * FROM jobs WHERE closing_date > '$today'"; 
                            $result = mysqli_query($conn, $query);
                            if ($result) {
                                echo"
                                <div class='results'>
                                    <div class='search-result'>
                                        <p>Search results: ".mysqli_num_rows($result). " job(s).</p>
                                    </div>
                                    <div class='job-container'>";
                                        include "job-sum.php";                                      // Attaches the job-sum.php to create a list of job summary to be displayed on the webpage 
                                                                                                    // Refer to job-sum.php to see the code.
                                echo "</div>
                                </div>"; 
                            } else {
                                // If database is empty
                                echo 
                                "
                                <div class='search-result'>
                                    <p>Search results: ".mysqli_num_rows($result). " job(s).</p>
                                    <p>No jobs available.</p>
                                </div>
                                ";
                            }
                        }
                        // Close Database Connection
                        mysqli_close($conn);
                    } else {
                        // Error in Database connection
                        echo "<p> Unable to connect to database.</p>";
                    }
                ?>
            </div>
                
        </main>
        <!-- ============================ FOOTER SECTION ============================ -->

        <?php include 'footer.inc'; ?>   <!-- Attach footer.inc to the bottom of the page for layout consistancy -->   
    </body>
</html>