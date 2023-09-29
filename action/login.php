<?php

include_once "../includes/config.php";

$username = filter_input(INPUT_POST, "username");
$password = filter_input(INPUT_POST, "password");

$result = FALSE;

if(isset($_POST['username'], $_POST['password']) and (!empty($username) and !empty($password))) {
    if($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
    } else {
        $query = "SELECT *, count(username) AS user_ctr FROM client ";
        $query .= "WHERE username = '$username'";
        $query .= "AND password = '" . sha1($password) . "'";

        $result = $mysqli->query($query);

        if(!$result) {
            printf("MySQL query is: %s", $query);
            printf("Error message: %s \n", $mysqli->error);
        } else {
            $record = $result->fetch_assoc();
        }

        if($record['user_ctr'] == 1) {
            if($record['AccountStatus'] == "Active") {

                session_name('ascc-loans');
                session_start();
                $_SESSION['ASCC-LOANS'] = "1";
                $_SESSION['ClientID'] = $record['ClientID'];
                $_SESSION['username'] = $record['username'];
                $_SESSION['password'] = $record['password'];
                $_SESSION['FirstName'] = $record['FirstName'];
                $_SESSION['MiddleName'] = $record['MiddleName'];
                $_SESSION['LastName'] = $record['LastName'];
                
                header("location:../home.php");
            } else {
                session_start();
                if(!empty($_SESSION['login_error_msg'])) {
                    unset($_SESSION['login_error_msg']);
                }
                $_SESSION['login_error_msg'] = "Account is disabled! <br> Please contact ASCC branch near you.";
                header("location:../index.php");
            }
        } else {
            session_start();
            if(!empty($_SESSION['login_error_msg'])) {
                unset($_SESSION['login_error_msg']);
            }
            $_SESSION['login_error_msg'] = "Incorrect Username or Password";
            header("location:../index.php");
        }
    }
} else {
    $result = array('status' => FALSE);
    header("location:../index.php");
}