<?php
session_start();

if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3>Student Organizer Dashboard</h3>
        </div>

        <div class="card-body">

            <h4>Welcome, <?php echo $_SESSION["full_name"]; ?>!</h4>

            <p>You have successfully logged in.</p>

            <hr>

            <div class="d-grid gap-2">

                <a href="courses/courses.php" class="btn btn-success">
                    Manage Courses
                </a>

                <a href="auth/logout.php" class="btn btn-danger">
                    Logout
                </a>

            </div>

        </div>

    </div>

</div>

</body>

</html>