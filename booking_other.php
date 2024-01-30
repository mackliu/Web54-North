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
.ui-datepicker-range {
  background-color: #ffcc99;
}
.ui-datepicker-range .ui-state-default {
  background-color: #ffcc99;
}
/* .ui-widget {
  width:100%!important;
} */
</style>
</head>
<body>
<?php
$pt=pathinfo(__FILE__);
include "header.php";
?>
<main class="container">
    <div id="datepicker" class="w-100"></div>
    <div class="booking-info form-group p-3 w-100">
        <div class="my-2 d-flex">
            <label class='col-3'  for="rooms">訂房間數</label>
            <input type="text" name="rooms" id="rooms" class="form-control">  
        </div>
        <div class="my-2 d-flex">
            <label class='col-3' for="days">入住天數</label>
            <input type="text" name="days" id="days" class="form-control">  
        </div>
        <div class="my-2 d-flex">
            <label class='col-3'  for="range">入住日期</label>
            <input type="text" name="start" id="start" class="form-control">  
            到
            <input type="text" name="end" id="end" class="form-control">  
        </div>
        <div class="my-2 d-flex">
            <label class='col-3 mx-1'  for="roomnum">房號</label>
            <input class='col-3 mx-1'  type="text" name="roomnum" id="roomnum" class="form-control"> 
            <button class='col-3 mx-1 btn btn-success'>自動產生房號</button>
            <button class='col-3 mx-1 btn btn-info'>選擇房號</button>
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
</body>
</html>
<script>
//$("#datepicker").datepicker();    

var selectedDateStart;
  var selectedDateEnd;

  $('#datepicker').datepicker({
    onSelect: function(dateText, inst) {
      var date = $(this).datepicker('getDate');
      if (!selectedDateStart || (selectedDateEnd && selectedDateStart)) {
        selectedDateStart = date;
        selectedDateEnd = null;
      } else if (selectedDateStart && !selectedDateEnd) {
        if (date >= selectedDateStart) {
          selectedDateEnd = date;
        } else {
          selectedDateEnd = selectedDateStart;
          selectedDateStart = date;
        }
        highlightRange(selectedDateStart, selectedDateEnd);
        
      }
    },
    beforeShowDay: function(date) {
      var cssClass = '';
      if (date >= selectedDateStart && date <= selectedDateEnd) {
        cssClass = 'ui-datepicker-range';
      }

      return [true, cssClass,"<a>123</a>"];
    },
    numberOfMonths: 2,
    showButtonPanel: true,
    autoSize:true,
  });
  

  function highlightRange(start, end) {
    $('#datepicker').find('.ui-datepicker-calendar a').each(function() {
      var day = $(this).data('date');
      var month = $(this).closest('td').data('month') + 1;
      var year = $(this).closest('td').data('year');

      // 確保月份和日期總是雙位數
      month = month < 10 ? '0' + month : month;
      day = day < 10 ? '0' + day : day;

      var dateString = year + '-' + month + '-' + day;
      var currentDate = $.datepicker.parseDate('yy-mm-dd', dateString);

      if (currentDate >= start && currentDate <= end) {
        $(this).addClass('ui-datepicker-range');
    } else {
        $(this).removeClass('ui-datepicker-range');
        
      }
    });

  }

</script>