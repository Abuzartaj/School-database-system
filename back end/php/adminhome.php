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

    <aside class="nav-hide">
        <ul>
            <li><a href="addstudent.php">Add a student</a></li>
            <li><a href="addparent.php">Add a parent</a></li>
           <li> <a href="seesparent.php">See all parents</a></li>
            <li><a href="addteacher.php">Add Teacher</a></li>
            <li><a href="seeteacher.php">View Teacher</a></li>
            <li><a href="addclass.php">Add Class</a></li>
            <li><a href="viewclass.php">View Class</a></li>
        </ul>
    </aside>
    <div class="content">
        <h1>RISHTON ACADEMY</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum cumque omnis esse voluptatum consequatur quibusdam!</p>

    </div>

    <script>
        document.getElementById('toggle-nav').addEventListener('click', function() {
            document.querySelector('.nav-hide').classList.toggle('nav-show');
        });
    </script>
</body>
</html>