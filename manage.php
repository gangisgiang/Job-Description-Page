<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>

<body>
    <!-- Header -->
    <?php
    include 'header.inc';
    require_once 'settings.php';

    function sanitize_input($conn, $data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($conn, $data);
        return $data;
    }

    $conn = @mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Unable to connect to the server</p>");

    // Create tables if not exist
    $createEOITable = "CREATE TABLE IF NOT EXISTS eoi (
        EOInumber INT AUTO_INCREMENT PRIMARY KEY,
        JobReferenceNumber CHAR(5) NOT NULL,
        FirstName VARCHAR(20) NOT NULL,
        LastName VARCHAR(20) NOT NULL,
        DateOfBirth CHAR(10) NOT NULL,
        Gender ENUM('Male', 'Female', 'Other') NOT NULL,
        StreetAddress VARCHAR(40) NOT NULL,
        SuburbOrTown VARCHAR(40) NOT NULL,
        GeoState VARCHAR(4) NOT NULL, 
        Postcode CHAR(4) NOT NULL,
        EmailAddress VARCHAR(255) NOT NULL,
        PhoneNumber VARCHAR(12) NOT NULL,
        Skills VARCHAR(100) NOT NULL,
        OtherSkills TEXT,
        EOI_Status ENUM('New', 'Current', 'Final') DEFAULT 'New'
    );";
    $result = @mysqli_query($conn, $createEOITable) or die("<p>Failed to create EOI table</p>");

    $createJobTable = "CREATE TABLE IF NOT EXISTS job (
        JobReferenceNumber CHAR(5) PRIMARY KEY,
        Position VARCHAR(100) NOT NULL,
        OpenPositions INT NOT NULL,
        Duration VARCHAR(100) NOT NULL,
        SalaryRange VARCHAR(100) NOT NULL,
        BriefDescription TEXT NOT NULL,
        FullDescription TEXT NOT NULL,
        EssentialRequirement TEXT NOT NULL,
        OtherRequirement TEXT NOT NULL
    );";
    $result = @mysqli_query($conn, $createJobTable) or die("<p>Failed to create job table</p>");

    // Handle form submission
    if (isset($_POST['Search'])) {
        $query = "SELECT * FROM eoi";
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
            $query = substr($query, 0, -5);  // Remove the last ' AND '
        }

        $query .= " ORDER BY " . $_POST['section'];
        $query .= $_POST['sort'] == "ascending" ? " ASC" : " DESC";
    } else {
        $query = "SELECT * FROM eoi";
    }

    $result = @mysqli_query($conn, $query) or die("<p>Failed to execute query</p>");

    if (mysqli_num_rows($result) == 0) {
        $eoi_list = "<p style='text-align: center; font-size: 20px;'>No records found</p>";
    } else {
        $eoi_list = "<div class='manager-table'><table>";
        $eoi_list .= "<tr><th>EOI Number</th><th>Job Reference Number</th><th>First Name</th><th>Last Name</th><th>DOB</th><th>Gender</th><th>Address</th><th>Town</th><th>State</th><th>Postcode</th><th>Email</th><th>Phone</th><th>Skills</th><th>Other Skills</th><th>EOI Status</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $eoi_list .= "<tr><td>{$row['EOInumber']}</td><td>{$row['JobReferenceNumber']}</td><td>{$row['FirstName']}</td><td>{$row['LastName']}</td><td>{$row['DateOfBirth']}</td><td>{$row['Gender']}</td><td>{$row['StreetAddress']}</td><td>{$row['SuburbOrTown']}</td><td>{$row['GeoState']}</td><td>{$row['Postcode']}</td><td>{$row['EmailAddress']}</td><td>{$row['PhoneNumber']}</td><td>{$row['Skills']}</td><td>{$row['OtherSkills']}</td><td>{$row['EOI_Status']}</td></tr>";
        }
        $eoi_list .= "</table></div>";
    }
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>

    <main>
        <h1 class="h1">Application Management</h1>


        <!-- Display EOI list -->
        <nav class="scrollbar">
        <?php echo $eoi_list; ?>
        </nav>


        <div class="table">
            <!-- Search Form -->
            <div class="apply">
                <form action="manage.php" method="post">
                    <div class="form-header">
                        <h2>Search EOIs</h2>
                    </div>
                    <label for="firstname_search">First Name:</label>
                    <input type="text" id="firstname_search" name="firstname_search" pattern="[A-Za-z]{1,20}" title="Max 20 alpha characters">
                    <span class="error-message" id="firstName-error"></span>
                    <label for="lastname_search">Last Name:</label>
                    <input type="text" id="lastname_search" name="lastname_search" pattern="[A-Za-z]{1,20}" title="Max 20 alpha characters">
                    <span class="error-message" id="lastName-error"></span>
                    <p> To list all EOIs, leave the fields blank and all categories at the default choice.</p>
                    <fieldset class="input-container">
                        <legend>Job Reference Number:</legend>
                        <div class="input-options">
                            <input type="radio" id="all_jobs_search" name="job_search" value="all" class="input-radio" checked>
                            <label for="all_jobs_search" class="label">All</label>
                            <?php
                            require_once 'settings.php';
                            $conn = @mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Unable to connect to the server</p>");
                            $query = "SELECT JobReferenceNumber FROM job";
                            $result = @mysqli_query($conn, $query) or die("<p>Unable to find the Job Reference Numbers</p>");

                            if (mysqli_num_rows($result) == 0) {
                                echo "<p>No jobs found</p>";
                            } else {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<input type='radio' id='{$row['JobReferenceNumber']}_search' name='job_search' value='{$row['JobReferenceNumber']}' class='input-radio'>";
                                    echo "<label for='{$row['JobReferenceNumber']}_search' class='label'>{$row['JobReferenceNumber']}</label>";
                                }
                            }

                            mysqli_free_result($result);
                            mysqli_close($conn);
                            ?>
                        </div>
                    </fieldset>
                    <br/>

                    <fieldset class="input-container">
                        <legend>Choose one category to sort:</legend>
                        <div class="input-options">
                            <input type="radio" id="EOInumber" name="section" value="EOInumber" class="input-radio" checked>
                            <label for="EOInumber" class="label">EOI Number</label>
                            <input type="radio" id="FirstName" name="section" value="FirstName" class="input-radio">
                            <label for="FirstName" class="label">First Name</label>
                            <input type="radio" id="LastName" name="section" value="LastName" class="input-radio">
                            <label for="LastName" class="label">Last Name</label>
                            <input type="radio" id="Gender" name="section" value="Gender" class="input-radio">
                            <label for="Gender" class="label">Gender</label>
                            <input type="radio" id="GeoState" name="section" value="GeoState" class="input-radio">
                            <label for="GeoState" class="label">Geo State</label>
                            <input type="radio" id="Postcode" name="section" value="Postcode" class="input-radio">
                            <label for="Postcode" class="label">Postcode</label>
                        </div>
                    </fieldset>
                    <br/>
                    <label for="sort">Sort by:</label>
                    <select id="sort" name="sort">
                        <option value="ascending">Ascending</option>
                        <option value="descending">Descending</option>
                    </select>
                    <br/><br/>
                    <input type="submit" value="Search" name="Search" class="form-button">
                </form>
            </div>
        </div>

        <div class="table">
            <!-- Form -->
            <div class="table">
            <div class="apply">
                <form action="process_manage.php" method="post">
                    <div class="form-header">
                        <h2>Delete EOIs Records</h2>
                    </div>
                    <br/>
                    <fieldset class="input-container">
                        <legend>Job Reference Number:</legend>
                        <div class="input-options">
                            <?php
                            require_once 'settings.php';
                            $conn = @mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Unable to connect to the server</p>");
                            
                            $query = "SELECT JobReferenceNumber FROM job";
                            $result = @mysqli_query($conn, $query) or die("<p>Unable to find the Job Reference Numbers</p>");

                            if (mysqli_num_rows($result) == 0) {
                                echo "<p>No jobs found</p>";
                            } else {
                                $i = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $checked = $i == 0 ? 'checked' : '';
                                    echo "<input type='radio' id='{$row['JobReferenceNumber']}_delete' name='job_delete_eoi' value='{$row['JobReferenceNumber']}' class='input-radio' {$checked}>";
                                    echo "<label for='{$row['JobReferenceNumber']}_delete_eoi' class='label'>{$row['JobReferenceNumber']}</label>";
                                    $i++;
                                }
                            }
                            mysqli_free_result($result);
                            ?>
                        </div>
                    </fieldset>
                    <br/>
                    <div class="button-container">
                        <input type="submit" name="Delete_EOI" value="Delete" class="submit-button">
                    </div>
                </form>
            </div>
        </div>
    </div>


        <!-- Change Status Form -->
        <div class="table">
            <div class="apply">
                <form action="process_manage.php" method="post">
                    <div class="form-header">
                        <h2>Change Status</h2>
                    </div>
                    <br/>
                    <label for="status_update">Enter the EOI number:</label>
                    <input type="text" id="status_update" name="status_update" required>
                    <br/>
                    <fieldset class="input-container">
                        <legend>Choose a status:</legend>
                        <div class="input-options">
                            <input type="radio" id="new" name="update_status" value="New" class="input-radio" checked>
                            <label for="new" class="label">New</label>
                            <input type="radio" id="current" name="update_status" value="Current" class="input-radio">
                            <label for="current" class="label">Current</label>
                            <input type="radio" id="final" name="update_status" value="Final" class="input-radio">
                            <label for="final" class="label">Final</label>
                        </div>
                    </fieldset>
                    <br/>
                    <div class="button-container">
                        <input type="submit" name="Update" value="Update" class="submit-button">
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Job Description Form -->
        <div class="table">
            <div class="apply">
                <form action="process_manage.php" method="post">
                    <div class="form-header">
                        <h2>Add Job Description</h2>
                    </div>
                    <br/>
                    <label for="JobReferenceNumber">Job Reference Number:</label>
                    <input type="text" id="JobReferenceNumber" name="JobReferenceNumber" pattern="[A-Za-z0-9]{5}" title="Exactly 5 alphanumeric characters" placeholder="ex: VC254, VC165" required>
                    <span class="error-message" id="jobRef-error"></span>
                    <br/>
                    <label for="Position">Position:</label>
                    <input type="text" id="Position" name="Position" required>
                    <br/>
                    <label for="OpenPositions">Open Positions:</label>
                    <input type="number" id="OpenPositions" name="OpenPositions" pattern="[0-9]" required>
                    <br/><br/>
                    <label for="Duration">Duration:</label>
                    <input type="text" id="Duration" name="Duration" required>
                    <br/>
                    <label for="SalaryRange">Salary Range:</label>
                    <input type="text" id="SalaryRange" name="SalaryRange" required>
                    <br/>
                    <label for="BriefDescription">Brief Description:</label>
                    <textarea id="BriefDescription" name="BriefDescription" required></textarea>
                    <br/>
                    <label for="FullDescription">Full Description:</label>
                    <textarea id="FullDescription" name="FullDescription" required></textarea>
                    <br/>
                    <label for="EssentialRequirement">Essential Requirement:</label>
                    <textarea id="EssentialRequirement" name="EssentialRequirement" required></textarea>
                    <br/>
                    <label for="OtherRequirement">Other Requirement:</label>
                    <textarea id="OtherRequirement" name="OtherRequirement" required></textarea>
                    <br/>
                    <div class="button-container">
                        <input type="submit" name="Add" value="Add" class="submit-button">
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Job Description Form -->
        <div class="table">
            <div class="apply">
                <form action="process_manage.php" method="post">
                    <div class="form-header">
                        <h2>Delete Job Description</h2>
                    </div>
                    <br/>
                    <fieldset class="input-container">
                        <legend>Job Reference Number:</legend>
                        <div class="input-options">
                            <?php
                            require_once 'settings.php';
                            $conn = @mysqli_connect($host, $user, $pwd, $sql_db) or die("<p>Unable to connect to the server</p>");
                            
                            $query = "SELECT JobReferenceNumber FROM job";
                            $result = @mysqli_query($conn, $query) or die("<p>Unable to find the Job Reference Numbers</p>");

                            if (mysqli_num_rows($result) == 0) {
                                echo "<p>No jobs found</p>";
                            } else {
                                $i = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $checked = $i == 0 ? 'checked' : '';
                                    echo "<input type='radio' id='{$row['JobReferenceNumber']}_delete' name='_delete' value='{$row['JobReferenceNumber']}' class='input-radio' {$checked}>";
                                    echo "<label for='{$row['JobReferenceNumber']}_delete' class='label'>{$row['JobReferenceNumber']}</label>";
                                    $i++;
                                }
                            }

                            mysqli_free_result($result);
                            mysqli_close($conn);
                            ?>
                        </div>
                    </fieldset>
                    <br/>
                    <div class="button-container">
                        <input type="submit" name="Delete_Job" value="Delete" class="submit-button">
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include 'footer.inc'; ?>
</body>
</html>
