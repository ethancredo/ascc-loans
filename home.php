<!DOCTYPE html>

<?php
    include_once 'includes/user-check.php';
    include_once 'includes/config.php';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/my-style.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>ASCC: Home</title>
    <link rel="icon" type="image/x-icon" href="image/ascc-icon.png">
</head>
<body>
    <div class="container">
        <?php include_once "includes/header.php"; ?>

        <?php include_once "includes/main-menu.php"; ?>

        <div class="content">
            <div class="card">
                <h1>Welcome to Alano & Sons Credit Corporation</h1>
                <p>
                    Your home for fast and reliable.
                </p>
            </div>

            <br>

            <div class="client-menu">
                <div class="client-menu-row">
                    <div class="client-menu-column">
                        <div class="client-menu-11 client-menu-container">
                            <div></div>
                            <a href="loan-apply.php">Apply Loan</a>
                        </div>
                        <div class="client-menu-12 client-menu-container">
                            <div></div>
                            <a href="loan-application.php">My Loan Application</a>
                        </div>
                        <div class="client-menu-13 client-menu-container">
                            <div></div>
                            <a href="loan-account-inquiry.php">Loan Account Inquiry</a>
                        </div>
                    </div>

                    <div class="client-menu-column">
                        <div class="client-menu-21 client-menu-container">
                            <div></div>
                            <a href="loan-account-inquiries.php">My Account Inquiries</a>
                        </div>
                        <div class="client-menu-profile client-menu-container">
                            <div></div>
                            <a href="my-profile.php">My Profile</a>
                        </div>
                        <div class="client-menu-logout client-menu-container">
                            <div></div>
                            <a href="action/logout.php">Logout</a>
                        </div>
                    </div>

                    <div class="client-menu-column">
                    </div>
                </div>
            </div>

            

        </div>

        <?php include_once "includes/footer.php"; ?>
    </div>
</body>
</html>