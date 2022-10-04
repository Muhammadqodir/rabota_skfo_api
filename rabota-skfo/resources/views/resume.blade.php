@extends("./layouts/cabinet")

@section("title")
- Мой кабинет
@endsection

@section('sub_title')
Мой кабинет
@endsection

@section('content')
<div class="container">
	<div class="row" style="margin-top: 10px;">
		<!-- <div id="resumeView" class="col-sm-12 col-md-9 order-2 order-sm-2 order-md-1"> -->
		<div id="resumeView" class="col-sm-12 col-md-9">
			<div id="tab_content" style="padding-top: 20px;">
				@if(Auth::user()->isResumeExist())
				<div class="input-group mb-3">
					<input type="text" onclick="copyLink()" value="{{route('public_resume', ['resume_id'=>Auth::user()->getResume()->id])}}" class="form-control" id="resume_link">
					<div class="input-group-append">
						<button class="btn btn-outline-secondary" onclick="copyLink()" type="button"><i class="far fa-copy"></i></button>
						<button class="btn btn-outline-secondary" onclick="window.open('{{route('student.view_resume')}}', '_blank').focus();" type="button"><i class="fas fa-mouse-pointer"></i></button>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<button onclick="window.location.href = '{{route('student.createCV')}}'" class="btnColor" style="margin-top: 12px;"><i class="fas fa-edit"></i> Редактировать резюме</button>
					</div>
					<div class="col-md-6 col-sm-12">
						<button onclick="window.open('{{route('student.view_resume').'?download=true'}}', '_blank').focus();" class="btnColorSuccess" style="margin-top: 12px;"><i class="fas fa-file-download"></i> Скачать резюме</button>
					</div>
				</div>
				@else
				<button onclick="window.location.href = '{{route('student.createCV')}}'" class="btnColor" style="max-width: 200px;	">Создать резюме</button><br>
				<img src="{{asset('res/illustrations/cv.png')}}" style="max-width: 300px; width: auto;">
				@endif
			</div>
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