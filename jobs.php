<!DOCTYPE php>
<php lang="en">

<head>
    <meta charset="UTF-8">
    <!--specifies the character encoding of the document as UTF-8, which sipports a wide range of charactiers and languages-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!DOCTYPE php>
    <php lang="en">

    <head>
        <meta charset="UTF-8">
        <!--specifies the character encoding of the document as UTF-8, which supports a wide range of characters and languages-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--sets the viewport to the width of the device and sets the initial zoom level to 1.0-->
        <title>Jobs Description</title>
        <link href="styles/style.css" rel="stylesheet">
    </head>

    <body>
        <section class="main1">

            <!-- Header -->

            <?php include 'header.inc'; ?>

            <nav class="scrollbar">
                <?php
                function sanitize_input($conn, $data)
                {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    $data = mysqli_real_escape_string($conn, $data);
                    return $data;
                }

                require_once 'settings.php';

                $conn = @mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Unable to connect to the server</p>");

                // Fetch job data from the database
                $sql = "SELECT Position FROM job";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output job positions
                    $jobNumber = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo '<a href="#job' . $jobNumber . '" class="job-link">' . $row["Position"] . '</a>';
                        $jobNumber++;
                    }
                }
                ?>
            </nav>

            <section class="jobs-list-container">
                <aside class="sidebar">
                    <h1>Recent Jobs</h1>
                    <ul class="recent-jobs">
                        <li>Frontend Developer</li>
                        <li>UX Designer</li>
                        <li>Network Engineer</li>
                    </ul>
                </aside>

                <section class="jobs">

                        <?php

                    $conn = @mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Unable to connect to the server</p>");

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch job data from the database
                    $sql = "SELECT * FROM job";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output job data
                        $jobNumber = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo '<section id="job' . $jobNumber . '" class="job">';
                            echo '<h2 class="job-title">' . $row["Position"] . '</h2>';
                            echo 'Reference number: ' . $row["JobReferenceNumber"];
                            echo '<section class="summary">';
                            echo $row["BriefDescription"];
                            echo '<section class="summary1">';
                            echo '<p> Duration: ' . $row["Duration"] . '</p>';
                            echo '<p> Salary Range: ' . $row["SalaryRange"] . '</p>';
                            echo '</section>';
                            echo '</section>';
                            echo '<a href="apply.php" alt="' . $row["JobReferenceNumber"] . '" class="summary-btn">Apply</a>';
                            echo '<span class="open-positions">' . $row["OpenPositions"] . ' open positions</span>';
                            echo '</section>';
                            echo '<section class="about">';
                            echo '<section class="short">';
                            echo '<input type="checkbox" id="short-head-' . $row["JobReferenceNumber"] . '">';
                            echo '<label for="short-head-' . $row["JobReferenceNumber"] . '">More Details</label>';
                            echo '<section class="short-text">'; // Added class="short-text" here
                            echo '<h3>About Job</h3>';
                            echo '<p>';
                            echo 'Job Description:';
                            echo '<br />';
                            echo '<ul>';
                            $descriptions = explode("\n", $row['FullDescription']);
                            foreach ($descriptions as $description) {
                                echo '<li>' . $description . '</li>';
                            }
                            echo '</ul>';
                            echo '<hr class="divider1">';
                            echo '<section class="require">';
                            echo '<h4>Essential Requirement</h4>';
                            echo '<ul>';
                            $essentialrequirements = explode("\n", $row['EssentialRequirement']);
                            foreach ($essentialrequirements as $essentialrequirement) {
                                echo '<li>' . $essentialrequirement . '</li>';
                            }
                            echo '</ul>';
                            echo '<hr class="divider1">';
                            echo '<section class="require">';
                            echo '<h4>Other Requirements</h4>';
                            echo '<ul>';
                            $essentialrequirements = explode("\n", $row['EssentialRequirement']);
                            foreach ($essentialrequirements as $essentialrequirement) {
                                echo '<li>' . $essentialrequirement . '</li>';
                            }
                            echo '</ul>';
                            echo '</section>';
                            echo '</section>';
                            echo '</section>';
                            echo '</section>';
                            $jobNumber++;
                        }
                    } else {
                        echo "No jobs found.";
                    }

                    $conn->close();

                    ?>
                    
                </section>
            </section>
        </section>
    
        <!-- Footer -->
    <?php include 'footer.inc'; ?>

</body>

</php>
