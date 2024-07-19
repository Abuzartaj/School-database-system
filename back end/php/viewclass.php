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
    echo "Connected successfully.<br>";
}

$sql = "SELECT * FROM Teacher";
$teachers = mysqli_query($link, $sql);

if (!$teachers) {
    die("SQL Error: " . mysqli_error($link));
}
?>
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

    <h3>See all classes</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Class ID</th>
                <th>Class Name</th>
                <th>Class Year</th>
                <th>Teacher Name</th>
                <th>Class Capacity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Execute the query to get class details with teacher names
            $sql = "
                SELECT Classes.ClassID, Classes.ClassName, Classes.ClassYear, Classes.ClassStrength as ClassCapacity, Teacher.Name as TeacherName
                FROM Classes
                JOIN Teacher ON Classes.TeacherID = Teacher.id
            ";
            $result = mysqli_query($link, $sql);

            // Check for errors in SQL execution
            if (!$result) {
                die("SQL Error: " . mysqli_error($link));
            }

            // Fetch the data and display in the table
            while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                    <td>{$row['ClassID']}</td>
                    <td>{$row['ClassName']}</td>
                    <td>{$row['ClassYear']}</td>
                    <td>{$row['TeacherName']}</td>
                    <td>{$row['ClassCapacity']}</td>
                    <td>
                        <a href='updateclass.php?ClassID={$row['ClassID']}' class='btn btn-primary'>Update</a>
                        <a href='deleteclass.php?ClassID={$row['ClassID']}' class='btn btn-danger' onclick='return confirm(\"Are you sure to delete this class?\");'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>

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