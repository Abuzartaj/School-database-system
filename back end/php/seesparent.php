<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "RISHTON";

// Create connection
$link = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($link === false) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
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
    <ul>
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

    <h3>See all parents</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Parent ID</th>
                <th>Parent Name</th>
                <th>Parent Phone No.</th>
                <th>Parent Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Execute the query
            $sql = mysqli_query($link, "SELECT ParentID, ParentName, ParentPhoneNumber, ParentEmailAddress FROM Parents");

            // Fetch the data and display in table
            while ($row = mysqli_fetch_assoc($sql)) {
                echo "
                <tr>
                    <td>{$row['ParentID']}</td>
                    <td>{$row['ParentName']}</td>
                    <td>{$row['ParentPhoneNumber']}</td>
                    <td>{$row['ParentEmailAddress']}</td>
                    <td>
                        <a href='updateparent.php?ParentID={$row['ParentID']}' class='btn btn-primary btn-sm'>Update</a>
                        <a href='deleteparent.php?ParentID={$row['ParentID']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this parent?\")'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    // Close the database connection
    mysqli_close($link);
    ?>

<script>
        document.getElementById('toggle-nav').addEventListener('click', function() {
            document.querySelector('.nav-hide').classList.toggle('nav-show');
        });
    </script>
</body>
</html>
