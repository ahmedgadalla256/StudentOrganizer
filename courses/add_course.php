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
    <title>Add Course</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-success text-white">
            <h3>Add New Course</h3>
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label>Course Name</label>
                    <input type="text" name="course_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Course Code</label>
                    <input type="text" name="course_code" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Instructor</label>
                    <input type="text" name="instructor" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Classroom</label>
                    <input type="text" name="classroom" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Day</label>
                    <input type="text" name="day" class="form-control" placeholder="Monday">
                </div>

                <div class="mb-3">
                    <label>Course Time</label>
                    <input type="time" name="course_time" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Semester</label>
                    <input type="text" name="semester" class="form-control" placeholder="Fall 2026">
                </div>

                <div class="mb-3">
                    <label>Credit Hours</label>
                    <input type="number" name="credit_hours" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Notes</label>
                    <textarea name="notes" class="form-control" rows="4"></textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    Save Course
                </button>

                <a href="courses.php" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

</body>

</html>