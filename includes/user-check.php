<?php
    session_name('ascc-loans');
    session_start();
    if(!(isset($_SESSION['username']) and (!empty($_SESSION['username'])) and isset($_SESSION['ASCC-LOANS']) )) {
        header('location:index.php');
        session_name('ascc-loans');
        session_destroy();
    }