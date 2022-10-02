@extends("./layouts/app")

@section("title")
- Организация
@endsection

@section('content')
@if($org != null)
    <div class="row">
        <div class="col-md-3">
            <div style="background-color: #F7F9FA; padding: 12px;">
                <img src="{{$org->getUser()->isUserHasPic() ? asset($org->getUser()->pic) : asset('res/icons/company.svg')}}" width="100%" class="round_rect">

                <br>

                <div style="margin-top: 12px"><i class="fas fa-map-marker-alt"></i> {{$org->getUser()->getRegionName()}}</div>

                <div style="margin-top: 12px"><a target="_blank" href="{{$org->web_site}}"><i class="fas fa-link"></i> {{$org->web_site}}</a></div>

                <div style="margin-top: 12px;"><label class="less-padding" style="margin-top: 0px !important;"><i class="far fa-dot-circle"></i> Сферы деятельности</label><br> {{$org->getSphere()->name}}</div>

                <div style="margin-top: 12px;"><label class="less-padding" style="margin-top: 0px !important;">Ваканции</label><br>Активные ваканции: {{count($org->getActiveVacancies())}}</div>
                @if(Auth::check()) 
                    @if(Auth::user()->role == 'student')
                        @if(Auth::user()->getDetails()->isSubscribed($org->id))
                            <div style="margin-top: 12px;"> <button class="btn" onclick="subscribe({{$org->id}})" style="width: 100%;"><i class="fas fa-check"></i> Вы подписаны</button> </div>
                        @else
                            <div style="margin-top: 12px;"> <button class="btn btn-success" onclick="subscribe({{$org->id}})" style="width: 100%;">Подписаться</button> </div>
                        @endif
                    @endif
                @endif
            </div>
        </div>
        <div class="col-md-9">
            <h3 class="strokeme"> {{$org->getOrgFullName()}}</h3>

                <div class="card">
                    <div class="card-body">
                    {!! str_replace("\n", '<br>', $org->description) !!}
                    </div>
                </div>
        </div>
    </div>
    <h5 style="margin-top: 24px;" class="strokeme"><i class="fas fa-briefcase"></i> Ваканции компании:</h5>
    <div class="row" style="margin-top: 18px;">
        @foreach($org->getActiveVacancies() as $item)
        <div class="col-12" style="margin-bottom: 12px;">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2"> <img src="{{$item->getUser()->isUserHasPic() ? asset($item->getUser()->pic) : asset('res/icons/company.svg')}}" class="item_image round_rect"> </div>
                        <div class="col-md-10">
                            <div class="item_date">{{$item->updated_at}}</div>
                            <div class="item_title">{{$item->position}}</div>
                            <div class="item_description">{!! str_replace("\n", '<br>', $item->duties) !!}</div>
                            <div class="row bottom_data">
                                <div class="col-md-4"> <i class="far fa-building"></i> {{$item->getUser()->getDetails()->getOrgFullName()}} </div>
                                <div class="col-md-4"> <i class="fas fa-map-marker"></i> {{$item->getUser()->getRegionName()}} </div>
                                <div class="col-md-4"> <i class="fas fa-money-bill-wave"></i> {{$item->getSalaryGap()}} </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection

@section('js')
<script>
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