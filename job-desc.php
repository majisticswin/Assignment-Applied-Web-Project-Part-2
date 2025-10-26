<!-- //======================================================           -->
<!-- // Filename: jobs.php                                              -->
<!-- // Purpose: Displays a detailed job description page when pressed. -->
<!-- // Author: Disha Anchan (103031430)                                -->
<!-- // Date: 25th October 2025                                         -->
<!-- // ======================================================          -->

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
        <link rel="stylesheet" href="styles/jobs_desc_styles.css">

    </head>
    <body>

        <!-- ============================ HEADER SECTION ============================ -->

        <?php include 'header.inc'?>        <!-- Include the header.inc file for layout consistency -->

        <!-- ============================ MAIN SECTION ============================== -->
        <!-- Contains a detailed job description, a "return to jobs" page and "Apply Now button" -->
        
        
        <!-- ============================ HERO SECTION ============================== -->
        <!-- A Hero image with a list of the benefits on why work with PandaMice company in order to attract users and visual aethetic -->
        <main class=site-main>
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
            <div class="container">

                <!-- ============================ JOB DESCRIPTION PAGE SECTION ============================== -->

                <?php
                    // ============================ DATABASE CONNECTION ============================ //

                    // Connect to SQL database
                    require_once "settings.php";
                    $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
                    if ($conn) {
                        // Check if jobref is not null
                        if (isset($_GET['jobref'])) {
                            $job_ref = mysqli_real_escape_string($conn, $_GET['jobref']);       // escape any special charcters 

                            // Running SQL query using prepared statements

                            // Prepare query with placeholders for prepared statements
                            $stmt = $conn->prepare("SELECT * FROM jobs WHERE job_ref = ? ");

                             // Bind all the variables into the SQL Query
                            $stmt->bind_param("s", $job_ref);

                            // Execute the safe and secure SQL query to the database
                            $stmt->execute();

                            // Get SQL query results
                            $result = $stmt->get_result();
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $OpenDate = htmlspecialchars($row['opening_date']);         // Convert special characters into HTML Entities

                                    $Opentimestamp = strtotime($OpenDate);                      // Convert the opening date to a timestamp
                                                                                                // NOTE: Found and used the function from the following website
                                                                                                // Link: https://www.w3schools.com/php/func_date_strtotime.asp

                                    $OpenDate = date("d M Y", $Opentimestamp);                  // Format date using the created timestamp to increase readability
                                                                                                // NOTE: Found and used the function from the following website
                                                                                                // Link: https://www.w3schools.com/php/func_date_date.asp                                                                                                
                                    
                                    $CloseDate = htmlspecialchars($row['closing_date']);
                                    $Closetimestamp = strtotime($CloseDate);
                                    $CloseDate = date("d M Y", $Closetimestamp);        

                                    $var = htmlspecialchars($row['job_ref']);
                                    $encodeRow = urlencode($var);                               // Encode the string to be a part of a query in a URL                                                                                                   // NOTE: Found and used the function from the following webpsite
                                                                                                // NOTE: Found and used the function from the following webpsite
                                                                                                // Link: https://www.php.net/manual/en/function.urlencode.php

                                    echo                                                        // Render the Job Description content dynamically
                                    "
                                     <div class='return-btn'>
                                        <div class='return-btn'>
                                            <a aria-label='Return to Jobs page' href='jobs.php'>Back to Jobs page</a>";
                                            // Return to Jobs Page button - A link used to return to the jobs page (jobs.php)
                                        echo "</div>
                                    </div>
                                    <div class='container'>
                                        <div class='job-position'>";
                                            // Job Title
                                            echo"<h2>". $row['title'] ."</h2>";
                                                // Job Details Section
                                                echo"<section class='job-details' aria-labelledby='job-detail'>
                                                    <h3 id='job-detail'>Job Details</h3>";
                                                    // Date posted
                                                    echo"<p><strong>Posted on ". $OpenDate ."</strong></p>";
                                                    // Job Reference Number
                                                    echo "<p><strong>Reference Number: </strong>". htmlspecialchars($row['job_ref'])."</p>";
                                                    // Location
                                                     echo"<p><strong>Location: </strong>". htmlspecialchars($row['location'])." (". htmlspecialchars($row['remote']) .")</p>";
                                                    // Employment type
                                                     echo"<p><strong>Employment type: </strong>". htmlspecialchars($row['job_type'])."</p>";
                                                    // Salary
                                                     echo"<p><strong>Salary: </strong>$".htmlspecialchars($row['salary'])."</p>";
                                                    // Reporting Line
                                                    echo "<p><strong>Reporting Line: </strong>".htmlspecialchars($row['reporting_line'])."</p>
                                                </section>";
                                                // Job Description Section
                                                 echo"<section class='job-desc' aria-labelledby='job-desc'>
                                                    <h3 id='job-desc'>Short description</h3>
                                                    <p>".htmlspecialchars($row['description'])."</p>
                                                </section>";
                                                // Key Responsibilities Section
                                                 echo"<section class='key-resp' aria-labelledby='key-resp'>
                                                    <h3 id='key-resp'>Key Responsibilities</h3>
                                                    
                                                    <ol>";


                                                    $resp_str = $row['responsibilities'];
                                                    $key_resp = explode("|", $resp_str);                            // explode = Break the string into an array using a delimiter |
                                                    
                                                    for ($x = 0; $x < count($key_resp); $x++ ) {                    // Insert each string into <li> element
                                                        echo "<li><p>".htmlspecialchars($key_resp[$x])."</p></li>";
                                                    }
                                                    echo "</ol>
                                                </section>";
                                                // Job Requirements Section
                                                 echo "<section class='job-req' aria-labelledby='job-req'>
                                                    <h3 id='job-req'>Requirements</h3>";
                                                    // Essential Requirements Section
                                                    echo "<section class='essen-req' aria-labelledby='ess-req'>
                                                        <h4 id='ess-req'> Essential Requirements </h4>
                                                        <ul>";
                                                        
                                                        $ess_str = $row['essential_req'];
                                                        $ess_req = explode("|", $ess_str);                          // explode = Break the string into an array using a delimiter |

                                                        for ($x = 0; $x < count($ess_req); $x++ ) {                 // Insert each string into <li> element
                                                            echo "<li><p>".htmlspecialchars($ess_req[$x])."</p></li>";
                                                        }

                                                        echo "</ul>
                                                    </section>";
                                                    // Preferrable Requirements Section
                                                    echo "<section class='pref-req' aria-labelledby='prefer-req'>
                                                        <h4 id='prefer-req'>Preferrable Requirements</h4>
                                                        <ul>";

                                                        $pref_str = $row['preferrable_req'];                        // explode = Break the string into an array using a delimiter |
                                                        $pref_req = explode("|", $pref_str);
                                                        for ($x = 0; $x < count($pref_req); $x++ ) {                // Insert each string into <li> element
                                                            echo "<li><p>".htmlspecialchars($pref_req[$x])."</p></li>";
                                                        }
                                                        echo "</ul>
                                                    </section>    
                                                </section>";
                                                        
                                                // Job Application Closing Date
                                                echo "<div class='close-date'>
                                                    <p><strong>Closing on ". $CloseDate ."</strong></p>
                                                </div>";
                                                // Apply Now Button
                                                echo "<div class='apply-btn'>
                                                    <a aria-label='Apply for the job' href='apply.php?jobref=$encodeRow'>Apply Now!</a>"
                                                    // Embedded the encode string into the URL to open up the job related to the job reference number.
                                                    // When clicked, it will pass the variable into apply.php and fill in the job reference number into the respective field
                                                    // This idea was suggested by Mitul Joarder and he assisted with code.
                                                "</div>
                                        </div>
                                    </div>
                                    ";
                                }

                            } else {
                                // if Job doesn't exist
                                echo 
                                "<p>Whoops! Looks like the job is unavailable! </p>";
                            }
                        }
                        // Close Database Connection
                        mysqli_close($conn);
                    } else {
                        // Unable to connect to database
                        echo "<p>Unable to connect to database.</p>";
                    }
                ?>
            </div>
        </main>

        <!-- ============================ FOOTER SECTION ============================ -->

        <?php include 'footer.inc'; ?>                  <!-- Attach footer.inc to the bottom of the page for layout consistancy -->   

    </body>
</html>