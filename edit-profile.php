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

    <link rel="stylesheet" href="css/my-style.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>ASCC: Edit Profile</title>
    <link rel="icon" type="image/x-icon" href="image/ascc-icon.png">
</head>
<body>
    <div class="container">
        <?php include_once "includes/header.php"; ?>

        <?php include_once "includes/main-menu.php"; ?>

        <div class="content">
            
            <div class="profile-container">
                <?php include_once 'includes/profile-sidebar.php'; ?>

                <div class="profile-content">
                    <h1>Edit Profile</h1>

                    <form action="action/edit-profile.php" method="post" class="form">
                        <p>
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname" value="<?php echo $result['FirstName']; ?>" required>
                        </p>
                        <p>
                            <label for="middlename">Middle Name</label>
                            <input type="text" name="middlename" value="<?php echo $result['MiddleName']; ?>" required>
                        </p>
                        <p>
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname" value="<?php echo $result['LastName']; ?>" required>
                        </p>
                        <p>
                            <label for="gender">Gender</label>
                            <select name="gender" required>
                                <?php if(isset($result['Gender'])) { ?>
                                    <option value="<?php echo $result['Gender'] ?>"><?php echo $result['Gender']; ?></option>
                                <?php } ?>
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </p>
                        <p>
                            <label for="civilstatus">Civil Status</label>
                            <select name="civilstatus" required>
                                <option value="<?php echo $result['CivilStatus']; ?>" disabled><?php echo $result['CivilStatus']; ?></option>
                                <hr>
                                <?php include_once 'includes/civil-status.php'; ?>
                            </select>
                        </p>
                        <p>
                            <label for="address">Address</label>
                            <input type="text" name="address" value="<?php echo $result['Address'] ?>" required>
                        </p>
                        <p>
                            <label for="email">Email</label>
                            <input type="email" name="email" value="<?php echo $result['email']; ?>" required>
                        </p>
                        <p>
                            <label for="contactnumber">Contact Number</label>
                            <input type="text" name="contactnumber" value="<?php echo $result['ContactNumber']; ?>" required>
                        </p>
                        <p>
                            <label for="branch">Branch</label>
                            <select name="branch" required>
                                <?php 
                                    if(empty($result['Branch'])) {
                                        include_once 'includes/list_branch.php';
                                    } else {
                                ?>
                                    <option value="<?php echo $result['Branch']; ?>"><?php echo $result['Branch']; ?></option>
                                    <?php include_once 'includes/list_branch.php'; echo '2'; ?>
                                <?php } ?>                                
                            </select>
                        </p>
                        <p>
                            <input type="hidden" name="clientid" value="<?php echo $id; ?>">
                            <input type="submit" value="Save" name="edit-profile" class="button-full">
                            <br>
                            <button class="danger-button" onclick="window.location.href='my-profile.php'">Cancel</button>
                        </p>
                    </form>
                </div>
            </div>

        </div>

        <?php include_once "includes/footer.php"; ?>
    </div>
</body>
</html>

