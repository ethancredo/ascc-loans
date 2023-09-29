<!DOCTYPE html>

<?php
    session_name('ascc-loans');
    session_start();
    if((isset($_SESSION['username']) and (!empty($_SESSION['username'])))) {
        header("location:home.php");
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ASCC: Login</title>
    <link rel="icon" type="image/x-icon" href="image/ascc-icon.png">

    <link rel="stylesheet" href="css/login-style.css">

    <!-- google fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">

</head>
<body>
    <div class="container">
        <div class="login-container">
            <a href="http://www.alano-and-sons.com/">
                <img src="image/ascc_logo2020_blackred.png" alt="">
            </a>
            
            <form action="action/login.php" class="login-form" method="POST">
                <h3>Sign in</h3>
                <?php
                    if(!empty($_SESSION['login_error_msg'])) {
                        $error = $_SESSION['login_error_msg'];
                        echo "<div class='login-error-msg'>$error</div>";
                    }
                ?>
                <p>
                    <label for="username">Username</label>
                    <input type="text" name="username" required>
                </p>
                <p>
                    <label for="password">Password</label>
                    <input type="password" name="password" required>
                </p>
                <div class="flex login-buttons">
                    <div>
                        <a href="register.php">Register</a>
                    </div>
                    <div>
                        <input type="submit" value="Login" name="login" class="btn-login text-right">
                    </div>
                </div>
            </form>
            <br>
        </div>
    </div>
</body>
</html>

<?php
    unset($_SESSION['login_error_msg']);
?>