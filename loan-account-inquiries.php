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

            <form action="loan-account-inquiries-search.php" method="GET" class="search-form">
                <select name="InquiryType">
                    <option value="">Inquiry Type</option>
                    <?php $InquiryTypes = array("Salary Change", "Loan Balance"); ?>
                    <?php foreach($InquiryTypes as $InquiryType) { ?>
                        <option value="<?php echo $InquiryType; ?>" >
                            <?php echo $InquiryType; ?>
                        </option>
                    <?php } ?>
                </select>
                <select name="InquirySentTo">
                    <option value="">Sent To</option>
                    <option value="Facebook Messenger">Facebook Messenger</option>
                    <option value="Email">Email</option>
                    <option value="Text Message">Text Message</option>
                </select>
                <input type="date" name="InquiryDate" id="">
                <select name="InquiryStatus" id="">
                    <option value="">Select Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancel">Cancel</option>
                </select>
                <button type="submit" name="search-inquiry-btn">Search</button>
            </form>            

            <br> <br>

            <?php
            $client_id = $_SESSION['ClientID'];
            $request = mysqli_query($mysqli, "SELECT i.*, c.* FROM LoanAccountInquiry i LEFT JOIN client c 
                                        ON i.ClientID = c.ClientID
                                        WHERE i.InquiryStatus = 'Pending' AND c.ClientID = '$client_id'
                                        ORDER BY InquiryDate ASC");

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
                                    <td><?php echo $result['SendInquiryTo']; ?></td>
                                    <td><?php echo $result['Recipient']; ?></td>
                                    <td><?php echo $result['Remarks']; ?></td>
                                    <td>
                                        <?php 
                                            $date = date("M d Y", strtotime($result['InquiryDate']));
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
                                    <td><a href="loan-account-inquiry-edit.php?id=<?php echo $result['InquiryID'] ?>">Edit</a></td>
                                </tr>
                            <?php } //while end ?>
                        </tbody>
                    </table>
                </div>

            <?php
            } else {
                echo "<br> <div class='error-message'>
                    No request found!
                </div>";
            }
            ?>
            
        </div>

        <?php include_once "includes/footer.php"; ?>
    </div>
</body>
</html>