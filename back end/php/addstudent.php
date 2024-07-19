<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/admin.css"> 
    <link rel="stylesheet" type="text/css" href="css/student.css"> 
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
            <li><a href="addteacher.php">Add Teacher</a></li>
            <li><a href="seeteacher.php">View Teacher</a></li>
            <li><a href="addclass.php">Add Class</a></li>
            <li><a href="viewclass.php">View Class</a></li>
            <li><a href="addparent.php">Add a parent</a></li>
            <li><a href="seesparent.php">See all parents</a></li>
        </ul>
    </aside>
    <div class="form-container">
        <h1>Add Student</h1>
        <form method="post" action="addstudent.php">
            <label>Student Name:</label>
            <input type="text" name="StudentName" required>
            <label for="email">Enter your email:</label>
            <input type="email" id="e-mail" name="StudentEmailAddress" required>
            <br><br>
            <label>Home Address:</label>
            <input type="text" name="StudentHomeAddress" required>
            <label>City:</label>
            <input type="text" name="StudentCity" required>
            <label>Post Code:</label>
            <input type="text" name="StudentPostCode" required>
            <br><br>
            <label>Select Parent:</label>
            <select name="ParentID" required>
                <?php
                // Database connection details
                $servername = "localhost";
                $username = "root";
                $password = "password";
                $dbname = "RISHTON";

                // Create connection
                $link = new mysqli($servername, $username, $password);

                // Check connection
                if ($link->connect_error) {
                    die("Connection failed: " . $link->connect_error);
                }

                // Create database if not exists
                $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
                if ($link->query($sql) !== TRUE) {
                    echo "Error creating database: " . $link->error . "<br>";
                }

                // Select the database
                $link->select_db($dbname);

                // SQL to create tables if they do not exist
                $sql = "CREATE TABLE IF NOT EXISTS Parents (
                    ParentID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    ParentName VARCHAR(50) NOT NULL
                )";

                if ($link->query($sql) !== TRUE) {
                    echo "Error creating table: " . $link->error . "<br>";
                }

                $sql = "CREATE TABLE IF NOT EXISTS Students (
                    StudentID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    StudentName VARCHAR(50) NOT NULL,
                    ParentID INT(6) UNSIGNED,
                    StudentEmailAddress VARCHAR(50) NOT NULL,
                    StudentHomeAddress VARCHAR(100) NOT NULL,
                    StudentCity VARCHAR(50) NOT NULL,
                    StudentPostCode VARCHAR(20) NOT NULL,
                    FOREIGN KEY (ParentID) REFERENCES Parents(ParentID)
                )";

                if ($link->query($sql) !== TRUE) {
                    echo "Error creating table: " . $link->error . "<br>";
                }

                // Fetch parents from the database
                $sql = $link->query("SELECT ParentID, ParentName FROM Parents");
                while ($row = $sql->fetch_assoc()) {
                    echo "<option value='{$row['ParentID']}'>{$row['ParentName']}</option>";
                }
                ?>
            </select>
            <br><br>
            <input type="submit" name="submit" value="Add Student">
        </form>

        <?php
        // Form submission handling
        if (isset($_POST['submit'])) {
            $StudentName = $_POST['StudentName'];
            $ParentID = $_POST['ParentID'];
            $StudentEmailAddress = $_POST['StudentEmailAddress'];
            $StudentHomeAddress = $_POST['StudentHomeAddress'];
            $StudentCity = $_POST['StudentCity'];
            $StudentPostCode = $_POST['StudentPostCode'];

            // SQL Insert Query to add a new student
            $sql = "INSERT INTO Students (StudentName, ParentID, StudentEmailAddress, StudentHomeAddress, StudentCity, StudentPostCode) 
                    VALUES ('$StudentName', '$ParentID', '$StudentEmailAddress', '$StudentHomeAddress', '$StudentCity', '$StudentPostCode')";

            if ($link->query($sql) === TRUE) {
                echo "New record created successfully.<br>";
            } else {
                echo "Error adding record: " . $link->error . "<br>";
            }
        }

        // Close the database connection
        $link->close();
        ?>
    </div>
    <hr>
    <script>
        document.getElementById('toggle-nav').addEventListener('click', function() {
            document.querySelector('.nav-hide').classList.toggle('nav-show');
        });
    </script>
</body>
</html>













   



 