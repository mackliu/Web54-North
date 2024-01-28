
<header class='d-flex bg-success' style="height:80px">
<div class="container d-flex justify-content-around">
    <a href="index.php" class="d-flex align-items-center text-center px-3 btn btn-success <?=($pt['filename']=='index')?'active':'';?>">首頁</a>
    <a href="message.php" class="d-flex align-items-center text-center px-3 btn btn-success <?=($pt['filename']=='message')?'active':'';?>">訪客留言</a>
    <a href="booking.php" class="d-flex align-items-center text-center px-3 btn btn-success <?=($pt['filename']=='booking')?'active':'';?>">訪客訂房</a>
    <a href="food.php" class="d-flex align-items-center text-center px-3 btn btn-success <?=($pt['filename']=='food')?'active':'';?>">訪客訂餐</a>
    <a href="traffic.php" class="d-flex align-items-center text-center px-3 btn btn-success <?=($pt['filename']=='traffic')?'active':'';?>">交通資訊</a>
    <a href="admin.php" class="d-flex align-items-center text-center px-3 btn btn-success <?=($pt['filename']=='admin')?'active':'';?>">網站管理</a>
</div>
</header>