<?php
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
                    
                    for ($x = 0; $x < count($ess_req); $x++ ) {
                        echo "<li><p>".$ess_req[$x]."</p></li>";
                    }

                echo "</ul>

                <h4>Preferrable Requirements</h4>
                <ul>";

                    $pref_str = $row['preferrable_req'];
                    $pref_req = explode("|", $pref_str);

                    for ($x = 0; $x < count($pref_req); $x++ ) {
                        echo "<li><p>".$pref_req[$x]."</p></li>";
                    }

                echo "</ul>
            </section>

            <p><strong>Closing Date: ". $row['closing_date']."</strong></p>
            <form action='apply.html' class='apply-btn'>
                <button> Apply Now </button>
            </form>

        </div>
        <hr>";
    }
?>