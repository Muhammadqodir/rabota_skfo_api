@extends("./layouts/cabinet")

@section("title")
- Мой кабинет
@endsection

@section('sub_title')
Мои вакансии
@endsection

@section('content')
<div class="container">
	<div class="row" style="margin-top: 10px;">
		<!-- <div id="resumeView" class="col-sm-12 col-md-9 order-2 order-sm-2 order-md-1"> -->
		<div id="resumeView" style="text-align: right;" class="col-sm-12 col-md-9">

			<button onclick="window.location.href = '{{route('org.createVacancy')}}'" class="btnColor" style="max-width: 200px;">+ Добавить вакансию</button>
			<br>
			<br>
			<div style="text-align: center;">
				@foreach(Auth::user()->getDetails()->getVacancies() as $vacancy)
				<div class="card" style="cursor: pointer; margin-bottom: 12px;">
					<div class="card-body" style="cursor: pointer;">
						<div class="row">
							<div class="col-12">
								<div class="item_date">{{$vacancy->created_at}}</div>
								<div class="item_title" style="text-align: left;">{{$vacancy->position}} <span class="badge badge-{{$vacancy->is_active ? 'success' : 'danger'}}"> {{$vacancy->is_active ? 'Опубликовано' : 'Снято с публикации'}} </span></div>
								<div class="item_description" style="text-align: left;">{!! str_replace("\n", '<br>', $vacancy->duties) !!}</div>
								<div class="row bottom_data" style="text-align: left;">
									<div class="col-md-4"> <i class="far fa-building" aria-hidden="true"></i> {{$vacancy->getOrg()->getOrgFullName()}} </div>
									<div class="col-md-4"> <i class="fas fa-map-marker" aria-hidden="true"></i> {{$vacancy->getRegion()}} </div>
									<div class="col-md-4"> <i class="fas fa-money-bill-wave" aria-hidden="true"></i> {{$vacancy->getSalaryGap()}}</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										@if($vacancy->is_active)
										<a type="button" onclick="setActive({{$vacancy->id}}, 0)" style="width: 100%; margin-top: 12px; color: #fff;" class="btn btn-secondary"><i class="fas fa-eye-slash"></i> Снять с публикации</a>
										@else
										<a type="button" onclick="setActive({{$vacancy->id}}, 1)" style="width: 100%; margin-top: 12px; color: #fff;" class="btn btn-success"><i class="fas fa-eye"></i> Опубликовать</a>
										@endif
									</div>
									<div class="col-md-4">
										<a style="width: 100%; margin-top: 12px;" class="btn btn-warning" target="_blank" href="{{route('org.editVacancy', ['id'=>$vacancy->id])}}"><i class="fas fa-pen"></i> Редактировать</a>
									</div>
									<div class="col-md-4">
										<a type="button" onclick="deleteVacancy({{$vacancy->id}})" style="width: 100%; margin-top: 12px; color: #fff;" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Удалить</a>
									</div>
								</div>
								<div class="item_date" style="margin-top: 12px; margin-bottom: -12px;">Запросы контактов: {{count($vacancy->getContactRequests())}} | <i class="fas fa-eye"></i> {{count($vacancy->getViews())}}</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
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

function setActive(id, value){
		var url = '{{route('org.setVacancyIsActive')}}';

		var request = $.ajax({
			url: url,
			method: "GET",
			data: {
				"id": id,
				"value": value
			},
			dataType: "json"
		});

		request.done(function(msg) {
			if(msg["success"]){
				showAlert("Готово");
				location.reload();
			}else{
				showAlert(msg["message"]);
			}
		});

		request.fail(function(jqXHR, textStatus) {
			console.log(textStatus);
			showAlert("Произошла ошибка");
		});
	}

	function deleteVacancy(id){
		var url = '{{route('org.removeVacancy')}}';

		var request = $.ajax({
			url: url,
			method: "GET",
			data: {
				"id": id
			},
			dataType: "json"
		});

		request.done(function(msg) {
			if(msg["success"]){
				showAlert("Готово");
				location.reload();
			}else{
				showAlert(msg["message"]);
			}
		});

		request.fail(function(jqXHR, textStatus) {
			console.log(textStatus);
			showAlert("Произошла ошибка");
		});
	}

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