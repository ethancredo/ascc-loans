<?php

    if(isset($_POST['register'])){
        include_once '../includes/config.php';

        $branch = mysqli_real_escape_string($mysqli, $_POST['branch']);
        $username = mysqli_real_escape_string($mysqli, $_POST['username']);
        $password = mysqli_real_escape_string($mysqli, $_POST['password']);
        $confirmpassword = mysqli_real_escape_string($mysqli, $_POST['confirmpassword']);
        $email = mysqli_real_escape_string($mysqli, $_POST['email']);
        $firstname = mysqli_real_escape_string($mysqli, $_POST['firstname']);
        $middlename = mysqli_real_escape_string($mysqli, $_POST['middlename']);
        $lastname = mysqli_real_escape_string($mysqli, $_POST['lastname']);
        $birthdate = mysqli_real_escape_string($mysqli, $_POST['birthdate']);
        $gender = mysqli_real_escape_string($mysqli, $_POST['gender']);
        $civilstatus = mysqli_real_escape_string($mysqli, $_POST['civilstatus']);
        $contactnumber = mysqli_real_escape_string($mysqli, $_POST['contactnumber']);
        $address = mysqli_real_escape_string($mysqli, $_POST['address']);
        $securityquestion = mysqli_real_escape_string($mysqli, $_POST['securityquestion']);
        $securityanswer = mysqli_real_escape_string($mysqli, $_POST['securityanswer']);

        if(empty($branch) && empty($username) && empty($password) && empty($confirmpassword) 
        && empty($email) && empty($contactnumber) && empty($firstname) && empty($middlename) && empty($lastname)) {
            echo "Some fields are empty";
        } else {

            //check username if it exists
            $query = "SELECT username, COUNT(username) AS user_ctr FROM client WHERE username = '$username'";
            $checkuser = $mysqli->query($query);
            
            if(!$checkuser) {
                printf("MySQL query is: %s", $query);
                printf("Error message is: %s", $mysqli->error);
            } else {
                $result = $checkuser->fetch_assoc();                
                session_start();
            }
            
            // check username if it exists
            if($result['user_ctr'] == 1) {
                $_SESSION['register-error'] = "Username '$username' is already taken.";
                header("location:../register.php");
            } else {

                // check password if it match
                if($password == $confirmpassword) {
                    $result = mysqli_query($mysqli, "INSERT INTO client(branch, username, password, email, firstname, middlename, lastname, birthdate, gender, civilstatus, contactnumber, address, SecurityQuestion, SecurityAnswer)
                                    VALUES('$branch', '$username', sha1('$password'), '$email', '$firstname', '$middlename', '$lastname', '$birthdate', '$gender', '$civilstatus', '$contactnumber', '$address', '$securityquestion', '$securityanswer')");

                    $_SESSION['register-success'] = "Registered successfully!";
                    header("location:../register.php");
                } else {
                    $_SESSION['register-error'] = "Password does not match!";
                    header("location:../register.php");
                }

            }
                    
        }
    } else {
        echo "error";
    }

?>