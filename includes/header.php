<?php
if(!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
?>

<div class="header">
    <a href="index.php" class="main-icon">
        <img src="image/ascc_icon2020_red.png" class="middle" alt="aw">
    </a>
    <span class="company-name">Alano & Sons Credit Corporation</span>
    <?php if(isset($username)) { ?>
        <a href="my-profile.php" class="client-pill"><?php echo $username; ?></a>
    <?php } else {  ?>
        <a href="index.php" class="client-pill">Login</a>
    <?php } ?>
    <br clear="both">
</div>

