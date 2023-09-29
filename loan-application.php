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

    <title>ASCC: Loan Applications</title>
    <link rel="icon" type="image/x-icon" href="image/ascc-icon.png">
</head>
<body>
    <div class="container">
        <?php include_once "includes/header.php"; ?>

        <?php include_once "includes/main-menu.php"; ?>

        <div class="content">
            <div class="card">
                <h1>Loan Applications</h1>
                <p>
                    All of your loan applications are displayed in this page.
                </p>
            </div>

            <br>

            <form action="loan-application-search-result.php" method="GET" class="search-form">
                <select name="ApplicationLoanType">
                    <option value="">Loan Type</option>
                    <option value="Regular Loan">Regular Loan</option>
                    <option value="Cash Advance">Cash Advance</option>
                    <option value="Incentive Loan">Incentive Loan</option>
                </select>
                <select name="ApplicationReleasedTo">
                    <option value="">Released To</option>
                    <option value="BDO Cash Card">BDO Cash Card</option>
                    <option value="ML Wallet">ML Wallet</option>
                    <option value="Palawan">Palawan</option>
                    <option value="Cebuana">Cebuana</option>
                </select>
                <input type="date" name="ApplicationDate">
                <select name="ApplicationStatus">
                    <option value="">Select Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancel">Cancel</option>
                </select>
                <button type="submit" name="search-application-btn">Search</button>
            </form>  
            
            <br><br>

            <?php
            $client_id = $_SESSION['ClientID'];
            $request = mysqli_query($mysqli, "SELECT * FROM LoanApplication WHERE ClientID = '$client_id' AND ApplicationStatus = 'Pending'");

            if(mysqli_num_rows($request) > 0) {
            ?>

                <div class="table_container">
                    <table class="tables" border="1">
                        <thead>
                            <th>#</th>
                            <th>Loan Type</th>
                            <th>Loan Amount</th>
                            <th>Release To</th>
                            <th>Application Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php while($result = mysqli_fetch_array($request)) { ?>
                                <tr>
                                    <td><?php echo $result['ApplicationID']; ?></td>
                                    <td><?php echo $result['LoanType']; ?></td>
                                    <td><?php echo $result['LoanAmount']; ?></td>
                                    <td><?php echo $result['ReleaseTo']; ?></td>
                                    <td>
                                        <?php 
                                        $date = date("M-d Y", strtotime($result['ApplicationDate']));
                                        echo $date; ?>
                                    </td>
                                    <td class="<?php $AppStatus = $result['ApplicationStatus']; 
                                                        if($AppStatus == 'Pending') { echo 'yellow'; }
                                                        elseif($AppStatus == 'Solved') { echo 'green'; }
                                                        else { echo 'red'; }
                                    ?>">
                                        <?php echo $result['ApplicationStatus']; ?>
                                    </td>
                                    <td><a href="loan-application-edit.php?id=<?php echo $result['ApplicationID']; ?>">Edit</a></td>
                                </tr>
                            <?php } //while end ?>
                        </tbody>
                    </table>
                </div>

            <?php
            } else {
                echo "<br> <div class='error-message'>
                    No application found.
                </div>";
            }
            ?>


        </div>

        <?php include_once "includes/footer.php"; ?>
    </div>
</body>
</html>