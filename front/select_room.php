<div class="modal fade" id="selectRoom" tabindex="-1" role="dialog" aria-labelledby="selectRoom" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-center">訪客訂房-選擇房間</h3>
                <button type='button' class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-wrap">
                    <div class="p-3 w-100">
                        <div class="w-25 border rounded mx-auto p-3 text-center"><?=$_POST['start'];?></div>
                    </div>
                    <div class="p-3 w-100 d-flex flex-wrap">
                        <?php
                        $bookedRooms=$_POST['bookedRooms']['unirooms']??[];
                        for($i=1;$i<=8;$i++){
                            echo "<div class='col-3 p2 my-2' data-num='$i'>";
                            if(in_array($i,$bookedRooms)){
                                echo "  <div class='text-center rounded border py-3 bg-secondary text-light' style='cursor:not-allowed'>";
                                echo    "Room" . sprintf("%02d",$i);
                                echo "(己訂)";
                            }else{
                                echo "  <div class='can-booking text-center rounded border py-3' style='cursor:pointer'>";
                                echo    "Room" . sprintf("%02d",$i);
                            }

                            echo "  </div>";
                            echo "</div>";
                        }
                        ?>
                    </div>
                    <div class="p-3 mx-auto w-100 text-center">
                        <button class="ok btn btn-primary">確定選取</button>
                        <button class="cancel btn btn-warning">取消選取</button>
                        <button class="quick btn btn-secondary">放棄離開</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(".quick").on("click",function(){
    $("#selectRoom").modal("hide");
    $("#selectRoom").on("hidden.bs.modal",function(){
        $("#selectRoom").modal("dispose");
        $("#modal").html("");
    });
});
$(".can-booking").on("click",function(){
    if($(this).hasClass("bg-info")){
        $(this).removeClass("bg-info");
    }else{
        $(".can-booking").removeClass("bg-info");
        $(this).addClass("bg-info");
    }
});
$(".cancel").on("click",function(){
    $(".can-booking").removeClass("bg-info");
});
$(".ok").on("click",function(){
    let roomnum=$(".can-booking.bg-info").parent().data("num");
    if(roomnum){
        $("#selectRoom").modal("hide");
        $("#selectRoom").on("hidden.bs.modal",function(){
            $("#selectRoom").modal("dispose");
            $("#modal").html("");
            $("#roomnum").val(`room${String(roomnum).padStart(2,"0")}`);
        });
    }else{
        alert("請選擇房間");
    }
});
</script>