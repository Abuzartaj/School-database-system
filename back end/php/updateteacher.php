
 
 
<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "RISHTON";

$link = new mysqli($servername, $username, $password, $dbname);

if (isset($_GET['teacher_id'])) {
    $id = $_GET['teacher_id'];
    $sql = "SELECT * FROM Teacher WHERE id = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $teacher = $result->fetch_assoc();
    $stmt->close();
}

if (isset($_POST['update_teacher'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $imageNewName = $teacher['Image']; // Default to current image

    if ($_FILES['image']['name']) {
        $image = $_FILES['image'];
        $imageName = $image['name'];
        $imageTmpName = $image['tmp_name'];
        $imageSize = $image['size'];
        $imageError = $image['error'];
        $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        $allowed = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($imageExt, $allowed)) {
            if ($imageError === 0) {
                if ($imageSize < 100000000) {
                    $imageNewName = uniqid('', true) . "." . $imageExt;
                    $imageDestination = 'uploads/' . $imageNewName;
                    move_uploaded_file($imageTmpName, $imageDestination);
                } else {
                    echo "Your file is too big!";
                }
            } else {
                echo "There was an error uploading your image!";
            }
        } else {
            echo "You cannot upload files of this type!";
        }
    }

    $sql = "UPDATE Teacher SET name=?, subject=?, image=? WHERE id=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("sssi", $name, $subject, $imageNewName, $id);
    if ($stmt->execute()) {
        header("Location: seeteacher.php");
    } else {
        echo "Error: " . $sql . "<br>" . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Teacher</title>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="stylesheet" href="css/teacher.css">
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
          <li>  <a href="addparent.php">Add a parent</a></li>
            <li><a href="seesparent.php">See all parents</a></li>
            <li><a href="addteacher.php">Add Teacher</a></li>
            <li><a href="seeteacher.php">View Teacher</a></li>
            <li><a href="addclass.php">Add Class</a></li>
            <li><a href="viewclass.php">View Course</a></li>
        </ul>
    </aside>
    <div class="content">
        <center>
            <h1>UPDATE TEACHER</h1>
            <div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $teacher['id']; ?>">
                    <div>
                        <label>Teacher Name:</label>
                        <input type="text" name="name" value="<?php echo $teacher['Name']; ?>">
                    </div>
                    <div>
                        <label>Subject:</label>
                        <input type="text" name="subject" value="<?php echo $teacher['Subject']; ?>">
                    </div>
                    <div>
                        <label>Image:</label>
                        <input type="file" name="image">
                        <img src="uploads/<?php echo $teacher['Image']; ?>" alt="Current Image" width="100">
                    </div>
                    <div>
                        <input type="submit" name="update_teacher" value="Update Teacher" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </center>
        <script>
            document.getElementById('toggle-nav').addEventListener('click', function() {
                document.querySelector('.nav-hide').classList.toggle('nav-show');
            });
        </script>
    </div>
</body>
</html>


 