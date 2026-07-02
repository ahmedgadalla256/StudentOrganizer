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
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h3>Login</h3>
                </div>

                <div class="card-body">

                    <?php if (!empty($message)) : ?>
                        <div class="alert alert-danger">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input
                                type="password"
                                name="pwd"
                                class="form-control"
                                required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Login
                        </button>

                    </form>

                    <div class="text-center mt-3">
                        Don't have an account?
                        <a href="signup.php">Sign Up</a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>
