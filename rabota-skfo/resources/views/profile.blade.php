@extends("./layouts/cabinet")

@section("title")
- Профиль
@endsection

@section('sub_title')
Мой профиль
@endsection

@section('content')
<div class="container" style="margin-top: 10px; margin-bottom: 20px">
	<div class="row">
		<div class="col-md-9">
			@if(Auth::user()->role == "student")
				@include('inc.st_profile')
			@endif
			@if(Auth::user()->role == "organization")
				@include('inc.org_profile')
			@endif
			@if(Auth::user()->role == "university")
				@include('inc.univer_profile')
			@endif
			@if(Auth::user()->role == "moderator")
			<div class='card card-shadow' style="margin-top: 20px;">
				<div class="card-body">
						<h5 class="card-title">API-токен</h5>

						<div class="input-group mb-3">
							<input type="text" onclick="copyToken()" value="{{$user->api_token}}" readonly class="form-control" id="api-token">
							<div class="input-group-append">
								<button class="btn btn-outline-success" onclick="copyToken()" type="button"><i class="far fa-copy"></i></button>
								<button class="btn btn-outline-primary" onclick="generateNewToken()" type="button"><i class="fas fa-sync"></i></button>
							</div>
						</div>
						
				</div>
			</div>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col-md-9">
			@include('inc.reset_pass')
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
	var requestUrl = '{{route('getUniverByRegion')}}';
	@if(Auth::user()->role == 'student')
		var selUniverId = {{$user->getDetails()->university_id}};
		dateInputMask(document.getElementById('burnDate'));
	@endif
	
	selectFile = function (){
		$("#userPic").click();
	}

	@if(Auth::user()->role == "moderator")
		function generateNewToken(){
			var request = $.ajax({
					url: "{{route('moderator.updateApiToken')}}",
					method: "GET",
					dataType: "text"
			});

			request.done(function(msg) {
					console.log(msg);
					document.getElementById("api-token").value = msg;
					showAlert("Готово");
			});

			request.fail(function(jqXHR, textStatus) {
					console.log(textStatus);
			});
		}

		function copyToken(){
			var copyText = document.getElementById("api-token");

			// Select the text field
			copyText.select();
			copyText.setSelectionRange(0, 99999); // For mobile devices

			// Copy the text inside the text field
			document.execCommand('copy');

			showAlert("Готово!");

		}
	@endif

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

	function setImageHeight(){
		console.log("test");
	}

	$("#userPic").change(function(){
		loadToPreview(this)
	});

	$( window ).resize(function() {
		$("#previewUserPic").height($("#previewUserPic").width());
	});

</script>
<script src="{{asset('js/profile.js')}}"></script>
@if(Auth::user()->role == "student")
	<script>
		fillUniversities();
	</script>
@endif
@endsection