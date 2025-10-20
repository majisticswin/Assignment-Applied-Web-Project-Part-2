<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Job Description page with PHP and SQL">
        <meta name="keywords" content="Job, Description, Roles, PHP, Search, SQL">
        <meta name="author" content="Disha Anchan">
        
        <title>Job Description</title>

        <link rel="stylesheet" href="styles\jobs_styles.css">

        <style>
            main hr {
            width: 100%;
            border: 0.5px solid #233142;
            margin: 2em 0em;
        }
        </style>

    </head>
    <body>

        <?php include 'header.inc'?>        <!-- Attach the Header Section using the header.inc file for layout consistency  -->

        <main>
            
            <h1>Careers</h1>

            <!-- <div> -->
                <!-- <aside class="join-us"> -->
                    <!-- <h2> Why Join us!</h2> -->
                    <!-- <ol> -->
                        <!-- <li>We offer flexible working options, including remote work opportunities!</li> -->
                        <!-- <li>We offer a competitive salary that includes additional bonuses as you gain experience!</li> -->
                        <!-- <li>We offer Extended parental leave for newly families!</li> -->
                        <!-- <li>Access to discounted mental health assistance!</li> -->
                        <!-- <li>We are like a family! Be a part of a supportive and inclusive culture!</li> -->
                    <!-- </ol> -->
                <!-- </aside> -->
            <!-- </div> -->

            <form action="jobs.php" method="GET">  <!-- The action will change the layout of the job.php to only contain matching title name -->
                <fieldset>
                    <legend>Job Search</legend>
                    <label for="search">Search: </label>
                    <input type="search" name="title" id="title" placeholder="E.g. Network Programmer etc."></input>
                    <input type="submit" value="Search">
                </fieldset>
            </form>

            <form action="jobs.php" method="get">
                <fieldset>
                    <legend>Filter</legend>

                    <label for="min-salary">Min. Salary: </label>
                    <input type="text" id="min-salary" name="min-salary" value="0" pattern="[0-9]*">        <!-- pattern is needed to only accept numerical values -->
                    <br>

                    <label for="max-salary">Max. Salary: </label>
                    <input type="text" id="max-salary" name="max-salary" value="350000" pattern="[0-9]*">   <!-- value attribute is needed as both minimum and maximum salary value is added into the SQL query --> 
                    <br>

                    <label for="category">Category: </label>
                    <select name="category" id="category">                   <!-- Submits value under the id "category" -->
                        <option value=" ">Select option</option>             <!-- Select option value allows for blank values to be submitted -->
                        <option value="Programming">Programming</option>
                        <option value="Design">Design</option>
                        <option value="Development">Development</option>
                    </select>
                    <br>

                    <label for="job_type">Work Type: </label>
                    <select name="job_type" id="job_type">                  <!-- Submits value under the id "job_type" -->
                        <option value=" ">Select option</option>
                        <option value="Full-Time">Full-Time</option>
                        <option value="Graduate">Graduate</option>
                        <option value="Internship">Internship</option>
                        <option value="Contract">Contract</option>
                    </select>
                    <br>

                    <label for="location">Location</label>
                    <select name="location" id="location">                  <!-- Submits value under the id "location" -->
                        <option value=" ">Select option</option>
                        <option value="Melbourne">Melbourne</option>
                        <option value="Remote">Remote</option>
                    </select>
                    <br>

                    <input type="submit" value="Filter">

                </fieldset>
            </form>

            <?php
                require_once "settings.php";
                $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
                if ($conn) {
                    if (isset($_GET['title'])) {
                        $title = mysqli_real_escape_string($conn, $_GET['title']);
                        $query = "SELECT * FROM jobs WHERE title LIKE '%$title%'";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            include 'job-desc.php';
                        } else {
                            echo "No matching jobs found.";
                        }
                    } else {
                        $query = "SELECT * FROM jobs";
                        $result = mysqli_query($conn, $query);
                        if ($result) {
                                include "job-desc.php";
                        } else {
                            echo "No jobs available";
                        }
                    }
                } else {
                    echo "<p> Unable to connect to database.</p>";
                }

            ?>
            
        </main>

        <?php include 'footer.inc'; ?>
    </body>
</html>