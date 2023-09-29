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
                    Your home for fast and reliable.
                </p>
            </div>

            <br>

            <form action="" method="GET" class="search-form">
                <select id="selectLoanType" name="ApplicationLoanType">
                    <option value="">Loan Type</option>
                    <!-- set array values. if the value from array is equal to $_GET value, set it as selected -->
                    <?php $loan_types = array("Regular Loan", "Cash Advance", "Incentive Loan"); ?>
                    <?php foreach($loan_types as $loan_type) { ?>
                        <option value="<?php echo $loan_type ?>" <?php if($_GET['ApplicationLoanType'] == $loan_type) { echo "selected='selected'"; } ?>>
                            <?php echo $loan_type; ?>
                        </option>
                    <?php } ?>
                </select>

                <select name="ApplicationReleasedTo">
                    <option value="">Released To</option>
                    <!-- set array values. if the value from array is equal to $_GET value, set it as selected -->
                    <?php $release_options = array("BDO Cash Card", "ML Wallet", "Palawan", "Cebuana"); ?>
                    <?php foreach($release_options as $release_option) { ?>
                        <option value="<?php echo $release_option; ?>" <?php if($_GET['ApplicationReleasedTo'] == $release_option) { echo "selected='selected'"; } ?>>
                            <?php echo $release_option; ?>
                        </option>
                    <?php } ?>
                </select>

                <input type="date" name="ApplicationDate" value="<?php echo $_GET['ApplicationDate']; ?>">

                <select name="ApplicationStatus">
                    <option value="">Select Status</option>
                    <!-- set array values. if the value from array is equal to $_GET value, set it as selected -->
                    <?php $application_statuses = array("Pending", "Completed", "Cancel"); ?>
                    <?php foreach($application_statuses as $application_status) { ?>
                        <option value="<?php echo $application_status; ?>" <?php if($_GET['ApplicationStatus'] == $application_status) { echo "selected='selected'"; } ?>>
                            <?php echo $application_status; ?>
                        </option>
                    <?php } ?>
                </select>

                <button type="submit" name="search-application-btn">Search</button>
            </form>  
            
            <br><br>

            <?php
            if(isset($_GET['search-application-btn'])) {
                $client_id = $_SESSION['ClientID'];
                $ApplicationLoanType = $_GET['ApplicationLoanType'];
                $ApplicationReleasedTo = $_GET['ApplicationReleasedTo'];
                $ApplicationDate = $_GET['ApplicationDate'];
                $ApplicationStatus = $_GET['ApplicationStatus'];

                $ApplicationLoanType = mysqli_real_escape_string($mysqli, $ApplicationLoanType);
                $ApplicationReleasedTo = mysqli_real_escape_string($mysqli, $ApplicationReleasedTo);
                $ApplicationDate = mysqli_real_escape_string($mysqli, $ApplicationDate);
                $ApplicationStatus = mysqli_real_escape_string($mysqli, $ApplicationStatus);

                $where = "WHERE TRUE ";

                if(!empty($ApplicationLoanType)) {
                    $where .= "AND LoanType = '$ApplicationLoanType'";
                }
                if(!empty($ApplicationReleasedTo)) {
                    $where .= "AND ReleaseTo = '$ApplicationReleasedTo'";
                }
                if(!empty($ApplicationDate)) {
                    $where .= "AND ApplicationDate = '$ApplicationDate'";
                }
                if(!empty($ApplicationStatus)) {
                    $where .= "AND ApplicationStatus = '$ApplicationStatus'";
                }

                $sql = "SELECT COUNT(*) FROM LoanApplication $where AND ClientID = '$client_id'";
                $result = mysqli_query($mysqli, $sql) or trigger_error("SQL", E_USER_ERROR);
                $row = mysqli_fetch_row($result);
                $numrows = $row[0];

                $rowsperpage = 20;
                $totalpages = ceil($numrows/$rowsperpage);

                if(isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
                    $currentpage = (int) $_GET['currentpage'];
                } else {
                    $currentpage = 1;
                }

                if($currentpage > $totalpages) {
                    $currentpage = $totalpages;
                }

                if($currentpage < 1) {
                    $currentpage = 1;
                }

                $offset = ($currentpage -1) * $rowsperpage;

                $x = 1;

                $sql = "SELECT * FROM LoanApplication $where AND ClientID = '$client_id' LIMIT $offset, $rowsperpage";
                $request = mysqli_query($mysqli, $sql) or TRIGGER_ERROR("SQL", E_USER_ERROR);

                if(mysqli_num_rows($request) > 0) {
            ?>

                    <div class="table_container">
                        <table class="tables">
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
                                                $date = date("M d Y", strtotime($result['ApplicationDate']));
                                                echo $date;
                                            ?>
                                        </td>
                                        <td class="<?php $AppStatus = $result['ApplicationStatus']; 
                                                        if($AppStatus == 'Pending') { echo 'yellow'; }
                                                        elseif($AppStatus == 'Solved') { echo 'green'; }
                                                        else { echo 'red'; }
                                        ?>">
                                            <?php echo $result['ApplicationStatus']; ?>
                                        </td>
                                        <td>
                                            <?php if($AppStatus == 'Pending') { ?>
                                                <a href="loan-application-edit.php?id=<?php echo $result['ApplicationID']; ?>">Edit</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php 
                                } //while end 
                                echo "<tr id='pagination_menu'>";
                                echo "<td colspan='10'>";

                                $range = 3;
                                if($currentpage > 1) {
                                    echo "<a class='btn_pagination' 
                                            href='{$_SERVER['PHP_SELF']}?currentpage=1&ApplicationLoanType=$ApplicationLoanType&ApplicationReleasedTo=$ApplicationReleasedTo&ApplicationDate=$ApplicationDate&ApplicationStatus=$ApplicationStatus'> 
                                        << 
                                    </a>";
                                    $prevpage = $currentpage -1;
                                }

                                for($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
                                    if(($x > 0) && ($x <= $totalpages)) {
                                        if($x == $currentpage) {
                                            echo "<b class='curr_page'>$x</b>";
                                        } else {
                                            echo " <a class='btn_pagination' href='{$_SERVER['PHP_SELF']}?currentpage=$x&ApplicationLoanType=$ApplicationLoanType&ApplicationReleasedTo=$ApplicationReleasedTo&ApplicationDate=$ApplicationDate&ApplicationStatus=$ApplicationStatus'>
                                                $x
                                            </a>";
                                        }
                                    }
                                }

                                if($currentpage != $totalpages) {
                                    $nextpage = $currentpage + 1;
                                    echo "<a class='btn_pagination' href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages&ApplicationLoanType=$ApplicationLoanType&ApplicationReleasedTo=$ApplicationReleasedTo&ApplicationDate=$ApplicationDate&ApplicationStatus=$ApplicationStatus'>
                                        >>
                                    </a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

            <?php
                } else {
                    echo "<br><div class='error-message'>
                        No application found.
                    </div>";
                }
            }
            ?>

        </div>

        <?php include_once "includes/footer.php"; ?>
    </div>
</body>
</html>