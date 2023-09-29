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
    <title>ASCC: Profile</title>
    <link rel="icon" type="image/x-icon" href="image/ascc-icon.png">

    <link rel="stylesheet" href="css/my-style.css">

    <style>
        .profile-table td {
            padding: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include_once 'includes/header.php'; ?>

        <?php include_once 'includes/main-menu.php'; ?>

        <div class="content">

            <div class="profile-container">

                <?php include_once 'includes/profile-sidebar.php'; ?>

                <div class="profile-content">
                    <h1>Profile</h1>
                
                    <h3>Personal Info</h3>

                    <table class="profile-table">
                        <tr>
                            <td>ID</td>
                            <td><?php echo $_SESSION['ClientID']; ?></td>
                        </tr>
                        <tr>
                            <td>First Name:</td>
                            <td><?php echo $result['FirstName']; ?></td>
                        </tr>
                        <tr>
                            <td>Middle Name:</td>
                            <td><?php echo $result['MiddleName'] ?></td>
                        </tr>
                        <tr>
                            <td>Last Name:</td>
                            <td><?php echo $result['LastName']; ?></td>
                        </tr>
                        <tr>
                            <td>Civil Status:</td>
                            <td><?php echo $result['CivilStatus']; ?></td>
                        </tr>
                        <tr>
                            <td>Address:</td>
                            <td><?php echo $result['Address']; ?></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><?php echo $result['email']; ?></td>
                        </tr>
                        <tr>
                            <td>Contact:</td>
                            <td><?php echo $result['ContactNumber'] ?></td>
                        </tr>
                        <tr>
                            <td>Branch:</td>
                            <td><?php echo $result['Branch']; ?></td>
                        </tr>
                    </table>
                    
                </div>

            </div>
        </div>

        <?php include_once 'includes/footer.php'; ?>
    </div>
</body>
</html>