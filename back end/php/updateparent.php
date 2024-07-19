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
    die("Connection failed: " . $link->connect_error);
}

// Initialize variables
$parentID = null;
$newParentName = "";
$newParentPhoneNumber = "";
$newParentEmailAddress = "";
$newAddress = "";
$newGender = "";

// Check if ParentID is passed via URL
if (isset($_GET['ParentID'])) {
    $parentID = $_GET['ParentID'];

    // Fetch parent details based on ParentID
    $sql = "SELECT ParentName, ParentPhoneNumber, ParentEmailAddress, Address, Gender FROM Parents WHERE ParentID = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $parentID);
    $stmt->execute();
    $stmt->bind_result($parentName, $parentPhoneNumber, $parentEmailAddress, $address, $gender);
    $stmt->fetch();

    // Assign fetched values to variables
    $newParentName = $parentName;
    $newParentPhoneNumber = $parentPhoneNumber;
    $newParentEmailAddress = $parentEmailAddress;
    $newAddress = $address;
    $newGender = $gender;

    // Close statement
    $stmt->close();
}

// Form submission handling
if (isset($_POST['submit'])) {
    $parentID = $_POST['parentID'];
    $newParentName = $_POST['newParentName'];
    $newParentPhoneNumber = $_POST['newParentPhoneNumber'];
    $newParentEmailAddress = $_POST['newParentEmailAddress'];
    $newAddress = $_POST['newAddress'];
    $newGender = $_POST['newGender'];

    // Prepare and bind SQL Update Query to update the selected parent's information
    $sql = "UPDATE Parents 
            SET ParentName = ?, 
                ParentPhoneNumber = ?, 
                ParentEmailAddress = ?, 
                Address = ?, 
                Gender = ?
            WHERE ParentID = ?";

    $stmt = $link->prepare($sql);
    $stmt->bind_param("sssssi", $newParentName, $newParentPhoneNumber, $newParentEmailAddress, $newAddress, $newGender, $parentID);

    if ($stmt->execute()) {
        echo "Record updated successfully.<br>";
    } else {
        echo "Error updating record: " . $stmt->error . "<br>";
    }

    // Close statement
    $stmt->close();
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

    <h3>Update Parent Information</h3>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="hidden" name="parentID" value="<?php echo $parentID; ?>">
        
        <label>Parent Name:</label>
        <input type="text" name="newParentName" value="<?php echo $newParentName; ?>">
        <br><br>

        <label>Parent Phone Number:</label>
        <input type="tel" name="newParentPhoneNumber" pattern="[0-9]{11}" value="<?php echo $newParentPhoneNumber; ?>">
        <br><br>

        <label>Parent Email Address:</label>
        <input type="email" name="newParentEmailAddress" value="<?php echo $newParentEmailAddress; ?>">
        <br><br>

        <label>Address:</label>
        <input type="text" name="newAddress" value="<?php echo $newAddress; ?>">
        <br><br>

        <label>Gender:</label>
        <select name="newGender">
            <option value="Male" <?php if ($newGender === 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($newGender === 'Female') echo 'selected'; ?>>Female</option>
            <option value="Other" <?php if ($newGender === 'Other') echo 'selected'; ?>>Other</option>
        </select>
        <br><br>

        <input type="submit" name="submit" value="Update Parent">
    </form>

    <script>
        document.getElementById('toggle-nav').addEventListener('click', function() {
            document.querySelector('.nav-hide').classList.toggle('nav-show');
        });
    </script>
</body>
</html>
