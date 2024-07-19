<?php
session_start();

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

if (isset($_GET['ClassID'])) {
    $ClassID = $_GET['ClassID'];

    // Get the current details of the class
    $sql = "SELECT * FROM Classes WHERE ClassID = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $ClassID);
    $stmt->execute();
    $result = $stmt->get_result();
    $class = $result->fetch_assoc();

    // Get the list of teachers
    $sql = "SELECT * FROM Teacher";
    $teachers = mysqli_query($link, $sql);
} else {
    echo "ClassID not provided.";
    exit();
}

if (isset($_POST['submit'])) {
    $ClassName = $_POST['ClassName'];
    $ClassYear = $_POST['ClassYear'];
    $TeacherID = $_POST['TeacherID'];
    $ClassStrength = $_POST['ClassCapacity'];

    // Update the class details
    $sql = "UPDATE Classes SET ClassName = ?, ClassYear = ?, TeacherID = ?, ClassStrength = ? WHERE ClassID = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("siisi", $ClassName, $ClassYear, $TeacherID, $ClassStrength, $ClassID);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Class updated successfully.";
        header("Location: " . $_SERVER['PHP_SELF'] . "?ClassID=" . $ClassID);
        exit();
    } else {
        echo "Error updating class: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Class</title>
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
            <li><a href="addparent.php">Add a parent</a></li>
            <li><a href="seesparent.php">See all parents</a></li>
            <li><a href="seestudent.php">See all students</a></li>
            <li><a href="addteacher.php">Add Teacher</a></li>
            <li><a href="seeteacher.php">View Teacher</a></li>
            <li><a href="addclass.php">Add Class</a></li>
            <li><a href="viewclass.php">View Class</a></li>
        </ul>
    </aside>

    <hr>

    <h3>Update Class</h3>

    <?php
    if (isset($_SESSION['success_message'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
        unset($_SESSION['success_message']);
    }
    ?>

    <form method="post" action="">
        <label>Class Name:</label>
        <input type="text" name="ClassName" value="<?php echo $class['ClassName']; ?>" required>
        <label for="ClassYear">Class Year:</label>
        <input type="number" id="ClassYear" name="ClassYear" value="<?php echo $class['ClassYear']; ?>" required>
        <label for="ClassCapacity">Class Capacity:</label>
        <input type="number" id="ClassCapacity" name="ClassCapacity" value="<?php echo $class['ClassStrength']; ?>" required>
        <br><br>
        <label>Select Teacher:</label>
        <select class="form-select" id="teacher" name="TeacherID" required>
            <option value="" disabled>Select a teacher</option>
            <?php while ($teacher = $teachers->fetch_assoc()) { ?>
                <option value="<?php echo $teacher['id']; ?>" <?php if ($teacher['id'] == $class['TeacherID']) echo 'selected'; ?>><?php echo $teacher['Name']; ?></option>
            <?php } ?>
        </select>
        <input type="submit" name="submit" class="btn btn-primary" value="Update Class">
    </form>

    <?php
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

