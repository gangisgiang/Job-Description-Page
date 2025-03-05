<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="styles/process_manage.css">
</head>

<body>
    <!-- Header -->

    <?php
    if (!isset($_POST['Search']) && !isset($_POST['Delete_EOI']) && !isset($_POST['Update']) && !isset($_POST['Add']) && !isset($_POST['Delete_Job'])) {
        header("location: manage.php");
    }
    ?>
    

    <main>
        <div class="result">
            <h1>Result</h1>
            <br/>
            <br/>
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
            
            // Disables direct connections to process_manage.php
            if (!isset($_SERVER['HTTP_REFERER'])) {
                header('location:manage.php');
                exit;
            }

            $br2 = "<br><br>";
            echo $br2;

            $back_btn = "<div class=\"back_banner_container\">
            <a href=\"manage.php\" class=\"back_banner\"><strong>Back to Manage Page</strong></a>
            </div>";
    
            $conn = @mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Unable to connect to the server</p> $back_btn");
            $eoi  = "eoi";
            if (isset($_POST['Search'])) {
                $query = "SELECT * FROM $eoi ";

                $firstname_search = sanitize_input($conn, $_POST['firstname_search']);
                $lastname_search = sanitize_input($conn, $_POST['lastname_search']);
                $job_search = $_POST['job_search'];

                if ($firstname_search != "" || $lastname_search != "" || $job_search != "all") {
                    $query .= " WHERE ";
                    if ($firstname_search != "") {
                        $query .= "FirstName LIKE '%$firstname_search%' AND ";
                    }
                    if ($lastname_search != "") {
                        $query .= "LastName LIKE '%$lastname_search%' AND ";
                    }
                    if ($job_search != "all") {
                        $query .= "JobReferenceNumber = '$job_search' AND ";
                    }
                    $query = substr($query, 0, -5);
                }

                $query .= " ORDER BY ";
                $query .= $_POST['section'];

                if ($_POST['sort'] == "ascending") {
                    $query .= " ASC";
                } else {
                    $query .= " DESC";
                }

                $result = @mysqli_query($conn, $query) or die("<p>Failed to execute query</p> $back_btn");

                if (mysqli_num_rows($result) == 0) {
                    echo "<p>No records found</p>";
                } else {
                    echo "<div class='manager'>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>EOI Number</th>";
                    echo "<th>Job Reference Number</th>";
                    echo "<th>First Name</th>";
                    echo "<th>Last Name</th>";
                    echo "<th>DOB</th>";
                    echo "<th>Gender</th>";
                    echo "<th>Address</th>";
                    echo "<th>Town</th>";
                    echo "<th>State</th>";
                    echo "<th>Postcode</th>";
                    echo "<th>Email</th>";
                    echo "<th>Phone</th>";
                    echo "<th>Ruby</th>";
                    echo "<th>C</th>";
                    echo "<th>Other Skills</th>";
                    echo "<th>EOI Status</th>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['EOInumber'] . "</td>";
                        echo "<td>" . $row['JobReferenceNumber'] . "</td>";
                        echo "<td>" . $row['FirstName'] . "</td>";
                        echo "<td>" . $row['LastName'] . "</td>";
                        echo "<td>" . $row['DateOfBirth'] . "</td>";
                        echo "<td>" . $row['Gender'] . "</td>";
                        echo "<td>" . $row['StreetAddress'] . "</td>";
                        echo "<td>" . $row['SuburbOrTown'] . "</td>";
                        echo "<td>" . $row['GeoState'] . "</td>";
                        echo "<td>" . $row['Postcode'] . "</td>";
                        echo "<td>" . $row['EmailAddress'] . "</td>";
                        echo "<td>" . $row['PhoneNumber'] . "</td>";
                        echo "<td>" . $row['Ruby'] . "</td>";
                        echo "<td>" . $row['C'] . "</td>";
                        echo "<td>" . $row['OtherSkills'] . "</td>";
                        echo "<td>" . $row['EOI_Status'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "</div>";
                }
                mysqli_free_result($result);
            }

            if (isset($_POST['Delete_EOI'])) {
                // Check if there is any jobs
                $query = "SELECT * FROM job";
                $result = @mysqli_query($conn, $query) or die("<p>Failed to check if there is any jobs</p> $back_btn");

                if (mysqli_num_rows($result) == 0) {
                    echo ("<p>There is no job to delete</p>");
                    mysqli_free_result($result);
                } else {
                    mysqli_free_result($result);
                    $job_delete_eoi = $_POST['job_delete_eoi'];
                    $query = "DELETE FROM $eoi  WHERE JobReferenceNumber = '$job_delete_eoi'";
                    $result = @mysqli_query($conn, $query) or die("<p>Failed to delete record</p> $back_btn");
                    echo "<p>Delete records successfully</p>";
                }
            }

            if (isset($_POST['Update'])) {
                $eoi_num = sanitize_input($conn, $_POST['status_update']);
                $status = $_POST['update_status'];

                $query = "UPDATE $eoi  SET EOI_Status = '$status' WHERE EOInumber = $eoi_num";
                $result = @mysqli_query($conn, $query) or die("<p>Failed to update record</p> $back_btn");

                if (mysqli_affected_rows($conn) == 0) {
                    echo "<p>EOI number not found</p>";
                } else {
                    echo "<p>Update record successfully</p>";
                }
            }

            if (isset($_POST['Add'])) {
                $reference = sanitize_input($conn, $_POST['JobReferenceNumber']);
                $position = sanitize_input($conn, $_POST['Position']);
                $open = sanitize_input($conn, $_POST['OpenPositions']);
                $duration = sanitize_input($conn, $_POST['Duration']);
                $salary = sanitize_input($conn, $_POST['SalaryRange']);
                $briefdesc = sanitize_input($conn, $_POST['BriefDescription']);
                $desc = sanitize_input($conn, $_POST['FullDescription']);
                $essreq = sanitize_input($conn, $_POST['EssentialRequirement']);
                $othreq = sanitize_input($conn, $_POST['OtherRequirement']);

                $query = "CREATE TABLE IF NOT EXISTS job (
                    JobReferenceNumber CHAR(5) PRIMARY KEY NOT NULL,
                    Position VARCHAR(100) NOT NULL,
                    OpenPositions INT NOT NULL,
                    Duration VARCHAR(100) NOT NULL,
                    SalaryRange VARCHAR(100) NOT NULL,
                    BriefDescription TEXT NOT NULL,
                    FullDescription TEXT NOT NULL,
                    EssentialRequirement TEXT NOT NULL,
                    OtherRequirement TEXT NOT NULL
                );";

                $result = @mysqli_query($conn, $query) or die("<p>Failed to create table</p> $back_btn");

                // Check if JobRefNum already exists
                $query = "SELECT * FROM job WHERE JobReferenceNumber = '$reference'";
                $result = @mysqli_query($conn, $query) or die("<p>Failed to check if Job Reference Number exists</p> $back_btn");

                if (mysqli_num_rows($result) != 0) {
                    echo ("<p>Job Reference Number already exists</p>");
                    mysqli_free_result($result);
                } else {
                    mysqli_free_result($result);
                    $query = "INSERT INTO job (JobReferenceNumber, Position, OpenPositions, Duration, SalaryRange, BriefDescription, FullDescription, EssentialRequirement, OtherRequirement) VALUES ('$reference', '$position', '$open', '$duration', '$salary', '$briefdesc', '$desc', '$essreq', '$othreq')";

                    $result = @mysqli_query($conn, $query) or die("<p>" . mysqli_error($conn) . "</p> $back_btn");

                    echo "<p>Insert record successfully</p>";
                }
            }

            if (isset($_POST['Delete_Job'])) {
                $query = "SELECT * FROM job";
                $result = @mysqli_query($conn, $query) or die("<p>Failed to check if there are any jobs</p> $back_btn");

                if (mysqli_num_rows($result) == 0) {
                    echo ("<p>There is no job to delete</p>");
                    mysqli_free_result($result);
                } else {
                    mysqli_free_result($result);
                    $job_delete = sanitize_input($conn, $_POST['job_delete']);

                    $query = "SELECT * FROM $eoi  WHERE JobReferenceNumber = '$job_delete'";
                    $result = @mysqli_query($conn, $query) or die("<p>Failed to check if there are any EOIs</p> $back_btn");

                    if (mysqli_num_rows($result) != 0) {
                        echo ("<p>There are EOIs associated with this job</p>");
                        mysqli_free_result($result);
                    } else {
                        mysqli_free_result($result);
                        $query = "DELETE FROM job WHERE JobReferenceNumber = '$job_delete'";
                        $result = @mysqli_query($conn, $query) or die("<p>Failed to delete record. Error: " . mysqli_error($conn) . "</p> $back_btn");

                        if (mysqli_affected_rows($conn) == 0) {
                            echo "<p>Job Reference Number not found</p>";
                        } else {
                            echo "<p>Delete job successfully</p>";
                        }
                    }
                }
            }

            mysqli_close($conn);

            echo $back_btn;
            ?>
        </div>
    </main>
</body>

</html>
