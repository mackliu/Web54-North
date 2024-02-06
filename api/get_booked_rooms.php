<?php include_once "../library.php";
$thisMonth=$pdo->query("select `date`, count(*) as 'rooms' from `room_booked` where year(`date`)='{$_GET['year']}' && month(`date`)='{$_GET['month']}' group by `date`")->fetchAll(PDO::FETCH_ASSOC);

$nextMonth=$pdo->query("select `date`, count(*) as 'rooms' from `room_booked` where year(`date`)='{$_GET['nextYear']}' && month(`date`)='{$_GET['nextMonth']}' group by `date`")->fetchAll(PDO::FETCH_ASSOC);
$thisRooms=[];
$nextRooms=[];


array_map(function($item)use(&$thisRooms){
    $thisRooms[date("d",strtotime($item['date']))]=$item['rooms'];
    } ,$thisMonth);

array_map(function($item)use(&$nextRooms){
    $nextRooms[date("d",strtotime($item['date']))]=$item['rooms'];
    } ,$nextMonth);

echo json_encode(['thisMonth'=>$thisRooms,'nextMonth'=>$nextRooms]);

