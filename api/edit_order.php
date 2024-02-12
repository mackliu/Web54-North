<?php
include_once "../library.php";

$order=q("select * from `orders` where `id`='{$_POST['id']}'")[0];
$sql="update `orders` set ";
$tmp=[];
foreach($_POST as $key => $value){
    if($key!='id'){
        $tmp[]="`$key`='$value'";
    }
}
$sql.=join(",",$tmp)." where `id`='{$_POST['id']}'";
$pdo->exec($sql);
q("delete from `room_booked` where `orderno`='{$_POST['no']}'");

if($_POST['start']==$_POST['end']){
    $sql="insert into `room_booked` (`date`,`roomnum`,`orderno`) values('{$_POST['start']}','{$order['roomnum']}','{$_POST['no']}')";
    $pdo->exec($sql);
}else{
    for($i=0;$i<$_POST['days'];$i++){
        $nextday=date("Y-m-d",strtotime("+$i days",strtotime($_POST['start'])));
        $sql="insert into `room_booked` (`date`,`roomnum`,`orderno`) values('{$nextday}','{$order['roomnum']}','{$_POST['no']}')";
        $pdo->exec($sql);
    }
}
