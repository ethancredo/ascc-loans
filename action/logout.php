<?php

session_name('ascc-loans');
session_start();
session_name('ascc-loans');
session_destroy();
header('location:../index.php');