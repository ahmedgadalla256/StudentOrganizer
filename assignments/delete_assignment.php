<?php
session_start();
require_once("../config/studentdb.inc.php");

if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

if(!isset($_GET["id"])) {
    header("Location: assignments.php");
    exit();
}

$id = $_GET["id"];

$query = $conn->prepare("DELETE FROM assignments WHERE id=? And user_id= ?");
$query-> execute([$id, $user_id]);

header("Location: assignments.php");
exit();

<<<<<<< HEAD
?>
=======
?>
>>>>>>> 78bc9f3 (Update Student Organizer project)
