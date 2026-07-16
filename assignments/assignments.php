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
    <title>My Assignments</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">
        <h2>My Assignments</h2>

        <div>
            <a href="add_assignment.php" class="btn btn-success">
                Add Assignment
            </a>

            <a href="../dashboard.php" class="btn btn-secondary">
                Dashboard
            </a>
        </div>
    </div>

    <table class="table table-bordered table-striped">

        <thead class="table-dark">

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

                    <a href="edit_assignment.php?id=<?php echo $assignment["id"]; ?>" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <a href="delete_assignment.php?id=<?php echo $assignment["id"]; ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete this assignment?')">
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
