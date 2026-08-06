<?php
session_start();
require_once("../config/studentdb.inc.php");

$message = NULL;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = trim($_POST["email"]);
    $pwd = trim($_POST["pwd"]);

    if( empty($email) || empty($pwd)){
        $message = "Please fill out all fields";
    }
   
    else{
        $query = $conn-> prepare("SELECT * From users WHERE email = ?");
        $query -> execute([$email]);

        if($query -> rowCount() == 1){
           $user = $query->fetch(PDO::FETCH_ASSOC);

           if(password_verify($pwd, $user["pwd"])){

            $_SESSION["user_id"] = $user["id"]; 
            $_SESSION["full_name"] = $user["full_name"];
            $_SESSION["email"] = $user["email"];
              
            header("Location: ../dashboard.php"); 
            exit();
           }
           else{
            $message = "Incorrect password";
           }
        }
        else{
            $message = "Email not found";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://kit.fontawesome.com/daa62b2e1b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="page-shell">

    <div class="card-theme">

        <div class="card-theme-header" style="justify-content:center;">
            <i class="fa-solid fa-right-to-bracket"></i>
            <h3>Login</h3>
        </div>

        <div class="card-theme-body">

            <?php if (!empty($message)) : ?>
                <div class="alert-theme">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form method="POST">

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

                <button type="submit" class="btn-theme btn-theme-block">
                    Login
                </button>

            </form>

            <div style="text-align:center; margin-top:18px; color: var(--slate);">
                Don't have an account?
                <a href="signup.php" style="color: var(--ink); font-weight:600;">Sign Up</a>
            </div>

        </div>

    </div>

</div>

</body>
</html>
