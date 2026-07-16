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
    <title>Edit Assignment</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-warning">
            <h3>Edit Assignment</h3>
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label>Assignment Title</label>
                    <input type="text" name="title" class="form-control"
                           value="<?php echo $assignment['title']; ?>" required>
                </div>

                <div class="mb-3">
                    <label>Course Code</label>
                    <input type="text" name="course_code" class="form-control"
                           value="<?php echo $assignment['course_code']; ?>" required>
                </div>

                <div class="mb-3">
                    <label>Due Date</label>
                    <input type="date" name="due_date" class="form-control"
                           value="<?php echo $assignment['due_date']; ?>" required>
                </div>

                <div class="mb-3">
                    <label>Created At</label>
                    <input type="date" name="created_at" class="form-control"
                           value="<?php echo $assignment['created_at']; ?>" required>   
                </div>

                <div class="mb-3">
                    <label>Notes</label>
                    <textarea name="note" class="form-control" rows="4"><?php echo $assignment['note']; ?></textarea>
                </div>

                <button type="submit" class="btn btn-warning">
                    Update Assignment
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