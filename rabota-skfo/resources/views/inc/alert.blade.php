
<div class="alert alertView alert-success" id="alert" role="alert">
    
</div>
<div class="alert alertView alert-danger" id="alertDanger" role="alert">
</div>
<script>
    showAlert = function($message){
        $("#alert").css('top', '110px')
        $("#alert").html($message);
        setTimeout(() => {
            $("#alert").css("top", "-110px");
        }, 3000);
    }
    showDangerAlert = function($message){
        $("#alertDanger").css('top', '110px')
        $("#alertDanger").html($message);
        setTimeout(() => {
            $("#alertDanger").css("top", "-110px");
        }, 3000);
    }
</script>

@if (session()->has('ev_message'))
<script>
    showAlert(session()->get('ev_message'));
</script>
@endif

@if (session()->has('alert'))
<script>
    setTimeout(()=>{
        showAlert('{{session()->get('alert')}}');
    }, 200)
</script>
@endif