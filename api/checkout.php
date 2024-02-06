<?php
include_once "../library.php";
//計算今日訂單數，加1成為新訂單編號
$seq=$pdo->query("select count(*) from `orders` where year(`created_at`)='".date("Y")."' && month(`created_at`)='".date('m')."'")->fetchColumn()+1;
//在$_POST陣列中加入訂單編號
$_POST['no']=date("Ymd").sprintf("%04d",$seq);
//將存在session中的訂房資訊合併到$_POST陣列中
$_POST=array_merge($_POST,$_SESSION['booking']);
//建立insert指令
$sql="insert into `orders` (`".join('`,`',array_keys($_POST))."`) values('".join("','",$_POST)."')";   
//執行insert指令
$pdo->exec($sql);

if($_POST['start']==$_POST['end']){
    $sql="insert into `room_booked` (`date`,`roomnum`,`orderno`) values('{$_POST['start']}','{$_POST['roomnum']}','{$_POST['no']}')";
    $pdo->exec($sql);
}else{
    for($i=0;$i<$_POST['days'];$i++){
        $nextday=date("Y-m-d",strtotime("+$i days",strtotime($_POST['start'])));
        $sql="insert into `room_booked` (`date`,`roomnum`,`orderno`) values('{$nextday}','{$_POST['roomnum']}','{$_POST['no']}')";
        $pdo->exec($sql);
    }
}
?>

<h2 class="text-center m-3 border rounded bg-info p-3">訪客訂房-訂房完成</h2>
<!--連絡資訊填寫表單區塊-->
<h3 class="text-center">訂單編號:<?=$_POST['no'];?></h3>

<h4 class="text-center">感謝你的訂購，請記下上方的訂單編號，入住時出示訂單編號或登記姓名即可</h4>

<div class="d-flex justify-content-around mx-auto my-4 w-50">
    <button class="btn btn-primary" onclick="location.href='index.php'">回首頁</button>
</div>

