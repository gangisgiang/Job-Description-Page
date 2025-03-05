<!DOCTYPE php>
<php lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/style.css" rel="stylesheet" />
    <title>Enhancements</title>
</head>


    <body>

        <?php include 'header.inc'; ?>

        <section class="responsive">
            <section id="responsive">
                <h2 class="title"> Job Description Enhancement</h2>
                <section class="rsv-sum">
                Store job descriptions in a database table and dynamically generate the HTML content using PHP. This approach allows for easy management and updates of job information, ensuring that changes in the database are instantly reflected on the website.
                </section>

                <section class="rsv">
                    <input type="checkbox" id="rsv">
                    <label for="rsv">Details</label>
                    <section class="rsv-text">
                        <h3>Add and Delete Jobs</h3>
                        <p>
                        A user-friendly interface for adding and deleting job records from the database. The form includes fields for entering job details such as position, reference number, description, duration, salary range, and open positions. The manager can easily add new job listings or remove existing ones, ensuring that the website's job database is up-to-date.
                        </p>

                        <p>
                        <img src="styles/images/enhancement2.png" alt="job">
                        <br/><br/>
                            (Applied: <a href="manage.php#JobReferenceNumber">manage.php</a>)
                        </p>
                        
                    </section>
                </section>
            </section>
        </section>
        </section>
        </section>

        <section class="googlemap">
            <section id="googlemap">
                <h2 class="title"> Selecting and Sorting</h2>
                <section class="map-sum">
                Enable the manager to select a specific field for sorting the EOI records, determining the order in which they are displayed. This functionality allows the manager to organize the records based on different criteria such as EOI number, first name, last name, gender, state, or postcode. The sorting can be done in either ascending or descending order, providing flexibility in how the data is presented.
                </section>

                <section class="map">
                    <input type="checkbox" id="map">
                    <label for="map">Details</label>
                    <section class="map-text">
                        <h3>Sorting Functionality</h3>
                        <h4>
                        The functionality for sorting database queries when searching for EOIs includes the following features:  
                        </h4>

                        <ul class="sorting">
                            <li>Criteria Selection</li>
                                <ul class = "criteria">
                                    <li>EOI number</li>
                                    <li>Firstname</li>
                                    <li>Lastname</li>
                                    <li>Gender</li>
                                    <li>State</li>
                                    <li>Postcode</li>
                                </ul>
                                <br/>
                            <li>Order Selection</li>
                                <ul class = "criteria">
                                    <li>Ascending</li>
                                    <li>Descending</li>
                                </ul>
                        </ul>

                        <p>
                        <img src="styles/images/enhancement1.png" alt="Sort enhacement">
                        <br/><br/>
                            (Applied: <a href="manage.php#firstname_search">manage.php</a>)
                        </p>

                    </section>
                </section>
            </section>
        </section>

        <?php include 'footer.inc'; ?>

    </body>

</php>
