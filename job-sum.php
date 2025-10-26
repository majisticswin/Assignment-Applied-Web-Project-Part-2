<?php
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
        <div class='job-summary' aria-label='Job Summary'>
                <h2>". $row['title'] ."</h2>
                <section class='job-details' aria-labelledby='job-details'>
                    <h3 id='job-details'>Job Details</h3>

                    <p><strong>Posted on ". $OpenDate ."</strong></p>

                    <p><strong>Location: </strong>". htmlspecialchars($row['location'])." (". htmlspecialchars($row['remote']) .") </p>

                    <p><strong>Work type: </strong>". htmlspecialchars($row['job_type'])."</p>

                    <p><strong>Salary: </strong>$".htmlspecialchars($row['salary'])."</p>

                </section>

                <section class='job-desc' aria-labelledby='job-desc'>
                    <h3 id='job-desc'>Short description</h3>

                    <p>".htmlspecialchars($row['description'])."</p>
                </section>
                
                <div class='close-date'>
                    <p><strong>Closing on ". $CloseDate ."</strong></p>
                </div>

                <div class='info-btn'>
                    <a aria-label='Find out more about the job' href='job-desc.php?jobref=$encodeRow'>Find out more!</a>
                </div>
        </div>
        ";
    }
?>