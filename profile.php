<?php

session_start();
require_once("config/studentdb.inc.php");

if(!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$msg = NULL;

if ($_SERVER["REQUEST_METHOD"] =="POST") {
    $currentpwd =trim($_POST["currentPwd"]);
    $newpwd = trim($_POST["newPwd"]);
    $confirmpwd = trim($_POST["confirmPwd"]);

    if(empty($currentpwd) || empty($newpwd) || empty($confirmpwd)){
        $msg = "Please fill out all fields";
    }
    elseif ($newpwd !== $confirmpwd){
        $msg = "New passwords don't match";
    }
    else{
        $query = $conn->prepare("SELECT pwd FROM users WHERE id = ?");
        $query->execute([$user_id]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($currentpwd, $user["pwd"])){
            $hashedpassword = password_hash($newpwd, PASSWORD_DEFAULT);
            $updateQuery = $conn->prepare("UPDATE users SET pwd = ? WHERE id = ?");
            $updateQuery->execute([$hashedpassword, $user_id]);
            $msg = "Password changed successfully";
        } else {
            $msg = "Current password is incorrect";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account</title>
        <script src="https://kit.fontawesome.com/daa62b2e1b.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div id="maincont" class="containerA">
            <header>
            <a href="dashboard.php" id="acntback">
                <i class="fa-solid fa-house"></i>
            </a>
            <h2 id="acnthead">Account</h2>
            </header>
            <i id="prficn" class="fa-solid fa-circle-user"></i>
            <div class="account-info">
                <p id="acntname"> <?php echo $_SESSION["full_name"]; ?>!</p>
                <p id="acntemail"> <?php echo $_SESSION["email"]; ?> </p>
            </div>
            <button type="button" class="btns" onclick="window.location.href='auth/logout.php'">logout</button>
            <button id="chngpwd" class="btns">Change Password</button>
        </div>
        <div id="pwdmodal" class="modal">
            <div class="modal-content">
                <h2>Change Password</h2>
                <?php if ($msg !== NULL): ?>
                    <p id="msg"><?php echo $msg; ?></p>
                <?php endif; ?>
                <form id="pwdForm" method="POST">
                    <label for="currentPwd">Current Password:</label>
                    <input type="password" id="currentPwd" name="currentPwd" class="dtt" required>
                    <br>
                    <label for="newPwd">New Password:</label>
                    <input type="password" id="newPwd" name="newPwd" class="dtt" required>
                    <br>
                    <label for="confirmPwd">Confirm Password:</label>
                    <input type="password" id="confirmPwd" name="confirmPwd" class="dtt" required>
                    <br>
                    <button type="submit" id="subbtn" class="btns">Submit</button>
                    <button type="button" id="closeModal" class="btns">Cancel</button>
                </form>
            </div>
        </div>
        <script src="java.js"></script>  
        <?php if ($msg !== NULL): ?>
        <script>
            main.style.display = "none";
            pwdmodal.style.display = "flex";
        </script>
        <?php endif; ?>
    </body>
</html>