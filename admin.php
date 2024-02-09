<?php include_once "library.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>快樂旅遊網-網站管理</title>
    <link rel="stylesheet" href="./library/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./library/fontawesome/fontawesome.css">
    <script src="./library/jquery/jquery.js"></script>
</head>
<body>

<?php
$pt=pathinfo(__FILE__);
include "header.php";

if(isset($_SESSION['admin'])){
?>
<div class="container d-flex justify-content-around align-items-center my-3" >
    <a href="admin.php?do=messages" class="btn btn-info px-3">留言管理</a>
    <a href="admin.php?do=rooms" class="btn btn-info px-3">訂房管理</a>
    <a href="admin.php?do=foods" class="btn btn-info px-3">訂餐管理</a>
</div>
<main class="container">
    <?php

        $do=$_GET['do']??'messages';
        $file="./admin/".$do.".php";
        if(file_exists($file)){
            include $file;
        }else{
            include "./admin/messages.php";
        }
  
    ?>
</main>
<?php
}else{
?>
<main class="container">
    <div>
        <h1 class="text-center my-3">管理登入</h1>
        <table class="w-50 mx-auto my-3 form-group">
            <tr>
                <td class="py-3">帳號</td>
                <td class="py-3"><input class='form-control' type="text" name="acc" id="acc"></td>
            </tr>
            <tr>
                <td class="py-3">密碼</td>
                <td class="py-3"><input class='form-control' type="password" name="pw" id="pw"></td>
            </tr>
            <tr>
                <td class="py-3">圖片驗證碼</td>
                <td class="py-3">
                    <div class="mb-2"><input class='form-control' type="text" name="ans" id="ans"></div>
                    <div class="d-flex justify-content-between">
                        <div class="border rounded w-50 mr-2 d-flex justify-content-center align-items-center" id="code"></div>
                        <button class="btn btn-info w-50" onclick="getCode()">驗證碼重新產生</button>
                    </div>
                </td>
            </tr>
        </table>
        <div class="text-center">
            <button class="btn btn-primary" onclick="login()">送出</button>
            <button class="btn btn-warning" onclick="clean()">重設</button>
        </div>
    </div>
</main>
<?php
}
?>


<script src="./library/bootstrap/bootstrap.js"></script>
</body>
</html>
<script>
getCode();
function getCode(){
    $.get("./api/get_code.php",function(res){
        $("#code").text(res);
    })

}
function login(){
    let acc=$("#acc").val();
    let pw=$("#pw").val();
    let ans=$("#ans").val();
    $.post("./api/chk_code.php",{ans},function(res){
        if(parseInt(res)==1){
            $.post("./api/login.php",{acc,pw},function(res){
                console.log(res);
                if(parseInt(res)==1){
                    location.reload();
                }else{
                    alert("帳號或密碼錯誤");
                }
            })
        }else{
            alert("驗證碼錯誤");
        }
    })
}
function clean(){
    $("#acc").val("");
    $("#pw").val("");
    $("#ans").val("");
}
</script>