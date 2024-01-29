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

<div id="datepicker" class='container'></div>
<script src="./library/jquery/jquery.js"></script>
<script src="./library/jquery-ui-1.13.2/jquery-ui.js"></script>
<script src="./library/bootstrap/bootstrap.js"></script>
<script>
createCalendarRange(2024, 1, 2)

function createCalendar(year, month) {
    var date = new Date(year, month - 1, 1);
    var day = date.getDay();
    var days = new Date(year, month, 0).getDate();
    var str = `<div class='w-100 p-1'>`;
    str += "<table class='table table-bordered'>";
    str += "<tr><th>日</th><th>一</th><th>二</th><th>三</th><th>四</th><th>五</th><th>六</th></tr>";
    str += "<tr>";
    for (var i = 0; i < day; i++) {
        str += "<td></td>";
    }
    for (var i = 1; i <= days; i++) {
        if ((i + day - 1) % 7 == 0) {
            str += "<tr>";
        }
        str += `<td data-date='${i}'>`;
        str += `<div class='text-right'>${i}</div>`;
        str += "<div>$5000</div>";
        str += "<div>可訂:5</div>";
        str += "</td>";

        if ((i + day - 1) % 7 == 6) {
            str += "</tr>";
        }
    }
    str += "</table>"
    str +="</div>";
    return str;
}

function createCalendarRange(year, month) {
    let str = "";
    

    let nextMonth = month + 1;
    let nextYear = year;

    if (nextMonth > 12) {
        nextMonth -= 12;
        nextYear += 1;
    }
    str += `<div class='w-100 d-flex justify-content-between align-items-center'>`;
    str += `<div class='prev-month col-1 text-left' data-year='${year}' data-month='${month}'> << </div>`;
    str += `<div class='col-5 text-center'>${year}年${month}月</div>`;
    str += `<div class='col-5 text-center'>${nextYear}年${nextMonth}月</div>`;
    str += `<div class='next-month col-1 text-right' data-year='${nextYear}' data-month='${nextMonth}'> >> </div>`;
    str += "</div>";
    str += "<div class='d-flex'>";
    str += createCalendar(year, month);
    str += createCalendar( nextYear,nextMonth);
    str += "</div>";
    $("#datepicker").html(str);

    $(".next-month").on("click", function () {
    let year = $(this).data("year");
    let month = $(this).data("month");

    if (month+1 > 12) {
        month = 1;
        year += 1;
    }else{
        month += 1;
    }
    createCalendarRange(year, month);
})
    $(".prev-month").on("click", function () {
    let year = $(this).data("year");
    let month = $(this).data("month");

    if (month-1 < 1) {
        month = 12;
        year -= 1;
    }else{
        month -= 1;
    }
    createCalendarRange(year, month);
})
}



</script>
</body>
</html>
