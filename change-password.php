<!DOCTYPE html>

<?php
    include_once 'includes/user-check.php';
    include_once 'includes/config.php';

    $id = $_SESSION['ClientID'];
    $request = $mysqli->query("SELECT * FROM client WHERE ClientID = '$id'");
    $result = $request->fetch_array();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASCC: Change Password</title>
    <link rel="icon" type="image/x-icon" href="image/ascc-icon.png">

    <link rel="stylesheet" href="css/my-style.css">

</head>
<body>
    <div class="container">
        <?php include_once 'includes/header.php'; ?>

        <?php include_once 'includes/main-menu.php'; ?>

        <div class="content">

            <div class="profile-container">

                <?php include_once 'includes/profile-sidebar.php'; ?>

                <div class="profile-content">
                    <h1>Change Password</h1>

                    <form action="action/change-password.php" method="POST" class="form">

                        <?php if(!empty($_SESSION['changepass-error'])) { ?>
                            <div class="error-message"><?php echo $_SESSION['changepass-error']; ?></div>
                        <?php } elseif(!empty($_SESSION['changepass-success'])) { ?>
                            <div class="success-message"><?php echo $_SESSION['changepass-success']; ?></div>
                        <?php } ?>

                        <p>
                            <label for="oldpassword">Old Password</label>
                            <input type="password" name="oldpassword" placeholder="Enter Old Password" required>
                        </p>
                        <p>
                            <label for="newpassword">New Password</label>
                            <input type="password" name="newpassword" placeholder="Enter New Password" required>
                        </p>
                        <p>
                            <label for="renewpassword">Repeat New Password</label>
                            <input type="password" name="renewpassword" placeholder="Repeat New Password" required>
                        </p>
                        <p>
                            <input type="submit" value="Change Password" name="change-password" class="button-full">
                            <br>
                            <button class="danger-button" onclick="window.location.href='my-profile.php'">Cancel</button>
                        </p>
                    </form>
                </div>

            </div>
        </div>

        <?php include_once 'includes/footer.php'; ?>
    </div>
</body>
</html>

<?php
    unset($_SESSION['changepass-error']);
    unset($_SESSION['changepass-success']);
?>