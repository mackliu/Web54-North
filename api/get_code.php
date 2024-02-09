<?php
include_once "../library.php";
$_SESSION['ans'] = rand(1000,9999);
echo $_SESSION['ans'];