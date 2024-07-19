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

// Create database if it does not exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
$link->query($sql);

// Select the database
$link->select_db($dbname);

// SQL to create the Parents table if it does not exist
$sql = "CREATE TABLE IF NOT EXISTS Parents (
    ParentID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ParentName VARCHAR(50) NOT NULL,
    ParentPhoneNumber VARCHAR(12) NOT NULL,
    ParentEmailAddress VARCHAR(100) NOT NULL,
    Address VARCHAR(100) NOT NULL,
    Gender VARCHAR(10) NOT NULL
)";
$link->query($sql);

// Handle form submission for adding a new parent
if (isset($_POST['submit'])) {
    $ParentName = $_POST['ParentName'];
    $ParentPhoneNumber = $_POST['ParentPhoneNumber'];
    $ParentEmailAddress = $_POST['ParentEmailAddress'];
    $Address = $_POST['Address'];
    $Gender = $_POST['Gender'];

    // Validate the input data
    if (empty($ParentName) || empty($ParentPhoneNumber) || empty($ParentEmailAddress) || empty($Address) || empty($Gender)) {
        die("Please fill in all the fields.");
    }

    // Prepare and bind the SQL Insert Query
    $sql = "INSERT INTO Parents (ParentName, ParentPhoneNumber, ParentEmailAddress, Address, Gender) VALUES (?, ?, ?, ?, ?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("sssss", $ParentName, $ParentPhoneNumber, $ParentEmailAddress, $Address, $Gender);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "New record created successfully";
    } else {
        die("Error adding record: " . $stmt->error);
    }
}

// Close the database connection
$link->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="stylesheet" type="text/css" href="css/parent.css">

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
          <li>  <a href="addparent.php">Add a parent</a></li>
          <li>  <a href="seesparent.php">See all parents</a></li>
            <li><a href="addteacher.php">Add Teacher</a></li>
            <li><a href="seeteacher.php">View Teacher</a></li>
            <li><a href="addclass.php">Add Class</a></li>
            <li><a href="viewclass.php">View Class</a></li>
        </ul>
    </aside>
    <hr>

    <h3>Add a new parent</h3>
    <form method="post" action="addparent.php">
        <label>Parent Name:</label>
        <input type="text" name="ParentName" required>
        <br><br>
        <label>Parent Phone Number:</label>
        <input type="tel" name="ParentPhoneNumber" pattern="[0-9]{11}" required>
        <br><br>
        <label>Parent Email Address:</label>
        <input type="email" name="ParentEmailAddress" required>
        <br><br>
        <label>Parent Address:</label>
        <input type="text" name="Address" required>
        <br><br>
        <label>Parent Gender:</label>
        <select name="Gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
        <br><br>
        <input type="submit" name="submit">
    </form>

    <hr>

    <script>
        document.getElementById('toggle-nav').addEventListener('click', function() {
            document.querySelector('.nav-hide').classList.toggle('nav-show');
        });
    </script>
</body>
</html>
