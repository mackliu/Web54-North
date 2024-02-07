    <!--萬年曆區塊-->
    <div id="datepicker"></div>

    <!--訂房資訊區塊-->
    <div id="orderForm" class="booking-info form-group p-3 w-100">
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
                <button class='col-4 mx-1 btn btn-success' onclick="autoroom()">自動產生房號</button>
                <button class='select-room col-4 mx-1 btn btn-info' onclick="selectRoom()">選擇房號</button>
            </div>
        </div>
        <div class="d-flex justify-content-around w-50 mx-auto my-4">
            <button class="btn btn-primary" onclick="order()">確定訂房</button>
            <button class="btn btn-warning" onclick="cancelSelect()">取消</button>
        </div>
    </div>
    <div id="modal">

    </div>
    <div id="confirm"></div>


    <script>
let today = new Date((new Date()).getFullYear(),(new Date()).getMonth(),(new Date()).getDate(),0,0,0);
createCalendarRange(today.getFullYear(), today.getMonth()+1, today.getDate())

let selectedDateStart;
let selectedDateEnd;

function selectRoom(){
    if(!selectedDateStart){
        alert("請先選擇入住日期");
        return;
    }
    let start=`${selectedDateStart.getFullYear()}-${String(selectedDateStart.getMonth()+1).padStart(2,'0')}-${String(selectedDateStart.getDate()).padStart(2,'0')}`;
    
    $.get("./api/get_booked_rooms.php",{start,end:start},(bookedRooms)=>{
        bookedRooms=JSON.parse(bookedRooms);
        $.post("./front/select_room.php",{start,bookedRooms},function(rooms){
            $("#modal").html(rooms);
        
        
            $("#selectRoom").modal("show");
        })
    })
}

function autoroom(){
    if(!selectedDateStart){
        alert("請先選擇入住日期");
        return;
    }
    let start,end;
        start=`${selectedDateStart.getFullYear()}-${String(selectedDateStart.getMonth()+1).padStart(2,'0')}-${String(selectedDateStart.getDate()).padStart(2,'0')}`;
    if(selectedDateEnd==null){
        end=start;
    }else{
        end=`${selectedDateEnd.getFullYear()}-${String(selectedDateEnd.getMonth()+1).padStart(2,'0')}-${String(selectedDateEnd.getDate()).padStart(2,'0')}`;
    }
    $.get("./api/get_booked_rooms.php",{start,end},function(bookedRooms){
        bookedRooms=JSON.parse(bookedRooms);
        let seed=Math.floor(Math.random()*bookedRooms.diffrooms.length);
        let roomnum=bookedRooms.diffrooms[seed];
        $("#roomnum").val(`room${String(roomnum).padStart(2,'0')}`);
    })
}

function order(){
    //取得表單各欄位資料
    let order={rooms:parseInt($("#rooms").val()),
               days:parseInt($("#days").val()),
               start:$("#start").val().split(" ")[0],
               end:$("#end").val().split(" ")[0],
               roomnum:parseInt($("#roomnum").val().replace("room","")),
               payment:parseInt($("#rooms").val())*parseInt($("#days").val())*5000,
            };

        $.post("./front/order.php",order,function(res){
            $("main").html(res);
        })  
}

/**
 * 產生指定年月的月曆
 * 回傳值為月曆的html字串
 */
function createCalendar(year, month,rooms) {
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
        let dateStr=`${year}-${String(month).padStart(2,'0')}-${String(i).padStart(2,'0')}`

        if ((i + day - 1) % 7 == 0) {
            str += "<tr>";
        }
        
        if(thisDay<today){
            str += `<td class='pass-date' data-date='${i}' data-fulldate='${dateStr}'>`;
        }else{
            str += `<td class='td-date' data-date='${i}' data-fulldate='${dateStr}'>`;
        }
        str += `<div class='col-day'>${i}</div>`;
        str += "<div class='col-price'>$5000</div>";
        if(rooms[dateStr]!==undefined){
            str += `<div class='col-rooms'>可訂:${8-rooms[dateStr].count}</div>`;
        }else{
            str += "<div class='col-rooms'>可訂:8</div>";
        }
        str += "</td>";

        if ((i + day - 1) % 7 == 6) {
            str += "</tr>";
        }
    }
    str += "</table>"
    str +="</div>";
    return str;
}

//產生指定年月的跨月月曆
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
    start=`${year}-${String(month).padStart(2,'0')}-01`;
    end=`${nextYear}-${String(nextMonth).padStart(2,'0')}-${(new Date(nextYear,nextMonth,0).getDate())}`;

    $.get("./api/get_booked_rooms.php",{start,end},function(bookedRooms){
        bookedRooms=JSON.parse(bookedRooms);
        str += createCalendar(year, month,bookedRooms);
        str += createCalendar( nextYear,nextMonth,bookedRooms);
        str += "</div>";
        $("#datepicker").html(str);
    
        setEvents();
    })
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
        let date = new Date(year, month-1, day);
        let dayOfWeek = date.getDay();
        let str = "";
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
        
        }else if(selectedDateStart && !selectedDateEnd){ //如果開始日期已經選擇，結束日期還沒選擇
            
            if(date > selectedDateStart){
                //如果選擇的日期比開始日期還晚，則將結束日期設為選擇的日期
                selectedDateEnd = date;
                $(this).addClass("end-date");
                $(".select-room").attr("disabled",true);
        
            }else if(date.getTime() == selectedDateStart.getTime()){
                //如果選擇的日期和開始日期相同，則取消開始日期的選擇
                selectedDateStart = null;
                $(this).removeClass("start-date");
                $(".select-room").attr("disabled",false);
            }else{
                //如果選擇的日期比開始日期還早，則將開始日期設為選擇的日期
                //alert("結束日期不能早於開始日期")
                selectedDateEnd = selectedDateStart;
                selectedDateStart = date;
                $('.start-date').addClass("end-date");
                $('.start-date').removeClass("start-date");
                $(this).addClass("start-date");
                $(".select-room").attr("disabled",true);        
            }

        }else{
            //如果開始日期和結束日期都選擇了
            if(date.getTime() == selectedDateEnd.getTime()){
                //如果選擇的日期和結束日期相同，則取消結束日期的選擇
                selectedDateEnd = null;
                $(this).removeClass("end-date");
                $(".select-room").attr("disabled",false)

            }else if(date.getTime() == selectedDateStart.getTime()){
                //如果選擇的日期和開始日期相同，則取消整個日期選擇
                selectedDateStart = null;
                selectedDateEnd = null;
                $(this).removeClass("start-date");
                $('.end-date').removeClass("end-date");
                $(".select-room").attr("disabled",false)

            }else if(date < selectedDateStart){
                //如果選擇的日期比開始日期還早，則將開始日期設為選擇的日期
                selectedDateStart = date;
                $(".start-date").removeClass("start-date");
                $(this).addClass("start-date");
                $(".select-room").attr("disabled",true);

            }else if(date > selectedDateStart){
                //如果選擇的日期比開始日期還晚，則將結束日期設為選擇的日期
                selectedDateEnd = date;
                $('.end-date').removeClass("end-date");
                $(this).addClass("end-date");
                $(".select-room").attr("disabled",true);

            }
        }
        highlightRange(selectedDateStart,selectedDateEnd);
        fillBookingInfo(selectedDateStart,selectedDateEnd);
    })
}

/**
 * 填訂房資訊
 */
function fillBookingInfo(start,end){
    let day_list = ['日', '一', '二', '三', '四', '五', '六'];
    let days;
    if(!start && !end){
        //沒有日期選擇時，清空訂房資訊
        $("#start").val("");
        $("#end").val("");
        days=0;
        $("#days").val(days);
        $("#roomnum").val("");
    }else if(start && !end){
        //開始日期有選擇，結束日期沒有選擇時，開始和結束日為同一天，天數設為1
        $("#start").val(`${start.getFullYear()}-${start.getMonth()+1}-${start.getDate()} 星期${day_list[start.getDay()]}`);
        $("#end").val(`${start.getFullYear()}-${start.getMonth()+1}-${start.getDate()} 星期${day_list[start.getDay()]}`);
        days=1;
        $("#days").val(days);
        if($("#roomnum").val() == ""){
        }
    }else if(start && end){
        //開始日期和結束日期都有選擇時，填入開始和結束日期，計算天數
        $("#start").val(`${start.getFullYear()}-${start.getMonth()+1}-${start.getDate()} 星期${day_list[start.getDay()]}`);
        $("#end").val(`${end.getFullYear()}-${end.getMonth()+1}-${end.getDate()} 星期${day_list[end.getDay()]}`);
        days=((end.getTime() - start.getTime()) / (1000 * 60 * 60 * 24))+1;
        $("#days").val(days);
        if($("#roomnum").val() == ""){
        }
    }
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
    fillBookingInfo(selectedDateStart,selectedDateEnd);
}

/**
 * 高亮選擇的日期區間
 */
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