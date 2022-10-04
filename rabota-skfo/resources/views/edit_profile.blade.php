@extends("./layouts/app")

@section("title")
- Редактировать профиль
@endsection

@section('sub_title')
- Редактировать профиль
@endsection

@section('content')
<div class="container" style="margin-top: 10px; margin-bottom: 20px">
	<div class="row">
		<div class="col-md-9">
			@if(Auth::user()->role == "university")
				<a class="btn btn-primary" href="{{route('univer.students')}}"><i class="fas fa-arrow-left"></i> Назад</a>
			@endif
			@if(Auth::user()->role == "moderator")
				@if($user->role == "student")
					<a class="btn btn-primary" href="{{route('moderator.students')}}"><i class="fas fa-arrow-left"></i> Назад</a>
				@else
					<a class="btn btn-primary" href="{{route('moderator.univers')}}"><i class="fas fa-arrow-left"></i> Назад</a>
				@endif
			@endif
            <h5 style="margin-top: 12px;">Редактировать профиль</h5>
			@if($user->role == "student")
				@include('inc.st_profile')
			@endif
			@if($user->role == "university")
				@include('inc.univer_profile')
			@endif
			@if($user->role == "organization")
				@include('inc.org_profile')
			@endif
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
	var requestUrl = '{{route('getUniverByRegion')}}';
	@if($user->role == 'student')
		var selUniverId = {{$user->getDetails()->university_id}};
		dateInputMask(document.getElementById('burnDate'));
	@endif

	
	selectFile = function (){
		$("#userPic").click();
	}

	function loadToPreview(input) {
		if((input.files[0].size / 1024 / 1024).toFixed(2) > 2 ){
			alert('Максимальный размер файла не фолжен превышать 2мб')
			return;
		}
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$("#previewUserPic").attr('src', e.target.result);
				$("#previewUserPic").height($("#previewUserPic").width());
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#userPic").change(function(){
		loadToPreview(this)
	});

	$( window ).resize(function() {
		$("#previewUserPic").height($("#previewUserPic").width());
	});

</script>
<script src="{{asset('js/profile.js')}}"></script>
@if($user->role == "student")
	<script>
		fillUniversities();
	</script>
@endif
@endsection