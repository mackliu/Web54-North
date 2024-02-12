<?php
    $orders=q("select * from `orders`");
?>
<table class='table'>
<tr>
    <td>訂單編號</td>
    <td>訂購時間</td>
    <td>姓名</td>
    <td>電話</td>
    <td>第一晚</td>
    <td>日數</td>
    <td>金額</td>
    <td>房號</td>
    <td>操作</td>
<?php
foreach($orders as $order){
?>
<tr>
    <td><?=$order['no'];?></td>
    <td><?=date("Y-m-d",strtotime($order['created_at']));?></td>
    <td><?=$order['name'];?></td>
    <td><?=$order['tel'];?></td>
    <td><?=$order['start'];?></td>
    <td><?=$order['days'];?></td>
    <td><?=$order['payment'];?></td>
    <td>room<?=sprintf("%02d",$order['roomnum']);?></td>
    <td>
        <button class="btn btn-primary" onclick="edit('orders',<?=$order['id'];?>)">編輯</button>
        <button class="btn btn-danger" onclick="del('orders',<?=$order['id'];?>)">刪除</button>
    </td>
</tr>
<?php
}
?>
</table>


<div id="modal">
    
</div>

<script>
function edit(table,id){
    $.post("admin/edit_order.php",{table,id},function(modal){
        $("#modal").html(modal);
        $("#editOrder").modal("show");
    })
}
function del(table,id){
    if(confirm("確定要刪除此筆資料?")){
        $.post("api/del.php",{table,id},function(res){
            location.reload();
        })
    }
}
</script>