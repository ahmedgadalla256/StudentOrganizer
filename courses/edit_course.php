<?php
session_start();
require_once("../config/studentdb.inc.php");

if (!isset($_SESSION["user_id"])) {
    header ("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

if(!isset($_GET["id"])) {
    header("Location: courses.php");
    exit();
}

$id = $_GET["id"];

$query = $conn ->prepare("SELECT * FROM courses WHERE id =? AND user_id = ? ");
$query -> execute([$id, $user_id]);

$course = $query -> fetch(PDO::FETCH_ASSOC);

if(!$course) {
    header("Location: courses.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $course_name = trim($_POST["course_name"]);
    $course_code = trim($_POST["course_code"]);
    $instructor = trim($_POST["instructor"]);
    $classroom = trim($_POST["classroom"]);
    $day = trim($_POST["day"]);
    $course_time = trim($_POST["course_time"]);
    $semester = trim($_POST["semester"]);
    $credit_hours = trim($_POST["credit_hours"]);
    $notes = trim($_POST["notes"]);

    $update = $conn->prepare("UPDATE courses SET course_name = ?, course_code = ?, instructor = ?, classroom = ?, day = ?, course_time = ?, semester = ?, credit_hours = ?, notes = ? WHERE id = ? AND user_id = ?");

    $update-> execute([
        $course_name,
        $course_code,
        $instructor,
        $classroom,
        $day,
        $course_time,
        $semester,
        $credit_hours,
        $notes,
        $id,
        $user_id
    ]);

    header("Location: courses.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Course</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-warning">
            <h3>Edit Course</h3>
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label>Course Name</label>
                    <input type="text" name="course_name" class="form-control"
                           value="<?php echo $course['course_name']; ?>" required>
                </div>

                <div class="mb-3">
                    <label>Course Code</label>
                    <input type="text" name="course_code" class="form-control"
                           value="<?php echo $course['course_code']; ?>" required>
                </div>

                <div class="mb-3">
                    <label>Instructor</label>
                    <input type="text" name="instructor" class="form-control"
                           value="<?php echo $course['instructor']; ?>">
                </div>

                <div class="mb-3">
                    <label>Classroom</label>
                    <input type="text" name="classroom" class="form-control"
                           value="<?php echo $course['classroom']; ?>">
                </div>

                <div class="mb-3">
                    <label>Day</label>
                    <input type="text" name="day" class="form-control"
                           value="<?php echo $course['day']; ?>">
                </div>

                <div class="mb-3">
                    <label>Course Time</label>
                    <input type="time" name="course_time" class="form-control"
                           value="<?php echo $course['course_time']; ?>">
                </div>

                <div class="mb-3">
                    <label>Semester</label>
                    <input type="text" name="semester" class="form-control"
                           value="<?php echo $course['semester']; ?>">
                </div>

                <div class="mb-3">
                    <label>Credit Hours</label>
                    <input type="number" name="credit_hours" class="form-control"
                           value="<?php echo $course['credit_hours']; ?>">
                </div>

                <div class="mb-3">
                    <label>Notes</label>
                    <textarea name="notes" class="form-control" rows="4"><?php echo $course['notes']; ?></textarea>
                </div>

                <button type="submit" class="btn btn-warning">
                    Update Course
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