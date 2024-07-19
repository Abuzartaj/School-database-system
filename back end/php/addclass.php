<?php 
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "RISHTON";

// Create connection
$link = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
} else {
    echo "";
}

$sql = "SELECT * FROM Teacher";
$teachers = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/admin.css">   -->
    <link rel="stylesheet" href="css/class.css">
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
            <li><a href="updatestudent.php">Update a Student</a></li>
            <li><a href="addparent.php">Add a parent</a></li>
            <li><a href="seesparent.php">See all parents</a></li>
            <li><a href="addteacher.php">Add Teacher</a></li>
            <li><a href="seeteacher.php">View Teacher</a></li>
            <li><a href="addclass.php">Add Class</a></li>
            <li><a href="viewclass.php">View Class</a></li>
        </ul>
    </aside>
    <hr>
    <h3>Add class</h3>
    <form method="post" action="addclass.php">
        <label>Class Name:</label>
        <input type="text" name="ClassName">
        <label for="ClassYear">Class Year:</label>
        <input type="number" id="ClassYear" name="ClassYear">
        <label for="ClassStrength">Class Strength:</label>
        <input type="number" id="Strength" name="ClassStrength">
        <br><br>
        <label>Select Teacher:</label>
        <select class="form-select" id="teacher" name="TeacherID">
            <option value="" disabled selected>Select a teacher</option>
            <?php while($teacher = $teachers->fetch_assoc()){ ?>
            <option value="<?php echo $teacher['id'];?>"><?php echo $teacher['Name'];?></option>
            <?php } ?>
        </select>
        <input type="submit" name="submit">
    </form>

    <?php
    // Create database if it does not exist
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($link->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error creating database: " . $link->error;
    }

    // Create table with new ClassYear column
    $sql = "CREATE TABLE IF NOT EXISTS Classes (
        ClassID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        TeacherID INT(6) UNSIGNED,
        ClassName VARCHAR(50) NOT NULL,
        ClassYear INT(4) NOT NULL,
        ClassStrength INT(6) NOT NULL,
        FOREIGN KEY (TeacherID) REFERENCES Teacher(id)
    )";

    if ($link->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error creating table: " . $link->error . "<br>";
    }

    // Handle form submission for adding a new class
    if (isset($_POST['submit'])) {
        $ClassName = $_POST['ClassName'];
        $ClassYear = $_POST['ClassYear'];
        $TeacherID = $_POST['TeacherID'];
        $ClassStrength = $_POST['ClassStrength'];

        // SQL Insert Query to add a new class
        $sql = "INSERT INTO Classes (ClassName, ClassYear, TeacherID, ClassStrength) VALUES ('$ClassName', '$ClassYear', '$TeacherID', '$ClassStrength')";
        if (mysqli_query($link, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error adding record: " . mysqli_error($link);
        }
    }

    // Close the database connection
    $link->close();
    ?>

    <hr>
    <script>
        document.getElementById('toggle-nav').addEventListener('click', function() {
            document.querySelector('.nav-hide').classList.toggle('nav-show');
        });
    </script>
</body>
</html>
