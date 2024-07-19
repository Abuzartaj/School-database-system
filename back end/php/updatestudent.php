<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/updatestudent.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/student.css">  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>






</head>
<body>
    <header class="header">
        <a href="#" id="toggle-nav">ADMIN Dashboard</a>
        <div class="logout">
            <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </header>
     <aside class="nav-hide">
        <ul>
        <li><a href="adminhome.php">Adminhome</a></li>
            <li><a href="addstudent.php">Add a student</a></li>
            <li><a href="seestudent.php">See all students</a></li>
            <li><a href="updatestudent.php">Update a Student</a></li>
            <li><a href="addparent.php">Add a parent</a></li>
           <li> <a href="seesparent.php">See all parents</a></li>
            <li><a href="addteacher.php">Add Teacher</a></li>
            <li><a href="seeteacher.php">View Teacher</a></li>
            <li><a href="addclass.php">Add Class</a></li>
            <li><a href="viewclass.php">View Course</a></li>
        </ul>
    </aside>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

        <h3>Select Student to update:</h3>
        <label>Select Student </label>
        <select name="StudentID">
            <?php
            // Database connection details
            $servername = "localhost";
            $username = "root";
            $password = "password";
            $dbname = "RISHTON";

            // Create connection
            $link = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($link->connect_error) {
                die("Connection failed: ". $link->connect_error);
            }

            // Fetch students from the database
            $sql = $link->query("SELECT StudentID, StudentName FROM Students");
            while ($row = $sql->fetch_assoc()) {
                echo "<option value='{$row['StudentID']}'>{$row['StudentName']}</option>";
            }
            ?>
        </select>
        <br><br>

        <label>New Student Name:</label>
        <input type="text" name="newStudentName">
        <br><br>

        <label>New Student Address:</label>
        <input type="text" name="newStudentAddress">
        <br><br>

        <label>New Student Post Code:</label>
        <input type="text" name="newStudentPostCode">
        <br><br>

        <label>New Student City:</label>
        <input type="text" name="newStudentCity">
        <br><br>

        <label>New Student Email:</label>
        <input type="email" name="newStudentEmail">
        <br><br>

        <input type="submit" name="submit" value="Update Student">
    </form>

    <?php
    // Form submission handling
    if (isset($_POST['submit'])) {
        $studentID = $_POST['StudentID'];
        $newStudentName = $_POST['newStudentName'];
        $newStudentAddress = $_POST['newStudentAddress'];
        $newStudentPostCode = $_POST['newStudentPostCode'];
        $newStudentCity = $_POST['newStudentCity'];
        $newStudentEmail = $_POST['newStudentEmail'];

        // SQL Update Query to update the selected student's details
        $sql = "UPDATE Students SET 
                StudentName = '$newStudentName', 
                StudentHomeAddress = '$newStudentAddress',
                StudentPostCode = '$newStudentPostCode',
                StudentCity = '$newStudentCity',
                StudentEmailAddress = '$newStudentEmail'
                WHERE StudentID = '$studentID'";

        if ($link->query($sql) === TRUE) {
            echo "Record updated successfully.<br>";
        } else {
            echo "Error updating record: ". $link->error. "<br>";
        }
    }
    // Close the database connection
    $link->close();
    ?>
    <script>
        document.getElementById('toggle-nav').addEventListener('click', function() {
            document.querySelector('.nav-hide').classList.toggle('nav-show');
        });
    </script>
</body>
</html>


