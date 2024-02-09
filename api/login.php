<?php
include_once "../library.php";
if($_POST['acc']=='admin' && $_POST['pw']=='1234'){
    $_SESSION['admin']=$_POST['acc'];
    echo 1;
}else{
    echo 0;
}