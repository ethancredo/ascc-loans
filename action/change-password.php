<?php
    session_start();
    include_once '../includes/config.php';

    if(isset($_POST['change-password'])) {
        $oldpassword = mysqli_real_escape_string($mysqli, $_POST['oldpassword']);
        $newpassword = mysqli_real_escape_string($mysqli, $_POST['newpassword']);
        $renewpassword = mysqli_real_escape_string($mysqli, $_POST['renewpassword']);
        $clientid = $_SESSION['ClientID'];
        $currentpassword = $_SESSION['password'];

        if(empty($oldpassword) && empty($newpassword) && empty($renewpassword) && empty($clientid) && empty($currentpassword)) {
            $error = "Some fields are empty!";
        } else {
            // check if the current password match
            if(sha1($oldpassword) == $currentpassword) {
                // check confirm password if it match
                if($newpassword == $renewpassword) {
                    $result = mysqli_query($mysqli, "UPDATE client SET password = '" . sha1($newpassword) . "' WHERE ClientID = $clientid");

                    $_SESSION['password'] = sha1($newpassword);
                    $_SESSION['changepass-success'] = "Password successfully changed!";
                    // header("location:../change-password.php");
                } else {
                    $_SESSION['changepass-error'] = "New password does not match!";
                    // header("location:../change-password.php");
                }
            } else {
                $_SESSION['changepass-error'] = "Incorrect Password.";
                // header("location:../change-password.php");
            }
        }
    } else {
        echo $_SESSION['ClientID'];
    }