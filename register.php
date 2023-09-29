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
    <title>ASCC: Register</title>
    <link rel="icon" type="image/x-icon" href="image/ascc-icon.png">

    <link rel="stylesheet" href="css/my-style.css">

    <style>
        body {            
            background-color: rgb(240, 240, 240);
            /* background-color: tomato; */
        }
        hr {
            border: 1px solid tomato;
            margin-bottom: 20px;
        }
        * {
            box-sizing: border-box;
        }
        .signin {
            text-align: center;
            background-color: white;
            margin: auto;
            padding: 30px 0 30px 0;
        }
        .content {
            width: 600px;
            margin: auto;
            background-color: white;
            padding: 16px;
            box-shadow: 0 4px 6px 0 gray;
        }
        
        @media screen and (max-width: 601px) {
            .content {
                width: 100%;
            }
            .signin {
                width: 100%;
            }
        }

        a {
            color: dodgerblue;
        }

        input[type=text], input[type=password], input[type=email], select {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background-color: #f1f1f1;
        }
        input[type=text]:focus, input[type=password]:focus, input[type=email]:focus, select:focus {
            background-color: #ddd;
        }
        .btnregister {
            background-color: #04AA6d;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include_once "includes/header.php"; ?>
        <br><br>
        <div class="content">
            <form action="action/register.php" method="POST" class="form">
                <h1>Register</h1>
                <p>
                    Please fill in this form to create an account.
                </p>
                <hr>
                
                <?php if(!empty($_SESSION['register-error'])) { ?>
                    <div class="error-message"><?php echo $_SESSION['register-error']; ?></div>
                <?php } elseif(!empty($_SESSION['register-success'])) { ?>
                    <div class="success-message"><?php echo $_SESSION['register-success']; ?></div>
                <?php } ?>

                <p>
                    <label for="branch"><b>Branch</b></label>
                    <select name="branch" required>
                        <?php include_once "includes/list_branch.php"; ?>
                    </select>
                </p>
                <p>
                    <label for="username"><b>Username</b></label>
                    <input type="text" name="username" placeholder="Enter Username" required>
                </p>
                <p>
                    <label for="password"><b>Password</b></label>
                    <input type="password" name="password" placeholder="Enter Password" required>
                    <input type="password" name="confirmpassword" placeholder="Confirm Password" required>
                </p>
                <p>
                    <label for="email"><b>Email</b></label>
                    <input type="email" name="email" placeholder="Enter Email" required>
                </p>
                <p>
                    <label for="firstname"><b>First Name</b></label>
                    <input type="text" name="firstname" placeholder="Enter First Name" required>
                </p>
                <p>
                    <label for="middlename"><b>Middle Name</b></label>
                    <input type="text" name="middlename" placeholder="Enter Middle Name" required>
                </p>
                <p>
                    <label for="lastname"><b>Last Name</b></label>
                    <input type="text" name="lastname" placeholder="Enter Last Name" required>
                </p>
                <p>
                    <label for="birthdate">Date of Birth</label>
                    <input type="date" name="birthdate" required>
                </p>
                <p>
                    <label for="gender">Gender</label>
                    <select name="gender" required>
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </p>
                <p>
                    <label for="civilstatus"><b>Civil Status</b></label>
                    <select name="civilstatus" required>
                        <option value="">Select</option>
                        <?php include_once 'includes/civil-status.php'; ?>
                    </select>
                </p>
                <p>
                    <label for="contactnumber"><b>Contact Number</b></label>
                    <input type="text" name="contactnumber" placeholder="Enter Contact Number" required>
                </p>
                <p>
                    <label for="address">Address</label>
                    <input type="text" name="address" placeholder="Enter Complete Address" required>
                </p>
                <p>
                    <label for="securityquestion">Security Question</label>
                    <select name="securityquestion" id="">
                        <option value="">Select Question</option>
                        <option value="In what city were you born?">In what city were you born?</option>
                        <option value="What is the name of your favorite pet?">What is the name of your favorite pet?</option>
                        <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                        <option value="What was your favorite food as a child?">What was your favorite food as a child?</option>
                    </select>
                    <input type="text" name="securityanswer" placeholder="Security Answer" required>
                </p>
                <hr>
                <p>
                    By creating an account you agree to Alano & Sons Credit Corporation <a href="">Terms & Privacy</a>.
                </p>
                <p>
                    <input type="submit" value="Register" name="register" class="btnregister">
                </p>
            </form>
            
            <div class="signin">
                Already have an account? <a href="index.php">Sign in</a>.
            </div>
        </div>
    </div>
    <br>
</body>
</html>

<?php

    unset($_SESSION['register-error']);
    unset($_SESSION['register-success']);

?>
