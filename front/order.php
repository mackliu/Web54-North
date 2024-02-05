<?php 
//將訂房資訊存入session
session_start();
$_SESSION['booking']=$_POST;
?>
<h2 class="text-center m-3 border rounded bg-info p-3">訪客訂房-已選擇的訂房資訊再確認</h2>
<!--訂房資訊區塊-->
<div class="booking-info form-group p-3 w-100">
    <div class="d-flex w-100 my-2 ">
        <div class="d-flex w-50">
            <label class='col-3 text-center'  for="rooms">訂房間數</label>
            <input type="text" name="rooms" id="rooms" value="<?=$_POST['rooms'];?>" class="form-control">
        </div>
    </div>
    <div class="my-2 d-flex w-100">
        <div class="d-flex w-50">
            <label class='col-3 text-center'  for="roomnum">房號</label>
            <input type="text" name="roomnum" id="roomnum" value="<?=$_POST['roomnum'];?>" class="form-control" disabled> 
        </div>
    </div>        
    <div class="w-100 my-2 ">
        <div class="d-flex w-50">
            <label class='col-3 text-center' for="days">入住天數</label>
            <input type="text" name="days" id="days" value="<?=$_POST['days'];?>" class="form-control">  
        </div>
    </div>
    <div class="my-2 d-flex w-100">
        <div class="d-flex w-50">
            <label class='col-3 text-center'  for="range">入住日期</label>
            <input type="text" name="start" id="start" value="<?=$_POST['start'];?>" class="form-control" disabled>  
        </div>
        <div class="d-flex w-50">
            <lable class="col-3 text-center">到</lable>
            <input type="text" name="end" id="end" value="<?=$_POST['end'];?>" class="form-control" disabled>  
        </div>
    </div>
    <div class="w-100 my-2">
        <div class="w-50 d-flex">
            <label class="col-3 text-center" for="sum">總金額</label>
            <?php
            $sum = $_POST['rooms']*$_POST['days']*5000;
            ?>
            <input type="text" name="sum" id="sum" value="<?=$sum;?>" class="form-control">
        </div>
    </div>
    <div class="w-100 my-2">
        <div class="w-50 d-flex">
            <label class="col-3 text-center" for="deposit">需付訂金</label>
            <input type="text" name="deposit" id="deposit" value="<?=$sum*0.3;?>" class="form-control">
        </div>
    </div>
    <div class="d-flex justify-content-around w-50 my-4 mx-auto">
        <button class="btn btn-primary" onclick="loadpage('confirm')">確定訂房</button>
        <button class="btn btn-warning" onclick="cancelSelect()">取消</button>
    </div>
</div>

<script>
function loadpage(page){
    $("main").load("./front/"+page+".php");
}    
</script>