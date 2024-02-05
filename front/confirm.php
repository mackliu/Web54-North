
<h2 class="text-center m-3 border rounded bg-info p-3">訪客訂房-填寫連絡方式</h2>
<!--連絡資訊填寫表單區塊-->
<div class="booking-info form-group p-3 w-50 m-auto">
    <div class="d-flex w-100 my-2 ">
        <label class='col-3 text-center'  for="name">姓名</label>
        <input type="text" name="name" id="name" value="" class="form-control">
    </div>
    <div class="my-2 d-flex w-100">
        <label class='col-3 text-center'  for="email">E-mail</label>
        <input type="text" name="email" id="email" value="" class="form-control" > 
    </div>        
    <div class="w-100 d-flex my-2 ">
        <label class='col-3 text-center' for="tel">電話</label>
        <input type="text" name="tel" id="tel" value="" class="form-control">  
    </div>
    <div class="w-100 d-flex my-2 ">
        <label class='col-3 text-center' for="note">備註</label>
        <textarea name="note" id="note" style="width:75%;height:100px" class="form-control"></textarea>
    </div>
    <div class="d-flex justify-content-around mx-auto my-4 w-50">
        <button class="btn btn-primary" onclick='checkout()'>送出</button>
        <button class="btn btn-warning">重設</button>
    </div>
</div>

<script>
    function checkout(){
        let form={
            name:$("#name").val(),
            email:$("#email").val(),
            tel:$("#tel").val(),
            note:$("#note").val()
        }
        $.post("./api/checkout.php",form,function(res){
            $("main").html(res);
        })
    }
</script>