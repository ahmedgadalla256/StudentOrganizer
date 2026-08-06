<?php
session_start();
require_once("../config/studentdb.inc.php");

$message = NULL;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $pwd = trim($_POST["pwd"]);
    $c_pwd = trim($_POST["c_pwd"]);

    if(empty($full_name) || empty($email) || empty($pwd) || empty($c_pwd)){
        $message = "Please fill out all fields";
    }
    elseif ($pwd !== $c_pwd){
        $message = "passwords don't match";
    }
    else{
        $check = $conn-> prepare("SELECT id From users WHERE email = ?");
        $check -> execute([$email]);

        if($check -> rowCount() > 0){
            $message = "email already exists";
        }
        else{
            $hashedpassword = password_hash($pwd, PASSWORD_DEFAULT);

            $query = $conn -> prepare("INSERT INTO users (full_name, email, pwd) VALUES (?, ?, ?)" );
            $query->execute([$full_name, $email, $hashedpassword]);

            header("Location: login.php");
            exit();
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://kit.fontawesome.com/daa62b2e1b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="page-shell">

    <div class="card-theme">

        <div class="card-theme-header header-success" style="justify-content:center;">
            <i class="fa-solid fa-user-plus"></i>
            <h3>Create Account</h3>
        </div>

        <div class="card-theme-body">

            <?php if($message != NULL) { ?>
                <div class="alert-theme">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <form method="POST">

                <div class="field-group">
                    <label>Full Name</label>
                    <input
                        type="text"
                        name="full_name"
                        class="field-input"
                        required>
                </div>

                <div class="field-group">
                    <label>Email</label>
                    <input
                        type="email"
                        name="email"
                        class="field-input"
                        required>
                </div>

                <div class="field-group">
                    <label>Password</label>
                    <input
                        type="password"
                        name="pwd"
                        class="field-input"
                        required>
                </div>

                <div class="field-group">
                    <label>Confirm Password</label>
                    <input
                        type="password"
                        name="c_pwd"
                        class="field-input"
                        required>
                </div>

                <button class="btn-theme btn-theme-success btn-theme-block">
                    Sign Up
                </button>

            </form>

            <div style="text-align:center; margin-top:18px; color: var(--slate);">
                Already have an account?
                <a href="login.php" style="color: var(--ink); font-weight:600;">Login</a>
            </div>

        </div>

    </div>

</div>

</body>
</html>
