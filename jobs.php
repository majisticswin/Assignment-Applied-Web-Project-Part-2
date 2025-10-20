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

            <?php
                require_once "settings.php";
                $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
                if ($conn) {
                    $query = "SELECT * FROM jobs";
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "
                            <div class='job-position'>
                                <h2>". $row['title'] ."</h2>

                                <section class='job-details'>
                                    <h3>Job Details</h3>

                                    <p><strong>Date Posted: </strong>". $row['opening_date']."</p>

                                    <p><strong>Reference Number: </strong>". $row['job_ref']."</p>

                                    <p><strong>Location: </strong>". $row['location']."</p>

                                    <p><strong>Work type: </strong>". $row['job_type']."</p>

                                    <p><strong>Salary: </strong>$".$row['salary']."</p>

                                    <p><strong>Reporting Line: </strong>".$row['reporting_line']."</p>
                                </section>

                                <section class='job-desc'>
                                    <h3>Short description</h3>

                                    <p>".$row['description']."</p>
                                </section>

                                <section class='key-resp'>
                                    <h3>Key Responsibilities</h3>

                                    <ol>";

                                        $resp_str = $row['responsibilities'];
                                        $key_resp = explode("|", $resp_str);

                                        for ($x = 0; $x < count($key_resp); $x++ ) {
                                            echo "<li><p>".$key_resp[$x]."</p></li>";
                                        }

                                    echo "</ol>

                                </section>

                                <section class='job-req'>
                                    <h3>Requirements</h3>
                                    <h4> Essential Requirements </h4>
                                    
                                    <ul>";

                                        $ess_str = $row['essential_req'];
                                        $ess_req = explode("|", $ess_str);
                                        
                                        
                                    echo "</ul>
                                </section>
                            </div>
                            ";
                        }
                    } else {
                        echo "No jobs available";
                    }
                } else {
                    echo "<p> Unable to connect to database.</p>";
                }

            ?>
            
        </main>

        <?php include 'footer.inc'; ?>
    </body>
</html>