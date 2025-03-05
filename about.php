<!DOCTYPE php>
<php lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/style.css" rel="stylesheet">
    <title>About Us</title>
</head>

<body>

    <?php include 'header.inc'; ?>

    <p>
    <dl class="photo">
        <strong>Our Members</strong>
        <figure>

            <img src="images/groupphoto.jpg" alt="" />

            <figcaption>
                From left to right: James Hardy, Michael Adamopoulos, Uyen Giang Thai
            </figcaption>
        </figure>
    </dl>

    <dl class="name">
        <dt>Group Name:</dt>
        <dd>VitaCoder</dd>
    </dl>
    <dl class="ID">
        <dt>Group ID:</dt>
        <dd>5</dd>
    </dl>
    <dl class="tutor">
        <dt>Tutor:</dt>
        <dd>Naveed Ali</dd>
    </dl>
    <dl class="course">
        <dt>Course:</dt>
        <dd>Bachelor of Computer Science</dd>
    </dl>

    </p>


    <table border="1">
        <caption><strong><em>Our timetable:</em></strong></caption>

        <thead>
            <tr>
                <th>Time</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td class="time">9:30 AM</td>
                <td class="empty"></td>
                <td class="empty"></td>
                <td class="empty"></td>
                <td class="empty"></td>
                <td class="empty"></td>
            </tr>
            </t>
            <tr>
                <td class="time">10:30 AM</td>
                <td class="empty"></td>
                <td rowspan="2">&nbsp; Intro to Programming <br>
                    <p>Lecture</p>
                </td>
                <td rowspan="2">&nbsp; Intro to Game Studies <br>
                    <p>Class</p>
                </td>
                <td rowspan="2">&nbsp; Computer Systems <br>
                    <p>Class</p>
                </td>
                <td class="empty"></td>
            </tr>
            <tr>
                <td class="time">11:30 AM</td>

            </tr>
            <tr>
                <td class="time">12:30 PM</td>
                <td>&nbsp; Inquiry Project <p>Live Online</p>
                </td>
                <td class="empty"></td>
                <td class="empty"></td>
                <td class="empty"></td>
                <td class="empty"></td>
            </tr>
            <tr>
                <td class="time">1:30 PM</td>
                <td class="empty"></td>
                <td>&nbsp; Inquiry Project <p>Class</p>
                </td>
                <td class="empty"></td>
                <td class="empty"></td>
                <td class="empty"></td>
            </tr>
            <tr>
                <td class="time">2:30 PM</td>
                <td class="empty"></td>
                <td rowspan="2">&nbsp; Inquiry Project <br>
                    <p>Workshop</p>
                </td>
                <td rowspan="2">&nbsp; Intro to Programming <br>
                    <p>Class</p>
                </td>
                <td class="empty"></td>
                <td class="empty"></td>
            </tr>
            <tr>
                <td class="time">3:30 PM</td>
                <td class="empty"></td>
                <td class="empty"></td>
            </tr>
            <tr>
                <td class="time">4:30 PM</td>
                <td class="empty"></td>
                <td class="empty"></td>
                <td class="empty"></td>
                <td class="empty"></td>
                <td rowspan="2">&nbsp; Computer Systems <br>
                    <p> Live Online</p>
                </td>
            </tr>
            <tr>
                <td class="time">5:30 PM</td>
                <td class="empty"></td>
                <td class="empty"></td>
                <td class="empty"></td>
                <td class="empty"></td>
            </tr>
            <tr>
                <td class="time">6:30 PM</td>
                <td rowspan="2">&nbsp; Intro to Game Studies <br>
                    <p>Lecture</p>
                </td>
                <td class="empty"></td>
                <td class="empty"></td>
                <td class="empty"></td>
                <td class="empty"></td>
            </tr>
            <tr>
                <td class="time">7:30 PM</td>
                <td class="empty"></td>
                <td class="empty"></td>
                <td class="empty"></td>
                <td class="empty"></td>
            </tr>
            <tr>
                <td class="time">8:30 PM</td>
                <td class="empty"></td>
                <td class="empty"></td>
                <td class="empty"></td>
                <td class="empty"></td>
                <td class="empty"></td>
            </tr>
        </tbody>
    </table>
    </p>



    <ul class="student-email">
        <p>Feel free to contact us:</p>
        <li><a href="mailto:104828510@student.swin.edu.au">Uyen Giang Thai</a></li><br>
        <li><a href="mailto:105338010@student.swin.edu.au">Michael Adamopoulos</a></li><br>
        <li><a href="mailto:105034253@student.swin.edu.au">James Hardy</a></li>
    </ul>

    <?php include 'footer.inc'; ?>

</body>

</php>