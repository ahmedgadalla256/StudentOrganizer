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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://kit.fontawesome.com/daa62b2e1b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="page-shell">

    <div class="card-theme">

        <div class="card-theme-header">
            <i class="fa-solid fa-graduation-cap"></i>
            <h3>Student Organizer Dashboard</h3>
        </div>

        <div class="card-theme-body">

            <h4 style="margin-top:0;">Welcome, <?php echo $_SESSION["full_name"]; ?>!</h4>
            <p style="color: var(--slate);">You have successfully logged in.</p>

            <hr style="border: none; border-top: 1px solid rgba(122,122,125,0.25); margin: 22px 0;">

            <div class="btn-stack">

                <a href="profile.php" class="btn-theme">
                    <i class="fa-solid fa-user"></i>&nbsp; Account
                </a>
                <a href="courses/courses.php" class="btn-theme btn-theme-success">
                    <i class="fa-solid fa-book"></i>&nbsp; Manage Courses
                </a>
                <a href="assignments/assignments.php" class="btn-theme" style="background-color: var(--info);">
                    <i class="fa-solid fa-list-check"></i>&nbsp; Manage Assignments
                </a>
                <a href="auth/logout.php" class="btn-theme btn-theme-danger">
                    <i class="fa-solid fa-right-from-bracket"></i>&nbsp; Logout
                </a>
            </div>

        </div>

    </div>

</div>

</body>

</html>
