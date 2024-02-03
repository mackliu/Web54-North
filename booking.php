<?php include_once "library.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>快樂旅遊網-訪客留言</title>
    <link rel="stylesheet" href="./library/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./library/fontawesome/fontawesome.css">
    <link rel="stylesheet" href="./library/jquery-ui-1.13.2/jquery-ui.css">
    <style>
        .col-price,.col-rooms{
            font-size: 14px;
        }
        #datepicker .table td{
            padding:0.25rem
        }
        .start-date{
            background-color: #ffcc99;
        }
        .end-date{
            background-color: #ffcc00;
        }
        .ui-datepicker-range {
            background-color: #ffddee;
        }
        .pass-date{
            background-color: #EEEEEE;
            color:#999999;
        }
    </style>
    <script src="./library/jquery/jquery.js"></script>
    <script src="./library/jquery-ui-1.13.2/jquery-ui.js"></script>
</head>
<body>
<?php
$pt=pathinfo(__FILE__);
include "header.php";
?>
<main class="container">

</main>


<script src="./library/bootstrap/bootstrap.js"></script>
</body>
</html>
<script>
$("main").load("./front/main.php")    
</script>
