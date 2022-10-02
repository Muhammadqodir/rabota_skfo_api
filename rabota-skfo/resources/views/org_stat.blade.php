@extends("./layouts/cabinet")

@section("title")
- Мой кабинет
@endsection

@section('sub_title')
Статистика просмотров
@endsection

@section('content')
<div class="container">
	<div class="row" style="margin-top: 10px;">
		<!-- <div id="resumeView" class="col-sm-12 col-md-9 order-2 order-sm-2 order-md-1"> -->
		<div class="col-sm-12 col-md-9">
				Statistics
		</div>
		<!-- <div class="col-sm-12 col-md-3 order-1 order-sm-1 order-md-2" style="margin-top: 20px"> -->
		<div class="col-sm-12 col-md-3" style="margin-top: 20px">
			@include('inc.profile_widget')
		</div>
	</div>
</div>
@endsection

@section('js')
<script>
function copyLink() {
  var copyText = document.getElementById("resume_link");

  /* Select the text field */
  copyText.focus();
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

   /* Copy the text inside the text field */
  document.execCommand('copy')
  /* Alert the copied text */
  showAlert("Скопировано!");
}
</script>
@endsection