<?php
include_once "../library.php";
//計算今日訂單數
//$seq=$pdo->query("select count(*) from `orders` where year(`created-at`)='".date("Y")."' && month(`created-at`)='".date('m')."'")->fetchColumn()+1;
//$no=date("Ymd").sprintf("%04d",$seq);

$sql="insert into `orders` (`rooms`,
                            `start`,
                            `end`,
                            `roomnum`,
                            `no`,
                            `name`,
                            `tel`,
                            `email`,
                            `note,
                            `payment`,
                            `created_at`) 
                     values('".$_POST['rooms']."',
                            '".$_POST['start']."',
                            '".$_POST['end']."',
                            '".$_POST['roomnum']."',
                            '".$no."',
                            '".$_POST['name']."',
                            '".$_POST['tel']."',
                            '".$_POST['email']."',
                            '".$_POST['note']."',
                            '".$_POST['payment']."')";   
//$pdo->exec($sql);
?>

<h2 class="text-center m-3 border rounded bg-info p-3">訪客訂房-訂房完成</h2>
<!--連絡資訊填寫表單區塊-->
<h3 class="text-center">訂單編號:<?=$no;?></h3>

<h4 class="text-center">感謝你的訂購，請記下上方的訂單編號，入住時出示訂單編號或登記姓名即可</h4>

<div class="d-flex justify-content-around mx-auto my-4 w-50">
    <button class="btn btn-primary" onclick="location.href='index.php'">回首頁</button>
</div>

