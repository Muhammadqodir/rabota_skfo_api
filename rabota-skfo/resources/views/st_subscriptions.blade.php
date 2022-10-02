@extends("./layouts/cabinet")

@section("title")
- Подписки
@endsection

@section('sub_title')
Подписки
@endsection

@section('content')
<div class="container">
	<div class="row" style="margin-top: 10px;">
		<!-- <div id="resumeView" class="col-sm-12 col-md-9 order-2 order-sm-2 order-md-1"> -->
		<div id="resumeView" class="col-sm-12 col-md-9">
			<div id="tab_content" style="padding-top: 20px;">
                @if(count(Auth::user()->getDetails()->getSubscriptions()) == 0)
                <div style="text-align: center;">
                    <img src="{{asset('res/illustrations/empty.svg')}}" style="max-width: 250px;"><br>
                    Список подписок пуст
                </div>
                @endif
                @foreach(Auth::user()->getDetails()->getSubscriptions() as $item)
                    @php($company = \App\Models\Organization::find($item->target_id))
                    <div class="col-md-12 col-lg-6"  style="margin-bottom: 12px;">
                        <div class="card">
                            <div class="card-body" style="cursor: pointer; display: flex; align-items: center;">
                                <img class="circle" style="width: 40px; float: left; margin-right: 12px;" src="{{$company->getUser()->isUserHasPic() ? asset($company->getUser()->pic) : asset('res/icons/no-photo.jpeg')}}">
                                <div>
                                    <span style="font-size: 12px; color: #888;">{{$company->created_at}}</span><br>
                                    {{$company->getOrgFullName()}}

                                    @if(Auth::check()) 
                                        @if(Auth::user()->role == 'student')
                                            @if(Auth::user()->getDetails()->isSubscribed($company->id))
                                                <div style="margin-top: 12px;"> <button class="btn text-ellipsis" style="width: 100%;" onclick="subscribe({{$company->id}})"><i class="fas fa-check"></i> Вы подписаны</button> </div>
                                            @else
                                                <div style="margin-top: 12px;"> <button class="btn btn-success text-ellipsis" style="width: 100%;" onclick="subscribe({{$company->id}})">Подписаться</button> </div>
                                            @endif
                                        @endif
                                    @endif
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
    function addToFav(vacancy_id){
        var request_url = "{{route('student.addToFav')}}";
		var request = $.ajax({
			url: request_url,
			method: "GET",
            data: {
                'id': vacancy_id
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

    function subscribe(id){
        var request_url = "{{route('student.subscribe')}}";
		var request = $.ajax({
			url: request_url,
			method: "GET",
            data: {
                'id': id
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