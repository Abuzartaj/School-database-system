<?php

//Array ( [name] => Image (1).jpeg [full_path] => Image (1).jpeg [type] => image/jpeg [tmp_name] => /tmp/phpLRvnW4 [error] => 0 [size] => 1698089 )

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "RISHTON";

$link = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['add_teacher'])){
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    //get image from form
    $image = $_FILES['image'];

    // get image details
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageSize = $_FILES['image']['size'];
    $imageError = $_FILES['image']['error'];
    $imageType = $_FILES['image']['type'];

    //get image extension
    $imageExt = explode('.', $imageName);
    $imageActualExt = strtolower(end($imageExt));

    //check if file is an image
    $allowed = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($imageActualExt, $allowed)){
        if ($imageError === 0) {
            if ($imageSize < 100000000) {
                // if no errors, generate new file name and save
                $imageNewName = uniqid('', true).".".$imageActualExt;
                $imageDestination = 'uploads/'.$imageNewName;
                move_uploaded_file($imageTmpName, $imageDestination);

                $sql="INSERT INTO Teacher (name,subject,image) VALUES ('{$name}','{$subject}','{$imageNewName}')";
                $result=mysqli_query($link,$sql);
                if($result) {
                    // if data is successfully saved, redirect to teacher list
                    header("Location: seeteacher.php");
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($link);
                }
            } else {
                echo "Your file is too big!";
            }
        } else {
            echo "There was an error upload image";
        }
    } else {
        echo "You cannot upload files of this type";
    }

    // $t_name=$_POST['name'];
    // $t_subject=$_POST['subject'];
    // $file=$_FILES['image']['name'];
    // $tmp_file=$_FILES['image']['tmp_name'];
    // $dst="./phpimg/".$file;
    // $dst_db="phpimg/".$file;
    // move_uploaded_file($tmp_file,$dst);
    // $sql="INSERT INTO Teacher (name,subject,image)
    // VALUES ('$t_name','$t_subject','$dst_db')";
    // $result=mysqli_query($link,$sql);
}
?>















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="stylesheet" href="css/tecaher.css">
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
          <li>  <a href="seesparent.php">See all parents</a></li>
            <li><a href="addteacher.php">Add Teacher</a></li>
            <li><a href="seeteacher.php">View Teacher</a></li>
            <li><a href="addclass.php">Add Class</a></li>
            <li><a href="viewclass.php">View Class</a></li>
        </ul>
    </aside>
    <div class="content">
        <center>
        <h1>ADD TEACHER</h1>
        <div>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
<div>
<label >Teacher Name:</label>
<input type="text" name="name">

</div>
<div>
<label >Subject</label>
<input type="text" name="subject">

</div>
<div>
<label >Image:</label>
<input type="file" name="image">

</div>
<div>

<input type="submit" name="add_teacher" value="Add Teacher" class="btn btn-primary">

</div>





</form>
            </div>



        </center>









        <script>
               document.getElementById('toggle-nav').addEventListener('click', function() {
                   document.querySelector('.nav-hide').classList.toggle('nav-show');
               });
           </script>
           </body>
           </html>















