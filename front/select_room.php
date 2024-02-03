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
                        $selected=intval(mb_substr($_POST['roomnum'],4,2));

                        for($i=1;$i<=8;$i++){
                            echo "<div class='col-3 p2 my-2'>";
                            if($i==$selected){
                                echo "    <div class='text-center rounded bg-success border py-3'>";
                            }else{
                                echo "    <div class='text-center rounded border py-3'>";
                            }
                            echo "Room" . sprintf("%02d",$i);
                            echo "</div>";
                            echo "</div>";
                        }
                        ?>
                    </div>
                    <div class="p-3 mx-auto w-100 text-center">
                        <button class="btn btn-primary">確定選取</button>
                        <button class="btn btn-warning">取消選取</button>
                        <button class="btn btn-secondary">放棄離開</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>