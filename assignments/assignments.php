<?php

session_start();
require_once("../config/studentdb.inc.php");

if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$query = $conn -> prepare("SELECT * FROM assignments WHERE user_id = ?");
$query -> execute([$user_id]);

$assignments = $query-> fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Assignments</title>
    <script src="https://kit.fontawesome.com/daa62b2e1b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="page-shell-wide">

    <div class="list-header">
        <h2><i class="fa-solid fa-list-check"></i>&nbsp; My Assignments</h2>

        <div class="btn-row">
            <a href="add_assignment.php" class="btn-theme btn-theme-success">
                <i class="fa-solid fa-plus"></i>&nbsp; Add Assignment
            </a>
            <a href="../dashboard.php" class="btn-theme btn-theme-secondary">
                <i class="fa-solid fa-house"></i>&nbsp; Dashboard
            </a>
        </div>
    </div>

    <?php if (count($assignments) === 0): ?>

        <div class="card-theme">
            <div class="empty-state">
                <i class="fa-solid fa-clipboard-list"></i>
                No assignments yet. Click "Add Assignment" to get started.
            </div>
        </div>

    <?php else: ?>

    <div class="table-shell">
        <table class="table-theme">

            <thead>
                <tr>
                    <th>Assignment Title</th>
                    <th>Course Code</th>
                    <th>Due Date</th>
                    <th>Created At</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

            <?php foreach ($assignments as $assignment) { ?>

                <tr>

                    <td><?php echo $assignment["title"]; ?></td>
                    <td><?php echo $assignment["course_code"]; ?></td>
                    <td><?php echo $assignment["due_date"]; ?></td>
                    <td><?php echo $assignment["created_at"]; ?></td>
                    <td><?php echo $assignment["note"]; ?></td>

                    <td>
                        <div class="table-actions">
                            <a href="edit_assignment.php?id=<?php echo $assignment["id"]; ?>" class="btn-theme btn-theme-warning btn-theme-sm">
                                Edit
                            </a>

                            <a href="delete_assignment.php?id=<?php echo $assignment["id"]; ?>" class="btn-theme btn-theme-danger btn-theme-sm"
                               onclick="return confirm('Delete this assignment?')">
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
