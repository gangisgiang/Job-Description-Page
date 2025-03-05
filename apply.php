<!DOCTYPE php>
<php lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="styles/style.css" rel="stylesheet" />
  <title>Application</title>
</head>

<body>
  <?php include 'header.inc'; ?>


    <h1 class="h1"> Application Form </h1>
      <div class="table">
          <div class="apply">

          
          <form action="processEOI.php" method="post" novalidate="novalidate">
                  <label for="reference">Job Reference Number:</label><br>
                      <input type="text" id="reference" name="reference" pattern="[a-zA-Z0-9]{5}" minlength="5" maxlength="5" required
                        placeholder="ex: VT284, VT126"><br>

                  <label for="firstname">First Name:</label><br>
                    <input type="text" id="firstname" name="firstname" pattern="^[a-zA-Z\s\-]+$" maxlength="20" required><br>

                  <label for="lastname">Last Name:</label><br>
                    <input type="text" id="lastname" name="lastname" pattern="^[a-zA-Z\s\-]+$" maxlength="20" required><br>

                  <label for="birth">Date of Birth:</label><br>
                    <input type="date" id="birth" name="birth" required><br>

                  <fieldset>
                    <legend>Gender:</legend>
                      <label><input type="radio" name="gender" value="male" unchecked required> Male</label><br>
                      <label><input type="radio" name="gender" value="female" unchecked required> Female</label><br>
                      <label><input type="radio" name="gender" value="other" unchecked required> Other</label><br>
                      <label><input type="radio" name="gender" value="prefernottosay" checked required> Prefer not to say</label><br>
                  </fieldset>
                  <br/>

                  <label for="address">Street Address:</label><br>
                  <input type="text" id="address" name="address" maxlength="40" required><br>

                  <label for="suburb">Suburb/Town:</label><br>
                  <input type="text" id="suburb" name="suburb" maxlength="40" required><br>

                  <label for="state">State:</label><br>
                  <select id="state" name="state" required>
                    <option value="VIC" selected>VIC</option>
                    <option value="NSW">NSW</option>
                    <option value="QLD">QLD</option>
                    <option value="NT">NT</option>
                    <option value="WA">WA</option>
                    <option value="SA">SA</option>
                    <option value="TAS">TAS</option>
                    <option value="ACT">ACT</option>
                  </select><br>

                  <label for="postcode">Postcode:</label><br>
                    <input type="text" inputmode="numeric" id="postcode" name="postcode" pattern="[0-9]{4}" minlength="4"
                        maxlength="4" required placeholder="ex: 3000, 3125"><br>

                  <label for="email">Email Address:</label><br>
                    <input type="email" id="email" name="email" required><br>

                  <label for="phone">Phone Number:</label><br>
                    <input type="tel" inputmode="numeric" id="phone" name="phone" minlength="8" maxlength="12"
                      pattern="[0-9\s]{8,12}" required>

                  <fieldset>
                    <legend>Skills</legend>
                    
                    <label for="py">
                      <input type="checkbox" name="skills[]" id="py" value="Python" checked> Python
                    </label>
                                          
                    <label for="js">
                      <input type="checkbox" name="skills[]" id="js" value="JavaScript"> JavaScript
                    </label>

                    
                    <label for="rb">
                    <input type="checkbox" name="skills[]" id="rb" value="Ruby"> Ruby
                    </label>

                    
                    <label for="c">
                    <input type="checkbox" name="skills[]" id="c" value="C"> C/C++/C#
                    </label>
                    
                    
                    <label for="other">
                    <input type="checkbox" name="other_skills_cbox" value="other" id="other"> Other skills...
                    <textarea id="other_skills" name="other_skills_tarea" rows="4" cols="50" placeholder="ex: communication, problem-solving, time-management..."></textarea>
                    </label>
                  </fieldset>

                  <div class="button-container">
                      <input type="submit" value="Apply">
                  </div>
                </form>
          </div>
        </div>

        <?php include 'footer.inc'; ?>
        
</body>

</php>