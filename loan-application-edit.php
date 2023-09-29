<!DOCTYPE html>

<?php
    include_once 'includes/user-check.php';
    include_once 'includes/config.php';

    $id = $_GET['id'];

    $request = mysqli_query($mysqli, "SELECT * FROM LoanApplication WHERE ApplicationID = $id");
    $result = mysqli_fetch_array($request);

    $LoanType = $result['LoanType'];
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/my-style.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>ASCC: Loan Inquiry</title>
    <link rel="icon" type="image/x-icon" href="image/ascc-icon.png">
</head>
<body>
    <div class="container">
        <?php include_once "includes/header.php"; ?>

        <?php include_once "includes/main-menu.php"; ?>

        <div class="content">
            <div class="card">
                <h1>Loan Inquiry</h1>
                <p>
                    Your home for fast and reliable.
                </p>
            </div>

            <br>

            <form action="" method="POST" class="form">
                <p>
                    <label for="loan_type">Type of Loan</label>
                    <select name="loan_type" required>
                        <!-- Mucky way for selecting option based on value from db -->
                        <!-- if $LoanType is equal to value then put selected -->
                        <option value="Regular Loan" <?php echo ($LoanType == 'Regular Loan')? 'selected="selected"':''; ?>>Regular Loan</option>
                        <option value="Cash Advance" <?php echo ($LoanType == 'Cash Advance')? 'selected="selected"':''; ?>>Cash Advance</option>
                        <option value="Incentive Loan" <?php echo ($LoanType == 'Incentive Loan')? 'selected="selected"':''; ?>>Incentive Loan</option>
                    </select>
                </p>

                <p>
                    <label for="loan_amount">Loan Amount</label>
                    <input type="number" name="loan_amount" placeholder="Enter Loan Amount" value="<?php echo $result['LoanAmount']; ?>">
                </p>

                <p>
                    <label for="loan_release">Options for Release</label>
                    <?php
                    // Clean way for selecting option based on value from db
                    // set array values for options for release. if the value from array is equal to db value set it as selected
                    $release_options = array("BDO Cash Card", "ML Wallet", "Palawan", "Cebuana");
                    ?>
                    <select name="loan_release" required>
                        <?php foreach($release_options as $release_option){ ?>
                            <option value="<?php echo $release_option ?>" <?php if($result['ReleaseTo'] == $release_option) { echo "selected='selected'"; } ?>>
                                <?php echo $release_option; ?>
                            </option>
                        <?php } ?>
                    </select>
                </p>

                <p>
                    <input type="submit" value="Submit" name="edit-loan-application" class="button-full">
                    <br clear="both">
                    <input class="danger-button" onclick="window.location.href='loan-application.php';" value="Cancel">
                </p>
            </form>
        </div>

        <?php include_once "includes/footer.php"; ?>
    </div>
</body>
</html>

<?php
    if(isset($_POST['edit-loan-application'])) {
        $client_id = $_SESSION['ClientID'];
        $loan_type = mysqli_real_escape_string($mysqli, $_POST['loan_type']);
        $loan_amount = mysqli_real_escape_string($mysqli, $_POST['loan_amount']);
        $release_option = mysqli_real_escape_string($mysqli, $_POST['loan_release']);

        if(empty($client_id) || empty($loan_type) || empty($loan_amount) || empty($release_option)) {
            $error = "Some fields are empty!";
            echo "empty";
        } else {
            $result = mysqli_query($mysqli, "UPDATE loanapplication SET LoanType = '$loan_type', 
                                                                            LoanAmount = '$loan_amount', 
                                                                            ReleaseTo = '$release_option'
                                                                        WHERE ApplicationID = '$id'");

            echo "<script>
                alert('Success!');
                window.location.href = 'loan-application.php';
            </script>";
        }
    }
?>