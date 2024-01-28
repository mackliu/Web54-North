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
</head>
<body>
<?php
$pt=pathinfo(__FILE__);
include "header.php";
?>

<div id="datepicker"></div>
<script src="./library/jquery/jquery.js"></script>
<script src="./library/jquery-ui-1.13.2/jquery-ui.js"></script>
<script src="./library/bootstrap/bootstrap.js"></script>
</body>
</html>
<script>
$("#datepicker").datepicker();    
</script>