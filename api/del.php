<?php include_once "../library.php";

if($_POST['table']=='orders'){
    $order=q("select * from `orders` where `id`='{$_POST['id']}'");

    q("delete from `room_booked` where `orderno`='{$order[0]['no']}'");
}
q("delete from `{$_POST['table']}` where `id`='{$_POST['id']}'");