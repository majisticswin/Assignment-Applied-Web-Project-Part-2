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
        <link rel="stylesheet" href="styles/jobs_styles.css">

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
        <main>
            
            <h1>Careers</h1>

            <div>
                <aside class="join-us">
                    <h2> Why Join us!</h2>
                    <ol>
                        <li>We offer flexible working options, including remote work opportunities!</li>
                        <li>We offer a competitive salary that includes additional bonuses as you gain experience!</li>
                        <li>We offer Extended parental leave for newly families!</li>
                        <li>Access to discounted mental health assistance!</li>
                        <li>We are like a family! Be a part of a supportive and inclusive culture!</li>
                    </ol>
                </aside>
            </div>

            <!-- ============================ SEARCH BAR SECTION ======================== -->
            <!-- A form is used to create the Search bar of the job description page  -->

            <form action="jobs.php" method="GET">  <!-- The action will change the layout of the job.php to only contain matching title name -->
                <fieldset>
                    <legend>Job Search</legend>
                    <label for="title">Search: </label>
                    <input type="search" name="title" id="title" placeholder="Enter Job title here">
                    <input type="submit" value="Search">
                </fieldset>
            </form>

            <!-- ============================ FILTER SECTION ============================ -->

            <!-- A form used to create the Filter section of the job description page  -->
            <form action="jobs.php" method="GET">   <!-- The action will change the layout of the job.php to only contain matching filter options -->
                <fieldset>
                    <legend>Filter</legend>

                    <!-- ============================ SALARY RANGE FILTER SECTION ============================ -->

                    <!-- Implement Salary range using two input elements: Min. Salary and Max. Salary -->
                    <!-- Minimum Salary Input element -->
                    <label for="min-salary">Min. Salary: </label>
                    <input type="text" id="min-salary" name="min-salary" value="0" pattern="[0-9]*" required >        <!-- pattern is needed to only accept numerical values -->
                    <br>

                    <!-- Maximum Salary input element -->
                    <label for="max-salary">Max. Salary: </label>
                    <input type="text" id="max-salary" name="max-salary" value="350000" pattern="[0-9]*" required>   <!-- value attribute is needed as both minimum and maximum salary value is added into the SQL query --> 
                    <br>

                    <!-- ============================ CATEGORY FILTER SECTION ============================ -->

                    <!-- Category Selection using Dropdown Menu -->
                    <label for="category">Category: </label>
                    <select name="category" id="category">                  <!-- Submits value under the id "category" -->
                        <option value="">Select option</option>             <!-- Select option value allows for blank values to be submitted -->
                        <option value="Programming">Programming</option>
                        <option value="Design">Design</option>
                        <option value="Development">Development</option>
                    </select>
                    <br>

                    <!-- ============================ CATEGORY FILTER SECTION ============================ -->

                    <!-- Work Type Selection using Dropdown Menu -->
                    <label for="job_type">Work Type: </label>
                    <select name="job_type" id="job_type">                  <!-- Submits value under the id "job_type" -->
                        <option value="">Select option</option>
                        <option value="Full-Time">Full-Time</option>
                        <option value="Graduate">Graduate</option>
                        <option value="Internship">Internship</option>
                        <option value="Contract">Contract</option>
                    </select>
                    <br>

                    <!-- ============================ LOCATION FILTER SECTION ============================ -->

                    <!-- Location Selection using Dropdown menu -->
                    <label for="location">Location</label>
                    <select name="location" id="location">                  <!-- Submits value under the id "location" -->
                        <option value="">Select option</option>
                        <option value="Melbourne">Melbourne</option>
                        <option value="Remote">Remote</option>
                    </select>
                    <br>
                    
                    <!-- ============================ REMOTE OPTION SECTION ============================ -->
                    <label for="remote">Remote Option </label>
                    <select name="remote" id="remote">                       <!-- Submits value under the id "remote" -->
                        <option value="On-site">On-site</option>             <!-- Select option value allows for blank values to be submitted -->
                        <option value="Design">Hybrid</option>
                        <option value="Development">Remote</option>
                    </select>
                    <br>

                    <!-- ============================ FILTER SUBMIT SECTION ============================ -->

                    <input type="submit" value="Filter">

                </fieldset>
            </form>
            
            <!-- ================================ SORT BY DATE SECTION ============================ -->

            <form action="jobs.php" method="GET">
                <fieldset>
                    <legend>Sort by</legend>
                    <input type="radio" name="sort" id="sort" value="date" >
                    <label for="sort">Date</label>
                    <input type="radio" name="sort" id="sort" value="relevance" checked>
                    <label for="sort">Revelance</label>
                    <br>
                    <input type="submit" value="Sort">
                </fieldset>
            </form>

            <p></p>

            <!-- ============================ JOB DESCRIPTION RESULTS SECTION ============================ -->

            <br>
            <?php

                // ============================ DATABASE CONNECTION ============================ //

                require_once "settings.php";
                $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
                if ($conn) {

                // ============================ RETRIEVE DATA USING THE FILTER SECTION ============================ //
                
                    if (isset($_GET['category']) || isset($_GET['location']) || isset($_GET['job_type']) || isset($_GET['min-salary']) || isset($_GET['max-salary'])) {
                        $valMinSalary = mysqli_real_escape_string($conn, $_GET['min-salary']);
                        $valMaxSalary = mysqli_real_escape_string($conn, $_GET['max-salary']);
                        $valCategory = mysqli_real_escape_string($conn, $_GET['category']);
                        $valType = mysqli_real_escape_string($conn, $_GET['job_type']);
                        $valLocation = mysqli_real_escape_string($conn, $_GET['location']);

                        $minSalary = $valMinSalary;
                        $maxSalary = $valMaxSalary;
                        $category = "%$valCategory%";
                        $type = "%$valType%";
                        $location = "%$valLocation%";

                        $stmt = $conn->prepare("SELECT * FROM jobs WHERE category LIKE ? AND job_type LIKE ? AND `location` LIKE ? AND salary BETWEEN ? AND ?");
                        $stmt->bind_param("sssii", $category, $type, $location, $minSalary, $maxSalary);
                        $stmt->execute();

                        $result = $stmt->get_result();
                        if (mysqli_num_rows($result) > 0) {
                            echo"
                            <p class='search'>Search results: ".mysqli_num_rows($result). " job(s).</p>
                            <br>";                            
                            include 'job-desc.php';
                        } else {
                        echo 
                        "
                        <p class='search'>Search results: ".mysqli_num_rows($result). " job(s).</p>
                        <br>
                        <p>No matching jobs found.</p>";
                        }
                    }
                    
                // ============================ RETRIEVE DATA USING THE SEARCH BAR SECTION ============================ //
                    elseif (isset($_GET['title'])) {
                        $valTitle = mysqli_real_escape_string($conn, trim($_GET['title']));
                        $title = "%$valTitle%";
                        
                        $stmt = $conn->prepare("SELECT * FROM jobs WHERE title LIKE ? ");
                        $stmt->bind_param("s", $title);
                        $stmt->execute();
                        
                        $result = $stmt->get_result();
                        if (mysqli_num_rows($result) > 0) {
                            echo"
                            <p class='search'>Search results: ".mysqli_num_rows($result). " job(s).</p>
                            <br>";
                            include 'job-desc.php';
                        } else {
                        echo 
                        "
                        <p class='search'>Search results: ".mysqli_num_rows($result). " job(s).</p>
                        <br>
                        <p>No matching jobs found.</p>";
                        }
                    } 
                    
                // ============================ SORTING BY DATE SECTION ============================ //
                    elseif (isset($_GET['sort'])) {
                        $sort = mysqli_real_escape_string($conn, $_GET['sort']);
                        if ($sort == "date") {
                            $query = "SELECT * FROM jobs ORDER BY opening_date DESC";
                            $result = mysqli_query($conn, $query);
                            if ($result) {
                                echo"
                                <p class='search'>Search results: ".mysqli_num_rows($result). " job(s).</p>
                                <br>";
                                include 'job-desc.php';
                            } else {
                            echo 
                            "
                            <p class='search'>Search results: ".mysqli_num_rows($result). " job(s).</p>
                            <br>
                            <p>No matching jobs found.</p>";
                            }
                        } else {
                            $query = "SELECT * FROM jobs";
                            $result = mysqli_query($conn, $query);
                            if ($result) {
                                echo"
                                <p class='search'>Search results: ".mysqli_num_rows($result). " job(s).</p>
                                <br>";
                                include 'job-desc.php';
                            } else {
                            echo 
                            "
                            <p class='search'>Search results: ".mysqli_num_rows($result). " job(s).</p>
                            <br>
                            <p>No matching jobs found.</p>";
                            }
                        }

                    }
                // ============================ DISPLAY ALL DATA FROM SQL ============================ //
                    else {
                        $query = "SELECT * FROM jobs";
                        $result = mysqli_query($conn, $query);
                        if ($result) {
                            echo"
                            <p class='search'>Search results: ".mysqli_num_rows($result). " job(s).</p>
                            <br>";
                            include "job-desc.php";
                        } else {
                            echo 
                            "
                            <p class='search'>Search results: ".mysqli_num_rows($result). " job(s).</p>
                            <br>
                            <p>No jobs available.</p>";
                        }
                    }
                    mysqli_close($conn);
                } else {
                    echo "<p> Unable to connect to database.</p>";
                }

            ?>
            
        </main>
        <!-- ============================ FOOTER SECTION ============================ -->

        <?php include 'footer.inc'; ?>        
    </body>
</html>