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

// Check if ParentID is provided in the URL
if (isset($_GET['ParentID'])) {
    $parentID = $_GET['ParentID'];

    // SQL query to delete parent
    $sql = "DELETE FROM Parents WHERE ParentID = '$parentID'";

    if (mysqli_query($link, $sql)) {
        // Redirect back to seesparent.php after successful deletion
        header("Location: seesparent.php");
        exit(); // Ensure script stops here to prevent further execution
    } else {
        echo "Error deleting parent: " . mysqli_error($link) . "<br>";
    }
} else {
    echo "ParentID not provided. Unable to delete.<br>";
}

// Close the database connection
mysqli_close($link);
?>
