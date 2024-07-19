<?php
// Database connection details
$link = mysqli_connect("localhost", "root", "password", "RISHTON");

// Check connection
if ($link === false) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if ClassID is set in the URL
if (isset($_GET['ClassID'])) {
    $classID = $_GET['ClassID'];

    // Prepare the delete statement
    $sql = "DELETE FROM Classes WHERE ClassID = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $classID);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the viewclass page after deletion
        header("Location: viewclass.php");
    } else {
        echo "Error deleting record: " . $link->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$link->close();
?>
