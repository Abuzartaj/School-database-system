<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link rel="stylesheet" type="text/css" href="css/admin.css"> 
<link rel="stylesheet" type="text/css" href="css/student.css"> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            <li><a href="addparent.php">Add a parent</a></li>
            <li><a href="seesparent.php">See all parents</a></li>
            <li><a href="addteacher.php">Add Teacher</a></li>
            <li><a href="seeteacher.php">View Teacher</a></li>
            <li><a href="addclass.php">Add Class</a></li>
            <li><a href="viewclass.php">View Class</a></li>
        </ul>
    </aside>
<h1>See all Students</h1>
 
<table class="table">
<thead>
<tr>
<th>Student ID</th>
<th>Student Name</th>
<th>Student Email</th>
<th>Home Address</th>
<th>Post Code</th>
<th>City</th>
<th>Parent Name</th> 
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$link = mysqli_connect("localhost", "root", "password", "RISHTON");
if ($link === false) {
    die("Connection failed: " . mysqli_connect_error());
}
 
$sql = "SELECT 
            s.StudentID, 
            s.StudentName, 
            s.StudentEmailAddress, 
            s.StudentHomeAddress, 
            s.StudentPostCode, 
            s.StudentCity, 
            p.ParentName 
        FROM Students s
        JOIN Parents p ON s.ParentID = p.ParentID"; // Join with Parents table
 
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "
<tr>
<td>{$row['StudentID']}</td>
<td>{$row['StudentName']}</td>
<td>{$row['StudentEmailAddress']}</td>
<td>{$row['StudentHomeAddress']}</td>
<td>{$row['StudentPostCode']}</td>
<td>{$row['StudentCity']}</td>
<td>{$row['ParentName']}</td> <!-- Display Parent Name -->
<td><button onclick='deleteStudent({$row['StudentID']})' class='btn btn-danger btn-delete'>Delete</button></td>
</tr>";
    }
} else {
    echo "<tr><td colspan='8'>No students found</td></tr>";
}

mysqli_close($link);
?>
</tbody>
</table>
 
<script>
document.getElementById('toggle-nav').addEventListener('click', function() {
    document.querySelector('.nav-hide').classList.toggle('nav-show');
});

function deleteStudent(studentID) {
    if (confirm("Are you sure you want to delete student with ID " + studentID + "?")) {
        // AJAX request
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // On success, reload the table or update it as needed
                location.reload(); // Refresh the page for simplicity, can be optimized
            }
        };
        xhttp.open("GET", "deletestudent.php?id=" + studentID, true);
        xhttp.send();
    }
}
</script>
</body>
</html>
