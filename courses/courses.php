<?php

session_start();
require_once("../config/studentdb.inc.php");

if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$query = $conn -> prepare("SELECT * FROM courses WHERE user_id = ?");
$query -> execute([$user_id]);

$courses = $query-> fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>
    <title>My Courses</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">
        <h2>My Courses</h2>

        <div>
            <a href="add_course.php" class="btn btn-success">
                Add Course
            </a>

            <a href="../dashboard.php" class="btn btn-secondary">
                Dashboard
            </a>
        </div>
    </div>

    <table class="table table-bordered table-striped">

        <thead class="table-dark">

            <tr>
                <th>Course Name</th>
                <th>Course Code</th>
                <th>Instructor</th>
                <th>Classroom</th>
                <th>Day</th>
                <th>Time</th>
                <th>Semester</th>
                <th>Credits</th>
                <th>Actions</th>
            </tr>

        </thead>

        <tbody>

        <?php foreach ($courses as $course) { ?>

            <tr>

                <td><?php echo $course["course_name"]; ?></td>
                <td><?php echo $course["course_code"]; ?></td>
                <td><?php echo $course["instructor"]; ?></td>
                <td><?php echo $course["classroom"]; ?></td>
                <td><?php echo $course["day"]; ?></td>
                <td><?php echo $course["course_time"]; ?></td>
                <td><?php echo $course["semester"]; ?></td>
                <td><?php echo $course["credit_hours"]; ?></td>

                <td>

                    <a href="edit_course.php?id=<?php echo $course["id"]; ?>" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <a href="delete_course.php?id=<?php echo $course["id"]; ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete this course?')">
                        Delete
                    </a>

                </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

</body>

</html>