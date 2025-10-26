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

        <?php include 'header.inc'?> 

        <!-- ============================ MAIN SECTION ============================== -->
        <main class=site-main>
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
            <div class="container">
                <?php
                    require_once "settings.php";
                    $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
                    if ($conn) {
                        if (isset($_GET['jobref'])) {
                            $job_ref = mysqli_real_escape_string($conn, $_GET['jobref']);

                            $stmt = $conn->prepare("SELECT * FROM jobs WHERE job_ref = ? ");
                            $stmt->bind_param("s", $job_ref);
                            $stmt->execute();

                            $result = $stmt->get_result();
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $OpenDate = htmlspecialchars($row['opening_date']);
                                    $Opentimestamp = strtotime($OpenDate);
                                    $OpenDate = date("d M Y", $Opentimestamp);

                                    $CloseDate = htmlspecialchars($row['closing_date']);
                                    $Closetimestamp = strtotime($CloseDate);
                                    $CloseDate = date("d M Y", $Closetimestamp);        

                                    $var = htmlspecialchars($row['job_ref']);
                                    $encodeRow = urlencode($var);

                                    echo 
                                    "
                                     <div class='return-btn'>
                                        <div class='return-btn'>
                                            <a aria-label='Return to Jobs page' href='jobs.php'>Back to Jobs page</a>
                                        </div>
                                    </div>
                                    <div class='container'>
                                        <div class='job-position'>
                                            <h2>". $row['title'] ."</h2>
                                                <section class='job-details' aria-labelledby='job-detail'>
                                                    <h3 id='job-detail'>Job Details</h3>

                                                    <p><strong>Posted on ". $OpenDate ."</strong></p>

                                                    <p><strong>Reference Number: </strong>". htmlspecialchars($row['job_ref'])."</p>

                                                    <p><strong>Location: </strong>". htmlspecialchars($row['location'])." (". htmlspecialchars($row['remote']) .")</p>

                                                    <p><strong>Work type: </strong>". htmlspecialchars($row['job_type'])."</p>

                                                    <p><strong>Salary: </strong>$".htmlspecialchars($row['salary'])."</p>

                                                    <p><strong>Reporting Line: </strong>".htmlspecialchars($row['reporting_line'])."</p>
                                                </section>

                                                <section class='job-desc' aria-labelledby='job-desc'>
                                                    <h3 id='job-desc'>Short description</h3>
                                                    <p>".htmlspecialchars($row['description'])."</p>
                                                </section>

                                                <section class='key-resp' aria-labelledby='key-resp'>
                                                    <h3 id='key-resp'>Key Responsibilities</h3>
                                                    
                                                    <ol>";

                                                    $resp_str = $row['responsibilities'];
                                                    $key_resp = explode("|", $resp_str);
                                                    
                                                    for ($x = 0; $x < count($key_resp); $x++ ) {
                                                        echo "<li><p>".htmlspecialchars($key_resp[$x])."</p></li>";
                                                    }
                                                    echo "</ol>
                                                </section>

                                                <section class='job-req' aria-labelledby='job-req'>
                                                    <h3 id='job-req'>Requirements</h3>
                                                    <section class='essen-req' aria-labelledby='ess-req'>
                                                        <h4 id='ess-req'> Essential Requirements </h4>
                                                        <ul>";
                                                        
                                                        $ess_str = $row['essential_req'];
                                                        $ess_req = explode("|", $ess_str);
                                                        for ($x = 0; $x < count($ess_req); $x++ ) {
                                                            echo "<li><p>".htmlspecialchars($ess_req[$x])."</p></li>";
                                                        }

                                                        echo "</ul>
                                                    </section>
                                                    <section class='pref-req' aria-labelledby='prefer-req'>
                                                        <h4 id='prefer-req'>Preferrable Requirements</h4>
                                                        <ul>";

                                                        $pref_str = $row['preferrable_req'];
                                                        $pref_req = explode("|", $pref_str);
                                                        for ($x = 0; $x < count($pref_req); $x++ ) {
                                                            echo "<li><p>".htmlspecialchars($pref_req[$x])."</p></li>";
                                                        }
                                                        echo "</ul>
                                                    </section>    
                                                </section>

                                                <div class='close-date'>
                                                    <p><strong>Closing on ". $CloseDate ."</strong></p>
                                                </div>

                                                <div class='apply-btn'>
                                                    <a aria-label='Apply for the job' href='apply.php?jobref=$encodeRow'>Apply Now!</a>
                                                </div>
                                        </div>
                                    </div>
                                    ";
                                }

                            } else {
                                echo 
                                "<p>Whoops! Looks like the job is unavailable! </p>";
                            }
                        }
                        mysqli_close($conn);
                    } else {
                        echo "<p>Unable to connect to database.</p>";
                    }
                ?>
            </div>
        </main>

        <!-- ============================ FOOTER SECTION ============================ -->

        <?php include 'footer.inc'; ?>

    </body>
</html>