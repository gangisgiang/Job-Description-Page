<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Expression of Interest</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.5;
            color: red;
        }
        .return-link {
            color: black;
            text-decoration: none;
        }
        a {
            color: #4e88aa;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php
        //Check if user is coming to this site from 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validate and sanitize input data:

            // Perform server-side data format checking
            $arrErrorMsg = array();

            //NOTE: WILL HAVE TO REDO/RETHINK HOW JOB REF NUMBER WORKS
            // Check if job ref number is set (if the user put a value of any kind into the input box)
            if (!isset ($_POST["reference"])) {
                // If it is not set, output error message
                $arrErrorMsg[] = "Job Reference Number is required and must have exactly 5 characters.";
            } else {
                // It is set. Now put input into variable and sanitise it. 
                $sJobRefNumber = sanitize_input($_POST["reference"]);

                // Check if the field is empty after sanitising input
                if (empty($sJobRefNumber)) {
                    // If it is empty, output error message
                    $arrErrorMsg[] = "Job Reference Number is required and must have exactly 5 characters.";
                } else {
                    // Check if input is alphanumeric characters
                    if (!ctype_alnum($sJobRefNumber)) {
                        // If not, output error message
                        $arrErrorMsg[] = "Job Reference Number must only contain letters and/or numbers.";
                    } else {
                        // Check if input is exactly 5 characters long
                        if (strlen($sJobRefNumber) != 5) { 
                            // If not, output error message.
                            $arrErrorMsg[] = "Job Reference Number is required and must have exactly 5 letters and/or numbers.";
                        }
                    }
                }
            }
            //If it passes all the validation, the input is correct and no errors have been found.
            
            // Check if first name is set (if the user put a value of any kind into the input box)
            if (!isset ($_POST["firstname"])) {
                // If it is not set, output error message
                $arrErrorMsg[] = "First Name is required and must be 20 characters or less.";
            } else {
                // It is set. Now put input into variable and sanitise it. 
                $sFirstName = sanitize_input($_POST["firstname"]);

                // Check if the field is empty after sanitising input
                if (empty($sFirstName)) {
                    // If it is empty, output error message.
                    $arrErrorMsg[] = "First Name is required and must be 20 characters or less.";
                } else {
                    if (strlen($sFirstName) > 20) {
                    // If input has more than 20 characters, output error message.
                    $arrErrorMsg[] = "First Name is required and must be 20 characters or less.";
                    } else {
                        // Check if input is only alpha characters
                        if (!ctype_alpha($sFirstName)) {
                            // If not, output error message.
                            $arrErrorMsg[] = "First Name must only contain letters, spaces and/or hyphens (20 max).";
                        }
                    } 
                }
            }
            //If it passes all the validation, the input is correct and no errors have been found.
            
            // Check if last name is set (if the user put a value of any kind into the input box)
            if (!isset ($_POST["lastname"])) {
                // If it is not set, output error message
                $arrErrorMsg[] = "Last Name is required and must be 20 characters or less.";
            } else {
                // It is set. Now put input into variable and sanitise it. 
                $sLastName = sanitize_input($_POST["lastname"]);

                // Check if the field is empty after sanitising input
                if (empty($sLastName)) {
                    // If it is empty, output error message.
                    $arrErrorMsg[] = "Last Name is required and must be 20 characters or less.";
                } else {
                    if (strlen($sLastName) > 20) {
                    // If input has more than 20 characters, output error message.
                    $arrErrorMsg[] = "Last Name is required and must be 20 characters or less.";
                    } else {
                        // Check if input is only alpha characters
                        if (!ctype_alpha($sFirstName)) {
                            // If not, output error message.
                            $arrErrorMsg[] = "Last Name must only contain letters, spaces and/or hyphens (20 max).";
                        }
                    } 
                }
            }
            //If it passes all the validation, the input is correct and no errors have been found.
        
            // Check if date of birth is set 
            if (!isset ($_POST["birth"])) {
                // If it is not set, output error message
                $arrErrorMsg[] = "Date of Birth is required.";
            } else {
                // It is set. Now put input into variable and sanitise it. 
                $sDOB = sanitize_input($_POST["birth"]);

                // Check if the field is empty after sanitising input
                if (empty($sDOB)) {
                    // If it is empty, output error message.
                    $arrErrorMsg[] = "Date of Birth is required.";
                } else {
                    $sDateToday = date("Y-m-d");
                    $iAge = $sDateToday - $sDOB;
                        
                    // Check to see if the age is in the correct range.
                    if ($iAge < 15 or $iAge > 80) {
                        // If not, output error message.
                        $arrErrorMsg[] = "Age must be between 15 and 80.";
                    }
                }
            }
            //If it passes all the validation, the input is correct and no errors have been found.

            // Check if gender is set
            if (!isset ($_POST["gender"])) {
                // If it is not set, output error message
                $arrErrorMsg[] = "Gender is required.";
            } else {
                // It is set. Now put input into variable and sanitise it. 
                $sGender = sanitize_input($_POST["gender"]);

                // Check if the field is empty after sanitising input
                if (empty($sGender)) {
                    // If it is empty, output error message.
                    $arrErrorMsg[] = "Gender is required.";
                }
            }
            //If it passes all the validation, the input is correct and no errors have been found.
            
            // Check if street address is set
            if (!isset ($_POST["address"])) {
                // If it is not set, output error message
                $arrErrorMsg[] = "Street Address is required and must be 40 characters or less.";
            } else {
                // It is set. Now put input into variable and sanitise it. 
                $sAddress = sanitize_input($_POST["address"]);

                // Check if the field is empty after sanitising input
                if (empty($sAddress)) {
                    // If it is empty, output error message.
                    $arrErrorMsg[] = "Street Address is required and must be 40 characters or less.";
                } else {
                    if (strlen($sAddress) > 40) {
                        // If input has more than 40 characters, output error message.
                        $arrErrorMsg[] = "Street Address is required and must be 40 characters or less.";
                    }
                }
            }
            //If it passes all the validation, the input is correct and no errors have been found.

            // Check if suburb/town is set
            if (!isset ($_POST["suburb"])) {
                // If it is not set, output error message
                $arrErrorMsg[] = "Suburb/Town is required and must be 40 characters or less.";
            } else {
                // It is set. Now put input into variable and sanitise it. 
                $sSuburbOrTown = sanitize_input($_POST["suburb"]);

                // Check if the field is empty after sanitising input
                if (empty($sSuburbOrTown)) {
                    // If it is empty, output error message.
                    $arrErrorMsg[] = "Suburb/Town is required and must be 40 characters or less.";
                } else {
                    if (strlen($sSuburbOrTown) > 40) {
                        // If input has more than 40 characters, output error message.
                        $arrErrorMsg[] = "Suburb/Town is required and must be 40 characters or less.";
                    }
                }
            }
            //If it passes all the validation, the input is correct and no errors have been found.

            // Check if state is set
            if (!isset ($_POST["state"])) {
                // If it is not set, output error message
                $arrErrorMsg[] = "State is required.";
            } else {
                // It is set. Now put input into variable and sanitise it. 
                $sValidateState = sanitize_input($_POST["state"]);

                // Check if the field is empty after sanitising input
                if (empty($sValidateState)) {
                    // If it is empty, output error message.
                    $arrErrorMsg[] = "State is required.";
                } elseif ($sValidateState == "VIC") {
                    // If an allowed value, let it go through (same for all except last eles sattement)
                    $sState = $sValidateState;
                } elseif ($sValidateState == "NSW") {
                    $sState = $sValidateState;
                } elseif ($sValidateState == "QLD") {
                    $sState = $sValidateState;
                } elseif ($sValidateState == "NT") {
                    $sState = $sValidateState;
                } elseif ($sValidateState == "WA") {
                    $sState = $sValidateState;
                } elseif ($sValidateState == "SA") {
                    $sState = $sValidateState;
                } elseif ($sValidateState == "TAS") {
                    $sState = $sValidateState;
                } elseif ($sValidateState == "ACT") {
                    $sState = $sValidateState;
                } else {
                    // If not an allowed value, output error message
                    $arrErrorMsg[] = "State must only be one of these values: VIC, NSW, QLD, NT, WA, SA, TAS or ACT.";
                }
            }
            //If it passes all the validation, the input is correct and no errors have been found.


            // Check if postcode is set
            if (!isset ($_POST["postcode"])) {
                // If it is not set, output error message
                $arrErrorMsg[] = "Postcode is required and must be exactly four numbers.";
            } else {
                // It is set. Now put input into variable and sanitise it. 
                $sPostcode = sanitize_input($_POST["postcode"]);

                // Check if the field is empty after sanitising input
                if (empty($sPostcode)) {
                    // If it is empty, output error message.
                    $arrErrorMsg[] = "Postcode is required and must be exactly four numbers.";
                } else {
                    // If input does not ONLY contain numbers, output error message
                    if (!is_numeric($sPostcode)) {
                        $arrErrorMsg[] = "Postcode is required and must be exactly four numbers.";
                    } else {
                        // If input is not exactly four numbers long, output error message
                        if (strlen($sPostcode) != 4) {
                            $arrErrorMsg[] = "Postcode is required and must be exactly four numbers.";
                        } else {
                            // Check if the postcode matches the state entered
                            // If not, output error message.
                            if ($sState == "VIC" and ($sPostcode < 3000 or $sPostcode > 3999)) {
                                $arrErrorMsg[] = "Invalid Postcode For VIC.";
                            }
                            if ($sState == "NSW" and ($sPostcode < 2000 or ($sPostcode > 2599 and $sPostcode < 2619) or ($sPostcode > 2898 and $sPostcode < 2921) or $sPostcode > 2999)) {
                                $arrErrorMsg[] = "Invalid Postcode For NSW.";
                            }
                            if ($sState == "QLD" and ($sPostcode < 4000 or $sPostcode > 4999)) {
                                $arrErrorMsg[] = "Invalid Postcode For QLD.";
                            }
                            if ($sState == "NT" and ($sPostcode < 800 or $sPostcode > 899)) {
                                $arrErrorMsg[] = "Invalid Postcode For NT.";
                            }
                            if ($sState == "WA" and ($sPostcode < 6000 or $sPostcode > 6797)) {
                                $arrErrorMsg[] = "Invalid Postcode For WA.";
                            }
                            if ($sState == "SA" and ($sPostcode < 5000 or $sPostcode > 5799)) {
                                $arrErrorMsg[] = "Invalid Postcode For SA.";
                            }
                            if ($sState == "TAS" and ($sPostcode < 7000 or $sPostcode > 7799)) {
                                $arrErrorMsg[] = "Invalid Postcode For TAS.";
                            }
                            if ($sState == "ACT" and ($sPostcode < 2600 or ($sPostcode > 2618 and $sPostcode < 2900) or $sPostcode > 2920)) {
                                $arrErrorMsg[] = "Invalid Postcode For ACT.";
                            } 
                        }
                    }
                }
            }
            //If it passes all the validation, the input is correct and no errors have been found.

            // Check if email is set
            if (!isset ($_POST["email"])) {
                // If it is not set, output error message
                $arrErrorMsg[] = "Email is required and must have an @ symbol.";
            } else {
                // It is set. Now put input into variable and sanitise it. 
                $sEmail = sanitize_input($_POST["email"]);

                // Check if the field is empty after sanitising input
                if (empty($sEmail)) {
                    // If it is empty, output error message.
                    $arrErrorMsg[] = "Email is required and must have an @ symbol.";
                } else {
                    // If input is not correct email format, output error message.
                    if (!filter_var($sEmail, FILTER_VALIDATE_EMAIL)) {
                        $arrErrorMsg[] = "Email is required and must have an '@' symbol with a '.' in between text after it. (e.g. example@example.net)";
                    }
                }
            }
            //If it passes all the validation, the input is correct and no errors have been found.

            // Check if phone number is set
            if (!isset ($_POST["phone"])) {
                // If it is not set, output error message
                $arrErrorMsg[] = "Phone Number is required and must be 8-12 numbers (spaces allowed).";
            } else {
                // It is set. Now put input into variable and sanitise it. 
                $sPhoneNumber = sanitize_input($_POST["phone"]);

                // Check if the field is empty after sanitising input
                if (empty($sPhoneNumber)) {
                    // If it is empty, output error message.
                    $arrErrorMsg[] = "Phone Number is required and must be 8-12 numbers (spaces allowed).";
                } else {
                    // Copies the input, strips ALL the spaces out, and then tests if that one is a number.
                    // If so, allow the rest of the code to go through but with the original input.
                    $sCheckPhoneNumber = str_replace(" ", "", $sPhoneNumber);
                    // If input does not ONLY contain numbers, output error message
                    if (!is_numeric($sCheckPhoneNumber)) {
                        $arrErrorMsg[] = "Phone Number is required and must be 8-12 numbers (spaces allowed).";
                    } else {
                        if (strlen($sPhoneNumber) < 8 OR strlen($sPhoneNumber) > 12) {
                            $arrErrorMsg[] = "Phone Number is required and must be 8-12 numbers (spaces allowed).";
                        }
                    }
                }
            }
            //If it passes all the validation, the input is correct and no errors have been found.

            // Check if any skills check skills checkboxes are checked.
            if (isset($_POST["skills"]) and is_array($_POST["skills"])) {
                // If any are selected, get the array that the checkboxes returned    
                $arrSkills = $_POST["skills"];
                // Then get all the skill values out of it and put them into a string.
                $sSkills = implode(", ", $arrSkills);
            } else {
                // Otherwise, put 'no skills selected' into the string instead
                $sSkills = "No skills selected";
            }

            // Check if the Other Skills text area is set
            if (isset($_POST['other_skills_tarea'])) {
                // If so, sanitize the input
                $sOtherSkills = sanitize_input($_POST['other_skills_tarea']);
            } else {
                // If not, put 'None' instead
                $sOtherSkills = "None";
            }
            
            // Check if the "Other Skills" checkbox is checked but no input is provided
            if (isset($_POST['other_skills_cbox']) && empty($sOtherSkills)) {
                //Output error message
                $arrErrorMsg[] = "You have checked the \"Other Skills\" checkbox. Please enter something in the associated text area. Otherwise, uncheck the box.";
            }
            
            // Check if input for other skills is provided but the checkbox is not checked
            if (!isset($_POST['other_skills_cbox']) && !empty($sOtherSkills)) {
                //Output error message
                $arrErrorMsg[] = "You have provided other skills but did not check the 'Other Skills' checkbox. Please check the checkbox if you want to include other skills.";
            }
            //If it passes all the validation, the input is correct and no errors have been found.

            // If there are validation errors, display the error messages
            if (!empty($arrErrorMsg)) {
                foreach ($arrErrorMsg as $sErrorMsg) {
                    echo $sErrorMsg . "<br>";
                }
                echo '<p class="return-link">To return to the application page, <a href="apply.php">click here</a>.</p>';
                exit(); // Stop further execution
            }

            require_once ("settings.php"); //connection info

            $connect = @mysqli_connect(
                $host,
                $user,
                $pwd,
                $sql_db
            );
    
            // Checks if connection is successful
            if (!$connect) {
                // If connection is unsuccessful, displays an error message
                die("Connection failed: " . mysqli_connect_error());
                //echo "<p>Database connection failure</p>";           
            } else {
                // Upon successful connection
                // SQL command to create table if it does not exist
                $sCreateTableQuery =
                "CREATE TABLE IF NOT EXISTS 'eoi' (
                    EOInumber INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    JobReferenceNumber VARCHAR(5) NOT NULL,
                    FirstName VARCHAR(20) NOT NULL,
                    LastName VARCHAR(20) NOT NULL,
                    DateOfBirth DATE NOT NULL,
                    Gender VARCHAR(20) NOT NULL,
                    StreetAddress VARCHAR(40) NOT NULL,
                    SuburbOrTown VARCHAR(40) NOT NULL,
                    GeoState VARCHAR(3) NOT NULL,
                    Postcode VARCHAR(4) NOT NULL,
                    EmailAddress VARCHAR(100) NOT NULL,
                    PhoneNumber VARCHAR(12) NOT NULL,
                    Skills VARCHAR(100),
                    OtherSkills TEXT,
                    EOI_Status ENUM('New', 'Current', 'Final') DEFAULT 'New' NOT NULL
                )";
            
                // Execute the query
                mysqli_query($connect, $sCreateTableQuery);

                //Now that existence of a table is confirmed, insert EOI record into it:
                $sInsertRecordQuery =
                "INSERT INTO eoi (
                    JobReferenceNumber,
                    FirstName,
                    LastName,
                    DateOfBirth,
                    Gender,
                    StreetAddress,
                    SuburbOrTown,
                    GeoState,
                    Postcode,
                    EmailAddress,
                    PhoneNumber,
                    Skills,
                    OtherSkills,
                    EOI_Status
                )
                VALUES (
                    '$sJobRefNumber',
                    '$sFirstName',
                    '$sLastName',
                    '$sDOB',
                    '$sGender',
                    '$sAddress',
                    '$sSuburbOrTown',
                    '$sState',
                    '$sPostcode',
                    '$sEmail',
                    '$sPhoneNumber',
                    '$sSkills',
                    '$sOtherSkills',
                    'New'
                )";
            
                // Execute the query
                $result = mysqli_query($connect, $sInsertRecordQuery);

                // Checks if the execution was successful
                if (!$result) {
                    echo "<p>Something is wrong with the query: " . mysqli_error($connect) . "</p>";
                } else {
                    // Get the EOInumber of the added record
                    $iEOInumber = mysqli_insert_id($connect);
                    echo "<p>Successfully added Expression of Interest. ID: $iEOInumber</p>";
                    
                    // Hyperlink to home page and jobs page
                    echo '<p><a href="index.php">Go to Home Page</a></p>';
                    echo '<p><a href="jobs.php">Go to Jobs Page</a></p>';
                }

                // Close the database connection
                mysqli_close($connect);

            } // if successful database connection

        } else {
            // If someone tries to access processEOI.php directly, redirect them to the form
            header("Location: apply.php");
            exit();
        }

        // Function to sanitize input data
        function sanitize_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>
</body>
</html>
