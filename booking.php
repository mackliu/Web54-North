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
</head>
<body>
<?php
$pt=pathinfo(__FILE__);
include "header.php";
?>
<main class="container">
    <!--萬年曆區塊-->
    <div id="datepicker"></div>

    <!--訂房資訊區塊-->
    <div class="booking-info form-group p-3 w-100">
        <div class="d-flex w-100">
            <div class="my-2 d-flex w-50">
                <label class='col-3 text-center'  for="rooms">訂房間數</label>
                <select name="rooms" id="rooms" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select>
            </div>
            <div class="my-2 d-flex w-50">
                <label class='col-3 text-center' for="days">入住天數</label>
                <input type="text" name="days" id="days" class="form-control">  
            </div>
        </div>
        <div class="my-2 d-flex w-100">
            <div class="my-2 d-flex w-50">
                <label class='col-3 text-center'  for="range">入住日期</label>
                <input type="text" name="start" id="start" class="form-control" disabled>  
            </div>
            <div class="my-2 d-flex w-50">
                <lable class="col-3 text-center">到</lable>
                <input type="text" name="end" id="end" class="form-control" disabled>  
            </div>
        </div>
        <div class="my-2 d-flex w-100">
            <div class="my-2 d-flex w-50">
                <label class='col-3 text-center'  for="roomnum">房號</label>
                <input type="text" name="roomnum" id="roomnum" class="form-control" disabled> 
            </div>
            <div class="my-2 d-flex w-50">
                <button class='col-4 mx-1 btn btn-success'>自動產生房號</button>
                <button class='col-4 mx-1 btn btn-info'>選擇房號</button>
            </div>
        </div>
        <div class="d-flex justify-content-around w-50">
            <button class="btn btn-primary">確定訂房</button>
            <button class="btn btn-warning">取消</button>
        </div>
    </div>
</main>
<script src="./library/jquery/jquery.js"></script>
<script src="./library/jquery-ui-1.13.2/jquery-ui.js"></script>
<script src="./library/bootstrap/bootstrap.js"></script>
<script>
let today = new Date((new Date()).getFullYear(),(new Date()).getMonth(),(new Date()).getDate(),0,0,0);
createCalendarRange(today.getFullYear(), today.getMonth()+1, today.getDate())

let selectedDateStart;
let selectedDateEnd;

function createCalendar(year, month) {
    let date = new Date(year, month - 1, 1);
    let day = date.getDay();
    let days = new Date(year, month, 0).getDate();
    let str = `<div class='w-100 p-1'>`;
    str += `<table class='table table-bordered' data-year='${year}' data-month='${month}'>`;
    str += "<tr><th>日</th><th>一</th><th>二</th><th>三</th><th>四</th><th>五</th><th>六</th></tr>";
    str += "<tr>";
    for (let i = 0; i < day; i++) {
        str += "<td></td>";
    }
    for (let i = 1; i <= days; i++) {
        let thisDay = new Date(year, month - 1, i);
        if ((i + day - 1) % 7 == 0) {
            str += "<tr>";
        }
        
        if(thisDay<today){
            str += `<td class='pass-date' data-date='${i}'>`;
        }else{
            str += `<td class='td-date' data-date='${i}'>`;
        }
        str += `<div class='col-day'>${i}</div>`;
        str += "<div class='col-price'>$5000</div>";
        str += "<div class='col-rooms'>可訂:5</div>";
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
    if(today.getFullYear() == year && today.getMonth()+1 == month){
        str += `    <div class='col-1 text-left' data-year='${year}' data-month='${month}' style='color:#999'> << </div>`;
    }else{
        str += `    <div class='prev-month col-1 text-left' data-year='${year}' data-month='${month}'> << </div>`;
    }
    str += `    <div class='col-5 text-center'>${year}年${month}月</div>`;
    str += `    <div class='col-5 text-center'>${nextYear}年${nextMonth}月</div>`;
    str += `    <div class='next-month col-1 text-right' data-year='${year}' data-month='${month}'> >> </div>`;
    str += "</div>";
    str += "<div class='d-flex'>";
    str += createCalendar(year, month);
    str += createCalendar( nextYear,nextMonth);
    str += "</div>";
    $("#datepicker").html(str);

    setEvents();
}

/**
 * 註冊萬年曆事件
 *
 */
function setEvents(){
    //註冊前一個月、下一個月按鈕事件
    $(".next-month , .prev-month").on("click", function () {
    let year = $(this).data("year");
    let month = $(this).data("month");

    if($(this).hasClass("next-month")){ //下個月
        if (month+1 > 12) {
            month = 1;
            year += 1;
        }else{
            month += 1;
        }
    }else{ //上個月
        if (month-1 < 1) {
            month = 12;
            year -= 1;
        }else{
            month -= 1;
        }
    }

        createCalendarRange(year, month);
    })

    //註冊日期選擇事件
    $(".td-date").on("click", function () {
        let year = $(this).parents("table").data("year");
        let month = $(this).parents("table").data("month");
        let day = $(this).data("date");
        let date = new Date(year, month - 1, day);
        let dayOfWeek = date.getDay();
        let str = "";
        str += `${year}年${month}月${day}日 星期${dayOfWeek}`;
        $("#start").val(str);
        $("#end").val(str);
        $("#days").val(1);
        /**
         * 每一次點擊日期時的判斷
         * 1. 開始和結束日期都還沒選擇
         *    a. 此時的點擊日期就是開始日期
         * 2. 開始日期已經選擇，結束日期還沒選擇
         *    a. 此時的點擊日期比開始日期還早，則將開始日期設為點擊日期，原本的開始日期變成結束日期
         *    b. 此時的點擊日期比開始日期還晚，則將結束日期設為點擊日期
         *    c. 此時的點擊日期和開始日期相同，取消開始日期的選擇
         * 3. 開始日期和結束日期都選擇了
         *    a. 此時的點擊日期和開始日期相同，取消整個日期選擇
         *    b. 此時的點擊日期和結束日期相同，取消結束日期的選擇
         *    c. 此時的點擊日期如果比開始日期還早，則將開始日期設為點擊日期，等於提前開始日期
         *    d. 此時的點擊日期如果比開始日期還晚，則將結束日期設為點擊日期，等於延後或提前結束日期
         * 4. 不可能有先選擇結束日期，再選擇開始日期的情況
         */

            //如果開始和結束日期都還沒選擇
        if(!selectedDateStart  && !selectedDateEnd){ 
            selectedDateStart = date;
            selectedDateEnd = null;
            $(this).addClass("start-date");
            fillBookingInfo(selectedDateStart,selectedDateStart);
        
        }else if(selectedDateStart && !selectedDateEnd){ //如果開始日期已經選擇，結束日期還沒選擇
            
            if(date > selectedDateStart){
                //如果選擇的日期比開始日期還晚，則將結束日期設為選擇的日期
                selectedDateEnd = date;
                $(this).addClass("end-date");
                fillBookingInfo(selectedDateStart,selectedDateEnd);
        
            }else if(date.getTime() == selectedDateStart.getTime()){
                //如果選擇的日期和開始日期相同，則取消開始日期的選擇
                selectedDateStart = null;
                $(this).removeClass("start-date");
            }else{
                //如果選擇的日期比開始日期還早，則將開始日期設為選擇的日期
                //alert("結束日期不能早於開始日期")
                selectedDateEnd = selectedDateStart;
                selectedDateStart = date;
                $('.start-date').addClass("end-date");
                $('.start-date').removeClass("start-date");
                $(this).addClass("start-date");        
                fillBookingInfo(selectedDateStart,selectedDateEnd);
            }

        }else{
            //如果開始日期和結束日期都選擇了
            console.log('開始日期和結束日期都選擇了',date.getTime(),selectedDateEnd.getTime())
            if(date.getTime() == selectedDateEnd.getTime()){
                //如果選擇的日期和結束日期相同，則取消結束日期的選擇
                selectedDateEnd = null;
                $(this).removeClass("end-date");

            }else if(date.getTime() == selectedDateStart.getTime()){
                //如果選擇的日期和開始日期相同，則取消整個日期選擇
                console.log('選擇的日期和開始日期相同')
                selectedDateStart = null;
                selectedDateEnd = null;
                $(this).removeClass("start-date");
                $('.end-date').removeClass("end-date");

            }else if(date < selectedDateStart){
                //如果選擇的日期比開始日期還早，則將開始日期設為選擇的日期
                selectedDateStart = date;
                $(".start-date").removeClass("start-date");
                $(this).addClass("start-date");
                fillBookingInfo(selectedDateStart,selectedDateEnd);

            }else if(date > selectedDateStart){
                //如果選擇的日期比開始日期還晚，則將結束日期設為選擇的日期
                selectedDateEnd = date;
                $('.end-date').removeClass("end-date");
                $(this).addClass("end-date");
                fillBookingInfo(selectedDateStart,selectedDateEnd);
            }
        }
        highlightRange(selectedDateStart,selectedDateEnd);
    })
}

/**
 * 填訂房資訊
 */
function fillBookingInfo(start,end){
    let day_list = ['日', '一', '二', '三', '四', '五', '六'];
    $("#start").val(`${start.getFullYear()}-${start.getMonth()}-${start.getDate()} 星期${day_list[start.getDay()]}`);
    $("#end").val(`${end.getFullYear()}-${end.getMonth()}-${end.getDate()} 星期${day_list[end.getDay()]}`);
    let days = ((end.getTime() - start.getTime()) / (1000 * 60 * 60 * 24))+1;
    $("#days").val(days);
}

/**
 * 取消訂房選擇
 */
function cancelSelect(){
    selectedDateStart = null;
    selectedDateEnd = null;
    $(".start-date").removeClass("start-date");
    $(".end-date").removeClass("end-date");
    $(".ui-datepicker-range").removeClass("ui-datepicker-range");
}

function highlightRange(){
    $(".td-date").each(function(){
        let year = $(this).parents("table").data("year");
        let month = $(this).parents("table").data("month");
        let day = $(this).data("date");
        let date = new Date(year, month - 1, day);
        if(date > selectedDateStart && date < selectedDateEnd){
            $(this).addClass("ui-datepicker-range");
        }else{
            $(this).removeClass("ui-datepicker-range");
        }
    })
}
</script>
</body>
</html>
