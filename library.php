<?php
date_default_timezone_set("Asia/Taipei");
session_start();
$dsn="mysql:host=localhost;charset=utf8;dbname=travel";
$pdo=new PDO($dsn,"root","");
function q($sql){
    global $pdo;
    return $pdo->query($sql)->fetchAll();
}

?>