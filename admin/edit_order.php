<?php include_once "../library.php";
$order=q("select * from `orders` where `id`='{$_POST['id']}'")[0];
?>
<div class="modal fade" id="editOrder" tabindex="-1" role="dialog" aria-labelledby="editOrder" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-center">編輯訂單</h3>
                <button type='button' class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-wrap">
                    <div class="d-flex w-100 my-2 ">
                        <div class="d-flex w-50">
                            <label class='col-3 text-center'  for="no">訂房編號</label>
                            <input type="text" name="no" id="no" value="<?=$order['no'];?>" class="form-control">
                        </div>
                    </div>
                    <div class="my-2 d-flex w-100">
                        <div class="d-flex w-50">
                            <label class='col-3 text-center'  for="range">入住日期</label>
                            <input type="text" name="start" id="start" value="<?=$order['start'];?>" class="form-control" >  
                        </div>
                        <div class="d-flex w-50">
                            <lable class="col-3 text-center">到</lable>
                            <input type="text" name="end" id="end" value="<?=$order['end'];?>" class="form-control" >  
                        </div>
                    </div>                    
                    <div class="my-2 d-flex w-100">
                        <div class="d-flex w-50">
                            <label class='col-3 text-center'  for="roomnum">房號</label>
                            <input type="text" name="roomnum" id="roomnum" value="room<?=sprintf("%02d",$order['roomnum']);?>" class="form-control" disabled> 
                        </div>
                    </div>   
                    <div class="my-2 d-flex w-100">
                        <div class="d-flex w-50">
                            <label class='col-3 text-center'  for="name">姓名</label>
                            <input type="text" name="name" id="name" value="room<?=$order['name'];?>" class="form-control"> 
                        </div>
                        <div class="d-flex w-50">
                            <label class='col-3 text-center'  for="tel">電話</label>
                            <input type="text" name="tel" id="tel" value="room<?=$order['tel'];?>" class="form-control"> 
                        </div>
                    </div>   
                    <div class="my-2 d-flex w-100">
                        <div class="d-flex w-50">
                            <label class='col-3 text-center'  for="email">email</label>
                            <input type="text" name="email" id="email" value="room<?=$order['email'];?>" class="form-control"> 
                        </div>
                    </div>   
                    <div class="my-2 d-flex w-100">
                        <div class="d-flex w-50">
                            <label class='col-3 text-center'  for="note">備註</label>
                            <textarea name="note" id="note" class="form-control"><?=$order['note'];?></textarea> 
                        </div>
                    </div>   
                    <div class=" my-2 d-flex w-100">
                        <div class="w-50 d-flex">
                            <label class="col-3 text-center" for="payment">總金額</label>
                            <input type="text" name="payment" id="payment" value="<?=$order['payment'];?>" class="form-control">
                        </div>
                        <div class="w-50 d-flex">
                            <label class="col-3 text-center" for="deposit">需付訂金</label>
                            <input type="text" name="deposit" id="deposit" value="<?=$order['payment']*0.3;?>" class="form-control">
                        </div>                        
                    </div>
                    <div class="p-3 mx-auto w-100 text-center">
                        <input type="hidden" name="days" id="days" value="<?=$order['days'];?>">
                        <button class="ok btn btn-primary">確定修改</button>
                        <button class="cancel btn btn-warning">取消</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>


$("#start,#end").on('change',function(){
    let start=$("#start").val();
    let end=$("#end").val();
    let days=((new Date(end)-new Date(start))/(1000*60*60*24))+1;
    $("#days").val(days);
    $("#payment").val(days*5000);
    $("#deposit").val(days*5000*0.3);
})

$(".cancel").on("click",function(){
    $("#editOrder").modal("hide");
});

$("#editOrder").on("hidden.bs.modal",function(){
    $("#editOrder").modal("dispose");
    $("#modal").html("");
});

$(".ok").on("click",function(){
    let order={
        id:<?=$order['id'];?>,
        no:$("#no").val(),
        start:$("#start").val(),
        end:$("#end").val(),
        name:$("#name").val(),
        tel:$("#tel").val(),
        email:$("#email").val(),
        rooms:$("#rooms").val(),
        note:$("#note").val(),
        payment:$("#payment").val(),
        days:$("#days").val()
    }
    $.post("api/edit_order.php",order,function(){
        location.reload();
    })
});
</script>