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

        <style>
            main hr {
            width: 100%;
            border: 0.5px solid #233142;
            margin: 2em 0em;
        }
        </style>

    </head>
    <body>

        <!-- ============================ HEADER SECTION ============================ -->

        <?php include 'header.inc'?> 

        <!-- ============================ MAIN SECTION ============================== -->
        <main class="site-main">
            <div class="hero">
                <div class="hero-content">
                    <img src="images/careers.jpg" alt="A group of developers working on computers">
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
                <form action="jobs.php" method="GET">  <!-- The action will change the layout of the job.php to only contain matching title name -->
                    <!-- ============================ SEARCH BAR SECTION ======================== -->
                    <div class="search">
                        <input class="search-bar" type="text" name="title" id="title" value="<?php if (isset($_GET['title'])){ echo htmlspecialchars($_GET['title']);}?>" placeholder="Enter Job title here" aria-label='Enter Job title here'>
                        <input class="search-btn" name="search"type="submit" value="Search" aria-label="Submit Search">
                    </div>

                    <!-- ============================ FILTER & SORT BY SECTION ============================ -->

                    <div class="filter-sort">
                        <!-- ================================ FILTER SECTION ============================ -->
                        <fieldset>
                            <legend>Filter</legend>

                            <!-- ============================ SALARY RANGE FILTER SECTION ============================ -->

                            <!-- Implement Salary range using two input elements: Min. Salary and Max. Salary -->
                            <!-- Minimum Salary Input element -->
                            <div class="min-salary">
                                <label for="min-salary">Minimum Salary: </label>
                                <input class="salary" type="number" id="min-salary" name="min-salary" min="0" max="350000" step="10000" value="0">
                            </div>

                            <!-- Maximum Salary input element -->
                            <div class="max-salary">
                                <label for="max-salary">Maximum Salary: </label>
                                <input class="salary" type="number" id="max-salary" name="max-salary" min="0" max="350000" step="10000" value="350000">   <!-- value attribute is needed as both minimum and maximum salary value is added into the SQL query --> 
                            </div>

                            <!-- ============================ CATEGORY FILTER SECTION ============================ -->

                            <!-- Category Selection using Dropdown Menu -->
                            <div class="category">
                                <label for="category">Category: </label>
                                <select name="category" id="category">                  <!-- Submits value under the id "category" -->
                                    <option value="" <?php if(isset($_GET['category']) && $_GET['category'] === ""){echo 'selected';}?> >Select Option</option>             <!-- Select option value allows for blank values to be submitted -->
                                    <option value="Programming"     <?php if(isset($_GET['category']) && $_GET['category'] === "Programming"){echo 'selected';}?>>Programming</option>
                                    <option value="Design"          <?php if(isset($_GET['category']) && $_GET['category'] === "Design")     {echo 'selected';}?>>Design</option>
                                    <option value="Development"     <?php if(isset($_GET['category']) && $_GET['category'] === "Development"){echo 'selected';}?> >Development</option>
                            </select>
                            </div>

                            <!-- ============================ CATEGORY FILTER SECTION ============================ -->

                            <!-- Work Type Selection using Dropdown Menu -->
                            <div class="job_type">
                                <label for="job_type">Work Type: </label>
                                <select name="job_type" id="job_type">                  <!-- Submits value under the id "job_type" -->
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
                            <legend>Sort by</legend>
                            <input type="radio" name="sort" id="date" value="date"<?php if(isset($_GET['sort']) && $_GET['sort'] === "date"){echo 'checked';}?>>
                            <label for="date">Date</label>
                            <br>
                            <input type="radio" name="sort" id="relevance" value="relevance" <?php if(isset($_GET['sort']) && $_GET['sort'] === "relevance"){echo 'checked';} if (!isset($_GET['sort'])){echo 'checked';}?>>
                            <label for="relevance">Relevance</label>
                            <br>
                            <input class="sort-btn" type="submit" value="Sort" aria-label="Submit Sort">
                        </fieldset>
                    </div>
                </form>  

                <!-- ============================ JOB DESCRIPTION RESULTS SECTION ============================ -->

                <?php
                    // ============================ DATABASE CONNECTION ============================ //

                    require_once "settings.php";
                    $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
                    if ($conn) {

                        $title = isset($_GET['title']);
                        $minSalary = isset($_GET['min-salary']);
                        $maxSalary = isset($_GET['max-salary']);
                        $category = isset($_GET['category']);
                        $type = isset($_GET['job_type']);
                        $location = isset($_GET['location']);
                        $remote = isset($_GET['remote']);
                        $listed = isset($_GET['listed']);
                        $sort = isset($_GET['sortby']);

                        if ($title || $minSalary || $maxSalary || $category || $type || $location || $remote || $listed || $sort) {
	                        // Search bar results
	                        $valTitle = mysqli_real_escape_string($conn, trim($_GET['title']));

                            // Filter Results
                            $valMinSalary = mysqli_real_escape_string($conn, $_GET['min-salary']);
                            $valMaxSalary =  mysqli_real_escape_string($conn, $_GET['max-salary']);
                            $valCategory = $_GET['category'];
                            $valType = $_GET['job_type'];
                            $valLocation = $_GET['location'];
                            $valRemote = $_GET['remote'];
                            $getListed = $_GET['listed'];
                            $getToday = date("Y-m-d");

                            if ($valMinSalary === '') {
                                $minSalary = 0;
                            } else {
                                $minSalary = $valMinSalary;
                            }
                            
                            if ($valMaxSalary === '') {
                                $maxSalary = 350000;
                            } else {
                                $maxSalary = $valMaxSalary;
                            }

                            // Sort results
                            $sort = mysqli_real_escape_string($conn, $_GET['sort']);

                            // Create Individual results
                            $title = "%$valTitle%";
                            $category = "%$valCategory%";
                            $type = "%$valType%";
                            $location = "%$valLocation%";
                            $remote = "%$valRemote%";
                            $today = "$getToday";

                            // Calculate job listing date for values "today", "3days", "7days", "14days", "30days" 
                            switch ($getListed) {
                                case "today":
                                    $listed = date("Y-m-d");
                                    break;
                                case "3days":
                                    $getDay = date("d");
                                    $lastThree = $getDay - 3;
                                    if ($lastThree < 0) {
                                        $lastThree += 30;
                                        $Month = date("m") - 1;
                                        if ($Month == 0) {
                                            $Month = 12;
                                            $date = date("Y"). "-". $Month . "-". $lastThree;
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
                                    if ($lastSeven < 0) {
                                        $lastSeven += 30;
                                        $Month = date("m") - 1;
                                        if ($Month == 0) {
                                            $Month = 12;
                                            $date = date("Y"). "-". $Month . "-". $lastSeven;
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
                                    if ($lastFourteen < 0) {
                                        $lastFourteen += 30;
                                        $Month = date("m") - 1;
                                        if ($Month == 0) {
                                            $Month = 12;
                                            $date = date("Y"). "-". $Month . "-". $lastFourteen;
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
                                    if ($lastThirty < 0) {
                                        $lastThirty += 30;
                                        $Month = date("m") - 1;
                                        if ($Month == 0) {
                                            $Month = 12;
                                            $date = date("Y"). "-". $Month . "-". $lastThirty;
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



                            if ($sort === "date") {
                                 $query = "SELECT * FROM jobs WHERE title LIKE ? AND salary BETWEEN ? AND ? AND category LIKE ? AND job_type LIKE ? AND `location` LIKE ?  AND `remote` LIKE ? AND opening_date >= ? AND closing_date >= ? ORDER BY opening_date DESC";
                            } else {
                                 $query = "SELECT * FROM jobs WHERE title LIKE ? AND salary BETWEEN ? AND ? AND category LIKE ? AND job_type LIKE ? AND `location` LIKE ?  AND `remote` LIKE ? AND opening_date >= ? AND closing_date >= ?";
                            }
 
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("siissssss", $title, $minSalary, $maxSalary, $category, $type, $location, $remote, $listed ,$today);
                            $stmt->execute();

                            $result = $stmt->get_result();
                            if (mysqli_num_rows($result) > 0) {
                                echo"
                                <div class='results'>
                                    <div class='search-result'>
                                        <p>Search results: ".mysqli_num_rows($result). " job(s).</p>
                                    </div>
                                    <div class='job-container'>";
                                        include "job-sum.php";
                                echo "</div>
                                </div>";                          
                            } else {
                                echo 
                                "
                                <div class='search-result'>
                                    <p>Search results: ".mysqli_num_rows($result). " job(s).</p>
                                    <p>No matching jobs found.</p>
                                </div>
                                ";
                            }
                        } else {
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
                                        include "job-sum.php";
                                echo "</div>
                                </div>"; 
                            } else {
                                echo 
                                "
                                <div class='search-result'>
                                    <p>Search results: ".mysqli_num_rows($result). " job(s).</p>
                                    <p>No jobs available.</p>
                                </div>
                                ";
                            }
                        }
                        mysqli_close($conn);
                    } else {
                        echo "<p> Unable to connect to database.</p>";
                    }
                ?>
            </div>
                
        </main>
        <!-- ============================ FOOTER SECTION ============================ -->

        <?php include 'footer.inc'; ?>        
    </body>
</html>