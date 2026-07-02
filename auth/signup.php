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
    <title>Sign Up</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h3>Create Account</h3>
                </div>

                <div class="card-body">

                    <?php if($message != NULL) { ?>
                        <div class="alert alert-danger">
                            <?php echo $message; ?>
                        </div>
                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label>Full Name</label>
                            <input
                                type="text"
                                name="full_name"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input
                                type="password"
                                name="pwd"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Confirm Password</label>
                            <input
                                type="password"
                                name="c_pwd"
                                class="form-control"
                                required>
                        </div>

                        <button class="btn btn-primary w-100">
                            Sign Up
                        </button>

                    </form>

                    <div class="text-center mt-3">
                        Already have an account?
                        <a href="login.php">Login</a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>