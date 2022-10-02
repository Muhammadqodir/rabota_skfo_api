@extends("./layouts/cabinet")

@section("title")
- Избранные
@endsection

@section('sub_title')
Избранные
@endsection

@section('content')
<div class="container">
	<div class="row" style="margin-top: 10px;">
		<!-- <div id="resumeView" class="col-sm-12 col-md-9 order-2 order-sm-2 order-md-1"> -->
		<div id="resumeView" class="col-sm-12 col-md-9">
			<div id="tab_content" style="padding-top: 20px;">
                @if(count(Auth::user()->getDetails()->getFavs()) == 0)
                <div style="text-align: center;">
                    <img src="{{asset('res/illustrations/empty.svg')}}" style="max-width: 250px;"><br>
                    Список избранных пуст
                </div>
                @endif
                @foreach(Auth::user()->getDetails()->getFavs() as $item)
                    @php($vacancy = \App\Models\Vacancy::find($item->target_id))
                    <div class="col-12" style="margin-bottom: 12px;">
                        <div class="card" style="cursor: pointer;" onclick="window.location.href = '{{route('vacancyDetails', ['id'=>$vacancy->id])}}'">
                            <div class="card-body" style="padding: 12px;">
                                    <div class="row">
                                        <div class="col-lg-2 d-lg-block d-md-none d-none"> <img src="{{$vacancy->getUser()->isUserHasPic() ? asset($vacancy->getUser()->pic) : asset('res/icons/company.svg')}}" class="item_image round_rect"> </div>
                                        
                                        <div class="col-md-12 col-lg-10">
                                            <div class="item_date">{{$vacancy->updated_at}}</div>
                                            <a style="text-decoration: none;" href="{{route('vacancyDetails', ['id'=>$vacancy->id])}}">    
                                            <div class="item_title">{{$vacancy->position}}</div>
                                            </a>
                                            <div class="item_description">{!! str_replace("\n", '<br>', $vacancy->duties) !!}</div>
                                            <div class="row" style="color: #444;">
                                                <div class="col-lg-4" onclick="window.open('{{route('orgDetails', ['id'=>$vacancy->getUser()->getDetails()->id])}}', '_blank').focus()">
                                                    <i class="far fa-building"></i> {{$vacancy->getUser()->getDetails()->getOrgFullName()}}
                                                </div>
                                                <div class="col-lg-4">
                                                    <i class="fas fa-map-marker"></i> {{$vacancy->getUser()->getRegionName()}}
                                                </div>
                                                <div class="col-lg-4">
                                                    <i class="fas fa-money-bill-wave"></i> {{$vacancy->getSalaryGap()}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <i class="fas fa-star btnFav" onclick="addToFav({{$vacancy->id}})" style="position: absolute; margin: 6px; font-size: 24px; color: #F7B519;"></i>
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
</script>
@endsection