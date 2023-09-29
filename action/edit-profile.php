<?php
    session_start();
    include_once '../includes/config.php';

    if(isset($_POST['edit-profile'])) {
        $firstname = mysqli_real_escape_string($mysqli, $_POST['firstname']);
        $middlename = mysqli_real_escape_string($mysqli, $_POST['middlename']);
        $lastname = mysqli_real_escape_string($mysqli, $_POST['lastname']);
        $gender = mysqli_real_escape_string($mysqli, $_POST['gender']);
        $civilstatus = mysqli_real_escape_string($mysqli, $_POST['civilstatus']);
        $address = mysqli_real_escape_string($mysqli, $_POST['address']);
        $email = mysqli_real_escape_string($mysqli, $_POST['email']);
        $contactnumber = mysqli_real_escape_string($mysqli, $_POST['contactnumber']);
        $branch = mysqli_real_escape_string($mysqli, $_POST['branch']);
        $id = mysqli_real_escape_string($mysqli, $_POST['clientid']);

        if(empty($branch) && empty($username) && empty($password) && empty($confirmpassword) 
        && empty($email) && empty($contactnumber) && empty($firstname) && empty($middlename) && empty($lastname)) {
            echo "Some fields are empty";
        } else {
            $result = mysqli_query($mysqli, "UPDATE client SET firstname = '$firstname',
                                                                middlename = '$middlename', 
                                                                lastname = '$lastname', 
                                                                gender = '$gender', 
                                                                civilstatus = '$civilstatus', 
                                                                address = '$address', 
                                                                email = '$email', 
                                                                contactnumber = '$contactnumber', 
                                                                branch = '$branch'
                                                                WHERE clientID = $id");

            header("location:../my-profile.php");
        }
    }