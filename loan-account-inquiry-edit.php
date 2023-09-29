<!DOCTYPE html>

<?php
    include_once 'includes/user-check.php';
    include_once 'includes/config.php';

    $id = $_GET['id'];

    $request = mysqli_query($mysqli, "SELECT * FROM LoanAccountInquiry WHERE InquiryID = $id");
    $result = mysqli_fetch_array($request);
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
                    <label for="InquiryType">Inquiry Type</label>
                    <select name="InquiryType" required>
                        <option value="">Select</option>
                        <?php $InquiryTypes = array("Salary Change", "Loan Balance"); ?>
                        <?php foreach($InquiryTypes as $InquiryType) { ?>
                            <option value="<?php echo $InquiryType; ?>" <?php if($result['InquiryType'] == $InquiryType) { echo "selected"; } ?> >
                                <?php echo $InquiryType; ?>
                            </option>
                        <?php } ?>
                    </select>
                </p>
                <p>
                    <label for="recipient">Send Inquiry to</label>
                    <select name="sendby" required>
                        <option value="<?php echo $result['SendInquiryTo'] ?>"><?php echo $result['SendInquiryTo'] ?></option>
                        <option value="Facebook Messenger">Facebook Messenger</option>
                        <option value="Email">Email</option>
                    </select>
                    <input type="text" name="recipient" placeholder="Enter recipient(email/account)" value="<?php echo $result['Recipient'] ?>" requied>
                </p>
                <p>
                    <label for="remarks">Remarks</label>
                    <input type="text" name="remarks" placeholder="Enter remarks" value=<?php echo $result['Remarks'] ?>>
                </p>
                <p>
                    <input type="submit" value="Submit" name="edit-inquire-account" class="button-full">
                    <input class="danger-button" value="Cancel" onclick="window.location.href='loan-account-inquiries.php';">
                </p>
            </form>
        </div>

        <?php include_once "includes/footer.php"; ?>
    </div>
</body>
</html>

<?php
    if(isset($_POST['edit-inquire-account'])) {
        $client_id = $_SESSION['ClientID'];
        $InquiryType = mysqli_real_escape_string($mysqli, $_POST['InquiryType']);
        $sendby = mysqli_real_escape_string($mysqli, $_POST['sendby']);
        $recipient = mysqli_real_escape_string($mysqli, $_POST['recipient']);
        $remarks = mysqli_real_escape_string($mysqli, $_POST['remarks']);

        if(empty($client_id) || empty($InquiryType) || empty($sendby) || empty($recipient)) {
            $error = "Some fields are empty!";
            echo "empty";
        } else {
            $result = mysqli_query($mysqli, "UPDATE LoanAccountInquiry SET InquiryType = '$InquiryType',
                                                                            SendInquiryTo = '$sendby', 
                                                                            Recipient = '$recipient', 
                                                                            Remarks = '$remarks'
                                                                        WHERE InquiryID = '$id'");

            echo "<script>
                alert('Success!');
                window.location.href = 'loan-account-inquiries.php';
            </script>";
        }
    }
?>