<?php include_once "../library.php";
/* $thisMonth=$pdo->query("select `date`, count(*) as 'rooms' from `room_booked` where year(`date`)='{$_GET['year']}' && month(`date`)='{$_GET['month']}' group by `date`")->fetchAll(PDO::FETCH_ASSOC);

$nextMonth=$pdo->query("select `date`, count(*) as 'rooms' from `room_booked` where year(`date`)='{$_GET['nextYear']}' && month(`date`)='{$_GET['nextMonth']}' group by `date`")->fetchAll(PDO::FETCH_ASSOC);
$thisRooms=[];
$nextRooms=[];


array_map(function($item)use(&$thisRooms){
    $thisRooms[date("d",strtotime($item['date']))]=$item['rooms'];
    } ,$thisMonth);

array_map(function($item)use(&$nextRooms){
    $nextRooms[date("d",strtotime($item['date']))]=$item['rooms'];
    } ,$nextMonth);

echo json_encode(['thisMonth'=>$thisRooms,'nextMonth'=>$nextRooms]); */

extract($_GET);
$orders=$pdo->query("select `date`,group_concat(`roomnum`) as 'roomnum' from `room_booked` where `date` between '{$start}' AND  '{$end}' group by `date`")->fetchAll(PDO::FETCH_ASSOC);

$orders=array_map(function($item){
    $item['roomnum']=array_unique(explode(",",$item['roomnum']));
    $item['count']=count($item['roomnum']);
    $item['year']=explode("-",$item['date'])[0];
    $item['month']=(int)explode("-",$item['date'])[1];
    $item['day']=(int)explode("-",$item['date'])[2];
    return $item;
},$orders);
$result=[];
$unirooms=[];
foreach($orders as $order){
    $result[$order['date']]=$order;
    $unirooms=array_merge($unirooms,$order['roomnum']);
}

$unirooms=array_unique($unirooms);
$rooms=["1","2","3","4","5","6","7","8"];
$diffrooms=array_diff($rooms,$unirooms);
sort($diffrooms);
sort($unirooms);
$result['unirooms']=$unirooms;
$result['diffrooms']=$diffrooms;
echo json_encode($result);