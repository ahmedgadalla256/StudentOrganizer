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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title>
    <script src="https://kit.fontawesome.com/daa62b2e1b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="page-shell-wide">

    <div class="list-header">
        <h2><i class="fa-solid fa-book"></i>&nbsp; My Courses</h2>

        <div class="btn-row">
            <a href="add_course.php" class="btn-theme btn-theme-success">
                <i class="fa-solid fa-plus"></i>&nbsp; Add Course
            </a>
            <a href="../dashboard.php" class="btn-theme btn-theme-secondary">
                <i class="fa-solid fa-house"></i>&nbsp; Dashboard
            </a>
        </div>
    </div>

    <?php if (count($courses) === 0): ?>

        <div class="card-theme">
            <div class="empty-state">
                <i class="fa-solid fa-book-open"></i>
                No courses yet. Click "Add Course" to get started.
            </div>
        </div>

    <?php else: ?>

    <div class="table-shell">
        <table class="table-theme">

            <thead>
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
                        <div class="table-actions">
                            <a href="edit_course.php?id=<?php echo $course["id"]; ?>" class="btn-theme btn-theme-warning btn-theme-sm">
                                Edit
                            </a>

                            <a href="delete_course.php?id=<?php echo $course["id"]; ?>" class="btn-theme btn-theme-danger btn-theme-sm"
                               onclick="return confirm('Delete this course?')">
                                Delete
                            </a>
                        </div>
                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>
    </div>

    <?php endif; ?>

</div>

</body>

</html>
