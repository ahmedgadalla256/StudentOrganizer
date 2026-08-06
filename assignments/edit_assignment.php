<?php
session_start();
require_once("../config/studentdb.inc.php");

if (!isset($_SESSION["user_id"])) {
    header ("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

if(!isset($_GET["id"])) {
    header("Location: assignments.php");
    exit();
}

$id = $_GET["id"];

$query = $conn-> prepare("SELECT * FROM assignments WHERE id =? AND user_id = ?");
$query -> execute([$id, $user_id]);
$assignment = $query -> fetch(PDO::FETCH_ASSOC);

if(!$assignment) {
    header("Location: assignments.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = trim($_POST["title"]);
    $course_code = trim($_POST["course_code"]);
    $due_date = trim($_POST["due_date"]);
    $created_at = trim($_POST["created_at"]);
    $note = trim($_POST["note"]);

    $update = $conn->prepare("UPDATE assignments SET title = ?, course_code = ?, due_date = ?, created_at = ?, note = ? WHERE id = ? AND user_id = ?");

    $update-> execute([
        $title,
        $course_code,
        $due_date,
        $created_at,
        $note,
        $id,
        $user_id
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
    <title>Edit Assignment</title>
    <script src="https://kit.fontawesome.com/daa62b2e1b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="page-shell">

    <div class="card-theme">

        <div class="card-theme-header header-warning">
            <i class="fa-solid fa-pen"></i>
            <h3>Edit Assignment</h3>
        </div>

        <div class="card-theme-body">

            <form method="POST">

                <div class="field-group">
                    <label>Assignment Title</label>
                    <input type="text" name="title" class="field-input"
                           value="<?php echo $assignment['title']; ?>" required>
                </div>

                <div class="field-group">
                    <label>Course Code</label>
                    <input type="text" name="course_code" class="field-input"
                           value="<?php echo $assignment['course_code']; ?>" required>
                </div>

                <div class="field-group">
                    <label>Due Date</label>
                    <input type="date" name="due_date" class="field-input"
                           value="<?php echo $assignment['due_date']; ?>" required>
                </div>

                <div class="field-group">
                    <label>Created At</label>
                    <input type="date" name="created_at" class="field-input"
                           value="<?php echo $assignment['created_at']; ?>" required>
                </div>

                <div class="field-group">
                    <label>Notes</label>
                    <textarea name="note" class="field-input" rows="4"><?php echo $assignment['note']; ?></textarea>
                </div>

                <div class="btn-row">
                    <button type="submit" class="btn-theme btn-theme-warning">
                        Update Assignment
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
