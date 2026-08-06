<?php

session_start();
require_once("../config/studentdb.inc.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$message = NULL;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION["user_id"];
    $course_name = trim($_POST["course_name"]);
    $course_code = trim($_POST["course_code"]);
    $instructor = trim($_POST["instructor"]);
    $classroom = trim($_POST["classroom"]);
    $day = trim($_POST["day"]);
    $course_time = trim($_POST["course_time"]);
    $semester = trim($_POST["semester"]);
    $credit_hours = trim($_POST["credit_hours"]);
    $notes = trim($_POST["notes"]);

    $query = $conn->prepare("INSERT INTO courses (user_id, course_name, course_code, instructor, classroom, day, course_time, semester, credit_hours, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $query->execute([
        $user_id,
        $course_name,
        $course_code,
        $instructor,
        $classroom,
        $day,
        $course_time,
        $semester,
        $credit_hours,
        $notes
    ]);

    header("Location: courses.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <script src="https://kit.fontawesome.com/daa62b2e1b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="page-shell">

    <div class="card-theme">

        <div class="card-theme-header header-success">
            <i class="fa-solid fa-plus"></i>
            <h3>Add New Course</h3>
        </div>

        <div class="card-theme-body">

            <form method="POST">

                <div class="field-group">
                    <label>Course Name</label>
                    <input type="text" name="course_name" class="field-input" required>
                </div>

                <div class="field-group">
                    <label>Course Code</label>
                    <input type="text" name="course_code" class="field-input" required>
                </div>

                <div class="field-group">
                    <label>Instructor</label>
                    <input type="text" name="instructor" class="field-input">
                </div>

                <div class="field-group">
                    <label>Classroom</label>
                    <input type="text" name="classroom" class="field-input">
                </div>

                <div class="field-group">
                    <label>Day</label>
                    <input type="text" name="day" class="field-input" placeholder="Monday">
                </div>

                <div class="field-group">
                    <label>Course Time</label>
                    <input type="time" name="course_time" class="field-input">
                </div>

                <div class="field-group">
                    <label>Semester</label>
                    <input type="text" name="semester" class="field-input" placeholder="Fall 2026">
                </div>

                <div class="field-group">
                    <label>Credit Hours</label>
                    <input type="number" name="credit_hours" class="field-input">
                </div>

                <div class="field-group">
                    <label>Notes</label>
                    <textarea name="notes" class="field-input" rows="4"></textarea>
                </div>

                <div class="btn-row">
                    <button type="submit" class="btn-theme btn-theme-success">
                        Save Course
                    </button>

                    <a href="courses.php" class="btn-theme btn-theme-secondary">
                        Cancel
                    </a>
                </div>

            </form>

        </div>

    </div>

</div>

</body>

</html>
