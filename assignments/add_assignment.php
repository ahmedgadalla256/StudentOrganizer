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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Assignment</title>
    <script src="https://kit.fontawesome.com/daa62b2e1b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="page-shell">

    <div class="card-theme">

        <div class="card-theme-header header-success">
            <i class="fa-solid fa-plus"></i>
            <h3>Add New Assignment</h3>
        </div>

        <div class="card-theme-body">

            <form method="POST">

                <div class="field-group">
                    <label>Assignment Title</label>
                    <input type="text" name="title" class="field-input" required>
                </div>

                <div class="field-group">
                    <label>Course Code</label>
                    <input type="text" name="course_code" class="field-input" required>
                </div>

                <div class="field-group">
                    <label>Due Date</label>
                    <input type="date" name="due_date" class="field-input" required>
                </div>

                <div class="field-group">
                    <label>Created At</label>
                    <input type="date" name="created_at" class="field-input" required>
                </div>

                <div class="field-group">
                    <label>Notes</label>
                    <textarea name="note" class="field-input" rows="4"></textarea>
                </div>

                <div class="btn-row">
                    <button type="submit" class="btn-theme btn-theme-success">
                        Add Assignment
                    </button>

                    <a href="assignments.php" class="btn-theme btn-theme-secondary">
                        Cancel
                    </a>
                </div>

            </form>

        </div>

    </div>

</div>

</body>

</html>
