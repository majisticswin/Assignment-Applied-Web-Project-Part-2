<?php
    // ========================================================
    // Filename: job-sum.php
    // Purpose: Format for the job summary displayed in jobs.php. 
    // Author: Disha Anchan (103031430)
    // Date: 25th October 2025
    // ========================================================

    while ($row = mysqli_fetch_assoc($result)) {
        // Formatting the opening date for readability
        $OpenDate = htmlspecialchars($row['opening_date']);         // Convert special characters into HTML Entities

        $Opentimestamp = strtotime($OpenDate);                      // Convert the opening date to a timestamp
                                                                    // NOTE: Found and used the function from the following website
                                                                    // Link: https://www.w3schools.com/php/func_date_strtotime.asp

        $OpenDate = date("d M Y", $Opentimestamp);                  // Format date using the created timestamp to increase readability                                                                                              // gets the current date to
                                                                    // NOTE: Found and used the function from the following website
                                                                    // Link: https://www.w3schools.com/php/func_date_date.asp

        // Formatting the closing date for readability
        $CloseDate = htmlspecialchars($row['closing_date']);
        $Closetimestamp = strtotime($CloseDate);
        $CloseDate = date("d M Y", $Closetimestamp);        

        // Encode job reference number into URL
        $var = htmlspecialchars($row['job_ref']);
        $encodeRow = urlencode($var);                               // Encode the string to be a part of a query in a URL
                                                                    // NOTE: Found and used the function from the following webpsite
                                                                    // Link: https://www.php.net/manual/en/function.urlencode.php
        
        // =============== Job Summary Format ================== 
        echo                                                        // Render the Job Summary content dynamically
        "
        <div class='job-summary' aria-label='Job Summary'>";
                // Job Title
                echo "<h2>". $row['title'] ."</h2>";
                // Job Details Sections
                echo "<section class='job-details' aria-labelledby='job-details'>
                    <h3 id='job-details'>Job Details</h3>";
                    // Job Date Posted
                    echo "<p><strong>Posted on ". $OpenDate ."</strong></p>";
                    // Job Location
                    echo "<p><strong>Location: </strong>". htmlspecialchars($row['location'])." (". htmlspecialchars($row['remote']) .") </p>";
                    // Employment Type
                    echo"<p><strong>Employment type: </strong>". htmlspecialchars($row['job_type'])."</p>";
                    // Salary
                    echo "<p><strong>Salary: </strong>$".htmlspecialchars($row['salary'])."</p>

                </section>";

                // Job Description Section
                echo "<section class='job-desc' aria-labelledby='job-desc'>
                    <h3 id='job-desc'>Short description</h3>

                    <p>".htmlspecialchars($row['description'])."</p>
                </section>";

                // Job Application Closing Date
                echo "<div class='close-date'>
                    <p><strong>Closing on ". $CloseDate ."</strong></p>
                </div>";

                // Find out more button ---> Opens up job-desc.php to show a detailed verion of the job summary
                echo "<div class='info-btn'>
                    <a aria-label='Find out more about the job' href='job-desc.php?jobref=". $encodeRow ."'>Find out more!</a>";
                    // Embedded the encode string into the URL to open up the job related to the job reference number.
                    // When clicked, it will be open a job-desc.php passing the variable, which will open a detailed job description with the specified job reference number 
                    // Gotten help from Mitul Joarder with embedding the string into the URL and linking it to the job-desc.php
                echo "</div> 
        </div>
        ";
    }
?>