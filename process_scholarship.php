<!-- PHP Chapter 4 example exercise -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Form</title>
</head>
<body>
    <?php
        // definition of the DisplayRequired() function
        function displayRequired($fieldName) {
            echo "<p style='color:red;'>The Field \"$fieldName\" is required!<p/>";
        }

        // definition of validateInput() function
        function validateInput($data, $fieldName) {
            global $errorCount;
            if(empty($data)) {
                // this is when the form field is empty
                displayRequired($fieldName);
                ++$errorCount;
                $retval = "";
            } else {
                // clean up the input when it is not empty
                $retval = trim($data);
                $retval = stripslashes($retval);
            }
            return $retval;
        } // end of function

        // definition of the redisplayForm() function
        function redisplayForm($firstName, $lastName) {
            ?>
            <h2 style ="text-align: center;">Scholarship Form</h2>
            <form name="scholarship" action="process_scholarship.php" method="post">
                <label for="fName">First Name:</label>
                <input type="text" name="fName" id="fName" value="<?php echo $firstName;?>"/>
                <br/>
                <br/>
                <label for="lName">Last Name:</label>
                <input type="text" name="lName" id="lName" value="<?php echo $lastName;?>"/>
                <p><input type="reset" value="Clear Form" />&nbsp;&nbsp;<input type="submit" name="Submit" value="Send Form" /></p>
            </form>

        <?php
        }

        $errorCount = 0;
        // Access data from the $_POST autoglobal array
        $firstName = validateInput($_POST["fName"], "First Name");
        $lastName = validateInput($_POST["lName"], "Last Name");
        
        // Either output the confirmation or explanation
        if($errorCount > 0) {
            echo "<p>Please re-enter the missing information below.</p>";
            redisplayForm($firstName, $lastName);
        } else {
            echo "Thank you for filling out the scholarship form, $firstName $lastName!";
        }
    ?>
    
</body>
</html>