<?php
error_reporting(E_ALL);

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

// Fetch all teachers
$sql = "SELECT * FROM Teacher";
$result = $link->query($sql);

// Handle delete operation
if (isset($_GET['teacher_id'])) {
    $teacher_id = $_GET['teacher_id'];

    // Prepare and execute delete statement
    $sql_delete = "DELETE FROM Teacher WHERE id=?";
    $stmt = $link->prepare($sql_delete);
    $stmt->bind_param("i", $teacher_id);

    if ($stmt->execute()) {
        // Redirect to this page after successful delete
        header('Location: seeteacher.php');
        exit;
    } else {
        echo "Error deleting record: " . $link->error;
    }

    $stmt->close();
}

$link->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="stylesheet" href="css/teacher.css"> <!-- Adjusted CSS file name -->
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
            <li><a href="addparent.php">Add a parent</a></li>
           <li> <a href="seesparent.php">See all parents</a></li>

            <li><a href="addteacher.php">Add Teacher</a></li>
            <li><a href="seeteacher.php">View Teacher</a></li>
            <li><a href="addclass.php">Add Class</a></li>
            <li><a href="viewclass.php">View Class</a></li>
        </ul>
    </aside>
    <div class="content1">
        <center>
            <h1>View TEACHER</h1>
            <div>
                <table>
                    <tr>
                        <th class="table_th">Teacher Name</th>
                        <th class="table_th">Subject</th>
                        <th class="table_th">PROFILE PHOTO</th>
                        <th class="table_th">DELETE</th>
                        <th class="table_th">UPDATE</th>
                    </tr>
                    <?php while ($info = $result->fetch_assoc()) { ?>
                    <tr>
                        <td class="table_td"><?php echo $info['Name']; ?></td>
                        <td class="table_td"><?php echo $info['Subject']; ?></td>
                        <td class="table_td">
                            <img src="./uploads/<?php echo $info['Image']; ?>" alt="Teacher Image" width="100">
                        </td>             
                        <td class="table_td">
                            <a onclick="return confirm('ARE YOU SURE TO DELETE THIS?');" class="btn btn-danger" href="seeteacher.php?teacher_id=<?= $info['id'] ?>">DELETE</a>
                        </td> 
                        <td class="table_td">
                            <a href="updateteacher.php?teacher_id=<?= $info['id'] ?>" class="btn btn-primary">Update</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </center>
    </div>

    <script>
        document.getElementById('toggle-nav').addEventListener('click', function() {
            document.querySelector('.nav-hide').classList.toggle('nav-show');
        });
    </script>
</body>
</html>



