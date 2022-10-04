@extends("./layouts/cabinet")

@section("title")
- Вакансии
@endsection

@section('sub_title')
Вакансии
@endsection

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
@endsection

@section('content')
<div class="container">
    <div style="margin-top: 30px; margin-bottom: 24px">


        <form action="{{route('moderator.vacancies')}}" method="GET">
            <label>Поиск:</label>
            <div class="input-group mb-3">
            <input type="text" name="q" class="form-control" placeholder="Поиск" value="{{$_GET['q'] ?? ''}}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-outline-secondary" type="button">
                <i class="fas fa-search"></i> Поиск
                </button>
            </div>
            </div>
            @if(isset($_GET['q']) && !empty($_GET['q']))
                <div>Результаты поиска для <span class="badge badge-primary">"{{$_GET['q']}}"</span>: <span class="badge badge-{{$vacancies->total() == 0 ? 'danger' : 'success'}}">{{$vacancies->total()}} найдено</span></div>
            @endif
        </form>
        <div>
            @if($vacancies->total() == 0)
            <div style="text-align: center;">
                <img src="{{asset('res/illustrations/search_result.svg')}}" style="max-width: 300px">
                <br>
                Поиск не дал Результатов
            </div>
            @else
            <table style="background-color: #fff;" class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Наименование вакансии</th>
                        <th scope="col">Организация</th>
                        <th scope="col">Требования</th>
                        <th scope="col">Условия</th>
                        <th scope="col">Зарплата</th>
                        <th scope="col">Действие</th>
                    </tr>
                </thead>
                <tbody>
                @php($no = ($vacancies->perPage() * ($vacancies->currentPage() - 1)))
                @foreach($vacancies as $vacancy)
                    @php($no++)
                    <tr>
                        <th scope="row">{{$no}}</th>
                        <td>
                            <a target="_blank" href="{{route('vacancyDetails', ['id'=>$vacancy->id])}}">
                                {{$vacancy->position}}
                            </a>
                        </td>
                        <td>
                            <a target="_blank" href="{{route('orgDetails', ['id'=>$vacancy->getUser()->getDetails()->id])}}">
                                {{$vacancy->getOrg()->getOrgFullName()}}
                            </a>
                        </td>
                        <td>
                            <div class="elipsis">
                            {{$vacancy->duties}}
                            </div>
                        </td>
                        <td>
                            <div class="elipsis">
                                {{$vacancy->conditions}}
                                </div>
                            </td>
                        <td>{{$vacancy->getSalaryGap()}}</td>
                        <td style="width: 125px;">
                            @if($vacancy->is_active)
                                <button onclick="setActive({{$vacancy->id}}, 0)" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Снять с публикации"><i class="fas fa-eye-slash"></i></button>
                            @else
                                <button onclick="setActive({{$vacancy->id}}, 1)" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Опубликовать"><i class="fas fa-eye"></i></button>
                            @endif
                            <button class="btn btn-danger"data-toggle="modal" data-target="#removeUser_{{$vacancy->id}}"><i class="fas fa-trash-alt"></i></button>
                            <!-- Modal -->
                            <div class="modal fade" style="z-index: 999999999;" id="removeUser_{{$vacancy->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Подтверите действие</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Вы действительно хотите удалить: <br><b>{{$vacancy->position}}</b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                                    <button onclick="deleteVacancy({{$vacancy->id}})" type="button" class="btn btn-danger">Удалить</button>
                                </div>
                                </div>
                            </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div style="text-align: center;">
                {{$vacancies->links()}}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('js')
<script>

function setActive(id, value){
		var url = '{{route('moderator.setVacancyIsActive')}}';

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
            console.log(msg);
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
		var url = '{{route('moderator.removeVacancy')}}';

		var request = $.ajax({
			url: url,
			method: "GET",
			data: {
				"id": id
			},
			dataType: "json"
		});

		request.done(function(msg) {
            console.log(msg);
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

</script>
@endsection
