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

    <title>ASCC: Loan Account Inquiries</title>
    <link rel="icon" type="image/x-icon" href="image/ascc-icon.png">
</head>
<body>
    <div class="container">
        <?php include_once "includes/header.php"; ?>

        <?php include_once "includes/main-menu.php"; ?>

        <div class="content">
            <div class="card">
                <h1>Loan Account Inquiries</h1>
                <p>
                    Leave search filter blank to search all.
                </p>
            </div>

            <br>

            <form action="" method="GET" class="search-form">
                <select name="InquiryType">
                    <option value="">Inquiry Type</option>
                    <?php $InquiryTypes = array("Salary Change", "Loan Balance"); ?>
                    <?php foreach($InquiryTypes as $InquiryType) { ?>
                        <option value="<?php echo $InquiryType; ?>" <?php if(isset($_GET['InquiryType'])) { if($_GET['InquiryType'] == $InquiryType) { echo "selected"; } } ?>>
                            <?php echo $InquiryType; ?>
                        </option>
                    <?php } ?>
                </select>

                <select name="InquirySentTo">
                    <option value="">Sent To</option>
                    <?php $sentto_list = array("Facebook Messenger", "Email"); ?>
                    <?php foreach($sentto_list as $sentto) { ?>
                        <option value="<?php echo $sentto ?>" <?php if(isset($_GET['InquirySentTo'])) { if($_GET['InquirySentTo'] == $sentto) { echo "selected"; } } ?> >
                            <?php echo $sentto; ?>
                        </option>
                    <?php } ?>
                </select>

                <input type="date" name="InquiryDate" value="<?php echo $_GET['InquiryDate']; ?>">

                <select name="InquiryStatus" id="">
                    <?php if(!empty($_GET['InquiryStatus'])) { ?>
                        <option value="<?php echo $_GET['InquiryStatus']; ?>"><?php echo $_GET['InquiryStatus']; ?></option>
                    <?php } ?>
                    <option value="">Select Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancel">Cancel</option>
                </select>
                
                <button type="submit" name="search-inquiry-btn">Search</button>
            </form>           

            <br><br>

            <?php
            if(isset($_GET['search-inquiry-btn'])) {
                $client_id = $_SESSION['ClientID'];
                $InquiryType = $_GET['InquiryType'];
                $InquirySentTo = $_GET['InquirySentTo'];
                $InquiryDate = $_GET['InquiryDate'];
                $InquiryStatus = $_GET['InquiryStatus'];

                $InquiryType = mysqli_real_escape_string($mysqli, $InquiryType);
                $InquirySentTo = mysqli_real_escape_string($mysqli, $InquirySentTo);
                $InquiryDate = mysqli_real_escape_string($mysqli, $InquiryDate);
                $InquiryStatus = mysqli_real_escape_string($mysqli, $InquiryStatus);

                $where = "WHERE TRUE ";

                if(!empty($InquiryType)) {
                    $where .= "AND InquiryType = '$InquiryType'";
                }
                if(!empty($InquirySentTo)) {
                    $where .= "AND SendInquiryTo = '$InquirySentTo'";
                }
                if(!empty($InquiryDate)) {
                    $where .= "AND InquiryDate = '$InquiryDate'";
                }
                if(!empty($InquiryStatus)) {
                    $where .= "AND InquiryStatus = '$InquiryStatus'";
                }

                $sql = "SELECT COUNT(*) FROM LoanAccountInquiry $where AND ClientID = '$client_id'";
                $result = mysqli_query($mysqli, $sql) or trigger_error("SQL", E_USER_ERROR);
                $row = mysqli_fetch_row($result);

                include_once 'includes/pagination.php';

                $sql = "SELECT * FROM LoanAccountInquiry $where AND ClientID = '$client_id' LIMIT $offset, $rowsperpage";
                $request = mysqli_query($mysqli, $sql) or TRIGGER_ERROR("SQL", E_USER_ERROR);

                if(mysqli_num_rows($request) > 0) {

            ?>

                    <div class="table_container">
                        <table class="tables">
                            <thead>
                                <th>#</th>
                                <th>Inquiry Type</th>
                                <th>Send Inquiry To</th>
                                <th>Recipient</th>
                                <th>Remarks</th>
                                <th>Inquiry Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php while($result = mysqli_fetch_array($request)) { ?>
                                    <tr>
                                        <td><?php echo $result['InquiryID']; ?></td>
                                        <td><?php echo $result['InquiryType']; ?></td>
                                        <td><?php echo $result['SendInquiryTo'] ?></td>
                                        <td><?php echo $result['Recipient']; ?></td>
                                        <td><?php echo $result['Remarks']; ?></td>
                                        <td>
                                            <?php 
                                                $date = date("M d, Y", strtotime($result['InquiryDate']));
                                                echo $date; 
                                            ?>
                                        </td>
                                        <td class="
                                            <?php if($result['InquiryStatus'] == 'Pending') { echo 'yellow'; } 
                                            elseif($result['InquiryStatus'] == 'Solved') { echo 'green'; }
                                            else { echo 'red'; } ?>
                                        ">
                                            <?php echo $result['InquiryStatus']; ?>
                                        </td>
                                        <td>
                                            <?php if($result['InquiryStatus'] == 'Pending') { ?>
                                            <a href="loan-account-inquiry-edit.php?id=<?php echo $result['InquiryID'] ?>">Edit</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } //while end
                                echo "<tr id='pagination_menu'>";
                                echo "<td colspan='10'>";

                                $range = 3;
                                if($currentpage > 1) {
                                    echo "<a class='btn_pagination' href='{$_SERVER['PHP_SELF']}?currentpage=1&InquirySentTo=$InquirySentTo&InquiryDate=$InquiryDate&InquiryStatus=$InquiryStatus'>
                                        <<
                                    </a>";
                                    $prevpage = $currentpage -1;
                                }

                                for($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
                                    if(($x > 0) && ($x <= $totalpages)) {
                                        if($x == $currentpage) {
                                            echo "<b class='curr_page'>$x</b>";
                                        } else {
                                            echo " <a class='btn_pagination' href='{$_SERVER['PHP_SELF']}?currentpage=$x&InquirySentTo=$InquirySentTo&InquiryDate=$InquiryDate&InquiryStatus=$InquiryStatus'>
                                                $x
                                            </a>";
                                        }
                                    }
                                }

                                if($currentpage != $totalpages) {
                                    $nextpage = $currentpage + 1;
                                    echo " <a class='btn_page' href='{$_SELF['PHP_SELF']}?currentpage=$totalpages&InquirySentTo=$InquirySentTo&InquiryDate=$InquiryDate&InquiryStatus=$InquiryStatus'>
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
                    echo "<br> <div class='error-message'>
                        No inquiry found.
                    </div>";
                }
            }
            ?>
            
        </div>

        <?php include_once "includes/footer.php"; ?>
    </div>
</body>
</html>