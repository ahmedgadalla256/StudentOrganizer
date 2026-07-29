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
                <p id="acntname">Name: John Doe</p>
                <p id="acntemail">Email: john.doe@example.com</p>
            </div>
            <button type="button" class="btns" onclick="window.location.href='auth/logout.php'">logout</button>
            <button id="chngpwd" class="btns">Change Password</button>
        </div>
        <div id="pwdmodal" class="modal">
            <div class="modal-content">
                <h2>Change Password</h2>
                <form id="pwdForm" method="post">
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
    </body>
</html>