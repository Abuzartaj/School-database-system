<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "RISHTON";

$link = new mysqli($servername, $username, $password, $dbname);

if ($link == false) {
    die("connection error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["username"];
    $pass = $_POST["password"];
    $sql = "select * from user where username='". $name. "' AND password='". $pass. "' ";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);

    if ($row) {
        if ($row["usertype"] == "student") {
            header("location:studenthome.php");
            exit;
        } elseif ($row["usertype"] == "admin") {
            header("location:adminhome.php");
            exit;
        }
    } else {
        echo "username or password do not match";
    }
}
?>

<head>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="../css/login.css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="html/js/script.js"></script>
</head>

<body>
  <div class="simple-login-container">
    <h2>Login</h2>
    <form action="#" method="POST">
      <div class="row">
        <div class="col-md-12 form-group">
          <input type="text" class="form-control" name="username" placeholder="Username" required>
          <div class="invalid-feedback">Please enter a username.</div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 form-group">
          <input type="password" name="password" placeholder="Enter your Password" class="form-control" required>
          <div class="invalid-feedback">Please enter a password.</div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 form-group">
          <input type="submit" class="btn btn-block btn-login" value="Login">
        </div>
      </div>
    </form>
  </div>
</body>