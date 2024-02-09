<?php
include_once "../library.php";
if($_POST['ans']==$_SESSION['ans']){
    echo 1;
}else{
    echo 0;
}