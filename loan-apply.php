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

    <title>ASCC: Apply Loan</title>
    <link rel="icon" type="image/x-icon" href="image/ascc-icon.png">
</head>
<body>
    <div class="container">
        <?php include_once "includes/header.php"; ?>

        <?php include_once "includes/main-menu.php"; ?>
        

        <div class="content">
            <div class="card">
                <h1>Loan Application</h1>
                <p>
                    Please fill up the form to apply loan.
                </p>
            </div>

            <br>

            <form action="" method="POST" class="form">

                <p>
                    <label for="loan_type">Type of Loan</label>
                    <select name="loan_type" required>
                        <option value="">Select</option>
                        <option value="Regular Loan">Regular Loan</option>
                        <option value="Cash Advance">Cash Advance</option>
                        <option value="Incentive Loan">Incentive Loan</option>
                    </select>
                </p>
                <p>
                    <label for="loan_amount">Loan Amount</label>
                    <input type="text" name="loan_amount" placeholder="Enter Loan Amount">
                </p>
                <p>
                    <label for="loan_release">Options for Release</label>
                    <select name="loan_release" required>
                        <option value="">Select</option>
                        <option value="BDO Cash Card">BDO Cash Card</option>
                        <option value="ML Wallet">ML Wallet</option>
                        <option value="Palawan">Palawan</option>
                        <option value="Cebuana">Cebuana</option>
                    </select>
                </p>                

                <hr>

                <p>
                    <a href="">Terms and Privacy.</a>
                </p>

                <p>
                    <input type="submit" value="Apply" name="applyloan" class="button-full">
                    <br clear="both">
                    <input value="Cancel" class="danger-button" onclick="window.location.href='index.php';">
                </p>

            </form>
            
        </div>

        <br>

        <?php include_once "includes/footer.php"; ?>
    </div>
</body>
</html>

<?php
    if(isset($_POST['applyloan'])) {
        $client_id = $_SESSION['ClientID'];
        $loan_type = mysqli_real_escape_string($mysqli, $_POST['loan_type']);
        $loan_amount = mysqli_real_escape_string($mysqli, $_POST['loan_amount']);
        $release_option = mysqli_real_escape_string($mysqli, $_POST['loan_release']);

        if(empty($client_id) || empty($loan_type) || empty($loan_amount) || empty($release_option)) {
            $error = "Some fields are empty";       
            echo "empty";
        } else {
            $result = mysqli_query($mysqli, "INSERT INTO loanapplication(ClientID, LoanType, LoanAmount, ReleaseTo)
                                                                VALUES('$client_id', '$loan_type', '$loan_amount', '$release_option')");

            echo "<script>
                alert('Success!');
                window.location.href = 'loan-application.php';
            </script>";
        }

    }
?>