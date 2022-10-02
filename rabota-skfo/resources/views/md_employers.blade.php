@extends("./layouts/cabinet")

@section("title")
- Студенты
@endsection

@section('sub_title')
Студенты
@endsection

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
@endsection

@section('content')
<div class="container">
    <div style="margin-top: 30px; margin-bottom: 24px">
        <form action="{{route('moderator.employers')}}" method="GET">
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
                <div>Результаты поиска для <span class="badge badge-primary">"{{$_GET['q']}}"</span>: <span class="badge badge-{{$organizations->total() == 0 ? 'danger' : 'success'}}">{{$organizations->total()}} найдено</span></div>
            @endif
        </form>
        <div>
            @if($organizations->total() == 0)
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
                        <th scope="col">Организация</th>
                        <th scope="col">Регион</th>
                        <th scope="col">Сфера деятельности</th>
                        <th scope="col">Кол-во активных вакансии</th>
                        <th scope="col">Действие</th>
                    </tr>
                </thead>
                <tbody>
                @php($no = ($organizations->perPage() * ($organizations->currentPage() - 1)))
                @foreach($organizations as $organization)
                    @php($no++)
                    <tr>
                        <th scope="row">{{$no}}</th>
                        <td>{{$organization->getDetails()->getOrgFullName()}}</td>
                        <td>{{$organization->getRegionName()}}</td>
                        <td>{{$organization->getDetails()->getSphere()->name}}</td>
                        <td>
                            {{$organization->getDetails()->getVacanciesCount()}}
                            <a href="{{route('moderator.orgVacancies', ['org'=>$organization->id])}}" class="btn btn-link"><i class="fas fa-eye"></i> Посмотреть</a>
                        </td>
                        <td style="width: 120px;">
                            @if($organization->active)
                                <button onclick="setActive({{$organization->id}}, 0)" class="btn btn-warning"><i class="fas fa-lock"></i></button>
                            @else
                                <button onclick="setActive({{$organization->id}}, 1)" class="btn btn-primary"><i class="fas fa-unlock"></i></button>
                            @endif
                            <button class="btn btn-danger"data-toggle="modal" data-target="#removeUser_{{$organization->id}}"><i class="fas fa-trash-alt"></i></button>
                            <!-- Modal -->
                            <div class="modal fade" style="z-index: 999999999;" id="removeUser_{{$organization->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Подтверите действие</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Вы действительно хотите удалить: <br><b>{{$organization->getDetails()->getOrgFullName()}}</b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                                    <button onclick="deleteOrg({{$organization->id}})" type="button" class="btn btn-danger">Удалить</button>
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
                {{$organizations->links()}}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('js')
<script>

function setActive(id, value){
		var url = '{{route('moderator.setOrgActive')}}';

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

	function deleteOrg(id){
		var url = '{{route('moderator.removeOrg')}}';

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
