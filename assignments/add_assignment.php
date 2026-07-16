<?php
session_start();
require_once '../config/studentdb.inc.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$message = NULL;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION["user_id"];
    $title = trim($_POST["title"]);
    $course_code = trim($_POST["course_code"]);
    $due_date = trim($_POST["due_date"]);
    $created_at = trim($_POST["created_at"]);
    $note = trim($_POST["note"]);

    $query = $conn->prepare("INSERT INTO assignments (user_id, title, course_code, due_date, created_at, note) VALUES (?, ?, ?, ?, ?, ?)");

    $query->execute([
        $user_id,
        $title,
        $course_code,
        $due_date,
        $created_at,
        $note,
    ]);

    header("Location: assignments.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Assignment</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-success text-white">
            <h3>Add New Assignment</h3>
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label>Assignment Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Course Code</label>
                    <input type="text" name="course_code" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Due Date</label>
                    <input type="date" name="due_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Created At</label>
                    <input type="date" name="created_at" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Notes</label>
                    <textarea name="note" class="form-control" rows="4"></textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    Add Assignment
                </button>

                <a href="assignments.php" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

</body>

</html>